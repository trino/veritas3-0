<?php
if($this->request->session()->read('debug')) {
    echo "<span style ='color:red;'>subpages/clients/products.php #INC???</span>";
}
?>
<STYLE>
    .toast{
        background-color: white;
    }
</STYLE>
<table class='table table-condensed  table-striped table-bordered table-hover dataTable no-footer'  ID='myTable'>
    <thead>
        <TR>
            <TH>Message</TH>
            <TD COLSPAN="3">
                <div class="toast"></div>
            </TD>
        </TR>
        <TR>
            <TH>ID</TH>
            <TH>Product</TH>
            <TH>Enabled for everyone (Globally)</TH>
            <TH>Enabled for this client (Locally)</TH>
        </TR>
    </thead>
    <tbody>
<?php //$action  = "Edit" (Not even shown otherwise)
foreach($products as $product){
    echo '<TR><TD>' . $product->number . '</TD><TD><DIV ID="dn' . $product->number . '">' . $product->title . '</DIV></TD><TD>';
    checkbox("global" . $product->number, $product->enable, "enable('global', -1, " .  $product->number . ");", false);
    echo "<TD>";
    checkbox("local" . $product->number, $product->clientenabled, "enable('local', " .  $id . ", " . $product->number . ");", false);
    echo '</TD></TR>';
}

function checkbox($name, $status, $onclick, $disabled = false){
    if ($status) {$status = " CHECKED"; }
    if ($disabled) { $disabled = " DISABLED";}
    echo '<INPUT TYPE="CHECKBOX" ONCLICK="' . $onclick . '" ID="' . $name . '" NAME="' . $name . '"' . $status . $disabled . '>';
}
?></tbody>
<tfoot>
    <TR>
        <TD colspan="4">
            A product needs to be enabled both globally and locally for it to show up for a client
        </TD>
    </TR>
</tfoot>
</TABLE>
<SCRIPT>
    function Toast(Text){
        $('.toast').stop();
        $('.toast').fadeIn(1);
        $('.toast').html(Text);
        $('.toast').show();
        $('.toast').fadeOut(5000);
    }

    function productname(ProductID){
        return $('#dn' + ProductID).text() ;
    }

    function enable(Name, ClientID, ProductID){
        element = document.getElementById(Name + ProductID);
        $.ajax({
            url: "<?php echo $this->request->webroot;?>clients/quickcontact",
            type: "post",
            dataType: "HTML",
            data: "Type=enabledocument&ClientID=" + ClientID + "&ProductID=" + ProductID + "&Value=" + element.checked,
            success: function (msg) {
                if(element.checked){ word="enabled "; } else { word = "disabled ";}
                Toast(productname(ProductID) + " was " + word + Name + "ly");
            }
        })
    }
</SCRIPT>