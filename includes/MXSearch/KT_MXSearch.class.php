<?php
class KT_MXSearch{
	var $connection; //connection name
	var $databaseType; //database type
	var $searchName; //name of the class
	var $tmpTable; //name of the temporary table storing last cache update
	var $refreshCacheDelay;
	var $cacheTable; //name of the cache table storing all site search content
	var $searchType; //type of search (fulltext || normal)
	var $searchColumns; //array with the names of the searched columns
	var $whereCondition; //where condition in the Search Recordset SQL
	var $orderBy; //order by statement in the Search Recordset SQL
	var $searchFor=''; //aditional columns in the Search Recordset SQL
	var $tables;
	var $totalRows;
	var $importanceArray = array(1=>5,2=>10,3=>25,4=>50,5=>100);
	var $sql = array(
		'MySQL' => array(
			'select' => "SELECT %s as title_cah, %s as shortdesc_cah, %s as url_cah, %s as importance_cah",
			'create_cache' => "CREATE TABLE %s (
							title_cah varchar (100) NOT NULL, 
							shortdesc_cah text NOT NULL, 
							col1_cah text NULL, 
							col2_cah text NULL, 
							col3_cah text NULL, 
							col4_cah text NULL, 
							col5_cah text NULL, 
							importance_cah INT NOT NULL, 
							url_cah varchar (255) NOT NULL);",
			'like' => "LIKE",	
			'fulltext_where' => array(
						'fulltext' => "MATCH (col%s_cah) AGAINST ('%s') >0 ",
						'boolean fulltext' => "MATCH (col%s_cah) AGAINST ('%s' IN BOOLEAN MODE) >0 "
						),
			'fulltext_order' => array(
						'fulltext' => "MATCH (col%s_cah) AGAINST ('%s') * %s",
						'boolean fulltext' => "MATCH (col%s_cah) AGAINST ('%s' IN BOOLEAN MODE) * %s"
						),
			'columns' => '%s'
		),
		'MsSQL' => array(
			'select' => "SELECT CAST(%s AS text) as title_cah, CAST(%s AS text) as shortdesc_cah, %s as url_cah, %s as importance_cah",
			'create_cache' => "CREATE TABLE %s (
							id_cah int IDENTITY(1,1) NOT NULL,
							title_cah text NOT NULL, 
							shortdesc_cah text NOT NULL, 
							col1_cah text NULL, 
							col2_cah text NULL, 
							col3_cah text NULL, 
							col4_cah text NULL, 
							col5_cah text NULL, 
							importance_cah INT NOT NULL, 
							url_cah varchar (255) NOT NULL);
							create unique index KT_%s_id_cah on %s(id_cah);",
			'like' => "LIKE",
			'columns' => "CAST(%s AS text) AS %s",
		),
	
		'PostgreSQL' => array(
			'select' => "SELECT %s as title_cah, %s as shortdesc_cah, %s as url_cah, %s as importance_cah",
			'create_cache' => "CREATE TABLE %s (
							title_cah varchar (100) NOT NULL, 
							shortdesc_cah text NOT NULL, 
							col1_cah text NULL, 
							col2_cah text NULL, 
							col3_cah text NULL, 
							col4_cah text NULL, 
							col5_cah text NULL, 
							importance_cah INT NOT NULL, 
							url_cah varchar (255) NOT NULL);",
			'like' => "ILIKE",
			'fulltext_where' => array(
						'fulltext' => " col%s_vect_cah @@ to_tsquery('%s') "
						),
			'fulltext_order' => array(
						'fulltext' => " rank(col%s_vect_cah, '%s') * %s"
						),
			'columns' => '%s'
		),
		'Access' => array(
			'select' => "SELECT %s as title_cah, %s as shortdesc_cah, %s as url_cah, %s as importance_cah",
			'create_cache' => "CREATE TABLE %s (
							title_cah varchar (100) NOT NULL, 
							shortdesc_cah memo NOT NULL, 
							col1_cah memo NULL, 
							col2_cah memo NULL, 
							col3_cah memo NULL, 
							col4_cah memo NULL, 
							col5_cah memo NULL, 
							importance_cah INT NOT NULL, 
							url_cah varchar (255) NOT NULL);",
			'like' => "LIKE",
			'columns' => '%s'			
		),
		'Other' =>	 array(
			'select' => "SELECT %s as title_cah, %s as shortdesc_cah, %s as url_cah, %s as importance_cah",
			'create_cache' => "CREATE TABLE %s (
							title_cah varchar (100) NOT NULL, 
							shortdesc_cah text NOT NULL, 
							col1_cah text NULL, 
							col2_cah text NULL, 
							col3_cah text NULL, 
							col4_cah text NULL, 
							col5_cah text NULL, 
							importance_cah INT NOT NULL, 
							url_cah varchar (255) NOT NULL);",
			'like' => "LIKE",
			'columns' => '%s'			
		)	
	);
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   KT_MXSearch
	//
	// DESCRIPTION:
	//   KT_MXSearch constructor
	//   
	// ARGUMENTS:
	//   searchName - Name of the object
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function KT_MXSearch() {
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   setConnection
	//
	// DESCRIPTION:
	//   Sets the connection and the connection type (database type)
	//
	// ARGUMENTS:
	//   connection - connection name
	//   databaseType - database type
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function setConnection(&$connection , $databaseType) {
		$this->connection = $connection;
		$this->databaseType = $databaseType;
	}
	

	
	function setCache($cacheTable, $refreshCacheDelay) {
		$this->cacheTable = $cacheTable;
		$this->refreshCacheDelay = $refreshCacheDelay*60;
	}
	
	function setTempTable($tmpTable) {
		$this->tmpTable = $tmpTable;
	}
	
	function setTables($config) {
		$this->tables = $config->Tables;
	}
	function setSearchType($searchType) {
		$this->searchType = $searchType;
	}
	
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   checkTableExists()
	//
	// DESCRIPTION:
	//   Verifies the existence of a table in the database
	//
	// ARGUMENTS:
	//   tableName - name of the table
	//
	// RETURNS:
	//   true or false
	//--------------------------------------------------------------------
	
	function checkTableExists($tableName){
		//check if table exists
		$KT_sql = "SELECT * FROM $tableName";
		$testRecord = $this->connection->Execute($KT_sql);
		if ($this->connection->ErrorMsg()) {
			return false;
		} else {
			return true;
		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   createTmpTable
	//
	// DESCRIPTION:
	//   Creates the table that holds the cache refresh information
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function createTmpTable(){
		//create settings table
		$KT_sql = "CREATE TABLE ".$this->tmpTable."(
								lastupd_tmp TEXT NOT NULL								
								);";
		$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg());								
		//insert record
		$this->initTmpTable();
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   updateTmpTable
	//
	// DESCRIPTION:
	//   Updates the table that holds the cache refresh information
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   true or false
	//--------------------------------------------------------------------
	
	function updateTmpTable(){
		$now = date("Y/m/d H:i:s");
		$KT_sql = "update ".$this->tmpTable." SET lastupd_tmp = '$now'";
		$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg());
		return true;
	}
	
	
	function initTmpTable() {
		$KT_sql = "INSERT INTO ".$this->tmpTable." (lastupd_tmp) VALUES('1970/01/01 00:00:00')	;";
		$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg()); 								
	}
	//--------------------------------------------------------------------
	// FUNCTION:
	//   checkCacheExpired
	//
	// DESCRIPTION:
	//   Checks if the cache has expired
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   true or false
	//--------------------------------------------------------------------
	
	function checkCacheExpired() {
		$KT_sql = "select lastupd_tmp from ".$this->tmpTable;
		$mxs_result = $this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg());
		$date = $mxs_result->Fields('lastupd_tmp');
		if ($mxs_result->Fields('lastupd_tmp')) {
			if (strtotime(date("Y/m/d H:i:s")) - strtotime($date) > $this->refreshCacheDelay) {
				return true;
			} else {
				return false;
			}
		} else {
			$this->initTmpTable();
			return false;
		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   createCacheTable
	//
	// DESCRIPTION:
	//   Creates the cache table
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function createFulltextIndex($dbType) {
		if ($dbType=="MySQL") {
			for ($i=1;$i<=5;$i++) {
				$KT_sql = 'ALTER TABLE `'.$this->cacheTable.'` DROP INDEX `idx_description`'.$i;
				$this->connection->Execute($KT_sql);
				$KT_sql = 'create fulltext index idx_description'.$i.' on '.$this->cacheTable.' (col'.$i.'_cah);';
				$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg()."<br>Please check that your database supports fulltext search");
			}
		}
		if ($dbType=="PostgreSQL") {
			$KT_sql = 'alter table '.$this->cacheTable.' add col1_vect_cah tsvector NULL;
							alter table '.$this->cacheTable.' add col2_vect_cah tsvector NULL;
							alter table '.$this->cacheTable.' add col3_vect_cah tsvector NULL;
							alter table '.$this->cacheTable.' add col4_vect_cah tsvector NULL;
							alter table '.$this->cacheTable.' add col5_vect_cah tsvector NULL;';
			$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg()."<br>Please check that your database supports fulltext search (that you have tsearch2 module installed)");				
		}
		if ($dbType == "MsSQL") {
			$KT_sql = "IF (SELECT DATABASEPROPERTY(DB_NAME(DB_ID()) ,'IsFulltextEnabled')) < 1
			BEGIN
 				EXEC sp_fulltext_database 'enable';
			END
			";
			$this->connection->Execute($KT_sql) or die('Cannot enable the Full Text Index for the database !<br/>'.$KT_sql);
			
			$KT_sql = "EXEC sp_fulltext_catalog 'catalog_".$this->cacheTable."', 'Create';"."\n";
			//add table to the catalog
			$KT_sql .= "EXEC sp_fulltext_table '".$this->cacheTable."', 'Create', 'catalog_".$this->cacheTable."', 'KT_".$this->cacheTable."_id_cah';"."\n";
			//add columns to the index
			$arrFields = array('col1_cah','col2_cah','col3_cah','col4_cah','col5_cah');
			foreach($arrFields as $fieldName) {
				$KT_sql .= "EXEC sp_fulltext_column '".$this->cacheTable."', '".$fieldName."', 'add';"."\n";
			}
			$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg().'<br/>Cannot create Full Text Index Catalog !<br/>'.$KT_sql);
		}
	} 
	
	function createCacheTable() {	
		$rs = $this->connection->Execute("DELETE FROM ".$this->cacheTable);
		if ($rs == false) {
			$KT_sql = sprintf($this->sql[$this->databaseType]['create_cache'], $this->cacheTable, $this->cacheTable, $this->cacheTable);
			$this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg()."<br>".$KT_sql);
			if ($this->searchType=='fulltext' || $this->searchType=='boolean fulltext') {
				$this->createFulltextIndex($this->databaseType);
			}		
		}
		 
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   fillCacheTable
	//
	// DESCRIPTION:
	//   Fills the cache table
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------

	function escapeChars($text) {
		if ($this->databaseType=="MsSQL") {
			$text = str_replace("'","''", $text);
		} elseif ($this->databaseType=="Access") {
			$text = str_replace("'","''", $text);
			$text = str_replace("\\","\\\\", $text);
		} else {
			$text = addslashes($text);
		}
		return $text;	
	}
	
	function fillCacheTable() {
		$this->updateTmpTable();		
		$this->createCacheTable();
		
		if (is_array($this->tables)){
		foreach($this->tables as $tableKey => $crtTable){
			$columnsString = array();
			
			$KT_TableName = $tableKey;

			//for each column...
	
			if (is_array($crtTable['searchColumns'])){
				$tmpColumnArr = array();
				foreach($crtTable['searchColumns'] as $fieldKey => $fieldValue) {
					$tmpColumnArr[$fieldValue][]	=	$fieldKey;
				}
				for ($relIdx=1;$relIdx<=5;$relIdx++) {
					if (isset($tmpColumnArr[$relIdx])) {
						$columnsString[$relIdx] = '';
						for($j=0;$j<count($tmpColumnArr[$relIdx]);$j++) {
							if ($j != 0) {
								$columnsString[$relIdx] .= ',';
							}
							$columnsString[$relIdx] .= sprintf($this->sql[$this->databaseType]['columns'], $tmpColumnArr[$relIdx][$j],$tmpColumnArr[$relIdx][$j]);
						}
						
					} else {
						unset ($columnsString[$relIdx]);
					}
					
				}
				
			}else {
				die('No search columns defined in table '.$KT_TableName.'!');
			}
			//end columns
			
			//set the columns values	
			$cacheTile			= $crtTable['resultTitle'];
			$cacheDesc			= $crtTable['resultDesc'];			
			$cacheURL			= $crtTable['pageName'];
			$cacheImportance 	= $crtTable['TableImportance'];
			if (isset($crtTable['AditionalCondition'])) {
				$cacheAditionalCond = $crtTable['AditionalCondition'];			
			} else {
				unset($cacheAditionalCond);
			}
			
			//compute result url parameters
			$paramValue = $crtTable['pageParam'];
				
			$KT_sql = sprintf($this->sql[$this->databaseType]['select'], $cacheTile, $cacheDesc, $paramValue, $cacheImportance);
			for ($relIdx=1;$relIdx<=5;$relIdx++) {
				if (isset($columnsString[$relIdx])) {
					$KT_sql .= ", ".$columnsString[$relIdx];	
				}
			}
			$KT_sql	.= " FROM ".$KT_TableName;
			if (isset($cacheAditionalCond) && $cacheAditionalCond != '') {
				$KT_sql .= " WHERE $cacheAditionalCond ";
			}

			$KT_results = $this->connection->Execute($KT_sql) or die($this->connection->ErrorMsg()."<br>".$KT_sql);
				
			while(!$KT_results->EOF){
				$cacheCol = array();
				$col_cah = array();
				$title_cah			= $this->escapeChars(strip_tags($KT_results->Fields('title_cah')));
				$shortdesc_cah		= $this->escapeChars(strip_tags($KT_results->Fields('shortdesc_cah')));
				for ($relIdx=1;$relIdx<=5;$relIdx++) {
					if (isset($tmpColumnArr[$relIdx])) {
						$cacheCol[$relIdx] = "";
						for ($colIdx=0;$colIdx<count($tmpColumnArr[$relIdx]);$colIdx++) {
							$cacheCol[$relIdx] .= "\r\n".$this->escapeChars($KT_results->Fields($tmpColumnArr[$relIdx][$colIdx]));
						}
					}
				}							
				$KT_colString = ''; $KT_valueString = '';
				for ($relIdx=1;$relIdx<=5;$relIdx++) {
					if (isset($cacheCol[$relIdx])) {
						$col_cah[$relIdx] = strip_tags($cacheCol[$relIdx]);
						$KT_colString .= ", col".$relIdx."_cah";
						$KT_valueString .= ", '".$col_cah[$relIdx]."'";
						if ($this->databaseType=="PostgreSQL" && $this->searchType=="fulltext") {
							$KT_colString .= ", col".$relIdx."_vect_cah";
							$KT_valueString .= ", to_tsvector('".$col_cah[$relIdx]."')";				
						}
					} else {
						$col_cah[$relIdx] = "";
					}
				}
				$url_cah	= $this->escapeChars($cacheURL.urlencode($KT_results->Fields('url_cah')));
				$importance_cah = $this->importanceArray[$cacheImportance];
				$KT_sql	= "INSERT INTO ".$this->cacheTable." (title_cah, shortdesc_cah".$KT_colString.", importance_cah, url_cah) values ('$title_cah', '$shortdesc_cah'".$KT_valueString.", $importance_cah, '$url_cah');";
				$this->connection->Execute($KT_sql);
				if ($this->connection->ErrorMsg()) {
					echo $this->connection->ErrorMsg()."<br>Please hit the refresh button";
					$this->dropTables();
					die();
				}
				$KT_results->MoveNext();
			}
				
		} //foreach table
		} else {die('No search tables defined!');}
		$this->afterFillCacheTable();
	}
	
	function afterFillcacheTable() {
		if ($this->databaseType=="MsSQL" && $this->searchType=="fulltext") {
			//START INDEX ON FULL-TEXT CATALOG
			$KT_sql = "EXEC sp_fulltext_catalog 'catalog_".$this->cacheTable."', 'start_full';"."\n";
			$this->connection->Execute($KT_sql);
			if ($this->connection->ErrorMsg()) {
				echo $this->connection->ErrorMsg()."<br>Error creating fulltext index<br>Please hit the refresh button";
				$this->dropTables();
				die();
			}
		}
	}
	
	function dropTables() {
		$KT_sql = "DROP TABLE ". $this->cacheTable;
		$this->connection->Execute($KT_sql);	
		$KT_sql = "DROP TABLE ". $this->tmpTable;
		$this->connection->Execute($KT_sql);
	}
	
	function getRecordset($start = null, $max = null) {
		$kt_searchWhere = $this->getWhereCondition();
		$kt_searchOrder = $this->getOrderBy();
		$kt_columns		= $this->getSearchColumns();
		$kt_searchFrom		= $this->getSearchFrom();
		
		$KT_sql = sprintf("SELECT * %s FROM %s WHERE %s ORDER BY %s", $kt_columns, $kt_searchFrom, $kt_searchWhere, $kt_searchOrder);
		//echo $KT_sql;
		$KT_result = $this->connection->SelectLimit($KT_sql);
		if ($this->connection->ErrorMsg()) {
			echo $this->connection->ErrorMsg()."<br>Please hit the refresh button";
			$this->dropTables();
			die();
		}
		$this->totalRows = $KT_result->RecordCount();
		if (isset($start) && isset($max)) {
			if ($this->searchType=='fulltext' || $this->searchType=='boolean fulltext') {	
				$KT_result = $this->connection->SelectLimit($KT_sql, $max, $start) or die($this->connection->ErrorMsg()."<br>".$KT_sql);
			}
			if ($this->searchFor!='' && $this->searchType=='normal') {
				$KT_result = new KT_MXSearchFakeRS($this->getOrderedArray($KT_result, $start, $max));
			}	
		}
		return $KT_result;
	}
	
	function getTotalRows() {
		return $this->totalRows;
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   refreshCache
	//
	// DESCRIPTION:
	//   Checks if the cache is expired and refreshes the cache if necesary
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function refreshCache(){
		if (!$this->checkTableExists($this->tmpTable)){
				$this->createTmpTable($this->tmpTable);
			}
		if ($this->checkCacheExpired()){
				$this->fillCacheTable();
			} 
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   computeAll
	//
	// DESCRIPTION:
	//   Checks the type of the search and performs the right search
	//
	// ARGUMENTS:
	//   searchFor - expression to search for
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function computeAll($searchFor){
		$this->refreshCache();
		$this->setSearchTerm($searchFor);
		
		if ($this->searchType=='normal') {
			$this->computeNormalSearch();		
		}
		if ($this->searchType=='fulltext') {	
			$this->computeFullSearch($this->databaseType);
		}
		if ($this->searchType=='boolean fulltext') {
			$this->computeMySQLFullSearch($this->searchType);
		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   setSearchTerm
	//
	// DESCRIPTION:
	//   Sets the expression to search for
	//
	// ARGUMENTS:
	//   searchFor - the expression
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function setSearchTerm($searchFor){
		if (get_magic_quotes_gpc()) {
			$keywords = @$_GET[$searchFor];
		} else {
			$keywords = addslashes(@$_GET[$searchFor]);
		}
		$this->searchFor = stripslashes(strtolower($keywords));
	}

	//--------------------------------------------------------------------
	// FUNCTION:
	//   computeNormalSearch
	//
	// DESCRIPTION:
	//   Computes the SQL for the normal search
	//
	// ARGUMENTS:
	//   
	// RETURNS:
	//   
	//--------------------------------------------------------------------
	
	function computeNormalSearch() {
		$searchFor = $this->searchFor;
		$like = $this->sql[$this->databaseType]['like'];
		if ($searchFor)	{
			$searchCond = explode(" and ", $searchFor);
			for ($condIdx=0;$condIdx<count($searchCond);$condIdx++)	{
				if ($searchCond[$condIdx]!='') {
					if ($condIdx!=0) {
						$this->whereCondition .= " AND (";
					} else {
						$this->whereCondition .= " (";
					}	
					$searchCond[$condIdx] = str_replace(" or "," ", $searchCond[$condIdx]);
					$expr = "/\"([^\"]*)\"/m";
					$matches = array();
					preg_match_all($expr, $searchCond[$condIdx], $matches);
					$searchCond[$condIdx] = preg_replace($expr, "", $searchCond[$condIdx]);
					$searchWords = explode(" ", $searchCond[$condIdx]);
					if (is_array($matches[1])) {			
						foreach ($matches[1] as $key=>$value) {				
							array_push($searchWords, $value);
						}
					}
					$first = true;
					for ($i=0;$i<count($searchWords);$i++) {
						if ($searchWords[$i]!='') {
							if (!$first) {
								$this->whereCondition .= " OR (";
							} else {
								$this->whereCondition .= " (";
							}
							$first = false;
							$this->whereCondition .= " col1_cah $like '%".$this->escapeChars($searchWords[$i])."%' ";
							for ($relIdx=2; $relIdx <= 5; $relIdx++) {
								$this->whereCondition .= " OR col".$relIdx."_cah $like '%".$this->escapeChars($searchWords[$i])."%' ";
								if ($relIdx==5) $this->whereCondition .= ") ";
							}
						}
					}
					$this->whereCondition .= " ) ";
				}
			}
			$this->orderBy		.= " importance_cah DESC";
		} else {
			$this->whereCondition .= " 1=-1 ";
			$this->orderBy		.= " importance_cah DESC";		
		}
	}
		
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   getScore
	//
	// DESCRIPTION:
	//   Calculates the importance score 
	//
	// ARGUMENTS:
	//   text - text to search in
	//   text - text to search in
	//	 searchFor - keywords
	// RETURNS:
	//   the importance score for the keywords
	//--------------------------------------------------------------------
		
	function getScore($text) 
	{
		$searchFor = $this->searchFor;
		$textLo = strtolower($text);
		$expr = "/\"([^\"]*)\"/m";
		$matches = array();
		preg_match_all($expr, $searchFor, $matches);
		$searchFor = preg_replace($expr, "", $searchFor);
		$searchFor = str_replace('"','',$searchFor);
		$nrWords = count(explode(" ", $text));
		$searchWords = explode(" ", $searchFor);
		if (is_array($matches[1])) {
			foreach($matches[1] as $key=>$value) {
				array_push($searchWords, $value);
			}
		}
		$nrSearchWords = count($searchWords);
		$mainWordIdx = 0;
		$mainWord = "";
		
		if ($nrSearchWords==1) {
			$nrOccur = substr_count($textLo, strtolower($searchFor));
			$score = $nrOccur/$nrWords;
			return $score;
		} else {
			$score = 0;
			$allWords = true;
			for ($i=0;$i<$nrSearchWords;$i++) {
				if ($searchWords[$i]!='') {
					$nrOccur = substr_count($textLo, strtolower($searchWords[$i]));		
					if (!$nrOccur) {
						$allWords = false;
					}
					$score += $nrOccur/$nrWords;		
				}
			}
			if ($allWords) {
				$score *= 5;
			}
			return $score;
		}
	}
	
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   getOrderedArray
	//
	// DESCRIPTION:
	//   Makes a sort operation on the results for the normal search using the importance score
	//
	// ARGUMENTS:
	//   recSet - recordset object containing the results
	//	 searchFor - keywords
	// RETURNS:
	//   array with the results in the right order
	//--------------------------------------------------------------------
	
	function getOrderedArray($recSet, $start, $length)
	{
		$searchFor = $this->searchFor;
		$ordArr = array();
		$i = 0;
		while (!$recSet->EOF) {
			$fieldsArr = array();
			$fieldsArr['title_cah'] = $recSet->Fields('title_cah');
			$fieldsArr['shortdesc_cah'] = $recSet->Fields('shortdesc_cah');
			$fieldsArr['url_cah'] = $recSet->Fields('url_cah');
			$score = 0;
			for ($j=1;$j<=5;$j++) {
				$score += $this->importanceArray[$j] * $this->getScore($recSet->Fields('col'.$j.'_cah'), $searchFor);
			}
			$fieldsArr['score'] = $score * $recSet->Fields('importance_cah');
			$ordArr[$i] = $fieldsArr;
			$recSet->MoveNext();
			$i++;
		}
		$recSet->MoveFirst();	
		$ready = false;
		$nrRec = $recSet->RecordCount(); 
		while(!$ready) {
			$ready = true;
			for($i=0;$i<$nrRec-1;$i++) {
				if ($ordArr[$i]['score']<$ordArr[$i+1]['score']) {
					$aux = $ordArr[$i];
					$ordArr[$i] = $ordArr[$i+1];
					$ordArr[$i+1] = $aux;
					$ready = false;
				}
			}
		} 
		return array_slice($ordArr, $start, $length);
	}
	
	function computeFullSearch($dbType)
	{
		$searchFor = $this->searchFor;
		switch ($dbType) {
			case 'PostgreSQL' : $this->computePostgresFullSearch(); break;
			case 'MySQL' : $this->computeMySQLFullSearch($this->searchType); break;
			case 'MsSQL' : $this->computeMsSQLFullSearch($this->searchType); break;
		}
	}
	//--------------------------------------------------------------------
	// FUNCTION:
	//   computeMySQLFullSearch
	//
	// DESCRIPTION:
	//  	Computes the SQL for the fulltext search 
	//	
	// ARGUMENTS:
	//   searchFor - search expression
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function computeMySQLFullSearch($fullType){
		$searchFor = $this->searchFor;
		if ($searchFor)	{
			$searchCond = explode(" and ", $searchFor);
			$first = true;
			for ($condIdx=0;$condIdx<count($searchCond);$condIdx++)	{
				if ($searchCond[$condIdx]!='') {
					if ($condIdx!=0) {
						$this->whereCondition .= " AND (";
					} else {
						$this->whereCondition .= " (";
					}	
					$searchCond[$condIdx] = str_replace(" or "," ", $searchCond[$condIdx]);
					if (!$first) {
						$this->orderBy .= " + ";
					} else {
						$this->orderBy .= " ( ";
					}
					$first = false;
					$this->whereCondition .= sprintf($this->sql['MySQL']['fulltext_where'][$fullType], 1, addslashes($searchCond[$condIdx]));
					$this->orderBy		.= " (".sprintf($this->sql['MySQL']['fulltext_order'][$fullType], 1, addslashes($searchCond[$condIdx]), $this->importanceArray[1]).") ";
					for ($relIdx=2; $relIdx <= 5; $relIdx++) {
						$this->orderBy		.= " + (".sprintf($this->sql['MySQL']['fulltext_order'][$fullType], $relIdx, addslashes($searchCond[$condIdx]), $this->importanceArray[$relIdx]).") ";
						$this->whereCondition .= " OR ".sprintf($this->sql['MySQL']['fulltext_where'][$fullType], $relIdx, addslashes($searchCond[$condIdx]));
					}
					$this->whereCondition .= " ) ";
				}
			}
			$this->orderBy		.= ") * importance_cah ";
			$this->searchColumns = ", ".$this->orderBy." as score ";	
			$this->orderBy		.= " DESC";
		} else {
			$this->whereCondition = " 1=-1 ";
			$this->orderBy = " importance_cah DESC ";
		}
	}
	
	function computeMsSQLFullSearch($fullType){
		$searchFor = $this->searchFor;
		if ($searchFor)	{
			$searchFor = $this->escapeChars($searchFor);
			$method = "FREETEXTTABLE";
			$this->searchColumns = ", CAST(".$this->cacheTable.".importance_cah * tbl.score AS int) AS tableScore";
			$this->searchFrom = "(
					SELECT tbl_test.myid, sum(score) AS score FROM
						(
							SELECT [key] AS myid, ([rank] * ".($this->importanceArray[1]/100).") AS score FROM
							".$method."(".$this->cacheTable.", col1_cah, '".$searchFor."')
							UNION ALL
							SELECT [key] AS myid, ([rank] * ".($this->importanceArray[2]/100).") AS score FROM
							".$method."(".$this->cacheTable.", col2_cah, '".$searchFor."')
							UNION ALL
							SELECT [key] AS myid, ([rank] * ".($this->importanceArray[3]/100).") AS score FROM
							".$method."(".$this->cacheTable.", col3_cah, '".$searchFor."')
							UNION ALL
							SELECT [key] AS myid, ([rank] * ".($this->importanceArray[4]/100).") AS score FROM
							".$method."(".$this->cacheTable.", col4_cah, '".$searchFor."')
							UNION ALL
							SELECT [key] AS myid, ([rank] * ".($this->importanceArray[5]/100).") AS score FROM
							".$method."(".$this->cacheTable.", col5_cah, '".$searchFor."')
						) AS tbl_test
					GROUP BY tbl_test.myid
				) AS tbl INNER JOIN ".$this->cacheTable." ON ".$this->cacheTable.".id_cah = tbl.myid";
				
			$this->whereCondition = " 1=1 ";
			$this->orderBy = " tbl.tableScore DESC";
		} else {
			$this->searchColumns = "";
			$this->whereCondition = " 1=-1 ";
			$this->orderBy = " id_cah ";

		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   computeOtherFullSearch
	//
	// DESCRIPTION:
	//  	Computes the SQL for the boolean fulltext search (for MySQL 4.0.1 and above)
	//	
	// ARGUMENTS:
	//   searchFor - search expression
	//
	// RETURNS:
	//   nothing
	//--------------------------------------------------------------------
	
	function computePostgresFullSearch()
	{
		$searchFor = $this->searchFor;
		if ($searchFor)	{
			$expr = "/\"([^\"]*)\"/m";
			$matches = array();
			preg_match_all($expr, $searchFor, $matches);
			$searchFor = str_replace('\"', '', $searchFor);
			$searchFor = str_replace(" and ", "&", $searchFor);
			$searchFor = str_replace(" or ","|", $searchFor);
			$searchFor = str_replace(" ","|", $searchFor);
			$this->whereCondition .= " (".sprintf($this->sql['PostgreSQL']['fulltext_where']['fulltext'], 1, addslashes($searchFor))." ";
			$this->orderBy		.= " ((".sprintf($this->sql['PostgreSQL']['fulltext_order']['fulltext'], 1, addslashes($searchFor), $this->importanceArray[1]).") ";
			for ($relIdx=2; $relIdx <= 5; $relIdx++) {
				$this->orderBy		.= " + (".sprintf($this->sql['PostgreSQL']['fulltext_order']['fulltext'], $relIdx, addslashes($searchFor), $this->importanceArray[$relIdx]).") ";
				$this->whereCondition .= " OR ".sprintf($this->sql['PostgreSQL']['fulltext_where']['fulltext'], $relIdx, addslashes($searchFor))." ";
			}
			$this->whereCondition .= " ) ";
			if (is_array($matches[1])) {
				foreach ($matches[1] as $key=>$value) {	
					$this->whereCondition .= " AND ( ";
					for ($relIdx=1; $relIdx <= 5; $relIdx++) {
						if ($relIdx!=1) {
							$this->whereCondition .= " OR ";
						}
						$this->whereCondition .= " (col".$relIdx."_cah ".$this->sql['PostgreSQL']['like']." '%".addslashes($value)."%') ";	
					}
					$this->whereCondition .= " ) ";
				} 
			}
			$this->orderBy		.= ") * importance_cah ";
			$this->searchColumns = ", ".$this->orderBy." as score ";	
			$this->orderBy		.= " DESC";
		} else {
			$this->whereCondition = " 1=-1 ";
			$this->orderBy = " importance_cah DESC ";
		}
	}
	
	
	function getKeywords() {
		if ($this->searchFor) {
			return stripslashes(str_replace('"', '&quot;', $this->searchFor)); 
		} else {
			return '';
		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   getSearchColumns
	//
	// DESCRIPTION:
	//   Gets the aditional search columns
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   String with the column names or false if no aditional search columns
	//--------------------------------------------------------------------
	
	function getSearchColumns() {
		if (isset($this->searchColumns))
			return $this->searchColumns;
		else
			return false;
	}
	
	function getSearchFrom() {
		if (isset($this->searchFrom)) {
			return $this->searchFrom;
		} else {
			return $this->cacheTable;
		}
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   getWhereConditions
	//
	// DESCRIPTION:
	//   Gets the where conditions for the SQL in the Advanced Recordset
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   String with the conditions or false if none defined
	//--------------------------------------------------------------------
	
	function getWhereCondition(){
		if (isset($this->whereCondition))
			return $this->whereCondition;
		else
			return false;
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   getOrderBy
	//
	// DESCRIPTION:
	//   Gets the order by statement for the SQL in the Advanced Recordset
	//
	// ARGUMENTS:
	//   none
	//
	// RETURNS:
	//   String with the order by statement or false if not defined
	//--------------------------------------------------------------------
	
	function getOrderBy(){
		if (isset($this->orderBy))
			return $this->orderBy;
		else
			return false;
	}
	
	//--------------------------------------------------------------------
	// FUNCTION:
	//   formatDescription
	//
	// DESCRIPTION:
	//   Formats the description of each result for hilighting the found words
	//
	// ARGUMENTS:
	//   text - the description text
	//
	// RETURNS:
	//   the formatted text
	//--------------------------------------------------------------------
	
	function cleanText($text)
	{
		$text = stripslashes(str_replace(array(" and "," or ","\""), " ", strtolower($text)));
		return $text;
	}

	function formatDescription($text){
		$maxChars = 100;
		$font = array(0=>"<span class=\"highlight\">",1=>"</span>");
		$searchFor = $this->searchFor;
		if(!trim($text)) //empty result
			return "";
		$ltext		= strtolower($text);
		if ($this->databaseType=='MySQL' && $this->searchType=='fulltext') {
			$searchFor = $this->cleanText($searchFor);
		}
		$expr = "/\"([^\"]*)\"/m";
		$matches = array();
		preg_match_all($expr, $searchFor, $matches);
		$searchFor = preg_replace($expr,"",$searchFor);
		$searchFor = $this->cleanText($searchFor);		
		$arrSearchFor 	= explode(" ",$searchFor);
		if (is_array($matches[1])) {
			foreach($matches[1] as $key=>$value) {
				array_push($arrSearchFor, $value);
			}
		}
		if (strlen($text) > 100) {
			foreach ($arrSearchFor as $key=>$value) {
				if ($value!='') {	
					$pos = strpos($ltext, $value);
					if ($pos) break;
				}
			}
			$leftLength = $pos;
			$rightLength = strlen(substr($ltext, $pos));
			if ($leftLength < 50) {
				$start = 0;
				$startStr = "";
				$endStr = "...";
			} else if ($rightLength < 50) {
				$start = $pos - (100 - $rightLength);
				$startStr = "...";
				$endStr = "";
			} else {
				$start = $pos - 50;
				$startStr = "...";
				$endStr = "...";
			}
			$firstSpace = 0;
			$lastSpace = strlen($text);
			if ($start!=0) {
				$firstSpace = strrpos(substr($text, 0, $start), " ");
			}
			if ($start + 100 <strlen($text)) {
				$lastSpace = strpos($text, " ", $start + 100);
			}
			$text = $startStr.substr($text, $firstSpace, $lastSpace - $firstSpace).$endStr;		
		} 
		
		$ltext = strtolower($text);
		$indexArr = array();	
		for ($i=0;$i<count($arrSearchFor);$i++) {
			if ($arrSearchFor[$i]!='') {
				$offset = 0;
				for ($j=0;$j<substr_count($ltext, $arrSearchFor[$i]);$j++) {
						$offset = strpos($ltext, $arrSearchFor[$i], $offset);
						$indexArr[] = array($offset, 0, $i);
						$offset += strlen($arrSearchFor[$i]);
						$indexArr[] = array($offset, 1);
				}
			}
		}
		$ready=false;
		while(!$ready) {
			$ready = true;
			for($i=0;$i<count($indexArr)-1;$i++) {
				if ($indexArr[$i][0]>$indexArr[$i+1][0]) {
					$aux = $indexArr[$i];
					$indexArr[$i] = $indexArr[$i+1];
					$indexArr[$i+1] = $aux;
					$ready = false;
				}
			}
		} 
		$displayText = "";
		$end = 0;
		for ($i=0; $i<count($indexArr); $i++) {
			if ($i!=0) {
				$start = $indexArr[$i-1][0];
			} else {
				$start = 0;
			}
			$end = $indexArr[$i][0];
			$type = $indexArr[$i][1];
			$displayText .= substr($text, $start, $end-$start).$font[$type];
		}
		$displayText .= substr($text, $end);
		return $displayText;
	}
}
//end class
?>