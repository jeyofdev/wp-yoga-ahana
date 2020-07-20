<?php

namespace jeyofdev\wp\yoga\ahana\extending\twig;

use Twig\Environment;
use Twig\TwigFunction;



/**
 * Class that allows adding new functions to Twig
 */
class Functions
{
    /**
     * Use the symfony dump function to replace the twig dump function
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function dump (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("dump", function ($value) {
            dump($value);
        }));
    }


    
    /**
     * Use the symfony function dd for debug dump and die
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function dd (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("dd", function ($value) {
            dd($value);
        }));
    }
}
