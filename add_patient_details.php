<?php
include "includes/common.php";


if (isset($_GET["mode"])) $mode = $_GET["mode"];
else if (isset($_POST["mode"])) $mode = $_POST["mode"];
else $mode = "A";

if (isset($_GET["id"])) $txtid = $_GET["id"];
else if (isset($_POST["txtid"])) $txtid = $_POST["txtid"];
else $mode = "A";

$ID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$campid = GetXFromYID("SELECT iCampID_reg FROM patient WHERE iPatientID = '$txtid'");
$token = GetXFromYID("SELECT iTokenNum FROM patient WHERE iPatientID = '$txtid'");


if (isset($txtid))
    $disp_url = "add_patient.php";
$edit_url = "add_patient_details.php";
$view_url = "patient_details.php";

$valid_modes = array("A", "I", "E", "U", "D");
$mode = EnsureValidMode($mode, $valid_modes, "A");
if ($mode == 'A') {
    $txtvisitID = '0';
    $txtname = '';
    $txtage = '';
    $txtgender = '';
    $iBP_low = '';
    $iBP_high = '';
    $iWeight = '';
    $iSugar = '';
    $txtuser = '0';
    $rdstatus = 'A';

    $form_mode = "I";
    $code_flag = '0';
} else if ($mode == 'I') {

    $txtvisitID = NextID("iVisitID", "visit");
    $txtid = db_input($_POST['txtid']);
    $txtcampid = db_input($_POST['txtcampid']);
    $txtname = db_input($_POST['txtname']);
    $txtage = db_input($_POST['txtage']);
    $token = db_input($_POST['token']);
    $txtgender = db_input($_POST['txtgender']);
    $iBP_low = db_input($_POST['iBP_low']);
    $iBP_high = db_input($_POST['iBP_high']);
    $iWeight = db_input($_POST['iWeight']);
    $iSugar = db_input($_POST['iSugar']);
    $txtuser = $sess_user_id;
    $rdstatus = 'A';

    $q = "insert into visit values ('$txtvisitID','$txtid', '$txtcampid', '', '$txtuser', '$token', '$iWeight', '$iBP_low', '$iBP_high', '$iSugar', '', '', '', '', '', '', '$rdstatus')";
    $r = sql_query($q, 'USER_EDI.56');
    $q = "UPDATE patient SET vName='$txtname', iAge='$txtage', cGender='$txtgender' WHERE iPatientID='$txtid'";
    $r = sql_query($q, 'USER_EDI.57');
} else if ($mode == 'E') {
    $q = "select * from visit where iPatientID = $txtid";
    $r = sql_query($q) or die("<strong>Error Code:PHOALBUM68</strong>");
    if (!sql_num_rows($r)) {
        header("location: $disp_url");
        exit;
    }
    $o = sql_fetch_object($r);
    $txtid = db_output($o->iClientID);
    $txtname = db_output($o->vName);
    $txtcname = db_output($o->vCPName);
    $txtemail = db_output($o->vEmail);
    $txtphone = db_output($o->vPhone);
    $txtdate = db_output($o->dtAdded);
    $txtuser = $sess_user_id;
    $rdstatus = db_output($o->cStatus);


    $form_mode = "U";
    $code_flag = '1';
} else if ($mode == 'U') {

    $txtid = db_input($_POST['txtid']);
    $txtname = db_input($_POST['txtname']);
    $txtcname = db_input($_POST['txtcname']);
    $txtemail = db_input($_POST['txtemail']);
    $txtphone = db_input($_POST['txtphone']);
    $txtdate = date('Y-m-d H:i:s');
    $txtuser = $sess_user_id;
    $rdstatus = 'A';

    $q = "update client set vName='$txtname', vCPName='$txtcname', vEmail='$txtemail', vPhone='$txtphone', dtAdded='$txtdate', iUpdated_UserID='$txtuser', cStatus='$rdstatus' where iClientID=$txtid";


    $r = sql_query($q, 'USER_EDI.104');
} elseif ($mode == "D") {
    $q = "delete from client where iClientID=$txtid";
    $r = sql_query($q, 'USER_EDI.114');
    $_SESSION[PROJ_SESSION_ID]->success_info = "Client Successfully Deleted";
    header("location:" . $disp_url);
    exit;
}
if ($mode == "I" || $mode == "U") {
    $successMessage = "New Client Added Successfully!";

    // $_SESSION[PROJ_SESSION_ID]->success_info = "Client Successfully Updated";

    header("location:" . $view_url . "?id=" . $txtid);
    exit;
}
?>

<body>
    <?php
    include 'load_header.php';
    include '_header.php'; ?>

    <div id="appCapsule">


        <div class="section mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="todo-indicator "></div>
                    <div class="ml-1">
                        <?php
                        // Query the database to get the counts
                        $query = "SELECT vMobileNum FROM patient WHERE iPatientID = $ID";
                        $result = sql_query($query);
                        $vMobileNum = 0;
                        if ($row = sql_fetch_assoc($result)) {
                            $vMobileNum = $row['vMobileNum'];
                        }
                        ?>
                        <div>Mobile Number</div>
                        <div>+91<?php echo $vMobileNum; ?></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="wide-block pt-2 ">
            <div class="text1">Patient Details</div>
            <p class="text-gray">Enter the patient’s detail below to continue</p>
        </div>


        <div class="wide-block pb-2">

            <form enctype="multipart/form-data" id="patientForm" action="<?php echo $edit_url ?>" method="post">
                <input type="hidden" name="add_mode" value="N" />
                <input type="hidden" name="mode" value="<?php echo $form_mode; ?>" />
                <input type="hidden" name="txtid" value="<?php echo $txtid; ?>" />
                <input type="hidden" name="txtcampid" value="<?php echo $txtcampid; ?>" />
                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Name</label>
                        <input type="text" class="form-control" id="txtname" name="txtname" placeholder="Eg: David Noronha" required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Age</label>
                                <input type="text" class="form-control" id="txtage" name="txtage" placeholder="Eg: 26" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Gender</label>
                                <select class="form-control custom-select" id="txtgender" name="txtgender" required>
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="3">Transgender</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Blood Pressure(mm Hg)</label>
                                <input type="text" class="form-control" id="" placeholder="Eg: 26" required="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Weight(kgs)</label>
                                <input type="text" class="form-control" id="iWeight" name="iWeight" placeholder="Eg: 86" required>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-6">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Sugar(mg/dL)</label>
                                <input type="text" class="form-control" id="iSugar" name="iSugar" placeholder="Eg: 70" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="">Smoking</label>
                                <select class="form-control custom-select" id="" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Known Illness</label>
                        <div class="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb1">
                                        <label class="custom-control-label" for="customCheckb1">Hypertension</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb2">
                                        <label class="custom-control-label" for="customCheckb2">Diabetes</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb3">
                                        <label class="custom-control-label" for="customCheckb3">Heart</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb4">
                                        <label class="custom-control-label" for="customCheckb4">Kidney</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb5">
                                        <label class="custom-control-label" for="customCheckb5">Liver</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb6">
                                        <label class="custom-control-label" for="customCheckb6">Stomach</label>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb7">
                                        <label class="custom-control-label" for="customCheckb7">Neuro</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb8">
                                        <label class="custom-control-label" for="customCheckb8">Gastro</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb9">
                                        <label class="custom-control-label" for="customCheckb9">Lungs</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb10">
                                        <label class="custom-control-label" for="customCheckb10">Urology</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb11">
                                        <label class="custom-control-label" for="customCheckb11">Gynac</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheckb12">
                                        <label class="custom-control-label" for="customCheckb12">Others</label>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>







                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="">Symptoms if any </label>
                        <textarea id="" rows="3" class="form-control"></textarea>
                    </div>
                </div>




                <div class="mt-2">
                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">SAVE</button>
                </div>

            </form>


        </div>

    </div>

    <?php include 'load_footer.php'; ?>
</body>

</html>