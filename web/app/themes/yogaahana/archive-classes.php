<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive 'classes' template file
 */



$context = Timber::context();

$templates = "pages/archive-classes.twig";



Timber::render($templates, $context);