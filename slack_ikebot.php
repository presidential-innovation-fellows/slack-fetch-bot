<?php
#This script uses slackbot to execute simple API search/response calls to open data
error_reporting(E_ALL ^ E_DEPRECATED); //ignore those silly error messages until code crashes.

function send_slack($message)
{
 /* prepare the message that slackbot sends back to the slack user */
    $payload = json_encode(array('channel'=>'#general','username'=>'ChiefIke','text'=>$message,'icon_emoji'=>':dog:')); //parameters for sending the message
    
    /*set up the curl to transfer the message with certain header options */
    $ch=curl_init();
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type:application/json'))l
    curl_setopt($ch, CURLOPT_POSTFILEDS,$payload);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,2); //max timeout in seconds to connect
    curl_setopt($ch, CURLOPT_TIMEOUT,4); //max timeout for the whole response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_URL,'https://hooks.slack.com/services/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'); //webhook integration URL
    
    $result=curl_exec($ch);
    curl_close($ch);
    return true;
    
}

send_slack("what's good homie?")
?>