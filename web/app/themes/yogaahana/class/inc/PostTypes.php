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

        register_post_type("classes", [
            "label" => __("Class", "ahana"),
            "labels" => [
                "name"                     => __("Classes", "ahana"),
                "singular_name"            => __("Class", "ahana"),
                "edit_item"                => __("Edit Class", "ahana"),
                "new_item"                 => __("New Class", "ahana"),
                "view_item"                => __("View Class", "ahana"),
                "view_items"               => __("View Classes", "ahana"),
                "search_items"             => __("Search Classes", "ahana"),
                "not_found"                => __("No Classes found.", "ahana"),
                "not_found_in_trash"       => __("No Classes found in trash.", "ahana"),
                "all_items"                => __("All Classes", "ahana")
            ],
            "public" => true,
            "hierarchical" => false,
            "exclude_from_search" => true,
            "menu_position" => 31,
            "menu_icon" => "dashicons-testimonial",
            "supports" => ["title", "thumbnail", "editor", "excerpt", "comments"],
            "show_in_rest" => false,
            "has_archive" => true,
            "taxonomies" => ["category"]
        ]);

        register_post_type("event", [
            "label" => __("Event", "ahana"),
            "labels" => [
                "name"                     => __("Events", "ahana"),
                "singular_name"            => __("Event", "ahana"),
                "edit_item"                => __("Edit Event", "ahana"),
                "new_item"                 => __("New Event", "ahana"),
                "view_item"                => __("View Event", "ahana"),
                "view_items"               => __("View Events", "ahana"),
                "search_items"             => __("Search Events", "ahana"),
                "not_found"                => __("No Events found.", "ahana"),
                "not_found_in_trash"       => __("No Events found in trash.", "ahana"),
                "all_items"                => __("All Events", "ahana")
            ],
            "public" => true,
            "hierarchical" => false,
            "exclude_from_search" => true,
            "menu_position" => 32,
            "menu_icon" => "dashicons-calendar-alt",
            "supports" => ["title", "thumbnail", "editor", "comments"],
            "show_in_rest" => false,
            "has_archive" => true,
            "taxonomies" => ["category"]
        ]);

        register_post_type("service", [
            "label" => __("Services", "ahana"),
            "labels" => [
                "name"                     => __("Services", "ahana"),
                "singular_name"            => __("Service", "ahana"),
                "edit_item"                => __("Edit Service", "ahana"),
                "new_item"                 => __("New Service", "ahana"),
                "view_item"                => __("View Service", "ahana"),
                "view_items"               => __("View Services", "ahana"),
                "search_items"             => __("Search Services", "ahana"),
                "not_found"                => __("No Services found.", "ahana"),
                "not_found_in_trash"       => __("No Services found in trash.", "ahana"),
                "all_items"                => __("All Services", "ahana")
            ],
            "public" => true,
            "hierarchical" => false,
            "exclude_from_search" => true,
            "menu_position" => 33,
            "menu_icon" => "dashicons-admin-generic",
            "supports" => ["title", "thumbnail", "editor"],
            "show_in_rest" => false,
            "has_archive" => false
        ]);

        register_post_type("testimonial", [
            "label" => __("Testimonial", "ahana"),
            "labels" => [
                "name"                     => __("Testimonials", "ahana"),
                "singular_name"            => __("Testimonial", "ahana"),
                "edit_item"                => __("Edit Testimonial", "ahana"),
                "new_item"                 => __("New Testimonial", "ahana"),
                "view_item"                => __("View Testimonial", "ahana"),
                "view_items"               => __("View Testimonials", "ahana"),
                "search_items"             => __("Search Testimonials", "ahana"),
                "not_found"                => __("No Testimonials found.", "ahana"),
                "not_found_in_trash"       => __("No Testimonials found in trash.", "ahana"),
                "all_items"                => __("All Testimonials", "ahana")
            ],
            "public" => true,
            "hierarchical" => false,
            "exclude_from_search" => true,
            "menu_position" => 34,
            "menu_icon" => "dashicons-testimonial",
            "supports" => ["title", "thumbnail", "editor"],
            "show_in_rest" => false,
            "has_archive" => false
        ]);
    }
}


