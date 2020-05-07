<?php
    if(isset($_POST["date"])){        

        require_once '../api/connect.php';

        $pf=0;
        $pl=8;

        if(isset($_POST["pf"])){  
            $pf=$_POST["pf"];
            $pl=$_POST["pl"];
        }

        $inputDate = $_POST["date"];
        $d = substr($inputDate,0,2);
        $m = substr($inputDate,3,2);
        $y = substr($inputDate,6);
        $date = $y."-".$m."-".$d;

        $sql_count="SELECT accountNo FROM rice_account WHERE dated LIKE'$date%'";
        $query_count=mysqli_query($conn,$sql_count);
        $row_count=mysqli_num_rows($query_count);

        $sql = "SELECT * FROM rice_account,location,type WHERE rice_account.locationNo=location.locationNo AND rice_account.typeNo=type.typeNo AND rice_account.dated LIKE'$date%' ORDER BY rice_account.accountNo LIMIT 8 OFFSET $pf";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_num_rows($query);
        $page=ceil($row_count/8);
?>
        <input id="inputDate" type="hidden" value="<?php echo $inputDate; ?>" />

        <div class="col-md-12" style="margin-top: 20px;">
            <p class="text-success" ><i class="fas fa-info-circle"></i> มีข้อมูลทั้งหมด <?php echo "$row_count"; ?> รายการ </p>
        </div>
      
        <figure class="highlight">
        <div class="table-responsive-xl">    
            <pre style="font-family: kanit;">
                <table class="table table-bordered table-hover table-striped">
                <thead class="thead">
                    <tr class="table-active">
                        <th scope="col" >Action</th>
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
                        <th scope="col" >ค่าชั่ง</th>
                        <th scope="col" >ราคาขาย</th>
                    </tr>
                </thead>
                <tbody>
                <?php                                
                    for($i=0;$i<$row;$i++){
                        $data = mysqli_fetch_array($query);
                        $accountNo = $data["accountNo"];
                ?>
                    <tr>
                        <td class="table-light"><button type="button" id="<?php echo $data["accountNo"]; ?>" class="btn btn-warning text-white btn-sm btnEdit"><i class="far fa-edit"></i> แก้ไข</button> <button type="button" class="btn btn-danger text-white btn-sm btnDel" data-toggle="modal" data-target="#delData" id="<?php echo "id".$data["accountNo"]; ?>" ><i class="fas fa-trash-alt"></i> ลบ</button></td>
                        <td class="table-active" ><?php echo $data["accountNo"]; ?></td>
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
                        <td><?php echo number_format($scoop, 2); ?></td>
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
                        <td><?php echo $scale; ?></td>
                        <td><?php echo $sell; ?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
                </table>

                <?php
                    $first_post = 0;
                    $last_post = 8;
                    if($page!=0){
                        echo "<div class='text-center col-sm-12'><p style='font-size:18px;'><i class='fas fa-book-open'></i> หน้าที่ ";
                    }  
                    for($p=1;$p<=$page;$p++)
                    {
                        echo "<a href='./editAccount?pf=$first_post&pl=$last_post' id='$first_post' name='$last_post' class='Lpage'>" . $p . "</a>";  if($p!=$page){echo " , ";}
                        $first_post=$first_post+8;
                        $last_post=$last_post+8;
                    }	
                    echo " </p></div>";
                ?>
            
            </pre>
        </div>          
        </figure>
        
<?php        
    }
?>
<!-- modal del -->
<div id="showDel"></div>

<!-- modal success -->
<div class="modal fade" tabindex="-1" role="dialog" id="success" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="swal2-icon swal2-success swal2-animate-success-icon"  style="display: flex;">
            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
            <span class="swal2-success-line-tip"></span>
            <span class="swal2-success-line-long"></span>
            <div class="swal2-success-ring"></div> 
            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
        </div>
    </div>
  </div>
</div>

<!-- modal error -->
<div class="modal fade" tabindex="-1" role="dialog" id="error" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
    </div>
  </div>
</div>

<script>
		
	$(".Lpage").click(function(){
		var inputDate = $("#inputDate").val();
		var first_post = $(this).attr('id');
        var last_post = $(this).attr('name');
		var url = "../api/editAccSearch.php";
		var data_set = { date : inputDate , pf : first_post , pl : last_post };
		$.post(url,data_set,function(data){
			$("#listAcc").html(data);
            //console.log(data);
		});
		return false;
	});

    $(".btnEdit").click(function(){
        var accountNo = $(this).attr('id');
		var url ="../api/editAccShow.php";
		var data_set = { accountNo : accountNo};
		$.post(url,data_set,function(data){ 
			$("#listAcc").html(data);
            //console.log(data);
		});
        return false;
	}); 	

    $(".btnDel").click(function(){
        var id = $(this).attr('id');
        var accountNo = id.substring(2);		
        var url ="../api/editDelShow.php";
		var data_set = { accountNo : accountNo};
		$.post(url,data_set,function(data){ 
			$("#showDel").html(data);
            $('#delData').modal('show');
            //console.log(data);
		});
        return false;
	}); 
				
</script>