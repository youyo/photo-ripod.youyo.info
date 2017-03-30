<?php      

defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeHtmlfiveResetPackage extends Package {

	protected $pkgHandle = 'theme_htmlfive_reset';
	protected $appVersionRequired = '5.1.1';
	protected $pkgVersion = '2.1';

	public function getPackageDescription() {
		return t("Installs the
		Html Five Reset theme.");
	}

	public function getPackageName() {
		return t("Html Five Reset Theme");
	}

	public function install() {
		$pkg = parent::install();

		// install block
		PageTheme::add('htmlfive_reset', $pkg);
	}

}