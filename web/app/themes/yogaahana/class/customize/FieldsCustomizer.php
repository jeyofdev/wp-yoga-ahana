<?php

namespace jeyofdev\wp\yoga\ahana\customize;

use Kirki;



/**
 * Class which manages the panels, sections and controls of the customizer
 */
class FieldsCustomizer 
{
	/**
	 * @var self|null
	 */
	private static $_instance = null;



	/**
	 * @var array
	 */
	private $sections = [];



	/**
	 * @var array
	 */
    private $fields = [];



	public function __construct() {
		$this->kirki_config();
		$this->add_panels();
		$this->add_sections();
        $this->add_fields();
    }



	/**
	 * @return self|null
	 */
	public static function instance () : ?self
	{
        if (self::$_instance === null) {
            self::$_instance = new FieldsCustomizer();
        }

        return self::$_instance;
    }



    /**
     * Set the Kirki configuration
     *
     * @return void
     */
    private function kirki_config () : void
    {
		Kirki::add_config("config", [
			"url_path"      => get_stylesheet_directory_uri() . "/class/customize/kirki/kirki.php",
			"capability"    => "edit_theme_options",
			"option_type"   => "theme_mod",
		]);
    }



	/**
	 * Add customizer panels
	 *
	 * @return void
	 */
    private function add_panels () : void
    {
        // Add header options panel
        Kirki::add_panel("header_option", [
            "priority"    => 30,
            "title"       => esc_html__("Header", "ahana"),
        ]);

        // Add theme options panel
        Kirki::add_panel("theme_option", [
            "priority"    => 40,
            "title"       => esc_html__("Theme options", "ahana"),
        ]);
    }



	/**
	 * Add customizer sections
	 *
	 * @return void
	 */
    private function add_sections () : void
    {
		$this->sections = $this->set_sections();

		if(!empty($this->sections)) {
			foreach ($this->sections as $key => $section) {
				Kirki::add_section($key, $section);
			}
		}
    }




	/**
	 * Add customizer fields
	 *
	 * @return void
	 */
    private function add_fields () : void
    {
        $this->fields = $this->set_fields ();

		if(!empty($this->fields)) {
			foreach ($this->fields as $field) {
				Kirki::add_field("config", $field);
			}
		}
	}



	/**
	 * Set the customizer sections
	 *
	 * @return void
	 */
    private function set_sections () : array
    {
        $sections = [
			// Add topbar header section
            "top_bar_header_section" => [
                "title" => esc_html__("Topbar", "ahana"),
				"panel" => "header_option",
				"priority" => 10
			],

			// Add logo header section
            "logo_header_section" => [
                "title" => esc_html__("Logo", "ahana"),
				"panel" => "header_option",
				"priority" => 20
			],

            // Add top section
            "top_section" => [
                "title" => esc_html__("Top section", "ahana"),
				"panel" => "theme_option",
				"priority" => 20
			],

            // Add what_we_do section
            "what_we_do_section" => [
                "title" => esc_html__("What we do section", "ahana"),
				"panel" => "theme_option",
				"priority" => 30
			],

            // Add testimonial section
            "testimonial_section" => [
                "title" => esc_html__("testimonial section", "ahana"),
				"panel" => "theme_option",
				"priority" => 40
			],

            // Add blog section
            "blog_section" => [
                "title" => esc_html__("Blog", "ahana"),
				"panel" => "theme_option",
				"priority" => 50
			]
		];

		return $sections;
    }



	/**
	 * Set the customizer fields
	 *
	 * @return array
	 */
    private function set_fields () : array
    {
		$fields = [
			// Show or hide the header topbar
            [
                "type"        => "toggle",
				"settings"    => "topbar_header_toogle",
				"description" => esc_html__("show or hide the header topbar.", "ahana"),
				"label"       => esc_html__("Topbar", "ahana"),
                "section"     => "top_bar_header_section",
				"default"     => "1"
			],

			// Add the logo of the header
			[
                "type"        => "image",
                "settings"    => "logo_header",
				"label"       => esc_html__("Logo", "ahana"),
                "section"     => "logo_header_section",
                "default"     => ''
			],

			// Set the first color for the background gradient of the breadcrumb
			[
				"type"      => "color",
				"settings"  => "top_section_color_top",
				"label"     => esc_attr__("Top Color", "ahana"),
				"section"   => "top_section",
				"default"   => "#f65d5d",
				"priority"  => 10,
				"output"    => [
					[
						"element"         => ".page-top-section:after",
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, $ topPos%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "top_section_gradient_direction",
							"topPos"    => "top_section_color_bottom",
							"bottomCol" => "top_section_color_top_position",
							"bottomPos" => "top_section_color_bottom_position",
						]
					]
				]
			],

			// Set the second color for the background gradient of the breadcrumb
			[
				"type"      => "color",
				"settings"  => "top_section_color_bottom",
				"label"     => esc_attr__("Bottom Color", "ahana"),
				"section"   => "top_section",
				"default"   => "#fdb07d",
				"priority"  => 11,
				"output"    => [
					[
						"element"         => ".page-top-section:after",
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol topPos%,$ bottomPos%)",
						"pattern_replace" => [
							"direction" => "top_section_gradient_direction",
							"topCol"    => "top_section_color_top",
							"topPos"    => "top_section_color_top_position",
							"bottomPos" => "top_section_color_bottom_position",
						]
					]
				]
			],

			// Set the direction for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "top_section_gradient_direction",
				"label"     => esc_attr__("Gradient direction", "ahana"),
				"section"   => "top_section",
				"default"   => 145,
				"priority"  => 12,
				"choices"   => [
					"min"  => 0,
					"max"  => 360,
					"step" => 1,
				],
				"output"    => [
					[
						"element"         => ".page-top-section:after",
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol $%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "top_section_gradient_direction",
							"topCol"    => "top_section_color_top",
							"bottomCol" => "top_section_color_bottom",
							"bottomPos" => "top_section_color_bottom_position",
						]
					]
				]
			],

			// Set the position of the first color for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "top_section_color_top_position",
				"label"     => esc_attr__("Top Color Position", "ahana"),
				"section"   => "top_section",
				"default"   => 0,
				"priority"  => 13,
				"choices"   => [
					"min"  => 0,
					"max"  => 100,
					"step" => 1,
				],
				"output"    => [
					[
						"element"         => ".page-top-section:after",
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol $%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "top_section_gradient_direction",
							"topCol"    => "top_section_color_top",
							"bottomCol" => "top_section_color_bottom",
							"bottomPos" => "top_section_color_bottom_position",
						]
					]
				]
			],


			// Set the position of the second color for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "top_section_color_bottom_position",
				"label"     => esc_attr__("Bottom Color Position", "ahana"),
				"section"   => "top_section",
				"default"   => 100,
				"priority"  => 14,
				"choices"   => [
					"min"  => 0,
					"max"  => 100,
					"step" => 1,
				],
				"output"    => [
					[
						"element"         => ".page-top-section:after",
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol topPos%,bottomCol $%)",
						"pattern_replace" => [
							"direction" => "top_section_gradient_direction",
							"topCol"    => "top_section_color_top",
							"topPos"    => "top_section_color_top_position",
							"bottomCol" => "top_section_color_bottom",
						]
					]
				]
			],

			// Add background image of the breadcrumb
			[
				"type"        => "background",
				"settings"    => "top_section_background_image",
				"transport"   => "auto",
				"section"     => "top_section",
				"default"     => [
					"background-image"      => "",
					"background-repeat"     => "no-repeat",
					"background-position"   => "center top",
					"background-size"       => "cover",
					"background-attachment" => "scroll",
				],
				"priority"  => 15,
				"output" => [
					[
						"element"  => ".page-top-section",
					]
				]
			],

			// Add background image of the what_we_do_section
			[
				"type"        => "background",
				"settings"    => "what_we_do_section_background_image",
				"transport"   => "auto",
				"section"     => "what_we_do_section",
				"default"     => [
					"background-image"      => "",
					"background-repeat"     => "no-repeat",
					"background-position"   => "center top",
					"background-size"       => "cover",
					"background-attachment" => "scroll",
				],
				"priority"  => 15,
				"output" => [
					[
						"element"  => ".wwd-section",
					]
				]
			],

			// Add background image of the testimonial section
			[
				"type"        => "background",
				"settings"    => "testimonial_section_background_image",
				"transport"   => "auto",
				"section"     => "testimonial_section",
				"default"     => [
					"background-image"      => "",
					"background-repeat"     => "no-repeat",
					"background-position"   => "center top",
					"background-size"       => "cover",
					"background-attachment" => "scroll",
				],
				"priority"  => 15,
				"output" => [
					[
						"element"  => ".review-section",
					]
				]
			],
			
			// add content to blog index
			[
				"type"     => "textarea",
				"settings" => "intro_blog",
				"label"    => esc_html__("Introduction", "ahana"),
				"section"  => "blog_section",
				"default"  => ''
			]
		];

		return $fields;
	}
}
