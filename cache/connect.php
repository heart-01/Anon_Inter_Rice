<?php
    $conn=mysqli_connect("localhost:3306","stwn_7749","Aszx1221","anon_inter_rice");
	if(!$conn)
	{
		echo "Failed to connect to MySQL: >";
		exit();
	}
	mysqli_set_charset($conn, "utf8");
?>