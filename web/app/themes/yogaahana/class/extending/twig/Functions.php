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
        $twig->addFunction(new TwigFunction("format_city", function (array $clubSetting = [], ?string $separator = null, ?bool $space = true) {
            extract($clubSetting);
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
        $twig->addFunction(new TwigFunction("format_opening_hours", function ($single = true) {
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

            if ($single) {
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
            } else {
                $output = '<li><i class="material-icons">map</i>' . sprintf(esc_html__("Mon - Fri : %s - %s", "ahana"), $hours["weeks"]["opening"], $hours["weeks"]["closing"]) . '</li>';
                $output .= '<li><i class="material-icons">map</i>' . sprintf(esc_html__("Saturday : %s - %s", "ahana"), $hours["saturday"]["opening"], $hours["saturday"]["closing"]) . '</li>';
                $output .= '<li><i class="material-icons">map</i>' . sprintf(esc_html__("Sunday : %s - %s", "ahana"), $hours["sunday"]["opening"], $hours["sunday"]["closing"]) . '</li>';

                return $output;
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



    /**
     * Retrieve the avatar <img> tag for a user, email address, MD5 hash, comment, or post
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function get_avatar (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("get_avatar", function (?int $size = 100, ?array $args = [], ?string $default = '', ?string $alt = '') {
            return get_avatar(get_the_author_meta('ID'), $size, $default, $alt, $args);
        }));
    }



    /**
     * Display social media links of an article author
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function add_social (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("add_social", function (string $social, string $icon, bool $author = false) {
            $urls = [
                "facebook" => "https://www.facebook.com/",
                "instagram" => "https://www.instagram.com/",
                "twitter" => "https://twitter.com/",
                "linkedin" => "https://www.linkedin.com/"
            ];

            if ($author) {
                $post = Timber::get_post();
                $user = $post->author();
                $url = $urls[$social] . $user->$social;

                if (empty($user->$social)) {
                    return;
                }
            } else {
                $context = Timber::get_context();
                $url = $urls[$social] . $context["club_settings"][$social];
            }

            if (!empty($social) && $icon !== '') {
                return '<a href="' . $url . '" target="_blank"><i class="' . $icon . '"></i></a>';
            }                   
        }));
    }



    /**
     * Display the days by displaying the first 3 letters
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function get_classes_days (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("get_classes_days", function (array $days) {
            $output = [];
            foreach ($days as $day) {
                $output[] = substr($day->title, 0, 3); 
            }

            return implode(", ", $output);
        }));
    }



    /**
     * Display the payment taxonomy for a pricing plan
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function get_pricing_plan_taxonomy (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("get_pricing_plan_taxonomy", function (array $payments) {
            return strtolower($payments[0]->name);
        }));
    }



    /**
     * retrieve the trainer corresponding to a classes or an event
     *
     * @param Environment $twig
     * 
     * @return void
     */
    public static function get_trainer (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("get_trainer", function (Post $post) {
            $trainer = get_the_terms($post, "trainer");

            if (!$trainer) {
                return;
            };

            $allTrainers = Timber::get_posts([
                "post_type" => "trainer",
                "posts_per_page" => -1
            ]);

            $items = [];
            foreach ($allTrainers as $item) {
                if ($trainer[0]->name === $item->title) {
                    $items[] = $item;
                    $job = get_the_terms($item, "trainer_job");
                }
            }

            return [
                "trainer_name" => $items[0]->name,
                "trainer_link" => $items[0]->link,
                "job" => $job[0]->name,
                "thumbnail" => $items[0]->trainer_avatar
            ];
        }));
    }



    /**
     * Get the posts number
     *
     * @param Environment $twig
     * @return void
     */
    public static function get_number_posts (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("get_number_posts", function ($posts, string $singular, string $plural) {
            $output = sprintf(_n($singular, $plural, $posts->count(), "ahana"), $posts->count(), $posts->found_posts);

            return $output;
        }));
    }



    /**
     * add sharing buttons to posts
     *
     * @param Environment $twig
     * @return void
     */
    public static function sharing (Environment $twig) : void
    {
        $twig->addFunction(new TwigFunction("sharing", function () {
            if (function_exists ('sharing_display')) {
                return sharing_display (); 
            }
        }));
    }
}
