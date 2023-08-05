<?php 

// OLD
// Create XML object
// $report = new SimpleXMLElement("<report></report>");
// $report->addChild("date", $date);
// $report->addChild("dishesSold", $totalDishes);
// $report->addChild("totalDiscount", $totalDiscount);
// $report->addChild("totalEarnings", $totalEarned);

// // Create temporary filename and file path
// $filePath = "generated-xml/temp.xml";

// // Save XML to file
// file_put_contents($filePath, $report->asXML());

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

?>