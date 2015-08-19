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
    debug($Manager->load_order($OrderID, true));
?>