<?php
class MX_RssReader {
	var $tempFolder;
	var $cacheTime;
	var $depthArr;
	var $fakeRsArr;
	var $supported;
	var $recCount;
	var $error;
	
	function MX_RssReader() {
		$this->tempFolder=dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
		
		$this->cacheTime = 0;
		$this->depthArr = array();
		$this->fakeRsArr = array();
		$this->supported=array(
			'channel' => array('channel_title','channel_link','channel_description', 'channel_pubdate','channel_copyright', 'channel_lastbuilddate', 'channel_image'), 
			'item' => array('item_title', 'item_description', 'item_link', 'item_author', 'item_pubdate', 'item_category', 'item_source', 'item_source_url'));
		$this->error='';
	}
	
	function setConnection(&$connection) {
		$this->connection = &$connection;
	}
	
	function setCacheTime($cacheTime) {
		$this->cacheTime = $cacheTime;
	}
	
	function getFeed($uri) {
		$fileName = $this->getCacheFileName($uri);
		$this->checkTempFolder();
		$this->clearTempFolder();
		clearstatcache();
		if ($this->error == '') {
			$f = @fopen($fileName, 'a+');
			if (is_resource($f) && flock($f, LOCK_EX)) {
				$props = fstat($f);
				if ($props['mtime'] + 60 * $this->cacheTime > time() && $props['size'] > 0) {
					//echo "From Cache\n";
					fseek($f, 0);
					$xmlRSS = fread($f, filesize($fileName));
				} else {
					//echo "From URI\n";
					ftruncate($f, 0);
					$xmlRSS = $this->getContentFromURI($uri);
					if (strstr($xmlRSS, 'xmlns:dc=') !== false) {
						$xmlRSS = preg_replace("/dc:title>/", "title>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:description>/", "description>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:date>/", "pubDate>", $xmlRSS);
						$xmlRSS = preg_replace("/date>/", "pubDate>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:rights>/", "copyright>", $xmlRSS);
						
						$xmlRSS = preg_replace("/dc:creator>/", "author>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:subject>/", "category>", $xmlRSS);
						
						$xmlRSS = preg_replace("/dc:source>/", "source>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:language>/", "language>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:identifier>/", "identifier>", $xmlRSS);
					}
					if (strstr($xmlRSS, '<rdf:RDF') !== false) {
						$pos = strpos($xmlRSS, '?'.'>');
						if ($pos !== false) {
							$xmlHead = substr($xmlRSS, 0, $pos+2);
							$xmlRSS = substr($xmlRSS, $pos+2);
						} else {
							$xmlHead = '';
						}
						$xmlRSS = preg_replace("/<image\s[^>]*\/>/i", "", $xmlRSS);
						$xmlRSS = preg_replace("/<items>.*?<\/items>/msi", "", $xmlRSS);
						$xmlRSS = preg_replace("/<\/channel>/i", "", $xmlRSS);
						$xmlRSS = preg_replace("/(<\/rdf:RDF>)/i", "</channel>$1", $xmlRSS);
						$xmlRSS = preg_replace("/rdf:RDF/i", "rss", $xmlRSS);
						$xmlRSS = preg_replace("/<content:encoded>/i", "<description>", $xmlRSS);
						$xmlRSS = preg_replace("/<\/content:encoded>/i", "</description>", $xmlRSS);
						
						$xmlRSS = preg_replace("/dc:title>/", "title>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:description>/", "description>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:date>/", "pubDate>", $xmlRSS);
						$xmlRSS = preg_replace("/date>/", "pubDate>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:rights>/", "copyright>", $xmlRSS);
						
						$xmlRSS = preg_replace("/dc:creator>/", "author>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:subject>/", "category>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:source>/", "source>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:language>/", "language>", $xmlRSS);
						$xmlRSS = preg_replace("/dc:identifier>/", "identifier>", $xmlRSS);
						
						$xmlRSS = preg_replace("/\w+:\w+=\".*?\"/", "", $xmlRSS);
						$xmlRSS = preg_replace("/\w+:\w+='.*?'/", "", $xmlRSS);
						$xmlRSS = preg_replace("/\s*>/", ">", $xmlRSS);
						$xmlRSS = $xmlHead.$xmlRSS;
					}
					fwrite($f, $xmlRSS);
				}
				flock($f, LOCK_UN);
			} else {
				die('Could not lock() the cache file !');
			}
			fclose($f);
		}
		if ($this->error == '') {
			$this->parseRssXml($xmlRSS);
		}
		if ($this->error == '') {
			$this->validateRss();
		}
	}
	
	function doFakeRsArr() {
		$this->fakeRsArr['item'] = array();
		foreach($this->depthArr['child'][0]['child'] as $pos => $tmpNode) {
			if ($tmpNode['name'] == 'item') {
				$tmpArr = array();
				if (isset($tmpNode['child'])) {
					foreach($tmpNode['child'] as $pos =>$tmpItemNode) {
						$tmpArr['item_'.$tmpItemNode['name']] = $tmpItemNode['text'];
						foreach($tmpItemNode['attrs'] as $attrName =>$attrValue) {
							$tmpArr['item_'.$tmpItemNode['name'].'_'.$attrName] = $attrValue;
						}
					}
				}
				$this->fakeRsArr['item'][] = $tmpArr;
			} else {
				if ($tmpNode['name'] == 'image') {
					$imgProps = array();
					foreach($tmpNode['child'] as $pos =>$tmpItemNode) {
						$imgProps[$tmpItemNode['name']] = $tmpItemNode['text'];
					}
					$img = '<img src="'.htmlspecialchars($imgProps['url']).'" alt="'.htmlspecialchars($imgProps['title']).'"';
					if (isset($imgProps['width'])) {
						$img .= ' width="'.$imgProps['width'].'"';
					}
					if (isset($imgProps['height'])) {
						$img .= ' height="'.$imgProps['height'].'"';
					}
					$img .= '/>';
					$link = '<a href="'.$imgProps['link'].'"';
					if (isset($imgProps['description'])) {
						$link .= ' title="'.htmlspecialchars ($imgProps['description']).'"';
					}
					$img = $link.'>'.$img.'</a>';					
					$this->fakeRsArr['channel_image'] = $img;
				} else {
					$this->fakeRsArr['channel_'.$tmpNode['name']] = $tmpNode['text'];
				}
			}
		}
		return true;
	}
	
	
	function getContentFromURI($uri) {
		$buf = '';
		if (ini_get('allow_url_fopen')) {
			$f = @fopen($uri,'rb');
			if (is_resource($f)) {
				while (!feof($f)) {
					$buf .= fread($f, 8192);
				}
				fclose($f);
			} else {
				die('Error opening:\''.$uri.'\'');
			}
		} else {
			die('Please enable \'allow_url_fopen\' in php.ini.');
		}
		return $buf;
	}
	
	function &getRssRecordset($from = '', $count = '') {
		if ($this->error === '') {
			$this->doFakeRsArr();
		}
		$ret = false;
		if (count($this->fakeRsArr) == 0) {
			return $ret;
		}

		foreach ($this->fakeRsArr['item'] as $key=>$value) {
			foreach ($value as $itemkey=>$itemvalue) {
				$arr[$key][$itemkey] = $itemvalue;
			}
			foreach ($this->fakeRsArr as $channelkey=>$channelvalue) {
				if ($channelkey!='item') {
					$arr[$key][$channelkey] = $channelvalue;
				}
			}
		}	
		
		if ($from !== '' && $count !=='') {
			$arr = array_slice($arr, $from, $count);
		}	
		$rs = new MX_RssFakeRs($arr);

		return $rs;
	}
	
	function recordCount() {
		if (count($this->fakeRsArr) > 0) {
			return count($this->fakeRsArr['item']);
		}
		return 0;
	}
	
	function createRecordset() {
		$createSQL = 'CREATE TEMPORARY TABLE fakeRecordSetTmp (';
		$insertSQL = 'INSERT INTO fakeRecordSetTmp (';
		$valuesSQL = '';
		foreach($this->supported['channel'] as $key) {
			$createSQL .= $key . ' TEXT ,';
			$insertSQL .= $key . ',';
			if (isset($this->fakeRsArr[$key])) {
				$value = $this->fakeRsArr[$key];
			} else {
				$value = '';
			}
			
			$valuesSQL .= "'".$this->prepareValue($value)."',";
		}
		foreach($this->supported['item'] as $key) {
			$createSQL .= $key . ' TEXT ,';
			$insertSQL .= $key . ',';
		}
		$createSQL = substr($createSQL,0,-1);
		$createSQL .= ')';
		
		$insertSQLS = array();
		
		if ($this->error === '') {
			$insertSQL = substr($insertSQL,0,-1);
			$valuesSQL = substr($valuesSQL,0,-1);
			$insertSQL .= ') VALUES ('.$valuesSQL;
			
			$i = 0;
			foreach($this->fakeRsArr['item'] as $detArr) {
				$insertSQLS[$i] = '';
				foreach($this->supported['item'] as $key) {
					if (isset($detArr[$key])) {
						$insertSQLS[$i] .= ",'".$this->prepareValue($detArr[$key])."'";
					} else {
						$insertSQLS[$i] .= ",''";
					}
				}
				$i++;
			}
			for($i=0;$i<count($insertSQLS);$i++) {
				$insertSQLS[$i] =$insertSQL.$insertSQLS[$i]. ');';
			}
		}
		mysql_select_db($this->database, $this->connection);
		mysql_query("DROP TABLE IF EXISTS fakeRecordSetTmp", $this->connection) or die(mysql_error());
		mysql_query($createSQL, $this->connection) or die(mysql_error().'<br/>' . $createSQL);
		for ($i=0;$i<sizeof($insertSQLS);$i++) {
			mysql_query($insertSQLS[$i], $this->connection) or die(mysql_error().'<br/>'. $insertSQLS[$i]);
		}
	}
	
	function prepareValue($value) {	
		return str_replace(array("'", "\\"), array("''", "\\\\"), $value);
	}
	
	function checkTempFolder() {
		clearstatcache();
		if (!file_exists($this->tempFolder)) {
			$folder = dirname(__FILE__);
			$arrFld = explode(DIRECTORY_SEPARATOR, substr($this->tempFolder, strlen($folder) + 1));
			foreach($arrFld as $tmpDir) {
				$newFolder = $folder . DIRECTORY_SEPARATOR . $tmpDir;
				if (!file_exists($newFolder)) {
					if (is_writable($folder)) {
						mkdir($newFolder,0700);
					} else {
						$this->error = 'MX_RssReader Error<br/>Error while creating the temporary cache folder: \''.$newFolder.'\'. Please set appropriate permissions.';
						return;
					}
				}
				$folder .= DIRECTORY_SEPARATOR . $tmpDir;
			}
		}
		if (!is_writable($this->tempFolder)) {
			$this->error = 'MX_RssReader Error<br/>Temporary cache folder is not writtable. Please set appropriate permissions.';
			return;
		}
	}
	
	function clearTempFolder() {
		if ($this->error == '') {
			$d = dir($this->tempFolder);
			clearstatcache();
			while (false !== ($f = $d->read())) {
				if ($f != '.' && $f != '..') {
					$props = stat($d->path . $f);
					if ($props['mtime'] + 60 * $this->cacheTime < time() && $props['size'] > 0) {
						@unlink($d->path . $f);
					}
				}
			}
			$d->close();
		}
	}
	
	function getCacheFileName($uri) {
		return $this->tempFolder . "/" . md5($uri) . '.rss.cache';
	}
	
	function getError() {
		return $this->error;
	}
	
	
	/* Rss Validation Functions */
	function validateRss() {
		if ($this->depthArr['name'] != 'rss') {
			$this->error = 'MX_RssReader Error<br/>The requested file is not a valid RSS ! (Root node is not &lt;rss&gt;)';
			return false;
		}
		if (count($this->depthArr['child']) != 1) {
			$this->error = 'MX_RssReader Error<br/>The requested file is not a valid RSS ! (More than one child node for &lt;rss&gt; node)';
			return false;
		}
		return $this->validateChannel($this->depthArr['child'][0]);
	}
	
	function validateChannel(&$channelNode) {
		if ($channelNode['name'] != 'channel') {
			$this->error = 'MX_RssReader Error<br/>The requested file is not a valid RSS ! (Child node of &lt;rss&gt; node is not &lt;channel&gt;)';
			return false;
		}
		$nItems = 0;
		for($i=0;$i<count($channelNode['child']);$i++) {
			if ($channelNode['child'][$i]['name'] == 'item') {
				$nItems++;
				if ($this->validateItem($channelNode['child'][$i]) == false) {
					return false;
				}
			}
		}
		if ($nItems == 0) {
			$this->error = 'MX_RssReader Error<br/>The requested file is not a valid RSS ! (No &lt;item&gt; nodes inside &lt;channel&gt;)';
			return false;
		}
	}
	
	function validateItem(&$tmpNode) {
		if (count($tmpNode['child']) == 0) {
			$this->error = 'MX_RssReader Error<br/>The requested file is not a valid RSS ! (No nodes inside &lt;item&gt;)';
			return false;
		}
		return true;
	}
	
	/* XML parse functions */
	function parseRssXml($xml) {
		$encoding = 'UTF-8';
		if (preg_match("/<\?xml.*?encoding\s*=\s*[\"'](.*?)[\"'].*?\?>/is", $xml, $matches)) {
			$encoding = strtoupper($matches[1]);
			if ($encoding != 'ISO-8859-1' && $encoding != 'UTF-8') {
				if (!function_exists('mb_convert_encoding')) {
					$this->error = "MX_RssReader Error<br/>The source XML has a '".$encoding."' encoding. Please enable mbstring extension from php.ini, so the file can be converted to 'UTF-8' encoding.";
					return;
				}
				$xml = preg_replace("/(<\?xml.*?encoding\s*=\s*[\"'])(.*?)([\"'].*?\?>)/is", '$1UTF-8$3', $xml);
				$xml = mb_convert_encoding($xml, 'UTF-8', $encoding);
				$encoding = 'UTF-8';
			}
		}
		$this->parser = xml_parser_create($encoding);
		xml_set_object($this->parser, $this);
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
		xml_set_element_handler($this->parser, 'startElement', 'endElement');
		xml_set_character_data_handler($this->parser, 'characterData');
		$error = xml_parse($this->parser,$xml,true);
		if ($error == false) {
			$this->error = sprintf('MX_RssReader Error<br/>The RSS feed is not a valid XML. (Parse error: %s at line %d)',
			  xml_error_string(xml_get_error_code($this->parser)),
			  xml_get_current_line_number($this->parser));
		  return false;
		}
		xml_parser_free($this->parser);
		$this->depthArr = $this->depthArr[-1]['child'][0];
		return true;
	}
	
	function startElement($parser, $name, $attrs) {
		$name= strtolower($name);
		foreach($attrs as $key => $value) {
			$attrs[$key] = strtolower($value);
		}
		array_push($this->depthArr, array('name'=>$name, 'attrs' => $attrs , 'text' => '', 'child' => array()));
	}
  
	function endElement($parser, $name) {
		$name= strtolower($name);
		$strPath = '';
		foreach($this->depthArr as $tmpPos => $tmpNode) {
			if ($strPath == '') {
				$strPath = $tmpNode['name'];
			} else {
				$strPath = $strPath . '_' . $tmpNode['name'];
			}
		}
		$tmpNode = array_pop($this->depthArr);
		$this->depthArr[count($this->depthArr) -1]['child'][] = $tmpNode;
	}
  
	function characterData($parser, $data) {
		$this->depthArr[count($this->depthArr)-1]['text'] .= $data;
	}
}
?>
