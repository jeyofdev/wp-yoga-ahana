<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the post types
 */
class PostTypes {

    /**
     * Load all post types
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("init", function () {
            self::register_post_type();
        });
    }



    /**
     * Registers post types
     *
     * @return void
     */
    public static function register_post_type () : void
    {
        register_post_type("trainer", [
            "label" => __("Trainers", "ahana"),
            "labels" => [
                "name"                     => __("Trainers", "ahana"),
                "singular_name"            => __("Trainer", "ahana"),
                "edit_item"                => __("Edit Trainer", "ahana"),
                "new_item"                 => __("New Trainer", "ahana"),
                "view_item"                => __("View Trainer", "ahana"),
                "view_items"               => __("View Trainers", "ahana"),
                "search_items"             => __("Search Trainers", "ahana"),
                "not_found"                => __("No trainers found.", "ahana"),
                "not_found_in_trash"       => __("No trainers found in trash.", "ahana"),
                "all_items"                => __("All Trainers", "ahana")
            ],
            "public" => true,
            "hierarchical" => false,
            "exclude_from_search" => true,
            "menu_position" => 30,
            "menu_icon" => "dashicons-universal-access",
            "supports" => ["title", "thumbnail", "editor"],
            "show_in_rest" => false,
            "has_archive" => true
        ]);
    }
}


