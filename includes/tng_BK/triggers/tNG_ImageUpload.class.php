<?php
/*
Copyright (c) InterAKT Online 2000-2006. All rights reserved.
 */
/**
 *   Provides functionalities for handling tNG based file uploads.
 *   Extends tNG_FileUpload class;
 * @access public
 */
class tNG_ImageUpload extends tNG_FileUpload
{
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
        //function tNG_ImageUpload($tNG) {
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
