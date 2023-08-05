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
        <div class="my-5">
            <!-- Page Title and Subtitle -->
            <div>
                <h1 class="page-title mb-1">Daily Report</h1>
                <p class="page-subtitle">View and/or export a summary report for a selected date</p>
            </div>
        </div>

         <!-- Alert Boxes -->
         <?php 
        // File upload failed
        if (isset($_GET["uploadFailed"])) {
            echo '<div class="alert alert-danger">Error: File upload failed.</div>';
        }
        ?>


        <div class="white-box">
            <!-- Form -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <!-- Date -->
                <label for="report-date">Select date:</label>
                <input type="date" 
                    name="report-date" 
                    max="<?php echo date("Y-m-d"); ?>"
                    class="form-control w-75" 
                    required>

                <br/>

                <!-- Submit Button -->
                <input type="submit" name="report-submit-btn" value="Generate Report" class="btn btn-outline-primary" />
            </form>
        </div>
        
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
                <div class="white-box">
                    <!-- Show report details -->
                    <h4 class="mb-4">Report for <?php echo date('F d, Y', strtotime($date)); ?></h4>
                    <table class="table w-50 mb-4">
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

                    <!-- Generate XML (New) -->
                    <form action="report-generate-xml.php" method="post">
                        <input type="hidden" name="report-date" value="<?php echo $date; ?>">
                        <input type="hidden" name="report-total-dishes" value="<?php echo $totalDishes; ?>">
                        <input type="hidden" name="report-total-discount" value="<?php echo $totalDiscount; ?>">
                        <input type="hidden" name="report-total-earned" value="<?php echo $totalEarned; ?>">

                        <input type="submit" value="Export as XML" class="btn btn-outline-primary">
                    </form>

                    <!-- Append New Report to Existing XML -->
                    <form action="report-append-xml.php" method="post" enctype="multipart/form-data">
                        <p class="mt-5 mb-3">You may also append this report to a XML containing multiple reports:</p>
                        <div class="d-flex">
                            <!-- Hidden Data to be Posted -->
                            <input type="hidden" name="report-date" value="<?php echo $date; ?>">
                            <input type="hidden" name="report-total-dishes" value="<?php echo $totalDishes; ?>">
                            <input type="hidden" name="report-total-discount" value="<?php echo $totalDiscount; ?>">
                            <input type="hidden" name="report-total-earned" value="<?php echo $totalEarned; ?>">

                            <input type="file" name="report-uploaded-xml"  class="form-control me-3">
                            <input type="submit" value="Append to XML" class="btn btn-outline-primary">
                        </div>
                    </form>
                </div>
            <?php endif; // For if (hasOrders) ?>

        <?php endif; // For if (isset) ?>
        

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>