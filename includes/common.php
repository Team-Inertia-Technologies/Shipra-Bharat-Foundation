<?php
include "config.inc.php"; // db configurations
include "define.inc.php"; // # defines
include "generic.inc.php"; // # common functions
include "common.inc.php"; // # project specific functions
include "sql.inc.php"; // # sql functions

if (!isset($NO_INCLUDE)) {
    include "userdat.php"; // # 
    // include "permission.inc.php"; // 
}
//include 'header-main.php';


include "dynamic.inc.php";
