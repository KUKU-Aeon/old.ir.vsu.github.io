<?php
/**
* @package		Joomla
* @Copyright ((c) bigemot.ru
* @license    GNU/GPL
*/
defined('JPATH_PLATFORM') or die;

class JFormFieldDonation extends JFormField
{
    protected $type = 'donation';

    protected function getInput()
    {
        $donation_code = '<script type="text/javascript">window.addEvent(\'domready\', function() {if($(\'.configuration\'))$(\'.configuration\').innerHTML=\'QuickForm\';$(\'jform_cod\').getParent().style.visibility=($(\'jform_display2\').checked)?\'\':\'hidden\';$(\'jform_cod-lbl\').getParent().style.visibility=($(\'jform_display2\').checked)?\'\':\'hidden\';$(\'qflinck\').style.visibility=($(\'jform_display2\').checked)?\'\':\'hidden\';$$(\'#jform_display input\').addEvent(\'click\', function() {$(\'jform_cod\').getParent().style.visibility=(this.id==\'jform_display2\')?\'\':\'hidden\';$(\'jform_cod-lbl\').getParent().style.visibility=(this.id==\'jform_display2\')?\'\':\'hidden\';$(\'qflinck\').style.visibility=($(\'jform_display2\').checked)?\'\':\'hidden\';});$(\'jform_cod-lbl\').innerHTML=$(\'jform_cod-lbl\').innerHTML;});</script>';

        return $donation_code.'<a href="http://juice-lab.ru/dev/components/3-quickform-3" target="_blank" id="qflinck">'.JText::_('Получите код на сайте').' juice-lab.ru</a>';
    }

    protected function getLabel()
    {
        return;
    }


}
 ?>