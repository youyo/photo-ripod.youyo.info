<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class ThemeMoldyYogurtPackage extends Package {

	protected $pkgHandle = 'theme_moldy_yogurt';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '1.1';

	public function getPackageDescription() {
		return t("Installs the Moldy Yogurt theme.");
	}

	public function getPackageName() {
		return t("Moldy Yogurt Theme");
	}

	public function install() {
		$pkg = parent::install();

		// install block
		PageTheme::add('moldy_yogurt', $pkg);



		// install Page Types
		Loader::model('collection_types');

		$ct = CollectionType::getByHandle('full');
		if((!is_object($ct)) || ($ct->getCollectionTypeID() < 1)) {
		$data['ctHandle'] = 'full';
		$data['ctName'] = t('Full');
		$hpt = CollectionType::add($data, $pkg);
		}

		$ct = CollectionType::getByHandle('left_sidebar');
		if((!is_object($ct)) || ($ct->getCollectionTypeID() < 1)) {
		$data['ctHandle'] = 'left_sidebar';
		$data['ctName'] = t('Left Sidebar');
		$hpt = CollectionType::add($data, $pkg);
		}

		$ct = CollectionType::getByHandle('right_sidebar');
		if((!is_object($ct)) || ($ct->getCollectionTypeID() < 1)) {
		$data['ctHandle'] = 'right_sidebar';
		$data['ctName'] = t('Right Sidebar');
		$hpt = CollectionType::add($data, $pkg);
		}

	}

}
