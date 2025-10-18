<?php
// Start the session if it's not already started.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file.
include("admin/admin_inc/db.php");

// Check if the user is logged in.
if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session.
$uid = $_SESSION['uid'];

// Prepare the SQL query to select all columns from the 'disaster_subsidy_applications' table where the 'user_id' matches the logged-in user's ID.
$query = "SELECT * FROM disaster_subsidy_applications WHERE user_id = ?";
$stmt = $con->prepare($query);

// Bind the user ID parameter to the prepared statement.
$stmt->bind_param("i", $uid);

// Execute the prepared statement.
$stmt->execute();

// Get the result set from the executed statement.
$result = $stmt->get_result();

// Initialize an empty array to store all subsidy records for the user.
$subsidies = [];

// Loop through the result set and fetch each row as an associative array.
while ($row = $result->fetch_assoc()) {
    $subsidies[] = $row;
}

// Close the statement to free up resources.
$stmt->close();

// Close the database connection.
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Subsidy Application - Krishak Bandhu</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Custom styling for the subsidy application cards */
        .card {
            margin: 30px auto; /* Center the card and add vertical margin */
            max-width: 800px; /* Limit the maximum width of the card */
            padding: 20px; /* Add padding inside the card */
            border-radius: 12px; /* Rounded corners for the card */
            box-shadow: 0 0 15px rgba(0,0,0,0.1); /* Subtle shadow for depth */
        }
        /* Styling for the status badges */
        .badge {
            font-size: 1rem; /* Larger font size for readability */
            padding: 0.6em 1em; /* More padding for a better look */
            border-radius: 20px; /* Pill-shaped badges */
        }
        /* Set a fixed width for table headers for better alignment */
        .table th {
            width: 30%;
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

<div class="container">
    <h2 class="text-center mt-4 mb-4">Subsidy Application Status</h2>

    <?php if (!empty($subsidies)): ?>
        <?php foreach ($subsidies as $subsidy): ?>
            <?php
            // Determine the status text and color based on the 'status' value from the database.
            $statusText = "Pending"; // Default status
            $statusColor = "warning"; // Default color (Bootstrap warning yellow)

            switch ($subsidy['status']) {
                case 'approved':
                    $statusText = "Approved";
                    $statusColor = "success"; // Bootstrap success green
                    break;
                case 'rejected':
                    $statusText = "Rejected";
                    $statusColor = "danger"; // Bootstrap danger red
                    break;
                // Default case (status 'pending' remains "Pending")
            }
            ?>
            <div class="card mb-4">
                <h5 class="mb-3">
                    Application ID: <?= htmlspecialchars($subsidy['id']) ?> | Applied on: <?= date('d M Y', strtotime($subsidy['created_at'])) ?>
                </h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?= htmlspecialchars($subsidy['name']) ?></td>
                    </tr>
                    <tr>
                        <th>Aadhaar No</th>
                        <td><?= htmlspecialchars($subsidy['aadhaar_no']) ?></td>
                    </tr>
                    <tr>
                        <th>Phone No</th>
                        <td><?= htmlspecialchars($subsidy['phone_no']) ?></td>
                    </tr>
                    <tr>
                        <th>PAN No</th>
                        <td><?= htmlspecialchars($subsidy['pan_no']) ?></td>
                    </tr>
                    <tr>
                        <th>Block Name</th>
                        <td><?= htmlspecialchars($subsidy['block_name']) ?></td>
                    </tr>
                    <tr>
                        <th>Disaster Date</th>
                        <td><?= htmlspecialchars($subsidy['disaster_date']) ?></td>
                    </tr>
                    <tr>
                        <th>Disaster Type</th>
                        <td><?= htmlspecialchars($subsidy['disaster_type']) ?></td>
                    </tr>
                    <tr>
                        <th>Estimated Loss</th>
                        <td>₹<?= number_format($subsidy['estimated_loss'], 2) ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-<?= $statusColor ?>"><?= $statusText ?></span></td>
                    </tr>
                    <?php if ($subsidy['status'] == 'approved'): ?>
                        <tr>
                            <th>Proof Path</th>
                            <td><a href="<?= htmlspecialchars($subsidy['proof_path']) ?>" target="_blank">View Proof</a></td>
                        </tr>
                    <?php elseif ($subsidy['status'] == 'rejected'): ?>
                        <tr>
                            <th>Reason</th>
                            <td>Not approved (contact local authority)</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info text-center mt-5">
            No subsidy applications found. <a href="apply_disaster_subsidy.php" class="btn btn-sm btn-primary ml-2">Apply Now</a>
        </div>
    <?php endif; ?>
</div>

<?php include('inc/dashboard_footer.php'); ?>
</body>
</html>
