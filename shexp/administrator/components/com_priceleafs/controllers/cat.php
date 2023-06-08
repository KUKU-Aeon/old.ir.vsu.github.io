<!--
Priceleaf pro (c1) компонент онлайн калькулятор.
Версия pro (c1) 2012.11.07
Автор Ваня
Copyright (C) 2012 joomla-umnik
Официальный сайт http://joomla-umnik.ru
-->

<?php
// Запрет к прямому доступу. Если кто то попытается обратиться к файлу напрямую, joomla выдаст пустую страницу.
defined('_JEXEC') or die;
 
/**
 * Класс контрорллера
 */
class PriceleafsControllerCat extends JControllerForm
{


//Метод переопределения, что бы проверить можно ли добавить новую запись.
	public function batch($model = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Установить модель Priceleaf
		$model = $this->getModel('Cat', '', array());

		// Предустановленная переадресация
		$this->setRedirect(JRoute::_('index.php?option=com_priceleafs&view=cats' . $this->getRedirectToListAppend(), false));

		return parent::batch($model);
	}
}