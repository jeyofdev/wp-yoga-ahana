<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive template file
 */

$context = Timber::context();
$templates = "pages/archive.twig";



Timber::render($templates, $context);