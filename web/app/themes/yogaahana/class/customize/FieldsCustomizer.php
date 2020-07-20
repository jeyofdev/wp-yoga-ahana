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
			// Add logo header section
            "logo_header_section" => [
                "title" => esc_html__("Logo", "ahana"),
				"panel" => "header_option",
				"priority" => 10
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
			// Add the logo of the header
			[
                "type"        => "image",
                "settings"    => "logo_header",
				"label"       => esc_html__("Logo", "ahana"),
                "section"     => "logo_header_section",
                "default"     => '',
            ]
		];

		return $fields;
	}
}
