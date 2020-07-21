<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Timber\Site as TimberSite;
use jeyofdev\wp\yoga\ahana\inc\Menus;
use jeyofdev\wp\yoga\ahana\inc\Assets;
use jeyofdev\wp\yoga\ahana\inc\Supports;
use jeyofdev\wp\yoga\ahana\customize\Customizer;
use jeyofdev\wp\yoga\ahana\inc\Images;
use jeyofdev\wp\yoga\ahana\inc\Settings;



/**
 * Class which manages the useful information of the application
 */
class Site extends TimberSite
{
    public function __construct ()
    {
        parent::__construct();
        Settings::init();
        Assets::init();
        Supports::init();
        Menus::init();
        Images::init();

        return new Customizer();
    }
}
