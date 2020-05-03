<?php
    require_once '../api/connect.php';

    date_default_timezone_set("Asia/Bangkok");
    $date_yesterday=date("Y-m-d", strtotime("yesterday")); 

    $data = $_POST["edit"];
    $location = $_POST["location"];
    $dateBalance = $_POST["dateBalance"];

    //$sql="SELECT * FROM balance_carry WHERE locationNo='$location' ORDER BY balanceDate DESC LIMIT 1";
    $sql="SELECT * FROM balance_carry WHERE locationNo = '$location' AND balanceDate='$dateBalance'";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($query);
    $data_sql=mysqli_fetch_array($query);

    $date_old=$data_sql["balanceDate"];

    $sql_up="UPDATE balance_carry SET balance='$data' WHERE locationNo='$location' AND balanceDate='$date_old' ";
    $query_up=mysqli_query($conn,$sql_up);
    if(!$query_up){
        echo "Not Query";
        exit();
    }
    
?>