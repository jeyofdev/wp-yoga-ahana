<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the paginations
 */
class Pagination {

    /**
     * Load custom paginations
     *
     * @return void
     */
    public static function init () : void
    {
        self::previous_post_link();
        self::next_post_link();
    }



    /**
     * Display the previous post link that is adjacent to the current post
     *
     * @return void
     */
    public static function previous_post_link () : void
    {
        add_filter("previous_post_link", function ($output) {
            $previousPost = get_adjacent_post();
        
            if ($previousPost !== '') {
                $previousPostTitle = strlen(get_the_title($previousPost)) > 30 ? substr(get_the_title($previousPost), 0, 30) . "..." : get_the_title($previousPost);

                $output = '<a href="' . get_the_permalink($previousPost). '" class="blog-nav bn-prev">';
                $output .= '<i class="material-icons">keyboard_arrow_left</i>';
                $output .= '<h3>' . $previousPostTitle . '</h3>';
                $output .= '<p>' . __("Previous Post", "ahana") . '</p>';
                $output .= '</a>';
            } else {
                $output = '';
            }
        
            return $output;
        });
    }



    /**
     * Display the next post link that is adjacent to the current post
     *
     * @return void
     */
    public static function next_post_link () : void
    {
        add_filter("next_post_link", function ($output) {
            $nextPost = get_adjacent_post(false, '', false);

            if ($nextPost !== '') {
                $nextPostTitle = strlen(get_the_title($nextPost)) > 30 ? substr(get_the_title($nextPost), 0, 30) . "..." : get_the_title($nextPost);

                $output = '<a href="' . get_the_permalink($nextPost). '" class="blog-nav bn-next">';
                $output .= '<i class="material-icons">keyboard_arrow_right</i>';
                $output .= '<h3>' . $nextPostTitle . '</h3>';
                $output .= '<p>' . __("Next Post", "ahana") . '</p>';
                $output .= '</a>';
            } else {
                $output = '';
            }

            return $output;
        });
    }
}

