<?php
  include('config.php');
  session_start();
  if(isset($_SESSION['login_uid']) && !empty($_SESSION['login_uid'])) {
    $uid = $_SESSION['login_uid'];
    if(isset($_GET['pid']) && !empty($_GET['pid']) && isset($_GET['pname']) && !empty($_GET['pname']) && isset($_GET['pstatus']) && !empty($_GET['pstatus'])) {
      $printerid = $_GET['pid'];
      $printername = $_GET['pname'];
      $printerstatus = $_GET['pstatus'];
      //Get last printer id
      $sqlcmd = "SELECT P_ID FROM printer,printing_shop,user WHERE user.U_ID = $uid AND user.U_ID = printing_shop.U_ID AND printing_shop.PS_ID = printer.PS_ID ORDER BY P_ID DESC LIMIT 1;";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
      $row = mysqli_fetch_row($dataRetrieve);
      $lastpid = $row[0]; //Last printer ID

      $sqlcmd = "SELECT PS_ID FROM printing_shop,user WHERE user.U_ID = $uid AND user.U_ID = printing_shop.U_ID LIMIT 1;";
      $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
      $row = mysqli_fetch_row($dataRetrieve);
      $psid = $row[0];
      $newpid = 0;
      if(empty($lastpid)){
        $newpid = 200001;
      }else{
        $newpid = $lastpid + 1;
      }
      $sqlcmd = "INSERT INTO printer (P_ID,P_ID_G,P_Name,P_Status,PS_ID) VALUES($newpid,'$printerid','$printername','$printerstatus',$psid);";
      $insertData = mysqli_query($dbcon,$sqlcmd);
      print('after insert');
      if($insertData){
        echo "<script type='text/javascript'>alert('Successful register printer');</script>";
        //header("Location: businessprofile.php");
      }//end if($errMsg == "")
      else{
         $errMsg = "Unknown error occur. Please try again later.";
         echo "<script type='text/javascript'>alert('$errMsg');</script>";
         //header("Location: businessprofile.php");
      }//end else
    }else{
      print('Invalid request');
    }
  }else{
    print('No user is currently logged in');
  }

?>
