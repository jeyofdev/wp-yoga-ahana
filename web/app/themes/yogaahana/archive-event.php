<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive 'event' template file
 */



$context = Timber::context();

$templates = "pages/archive-event.twig";



Timber::render($templates, $context);