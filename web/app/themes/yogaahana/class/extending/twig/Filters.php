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
     * Format a phone number
     *
     * @param Environment $twig
     *
     * @return void
     */
    public static function format_phone_number (Environment $twig) : void
    {
        $twig->addFilter(new TwigFilter("format_phone_number", function (string $phone_number) {
            $phone_number = str_replace(' ', '', $phone_number);
            $number = str_split($phone_number);

            unset($number[0]);

            $prefix = "(+" . str_replace("code-", "", get_option(ClubSettings::PHONE_CODE)) . ")";
            $part_one = implode('', array_slice($number, 0, 1));
            $part_two = implode('', array_slice($number, 1, 2));
            $part_three = implode('', array_slice($number, 3, 2));
            $part_four = implode('', array_slice($number, 5, 2));
            $part_five = implode('', array_slice($number, 7, 2));

            return "$prefix $part_one $part_two $part_three $part_four $part_five";
        }));
    }
}



