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
$username = $aadhaar_no = $phone_no = $pan_no = '';

$query = "SELECT username, aadhaar_no, phone_no, pan_no FROM user WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $uid);
$stmt->execute();
$stmt->bind_result($username, $aadhaar_no, $phone_no, $pan_no);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crop Insurance – Krishak Bandhu</title>
    <link rel="icon" href="images/krishakbondhulogo.png">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .form-container {
    max-width: 500px;  /* reduce width, adjust as needed */
    margin: 60px auto; /* center horizontally */
    padding: 30px 20px; /* padding can be adjusted */
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            flex: 1 1 30%;
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 6px;
            font-weight: 500;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="submit"] {
    width: 100%;               /* full width */
    padding: 14px;             /* comfortable padding */
    background-color: #0c46f2; /* your blue */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
    box-shadow: 0 4px 8px rgba(12, 70, 242, 0.3);
}

input[type="submit"]:hover {
    background-color: #0ba4a4; /* teal-ish on hover */
    box-shadow: 0 6px 12px rgba(11, 164, 164, 0.5);
}

    </style>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<div class="form-container">
    <h2>Crop Insurance Application</h2>
    <form action="crop_insurance_check.php" method="post" enctype="multipart/form-data" onsubmit="return validateCropInsuranceForm()">
        <div class="form-row">
            <div class="form-group">
                <label for="name">Farmer Name</label>
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
                <label for="crop_type">Crop Type</label>
                <select name="crop_type" id="crop_type" required>
                    <option value="">Select Crop</option>
                    <option value="Wheat">Wheat</option>
                    <option value="Rice">Rice</option>
                    <option value="Maize">Maize</option>
                    <option value="Potato">Potato</option>
                    <option value="Mustard">Mustard</option>
                </select>
            </div>
            <div class="form-group">
                <label for="season">Season</label>
                <select name="season" id="season" required>
                    <option value="">Select Season</option>
                    <option value="Rabi">Rabi</option>
                    <option value="Kharif">Kharif</option>
                    <option value="Zaid">Zaid</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="area">Cultivated Area (in acres)</label>
                <input type="number" name="area" id="area" min="0.1" step="0.1" required>
            </div>
            
        </div>

        <div class="form-row">
            <div class="form-group" style="flex: 1 1 100%;">
                <label for="proof">Upload Land Proof / Crop Photo</label>
                <input type="file" name="proof" id="proof" accept=".jpg,.jpeg,.png,.pdf" required>
            </div>
        </div>

        <input type="submit" value="Submit Insurance Application">
    </form>
</div>

<?php include("inc/dashboard_footer.php"); ?>

<script>
function validateCropInsuranceForm() {
    const aadhaar = document.getElementById('aadhaar').value.trim();
    const phone = document.getElementById('phone').value.trim();

    if (!/^\d{12}$/.test(aadhaar)) {
        Swal.fire("Invalid", "Aadhaar must be 12 digits.", "error");
        return false;
    }

    if (!/^\d{10}$/.test(phone)) {
        Swal.fire("Invalid", "Phone number must be 10 digits.", "error");
        return false;
    }

    return true;
}
</script>
</body>
</html>