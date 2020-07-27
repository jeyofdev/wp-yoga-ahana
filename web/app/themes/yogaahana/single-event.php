<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The single event template file
 */

$context = Timber::context();
$context["post"] = new Post();
$context["events"] = Timber::get_posts([
    "post_type" => "event",
    "posts_per_page" => 4,
    "order" => "DESC",
    "post__not_in" => [$post->ID]
]);

$templates = "pages/single-event.twig";


Timber::render($templates, $context);
