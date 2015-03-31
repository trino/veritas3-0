<style>
    th.rotate {
        height: 140px;
        white-space: nowrap;
    }
    th.rotate > div {
        transform:
        translate(20px, -5px)
        rotate(315deg);
        width: 30px;
    }
    th.rotate > div > span {
        border-bottom: 1px solid #ccc;
        padding: 5px 10px;
    }

    .toast{
        background-color: white;
    }
</style>
<script>
    var OldIndex =-1;
    function setprov(DocID, Province){
        element = document.getElementById(DocID + "." + Province);
        $.ajax({
            url: "<?php echo $this->request->webroot;?>profiles/products",
            type: "post",
            dataType: "HTML",
            data: "Type=selectdocument&DocID=" + DocID + "&Province=" + Province + "&Product=" + OldIndex + "&Value=" + element.checked,
            success: function (msg) {
                Toast(msg, true);
            }
        })
    }

    function Toast(Text, FadeOut){
        $('.toast').html(Text);
        $('.toast').show();
        if (FadeOut) {$('.toast').fadeOut(2000);}
    }

    function selectproduct(Index){
        if(OldIndex>-1){$("#rad" + OldIndex).prop("checked", false);}
        Toast("<FONT COLOR='BLACK'>You have selected " + Index + "</FONT>", true);
        $("#rad" + Index).prop("checked", true);
        OldIndex=Index;

        $.ajax({
            url: "<?php echo $this->request->webroot;?>profiles/products",
            type: "post",
            dataType: "HTML",
            data: "Type=selectproduct&DocID=" + Index,
            success: function (msg) {
                $('.tablespot').html(msg);
            }
        })
    }


</script>

<TABLE WIDTH="100%" HEIGHT="100%"><TR><TD COLSPAN="2"><TABLE WIDTH="100%" HEIGHT="100%"><TR><TD><FONT COLOR="white">[</FONT></TD><TD width="99%"><div class="toast" style="color: rgb(255,0,0);"></div></TD></TR></TABLE>
</TD></TR>
<TR><TD WIDTH="25%" VALIGN="TOP">
<?php
$provincelist = array("AB" => "Alberta", "BC" => "British Columbia", "MB" => "Manitoba", "NB" => "New Brunswick", "NL" => "Newfoundland and Labrador", "NT" => "Northwest Territories", "NS" => "Nova Scotia", "NU" => "Nunavut", "ON" => "Ontario", "PE" => "Prince Edward Island", "QC" => "Quebec", "SK" => "Saskatchewan", "YT" => "Yukon Territories");

echo "<table class='table table-condensed  table-striped table-bordered table-hover dataTable no-footer'  ID='myTable'>";
echo "<THEAD><TH>ID</TH><TH>Product</TH></THEAD>";
foreach($products as $product){
    echo '<TR onclick="selectproduct(' . $product->number . ');"><TD><INPUT TYPE="RADIO" ID="rad' . $product->number . '">' . $product->number . '</TD><TD>' . $product->title . "</TD></TR>";
}
echo "</table></TD><TD>";
    echo '<DIV CLASS="tablespot"></DIV>';
echo "</TD></TR></TABLE>";
?>