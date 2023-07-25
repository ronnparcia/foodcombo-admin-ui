<?php 
require("reusable-snippets/show-errors.php"); 

// TODO: Add conditions for login session
?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Menu Items</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <!-- Page Body -->
    <div class="container">
        <!-- Page Title -->
        <h1>Daily Report</h1>

        <!-- Form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <!-- Date -->
            <label for="report-date">Select date:</label>
            <input type="date" name="report-date" class="form-control w-50" required>

            <br/>

            <!-- Submit Button -->
            <input type="submit" name="report-submit-btn" value="Generate Report" class="btn btn-outline-primary" />
        </form>
        
        <br/><br/>

        <!-- Once Button is Clicked -->
        <?php 
        if (isset($_POST["report-submit-btn"])) {
            echo "Button was clicked.";
        }
        
        ?>
        

    </div>
</body>

</html>