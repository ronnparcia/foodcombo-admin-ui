<?php require("show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <!-- Navbar -->
    <?php require("navbar.php"); ?>
    
    <h1>Menu Items</h1>
    <?php require("connect-database.php"); ?>

    <!-- Table of Items -->
    <table id="menu-table" class="table">
        <!-- Heading -->
        <thead>
            <tr>
                <th>Icon</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Inventory Count</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <!-- Item Rows -->
        <tbody>
            <!-- SQL Statement and Query -->
            <?php 
            $itemsSQL = "SELECT * FROM tbl_items";
            $itemsQuery = mysqli_query($conn, $itemsSQL);
            ?>

            <?php while ($itemsResult = mysqli_fetch_assoc($itemsQuery)) { ?>
                <tr>
                    <td><img src="<?php echo $itemsResult["image_url"]; ?>" alt=""></td>
                    <td><?php echo $itemsResult["item_name"]; ?></td>
                    <td><?php echo $itemsResult["category_name"]; ?></td>
                    <td><?php echo $itemsResult["price"]; ?></td>
                    <td><?php echo $itemsResult["inventory_qty"]; ?></td>
                    <!-- Edit -->
                    <td>
                        
                    </td>
                    <!-- Delete -->
                    <td>
                        
                    </td>
                </tr>
            <?php } // Closing bracket for while statement ?>
        </tbody>
    </table> 
</body>

</html>