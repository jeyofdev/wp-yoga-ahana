<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the assets
 */
class Assets {

    /**
     * Register and enqueue styles & scripts
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("wp_enqueue_scripts", function () {
            wp_enqueue_script("script", dirname(get_template_directory_uri()) . "/assets/scripts/app.js", [], true, true);
            wp_enqueue_style("styles", dirname(get_template_directory_uri()) . "/assets/styles/app.css", [], true);
        });

        add_action("admin_enqueue_scripts", function () {
            wp_enqueue_style("admin_styles", dirname(get_template_directory_uri()) . "/assets/styles/admin.css", [], true);
        });
    }
}