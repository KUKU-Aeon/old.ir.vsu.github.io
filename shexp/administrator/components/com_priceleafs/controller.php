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
 * Главный контроллер компонента Priceleaf. Данный контроллер вызовет из папки controllers файл priceleafs он то и вызовет всё остальное модель вид.
 */
class PriceleafsController extends JControllerLegacy
{

//Возвращение способа отображения, кешируемый или нет
	public function display($cachable = false, $urlparams = false)
	{
	
//Добавление файла помощи и пунктов навигации, /helpers/priceleafs.php
//что бы пользователь мог перемещаться по страницам компонента, всё меню будет выводиться 
//в файле helpers.
		require_once JPATH_COMPONENT.'/helpers/priceleafs.php';

		$view   = $this->input->get('view', 'priceleafs');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Проверка формы редактирования
		if ($view == 'priceleaf' && $layout == 'edit' && !$this->checkEditId('com_priceleafs.edit.priceleaf', $id)) {
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_priceleafs&view=priceleafs', false));

			return false;
		}

		parent::display();

		return $this;
	}
}