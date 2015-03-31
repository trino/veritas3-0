<?
$provincelist = array("AB" => "Alberta", "BC" => "British Columbia", "MB" => "Manitoba", "NB" => "New Brunswick", "NL" => "Newfoundland and Labrador", "NT" => "Northwest Territories", "NS" => "Nova Scotia", "NU" => "Nunavut", "ON" => "Ontario", "PE" => "Prince Edward Island", "QC" => "Quebec", "SK" => "Saskatchewan", "YT" => "Yukon Territories");

echo "<table style='width: 25%;' class='table table-condensed  table-striped table-bordered table-hover dataTable no-footer'>";
foreach($products as $product){
    echo "<TR><TD><INPUT TYPE='RADIO' ID='rad" . $product->number . "'>" . $product->number . '</TD><TD onclick="alert();">' . $product->title . "</TD></TR>";
}
echo "</table>";
?>
