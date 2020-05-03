<?php
    require_once '../api/connect.php';
    if(isset($_POST["typeNo"])){
        $typeNo = $_POST["typeNo"];
        $type = $_POST["type"];
        $sql = "UPDATE type SET type='$type' WHERE typeNo='$typeNo'";
        $query = mysqli_query($conn,$sql);
        if(!$query){
            echo "Not Query";
            exit();
        }
    }
?>