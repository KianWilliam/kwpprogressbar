<?php 

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Form\FormField;

//JHtml::_('behavior.formvalidator');
//class JFormFieldMtextarea extends JFormField{
class JFormFieldPtextarea extends FormField{


	protected $type = 'ptextarea';
	protected $rows = 10;
	protected $columns = 100;

	
	public function getInput()
	{
		

		$html = '<textarea  name="' . $this->name . '" id="' . $this->id . '"   class="form-control validate-uri"  aria-describedby="'.$this->id.'-desc">'.$this->value.'</textarea>';
		$html.="<div>Copy and paste the structure below:</div>";
		$html.="<div>|sitemap.html|home.html|contact.html|</div>";
		return $html;
	}

	public function getLabel() {
		//var_dump($this->_get('rows'));
		//var_dump($this);
		//return $this->getAttribute('label');
		return (string) $this->element['label'];
		
	}
   
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
document.formvalidator.setHandler('uri', function(value){
		
		regex=/^(\|?([a-zA-Z0-9\?\/\.\-\=&_:\s])+\|?)+$/;
	return regex.test(value);

	
})
</script>
