<!--
Priceleaf shop ��������� �������� ��������.
������ pro 2011.03.05
����� ����
Copyright (C) 2011 joomla-umnik
�������� GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
����������� ���� http://joomla-umnik.ru
-->
<?php
//������ �� ������� ��������� � �������
defined('_JEXEC') or die;

class TableOformlenie extends JTable
{
	/**
	 * �����������
	 *
	 * ��������� ������� ���� ������. ��� �� � ��� �� ����� ��������.
	 */
	function __construct(&$db) 
	{
		parent::__construct('#__priceleaf_zakaz', 'id', $db);
	}
}