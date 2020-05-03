<?php
    require_once '../api/connect.php';
    if(isset($_POST["millNo"])){
        $millNo = $_POST["millNo"];
        $mill = $_POST["mill"];
        $sql = "UPDATE mill SET mill='$mill' WHERE millNo='$millNo'";
        $query = mysqli_query($conn,$sql);
        if(!$query){
            echo "Not Query";
            exit();
        }
    }
?>