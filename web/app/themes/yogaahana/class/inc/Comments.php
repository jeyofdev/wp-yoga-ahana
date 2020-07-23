<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class that manages comments and the form for adding comments
 */
class Comments {

    /**
     * Load all methods
     *
     * @return void
     */
    public static function init () : void
    {
        self::comment_reply_link();
        self::comment_form_default_fields();
        self::comment_form_defaults();
    }



    /**
     * Change the class attribute of the comment reply link
     *
     * @return void
     */
    public static function comment_reply_link () : void
    {
        add_filter("comment_reply_link", function ($class){
            $class = str_replace("class='comment-reply-link", 'class="comment-reply-link reply"', $class);

            return $class;
        });

        add_filter("comment_reply_link_args", function ($args){
            $args["reply_text"] = '<i class="material-icons">reply</i>Reply';

            return $args;
        });
    }



    /**
     * Filters the default comment form fields
     *
     * @return void
     */
    public static function comment_form_default_fields () : void
    {
        add_filter("comment_form_default_fields", function (array $fields)
        {
            $authorLabel = __("Your name *", "ahana");
            $emailLabel = __("Your Email *", "ahana");
            $urlLabel = __("Your website", "ahana");

            $fields['author'] = 
                '<input type="text" name="author" id="author" placeholder="' . $authorLabel . '" required>'
            ;

            $fields['email'] = 
                '<input type="email" name="email" id="email" placeholder="' . $emailLabel . '" required>'
            ;

            $fields['url'] = 
                '<input type="url" name="url" id="url" placeholder="' . $urlLabel . '">'
            ;

            $fields['cookies'] = '';

            return $fields;
        });
    }



    /**
     * Filters the comment form default arguments
     *
     * @return void
     */
    public static function comment_form_defaults () : void
    {
        add_filter("comment_form_defaults", function (array $fields)
        {
            $commentLabel = __("Write Comment *", "ahana");

            $user = wp_get_current_user();
            $user_identity = $user->exists() ? $user->display_name : '';

            $fields["title_reply_before"] = '<h3 class="comment-title">';
            $fields["title_reply_after"] = "</h3>";
            $fields["title_reply"] = __("Leave a Reply", "ahana");
            $fields["class_form"] = "singup-form";
            $fields["comment_field"] = 
                '<textarea id="comment" name="comment" cols="30" rows="9" placeholder="' . $commentLabel . '" required></textarea>'
            ;
            $fields["class_submit"] = "site-btn sb-gradient";
            $fields["label_submit"] = __("Send Message", "dingo");
            $fields["submit_button"] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s"/>%4$s</button>';
            $fields["submit_field"] = '<div class="form-group">%1$s %2$s</div>';

            return $fields;
        });
    }
}