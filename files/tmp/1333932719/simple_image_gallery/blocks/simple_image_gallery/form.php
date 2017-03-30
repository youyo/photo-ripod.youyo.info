<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<style>
	#galleryOptions label { display: inline; }
	#galleryOptions input { width: 25px; }
	.galleryOptionField { display: inline; margin-right: 15px; }
	#galleryOptions { float: left; padding-bottom: 15px; }

	hr.clear { clear: both; }
</style>

<strong>File Set:</strong>
<select id="fsID" name="fsID">
	<option value="0">Loading...</option>
</select>

<hr class="clear" />

<table id="galleryOptions" border="0">
	<tr>
		<td align="right"><?php  echo $form->label('displayColumns', 'Display Columns:'); ?></td>
		<td align="left"><span class="galleryOptionField"><?php  echo $form->text('displayColumns', $displayColumns); ?></span></td>
		<td align="right"><span><?php  echo $form->label('thumbWidth', 'Thumbnail Width:'); ?></span></td>
		<td align="left"><span class="galleryOptionField"><?php  echo $form->text('thumbWidth', $thumbWidth); ?> px</span></td>
		<td align="right"><span><?php  echo $form->label('thumbHeight', 'Thumbnail Height:'); ?></span></td>
		<td align="left"><span class="galleryOptionField"><?php  echo $form->text('thumbHeight', $thumbHeight); ?> px</span></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><span class="galleryOptionField"><?php  echo $form->checkbox('enableLightbox', 1, $enableLightbox, array('style' => 'margin-right: 0;')); ?><?php  echo $form->label('enableLightbox', 'Enable Lightbox?'); ?></span></td>
		<td align="right"><span class="lightbox-setting"><?php  echo $form->label('fullWidth', 'Zoomed Width:'); ?></span></td>
		<td align="left"><span class="lightbox-setting galleryOptionField"><?php  echo $form->text('fullWidth', $fullWidth); ?> px</span></td>
		<td align="right"><span class="lightbox-setting"><?php  echo $form->label('fullHeight', 'Zoomed Height:'); ?></span></td>
		<td align="left"><span class="lightbox-setting galleryOptionField"><?php  echo $form->text('fullHeight', $fullHeight); ?> px</span></td>
	</tr>	
	<tr>
		<td align="left" colspan="2">&nbsp;</td>
		<td align="right"><span class="lightbox-setting"><?php  echo $form->label('lightboxTransitionEffect', 'Transition Effect:'); ?></span></td>
		<td align="left"><span class="lightbox-setting galleryOptionField"><?php  echo $form->select('lightboxTransitionEffect', array('fade' => 'Fade', 'elastic' => 'Elastic', 'none' => 'None'), $lightboxTransitionEffect); ?></span></td>
		<td align="right"><span class="lightbox-setting"><?php  echo $form->label('lightboxTitlePosition', 'Title Position:'); ?></span></td>
		<td align="left"><span class="lightbox-setting galleryOptionField"><?php  echo $form->select('lightboxTitlePosition', array('outside' => 'Outside', 'inside' => 'Inside', 'over' => 'Over', 'none' => 'None'), $lightboxTitlePosition); ?></span></td>
	</tr>	
</table>

<hr class="clear" />

<script>
var SG_GET_FILESETS_URL = '<?php  echo $get_filesets_url; ?>';
var SG_BLOCK_ID = '<?php  echo $this->controller->bID; ?>';

refreshFilesetList(<?php  echo $fsID; ?>);
</script>