<?php

namespace jeyofdev\wp\yoga\ahana\extending\twig;

use \DateTime;
use Timber\Post;
use Twig\Environment;
use Twig\TwigFunction;
use jeyofdev\wp\yoga\ahana\extending\Timber;
use jeyofdev\wp\yoga\ahana\options\ClubSettings;



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



    /**
     * Format the address
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function format_city (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("format_city", function (?string $separator = null, ?bool $space = true) {
            $context = Timber::get_context();
            extract($context["club_settings"]);

            $space = $space ? " " : null;

            return $address . $separator . $space . $city;
        }));
    }



    /**
     * Format the opening hours
     *
     * @param Environment $twig
     * @return void
     */
    public static function format_opening_hours (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("format_opening_hours", function () {
            $hours = [
                "weeks" => [
                    "opening" => get_option(ClubSettings::WEEK_OPENING),
                    "closing" => get_option(ClubSettings::WEEK_CLOSING),
                ],
                "saturday" => [
                    "opening" => get_option(ClubSettings::SATURDAY_OPENING),
                    "closing" => get_option(ClubSettings::SATURDAY_CLOSING),
                ],
                "sunday" => [
                    "opening" => get_option(ClubSettings::SUNDAY_OPENING),
                    "closing" => get_option(ClubSettings::SUNDAY_CLOSING),
                ],
            ];


            $currentDay = (new DateTime())->format("l");
            $dayWeek = ["Monday", "Tuesday", "Thursday", "Wednesday", "Thursday", "Friday"];

            if (in_array($currentDay, $dayWeek)) {
                return sprintf(esc_html__("Mon - Fri : %s - %s", "ahana"), $hours["weeks"]["opening"], $hours["weeks"]["closing"]);
            }

            if ($currentDay === "Saturday") {
                return sprintf(esc_html__("Saturday : %s - %s", "ahana"), $hours["saturday"]["opening"], $hours["saturday"]["closing"]);
            }

            if ($currentDay === "Sunday") {
                return sprintf(esc_html__("Sunday : %s - %s", "ahana"), $hours["sunday"]["opening"], $hours["sunday"]["closing"]);
            }
        }));
    }



    /**
     * Display the categories associated with an article
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function category_by_post (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("category_by_post", function (Post $post) {
            $categories = [];

            foreach ($post->categories as $category) {
                $categories[] = '<a href="' . get_category_link($category) . '">' . $category->name . '</a>';
            }

            return join(" & ", $categories);
        }));
    }
}
