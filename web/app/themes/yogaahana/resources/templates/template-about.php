<?php

/**
 * Template Name: Page about
 * Template Post Type: page
 */

use jeyofdev\wp\yoga\ahana\extending\Timber;



$context = Timber::context();
$context["post"] = Timber::get_post();
$context["services"] = Timber::get_posts([
    "post_type" => "service",
    "posts_per_page" => 4,
    "order" => "DESC"
]);
$context["trainers"] = Timber::get_posts([
    "post_type" => "trainer",
    "posts_per_page" => 5,
    "order" => "DESC"
]);
$context["testimonials"] = Timber::get_posts([
    "post_type" => "testimonial",
    "posts_per_page" => 3,
    "order" => "DESC"
]);
$context["blog"] = Timber::get_posts([
    "post_type" => "post",
    "posts_per_page" => 3,
    "order" => "DESC"
]);

$templates = "pages/templates/about.twig";



Timber::render($templates, $context);
