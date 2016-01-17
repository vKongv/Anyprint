<?php
session_start();
require __DIR__.'/vendor/autoload.php';
require_once '../gcp/Config.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

// Create a client with a base URI
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://www.googleapis.com',
    // You can set any number of default request options.
    'timeout'  => 10.0,
]);
$refreshTokenConfig['refresh_token'] = '1/44G8HsB8gpwpj-bSbytUJ3FS94d_Z3EkISF0_sE8KZs';
$refreshTokenConfig['grant_type'] = 'refresh_token';
$response =  $client->request('POST', '/oauth2/v4/token', [
                               'verify' => false,
                                 'headers' => $refreshTokenConfig,
                            ]);
//Get the body of the response, it is a JSON file.
$json = $response->getBody();
$decoded = json_decode($json,true);
//print_r($decoded["xsrf_token"]); //Can display the XSRF token received! FINALLY!!
$xsrf = $decoded["access_token"];
print_r($xsrf);
?>
