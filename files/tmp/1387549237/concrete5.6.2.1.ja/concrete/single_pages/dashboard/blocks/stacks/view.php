<?php	 defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php	 if ($this->controller->getTask() == 'view_details') { ?>

	<script type="text/javascript">
	
	ccm_stacksAddBlock = function() {
		ccm_openAreaAddBlock("Main", true, <?php	echo $stack->getCollectionID()?>);
	}
	
	ccm_parseBlockResponsePost = function(r) {
		if (r.task != 'update_groups') {
			$(".ccm-main-nav-edit-option").fadeIn(300);
		}
	}
	
	$(function() {
		CCM_EDIT_MODE = true; // override header_required
		ccm_editInit();
		$("#stackPermissions").dialog();
		$("#stackVersions").dialog();
	});
	
	</script>
	
	<style type="text/css">
	div.ccm-block {border: 2px dotted #efefef; clear: both; overflow: hidden; margin: 0px 0px 4px 0px; padding: 2px}
	div#ccm-stack-status-bar div#ccm-page-status-bar {position: static; height: auto; margin-bottom: 20px;}
	div#ccm-stack-status-bar div#ccm-page-status-bar div.ccm-page-status-bar-buttons {display: block; margin-top: 10px; position: static;}
	</style>
	
	<?php	echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper($stack->getCollectionName(), false, 'span10 offset1', false)?>
	<div class="ccm-pane-options">
		<a href="javascript:void(0)" onclick="ccm_stacksAddBlock()" class="btn small ccm-main-nav-edit-option"><?php	echo t('Add Block')?></a>
		<a class="btn small ccm-main-nav-edit-option" dialog-width="640" dialog-height="340" id="stackVersions" dialog-title="<?php	echo t('Version History')?>" href="<?php	echo REL_DIR_FILES_TOOLS_REQUIRED?>/versions.php?rel=SITEMAP&cID=<?php	echo $stack->getCollectionID()?>"><?php	echo t('Version History')?></a>

		<?php	 $cpc = new Permissions($stack); ?>
		
		<?php	 if ($cpc->canEditPagePermissions() && PERMISSIONS_MODEL == 'advanced') { ?>
			<a class="btn small ccm-main-nav-edit-option" dialog-width="580" dialog-append-buttons="true" dialog-height="420" dialog-title="<?php	echo t('Stack Permissions')?>" id="stackPermissions" href="<?php	echo REL_DIR_FILES_TOOLS_REQUIRED?>/edit_area_popup.php?cID=<?php	echo $stack->getCollectionID()?>&arHandle=Main&atask=groups"><?php	echo t('Permissions')?></a>
		<?php	 } ?>

		<?php	 if ($cpc->canDeletePage()) { ?>
			<a class="btn ccm-button-v2-right small ccm-main-nav-edit-option error" href="javascript:void(0)" onclick="if (confirm('<?php	echo t('Are you sure you want to remove this stack?')?>')) { window.location.href='<?php	echo $this->url('/dashboard/blocks/stacks/', 'delete', $stack->getCollectionID(), Loader::helper('validation/token')->generate('delete'))?>' }"><?php	echo t('Delete Stack')?></a>
		<?php	 } ?>

		<?php	
		$hasPendingPageApproval = false;
		$workflowList = PageWorkflowProgress::getList($stack);
		foreach($workflowList as $wl) {
			$wr = $wl->getWorkflowRequestObject(); 
			$wrk = $wr->getWorkflowRequestPermissionKeyObject(); 
			if ($wrk->getPermissionKeyHandle() == 'approve_page_versions') {
				$hasPendingPageApproval = true;
				break;
			}
		}

		if (!$hasPendingPageApproval) { 
			$vo = $stack->getVersionObject();
			if ($cpc->canApprovePageVersions()) {
				$publishTitle = t('Approve Changes');
				$pk = PermissionKey::getByHandle('approve_page_versions');
				$pk->setPermissionObject($stack);
				$pa = $pk->getPermissionAccessObject();
				if (is_object($pa) && count($pa->getWorkflows()) > 0) {
					$publishTitle = t('Submit to Workflow');
				}
			
				$token = '&' . Loader::helper('validation/token')->getParameter(); ?>
				<a style="margin-right: 8px; <?php	 if ($vo->isApproved()) { ?> display: none; <?php	 } ?>" href="javascript:void(0)" onclick="window.location.href='<?php	echo DIR_REL . "/" . DISPATCHER_FILENAME . "?cID=" . $stack->getCollectionID() . "&ctask=approve-recent" . $token?>'" class="btn btn-success small ccm-main-nav-edit-option ccm-button-v2-right"><?php	echo $publishTitle?></a>
			<?php	
			}		
		}
		?>
	</div>
	<div class="ccm-pane-body ccm-pane-body-footer clearfix" id="ccm-stack-container">
		<?php	
			if (count($workflowList) > 0) { ?>
			<div id="ccm-stack-status-bar"></div>

			<script type="text/javascript">
			$(function() {

			<?php	 foreach($workflowList as $wl) { ?>
				<?php	 $wr = $wl->getWorkflowRequestObject(); 
				$wrk = $wr->getWorkflowRequestPermissionKeyObject(); 
				if ($wrk->getPermissionKeyHandle() == 'approve_page_versions') {
					$hasPendingPageApproval = true;
				}
				?>
				<?php	 $wf = $wl->getWorkflowObject(); ?>
				sbitem = new ccm_statusBarItem();
				sbitem.setCSSClass('<?php	echo $wr->getWorkflowRequestStyleClass()?>');
				sbitem.setDescription('<?php	echo $wf->getWorkflowProgressCurrentDescription($wl)?>');
				sbitem.setAction('<?php	echo $wl->getWorkflowProgressFormAction()?>');
				sbitem.enableAjaxForm();
				<?php	 $actions = $wl->getWorkflowProgressActions(); ?>
				<?php	 foreach($actions as $act) { ?>
					btn = new ccm_statusBarItemButton();
					btn.setLabel('<?php	echo $act->getWorkflowProgressActionLabel()?>');
					btn.setCSSClass('<?php	echo $act->getWorkflowProgressActionStyleClass()?>');
					btn.setInnerButtonLeftHTML('<?php	echo $act->getWorkflowProgressActionStyleInnerButtonLeftHTML()?>');
					btn.setInnerButtonRightHTML('<?php	echo $act->getWorkflowProgressActionStyleInnerButtonRightHTML()?>');
					<?php	 if ($act->getWorkflowProgressActionURL() != '') { ?>
						btn.setURL('<?php	echo $act->getWorkflowProgressActionURL()?>');
					<?php	 } else { ?>
						btn.setAction('<?php	echo $act->getWorkflowProgressActionTask()?>');
					<?php	 } ?>
					<?php	 if (count($act->getWorkflowProgressActionExtraButtonParameters()) > 0) { ?>
						<?php	 foreach($act->getWorkflowProgressActionExtraButtonParameters() as $key => $value) { ?>
							btn.addAttribute('<?php	echo $key?>', '<?php	echo $value?>');
						<?php	 } ?>
					<?php	 } ?>
					sbitem.addButton(btn);
				<?php	 } ?>
				ccm_statusBar.addItem(sbitem);
			<?php	 } ?>
				ccm_statusBar.activate('ccm-stack-status-bar');
			});
			</script>

			<?php	 }  


		$a = Area::get($stack, 'Main');
		$bv = new BlockView();
		$bv->renderElement('block_area_header', array('a' => $a));	
		$bv->renderElement('block_area_header_view', array('a' => $a));	

		foreach($blocks as $b) {
			$bv = new BlockView();
			$bv->setAreaObject($a); 
			$p = new Permissions($b);
			if ($p->canViewBlock()) {
				$bv->renderElement('block_controls', array( 'a' => $a, 'b' => $b, 'p' => $p ));
				$bv->renderElement('block_header', array( 'a' => $a, 'b' => $b, 'p' => $p ));
				$bv->render($b);
				$bv->renderElement('block_footer');
			}
		}
		$bv->renderElement('block_area_footer_view', array('a' => $a));	
		print '</div>'; // instead  of loading block area footer view
	?>	
	</div>
	<?php	echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>

<?php	 } else { ?>

	<?php	echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Stacks'), t('Stacks give you a central place to stash blocks, where you can control their order, permissions, and even version them.<br><br>Add stacks to your site and you can update them in one place.'), 'span10 offset1');?>
		
	<h4><?php	echo t('Global Areas')?></h4>
	<div class="ccm-stack-content-wrapper">
	
	<?php	
	if (count($globalareas) > 0) { 
		foreach($globalareas as $st) { ?>

			<div class="ccm-stack">
				<a href="<?php	echo $this->url('/dashboard/blocks/stacks/view_details', $st->getCollectionID())?>"><?php	echo $st->getCollectionName()?></a>
			</div>
		
		<?php	
		}
	} else {
		print '<p>';
		print t('No global areas created yet.');
		print '</p>';	
	}
	?>
	
	</div>
		
	<h4><?php	echo t('Other Stacks')?></h4>
	<div class="ccm-stack-content-wrapper">
	<?php	
	if (count($useradded) > 0) { 
		foreach($useradded as $st) { ?>

			<div class="ccm-stack">
				<a href="<?php	echo $this->url('/dashboard/blocks/stacks/view_details', $st->getCollectionID())?>"><?php	echo $st->getCollectionName()?></a>
			</div>
		
		<?php	
		}
	} else {
		print '<p>';
		print t('No stacks have been added.');
		print '</p>';
	}
	?>
	</div>
		<h3><?php	echo t('Add Stack')?></h3>
		<form method="post" class="form-stacked" style="padding-left: 0px" action="<?php	echo $this->action('add_stack')?>">
		<?php	echo Loader::helper("validation/token")->output('add_stack')?>
		<div class="clearfix">
			<?php	echo Loader::helper("form")->label('stackName', t('Name'))?>
			<div class="input">
				<?php	echo Loader::helper('form')->text('stackName')?>
				<?php	echo Loader::helper("form")->submit('add', t('Add'))?>
		</div>
		</div>
		
		</form>
		
	<?php	echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper()?>

<?php	 } ?>