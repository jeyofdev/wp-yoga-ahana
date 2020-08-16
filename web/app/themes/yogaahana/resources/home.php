<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The blog template file
 */

$context = Timber::context();
$templates = "pages/home.twig";



Timber::render($templates, $context);