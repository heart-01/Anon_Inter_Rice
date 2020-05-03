<?php
    require_once '../api/connect.php';

    $date=$_POST["date"];
    $location=$_POST["location"];
    $type=$_POST["type"];
    $purchase=$_POST["purchase"];
    $total=$_POST["total"];
    $service=$_POST["service"];
    $average=$_POST["average"];
    $income=$_POST["income"];
    $interest=$_POST["interest"];
    $withdraw=$_POST["withdraw"];
    $note=$_POST["note"];

    $qty_input=$_POST["qty_input"];
    
    date_default_timezone_set("Asia/Bangkok");
    $date_now=date("Y-m-d H:i:s");
    $date_yesterday=date("Y-m-d", strtotime("yesterday")); 

    if(empty($purchase[0]) && empty($total[0]) && empty($service[0]) && empty($average[0]) && empty($income[0]) && empty($interest[0]) && empty($withdraw[0]) && empty($note[0]) ){          
        echo "Empty";
        exit();
    }

    for($i=1;$i<=$qty_input;$i++){
        ${"vehicle$i"} = "";
        ${"count$i"} = "";
    }
    if(isset($_POST["1"])){
        $vehicle1 = $_POST["1"];
        $count1 = count($vehicle1);
    }
    if(isset($_POST["2"])){
        $vehicle2 = $_POST["2"];
        $count2 = count($vehicle2);
    }
    if(isset($_POST["3"])){
        $vehicle3 = $_POST["3"];
        $count3 = count($vehicle3);
    }
    if(isset($_POST["4"])){
        $vehicle4 = $_POST["4"];
        $count4 = count($vehicle4);
    }
    if(isset($_POST["5"])){
        $vehicle5 = $_POST["5"];
        $count5 = count($vehicle5);
    }
    if(isset($_POST["6"])){
        $vehicle6 = $_POST["6"];
        $count6 = count($vehicle6);
    }
    if(isset($_POST["7"])){
        $vehicle7 = $_POST["7"];
        $count7 = count($vehicle7);
    }
    if(isset($_POST["8"])){
        $vehicle8 = $_POST["8"];
        $count8 = count($vehicle8);
    }
    if(isset($_POST["9"])){
        $vehicle9 = $_POST["9"];
        $count9 = count($vehicle9);
    }
    if(isset($_POST["10"])){
        $vehicle10 = $_POST["10"];
        $count10 = count($vehicle10);
    }

    $sql="";

    for($i=0;$i<$qty_input;$i++)
	{ 
        if($purchase[$i]==""){
            $purchase[$i]=0;
        }
        if($total[$i]==""){
            $total[$i]=0;
        }
        if($service[$i]==""){
            $service[$i]=0;
        }
        if($average[$i]==""){
            $average[$i]=0;
        }
        if($income[$i]==""){
            $income[$i]=0;
        }
        if($interest[$i]==""){
            $interest[$i]=0;
        }
        if($withdraw[$i]==""){
            $withdraw[$i]=0;
        }

        if(preg_match('/[\'^£$&()}{@#~?><>,|=_¬;]/', $note[$i]))
        {
            echo "Not straight";
            exit();
        }else{
            if(empty($purchase[$i]) && empty($total[$i]) && empty($service[$i]) && empty($average[$i]) && empty($income[$i]) && empty($interest[$i]) && empty($withdraw[$i]) && empty($note[$i]) ){          
                break;
            }else{

                //ID rice_account
                $sql_riceAcc = "SELECT MAX(accountNo) AS riceAcc FROM rice_account";
                $query_riceAcc = mysqli_query($conn,$sql_riceAcc);
                $data_riceAcc = mysqli_fetch_array($query_riceAcc);
                $riceAcc_Max = $data_riceAcc["riceAcc"];
                $riceAcc="";
                if(empty($riceAcc_Max)){
                    $riceAcc = "1";
                }else{
                    $riceAcc = $riceAcc_Max+1;
                }

                $num = $i+1;
                for($j=0;$j<${"count$num"};$j++){
                    $vehicleID = ${"vehicle$num"}[$j];  
                    $sql_addVehicleAcc="INSERT INTO vehicle_account(vehicleNo,accountNo,weight,millNo,destination,scale,sell,round) VALUES ($vehicleID,$riceAcc,'','1',0,0,0,'1')";
                    $query_addVehicleAcc = mysqli_query($conn,$sql_addVehicleAcc);

                    if(!$query_addVehicleAcc){
                        echo "Not Query";
                        exit();
                    }

                }
                
                if($location[$i]=="noData"){
                    $location[$i]="1";
                }
                if($type[$i]=="noData"){
                    $type[$i]="1";
                }

                $sql="INSERT INTO rice_account(accountNo,dated,datePost,locationNo,typeNo,purchase,total,service,average,income,interest,withdraw,note) VALUES ('$riceAcc','$date[$i]','$date_now','$location[$i]','$type[$i]','$purchase[$i]','$total[$i]','$service[$i]','$average[$i]','$income[$i]','$interest[$i]','$withdraw[$i]','$note[$i]')"; 
    
                $query = mysqli_query($conn,$sql);
                if(!$query){
                    echo "Not Query";
                    exit();
                }
                
            }
        }
    }
    
    
?>