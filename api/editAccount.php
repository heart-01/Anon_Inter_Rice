<?php
    require_once '../api/connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $date_yesterday=date("Y-m-d", strtotime("yesterday")); 
    $date=date("Y-m-d");
    $date_now=date("Y-m-d H:i:s");

    $accountNo=$_POST["accountNo"];
    $dated=$_POST["date"];
    $datePost=$_POST["datePost"];
    $datePost_sub = substr($datePost,0,10);
    $location=$_POST["location"];
    $type=$_POST["type"];
    $purchase=$_POST["purchase"];
    $total=$_POST["total"];
    $service=$_POST["service"];
    $average=$_POST["average"];
    $income_old=$_POST["income_old"];
    $income=$_POST["income"];
    $interest=$_POST["interest"];
    $withdraw=$_POST["withdraw"];
    $note=$_POST["note"];
    $status=$_POST["status"];

    $sta_ve="0";
    if(isset($_POST["1"])){
        $vehicle = $_POST["1"];
        $count = count($vehicle);
        $sta_ve="1";
    }

    if($purchase==""){
        $purchase=0;
    }
    if($total==""){
        $total=0;
    }
    if($service==""){
        $service=0;
    }
    if($average==""){
        $average=0;
    }
    if($income==""){
        $income=0;
    }
    if($income_old==""){
        $income_old=0;
    }
    if($interest==""){
        $interest=0;
    }
    if($withdraw==""){
        $withdraw=0;
    }

    if(preg_match('/[\'^£$&()}{@#~?><>,|=_¬;]/', $note))
    {
        echo "Not straight";
        exit();
    }else{

        if($status=="1"){
            $sql_vehicle_account = "DELETE FROM vehicle_account WHERE accountNo = '$accountNo'";
            $query_vehicle_account = mysqli_query($conn,$sql_vehicle_account);

            if(!$query_vehicle_account){
                echo "Not Query";
                exit();
            }else{
                if($sta_ve==1){
                    for($i=0;$i<$count;$i++){
                        $vehicleID = $vehicle[$i];  
                        $sql_addVehicleAcc="INSERT INTO vehicle_account(vehicleNo,accountNo,weight,millNo,destination,scale,sell,round) VALUES ($vehicleID,$accountNo,'','1','',0,0,'1')";
                        $query_addVehicleAcc = mysqli_query($conn,$sql_addVehicleAcc);

                        if(!$query_addVehicleAcc){
                            echo "Not Query";
                            exit();
                        }

                        //เช็คค่าซ้ำ
                        $sql_duplicate = "SELECT * FROM vehicle_account WHERE accountNo = '$accountNo' AND vehicleNo='$vehicleID'";
                        $query_duplicate  = mysqli_query($conn,$sql_duplicate);
                        $row_duplicate = mysqli_num_rows($query_duplicate);
                        if($row_duplicate>=2){
                            $sql_vehicle_account = "DELETE FROM vehicle_account WHERE accountNo = '$accountNo' AND vehicleNo='$vehicleID' ORDER BY vehicleAcc DESC LIMIT 1";
                            $query_vehicle_account = mysqli_query($conn,$sql_vehicle_account);
                        }
                        
                    }
                }
            }
        }

            $sql="UPDATE rice_account SET dated='$dated', locationNo='$location', typeNo='$type', purchase='$purchase', total='$total', service='$service', average='$average', income='$income', interest='$interest', withdraw='$withdraw', note='$note' WHERE accountNo='$accountNo'";
            $query = mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }

            if($date!=$datePost_sub){
                $result=$income-$income_old;
                $sql_balance="";
                if($result!=0){
                    if($result>0){
                        $sql_balance="UPDATE balance_carry SET balance=balance+$result , balanceDate='$date_now'  WHERE balanceDate >= '$dated' AND locationNo = '$location'";
                        //echo "<script>console.log('$result>0 = '$sql_balance);</script>";
                    }else if($result<0){
                        $sql_balance="UPDATE balance_carry SET balance=balance+$result , balanceDate='$date_now' WHERE balanceDate >= '$dated' AND locationNo = '$location'";
                        //echo "<script>console.log('$result<0 = '$sql_balance);</script>";
                    }
                    $query_balance = mysqli_query($conn,$sql_balance);
                    if(!$query_balance){
                        echo "Not Query";
                        exit();
                    }
                }
            }
    }
?>