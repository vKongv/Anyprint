<?php
  require __DIR__.'/vendor/autoload.php';
  use GuzzleHttp\Client;
  use GuzzleHttp\Psr7\Request;
  class Message{
    private $messagecontent;
    private $number;
    private $accecctoken;

    public function __construct() {
  		$this->accesstoken = "o.kxVFnnEFWK1eBWClp9x3sEt8wliX0d2e";
  	}

    public function sendMessage($targetHPNum, $content){
      // Create a client with a base URI
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.pushbullet.com',
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);

        $header = array(
          'Access-Token' => $this->accesstoken
        );
        $jsonBody = array(
          'push' => array(
            'conversation_iden' => $targetHPNum,
            'message' => $content,
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
        return $decoded;
      }
    }
?>
