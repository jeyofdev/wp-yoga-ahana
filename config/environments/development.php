<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Whoops\Run;
use Roots\WPConfig\Config;
use Whoops\Handler\PrettyPageHandler;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);

ini_set('display_errors', '1');

// php errors handler
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);
