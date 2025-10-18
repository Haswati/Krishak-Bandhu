<?php
session_start();
include("admin/admin_inc/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Krishak Bandhu – Official Farmer Portal</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <meta name="keywords" content="Krishak Bandhu, Farmer Login, West Bengal Government Scheme, Agricultural Support, Krishak Sahayata Yojana" />

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Animation -->
    <link href="css/animate.css" rel="stylesheet" />
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>

    <!-- SweetAlert CDN -->
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

<?php if (isset($_SESSION['login_error'])): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '<?php echo $_SESSION['login_error']; ?>',
        confirmButtonColor: '#3085d6'
    });
</script>
<?php unset($_SESSION['login_error']); ?>
<?php endif; ?>

<!-- Banner -->
<div class="banner a-banner">
    <div class="container">
        <?php include("inc/header.php"); ?>
    </div>
</div>

<!-- Login Section -->
<div class="mail">
    <div class="container">
        <div class="mail-grids">
            
            <!-- Contact Info -->
            <div class="col-md-6 mail-grid-left wow fadeInLeft animated" data-wow-delay="0.4s">
                <h4>Contact Information</h4>
                <p>
                    Department of Agriculture<br>
                    Government of West Bengal<br>
                    Writers' Building, Kolkata - 700001
                </p>

                <h4>Helpline Numbers</h4>
                <p><a href="tel:+919751596554">+91 97515 96554</a></p>
                <p><a href="tel:+918634305678">+91 86343 05678</a></p>

                <h4>Email Support</h4>
                <p><a href="mailto:support@krishakbandhu.gov.in">support@krishakbandhu.gov.in</a></p>
                <p><a href="mailto:helpline@krishakbandhu.gov.in">helpline@krishakbandhu.gov.in</a></p>
            </div>

            <!-- Login Form -->
            <div class="col-md-6 contact-form wow fadeInRight animated" data-wow-delay="0.4s">
                <div class="card p-4 shadow rounded" style="background-color: #f8f9fa;">
                    <h3 class="mb-4 text-center text-success">Krishak Bandhu – Farmer Login</h3>
                    
                    <form action="login_check.php" method="post">
                        <div class="form-group mb-3">                                
                            <input type="text" class="form-control" name="uname" id="uname" placeholder="Enter your Email or Aadhaar" required>
                        </div>
                        
                        <div class="form-group mb-3">                                
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-block w-100">Login</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="sign_up.php" class="text-decoration-none">Don't have an account? <strong>Register here</strong></a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map footer-middle wow bounceIn animated" data-wow-delay="0.4s">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.140687176134!2d88.34620587530051!3d22.573840879490874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277a49d1d522b%3A0x29d795887ec9fe6e!2sWriters&#39;%20Building!5e0!3m2!1sen!2sin!4v1747892080417!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Tawk.to Chat -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/682374f97cde6e190a95b301/1ir581ros';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
</div>

<!-- Footer -->
<?php include("inc/footer.php"); ?>
</body>
</html>
