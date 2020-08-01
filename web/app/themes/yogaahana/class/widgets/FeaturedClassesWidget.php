<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use Timber\Post;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the featured Classes widget
 */
class FeaturedClassesWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        parent::__construct("ahana_featured_classes_widget", __("Featured classes", "ahana"), [
            "classname" => "featured-classes-widget",
			"description" => __("Displays the featured classes.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "count" => __("Number of classes to show :", "ahana")
        ];
	}



	/**
	 * Outputs the content for the widget instance
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget ($args, $instance)
    {
        if (!class_exists("Timber")) {
            return;
        }

        // title
        $instance["title"] = !empty($instance["title"]) ? apply_filters("widget_title", $instance["title"], $instance, $this->id_base) : __("Featured classes", "ahana");
        
        // get number of classes to display
        $instance["count"] = (!empty($instance["count"])) ? absint($instance["count"]) : 2;

        if (is_single()) {
            $current_post = new Post();
            $postId = $current_post->ID;
        }

        $classes = Timber::get_posts(
            apply_filters(
				"widget_posts_args", [
                    "post_type" => "classes",
                    "posts_per_page" => $instance["count"],
                    "orderby" => [
                        "date" => "DESC"
                    ],
					"no_found_rows" => true,
                    "ignore_sticky_posts" => true,
                    "post__not_in" => [isset($postId) ? $postId : '']
				],
				$instance
            )
        );

        if (empty($classes)) {
			return;
        }

        Timber::render("widgets/featured-classes-widget.twig", [
            "args" => $args,
            "instance" => $instance,
            "classes" => $classes,
        ]);
    }



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
    public function form ($instance)
    {
        $title = isset($instance["title"]) ? esc_attr($instance["title"]) : '';
        $count = isset( $instance["count"] ) ? absint( $instance["count"] ) : 4;

        ?>
            <p>
                <label for="<?= $this->get_field_id('title'); ?>"><?= $this->fields["title"]; ?></label>
                <input
                    type="text"
                    class="widefat"
                    id="<?= $this->get_field_id('title'); ?>"
                    name="<?= $this->get_field_name('title'); ?>"
                    value="<?= $title; ?>" />
            </p>
            
            <p>
                <label for="<?= $this->get_field_id('count'); ?>"><?= $this->fields["count"] ?></label>
                <input 
                    type="number"
                    class="tiny-text"
                    id="<?= $this->get_field_id('count'); ?>"
                    name="<?= $this->get_field_name('count'); ?>"
                    step="1"
                    min="1"
                    value="<?= $count; ?>"
                    size="3" />
            </p>
        <?php
    }



	/**
	 * Handles updating the settings for the current widget instance
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Updated settings to save
	 */
	public function update ($newInstance, $oldInstance)
    {
        $output = $oldInstance;

		$output["title"] = sanitize_text_field( $newInstance["title"] );
        $output["count"] = (int)$newInstance["count"];
        
        return $output;
    }
}


