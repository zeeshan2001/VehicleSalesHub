<?php

/**
 *   Provides functionalities for handling tNG based file uploads.
 *   Extends tNG_FileUpload class;
 * @access public
 */
class tNG_ImageUpload extends tNG_FileUpload
{
	function rotateImage($filename,$degrees,$imageType){
		$size = getimagesize($image);
		$height = $size[1];
		$width = $size[0];
		//Swap width and Height to rotated width and height
		$new_width = $degrees == 180 ? $width : $height;
		$new_height = $degrees == 180 ? $height : $width;
		$newImage = imagecreatetruecolor($width,$height);
		switch($imageType) {
			case "image/gif":
				$source = imagecreatefromgif($filename);
			break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source = imagecreatefromjpeg($filename);
			break;
			case "image/png":
			case "image/x-png":
				$source = imagecreatefrompng($filename);
			break;
		}
		$rotate = imagerotate($source, $degrees, 0);
		imagecopyresampled($newImage,$source,0, 0, 0, 0,$new_width,$new_height,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($rotate,$filename);
			break;
			case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($rotate,$filename,80);
			break;
			case "image/png":
			case "image/x-png":
				imagepng($rotate,$filename,9);
			break;
		}
		imagedestroy($source);
		imagedestroy($rotate);
		return $filename;
	}
	function image_fix_orientation($image) {
		$exif_data = exif_read_data($image);
		if($exif_data !== false){
			$orientation = $exif_data['Orientation'];
			switch($orientation){
				case 3: // 180 rotate left
					$angle = 180;
				break;
				case 6: // 90 rotate right == 270
					$angle = 270;
				break;
				case 8:    // 90 rotate left
					$angle = 90;
				break;
			}
			if(isset($angle) && $angle > 0){
				$imageType = $exif_data['MimeType'];
				$image = $this->rotateImage($image,$angle,$imageType);
			}
		}
	}
		/**
		 * if the image will be resized
		 * @var boolena
		 * @access public
		 */
		public $resize;
		/**
		 * If the proportions must be kept in case of a resize
		 * @var boolean
		 * @access public
		 */
		public $resizeProportional;
		/**
		 * width for resize
		 * @var integer
		 * @access public
		 */
		public $resizeWidth;
		/**
		 * height for resize
		 * @var integer
		 * @access public
		 */
		public $resizeHeight;
		/**
		 * Constructor. Sets the reference to transaction. initialize some vars;
		 * @param object tNG
		 * @access public
		 */
		public function __construct($tNG)
		{
				//function tNG_ImageUpload(&$tNG) {
				parent:: __construct($tNG);
				$this->resize = false;
				$this->resizeProportional = true;
				$this->resizeWidth = 0;
				$this->resizeHeight = 0;
		}
		/**
		 * setter. set the sizes for the resize and proportional resize flag;
		 * @var boolean proportional make the resize proportional
		 * @var integer width of the resize
		 * @var integer height
		 * @access public
		 */
		public function setResize($proportional, $width, $height)
		{
				$this->resize = true;
				$this->resizeProportional = $proportional;
				$this->resizeWidth = (int) $width;
				$this->resizeHeight = (int) $height;
		}
		/**
		 * in case of an update, the old thumbnail are deleted;
		 * @var string the name of the folder
		 * @var string the old name of the file
		 * @access public
		 */
		public function deleteThumbnails($folder, $oldName)
		{
				tNG_deleteThumbnails($folder, $oldName, '');
		}
		/**
		 * the main method, execute the code of the class;
		 * Upload the file, set the file name in transaction;
		 * return mix null or error object
		 * @access public
		 */
		public function Execute()
		{
				$ret = parent::Execute();
				if ($ret === null && $this->resize && $this->uploadedFileName != '') {
			$this->image_fix_orientation($this->dynamicFolder.$this->uploadedFileName);
						$ret = $this->Resize();
				}
				return $ret;
		}
		/**
		 * Make the resize on the saved file;
		 * return mix null or error object
		 * @access public
		 */
		public function Resize()
		{
				$ret = null;
				$image = new KT_image();
				$image->setPreferedLib($GLOBALS['tNG_prefered_image_lib']);
				$image->addCommand($GLOBALS['tNG_prefered_imagemagick_path']);
				$image->resize($this->dynamicFolder . $this->uploadedFileName, $this->dynamicFolder, $this->uploadedFileName, $this->resizeWidth, $this->resizeHeight, $this->resizeProportional);
				if ($image->hasError()) {
						$arrError = $image->getError();
						$errObj = new tNG_error('IMG_RESIZE', array(), array($arrError[1]));
						if ($this->dbFieldName != '') {
								$errObj->addFieldError($this->dbFieldName, 'IMG_RESIZE', array());
						}
						$ret = $errObj;
				}
				return $ret;
		}
}
?>
