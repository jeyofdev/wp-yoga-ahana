<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Timber\Site as TimberSite;
use jeyofdev\wp\yoga\ahana\inc\Menus;
use jeyofdev\wp\yoga\ahana\inc\Assets;
use jeyofdev\wp\yoga\ahana\inc\Supports;
use jeyofdev\wp\yoga\ahana\customize\Customizer;
use jeyofdev\wp\yoga\ahana\inc\Admin;
use jeyofdev\wp\yoga\ahana\inc\Comments;
use jeyofdev\wp\yoga\ahana\inc\Images;
use jeyofdev\wp\yoga\ahana\inc\Page;
use jeyofdev\wp\yoga\ahana\inc\Pagination;
use jeyofdev\wp\yoga\ahana\inc\Post;
use jeyofdev\wp\yoga\ahana\inc\PostTypes;
use jeyofdev\wp\yoga\ahana\inc\Queries;
use jeyofdev\wp\yoga\ahana\inc\Settings;
use jeyofdev\wp\yoga\ahana\inc\Share;
use jeyofdev\wp\yoga\ahana\inc\Sidebar;
use jeyofdev\wp\yoga\ahana\inc\Styles;
use jeyofdev\wp\yoga\ahana\inc\Taxonomies;
use jeyofdev\wp\yoga\ahana\inc\Theme;
use jeyofdev\wp\yoga\ahana\inc\Title;
use jeyofdev\wp\yoga\ahana\inc\Users;



/**
 * Class which manages the useful information of the application
 */
class Site extends TimberSite
{
    public function __construct ()
    {
        parent::__construct();
        Theme::init();
        Admin::init();
        Settings::init();
        Supports::init();
        Title::init();
        Assets::init();
        Menus::init();
        Sidebar::init();
        Images::init();
        Users::init();
        Pagination::init();
        Comments::init();
        Post::init();
        PostTypes::init();
        Taxonomies::init();
        Queries::init();
        Page::init();
        Styles::init();
        Share::init();

        return new Customizer();
    }
}
