<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the posts share
 */
class Share {

    public static function init () : void
    {
        self::loop_start();
        self::sharing_display_markup();
    }



    /**
     * Fires once the loop is started.
     *
     * @return void
     */
    public static function loop_start ()
    {
        add_action("loop_start", function () {
            remove_filter("the_content", "sharing_display", 19);
            remove_filter("the_excerpt", "sharing_display", 19);
        });
    }



    /**
     * Filters the content markup of the Jetpack sharing links.
     *
     * @return void
     */
    public static function sharing_display_markup () : void
    {
        add_filter("jetpack_sharing_display_markup", function ($sharing_content) {
            $parts = explode(">", $sharing_content);
        
            $sharing_content = [];
            foreach ($parts as $part) {
                if (strpos($part, "<a rel") !== false) {
                    $sharing_content[] = $part . "></a>";
                }
            }
        
            $links = [];
            foreach ($sharing_content as $item) {
                if (strpos($item, "facebook") !== false) {
                    $links[] = str_replace('></a>', '><i class="fab fa-facebook-f"></i></a>', $item);
                } 
                else if (strpos($item, "twitter") !== false) {
                    $links[] = str_replace('></a>', '><i class="fab fa-twitter"></i></a>', $item);
                }
                else if (strpos($item, "linkedin") !== false) {
                    $links[] = str_replace('></a>', '><i class="fab fa-linkedin-in"></i></a>', $item);
                }
            }
        
            return implode("", $links);
        });
    }
}
