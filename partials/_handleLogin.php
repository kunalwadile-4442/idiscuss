<?php
include '_db.conect.php'; // Ensure this path is correct
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start(); // Start the session at the beginning

    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) { // Use == for comparison
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];

            $_SESSION['useremail'] = $email;
            header("Location: /forum/index.php?loginsuccess"); // Redirect to the forum index
            exit();
        } else {
            header("Location: /forum/index.php?loginError".($showError));
        }
    } else {
        $showError = "Unable to login. Invalid credentials.";
    }
}

// If there's an error, redirect with an error message
if ($showError) {
    header("Location: /forum/index.php?loginsuccess=false&error=" . urlencode($showError));
    exit();
}
?>
