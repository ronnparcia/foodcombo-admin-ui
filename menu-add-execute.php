<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

// Get POSTed values from form
$name = $_POST["menu-item-name"];
$category = $_POST["menu-item-category"];
$price = $_POST["menu-item-price"];
$inventory = $_POST["menu-item-qty"];


$imageURL = $_POST["menu-item-img-url"];

// Check if imageURL is empty. Set a default value
if ($imageURL == "") {
    $imageURL = "https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/default.png";
}

// SQL
$insertSQL = "INSERT INTO tbl_items
              (item_name, category_name, price, inventory_qty, image_url)
              VALUES
              ('$name', '$category', $price, $inventory, '$imageURL')";

if ((mysqli_query($conn, $insertSQL))) {
    header("location:menu.php?addSuccess=1");
} else {
    header("location:menu.php?addSuccess=0");
}

// Close connection
mysqli_close($conn);

?>