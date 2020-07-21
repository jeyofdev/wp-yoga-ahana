<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the images
 */
class Images {

    /**
     * Register all image sizes
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("after_setup_theme", function () {
            add_image_size("post_thumbnail", 370, 252, true);
            add_image_size("post_thumbnail", 850, 502, true);
        });
    }
}



