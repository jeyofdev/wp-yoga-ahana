<?php

namespace jeyofdev\wp\yoga\ahana\inc;



class Theme {

    /**
     * Load all styles
     *
     * @return void
     */
    public static function init () : void
    {
        self::stylesheet_directory_uri();
    }



    /**
     * Filters the stylesheet directory URI
     *
     * @return void
     */
    public static function stylesheet_directory_uri () : void
    {
        add_filter("stylesheet_directory_uri", function (string $stylesheet_dir_uri) {
            return dirname($stylesheet_dir_uri);
        });
    }
}