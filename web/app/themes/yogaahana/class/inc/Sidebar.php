<?php

namespace jeyofdev\wp\yoga\ahana\inc;

use jeyofdev\wp\yoga\ahana\widgets\LatestPostWidget;
use jeyofdev\wp\yoga\ahana\widgets\PostCategoryWidget;
use jeyofdev\wp\yoga\ahana\widgets\TagCloudWidget;



/**
 * Class which manages the sidebars
 */
class Sidebar 
{
    /**
     * Registers all the widgets and sidebars 
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("widgets_init", function ()
        {
            self::unregister_widget();
            self::register_widget();
            self::register_sidebar();
        });
    }



    /**
     * Register a widget
     *
     * @return void
     */
    public static function register_widget () : void
    {
        register_widget(PostCategoryWidget::class);
        register_widget(LatestPostWidget::class);
        register_widget(TagCloudWidget::class);
    }



    /**
     * Unregisters a widget
     *
     * @return void
     */
    public static function unregister_widget () : void
    {
        unregister_widget("WP_Widget_Categories");
        unregister_widget("WP_Widget_Recent_Posts");
        unregister_widget("WP_Widget_Tag_Cloud");
    }



    /**
     * Register a sidebar
     *
     * @return void
     */
    public static function register_sidebar () : void
    {
        register_sidebar([
            "id" => "blog",
            "name" => __("Blog sidebar", "ahana"),
            'before_widget' => '<div id="%1$s" class="sb-widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h2 class="sb-title">',
            'after_title'   => "</h2>",
        ]);
    }
}