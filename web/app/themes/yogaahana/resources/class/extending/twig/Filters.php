<?php

namespace jeyofdev\wp\yoga\ahana\extending\twig;

use Twig\TwigFilter;
use Twig\Environment;
use jeyofdev\wp\yoga\ahana\options\ClubSettings;



/**
 * Class that allows adding new filter to Twig
 */
class Filters
{
    /**
     * Display the excerpt of a text
     *
     * @param Environment $twig
     *
     * @return void
     */
    public static function chars (Environment $twig) : void
    {
        $twig->addFilter(new TwigFilter("chars", function (string $text, ?int $limit = 20) {
            if (strlen($text) > $limit) {
                $last_space = strpos($text, " ", $limit);

                if ($last_space !== false) {
                    return substr($text, 0, $last_space) . "...";
                }
            }

            return $text;
        }));
    }



    /**
     * Replaces common plain text characters with formatted entities
     *
     * @param Environment $twig
     *
     * @return void
     */
    public static function texturize (Environment $twig) : void
    {
        $twig->addFilter(new TwigFilter("texturize", function (string $text) {
            $text = str_replace("&#038;", "&", $text);
            $text = str_replace("&hellip;", "...", $text);
            return $text;
        }));
    }
}



