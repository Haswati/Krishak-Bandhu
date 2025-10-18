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
$prev_subsidy = [];
$subsidy_exists = false;

// Fetch user info
$query = "SELECT username, aadhaar_no, pan_no, phone_no FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $sid);
$stmt->execute();
$stmt->bind_result($username, $aadhaar_no, $pan_no, $phone_no);
$stmt->fetch();
$stmt->close();

// Fetch previous disaster subsidy application (if any)
$query_subsidy = "SELECT * FROM disaster_subsidy_applications WHERE user_id = ? ORDER BY id DESC LIMIT 1";
$stmt_subsidy = $con->prepare($query_subsidy);
$stmt_subsidy->bind_param("i", $sid);
$stmt_subsidy->execute();
$result_subsidy = $stmt_subsidy->get_result();
if ($result_subsidy->num_rows > 0) {
    $prev_subsidy = $result_subsidy->fetch_assoc();
    // Block only if status is still 'pending'
    if ($prev_subsidy['status'] == 'pending') {
        $subsidy_exists = true;
    }
}
$stmt_subsidy->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Krishak Bandhu | Disaster Subsidy</title>
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
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('status');
                window.history.replaceState({}, document.title, url.toString());
            }
        });
    });
</script>
<?php elseif ($subsidy_exists): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "warning",
            title: "Already Applied",
            text: "You have already applied for a disaster subsidy. Please wait until your application is reviewed by the authority.",
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
            <h2>Disaster Subsidy Application</h2>
            <?php if ($subsidy_exists): ?>
                <div class="alert alert-warning text-center">
                    <strong>Note:</strong> You have already applied for a disaster subsidy. Please wait for admin approval or status update.
                </div>
            <?php else: ?>
            <form action="disaster_subsidy_check.php" method="post" enctype="multipart/form-data" onsubmit="return validateDisasterForm()">

                <!-- Personal Details -->
                <h4 class="section-header">Personal Details</h4>
                <div class="form-row">
                    <input type="text" name="name" value="<?= htmlspecialchars($username) ?>" placeholder="Applicant Name" readonly required>
                    <input type="text" name="aadhaar" value="<?= htmlspecialchars($aadhaar_no) ?>" placeholder="Aadhaar Number" pattern="\d{12}" maxlength="12" readonly required>
                </div>
                <div class="form-row">
                    <input type="text" name="phone_no" value="<?= htmlspecialchars($phone_no) ?>" placeholder="Contact Number" pattern="\d{10}" maxlength="10" readonly required>
                    <input type="text" name="pan" value="<?= htmlspecialchars($pan_no) ?>" placeholder="PAN Number" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" maxlength="10" readonly required>
                </div>
                <div class="form-row">
                    <select name="block_name" required>
                        <option value="">Select Block Name</option>
                        <optgroup label="Purba Bardhaman">
                            <option value="Kalna-I">Kalna-I</option>
                            <option value="Kalna-II">Kalna-II</option>
                            <option value="Purbasthali-I">Purbasthali-I</option>
                            <option value="Purbasthali-II">Purbasthali-II</option>
                            <option value="Katwa-I">Katwa-I</option>
                            <option value="Katwa-II">Katwa-II</option>
                            <option value="Manteswar">Manteswar</option>
                            <option value="Aushgram-I">Aushgram-I</option>
                            <option value="Aushgram-II">Aushgram-II</option>
                            <option value="Bhatar">Bhatar</option>
                            <option value="Burdwan-I">Burdwan-I</option>
                            <option value="Burdwan-II">Burdwan-II</option>
                        </optgroup>
                        <optgroup label="Paschim Bardhaman">
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Kanksa">Kanksa</option>
                            <option value="Barabani">Barabani</option>
                            <option value="Pandabeswar">Pandabeswar</option>
                            <option value="Salanpur">Salanpur</option>
                            <option value="Raniganj">Raniganj</option>
                            <option value="Andal">Andal</option>
                        </optgroup>
                        <optgroup label="Birbhum">
                            <option value="Suri-I">Suri-I</option>
                            <option value="Suri-II">Suri-II</option>
                            <option value="Rampurhat-I">Rampurhat-I</option>
                            <option value="Rampurhat-II">Rampurhat-II</option>
                            <option value="Nalhati-I">Nalhati-I</option>
                            <option value="Nalhati-II">Nalhati-II</option>
                        </optgroup>
                        <optgroup label="Bankura">
                            <option value="Bankura-I">Bankura-I</option>
                            <option value="Bankura-II">Bankura-II</option>
                            <option value="Indpur">Indpur</option>
                            <option value="Saltora">Saltora</option>
                        </optgroup>
                        <optgroup label="Nadia">
                            <option value="Krishnanagar-I">Krishnanagar-I</option>
                            <option value="Krishnanagar-II">Krishnanagar-II</option>
                            <option value="Chapra">Chapra</option>
                            <option value="Tehatta-I">Tehatta-I</option>
                            <option value="Tehatta-II">Tehatta-II</option>
                        </optgroup>
                        <optgroup label="Murshidabad">
                            <option value="Berhampore">Berhampore</option>
                            <option value="Beldanga-I">Beldanga-I</option>
                            <option value="Beldanga-II">Beldanga-II</option>
                            <option value="Domkal">Domkal</option>
                        </optgroup>
                    </select>
                    <input type="date" name="disaster_date" required>
                </div>

                <!-- Disaster Details -->
                <h4 class="section-header">Disaster Information</h4>
                <div class="form-row">
                    <select name="disaster_type" required>
                        <option value="">Type of Disaster</option>
                        <option value="Flood">Flood</option>
                        <option value="Drought">Drought</option>
                        <option value="Cyclone">Cyclone</option>
                        <option value="Hailstorm">Hailstorm</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-row">
                    <textarea name="damage_details" placeholder="Describe Damage (Crops, Livestock, Property)" required></textarea>
                </div>
                <div class="form-row">
                    <input type="number" name="estimated_loss" placeholder="Estimated Loss (in ₹)" min="0" required>
                    <input type="file" name="proof" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>

                <!-- Bank Details -->
                <h4 class="section-header">Bank Details</h4>
                <div class="form-row">
                    <input type="text" name="account" placeholder="Account Number" pattern="\d{9,18}" required>
                    <input type="text" name="ifsc" placeholder="IFSC Code" pattern="^[A-Z]{4}0[A-Z0-9]{6}$" required>
                </div>
                <div class="form-row">
                    <input type="text" name="branch" placeholder="Branch Location" required>
                </div>

                <input type="submit" value="Apply for Subsidy">
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("inc/footer.php"); ?>

<script>
function validateDisasterForm() {
    const aadhaar = document.querySelector('[name="aadhaar"]').value.trim();
    const phone = document.querySelector('[name="phone_no"]').value.trim();
    const pan = document.querySelector('[name="pan"]').value.trim();
    const ifsc = document.querySelector('[name="ifsc"]').value.trim();

    if (!/^\d{12}$/.test(aadhaar)) {
        Swal.fire("Error", "Aadhaar number must be 12 digits.", "error");
        return false;
    }

    if (!/^\d{10}$/.test(phone)) {
        Swal.fire("Error", "Phone number must be 10 digits.", "error");
        return false;
    }

    if (!/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(pan)) {
        Swal.fire("Error", "Invalid PAN format.", "error");
        return false;
    }

    if (!/^[A-Z]{4}0[A-Z0-9]{6}$/.test(ifsc)) {
        Swal.fire("Error", "Invalid IFSC Code.", "error");
        return false;
    }

    return true;
}
</script>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f9f9f9;
    margin: 0;
    padding: 0;
}
.form-container {
    max-width: 750px;
    margin: 60px auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}
.form-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #222;
}
.section-header {
    margin-top: 30px;
    margin-bottom: 10px;
    font-size: 20px;
    color: #0c46f2;
    border-left: 4px solid #0c46f2;
    padding-left: 10px;
}
.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 15px;
}
.form-row input,
.form-row textarea,
.form-row select {
    flex: 1;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    min-width: 45%;
    box-sizing: border-box;
}
textarea {
    resize: vertical;
    min-height: 60px;
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
</style>

</body>
</html>
