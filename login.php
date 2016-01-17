<!DOCTYPE HTML>
<?php
  if (isset($_GET['err'])){
    if($_GET['err'] == 1){
      ?>
      <script>
        alert('Incorrect username or password');
      </script>
    <?php
    }
  }
?>
<html>
<head>
 <title>Login</title>

   <meta charset="utf-8"/>
   <meta http-equiv="content-type" content="text/html" />
   <meta name ="viewport" content="width=device-width, initial-scale=1" />

   <link rel="import" href="bower_components/paper-input/paper-input.html" />
   <link rel="import" href="bower_components/paper-button/paper-button.html" />
   <link rel="import" href="bower_components/paper-header-panel/paper-header-panel.html" />
   <link rel="import" href="bower_components/paper-toolbar/paper-toolbar.html" />
   <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html">
   <link rel="import" href="bower_components/font-roboto/roboto.html">

   <script src="bower_components/webcomponentsjs/webcomponents-lite.js"></script>
   <style>
     body {
       font-family: Roboto;
     }
     .centered {
       margin: auto;
       margin-left: auto;
       margin-right: auto;
       max-width: 600px;
       max-height: 800px;
     }
   </style>
</head>

 <body>
   <!-- Login form -->
   <template is="dom-bind" id="app">
       <div class="centered">
         <paper-toolbar><h2>Login to your account</h2></paper-toolbar>
         <paper-material elevation="3" style="padding: 30px;">
         <form id ="formlogin" action="verify.php" method="post">
           <paper-input  id= "unamefake" label="Username" required auto-validate error-message="Please type your username" value="{{uname}}" ></paper-input>
           <input type="hidden" id="uname" name="uname" value="{{formUName}}"/>

           <paper-input id="upasswordfake" label="Password" type="password" required auto-validate error-message="Please type your password" value={{upassword}}></paper-input>
           <input type="hidden" id="upassword"  name="upassword" value="{{formUPassword}}"/>

           <paper-button name="btnlogin" raised onclick="submitHandler()" value="login">Log in</paper-button>
           <input type="hidden" name="login" value="login"/>
         </form>
       </paper-material elevation="3">
        </div>
    </template>

 <script>
  var app = document.querySelector('#app');
  var canSubmit = true;
  var submitHandler = function(){
     //Validate input
     alert("Username: " + app.uname + "Password: " + app.upassword);
     if(app.uname == ""){
       canSubmit = false;
       return;
     }
      if(app.upassword == ""){
       canSubmit = false;
       return;
     }

      //If all input OK, then submit
     if(canSubmit){
       app.formUName = app.uname;
       app.formUPassword = app.upassword;
       alert("Form uname: " + app.formUName + " Form Password: " + app.formUPassword);
        app.$.formlogin.submit();
     }
      else{
        alert("invalid");
        return;
      }
    }
    </script>
 </body>
 </html>
