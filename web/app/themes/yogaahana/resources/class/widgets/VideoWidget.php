<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use jeyofdev\wp\yoga\ahana\extending\Timber;
use \WP_Widget;
use \WP_Widget_Media_Image;



/**
 * Class which manages the video widget
 */
class VideoWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        $wpImage = new WP_Widget_Media_Image();

        parent::__construct("ahana_video_widget", __("Video", "ahana"), [
            "classname" => "video_widget",
            "description" => __("Displays a video YouTube.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "link" => __("Link", "ahana")
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
        $instance["title"] = !empty($instance["title"]) ? apply_filters("widget_title", $instance["title"], $instance, $this->id_base) : '';

        $context = Timber::get_context();
        $context["args"] = $args;
        $context["instance"] = $instance;

        Timber::render("widgets/video-widget.twig", $context);
    }



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
    public function form ($instance)
    {
        $title = isset($instance["title"]) ? esc_attr($instance["title"]) : '';

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
        $output["title"] = sanitize_text_field($newInstance["title"]);
        
        return $output;
    }
}
