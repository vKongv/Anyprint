<?php
//ABLE TO SEND SMS!!! YEAH!!!!!!!!!
session_start();
require __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

// Create a client with a base URI
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://api.pushbullet.com',
    // You can set any number of default request options.
    'timeout'  => 10.0,
]);

$header = array(
  'Access-Token' => 'o.FqMTx5y80HyK8GxSWZXSRTC5ZgTDxZha'
);

$jsonBody = array(
  'push' => array(
    'conversation_iden' => '+60 179556908',
    'message' => 'Hello Testing Im Kong',
    'package_name' => 'com.pushbullet.android',
    'source_user_iden' => 'ujxLcTi4vRI',
    'target_device_iden' => 'ujxLcTi4vRIsjAiVsKnSTs',
    'type' => 'messaging_extension_reply'
  ),
  'type' => 'push'
);

$response =  $client->request('POST', '/v2/ephemerals', [
                               'verify' => false,
                                 'headers' => $header,
                                 'json' => $jsonBody
                            ]);
//Get the body of the response, it is a JSON file.
$json = $response->getBody();
$decoded = json_decode($json,true);
//print_r($decoded["xsrf_token"]); //Can display the XSRF token received! FINALLY!!
print($json);
?>
