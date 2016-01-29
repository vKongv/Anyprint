<?php
  session_start();
  if(isset($_GET['id']) && !empty($_GET['id'])) {
    $_SESSION['user_psid'] = $_GET["id"];
    if(isset($_GET['status']) && !empty($_GET['status'])){
      if($_GET['status'] == "err"){
?>
        <script>
          alert("Fail to upload file, please try again")
        </script>
<?php
      }
    }
  }else{
    exit();
  }
  echo "s";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Upload Document</title>
    <!-- Import polymer HTML files-->
    <link rel="import" href="bower_components/paper-toolbar/paper-toolbar.html">
    <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html">
    <link rel="import" href="bower_components/paper-card/paper-card.html">
    <link rel="import" href="bower_components/paper-button/paper-button.html">
    <link rel="import" href="bower_components/paper-drawer-panel/paper-drawer-panel.html">
    <link rel="import" href="bower_components/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="bower_components/paper-toast/paper-toast.html">
    <link rel="import" href="bower_components/paper-item/paper-item.html">
    <link rel="import" href="bower_components/paper-header-panel/paper-header-panel.html">
    <link rel="import" href="bower_components/font-roboto/roboto.html">
    <link rel="import" href="element/user-print-page-1.html">

    <script src="bower_components/webcomponentsjs/webcomponents-lite.js"></script>
    <style is="custom-style">
      body {
        font-family: Roboto;
      }
      .center{
        max-width: 300px;
        max-height: 400px;
        margin: auto;
        margin-top: 30px;
      }
      paper-button{
        min-width: inherit;
      }
      .spacer{
        @apply(--layout-flex);
      }
      #file {
        margin-bottom: 300px;
      }
      paper-button {
        color: white;
        background-color: #65C6BB;
      }
      .warning {
        --paper-toast-background-color: #F7CA18;
        --paper-toast-color: white;
      }
    </style>
  </head>

  <body class="fullbleed vertical layout">
    <template is="dom-bind" id="app">
      <paper-header-panel class="flex">
        <paper-toolbar>
          <div><h1> Choose a file <h1></div>
        </paper-toolbar>
        <div class="center">
          <form id="uploadfile" method="POST" action="processfile.php" enctype="multipart/form-data">
            <input name="file" id="file" type="file">
            <paper-button raised on-click="submitform">U P L O A D</paper-button>
          </form>
           <paper-toast id="warning" class="fit-bottom warning" text="Can ONLY print 1 document at a time" opened duration="10000"></paper-toast>
        </div>
      </paper-header-panel>

    </template>
  </body>

  <script>
    //Set the first page
    var app = document.querySelector("#app");
    app.select = 0;

    app.submitform = function(event){
      if(this.$.file.files.length == 0){
        alert('No file selected');
      }
      else{
        this.$.uploadfile.submit();
      }
    }
  </script>
</html>
