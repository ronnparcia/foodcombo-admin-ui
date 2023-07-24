<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

// Get POSTed values from form
$comboName   = $_POST["combo-name"];
$discountPct = $_POST["combo-discount-pct"] / 100;

$mainID  = $_POST["combos-main"];
$sideID  = $_POST["combos-side"];
$drinkID = $_POST["combos-drink"];


// Check if the combo is already in the database
$existingComboSQL = "SELECT * FROM tbl_combos
                     WHERE main_item_id = $mainID
                     AND side_item_id = $sideID
                     AND drink_item_id = $drinkID";
$existingComboQuery = mysqli_query($conn, $existingComboSQL);


if (mysqli_num_rows($existingComboQuery) > 0) {

    // If combo exists, return to combos.php with error message
    $existingComboResult = mysqli_fetch_assoc(mysqli_query($conn, $existingComboSQL));
    $existingComboID = $existingComboResult["combo_id"];
    header("location:combos.php?comboAlreadyExists=$existingComboID");

} else {

    // If combo doesn't exist yet, proceed with insertion
    $insertSQL = "INSERT INTO tbl_combos
                  (combo_name, main_item_id, side_item_id, drink_item_id, discount_pct)
                  VALUES
                  ('$comboName', $mainID, $sideID, $drinkID, $discountPct)";
    
    if ((mysqli_query($conn, $insertSQL))) {
        header("location:combos.php?addSuccess=1");
    } else {
        header("location:combos.php?addSuccess=0");
    }

}

// Close connection
mysqli_close($conn);

?>