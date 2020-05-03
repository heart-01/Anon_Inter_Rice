<?php
    require_once '../api/connect.php';
    if(isset($_POST["vehicle"])){
        $vehicle = $_POST["vehicle"];

        $sql_ck="SELECT vehicle FROM vehicle WHERE vehicle = '$vehicle'";
        $query_ck=mysqli_query($conn,$sql_ck);
        $row_ck=mysqli_num_rows($query_ck);

        if($row_ck==0){
            $sql = "INSERT INTO vehicle(vehicle) VALUES ('$vehicle')";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }
        }else{
            echo "Duplicate";
        }
    }
?>