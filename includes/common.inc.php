<?php
function IsUniqueEntry($id_fld, $id_val, $txt_fld, $txt_val, $tbl)
{
	$ret_val = '2';
	$curr_txt = (isset($id_val))? GetXFromYID("select $txt_fld from $tbl where $id_fld=$id_val"): "";
	
	if($txt_val!='' && $txt_val != $curr_txt) // no change in value, ignore
	{
		$q_str = (isset($id_val))? " and $id_fld!=$id_val": "";
		$chk = GetXFromYID("select count(*) from $tbl where $txt_fld='$txt_val' " . $q_str);

		$ret_val = ($chk)? '0': '1';
	}
	
	return $ret_val;
}

function ContactDetails($phone, $mobile, $email)
{	
	$arr = array();

	if($phone!='' || $mobile!='' || $email!='')
	{
		if(!empty($email))
			$arr['email'] = $email;

		if(!empty($mobile))
			$arr['mobile'] = $mobile;

		if(!empty($phone))
			$arr['phone'] = $phone;
	}

	return '&nbsp;'.implode(', ',$arr);
}

function FillYearArr()
{
	$arr = array();
	for($i=START_YEAR;$i<=THIS_YEAR;$i++)
		$arr[$i] = $i.'-'.($i+1);
	return $arr;
}

function GetDuration($dfrom, $dto)
{
	$str = '';
	
	if($dfrom!='')	$str .= $dfrom;	
	if($dfrom!='' && $dto!='')	$str .= ' to: ';	
	if($dto!='')	$str .= $dto;
	
	if($str=='')	$str = '&nbsp;';	
	return $str;
}
function GetUrlName($title)
{
	$URL_CHAR_ARR = array("%","/",".","#","?","*","!","@","&",":","|",";","=","<",">","^","~","'","\"",",","-","(",")","'",'"','\\');
	$rurl = trim($title);
	$rurl = str_replace($URL_CHAR_ARR,'',$title);
	$rurl = str_replace('   ',' ',$rurl);
	$rurl = str_replace('  ',' ',$rurl);
	$rurl = str_replace(' ','-',$rurl);
	$rurl = trim(strtolower($rurl));

	return $rurl;
}

function GenerateSpace($level, $symbol='&nbsp;&nbsp;')
{
	$space = '';
	
	for($i=0; $i < $level; $i++)
		$space .= $symbol;
		
	return $space;
}

function GetURL($url_name,$type,$c_name='')
{
	$str = '';
	
	if($type=='R')
		$str = SITE_ADDRESS.'food-home-delivery-goa-'.$url_name.'.html';
	if($type=='C')
		$str = SITE_ADDRESS.$url_name.'-cusine-home-delivery-goa.html';
	if($type=='L')
		$str = SITE_ADDRESS.'food-home-delivery-'.$url_name.'.html';
	if($type=='V')
		$str = SITE_ADDRESS.'food-home-delivery-'.$url_name.'.html';
	if($type=='CC')
		$str = SITE_ADDRESS.'home-food-delivery-in-goa.html';

	return $str;
}

function GetFirstOfMonth($date_ymd)
{
	list($y,$m,$d) = explode('-',$date_ymd);
	return $y.'-'.$m.'-01';
}

function GetLastOfMonth($date_ymd, $month_offset=0)
{
	$d = GetFirstOfMonth($date_ymd);
	return DateTimeAdd($d, -1, ($month_offset+1), 0, 0, 0, 0, $format="Y-m-d");
}

function SetStatusFlags($status)
{
	global $is_inactive, $is_active, $is_complete;
	
	if($status=='C')		$is_complete = true;
	else if($status=='A')	$is_active = true;
	else					$is_inactive = true;
} 

function GetWeekStart($dt)
{
	$curr_day = date('w', strtotime($dt));
	
	$curr_week_start_offset = ($curr_day != WEEK_START_DAY)? ($curr_day - WEEK_START_DAY): 0;
	return DateTimeAdd($dt, -$curr_week_start_offset, 0, 0, 0, 0, 0, 'Y-m-d');
}

function GetRelevantItemCatIDArr($icat_id)
{
	$arr = array();
	$arr[$icat_id] = $icat_id;
	$arr = GetSubItemCat(1, $icat_id, $arr, '4');
	return $arr;
}

function GetLevelStr($level, $char='&nbsp;')
{
	$str = '';
	
	for($i=1; $i < $level; $i++)
		$str .= $char;
		
	return $str;
}

function GetUniqueCode($id, $val, $pk_fld, $code_fld, $tbl, $char_len=1, $num_len=2, $min_num=0) // GetItemUniqueCode
{
	$ret_val = '';
		
	$val = strtoupper(trim($val));
	$prefix = substr($val, 0, $char_len);
	
	$ret_val = $prefix . str_pad('1', 2, '0', STR_PAD_LEFT);
	$code_arr = array();
	
	$q_str = ($id)? ' and '.$pk_fld.'!='.$id: '';
	
	$q = "select upper($code_fld) from $tbl where $code_fld like '$prefix%' ".$q_str;
	$r = sql_query($q, 'COM.160');
	while(list($code) = sql_fetch_row($r))
	{
		$code_no = str_replace($prefix, '', $code);
		
		if(!is_numeric($code_no))
			$code_no = '0';
			
		$code_arr[$code] = $code_no;
	}
			
	if(count($code_arr))
	{
		rsort($code_arr, SORT_NUMERIC);
		reset($code_arr);
		
		$code_no = max($code_arr[0], $min_num) + 1;
		$ret_val = $prefix . str_pad($code_no, 2, '0', STR_PAD_LEFT);
	}
	
	return $ret_val;
}

function CalcWeightedAdjustValue($item_value, $total_value, $total_adjust)
{
	return (!empty($total_value) && !empty($total_adjust))? $item_value/ $total_value * $total_adjust: 0;
}

function GenerateCode($mode, $id=false)
{
	if(!$id)
	{
		if($mode=='QUOTE')
			$id = NextID('iQuoteID', 'quote');
	}
	
	if(!$id)	$id = 1;

	$prefix = '';
	
	if($mode=='QUOTE')		$prefix = 'Q';
	else if($mode=='LEAD')	$prefix = 'L';

	return $prefix.str_pad($id, 5, '0', STR_PAD_LEFT);
}

function GetStatusString($status, $status_arr, $mode='1')
{
	$str = '';

	if($status == 'A')		$css = 'success';
	else if($status == 'I')	$css = 'warning';
	else if($status == 'P')	$css = 'warning';
	else					$css = 'info';
		
	if(isset($status_arr[$status]))
	{
		if($mode=='2')
			$str = '<span class="badge badge-'.$css.'">'.$status_arr[$status].'</span>';
		else if($mode=='3')
			$str = '<input type="button" name="btn_just" value="'.$status_arr[$status].'" class="btn-'.$css.' btn">';
		else
			$str = '<span class="label label-'.$css.'">'.$status_arr[$status].'</span>';
	}
	
	return $str;
}

function GetLocationName($loc_id)
{
	JustID($loc_id);
	return GetXFromYID("select vName from gen_delivery where iLocID=$loc_id");
}

function GetFinancialYears($date) // date: yyyy-mm-dd
{
	$start_year = THIS_YEAR;
	$end_year = THIS_YEAR + 1;
	list($year, $month, $day) = explode('-', $date);

	if(intval($month) < 4)
	{
		$start_year--;
		$end_year--;
	}
	
	return $start_year.'-'.$end_year;
}

function GetSuffix($parent_id, $table_name, $key_field)
{
	$x = '';
	MustID($parent_id);
	
	if($parent_id)
	{
		$x = GetXFromYID("select max(cSuffix) from $table_name where $key_field=$parent_id");
		$x = ($x)? ++$x: 'a';
	}
	
	return $x;
}

function GetUserDetails($cond="")
{
	$arr = array();	
	$q = "select iUserID, vName, vPic, vEmail, vPhone, cStatus from users where 1 $cond order by iLevel, vName";
	$r = sql_query($q, 'COM.1187');
	while(list($id, $name, $pic, $email, $phone, $status) = sql_fetch_row($r))
		$arr[$id] = array('id'=>$id, 'text'=>$name, 'name'=>$name, 'email'=>$email, 'phone'=>$phone, 'status'=>$status, 'pic'=>$pic);
	
	return $arr;
}

function GetTableTreeDetails($parent_id, $pk_id, $tbl, $pk_fld)
{
	$ancestorid = $pk_id;
	$level = 0;

	if(!empty($parent_id))
	{
		$q = "select iAncestorID, iLevel from $tbl where $pk_fld=$parent_id";
		$r = sql_query($q, 'GL_E.250');
		if(sql_num_rows($r))
		{
			list($ancestorid, $level) = sql_fetch_row($r);
			
			if(empty($ancestorid)) $ancestorid = $pk_id;
			$level++;
		}
	}

	return array($ancestorid, $level);
}

function GetTreeArr($tbl, $pk_fld, $level, $parentid, $arr, $mode="1", $cond='', $order='vName, iLevel')
{
	$space = "";
	$level++;
	$q = "select * from $tbl where iParentID=$parentid and $pk_fld!=$parentid $cond order by $order";
	$r = sql_query($q, 'COM.400');
	
	if(sql_num_rows($r))
	{
		if($mode == "1")
		{
			for($i=0; $i < $level; $i++)
				$space .= "&nbsp;&nbsp;";
		}
		elseif($mode == "2") {}
		
		while($a = sql_fetch_assoc($r))
		{
			$id = $a[$pk_fld];
			$arr[$id] = $a;
			$arr[$id]['space'] = $space;
			
			if($mode=='3')
				$arr[$id] = $id;
			else
			{
				$arr[$id] = $a;
				$arr[$id]['space'] = $space;
				$arr[$id]['level'] = $level;
			}
			
			$arr = GetTreeArr($tbl, $pk_fld, $level, $id, $arr, $mode, $cond, $order);
		}
	}

	return $arr;
}

function SortTreeStruct($tbl, $pk_fld)
{
	$arr = array();
	$arr = GetTreeArr($tbl, $pk_fld, -1, 0, $arr);
	
	$i=0;
	foreach($arr as $id=>$a)
	{		
		$q = "update $tbl set iRank=".(++$i).", iLevel=".$a['level']." where $pk_fld=$id;";
		$r = sql_query($q, 'COM.704');
	}
}
?>