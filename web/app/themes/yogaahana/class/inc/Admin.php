<?php

namespace jeyofdev\wp\yoga\ahana\inc;

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the admin custom
 */
class Admin {

    public static function init () : void
    {
        self::post_type_trainer_columns();
        self::post_type_classes_columns();
        self::post_type_event_columns();
        self::post_type_service_columns();
    }



    /**
     * Filters the columns displayed in the Posts list table for a trainer post type
     *
     * @return void
     */
    public static function post_type_trainer_columns () : void
    {
        add_filter("manage_trainer_posts_columns", function ($columns) {
            return [
                "cb" => $columns["cb"],
                "thumbnail" => __("Thumbnail", "ahana"),
                "title" => $columns["title"],
                "job" => __("Job", "ahana"),
                "date" => $columns["date"]
            ];
        });

        add_filter("manage_trainer_posts_custom_column", function ($column, $postId) {
            if ($column === "thumbnail") {
                the_post_thumbnail("admin_column_thumbnail", $postId);
            } else if ($column === "job") {
                echo self::set_column("trainer", $postId, "trainer_job");
            }
        }, 10, 2);
    }



    /**
     * Filters the columns displayed in the Posts list table for a classes post type
     *
     * @return void
     */
    public static function post_type_classes_columns () : void
    {
        add_filter("manage_classes_posts_columns", function ($columns) {
            return [
                "cb" => $columns["cb"],
                "thumbnail" => __("Thumbnail", "ahana"),
                "title" => $columns["title"],
                "categories" => __("Categories", "ahana"),
                "trainer" => __("Trainer", "ahana"),
                "level" => __("Level", "ahana"),
                "date" => $columns["date"]
            ];
        });

        add_filter("manage_classes_posts_custom_column", function ($column, $postId) {
            switch ($column) {
                case "thumbnail":
                    the_post_thumbnail("admin_column_thumbnail", $postId);
                    break;
                case "level":
                    echo self::set_column("classes", $postId, "classes_level");
                    break;
                case "trainer":
                    echo self::set_column("classes", $postId, "trainer");
                    break;
                case "categories":
                    echo self::set_column("classes", $postId, "category");
                    break;

                default:
                    break;
            }
        }, 10, 2);
    }



    /**
     * Filters the columns displayed in the Posts list table for a event post type
     *
     * @return void
     */
    public static function post_type_event_columns () : void
    {
        add_filter("manage_event_posts_columns", function ($columns) {
            return [
                "cb" => $columns["cb"],
                "thumbnail" => __("Thumbnail", "ahana"),
                "title" => $columns["title"],
                "categories" => __("Categories", "ahana"),
                "trainer" => __("Trainer", "ahana"),
                "comments" => $columns["comments"],
                "date" => $columns["date"]
            ];
        });

        add_filter("manage_event_posts_custom_column", function ($column, $postId) {
            switch ($column) {
                case "thumbnail":
                    the_post_thumbnail("admin_column_thumbnail", $postId);
                    break;
                case "categories":
                    echo self::set_column("event", $postId, "category");
                    break;
                case "trainer":
                    echo self::set_column("event", $postId, "trainer");
                    break;

                default:
                    break;
            }
        }, 10, 2);
    }



    /**
     * Filters the columns displayed in the Posts list table for a service post type
     *
     * @return void
     */
    public static function post_type_service_columns () : void
    {
        add_filter("manage_service_posts_columns", function ($columns) {
            return [
                "cb" => $columns["cb"],
                "thumbnail" => __("Thumbnail", "ahana"),
                "title" => $columns["title"],
                "date" => $columns["date"]
            ];
        });

        add_filter("manage_service_posts_custom_column", function ($column, $postId) {
            if ($column === "thumbnail") {
                the_post_thumbnail("admin_column_thumbnail", $postId);
            }
        }, 10, 2);
    }



    /**
     * Fires for each custom column of a specific post type in the Posts list table
     *
     * @param string $postType
     * @param integer $postId
     * @param string $taxonomy
     * @return string|null
     */
    public static function set_column (string $postType, int $postId, string $taxonomy) : ?string
    {
        $post = Timber::get_post([
            "post_type" => $postType,
            "posts_per_page" => 1,
            "post__in" => [$postId]
        ]);

        $terms = $post->terms($taxonomy);

        $currentTerms = [];
        foreach ($terms as $term) {
            $currentTerms[] = $term->name;
        }

        return join(", ", $currentTerms);
    }
}