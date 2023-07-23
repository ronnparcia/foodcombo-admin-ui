<?php require("reusable-snippets/show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <?php require("reusable-snippets/head.php"); ?>
    <title>Menu Items</title>
</head>

<body>

    <h1>Delete</h1>

    <?php
    $itemID = $_POST["menu-item-id"];
    echo $itemID;

    require("reusable-snippets/connect-database.php");
    $itemsSQL = "SELECT * FROM tbl_items WHERE item_id=$itemID";
    $itemsQuery = mysqli_query($conn, $itemsSQL);
    $itemsResult = mysqli_fetch_assoc($itemsQuery);

    echo $itemsResult["item_name"];

    echo "" + $itemsResult["item_id"] + " - " + $itemsResult["item_name"];
    ?>

</body>

</html>