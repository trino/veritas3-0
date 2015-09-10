<DIV ID="exceltest" style="width: 400px; height: 400px; border: 1px solid black; overflow: auto; resize: both;">
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