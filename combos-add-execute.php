<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

// Get POSTed values from form
$comboName = $_POST["combo-name"];
$discountPct = $_POST["combo-discount-pct"] / 100;

$mainID = $_POST["combos-main"];
$sideID = $_POST["combos-side"];
$drinkID = $_POST["combos-drink"];

// TODO: Add a check if the combo is already in the database

// SQL
$insertSQL = "INSERT INTO tbl_combos
              (combo_name, main_item_id, side_item_id, drink_item_id, discount_pct)
              VALUES
              ('$comboName', $mainID, $sideID, $drinkID, $discountPct)";

if ((mysqli_query($conn, $insertSQL))) {
    header("location:combos.php?addSuccess=1");
} else {
    header("location:combos.php?addSuccess=0");
}

// Close connection
mysqli_close($conn);

?>