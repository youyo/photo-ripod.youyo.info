<?php	  defined('C5_EXECUTE') or die("Access Denied.");

Loader::library('archive');

/**
*
* This class is responsible for unpacking themes that have been zipped and uploaded to the system. 
* @package Pages
* @subpackage Themes
*/
class PackageArchive extends Archive {
	
	public function install($file, $inplace=false) {
		parent::install($file, $inplace);
	}
	
	public function __construct() {
		parent::__construct();
		$this->targetDirectory = DIR_PACKAGES;
	}
	
	public function uninstall() {
	}
	
}
