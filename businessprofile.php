<?php
  include('usersession.php');
  //include('request_access_token.php');
  ?>
  <script>
    var validToken;
  </script>
  <?php
  if(isset($_GET['token']) && !empty($_GET['token'])) {
    $validToken = $_GET['token'];
    if($validToken == "true"){
      ?>
      <script>
        validToken = true;
      </script>
<?php
    } else if ($validToken == "false"){
        ?>
        <script>
          validToken = false;
        </script>
<?php
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Your Home Page</title>
    <!-- Import polymer HTML files-->
    <link rel="import" href="bower_components/paper-toolbar/paper-toolbar.html">
    <link rel="import" href="bower_components/iron-flex-layout/iron-flex-layout.html">
    <link rel="import" href="bower_components/paper-card/paper-card.html">
    <link rel="import" href="bower_components/paper-button/paper-button.html">
    <link rel="import" href="bower_components/paper-drawer-panel/paper-drawer-panel.html">
    <link rel="import" href="bower_components/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="bower_components/iron-icons/iron-icons.html">
    <link rel="import" href="bower_components/paper-menu/paper-menu.html">
    <link rel="import" href="bower_components/paper-item/paper-item.html">
    <link rel="import" href="bower_components/paper-header-panel/paper-header-panel.html">
    <link rel="import" href="bower_components/neon-animation/neon-animated-pages.html">
    <link rel="import" href="bower_components/neon-animation/neon-animatable.html">
    <link rel="import" href="bower_components/font-roboto/roboto.html">
    <link rel="import" href="element/business-home.html">
    <link rel="import" href="element/business-add-printer.html">

    <script src="bower_components/webcomponentsjs/webcomponents-lite.js"></script>
    <style>
      body {
        font-family: Roboto;
      }
      paper-drawer-panel [main]{
        color: #000000;
      }
      paper-drawer-panel [drawer]{
        background-color: #22A7F0;
        color: white;
      }
    </style>
  </head>

  <body class="fullbleed vertical layout">
    <template is="dom-bind" id="app">
      <paper-drawer-panel class="flex">
        <paper-header-panel drawer>
          <paper-toolbar drawer>
            <div>AnyPrint</div>
          </paper-toolbar>
          <paper-menu selected={{select}} drawer>
            <paper-item>Home Page</paper-item>
            <paper-item>Add Printer</paper-item>
            <paper-item>Pending Print Request</paper-item>
            <paper-item>Manage Printer</paper-item>
            <p>{{select}}</p>
          </paper-menu>
        </paper-header-panel>
        <paper-header-panel main>
          <paper-toolbar>
            <paper-icon-button icon="menu" paper-drawer-toggle></paper-icon-button>
            <div>Welcome back</div>
          </paper-toolbar>
          <neon-animated-pages selected="{{select}}">
            <business-home user-id="400001"></business-home>
            <business-add-printer id='add-printer-page'></business-add-printer>
            <neon-animation><?php echo $_SESSION['access_token']; ?></neon-animation>
            <neon-animation>Manage Printer</neon-animation>
          </neon-animated-pages>
        </paper-header-panel>
      </paper-drawer-panel>
    </template>
  </body>

  <script>
    //When the element is finished loaded, set the login based on the attribute
    document.addEventListener('finished_attached', function() {
      //Testing purpose
      console.log('Loaded');
      if(validToken){
        document.querySelector('#add-printer-page').usableToken = true;
      } else{
        document.querySelector('#add-printer-page').usableToken = false;
      }
    }, false);
  </script>
</html>
