<?php
    if(!isset($_POST["user"])){
        echo "<script>alert('not use');window.location.href='../page/index';</script>";
        exit();
    }
    session_start();
    require_once './connect.php';

    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $pass_md5 = md5($_POST["pass"]);

	include("connect.php");
	
	$sql = "SELECT * FROM staff WHERE username = '$user' AND password = '$pass_md5' ";
	$query = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($query);
	
	if($row == 1)
	{
		$data = mysqli_fetch_array($query);
		$_SESSION["staffNo"] = $data["staffNo"];
		$_SESSION["username"] = $data["username"];	
        $_SESSION["status"] = $data["positionNo"];
        echo "1";
	}else{
		echo "2";
	}
?>