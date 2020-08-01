<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The single classes template file
 */

$context = Timber::context();
$context["post"] = new Post();
$context["classes"] = Timber::get_posts([
    "post_type" => "classes",
    "posts_per_page" => 4,
    "order" => "DESC",
    "post__not_in" => [$post->ID]
]);
$context["sidebar_classes_single"] = Timber::get_widgets("classes-single");

$templates = "pages/single-classes.twig";

Timber::render($templates, $context);
