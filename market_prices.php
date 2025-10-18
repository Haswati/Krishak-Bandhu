<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

include("admin/admin_inc/db.php"); // Include DB if you plan to use dynamic data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Market Prices – Krishak Bandhu</title>
    <link rel="icon" href="images/krishakbondhulogo.png">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .market-prices {
            max-width: 800px;
            margin: 60px auto;
            padding: 30px 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        tbody tr:nth-child(even) {
            background-color: #fafafa;
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

<div class="banner a-banner">
    <div class="container">
        <?php include("inc/header.php"); ?>
    </div>
</div>

<div class="market-prices">
    <h2>Today's Market Prices</h2>
    <table>
        <thead>
            <tr>
                <th>Crop</th>
                <th>Price (₹ / Quintal)</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Wheat</td>
                <td>₹2,150</td>
                <td>Burdwan</td>
            </tr>
            <tr>
                <td>Rice (Paddy)</td>
                <td>₹1,950</td>
                <td>Nadia</td>
            </tr>
            <tr>
                <td>Maize</td>
                <td>₹1,800</td>
                <td>Birbhum</td>
            </tr>
            <tr>
                <td>Potato</td>
                <td>₹1,200</td>
                <td>Hooghly</td>
            </tr>
            <tr>
                <td>Mustard</td>
                <td>₹5,000</td>
                <td>Bankura</td>
            </tr>
        </tbody>
    </table>
</div>

<?php include("inc/dashboard_footer.php"); ?>
</body>
</html>
