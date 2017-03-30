<?php    
/*
* Theme by RynoMedia at www.rynomediaonline.com
*/

/* 
* Version History
* 1.0 - Initial Release
* 1.1 - Fixed Page Type Issue
* 1.2 - Fixed Minor Mis-spellings and other non-sense
* 2.0 - Major Overhaul includes:
*		1. Re-configured Pages so Header Content is in Header.php
*		2. Included area for Site Title in Header
*		3. Added "blog_entry" page type for use with core blog
*		4. Fixed a bug in the 'default' page type that used the wrong area name
*		5. Added auto install of the three_column page layout.
*/

defined('C5_EXECUTE') or die(_("Access Denied."));

class Cannonf700BlackAccentsPackage extends Package {

	protected $pkgHandle = 'cannonf700_black_accents';
	protected $appVersionRequired = '5.3.1';
	protected $pkgVersion = '2.0';
	
	public function getPackageDescription() {
		return t("Black Accents themes by rynomediaonline.com");
	}
	
	public function getPackageName() {
		return t("Black Accents");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		PageTheme::add('black_accents', $pkg);	
		
		// install page types
		$data['ctHandle'] = 'three_column';
		$data['ctName'] = t('three_column');
		$napt = CollectionType::add($data, $pkg);
			 
	}
}