<?php

namespace jeyofdev\wp\yoga\ahana\inc;



/**
 * Class which manages the users
 */
class Users {

    /**
     * Filters the user contact methods
     *
     * @return void
     */
    public static function init () : void
    {
        add_action("user_contactmethods", function ($contactMethods) {
            $contactMethods["facebook"] = "Facebook";
            $contactMethods["instagram"] = "Instagram";
            $contactMethods["twitter"] = "Twitter";
            $contactMethods["linkedin"] = "Linkedin";

            return $contactMethods;
        });
    }
}
