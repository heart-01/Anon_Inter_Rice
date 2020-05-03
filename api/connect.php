<?php
    $conn=mysqli_connect("localhost","root","12345678","anon inter rice");
	if(!$conn)
	{
		echo "Failed to connect to MySQL: >";
		exit();
	}
	mysqli_set_charset($conn, "utf8")
?>