<?php
if(isset($logged) && !empty($logged))
{
	$LINK_ARR = array();
	if(count($MENU_ARR) && !empty($MENU_ARR))
	{
		foreach($MENU_ARR as $mKEY=>$mVALUE)
		{
			if(!empty($mVALUE['HREF']) && $mVALUE['HREF']!='javascript:;')
			{
				if(strpos($mVALUE['HREF'],'?') === false)
					array_push($LINK_ARR,$mVALUE['HREF']);
				else
				{
					$l = explode('?',$mVALUE['HREF']);
					array_push($LINK_ARR,$l['0']);
				}
			}
			
			if(isset($mVALUE['URLS']) && count($mVALUE['URLS']) && !empty($mVALUE['URLS']))
			{
				foreach($mVALUE['URLS'] as $k=>$v)
					array_push($LINK_ARR,$v);
			}
			
			if(!empty($mVALUE['IS_SUB']))
			{
				if(isset($mVALUE['SUB']) && count($mVALUE['SUB']) && !empty($mVALUE['SUB']))
				{
					foreach($mVALUE['SUB'] as $k=>$v)
					{
						if(isset($v['HREF'])) array_push($LINK_ARR,$v['HREF']);
						if(isset($v['SUB']) && count($v['SUB']) && !empty($v['SUB']))
						{
							foreach($v['SUB'] as $v2)
							{
								if(isset($v2['HREF']))
									array_push($LINK_ARR,$v2['HREF']);
							}
						}
					}
				}
			}
		}
		
		if($sess_user_level=='2' || $sess_user_level=='3')
			array_push($LINK_ARR,'user_edit.php');
		
		if(in_array('home.php',$LINK_ARR))
		{
			array_push($LINK_ARR,'delivery_home.php');
			array_push($LINK_ARR,'cancelled.php');
			array_push($LINK_ARR,'_updateorder_status.php');
			array_push($LINK_ARR, 'orders_edit.php');
			array_push($LINK_ARR, '_get_order_log.php');
			array_push($LINK_ARR, '_get_order_log2.php');
		}
		
		array_push($LINK_ARR,'auth2.php');
		array_push($LINK_ARR,'ajax.inc.php');
		array_push($LINK_ARR,'lock_screen.php');
		array_push($LINK_ARR,'password.inc.php');
		array_push($LINK_ARR,'logout.php');
	}

	if(!empty($LINK_ARR) && count($LINK_ARR))
	{
		if(!in_array(basename($_SERVER["SCRIPT_NAME"]),$LINK_ARR))
		{
			header('location:home.php');
			exit;
		}
	}
}
?>