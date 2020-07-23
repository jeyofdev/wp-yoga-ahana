<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the queries
 */
class Queries {

    /**
     * Load the queries
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("pre_get_posts", function ($query) {
            if (!is_admin() && is_post_type_archive("trainer") && $query->is_main_query()) {
                $query->set("post_type", "trainer");
                $query->set("posts_per_page", 4);
            }
        });
    }
}
