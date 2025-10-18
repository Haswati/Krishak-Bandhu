<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("admin/admin_inc/db.php");

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Krishak Bandhu – Official Farmer Portal</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f9ff;
            margin: 0;
            padding: 0;
        }
        .authority-container {
            max-width: 700px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .authority-container h2 {
            color: #0c46f2;
            margin-bottom: 20px;
        }
        .authority-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .contact-card {
            background: #f1f7ff;
            border-left: 4px solid #0c46f2;
            padding: 15px 20px;
            margin-bottom: 15px;
            text-align: left;
            border-radius: 8px;
        }
        .contact-card strong {
            color: #333;
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
		<?php include("inc/header.php");?>
		</div>
	</div>
<div class="authority-container">
    <h2>Need Help?</h2>
    <p>Contact your local Krishi officer for assistance with the Krishak Bandhu scheme.</p>

    <!-- Example contact entries -->
    <div class="contact-card">
        <strong>Officer Name:</strong> Ms. Shreejani Manna<br>
        <strong>Designation:</strong> Block Krishi Officer, Singur-I<br>
        <strong>Phone:</strong> +91-9876543210<br>
        <strong>Email:</strong> Shreejani.man@gov.in
    </div>

    <div class="contact-card">
        <strong>Officer Name:</strong> Ms. Haswati Naskar<br>
        <strong>Designation:</strong> Assistant Agriculture Officer, Konnagar-II<br>
        <strong>Phone:</strong> +91-9123456789<br>
        <strong>Email:</strong> haswati.nas@gov.in
    </div>
    <div class="contact-card">
        <strong>Officer Name:</strong> Ms. Oindrila Batabyal<br>
        <strong>Designation:</strong> Assistant Agriculture Officer, Chandannagar-II<br>
        <strong>Phone:</strong> +91-8415245789<br>
        <strong>Email:</strong> oindrila.bat@gov.in
    </div>

    <!-- Add more officers as needed -->
</div>
<!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/682374f97cde6e190a95b301/1ir581ros';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
<!--End of Tawk.to Script-->
<!-- Footer -->
<?php include("inc/dashboard_footer.php"); ?>
</body>
</html>
