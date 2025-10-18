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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Krishak Bandhu" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script> new WOW().init(); </script>

    <style>
        .service-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 12px;
            padding: 25px 20px;
            color: #fff;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 15px;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.18);
        }

        .service-icon {
            font-size: 32px;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.2);
            width: 64px;
            height: 64px;
            line-height: 64px;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            color: white;
        }

        .service-card h5 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .service-card p {
            font-size: 1.1rem;
            line-height: 1.5;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .service-card .btn {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 20px;
            background-color: #ffffff;
            color: #000;
        }

        .service-card .btn:hover {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
        }

        .loan-card { background: linear-gradient(135deg, #e53935, #b71c1c); }
        .subsidy-card { background: linear-gradient(135deg, #43a047, #1b5e20); }
        .contact-card { background: linear-gradient(135deg, #1e88e5, #0d47a1); }
        .insurance-card { background: linear-gradient(135deg, #8e24aa, #4a148c); }
        .id-card { background: linear-gradient(135deg, #f9a825, #f57f17); }
        .market-card { background: linear-gradient(135deg, #00acc1, #006064); }
        .tracking-card { background: linear-gradient(135deg, #6d4c41, #3e2723); }

        .row > [class*='col-'] {
            display: flex;
        }

        .service-card {
            width: 100%;
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
<?php if (isset($_SESSION['login_success'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'success',
                title: 'Login Successful',
                text: 'Welcome to Krishak Bandhu Portal!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
    <?php unset($_SESSION['login_success']); ?>
<?php endif; ?>

<!-- Banner -->
<div class="banner">
    <div class="container">
        <?php include('inc/header.php'); ?>

        <!-- Services Section -->
        <div class="container mt-5">
            <div class="text-center mb-4">
                <h2 style="color: white;">Farmer Services</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- All Service Cards Here -->
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card loan-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-hand-holding-usd fa-2x"></i></div>
                        <h5 class="mt-2">Apply for Loan</h5>
                        <p>Get financial help to boost your agricultural productivity.</p>
                        <a href="apply_loan.php" class="btn btn-light">Apply Now</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card subsidy-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-cloud-showers-heavy fa-2x"></i></div>
                        <h5 class="mt-2">Disaster Subsidy</h5>
                        <p>Recover from natural disasters with government support.</p>
                        <a href="apply_disaster_subsidy.php" class="btn btn-light">Apply Now</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card contact-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-user-shield fa-2x"></i></div>
                        <h5 class="mt-2">Local Authority</h5>
                        <p>Need help? Contact your local Krishi officer.</p>
                        <a href="contact_local_authority.php" class="btn btn-light">Contact</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card id-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-id-card fa-2x"></i></div>
                        <h5 class="mt-2">Farmer ID</h5>
                        <p>Register to get your unique Farmer Identity Card.</p>
                        <a href="apply_farmer_id.php" class="btn btn-light">Register</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card insurance-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-shield-alt fa-2x"></i></div>
                        <h5 class="mt-2">Crop Insurance</h5>
                        <p>Protect your crops from unexpected losses and damages.</p>
                        <a href="crop_insurance.php" class="btn btn-light">Learn More</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card market-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-chart-line fa-2x"></i></div>
                        <h5 class="mt-2">Market Prices</h5>
                        <p>Track real-time mandi prices for your produce.</p>
                        <a href="market_prices.php" class="btn btn-light">View Prices</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card tracking-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-tasks fa-2x"></i></div>
                        <h5 class="mt-2">Track Loan Applications</h5>
                        <p>Track real-time loan applications.</p>
                        <a href="track_applications.php" class="btn btn-light">Track Now</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card tracking-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-tasks fa-2x"></i></div>
                        <h5 class="mt-2">Track Subsidy Applications</h5>
                        <p>Track real-time subsidy applications.</p>
                        <a href="track_subsidy_application.php" class="btn btn-light">Track Now</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                    <div class="card service-card tracking-card flex-fill text-center p-3">
                        <div class="service-icon"><i class="fas fa-tasks fa-2x"></i></div>
                        <h5 class="mt-2">Track Insurance Applications</h5>
                        <p>Track real-time Insurance applications.</p>
                        <a href="track_insurance_application.php" class="btn btn-light">Track Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- // Services Section -->
    </div>
</div>

<!-- Tawk.to Script -->
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

<?php include("inc/dashboard_footer.php"); ?>
</body>
</html>
