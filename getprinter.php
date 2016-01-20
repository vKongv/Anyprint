<?php
  include 'config.php';
  require_once 'gcp/Config.php';
  require_once 'gcp/GoogleCloudPrint.php';

  session_start();
  // Create object
  $gcp = new GoogleCloudPrint();

  // Replace token you got in offlineToken.php
  $refreshTokenConfig['refresh_token'] = '1/VJYcjvBzkOmyvtPPfe7MUFOkV8YXJNB8nhJoJtxBcK8';

  $token = $gcp->getAccessTokenByRefreshToken($urlconfig['refreshtoken_url'],http_build_query($refreshTokenConfig));

  $gcp->setAuthToken($token->access_token);

  $printers = $gcp->getPrinters();
  $uid = $_SESSION['login_uid'];
  $sqlcmd = "SELECT P_ID_G FROM user,printer,printing_shop WHERE user.U_ID = $uid AND user.U_ID = printing_shop.U_ID AND printing_shop.PS_ID = printer.PS_ID;";
  $dataRetrieve = mysqli_query($dbcon,$sqlcmd);

  while($row = mysqli_fetch_row($dataRetrieve)){
  	for($i=0; $i<count($printers);$i++){
  		if($printers[$i]['id'] == $row[0]){
  			$printers[$i]['added'] = 'disabled';
  		}
  	}
  }

  print json_encode($printers);
?>
