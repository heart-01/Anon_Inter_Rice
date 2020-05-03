<?php
    require_once '../api/connect.php';
    
    $data_add = $_POST["add"];
    $location = $_POST["location"];
    $dateBalance = $_POST["dateBalance"];

    date_default_timezone_set("Asia/Bangkok");
    //$date_yesterday=date("Y-m-d", strtotime("yesterday")); 

    $sql="SELECT * FROM balance_carry WHERE locationNo = '$location' AND balanceDate='$dateBalance'";
    //$sql="SELECT * FROM balance_carry WHERE locationNo='$location' ORDER BY balanceDate DESC LIMIT 1";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($query);
    $data=mysqli_fetch_array($query);

    if(!$query){
        echo "Not Query";
        exit();
    }

    if($row==0){
        $sql_add="INSERT INTO balance_carry(locationNo,balance,balanceDate) VALUES ('$location','$data_add','$dateBalance')";
        $query_add=mysqli_query($conn,$sql_add);
        if(!$query_add){
            echo "Not Query";
            exit();
        }
    }else{
        $balance=$data["balance"];
        $date_old=$data["balanceDate"];
        
        $sum=$balance+$data_add;
        $sql_up="UPDATE balance_carry SET balance='$sum' WHERE locationNo='$location' AND balanceDate='$date_old'";
        $query_up=mysqli_query($conn,$sql_up);
        if(!$query_up){
            echo "Not Query";
            exit();
        }
    }
?>