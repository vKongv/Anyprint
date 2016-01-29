<?php
  include('config.php');
  session_start();
  if(isset($_SESSION['login_uid']) && !empty($_SESSION['login_uid'])) {
    $uid = $_SESSION['login_uid'];
    $sqlcmd = "SELECT PR_ID, Job_ID, PR_Name, PR_Price, PS_Name FROM user,printer, print_request, printing_shop WHERE user.U_ID = $uid AND printer.P_ID = print_request.P_ID AND printer.PS_ID = printing_shop.PS_ID";

    $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
    $printrequests = [];
    while($row = mysqli_fetch_row($dataRetrieve)){
      $printrequest = array(
        'id' => $row[0],
        'jobid' => $row[1],
        'name' => $row[2],
        'price' => $row[3],
        'shop' => $row[4]
      );
      array_push($printrequests,$printrequest);
    }
    print json_encode($printrequests);
  }
?>
