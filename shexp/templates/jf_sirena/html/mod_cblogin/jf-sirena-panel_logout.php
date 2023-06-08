<?php
/**
* Community Builder (TM)
* @version $Id: $
* @package CommunityBuilder
* @copyright (C) 2004-2016 www.joomlapolis.com / Lightning MultiCom SA - and its licensors, all rights reserved
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

JHtml::_( 'behavior.keepalive' );

?>
<?php echo modCBLoginHelper::getPlugins( $params, $type, 'beforeForm' ); ?>
<form action="<?php echo $_CB_framework->viewUrl( 'logout', true, null, 'html', $secureForm ); ?>" method="post" id="login-form" class="form-vertical cbLogoutForm">
	<input type="hidden" name="option" value="com_comprofiler" />
	<input type="hidden" name="view" value="logout" />
	<input type="hidden" name="op2" value="logout" />
	<input type="hidden" name="return" value="B:<?php echo $logoutReturnUrl; ?>" />
	<input type="hidden" name="message" value="<?php echo (int) $params->get( 'logout_message', 0 ); ?>" />
	<?php echo cbGetSpoofInputTag( 'logout' ); ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'start' ); ?>
	<?php if ( $preLogoutText ) { ?>
		<div class="pretext <?php echo htmlspecialchars( $templateClass ); ?>">
			<?php echo $preLogoutText; ?>
		</div>
	<?php } ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'almostStart' ); ?>
	<?php if ( (int) $params->get( 'show_avatar', 1 ) ) { ?>
		<div class="jf_cblogin_profilebox">
			<div class="jf_cblogin_cover" style="background-image:url(<?php echo $cbUser->getField( 'canvas', null, 'csv', 'none', 'profile', 0, true ); ?>)"></div>
			<?php echo $cbUser->getField( 'avatar', null, 'html', 'none', 'profile', 0, true ); ?>
			<div class="jf_cblogin_name"><?php echo $cbUser->replaceUserVars( CBTxt::T( '[formatname]' ) ); ?><i class="material-icons">arrow_drop_down</i></div>
		</div>
		<?php if ( $profileViewText || $profileEditText || $showPrivateMessages || $showConnectionRequests ) { ?>
		<ul class="jf_cblogin_profilemenu">
			<?php if ( $profileViewText ) { ?>
			<li>
				<a href="<?php echo $_CB_framework->userProfileUrl(); ?>"<?php echo ( $styleProfile ? ' class="' . htmlspecialchars( $styleProfile ) . '"' : null ); ?>>
					<?php if ( $params->get( 'icon_show_profile', 0 ) ) { ?><i class="material-icons">person</i><?php } ?>
					<?php echo $profileViewText; ?>
				</a>
			</li>
			<?php } ?>
			<?php if ( $profileEditText ) { ?>
			<li>
				<a href="<?php echo $_CB_framework->userProfileEditUrl(); ?>"<?php echo ( $styleProfileEdit ? ' class="' . htmlspecialchars( $styleProfileEdit ) . '"' : null ); ?>>
					<?php if ( $params->get( 'icon_edit_profile', 0 ) ) { ?><i class="material-icons">edit</i><?php } ?>
					<?php echo $profileEditText; ?>
				</a>
			</li>
			<?php } ?>
			<?php if ( $showPrivateMessages ) { ?>
			<li>
				<a href="<?php echo $privateMessageURL; ?>"<?php echo ( $stylePrivateMsgs ? ' class="' . htmlspecialchars( $stylePrivateMsgs ) . '"' : null ); ?>>
					<?php if ( $params->get( 'show_pms_icon', 0 ) ) { ?><i class="material-icons">email</i><?php } ?>
					<?php echo CBTxt::T( 'Private Messages' ); ?>
					<?php if ( $newMessageCount ) { ?>
						<div class="jf_cblogin_noty">
							<?php echo ( $newMessageCount == 1 ? CBTxt::T( 'COUNT', '[count]', array( '[count]' => $newMessageCount ) ) : CBTxt::T( 'COUNT', '[count]', array( '[count]' => $newMessageCount ) ) ); ?>
						</div>
					<?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if ( $showConnectionRequests ) { ?>
			<li>
				<a href="<?php echo $_CB_framework->viewUrl( 'manageconnections' ); ?>"<?php echo ( $styleConnRequests ? ' class="' . htmlspecialchars( $styleConnRequests ) . '"' : null ); ?>>
					<?php if ( $params->get( 'show_connection_notifications_icon', 0 ) ) { ?><i class="material-icons">group_add</i><?php } ?>
					<?php echo CBTxt::T( 'Connection Requests' ); ?>
					<?php if ( $newConnectionRequests ) { ?>
						<div class="jf_cblogin_noty">
							<?php echo ( $newConnectionRequests == 1 ? CBTxt::T( 'COUNT', '[count]', array( '[count]' => $newConnectionRequests ) ) : CBTxt::T( 'COUNT', '[count]', array( '[count]' => $newConnectionRequests ) ) ); ?>
						</div>
					<?php } ?>
				</a>
			</li>
			<?php } ?>
			<li>
				<button type="submit" name="Submit">
					<i class="material-icons">restore</i><?php echo htmlspecialchars( CBTxt::T( 'Log out' ) ); ?>
				</button>
			</li>
		</ul>
		<?php } ?>
	<?php } ?>

	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'almostEnd' ); ?>
	<?php if ( $postLogoutText ) { ?>
		<div class="posttext <?php echo htmlspecialchars( $templateClass ); ?>">
			<p><?php echo $postLogoutText; ?></p>
		</div>
	<?php } ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'end' ); ?>
</form>
<?php echo modCBLoginHelper::getPlugins( $params, $type, 'afterForm' ); ?>