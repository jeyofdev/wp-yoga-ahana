<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive 'classes' template file
 */



$context = Timber::context();
$context["sidebar_classes_list"] = Timber::get_widgets("classes-list");

$templates = "pages/archive-classes.twig";



Timber::render($templates, $context);