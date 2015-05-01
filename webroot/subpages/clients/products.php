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
<form action="#" method="post" id="blockform">
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
$global=true;
$local=true;
foreach($products as $product){
    echo '<TR><TD>' . $product->number . '</TD><TD><DIV ID="dn' . $product->number . '">' . $product->title . '</DIV></TD><TD>';
    if(!checkbox("global" . $product->number, $product->enable, "enable('global', -1, " .  $product->number . ");", false)){$global = false;}
    echo "<TD>";
    if(!checkbox("local" . $product->number, $product->clientenabled, "enable('local', " .  $id . ", " . $product->number . ");", false)) {$local=false;}
    echo '</TD></TR>';
}

function checkbox($name, $status, $onclick, $disabled = false){
    if ($status) {$status = " CHECKED"; }
    if ($disabled) { $disabled = " DISABLED";}
    echo '<INPUT TYPE="CHECKBOX" ONCLICK="' . $onclick . '" ID="' . $name . '" NAME="' . $name . '" CLASS="' . $name . '"' . $status . $disabled . '>';
    if($status) return true;
}


echo "</tbody><tfoot><TR><TD></TD><TD>All</TD><TD>";
checkbox("allglobal", $global, "selectall('global', 'allglobal', -1);");
echo "</TD><TD>";
checkbox("alllocal", $local, "selectall('local', 'alllocal', " . $id . ");");
?>
        </TD>
    </TR>
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

    function selectall(startswith, classname, clientid){
        var checked = $('.' + classname).is(':checked');
        $('#blockform input[type="checkbox"]').each(function () {
            var name = $(this).attr("name");
            if (typeof name  !== "undefined") {
                if (name.substring(0, startswith.length) == startswith) {
                    var number = name.substring(startswith.length);
                    if (checked) {
                        $(this).parent().addClass('checked')
                        $(this).attr('checked', 'checked');
                    } else {
                        $(this).parent().removeClass('checked')
                        $(this).removeAttr('checked');
                    }
                    enable(startswith, clientid, number);
                }
            }
        });
    }


    function simulateClick(name) {
        var evt = document.createEvent("MouseEvents");
        evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        var cb = document.getElementById(name);
        var canceled = !cb.dispatchEvent(evt);
    }
</SCRIPT></form>