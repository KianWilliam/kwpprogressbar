<?php 
/*
  * @package plugin progressbar for Joomla! 4.x
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

?>
<?php
defined('_JEXEC') or die;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;



class PlgContentProgressbar extends CMSPlugin
{		
	    protected $autoloadLanguage = true;
	
		protected $db;
	


    public function onAfterInitialise()
	{
		$this->loadLanguage();
	}
	public function onContentBeforeDisplay($context, &$article, &$params, $page)
	{
			
		$app = Factory::getApplication();
		$config = Factory::getConfig();
		$doc = $app->getDocument();
		$wa = $doc->getWebAssetManager();
		$db = $this->db;
		$currentpage = Uri::getInstance()->toString();

		
		if($app->isClient('site')):
		
		   $query = $db->getQuery(true);		   	
		   $query->select('*')->from($db->quoteName('#__approximate_load_time'))->where($db->quoteName('uri') .' = '.$db->quote($currentpage));
						$db->setQuery($query);
						$result = $db->loadObject();
		if($result->loadtime!==NULL){
			$fadetime = $result->loadtime;
		$excludedpages = $this->params->get("excluded");
		$mainpage = $this->params->get("mainpage");
		$flag = 0;
		if(preg_match('/'.$mainpage.'/', $currentpage))
		  $flag = 1;
		else{
		$ps = explode("|" , $excludedpages);
		
		
		foreach($ps as $page):
		    if(preg_match('/'.$page.'/', $currentpage) ){
			$flag = 1;
			break;
			}
		endforeach;
		}

		$loadbartype = $this->params->get('loadbartype');
      if($loadbartype!=0)
        if($excludedpages === NULL || ($config['sef']==1 && $flag==0))
		{	
		
	
	//	$doc->addStyleSheet(Uri::Base().'plugins/content/progressbar/assets/loadbar.css');
	$wa->registerAndUseStyle('loadbar', Uri::Base().'plugins/content/progressbar/assets/loadbar.css');
	$cssan = '
		
	@keyframes spFadeIn{from{opacity:0}to{opacity:1}}
	@keyframes spFadeInUp{0%{opacity:0;transform:translateY(20px)}100%{opacity:1;transform:translateY(0)}}
	@keyframes spFadeInDown{0%{opacity:0;transform:translateY(-20px)}100%{opacity:1;transform:translateY(0)}}
	@keyframes spZoomIn{0%{opacity:0;transform:scale3d(0.3, 0.3, 0.3)}100%{opacity:1}}
	@keyframes spRotateIn{from{transform-origin:center;transform:rotate3d(0, 0, 1, -45deg);opacity:0}to{transform-origin:center;transform:none;opacity:1}}
	@keyframes spPulse{from{opacity:0;transform:scale3d(1, 1, 1)}50%{opacity:0.5;transform:scale3d(1.05, 1.05, 1.05)}to{opacity:1;transform:scale3d(1, 1, 1)}}
	@keyframes spSpin{to{transform:rotate(360deg)}}@-webkit-keyframes grdAiguille{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}
	@keyframes grdAiguille{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
	@-webkit-keyframes ptAiguille{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}
	@keyframes ptAiguille{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
	@-webkit-keyframes loader1{0%{-webkit-transform:rotate(0deg)}100%{-webkit-transform:rotate(360deg)}}
	@keyframes loader1{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
	@-webkit-keyframes loader6{0%{-webkit-transform:rotate(0deg)}50%{-webkit-transform:rotate(180deg)}100%{-webkit-transform:rotate(180deg)}}
	@keyframes loader6{0%{transform:rotate(0deg)}50%{transform:rotate(180deg)}100%{transform:rotate(180deg)}}
	@keyframes rotate-360{from{-moz-transform:rotate(0);-ms-transform:rotate(0);-webkit-transform:rotate(0);transform:rotate(0)}to{-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
	@keyframes audioWave{25%{background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 2em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em}37.5%{background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 0.25em, 0.5em 2em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em}50%{background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 0.25em, 0.5em 0.25em, 0.5em 2em, 0.5em 0.25em, 0.5em 0.25em}62.5%{background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 2em, 0.5em 0.25em}75%{background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 2em}}
	@-webkit-keyframes effect-2{from{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes effect-2{from{-moz-transform:rotate(0deg);-ms-transform:rotate(0deg);transform:rotate(0deg)}to{-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);transform:rotate(360deg)}}
	@keyframes sequence1{0%{height:10px}50%{height:50px}100%{height:10px}}
	@keyframes sequence2{0%{height:20px}50%{height:65px}100%{height:20px}}
	@keyframes rot1{100%{transform:skew(-10deg) translateX(50px) rotate(405deg)}}
	@-webkit-keyframes rot1{100%{-webkit-transform:skew(-10deg) translateX(50px) rotate(405deg)}}
	@keyframes rot2{100%{transform:skew(-10deg) rotate(525deg)}}
	@-webkit-keyframes rot2{100%{-webkit-transform:skew(-10deg) rotate(525deg)}}
	@keyframes rot3{100%{transform:skew(-10deg) translateX(20px) translateY(-50px) rotate(645deg)}}
	@-webkit-keyframes rot3{100%{-webkit-transform:skew(-10deg) translateX(20px) translateY(-50px) rotate(645deg)}}
	@keyframes width{10%{width:10%}20%{width:20%}30%{width:30%}40%{width:40%}50%{width:50%}60%{width:60%}70%{width:70%}80%{width:80%}90%{width:90%}100%{width:100%}}
	
.sp-pre-loader{background:#FFFFFF;height:100%;left:0;position:fixed;top:0;width:100%;z-index:99999}

.sp-pre-loader .sp-loader-clock{
	border:3px solid #ec430f;
	border-radius:60px;bottom:0;height:80px;left:0;margin:auto;position:absolute;right:0;top:0;width:80px}
.sp-pre-loader .sp-loader-clock:after{content:"";position:absolute;background-color:#ec430f;top:2px;left:48%;height:38px;width:4px;border-radius:5px;-webkit-transform-origin:50% 97%;transform-origin:50% 97%;-webkit-animation:grdAiguille 2s linear infinite;animation:grdAiguille 2s linear infinite}
.sp-pre-loader .sp-loader-clock:before{content:"";position:absolute;background-color:#ec430f;top:6px;left:48%;height:35px;width:4px;border-radius:5px;-webkit-transform-origin:50% 94%;transform-origin:50% 94%;-webkit-animation:ptAiguille 12s linear infinite;animation:ptAiguille 12s linear infinite}

.sp-pre-loader .sp-loader-circle{position:absolute;height:80px;width:80px;border-radius:80px;border:3px solid fade(#ec430f, 70%);left:0;top:0;right:0;bottom:0;margin:auto;-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-animation:loader1 3s linear infinite;animation:loader1 3s linear infinite}
.sp-pre-loader .sp-loader-circle:after{content:"";position:absolute;top:-5px;left:20px;width:11px;height:11px;border-radius:10px;background-color:#ec430f}
.sp-pre-loader .sp-loader-bubble-loop{position:absolute;width:12px;height:12px;left:0;top:0;right:0;bottom:0;margin:auto;border-radius:12px;background-color:#ec430f;-webkit-transform-origin:50% 50%;transform-origin:50% 50%;-webkit-animation:loader6 1s ease-in-out infinite;animation:loader6 1s ease-in-out infinite}
.sp-pre-loader .sp-loader-bubble-loop:before{content:"";position:absolute;background-color:rgba(236, 67, 15, 0.5);top:0px;left:-25px;height:12px;width:12px;border-radius:12px}
.sp-pre-loader .sp-loader-bubble-loop:after{content:"";position:absolute;background-color:rgba(236, 67, 15, 0.5);top:0px;left:25px;height:12px;width:12px;border-radius:12px}
.sp-pre-loader .circle-two{bottom:0;height:100px;left:0;margin:auto;position:absolute;right:0;top:0;width:100px}
.sp-pre-loader .circle-two>span,.sp-pre-loader .circle-two>span:before,.sp-pre-loader .circle-two>span:after{content:"";display:block;border-radius:50%;border:2px solid #ec430f;position:absolute;top:50%;left:50%;-webkit-transform:translate(-50%, -50%);-moz-transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);-o-transform:translate(-50%, -50%);transform:translate(-50%, -50%)}
.sp-pre-loader .circle-two>span{width:100%;height:100%;top:0;left:0;border-left-color:transparent;-webkit-animation:effect-2 2s infinite linear;-moz-animation:effect-2 2s infinite linear;-ms-animation:effect-2 2s infinite linear;-o-animation:effect-2 2s infinite linear;animation:effect-2 2s infinite linear}
.sp-pre-loader .circle-two>span:before{width:75%;height:75%;border-right-color:transparent}
.sp-pre-loader .circle-two>span:after{width:50%;height:50%;border-bottom-color:transparent}
.sp-pre-loader .wave-two-wrap{position:absolute;margin:auto;left:0;right:0;top:50%;width:90px}
.sp-pre-loader .wave-two{margin:0;list-style:none;width:90px;position:relative;padding:0;height:10px}
.sp-pre-loader .wave-two li{position:absolute;width:2px;height:0;background-color:#ec430f;bottom:0}
.sp-pre-loader .wave-two li:nth-child(1){left:0;-webkit-animation:sequence1 1s ease infinite 0;animation:sequence1 1s ease infinite 0}
.sp-pre-loader .wave-two li:nth-child(2){left:15px;-webkit-animation:sequence2 1s ease infinite 0.1s;animation:sequence2 1s ease infinite 0.1s}
.sp-pre-loader .wave-two li:nth-child(3){left:30px;-webkit-animation:sequence1 1s ease-in-out infinite 0.2s;animation:sequence1 1s ease-in-out infinite 0.2s}
.sp-pre-loader .wave-two li:nth-child(4){left:45px;-webkit-animation:sequence2 1s ease-in infinite 0.3s;animation:sequence2 1s ease-in infinite 0.3s}
.sp-pre-loader .wave-two li:nth-child(5){left:60px;-webkit-animation:sequence1 1s ease-in-out infinite 0.4s;animation:sequence1 1s ease-in-out infinite 0.4s}
.sp-pre-loader .wave-two li:nth-child(6){left:75px;-webkit-animation:sequence2 1s ease infinite 0.5s;animation:sequence2 1s ease infinite 0.5s}
.sp-pre-loader .sp-loader-audio-wave{width:3em;height:2em;background:linear-gradient(#ec430f, #ec430f) 0 50%, linear-gradient(#ec430f, #ec430f) 0.625em 50%, linear-gradient(#ec430f, #ec430f) 1.25em 50%, linear-gradient(#ec430f, #ec430f) 1.875em 50%, linear-gradient(#ec430f, #ec430f) 2.5em 50%;background-repeat:no-repeat;background-size:0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em, 0.5em 0.25em;animation:audioWave 1.5s linear infinite;position:absolute;left:0;top:0;bottom:0;right:0;margin:auto}
.sp-pre-loader .sp-loader-with-logo{top:0;left:0;width:100%;height:100%;right:0;bottom:0;margin:auto;text-align:center;position:absolute;display:flex;justify-content:center;align-items:center}
.sp-pre-loader .sp-loader-with-logo .logo{display:inline-block;width:auto}
.sp-pre-loader .sp-loader-with-logo .line{background:#ec430f;height:5px;left:0;position:absolute;top:0}

	';
	//$wa->addInlineStyle($cssan);
			$codepiece ='jQuery(document).ready(function(){
				if(!jQuery("body").hasClass("sp-pre-loader")){
				jQuery("<div class=\'sp-pre-loader\'></div>").prependTo("body");
                var loadbar;
                loadbar	= '.$loadbartype.';
                console.log(loadbar);
                switch(loadbar)
                {
					case 1:
						 jQuery("<div class=\'sp-loader-circle\'></div>").appendTo(".sp-pre-loader");
						break;
						case 2:
					    jQuery("<div class=\'sp-loader-bubble-loop\'></div>").appendTo(".sp-pre-loader");
						break;
						case 3:
					   jQuery("<div class=\'wave-two-wrap\'><ul class=\'wave-two\'>'. str_repeat("<li></li>", 6).'</ul></div>").appendTo(".sp-pre-loader");
						break;
						case 4:
						 jQuery("<div class=\'sp-loader-audio-wave\'></div>").appendTo(".sp-pre-loader");
						break;
						case 5:
						 jQuery("<div class=\'circle-two\'></div>").appendTo(".sp-pre-loader");
						break;
						case 6:
    					jQuery("<div class=\'sp-loader-clock\'></div>").appendTo(".sp-pre-loader");
						break;
				}	
			
			  }				
			});';
			//$doc->addScriptDeclaration($codepiece);
			$wa->addInlineScript($codepiece);
			$fadetime *= 1000;
			$runloadbar = "
			
				jQuery(window).on('load', function () {
	
	jQuery('.sp-pre-loader').fadeOut(".$fadetime.", function () {
		jQuery(this).remove();
	});
});
			";
					//	$doc->addScriptDeclaration($runloadbar);
					$wa->addInlineScript($runloadbar);

		}
		}	
		endif;

	}
		
	



}
?>

