<?php

namespace jeyofdev\wp\yoga\ahana\inc;



class Page {

    /**
     * Set the page title
     *
     * @return void
     */
    public static function init () : void
    {
        self::set_title();
    }



    /**
     * Set the title of the page
     *
     * @return void
     */
    public static function set_title () : void
    {
        add_filter("get_the_archive_title", function (string $title) {
            if (is_category()) {
                $title = single_cat_title("category : ", false);
            }
        
            return $title;
        } );
    }
}




