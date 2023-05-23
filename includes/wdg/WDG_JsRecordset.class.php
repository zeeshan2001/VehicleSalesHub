<?php





class WDG_JsRecordset {

	var $outputString = '';

	
	function __construct($RecordsetName) {
	//function WDG_JsRecordset($RecordsetName) {

		$rs = $GLOBALS[$RecordsetName];

		if (is_resource($rs)) {

			$recordset = new KT_Recordset($rs); 

		} else {

			$recordset = &$rs;

		}

		$nl = "\r\n";

		$this->outputString .= <<<EOD

<script>

top.jsRawData_{$RecordsetName} = [



EOD;

		$fieldCount = $recordset->FieldCount();

		$fieldNames = array();

		for ($i=0; $i < $fieldCount; $i++) {

			$meta = $recordset->FetchField($i);

			if ($meta) {

				$fieldNames[] = $meta->name;

				$this->outputString .= ($i==0 ? '[' : ', '). '"' . $meta->name . '"';

			}

		}

		$this->outputString .= <<<EOD

],

//data



EOD;

		while (!$recordset->EOF) {

			$arr = array();

			foreach ($fieldNames as $field) {

				$arr[] = $recordset->Fields($field);

			}

			$this->outputString .= WDG_phparray2jsarray($arr) . ', ';

			$recordset->MoveNext();

		}

		

		$this->outputString .= <<<EOD

[]

];

top.{$RecordsetName} = new JSRecordset('{$RecordsetName}');

</script>

EOD;



		//restore old rs position

		$recordset->MoveFirst();

	}

	function getOutput() {

		return $this->outputString;

	}

}

?>

