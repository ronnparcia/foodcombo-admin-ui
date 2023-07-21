<?php require("show-errors.php"); ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="css/global.css">
</head>

<body>

    <h1>Edit</h1>

    <form action="menu-edit-execute.php" method="post">
        
    </form>

    <?php
    $itemID = $_POST["menu-item-id"];
    echo $itemID;

    require("connect-database.php");
    $itemsSQL = "SELECT * FROM tbl_items WHERE item_id=$itemID";
    $itemsQuery = mysqli_query($conn, $itemsSQL);
    $itemsResult = mysqli_fetch_assoc($itemsQuery);

    echo $itemsResult["item_name"];

    // echo "" + $itemsResult["item_id"] + " - " + $itemsResult["item_name"];
    ?>

</body>

</html>