<?php

/**
 * The connection class (used on PHP - MySQL Server model)
 */
class KT_Connection {

	/**
	 * The database name
	 * @var string
	 * @access private
	 */
	var $databaseName = '';

	/**
	 * The connection Resource ID
	 * @var object ResourceID
	 * @access private
	 */
	var $connection = null;

	/**
	 * Flag. what server model is.
	 * @var string
	 * @access private
	 */
	var $servermodel = "mysql";

	/**
	 * for ADODB compatibility
	 * @var string
	 * @access public
	 */
	var $databaseType = "mysql";

	/**
	 * The constructor
	 * Sets the connection and the database name
	 * @param object ResourceID &$connection
	 * @param string $databasename
	 * @access public
	 */
		public function __construct(&$connection, $databasename) {
	//function KT_Connection(&$connection, $databasename) {
		$this->connection = &$connection;
		$this->databaseName = $databasename;
	}

	/**
	 * Executes a SQL statement
	 * @param string $sql
	 * @return object unknown
	 *         true on success
	 *         response Resource ID if one is returned by the wrapper function
	 * @access public
	 */
	function Execute($sql) {
		if (!mysqli_select_db($this->databaseName, $this->connection)) {
			return false;
		}
		$response = mysqli_query($sql, $this->connection);
		if (!is_resource($response)) {
			return $response;
		} else {
			$recordset = new KT_Recordset($response);
			return $recordset;
		}
	}

	/**
	 * Executes a SQL statement
	 * @param string $sql
	 * @return mysql resource
	 *         true on success
	 *         response MYSQL Resource ID
	 * @access public
	 */
	function MySQL_Execute($sql) {
		if (!mysqli_select_db($this->databaseName, $this->connection)) {
			return false;
		}
		$response = mysqli_query($sql, $this->connection);
		return $response;
	}

	/**
	 * Gets the error message
	 * @return string
	 * @access public
	 */
	function ErrorMsg() {
		return mysqli_error($this->connection);
	}

	/**
	 * Gets the auto-generated inserted id (if any)
	 * @return object unknown
	 * @access public
	 */
	function Insert_ID($table, $pKeyCol) {
		return mysqli_insert_id($this->connection);
	}
}
?>
