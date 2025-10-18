<?php 
session_start();
include("admin/admin_inc/db.php");

$u = $_POST['username'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 
$e = $_POST['email'];
$ph = $_POST['phone_no'];
$aadhaar_no = $_POST['aadhaar_no'];
$pan_no = $_POST['pan_no'];

$ins = "INSERT INTO user (username, password, email, phone_no, aadhaar_no, pan_no) 
        VALUES ('$u', '$pass', '$e', '$ph', '$aadhaar_no', '$pan_no')";

if ($con->query($ins)) {
    $_SESSION['registration_success'] = true;
    header("Location: sign_up.php"); // change to your actual registration page
    exit();
} else {
    $_SESSION['registration_error'] = "Error: " . $con->error;
    header("Location: sign_up.php");
    exit();
}
?>
