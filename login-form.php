<?php 
require("reusable-snippets/show-errors.php"); 
?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Login</title>
</head>

<body>
    <!-- Page Body -->
    <div class="container">

        <!-- Page Title -->
        <h1>Login</h1>

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

    
</body>

</html>