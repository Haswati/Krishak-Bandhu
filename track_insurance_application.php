<?php
// ---------- Session & DB ----------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "admin/admin_inc/db.php";

if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['uid'];

// ---------- Fetch applications ----------
$sql  = "SELECT * FROM crop_insurance WHERE user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result       = $stmt->get_result();
$applications = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Insurance Application – Krishak Bandhu</title>
    <link rel="icon"               href="images/krishakbondhulogo.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        .card  { margin:30px auto; max-width:800px; padding:20px; border-radius:12px; box-shadow:0 0 15px rgba(0,0,0,.1);}
        .badge { font-size:1rem; padding:.6em 1em; border-radius:20px;}
        .table th{width:30%;}
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
<div class="banner a-banner"><div class="container"><?php include "inc/header.php"; ?></div></div>

<div class="container">
    <h2 class="text-center mt-4 mb-4">Insurance Application Status</h2>

<?php if ($applications): ?>
    <?php foreach ($applications as $app): ?>
        <?php
        /** ---------- Flexible status handling ---------- */
        $rawStatus = strtolower(trim((string)$app['status']));   // always a string, lowercase
        $statusMap = [
            // anything that maps to "approved"
            '1'         => ['Approved', 'success'],
            'approved'  => ['Approved', 'success'],
            'accept'    => ['Approved', 'success'],
            'accepted'  => ['Approved', 'success'],

            // anything that maps to "rejected"
            '2'         => ['Rejected', 'danger'],
            'rejected'  => ['Rejected', 'danger'],
            'reject'    => ['Rejected', 'danger']
        ];
        [$statusText, $statusColor] = $statusMap[$rawStatus] ?? ['Pending', 'warning'];
        ?>
        <div class="card mb-4">
            <h5 class="mb-3">
                Application ID: <?= htmlspecialchars($app['id']) ?>
                | Applied on: <?= date('d M Y', strtotime($app['submission_date'])) ?>
            </h5>

            <table class="table table-bordered">
                <tr><th>Crop Type</th><td><?= htmlspecialchars($app['crop_type']) ?></td></tr>
                <tr><th>Season</th><td><?= htmlspecialchars($app['season'])    ?></td></tr>
                <tr><th>Area</th>  <td><?= number_format($app['area'],2)       ?></td></tr>
                <tr><th>Status</th><td><span class="badge bg-<?= $statusColor ?>"><?= $statusText ?></span></td></tr>

            <?php if ($statusText === 'Approved'): ?>
                
                <tr><th>Expected Release Date</th>
                    <td><?= date('d M Y', strtotime($app['created_at'].' +7 days')) ?>
                        <small class="text-muted">(within 7 days of approval)</small>
                    </td></tr>
            <?php elseif ($statusText === 'Rejected'): ?>
                <tr><th>Reason</th><td>Not approved (contact insurance authority)</td></tr>
            <?php endif; ?>
            </table>
        </div>
    <?php endforeach; ?>

<?php else: ?>
    <div class="alert alert-info text-center mt-5">
        No insurance applications found.
        <a href="crop_insurance.php" class="btn btn-sm btn-primary ml-2">Apply Now</a>
    </div>
<?php endif; ?>
</div>

<?php include "inc/dashboard_footer.php"; ?>
</body>
</html>