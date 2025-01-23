<?php
##	GETCONNECTED	###################################################################################
$CON = GetConnected();

##	DYNAMIC DEFINES	###################################################################################
$USER_LEVEL_SUPER = '0';
$USER_LEVEL_HO = '1';
$USER_LEVEL_MANAGER = '2';
$USER_LEVEL_SUPERVISOR = '3';
$USER_LEVEL_CASHIER = '4';

##	USER SESSION VARIABLES	###################################################################################
$logged = 0;
$sess_user_type = 'ADM';
$is_sys_admin = $is_super_admin = $is_ho = $is_manager = $is_supervisor = $is_cashier = $is_menu_closed = false;
$sess_info_str = '';
$sess_allow_counter_close = 'N';

if (isset($_SESSION[PROJ_SESSION_ID]->log_stat)) // if the session variable has been set...
{
	if ($_SESSION[PROJ_SESSION_ID]->log_stat == "A") {
		$logged = 1;
		$sess_user_id = $_SESSION[PROJ_SESSION_ID]->user_id;
		$sess_user_name = $_SESSION[PROJ_SESSION_ID]->user_name;
		$sess_user_level = $_SESSION[PROJ_SESSION_ID]->user_level;
		$sess_user_sess = $_SESSION[PROJ_SESSION_ID]->sess;
		$sess_login_time = FormatDate($_SESSION[PROJ_SESSION_ID]->log_time, "B", 1);
		$sess_user_token = $_SESSION[PROJ_SESSION_ID]->sess_token;
		$sess_lhs_menu = $_SESSION[PROJ_SESSION_ID]->lhs_menu;
		$sess_user_active = $_SESSION[PROJ_SESSION_ID]->sess_active;
		$sess_allow_counter_close = $_SESSION[PROJ_SESSION_ID]->allow_counter_close;

		switch ($sess_user_level) {
			case $USER_LEVEL_SUPER: {
					$is_super_admin = true;
					break;
				}
			case $USER_LEVEL_HO: {
					$is_ho = true;
					break;
				}
			case $USER_LEVEL_MANAGER: {
					$is_manager = true;
					break;
				}
			case $USER_LEVEL_SUPERVISOR: {
					$is_supervisor = true;
					break;
				}
			case $USER_LEVEL_CASHIER: {
					$is_cashier = true;
					break;
				}
		}

		if ($is_super_admin && !$sess_user_id) $is_sys_admin = true;
	}

	$sess_user_access = true;
	$msg_unread_count = 0;
}

if (!$logged && empty($NO_REDIRECT)) {
	ForceOut(6);
}

if ($logged) {
	$sess_user_active = GetXFromYID('select cStatus from users where iUserID=' . $sess_user_id . '');
	$_SESSION[PROJ_SESSION_ID]->sess_active = $sess_user_active;
}

if ($logged) {
	##	DEFINED MENU ARRAYs	###################################################################################
	$MENU_ARR[0] = array('TEXT' => 'Dashboard', 'ICON' => 'fas fa-home', 'HREF' => 'home.php', 'IS_SUB' => false);

	$MENU_ARR[1] = array('TEXT' => 'Registration', 'ICON' => 'fas fa-house-user', 'HREF' => 'registration_disp.php', 'IS_SUB' => false, 'URLS' => array('registration_disp.php', 'registration_edit.php', 'participant_view.php'));

	$MENU_ARR[3] = array('TEXT' => 'Batches', 'ICON' => 'flaticon2-protection', 'HREF' => 'batches_disp.php', 'IS_SUB' => false, 'URLS' => array('batches_disp.php', 'batches_edit.php', 'participant_list.php', 'multi_edit_change.php', 'certificate_pdf.php', 'send_certificates.php'));

	$MENU_ARR[5] = array('TEXT' => 'Configurations', 'ICON' => 'fas fa-cog', 'HREF' => 'javascript:;', 'IS_SUB' => true);
	//$MENU_ARR[5]['SUB'][1] = array('TEXT'=>'Users', 'ICON'=>'fas fa-users-cog', 'HREF'=>'users_disp.php');//
	//$MENU_ARR[5]['SUB'][1]['SUB'][0] = array('HREF'=>'users_edit.php');//
	$MENU_ARR[5]['SUB'][2] = array('TEXT' => 'Change Password', 'ICON' => 'fas fa-user-cog', 'HREF' => 'change_password.php'); //
}

##	USER ACCESS		###################################################################################
$_file_name = basename($_SERVER["SCRIPT_NAME"]);
$_file_module = GetFileModule($_file_name);

##	SESSION->INFO	###################################################################################
$lbl_display = 'none'; // used for LBL_ERR
if ($logged) {
	$sess_info = (isset($_SESSION[PROJ_SESSION_ID]->info)) ? NotifyThis($_SESSION[PROJ_SESSION_ID]->info, 'info') : '';
	$sess_success_info = (isset($_SESSION[PROJ_SESSION_ID]->success_info)) ? NotifyThis($_SESSION[PROJ_SESSION_ID]->success_info, 'success') : '';
	$sess_error_info = (isset($_SESSION[PROJ_SESSION_ID]->error_info)) ? NotifyThis($_SESSION[PROJ_SESSION_ID]->error_info, 'error') : '';
	$sess_alert_info = (isset($_SESSION[PROJ_SESSION_ID]->alert_info)) ? NotifyThis($_SESSION[PROJ_SESSION_ID]->alert_info, 'alert') : '';

	$sess_info_str = $sess_info . $sess_success_info . $sess_error_info . $sess_alert_info;

	$lbl_display = ($sess_info != "") ? '' : 'none';
	$_SESSION[PROJ_SESSION_ID]->info = "";
	$_SESSION[PROJ_SESSION_ID]->success_info = "";
	$_SESSION[PROJ_SESSION_ID]->error_info = "";
	$_SESSION[PROJ_SESSION_ID]->alert_info = "";	// */
}

$PAGE_OPTION_STR = '';
if (empty($NO_PRELOAD))
	if (!isset($USER_ARR) && $logged) $USER_ARR = GetUserDetails();

if (isset($sess_user_id))
	$sess_user_pic = (!empty($USER_ARR[$sess_user_id]['pic']) && IsExistFile($USER_ARR[$sess_user_id]['pic'], USER_UPLOAD)) ? USER_PATH . $USER_ARR[$sess_user_id]['pic'] : false;

#######################################################################################################
function GetFileModule($_file_name)
{
	global $MENU_ARR;
	$str = '-1';
	$is_this_url = false;

	if (isset($MENU_ARR)) {
		foreach ($MENU_ARR as $M_CODE => $M) {
			if (IsInThisMenuLevel($M, $_file_name)) {
				$str = $M_CODE;
				break;
			}
		}
	}

	return strval($str);
}

function IsInThisMenuLevel($M, $_file_name)
{
	global $MENU_ARR;
	$x = false;

	if (isset($M['HREF']) && $M['HREF'] == $_file_name) {
		$x = true;
	} else if (isset($M['SUB']) && is_array($M['SUB'])) {
		foreach ($M['SUB'] as $N_CODE => $N) {
			$x = IsInThisMenuLevel($N, $_file_name);

			if ($x)
				break;
		}
	}

	return $x;
}

function NotifyThis($text, $mode = 'alert')
{
	if ($mode == 'success') $mode_str = 'success';
	else if ($mode == 'error') $mode_str = 'danger';
	else if ($mode == 'info') $mode_str = 'warning';
	else $mode_str = 'primary';

	if ($mode == 'success') $mode_icon = 'flaticon2-check-mark';
	else if ($mode == 'error') $mode_icon = 'flaticon2-cross';
	else if ($mode == 'info') $mode_icon = 'flaticon-warning';
	else $mode_icon = 'flaticon-questions-circular-button';


	$text = trim($text);
	return ($text != '') ? '<div class="alert alert-custom alert-light-' . $mode_str . ' fade show mb-5" role="alert"><div class="alert-icon"><i class="' . $mode_icon . '"></i></div><div class="alert-text">' . $text . '</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>' : '';
}

function GetAllUrls($menu_arr, $module)
{
	$arr = array();
	global $BREADCRUMB_ARR;
	$i = 0;

	foreach ($menu_arr as $a_key => $a) {
		if ($a[0] != '#')
			$BREADCRUMB_ARR[$a[0]] = array($module, '<a href="' . $a[0] . '">' . $a_key . '</a>');

		foreach ($a as $b_key => $b) {
			if (!is_array($b)) {
				$arr[$i++] = $b;
				continue;
			}

			foreach ($b as $c_key => $c) {
				$arr[$i++] = $c;

				if (is_numeric($c_key))
					$BREADCRUMB_ARR[$c] = array($module, '<a href="' . $a[0] . '">' . $a_key . '</a>');
				else
					$BREADCRUMB_ARR[$c] = array($module, '<a href="' . $a[0] . '">' . $a_key . '</a>', '<a href="' . $b[0] . '">' . $b_key . '</a>');
			}
		}
	}

	$arr = array_unique($arr);
	return $arr;
}
