<?php 
require("reusable-snippets/show-errors.php"); 

// TODO: Add conditions for login session
?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Combos</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <!-- Page Body -->
    <div class="container">
        <!-- Page Title -->
        <h1>Combos</h1>


        <!-- Alert Boxes -->
        <!-- TODO: Add alert boxes -->

        <!-- Connect to Database -->
        <?php require("reusable-snippets/connect-database.php"); ?>


        <!-- List of Combos -->
        <table id="combos-table" class="table table-striped align-middle">
            <!-- Heading -->
            <thead>
                <tr>
                    <th>Combo ID</th>
                    <th>Combo Name</th>
                    <th>Discount</th>
                    <th>Main</th>
                    <th>Side</th>
                    <th>Drink</th>
                </tr>
            </thead>
            <!-- Item Rows -->
            <tbody>
                <!-- SQL Statement and Query -->
                <?php
                $combosSQL = "SELECT c.combo_id, c.combo_name, c.discount_pct,
	                                 m.item_name AS main_name, m.image_url AS main_img,
                                     s.item_name AS side_name, s.image_url AS side_img,
                                     d.item_name AS drink_name, d.image_url AS drink_img
                              FROM tbl_combos c JOIN tbl_items m ON c.main_item_id = m.item_id 
                                                JOIN tbl_items s ON c.side_item_id = s.item_id
                                                JOIN tbl_items d ON c.drink_item_id = d.item_id";
                $combosQuery = mysqli_query($conn, $combosSQL);
                ?>

                <!-- Generate row for each record -->
                <?php while ($combosResult = mysqli_fetch_assoc($combosQuery)) : ?>

                    <tr>
                        <!-- Icon, Item Name, Category, Price, Inventory Count -->
                        <td><?php echo $combosResult["combo_id"]; ?></td>
                        <td><?php echo $combosResult["combo_name"]; ?></td>
                        <td><?php echo $combosResult["discount_pct"]; ?></td>
                        <td><?php echo $combosResult["main_name"]; ?></td>
                        <td><?php echo $combosResult["side_name"]; ?></td>
                        <td><?php echo $combosResult["drink_name"]; ?></td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        
        <br/><br/>
        
        <!-- Add Item -->
        <h3>Add New Combo Item</h3>
        <a href="combo-add.php" class="btn btn-outline-primary">Add New Combo</a>


        <br/><br/>

        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>