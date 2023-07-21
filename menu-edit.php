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

        <!-- Form -->
        <form action="menu-edit-execute.php" method="post">
            <!-- Item Name -->
            <label for="" class="form-label">Item Name</label>
            <input type="text" name="menu-item-name" class="form-text">

            <br />

            <!-- Category -->
            <label for="">Category</label>
            <select name="menu-item-category">
                <option value="">Test</option>
                <option value="">Test</option>
                <option value="">Test</option>
            </select>

            <br />

            <!-- Price -->
            <label for="">Price</label>
            <input type="number" name="menu-item-price" class="form-number" />

            <br />

            <!-- Inventory -->
            <label for="">Inventory Count</label>
            <input type="number" name="menu-item-qty" class="form-number" />
        </form>

        <?php
        $itemID = $_POST["menu-item-id"];
        echo $itemID;

        require("reusable-snippets/connect-database.php");
        $itemsSQL = "SELECT * FROM tbl_items WHERE item_id=$itemID";
        $itemsQuery = mysqli_query($conn, $itemsSQL);
        $itemsResult = mysqli_fetch_assoc($itemsQuery);

        echo $itemsResult["item_name"];

        // echo "" + $itemsResult["item_id"] + " - " + $itemsResult["item_name"];
        ?>
    </div>
</body>

</html>