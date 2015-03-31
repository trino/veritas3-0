<?php
    if ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1") {
        include_once('/subpages/api.php');
    } else {
        include_once('subpages/api.php');
    }

    $proxyhost = 'https://infosearchsite.com/MEEWS/ISBService.svc?wsdl';
    $client = new nusoap_client($proxyhost, true, $proxyhost, $proxyport = null, $proxyusername = null, $proxypassword = null);
    $client->useHTTPPersistentConnection();

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $user_id234 = $this->Session->read('Profile.isb_id');
    if (isset($user_id234) && $user_id234 != "") {
        $user_id234 = $this->Session->read('Profile.isb_id');
    } else {
        $user_id234 = '22552';
    }
/*
    if ($_SERVER['SERVER_NAME'] != "isbmeereports.com") {
        $user_id234 = '22552';
    }
*/  
  echo $_SERVER['SERVER_NAME'];

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $upload_additional_id = '';

    $startorder1 = false;
    $upload_additional = true; //additional are all attachments in all forms

    $uploadbinaryconsent_1603 = true;
    $uploadbinaryemployment_1627 = true;
    $uploadbinaryeducation_1650 = true;

    $productdetailsebs1603 = false;         //1  1603 Premium check
    $productdetails1 = false;               //2  1    MVR Driver's Record Abstract
    $productdetails14 = false;              //3  14   CVOR
    $productdetails77 = false;              //4  77   Pre-employment Screening Program Report
    $productdetails78 = false;              //5  78   Transclick
    $productdetailsebs1650 = false;         //6  1650 Certification (Education)
    $productdetailsebs1627 = false;         //7  1627 LOE (Employment)
    $productdetails_CheckDL_72 = false;     //8  72   checkdl

    echo $order_info->order_type;

    if ($order_info->order_type == "Order MEE") {
        $productdetails79 = true; // only TRUE if complete mee roders  - DONT CHANGE

        $productdetailsebs1603 = true;         // 1603 Premium check
        $productdetails1 = true;               // 1    MVR Driver's Record Abstract
        $productdetails14 = true;              // 14   CVOR
        $productdetails77 = true;              // 77   Pre-employment Screening Program Report
        $productdetails78 = true;              // 78   Transclick
        $productdetailsebs1650 = true;         // 1650 Certification (Education)
        $productdetailsebs1627 = true;         // 1627 LOE (Employment)
        //$productdetails_CheckDL_72 = true;   // 72   checkdl

    } else {

        $productdetails79 = false; // only TRUE if complete mee roders  - DONT CHANGE

        $myArray = explode(',', $order_info->forms);
        foreach ($myArray as $splitArray) {
            switch ($splitArray) {
                case 1:
                    $productdetailsebs1603 = true;
                    break;
                case 2:
                    $productdetails1 = true;
                    break;
                case 3:
                    $productdetails14 = true;
                    break;
                case 4:
                    $productdetails77 = true;
                    break;
                case 5:
                    $productdetails78 = true;
                    break;
                case 6:
                    $productdetailsebs1650 = true;
                    break;
                case 7:
                    $productdetailsebs1627 = true;
                    break;
                case 8:
                    $productdetails_CheckDL_72 = true;
                    break;
            }
        }
    }

    /*
        echo '<br>1' . $productdetailsebs1603;         // 1603 Premium check
        echo '<br>2' . $productdetails1;               // 1    MVR Driver's Record Abstract
        echo '<br>3' . $productdetails14;              // 14   CVOR
        echo '<br>4' . $productdetails77;              // 77   Pre-employment Screening Program Report
        echo '<br>5' . $productdetails78;              // 78   Transclick
        echo '<br>6' . $productdetailsebs1650;         // 1650 Certification (Education)
        echo '<br>7' . $productdetailsebs1627;         // 1627 LOE (Employment)
        echo '<br>8' . $productdetails_CheckDL_72;     // 72   checkdl
    */

    if ($startorder1 == true) {

        $body = '&lt;ProductData&gt;&lt;isb_FN&gt;' . $driverinfo->fname . '&lt;/isb_FN&gt;&lt;isb_LN&gt;' . $driverinfo->lname .
            '&lt;/isb_LN&gt;&lt;isb_Ref&gt;MEETEST-777&lt;/isb_Ref&gt;&lt;isb_DOL&gt;' . date("Y-m-d") . '&lt;/isb_DOL&gt;&lt;isb_Prov&gt;' . $driverinfo->driver_province . '&lt;/isb_Prov&gt;&lt;isb_UserID&gt;' . $user_id234 . '&lt;/isb_UserID&gt;&lt;/ProductData&gt;';

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><StartOrder xmlns="http://tempuri.org/"><IntPackage>'
            . $body .
            '</IntPackage><tp>' . $ordertype . '</tp><prod>true</prod></StartOrder></soap:Body></soap:Envelope>';

        $result = $client->call('StartOrder', $soap_xml);
        $myArray = explode(',', $result['StartOrderResult']);

        $ins_id = substr($myArray[0], 4);
        $ebs_id = substr($myArray[1], 4);

        $this->requestAction('orders/save_webservice_ids/' . $orderid . '/' . $ins_id . '/' . $ebs_id);
        //     ECHO "999start order";
    } else {
           die('ORDER NOT STARTED!');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetails79 == true) {  //this product only goes with FULL mee order, (bright planet)

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' .

            '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_FirstName&gt;' . $driverinfo->fname . '&lt;/isb_FirstName&gt;&lt;isb_LastName&gt;' . $driverinfo->lname . '&lt;/isb_LastName&gt;&lt;isb_DriverLicence&gt;' . $driverinfo->driver_license_no . '&lt;/isb_DriverLicence&gt;&lt;isb_USDOT_MC&gt;11&lt;/isb_USDOT_MC&gt;&lt;/ProductData&gt;'
            . '</productdetails><productID>79</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';
        $result = $client->call('ProductDetails', $soap_xml);

        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }
        $pdi = $r[0];
        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_79');
        $upload_additional_id = '79';
        echo '999ins_79';
        var_dump($result);

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetails1 == true) { // MVR

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_aucodes&gt;AU03&lt;/isb_aucodes&gt;&lt;isb_FirstName&gt;' . $driverinfo->fname . '&lt;/isb_FirstName&gt;&lt;isb_LastName&gt;' . $driverinfo->lname . '&lt;/isb_LastName&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;isb_DriverLicence&gt;' . $driverinfo->driver_license_no . '&lt;/isb_DriverLicence&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;/ProductData&gt;' . '</productdetails><productID>1</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $upload_additional_id = '1';
        $pdi = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_1');

        echo '999ins_1';
        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetails14 == true) { //CVOR

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' .

            '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_FirstName&gt;' . $driverinfo->fname . '&lt;/isb_FirstName&gt;&lt;isb_LastName&gt;' . $driverinfo->lname . '&lt;/isb_LastName&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;isb_aucodes14&gt;AU03&lt;/isb_aucodes14&gt;&lt;isb_CVORType&gt;Commercial Vehicle Operator Record Driver Abstract (on drivers)&lt;/isb_CVORType&gt;&lt;isb_DriverLicence&gt;' . $driverinfo->driver_license_no . '&lt;/isb_DriverLicence&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;/ProductData&gt;' . '</productdetails><productID>14</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $pdi = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_14');
        $upload_additional_id = '14';

        echo '999ins_14';
        var_dump($result);
    }

    if ($productdetails_CheckDL_72 == true) { //CheckDL

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_typeOfOrder&gt;Single Order&lt;/isb_typeOfOrder&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;isb_DriverLicence&gt;' . $driverinfo->driver_license_no . '&lt;/isb_DriverLicence&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;isb_CheckDLBulk&gt;a&lt;/isb_CheckDLBulk&gt;&lt;isb_uploadBulk&gt;a&lt;/isb_uploadBulk&gt;&lt;isb_CheckDLrbl&gt;a&lt;/isb_CheckDLrbl&gt;&lt;isb_rblHaveSig&gt;I confirm that I have signed consent from the drivers licence holder to verify its status&lt;/isb_rblHaveSig&gt;&lt;isb_specialInstructions&gt;&lt;/isb_specialInstructions&gt;&lt;/ProductData&gt;' . '</productdetails><productID>72</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        var_dump($soap_xml);
        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }
        $pdi = $r[0];
        echo '999ins_72';
        $upload_additional_id = '72';

        var_dump($result);

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_72');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetails77 == true) { // Pre-employment Screening Program Report

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' .

            '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_FirstName&gt;' . $driverinfo->fname . '&lt;/isb_FirstName&gt;&lt;isb_LastName&gt;' . $driverinfo->lname . '&lt;/isb_LastName&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;isb_DriverLicence&gt;' . $driverinfo->driver_license_no . '&lt;/isb_DriverLicence&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;/ProductData&gt;' . '</productdetails><productID>77</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }
        $pdi = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_77');
        echo '999ins_77';
        $upload_additional_id = '77';

        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetails78 == true) { //transclick

        if (isset($driverinfo->email) && $driverinfo->email != "") {
        } else {
            $driverinfo->email = "test@" . getHost("isbmee.com");
        }

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ins_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_FirstName&gt;' . $driverinfo->fname . '&lt;/isb_FirstName&gt;&lt;isb_LastName&gt;' . $driverinfo->lname . '&lt;/isb_LastName&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;isb_Email&gt;' . $driverinfo->email . '&lt;/isb_Email&gt;&lt;/ProductData&gt;' . '</productdetails><productID>78</productID><tp>INS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $pdi = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ins_78');
        echo '999ins_78';
        $upload_additional_id = '78';

        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetailsebs1650 == true) { // Certification

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_appfirstname&gt;a1aaq2bernard&lt;/isb_appfirstname&gt;&lt;isb_appsurname&gt;1q2naaormington&lt;/isb_appsurname&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;/ProductData&gt;' . '</productdetails><productID>1650</productID><tp>EBS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $pdi = $r[0];
        $pdi_1650 = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ebs_1650');
        echo '999ebs_1650';
        $upload_additional_id = '1650';

        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetailsebs1627 == true) { //LOE

        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_appfirstname&gt;a1qaa2bernard&lt;/isb_appfirstname&gt;&lt;isb_appsurname&gt;12noaarmington&lt;/isb_appsurname&gt;&lt;isb_provToSearch&gt;' . $driverinfo->driver_province . '&lt;/isb_provToSearch&gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;/ProductData&gt;' . '</productdetails><productID>1627</productID><tp>EBS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $pdi = $r[0];
        $pdi_1627 = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ebs_1627');
        echo '999ebs_1627';
        $upload_additional_id = '1627';

        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($productdetailsebs1603 == true) { //Premium check
        $soap_xml = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soap:Body><ProductDetails xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><productdetails>&lt;ProductData&gt;&lt;dupe_date&gt;' . date("Y-m-d") . '&lt;/dupe_date&gt;&lt;isb_appothername&gt;a1aaaaq2normington&lt;/isb_appothername &gt;&lt;isb_DOB&gt;' . $driverinfo->dob . '&lt;/isb_DOB&gt;&lt;isb_Sex&gt;Male&lt;/isb_Sex&gt;&lt;/ProductData&gt;' . '</productdetails><productID>1603</productID><tp>EBS</tp><prod>true</prod></ProductDetails></soap:Body></soap:Envelope>';

        $result = $client->call('ProductDetails', $soap_xml);
        //get between
        $r = explode('[', $result['ProductDetailsResult']);
        if (isset($r[1])) {
            $r = explode(']', $r[1]);
        }

        $pdi = $r[0];
        $pdi_1603 = $r[0];

        $this->requestAction('orders/save_pdi/' . $orderid . '/' . $pdi . '/ebs_1603');
        echo '999ebs_1603';
        $upload_additional_id = '1603';
        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($uploadbinaryconsent_1603 == true) {

        $pdf_content = '';
        $pdf_decoded = base64_decode($pdf_content);
        $pdf = file_get_contents('orders/order_' . $orderid . '/Consent_Form.pdf');
        $body = base64_encode($pdf);
        //      echo $urlDecodedStr = rawurldecode($body);
        $soap_xml = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><UploadBinaryFile xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><PDI>' . $pdi_1603 . '</PDI><FileData>' . $body . '</FileData><productID>1603</productID><Filename>Consent_Form.pdf</Filename><FileType>ConsentForm</FileType><tp>EBS</tp><prod>true</prod></UploadBinaryFile></soap:Body></soap:Envelope>';
        $result = $client->call('UploadBinaryFile', $soap_xml);
        echo "999uploadbinaryconsent_1603";
        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($uploadbinaryemployment_1627 == true) {

        $pdf_content = '';
        $pdf_decoded = base64_decode($pdf_content);
        $pdf = file_get_contents('orders/order_' . $orderid . '/Employment_Form.pdf');
        $body = base64_encode($pdf);
        //     echo $urlDecodedStr = rawurldecode($body);
        $soap_xml = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><UploadBinaryFile xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><PDI>' . $pdi_1627 . '</PDI><FileData>' . $body . '</FileData><productID>1627</productID><Filename>Employment_Form.pdf</Filename><FileType>ConsentForm</FileType><tp>EBS</tp><prod>true</prod></UploadBinaryFile></soap:Body></soap:Envelope>';
        $result = $client->call('UploadBinaryFile', $soap_xml);
        echo "999uploadbinaryemployment_1627";
        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if ($uploadbinaryeducation_1650 == true) {

        $pdf_content = '';
        $pdf_decoded = base64_decode($pdf_content);
        $pdf = file_get_contents('orders/order_' . $orderid . '/Education_Form.pdf');
        $body = base64_encode($pdf);
        // echo $urlDecodedStr = rawurldecode($body);
        $soap_xml = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><UploadBinaryFile xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><PDI>' . $pdi_1650 . '</PDI><FileData>' . $body . '</FileData><productID>1650</productID><Filename>Education_Form.pdf</Filename><FileType>ConsentForm</FileType><tp>EBS</tp><prod>true</prod></UploadBinaryFile></soap:Body></soap:Envelope>';
        $result = $client->call('UploadBinaryFile', $soap_xml);
        echo "999uploadbinaryeducation_1650";
        var_dump($result);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    if ($upload_additional == true) {

        foreach ($order_attach as $d) {
            echo "Attachment: " . $d->attachment;

            if($d){
                echo "<br/>";
                echo "Sub Document: " . $d->title;
            }

            $sendit = file_get_contents('attachments/' . $d->attachment);
            $body = base64_encode($sendit);

            $soap_xml = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><UploadBinaryFile xmlns="http://tempuri.org/">' . '<UID>' . $ebs_id . '</UID><PDI>' . $pdi . '</PDI><FileData>' . $body . '</FileData><productID>' . $upload_additional_id . '</productID><Filename>Consent_' . $d->attachment . '</Filename><FileType>Attachment</FileType><tp>EBS</tp><prod>true</prod></UploadBinaryFile></soap:Body></soap:Envelope>';

            $result = $client->call('UploadBinaryFile', $soap_xml);
            var_dump( $result);
        }
    }




    die();

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /*
    if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
    } else {
    $err = $client->getError();
    if ($err) {
    echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
    echo '<h2>Result</h2><pre>';
    print_r($result);
    echo '</pre>';
    }
    }

    echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
    echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
    echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';

    $client->clearDebug();
    */
?>