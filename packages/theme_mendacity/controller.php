<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeMendacityPackage extends Package {

	protected $pkgHandle = 'theme_mendacity';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '1.2';

	public function getPackageDescription() {
		return t("Installs the Mendacity theme.");
	}

	public function getPackageName() {
		return t("Mendacity");
	}

	public function install() {
		$pkg = parent::install();

		// install block
		PageTheme::add('mendacity', $pkg);


		// install Page Types
		Loader::model('collection_types');

		$ct = CollectionType::getByHandle('full');
		if((!is_object($ct)) || ($ct->getCollectionTypeID() < 1)) {
		$data['ctHandle'] = 'full';
		$data['ctName'] = t('Full');
		$hpt = CollectionType::add($data, $pkg);
		}


	}

}