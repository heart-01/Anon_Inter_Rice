<?php
    require_once '../api/connect.php';
    if(isset($_POST["vehicleNo"])){
        $vehicleNo = $_POST["vehicleNo"];

        $sql_Ck = "SELECT vehicleNo FROM vehicle_account WHERE vehicleNo = '$vehicleNo' LIMIT 0,1";
        $query_Ck  = mysqli_query($conn,$sql_Ck);
        $row_Ck = mysqli_num_rows($query_Ck);

        if($row_Ck==1){
            echo "Have Data";
            exit();
        }else{
            $sql = "DELETE FROM vehicle WHERE vehicleNo='$vehicleNo'";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }
        }

        
    }
?>