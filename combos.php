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
    <link rel="stylesheet" href="css/combos.css">
    <title>Combos</title>
</head>

<body>
    <!-- Navbar -->
    <?php require("reusable-ui/navbar.php"); ?>

    <!-- Page Body -->
    <div class="container">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center my-5">
            <!-- Page Title and Subtitle -->
            <div>
                <h1 class="page-title mb-1">Combos</h1>
                <p class="page-subtitle">View existing combos or add new ones</p>
            </div>
            <!-- Add Buttons -->
            <div>
                <a href="combos-add.php" class="btn btn-primary">New Combo</a>    
            </div>
        </div>


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
        <div class="row row-cols-4 g-4">
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

                <div class="col">
                    <div class="combo-card">
                        <div class="d-flex align-items-center mb-4">
                            <p class="combo-id"><?php echo $combosResult["combo_id"]; ?></p>
                            <div>
                                <h2 class="combo-name mb-1"><?php echo $combosResult["combo_name"]; ?></h2>
                                <p class="combo-discount"><?php echo ($combosResult["discount_pct"] * 100); ?>% Discount</p>
                            </div>
                        </div>
                        

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <img src="<?php echo $combosResult["main_img"]; ?>" class="combo-img">
                                <?php echo $combosResult["main_name"]; ?>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <img src="<?php echo $combosResult["side_img"]; ?>" class="combo-img">
                                <?php echo $combosResult["side_name"]; ?>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <img src="<?php echo $combosResult["drink_img"]; ?>" class="combo-img">
                                <?php echo $combosResult["drink_name"]; ?>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>