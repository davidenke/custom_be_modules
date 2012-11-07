<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Yanick Witschi 2010 
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch> 
 * @package    CustomBEModule 
 * @license    LGPL 
 * @filesource
 */

 
$GLOBALS['BE_MOD']['system']['custombemodule'] = array
(
	'tables'       		=> array('tl_custombemodule'),
	'icon'         		=> 'system/modules/z_custombemodule/assets/icon.png',
	'generateModules'   => array('ConfigWriter', 'doUpdate')
);

$GLOBALS['TL_HOOKS']['outputBackendTemplate'][] = array('BENavigation', 'outputBackendTemplate');
// works a little easier in 2.10
$GLOBALS['TL_HOOKS']['getUserNavigation'][] = array('BENavigation', 'removeModulesToHide');

### CUSTOMCONFIG START ###
$arrDummy = array();
### CUSTOMCONFIG END ###
?>