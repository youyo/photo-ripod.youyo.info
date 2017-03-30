<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));

class SimpleImageGallery extends Object {
//We're extending "Object", not "Model", because we don't want an ActiveRecord-style object
	
	public static function getPermittedFilesetImages($fsID) {
		Loader::model('file_set');
		Loader::model('file_list');

		$fs = FileSet::getByID($fsID);
		$fl = new FileList();		
		$fl->filterBySet($fs);
		$fl->filterByType(FileType::T_IMAGE);
		$fl->sortByFileSetDisplayOrder();
		
		$all_files = $fl->get();
		$permitted_files = array();
		foreach ($all_files as $f) {
			$fp = new Permissions($f);
			if ($fp->canRead()) {
				$fv = $f->getRecentVersion();
				$permitted_files[$f->fID] = array(
					'file' => $f,
					'fID' => $f->fID,
					'position' => $f->fsDisplayOrder,
					'title' => $fv->getTitle(),
					'caption' => $fv->getDescription(),
				);
			}
		}
		return $permitted_files;	
	}

}