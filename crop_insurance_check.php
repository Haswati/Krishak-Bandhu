<?php
session_start();
include('admin/admin_inc/db.php'); // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $aadhaar = $_POST['aadhaar'];
    $phone = $_POST['phone'];
    $pan = $_POST['pan'];
    $crop_type = $_POST['crop_type'];
    $season = $_POST['season'];
    $area = $_POST['area'];
    $proof = $_FILES['proof']['name']; // File name
    $proof_tmp = $_FILES['proof']['tmp_name']; // Temporary file path

    // Validate and move uploaded file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($proof);
    if (move_uploaded_file($proof_tmp, $target_file)) {
        // Prepare and bind
        $user_id = $_SESSION['uid']; // get current user id

$stmt = $con->prepare("INSERT INTO crop_insurance (user_id, name, aadhaar, phone, pan, crop_type, season, area, proof) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssssds", $user_id, $name, $aadhaar, $phone, $pan, $crop_type, $season, $area, $target_file);


        

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: crop_insurance.php?status=success");
            exit();
        } else {
            echo "Error submitting application: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Close the connection
$con->close();
?>
