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
 * Table tl_custombemodule
 */
$GLOBALS['TL_DCA']['tl_custombemodule'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onsubmit_callback'			  => array
		(
			array('tl_custombemodule', 'updateConfig')	
		),
		'ondelete_callback'			  => array
		(
			array('tl_custombemodule', 'updateConfig')	
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('module_name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter,limit'
		),
		'label' => array
		(
			'fields'                  => array('module_name', 'type', 'language'),
			'format'                  => '%s <span style="color:#CCCCCC;">[%s, %s]</span>'
		),
		'global_operations' => array
		(
			'generateModules' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_custombemodule']['generateModules'],
				'href'                => 'key=generateModules',
				'attributes'          => 'onclick="Backend.getScrollOffset();" style="-moz-background-clip:border;-moz-background-inline-policy:continuous;-moz-background-origin:padding;background:transparent url(system/modules/z_custombemodule/assets/go.png) no-repeat scroll left center;padding:2px 0 3px 20px;"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_custombemodule']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_custombemodule']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_custombemodule']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_custombemodule']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('type','specialplace'),
		'default'                     => '{custombemodule_legend},module_name,language,type;',
		'group'						  => '{custombemodule_legend},module_name,language,type,group_position,beforeOrafter;',
		'module'					  => '{custombemodule_legend},module_name,language,type,descr,iconUrl,forwardto,addtogroup,specialplace;',
		'link'						  => '{custombemodule_legend},module_name,language,type,descr,iconUrl,link,addtogroup,specialplace;',
		'file'						  => '{custombemodule_legend},module_name,language,type,descr,iconUrl,file,addtogroup,specialplace;',
	),

	// Subpalettes
	'subpalettes' => array
	(
		'specialplace'                            => 'pastebefore'
	),

	// Fields
	'fields' => array
	(
		'module_name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['module_name'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'unique'=>true),
			'save_callback'			  => array
			(
				array('tl_custombemodule', 'addTabName')
			)
		),
		'type'	=> array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['type'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'				  => 'group',
			'filter'				  => true,
			'options'				  => array('group', 'module', 'link', 'file'),
			'reference'				  => &$GLOBALS['TL_LANG']['tl_custombemodule']['type'],
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true)
		),
		'group_position' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['group_position'],
			'exclude'                 => true,
			'inputType'               => 'radio',
			'options_callback'		  => array('tl_custombemodule', 'getBENavCategories'),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true)
		),
		'beforeOrafter'	=> array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['beforeOrafter'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'default'				  => 'before',
			'options'		 		  => array('before', 'after'),
			'reference'				  => &$GLOBALS['TL_LANG']['tl_custombemodule']['beforeOrafter'],
			'eval'                    => array('mandatory'=>true,'tl_class'=>'w50'),
		),
		'descr' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['descr'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long')
		),
		'language' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['language'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'filter'				  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>2, 'tl_class'=>'w50')
		),
		'forwardto' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['forwardto'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long')
		),
		'addtogroup' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['addtogroup'],
			'exclude'                 => true,
			'inputType'               => 'radio',
			'options_callback'		  => array('tl_custombemodule', 'getBENavCategories'),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true)
		),
		'specialplace' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['specialplace'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'pastebefore' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['pastebefore'],
			'exclude'                 => true,
			'inputType'               => 'radio',
			'options_callback'		  => array('tl_custombemodule', 'getBEModules'),
			'eval'                    => array('mandatory'=>true)
		),
		'iconUrl' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['iconUrl'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'extensions'=>'png,gif', 'tl_class'=>'clr')
		),
		'link' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['link'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'mandatory'=>true)
		),
		'file' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_custombemodule']['file'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('fieldType'=>'radio', 'files'=>true, 'mandatory'=>true, 'filesOnly'=>true, 'extensions'=>$GLOBALS['TL_CONFIG']['allowedDownload'])
		)
	)
);


class tl_custombemodule extends Backend
{
	
	/**
	 * Initialize the object
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * Get all backend navigation categories
	 * @return array
	 */
	public function getBENavCategories()
	{
		$retArr = array();
		foreach($GLOBALS['BE_MOD'] as $k => $v)
		{
			$retArr[$k] = $GLOBALS['TL_LANG']['MOD'][$k];
		}
		return $retArr;
	}
	
	
	/**
	 * Get all backend modules
	 * @param object
	 * @return array
	 */
	public function getBEModules(DataContainer $dc)
	{
		$retArr = array();
		
		if(!$dc->activeRecord->addtogroup)
		{
			return array();
		}
		
		$count = 0;
		foreach($GLOBALS['BE_MOD'][$dc->activeRecord->addtogroup] as $k => $v)
		{
			$retArr['count_'.$count] = $GLOBALS['TL_LANG']['MOD'][$k][0];
			$count++;
		}		

		return $retArr;
	}
	
	
	/**
	 * Add the table name
	 * @param string
	 * @param object
	 * @return mixed
	 */	
	public function addTabName($strValue, DataContainer $dc)
	{
		$strTabName = standardize($strValue);
		
		$objDatabase = $this->Database->prepare("UPDATE tl_custombemodule SET tabname=? WHERE id=?")
									  ->execute($strTabName, $dc->id);
									  
		// return the module's name untouched
		return $strValue;
	}
	
	
	/**
	 * Update the config file
	 * @param DataContainer
	 */
	public function updateConfig(DataContainer $dc)
	{
		$this->import('ConfigWriter');
		$this->ConfigWriter->doUpdate();
	}
}

?>