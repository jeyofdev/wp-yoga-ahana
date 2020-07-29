<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Twig\Environment;
use Twig\TwigFunction;
use Timber\Twig as TimberTwig;
use jeyofdev\wp\yoga\ahana\extending\twig\Filters;
use jeyofdev\wp\yoga\ahana\extending\twig\Functions;



/**
 * Class which allows to add functionality to Twig
 */
class Twig extends TimberTwig
{
    /**
	 * @codeCoverageIgnore
	 */
	public static function init() {
		$self = new self();

		add_action("timber/twig/functions", [$self, "add_timber_functions"]);
		add_action("timber/twig/filters", [$self, "add_timber_filters"]);
	}



    /**
	 * Adds functions to Twig.
	 *
	 * @param Environment $twig The Twig Environment
     * 
	 * @return Environment
	 */
	
    public function add_timber_functions($twig) {
		$twig->addFunction(new TwigFunction("previous_post_link", "previous_post_link"));
		$twig->addFunction(new TwigFunction("next_post_link", "next_post_link"));
		$twig->addFunction(new TwigFunction("comment_form", "comment_form"));
		$twig->addFunction(new TwigFunction("get_post_meta", "get_post_meta"));
		$twig->addFunction(new TwigFunction("sprintf", "sprintf"));


        Functions::dump($twig);
		Functions::dd($twig);
		Functions::format_city($twig);
		Functions::format_opening_hours($twig);
		Functions::category_by_post($twig);
		functions::get_avatar($twig);
		Functions::add_social($twig);
		Functions::get_classes_days($twig);
		Functions::get_pricing_plan_taxonomy($twig);
		Functions::get_trainer($twig);

		return $twig;
    }



	/**
	 * Adds filters to Twig
	 *
	 * @param Environment $twig The Twig Environment
     * 
	 * @return Environment
	 */
    public function add_timber_filters($twig) {
		Filters::format_phone_number($twig);
        Filters::chars($twig);
		

		return $twig;
	}
}
