<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the taxonomies
 */
class Taxonomies {

    /**
     * Load all custom taxonomies
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("init", function () {
            self::register_taxonomy();
        });
    }



    /**
     * Registers taxonomies
     *
     * @return void
     */
    public static function register_taxonomy () : void
    {
        register_taxonomy("trainer_job", "trainer", [
            "labels" => [
                "name"                       => __( "Jobs", "ahana"),
                "singular_name"              => __( "Job", "ahana"),
                "search_items"               => __( "Search Jobs", "ahana"),
                "popular_items"              => __( "Popular Jobs", "ahana"),
                "all_items"                  => __( "All Jobs", "ahana"),
                "edit_item"                  => __( "Edit Job", "ahana"),
                "view_item"                  => __( "View Job", "ahana"),
                "update_item"                => __( "Update Job", "ahana"),
                "add_new_item"               => __( "Add New Job", "ahana"),
                "not_found"                  => __( "No Jobs found.", "ahana"),
                "no_terms"                   => __( "No Jobs", "ahana"),
                "back_to_items"              => __( "&larr; Back to Jobs", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
        ]);

        register_taxonomy("trainer", ["post", "classes", "event"], [
            "labels" => [
                "name"                       => __( "Trainers", "ahana"),
                "singular_name"              => __( "Trainer", "ahana"),
                "search_items"               => __( "Search Trainers", "ahana"),
                "popular_items"              => __( "Popular Trainers", "ahana"),
                "all_items"                  => __( "All Trainers", "ahana"),
                "edit_item"                  => __( "Edit Trainer", "ahana"),
                "view_item"                  => __( "View Trainer", "ahana"),
                "update_item"                => __( "Update Trainer", "ahana"),
                "add_new_item"               => __( "Add New Trainer", "ahana"),
                "not_found"                  => __( "No Trainers found.", "ahana"),
                "no_terms"                   => __( "No Trainers", "ahana"),
                "back_to_items"              => __( "&larr; Back to Trainers", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
            "show_in_rest" => true
        ]);

        register_taxonomy("classes_level", "classes", [
            "labels" => [
                "name"                       => __( "Levels", "ahana"),
                "singular_name"              => __( "Level", "ahana"),
                "search_items"               => __( "Search Levels", "ahana"),
                "popular_items"              => __( "Popular Levels", "ahana"),
                "all_items"                  => __( "All Levels", "ahana"),
                "edit_item"                  => __( "Edit Level", "ahana"),
                "view_item"                  => __( "View Level", "ahana"),
                "update_item"                => __( "Update Level", "ahana"),
                "add_new_item"               => __( "Add New Level", "ahana"),
                "not_found"                  => __( "No Levels found.", "ahana"),
                "no_terms"                   => __( "No Levels", "ahana"),
                "back_to_items"              => __( "&larr; Back to Levels", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
            "show_in_rest" => true
        ]);

        register_taxonomy("classes_day", "classes", [
            "labels" => [
                "name"                       => __( "Days", "ahana"),
                "singular_name"              => __( "Day", "ahana"),
                "search_items"               => __( "Search Days", "ahana"),
                "popular_items"              => __( "Popular Days", "ahana"),
                "all_items"                  => __( "All Days", "ahana"),
                "edit_item"                  => __( "Edit Day", "ahana"),
                "view_item"                  => __( "View Day", "ahana"),
                "update_item"                => __( "Update Day", "ahana"),
                "add_new_item"               => __( "Add New Day", "ahana"),
                "not_found"                  => __( "No Days found.", "ahana"),
                "no_terms"                   => __( "No Days", "ahana"),
                "back_to_items"              => __( "&larr; Back to Days", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
        ]);

        register_taxonomy("pricing_plan_payment", "pricing_plan", [
            "labels" => [
                "name"                       => __( "Payments", "ahana"),
                "singular_name"              => __( "Payment", "ahana"),
                "search_items"               => __( "Search Payments", "ahana"),
                "popular_items"              => __( "Popular Payments", "ahana"),
                "all_items"                  => __( "All Payments", "ahana"),
                "edit_item"                  => __( "Edit Payment", "ahana"),
                "view_item"                  => __( "View Payment", "ahana"),
                "update_item"                => __( "Update Payment", "ahana"),
                "add_new_item"               => __( "Add New Payment", "ahana"),
                "not_found"                  => __( "No Payments found.", "ahana"),
                "no_terms"                   => __( "No Payments", "ahana"),
                "back_to_items"              => __( "&larr; Back to Payments", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
        ]);

        register_taxonomy("pricing_plan_options", "pricing_plan", [
            "labels" => [
                "name"                       => __( "Options", "ahana"),
                "singular_name"              => __( "Option", "ahana"),
                "search_items"               => __( "Search Options", "ahana"),
                "popular_items"              => __( "Popular Options", "ahana"),
                "all_items"                  => __( "All Options", "ahana"),
                "edit_item"                  => __( "Edit Option", "ahana"),
                "view_item"                  => __( "View Option", "ahana"),
                "update_item"                => __( "Update Option", "ahana"),
                "add_new_item"               => __( "Add New Option", "ahana"),
                "not_found"                  => __( "No Options found.", "ahana"),
                "no_terms"                   => __( "No Options", "ahana"),
                "back_to_items"              => __( "&larr; Back to Options", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
        ]);

        register_taxonomy("pricing_plan_level", "pricing_plan", [
            "labels" => [
                "name"                       => __( "Levels", "ahana"),
                "singular_name"              => __( "Level", "ahana"),
                "search_items"               => __( "Search Levels", "ahana"),
                "popular_items"              => __( "Popular Levels", "ahana"),
                "all_items"                  => __( "All Levels", "ahana"),
                "edit_item"                  => __( "Edit Level", "ahana"),
                "view_item"                  => __( "View Level", "ahana"),
                "update_item"                => __( "Update Level", "ahana"),
                "add_new_item"               => __( "Add New Level", "ahana"),
                "not_found"                  => __( "No Levels found.", "ahana"),
                "no_terms"                   => __( "No Levels", "ahana"),
                "back_to_items"              => __( "&larr; Back to Levels", "ahana")
            ],
            "hierarchical" => true,
            "meta_box_cb" => "post_categories_meta_box",
            "has_archive" => false,
        ]);
    }
}
