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
    <title>Add Menu Item</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <div class="container">

        <!-- Page Title -->
        <div class="my-5">
            <h1 class="page-title mb-1">Add Menu Item</h1>
        </div>

        
        <!-- Connect to Database -->
        <?php
        // Connect to database
        require("reusable-snippets/connect-database.php");

        // Fetch categories from database
        $categoriesSQL = "SELECT * FROM tbl_categories";
        $categoriesQuery = mysqli_query($conn, $categoriesSQL);
        ?>


        <div class="white-box">
            <!-- Form -->
            <form action="menu-add-execute.php" method="post">

                <!-- Item Name -->
                <label for="menu-item-name">Item Name</label>
                <input type="text" 
                    name="menu-item-name" 
                    class="form-control w-50"
                    required />

                <br />

                <!-- Category Dropdown -->
                <label for="menu-item-category">Category</label>
                <select name="menu-item-category" class="form-select w-50">
                    <!-- Create a dropdown option for each category -->
                    <?php while ($categoriesResult = mysqli_fetch_assoc($categoriesQuery)) : ?>

                        <!-- Display dropdown option -->
                        <option value="<?php echo $categoriesResult["category_name"]; ?>">
                            <?php echo $categoriesResult["category_name"]; ?>
                        </option>

                    <?php endwhile; ?>
                </select>

                <br />

                <!-- Price -->
                <label for="menu-item-price">Price</label>
                <input type="number" 
                    name="menu-item-price" 
                    class="form-control w-25"
                    min="0" 
                    step=".01"
                    required />

                <br />

                <!-- Inventory -->
                <label for="menu-item-qty">Inventory Count</label>
                <input type="number" 
                    name="menu-item-qty" 
                    class="form-control w-25"
                    min="0"
                    required />

                <br />

                <!-- Image URL -->
                <label for="menu-item-img-url">Image URL</label>
                <input type="url" 
                    name="menu-item-img-url" 
                    size="80" 
                    class="form-control" />

                <br />

                <!-- Submit -->
                <input type="submit" 
                    name="menu-item-edit-execute-btn" 
                    value="Submit" />
            </form>
        </div>


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>