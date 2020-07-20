<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the theme supports
 */
class Supports {

    /**
     * Registers theme supports
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("after_setup_theme", function () {
            add_theme_support("html5");
            add_theme_support("menus");
        });
    }
}

