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



/**
 *  wwd section
 */
register_extended_field_group([
    "title" => __("What we do section", "ahana"),
    "fields" => [
        Text::make(__("Title", "ahana"), "wwd_title")
            ->required()
            ->defaultValue(__("what we do", "ahana")),
        Text::make(__("Introduction", "ahana"), "wwd_intro")
            ->required()
            ->defaultValue(__("To be invited to the nearest Cali center and get free physical advice to learn more about the program.", "ahana")),
        Group::make(__("Skills", "ahana"), "wwd_skills")
            ->required()
            ->layout("row")
            ->fields([
                Range::make(__("Breathing", "ahana"), "wwd_breathing")
                    ->min(0)
                    ->max(100)
                    ->step(1)
                    ->defaultValue(50)
                    ->required(),
                Range::make(__("Metabolism", "ahana"), "wwd_metabolism")
                    ->min(0)
                    ->max(100)
                    ->step(1)
                    ->defaultValue(50)
                    ->required(),
                Range::make(__("Flexibility", "ahana"), "wwd_flexibility")
                    ->min(0)
                    ->max(100)
                    ->step(1)
                    ->defaultValue(50)
                    ->required(),
                Range::make(__("Strongness", "ahana"), "wwd_strongness")
                    ->min(0)
                    ->max(100)
                    ->step(1)
                    ->defaultValue(50)
                    ->required(),
            ])
    ],
    "location" => [
        Location::if("page_template", "==", "templates/template-about.php")
    ],
    "menu_order" => 1,
    "position" => "normal",
    "style" => "default",
    "label_placement" => "top",
    "instruction_placement" => "label",
    "active" => true,
]);




/**
 * trainers section
 */
register_extended_field_group([
    "title" => __("Trainers section", "ahana"),
    "fields" => [
        Text::make(__("Title", "ahana"), "trainer_title")
            ->required()
            ->defaultValue(__("our trainer yoga", "ahana")),
        Text::make(__("Subtitle", "ahana"), "trainer_subtitle")
            ->required()
            ->defaultValue(__("Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!", "ahana")),
    ],
    "location" => [
        Location::if("page_template", "==", "templates/template-about.php")
    ],
    "menu_order" => 2,
    "position" => "normal",
    "style" => "default",
    "label_placement" => "top",
    "instruction_placement" => "label",
    "active" => true,
]);