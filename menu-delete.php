<?php 
require("reusable-snippets/show-errors.php"); 

// Check if logged in
// Begin session
session_start();

// If there is no session variable for the account id, redirect back to login.php
// Otherwise, display HTML content
if (!isset($_SESSION["account_id"])):
    header("location:login-form.php?notLoggedIn=1");
else:

// If this page was accessed without going through menu.php, go back to menu
if (!isset($_POST["menu-item-id"])):
    header("location:menu.php?noDataSent=1");
else:
?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Delete Menu Item</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <div class="container">

        <!-- Page Title -->
        <div class="my-5">
            <h1 class="page-title mb-1">Delete Menu Item</h1>
        </div>

        <!-- Connect to Database -->
        <?php 
        // Get selected item ID from menu.php
        $itemToDeleteID = $_POST["menu-item-id"];

        // Connect to database
        require("reusable-snippets/connect-database.php");

        // Fetch item from database
        $itemToDeleteSQL = "SELECT * FROM tbl_items WHERE item_id=$itemToDeleteID";
        $itemToDeleteQuery = mysqli_query($conn, $itemToDeleteSQL);
        $itemToDeleteResult = mysqli_fetch_assoc($itemToDeleteQuery);
        ?>

        <div class="white-box">
            <!-- Display item information -->
            <h4 class="mb-4">Are you sure you want to delete this item?</h4>
            <table class="table align-middle mb-4">
                <thead>
                    <tr>
                        <th><!-- Icon --></th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Inventory</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Icon, Item Name, Category, Price, Inventory Count -->
                        <td><img src="<?php echo $itemToDeleteResult["image_url"]; ?>" /></td>
                        <td><?php echo $itemToDeleteResult["item_name"]; ?></td>
                        <td><?php echo $itemToDeleteResult["category_name"]; ?></td>
                        <td><?php echo $itemToDeleteResult["price"]; ?></td>
                        <td><?php echo $itemToDeleteResult["inventory_qty"]; ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Form to Delete -->
            <form action="menu-delete-execute.php" method="post">
                <input type="hidden" name="menu-item-id" value="<?php echo $itemToDeleteID; ?>" />
                <input type="submit" name="menu-item-delete-btn" value="Delete" class="btn btn-danger" />
            </form>
        </div>
    </div>

</body>

</html>

<?php endif; // Close if statement for if data was sent ?>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>