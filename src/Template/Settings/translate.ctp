<H2>Mass translation string system</H2><?php if($data){ echo $data;} else { echo "Page and language are reserved veriables<BR>The text is exploded based on =";} ?>
<FORM METHOD="post">
    <TEXTAREA NAME="data" STYLE="width: 100%; height: 500px;"><?php
        if ($page){
            $CRLF = "\r\n";
            echo "page=". $page . $CRLF;
            echo "language=". $language . $CRLF;
        }
        ?></TEXTAREA>
    <BR>
    <INPUT TYPE="submit">
</FORM>