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
<form action="<?php echo $_CB_framework->viewUrl( 'login', true, null, 'html', $secureForm ); ?>" method="post" id="login-form-sirena" class="form-inline cbLoginForm">
	<input type="hidden" name="option" value="com_comprofiler" />
	<input type="hidden" name="view" value="login" />
	<input type="hidden" name="op2" value="login" />
	<input type="hidden" name="return" value="B:<?php echo $loginReturnUrl; ?>" />
	<input type="hidden" name="message" value="<?php echo (int) $params->get( 'login_message', 0 ); ?>" />
	<input type="hidden" name="loginfrom" value="<?php echo htmlspecialchars( ( defined( '_UE_LOGIN_FROM' ) ? _UE_LOGIN_FROM : 'loginmodule' ) ); ?>" />
	<?php echo cbGetSpoofInputTag( 'login' ); ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'start' ); ?>
	<?php if ( $preLogintText ) { ?>
		<div class="pretext <?php echo htmlspecialchars( $templateClass ); ?>">
			<?php echo $preLogintText; ?>
		</div>
	<?php } ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'almostStart' ); ?>
	<?php if ( $loginMethod != 4 ) { ?>
		<div class="userdata">
			<div id="form-login-username-sirena" class="control-group">
				<div class="controls">
					<?php if ( in_array( $showUsernameLabel, array( 1, 2, 3, 5 ) ) ) { ?>
						<?php if ( in_array( $showUsernameLabel, array( 2, 3, 5 ) ) ) { ?>
							<?php if ( $showUsernameLabel == 3 ) { ?>
								<label for="modlgn-username-sirena"><?php echo htmlspecialchars( $userNameText ); ?></label>
							<?php } ?>
							<div class="input-prepend input-append">
								<span class="add-on">
									<span class="<?php echo htmlspecialchars( $templateClass ); ?>">
										<span class="cbModuleUsernameIcon fa fa-user" title="<?php echo htmlspecialchars( $userNameText ); ?>"></span>
									</span>
								</span>
								<input id="modlgn-username-sirena" type="text" name="username" class="<?php echo ( $styleUsername ? htmlspecialchars( $styleUsername ) : 'input-small' ); ?>" size="<?php echo $usernameInputLength; ?>"<?php echo ( in_array( $showUsernameLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( $userNameText ) . '"' : null ); ?> />
								<?php if ( $showForgotLogin ) { ?>
									<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
								<?php } ?>
							</div>
						<?php } else { ?>
							<label for="modlgn-username-sirena" class="control-label">
								<?php if ( in_array( $showUsernameLabel, array( 1, 3 ) ) ) { ?>
									<?php echo htmlspecialchars( $userNameText ); ?>
								<?php } ?>
							</label>
							<input id="modlgn-username-sirena" type="text" name="username" class="<?php echo ( $styleUsername ? htmlspecialchars( $styleUsername ) : 'input-medium' ); ?>" size="<?php echo $usernameInputLength; ?>"<?php echo ( in_array( $showUsernameLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( $userNameText ) . '"' : null ); ?> />
							<?php if ( $showForgotLogin ) { ?>
								<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<input id="modlgn-username-sirena" type="text" name="username" class="<?php echo ( $styleUsername ? htmlspecialchars( $styleUsername ) : 'input-medium' ); ?>" size="<?php echo $usernameInputLength; ?>"<?php echo ( in_array( $showUsernameLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( $userNameText ) . '"' : null ); ?> />
						<?php if ( $showForgotLogin ) { ?>
							<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<div id="form-login-password-sirena" class="control-group">
				<div class="controls">
					<?php if ( in_array( $showPasswordLabel, array( 1, 2, 3, 5 ) ) ) { ?>
						<?php if ( in_array( $showPasswordLabel, array( 2, 3, 5 ) ) ) { ?>
							<?php if ( $showPasswordLabel == 3 ) { ?>
								<label for="modlgn-passwd-sirena"><?php echo htmlspecialchars( CBTxt::T( 'Password' ) ); ?></label>
							<?php } ?>
							<div class="input-prepend input-append">
								<span class="add-on">
									<span class="<?php echo htmlspecialchars( $templateClass ); ?>">
										<span class="cbModulePasswordIcon fa fa-lock" title="<?php echo htmlspecialchars( CBTxt::T( 'Password' ) ); ?>"></span>
									</span>
								</span>
								<input id="modlgn-passwd-sirena" type="password" name="passwd" class="<?php echo ( $stylePassword ? htmlspecialchars( $stylePassword ) : 'input-small' ); ?>" size="<?php echo $passwordInputLength; ?>"<?php echo ( in_array( $showPasswordLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Password' ) ) . '"' : null ); ?>  />
								<?php if ( $showForgotLogin ) { ?>
									<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
								<?php } ?>
							</div>
						<?php } else { ?>
							<label for="modlgn-passwd-sirena" class="control-label">
								<?php if ( in_array( $showPasswordLabel, array( 1, 3 ) ) ) { ?>
									<?php echo htmlspecialchars( CBTxt::T( 'Password' ) ); ?>
								<?php } ?>
							</label>
							<input id="modlgn-passwd-sirena" type="password" name="passwd" class="<?php echo ( $stylePassword ? htmlspecialchars( $stylePassword ) : 'input-medium' ); ?>" size="<?php echo $passwordInputLength; ?>"<?php echo ( in_array( $showPasswordLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Password' ) ) . '"' : null ); ?>  />
							<?php if ( $showForgotLogin ) { ?>
								<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
							<?php } ?>
						<?php } ?>
					<?php } else { ?>
						<input id="modlgn-passwd-sirena" type="password" name="passwd" class="<?php echo ( $stylePassword ? htmlspecialchars( $stylePassword ) : 'input-medium' ); ?>" size="<?php echo $passwordInputLength; ?>"<?php echo ( in_array( $showPasswordLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Password' ) ) . '"' : null ); ?>  />
						<?php if ( $showForgotLogin ) { ?>
							<a class="jf_cblogin_remind jf_tip_e" href="<?php echo $_CB_framework->viewUrl( 'lostpassword', true, null, 'html', $secureForm ); ?>" title="<?php echo CBTxt::T( 'Forgot Login?' ); ?>" tabindex="-1">?</a>	
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<?php if ( count( $twoFactorMethods ) > 1 ) { ?>
				<div id="form-login-secretkey-sirena" class="control-group">
					<div class="controls">
						<?php if ( in_array( $showSecretKeyLabel, array( 1, 2, 3, 5 ) ) ) { ?>
							<?php if ( in_array( $showSecretKeyLabel, array( 2, 3, 5 ) ) ) { ?>
								<?php if ( $showSecretKeyLabel == 3 ) { ?>
									<label for="modlgn-secretkey-sirena"><?php echo htmlspecialchars( CBTxt::T( 'Secret Key' ) ); ?></label>
								<?php } ?>
								<div class="input-prepend input-append">
									<span class="add-on">
										<span class="<?php echo htmlspecialchars( $templateClass ); ?>">
											<span class="cbModuleSecretKeyIcon fa fa-star" title="<?php echo htmlspecialchars( CBTxt::T( 'Secret Key' ) ); ?>"></span>
										</span>
									</span>
									<input id="modlgn-secretkey-sirena" type="text" name="secretkey" class="<?php echo ( $styleSecretKey ? htmlspecialchars( $styleSecretKey ) : 'input-small' ); ?>" size="<?php echo $secretKeyInputLength; ?>"<?php echo ( in_array( $showSecretKeyLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Secret Key' ) ) . '"' : null ); ?> />
								</div>
							<?php } else { ?>
								<label for="modlgn-secretkey-sirena" class="control-label">
									<?php if ( in_array( $showSecretKeyLabel, array( 1, 3 ) ) ) { ?>
										<?php echo htmlspecialchars( CBTxt::T( 'Secret Key' ) ); ?>
									<?php } ?>
								</label>
								<input id="modlgn-secretkey-sirena" type="text" name="secretkey" class="<?php echo ( $styleSecretKey ? htmlspecialchars( $styleSecretKey ) : 'input-medium' ); ?>" size="<?php echo $secretKeyInputLength; ?>"<?php echo ( in_array( $showSecretKeyLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Secret Key' ) ) . '"' : null ); ?> />
							<?php } ?>
						<?php } else { ?>
							<input id="modlgn-secretkey-sirena" type="text" name="secretkey" class="<?php echo ( $styleSecretKey ? htmlspecialchars( $styleSecretKey ) : 'input-medium' ); ?>" size="<?php echo $secretKeyInputLength; ?>"<?php echo ( in_array( $showSecretKeyLabel, array( 4, 5 ) ) ? ' placeholder="' . htmlspecialchars( CBTxt::T( 'Secret Key' ) ) . '"' : null ); ?> />
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<?php if ( in_array( $showRememberMe, array( 1, 3 ) ) ) { ?>
				<div id="form-login-remember-sirena" class="control-group checkbox">
					<label for="modlgn-remember-sirena" class="control-label"><?php echo htmlspecialchars( CBTxt::T( 'Remember Me' ) ); ?></label>
					<input id="modlgn-remember-sirena" type="checkbox" name="remember" class="inputbox" value="yes"<?php echo ( $showRememberMe == 3 ? ' checked="checked"' : null ); ?> />
				</div>
			<?php } elseif ( $showRememberMe == 2 ) { ?>
				<input id="modlgn-remember-sirena" type="hidden" name="remember" class="inputbox" value="yes" />
			<?php } ?>
			<?php echo modCBLoginHelper::getPlugins( $params, $type, 'beforeButton', 'p' ); ?>
			<div id="form-login-submit-sirena" class="control-group">
				<div class="controls">
					<button type="submit" name="Submit" class="jf_cb_btn raised accent"<?php echo $buttonStyle; ?>>
						<?php if ( in_array( $showButton, array( 1, 2, 3 ) ) ) { ?>
							<span class="<?php echo htmlspecialchars( $templateClass ); ?>">
								<span class="cbModuleLoginIcon fa fa-sign-in" title="<?php echo htmlspecialchars( CBTxt::T( 'Sign In' ) ); ?>"></span>
							</span>
						<?php } ?>
						<?php if ( in_array( $showButton, array( 0, 1, 4 ) ) ) { ?>
							<?php echo htmlspecialchars( CBTxt::T( 'Sign In' ) ); ?>
						<?php } ?>
					</button>
				</div>
			</div>
			<?php echo modCBLoginHelper::getPlugins( $params, $type, 'afterButton', 'p' ); ?>
		</div>
	<?php } else { ?>
		<?php echo modCBLoginHelper::getPlugins( $params, $type, 'beforeButton', 'p' ); ?>
		<?php echo modCBLoginHelper::getPlugins( $params, $type, 'afterButton', 'p' ); ?>
	<?php } ?>
	<?php if ( $showRegister ) { ?>
		<ul id="form-login-links-sirena" class="unstyled">
			
				<li id="form-login-register-sirena">
					<a class="jf_cb_btn raised default" href="<?php echo $_CB_framework->viewUrl( 'registers', true, null, 'html', $secureForm ); ?>" style="margin-top:0">
						<?php if ( in_array( $params->get( 'show_newaccount', 1 ), array( 2, 3 ) ) ) { ?>
							<span class="<?php echo htmlspecialchars( $templateClass ); ?>">
								<span class="cbModuleRegisterIcon fa fa-edit" title="<?php echo htmlspecialchars( CBTxt::T( 'JF_UE_REGISTER', 'Create An Account' ) ); ?>"></span>
							</span>
						<?php } ?>
						<?php if ( in_array( $params->get( 'show_newaccount', 1 ), array( 1, 3 ) ) ) { ?>
							<?php echo CBTxt::T( 'JF_UE_REGISTER', 'Create An Account' ); ?>
						<?php } ?>
					</a>
				</li>
			
		</ul>
	<?php } ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'almostEnd' ); ?>
	<?php if ( $postLoginText ) { ?>
		<div class="posttext <?php echo htmlspecialchars( $templateClass ); ?>">
			<p><?php echo $postLoginText; ?></p>
		</div>
	<?php } ?>
	<?php echo modCBLoginHelper::getPlugins( $params, $type, 'end' ); ?>
</form>
<?php echo modCBLoginHelper::getPlugins( $params, $type, 'afterForm' ); ?>