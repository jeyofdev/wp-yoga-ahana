<?php

namespace jeyofdev\wp\yoga\ahana\inc;

use \WP_Query;


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
            }

            else if (!is_admin() && is_post_type_archive("event") && $query->is_main_query()) {
                $query->set("post_type", "event");
                $query->set("posts_per_page", 8);
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

            if (!empty($searchAll)) {
                $query->set("post_type", ["post", "trainer", "classes", "event"]);
                $query->set("posts_per_page", 10);
            }

            return $query;
        });
    }



    public static function add_query_vars () : void
    {
        add_filter("query_vars", function (array $params)
        {
            $params[] = "search_all";

            return $params;
        });
    }
}
