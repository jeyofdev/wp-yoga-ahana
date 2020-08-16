<?php

namespace jeyofdev\wp\yoga\ahana\inc;



class Post {

    /**
     * Add reading time in minutes
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("save_post", function ($post_id, $post, $update) {
            if(!$update || wp_is_post_revision($post_id) || ($post->post_type != "post" && $post->post_type != "classes" && $post->post_type != "event") || (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)) {
                return;
            }

            $theContent = str_replace("[", "<", $post->post_content);
            $theContent = str_replace("]", ">", $theContent);

            $word_count = str_word_count(strip_tags($theContent));
            $minutes = ceil($word_count / 250);

            update_post_meta($post_id, "time_to_read", $minutes);
        }, 10, 3);
    }
}


