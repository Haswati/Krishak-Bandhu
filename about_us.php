<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Krishak Bandhu – Official Farmer Portal</title>
<link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Krishak Bandhu, Government Agricultural Scheme, West Bengal Farmers Support" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/jquery-1.11.1.min.js"></script>
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
	<div class="banner a-banner">
		<div class="container">
		<?php include("inc/header.php");?>
		</div>
	</div>

	<div class="about-top">
		<div class="container">
			<div class="about-info wow fadeInLeft animated" data-wow-delay="0.4s">
				<h3>About Krishak Bondhu</h3>
				<h5>Empowering Farmers, Ensuring Welfare</h5>
			</div>
			<div class="banner-bottom-grids a-banner-bottom-grids">
				<div class="col-md-5 banner-bottom-right wow fadeInRight animated" data-wow-delay="0.5s">
					<img src="images/krishak_farmers.jpg" alt="Farmers Krishak Bandhu">
				</div>
				<div class="col-md-7 a-banner-bottom-text">
					<div class="jumbotron banner-bottom-left wow fadeInLeft animated" data-wow-delay="0.5s">
					  <h3>Support System for West Bengal Farmers</h3>
						<h5>The Krishak Bandhu scheme is a flagship welfare initiative of the Government of West Bengal aimed at providing financial security to farmers.</h5>
						<p>This scheme offers direct financial assistance of Rs. 10,000 per year (in two installments) to farmers owning one acre or more, and proportionate assistance to those with less land. Additionally, the scheme provides a death benefit of Rs. 2 lakh to the farmer's family in case of untimely demise.</p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<div class="about-bottom">
		<div class="container">
			<h3 class="wow fadeInRight animated">Transforming Agriculture in West Bengal</h3>
			<div class="about-bottom-grids">
				<div class="col-md-6 about-bottom-left wow fadeInLeft animated" data-wow-delay="0.5s">
					<h4>Farmer-centric Initiatives</h4>
					<p>Krishak Bandhu enables hassle-free access to crop insurance, death benefits, and real-time updates on financial aid disbursements. It builds transparency and timely delivery into agricultural support systems.</p>
				</div>
				<div class="col-md-6 about-bottom-left about-bottom-right wow fadeInRight animated" data-wow-delay="0.5s">
					<h4>Digital Integration for Easy Access</h4>
					<p>With the launch of the online portal, farmers can now check payment status, update personal details, and download important documents. This digital platform minimizes delays and bridges the information gap between the government and beneficiaries.</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

	<div class="team">
		<div class="container">
			<div class="team-info">
				<h3 class="wow bounceIn animated" data-wow-delay="0.4s">Our Support Team</h3>
				<div class="team-grids">
					<div class="col-md-3 team-grid wow bounceIn animated" data-wow-delay="0.4s">
						<img src="images/haswati.jpg" style="width:100px,height:100px" alt="Team Member">
						<h6>Haswati Naskar</h6>
						<p>Technical Assistant Grade - I</p>
					</div>
					<div class="col-md-3 team-grid wow bounceIn animated" data-wow-delay="0.4s">
						<img src="images/shreejani.jpg" style="width:100px,height:100px" alt="Team Member">
						<h6>Shreejani Manna</h6>
						<p>Technical Assistant Grade - II</p>
					</div>
					<div class="clearfix"> </div>
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
				</div>
			</div>
		</div>
	</div>

	<?php include("inc/dashboard_footer.php"); ?>
</body>
</html>