<?php 

// Connect to database
require("reusable-snippets/connect-database.php");

// If login button was clicked
if (isset($_POST["login-submit-btn"])) {
    // Obtain username and password input from login.php
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query database for username and password
    $accountSQL = "SELECT * FROM tbl_accounts
                   WHERE username = '$username'
                   AND password = '$password'";

    if ($accountQuery = mysqli_query($conn, $accountSQL)) {
        // If username and password are correct
        if (mysqli_num_rows($accountQuery) == 1) {
            // echo "Account exists.";
            // Start session
            session_start();

            // Fetch account details
            $accountResult = mysqli_fetch_assoc($accountQuery);

            // Store account details in session variables
            $_SESSION["account_id"] = $accountResult["id"];
            $_SESSION["account_name"] = $accountResult["name"];
            $_SESSION["account_username"] = $accountResult["username"];

            // // Redirect to menu.php
            header("location:menu.php");
        } else {
            // echo "Incorrect username and/or password.";
            // Redirect to login-form.php
            header("location:login-form.php?wrongCredentials=1");
        }
    } else {
        // echo "Query failed";
        header("location:login-form.php?queryFailed=1");
    }
}

?>