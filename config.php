 <?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "anyprint";

	//connect to Myqsl
	$dbcon = mysqli_connect($hostname,$username,$password,$database) or die("ERROR: Could not connect to the database.");
	//connect to gaming galaxy database

?>
