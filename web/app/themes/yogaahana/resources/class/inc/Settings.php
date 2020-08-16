<?php
namespace jeyofdev\wp\yoga\ahana\inc;

use jeyofdev\wp\yoga\ahana\options\ClubSettings;



/**
 * Class which manages all the setting options
 */
class Settings
{
    /**
     * Load all setting options
     *
     * @return void
     */
    public static function init () : void
    {
        ClubSettings::register();
    }
}

