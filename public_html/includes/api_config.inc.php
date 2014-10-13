<?php #Sample configuration and handler file
/******** paypal setting number********/
//routing number : 325272199
//Account number : 542451737523215
//SSN            : 111239235
//accont for maggi.
//bank name: chase 
//routing no: 325272021
//acc no: 400189473198511


$include_path = ini_get('include_path');
//$pear_path =  "/home/ppadmin0/pear/";
$pear_path =  "./pear/";
if(!stristr($pear_path,$include_path)) ini_set('include_path',$include_path . PATH_SEPARATOR . $pear_path);

require_once 'Services/PayPal.php'; //Import the base SDK services packages
require_once 'Services/PayPal/Profile/Handler/Array.php'; //Import Profile Handler array routines
require_once 'Services/PayPal/Profile/API.php'; //Import the default API profile routines

$certfile = dirname(__FILE__) . '/cert_key_pem.txt';

$certpass = ''; //The private key for API certificates is not implemented at this time.

$apiusername = 'services_sub_api1.youngpetals.net';

$apipassword = 'rasdiv2392';

$subject = null; //If this program were run on behalf a third   party, subject must be set to the email address of that third-party.

$environment = 'Sandbox'; //Because this is a test application, it will be
                          //run against the PayPal sandbox endpoint,
                          //not the live PayPal API endpoint.

$handler =& ProfileHandler_Array::getInstance(array(
'username' => $apiusername,
'certificateFile' => $certfile,
'subject' => $subject,
'environment' => $environment));

 $profile =& APIProfile::getInstance($apiusername, $handler);
 $profile->setAPIPassword($apipassword); //Set the API password object

$caller =& Services_PayPal::getCallerServices($profile); //Create a caller object

 if(Services_PayPal::isError($caller)) //Some simple error handling.
 {
print "Could not create CallerServices instance: ". $caller->getMessage();
 exit;
}
