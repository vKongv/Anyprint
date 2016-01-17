<?php
  include('config.php');
  $message = "Ori";
  if(isset($_SESSION['accessToken']) && !empty($_SESSION['accessToken'])) {
    $message = 'already set access token';
    header("Location: businessprofile.php");
  }else{
    //If user is already login
    $message = 'did not set access token';
    if(isset($_SESSION['login_uid']) && !empty($_SESSION['login_uid'])) {
      $message = "Setting access token";
      $uid = $_SESSION['login_uid']; //get the login uid
      $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; //Current url, to redirect back to this link.
      $sqlcmd = "SELECT U_GRefreshToken FROM user WHERE U_ID = '$uid'";
      $dataRetreive = mysqli_query($dbcon,$sqlcmd);
      $row = mysqli_fetch_row($dataRetreive);
      $refreshToken = $row[0]; //Get the refresh token of the user
      $redirect_url = "gcp/oAuthRedirect.php?code=".$refreshToken."&offline=true&previous=".$url;
      $message = "After set access token";
      header("Location: ".$redirect_url);
    }
  }
?>
