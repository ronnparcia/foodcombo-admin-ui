<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

// Get POSTed values from form
$id = $_POST["menu-item-id"];

// SQL
$deleteSQL = "DELETE FROM tbl_items WHERE item_id = $id;";

if (mysqli_query($conn, $deleteSQL)) {
    header("location:menu.php?deleteSuccess=1");
} else {
    header("location:menu.php?deleteSuccess=0");
}

// Close connection
mysqli_close($conn);

?>