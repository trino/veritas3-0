<?php
    $Action="";
    if(isset($_GET["action"])){$Action = $_GET["action"];}
    if(isset($_POST["action"])){$Action = $_POST["action"];}

    function makeaction($Action, $Title, $Name, $Data, $PrimaryKey, $ValueKey){
        echo '<FORM method="get"><INPUT TYPE="hidden" name="action" value="' . $Action . '">' . $Title . ": ";
        echo '<SELECT Name="' . $Name . '" ID="' . $Name . '">';
        foreach($Data as $DataPoint){
            echo '<OPTION VALUE="' . $DataPoint->$PrimaryKey . '">(' . $DataPoint->$PrimaryKey . ") " . $DataPoint->$ValueKey . '</OPTION>';
        }
        echo '</SELECT> <INPUT TYPE="submit"></FORM><P></P>';
    }
    function printoption($Name, $selected, $Value = ""){
        if (is_array($Name)){
            foreach($Name as $Key => $Value){
                printoption($Value, $selected, $Key);
            }
        } else {
            echo '<OPTION';
            if ($Value) {echo ' VALUE="' . $Value . '"';}
            if ($Name == $selected || $Value == $selected) {echo " SELECTED";}
            echo '>' . $Name . "</OPTION>";
        }
    }

    makeaction("order_to_json", "Convert order to JSON", "OrderID", $Manager->enum_orders(), "id", "title");
    makeaction("profile_to_json", "Convert profile to JSON", "ProfileID", $Manager->enum_profiles(), "id", "username");
?>

<FORM method="POST">
    Action:
    <SELECT NAME="action">
        <OPTION>Show JSON</OPTION>
        <OPTION value="json_to_html">Show JSON HTML</OPTION>
        <?php printoption(array("json_to_profile" => "JSON to Profile", "json_to_order" => "JSON to Order"), $Action); ?>
    </SELECT>
    <INPUT TYPE="submit">
    <?php
        if($Action != "json_to_html"){ echo '<TEXTAREA style="width: 100%; height: 500px;" name="JSON" id="JSON">';}
            if(isset($JSON)){echo '' . $JSON . '';}
        if($Action != "json_to_html"){ echo '</TEXTAREA>';}
    ?>
</FORM>









<?php /*
<TABLE width="100%" valign="top">
    <TR>
        <TD valign="top" width="25%">
            <UL>
                <?php
                    foreach($tables as $table){
                        echo '<LI><A HREF="?table=' . $table . '">' . $table . '</A></LI>';
                    }
                ?>
            </UL>
        </TD>
        <TD width="75%">
            <TEXTAREA style="width: 100%; height: 80%;" title="schema"><?php
                if (isset($_GET["table"])){
                   $JSON = $Manager->table_to_schema($_GET["table"], true);
                    echo $JSON;
                }
            ?></TEXTAREA>
            <TEXTAREA style="width: 100%; height: 20%" title="test data"><?php
                if (isset($test)) {echo $test;}
            ?></TEXTAREA>
        </TD>
    </TR>
</TABLE>
<BR>Test data can be verified with the schema:
<?php
    if (isset($test)) {
        echo $Manager->verify_data($JSON, $test, true);
    }

    //debug($Manager->load_document(4, false));
    //debug($Manager->load_document(4, true));
    $OrderID = 10;
    if(isset($_GET["order_id"])){
        $OrderID  = $_GET["order_id"];
    }else{
        echo "<BR>order_id not set, using 10";
    }
    $Order = $Manager->load_order($OrderID, true, true, "1603,1,14");
    if($Order) {
        echo '<TEXTAREA style="width: 100%; height: 500px;">' . json_encode($Order, JSON_PRETTY_PRINT) . '</TEXTAREA>';

        //$Order= $Manager->json_to_order($Order);
        //debug($Order);
    } else {
        echo "This order does not contain any of the following forms: 1603,1,14";
    }

    $JSON = $Manager->profile_to_array($Me,true, true);
    echo '<TEXTAREA style="width: 100%; height: 500px;">' . $JSON . '</TEXTAREA>';

    $Data = $Manager->json_to_profile($JSON);
    echo "<BR>ProfileID: " . $Data;

    $Client = $Manager->client_to_array(17);
    echo "<BR>ClientID: " . $Manager->json_to_client($Client);


?>

 */ ?>