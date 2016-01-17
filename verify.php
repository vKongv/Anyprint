<?php
  /*
    To verify login and sign up data of user
  */
  session_start();
  include("config.php");
  require_once 'gcp/GoogleCloudPrint.php';
  require_once 'gcp/Config.php';
    //For login checking
    if(isset($_POST['login'])){
      $uid;
      // Define $username and $password
      $username = $_POST['uname'];
      $password = $_POST['upassword'];

      // To protect MySQL injection for Security purpose
      $username = stripslashes($username);
      $password = stripslashes($password);
      $username = mysql_real_escape_string($username);
      $password = mysql_real_escape_string($password);

      $type = "";
      $sqlcmd = "SELECT U_ID, U_Name, U_Password, U_Type, U_GRefreshToken FROM user WHERE UPPER(U_Name) = UPPER('$username') AND U_Password='$password';";
      $dataRetreive = mysqli_query($dbcon,$sqlcmd);
      $row = mysqli_fetch_row($dataRetreive);
      if ($username == $row[1]){
        if($password == $row[2]){
          $type = $row[3];
          //If is business owner, redirect to business owner page
          if($type == "BO"){
            //To set cookies
            // echo "<script type='text/javascript'>alert('Verified!');</script>";
            // setcookie("userName",$_POST['userName'],time()+ 3600,"/");
            // setcookie("userID", $row[0],time()+ 3600,"/" );
            // setcookie("userType",$row[3],time()+ 3600,"/" );
            $uid = $row[0];
            $refreshtoken = $row[4];
            $gcp = new GoogleCloudPrint();

            $refreshTokenConfig['refresh_token'] = $refreshtoken;
            $gcpResponse = $gcp->getAccessTokenByRefreshToken($urlconfig['refreshtoken_url'],http_build_query($refreshTokenConfig));

            if(isset($gcpResponse->access_token) && !empty($gcpResponse->access_token)) {
              $_SESSION['access_token'] = $gcpResponse->access_token;
              $_SESSION['refresh_token'] = $refreshtoken;
             } else{
                $_SESSION['access_token'] = $gcpResponse->error;
                $_SESSION['refresh_token'] = "ERROR";
                header("location: login.php?err=invalidtoken");
                exit();
             }
            $_SESSION['login_uid']=$uid; // Initializing Session
            header("location: businessprofile.php"); // Redirecting To Other Page
          }//end if ($type == "BO")
          //If is normal user, redirect to normal user page
          else if($type == "NORMAL"){
            $uid = $row[0];
            $_SESSION['login_uid']=$uid; // Initializing Session
            header("location: userprofile.php"); // Redirecting To Other Page
          }
        }//end if($password == $row[2])
      }//end if ($username == $row[1])
      else{
      //If username or password is wrong
      header("location: login.php?err=invaliduser");
    }
    } //end if(isset($_POST['login']))

    //For sign up checking
    else if(isset($_POST['signup'])){
        // Define $username and $password
        $username = $_POST['uname'];
        $email = $_POST['uemail'];
        $password = $_POST['upassword'];
        $hpnum = $_POST['uhpnum'];

        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $email = stripslashes($email);
        $password = stripslashes($password);
        $hpnum = stripslashes($hpnum);
        $username = mysql_real_escape_string($username);
        $email = mysql_real_escape_string($email);
        $password = mysql_real_escape_string($password);
        $hpnum = mysql_real_escape_string($hpnum);

        //Define a variable to hold error message
        $errMsg = "";
        $sqlcmd = "SELECT U_ID, U_Name, U_HP, U_Email FROM user;";
        $dataRetrieve = mysqli_query($dbcon,$sqlcmd);
        $numOfRows = mysqli_num_rows($dataRetrieve); //Retrieve number of row in the database

        while($row = mysqli_fetch_row($dataRetrieve)){
          //Check all the sign up data
          if($username == $row[1]){
            $errMsg = "The username has been choosen. Please choose another username";
            break;
          }//end if($_POST['uname'] = $row[1])
          if($hpnum == $row[2]){
            $errMsg = "This phone number is already registered in our system. Please use another phone number.";
            break;
          }//end if($hpnum == $row[2])
          if($email == $row[3]){
            $errMsg = "This email address is already registered in our system. Please use another email address.";
            break;
          }//end if($email == $row[3])
        }// end while($row = mysqli_fetch_row($dataRetrieve))

        //Check if any error exist
        if($errMsg == ""){
          $uid = 400001 + $numOfRows;
          $ustatus = "NOT VERIFIED";
          $utype = "NORMAL";
          $sqlinsert = "INSERT INTO user (U_ID, U_Name, U_Password ,U_HP, U_Email, U_Status, U_Type) VALUES ($uid, '$username', '$password','$hpnum','$email','$ustatus','$utype');";
          $insertData = mysqli_query($dbcon,$sqlinsert);

          if($insertData){
            echo "<script type='text/javascript'>alert('Successful register!');</script>";
          }//end if($errMsg == "")
          else{
             $errMsg = "Unknown error occur. Please try again later.";
             echo "<script type='text/javascript'>alert('$errMsg');</script>";
          }//end else
        }//end if($errMsg == "")
        else{
          echo "<script type='text/javascript'>alert('$errMsg');</script>";
        }// end else
        ?>
        <script type="text/javascript">
          window.location = "index.php";
        </script>
      <?php
      } // end if(isset($_POST['signup']))
      mysqli_close($dbcon);
      echo "Error";
?>
