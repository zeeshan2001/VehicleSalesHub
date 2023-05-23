<?php
/*
	Copyright (c) InterAKT Online 2000-2006. All rights reserved.
*/

/**
 * This class is the "CSV" implementation of the tNG_import class.
 * @access public
 */
class tNG_CSVImport extends tNG_import {
	/**
	 * The delimiter character of the CSV data
	 * @var string
	 * @access private
	 */
	var $delimiter;
	
	/**
	 * The enclosure character for CSV data
	 * @var string
	 * @access private
	 */
	var $enclosure;

	/**
	 * Constructor. Sets the connection, the database name and other default values.
	 * Also sets the import type and import variables reference.
	 * @param object KT_Connection &$connection the connection object
	 * @access public
	 */
     public function __construct(&$connection) {
	//function tNG_CSVImport(&$connection) {
		parent::tNG_import($connection);
		$this->importType = 'CSV';
		$this->importReference = 'KT_CSV';
		$this->lineStart = 0;
	}
	
	/**
	 * Sets the source of the CSV data
	 * Calls the parent setSource method and also registers an upload file STARTER trigger.
	 * @param string $type The type of the source (FILES only)
	 * @param string $reference The submitted variable name (if type=FILES and reference=test, value=$_FILES['test'])
	 * @access public
	 */ 
	function setSource($type, $reference) {
		parent::setSource($type, $reference);
		
		if ($this->source['type'] == 'FILES') {
			$this->registerTrigger("STARTER", "Trigger_CSVImport_FileUpload", 90, $this->source['reference']);
		}
	}
	
	/**
	 * Sets the hasHeader property of the import transaction
	 * @param boolean $hasHeader true if the CSV file contains headers
	 * @access public
	 */ 
	function setHeader($hasHeader) {
		$this->hasHeader = $hasHeader;
		if ($this->hasHeader) {
			$this->lineStart = 1;
		}
	}
	
	/**
	 * Sets the delimiter of CSV data
	 * @param string $delimiter the delimiter
	 * @access public
	 */ 
	function setDelimiter($delimiter) {
		if ($delimiter == 'KT_TAB') {
			$this->delimiter = "\t";
		} else {
			$this->delimiter = $delimiter;    
		}
	}
	
	/**
	 * Sets the enclosure of CSV data
	 * @param string $enclosure the enclosure
	 * @access public
	 */ 
	function setEnclosure($enclosure) {
		$this->enclosure = $enclosure;
	}
	
	/**
	 * Sets the unique key column for the CSV import
	 * Calls the parent setUniqueKey method.
	 * @param string $CSVuniqueKey The name of the unique key column
	 * @access public
	 */
	function setCSVUniqueKey($CSVuniqueKey) {
		parent::setUniqueKey($CSVuniqueKey);
	}
	
	/**
	 * Set the headers and data structures associated to this transaction
	 * @return object tNG_Error or null if no error occured
	 * @access protected
	 */
	function &prepareData() {
		$ret = $this->uploadObj->errObj;
		if ($ret === null && (!isset($this->uploadObj->uploadedFileName) || $this->uploadObj->uploadedFileName == '')) {
			$ret = new tNG_error('CSV_IMPORT_NO_FILE_ERROR', array(), array());
			tNG_log::log('KT_ERROR');
			return $ret;
		}
		$f = fopen($this->uploadObj->dynamicFolder . $this->uploadObj->uploadedFileName, 'rb');
		$headersFound = false;
		if (!$this->hasHeader) {
			foreach ($this->headers as $k => $v) {
				$this->headers[$k] = $k - 1;
			}
		}
		while (($dataarr = fgetcsv($f, 4096, $this->delimiter, $this->enclosure)) !== FALSE) {
			if ($this->hasHeader && !$headersFound) {
				$dataarr = array_flip($dataarr);
				foreach ($this->headers as $k => $v) {
					if (isset($dataarr[$k])) {
						$this->headers[$k] = $dataarr[$k];
					}
				}
				$headersFound = true;
				continue;
			}
			$this->data[] = $dataarr;
		}
		fclose($f);
		$this->uploadObj->RollBack();
		return $ret;
	}
	
	/**
	 * Generates sample and hints for the current CSV import transaction
	 * @return string
	 * @access public
	 */
	function getHints() {
		$ret = '';
		$ret .= "<div class=\"KT_csv_hints\">\r\n";
		$ret .= "<h3>". KT_getResource('CSV_HINTS_SAMPLES','tNG',array()) ."</h3>\r\n";
		$ret .= "<table border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\r\n";
		
		if ($this->hasHeader == true) {
			$ret .= "<tr>\r\n";
			foreach($this->columns as $colName=>$colDetails) {
				if ($colDetails['method'] == 'CSV') {
					$label = $colDetails['reference'];
					$ret .= "<th><strong>" . $label . "</strong></th>\r\n";
				}
			}
			$ret .= "</tr>\r\n";
		}
		
		$CSVColumns = array();
		$DBColumns = array();
		foreach($this->columns as $colName=>$colDetails) {
			if ($colDetails['method'] == 'CSV') {
				$CSVColumns[$colDetails['reference']] = $colName;
				$DBColumns[$colName] = $colDetails['reference'];
			}
		}
		$hasDateColumn = false;
		for ($i=1; $i<=2; $i++) {
			$ret .= "<tr>\r\n";
			foreach($this->columns as $colName=>$colDetails) {
				if ($colDetails['method'] == 'CSV') {
					$colType = $colDetails['type'];
					switch ($colType) {
						case 'STRING_TYPE':
							$value = KT_getResource('CSV_HINTS_STRING', 'tNG', array()) . $i;
							break;
						case 'NUMERIC_TYPE':
							$value = $i;
							break;
						case 'DOUBLE_TYPE':
							$value = $i . '.' . $i;
							break;
						case 'DATE_TYPE':
						case 'DATE_ACCESS_TYPE':
							$value = KT_DynamicData('{NOW}',null);
							$hasDateColumn = true;
							break;
						case 'CHECKBOX_YN_TYPE':
							$value = 'Y';
							break;
						case 'CHECKBOX_1_0_TYPE':
						case 'CHECKBOX_-1_0_TYPE':
							$value = '1';
							break;
						case 'CHECKBOX_TF_TYPE':
							$value = 't';
							break;
						default:
							$value = 'string' . $i;
							break;
					}
					$ret .= "<td>" . $value . "</td>\r\n";
				}
			}
			$ret .= "</tr>\r\n";
		}
		$ret .= "</table>\r\n";
		
		$ret .= "<h3>". KT_getResource('CSV_HINTS_NOTES', 'tNG', array()) ."</h3>\r\n";
		$ret .= "<ul style=\"margin-top:0\">\r\t";
		if ($this->delimiter == "\t") {
			$delimiter_string = KT_getResource('CSV_HINTS_TAB', 'tNG', array());
		} else {
			$delimiter_string = htmlentities($this->delimiter);
		}
		$ret .= "<li>" . KT_getResource("CSV_HINTS_CELL_SEPARATOR", "tNG", array($delimiter_string)) . "</li>\r\n";
		$enclosure_string = htmlentities($this->enclosure);
		$ret .= "<li>" . KT_getResource("CSV_HINTS_CELL_ENCLOSURE", "tNG", array($enclosure_string)) . "</li>\r\n";
		if ($hasDateColumn == true) {
			$ret .= "<li>" . KT_getResource("CSV_HINTS_DATE_FORMAT", "tNG", array($GLOBALS['KT_screen_date_format'])) ."</li>\r\n";
		}
		// Unique key
		if ($this->uniqueKey != '') {
			if ($this->hasHeader == true) {
				$ret .= "<li>" . KT_getResource("CSV_HINTS_COLUMNNAME_UNIQUE", "tNG", array($DBColumns[$this->uniqueKey])) . "</li>\r\n";
			} else {
				$ret .= "<li>" . KT_getResource("CSV_HINTS_COLUMNREFERENCE_UNIQUE", "tNG", array($DBColumns[$this->uniqueKey])) . "</li>\r\n";
			}
		}
		
		if ($this->hasHeader == false) {
			// column associations
			$ret .= "<li><strong>". KT_getResource("CSV_HINTS_COLUMNS_ASSOCIATIONS", "tNG", array()) ."</strong>\r\n";
			$ret .= "<ul style=\"margin-top:0\">\r\n";
			foreach($CSVColumns as $colRef=>$fieldName) {
				$ret .= "<li>" . KT_getResource("CSV_HINTS_PER_COLUMN_IMPORT", "tNG", array($colRef, $fieldName)) . "</li>\r\n";
			}
			$ret .= "</ul>\r\n";
			$ret .= "</li>\r\n";
		}
		$ret .= "</ul>\r\n";
		$ret .= "</div>";
		
		return $ret;
	}

}
?>