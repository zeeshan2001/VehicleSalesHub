<?php


/**
 * This class is the "custom" implementation of the tNG_fields class.
 * @access public
 */
class tNG_custom extends tNG_fields {

	/**
	 * Constructor. Sets the connection, the database name and other default values.
	 * Also sets the transaction type.
	 * @param object KT_Connection &$connection the connection object
	 * @access public
	 */
     public function __construct(&$connection) {
	//function tNG_custom(&$connection) {
		//parent::tNG_fields($connection);
		parent::__construct($connection);
		$this->transactionType = '_custom';
		$this->setTable("custom");
		$this->exportRecordset = true;
	}
	
	/**
	 * Prepares the custom SQL query to be executed
	 * @access protected
	 */
	function prepareSQL() {
		tNG_log::log('tNG_custom', 'prepareSQL', 'begin');
		parent::prepareSQL();
		$sql = KT_DynamicData($this->sql, $this, "SQL");
		$this->setSQL($sql);
		tNG_log::log('tNG_custom', 'prepareSQL', 'end');
		return null;
	}
	
	/**
	 * Get the local recordset associated to this transaction
	 * @return object resource Recordset resource
	 * @access protected
	 */
	function getLocalRecordset() {
		tNG_log::log('tNG_custom', 'getLocalRecordset');
		$fakeArr = array();
		$tmpArr = $this->columns;
		foreach($tmpArr as $colName=>$colDetails) {
			$tmpVal = KT_escapeForSql($colDetails['default'], $colDetails['type'], true);
			$fakeArr[$colName] = $tmpVal;
		}
		return $this->getFakeRecordset($fakeArr);
	}
	
	/**
	 * Adds a column to the transaction
	 * Calls the parent addColumn method then sets the default value.
	 * @param string $colName The column name
	 * @param string $type The column type (NUMERYC_TYPE, STRING_TYPE, etc)
	 * @param string $method The request method (GET, POST, FILE, COOKIE, SESSION)
	 * @param string $reference The submitted variable name (if method=GET and reference=test, value=$_GET['test'])
	 * @param string $defaultValue The default value for the current column
	 * @access public
	 */
	function addColumn($colName, $type, $method, $reference, $defaultValue = '') {
		parent::addColumn($colName, $type, $method, $reference);
		$this->columns[$colName]['default'] = $defaultValue;
	}
}
?>
