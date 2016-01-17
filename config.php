 <?php
	$hostname = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$database = "anyprint";

	//connect to Myqsl
	$dbcon = mysqli_connect($hostname,$dbusername,$dbpassword,$database) or die("ERROR: Could not connect to the database.");
	//connect to gaming galaxy database

?>
