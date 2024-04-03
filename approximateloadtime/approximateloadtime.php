<?php 
/*
  * @package plugin approximateloadtime for Joomla! 4.x
 * @version $Id: approximateloadtime 1.0.0 2024-03-15 01:10:10Z $
 * @author KWProductions Co.
 * @copyright (C) 2022- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of approximateloadtime.
    approximateloadtime is free software: you can redistribute it and/or adify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    approximateloadtime is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for are details.
    You should have received a copy of the GNU General Public License
    along with approximateloadtime.  If not, see <http://www.gnu.org/licenses/>.
 
*/

?>
<?php
defined('_JEXEC') or die;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Stream;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;



class PlgSystemApproximateloadtime extends CMSPlugin
{		
	    protected $autoloadLanguage = true;
		protected $app;
		protected $db;
		protected $start;
		protected $end;


    public function onAfterInitialise()
	{
		$this->loadLanguage();
	}
	
	public function onBeforeRender()
	{
		$db = $this->db;
		
    $query = "CREATE TABLE IF NOT EXISTS `#__approximate_load_time` ( `id` int(10)  unsigned NOT NULL auto_increment,`loadtime` int(10)  unsigned,`uri` text NOT NULL,  PRIMARY KEY  (`id`))";
			$db->setQuery($query);
		//$db->execute();  
  
		$this->start = microtime(true);
	}
	public function onAfterRender()
	{
		$db = $this->db;
		$app = Factory::getApplication();
		$this->end = microtime(true);

		$loadtime = ($this->end) - ($this->start);
		if($loadtime<1)
			$loadtime = 1;
		$action = $this->params->get("inup");
		$uri = Uri::getInstance()->toString();
		if($app->isClient('site')):
		
		if($action==='check')
		{
		   $query = $db->getQuery(true);		   	
		   $query->select('*')->from($db->quoteName('#__approximate_load_time'))->where($db->quoteName('uri') .' = '.$db->quote($uri));
						$db->setQuery($query);
						$result = $db->loadObject();
						if($result==NULL)
						{
							$query = $db->getQuery(true);
                    $columns = array('loadtime', 'uri');
                    $values = array($db->quote($loadtime), $db->quote($uri));
                    $query->insert($db->quoteName('#__approximate_load_time'))->columns($db->quoteName($columns))->values(implode(',', $values));

                    $db->setQuery($query);
                    $db->execute();
						}
						else
						{
							
							$query = $db->getQuery(true);
						$value = array($db->quoteName('loadtime').'='.$db->quote($loadtime));
						$condition = array($db->quoteName('uri').'='.$db->quote($uri));
						$query->update($db->quoteName('#__approximate_load_time'))->set($value)->where($condition);
						$db->setQuery($query);
						$db->execute();				

						}
		}
		
		
			
					
					
		
		endif;
	}
	

		
	



}
?>

