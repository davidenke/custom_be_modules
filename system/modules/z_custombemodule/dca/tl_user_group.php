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


/**
 * Table tl_user_group
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] .= ';{custombemodules_legend},custombemodules_modulesToHide';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['custombemodules_modulesToHide'] = array
(	
	'label'                   => &$GLOBALS['TL_LANG']['tl_user_group']['custombemodules_modulesToHide'],
	'exclude'				  => true,
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_user_group', 'getModules'),
	'reference'               => &$GLOBALS['TL_LANG']['MOD'],
	'eval'					  => array('multiple'=>true)
);

?>