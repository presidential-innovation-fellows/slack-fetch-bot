<?php
#This script uses slackbot to execute simple API search/response calls to open data
include_once("../code/tokens.php");

global $command;
$command = $_POST['text']; //read the message from slack 

error_reporting(E_ALL ^ E_DEPRECATED); //ignore those silly error messages until code crashes.



function post_slack_msg($message)
{
    global $bot_token; //private authorization token defined in another file
    if (empty($message)) {
        $message = "Ignore this debugging message."; //if for some reason, the message is null    
    }
    
    $request_url       = "https://slack.com/api/chat.postMessage";
    $parameters        = array(
        'username' => 'chiefike',
        'as_user' => 'true',
        'channel' => '#general',
        'text' => $message,
        'token' => $bot_token
    );
    $query             = http_build_query($parameters);
    $final_request_url = $request_url . "?" . $query;
    $response          = file_get_contents($final_request_url);
    
    
    return true;
}

function parse_response($response)
{
    
    if (strpos($response, 'economy') == true) {
        post_slack_msg("Here's a snapshot of the US economy:");
        
    } else {
        post_slack_msg("I don't know how to respond to that yet. But you can help me learn by visiting: http://www.pif.gov");
    }
    
    return true;
}
if (strpos($command, 'chiefike') == true) {
    $text  = $_POST['text'];
    $token = $_POST['token']; //store the token from the slack message and maybe use it for validation later
    
    parse_response($text);
    
}

?>