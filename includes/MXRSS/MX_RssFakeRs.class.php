<?php
class MX_RssFakeRs{
	var $fields = array();
	var $position = 0;
	var $EOF = false;

	function MX_RssFakeRs($valArr) {
		$this->fields = $valArr;
		if (count($valArr)==0) $this->EOF = true;
	}
		   
	function MoveFirst() {
		$this->position = 0;
	}
		
	function MoveNext() {
		$this->position++;
		if (count(@$this->fields) == $this->position) $this->EOF = true;
	}
	
	function Fields($field){
		return @$this->fields[@$this->position][$field];
	}
	
	function RecordCount() {
		return count(@$this->fields);
	}

	function Close(){
		unset($this->fields);
	}
}
?>