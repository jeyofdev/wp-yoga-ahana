<?php

namespace jeyofdev\wp\yoga\ahana;

use jeyofdev\wp\yoga\ahana\extending\Site;



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
