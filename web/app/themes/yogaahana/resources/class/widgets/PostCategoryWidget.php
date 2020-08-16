<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the post category widget
 */
class PostCategoryWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    
    /**
	 * Sets up a new widget instance.
	 */
	public function __construct() {
		parent::__construct("ahana_post_category_widget", __("Categories", "ahana"), [
            "classname" => "post_category_widget",
			"description" => __("A list of categories.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "count" => __("Show post counts ?", "ahana")
        ];
	}



	/**
	 * Outputs the content for the widget instance
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget($args, $instance) {
        if (!class_exists("Timber")) {
            return;
        }

        // title
        $instance["title"] = !empty($instance["title"]) ? apply_filters("widget_title", $instance["title"], $instance, $this->id_base) : __("Categories", "ahana");

        // count
        $instance["count"] = isset($instance["count"]) ? (bool)$instance["count"] : false;

        // categories
		$cat_args = [
            "taxonomy" => "category",
			"orderby" => "name",
			"show_count" => $instance["count"],
            "title_li"            => false,
            "echo"                => false,
            "style"               => "list",
        ];

        $categories = wp_list_categories(apply_filters("widget_categories_args", $cat_args, $instance));

        $categories = explode("\t", $categories);
        unset($categories[0]);

        $newCategories = [];
        foreach ($categories as $category) {
            $category = str_replace("</a> (", "<span>(", $category);
            $category = str_replace(")", ")</a>", $category);
            $newCategories[] = $category . "\t";
        }

        $categories = $newCategories;

        $context = Timber::get_context();
        $context["args"] = $args;
        $context["instance"] = $instance;
        $context["categories"] = $categories;
        $context["count"] = $instance["count"];

        Timber::render("widgets/post-category-widget.twig", $context);
	}



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
	public function form($instance) {
		$title = isset($instance["title"]) ? esc_attr($instance["title"]) : '';
        $count = isset($instance["count"]) ? (bool) $instance["count"] : false;
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
                <input 
                    type="checkbox"
                    class="checkbox"
                    id="<?= $this->get_field_id('count'); ?>"
                    name="<?= $this->get_field_name('count'); ?>" 
                    <?php checked($count); ?> />
                <label for="<?= $this->get_field_id('count'); ?>"><?= $this->fields["count"] ?></label>
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
        $output["count"] = isset($newInstance["count"] ) ? (bool)$newInstance["count"] : false;

        return $output;
    }
}


