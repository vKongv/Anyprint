 <?php
	$hostname = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$database = "anyprint";

	//connect to Myqsl
	$dbcon = mysqli_connect($hostname,$dbusername,$dbpassword,$database) or die("ERROR: Could not connect to the database.");
	//connect to anyprint database
  $acceptTypes = array(
    'docx',
    'doc',
    'rtf',
    'ppt',
    'pptx',
    'pdf',
    'jpg',
    'png'
  );
?>
