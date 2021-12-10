<?php
//Hàm login sau khi mạng xã hội trả dữ liệu về
function loginFromSocialCallBack($socialUser) {
    include_once 'assets/conn/dbconnect.php';
    $result = mysqli_query($con, "Select * from `patient` WHERE `patientEmail` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($con, "INSERT INTO `patient` (`username`,`patientFirstName`,`patientLastName`,`patientEmail`) VALUES ('" . $socialUser['email'] . "', '" . $socialUser['name'] . "', '" . $socialUser['name'] . "','" . $socialUser['email'] . "')");
        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "Select * from `patient` WHERE `patientEmail` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['patientSession'] = $user['icPatient'];
        header('Location: doctorlogin.php');
    }
}

