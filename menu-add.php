<?php 
require("reusable-snippets/show-errors.php"); 

// TODO: Add conditions for login session
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
        <h1>Add Menu Item</h1>

        
        <!-- Connect to Database -->
        <?php
        // Connect to database
        require("reusable-snippets/connect-database.php");

        // Fetch categories from database
        $categoriesSQL = "SELECT * FROM tbl_categories";
        $categoriesQuery = mysqli_query($conn, $categoriesSQL);
        ?>


        <!-- Form -->
        <form action="menu-add-execute.php" method="post">

            <!-- Item Name -->
            <label for="menu-item-name">Item Name</label>
            <input type="text" 
                   name="menu-item-name" 
                   class="form-control"
                   required />

            <br />

            <!-- Category Dropdown -->
            <label for="menu-item-category">Category</label>
            <select name="menu-item-category" class="form-select">
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
                   class="form-control"
                   min="0" 
                   step=".01"
                   required />

            <br />

            <!-- Inventory -->
            <label for="menu-item-qty">Inventory Count</label>
            <input type="number" 
                   name="menu-item-qty" 
                   class="form-control"
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


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>