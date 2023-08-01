<?php 
// Create XML object
$report = new SimpleXMLElement("<report></report>");
$report->addChild("date", $date);
$report->addChild("dishesSold", $totalDishes);
$report->addChild("totalDiscount", $totalDiscount);
$report->addChild("totalEarnings", $totalEarned);

// Create temporary filename and file path
$filePath = "generated-xml/temp.xml";

// Save XML to file
file_put_contents($filePath, $report->asXML());

?>