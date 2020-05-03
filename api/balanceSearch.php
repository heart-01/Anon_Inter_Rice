<?php
    require_once '../api/connect.php';

    date_default_timezone_set("Asia/Bangkok");
     
    $location = $_POST["location"];
    $dateBalance = $_POST["dateBalance"];
    $sql="SELECT * FROM balance_carry WHERE locationNo = '$location' AND balanceDate='$dateBalance'";
    //$sql="SELECT * FROM balance_carry WHERE locationNo='$location' ORDER BY balanceDate DESC LIMIT 1";
    $query=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($query);
    $data=mysqli_fetch_array($query);
    if($row==0){
        echo "No";
    }else{
        echo $data["balance"];
    }
?>