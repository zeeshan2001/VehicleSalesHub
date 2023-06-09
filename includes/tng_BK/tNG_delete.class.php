<?php
/*
Copyright (c) InterAKT Online 2000-2006. All rights reserved.
 */
/**
 * This class is the "delete" implementation of the tNG_fields class.
 * @access public
 */
class tNG_delete extends tNG_fields
{
    /**
     * Constructor. Sets the connection, the database name and other default values.
     * Also sets the transaction type.
     * @param object KT_Connection &$connection the connection object
     * @access public
     */
    public function __construct($connection)
    {
        //function tNG_delete(&$connection) {
        //parent::tNG_fields($connection);
        parent:: __construct($connection);
        $this->transactionType = '_delete';
        $this->registerTrigger("BEFORE", "Trigger_Default_saveData", -1);
    }
    /**
     * Prepares the delete SQL query to be executed
     * @access protected
     */
    public function prepareSQL()
    {
        tNG_log::log('tNG_delete', 'prepareSQL', 'begin');
        parent::prepareSQL();
        // check if we have a valid primaryKey
        if (!$this->primaryKey) {
            $ret = new tNG_error('DEL_NO_PK_SET', array(), array());
        }
        // check the primary key value
        if (!isset($this->primaryKeyColumn['value'])) {
            $ret = new tNG_error('DEL_NO_PK_VAL', array(), array());
        }
        $ret = null;
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . KT_escapeFieldName($this->primaryKey) . ' = ';
        $sql .= KT_escapeForSql($this->primaryKeyColumn['value'], $this->primaryKeyColumn['type']);
        $this->setSQL($sql);
        tNG_log::log('tNG_delete', 'prepareSQL', 'end');
        return $ret;
    }
    /**
     * This function exits because the current class does not export a recordset.
     * @access protected
     */
    public function getLocalRecordset()
    {
        $this->setError(new tNG_error('DEL_NO_RS', array(), array()));
    }
}
?>
