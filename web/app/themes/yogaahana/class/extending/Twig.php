<?php

namespace jeyofdev\wp\yoga\ahana\extending;

use Twig\Environment;
use jeyofdev\wp\yoga\ahana\extending\twig\Functions;
use Timber\Twig as TimberTwig;



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

		return $twig;
    }
}



