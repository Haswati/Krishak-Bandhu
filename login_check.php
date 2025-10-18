<?php
session_start();
include("admin/admin_inc/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    // Check if the username is an email or Aadhaar number
    $query = "SELECT * FROM user WHERE email = ? OR aadhaar_no = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $uname, $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['login_success'] = true;
            $_SESSION['uid'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>
                    alert('Invalid password. Please try again.');
                    window.location.href = 'login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('User not found. Please check your email or Aadhaar number.');
                window.location.href = 'login.php';
              </script>";
    }
}
?>
