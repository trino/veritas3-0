<?php if ($_SERVER['SERVER_NAME'] == 'localhost') { echo "<span style ='color:red;'>products.ctp #INC not assigned</span>";} ?>
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

    function addproduct(){
        var Number =  $('#newnum').val();
        var Name =  $('#newname').val();
        if(isNaN(Number)) {
            Toast("'" + Number + "' is not a number", true);
        } else if (Name.length ==0) {
            Toast("No name was specified", true);
        } else {
            $.ajax({
                url: "<?php echo $this->request->webroot;?>profiles/products",
                type: "post",
                dataType: "HTML",
                data: "Type=createdocument&DocID=" + Number + "&Name=" + Name,
                success: function (msg) {
                    Toast(msg, true);
                    if(msg.indexOf("green") >-1){
                        $('#myTable > tbody:last').append('<TR ID="PTR' + Number + '" onclick="selectproduct(' + Number + ');"><TD><INPUT TYPE="RADIO" ID="rad' + Number + '">' + Number + '</LABEL></TD><TD><DIV ID="pn' + Number + '">' + Name + "</div></TD></TR>");

                        $('#newnum').val("");
                        $('#newname').val("");
                    }
                }
            })
        }
    }

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
        if (FadeOut) {$('.toast').fadeOut(5000);}
    }

    function selectproduct(Index){
        if(OldIndex>-1){$("#rad" + OldIndex).prop("checked", false);}
        Toast("<FONT COLOR='BLACK'>You have selected " + Index + "</FONT>", true);
        $("#rad" + Index).prop("checked", true);
        OldIndex=Index;
        $('.actions').show();
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

    function selectedname(){
        return $('#pn' + OldIndex).text();
    }
    function deleteproduct(){
        if (confirm("Are you sure you want to delete '" + selectedname() + "'?")){
            $.ajax({
                url: "<?php echo $this->request->webroot;?>profiles/products",
                type: "post",
                dataType: "HTML",
                data: "Type=deletedocument&DocID=" + OldIndex,
                success: function (msg) {
                    Toast("'" + selectedname() + "' was deleted", true);
                    document.getElementById("PTR" + OldIndex).remove();
                    OldIndex=-1;
                    OldRow=-1;
                    $('.actions').hide();
                    $('.tablespot').html("");
                }
            })
        }
    }
    function editproduct(){
        var person = prompt("Please enter a new name for: '" + selectedname() + "'", selectedname());
        if(person !== null && person.length>0) {
            $.ajax({
                url: "<?php echo $this->request->webroot;?>profiles/products",
                type: "post",
                dataType: "HTML",
                data: "Type=rename&DocID=" + OldIndex + "&newname=" + person,
                success: function (msg) {
                    Toast("'" + selectedname() + "' was renamed to '" + person + "' - " + msg, true);
                    $('#pn' + OldIndex).text(person);
                }
            })
        }
    }

</script>

<div class="portlet box green-haze">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-briefcase"></i>Products
        </div>
    </div>
    <div class="portlet-body">

<TABLE WIDTH="100%" HEIGHT="100%"><TR><TD COLSPAN="2"><TABLE WIDTH="100%" HEIGHT="100%"><TR><TD><FONT COLOR="white">[</FONT></TD><TD width="99%"><div class="toast" style="color: rgb(255,0,0);"></div></TD></TR></TABLE>
</TD></TR>
<TR><TD WIDTH="25%" VALIGN="TOP">
<?php
$provincelist = array("AB" => "Alberta", "BC" => "British Columbia", "MB" => "Manitoba", "NB" => "New Brunswick", "NL" => "Newfoundland and Labrador", "NT" => "Northwest Territories", "NS" => "Nova Scotia", "NU" => "Nunavut", "ON" => "Ontario", "PE" => "Prince Edward Island", "QC" => "Quebec", "SK" => "Saskatchewan", "YT" => "Yukon Territories");

echo "<table class='table table-condensed  table-striped table-bordered table-hover dataTable no-footer'  ID='myTable'>";
echo "<THEAD><TH>ID</TH><TH>Product</TH></THEAD><TBODY>";
foreach($products as $product){
    echo '<TR ID="PTR' . $product->number . '" onclick="selectproduct(' . $product->number . ');"><TD><INPUT TYPE="RADIO" ID="rad' . $product->number . '">' . $product->number . '</LABEL></TD><TD><DIV ID="pn' . $product->number . '">' . $product->title . "</div></TD></TR>";
}
?></TBODY><TFOOT>
    <TR><TH COLSPAN="2">Actions:</TH></TR><TR class="actions" style="display: none;"><TD COLSPAN="2">
                    <a class="btn btn-xs btn-info" id="delete" onclick="editproduct();">Rename</a>
                    <a class="btn btn-xs btn-danger" id="delete" onclick="deleteproduct();">Delete</a>
                </TD></TR>
    <TR><TH COLSPAN="2">Add Product:</TH></TR>
        <TR><TD><input type="text" id="newnum" style="width: 50px"></TD><TD><input type="text" id="newname" style="width: 80%">
                <a class="btn btn-xs btn-info" id="add" onclick="addproduct();" style="float: right;">Add</a></TD></TR>
                </table>
            </TD>
            <TD><DIV CLASS="tablespot"></DIV></TD>
        </TR></TFOOT></TABLE>
    </div>
</div>