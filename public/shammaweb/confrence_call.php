<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// The PHP Twilio helper library. Get it here http://www.twilio.com/docs/libraries/
require_once('twilio.php');

$API_VERSION = '2010-04-01';
$ACCOUNT_SID = 'ACe583fc9621e5b27acf15132efa7716d1';//'AC609b7874b36da631d1301286082eba20';
$AUTH_TOKEN = "ad040ab17878659d3fca378872d60921";//"52e3573377150a2632526cda5346056f";//'ad040ab17878659d3fca378872d60921';

$client = new TwilioRestClient($ACCOUNT_SID, $AUTH_TOKEN);

// The phone numbers of the people to be called
$participants = array('+917983183218', '+919569845641');

// Go through the participants array and call each person.
foreach ($participants as $particpant) {
//            echo $particpant."<br>";
    $vars = array(
        'From' => '+16477978995',
        'To' => $particpant,
        'Url' => 'http://shamma.proximitycrm.com/shammaweb/conference.xml');

    $response = $client->request("/$API_VERSION/Accounts/$ACCOUNT_SID/Calls", "POST", $vars);
}
echo "<pre>";
print_r($response);
echo "</pre>";
?>