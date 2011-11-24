-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_custombemodule`
-- 

CREATE TABLE `tl_custombemodule` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `module_name` varchar(255) NOT NULL default '',
  `type` varchar(6) NOT NULL default '',
  `beforeOrafter` varchar(6) NOT NULL default '',
  `group_position` varchar(255) NOT NULL default '',
  `language` varchar(2) NOT NULL default '',
  `descr` varchar(255) NOT NULL default '',
  `tabname` varchar(255) NOT NULL default '',
  `forwardto` varchar(255) NOT NULL default '',
  `addtogroup` varchar(255) NOT NULL default '',
  `specialplace` char(1) NOT NULL default '',
  `pastebefore` varchar(255) NOT NULL default '',
  `iconUrl` varchar(255) NOT NULL default '',
  `link` varchar(255) NOT NULL default '',
  `file` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_user_group`
-- 

CREATE TABLE `tl_user_group` (
  `custombemodules_modulesToHide` blob NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
