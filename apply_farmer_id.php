<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("admin/admin_inc/db.php");

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$sid = $_SESSION['uid'];
$username = $aadhaar_no = $pan_no = $phone_no = '';
$application_exists = false;
$application_status = '';
$farmer_id = '';

// Fetch user info
$query = "SELECT username, aadhaar_no, pan_no, phone_no FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $sid);
$stmt->execute();
$stmt->bind_result($username, $aadhaar_no, $pan_no, $phone_no);
$stmt->fetch();
$stmt->close();

// Check application status
$checkQuery = "SELECT status, farmer_id FROM farmer_id_applications WHERE user_id = ?";
$checkStmt = $con->prepare($checkQuery);
$checkStmt->bind_param("i", $sid);
$checkStmt->execute();
$checkStmt->store_result();
if ($checkStmt->num_rows > 0) {
    $application_exists = true;
    $checkStmt->bind_result($application_status, $farmer_id);
    $checkStmt->fetch();
}
$checkStmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Farmer ID</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<!-- Google Translate Widget -->
<div id="google_translate_element"></div>

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,bn,hi,mr,ar,gu,bho,fr,te,pa',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
  #google_translate_element {
    position: fixed;
    top: 10px;
    right: 10px;
    z-index: 9999;
    background: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
  }
  .goog-te-gadget {
    font-size: 14px;
  }
  .goog-te-gadget-simple {
    border: none;
    background: none;
  }
</style>

<body>

<?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Application submitted successfully!",
            showConfirmButton: false,
            timer: 1500
        });
    });
</script>
<?php endif; ?>

<div class="banner a-banner">
    <div class="container">
        <?php include("inc/header.php"); ?>
    </div>
</div>

<div class="products-top">
    <div class="container">
        <div class="form-container">
            <h2>Apply for Farmer ID</h2>

                <?php if ($application_exists): ?>
                    <?php if ($application_status === 'approved'): ?>
                        <!-- Farmer ID Card -->
                        <div class="id-card">
                            <h3>Your Farmer ID is Approved</h3>
                            <p><strong>Name:</strong> <?= htmlspecialchars($username) ?></p>
                            <p><strong>Aadhaar:</strong> <?= htmlspecialchars($aadhaar_no) ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($phone_no) ?></p>
                            <p><strong>PAN:</strong> <?= htmlspecialchars($pan_no) ?></p>
                            <p><strong>Farmer ID:</strong> <span class="farmer-id"><?= htmlspecialchars($farmer_id) ?></span></p>
                        </div>
                    <?php elseif ($application_status === 'rejected'): ?>
                        <div class="alert alert-danger" role="alert" style="font-weight: bold;">
                            ❌ Your application was rejected. Please contact the local authority for more information or reapply.
                        </div>
                    <?php else: ?>
                        <p style="color: orange; font-weight: bold;">🕓 You have already applied. Please wait for admin approval.</p>
                    <?php endif; ?>
                <?php else: ?>
   

                <!-- Show Application Form -->
                <form action="farmer_id_check.php" method="post" enctype="multipart/form-data" onsubmit="return validateFarmerForm()">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Applicant Name</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($username) ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="aadhaar">Aadhaar Number</label>
                            <input type="text" id="aadhaar" name="aadhaar" value="<?= htmlspecialchars($aadhaar_no) ?>" readonly required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($phone_no) ?>" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="pan">PAN Number</label>
                            <input type="text" id="pan" name="pan" value="<?= htmlspecialchars($pan_no) ?>" readonly required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="land_proof">Upload Land Deed</label>
                            <input type="file" id="land_proof" name="land_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>
                        <div class="form-group">
                            <label for="photo">Upload Authority Approval</label>
                            <input type="file" id="photo" name="photo" accept=".jpg,.jpeg,.png" required>
                        </div>
                    </div>

                    <input type="submit" value="Submit Application">
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("inc/dashboard_footer.php"); ?>

<script>
function validateFarmerForm() {
    const aadhaar = document.querySelector('[name="aadhaar"]').value.trim();
    const phone = document.querySelector('[name="phone"]').value.trim();
    const pan = document.querySelector('[name="pan"]').value.trim();

    if (!/^\d{12}$/.test(aadhaar)) {
        Swal.fire("Error", "Aadhaar number must be 12 digits.", "error");
        return false;
    }
    if (!/^\d{10}$/.test(phone)) {
        Swal.fire("Error", "Phone number must be 10 digits.", "error");
        return false;
    }
    if (!/^[A-Z]{5}[0-9]{4}[A-Z]$/.test(pan)) {
        Swal.fire("Error", "Invalid PAN format.", "error");
        return false;
    }
    return true;
}
</script>

<style>
.form-container {
    max-width: 600px;
    margin: 60px auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    min-width: 45%;
    display: flex;
    flex-direction: column;
}

label {
    font-weight: 600;
    margin-bottom: 5px;
}

input {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 14px;
    background-color: #0c46f2;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
}

input[type="submit"]:hover {
    background-color: #0ba4a4;
}

.id-card {
    border: 2px solid green;
    padding: 20px;
    border-radius: 12px;
    background: #f1fff1;
}

.farmer-id {
    color: #0c46f2;
    font-weight: bold;
    font-size: 18px;
}
</style>

</body>
</html>