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
        self::set_search_args();

        add_action("pre_get_posts", function ($query) {
            if (!is_admin() && is_post_type_archive("trainer") && $query->is_main_query()) {
                $query->set("post_type", "trainer");
                $query->set("posts_per_page", 6);
            } 

            else if (!is_admin() && is_post_type_archive("classes") && $query->is_main_query()) {
                $query->set("post_type", "classes");
                $query->set("posts_per_page", 6);

                $meta_query = $query->get("meta_query", []);

                // filter category
                $category = get_query_var("classes_category");
                if ($category) {
                    $meta_query[] = [
                        "taxonomy" => "category",
                        "field"    => "slug",
                        "terms" => $category,
                    ];
                    $query->set("tax_query", $meta_query);
                }

                // filter trainer
                $trainer = get_query_var("classes_trainer");
                if ($trainer) {
                    $meta_query[] = [
                        "taxonomy" => "trainer",
                        "field"    => "slug",
                        "terms" => $trainer,
                    ];
                    $query->set("tax_query", $meta_query);
                }

                // filter price
                $price_min = get_query_var("classes_price_min");
                $price_max = get_query_var("classes_price_max");
                if ($price_min & $price_max) {
                    $meta_query[] = [
                        "key" => "classes_price",
                        "value" => [$price_min, $price_max],
                        "type" => "numeric",
                        "compare" => "BETWEEN"
                    ];
                    $query->set("meta_query", $meta_query);
                }

                // filter days
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
            }

            else if (!is_admin() && is_post_type_archive("event") && $query->is_main_query()) {
                $query->set("post_type", "event");
                $query->set("posts_per_page", 8);

                // filter date
                $filterDate = explode("/", get_query_var("event_date"));

                $date = '';
                if (count($filterDate) === 3) {
                    $date = $filterDate[2] . $filterDate[0] . $filterDate[1]; 
                }

                if ($date) {
                    $meta_query = $query->get("meta_query", []);
                    $meta_query[] = [
                        "key" => "event_date",
                        "value" => $date,
                        "compare" => ">="
                    ];
                    $query->set("meta_query", $meta_query);
                }

                // filter search
                $search = get_query_var("event_search");
                if ($search) {
                    $query->set("s", $search);
                }

                // filter trainer
                $trainer = get_query_var("event_trainer");
                if ($trainer) {
                    $meta_query = $query->get("meta_query", []);
                    $meta_query[] = [
                        "taxonomy" => "trainer",
                        "field"    => "slug",
                        "terms" => $trainer,
                    ];
                    $query->set("tax_query", $meta_query);
                }
            }

            else if (!is_admin() && is_category() && $query->is_main_query()) {
                $query->set("post_type", ["post", "classes", "event"]);
                $query->set("posts_per_page", 6);
            }
        });
    }



    /**
     * Set the parameters of the search query
     *
     * @return void
     */
    public static function set_search_args () : void
    {
        add_action("pre_get_posts", function (WP_Query $query) {
            if (is_admin() || !is_search() || !$query->is_main_query()) {
                return;
            }

            $searchAll = get_query_var("search_all");
            $searchBlog = get_query_var("search_blog");

            if (!empty($searchAll)) {
                $query->set("post_type", ["post", "trainer", "classes", "event"]);
                $query->set("posts_per_page", 10);
            } elseif (!empty($searchBlog)) {
                $query->set("post_type", "post");
            }

            return $query;
        });
    }



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
}
