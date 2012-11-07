<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Z_custombemodule
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Contao\BENavigation'   => 'system/modules/z_custombemodule/classes/BENavigation.php',
	'Contao\ConfigWriter'   => 'system/modules/z_custombemodule/classes/ConfigWriter.php',
	'Contao\CustomBEModule' => 'system/modules/z_custombemodule/classes/CustomBEModule.php',
));
