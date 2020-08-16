<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the document title
 */
class Title {

    public static function init () : void
    {
        self::document_title_separator();
    }



    /**
     * Filters the separator for the document title
     *
     * @return void
     */
    public static function document_title_separator () : void 
    {
        add_filter("document_title_separator", function () {
            return " | ";
        });
    }
}