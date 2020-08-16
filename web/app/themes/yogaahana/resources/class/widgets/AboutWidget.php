<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use jeyofdev\wp\yoga\ahana\extending\Timber;
use jeyofdev\wp\yoga\ahana\options\ClubSettings;



/**
 * Class which manages the about widget
 */
class AboutWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        parent::__construct("ahana_about_widget", __("About", "ahana"), [
            "classname" => "about-widget",
			"description" => __("Displays the club contact informations.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "content" => __("Content", "ahana"),
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

        // content
        $instance["content"] = !empty($instance["content"]) ? ($instance["content"]) : __("", "ahana");

        $context = Timber::get_context();
        $context["args"] = $args;
        $context["instance"] = $instance;
        $context["club_settings"] = [
            "phone" => get_option(ClubSettings::PHONE),
            "address" => get_option(ClubSettings::ADDRESS),
            "city" => get_option(ClubSettings::CITY),
            "email" => get_option(ClubSettings::EMAIL),
        ];

        Timber::render("widgets/about-widget.twig", $context);
    }



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
    public function form ($instance)
    {
        $content = isset($instance["content"]) ? esc_attr($instance["content"]) : '';
        $count = isset( $instance["count"] ) ? absint( $instance["count"] ) : 4;
        $show_date = isset( $instance["show_date"] ) ? (bool) $instance["show_date"] : false;

        ?>
            <p>
                <label for="<?= $this->get_field_id('content'); ?>"><?= $this->fields["content"]; ?></label>
                <textarea
                    class="widefat"
                    id="<?= $this->get_field_id('content'); ?>"
                    name="<?= $this->get_field_name('content'); ?>"
                    rows="5"><?= $content; ?></textarea>
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
        $output["content"] = sanitize_textarea_field($newInstance["content"]);
        
        return $output;
    }
}




