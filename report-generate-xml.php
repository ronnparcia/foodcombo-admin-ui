<?php 

if (!isset($_POST["report-export-btn"])) {
    header("location:report.php?noDataSent=1");
} else {
    // Create XML object
    $reports = new SimpleXMLElement("<reports></reports>");
    $report = $reports->addChild("report");
    $report->addChild("date", $_POST["report-date"]);
    $report->addChild("dishesSold", $_POST["report-total-dishes"]);
    $report->addChild("totalDiscount", $_POST["report-total-discount"]);
    $report->addChild("totalEarnings", $_POST["report-total-earned"]);
    
    // Save XML file
    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="new-report.xml"');
    echo $reports->asXML();
}


?>