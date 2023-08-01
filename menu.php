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
    <title>Menu Items</title>
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
                <h1 class="page-title mb-1">Menu Items</h1>
                <p class="page-subtitle">Add new items, update item details, or remove an item</p>
            </div>
            <!-- Add Buttons -->
            <div>
                <a href="menu-add.php" class="btn btn-primary me-2">New Item</a>
                <button onclick="showImportXML()" class="btn btn-primary">Import Items (XML)</button>
            </div>
        </div>

        <!-- Import XML -->
        <div id="import-xml-form" class="mb-5" style="display: none;">
            <form action="menu-import-xml.php" method="post" enctype="multipart/form-data">
                <div class="d-flex">
                    <!-- Upload Button -->
                    <input type="file" name="menu-uploaded-xml" class="form-control me-3" />

                    <!-- Submit Button -->
                    <input type="submit" name="menu-import-xml-btn" value="Upload XML" class="btn btn-outline-primary" />
                </div>
            </form>
        </div>
        


        <!-- Alert Boxes -->
        <?php 
        // Attempted to access page without clicking edit or delete button
        if (isset($_GET["noDataSent"])) {
            echo '<div class="alert alert-warning">Warning: Select an item here first.</div>';
        }

        // Attempted to access import XML page without uploading
        if (isset($_GET["noFileUploaded"])) {
            echo '<div class="alert alert-warning">Warning: Upload an XML file first.</div>';
        }

        // File upload failed
        if (isset($_GET["uploadFailed"])) {
            echo '<div class="alert alert-danger">Error: File upload failed.</div>';
        }

        if (isset($_GET["importSuccess"])) {
            if ($_GET["importSuccess"] == 1) {
                echo '<div class="alert alert-success">Items successfully imported.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Items not imported.</div>';
            }
        }

        // Successful Add
        if (isset($_GET["addSuccess"])) {
            if ($_GET["addSuccess"] == 1) {
                echo '<div class="alert alert-success">Item successfully added.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Item not added.</div>';
            }
        }

        // Successful Edit
        if (isset($_GET["editSuccess"])) {
            if ($_GET["editSuccess"] == 1) {
                echo '<div class="alert alert-success">Item successfully edited.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Item not edited.</div>';
            }
        }

        // Successful Delete
        if (isset($_GET["deleteSuccess"])) {
            if ($_GET["deleteSuccess"] == 1) {
                echo '<div class="alert alert-success">Item successfully deleted.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: Item not deleted.</div>';
            }
        }
        ?>


        <!-- Connect to Database -->
        <?php require("reusable-snippets/connect-database.php"); ?>


        <!-- Table of Items -->
        <table id="menu-table" class="table table-striped align-middle">
            <!-- Heading -->
            <thead>
                <tr>
                    <th class="ps-4"><!-- Icon --></th>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Inventory</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <!-- Item Rows -->
            <tbody>
                <!-- SQL Statement and Query -->
                <?php
                $itemsSQL = "SELECT * FROM tbl_items";
                $itemsQuery = mysqli_query($conn, $itemsSQL);
                ?>

                <!-- Generate row for each record -->
                <?php while ($itemsResult = mysqli_fetch_assoc($itemsQuery)) : ?>

                    <tr>
                        <!-- Icon, Item Name, Category, Price, Inventory Count -->
                        <td class="ps-4"><img src="<?php echo $itemsResult["image_url"]; ?>" /></td>
                        <td><?php echo $itemsResult["item_name"]; ?></td>
                        <td><?php echo $itemsResult["category_name"]; ?></td>
                        <td>₱ <?php echo $itemsResult["price"]; ?></td>
                        <td><?php echo $itemsResult["inventory_qty"]; ?></td>
                        <!-- Edit -->
                        <td>
                            <form action="menu-edit.php" method="post">
                                <input type="hidden" name="menu-item-id" value="<?php echo $itemsResult["item_id"]; ?>" />
                                <input type="submit" name="menu-item-edit-btn" value="Edit" class="btn btn-sm btn-outline-primary" />
                            </form>
                        </td>
                        <!-- Delete -->
                        <td>
                            <form action="menu-delete.php" method="post">
                                <input type="hidden" name="menu-item-id" value="<?php echo $itemsResult["item_id"]; ?>" />
                                <input type="submit" name="menu-item-delete-btn" value="Delete" class="btn btn-sm btn-outline-primary" />
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        
        <br/><br/>
        
        


        <!-- Close SQL Connection -->
        <?php mysqli_close($conn); ?>

    </div>

    <!-- Script for Toggling XML Form -->
    <script src="js/menu.js"></script>
</body>

</html>

<?php endif; // End of else for if (!isset($_SESSION["account_id"])) ?>