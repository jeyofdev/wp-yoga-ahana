<?php

namespace jeyofdev\wp\yoga\ahana\widgets;

use \WP_Widget;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * Class which manages the tag cloud widget
 */
class TagCloudWidget extends WP_Widget {

    /**
     * @var array
     */
    public $fields = [];


    /**
	 * Sets up a new widget instance
	 */
	public function __construct()
    {
        parent::__construct("ahana_tag_cloud_widget", __("Tag Cloud", "ahana"), [
            "classname" => "tag_cloud_widget",
			"description" => __("A cloud of your most used taxonomies.", "ahana"),
			"customize_selective_refresh" => true,
        ]);

        $this->fields = [
            "title" => __("Title", "ahana"),
            "count" => __("Show tag counts ?", "ahana"),
            "taxonomy" => __("Taxonomy", "ahana")
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

        $current_taxonomy = $this->_get_current_taxonomy($instance);

        // title
		if (!empty($instance["title"])) {
			$instance["title"] = apply_filters("widget_title", $instance["title"], $instance, $this->id_base);
		} else {
            if ($current_taxonomy === "Category") {
                $instance["title"] = __("Category", "ahana");
            } if ($current_taxonomy === "post_tag") {
                $instance["title"] = __("Tags", "ahana");
            } else {
				$instance["title"] = __("Tag Clouds", "ahana");
			}
        }

        // show tag count 
        $count = ! empty( $instance["count"]);
		$tag_cloud = wp_tag_cloud(
			apply_filters("widget_tag_cloud_args", [
				"taxonomy" => $current_taxonomy,
				"echo" => false,
                "show_count" => $count,
                "smallest"   => 16,
                "largest"    => 16,
                "unit"       => "px",
			], $instance)
        );

		if (empty($tag_cloud)) {
			return;
        }

        $context = Timber::get_context();
        $context["args"] = $args;
        $context["instance"] = $instance;
        $context["tag_cloud"] = explode("\n", $tag_cloud);

        Timber::render("widgets/tag-cloud-widget.twig", $context);
    }



	/**
	 * Outputs the settings form for the widget
	 *
	 * @param array $instance Current settings
	 */
    public function form ($instance)
    {
        $title = isset($instance["title"]) ? esc_attr($instance["title"]) : '';
        $count = isset($instance["count"]) ? (bool) $instance["count"] : false;

        $taxonomies = get_taxonomies(["show_tagcloud" => true], "object");
        $current_taxonomy = $this->_get_current_taxonomy($instance);

        $taxonomy_ID = $this->get_field_id("taxonomy");
        $taxonomy_name = $this->get_field_name("taxonomy");
        $hidden_input = '<input type="hidden" id="' . $taxonomy_ID . '" name="' . $taxonomy_name . '" value="%s" />';

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

        $count_checkbox = sprintf(
            '<p><input type="checkbox" class="checkbox" id="%1$s" name="%2$s"%3$s /> <label for="%1$s">%4$s</label></p>',
            $this->get_field_id("count"),
            $this->get_field_name("count"),
            checked($count, true, false),
            $this->fields["count"]
        );

        if (array_key_exists("link_category", $taxonomies)) {
            unset($taxonomies["link_category"]);
        }

        switch (count($taxonomies)) {
            // No tag cloud supporting taxonomies found, display error message.
            case 0:
                echo "<p>" . __("The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.") . "</p>";
                printf($hidden_input, '');
                break;

            // Just a single tag cloud supporting taxonomy found, no need to display a select.
            case 1:
                $keys = array_keys($taxonomies);
                $taxonomy = reset($keys);
                printf($hidden_input, esc_attr($taxonomy));
                echo $count_checkbox;
                break;

            // More than one tag cloud supporting taxonomy found, display a select.
            default:
                printf(
                    '<p><label for="%1$s">%2$s</label>' .
                    '<select class="widefat" id="%1$s" name="%3$s">',
                    $taxonomy_ID,
                    $this->fields["taxonomy"],
                    $taxonomy_name
                );

                foreach ($taxonomies as $taxonomy => $tax) {
                    printf(
                        '<option value="%s"%s>%s</option>',
                        esc_attr($taxonomy),
                        selected($taxonomy, $current_taxonomy, false),
                        $tax->labels->name
                    );
                }

                echo "</select></p>" . $count_checkbox;
        }
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
        $output["taxonomy"] = stripslashes($newInstance["taxonomy"]);
        
        return $output;
    }



    /**
	 * Get the taxonomy for the current widget instance
	 *
	 * @param array $instance Current settings
	 * @return string Name of the current taxonomy if set, otherwise 'post_tag'
	 */
    public function _get_current_taxonomy($instance)
    {
		if (!empty($instance["taxonomy"] ) && taxonomy_exists($instance["taxonomy"])) {
			return $instance["taxonomy"];
		}

		return "post_tag";
	}
}