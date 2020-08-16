<?php

namespace jeyofdev\wp\yoga\ahana\inc;

use \WP_Query;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the queries
 */
class Queries {

    /**
     * Load the queries
     *
     * @return void
     */
    public static function init () : void
    {
        self::add_query_vars();

        add_action("pre_get_posts", function (WP_Query $query) {
            if (is_admin() || !$query->is_main_query()) {
                return null;
            }

            if (is_search()) {
                self::set_search_args($query);
            } elseif (is_category()) {
                self::set_category_args($query);
            } elseif (is_post_type_archive("trainer")) {
                self::set_trainer_args($query);
            } elseif (is_post_type_archive("classes")) {
                $query->set("post_type", "classes");
                $query->set("posts_per_page", 6);

                $meta_query = $query->get("meta_query", []);

                // filter by category and trainer
                self::filter_by_taxonomy($query, "classes_category", "category");
                self::filter_by_taxonomy($query, "classes_trainer", "trainer");

                // filter by price
                self::filter_by_range($query, ["min" => "classes_price_min", "max" => "classes_price_max"], "classes_price");

                // filter by day
                $days = Timber::get_terms([
                    "taxonomy" => "classes_day",
                    "orderby" => "ID",
                ]);

                foreach ($days as $day) {
                    $query_var = get_query_var("classes_" . $day->slug());

                    if ($query_var) {
                        $meta_query[] = [
                            "taxonomy" => "classes_day",
                            "field"    => "slug",
                            "terms" => $day->slug()
                        ];
                        $query->set("tax_query", $meta_query);
                    }
                }
            } elseif (is_post_type_archive("event")) {
                $query->set("post_type", "event");
                $query->set("posts_per_page", 8);

                $meta_query = $query->get("meta_query", []);

                // filter by date
                $filterDate = explode("/", get_query_var("event_date"));
                $date = '';
                if (count($filterDate) === 3) {
                    $date = $filterDate[2] . $filterDate[0] . $filterDate[1];
                    self::filter_by_field($query, $date, "event_date", ">=");
                }

                // filter by search
                $search = get_query_var("event_search");
                if ($search) {
                    $query->set("s", $search);
                }

                // filter by trainer
                self::filter_by_taxonomy($query, "event_trainer", "trainer");
            } else {
                return null;
            }
        });
    }



    /**
     * Filters the query variables whitelist before processing.
     *
     * @return void
     */
    public static function add_query_vars () : void
    {
        add_filter("query_vars", function (array $params)
        {
            $params[] = "search_all";
            $params[] = "search_blog";
            $params[] = "event_date";
            $params[] = "event_search";
            $params[] = "event_trainer";
            $params[] = "classes_trainer";
            $params[] = "classes_category";
            $params[] = "classes_price_min";
            $params[] = "classes_price_max";

            $days = Timber::get_terms([
                "taxonomy" => "classes_day",
                "orderby" => "ID",
            ]);
            
            foreach ($days as $day) {
                $params[] = "classes_" . $day->slug;
            }
            return $params;
        });
    }



    /**
     * Set the parameters of the category query
     *
     * @return WP_Query
     */
    public static function set_category_args (WP_Query $query) : WP_Query
    {
        $query->set("post_type", ["post", "classes", "event"]);
        $query->set("posts_per_page", 6);

        return $query;
    }



    /**
     * Set the parameters of the trainer query
     *
     * @return WP_Query
     */
    public static function set_trainer_args (WP_Query $query) : WP_Query
    {
        $query->set("post_type", "trainer");
        $query->set("posts_per_page", 6);

        return $query;
    }



    /**
     * Set the parameters of the search query
     *
     * @return WP_Query
     */
    public static function set_search_args (WP_Query $query) : WP_Query
    {
        $searchAll = get_query_var("search_all");
        $searchBlog = get_query_var("search_blog");

        if (!empty($searchAll)) {
            $query->set("post_type", ["post", "trainer", "classes", "event"]);
            $query->set("posts_per_page", 10);
        } elseif (!empty($searchBlog)) {
            $query->set("post_type", "post");
        }

        return $query;
    }



    /**
     * Filter posts based on a taxonomy
     *
     * @param WP_Query $query
     * @param string $query_vars
     * @param string $taxonomy
     * @return WP_Query
     */
    public static function filter_by_taxonomy (WP_Query $query, string $query_vars, string $taxonomy) : WP_Query
    {
        $terms = get_query_var($query_vars);
        if ($terms) {
            $meta_query[] = [
                "taxonomy" => $taxonomy,
                "field"    => "slug",
                "terms" => $terms,
            ];
            $query->set("tax_query", $meta_query);
        }

        return $query;
    }



    /**
     * Filter posts based on a custom field
     *
     * @param WP_Query $query
     * @param int|string $value
     * @param string $field
     * @param string $compare
     * @return WP_Query
     */
    public static function filter_by_field (WP_Query $query, $value, string $field, string $compare) : WP_Query
    {
        if ($value) {
            $meta_query[] = [
                "key" => $field,
                "value" => $value,
                "compare" => $compare
            ];
            $query->set("meta_query", $meta_query);
        }

        return $query;
    }



    /**
     * Filter posts based on a range of two values
     *
     * @param WP_Query $query
     * @param array $query_vars ex: [min => "classes_price_min", max => "classes_price_max"]
     * @param string $key
     * @param string|null $type
     * @param string|null $compare
     * @return WP_Query
     */
    public static function filter_by_range (WP_Query $query, array $query_vars, string $key, ?string $type = "numeric", ?string $compare = "BETWEEN") : WP_Query
    {
        $min = get_query_var($query_vars["min"]);
        $max = get_query_var($query_vars["max"]);

        if ($min & $max) {
            $meta_query[] = [
                "key" => $key,
                "value" => [$min, $max],
                "type" => $type,
                "compare" => $compare
            ];
            $query->set("meta_query", $meta_query);
        }

        return $query;
    }
}
