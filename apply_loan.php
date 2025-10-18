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
$prev_loan = [];
$loan_exists = false;

// Fetch user info
$query = "SELECT username, aadhaar_no, pan_no, phone_no FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $sid);
$stmt->execute();
$stmt->bind_result($username, $aadhaar_no, $pan_no, $phone_no);
$stmt->fetch();
$stmt->close();

// Fetch previous loan application (if any)
$query_loan = "SELECT * FROM loan WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt_loan = $con->prepare($query_loan);
$stmt_loan->bind_param("i", $sid);
$stmt_loan->execute();
$result_loan = $stmt_loan->get_result();
if ($result_loan->num_rows > 0) {
    $prev_loan = $result_loan->fetch_assoc();
    // Only block if status is PENDING (0)
    if ($prev_loan['status'] == 0) {
        $loan_exists = true;
    }
}
$stmt_loan->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Krishak Bandhu | Apply Loan</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css" />
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
            icon: "success",
            title: "Application submitted successfully!",
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Remove status parameter from URL after showing alert
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('status');
                window.history.replaceState({}, document.title, url.toString());
            }
        });
    });
</script>
<?php elseif ($loan_exists): ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "warning",
            title: "Already Applied",
            text: "You have already applied for a loan. Please wait until your application status is updated.",
            confirmButtonText: "OK"
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
            <h2>Loan Application Form</h2>

            <?php if ($loan_exists): ?>
                <div class="alert alert-warning text-center">
                    <strong>Note:</strong> You have already applied for a loan. Please wait for admin approval or status update.
                </div>
            <?php else: ?>
                <form action="loan_check.php" method="post" onsubmit="return validateForm()">
                    <h4 class="section-header">Personal Details</h4>
                    <div class="form-row">
                        <input type="text" name="name" value="<?= htmlspecialchars($username) ?>" readonly required>
                        <input type="text" name="adhaar" value="<?= htmlspecialchars($aadhaar_no) ?>" readonly pattern="\d{12}" maxlength="12" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="mother" value="<?= htmlspecialchars($prev_loan['mother'] ?? '') ?>" placeholder="Mother's Name" required>
                        <input type="text" name="father" value="<?= htmlspecialchars($prev_loan['father'] ?? '') ?>" placeholder="Father's Name" required>
                    </div>

                    <h4 class="section-header">Contact Details</h4>
                    <div class="form-row">
                        <input type="text" name="village" value="<?= htmlspecialchars($prev_loan['village'] ?? '') ?>" placeholder="Village Name" required>
                        <textarea name="address" placeholder="Full Address" required><?= htmlspecialchars($prev_loan['address'] ?? '') ?></textarea>
                        <input type="text" name="pincode" value="<?= htmlspecialchars($prev_loan['pincode'] ?? '') ?>" placeholder="Pincode" pattern="\d{6}" maxlength="6" required>
                    </div>
                    <div class="form-row">
                        <select name="state" required>
                            <option value="">Select State</option>
                            <option value="West Bengal" <?= (isset($prev_loan['state']) && $prev_loan['state'] == 'West Bengal') ? 'selected' : '' ?>>West Bengal</option>
                        </select>
                    </div>

                    <h4 class="section-header">Bank Details</h4>
                    <div class="form-row">
                        <input type="text" name="account" value="<?= htmlspecialchars($prev_loan['account'] ?? '') ?>" placeholder="Account Number" required>
                        <input type="text" name="ifsc" value="<?= htmlspecialchars($prev_loan['ifsc'] ?? '') ?>" placeholder="IFSC Code" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="branch" value="<?= htmlspecialchars($prev_loan['branch'] ?? '') ?>" placeholder="Branch Location" required>
                    </div>

                    <h4 class="section-header">Loan Details</h4>
                    <div class="form-row">
                        <textarea name="field" placeholder="Area of Field (in Acres)" required><?= htmlspecialchars($prev_loan['field'] ?? '') ?></textarea>
                        <input type="number" name="amount" value="<?= htmlspecialchars($prev_loan['amount'] ?? '') ?>" placeholder="Loan Amount (Max ₹50000)" max="50000" required>
                    </div>

                    <input type="submit" value="Apply for Loan">
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("inc/dashboard_footer.php"); ?>

<script>
function validateForm() {
    const adhaar = document.querySelector('[name="adhaar"]').value.trim();
    const pincode = document.querySelector('[name="pincode"]').value.trim();
    const ifsc = document.querySelector('[name="ifsc"]').value.trim();
    const amount = parseFloat(document.querySelector('[name="amount"]').value);

    if (!/^\d{12}$/.test(adhaar)) {
        alert("Aadhaar must be 12 digits.");
        return false;
    }
    if (!/^\d{6}$/.test(pincode)) {
        alert("Pincode must be 6 digits.");
        return false;
    }
    if (!/^[A-Z]{4}0[A-Z0-9]{6}$/.test(ifsc)) {
        alert("Invalid IFSC Code.");
        return false;
    }
    if (isNaN(amount) || amount > 50000) {
        alert("Loan amount must be ₹50,000 or less.");
        return false;
    }
    return true;
}
</script>

<style>
body { font-family: 'Segoe UI', sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
.form-container { max-width: 750px; margin: 60px auto; background: #fff; padding: 30px 40px; border-radius: 12px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); }
.form-container h2 { text-align: center; margin-bottom: 30px; color: #222; }
.section-header { margin-top: 30px; margin-bottom: 10px; font-size: 20px; color: #0c46f2; border-left: 4px solid #0c46f2; padding-left: 10px; }
.form-row { display: flex; gap: 20px; margin-bottom: 15px; flex-wrap: wrap; }
.form-row select, .form-row input, .form-row textarea { flex: 1; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 15px; min-width: 45%; background-color: #fff; }
textarea { resize: vertical; min-height: 60px; }
input[type="submit"] { width: 100%; padding: 14px; background-color: #0c46f2; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; margin-top: 20px; }
input[type="submit"]:hover { background-color: #0ba4a4; }
</style>

</body>
</html>
