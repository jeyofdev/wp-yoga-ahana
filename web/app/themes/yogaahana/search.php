<?php

namespace jeyofdev\wp\yoga\ahana;

use jeyofdev\wp\yoga\ahana\extending\Timber;



/**
 * The search result template file
 */

$context = Timber::context();
$context["query_vars"] = [
    "search_all" => get_query_var("search_all"),
    "search_blog" => get_query_var("search_blog")
];

$templates = ["pages/search.twig"];



Timber::render($templates, $context);
