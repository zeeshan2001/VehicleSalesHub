<?php
class KT_MXSearchFakeRs{
	var $fields = array();
	var $position = 0;
	var $EOF = false;

	function KT_MXSearchFakeRs($valArr) {
		$this->fields = $valArr;
		$this->fields = $valArr;
		if (count($valArr)==0) $this->EOF = true;
	}
		
	function prepareValue($field, $value){
		if($value==="NULL"){
			$value="";
		}
		$this->fields[$field]=$value;
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