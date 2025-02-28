<?php
$NO_REDIRECT = 1;
require_once('includes/common.php');
require_once('includes/ti-salt.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ####################################################################################
    // First, make sure the form was posted from a browser.
    // For basic web-forms, we don't care about anything  other than requests from a browser:    
    if (!isset($_SERVER['HTTP_USER_AGENT']))
        ForceOut(5);

    // Make sure the form was indeed POST'ed: (requires your html form to use: action="post") 
    if (!$_SERVER['REQUEST_METHOD'] == "POST")
        ForceOut(5);

    #########################################################################################  
    if (isset($_POST["txtusername"]) && isset($_POST["txtpassword"])) // && isset($_POST["btnlogin"]))
    {
        $username = db_input($_POST["txtusername"]);
        $txtpassword = htmlspecialchars_decode(db_input($_POST["txtpassword"]));

        $salt_obj = new SaltIT;
        $password = $salt_obj->EnCode($txtpassword);

        $ret = 0; //error flag

        if ($password == '')
            ForceOut(8);
        elseif ($username == '')
            ForceOut(7);
        else {
            $u_id = $u_level = 0;
            $q = "select iUserID, vUName, vPassword, vPic, iLevel,VEmail from users where vUName='$username' and cStatus='A'";
            $r = sql_query($q, 'AUTH.61');

            if (sql_num_rows($r)) {

                list($u_id, $u_name, $u_pass, $u_pic, $u_level, $u_email) = sql_fetch_row($r);


                $ret = ($u_pass == $password) ? 1 : -1;    // 1 - Password Matches ::  -1 - Password MisMatch
            } else
                $ret = -2;    //No User Found

            if ($ret == -1 || $ret == -2) {
                LogAttempt($username, 'F', 'Wrong User Name');
                ForceOut(4);
            } elseif ($ret == 1) {
                //echo '1';exit;
                session_destroy();
                session_start();
                session_regenerate_id();
                ${PROJ_SESSION_ID} = new userdat;

                $randomtoken = base64_encode(uniqid(rand(), true));

                $_SESSION[PROJ_SESSION_ID] = new userdat;
                $_SESSION[PROJ_SESSION_ID]->log_time = NOW2;
                $_SESSION[PROJ_SESSION_ID]->log_stat = "A";
                $_SESSION[PROJ_SESSION_ID]->user_id = $u_id;
                $_SESSION[PROJ_SESSION_ID]->user_name = $u_name;
                $_SESSION[PROJ_SESSION_ID]->user_level = $u_level;
                $_SESSION[PROJ_SESSION_ID]->user_email = $u_email;
                $_SESSION[PROJ_SESSION_ID]->sess = session_id();
                $_SESSION[PROJ_SESSION_ID]->rmadr = $_SERVER['REMOTE_ADDR'];
                $_SESSION[PROJ_SESSION_ID]->lhs_menu = true;
                $_SESSION[PROJ_SESSION_ID]->sess_token = $randomtoken;
                $_SESSION[PROJ_SESSION_ID]->sess_active = 'Y';
                $_SESSION[PROJ_SESSION_ID]->allow_counter_close = 'N';

                LogAttempt($username, 'S', 'Logged');

                $q = "update users set dtLastLogin='" . NOW . "', vLastLoginIP='" . $_SERVER['REMOTE_ADDR'] . "' where iUserID=$u_id";
                $r = sql_query($q, 'AUTH.78');

                header("location:dashboard.php");
            }
        }
    } else
        ForceOut(4);
} else {
    session_destroy(); // destroy all data in session
    die("Forbidden - You are not authorized to view this page");
    exit;
}
