<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("admin/admin_inc/db.php");

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['uid'];

// Fetch user info from DB
$username = $aadhaar_no = $pan_no = $phone_no = '';
$query = "SELECT username, aadhaar_no, pan_no, phone_no FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $aadhaar_no, $pan_no, $phone_no);
$stmt->fetch();
$stmt->close();

// Validate other POST parameters
$required_fields = ['block_name', 'disaster_date', 'disaster_type', 'damage_details', 'estimated_loss', 'account', 'ifsc', 'branch'];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire('Error', 'Missing required field: $field', 'error').then(() => window.history.back());
              </script>";
        exit();
    }
}

function clean_input($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$block_name      = clean_input($_POST['block_name']);
$disaster_date   = clean_input($_POST['disaster_date']);
$disaster_type   = clean_input($_POST['disaster_type']);
$damage_details  = clean_input($_POST['damage_details']);
$estimated_loss  = floatval($_POST['estimated_loss']);
$account_no      = clean_input($_POST['account']);
$ifsc_code       = strtoupper(clean_input($_POST['ifsc']));
$branch_location = clean_input($_POST['branch']);

// Validate inputs
if (!preg_match('/^\d{12}$/', $aadhaar_no)) {
    $error = "Aadhaar number must be 12 digits.";
}
elseif (!preg_match('/^\d{10}$/', $phone_no)) {
    $error = "Phone number must be 10 digits.";
}
elseif (!preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $pan_no)) {
    $error = "Invalid PAN format.";
}
elseif (!preg_match('/^[A-Z]{4}0[A-Z0-9]{6}$/', $ifsc_code)) {
    $error = "Invalid IFSC code format.";
}

if (isset($error)) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
    exit();
}

// Handle file upload
$upload_dir = "uploads/proofs/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (!isset($_FILES['proof']) || $_FILES['proof']['error'] !== UPLOAD_ERR_OK) {
    $error = "Error uploading file.";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
    exit();
}

$proof_file = $_FILES['proof'];
$ext = strtolower(pathinfo($proof_file['name'], PATHINFO_EXTENSION));
$allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];

if (!in_array($ext, $allowed_ext)) {
    $error = "Invalid file type. Only JPG, JPEG, PNG, PDF allowed.";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
    exit();
}

$proof_path = $upload_dir . uniqid('proof_', true) . '.' . $ext;

if (!move_uploaded_file($proof_file['tmp_name'], $proof_path)) {
    $error = "Failed to save uploaded file.";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
    exit();
}

// Insert into DB
$query = "INSERT INTO disaster_subsidy_applications 
    (user_id, name, aadhaar_no, phone_no, pan_no, block_name, disaster_date, disaster_type, 
     damage_details, estimated_loss, proof_path, account_no, ifsc_code, branch_location)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
if (!$stmt) {
    $error = "Prepare failed: " . $con->error;
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
    exit();
}

$stmt->bind_param("isssssssssdsss", 
    $user_id, $username, $aadhaar_no, $phone_no, $pan_no, $block_name, $disaster_date, $disaster_type, 
    $damage_details, $estimated_loss, $proof_path, $account_no, $ifsc_code, $branch_location);

if ($stmt->execute()) {
    header("Location: apply_disaster_subsidy.php?status=success");
} else {
    $error = "Database error: " . $stmt->error;
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
          <script>
            Swal.fire('Error', '$error', 'error').then(() => window.history.back());
          </script>";
}

$stmt->close();
?>
