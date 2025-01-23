<?php
$NO_PRELOAD = true;
require_once("common.php");

if(isset($_POST["response"])) $response = $_POST["response"];
else if(isset($_GET["response"])) $response = $_GET["response"];
else $response = "";

$result = 'false'; //0~0~0~0";

if($response == "UNIQUE_CODE") 
{
	if(isset($_GET["id"]) && isset($_GET['val']) && isset($_GET['mode']))
	{
		$id = $_GET["id"];
		$val = trim($_GET["val"]);
		$mode = $_GET['mode'];
		
		if($mode == 'USERS')
		{  
			$pk_fld = 'iUserID';
			$code_fld = 'vUName';
			$tbl = 'users';
		}

		$flag = IsUniqueEntry($pk_fld, $id, $code_fld, $val, $tbl);
		$result = ($flag=='0')? '0': '1';
	}
}

else if($response == 'UPDATE_STATUS')
{
	if(isset($_GET["mode"]) && isset($_GET["status"]) && isset($_GET["id"]))
	{
		$mode = $_GET["mode"];
		$status = $_GET["status"];
		$id = $_GET["id"];

		$valid_modes = array('USERS','PARTICIPANT');
		if(in_array($mode, $valid_modes))
		{
			if($mode == 'USERS')
			{
				$pk_fld = 'iUserID';
				$tbl = 'users';
				$msg = 'Users';
			}elseif ($mode == 'PARTICIPANT') {
				$pk_fld = 'cPID';
				$tbl = 'participant';
				$msg = 'Participant';
			}

			$q = "update ".$tbl." set cAttend='$status' where ".$pk_fld."='".$id."'";
			$r = sql_query($q, 'AJX.68');
			
			//LogAdminUpdates($sess_user_id,$response.'~'.$mode,$tbl,$id);
	
			if(sql_affected_rows())
			{
				$str = GetStatusImageString($mode, $status, $id);
				$result = "$str~$msg Status Has Been Changed";
			}
		}
	}
}

else if($response == 'UPDATE_YESNO')
{
	if(isset($_GET["mode"]) && isset($_GET["status"]) && isset($_GET["id"]))
	{
		$mode = $_GET["mode"];
		$status = $_GET["status"];
		$id = $_GET["id"];

		$valid_modes = array('BATCHES');
		if(in_array($mode, $valid_modes))
		{
			if($mode == 'BATCHES')
			{
				$pk_fld = 'cBID';
				$fld = 'cShowOnWebsite';
				$tbl = 'olb_batches';
				$msg = 'Batch Website Display';
			}

			$q = "update ".$tbl." set ".$fld."='$status' where ".$pk_fld."='".$id."'";
			$r = sql_query($q, 'AJX.68');
			
			LogAdminUpdates($sess_user_id,$response.'~'.$mode,$tbl,$id);
	
			if(sql_affected_rows())
			{
				$str = GetYesNoImageString($mode, $status, $id);
				$result = "$str~$msg Status Has Been Changed";
			}
		}
	}
}

elseif($response=='DELETE_BATCH')
{
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];
		
		$chk_arr['Registrations'] = GetXFromYID('select count(*) from olb_registration where cBID="'.$id.'"');
		$chk = array_sum($chk_arr);

		if(!$chk)
		{
			$q = 'delete from olb_batches where cBID="'.$id.'"';
			$r = sql_query($q, 'AJX.BATCH.D.670');
			$result = '1~Batch Details Successfully Deleted';
			
			LogAdminUpdates($sess_user_id,$response,'olb_batches',$id);
		}
		else
			$result = '0~Batch Details Could Not Be Deleted Because of Existing '.(CHK_ARR2Str($chk_arr)).' Dependencies';
	}
	else
		$result = '2~Invalid Access Detected';
}

elseif($response=='MARK_PARTICIPANT_PRESENT')
{
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];

		$q = 'update olb_participant set cAttend="Y" where cPID="'.$id.'"';
		$r = sql_query($q, 'AJX.BATCH.D.670');
		$result = '1~Participant Marked as Present~<span class="label label-success label-inline mr-2" style="cursor:pointer" onClick="MarkParticipantAbsent(\''.$id.'\');">Yes</span>';
		
		LogAdminUpdates($sess_user_id,$response,'olb_participant',$id);
	}
	else
		$result = '2~Invalid Access Detected';
}

elseif($response=='MARK_PARTICIPANT_ABSENT')
{
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];

		$q = 'update olb_participant set cAttend="N" where cPID="'.$id.'"';
		$r = sql_query($q, 'AJX.BATCH.D.670');
		$result = '1~Participant Marked as Absent~<span class="label label-danger label-inline mr-2" style="cursor:pointer" onClick="MarkParticipantPresent(\''.$id.'\');">No</span>';
		
		LogAdminUpdates($sess_user_id,$response,'olb_participant',$id);
	}
	else
		$result = '2~Invalid Access Detected';
}

elseif($response=='DELETE_REGISTRATION')
{
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];
		
		$chk_arr['Participants'] = GetXArrFromYID("select count(*) from olb_regpart where iRID='$id'");
		$chk = array_sum($chk_arr);

		if(!$chk)
		{
			$q = 'delete from olb_registration where iRID="'.$id.'"';
			$r = sql_query($q, 'AJX.REGISTRATION.D.670');
			$result = '1~Registration Details Successfully Deleted';
			
			LogAdminUpdates($sess_user_id,$response,'olb_registration',$id);
		}
		else
			$result = '0~Registration Details Could Not Be Deleted Because of Existing '.(CHK_ARR2Str($chk_arr)).' Dependencies';
	}
	else
		$result = '2~Invalid Access Detected';
}

elseif($response=='DELETE_PARTICIPANT')
{
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];
		
		$RID = GetXFromYID('select iRID from olb_regpart where cPID="'.$id.'"');

		$q = 'delete from olb_participant where cPID="'.$id.'"';
		$r = sql_query($q, 'AJX.REGISTRATION.D.670');
		$result = '1~Participant Details Successfully Deleted';

		LogAdminUpdates($sess_user_id,$response,'olb_participant',$id);
			
		$q2 = 'delete from olb_regpart where cPID="'.$id.'" and iRID='.$RID;
		$r2 = sql_query($q2, 'AJX.REGISTRATION.D.670');
		
		$checkRIDExists = GetXFromYID('select count(*) from olb_regpart where iRID='.$RID);
		if(empty($checkRIDExists) || $checkRIDExists=='-1')
		{
    		$q3 = 'delete from olb_registration where iRID='.$RID;
    		$r3 = sql_query($q3, 'AJX.REGISTRATION.D.670');
    		LogAdminUpdates($sess_user_id,$response,'olb_registration',$RID);
		}
	}
	else
		$result = '2~Invalid Access Detected';
}

echo $result;
exit;
?>