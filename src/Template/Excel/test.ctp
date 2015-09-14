<?php
    $Path = 'assets/global/plugins/';
?>
<DIV ID="exceltest" style="display: none; width: 400px; height: 400px; border: 1px solid black; overflow: auto; resize: both;">
    <HEADER>
        Header Test
    </HEADER>
    <?php
        $Table = "test";
        $EmbeddedMode="exceltest";
        $DIR = str_replace('\webroot/', '/', getcwd() . "/src/Template/Excel/index.ctp");
        include($DIR);
    ?>
    <FOOTER>
        Footer Test
    </FOOTER>
</DIV>


    <!-- bootstrap -->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

    <!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

    <!-- main.js -->
    <script>
    $(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';

    $('.editable').editable();

});
</script>

<div class="container">

    <h1>X-editable starter template</h1>

    <div>
        <span>Username:</span>
        <a href="#" id="username" data-type="text" data-placement="right" data-title="Enter username" class="editable">superuser</a>
    </div>

    <div>
        <span>Status:</span>
        <a href="#" id="status" class="editable"></a>
    </div>


</div>