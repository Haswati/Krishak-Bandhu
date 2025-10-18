<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

include("admin/admin_inc/db.php");

$uid = $_SESSION['uid'];

// Validate inputs
$name = trim($_POST['name']);
$aadhaar = trim($_POST['aadhaar']);
$phone = trim($_POST['phone']);
$pan = trim($_POST['pan']);

$allowed_image_types = ['image/jpeg', 'image/png', 'application/pdf'];
$upload_dir = 'uploads/farmer_id/';

// Create upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Validate and move uploaded files
function handle_upload($file_input_name, $upload_dir, $allowed_types) {
    if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $file = $_FILES[$file_input_name];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid() . "_" . time() . "." . $ext;
    $target_path = $upload_dir . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $target_path)) {
        return $target_path;
    }

    return false;
}

$land_proof_path = handle_upload('land_proof', $upload_dir, $allowed_image_types);
$authority_approval_path = handle_upload('photo', $upload_dir, $allowed_image_types);

if (!$land_proof_path || !$authority_approval_path) {
    echo "File upload failed. Please check file type and try again.";
    exit();
}

// Insert into database
$query = "INSERT INTO farmer_id_applications (user_id, name, aadhaar, phone, pan, land_proof, authority_approval, applied_at)
          VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $con->prepare($query);
if (!$stmt) {
    die("Database error: " . $con->error);
}

$stmt->bind_param("issssss", $uid, $name, $aadhaar, $phone, $pan, $land_proof_path, $authority_approval_path);

if ($stmt->execute()) {
    header("Location: apply_farmer_id.php?status=success");
    exit();
} else {
    echo "Error submitting application: " . $stmt->error;
}

$stmt->close();
$con->close();
?>