<?php
include "includes/common.php";

$camp_id = isset($_GET['id']) ? db_input($_GET['id']) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $iPatientID = NextID("iPatientID", "patient");
    $vMobile = db_input($_POST['vMobile']);
    $dtCreated = NOW;
    $iTokenNum = NextID("iTokenNum", "patient");
    $cStatus = 'A';



    if (!empty($vMobile)) {
        // Check if mobile number already exists
        $checkQuery = "SELECT iPatientID FROM patient WHERE vMobileNum = '$vMobile'";
        $checkResult = sql_query($checkQuery);

        if (sql_num_rows($checkResult) > 0) {
            $error_message = "Mobile number already exists. Please use a different number.";
        } else {

            // Insert into the patient table
            $query = "INSERT INTO patient (iPatientID, vMobileNum, dtReg, cStatus, iCampID_reg, iCampID_last, iTokenNum) 
                      VALUES ('$iPatientID', '$vMobile', '$dtCreated', '$cStatus', '$camp_id', '$camp_id', '$iTokenNum')";
            $result = sql_query($query);

            if ($result) {
                // Update the camp table
                $updateCampQuery = "UPDATE camp 
                                    SET iCurrToken = iCurrToken + 1, 
                                        iNumRegs = iNumRegs + 1 
                                    WHERE iCampID = '$camp_id'";
                $updateCampResult = sql_query($updateCampQuery);

                if ($updateCampResult) {
                    header('Location: add_patient_details.php?id=' . $iPatientID);
                    exit;
                } else {
                    $error_message = "Failed to update camp details. Please try again.";
                }
            } else {
                $error_message = "Failed to save patient details. Please try again.";
            }
        }
    } else {
        $error_message = "Mobile number is required.";
    }
}
?>

<body>
    <?php
    include 'load_header.php';
    include '_header.php';
    ?>

    <div id="appCapsule">
        <div class="wide-block pt-2 pb-2">
            <div class="text1">Patient Mobile Number</div>
            <p class="text-gray">Enter the patient’s mobile number below to continue</p>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label text-black" for="vMobile">Mobile number</label>
                        <input type="tel" class="form-control" name="vMobile" id="vMobile" placeholder="+91">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">NEXT</button>
                <a href="dashboard.php" class="btn btn-block btn-lg mt-4">SKIP</a>
            </form>
        </div>
    </div>

    <?php include 'load_footer.php'; ?>
</body>

</html>