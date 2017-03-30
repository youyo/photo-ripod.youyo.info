
<?php	 $ih = Loader::helper('concrete/interface'); ?>
<?php	
$enabledVals = array('0' => t('No'), '1' => t('Yes'));
$secureVals = array('' => t('None'), 'SSL' => 'SSL', 'TLS' => 'TLS');
$form = Loader::helper('form');
?>
	

	<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('SMTP Method'), false, 'span12 offset2', false)?>
	<div class="ccm-pane-body">
	<form method="post" action="<?php	echo $this->url('/dashboard/system/mail/method', 'save_settings')?>" id="mail-settings-form">
	<fieldset>
	<legend><?php	echo t('Send Mail Method')?></legend>
	<div class="clearfix">
	<label></label>
	<div class="input">
	<ul class="inputs-list">
	<li><label><?php	echo $form->radio('MAIL_SEND_METHOD', 'PHP_MAIL', MAIL_SEND_METHOD)?> <span><?php	echo t('Default PHP Mail Function')?></span></label></li>
	<li><label><?php	echo $form->radio('MAIL_SEND_METHOD', 'SMTP', MAIL_SEND_METHOD)?> <span><?php	echo t('External SMTP Server')?></span></label></li>
	</ul>
	</div>
	<div>
	</fieldset>
	<fieldset id="ccm-settings-mail-smtp">
		<legend><?php	echo t('SMTP Settings')?></legend>
			<div class="clearfix">
				<?php	echo $form->label('MAIL_SEND_METHOD_SMTP_SERVER',t('Mail Server'));?>
				<div class="input">
					<?php	echo $form->text('MAIL_SEND_METHOD_SMTP_SERVER', Config::get('MAIL_SEND_METHOD_SMTP_SERVER'))?>
				</div>
			</div>
			<div class="clearfix">
				<?php	echo $form->label('MAIL_SEND_METHOD_SMTP_USERNAME',t('Username'));?>
				<div class="input">
					<?php	echo $form->text('MAIL_SEND_METHOD_SMTP_USERNAME', Config::get('MAIL_SEND_METHOD_SMTP_USERNAME'))?>
				</div>
			</div>
			<div class="clearfix">
				<?php	echo $form->label('MAIL_SEND_METHOD_SMTP_PASSWORD',t('Password'));?>
				<div class="input">
					<?php	echo $form->text('MAIL_SEND_METHOD_SMTP_PASSWORD', Config::get('MAIL_SEND_METHOD_SMTP_PASSWORD'))?>
				</div>
			</div>
			
			<div class="clearfix">
				<?php	echo $form->label('MAIL_SEND_METHOD_SMTP_ENCRYPTION',t('Encryption'));?>
				<div class="input">
					<?php	echo $form->select('MAIL_SEND_METHOD_SMTP_ENCRYPTION', $secureVals, Config::get('MAIL_SEND_METHOD_SMTP_ENCRYPTION'))?>
				</div>
			</div>
			<div class="clearfix">
				<?php	echo $form->label('MAIL_SEND_METHOD_SMTP_PORT',t('Port (Leave blank for default)'));?>
				<div class="input">
					<?php	echo $form->text('MAIL_SEND_METHOD_SMTP_PORT', Config::get('MAIL_SEND_METHOD_SMTP_PORT'))?>
				</div>
			</div>	
	</fieldset>	
	</div>
	<div class="ccm-pane-footer">
		<?php	echo $ih->submit(t('Save'), 'mail-settings-form','right','primary')?>
	</div>
	</form>
	
	</div>
	<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);?>
	
		<script type="text/javascript">
	ccm_checkMailSettings = function() {
		obj = $("input[name=MAIL_SEND_METHOD]:checked");
		if (obj.val() == 'SMTP') {
			$("#ccm-settings-mail-smtp").show();	
		} else {
			$("#ccm-settings-mail-smtp").hide();	
		}
	}

	$(function() {
		$("input[name=MAIL_SEND_METHOD]").click(function() {
			ccm_checkMailSettings();
		});
		ccm_checkMailSettings();	
	});

	</script>
