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
 * Class BENavigation 
 *
 * @copyright  Yanick Witschi 2010 
 * @author     Yanick Witschi <yanick.witschi@certo-net.ch> 
 * @package    Controller
 */
class BENavigation extends Backend
{
	/**
	 * Modules to hide
	 * @var array
	 */
	private $modulesToHide = array();
	

	/**
	 * Initialize object
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * Filters the backend navigation for hidden modules
	 * @param string
	 * @param string
	 * @return string
	 */
	public function outputBackendTemplate($strContent, $strTemplate)
	{
		// fix installation bug
		if (!$this->Database->fieldExists('custombemodules_modulesToHide', 'tl_user_group'))
		{
			return $strContent;
		}
		
		if ($strTemplate == 'be_main')
		{
			// add JS to external links
			$strContent = $this->addJavascriptForExternalLinks($strContent);
			
			if (!$this->loadModules())
			{
				return $strContent;
			}
			

			$regEx = '!<li[^>]*><a[^>]*(typolight|contao[^"]*)[^>]*>([ 0-9a-zA-Z]+)</a></li>!ix';
			$strContent = preg_replace_callback($regEx, array($this,'dispatcher'), $strContent);
		}

		return $strContent;
	}

	
	/**
	 * Callback function for the regex
	 * @param array
	 * @return string
	 */
	private function dispatcher($matches)
	{	
		$myTag = array_reverse(explode('=',$matches[1]));

		if(!in_array($myTag[0], $this->modulesToHide))
		{
			return $matches[0];
		}
		else
		{			
			return '';
		}		
	}
	
	
	/**
	 * Add javascript so external links are forced to open in a new window
	 */
	private function addJavascriptForExternalLinks($strContent)
	{
		$objModules = $this->Database->prepare("SELECT * FROM tl_custombemodule WHERE type='link'")->execute();
		if (!$objModules->numRows)
		{
			return $strContent;
		}
		
		$strJS = '<script>' . "\n";
		
		while ($objModules->next())
		{
			$strJS .= '$$(\'a.navigation.'. $objModules->tabname . '\')[0].addEvent(\'click\', function(e)
			{
				e.preventDefault();
				window.open(this.href);
			});' . "\n";
		}
		
		$strJS .= '</script>' . "\n";
		
		return str_replace('</body>', $strJS . '</body>', $strContent);
	}
	
	
	/**
	 * Load modules to hide
	 * @return boolean
	 */
	private function loadModules()
	{
		// import User class
		$this->import('BackendUser', 'User');
		
		// if User is admin, we won't hide anything
		if ($this->User->isAdmin)
		{
			return false;
		}
		
		$groups = $this->User->groups;
		
		// if User is not assigned to any group at all we won't hide anything
		if(!$this->User->groups[0])
		{
			return false;					
		}
		
		$objUserRights = $this->Database->execute("SELECT custombemodules_modulesToHide AS modulesToHide FROM tl_user_group WHERE id IN (" . implode(',', $groups) . ")");
		
		// filter all the modules the user has no right to see
		if($objUserRights->numRows < 1)
		{
			return false;
		}
		
		while($objUserRights->next())
		{
			$arrModules = deserialize($objUserRights->modulesToHide);

			if(is_array($arrModules))
			{
				foreach($arrModules as $module)
				{
					$this->modulesToHide = array_merge(array($module), $this->modulesToHide);
				}
			}
		}
		
		return true;
	}
	
	
	/**
	 * Remove modules to hide for 2.10
	 * @param array
	 * @return array
	 */
	public function removeModulesToHide($arrModules)
	{
		if (!$this->loadModules())
		{
			return $arrModules;
		}
		
		foreach ($arrModules as $k => $arrModule)
		{
			foreach ($this->modulesToHide as $moduleKey)
			{
				unset($arrModules[$k]['modules'][$moduleKey]);
			}
		}

		return $arrModules;
	}
}

?>