<?php

namespace jeyofdev\wp\yoga\ahana;

use Timber\Menu;
use jeyofdev\wp\yoga\ahana\extending\Site;
use jeyofdev\wp\yoga\ahana\options\ClubSettings;



/**
 * class which manages the context array
 */
class Context {

    /**
     * @var array
     */
    public $context;



    public function __construct ()
    {
        add_filter("timber/context", function ($context) {
            $this->context = $context;

            $this->add("site", new Site());
            $this->add("menu", new Menu("primary"));
            $this->add("club_settings", [
                "phone" => get_option(ClubSettings::PHONE),
                "address" => get_option(ClubSettings::ADDRESS),
                "city" => get_option(ClubSettings::CITY),
                "opening_hours" => get_option(ClubSettings::OPENING_HOURS)
            ]);

            return $this->context;
        });
    }



    /**
     * Add informations to context
     *
     * @param string $key
     * @param mixed $value
     * 
     * @return self
     */
    public function add (string $key, $value) : self
    {
        $this->context[$key] =  $value;
        return $this;
    } 
}
