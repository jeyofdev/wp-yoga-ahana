<?php

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The archive 'event' template file
 */



$context = Timber::context();
$context["trainers"] = Timber::get_terms([
    "taxonomy" => "trainer"
]);
$context["query_vars"] = [
    "date" => get_query_var("event_date"),
    "event_search" => get_query_var("event_search"),
    "trainer" => get_query_var("event_trainer"),
];

$templates = "pages/archive-event.twig";



Timber::render($templates, $context);