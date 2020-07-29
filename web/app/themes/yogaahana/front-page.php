<?php

use Timber\Post;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The front page template file
 */

$context = Timber::context();
$context["post"] = new Post();
$context["services"] = Timber::get_posts([
    "post_type" => "service",
    "posts_per_page" => 3,
    "order" => "DESC"
]);
$context["classes"] = Timber::get_posts([
    "post_type" => "classes",
    "posts_per_page" => 4,
    "order" => "DESC"
]);
$context["trainers"] = Timber::get_posts([
    "post_type" => "trainer",
    "posts_per_page" => 4,
    "order" => "DESC"
]);
$context["testimonials"] = Timber::get_posts([
    "post_type" => "testimonial",
    "posts_per_page" => 3,
    "order" => "DESC"
]);
$context["events"] = Timber::get_posts([
    "post_type" => "event",
    "posts_per_page" => 3,
    "order" => "DESC"
]);
$context["pricing_plans"] = Timber::get_posts([
    "post_type" => "pricing_plan",
    "posts_per_page" => 4,
    "order" => "ASC"
]);
$context["slides"] = Timber::get_posts([
    "post_type" => "slide",
    "posts_per_page" => 3,
    "order" => "ASC"
]);



$templates = "pages/front-page.twig";



Timber::render($templates, $context);