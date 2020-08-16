<?php

namespace jeyofdev\wp\yoga\ahana\customize;

use \WP_Customize_Manager;



/**
 * Class which manages the initialization of the customizer
 */
class InitCustomizer {

	public static function init ()
	{
		self::customize_register();
	}



	/**
	 * Customize register
	 *
	 * @return void
	 */
	private static function customize_register ()
	{
		add_action("customize_register", function (WP_Customize_Manager $wp_customize) {
			self::edit_transport_setting($wp_customize, [
				"blogname" => "postMessage",
				"blogdescription" => "postMessage",
				"header_textcolor" => "postMessage"
			]);

			if (!class_exists("Kirki")) {
				return;
			}
			
			// Move default sections
			self::move_section($wp_customize, [
				"title_tagline" => "theme_option",
				"custom_css" => "theme_option"
			]);
		});
	}



	/**
	 * Edit the options for rendering the live preview of changes in Customizer
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @param array $args [settingID => transport] example : ["blogname" => "postMessage", "blogdescription" => "postMessage", ...]
	 * 
	 * @return void
	 */
	private static function edit_transport_setting (WP_Customize_Manager $wp_customize, array $args) : void
	{
		foreach ($args as $settingID => $transport) {
			$wp_customize->get_setting($settingID)->transport = $transport;
		}
	}



	/**
	 * Move sections from one panel to another
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @param array $args [sectionID to move => PanelId where to add the section] example : ["title_tagline", "dingo_header", "custom_css", "dingo_advance_options", ...]
	 * 
	 * @return void
	 */
	private static function move_section (WP_Customize_Manager $wp_customize, array $args) : void
	{
		foreach ($args as $sectionID => $panelID) {
			$wp_customize->get_section($sectionID)->panel = $panelID;
		}
	}
}
