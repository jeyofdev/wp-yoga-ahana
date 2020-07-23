<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The single post template file
 */

$context = Timber::context();
$context["post"] = new Post();
$templates = "pages/single-post.twig";


Timber::render($templates, $context);

