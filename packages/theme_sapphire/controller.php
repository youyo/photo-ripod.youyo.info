<?php    

defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeSapphirePackage extends Package {

	protected $pkgHandle = 'theme_sapphire';
	protected $appVersionRequired = '5.5.0';
	protected $pkgVersion = '1.5.0';
	
	public function getPackageDescription() {
		return t("Install the theme Sapphire.");
	}
	
	public function getPackageName() {
		return t("Sapphire");
	}
	
	public function install() {
		$pkg = parent::install();
		
		//install theme
		PageTheme::add('sapphire', $pkg);
	}

}