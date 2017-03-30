<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class SimpleImageGalleryPackage extends Package {

	protected $pkgHandle = 'simple_image_gallery';
	protected $appVersionRequired = '5.4.1';
	protected $pkgVersion = '1.1.2';
	
	public function getPackageName() {
		return t("Simple Image Gallery"); 
	}	
	
	public function getPackageDescription() {
		return t("Displays images in a fileset (with an optional lightbox).");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block
		BlockType::installBlockTypeFromPackage('simple_image_gallery', $pkg);
	}
	
	public function uninstall() {
		parent::uninstall();
		$db = Loader::db();
		$db->Execute('DROP TABLE btSimpleImageGallery');
	}


}