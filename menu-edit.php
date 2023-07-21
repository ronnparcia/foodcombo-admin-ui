<?php require("reusable-snippets/show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Menu Items</title>
</head>

<body>
    <div class="container">
        <!-- Navbar -->
        <?php require("reusable-ui/navbar.php"); ?>

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
            <input 
                type="text" 
                name="menu-item-name" 
                placeholder="<?php echo $itemToEditResult["item_name"]; ?>"
            />

            <br />

            <!-- Category -->
            <label for="">Category</label>
            <select name="menu-item-category">
                <?php while ($categoriesResult = mysqli_fetch_assoc($categoriesQuery)) { ?>
                    <option value="<?php echo $categoriesResult["category_name"]; ?>">
                        <?php echo $categoriesResult["category_name"]; ?>
                    </option>
                <?php } // Closing tag for while loop 
                ?>
            </select>

            <br />

            <!-- Price -->
            <label for="">Price</label>
            <input 
                type="number" 
                name="menu-item-price" 
                class="form-number" 
                placeholder="<?php echo $itemToEditResult["price"]; ?>" 
            />

            <br />

            <!-- Inventory -->
            <label for="">Inventory Count</label>
            <input 
                type="number" 
                name="menu-item-qty" 
                placeholder="<?php echo $itemToEditResult["inventory_qty"]; ?>" 
            />

            <br />

            <!-- Image URL -->
            <label for="">Image URL</label>
            <input 
                type="text" 
                name="menu-item-img-url" 
                placeholder="<?php echo $itemToEditResult["image_url"]; ?>" 
                size="80"
            />

            <br />

            <!-- Submit -->
            <input type="submit" name="menu-item-edit-execute-btn" value="Submit">
        </form>

        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>