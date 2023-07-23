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

    <!-- Page Body -->
    <div class="container">
        <!-- Page Title -->
        <h1>Menu Items</h1>


        <!-- Alert Boxes -->
        <?php 
        // Attempted to access page without clicking edit or delete button
        if (isset($_GET["noDataSent"])) {
            echo '<div class="alert alert-warning">Warning: Select an item here first.</div>';
        }

        // Successful Edit
        if (isset($_GET["editSuccess"])) {
            if ($_GET["editSuccess"] == 1) {
                echo '<div class="alert alert-success">Item successfully edited.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Item not edited.</div>';
            }
        }

        // Successful Delete
        if (isset($_GET["deleteSuccess"])) {
            if ($_GET["deleteSuccess"] == 1) {
                echo '<div class="alert alert-success">Item successfully deleted.</div>';
            }
            // TODO: Add alert box for unsuccessful
        }
        ?>


        <!-- Connect to Database -->
        <?php require("reusable-snippets/connect-database.php"); ?>


        <!-- Table of Items -->
        <table id="menu-table" class="table table-striped align-middle">
            <!-- Heading -->
            <thead>
                <tr>
                    <th><!-- Icon --></th>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Inventory</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <!-- Item Rows -->
            <tbody>
                <!-- SQL Statement and Query -->
                <?php
                $itemsSQL = "SELECT * FROM tbl_items ORDER BY category_name";
                $itemsQuery = mysqli_query($conn, $itemsSQL);
                ?>

                <!-- Generate row for each record -->
                <?php while ($itemsResult = mysqli_fetch_assoc($itemsQuery)) : ?>

                    <tr>
                        <!-- Icon, Item Name, Category, Price, Inventory Count -->
                        <td><img src="<?php echo $itemsResult["image_url"]; ?>" /></td>
                        <td><?php echo $itemsResult["item_name"]; ?></td>
                        <td><?php echo $itemsResult["category_name"]; ?></td>
                        <td><?php echo $itemsResult["price"]; ?></td>
                        <td><?php echo $itemsResult["inventory_qty"]; ?></td>
                        <!-- Edit -->
                        <td>
                            <form action="menu-edit.php" method="post">
                                <input type="hidden" name="menu-item-id" value="<?php echo $itemsResult["item_id"]; ?>" />
                                <input type="submit" name="menu-item-edit-btn" value="Edit" />
                            </form>
                        </td>
                        <!-- Delete -->
                        <td>
                            <form action="menu-delete.php" method="post">
                                <input type="hidden" name="menu-item-id" value="<?php echo $itemsResult["item_id"]; ?>" />
                                <input type="submit" name="menu-item-delete-btn" value="Delete" />
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        <br/><br/>

        <!-- Import XML -->
        <form action="menu-import-xml.php" method="post" enctype="multipart/form-data">
            <h3>Import XML Data</h3>

            <!-- Upload Button -->
            <input type="file" name="menu-uploaded-xml" />

            <br/><br/>

            <!-- Submit Button -->
            <input type="submit" name="menu-import-xml-btn" value="Import XML" />
        </form>


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>