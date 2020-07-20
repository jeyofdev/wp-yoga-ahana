<?php

namespace jeyofdev\wp\yoga\ahana\customize;

use jeyofdev\wp\yoga\ahana\customize\InitCustomizer;
use jeyofdev\wp\yoga\ahana\customize\FieldsCustomizer;



/**
 * Class which manages the customizer
 */
class Customizer
{

    public function __construct ()
    {
        InitCustomizer::init();
        $this->init();

        return $this->get_fields();
    }



    /**
     * Initialize the customizer with Kirki
     *
     * @return void
     */
    private function init () : void
    {
        if (!class_exists("Kirki")) {
            require_once "kirki/kirki.php";

            /**
             * Implement the theme options using Kirki.
             */
            new FieldsCustomizer();

            add_filter("kirki_telemetry", "__return_false");
        }
    }



    /**
     * @return FieldsCustomizer|null
     */
    private function get_fields () : ?FieldsCustomizer
    {
        return FieldsCustomizer::instance();
    }
}


