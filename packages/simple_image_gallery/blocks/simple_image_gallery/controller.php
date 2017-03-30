<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));

	class SimpleImageGalleryBlockController extends BlockController {
		
		var $pobj;
		
		protected $btDescription = "Displays images in a fileset (with an optional lightbox).";
		protected $btName = "Simple Image Gallery";
		protected $btTable = 'btSimpleImageGallery';
		protected $btInterfaceWidth = "550";
		protected $btInterfaceHeight = "175";

		public function on_page_view() {
			if ($this->enableLightbox) {
				$html = Loader::helper('html');				
				$bv = new BlockView();
				$bv->setBlockObject($this->getBlockObject());
				$this->addHeaderItem($html->css($bv->getBlockURL() . '/fancybox/jquery.fancybox-1.3.1.css'));
				$this->addHeaderItem($html->javascript($bv->getBlockURL() . '/fancybox/jquery.fancybox-1.3.1.pack.js'));
			}
		}
		
		public function view() {
			Loader::model('simple_image_gallery', 'simple_image_gallery');
			$files = SimpleImageGallery::getPermittedFilesetImages($this->fsID);
			
			$ih = Loader::helper('image');

			$images = array();
			$max_img_height = 0;
			foreach ($files as $file) {
				$image = array();
				
				$f = $file['file'];
				$thumb = $ih->getThumbnail($f, $this->thumbWidth, $this->thumbHeight);
				$image['thumb_src'] = $thumb->src;
				$image['thumb_width'] = $thumb->width;
				$image['thumb_height'] = $thumb->height;
				$max_img_height = ($thumb->height > $max_img_height) ? $thumb->height : $max_img_height;
				
				if ($this->enableLightbox) {
					$full = $ih->getThumbnail($f, $this->fullWidth, $this->fullHeight);
					$image['full_src'] = $full->src;
					$image['full_width'] = $full->width;
					$image['full_height'] = $full->height;
				} else {
					$image['full_src'] = '';
					$image['full_width'] = 0;
					$image['full_height'] = 0;
				}

				$image['title'] = htmlspecialchars($file['title'], ENT_QUOTES, 'UTF-8');
				
				$images[] = $image;
			}

			$this->set('images', $images);
			$this->set('max_img_height', $max_img_height);
			
			//For "initial block add" css workaround:
			$html = Loader::helper('html');				
			$bv = new BlockView();
			$bv->setBlockObject($this->getBlockObject());
			$css_output_object = $html->css($bv->getBlockURL() . '/view.css'); //Pick up theme overrides
			$this->set('inline_view_css_url', $css_output_object->file);
		}
		
		function add() {
			$this->set('fsID', 0);
			$this->set_tools_urls();

			//Defaults for new blocks
			$this->set('enableLightbox', '1');
			$this->set('thumbWidth', '150');
			$this->set('thumbHeight', '150');
			$this->set('fullWidth', '800');
			$this->set('fullHeight', '600');
			$this->set('displayColumns', '3');
			$this->set('lightboxTransitionEffect', 'fade');
			$this->set('lightboxTitlePosition', 'outside');
		}
		
		function edit() {
			$this->set_tools_urls();
		}
		
		private function set_tools_urls() {
			//Can't use the $this->action() method from add or edit forms, so we have to use tools files to respond to ajax calls.
			//We need to get the tools files' urls to the auto.js file, but we can't send values there directly,
			// so instead we send them to the add/edit form, which in turn outputs them as javascript variables
			// (which are then available to code in the auto.js file)
			$th = Loader::helper('concrete/urls'); 
			$this->set('get_filesets_url', $th->getToolsURL('get_fileset_select_options', 'simple_image_gallery'));
		}			
		
		public function save($args) {

			//checkboxes are weird in C5 -- must be handled in this way.
			$args['enableLightbox'] = isset($args['enableLightbox']) ? 1 : 0;
			
			parent::save($args);
		}
		
	}

?>
