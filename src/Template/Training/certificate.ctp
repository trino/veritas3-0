<?php
$initials = W_ROOT;
ob_start();
error_reporting(1);
require_once('tcpdf/tcpdf2.php');

function left($text, $length){
    return substr($text,0,$length)	;
}
function right($text, $length){
    return substr($text, -$length);
}
function extractdate($text){
    if(str_replace(' ','',$text)!=$text)
        return trim(left($text, strpos($text, " ")));
    else
        return $text;
}

function getdatestamp($date){
    $newdate = date_create($date);
    return date_timestamp_get($newdate);
}

function clean($data, $datatype=0){
    if (is_object($data)){
        switch($datatype) {
            case 0:
                $data->Description = clean($data->Description);
                $data->Name = clean($data->Name);
                $data->Attachments = clean($data->Attachments);
                $data->image = clean($data->image);
                return $data;
                break;
            case 1:
                $data->Question = clean($data->Question);
                $data->Picture = clean($data->Picture);
                $data->Choice0 = clean($data->Choice0);
                $data->Choice1 = clean($data->Choice1);
                $data->Choice2 = clean($data->Choice2);
                $data->Choice3 = clean($data->Choice3);
                $data->Choice4 = clean($data->Choice4);
                $data->Choice5 = clean($data->Choice5);
                return $data;
                break;
        }
    }
    if (substr($data,0,1)== '"' && substr($data,-1) == '"'){$data = substr($data,1, strlen($data)-2);}
    $data = str_replace("\\r\\n", "\r\n", trim($data)) ;
    return $data;
}
$quiz = clean($quiz);
$orientation = "L";//P or L
if (isset($_GET["orientation"])) {$orientation = $_GET["orientation"]; }
$GLOBALS["orientation"] = $orientation;

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = K_PATH_IMAGES.'../img/certificates/certificate.jpg';


        //Image	(    $file,     $x,$y,$w,  $h,  $type, $link, $align, $resize, $dpi, $palign, $ismask, $imgmask, $border, $fitbox, $hidden, $fitonpage, $alt, $altimgs)
        if ($GLOBALS["orientation"] == "P") {//portrait
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0, "CT");
        } else {//landscape
            $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0, "CT");
        }

        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}

// create new PDF document
$pdf = new MYPDF($orientation, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 051');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 48);

// add a page
$pdf->AddPage();

// Print a text
//$html = '<span style="background-color:yellow;color:blue;">&nbsp;PAGE 1&nbsp;</span>
//<p stroke="0.2" fill="true" strokecolor="yellow" color="blue" style="font-family:helvetica;font-weight:bold;font-size:26pt;">' . ucfirst($user->fname) . " " . ucfirst($user->lname) . " " . $quiz->Name . '</p>';
//$pdf->writeHTML($html, true, false, true, false, '');
//Text	($x, $y, $txt, $fstroke, $fclip, $ffill, $border, $ln, $align, $fill, $link, $stretch, $ignore_min_height, $calign, $valign, $rtloff)

$pdf->SetFontSize(30);

$ScaleFactor=1;
if ($orientation== "L") { $ScaleFactor = "1.344262295081967"; }//portrait 1.344262295081967

    $pdf->Text(15, 61 * $ScaleFactor, ucfirst($user->fname) . " " . ucfirst($user->lname), false, false, true, 0, 0, "C");
    $pdf->Text(15, 80 * $ScaleFactor, $quiz->Name, false, false, true, 0, 0, "C");
    $pdf->SetFontSize(15);
    $pdf->Text(15, 92 * $ScaleFactor, "On this date: " . date("F d, Y", getdatestamp($date)), false, false, true, 0, 0, "C");
//} else {//landscape
//    $pdf->Text(15, 82, ucfirst($user->fname) . " " . ucfirst($user->lname), false, false, true, 0, 0, "C");
//    $pdf->Text(15, 108.54, $quiz->Name, false, false, true, 0, 0, "C");
//    $pdf->SetFontSize(15);
//    $pdf->Text(15, 123.67, "On this date: " . date("F d, Y", getdatestamp($date)), false, false, true, 0, 0, "C");
//}


ob_end_clean();
$name='certificate' . $user->id . '-' . $_GET["quizid"] . '.pdf';
$pdf->Output($name, 'F', '../webroot/img/certificates');

$name='../webroot/img/certificates/' . $name;
echo "<center><a download='certificate.pdf' href='" . $name . "'><i class='fa fa-floppy-o'></i> Click here to save your certificate</a><BR></center>";

echo '<iframe src="' . $name . '#view=FitW" width="100%" height="603" type="application/pdf"></iframe>';
//============================================================+
// END OF FILE
//============================================================+
?>

<?php
/*k = new Imagick();
$fonts = $imagick->queryFonts();
foreach($fonts as $font) {
    echo $font;
}


function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) { return false; }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
            break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
            break;
        case 3 :
            $im = imageCreateFromPng($filepath);
            break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
            break;
    }
    return $im;
}

//debug($user);
//debug($quiz);

$path = getcwd() . "/img/certificates/";
$image = imageCreateFromAny($path . "certificate.jpg");
if($image){
    $black  = imagecolorallocate($image, 0, 0, 0);

    //$font = imageloadfont($path . "font.fon");
    //imagestring($image,  $font, 5, 5,ucfirst($user->fname) . " " . ucfirst($user->lname) . " " . $quiz->Name , $black);
    $font = 'arial.ttf';
    imagettftext($image, 20, 0, 10, 20, $black, $font, ucfirst($user->fname) . " " . ucfirst($user->lname) . " " . $quiz->Name);

    imagejpeg($image, $path . "certificate_" . $user->id . ".jpg");
    echo "<img width='100%' src='" . $this->request->webroot . "/img/certificates/certificate_" . $user->id . ".jpg'>";
} else {
    echo "Load image failed";
} */
?>