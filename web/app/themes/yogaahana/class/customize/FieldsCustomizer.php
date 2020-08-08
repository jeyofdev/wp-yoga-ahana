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

		// Add footer options panel
        Kirki::add_panel("footer_option", [
            "priority"    => 30,
            "title"       => esc_html__("Footer", "ahana"),
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

			// Add search header section
            "search_header_section" => [
                "title" => esc_html__("Search", "ahana"),
				"panel" => "header_option",
				"priority" => 30
			],

			// Add logo footer section
            "logo_footer_section" => [
                "title" => esc_html__("Logo", "ahana"),
				"panel" => "footer_option",
				"priority" => 10
			],

            // Add colors section
            "colors_section" => [
                "title" => esc_html__("Colors", "ahana"),
				"panel" => "theme_option",
				"priority" => 20
			],

            // Add colors section
            "gradients_section" => [
                "title" => esc_html__("Gradients", "ahana"),
				"panel" => "theme_option",
				"priority" => 30
			],

            // Add top section
            "top_section" => [
                "title" => esc_html__("Top section", "ahana"),
				"panel" => "theme_option",
				"priority" => 40
			],

            // Add what_we_do section
            "what_we_do_section" => [
                "title" => esc_html__("What we do section", "ahana"),
				"panel" => "theme_option",
				"priority" => 50
			],

            // Add testimonial section
            "testimonial_section" => [
                "title" => esc_html__("Testimonial section", "ahana"),
				"panel" => "theme_option",
				"priority" => 60
			],

            // Add classes section
            "classes_section" => [
                "title" => esc_html__("Classes section", "ahana"),
				"panel" => "theme_option",
				"priority" => 70
			],

            // Add event section
            "event_section" => [
                "title" => esc_html__("Event section", "ahana"),
				"panel" => "theme_option",
				"priority" => 80
			],

            // Add video section
            "video_section" => [
                "title" => esc_html__("Video", "ahana"),
				"panel" => "theme_option",
				"priority" => 90
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

			// Add background image on header search
			[
				"type"        => "background",
				"settings"    => "header_search_background_image",
				"transport"   => "auto",
				"section"     => "search_header_section",
				"default"     => [
					"background-image"      => "",
					"background-repeat"     => "no-repeat",
					"background-position"   => "center top",
					"background-size"       => "cover",
					"background-attachment" => "scroll",
				],
				"output" => [
					[
						"element"  => ".search-model",
					]
				]
			],

			// Add the logo of the footer
			[
                "type"        => "image",
                "settings"    => "logo_footer",
				"label"       => esc_html__("Logo", "ahana"),
                "section"     => "logo_footer_section",
                "default"     => ''
			],


			//
			// COLOR THEME
			//

			// Add primary color
			[
				"type"        => "color",
				"settings"    => "primary_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Primary color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 10,
                "default"     => "#f65d5d",
                "output" => [
                    [
                        "element"  => [
							".footer-widget ul li a:hover",
							".material-icons",
							".site-btn.sb-gradient:hover",
							".site-btn.sb-line-gradient",
							".trainer-item h6",
							".ti-text a:hover",
							".bi-text a:hover",
							".ei-text a:hover",
							".ci-text a:hover",
							".lp-text a:hover",
							".pc-text a:hover",
							".site-btn.sb-white",
							".ci-author p",
							".ci-author a:hover",
							".owl-nav .owl-next",
							".owl-nav .owl-prev",
							".copyright i",
							".copyright a:hover",
							".about-instructor-widget h6",
							".sb-tags a:hover",
							".ba-social a:hover",
							".reply",
							".reply:hover",
							".classes-info ul li a:hover",
							".about-instructor-widget a:hover",
							".logged-in-as a"
						],
						"property" => "color"
					],
					[
                        "element"  => [
							".owl-carousel .owl-dot.active",
							".ti-social a:hover",
							".ai-social a:hover",
							".td-social a:hover",
							".progress-bar-style .bar-inner",
							".cd-price",
							".bi-cata:after",
							".contact-social a:hover"
						],
                        "property" => "background-color"
                    ],
				]
			],

			// Add secondary color
			[
				"type"        => "color",
				"settings"    => "secondary_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Secondary color :", "ahana"),
				"section"     => "colors_section",
                "default"     => "#fdb07d",
                "output" => [
                    [
                        "element"  => [
							".progress-bar-style"
						],
						"property" => "background-color"
					]
				]
			],

			// Add light color
			[
				"type"        => "color",
				"settings"    => "light_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Light color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 20,
                "default"     => "#ffffff",
                "output" => [
                    [
                        "element"  => [
							"body",
							".text-white *",
							".hs-text *",
							".sb-gradient",
							".sb-line-gradient:hover",
							".ed-note",
							".site-pagination a:hover i"
						],
						"property" => "color"
					],
					[
                        "element"  => [
							"body",
							".header-top",
							".classes-item",
							".trainer-item .ti-text",
							".pricing-item",
							".pi-price",
							".hero-slider .owl-dots .owl-dot:before",
							".sb-line-gradient:after",
							".sb-white",
							".sb-gradient:after",
							".review-item .ri-img",
							".event-filter-warp"

						],
						"property" => "background-color"
					],
					[
                        "element"  => [
							".hero-slider .owl-dots .owl-dot",
						],
						"property" => "border-color"
					]
				]
			],

			// Add headings color
			[
				"type"        => "color",
				"settings"    => "headings_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Headings color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 30,
                "default"     => "#333333",
                "output" => [
                    [
                        "element"  => [
							"h1", "h2", "h3", "h4", "h5", "h6", ".single-progress-item p", 
							".cd-meta p",
							".ed-meta p",
							".blog-meta p",
							".about-instructor-widget a"
						],
						"property" => "color"
					]
				]
			],

			// Add paragraph color
			[
				"type"        => "color",
				"settings"    => "paragrah_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Paragrah color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 40,
                "default"     => "#666666",
                "output" => [
                    [
                        "element"  => [
							"p",
							".footer-widget ul li",
							".ci-meta",
							".ei-text ul li",
							".pricing-item ul li",
							".pc-text ul li",
							".comment-list .comment-text .comment-date",
							".trainer-details .trainer-info ul strong",
							".pc-text a",
							".classes-info ul li",
							".classes-info ul li a",
							".sb-list li a"
						],
						"property" => "color"
					]
				]
			],

			// Add link color
			[
				"type"        => "color",
				"settings"    => "link_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Link color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 50,
                "default"     => "#333333",
                "output" => [
                    [
                        "element"  => [
							".ti-text a",
							".bi-text a",
							".ei-text a",
							".ci-text a",
							".lp-text a"
						],
						"property" => "color"
					]
				]
			],

			// Add link navbar color
			[
				"type"        => "color",
				"settings"    => "link_nav_color_setting_hex",
                "transport"   => "auto",
				"label"       => esc_html__("Link nav color :", "ahana"),
				"section"     => "colors_section",
				"priority"    => 60,
                "default"     => "#fff",
                "output" => [
                    [
                        "element"  => ".main-menu li > a",
						"property" => "color"
					],
					[
                        "element"  => ".main-menu li.current-menu-item a",
						"property" => "border-color"
					]
				]
			],


			//
			// GRADIENT COLOR THEME
			//

			// Set the first color for the primary gradient
			[
				"type"      => "color",
				"settings"  => "gradient_color_top",
				"label"     => esc_attr__("Color top", "ahana"),
				"section"   => "gradients_section",
				"default"   => "#f65d5d",
				"priority"  => 10,
				"output"    => [
					[
						"element" => [
							".hero-section",
							".back-to-top",
							".site-btn.sb-gradient",
							".site-btn.sb-line-gradient",
							".site-pagination a:hover",
							".site-pagination > span",
							".page-top-section:after",
							".review-section:after",
							".search-model:after"
						],
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, $ topPos%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "gradient_direction",
							"topPos"    => "gradient_top_position",
							"bottomCol" => "gradient_color_bottom",
							"bottomPos" => "gradient_bottom_position",
						]
					]
				]
			],

			// Set the second color for the background gradient of the breadcrumb
			[
				"type"      => "color",
				"settings"  => "gradient_color_bottom",
				"label"     => esc_attr__("Color bottom", "ahana"),
				"section"   => "gradients_section",
				"default"   => "#fdb07d",
				"priority"  => 11,
				"output"    => [
					[
						"element" => [
							".hero-section",
							".back-to-top",
							".site-btn.sb-gradient",
							".site-btn.sb-line-gradient",
							".site-pagination a:hover",
							".site-pagination > span",
							".page-top-section:after",
							".review-section:after",
							".search-model:after"
						],
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol topPos%,$ bottomPos%)",
						"pattern_replace" => [
							"direction" => "gradient_direction",
							"topCol"    => "gradient_color_top",
							"topPos"    => "gradient_top_position",
							"bottomPos" => "gradient_bottom_position",
						]
					]
				]
			],

			// Set the direction for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "gradient_direction",
				"label"     => esc_attr__("Direction", "ahana"),
				"section"   => "gradients_section",
				"default"   => 145,
				"priority"  => 12,
				"choices"   => [
					"min"  => 0,
					"max"  => 360,
					"step" => 1,
				],
				"output"    => [
					[
						"element" => [
							".hero-section",
							".back-to-top",
							".site-btn.sb-gradient",
							".site-btn.sb-line-gradient",
							".site-pagination a:hover",
							".site-pagination > span",
							".page-top-section:after",
							".review-section:after",
							".search-model:after"
						],
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol $%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "gradient_direction",
							"topCol"    => "gradient_color_top",
							"bottomCol" => "gradient_color_bottom",
							"bottomPos" => "gradient_bottom_position",
						]
					]
				]
			],

			// Set the position of the first color for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "gradient_top_position",
				"label"     => esc_attr__("Top Position", "ahana"),
				"section"   => "gradients_section",
				"default"   => 0,
				"priority"  => 13,
				"choices"   => [
					"min"  => 0,
					"max"  => 100,
					"step" => 1,
				],
				"output"    => [
					[
						"element" => [
							".hero-section",
							".back-to-top",
							".site-btn.sb-gradient",
							".site-btn.sb-line-gradient",
							".site-pagination a:hover",
							".site-pagination > span",
							".page-top-section:after",
							".review-section:after",
							".search-model:after"
						],
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol $%,bottomCol bottomPos%)",
						"pattern_replace" => [
							"direction" => "gradient_direction",
							"topCol"    => "gradient_color_top",
							"bottomCol" => "gradient_color_bottom",
							"bottomPos" => "gradient_bottom_position",
						]
					]
				]
			],


			// Set the position of the second color for the background gradient of the breadcrumb
			[
				"type"      => "slider",
				"settings"  => "gradient_bottom_position",
				"label"     => esc_attr__("Bottom Position", "ahana"),
				"section"   => "gradients_section",
				"default"   => 100,
				"priority"  => 14,
				"choices"   => [
					"min"  => 0,
					"max"  => 100,
					"step" => 1,
				],
				"output"    => [
					[
						"element" => [
							".hero-section",
							".back-to-top",
							".site-btn.sb-gradient",
							".site-btn.sb-line-gradient",
							".site-pagination a:hover",
							".site-pagination > span",
							".page-top-section:after",
							".review-section:after",
							".search-model:after"
						],
						"property"        => "background",
						"value_pattern"   => "linear-gradient(directiondeg, topCol topPos%,bottomCol $%)",
						"pattern_replace" => [
							"direction" => "gradient_direction",
							"topCol"    => "gradient_color_top",
							"topPos"    => "gradient_top_position",
							"bottomCol" => "gradient_color_bottom",
						]
					]
				]
			],

			// Add background image of the top section
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
				"priority"  => 10,
				"output" => [
					[
						"element"  => ".page-top-section",
					]
				]
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_about",
				"label"    => esc_html__("About", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 20,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_classes",
				"label"    => esc_html__("Classes", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 30,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_trainer",
				"label"    => esc_html__("Trainers", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 40,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_event",
				"label"    => esc_html__("Events", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 50,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_blog",
				"label"    => esc_html__("Blog", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 60,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_contact",
				"label"    => esc_html__("Contact", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 70,
			],
			
			// add content of the top section for blog templates
			[
				"type"     => "textarea",
				"settings" => "top_section_content_search",
				"label"    => esc_html__("Search", "ahana"),
				"section"  => "top_section",
				"default"  => '',
				"priority"  => 80,
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
			
			// add title section classes
			[
				"type"     => "text",
				"settings" => "title_classes_section",
				"label"    => esc_html__("Title", "ahana"),
				"section"  => "classes_section"
			],

			// add title section event
			[
				"type"     => "text",
				"settings" => "title_event_section",
				"label"    => esc_html__("Title", "ahana"),
				"section"  => "event_section",
				"priority"  => 10,
			],

			// Add a video link of the events section
			[
				"type"     => "text",
				"settings" => "video_link",
				"label"    => esc_html__("link", "ahana"),
				"section"  => "video_section",
				"default"  => esc_html__("Youtube video", "ahana"),
				"priority"  => 11,
			],

			// Add an image to the video of the events section
			[
				"type"        => "image",
				"settings"    => "video_image",
				"label"       => esc_html__("Image", "ahana"),
				"transport"   => "auto",
				"section"     => "video_section",
				"default"     => '',
				"priority"    => 12,
			]
		];

		return $fields;
	}
}
