<?php

/**
 * Error class used in tNG3
 * @access private
 */
class tNG_error {
	/**
	 * Developper details error
	 * @var string
	 * @access private
	 */
	var $devDetails;
	/**
	 * User error details
	 * @var string 
	 * @access private
	 */
	var $details;
	/**
	 * Fields errors for user
	 * @var array 
	 * @access private
	 */
	var $fieldErrors = array();
	
	/**
	 * Constructor. 
	 * @param string $errorCode error code for user
	 * @param array $arrArgUsr arguments for user error
	 * @param array $arrArgsDev arguments for developer error
	 * @access protected
	 */
     public function __construct($errorCode, $arrArgsUsr, $arrArgsDev) {
	//function tNG_error($errorCode, $arrArgsUsr, $arrArgsDev) {
		$this->setDetails($errorCode, $arrArgsUsr, $arrArgsDev);
	}
	
	/**
	 * Set user error for a fieldname 
	 * @param string $fieldName fieldname
	 * @param string $errorCode error code for user
	 * @param array $arrArgs arguments for user error
	 * @return nothing
	 * @access protected
	 */
	function setFieldError($fieldName, $errorCode, $arrArgs) {
		$res_errorMsg = KT_getResource($errorCode, 'tNG', $arrArgs);
		$this->fieldErrors[$fieldName] = $res_errorMsg;
	}
	
	/**
	 * Appent an user error to existent error for the fieldname 
	 * @param string $fieldName fieldname
	 * @param string $errorCode error code for user
	 * @param array $arrArgs arguments for user error
	 * @return nothing
	 * @access protected
	 */
	function addFieldError($fieldName, $errorCode, $arrArgs) {
		$res_errorMsg = KT_getResource($errorCode, 'tNG', $arrArgs);
		
		if (!isset($this->fieldErrors[$fieldName])) {
			$this->fieldErrors[$fieldName] = $res_errorMsg;
		} else {
			$this->fieldErrors[$fieldName] .= "<br />" . $res_errorMsg;
		}
	}
	
	/**
	 * Get user error for a fieldname 
	 * @param string $fieldName fieldname
	 * @return string the error
	 * @access protected
	 */
	function getFieldError($fieldName) {
		if (isset($this->fieldErrors[$fieldName])) {
			return $this->fieldErrors[$fieldName];
		}
		return null;
	}
	
	/**
	 * Set error for user and developer
	 * @param string $errorCode  error code for user
	 * @param array $arrArgs arguments for user error
	 * @param array $arrArgsDev arguments for developper error
	 * @return nothing
	 * @access protected
	 */
	function setDetails($errorCode, $arrArgsUsr, $arrArgsDev) {
		$errorCodeDev = $errorCode;
		if ( !in_array($errorCodeDev, array('', '%s')) ) {
			$errorCodeDev .= '_D';
		}
		$res_details = KT_getResource($errorCode, 'tNG', $arrArgsUsr);
		$res_devDetails = KT_getResource($errorCodeDev, 'tNG', $arrArgsDev);

		$this->details = $res_details;
		$this->devDetails = $res_devDetails;
		if ($errorCode != "%s" && $errorCode != "" && $res_devDetails != "") {
			$this->devDetails .= " (".$errorCode.")";
		}
	}
	
	/**
	 * Add error for user and developer (append to an existent error)
	 * @param string $errorCode  error code for user
	 * @param array $arrArgs arguments for user error
	 * @param array $arrArgsDev arguments for developper error
	 * @return nothing
	 * @access protected
	 */
	function addDetails($errorCode, $arrArgsUsr, $arrArgsDev) {
		if ($this->details != '') {
			$this->details .= "<br />";
		}
		if ($this->devDetails != '') {
			$this->devDetails .= "<br />";
		}
		$errorCodeDev = $errorCode;
		if ( !in_array($errorCodeDev, array('', '%s')) ) {
			$errorCodeDev .= '_D';
		}
		$res_details = KT_getResource($errorCode, 'tNG', $arrArgsUsr);
		$res_devDetails = KT_getResource($errorCodeDev, 'tNG', $arrArgsDev);

		$this->details .= $res_details;
		$this->devDetails .= $res_devDetails;
		if ($errorCode != "%s" && $errorCode != "" && $res_devDetails != "") {
			$this->devDetails .= " (".$errorCode.")";
		}
	}
	
	/**
	 * Getter. the error code for the user
	 * @return string error string for the user
	 * @access protected
	 */
	function getDetails() {
		$ret = $this->details;
		return $ret;
	}
	
	/**
	 * Getter. the error code for the developper
	 * @return string error string for the developper
	 * @access protected
	 */
	function getDeveloperDetails() {
		$ret = $this->devDetails;
		return $ret;
	}
}
?>