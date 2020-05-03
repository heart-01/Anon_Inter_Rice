<?php
    require_once '../api/connect.php';
    if(isset($_POST["mill"])){
        $mill = $_POST["mill"];

        $sql_ck="SELECT mill FROM mill WHERE mill = '$mill'";
        $query_ck=mysqli_query($conn,$sql_ck);
        $row_ck=mysqli_num_rows($query_ck);

        if($row_ck==0){
            $sql = "INSERT INTO mill(mill) VALUES ('$mill')";
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