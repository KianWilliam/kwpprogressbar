<?php

/*
  * @package package progressbar for Joomla! 4.x
 * @version $Id: progressbar 1.0.0 2024-03-15 01:10:10Z $
 * @author KWProductions Co.
 * @copyright (C) 2022- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of progressbar.
    progressbar is free software: you can redistribute it and/or adify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    progressbar is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for are details.
    You should have received a copy of the GNU General Public License
    along with progressbar.  If not, see <http://www.gnu.org/licenses/>.
 
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Installer\InstallerScript;

class Pkg_ProgressbarInstallerScript extends InstallerScript
{
 public function install($parent)
 {
  
   
  $db  = Factory::getDbo();
  $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('progressbar'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute(); 
  
   $query = $db->getQuery(true);
  $query->update('#__extensions');
  $query->set($db->quoteName('enabled') . ' = 1');
  $query->where($db->quoteName('element') . ' = ' . $db->quote('approximateloadtime'));
  $query->where($db->quoteName('type') . ' = ' . $db->quote('plugin'));
  $db->setQuery($query);
  $db->execute(); 

    $query = "CREATE TABLE IF NOT EXISTS `#__approximate_load_time` ( `id` int(10)  unsigned NOT NULL auto_increment,`loadtime` int(10)  unsigned,`uri` text NOT NULL,  PRIMARY KEY  (`id`))";
			$db->setQuery($query);
			$db->execute();  
  
 }
   public function uninstall($parent) 
  {
	   $db  = Factory::getDbo();
	       
       $query = "DROP IF EXISTS TABLE `#__approximate_load_time`";
	   $db->setQuery($query);
			$db->execute();
			
		
  }
}
