<?php
// data that needs to be rememberered...
class userdat
{
	var $log_time;		// time of login
	var $log_stat;		// log status - is the user logged in or not
	var $sess_id;		// session id
	///////////////////////////////////////////////

	var $user_id;		// de user's id		
	var $user_code;		// de user's id		
	var $user_name;		// de user's name	
	var $user_level;	//
	var $user_pic;	//	
	var $user_lastlogin;	//	
	var $user_ip;	//
	var $allow_counter_close;
	///////////////////////////////////////////////

	var $srch_ctrl_arr = array();
	var $list_cart_arr = array();
	var $list_pics_arr = array();
	var $list_param_arr = array();
	var $lhs_menu = true;

	var $info;			// error msg
	var $success_info;		// error msg
	var $error_info;			// error msg
	var $alert_info;			// error msg
	var $sess_token;
	var $sess_active;
}

$sess_id = session_id();

if (empty($sess_id)) {
	session_start();
}
