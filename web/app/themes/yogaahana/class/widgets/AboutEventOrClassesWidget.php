<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the 'About Event Or Classes' widget
 */
class AboutEventOrClassesWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        parent::__construct("ahana_about_event_or_classes_widget", __("About event or classes", "ahana"), [
            "classname" => "about_event_or_classes-widget",
			"description" => __("Display informations on an event or a classes.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "post_type" => __("Post type")
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
        $instance["title"] = !empty($instance["title"]) ? apply_filters("widget_title", $instance["title"], $instance, $this->id_base) : __("About event", "ahana");

        // post
        $post = Timber::get_post();

        // trainer
        $postTrainer = get_the_terms($post, "trainer")[0];
        $trainer = Timber::get_post(
            apply_filters(
				"widget_posts_args", [
                    "post_type" => "trainer",
                    "posts_per_page" => 1,
                    "post_name__in" => [$postTrainer->slug]
				],
				$instance
            )
        );

        if (empty($trainer)) {
			return;
        }

        $context = Timber::get_context();
        $context["args"] = $args;
        $context["instance"] = $instance;
        $context["post"] = $post;
        $context["trainer"] = $trainer;

        Timber::render("widgets/about_event_or_classes-widget.twig", $context);
    }



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
    public function form ($instance)
    {
        $title = isset($instance["title"]) ? esc_attr($instance["title"]) : '';

        $post_types = get_post_types([
            "public" => true,
        ], "object");
        $current_post_type = $this->_get_current_post_type($instance);
        $post_type_allowed = ["event", "classes"];

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
            <label for="<?= $this->get_field_id('post_type'); ?>"><?= $this->fields["post_type"]; ?></label>
                <select class="widefat" id="<?= $this->get_field_id('post_type'); ?>" name="<?= $this->get_field_name('post_type'); ?>">
                    <?php 
                        foreach ($post_types as $item => $value) {
                            if (in_array($item, $post_type_allowed)) {
                                printf(
                                    '<option value="%s"%s>%s</option>',
                                    esc_attr($item),
                                    selected($item, $current_post_type, false),
                                    $value->labels->name
                                );
                            }
                        }
                    ?>
                </select>
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
        $output["post_type"] = stripslashes($newInstance["post_type"]);
        
        return $output;
    }



    /**
	 * Get the post type for the current widget instance
	 *
	 * @param array $instance Current settings
	 * @return string Name of the current post type
	 */
    public function _get_current_post_type($instance)
    {
		if (!empty($instance["post_type"] ) && post_type_exists($instance["post_type"])) {
			return $instance["post_type"];
		}

		return "";
	}
}
