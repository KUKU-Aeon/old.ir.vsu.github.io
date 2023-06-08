<?php
// запрет прямого доступа
defined( '_JEXEC' ) or die;
//Статичный класс для создания кнопок печати и отправить ссылку по E-mail
class BlogIcons
{
    /**
     * Метод для добавления кнопки отправить по E-mail
     * @param $url
     * @param array $attribs
     * @return mixed
     */
    static function email( $url, $attribs = array() )
    {
        //Подключаем клласс помощник для отправки писем
        require_once( JPATH_SITE . '/components/com_mailto/helpers/mailto.php' );
        //ссылка для открытия формы в всплывающем окне
        $url = 'index.php?option=com_mailto&tmpl=component&link=' . MailToHelper::addLink( $url );
        //настройки высплывающего окна
        $status = 'width=400,height=350,menubar=yes,resizable=yes';
        //изображение кнопки печати
        $text = JHtml::_( 'image', 'system/emailButton.png', JText::_( 'JGLOBAL_EMAIL' ), NULL, true );
        //праметры кнопки
        $attribs['title'] = JText::_( 'JGLOBAL_EMAIL' );
        $attribs['onclick'] = "window.open(this.href,'win2','" . $status . "'); return false;";
        //возвращаем сформированную кнопку отправки по email
        return JHtml::_( 'link', JRoute::_( $url ), $text, $attribs );
    }
 
    /**
     * Метод для добавления кнопки печати
     * @param $url
     * @param array $attribs
     * @return mixed
     */
    static function print_popup( $url, $attribs = array() )
    {
        //добавляем ссылку которая сформирует окно печати
        $url .= '?tmpl=component&print=1&layout=default';
        //параметры окна печати
        $status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
        //Иконка печати
        $text = JHtml::_( 'image', 'system/printButton.png', JText::_( 'JGLOBAL_PRINT' ), NULL, true );
        //парамтры кнопки отправки
        $attribs['title'] = JText::_( 'JGLOBAL_PRINT' );
        $attribs['onclick'] = "window.open(this.href,'win2','" . $status . "'); return false;";
        $attribs['rel'] = 'nofollow';
        //возвращаем сформированную кнопку печати
        return JHtml::_( 'link', JRoute::_( $url ), $text, $attribs );
    }
}