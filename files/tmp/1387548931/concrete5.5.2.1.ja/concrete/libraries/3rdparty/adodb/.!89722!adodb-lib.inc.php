<?php




// security - hide paths
if (!defined('ADODB_DIR')) die();

global $ADODB_INCLUDED_LIB;
$ADODB_INCLUDED_LIB = 1;

/* 
 @version V5.06 16 Oct 2008  (c) 2000-2009 John Lim (jlim\@natsoft.com.my). All rights reserved.
  Released under both BSD license and Lesser GPL library license. 
  Whenever there is any discrepancy between the two licenses, 
  the BSD license will take precedence. See License.txt. 
  Set tabs to 4 for best viewing.
  
  Less commonly used functions are placed here to reduce size of adodb.inc.php. 
*/ 

function adodb_strip_order_by($sql)
{
	$rez = preg_match('/(\sORDER\s+BY\s[^)]*)/is',$sql,$arr);
	if ($arr)
		if (strpos($arr[0],'(') !== false) {
			$at = strpos($sql,$arr[0]);
			$cntin = 0;
			for ($i=$at, $max=strlen($sql); $i < $max; $i++) {
				$ch = $sql[$i];
				if ($ch == '(') {
					$cntin += 1;
				} elseif($ch == ')') {
					$cntin -= 1;
					if ($cntin < 0) {
						break;
					}
				}
			}
			$sql = substr($sql,0,$at).substr($sql,$i);
		} else
			$sql = str_replace($arr[0], '', $sql); 
	return $sql;
 }

if (false) {
	$sql = 'select * from (select a from b order by a(b),b(c) desc)';
	$sql = '(select * from abc order by 1)';
	die(adodb_strip_order_by($sql));
}

function adodb_probetypes(&$array,&$types,$probe=8)
{
// probe and guess the type
	$types = array();
	if ($probe > sizeof($array)) $max = sizeof($array);
	else $max = $probe;
	
	
	for ($j=0;$j < $max; $j++) {
		$row = $array[$j];
		if (!$row) break;
		$i = -1;
		foreach($row as $v) {
			$i += 1;

			if (isset($types[$i]) && $types[$i]=='C') continue;
			
			//print " ($i ".$types[$i]. "$v) ";
			$v = trim($v);
			
			if (!preg_match('/^[+-]{0,1}[0-9\.]+$/',$v)) {
				$types[$i] = 'C'; // once C, always C
				
				continue;
			}
			if ($j == 0) { 
			// If empty string, we presume is character
			// test for integer for 1st row only
			// after that it is up to testing other rows to prove
			// that it is not an integer
				if (strlen($v) == 0) $types[$i] = 'C';
				if (strpos($v,'.') !== false) $types[$i] = 'N';
				else  $types[$i] = 'I';
				continue;
			}
			
			if (strpos($v,'.') !== false) $types[$i] = 'N';
			
		}
	}
	
}

function  adodb_transpose(&$arr, &$newarr, &$hdr, &$fobjs)
{
	$oldX = sizeof(reset($arr));
	$oldY = sizeof($arr);	
	
	if ($hdr) {
		$startx = 1;
		$hdr = array('Fields');
		for ($y = 0; $y < $oldY; $y++) {
			$hdr[] = $arr[$y][0];
		}
	} else
		$startx = 0;

	for ($x = $startx; $x < $oldX; $x++) {
		if ($fobjs) {
			$o = $fobjs[$x];
			$newarr[] = array($o->name);
		} else
			$newarr[] = array();
			
		for ($y = 0; $y < $oldY; $y++) {
			$newarr[$x-$startx][] = $arr[$y][$x];
		}
	}
}

// Force key to upper. 
// See also http://www.php.net/manual/en/function.array-change-key-case.php
function _array_change_key_case($an_array)
{
	if (is_array($an_array)) {
		$new_array = array();
		foreach($an_array as $key=>$value)
			$new_array[strtoupper($key)] = $value;

	   	return $new_array;
   }

	return $an_array;
}

function _adodb_replace(&$zthis, $table, $fieldArray, $keyCol, $autoQuote, $has_autoinc)
{
		if (count($fieldArray) == 0) return 0;
		$first = true;
		$uSet = '';
		
		if (!is_array($keyCol)) {
			$keyCol = array($keyCol);
		}
		foreach($fieldArray as $k => $v) {
			if ($v === null) {
				$v = 'NULL';
				$fieldArray[$k] = $v;
			} else if ($autoQuote && /*!is_numeric($v) /*and strncmp($v,"'",1) !== 0 -- sql injection risk*/ strcasecmp($v,$zthis->null2null)!=0) {
				$v = $zthis->qstr($v);
				$fieldArray[$k] = $v;
			}
			if (in_array($k,$keyCol)) continue; // skip UPDATE if is key
			
			if ($first) {
				$first = false;			
				$uSet = "$k=$v";
			} else
				$uSet .= ",$k=$v";
		}
		
		$where = false;
		foreach ($keyCol as $v) {
			if (isset($fieldArray[$v])) {
				if ($where) $where .= ' and '.$v.'='.$fieldArray[$v];
				else $where = $v.'='.$fieldArray[$v];
			}
		}
		
		if ($uSet && $where) {
			$update = "UPDATE $table SET $uSet WHERE $where";

			$rs = $zthis->Execute($update);
			
			
			if ($rs) {
				if ($zthis->poorAffectedRows) {
				/*
				 The Select count(*) wipes out any errors that the update would have returned. 
				http://phplens.com/lens/lensforum/msgs.php?id=5696
				*/
					if ($zthis->ErrorNo()<>0) return 0;
					
				# affected_rows == 0 if update field values identical to old values
				# for mysql - which is silly. 
			
					$cnt = $zthis->GetOne("select count(*) from $table where $where");
					if ($cnt > 0) return 1; // record already exists
				} else {
					if (($zthis->Affected_Rows()>0)) return 1;
				}
			} else
				return 0;
		}
		
	//	print "<p>Error=".$this->ErrorNo().'<p>';
		$first = true;
		foreach($fieldArray as $k => $v) {
			if ($has_autoinc && in_array($k,$keyCol)) continue; // skip autoinc col
			
			if ($first) {
				$first = false;			
				$iCols = "$k";
				$iVals = "$v";
			} else {
				$iCols .= ",$k";
				$iVals .= ",$v";
			}				
		}
		$insert = "INSERT INTO $table ($iCols) VALUES ($iVals)"; 
		$rs = $zthis->Execute($insert);
		return ($rs) ? 2 : 0;
}

// Requires $ADODB_FETCH_MODE = ADODB_FETCH_NUM
function _adodb_getmenu(&$zthis, $name,$defstr='',$blank1stItem=true,$multiple=false,
			$size=0, $selectAttr='',$compareFields0=true)
{
	$hasvalue = false;

	if ($multiple or is_array($defstr)) {
		if ($size==0) $size=5;
		$attr = ' multiple size="'.$size.'"';
		if (!strpos($name,'[]')) $name .= '[]';
	} else if ($size) $attr = ' size="'.$size.'"';
	else $attr ='';
	
	$s = '<select name="'.$name.'"'.$attr.' '.$selectAttr.'>';
	if ($blank1stItem) 
		if (is_string($blank1stItem))  {
			$barr = explode(':',$blank1stItem);
			if (sizeof($barr) == 1) $barr[] = '';
			$s .= "\n<option value=\"".$barr[0]."\">".$barr[1]."</option>";
		} else $s .= "\n<option></option>";

	if ($zthis->FieldCount() > 1) $hasvalue=true;
	else $compareFields0 = true;
	
	$value = '';
    $optgroup = null;
    $firstgroup = true;
    $fieldsize = $zthis->FieldCount();
	while(!$zthis->EOF) {
		$zval = rtrim(reset($zthis->fields));

		if ($blank1stItem && $zval=="") {
			$zthis->MoveNext();
			continue;
		}

        if ($fieldsize > 1) {
			if (isset($zthis->fields[1]))
				$zval2 = rtrim($zthis->fields[1]);
			else
				$zval2 = rtrim(next($zthis->fields));
		}
		$selected = ($compareFields0) ? $zval : $zval2;
		
        $group = '';
		if ($fieldsize > 2) {
            $group = rtrim($zthis->fields[2]);
        }
/* 
        if ($optgroup != $group) {
            $optgroup = $group;
            if ($firstgroup) {
                $firstgroup = false;
                $s .="\n<optgroup label='". htmlspecialchars($group) ."'>";
            } else {
                $s .="\n</optgroup>";
                $s .="\n<optgroup label='". htmlspecialchars($group) ."'>";
            }
		}
*/
		if ($hasvalue) 
			$value = " value='".htmlspecialchars($zval2)."'";
		
		if (is_array($defstr))  {
			
			if (in_array($selected,$defstr)) 
				$s .= "\n<option selected='selected'$value>".htmlspecialchars($zval).'</option>';
			else 
				$s .= "\n<option".$value.'>'.htmlspecialchars($zval).'</option>';
		}
		else {
			if (strcasecmp($selected,$defstr)==0) 
				$s .= "\n<option selected='selected'$value>".htmlspecialchars($zval).'</option>';
			else
				$s .= "\n<option".$value.'>'.htmlspecialchars($zval).'</option>';
		}
		$zthis->MoveNext();
	} // while
	
    // closing last optgroup
    if($optgroup != null) {
        $s .= "\n</optgroup>";
	}
	return $s ."\n</select>\n";
}

// Requires $ADODB_FETCH_MODE = ADODB_FETCH_NUM
function _adodb_getmenu_gp(&$zthis, $name,$defstr='',$blank1stItem=true,$multiple=false,
			$size=0, $selectAttr='',$compareFields0=true)
{
	$hasvalue = false;

	if ($multiple or is_array($defstr)) {
		if ($size==0) $size=5;
		$attr = ' multiple size="'.$size.'"';
		if (!strpos($name,'[]')) $name .= '[]';
	} else if ($size) $attr = ' size="'.$size.'"';
	else $attr ='';
	
	$s = '<select name="'.$name.'"'.$attr.' '.$selectAttr.'>';
	if ($blank1stItem) 
		if (is_string($blank1stItem))  {
			$barr = explode(':',$blank1stItem);
			if (sizeof($barr) == 1) $barr[] = '';
			$s .= "\n<option value=\"".$barr[0]."\">".$barr[1]."</option>";
		} else $s .= "\n<option></option>";

	if ($zthis->FieldCount() > 1) $hasvalue=true;
	else $compareFields0 = true;
	
	$value = '';
    $optgroup = null;
    $firstgroup = true;
    $fieldsize = sizeof($zthis->fields);
	while(!$zthis->EOF) {
		$zval = rtrim(reset($zthis->fields));

		if ($blank1stItem && $zval=="") {
			$zthis->MoveNext();
			continue;
		}

        if ($fieldsize > 1) {
			if (isset($zthis->fields[1]))
				$zval2 = rtrim($zthis->fields[1]);
			else
				$zval2 = rtrim(next($zthis->fields));
		}
		$selected = ($compareFields0) ? $zval : $zval2;
		
        $group = '';
		if (isset($zthis->fields[2])) {
            $group = rtrim($zthis->fields[2]);
        }
 
        if ($optgroup != $group) {
            $optgroup = $group;
            if ($firstgroup) {
                $firstgroup = false;
                $s .="\n<optgroup label='". htmlspecialchars($group) ."'>";
            } else {
                $s .="\n</optgroup>";
                $s .="\n<optgroup label='". htmlspecialchars($group) ."'>";
            }
		}
	
		if ($hasvalue) 
			$value = " value='".htmlspecialchars($zval2)."'";
		
		if (is_array($defstr))  {
			
			if (in_array($selected,$defstr)) 
				$s .= "\n<option selected='selected'$value>".htmlspecialchars($zval).'</option>';
			else 
				$s .= "\n<option".$value.'>'.htmlspecialchars($zval).'</option>';
		}
		else {
			if (strcasecmp($selected,$defstr)==0) 
				$s .= "\n<option selected='selected'$value>".htmlspecialchars($zval).'</option>';
			else
				$s .= "\n<option".$value.'>'.htmlspecialchars($zval).'</option>';
		}
		$zthis->MoveNext();
	} // while
	
    // closing last optgroup
    if($optgroup != null) {
        $s .= "\n</optgroup>";
	}
	return $s ."\n</select>\n";
}


/*
	Count the number of records this sql statement will return by using
	query rewriting heuristics...
	
	Does not work with UNIONs, except with postgresql and oracle.
	
	Usage:
	
	$conn->Connect(...);
	$cnt = _adodb_getcount($conn, $sql);
	
*/
function _adodb_getcount(&$zthis, $sql,$inputarr=false,$secs2cache=0) 
{
	$qryRecs = 0;
	
	 if (!empty($zthis->_nestedSQL) || preg_match("/^\s*SELECT\s+DISTINCT/is", $sql) || 
	 	preg_match('/\s+GROUP\s+BY\s+/is',$sql) || 
		preg_match('/\s+UNION\s+/is',$sql)) {
		
		$rewritesql = adodb_strip_order_by($sql);
		
		// ok, has SELECT DISTINCT or GROUP BY so see if we can use a table alias
		// but this is only supported by oracle and postgresql...
		if ($zthis->dataProvider == 'oci8') {
			// Allow Oracle hints to be used for query optimization, Chris Wrye
			if (preg_match('#/\\*+.*?\\*\\/#', $sql, $hint)) {
				$rewritesql = "SELECT ".$hint[0]." COUNT(*) FROM (".$rewritesql.")"; 
			} else
				$rewritesql = "SELECT COUNT(*) FROM (".$rewritesql.")"; 
			
		} else if (strncmp($zthis->databaseType,'postgres',8) == 0 || strncmp($zthis->databaseType,'mysql',5) == 0)  {
			$rewritesql = "SELECT COUNT(*) FROM ($rewritesql) _ADODB_ALIAS_";
		} else {
			$rewritesql = "SELECT COUNT(*) FROM ($rewritesql)";
		}
	} else {
		// now replace SELECT ... FROM with SELECT COUNT(*) FROM
		$rewritesql = preg_replace(
					'/^\s*SELECT\s.*\s+FROM\s/Uis','SELECT COUNT(*) FROM ',$sql);
		// fix by alexander zhukov, alex#unipack.ru, because count(*) and 'order by' fails 
		// with mssql, access and postgresql. Also a good speedup optimization - skips sorting!
		// also see http://phplens.com/lens/lensforum/msgs.php?id=12752
		$rewritesql = adodb_strip_order_by($rewritesql);
	}
	
	if (isset($rewritesql) && $rewritesql != $sql) {
		if (preg_match('/\sLIMIT\s+[0-9]+/i',$sql,$limitarr)) $rewritesql .= $limitarr[0];
		 
		if ($secs2cache) {
			// we only use half the time of secs2cache because the count can quickly
			// become inaccurate if new records are added
			$qryRecs = $zthis->CacheGetOne($secs2cache/2,$rewritesql,$inputarr);
			
		} else {
			$qryRecs = $zthis->GetOne($rewritesql,$inputarr);
	  	}
		if ($qryRecs !== false) return $qryRecs;
	}
	//--------------------------------------------
	// query rewrite failed - so try slower way...
	
	
	// strip off unneeded ORDER BY if no UNION
	if (preg_match('/\s*UNION\s*/is', $sql)) $rewritesql = $sql;
	else $rewritesql = $rewritesql = adodb_strip_order_by($sql); 
	
	if (preg_match('/\sLIMIT\s+[0-9]+/i',$sql,$limitarr)) $rewritesql .= $limitarr[0];
		
	$rstest = $zthis->Execute($rewritesql,$inputarr);
	if (!$rstest) $rstest = $zthis->Execute($sql,$inputarr);
	
	if ($rstest) {
	  		$qryRecs = $rstest->RecordCount();
		if ($qryRecs == -1) { 
		global $ADODB_EXTENSION;
		// some databases will return -1 on MoveLast() - change to MoveNext()
			if ($ADODB_EXTENSION) {
				while(!$rstest->EOF) {
					adodb_movenext($rstest);
				}
			} else {
				while(!$rstest->EOF) {
					$rstest->MoveNext();
				}
			}
			$qryRecs = $rstest->_currentRow;
		}
		$rstest->Close();
		if ($qryRecs == -1) return 0;
	}
	return $qryRecs;
}

/*
 	Code originally from "Cornel G" <conyg@fx.ro>

	This code might not work with SQL that has UNION in it	
	
	Also if you are using CachePageExecute(), there is a strong possibility that
	data will get out of synch. use CachePageExecute() only with tables that
	rarely change.
*/
function _adodb_pageexecute_all_rows(&$zthis, $sql, $nrows, $page, 
						$inputarr=false, $secs2cache=0) 
{
	$atfirstpage = false;
	$atlastpage = false;
	$lastpageno=1;

	// If an invalid nrows is supplied, 
	// we assume a default value of 10 rows per page
	if (!isset($nrows) || $nrows <= 0) $nrows = 10;

	$qryRecs = false; //count records for no offset
	
	$qryRecs = _adodb_getcount($zthis,$sql,$inputarr,$secs2cache);
	$lastpageno = (int) ceil($qryRecs / $nrows);
	$zthis->_maxRecordCount = $qryRecs;
	


	// ***** Here we check whether $page is the last page or 
	// whether we are trying to retrieve 
	// a page number greater than the last page number.
	if ($page >= $lastpageno) {
		$page = $lastpageno;
		$atlastpage = true;
	}
	
	// If page number <= 1, then we are at the first page
	if (empty($page) || $page <= 1) {	
		$page = 1;
		$atfirstpage = true;
	}
	
	// We get the data we want
	$offset = $nrows * ($page-1);
	if ($secs2cache > 0) 
		$rsreturn = $zthis->CacheSelectLimit($secs2cache, $sql, $nrows, $offset, $inputarr);
	else 
		$rsreturn = $zthis->SelectLimit($sql, $nrows, $offset, $inputarr, $secs2cache);

	
	// Before returning the RecordSet, we set the pagination properties we need
	if ($rsreturn) {
		$rsreturn->_maxRecordCount = $qryRecs;
		$rsreturn->rowsPerPage = $nrows;
		$rsreturn->AbsolutePage($page);
		$rsreturn->AtFirstPage($atfirstpage);
		$rsreturn->AtLastPage($atlastpage);
		$rsreturn->LastPageNo($lastpageno);
	}
	return $rsreturn;
}

