<?php
    require_once '../api/connect.php';
    $acc=$_POST["acc"];
    $idVeh=$_POST["idVeh"];
    $dataVeh=$_POST["dataVeh"];
    $dataDes=$_POST["dataDes"];
    $dataScale=$_POST["dataScale"];
    $dataSell=$_POST["dataSell"];
    $millNo=$_POST["mill"];
    $dataRound=$_POST["dataRound"];
    
    $idCount = count($idVeh);

    for($i=0;$i<$idCount;$i++){
        if($dataSell[$i]==""){
            $dataSell[$i]=0;
        }
        if($dataScale[$i]==""){
            $dataScale[$i]=0;
        }

        if( empty($dataVeh[$i]) && empty($dataDes[$i]) && $dataScale[$i]==0 && $dataSell[$i]==0 && $millNo[$i]==1 ){
            $sql_Del = "DELETE FROM vehicle_account WHERE accountNo = '$acc' AND vehicleNo='$idVeh[$i]' AND round='$dataRound[$i]'";
            $query=mysqli_query($conn,$sql_Del);
            if(!$query){
                echo "Not Query";
                exit();
            }
        }else{
            
            $sql="UPDATE vehicle_account SET weight='$dataVeh[$i]', destination='$dataDes[$i]', scale='$dataScale[$i]', sell='$dataSell[$i]', millNo='$millNo[$i]' WHERE vehicleNo='$idVeh[$i]' AND accountNo='$acc' AND round='$dataRound[$i]'";
            $query=mysqli_query($conn,$sql);
            if(!$query){
                echo "Not Query";
                exit();
            }

        }
    }
?>