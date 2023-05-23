<?php

class CSV_Export {
	var $filename;
	var $hasHeaders;
	var $delimiter;
	var $enclosure;
	var $columns;
	
	function CSV_Export(&$recordset) {
		$this->filename = 'dataexport.csv';
		$this->hasHeaders = false;
		$this->delimiter = ',';
		$this->enclosure = '"';
		$this->columns = array();
		
		if (is_resource($recordset)) {
			$localRs = new KT_Recordset($recordset);
		} else {
			$localRs = &$recordset;
		}
		$this->recordset = $localRs;
	}
	
	function addColumn($column, $colType = '', $label = '') {
		$this->columns[trim($column)] = array('type' => trim($colType), 'label' => trim($label));
	}
	
	function setFilename($filename) {
		$this->filename = trim($filename);
	}
	
	function setHeaders($hasHeaders) {
		$this->hasHeaders = $hasHeaders;
	}
	
	function setDelimiter($delimiter) {
        if ($delimiter == 'KT_TAB') {
            $this->delimiter = "\t";
        } else {
            $this->delimiter = $delimiter;    
        }
	}
	
	function setEnclosure($enclosure) {
		$this->enclosure = $enclosure;
	}
	
	function Execute($method, $reference) {
		
		$ret = KT_getRealValue($method, $reference);
		if (!isset($ret)) {
			return;
		}

		if ( !isset($this->recordset) || !isset($this->recordset->fields) ) {
			die('<strong>CSV_Export Error.</strong><br/>Passed argument is not a valid recordset.');
			return;
		}
		
		if (count($this->columns) < 1) {
			die('<strong>CSV_Export Error.</strong><br/>No columns defined!');
			return;
		}
		
		$row = '';
		ob_start();
		if ($this->hasHeaders === true) {
			foreach ($this->columns as $column => $details) {
				$value = $column;
				if ($details['label'] != '') {
					$value = $details['label'];
				}
				$row .= $this->enclosure . $this->escapeEnclosure($value) . $this->enclosure;
				$row .= $this->delimiter;
			}
			$row = substr($row, 0, -strlen($this->delimiter));
			echo $row . "\r\n";
		}
		while (!$this->recordset->EOF) {
			$row = '';
			foreach ($this->columns as $column => $details) {
				$value = $this->recordset->Fields($column);
				if ($details['type'] == 'DATE_TYPE') {
					$value = KT_formatDate($value);
				}
				if (!preg_match('/^[0-9]*$/', $value)) {
					$row .= $this->enclosure . $this->escapeEnclosure($value) . $this->enclosure;
				} else {
					$row .= $value;
				}
				$row .= $this->delimiter;
			}
			$row = substr($row, 0, -strlen($this->delimiter));
			echo $row . "\r\n";
			$this->recordset->MoveNext();
		}
		$size = ob_get_length();
		$this->sendHeaders($size);
		ob_end_flush();
		exit;
	}
	
	function sendHeaders($size) {
		if (headers_sent()){
			die('Headers already sent! The CSV File cannot be exported');
		}
		header('Content-type: text/csv');
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');
		header('Content-Length: ' . $size);
		header('Content-disposition: attachment; filename="' . $this->filename . '";');
	}
	
	function escapeEnclosure(&$text) {
		return str_replace($this->enclosure, $this->enclosure . $this->enclosure, $text);
	}
}
?>