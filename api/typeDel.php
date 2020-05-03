<?php
    require_once '../api/connect.php';
    if(isset($_POST["typeNo"])){
        $typeNo = $_POST["typeNo"];

        $sql_Ck = "SELECT typeNo FROM rice_account WHERE typeNo='$typeNo' LIMIT 0,1";
        $query_Ck  = mysqli_query($conn,$sql_Ck);
        $row_Ck = mysqli_num_rows($query_Ck);

        if($row_Ck==1){
            echo "Have Data";
            exit();
        }else{
            $sql = "DELETE FROM type WHERE typeNo='$typeNo'";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }
        }

        
    }
?>