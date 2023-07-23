<?php 
// Connect to database
require("reusable-snippets/connect-database.php");

$id = $_POST["menu-item-id"];
$name = $_POST["menu-item-name"];
$category = $_POST["menu-item-category"];
$price = $_POST["menu-item-price"];
$qty = $_POST["menu-item-qty"];
$imageURL = $_POST["menu-item-img-url"];

echo "ID $id; Name $name; Category $category; Price $price; Quantity: $qty; Image URL: $imageURL";

$updateSQL;

?>