<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class that manages the menus
 */
class Menus {

    /**
     * Register the navigation menus location
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("init", function () {
            register_nav_menu("primary", __("Main navigation", "ahana"));
        });
    }
}


