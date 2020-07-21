<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The blog template file
 */

$context = Timber::context();
$context["post"] = new Post();
$templates = "pages/single-post.twig";


Timber::render($templates, $context);

