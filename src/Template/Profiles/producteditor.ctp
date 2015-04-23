<STYLE>
    .icon-footprint:before { content: url('assets/global/img/footprint.png'); }
    .icon-surveillance:before { content: url('assets/global/img/surveillance.png'); }
    .icon-physical:before { content: url('assets/global/img/physical.png'); }
    .icon{  background-color: black;  }
    .selected{  background-color: #afd9ee;  }
</STYLE>
<table class="table table-light table-hover">
    <thead>
        <TR>
            <TH>ID</TH>
            <TH>Icon</TH>
            <TH>Acronym</TH>

            <TH>English Name</TH>
            <!--TH>English Description</TH-->

            <TH>French Name</TH>
            <!--TH>French Description</TH-->

            <TH>Color</TH>
            <TH>Checked</TH>

            <TH>Sidebar Alias</TH>
            <TH>Blocks Alias</TH>

            <TH>Button Color</TH>
            <TH>Blocked</TH>
            <TH>Doc IDs</TH>

            <TH>Visible</TH>
            <TH>Bypass</TH>
        </TR>
    </thead>
    <tbody>
        <TR ONCLICK="productclick('');">
            <TD COLSPAN="14" ALIGN="CENTER" <?php if(!isset($_GET["Acronym"])){echo 'CLASS="selected"';}?>>
                Create new product type
            </TD>
        </TR>
        <?php
            $selectedproduct = "";
            $iconsize=20;

            function td($text, $boolean = false, $Blank = ""){
                if($boolean){
                    if ($text==1){$text="Yes";} else {$text = "No";}
                }
                if(!$text){$text=$Blank;}
                echo "<TD>" . $text . "</TD>";
            }

            foreach($producttypes as $producttype){
                $class="";
                $selected=(isset($_GET["Acronym"]) && $_GET["Acronym"] == $producttype->Acronym);
                if ($selected){$selectedproduct = $producttype; $class="selected";}
                echo '<TR class="' . $class . '" onclick="productclick(' . "'" . $producttype->Acronym . "'" . ')">';
                    td($producttype->ID);
                    if ($producttype->Icon == "icon-docs"){
                        td('<i class="' . $producttype->Icon . '"></i>');
                    } else {
                        $img = str_replace("fa icon-", "", $producttype->Icon);
                        echo '<TD><IMG CLASS="icon" HEIGHT="' . $iconsize . '" SRC="' . $this->request->webroot . 'assets/global/img/' . $img . '.png"></TD>';
                    }

                    td($producttype->Acronym);
                    td($producttype->Name);
                    //td($producttype->Description);

                    td($producttype->NameFrench);

                    td($producttype->Color, False, "green");
                    td($producttype->Checked, True);

                    td($producttype->Sidebar_Alias);
                    td($producttype->Blocks_Alias);

                    td($producttype->ButtonColor);
                    td($producttype->Blocked);
                    td($producttype->doc_ids);

                    td($producttype->Visible, True);
                    td($producttype->Bypass, True);
                echo "</TR>";
            }
        ?>
    </tbody>
</table>
<SCRIPT>
    var changed = false;
    function productclick(Name){
        if (changed){
            if (!confirm("Do you want to quit without saving?")) {return false;}
        }
        if (Name) {
            window.location = "?Acronym=" + Name;
        } else {
            window.location = "producteditor";
        }

    }
</SCRIPT>
<FORM METHOD="get">
<?php //pricing-red pricing-blue regular=green
    function tr($Title, $Cols = 4, $Tooltip="", $First = false){
        //if (!$First) { echo "</TD></TR>";}
        //echo '<TR><TD WIDTH="10%">' . $Title . '</TD><TD>';
        if(!$First){ echo '</div></div>';}
        echo '<div class="col-md-' . $Cols . '" TITLE="' . $Tooltip . '"><div class="form-group"><label class="control-label">' . $Title . ': </label>';
    }
    function input($Type, $Name, $Value="", $Disabled = false, $Checked=false){
        if($Type=="checkbox"){echo "<BR>";}
        echo '<INPUT CLASS="form-control" TYPE="' . $Type . '" ID="' . $Name . '" NAME="' . $Name . '" VALUE="' . $Value . '"';
        if($Disabled){ echo ' DISABLED';}
        if($Checked){ echo ' CHECKED';}
        echo ' onchange="changed=true;">';
    }
    function getvalue($Object, $Fieldname, $Default=""){
        if(is_object($Object)){
            return $Object->$Fieldname;
        }
        return $Default;
    }
    function iif($Value, $True, $False){
        if($Value){return $True;}
        return $False;
    }

    function makeselect($is_disabled=false, $Name=""){
        if($Name){
            if($is_disabled){$is_disabled=" DISABLED";}
            echo '<select class="form-control" ' . $is_disabled . ' name="' . $Name . '" id="'. $Name . '" onchange="changed=true;">';
        }else{
            echo "</select>";
        }
    }
    function makedropdown($is_disabled, $Name, $TheValue, $Language, $EnglishValues, $FrenchValues = ""){
        makeselect($is_disabled, $Name);
        if ($FrenchValues == ""){ $Language = "English"; }
        $variable = $Language . "Values";
        foreach($$variable as $Key => $Value){
            makedropdownoption($Key, $Value, $TheValue);
        }
        echo '</select>';
    }
    function makedropdownoption($Key, $Value, $TheValue){
        echo '<option value="' . $Key . '"';
        if($TheValue == $Key){echo "selected='selected'";}
        echo '>' . $Value . '</option>';
    }
    function makecolordropdown($Name, $Colors, $Value){
        makeselect(false, $Name);
        echo '<option value="">Select a color class</option>';
        foreach ($Colors as $c) {
            echo '<option value="' . $c->color . '" "';
            if ($Value == $c->color) { echo ' selected="selected"';}
            echo ' style="background: ' . $c->rgb . ';">' . $c->color . '</option>';
        }
        makeselect();
    }
    function makeradio($webroot, $Name, $UserValue, $Value, $Icon = "icon-docs", $iconsize = ""){
        echo '<LABEL CLASS="uniform-inline">';
        input("radio", $Name, $Value, False, $UserValue==$Value);
        if($iconsize) {
            echo '<IMG CLASS="icon" HEIGHT="' . $iconsize . '" SRC="' . $webroot . 'assets/global/img/' . $Icon . '.png">';
        } else {
            echo '<i class="' . $Icon . '"></i>';
        }
        echo '</LABEL>';
    }
    function makealiasselect($Name, $Columns, $UserValue = ""){
        makeselect(False, $Name);
        makedropdownoption("","Select a column",$UserValue);
        foreach ($Columns as $key => $value) {
            makedropdownoption($value,$value,$UserValue);
        }
        makeselect();
    }

    function makelist($Title, $Name, $Values){
        echo '<table class="table table-light table-hover"><TH COLSPAN="2">' . $Title . '</TH>';
        foreach($Values as $Key => $Value){
            echo '<TR ONCLICK="' . $Name . "('" . $Key . "'" . ');"><TD>' . $Key . "</TD><TD>" . $Value . '</TD></TR>';
        }
        echo '</TABLE>';
    }
    function isolatefield($Obj, $Key, $Value){
        $array = array();
        foreach($Obj as $Object){
            $array[$Object->$Key] = $Object->$Value;
        }
        return $array;
    }

    tr("Acronym", 1, "", true);
    input("text", "Acronym", getvalue($selectedproduct, "Acronym"), isset($_GET["Acronym"]));
    if(isset($_GET["Acronym"])) {input("hidden", "Acronym", getvalue($selectedproduct, "Acronym"));}

    tr("Panel Color", 2, "What color will show when selecting products");
    makedropdown("", "Color", getvalue($selectedproduct, "Color"), "English", array("" => "Green", "red" => "Red", "blue" => "Blue") );

    tr("Button/Top block Color", 2, "What color will the buttons/Top blocks show as");
    makecolordropdown("ButtonColor", $colors,  getvalue($selectedproduct, "ButtonColor"));

    tr("Checked", 1 , "If enabled, all products will be selected and the user cannot pick");
    input("checkbox", "Checked", "1", False, getvalue($selectedproduct, "Checked") ==1 );

    tr("Visible", 1, "If disabled, it will not show in the sidebar or settings");
    input("checkbox", "Visible", "1", False, getvalue($selectedproduct, "Visible") ==1 );

    tr("Bypass", 1, "If enabled, the top block will use Driver ID 0");
    input("checkbox", "Bypass", "1", False, getvalue($selectedproduct, "Bypass") ==1 );

    tr("Sidebar Alias", 2, "Needs to point to a column in the sidebar table");
    makealiasselect("Sidebar_Alias", $sidebarcols,getvalue($selectedproduct, "Sidebar_Alias"));

    tr("Blocks Alias", 2, "Needs to point to a column in the blocks table");
    makealiasselect("Blocks_Alias", $blockscols,getvalue($selectedproduct, "Blocks_Alias"));

    tr("English Name", 2);
    input("text", "Name", getvalue($selectedproduct, "Name"));

    tr("English Description", 4);
    input("text", "Description", getvalue($selectedproduct, "Description"));

    tr("French Name", 2);
    input("text", "NameFrench", getvalue($selectedproduct, "NameFrench"));

    tr("French Description", 4);
    input("text", "DescriptionFrench", getvalue($selectedproduct, "DescriptionFrench"));

    tr("Icon", 12, "What icon will show");
    echo '<BR>';
    $icon = getvalue($selectedproduct, "Icon");
    makeradio($this->request->webroot, "Icon", $icon, "icon-docs");
    makeradio($this->request->webroot, "Icon", $icon, "fa icon-footprint", "footprint", $iconsize);
    makeradio($this->request->webroot, "Icon", $icon, "fa icon-surveillance", "surveillance", $iconsize);
    makeradio($this->request->webroot, "Icon", $icon, "fa icon-physical", "physical", $iconsize);
    echo '<INPUT STYLE="float: right" TYPE="SUBMIT" NAME="submit" CLASS="btn btn-primary" VALUE="Save Changes">';

    tr("Blocked Products", 6);//order_products
    input("text", "Blocked", getvalue($selectedproduct, "Blocked"));

    tr("Product/Document IDs", 6, "If Bypass is enabled: Which products will show when a topblock is clicked. Otherwise it's which forms will show when placing an order");
    input("text", "doc_ids", getvalue($selectedproduct, "doc_ids"));

    echo '</DIV></DIV><TABLE><TR><TD WIDTH="50%" STYLE="vertical-align: top;">';
    makelist("Products (1)", "addblocked", isolatefield($order_products, "number", "title"));
    echo '</TD><TD WIDTH="25%" STYLE="vertical-align: top;">';
    makelist("Products (2)", "addblocked2", isolatefield($order_products, "number", "title"));
    echo '</TD><TD WIDTH="25%" STYLE="vertical-align: top;">';
    makelist("Documents", "addblocked3", isolatefield($subdocuments, "id", "title"));
?>
    </TD></TR></TABLE></FORM>
<SCRIPT>
    function addblocked(ID){
        addID("Blocked", ID);
    }
    function addblocked2(ID){
        if(getChecked("Bypass")) {
            addID("doc_ids", ID);
        }else{
            alert("Bypass is not enabled, use 'Documents' instead");
        }
    }
    function addblocked3(ID){
        if(getChecked("Bypass")) {
            alert("Bypass is not enabled, use 'Products (2)' instead");
        }else{
            addID("doc_ids", ID);
        }
    }

    function getChecked(ElementName){
        return document.getElementById(ElementName).checked;
    }


    function addID(ElementName, ID){
        element = document.getElementById(ElementName);
        if(element.value){
            var values = element.value.split(",");
            for (temp = 0; temp< values.length; temp++){
                if(values[temp]== ID ) {
                    removeID(ElementName, ID);
                    return false;
                }
            }
            element.value = element.value + "," + ID;
        } else {
            element.value = ID;
        }
    }
    function removeID(ElementName, ID){
        element = document.getElementById(ElementName);
        var values = element.value.split(",");
        var newvalue = "";
        for (temp = 0; temp< values.length; temp++){
            if(values[temp] != ID ) {
                if(newvalue){
                    newvalue=newvalue + "," + values[temp];
                }else{
                    newvalue=values[temp];
                }
            }
        }
        element.value=newvalue;
    }
</SCRIPT>