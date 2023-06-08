<?php
/**
* @Copyright ((c) bigemot.ru
* @ http://bigemot.ru/
* @license    GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_ADMINISTRATOR.'/components/com_quickform/helpers/quickform.php';

class QuickForm
{
	function QuickForm($id,$html = ''){
		$db		= JFactory::getDBO();
		$db->setQuery('SELECT * FROM #__quickform WHERE published=1 AND id = '.(int)$id);
		$this->row = $db->loadObject();
		$this->id = (int)$id;
		if(!isset($this->rowOld))$this->rowOld=$this->row;
		
		if($this->row&&$this->row->settlement){
			$user = JFactory::getUser();
			$groups	= $user->getAuthorisedViewLevels();
			
			if(in_array($this->row->access, $groups)){
				$doc = JFactory::getDocument();
				$ver = new JVersion;
				if($ver->RELEASE>2.9){
					JHtmlBehavior::framework();
				}else{
					JHTML::_( 'behavior.mootools' );
				}
				$doc->addStylesheet(JURI::root(true)."/components/com_quickform/css/".$this->rowOld->qfcss);
				$doc->addScript(JURI::root(true)."/components/com_quickform/js/quickform.js");
				
				$lang = JFactory::getLanguage();
				$lang->load('com_quickform');
				
				$doc->addScriptDeclaration('var allthefieldsare="'.JText::_('COM_QF_NOT_ALL').'";var qfroot="'.JURI::root(true).'";');
				
				$arr=explode('</tr><tr>',QuickFormHelper::coder($this->row->settlement,'d'));
				foreach($arr as $ar){
					if(strpos($ar,'select</a></td>')!== false)$html.=$this->buildSelect($ar);
					elseif(strpos($ar,'checkbox</td>')!== false)$html.=$this->buildCheckbox($ar);
					elseif(strpos($ar,'email</td>')!== false)$html.=$this->buildEmail($ar);
					elseif(strpos($ar,'radio</a></td>')!== false)$html.=$this->buildRadio($ar);
					elseif(strpos($ar,'>text</td>')!== false)$html.=$this->buildText($ar);
					elseif(strpos($ar,'textarea</td>')!== false)$html.=$this->buildTextarea($ar);
					elseif(strpos($ar,'separator</td>')!== false)$html.=$this->buildSeparator($ar);
					elseif(strpos($ar,'submit</td>')!== false)$html.=$this->buildSubmit($ar);
					elseif(strpos($ar,'<td class="r_td">price</td>')!== false)$html.=$this->buildPrice($ar);
					elseif(strpos($ar,'<td class="r_td">emailback</td>')!== false)$html.=$this->buildBack($ar);
					elseif(strpos($ar,'<td class="r_td">calctext</td>')!== false)$html.=$this->buildCalctext($ar);
					elseif(strpos($ar,'<td class="r_td">file</td>')!== false)$html.=$this->buildFile($ar);
					elseif(strpos($ar,'>cloner<')!== false)$html.=$this->buildCloner($ar);
					elseif(strpos($ar,'>captcha<')!== false)$html.=$this->buildCaptcha($ar);
				}
			}else{
				$html .=JText::_( 'JERROR_ALERTNOAUTHOR' );
			}
		}else{
			$html .=JText::_( 'not found' );
		}
		$this->html = $html;
	}
	
	function buildSelect($pat,$row='') {
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qfselect"><label>'.$m[0].'</label><select name="sel[]" class="inputbox">';
		$opts=explode('</div><div>',$pat);
		$i=0;
		foreach($opts as $opt) {
			$value='';
//			if($this->rowOld->calc) {
				$vals=explode('input',$opt);
				foreach($vals as $val){
					if(strpos($val,'opt_modifer'))$value.=$val{strpos($val,'value="')+7};
				}
				
				preg_match('/([^"]+)(?=" class="opt_price)/', $opt, $o);
				$value.=trim($o?$o[0]:'');
//			}
			$cl = '';
			if(strpos($opt,'inp_svz')){
				preg_match('/([^"]+)(?=" class="inp_svz)/', $opt, $o);
				$cl ='class="qfsvz_'.trim($o?$o[0]:'').'"';
			}
			
			preg_match('/([^"]+)(?=" class="inp_opt")/', $opt, $m);
			$row.='<option value="'.$i.'_'.$value.'" '.$cl.'>'.$m[0].'</option>';
			$i++;
		}
		$row.='</select></div>';
		return $row;
	}
	
	function buildCheckbox($pat,$row='',$value='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
//		if($this->rowOld->calc) {
			$vals=explode('input',$pat);
			foreach($vals as $val){
				if(strpos($val,'opt_modifer'))$value.=$val{strpos($val,'value="')+7};
			}
				
			preg_match('/([^"]+)(?=" class="opt_price)/', $pat, $o);
			$value.=trim($o?$o[0]:'');
//		}
		static $i=0;
		preg_match('/([^"]+)(?=" class="inp_ch")/', $pat, $m);
		$row.='<div class="qfcheckbox"><label>'.$m[0].($validat?' *':'').'</label><input name="chbx['.$i.']" type="checkbox" class="'.$validat.'" value="'.$i.'_'.$value.'" '.((strpos($pat,'checked="checked"')!== false)?'checked="checked"':'').'/></div>';
		$i++;
		return $row;
	}
	
	function buildEmail($pat,$row='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qfemail"><label>'.$m[0].($validat?' *':'').'</label><input name="email[]" type="text" value="" class="inputbox'.$validat.'"></div>';
		return $row;
	}
	
	function buildRadio($pat,$row='') {
		static $a=1;
		$i=0;
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qfradio"><label>'.$m[0].'</label>';
		$opts=explode('</div><div>',$pat);
		$name='r'.$this->id.'_'.$a;$n=0;$a++;
		foreach($opts as $opt) {
			$value='';
//			if($this->rowOld->calc) {
				$vals=explode('input',$opt);
				foreach($vals as $val){
					if(strpos($val,'opt_modifer'))$value.=$val{strpos($val,'value="')+7};
				}
				
				preg_match('/([^"]+)(?=" class="opt_price)/', $opt, $o);
				$value.=trim($o?$o[0]:'');
//			}
			
			$cl = '';
			if(strpos($opt,'inp_svz')){
				preg_match('/([^"]+)(?=" class="inp_svz)/', $opt, $o);
				$cl =' class="qfsvz_'.trim($o?$o[0]:'').'"';
			}
			
			preg_match('/([^"]+)(?=" class="inp_opt")/', $opt, $m);
			$row.=$m[0].'<input type="radio" name="'.$name.'" value="'.$i.'_'.$value.'" '.(!$n?'checked="checked"':'').$cl.'>';
			$n++;
			$i++;
		}
		$row.='</div>';
		return $row;
	}
	
	function buildCloner($pat,$row='') {
		preg_match('/([^"]+)(?=" class="inp_len")/', $pat, $m);
		$len=(int)$m[0]?(int)$m[0]:1;
		preg_match('/([^"]+)(?=" class="inp_max")/', $pat, $m);
		$max=(int)$m[0];
		preg_match('/([^"]+)(?=" class="inp_clone")/', $pat, $m);
		if($id=(int)$m[0]){
			$this->QuickForm($id,'');
			$row.='<div class="qfclone qfclid'.$id.'"><div class="qfcloneone len_'.$len.(($len>1)?' qflong':'').'">'.$this->html.'<div class="qfclonep"><a href="javascript:void(0)" onClick="qfclonep(this,'.$max.');">+</a></div><div class="qfclonem"><a href="javascript:void(0)" onClick="qfclonem(this);">-</a></div><div class="qfclonesum'.((!$this->row->calc&&$len>1)?' hidden':'').'"></div></div></div>';
		}
		return $row;
	}
	
	function buildText($pat,$row='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qftext"><label>'.$m[0].($validat?' *':'').'</label><input name="qftext[]" type="text" value="" class="inputbox'.$validat.'"></div>';
		return $row;
	}
	
	function buildCalctext($pat,$row='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
//		if($this->rowOld->calc) {
			$vals=explode('input',$pat);
			foreach($vals as $val){
				if(strpos($val,'opt_modifer'))$value.=$val{strpos($val,'value="')+7};
			}
				
			preg_match('/([^"]+)(?=" class="opt_price2)/', $pat, $o);
			$value.=trim($o?$o[0]:'');
//		}
		preg_match('/([^"]+)(?=" class="inp_ch")/', $pat, $m);
		$row.='<div class="qftext"><label>'.$m[0].($validat?' *':'').'</label><input name="qfctext[]" type="text" value="0" class="inputbox'.$validat.'"><input type="hidden" value="'.$value.'" name="qfchtext[]"></div>';
		return $row;
	}
	
	function buildTextarea($pat,$row='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qftextarea"><label>'.$m[0].($validat?' *':'').'</label><textarea name="qftextarea[]" class="inputbox'.$validat.'"></textarea></div>';
		return $row;
	}
	
	function buildFile($pat,$row='',$validat='') {
		if(strpos($pat,'style="color: red'))$validat=' validat';
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qffile"><label>'.$m[0].($validat?' *':'').'</label><input name="qffile[]" type="file" value="" class="inputbox'.$validat.'"></div>';
		return $row;
	}
	
	function buildSeparator($pat,$row='') {
		preg_match('/([^>]+)(?=<\/textarea)/', $pat, $m);
		$row.=html_entity_decode($m[0]);
		return $row;
	}
	
	function buildSubmit($pat,$row='') {
		preg_match('/([^"]+)(?=" class="inp_sel")/', $pat, $m);
		$row.='<div class="qfsubmit"><label></label><input name="btn" type="button" value="'.$m[0].'" onclick="qfsubmit(this)"></div>';
		return $row;
	}
	
	function buildPrice($pat,$row='') {
		$row.='<div class="qfprice"><label>&nbsp;</label><span class="qfpriceinner"></span> <span>'.$this->rowOld->cur.'</span><input name="price" type="hidden" value=""><input name="start" type="hidden" value="'.$this->rowOld->price.'"></div>';
		return $row;
	}
	
	function buildBack($pat,$row='') {
		$row.='<div class="qfback"><label>'.JText::_( 'Send a copy of this message to your own address' ).'</label><input name="back" type="checkbox" value="1"></div>';
		return $row;
	}
	
	function buildCaptcha($pat,$row='') {
		$user = JFactory::getUser();
		if($user->get('guest')){
			$captchaplugin = JPluginHelper::getPlugin('captcha', 'recaptcha');
			$captchaparams = new JRegistry();
			$captchaparams->loadString($captchaplugin->params);
			$pubkey     = $captchaparams->get('public_key', '');
			$theme = $captchaparams->get('theme2', 'light');
			if (!$pubkey) $row.=JText::_('PLG_RECAPTCHA_ERROR_NO_PUBLIC_KEY');
			else $row.='<div class="qfcaptcha"><label>&nbsp;</label><div class="qf_recaptcha" data-sitekey="'.$pubkey.'" data-theme="'.$theme.'"></div></div>';
		}
		return $row;
	}
	
	function getQFlink() {
		$params = JComponentHelper::getParams('com_quickform');$cl='';
		if($params->get('display')=='2'&&trim($params->get('cod'))) return '<input name="qfcod" type="hidden" value="'.trim($params->get('cod')).'" />';
		elseif($params->get('display')=='1') $cl=' nfl';
		return '<input name="qfcod" type="hidden" value="" /><div class="qflink'.$cl.'"><a href="http://bigemot.ru" target="_blank">QuickForm</a></div>';
	}
	
	function getHTML() {
		$params=json_decode($this->rowOld->params, TRUE);
		return ('<script type="text/javascript">function qfCh() {return "1'. JSession::getFormToken().'";}</script><div class="qfblock"><form method="post" enctype="multipart/form-data">'.$this->html.'<input name="option" type="hidden" value="com_quickform" />  <input type="hidden" name="formul" value="'.$params['formul'].'" />
<input name="id" type="hidden" value="'.$this->rowOld->id.'" /><input name="task" type="hidden" value="form" />'.$this->getQFlink().'</form></div>');
	}

	function ajaxHTML() {
		return ('<div class="qfblockch">'.$this->html.'</div>');
	}
	
}