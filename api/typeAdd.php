<?php
    require_once '../api/connect.php';
    if(isset($_POST["type"])){
        $type = $_POST["type"];

        $sql_ck="SELECT type FROM type WHERE type = '$type'";
        $query_ck=mysqli_query($conn,$sql_ck);
        $row_ck=mysqli_num_rows($query_ck);

        if($row_ck==0){
            $sql = "INSERT INTO type(type) VALUES ('$type')";
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