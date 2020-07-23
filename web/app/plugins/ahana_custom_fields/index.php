<?php

/**
 * Custom fields for theme "ahana"
 *
 * Plugin Name:  ahana_custom_fields
 * Text Domain: ahanaplugin
 * Domain Path: /languages
 * Requires PHP: 7.1
 *
 */

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Email;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Range;
use WordPlate\Acf\Fields\Textarea;

defined("ABSPATH") or die("unauthorized");

if (!function_exists("register_extended_field_group")) {
    return;
}



/**
 * Custom post type trainers
 */
register_extended_field_group([
    "title" => __("Informations", "ahana"),
    "fields" => [
        Range::make(__("Experience", "ahana"), "trainer_experience")
            ->min(0)
            ->max(100)
            ->step(1)
            ->required(),
        Email::make(__("Email", "ahana"), "trainer_email")->required(),
        Textarea::make(__("Biography", "ahana"), "trainer_biography")->required(),
        Textarea::make(__("Excerpt", "ahana"), "trainer_excerpt")->required(),
        Text::make(__("Content title", "ahana"), "trainer_content_title")->required(),
        Group::make(__("Social media", "ahana"), "trainer_social")
            ->required()
            ->layout("row")
            ->fields([
                Text::make(__("Facebook", "ahana"), "facebook")->placeholder("john-doe")->prepend("https://www.facebook.com/"),
                Text::make(__("Twitter", "ahana"), "twitter")->placeholder("john-doe")->prepend("https://twitter.com/"),
                Text::make(__("Instagram", "ahana"), "instagram")->placeholder("john-doe")->prepend("https://www.instagram.com/"),
                Text::make(__("Linkedin", "ahana"), "linkedin")->placeholder("john-doe")->prepend("https://www.linkedin.com/"),
            ]),
        Image::make(__("Content picture", "ahana"), "trainer_image")
            // ->required()
            ->returnFormat("array")
            ->previewSize("medium")
            ->library("all")
    ],
    "location" => [
        Location::if("post_type", "==", "trainer")
    ],
    "position" => "normal",
    "style" => "default",
    "label_placement" => "top",
    "instruction_placement" => "label",
    "active" => true,
]);