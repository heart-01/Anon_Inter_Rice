<?php
    require_once '../api/connect.php';
    if(isset($_POST["locationNo"])){
        $locationNo = $_POST["locationNo"];
        $location = $_POST["location"];
        $sql = "UPDATE location SET location='$location' WHERE locationNo='$locationNo'";
        $query = mysqli_query($conn,$sql);
        if(!$query){
            echo "Not Query";
            exit();
        }
    }
?>