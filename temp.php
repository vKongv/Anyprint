<?php
session_start();
require __DIR__.'/vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

// Create a client with a base URI
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'http://www.google.com',
    // You can set any number of default request options.
    'timeout'  => 10.0,
]);

$response =  $client->request('GET', '/cloudprint/xsrf', [
                               'verify' => true,
                                 'headers' => [
                                     'Accept' => '*/*',
                                     'Authorization' => 'Bearer ya29.UgK8Bk9f5vqPDsZvs26zJPzwhW3EkSpy6NnXyAKxFTi4D-IUZisTHUKvmrki'
                                 ]
                            ]);
//Get the body of the response, it is a JSON file.
$json = $response->getBody();
$decoded = json_decode($json,true);
//print_r($decoded["xsrf_token"]); //Can display the XSRF token received! FINALLY!!
$xsrf = $decoded["xsrf_token"];
//print_r($xsrf);
?>
