<?php
##	DEFINES 		###################################################################################
define('TODAY', date("Y-m-d"));
define('NOW', date("Y-m-d H:i:s"));
define('TOMMORROW', date("Y-m-d", strtotime("+1 day")));
define('YESTERDAY', date("Y-m-d", strtotime("-60 day")));
define('CURRENTTIME', date("H:i:s"));

define('TODAY2', date("d-m-Y"));
define('NOW2', date("d-m-Y H:i:00"));
define('TOMMORROW2', date("d-m-Y", strtotime("+1 day")));
define('YESTERDAY2', date("d-m-Y", strtotime("-1 day")));
define('LAST7DAYS', date("Y-m-d", strtotime("-7 day")));

define('NOW3', date("Ymd.Hi"));
// define('PAYROLL_PROCESS_START', '2014-03');
define('THIS_WEEK', date("W"));
define('THIS_MONTH', date("m"));
define('THIS_YEAR', date("Y"));

define('LAST_WEEK', date("W", strtotime("-1 week")));
define('LAST_MONTH', date("m", strtotime("-1 month")));
define('LAST_YEAR', date("Y", strtotime("-1 year")));

define('CURRENT_MONTH', date("m"));
define('CURRENT_YEAR', date("Y"));

define('MONTH_START', date("Y-m-01"));
define('MONTH_START2', date("01-m-Y"));

define('MONTH_YEAR', date("mY"));
define('TODAY1', date("Ymd"));

define('URL_REWRITTING', 'OFF');
define('PROJ_DELIMITER', '[EIN_BREAK]');
$STARTOFMONTH = "01-" . THIS_MONTH . "-" . THIS_YEAR;

// define('SEND_MAILER', 0);
define('PROJ_SESSION_ID', 'udat_EIN');
define('PROJ_FRONT_SESSION_ID', 'udat_FEIN');
define('PROJ_AUTHORISE_SESSION_ID', 'udat_AUTHEIN');
define('PROJ_ALERT_SESSION_ID', 'udat_AEIN');
define('THUMBNAIL_ALLOWED', 1);    // 1 - Yes, 0 - No.
define('RANDOMIZE_FILENAME', 1); // 0 - Randomize Uploaded Image Name, 1 - Customize Uploaded Image Name
define('SQL_ERROR', 1);
define('NEWLINE', "\r\n");
define('TAB_SPACE', "\t");
define('FORCE_PRINT_DOWNLOAD', 1); // default is 0
define('IS_WAMP_SETUP', 1);
define('WEEK_START_DAY', 1); // 0: Sunday, 1: Monday...
define('QTR_START_MONTH', 1); // Jan
define('QTR_MONTH_OFFSET', 0); // Jan
define('ADD_SLASHES', 0);
define('NA', '- n/a -');
define('IS_INTERNET', false);

##	PATH DEFINES	###################################################################################
define('AJAX_INC_URL', SITE_ADDRESS . 'includes/ajax.inc.php');

define('IMAGE_PATH', SITE_ADDRESS . 'images/');
define('IMAGE_UPLOAD', DOCROOT . 'images/');

define('BARCODE_PATH', SITE_ADDRESS . 'uploads/barcode/');
define('BARCODE_UPLOAD', DOCROOT . 'uploads/barcode/');

define('USER_PATH', SITE_ADDRESS . 'uploads/users/');
define('USER_UPLOAD', DOCROOT . 'uploads/users/');

define('CONTENT_ITEM_PATH', SITE_ADDRESS . 'uploads/content/');
define('CONTENT_ITEM_UPLOAD', DOCROOT . 'uploads/content/');

define('CERTIFICATE_PATH', DOCROOT . 'uploads/certificate/');
define('CERTIFICATE_UPLOAD', DOCROOT . 'uploads/certificate/');

##	DEFINED ARRAYs	###################################################################################
$IMG_TYPE = array('gif', 'png', 'pjpeg', 'jpeg', 'jpg', 'JPG');
$DOC_TYPE = array('txt', 'doc', 'docx', 'pdf', 'xls', 'xlsx');
$IMG_FILE_TYPE = array('image/gif', 'image/png', 'image/pjpeg', 'image/jpeg', 'image/jpg');
$DOC_FILE_TYPE = array('text/plain', 'application/msword', 'application/vnd.ms-word', 'application/pdf', 'application/vnd.ms-excel');

$WEEKDAY_ARR = array('0' => 'Sunday', '1' => 'Monday', '2' => 'Tuesday', '3' => 'Wednesday', '4' => 'Thursday', '5' => 'Friday', '6' => 'Saturday');
$WEEKDAY_ARR2 = array('SUN' => 'Sunday', 'MON' => 'Monday', 'TUE' => 'Tuesday', 'WED' => 'Wednesday', 'THU' => 'Thursday', 'FRI' => 'Friday', 'SAT' => 'Saturday');
$WEEKDAY_ORDER_ARR = array("'SUN'", "'MON'", "'TUE'", "'WED'", "'THU'", "'FRI'", "'SAT'");
$WEEKDAY_ARR3 = array('0' => 'SUN', '1' => 'MON', '2' => 'TUE', '3' => 'WED', '4' => 'THU', '5' => 'FRI', '6' => 'SAT');
$MONTH_ARR = array("1" => "January", "2" => "February", "3" => "March", "4" => "April", "5" => "May", "6" => "June", "7" => "July", "8" => "August", "9" => "September", "10" => "October", "11" => "November", "12" => "December");
$SHORT_MONTH_ARR = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");
$HOLITYPE_ARR = array('P' => 'Public', 'R' => 'Restricted');
$SHORT_MONTH_ARR = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

$STATUS_ARR = array('A' => 'Active', 'I' => 'Inactive');
$STATUS_ARR2 = array('A' => 'Complete', 'I' => 'Pending');
$BOOKING_STATUS_ARR = array('D' => 'Draft', 'A' => 'Active', 'I' => 'Inactive', 'P' => 'Pending');
$USER_LEVEL_ARR = array('0' => 'System Admin', '1' => 'Head Office', '2' => 'Vessel Manager', '3' => 'Supervisor', '4' => 'Cashier');
$YES_ARR = array('Y' => 'Yes', 'N' => 'No');
$REGISTRATION_STATUS_ARR = array('D' => 'Draft', 'V' => 'Verified', 'C' => 'Confirmed', 'R' => 'Rejected');
$REGISTRATION_STATUS_CSS_ARR = array('D' => 'warning', 'V' => 'primary', 'C' => 'success', 'R' => 'danger');
$PARTICIPANT_SEX_ARR = array('G' => 'Groom', 'B' => 'Bride');
$ATTENDANCE_ARR = array('S' => 'Seperately', 'T' => 'Together');
$levels = array(4 => "Employee", 3 => "Client", 2 => "Recruiter", 1 => "Admin");
##	DEFINED ERROR MSGS	###################################################################################

define('NO_RECORDS_IN_TABLE', 'No Data Records Found In Table');
define('READONLY_ACCESS', '<div class="err_lbl1" align="center">You Can No Longer Add/ Modify Records For This Module Locally. Inorder To Do So, You Need To Login To The Online Module.</div>');
define('INVALID_ACCESS', 'Invalid Access Detected. Script Terminated.');
define('MODULE_ACCESS_DENIED', 'Invalid Access: You Do Not Have The Necessary Permissions To View This Module');
define('MODULE_EDIT_DENIED', 'Invalid Access: You Do Not Have The Necessary Permissions To Edit This Process');
define('INVALID_PARAMETER', 'Invalid Parameter Detected. Script Terminated.');
#######################################################################################################
