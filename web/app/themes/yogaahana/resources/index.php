<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The main template file
 */

$context = Timber::context();
$templates = "pages/index.twig";



Timber::render($templates, $context);