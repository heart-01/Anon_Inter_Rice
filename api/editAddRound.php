<?php

    if(isset($_POST["idVehicle"])){

        require_once '../api/connect.php';

        $accountNo = $_POST["accountNo"];
        $idVehicle = $_POST["idVehicle"];

        $sql_countRound = "SELECT * FROM vehicle_account WHERE accountNo=$accountNo AND vehicleNo=$idVehicle ORDER BY round DESC LIMIT 1";
        $query_countRound = mysqli_query($conn,$sql_countRound);
        $data_countRound = mysqli_fetch_array($query_countRound);
        $round = $data_countRound["round"]+1;
        
        $sql_addVehicleAcc="INSERT INTO vehicle_account(vehicleNo,accountNo,weight,millNo,destination,scale,sell,round) VALUES ($idVehicle,$accountNo,'','1','',0,0,'$round')";
        $query_addVehicleAcc = mysqli_query($conn,$sql_addVehicleAcc);
        if(!$query_addVehicleAcc){
            echo "Not Query";
            exit();
        }

        $sql_vehWeg="SELECT * FROM vehicle_account va,vehicle v WHERE va.accountNo='$accountNo' AND va.vehicleNo='$idVehicle' AND va.round='$round' AND va.vehicleNo = v.vehicleNo";
        $query_vehWeg=mysqli_query($conn,$sql_vehWeg);
        $data_vehWeg=mysqli_fetch_array($query_vehWeg);

        $idVehicle_new = $data_vehWeg['vehicleNo'];
        $dataVehicle_new = $data_vehWeg['vehicle'];
        $wegVehicle_new = $data_vehWeg['weight'];
        $desVehicle_new = $data_vehWeg['destination'];
        $scaVehicle_new = $data_vehWeg['scale'];
        $sellVehicle_new = $data_vehWeg['sell'];
        $round_new = $data_vehWeg['round'];

        echo "<tr>";
        echo "<td></td>";
        echo "<td><input type='hidden' name='dataRound[]' value='$round_new' placeholder='$round_new'>
        <input type='hidden' name='idVeh[]' value='$idVehicle_new' placeholder='$idVehicle_new'>$dataVehicle_new</td>";
        echo "<td><input type='number' class='input-no-spinner' name='dataVeh[]' style='width:120px;' placeholder='$dataVehicle_new' value='$wegVehicle_new'></td>";
        echo "<td><input type='number' class='input-no-spinner' name='dataDes[]' style='width:120px;' placeholder='$dataVehicle_new' value='$desVehicle_new'></td>";
        echo "<td><input type='number' class='input-no-spinner' name='dataScale[]' style='width:120px;' placeholder='$dataVehicle_new' value='$scaVehicle_new'></td>";
        echo "<td><input type='number' class='input-no-spinner' name='dataSell[]' style='width:120px;' placeholder='$dataVehicle_new' value='$sellVehicle_new'></td>";
        echo "<td>";
            echo "<select class='form-control form-control-sm mill' name='mill[]'>";
                    //millAll
                    $sql_mill="SELECT * FROM mill";
                    $query_mill=mysqli_query($conn,$sql_mill);
                    $row_mill=mysqli_num_rows($query_mill);

                    //Select Old
                    $sql_millOld="SELECT * FROM vehicle_account va, mill m WHERE va.millNo=m.millNo AND va.accountNo='$accountNo' AND va.vehicleNo='$idVehicle_new' AND va.round='$round_new' ";
                    $query_millOld=mysqli_query($conn,$sql_millOld);
                    $data_millOld=mysqli_fetch_array($query_millOld);
                    $millNo_old=$data_millOld["millNo"];

                    for($i=0;$i<$row_mill;$i++){
                        $data_mill=mysqli_fetch_array($query_mill);
                        $millNo = $data_mill["millNo"];
                        $mill = $data_mill["mill"];
                        if($millNo_old==$millNo){
                            if($millNo!="1"){
                                echo "<option value='$millNo' selected>$mill</option>";
                            }else{
                                echo "<option value='1' selected>---</option>";
                            }
                        }else if($mill!="noData"){
                            echo "<option value='$millNo'>$mill</option>";
                        }
                    }
            echo "</select> ";
            echo "</td>";
        echo "</tr>";

    }

?>