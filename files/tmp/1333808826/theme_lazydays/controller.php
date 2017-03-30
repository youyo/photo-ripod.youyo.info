<?php    

defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeLazydaysPackage extends Package {

	protected $pkgHandle = 'theme_lazydays';
	protected $appVersionRequired = '5.5.1';
	protected $pkgVersion = '1.1';
	
	public function getPackageDescription() {
		return t("Installs the Lazydays theme.");
	}
	
	public function getPackageName() {
		return t("Lazydays");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		PageTheme::add('lazydays', $pkg);		
	}




}