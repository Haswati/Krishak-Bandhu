<?php
// Start the session if it's not already started. This is crucial for accessing $_SESSION variables.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file. This file should contain the $con variable for database interaction.
include("admin/admin_inc/db.php");

// Check if the user is logged in by verifying if 'uid' is set in the session.
// If not logged in, redirect to the login page and exit to prevent further script execution.
if (empty($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session. This ID will be used to fetch their specific loan records.
$uid = $_SESSION['uid'];

// Prepare the SQL query to select all columns from the 'loan' table where the 'user_id' matches the logged-in user's ID.
// Using a prepared statement helps prevent SQL injection vulnerabilities.
$query = "SELECT * FROM loan WHERE user_id = ?";
$stmt = $con->prepare($query);

// Bind the user ID parameter to the prepared statement. 'i' indicates that $uid is an integer.
$stmt->bind_param("i", $uid);

// Execute the prepared statement.
$stmt->execute();

// Get the result set from the executed statement.
$result = $stmt->get_result();

// Initialize an empty array to store all loan records for the user.
// This is critical for displaying multiple loan applications.
$loans = [];

// Loop through the result set and fetch each row as an associative array.
// Add each fetched row (representing a single loan application) to the $loans array.
while ($row = $result->fetch_assoc()) {
    $loans[] = $row;
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
    <title>Track Loan Application - Krishak Bandhu</title>
    <link rel="icon" type="image/x-icon" href="images/krishakbondhulogo.png">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Custom styling for the loan application cards */
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
    <h2 class="text-center mt-4 mb-4">Loan Application Status</h2>

    <?php
    // Check if the $loans array is not empty. If it contains loan records, proceed to display them.
    if (!empty($loans)):
    ?>
        <?php
        // Loop through each loan record in the $loans array.
        // Each $loan variable in this loop will represent a single loan application.
        foreach ($loans as $loan):
        ?>
            <?php
            // Determine the status text and color based on the 'status' value from the database.
            // This logic is repeated for each loan as its status can be different.
            $statusText = "Pending"; // Default status
            $statusColor = "warning"; // Default color (Bootstrap warning yellow)

            switch ($loan['status']) {
                case 1:
                    $statusText = "Approved";
                    $statusColor = "success"; // Bootstrap success green
                    break;
                case 2:
                    $statusText = "Rejected";
                    $statusColor = "danger"; // Bootstrap danger red
                    break;
                // Default case (status 0 or any other value) remains "Pending"
            }
            ?>
            <div class="card mb-4">
                <h5 class="mb-3">
                    Application ID: <?= htmlspecialchars($loan['id']) ?> | Applied on: <?= date('d M Y', strtotime($loan['created_at'])) ?>
                </h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Field</th>
                        <td><?= htmlspecialchars($loan['field']) ?></td>
                    </tr>
                    <tr>
                        <th>Requested Amount</th>
                        <td>₹<?= number_format($loan['amount'], 2) ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-<?= $statusColor ?>"><?= $statusText ?></span></td>
                    </tr>
                    <?php
                    // Display additional information if the loan is approved (status 1).
                    if ($loan['status'] == 1):
                    ?>
                        <tr>
                            <th>Approved Amount</th>
                            <td>₹<?= number_format($loan['amount'], 2) ?></td>
                        </tr>
                        <tr>
                            <th>Expected Release Date</th>
                            <td>
                                <?= date('d M Y', strtotime($loan['created_at'] . ' +7 days')) ?>
                                <small class="text-muted">(within 7 days of approval)</small>
                            </td>
                        </tr>
                    <?php
                    // Display a reason if the loan is rejected (status 2).
                    elseif ($loan['status'] == 2):
                    ?>
                        <tr>
                            <th>Reason</th>
                            <td>Not approved (contact local authority)</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endforeach; ?>
    <?php
    // If no loan applications are found for the user, display an informative message.
    else:
    ?>
        <div class="alert alert-info text-center mt-5">
            No loan applications found. <a href="apply_loan.php" class="btn btn-sm btn-primary ml-2">Apply Now</a>
        </div>
    <?php endif; ?>

</div>

<?php include('inc/dashboard_footer.php'); ?>
</body>
</html>
