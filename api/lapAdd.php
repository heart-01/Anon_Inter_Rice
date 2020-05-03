<?php
    require_once '../api/connect.php';
    if(isset($_POST["location"])){
        $location = $_POST["location"];

        $sql_ck="SELECT location FROM location WHERE location = '$location'";
        $query_ck=mysqli_query($conn,$sql_ck);
        $row_ck=mysqli_num_rows($query_ck);

        if($row_ck==0){
            $sql = "INSERT INTO location(location) VALUES ('$location')";
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