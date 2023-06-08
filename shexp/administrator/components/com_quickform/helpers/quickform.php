<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('_JEXEC') or die;

class QuickFormHelper
{
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_quickform';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, $assetName));
		}

		return $result;
	}
	
	public static function getStatus()
	{
		return array(
			 array ( "value"=>"-1", "text"=>JText::_('Select status')),
			 array ( "value"=>"0", "text"=>JText::_('new')),
			 array ( "value"=>"1", "text"=>JText::_('underway')),
			 array ( "value"=>"2", "text"=>JText::_('Achieved')),
		 );
	}
	
	public static function coder($html, $vector='c')
	{
		$arr1 = array(
			 '<input name="svz" type="text" value="',
			 '" class="inp_svz"  title=',
			 '<a href="javppfascript:void(0)" oncppflick="fsvz(this)" class="opt_svz" title=',
			 '<td class="l_td">'.JText::_( 'JFIELD_TITLE_DESC' ),
			 'oo',
			 '</td><td class="c_td"><input name="sel" type="text" value="',
			 '<a href="javppfascript:void(0)" oncppflick="addOption(this)">',
			 '<span style="font-weight: bold;font-size: 16px;">+</span></a>',
			 '<a href="javppfascript:void(0)" oncppflick="u_sbut(this)">',
			 '<span class="sbut"',
			 '▲</span></a>',
			 '<a href="javppfascript:void(0)" oncppflick="d_sbut(this)">',
			 '▼</span></a><a href="javppfascript:void(0)" oncppflick="removep(this.parentNode.parentNode)">',
			 '<span>'. (JText::_( 'JTOOLBAR_DELETE' )).'</span>',
			 '</a><div style="clear:both"></div>',
			 '</span><a href="javppfascript:void(0)" oncppflick="toglit(this)">',
			 '<tr><td class="l_td"><br /></td><td class="c_td"></td><td class="r_td"></td></tr>',
			 '<div><em><a href="javppfascript:void(0)" oncppflick="fsvz(this)" class="opt_svz" title="',
			 ''. JText::_( 'Attach a related field' ).'">c</a></em>',
			 JText::_( 'Insert id other form fields to be displayed' ),
			 '<input name="sop" type="text" value="',
			 '>▲</span><span oncppflick="div_mave(this,\'down\')"',
			 '>▼</span><input name="mf" type="text" value="',
			 '<a href="javppfascript:void(0)" oncppflick="chen_modifer(this)" class="plusmn"',
			 '</a><input name="pop" type="text" value="',
			 'class="opt_price" />',
			 '<a href="javppfascript:void(0)" oncppflick="div_del(this)" class="opt_del">x</a></div>',
			 ' style="visibility: hidden;">',
			 '<span>'. (JText::_( 'JTOOLBAR_DELETE' )).'</span>',
			 '</td><td class="r_td"><span class="togl">',
			 'class="inp_opt"><span oncppflick="div_mave(this,\'up\')"',
			 'style="visibility: hidden;"',
			 '<div style="clear: both;"><div>',
			 '</div><span class="ch_block"><input name="cbx" type="checkbox" value="',
			 '<span class="inp_block"></span>',
			 '<input name="inp" type="text" value="',
			 '</td><td class="r_td">',
			 'class="opt_modifer">',
			 'class="opt_price">',
			 '<div style="float:left;"><input name="mf" type="text" value=',
			 '</td><td class="r_td">',
			 '</span></td><td class="c_td">',
			 '<input name="ckb" type="text" value=',
			 '<textarea name="inp" ',
			 'class="inp_sel">',
			 '</a><div style="clear: both; display: none;"><div><em>',
			 'oncppflick="md_red(this)"',
			 'style="color: red;"',
			 '</td></tr><tr>',
			 'class="opt_price" style="margin:0 10px;">',
			 '<a href="javppfascript:void(0)" oncppflick="u_sbut(this)">',
			 '>▲</span></a><a href="javppfascript:void(0)" oncppflick="d_sbut(this)">',
			 '>▼</span></a><a href="javppfascript:void(0)" oncppflick="removep(this.parentNode.parentNode)"><span>',
			 'style="display: none;">',
			 'class="inp_ch" style="width: 300px;">',
			 'class="opt_price" style="margin-top: 0px; margin-right: 10px; margin-bottom: 0px; margin-left: 10px',
			 'class="inp_ch" style="width: 175px;">',
			 '</a><div style="clear:both"><div><em>',
			 '" checked="checked"></span>',
			 '<tr><td class="l_td"><br></td><td class="c_td">',
			 '<td class="l_td"></td><td class="c_td">',
			 '<td class="l_td"></td><td class="c_td"><span class="block_price">'
		 );
		 $n=0;
		 foreach($arr1 as $ar){
			 $arr2[]='{'.$n.'}';$n++;
		 }
		 if($vector=='c') return str_replace($arr1,$arr2, $html);
		 elseif($vector=='a') return $arr1;
		 else return str_replace($arr2,$arr1, $html);
	}
	
}
