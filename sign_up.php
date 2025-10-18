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
    <meta name="keywords" content="Krishak Bondhu" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
        function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
    <!-- css -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--// css -->
    <!-- bootstrap-css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!--// bootstrap-css -->
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
    <?php if (isset($_SESSION['registration_success'])): ?>
    <script>
        swal({
            title: "Registration Successful!",
            text: "You will be redirected to login.",
            type: "success",
            timer: 2000,
            showConfirmButton: false
        });
        setTimeout(() => {
            window.location.href = "login.php";
        }, 2000);
    </script>
    <?php unset($_SESSION['registration_success']); endif; ?>

    <?php if (isset($_SESSION['registration_error'])): ?>
    <script>
        swal({
            title: "Registration Failed!",
            text: "<?php echo addslashes($_SESSION['registration_error']); ?>",
            type: "error",
            button: "Try Again",
        });
    </script>
    <?php unset($_SESSION['registration_error']); endif; ?>

    <!-- banner -->
    <div class="banner a-banner">
        <div class="container">
            <?php include("inc/header.php");?>
        </div>
    </div>
    <!-- //banner -->
    <!-- mail -->
    <div class="mail">
        <div class="container">
            <div class="mail-grids">
                <div class="col-md-6 mail-grid-left wow fadeInLeft animated" data-wow-delay="0.4s">
                    <h4>Krishak Bandhu Office</h4>
                    <p>Department of Agriculture<br>
                        Government of West Bengal<br>
                        Krishak Bandhu Cell<br>
                        Writers’ Building, Kolkata - 700001
                    </p>
                    <h4>Helpline</h4>
                    <p><a href="tel:+919875432100">+91 98754 32100</a></p>
                    <h4>Email Support</h4>
                    <p><a href="mailto:support@krishakbandhu.gov.in">support@krishakbandhu.gov.in</a></p>
                </div>
                <div class="col-md-6 contact-form wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
                    <h3><strong>Krishak Bondhu Registration</strong></h3>
                    <form action="register_check.php" method="post" class="php-email-form" onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="username" id="name" placeholder="User  Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="email" id="mail" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone_no" id="contact" minlength="10" maxlength="10" required pattern="\d{10}" placeholder="Phone Number">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="aadhaar_no" id="aadhaar_no" minlength="12" maxlength="12" required pattern="\d{12}" placeholder="Aadhaar Number">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="pan_no" id="pan_no" minlength="10" maxlength="10" required pattern="{10}" placeholder="Pan Number">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="password" id="password" placeholder="Password"> 
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required class="form-control">
                            </div>
                        </div>
                        <input type="submit" value="Register Now">
                    </form>

                    <script>
                        function validateForm() {
                            var name = document.getElementById("name").value.trim();
                            var contact = document.getElementById("contact").value.trim();
                            var mail = document.getElementById("mail").value.trim();
                            var password = document.getElementById("password").value.trim();
                            var confirm_password = document.getElementById("confirm_password").value.trim();
                            var aadhaar_no = document.getElementById("aadhaar_no").value.trim();
                            var pan_no = document.getElementById("pan_no").value.trim();

                            if (name === "" || contact === "" || mail === "" || password === "" || confirm_password === "" || aadhaar_no === "" || pan_no === "") {
                                alert("Oops!! All fields are mandatory.");
                                return false;
                            }
                            if (password !== confirm_password) {
                                alert("Password & confirm password are not the same.");
                                return false;
                            }
                            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailPattern.test(mail)) {
                                alert("Please enter a valid email address.");
                                return false;
                            } else if (contact.length !== 10 || isNaN(contact)) {
                                alert("Contact number should be 10 digits and only contain numbers.");
                                return false;
                            }

                            return true;
                        }
                    </script>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="map footer-middle wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.140687176134!2d88.34620587530051!3d22.573840879490874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277a49d1d522b%3A0x29d795887ec9fe6e!2sWriters&#39;%20Building!5e0!3m2!1sen!2sin!4v1747892080417!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- //container -->
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
    <!-- //mail -->
    <!-- footer -->
    <?php include("inc/footer.php"); ?>
</body>
</html>
