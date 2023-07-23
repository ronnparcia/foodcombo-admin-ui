<?php 
require("reusable-snippets/show-errors.php"); 

// TODO: Add conditions for login session

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
        <h1>Delete Menu Item</h1>

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

        <!-- Display item information -->
        <h4>Are you sure you want to delete this item?</h4>
        <table class="table align-middle">
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

    </div>

</body>

</html>

<?php endif; // Close if statement for if data was sent ?>