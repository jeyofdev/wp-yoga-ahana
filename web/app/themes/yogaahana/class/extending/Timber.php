<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Timber\Timber as TimberTimber;
use jeyofdev\wp\yoga\ahana\Context;



/**
 * Extend Timber\Timber
 */
class Timber extends TimberTimber
{
    public function __construct()
    {
        parent::__construct();
        Twig::init();

        return [
            new Site(),
            new Context()
        ];
    }
}
