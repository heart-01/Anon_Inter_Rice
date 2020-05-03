<?php
    require_once '../api/connect.php';
    if(isset($_POST["millNo"])){
        $millNo = $_POST["millNo"];

        $sql_Ck = "SELECT millNo FROM rice_account WHERE millNo='$millNo' LIMIT 0,1";
        $query_Ck  = mysqli_query($conn,$sql_Ck);
        $row_Ck = mysqli_num_rows($query_Ck);

        if($row_Ck==1){
            echo "Have Data";
            exit();
        }else{

            $sql = "DELETE FROM mill WHERE millNo='$millNo'";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }

        }
    }
?>