<?php
  include('config.php');
  session_start();
  if(isset($_SESSION['login_uid']) && !empty($_SESSION['login_uid'])) {
    $uid = $_SESSION['login_uid'];
    if(isset($_GET['pid']) && !empty($_GET['pid'])) {
      $printerid = $_GET['pid'];

      $sqlcmd = "DELETE FROM printer WHERE P_ID = '$printerid'";
      $deletePrinter = mysqli_query($dbcon,$sqlcmd);
      if($deletePrinter){
        header("Location: businessprofile.php?delete=true");
      }//end if($errMsg == "")
      else{
         header("Location: businessprofile.php?delete=false");
      }//end else
    }else{
      print('Invalid request');
    }
  }else{
    print('No user is currently logged in');
  }

?>
