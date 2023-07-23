<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

// Get POSTed values from form
$id = $_POST["menu-item-id"];
$name = $_POST["menu-item-name"];
$category = $_POST["menu-item-category"];
$price = $_POST["menu-item-price"];
$qty = $_POST["menu-item-qty"];
$imageURL = $_POST["menu-item-img-url"];

// SQL
$updateSQL = "UPDATE tbl_items
              SET    item_name = '$name',
                     category_name = '$category',
                     price = $price,
                     inventory_qty = $qty,
                     image_url = '$imageURL'
              WHERE  item_id = $id;";

if (mysqli_query($conn, $updateSQL)) {
    header("location:menu.php?editSuccess=1");
} else {
    header("location:menu.php?editSuccess=0");
}

?>