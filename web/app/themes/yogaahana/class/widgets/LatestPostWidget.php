<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use Timber\Post;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the latest posts widget
 */
class LatestPostWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        parent::__construct("ahana_recent_posts_widget", __("Latest Posts", "ahana"), [
            "classname" => "latest-post-widget",
			"description" => __("Your site’s most latest Posts with thumbnail.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "count" => __("Number of posts to show :", "ahana"),
            "show_date" => __("Show post date ?", "ahana")
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
        $instance["title"] = !empty($instance["title"]) ? apply_filters("widget_title", $instance["title"], $instance, $this->id_base) : __("Latest Posts", "ahana");
        
        // get number of posts to display
        $instance["count"] = (!empty($instance["count"])) ? absint($instance["count"]) : 4;

        // date
        $instance["show_date"] = isset( $instance["show_date"] ) ? (bool)$instance["show_date"] : false;

        if (is_single()) {
            $current_post = new Post();
            $postId = $current_post->ID;
        }

        // posts
        $posts = Timber::get_posts(
            apply_filters(
				"widget_posts_args", [
                    "posts_per_page" => $instance["count"],
                    "post_status" => "publish",
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

        if (empty($posts)) {
			return;
        }

        $context = Timber::get_context();

        Timber::render("widgets/latest-posts-widget.twig", [
            "args" => $args,
            "instance" => $instance,
            "posts" => $posts,
            "theme" => $context["theme"],
            "date" => $instance["show_date"]
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
        $show_date = isset( $instance["show_date"] ) ? (bool) $instance["show_date"] : false;

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

            <p>
                <input 
                    type="checkbox"
                    class="checkbox"
                    id="<?= $this->get_field_id('show_date'); ?>"
                    name="<?= $this->get_field_name('show_date'); ?>" 
                    <?php checked($show_date); ?> />
                <label for="<?= $this->get_field_id('show_date'); ?>"><?= $this->fields["show_date"] ?></label>
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
        $output["show_date"] = isset($newInstance["show_date"] ) ? (bool)$newInstance["show_date"] : false;
        
        return $output;
    }
}




