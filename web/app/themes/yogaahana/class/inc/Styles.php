<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the styles
 */
class Styles {

    /**
     * Load all styles
     *
     * @return void
     */
    public static function init () : void
    {
        self::contact_form_remove_span();
    }



    /**
     * Contact form 7 remove span
     */
    public static function contact_form_remove_span () : void
    {
        add_filter("wpcf7_form_elements", function( string $content)
        {
            $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
            $content = str_replace('<br />', '', $content);
            $content = str_replace('<p>', '', $content);
            $content = str_replace('</p>', '', $content);

            return $content;
        });
    }
}