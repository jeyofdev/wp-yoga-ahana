<?php

namespace jeyofdev\wp\yoga\ahana\inc;

use jeyofdev\wp\yoga\ahana\widgets\AboutEventOrClassesWidget;
use jeyofdev\wp\yoga\ahana\widgets\AboutWidget;
use jeyofdev\wp\yoga\ahana\widgets\LatestPostWidget;
use jeyofdev\wp\yoga\ahana\widgets\OpeningHoursWidget;
use jeyofdev\wp\yoga\ahana\widgets\PostCategoryWidget;
use jeyofdev\wp\yoga\ahana\widgets\SearchWidget;
use jeyofdev\wp\yoga\ahana\widgets\TagCloudWidget;
use jeyofdev\wp\yoga\ahana\widgets\TrainerWidget;



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
        register_widget(TrainerWidget::class);
        register_widget(AboutWidget::class);
        register_widget(OpeningHoursWidget::class);
        register_widget(SearchWidget::class);
        register_widget(AboutEventOrClassesWidget::class);
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
        unregister_widget("WP_Widget_Search");

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

        register_sidebar([
            "id" => "footer",
            "name" => __("Footer sidebar", "ahana"),
            'before_widget' => '<div class="col-lg-3 col-sm-6"><div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => "</div></div>",
            'before_title'  => '<h2 class="fw-title">',
            'after_title'   => "</h2>",
        ]);

        register_sidebar([
            "id" => "event",
            "name" => __("Event sidebar", "ahana"),
            "before_widget" => '<div id="%1$s" class="sb-widget %2$s">',
            "after_widget"  => "</div>",
            "before_title"  => '<h2 class="sb-title">',
            "after_title"   => "</h2>",
        ]);
    }
}