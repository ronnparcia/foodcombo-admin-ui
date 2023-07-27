<?php 
require("reusable-snippets/show-errors.php"); 

// Begin session
session_start();

// If there is no session variable for the account id, redirect back to login.php
// Otherwise, display HTML content
if (!isset($_SESSION["account_id"])):
    header("location:login-form.php?notLoggedIn=1");
else:
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
            <input type="date" 
                   name="report-date" 
                   max="<?php echo date("Y-m-d"); ?>"
                   class="form-control w-50" 
                   required>

            <br/>

            <!-- Submit Button -->
            <input type="submit" name="report-submit-btn" value="Generate Report" class="btn btn-outline-primary" />
        </form>
        
        <br/><br/>

        <!-- Once Button is Clicked -->
        <?php if (isset($_POST["report-submit-btn"])): ?>

            <!-- Connect to database -->
            <?php 
            $date = $_POST["report-date"];
            
            // Connect to database
            require("reusable-snippets/connect-database.php");
            $reportSQL = "SELECT SUM(main_qty) + SUM(side_qty) + SUM(drink_qty) AS total_dishes,
                                 SUM(discounted_total_price) AS total_earned,
                                 SUM(discount) AS total_discount
                          FROM tbl_orders
                          WHERE order_date='$date';";
            $reportQuery = mysqli_query($conn, $reportSQL);
            $reportResult = mysqli_fetch_assoc($reportQuery);

            // If there is no records for this date, show error message
            if (
                $reportResult["total_dishes"] == NULL &&
                $reportResult["total_earned"] == NULL &&
                $reportResult["total_discount"] == NULL
            ) {
                $hasOrders = false;
                echo '<div class="alert alert-danger">No records found for this date.</div>';
            } else {
                $hasOrders = true;
                $totalDishes = $reportResult["total_dishes"];
                $totalEarned = $reportResult["total_earned"];
                $totalDiscount = $reportResult["total_discount"];
            }
            ?>

            <!-- Display record -->
            <?php if ($hasOrders): ?>
                <h4>Report for <?php echo date('F d, Y', strtotime($date)); ?></h4>
                <table class="table w-50">
                    <tr>
                        <td>Total dishes sold: </td>
                        <td><?php echo $totalDishes; ?></td>
                    </tr>
                    <tr>
                        <td>Total discounts given: </td>
                        <td>Php <?php echo $totalDiscount; ?></td>
                    </tr>
                    <tr>
                        <td>Total earnings: </td>
                        <td>Php <?php echo $totalEarned; ?></td>
                    </tr>
                </table>
            <?php endif; // For if (hasOrders) ?>

        <?php endif; // For if (isset) ?>
        

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>