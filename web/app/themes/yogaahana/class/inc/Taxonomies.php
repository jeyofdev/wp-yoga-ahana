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
    }
}
