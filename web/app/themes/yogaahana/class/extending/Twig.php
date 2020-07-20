<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Twig\Environment;
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
        Functions::dump($twig);
		Functions::dd($twig);
		Functions::format_city($twig);
		Functions::format_opening_hours($twig);
		

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

		return $twig;
	}
}
