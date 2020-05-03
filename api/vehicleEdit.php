<?php
    require_once '../api/connect.php';
    if(isset($_POST["vehicleNo"])){
        $vehicleNo = $_POST["vehicleNo"];
        $vehicle = $_POST["vehicle"];
        $sql = "UPDATE vehicle SET vehicle='$vehicle' WHERE vehicleNo='$vehicleNo'";
        $query = mysqli_query($conn,$sql);
        if(!$query){
            echo "Not Query";
            exit();
        }
    }
?>