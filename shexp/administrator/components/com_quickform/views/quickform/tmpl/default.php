<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

JFactory::getDocument()->addStyleSheet('components/com_quickform/helpers/style.css' );

?>
<script type="text/javascript">
  window.onload= function() {
		$$('.calcul').addEvent('click', function() {
			isCalc();
		});isCalc();delfsvz();
		$$('.page-title').each(function(el){
			el.innerHTML+=' <h7 style="font-size:12px;">from bigemot.ru</h7>';
		});
  };
	Joomla.submitbutton = function(task)
	{
		if (task == 'cancel' || document.forms.adminForm.title.value.length>1) {
						var input = document.forms.adminForm.elements, i = input.length-1;
						while(i--){
								if(input[i].type=='text')input[i].setAttribute("value", input[i].value);
								else if(input[i].type=='checkbox'&&input[i].checked)input[i].setAttribute("checked", "checked");
								else if(input[i].type=='checkbox')input[i].removeAttribute("checked");
								else if(input[i].type=='textarea')input[i].innerHTML=input[i].value;
						}
						var x=$('formtbl').innerHTML.split('onclick').join('oncppflick');
			document.forms.adminForm.settlement.value=x.split('javascript').join('javppfascript');
			Joomla.submitform(task, document.forms.adminForm);
		}
		else {
			alert('<?php echo JText::_('JGLOBAL_VALIDATION_FORM_FAILED');?>');
		}
	}
	function removep(elem) {
		var a= elem.parentNode ? elem.parentNode.removeChild(elem) : elem;
		up_but();
		return a;
	}
	if (typeof(jQuery) == 'undefined'){
		Object.prototype.clone = function() {
			var newObj = (this instanceof Array) ? [] : {};
			for (i in this) {
				if (i == 'clone') continue;
				if (this[i] && typeof this[i] == "object") {
					newObj[i] = this[i].clone();
				} else newObj[i] = this[i]
			} return newObj;
		};
	}
	function isCalc() {
		if($$('.calcul')[1].checked){
			$$('.opt_modifer').setStyle('display','none');
			$$('.opt_price').setStyle('display','none');
			$$('.opt_price2').setStyle('display','none');
			$$('.plusmn').setStyle('display','none');
			$$('.inp_ch').setStyle('width',300);
			$('showprice').setStyle('display','none');
		}else{
			$$('.opt_modifer').setStyle('display','');
			$$('.opt_price').setStyle('display','');
			$$('.opt_price2').setStyle('display','');
			$$('.plusmn').setStyle('display','');
			$$('.inp_ch').setStyle('width',175);
			$('showprice').setStyle('display','');
		}
	}
	function d_sbut(x) {
		var tr=x.parentNode.parentNode;
		tr.parentNode.insertBefore(tr.clone(), tr.getNext().getNext());
		removep(tr);
	}
	function u_sbut(x) {
		var tr=x.parentNode.parentNode;
		tr.parentNode.insertBefore(tr.clone(), tr.getPrevious());
		removep(tr);
	}
	function up_but() {
		var arr=$$('.sbut');
		arr.each(function(el){
			el.style.visibility='';
		});
		arr[0].style.visibility='hidden';
		arr[arr.length-1].style.visibility='hidden';
	}
	function chen_modifer(x) {
		var m=x.getPrevious();
		if(m.value=='+')m.value="-";
		else if(m.value=='-')m.value="=";
		else if(m.value=='=')m.value="*";
		else m.value="+";
	}
	function div_del(x) {
		var x=x.parentNode;
		var div=x.parentNode;
		div.removeChild(x);
		div_up(div);
	}
	function div_up(x) {
		var arr=x.getElementsByTagName('span');
		for(var n=0; n<arr.length; n++) {arr[n].style.visibility='';}
		arr[0].style.visibility='hidden';
		arr[arr.length-1].style.visibility='hidden';
	}
	function div_mave(x,d) {
		if(d=='up')x.parentNode.parentNode.insertBefore(x.parentNode.clone(), x.parentNode.getPrevious());
		else insertAfter(x.parentNode.clone(), x.parentNode.getNext());
		div_del(x);
	}
	function insertAfter(elem, refElem) {
    return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
	}
	function toglit(x) {
		var tr=x.parentNode.parentNode;
		if(tr.getElement('.togl').innerHTML=='v'){
			tr.getElement('.togl').innerHTML='<';
			tr.getElement('div').style.display='none';
		}else{
			tr.getElement('.togl').innerHTML='v';
			tr.getElement('div').style.display='';
		}
	}
	function md_red(x) {
		x.style.color=(x.style.color=='red')?'grey':'red';
	}
	function qfshowhide(x) {
		$(x).style.display=($(x).style.display=='none')?'':'none';
	}
	function fsvz(x) {
		x.parentNode.innerHTML='<input name="svz" type="text" value="" class="inp_svz"  title="<?php echo JText::_( 'Insert id other form fields to be displayed' ); ?>"/>';
		delfsvz();
	}
	function delfsvz() {
		$$('.inp_svz').addEvent('blur', function() {
			this.value==''?this.parentNode.innerHTML='<a href="javascript:void(0)" onclick="fsvz(this)" class="opt_svz" title="<?php echo JText::_( 'Attach a related field' ); ?>">c</a>':'';
		});
	}
	function addSelect(d) {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"><?php echo JText::_( 'JFIELD_TITLE_DESC' ); ?></td><td class="c_td"><input name="sel" type="text" value="" class="inp_sel" /><a href="javascript:void(0)" onclick="addOption(this)"><span style="font-weight: bold;font-size: 16px;">+</span></a><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td"><span class="togl">v</span><a href="javascript:void(0)" onclick="toglit(this)">'+d+'</a></td>';
		up_but();
	}
	function addOption(x) {
		var html='<div><em><a href="javascript:void(0)" onclick="fsvz(this)" class="opt_svz" title="<?php echo JText::_( 'Attach a related field' ); ?>">c</a></em><input name="sop" type="text" value="" class="inp_opt" /><span onclick="div_mave(this,\'up\')">▲</span><span onclick="div_mave(this,\'down\')">▼</span><input name="mf" type="text" value="+" class="opt_modifer" /><a href="javascript:void(0)" onclick="chen_modifer(this)" class="plusmn">&plusmn;</a><input name="pop" type="text" value="0" class="opt_price" /><a href="javascript:void(0)" onclick="div_del(this)" class="opt_del">x</a></div>';
		var input = document.forms.adminForm.elements, i = input.length-1;
		while(i--){
				if(input[i].type=='text')input[i].setAttribute("value", input[i].value);
		}
		x.parentNode.getElement('div').setStyle('display','').innerHTML+=html;
		x.parentNode.parentNode.getElement('.togl').innerHTML='v';
		div_up(x.parentNode.getElement('div'));isCalc();
	}
	function addCheckbox(d) {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"><?php echo JText::_( 'JFIELD_TITLE_DESC' ); ?><span onclick="md_red(this)">*</span></td><td class="c_td"><input name="ckb" type="text" value="" class="inp_ch" /><div style="float:left;"><input name="mf" type="text" value="+" class="opt_modifer" /><a href="javascript:void(0)" onclick="chen_modifer(this)" class="plusmn">&plusmn;</a><input name="pop" type="text" value="0" class="opt_price" style="margin:0 10px;" /></div><span class="ch_block"><input name="cbx" type="checkbox" value="" /></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">'+d+'</td>';
		up_but();isCalc();
	}
	function addInput(d) {
		var table=$('formtbl'), z='';
		var tr = table.insertRow(-1);
		if(d=='separator')var inp='<textarea name="inp" class="inp_sel">your code here...</textarea>';
		else if(d=='submit'){var inp='<input name="inp" type="text" value="" class="inp_sel" />'; z='<?php echo JText::_( 'JFIELD_TITLE_DESC' ); ?>';}
		else {var inp='<input name="inp" type="text" value="" class="inp_sel" />'; z='<?php echo JText::_( 'JFIELD_TITLE_DESC' ); ?><span onclick="md_red(this)">*</span>';}
		tr.innerHTML='<td class="l_td">'+z+'</td><td class="c_td">'+inp+'<span class="inp_block"></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">'+d+'</td>';
		up_but();
	}
	function addPrice() {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"></td><td class="c_td"><span class="block_price"><?php echo JText::_( 'Display of prices' ); ?></span><span class="inp_block"></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">price</td>';
		up_but();
	}
	function addback(d) {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"></td><td class="c_td"><span class="block_price"><?php echo JText::_( 'backemail' ); ?></span><span class="inp_block"></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">emailback</td>';
		up_but();
	}
	function addcaptcha(d) {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"></td><td class="c_td"><span class="block_price"><?php echo JText::_( 'captcha' ); ?></span><span class="inp_block"></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">captcha</td>';
		up_but();
	}
	function addcalctext(d) {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"><?php echo JText::_( 'JFIELD_TITLE_DESC' ); ?><span onclick="md_red(this)">*</span></td><td class="c_td"><input name="ckb" type="text" value="" class="inp_ch" /><div style="float:left;"><input name="mf" type="text" value="+" class="opt_modifer" /><a href="javascript:void(0)" onclick="chen_modifer(this)" class="plusmn">&plusmn;</a> <span class="plusmn">value*</span><input name="pop" type="text" value="1" class="opt_price2"/></div><span class="ch_block"></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td">'+d+'</td>';
		up_but();isCalc();
	}
	function cloner() {
		var table=$('formtbl');
		var tr = table.insertRow(-1);
		tr.innerHTML='<td class="l_td"></td><td class="c_td"><span class="inp_block2">form id: <input name="inp" type="text" value="" class="inp_clone" /> max: <input name="inp" type="text" value="" class="inp_max" title="<?php echo JText::_( 'QF_MAX' ); ?>" /> Qty: <input name="inp" type="text" value="" class="inp_len" title="<?php echo JText::_( 'QF_NUM' ); ?>" /></span><a href="javascript:void(0)" onclick="u_sbut(this)"><span class="sbut">▲</span></a><a href="javascript:void(0)" onclick="d_sbut(this)"><span class="sbut">▼</span></a><a href="javascript:void(0)" onclick="removep(this.parentNode.parentNode)"><span><?php echo (JText::_( 'JTOOLBAR_DELETE' )); ?></span></a><div style="clear:both"></div></td><td class="r_td" style="color:green">cloner</td>';
		up_but();
	}
	function qfForm() {
		var arr=['formtbl','radqf','qf21','mailtbl'];
		if(!$$('.calcul')[1].checked)arr[5]='showprice';
		arr.each(function(el){
			if(!$(el).style.display)$(el).style.display='none';
			else $(el).style.display='';
		});
		$$('.rtbtn a').each(function(el){
			if(el.className)el.className='';
			else el.className='activ';
		});
	}
</script>
<form action="index.php" method="post" name="adminForm">
  <div align="center" id="quickform">

    <div class="quickformInner">
      <div class="venz2"><span title="<?php	echo JText::_( 'Enter a comma Email Recipients' ); ?>">Email:</span> &nbsp;<input name="toemail" type="text" value="<?php 
			$params=json_decode($this->item->params, TRUE);
			$start=$this->item->price?$this->item->price:'0';
			if($this->item->toemail)$toemail=$this->item->toemail;
			else {
				$jAp = JFactory::getApplication();
				$toemail = $jAp->getCfg('mailfrom');
			}
			echo $toemail;
			?>"  class="inp_title"/><span id="qf21">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span title="<?php	echo JText::_( 'You can add your own styles to the folder' ).' '.JPATH_COMPONENT_SITE.'/css/'; ?>">CSS: </span><?php echo $this->lists['css'] ?> <?php echo JText::_( 'Calculator' ); ?>: &nbsp;<input name="calc" type="radio" value="1" <?php if ($this->item->calc)echo 'checked'; ?>  class="calcul"/> yes  <input name="calc" type="radio" value="0" <?php if (!$this->item->calc)echo 'checked'; ?>  class="calcul"/> no</span></div>
      <div class="venz"></div>
      <table width="100%">
        <tr>
          <td class="l_td"><?php echo JText::_( 'Entry title' ); ?></td>
          <td class="c_td"><input name="title" type="text" value="<?php echo $this->item->title ?>" class="inp_title" /></td>
          <td rowspan="2" class="r_td"><div class="rtbtn"><a class="activ" href="javascript:void(0)" onclick="qfForm()"><?php echo JText::_( 'Form' ); ?></a> / <a href="javascript:void(0)" onclick="qfForm()"><?php echo JText::_( 'Letter' ); ?></a></div><div id="radqf" class="radius"><a href="javascript:void(0)" onclick="addSelect('select')">select</a><a href="javascript:void(0)" onclick="addSelect('radio')">radio</a><a href="javascript:void(0)" onclick="addInput('submit')" title="<?php echo JText::_( 'Form submit button' ); ?>">submit</a><a href="javascript:void(0)" onclick="addCheckbox('checkbox')" title="<?php echo JText::_( 'Checkbox marked, showing pre.' ); ?>">checkbox</a><a href="javascript:void(0)" onclick="addInput('text')">text</a><a href="javascript:void(0)" onclick="addInput('email')" title="<?php echo JText::_( 'Different from the text that, if required, is being tested for validity email.' ); ?>">email</a><a href="javascript:void(0)" onclick="addInput('textarea')">textarea</a><a href="javascript:void(0)" onclick="addInput('separator')" title="<?php echo JText::_( 'Insert any html code or text' ); ?>">separator</a><a href="javascript:void(0)" onclick="addback('backemail')" title="<?php echo JText::_( 'Allows you to send a copy of the letter to the sender. You must have the email field in the form' ); ?>">backemail</a><a href="javascript:void(0)" title="<?php echo JText::_( 'different from the text that is being calculated' ); ?>" onclick="addcalctext('calctext')">calc-text</a><a href="javascript:void(0)" onclick="addInput('file')">file</a><a href="javascript:void(0)" onclick="cloner()">cloner</a><a href="javascript:void(0)" onclick="addcaptcha('captcha')">captcha</a><div style="clear:both"></div></div></td>
        </tr>
        <tr id="showprice">
          <td class="l_td"><?php echo JText::_( 'Starting price' ); ?></td>
          <td class="c_td"><input name="price" type="text" value="<?php echo $start ?>" class="inp_price" />&nbsp;&nbsp;&nbsp;<?php echo JText::_( 'Currency' ); ?>: <input name="cur" type="text" value="<?php echo $this->item->cur ?>" class="inp_cur" /><a href="javascript:void(0)" onclick="addPrice()" class="addprice" title="<?php echo JText::_( 'Displays the map in the form of price' ); ?>"><?php echo JText::_( 'insert' ); ?></a><br /><a href="javascript:void(0)" onclick="qfshowhide('formuls')"><?php echo JText::_( 'The formula calculator' ); ?>:</a><div id="formuls" style="display:none"><input name="params[formul]" type="radio" value="0" <?php if (!$params['formul'])echo 'checked'; ?>  class="calcf"/>. (st+=*-el) <?php echo JText::_( 'In the order of the elements' ); ?><br /><input name="params[formul]" type="radio" value="1" <?php if ($params['formul']==1)echo 'checked'; ?>  class="calcf"/>. (st*mul+sum) <?php echo JText::_( 'Start multiplied by the multipliers, then the product is added to the sum of the terms' ); ?><br /><input name="params[formul]" type="radio" value="2" <?php if ($params['formul']==2)echo 'checked'; ?>  class="calcf"/>. (st+sum)*mul <?php echo JText::_( 'By starting the summands are added, and then the sum is multiplied by the multiplier' ); ?></div></td>
        </tr>
      </table>
      <?php if (!$this->item->settlement){ ?>
      <table width="100%" id="formtbl">
        <tr><td class="l_td"><br /></td><td class="c_td"></td><td class="r_td"></td></tr>
      </table>
      <?php 
			} else { 
				echo '<table width="100%" id="formtbl">'.str_replace(array('oncppflick','javppfascript'),array('onclick','javascript'),QuickFormHelper::coder($this->item->settlement,'d')).'</table>';
			}
			?>
      <table width="100%" id="mailtbl" style="display:none">
        <tr><td class="l_td">before</td><td class="c_td">
        <textarea name="params[mailare1]" class="inp_sel2"><?php echo $params['mailare1'] ?></textarea>
        </td><td class="r_td"></td></tr>
        <tr><td class="l_td">template</td><td class="c_td">
        <select name="params[tmpl]" style="padding:3px 5px;">
          <option value="default" <?php if ($params['tmpl']!='json')echo 'selected'; ?>>default</option>
          <option value="json" <?php if ($params['tmpl']=='json')echo 'selected'; ?>>json</option>
        </select>
        </td><td class="r_td"></td></tr>
        <tr><td class="l_td">after</td><td class="c_td">
        <textarea name="params[mailare2]" class="inp_sel2"><?php echo $params['mailare2'] ?></textarea>
        </td><td class="r_td"></td></tr>
      </table>
    </div>
    <div style="width:1000px; background-color:#FFFFFF; padding:10px 20px;">
      <div class="venz"></div>
    </div>
  </div>
  <input type="hidden" name="settlement" value="" />
  <input type="hidden" name="option" value="com_quickform" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="id" value="<?php echo $this->item->id ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
