<?php 
session_start();
include("admin/admin_inc/db.php");

if (!isset($_SESSION['uid'])) {
    header("location: login.php");
    exit();
}

$sid = $_SESSION['uid'];

// Check if user has an existing loan with status Pending (0) or Approved (1)
$checkQuery = "SELECT id FROM loan WHERE user_id = ? AND status = 0";
$checkStmt = $con->prepare($checkQuery);
$checkStmt->bind_param("i", $sid);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    header("Location: apply_loan.php?status=exists");
    exit();
}
$checkStmt->close();

// Sanitize and validate input
function clean($data) {
    return htmlspecialchars(trim($data));
}

$name     = clean($_POST['name']);
$father   = clean($_POST['father']);
$mother   = clean($_POST['mother']);
$adhaar   = clean($_POST['adhaar']);
$address  = clean($_POST['address']);
$pincode  = clean($_POST['pincode']);
$state    = clean($_POST['state']);
$account  = clean($_POST['account']);
$ifsc     = clean($_POST['ifsc']);
$branch   = clean($_POST['branch']);
$village  = clean($_POST['village']);
$field    = clean($_POST['field']);
$amount   = floatval($_POST['amount']);

// Server-side validation
if (!preg_match('/^\d{12}$/', $adhaar)) {
    die("Invalid Aadhaar number");
}
if (!preg_match('/^\d{6}$/', $pincode)) {
    die("Invalid pincode");
}
if (!preg_match('/^[A-Z]{4}0[A-Z0-9]{6}$/', $ifsc)) {
    die("Invalid IFSC code");
}
if ($amount <= 0 || $amount > 50000) {
    die("Amount must be between ₹1 and ₹50000");
}

// Insert the loan application
$query = "INSERT INTO loan (name, father, mother, adhaar, address, pincode, state, account, ifsc, branch, village, field, amount, user_id)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $con->prepare($query);
$stmt->bind_param("ssssssssssssdi", $name, $father, $mother, $adhaar, $address, $pincode, $state, $account, $ifsc, $branch, $village, $field, $amount, $sid);

if ($stmt->execute()) {
    header("Location: apply_loan.php?status=success");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
?>
