<?php 
require("reusable-snippets/show-errors.php"); 
?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <!-- Page Body -->
    <div class="container py-5">

        <div class="white-box p-0 mx-auto overflow-hidden">
            <div class="login-logo-box px-5 py-4">
                <img src="assets/logo.png" alt="">
            </div>    
            
            <div class="p-5">
                <!-- Page Title -->
                <h1 class="mb-3">Login</h1>

                <!-- Alert Boxes -->
                <?php 

                if (isset($_GET["queryFailed"])) {
                    echo '<div class="alert alert-danger">Account database query failed.</div>';
                }
                
                if (isset($_GET["wrongCredentials"])) {
                    echo '<div class="alert alert-danger">Incorrect username and/or password.</div>';
                }

                if (isset($_GET["notLoggedIn"])) {
                    echo '<div class="alert alert-warning">You must login to view that page.</div>';
                }

                if (isset($_GET["logoutSuccess"])) {
                    echo '<div class="alert alert-success">You have been logged out.</div>';
                }
                ?>

                <!-- Login Form -->
                <form action="login-authenticate.php" method="post" class="w-50">
                    <!-- Username -->
                    <label for="username">Username</label>
                    <input type="text" 
                        name="username" 
                        class="form-control"
                        required />

                    <br />

                    <!-- Password -->
                    <label for="password">Password</label>
                    <input type="password" 
                        name="password" 
                        class="form-control"
                        required />

                    <br />

                    <!-- Submit Button -->
                    <input type="submit"
                        name="login-submit-btn" 
                        value="Login" 
                        class="btn btn-primary" />
                </form>
            </div>
        </div>

    </div>

    
</body>

</html>