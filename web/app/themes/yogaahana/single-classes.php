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
$templates = "pages/single-classes.twig";

Timber::render($templates, $context);
