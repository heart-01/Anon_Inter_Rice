<?php
/*$conn=mysqli_connect("localhost:3306","stwn_7749","Aszx1221","anon_inter_rice");
if(!$conn)
{
    echo "Failed to connect to MySQL: >";
    exit();
}
mysqli_set_charset($conn, "utf8");*/

require_once '../api/connect.php';

date_default_timezone_set("Asia/Bangkok");
$date=date("Y-m-d");
$date_Time=date("Y-m-d H:i:s");

$date_yesterday=date("Y-m-d", strtotime("yesterday")); 

$sql = "SELECT * FROM rice_account r,location l,type t WHERE r.locationNo = l.locationNo AND r.typeNo = t.typeNo AND r.datePost LIKE'$date%' ORDER BY r.dated , r.accountNo";
$query = mysqli_query($conn,$sql);
$row = mysqli_num_rows($query);

function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>
<figure class="highlight">
    <div class="table-responsive-xl">    
        <pre style="font-family: kanit;">
            <table class="table table-bordered table-hover table-striped">
            <thead class="thead">
                <tr class="table-active">
                    <th scope="col" >วันที่</th>
                    <th scope="col" >เลขที่</th>
                    <th scope="col" >ลานตัก</th>
                    <th scope="col" >ชนิดข้าว</th>
                    <th scope="col" >นน.เข้า</th>
                    <th scope="col" >เงินซื้อข้าว</th>
                    <th scope="col" >ค่าบริการ</th>
                    <th scope="col" >เฉลี่ย</th>
                    <th scope="col" >เงินเข้า</th>
                    <th scope="col" >ดอกเบี้ย</th>
                    <th scope="col" >เบิก</th>
                    <th scope="col" >หมายเหตุ</th>
                    <th scope="col" >เงินคงเหลือ</th>
                    <th scope="col" >ทะเบียนรถ</th>
                    <th scope="col" >นน.ตักออก</th>
                    <th scope="col" >โรงสีปลายทาง</th>
                    <th scope="col" >นน.ปลายทาง</th>
                    <th scope="col" >นน.ขาด</th>
                    <th scope="col" >ค่าชั่ง</th>
                    <th scope="col" >ราคาขาย</th>
                    <th scope="col" >จำนวนเงิน</th>
                </tr>
            </thead>
            <tbody>
            <?php     
               $sql_lap="SELECT * FROM location WHERE locationNo!=1";
               $query_lap=mysqli_query($conn,$sql_lap);
               $row_lap=mysqli_num_rows($query_lap);  
               for($i=0;$i<$row_lap;$i++) {
                    $data_lap = mysqli_fetch_array($query_lap);
                    $lapNo=$data_lap["locationNo"];
                    ${"lap$lapNo"} = 0;
                    ${"sta$lapNo"} = 0;
               }       

                for($i=0;$i<$row;$i++){
                    $data = mysqli_fetch_array($query);
                    $accountNo = $data["accountNo"];
            ?>
                <tr>
                    <td><?php echo DateThai($data["dated"]) ?></td>
                    <td><?php echo $data["accountNo"]; ?></td>
                    <td><?php if($data["location"]=="noData"){echo "";}else{echo $data["location"];}?></td>
                    <td><?php if($data["type"]=="noData"){echo "";}else{echo $data["type"];}?></td>
                    <td><?php echo number_format($data["purchase"],2); ?></td>
                    <td><?php echo number_format($data["total"],2); ?></td>
                    <td><?php echo number_format($data["service"],2); ?></td>
                    <td><?php echo number_format($data["average"],2); ?></td>
                    <td><?php echo number_format($data["income"],2); ?></td>
                    <td><?php echo number_format($data["interest"],2); ?></td>
                    <td><?php echo number_format($data["withdraw"],2); ?></td>
                    <td><?php echo $data["note"]; ?></td>
                    <td><?php echo $data["balance"]; ?></td>
                    
                    <td><?php
                        $sql_vehicle_account="SELECT * FROM vehicle_account va, vehicle v WHERE va.accountNo = $accountNo AND va.vehicleNo = v.vehicleNo";
                        $query_vehicle_account=mysqli_query($conn,$sql_vehicle_account);
                        $row_vehicle_account=mysqli_num_rows($query_vehicle_account);
                        $scoop=0;
                        $destination=0;
                        $sell=0;
                        $scale=0;
                        $last=$row_vehicle_account-1;
                        for($j=0;$j<$row_vehicle_account;$j++){
                            $data_vehicle_account=mysqli_fetch_array($query_vehicle_account);
                            if($last==$j){
                                echo $data_vehicle_account["vehicle"];
                            }else{
                                echo $data_vehicle_account["vehicle"]." , ";
                            }
                            $weight=$data_vehicle_account["weight"];    
                            if($weight!=""){
                                $w=(int)$data_vehicle_account["weight"];
                                $scoop=$scoop+$w;
                            }
                            $weight_out=$data_vehicle_account["destination"];
                            if($weight_out!=""){
                                $d=(int)$data_vehicle_account["destination"];
                                $destination=$destination+$d;
                            }  
                            $sellData=$data_vehicle_account["sell"];
                            if($sellData!=""){
                                $s=(int)$data_vehicle_account["sell"];
                                $sell=$sell+$s;
                            } 
                            $scaleData=$data_vehicle_account["scale"];
                            if($scaleData!=""){
                                $sc=(int)$data_vehicle_account["scale"];
                                $scale=$scale+$sc;
                            }   
                        }
                    ?></td>
                    <td><?php echo $scoop; ?></td>
                    <td><?php 
                            $sql_mill="SELECT * FROM vehicle_account va, mill m WHERE va.accountNo = $accountNo AND va.millNo = m.millNo";
                            $query_mill=mysqli_query($conn,$sql_mill);
                            $row_mill=mysqli_num_rows($query_mill);
                            $lst=$row_mill-1;
                            for($k=0;$k<$row_mill;$k++){
                                $data_mill=mysqli_fetch_array($query_mill);
                                if($data_mill["mill"]!="noData"){
                                    echo $data_mill["mill"]." ";
                                }
                            }
                    ?></td>
                    <td><?php echo $destination; ?></td>
                    <td><?php echo ($scoop)-($destination) ?></td>
                    <td><?php echo $scale; ?></td>
                    <td><?php echo $sell; ?></td>
                    <td><?php echo number_format( (($destination*$sell/1000))-$scale ,2); ?></td>
                </tr>
            <?php
                }
            ?>
            </tbody>
            </table>
        
        </pre>
    </div>          
</figure>

</body>
