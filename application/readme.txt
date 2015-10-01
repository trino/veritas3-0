You will need this PHP code to generate a POST request:

//gets the extension of a file (not including the period)
function extension($Filename){
    $type = strtolower(pathinfo($Filename, PATHINFO_EXTENSION));
    if($type == "jpeg"){$type="jpg";}
    return $type;
}

//base64 encodes a file
function base64encodefile($Filename, $Extension = ""){
    if (file_exists($Filename)) {
        if(!$Extension){$Extension= extension($Filename);}
        return "data:image/" . $Extension . ";base64," . base64_encode(file_get_contents($Filename));
    }
}

//returns if the string is a valid JSON string or not
function isJson($string) {
    if($string && !is_array($string)){
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

//flattens a multi-dimensional POST made for this system
function array_flatten($array) {
    if(isset($array["form"])) {
        foreach ($array["form"] as $ID => $Data) {
            foreach ($Data as $Key => $Value) {
                $array["data[" . $ID . "][" . $Key . ']'] = $Value;
            }
        }
    }
    unset($array["form"]);
    return $array;
}

//makes a raw POST request
function cURL($URL, $data = "", $username = "", $password = ""){
    $session = curl_init($URL);
    curl_setopt($session, CURLOPT_HEADER, true);
    //curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);//not in post production
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_POST, true);
    if($data) {
        curl_setopt ($session, CURLOPT_POSTFIELDS, $data);
    }
    //$datatype = "application/x-www-form-urlencoded;charset=UTF-8";
    $datatype= "multipart/form-data";
    if(isJson($data)){$datatype  = "application/json";}//comment out this line, and isJson won't be required

    $header = array('Content-type: ' . $datatype, "User-Agent: SMI");
    if ($username && $password){
        $header[] =	"Authorization: Basic " . base64_encode($username . ":" . $password);
    } else if ($username) {
        $header[] =	"Authorization: Bearer " .  $username;
        $header[] =	"Accept-Encoding: gzip";
    } else if ($password) {
        $header[] =	"Authorization: AccessKey " .  $password;
    }
    curl_setopt($session, CURLOPT_HTTPHEADER, $header);

    $response = curl_exec($session);
    if(curl_errno($session)){
        $response = "[Error: " . curl_error($session) . ']';
    }
    curl_close($session);
    $FIND="Content-Type: text/html";
    $START = strpos($response, $FIND);
    if($START){$response = substr($response,$START + strlen($FIND) + 4);}
    return $response;
}

the $URL parameter needs to point to /rapid/placerapidorder

the $data parameter needs to the POST data in a single dimensional array (use array_flatten to flatten it)
The POST data will be validated by Veritas

POST data:
  'username' 		    => string (Your username)
  'password' 		    => string (Your Password, md5'd)

  'fname' 		        => string (User's first name)
  'mname' 		        => string (User's middle name)
  'lname' 		        => string (User's last name)
  'gender' 		        => string (User's gender ["Male" or "Female"])
  'title' 		        => string (User's title ["Mr.", "Ms." or "Mrs."])
  'email' 		        => string (User's email address, must be unique)
  'phone' 		        => string (User's phone number)
  'street' 		        => string (User's street)
  'city' 		        => string (User's city)
  'province' 		    => string (User's province, must be ["AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"])
  'country' 		    => string (User's Coutnry, Usually Canada)
  'postal' 		        => string (User's Postal Code)
  'dob' 		        => string (User's date of birth in format of 'MM/DD/YYYY')
  'driver_license_no' 	=> string (driver's license #)
  'driver_province' 	=> string (driver's license issued province, must be ["AB", "BC", "MB", "NB", "NL", "NT", "NS", "NU", "ON", "PE", "QC", "SK", "YT"])
  'clientid' 		    => number (Client ID number)
  'driverphotoBASE' 	=> string (Base64 encoded image of driver photo ID)
  'forms' 		        => string (Comma delimeted list of form numbers, see the list at the bottom)
  'ordertype' 		    => string (Product Type ['MEE', 'CAR', 'BUL', 'SIN', 'EMP', 'SAL', 'GDO'])
  'signatureBASE' 	    => string (Base64 encoded image of signature)
  'forms' 		        => array(Key = Index number, Value = array(
            'type' => number (9=letter of experience, 10=education verification)
            Required fields for letter of experience:
				company_name => string
				address => string
				city => string
				state_province => string
				country => string
				supervisor_name => string
				supervisor_phone => string
				supervisor_email => string
				supervisor_secondary_email => string
				employment_start_date => string (date in format of 'MM/DD/YYYY')
				employment_end_date => string (date in format of 'MM/DD/YYYY')
				claims_with_employer => number (0=no, 1=yes)
				claims_recovery_date => string (date in format of 'MM/DD/YYYY')
				emploment_history_confirm_verify_use => string
				us_dot => string
				signature => hidden/blank
				signature_datetime => string (today's date in format of 'MM/DD/YYYY')
				equipment_vans => number (0=no, 1=yes)
				equipment_reefer => number (0=no, 1=yes)
				equipment_decks => number (0=no, 1=yes)
				equipment_super => number (0=no, 1=yes)
				equipment_straight_truck => number (0=no, 1=yes)
				equipment_others => number (0=no, 1=yes)
				driving_experince_local => number (0=no, 1=yes)
				driving_experince_canada => number (0=no, 1=yes)
				driving_experince_canada_rocky_mountains => number (0=no, 1=yes)
				driving_experince_usa => number (0=no, 1=yes)
			Required fields for education verification:
				college_school_name
				address
				supervisor_name => string
				supervisor_phone => string
				supervisor_email => string
				education_start_date => string (date in format of 'MM/DD/YYYY')
				education_end_date => string (date in format of 'MM/DD/YYYY')
				claim_tutor => number (0=no, 1=yes)
				date_claims_occur => string
				education_history_confirmed_by => string
				highest_grade_completed => number (1-8)
				high_school => number (1-4)
				college => number (1-4)
				last_school_attended => string
				performance_issue => string
				date_time => string (today's date in format of 'MM/DD/YYYY')
				signature => hidden/blank

  ));// so the forms value is an array, which each cell containing a form, which is an array of all the form's fields

ie:

form[0][type] = 9;
form[0][address] = "test";
form[1][type] = 10;
form[1][address] = "test";

cURL will return the HTTP header, as well as a JSON object with Status being either true or false
If Status is false, the Reason variable will indicate why
If Status is false, the OrderID variable will give the Order ID number that was made

Order status API:
[website URL]/rapid/placerapidorder?action=orderstatus&orderid=[OrderID]

Will return a JSON object with the order info from the database, and Files which is an array of URLs to the files

Forms:
1603    Premium check EBS (criminal)
1       MVR Driver's Record Abstract INS
14      CVOR INS
77      Pre-employment Screening Program Report INS
78      Transclick INS
1650    Certification (Education) EBS
1627    LOE (Employment) EBS
72      checkdl INS
32      social media search
31 	    Credit Check