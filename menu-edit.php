<?php require("reusable-snippets/show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Menu Items</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <div class="container">

        <!-- Page Title -->
        <h1>Edit Menu Item</h1>

        <!-- Connect to Database -->
        <?php
        // Get selected item ID from menu.php
        $itemToEditID = $_POST["menu-item-id"];

        // Connect to database
        require("reusable-snippets/connect-database.php");

        // Fetch item from database
        $itemToEditSQL = "SELECT * FROM tbl_items WHERE item_id=$itemToEditID";
        $itemToEditQuery = mysqli_query($conn, $itemToEditSQL);
        $itemToEditResult = mysqli_fetch_assoc($itemToEditQuery);

        // Fetch categories from database
        $categoriesSQL = "SELECT * FROM tbl_categories";
        $categoriesQuery = mysqli_query($conn, $categoriesSQL);
        ?>

        <!-- Form -->
        <form action="menu-edit-execute.php" method="post">
            <!-- Hidden Item ID -->
            <input type="hidden" name="menu-item-id" value="<?php echo $itemToEditID; ?>">

            <!-- Item Name -->
            <label for="">Item Name</label>
            <input type="text" name="menu-item-name" value="<?php echo $itemToEditResult["item_name"]; ?>" class="form-control" />

            <br />

            <!-- Category Dropdown -->
            <label for="">Category</label>
            <select name="menu-item-category" class="form-control">
                <!-- Create a dropdown option for each category -->
                <?php while ($categoriesResult = mysqli_fetch_assoc($categoriesQuery)) : ?>

                    <!-- Identify if iterated category is current category of the selected item -->
                    <?php
                    $isCurrentCategory = false;
                    if ($categoriesResult["category_name"] == $itemToEditResult["category_name"]) {
                        $isCurrentCategory = true;
                    }
                    ?>
                    
                    <!-- Display dropdown option -->
                    <option value="<?php echo $categoriesResult["category_name"]; ?>" <?php if ($isCurrentCategory) echo 'selected="selected"'; ?>>
                        <?php echo $categoriesResult["category_name"]; ?>
                    </option>

                <?php endwhile; ?>
            </select>

            <br />

            <!-- Price -->
            <label for="">Price</label>
            <input type="number" 
                   name="menu-item-price" 
                   value="<?php echo $itemToEditResult["price"]; ?>" 
                   class="form-control" />

            <br />

            <!-- Inventory -->
            <label for="">Inventory Count</label>
            <input type="number" 
                   name="menu-item-qty" 
                   value="<?php echo $itemToEditResult["inventory_qty"]; ?>" 
                   class="form-control" />

            <br />

            <!-- Image URL -->
            <label for="">Image URL</label>
            <input type="text" 
                   name="menu-item-img-url" 
                   value="<?php echo $itemToEditResult["image_url"]; ?>" 
                   size="80" 
                   class="form-control" />

            <br />

            <!-- Submit -->
            <input type="submit" 
                   name="menu-item-edit-execute-btn" 
                   value="Submit">
        </form>

        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>