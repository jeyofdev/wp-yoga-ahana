<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Timber\Timber as TimberTimber;
use jeyofdev\wp\yoga\ahana\Context;
use jeyofdev\wp\yoga\ahana\extending\Site;


/**
 * Extend Timber\Timber
 */
class Timber extends TimberTimber
{
    public function __construct()
    {
        parent::__construct();

        return [
            new Site(),
            new Context()
        ];
    }
}
