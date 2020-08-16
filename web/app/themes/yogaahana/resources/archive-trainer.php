<?php

use Timber\PostQuery;
use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive 'trainer' template file
 */



$context = Timber::context();
$context["posts"] = new PostQuery();

$templates = "pages/archive-trainers.twig";



Timber::render($templates, $context);