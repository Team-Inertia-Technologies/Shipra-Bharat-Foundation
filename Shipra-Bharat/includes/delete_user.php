<?php
include '../includes/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    $deleteUserQuery = "DELETE FROM users WHERE iUserID = '$userID'";
    $userDeleted = sql_query($deleteUserQuery);

    $deleteAssocQuery = "DELETE FROM client_user_assoc WHERE iUserID = '$userID'";
    $assocDeleted = sql_query($deleteAssocQuery);

    $deletequery = "DELETE FROM employee_user_assoc WHERE iUserID = '$userID'";
    $res = sql_query($deletequery);

    if ($userDeleted && $assocDeleted && $res) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
