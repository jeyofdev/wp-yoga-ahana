<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The single post template file
 */

$context = Timber::context();
$context["post"] = new Post();
$context["sidebar_blog"] = Timber::get_widgets("blog");

$templates = "pages/single-post.twig";


Timber::render($templates, $context);

