<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Timber\Site as TimberSite;
use jeyofdev\wp\yoga\ahana\inc\Menus;
use jeyofdev\wp\yoga\ahana\inc\Assets;
use jeyofdev\wp\yoga\ahana\inc\Supports;
use jeyofdev\wp\yoga\ahana\customize\Customizer;



/**
 * Class which manages the useful information of the application
 */
class Site extends TimberSite
{
    public function __construct ()
    {
        parent::__construct();
        Assets::init();
        Supports::init();
        Menus::init();

        return new Customizer();
    }
}
