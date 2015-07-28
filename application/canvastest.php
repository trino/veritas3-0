<?php
    if (isset($_POST["image"])){
        echo saveimage($_POST["image"]);
        die();
    }

    function getnewfilename($dir = "", $ext){
        $filename = randomfilename($dir, $ext);
        while(file_exists($filename)){
            $filename = randomfilename($dir, $ext);
        }
        return $filename;
    }

    function generateRandomString($length = 10, $characters = "[ALL]") {
        $numbers = "0123456789";
        $lowercase = "abcdefghijklmnopqrstuvwxyz";
        $uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        switch($characters){
            case "[ALL]":
                $characters = $numbers . $lowercase . $uppercase;
                break;
            case "[NUM]":
                $characters = $numbers;
                break;
            case "[LCASE]":
                $characters = $lowercase;
                break;
            case "[UCASE]":
                $characters = $uppercase;
                break;
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function randomfilename($dir, $ext){
        $file = generateRandomString(10, "[NUM]") . "_" . generateRandomString(10, "[NUM]") . "." . $ext;
        return chkdir($dir, $file);
    }
    function chkdir($dir, $file){
        return $dir . DIRECTORY_SEPARATOR . $file;
    }

    function saveimage($text, $filename = ""){
        $dir = "assets";
        if(!$filename){$filename = getnewfilename($dir, "png");}
        file_put_contents($filename, base64_decode($text));
        return right($filename, strlen($filename) - strlen($dir) - 1);
    }

    function right($text, $length){
        return substr($text, -$length);
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Signature App</title>
</head>
<body>

<script src="assets/jquery-2.0.3.min.js"></script>
<link rel="stylesheet" href="assets/bootstrap.min.css">
<link rel="stylesheet" href="assets/bootstrap-theme.min.css">
<script src="assets/bootstrap.min.js"></script>
<script src="assets/signature_pad.js"></script>

<script>
    $(document).ready(function () {
        // Handler for .ready() called.

        var wrapper = document.getElementById("signature-pad"),
            clearButton = wrapper.querySelector("[data-action=clear]"),
            saveButton = wrapper.querySelector("[data-action=save]"),
            canvas = wrapper.querySelector("canvas"),
            signaturePad;

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            var ratio = window.devicePixelRatio || 1;
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        signaturePad = new SignaturePad(canvas);

        clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                SaveImage(signaturePad.toDataURL());
            }
        });
    });

    var uri = window.location.href;// 'canvastest.php';
    var saved = "";

    function QuickSave(){
        $('#savebtn').click();
    }

    function SaveImage(dataURL) {
        //$('#test').html('<IMG SRC="' + dataURL + '">');
        dataURL = dataURL.replace('data:image/png;base64,', '');
        var data = encodeURIComponent(dataURL);//JSON.stringify({value: dataURL});

        //alert("Let's pretend this got saved: " + data);

        $.ajax({
            type: "POST",
            url: uri,
            dataType: "HTML",
            data: "image=" + data,
            success: function (msg) {
                saved=msg;
                alert(msg);
                //$('#error').html(msg);
            },
            error: function (result, status, error) {
                var resultText = result.responseText;
                $('#error').html(resultText);
                saved="";
            }
        });
    }
</script>
<div class="panel panel-default">
    <div class="panel-body" id="signature-pad">
        <div>
            <canvas style="width: 400px; height: 200px;"></canvas>
        </div>
        <div>
            <div class="alert alert-info">Sign above</div>
            <button data-action="clear" class="btn btn-info">Clear</button>
            <button data-action="save" id="savebtn" class="btn btn-success" style="display: none">Save</button>
            <button class="btn btn-success" onclick="QuickSave();">Save</button>
        </div>
        <!--DIV id="test"></DIV-->
        <DIV id="error"></DIV>
    </div>
</div>
</body>
</html>