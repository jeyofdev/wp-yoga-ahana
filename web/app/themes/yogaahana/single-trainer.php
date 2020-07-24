<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;
use Timber\Post;



/**
 * The single trainer template file
 */

$context = Timber::context();
$context["post"] = new Post();
$templates = "pages/single-trainer.twig";


Timber::render($templates, $context);
