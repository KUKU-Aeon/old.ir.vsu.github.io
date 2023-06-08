<?php 

/**
* @package   Shortcode Ultimate
* @author    BdThemes http://www.bdthemes.com
* @copyright Copyright (C) BdThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

class Su_Shortcode_contact_form extends Su_Shortcodes {

    function __construct() {
        parent::__construct();
    }
    
    public static function contact_form( $atts = null, $content = null ) {
        $atts = su_shortcode_atts(array(
            'style'              => 'default',
            'email'              => '',
            'name'               => 'yes',
            'subject'            => 'yes',
            'submit_button_text' => '',
            'label'              => 'yes',
            'textarea_height'    => 120,
            'reset'              => 'no',
            'margin'             => '',
            'captcha'            => 'no',
            'scroll_reveal'      => '',
            'class'              => ''
        ), $atts, 'contact_form');

        $id            = uniqid('sucf');
        $config        = JFactory::getConfig();
        $margin        = ($atts['margin'] != '') ? 'margin: '. $atts['margin'] : ' margin: 0 0 25px 0';
        $return        = array();
        $fields        = "";
        $lang          = JFactory::getLanguage();
        $app           = JFactory::getApplication();
        $error         = false;
        $lang->load('plg_system_bdthemes_shortcodes', JPATH_ADMINISTRATOR);

        if ($atts['captcha'] == 'yes') {
            //google recaptcha check
            JPluginHelper::importPlugin('captcha');
            $dispatcher = JDispatcher::getInstance();
            $dispatcher->trigger('onInit','gr'.$id);
        }

        if ($atts['name']=='yes' && $atts['subject']=='yes') {
            $fields .= 'name-email-subject';
        } elseif ($atts['name']=='yes') {
           $fields .= 'name-email';
        }  elseif ($atts['subject']=='yes') {
           $fields .= 'email-subject';
        } else {
            $fields .= 'email';
        }

        if (isset($_POST['email'])) {
            $name     = ($_POST['name']) ? $_POST['name'] : 'Unknown';
            $email    = JStringPunycode::emailToPunycode($_POST['email']);
            $subject  = ($_POST['subject']) ? $_POST['subject'] : $config->get( 'fromname' );
            $message  = stripslashes($_POST['message']);
            $sitename = $app->get('sitename');
            $to       = ($atts['email']) ? $atts['email'] :  $config->get( 'mailfrom' );

            // Error message prited if spam form attack found
            $SpamErrMsg = "<p align=\"center\"><font color=\"red\">Malicious code content detected.</font><br><b>Your IP Number of <b>".getenv("REMOTE_ADDR")."</b> has been logged.</b></p>";

            // Check for Website URL's in the form input boxes as if we block website URLs from the form,
            // then this will stop the spammers wastignt ime sending emails
            if (preg_match("/http/i", "$name")) { echo "$SpamErrMsg"; exit(); } 
            if (preg_match("/http/i", "$email")) { echo "$SpamErrMsg"; exit(); } 
            if (preg_match("/http/i", "$message")) { echo "$SpamErrMsg"; exit(); } 

            // Patterm match search to strip out the invalid charcaters, this prevents the mail injection spammer 
            $pattern = '/(;|\||`|>|<|&|^|"|'."\n|\r|'".'|{|}|[|]|\)|\()/i'; // build the pattern match string 
                                        
            $name = preg_replace($pattern, "", $name); 
            $email = preg_replace($pattern, "", $email); 
            $message = preg_replace($pattern, "", $message);

            if(!empty($subject)){           
                $subject = $subject;
            } else {
                $subject =  $config->get( 'fromname' );
            }
            
            if (!$email) {
                $error = JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_VALID_EMAIL');
            } elseif (!$message) {
                $error = JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_VALID_MESSAGE');
            }

            if ($atts['captcha'] == 'yes') {
                $grr = $dispatcher->trigger('onCheckAnswer',$_POST['g-recaptcha-response']);
                if(!$grr[0]){
                    $error = JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_FORM_VALID_RECAPTCHA');
                }
            }

            $fullmsg  = "<html><body style='background-color: #f5f5f5; padding: 35px;'>";
            $fullmsg .= "<div style='max-width: 768px; margin: 35px auto; background-color: #fff; padding: 35px;'>";
            $fullmsg .= nl2br($message);
            $fullmsg .= "<br><br>";
            $fullmsg .= $name . "<br>";
            $fullmsg .= $email;
            $fullmsg .= "</div>";
            $fullmsg .= "</body></html>";

            if ($error != true) {
                $mail = JFactory::getMailer();
                $mail->addRecipient($to);
                $mail->addReplyTo($email, $name);
                $mail->setSender(array($to, $subject));
                $mail->setSubject($sitename . ': ' . $subject);
                $mail->isHTML(true);
                $mail->setBody($fullmsg);
                $sent = $mail->Send();

                if ($sent !== true) {
                   $return[] = $app->enqueueMessage($error . $sent->__toString(), 'warning');
                } else {
                    $return[] = $app->enqueueMessage(JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_FORM_SUCCESS'), 'message');
                    $return[] = $app->redirect(JRoute::_('index.php'));
                }
            } else {
                $return[] = $app->enqueueMessage($error, 'warning');
            }
        }

        suAsset::addFile('css', 'contact_form.css', __FUNCTION__);
        JHtml::_('behavior.keepalive');
        JHtml::_('behavior.formvalidator');


        $return[] = '
        <div'.su_scroll_reveal($atts).' class="su-contact-form '.$fields . su_ecssc($atts) . '" style="'.$margin.'" id="'.$id.'">
            <div class="su-form-wrapper">                                
                <div class="su-form">
                    <form name="contact_us_form" class="form-horizontal form-validate" action="' .JRoute::_('index.php'). '" method="post">
                        <div class="su-form-fields">
                            ';
                            if($atts['name']=='yes'){
                            $return[] ='
                                <div class="su-cf-group">
                                    ';
                                    $return[] =' 
                                    <div class="su-input-box">';
                                    if ($atts['label']=='yes') { $return[] ='<label for="name'.$id.'" class="su-form-label">'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_NAME') .'</label>';}                    
                                        $return[] ='<input type="text" placeholder="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_PH_NAME') .'" class="form-control cf-name required" name="name" id="name'.$id.'" />
                                    </div>
                                </div>';
                            }
                            $return[] ='
                            <div class="su-cf-group">
                                ';
                                                   
                                $return[] ='                             
                                <div class="su-input-box">';
                                if ($atts['label']=='yes') {$return[] ='<label for="email'.$id.'" class="su-form-label">'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_EMAIL') .'</label>';} 

                                    $return[] = '<input type="email" placeholder="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_PH_EMAIL') .'"  class="form-control cf-email required validate-email" name="email" id="email'.$id.'" />
                                </div>
                            </div>';
                            if($atts['subject']=='yes'){
                            $return[] ='
                                <div class="su-cf-group">
                                    ';
                                    $return[] =' 
                                    
                                    <div class="su-input-box">';
                                    if ($atts['label']=='yes') {$return[] ='<label for="subject'.$id.'" class="su-form-label">'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_SUBJECT') .'</label>';}                    
                                        $return[] = '<input type="text" placeholder="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_PH_SUBJECT') .'"  class="form-control cf-subject" name="subject" id="subject'.$id.'">
                                    </div>
                                </div>';
                        }
                        $return[] ='
                        </div>
                        <div class="su-cf-message-wrapper">
                            <div class="su-cf-message-content">';
                                $return[] ='                
                                <div class="su-input-box">';
                                if ($atts['label']=='yes') {$return[] ='<label for="message'.$id.'" class="su-form-label">'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_MESSAGE') .'</label>';}                    
                                    $return[] ='<textarea placeholder="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_PH_MESSAGE') .'"  class="form-control cf-message required" name="message" style="height: '.$atts['textarea_height'].'px;" id="message'.$id.'"></textarea>
                                </div>
                            </div>';

                            if ($atts['captcha'] == 'yes') {
                                $return[] = '
                                <div class="su-cf-captcha-wrapper">
                                    <div id="gr'.$id.'"></div>
                                </div>';
                            }

                            $return[] ='<div class="su-cf-submit-wrapper">
                                <div class=" submit-button">';
                                    if ($atts['submit_button_text']) {
                                        $return[] ='<input name="contact_us_submit" class="btn btn-primary" type="submit" value="'. $atts['submit_button_text'] .'" />';}   
                                    else { 
                                        $return[] ='<input name="contact_us_submit" class="btn btn-primary" type="submit" value="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_SEND') .'" />';}                 
                                   
                                    if($atts['reset']=='yes'){
                                        $return[] ='<input name="contact_us_reset" class="btn btn-warning" type="reset" value="'. JText::_('PLG_SYSTEM_BDTHEMES_SHORTCODES_CONTACT_FORM_RESET') .'" />';
                                    }
                                    $return[] = '<input type="hidden" name="return" value="' .JRoute::_('index.php'). '" />';
                                    $return[] = JHtml::_('form.token');
                                    $return[] ='
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>';

        return implode('', $return);
    }


}