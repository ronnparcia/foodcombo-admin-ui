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
    <title>Add New Combo</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <div class="container">

        <!-- Page Title -->
        <div class="my-5">
            <h1 class="page-title mb-1">Add Combo</h1>
        </div>

        
        <!-- Connect to Database -->
        <?php
        // Connect to database
        require("reusable-snippets/connect-database.php");

        // Fetch items from database
        $mainsSQL = "SELECT * FROM tbl_items WHERE category_name='Mains'";
        $mainsQuery = mysqli_query($conn, $mainsSQL);

        $sidesSQL = "SELECT * FROM tbl_items WHERE category_name='Sides'";
        $sidesQuery = mysqli_query($conn, $sidesSQL);

        $drinksSQL = "SELECT * FROM tbl_items WHERE category_name='Drinks'";
        $drinksQuery = mysqli_query($conn, $drinksSQL);
        ?>

        <div class="white-box">
            <!-- Form -->
            <form action="combos-add-execute.php" method="post">

                <!-- Combo Name -->
                <label for="combo-name">Combo Name</label>
                <input type="text" 
                    name="combo-name" 
                    class="form-control"
                    required />

                <br />

                <!-- Mains Dropdown -->
                <label for="combos-main">Main</label>
                <select name="combos-main" class="form-select">
                    <!-- Create a dropdown option for each item -->
                    <?php while ($mainsResult = mysqli_fetch_assoc($mainsQuery)) : ?>

                        <!-- Display dropdown option -->
                        <option value="<?php echo $mainsResult["item_id"]; ?>">
                            <?php echo $mainsResult["item_name"]; ?>
                        </option>

                    <?php endwhile; ?>
                </select>

                <br />

                <!-- Sides Dropdown -->
                <label for="combos-side">Side</label>
                <select name="combos-side" class="form-select">
                    <!-- Create a dropdown option for each item -->
                    <?php while ($sidesResult = mysqli_fetch_assoc($sidesQuery)) : ?>

                        <!-- Display dropdown option -->
                        <option value="<?php echo $sidesResult["item_id"]; ?>">
                            <?php echo $sidesResult["item_name"]; ?>
                        </option>

                    <?php endwhile; ?>
                </select>

                <br />

                <!-- Mains Dropdown -->
                <label for="combos-drink">Drink</label>
                <select name="combos-drink" class="form-select">
                    <!-- Create a dropdown option for each item -->
                    <?php while ($drinksResult = mysqli_fetch_assoc($drinksQuery)) : ?>

                        <!-- Display dropdown option -->
                        <option value="<?php echo $drinksResult["item_id"]; ?>">
                            <?php echo $drinksResult["item_name"]; ?>
                        </option>

                    <?php endwhile; ?>
                </select>

                <br />

                <!-- Discount -->
                <label for="combo-discount-pct">Discount (%)</label>
                <input type="number" 
                    name="combo-discount-pct" 
                    class="form-control"
                    min="1"
                    max="100"
                    required />

                <br/>

                <!-- Submit -->
                <input type="submit" 
                    name="combos-add-execute-btn" 
                    value="Submit" />
            </form>
        </div>


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>