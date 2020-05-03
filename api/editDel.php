<?php
    require_once '../api/connect.php';
    if(isset($_POST["accountNo"])){
        $accountNo = $_POST["accountNo"];
        $sql = "DELETE FROM rice_account WHERE accountNo='$accountNo'";
        $query = mysqli_query($conn,$sql);
        
        if(!$query){
            echo "Not Query";
            exit();
        }else{
            $sql_vehicle_account = "DELETE FROM vehicle_account WHERE accountNo = '$accountNo'";
            $query_vehicle_account = mysqli_query($conn,$sql_vehicle_account);
            
            if(!$query_vehicle_account){
                echo "Not Query";
                exit();
            }
        }
    }
?>