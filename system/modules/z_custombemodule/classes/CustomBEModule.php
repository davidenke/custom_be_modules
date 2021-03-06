<?php

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
 * Run in a custom namespace, so the class can be replaced
 */
namespace Contao;


/**
 * Class CustomBEModule 
 *
 * @copyright  Yanick Witschi 2010 
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch> 
 * @package    Controller
 */
class CustomBEModule extends \Backend
{
	/**
	 * Initialize the object
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * Redirects the module to where it should
	 */
	protected function generate()
	{		
		$objData = $this->Database->prepare("SELECT * FROM tl_custombemodule WHERE tabname=?")
								->limit(1)
								->execute($this->Input->get('do'));
		
 		switch ($objData->type)
 		{
			 case 'module':
				 $this->import('String');
				 $this->redirect($this->Environment->script . '?' . $this->String->decodeEntities($objData->forwardto));
				 break;
				 
			 case 'link':
				 $this->redirect($objData->link);
				 break;
			 
			 case 'file':
				 $this->sendFileToBrowser($objData->file);
				break;
		 }
	}

}