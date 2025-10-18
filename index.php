<?php
session_start();
include("admin/admin_inc/db.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Krishak Bandhu – Official Farmer Portal</title>
<link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tillage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstarp-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstarp-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<script src="js/jquery-1.11.1.min.js"></script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,800,700,600' rel='stylesheet' type='text/css'>
<!--/fonts-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
	 new WOW().init();
</script>
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
  <div class="banner">
    <div class="container">
      <?php include('inc/header.php'); ?>
      <div class="callbacks_container">
        <ul class="rslides" id="slider3">
          <li>
            <div class="banner-info">
              <h2>কৃষক বাঁচলে, কৃষি বাঁচবে, বাঁচবে জাতি</h2>
              <h2>কৃষক হলো মোদের আঁধার ঘরের বাতি।</h2>                
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="banner-bottom">
    <div class="container">
      <div class="banner-bottom-grids">
        <div class="col-md-7 banner-bottom-grid-text">
          <div class="jumbotron wow fadeInLeft animated">
            <h3>What is Krishak Bandhu?</h3>
            <h5>The West Bengal Government's flagship welfare scheme for farmers.</h5>
            <p>It provides direct financial assistance of Rs. 10,000 per year to farmers, crop insurance, and death benefit coverage of Rs. 2 lakhs to support farming families in need.</p>
            <a class="btn btn-primary btn-lg" href="#">Learn More</a>
          </div>
        </div>
        <div class="col-md-5 wow fadeInRight animated">
          <img src="images/image001.jpeg" alt="Krishak Bandhu Scheme" style="width:400px;height:400px">
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

  <div class="specialty">
    <div class="container">
      <div class="col-md-5 specialty-info wow fadeInLeft animated">
        <h3>Our Mission</h3>
        <h5>Support, Empower, and Uplift Bengal's Farmers</h5>
        <p>The Krishak Bandhu scheme ensures that every farmer is recognized, protected, and provided with the means to grow safely and sustainably.</p>
        <a class="btn btn-primary btn-lg" href="#">Explore Benefits</a>
      </div>
      <div class="col-md-7 specialty-grids">
        <div class="row">
          <div class="col-md-6 service-box wow bounceIn">
            <img src="images/image04.jpeg" alt="Krishak Bandhu Scheme" style="width:250px;height:250px">
            <h5>Direct Financial Assistance</h5>
            <p>Yearly support to ensure crop planning and timely sowing.</p>
          </div>
          <div class="col-md-6 service-box wow bounceIn">
            <img src="images/image05.png" alt="Krishak Bandhu Scheme" style="width:250px;height:250px">
            <h5>Crop Insurance Coverage</h5>
            <p>Financial protection from natural calamities and crop failures.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 service-box wow bounceIn">
            <img src="images/image06.png" alt="Krishak Bandhu Scheme" style="width:250px;height:250px">
            <h5>Death Benefit Coverage</h5>
            <p>Rs. 2 lakh support to farming families in case of untimely death.</p>
          </div>
          <div class="col-md-6 service-box wow bounceIn">
            <img src="images/image07.png" alt="Krishak Bandhu Scheme" style="width:250px;height:250px">
            <h5>One Farmer One Identity</h5>
            <p>Unique Farmer ID Card for seamless benefits and services.</p>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>

  <div class="news">
    <div class="container">
      <div class="news-text">
        <h3>Latest Updates</h3>
        <h5>News, Events & Announcements</h5>
      </div>
      <div class="row">
        <div class="col-md-3 news-grid wow bounceIn">
          <h4>Farmers' Meet 2025</h4>
          <span>JUN 09, 2025</span>
          <img src="images/image08.png" alt="Krishak Bandhu Scheme" style="width:200px;height:200px">
          <p>Interactive session held in Bardhaman to raise awareness about Krishak Bandhu benefits.</p>
        </div>
        <div class="col-md-3 news-grid wow bounceIn">
          <h4>Insurance Claim Update</h4>
          <span>SEP 24, 2025</span>
          <img src="images/image05.png" alt="Krishak Bandhu Scheme" style="width:200px;height:200px">
          <p>Over 2 lakh farmers received crop insurance benefits after recent floods.</p>
        </div>
        <div class="col-md-3 news-grid wow bounceIn">
          <h4>New Farmer ID Launched</h4>
          <span>FEB 15, 2025</span>
          <img src="images/image07.png" alt="Krishak Bandhu Scheme" style="width:200px;height:200px">
          <p>One Farmer One ID introduced for easier access to welfare schemes.</p>
        </div>
        <div class="col-md-3 news-grid wow bounceIn">
          <h4>Mobile App Released</h4>
          <span>JUN 10, 2025</span>
          <img src="images/krishak_farmers_access.jpg" alt="Krishak Bandhu Scheme" style="width:200px;height:200px">
          <p>Official Krishak Bandhu mobile app released to check status and apply online.</p>
        </div>
      </div>
    </div>
  </div>
				<div class="clearfix"> </div>
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
			</div>
		</div>
	</div>
	<!-- //news -->
	<!-- footer -->
	<?php include("inc/footer.php");?>