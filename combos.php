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
        <?php 
        // Successful add combo
        if (isset($_GET["addSuccess"])) {
            if ($_GET["addSuccess"] == 1) {
                echo '<div class="alert alert-success">Combo successfully added.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Combo not added.</div>';
            }
        }

        // Combo already exists
        if (isset($_GET["comboAlreadyExists"])) {
            echo '<div class="alert alert-danger">Error: Cannot add combo, it already exists (Combo ID #' . $_GET["comboAlreadyExists"] . ').</div>';
        }
        ?>

        <!-- Connect to Database -->
        <?php require("reusable-snippets/connect-database.php"); ?>


        <!-- List of Combos -->
        <table id="combos-table" class="table table-striped align-middle">
            <!-- Heading -->
            <thead>
                <tr>
                    <th>Combo ID</th>
                    <th>Combo Name</th>
                    <th>Main</th>
                    <th>Side</th>
                    <th>Drink</th>
                    <th>Discount</th>
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
                        <td><?php echo $combosResult["main_name"]; ?></td>
                        <td><?php echo $combosResult["side_name"]; ?></td>
                        <td><?php echo $combosResult["drink_name"]; ?></td>
                        <td><?php echo ($combosResult["discount_pct"] * 100); ?>%</td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        
        <br/><br/>
        
        <!-- Add Item -->
        <h3>Add New Combo Item</h3>
        <a href="combos-add.php" class="btn btn-outline-primary">Add New Combo</a>


        <br/><br/>

        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>