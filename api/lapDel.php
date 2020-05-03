<?php
    require_once '../api/connect.php';
    if(isset($_POST["locationNo"])){
        $locationNo = $_POST["locationNo"];

        $sql_Ck = "SELECT locationNo FROM rice_account WHERE locationNo='$locationNo' LIMIT 0,1";
        $query_Ck  = mysqli_query($conn,$sql_Ck);
        $row_Ck = mysqli_num_rows($query_Ck);

        if($row_Ck==1){
            echo "Have Data";
            exit();
        }else{

            $sql = "DELETE FROM location WHERE locationNo='$locationNo'";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }

            $sql_ba = "DELETE FROM balance_carry WHERE locationNo='$locationNo'";
            $query_ba = mysqli_query($conn,$sql_ba);
            if(!$query_ba){
                echo "Not Query";
                exit();
            }

        }
    }
?>