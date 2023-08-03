<?php
require("reusable-snippets/show-errors.php");

// Read XML File
if (!isset($_FILES["menu-uploaded-xml"])) { // If no file uploaded
    header("location:menu.php?noFileUploaded=1");
} elseif ($_FILES["menu-uploaded-xml"]["error"] > 0) { // If file upload failed
    header("location:menu.php?uploadFailed=1");
} else { // If file upload successful
    // Find where file was temporarily uploaded by the server
    $filePath = $_FILES["menu-uploaded-xml"]["tmp_name"];

    // Load the XML items
    // TODO: Add mechanism to check if XML was successfully loaded/if it is an XML file
    $items = simplexml_load_file($filePath);

    // TODO: Add check if there's already an item with the same name. Maybe 
    foreach ($items->item as $item) {
        // Name, category, price, inventory
        $name = $item->name;
        $category = $item->category;
        $price = $item->price;
        $inventory = $item->inventory;

        // Image
        // Set default image if image is empty
        if ($item->image == "") {
            $imageURL = 'https://raw.githubusercontent.com/ronnparcia/itprog-mp-icons/main/default.png';
        } else {
            $imageURL = $item->image;
        }

        // SQL
        require("reusable-snippets/connect-database.php");
        $insertSQL = "INSERT INTO tbl_items
                      (item_name, category_name, price, inventory_qty, image_url)
                      VALUES
                      ('$name', '$category', $price, $inventory, '$imageURL')";

        if ((mysqli_query($conn, $insertSQL))) {
            header("location:menu.php?importSuccess=1");
        } else {
            header("location:menu.php?importSuccess=0");
        }

        mysqli_close($conn);
    }
}
