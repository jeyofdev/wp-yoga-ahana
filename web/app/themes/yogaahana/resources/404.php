<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The 404 template file
 */

$context = Timber::context();
$templates = "pages/errors/404.twig";



Timber::render($templates, $context);