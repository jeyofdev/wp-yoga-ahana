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
            add_image_size("trainer_single_thumbnail", 200, 200, true);
            add_image_size("classes_thumbnail", 280, 280, true);
            add_image_size("classes_trainer_thumbnail", 50, 50, true);
            add_image_size("event_thumbnail", 222, 186, true);
            add_image_size("post_thumbnail_widget", 86, 68, true);
            add_image_size("trainer_thumbnail_widget", 142, 142, true);
            add_image_size("featured_classes_thumbnail_widget", 255, 200, true);
            add_image_size("video_image_widget", 270, 298, true);
            add_image_size("event_single", 930, 463, true);
            add_image_size("event_single_thumbnail", 315, 265, true);
            add_image_size("home_about_thumbnail", 557, 533, true);
            add_image_size("video_image", 930, 1028, true);
            add_image_size("admin_column_thumbnail", 100, 100, false);
        });
    }
}
