<?php require("reusable-snippets/show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Edit Menu Item</title>
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
        // TODO: Add an isset() condition if $itemToEditID was given
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
            <!-- TODO: Required validation -->
            <input type="hidden" name="menu-item-id" value="<?php echo $itemToEditID; ?>" />

            <!-- Item Name -->
            <!-- TODO: Required validation -->
            <label for="menu-item-name">Item Name</label>
            <input type="text" name="menu-item-name" value="<?php echo $itemToEditResult["item_name"]; ?>" class="form-control" />

            <br />

            <!-- Category Dropdown -->
            <!-- TODO: Input validation -->
            <label for="menu-item-category">Category</label>
            <select name="menu-item-category" class="form-select">
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
                    <option value="<?php echo $categoriesResult["category_name"]; ?>" <?php if ($isCurrentCategory) echo "selected"; ?> >
                        <?php echo $categoriesResult["category_name"]; ?>
                    </option>

                <?php endwhile; ?>
            </select>

            <br />

            <!-- Price -->
            <!-- TODO: Validate if positive decimal -->
            <label for="menu-item-price">Price</label>
            <input type="number" 
                   name="menu-item-price" 
                   value="<?php echo $itemToEditResult["price"]; ?>" 
                   class="form-control" />

            <br />

            <!-- Inventory -->
            <!-- TODO: Validate if positive INTEGER -->
            <label for="menu-item-qty">Inventory Count</label>
            <input type="number" 
                   name="menu-item-qty" 
                   value="<?php echo $itemToEditResult["inventory_qty"]; ?>" 
                   class="form-control" />

            <br />

            <!-- Image URL -->
            <!-- TODO: Input validation -->
            <label for="menu-item-img-url">Image URL</label>
            <input type="url" 
                   name="menu-item-img-url" 
                   value="<?php echo $itemToEditResult["image_url"]; ?>" 
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