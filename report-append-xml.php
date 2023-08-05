<?php 

require("reusable-snippets/show-errors.php");

// Read XML File
if (!isset($_FILES["report-uploaded-xml"])) { // If no file uploaded
    header("location:report.php?noFileUploaded=1");
} elseif ($_FILES["report-uploaded-xml"]["error"] > 0) { // If file upload failed
    header("location:report.php?uploadFailed=1");
} else { // If file upload successful
    // Find where file was temporarily uploaded by the server
    $filePath = $_FILES["report-uploaded-xml"]["tmp_name"];

    // Get root tag
    $reports = simplexml_load_file($filePath);

    // Add new report child
    $report = $reports->addChild("report");
    $report->addChild("date", $_POST["report-date"]);
    $report->addChild("dishesSold", $_POST["report-total-dishes"]);
    $report->addChild("totalDiscount", $_POST["report-total-discount"]);
    $report->addChild("totalEarnings", $_POST["report-total-earned"]);


    // Save XML file
    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="appended-reports.xml"');
    echo $reports->asXML();
}


?>