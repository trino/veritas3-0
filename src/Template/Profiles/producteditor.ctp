<table class="table table-light table-hover">
    <thead>
        <TR>
            <TH>ID</TH>
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
        <?php
            function td($text, $boolean = false){
                if($boolean){
                    if ($text==1){$text="Yes";} else {$text = "No";}
                }
                echo "<TD>" . $text . "</TD>";
            }

            foreach($producttypes as $producttype){
                echo "<TR>";
                    td($producttype->ID);
                    td($producttype->Acronym);

                    td($producttype->Name);
                    //td($producttype->Description);

                    td($producttype->NameFrench);

                    td($producttype->Color);
                    td($producttype->Checked);

                    td($producttype->Sidebar_Alias);
                    td($producttype->Blocks_Alias);

                    td($producttype->ButtonColor);
                    td($producttype->Blocked);
                    td($producttype->doc_ids);

                    td($producttype->Visible);
                    td($producttype->Bypass);
                echo "</TR>";
            }
        ?>
    </tbody>
</table>

<!--
pricing-red pricing-blue regular=green
-->