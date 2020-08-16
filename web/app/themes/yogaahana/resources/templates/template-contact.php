<?php

/**
 * Template Name: Page contact
 * Template Post Type: page
 */

use jeyofdev\wp\yoga\ahana\extending\Timber;



$context = Timber::context();
$context["post"] = Timber::get_post();

$templates = "pages/templates/contact.twig";



Timber::render($templates, $context);
