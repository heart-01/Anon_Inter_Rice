<?php
    if(isset($_POST["accountNo"])){  
        require_once '../api/connect.php';

        $accountNo=$_POST["accountNo"];

        $sql = "SELECT * FROM rice_account r,location l,type t WHERE r.locationNo = l.locationNo AND r.typeNo = t.typeNo AND r.accountNo = '$accountNo'";
        $query = mysqli_query($conn,$sql);
        $data = mysqli_fetch_array($query);

        $sql_location="SELECT * FROM location";
        $query_location=mysqli_query($conn,$sql_location);
        $row_location=mysqli_num_rows($query_location);

        $sql_type="SELECT * FROM type";
        $query_type=mysqli_query($conn,$sql_type);
        $row_type=mysqli_num_rows($query_type);

        $sql_vehicle="SELECT * FROM vehicle";
        $query_vehicle=mysqli_query($conn,$sql_vehicle);
        $row_vehicle=mysqli_num_rows($query_vehicle);

        $sql_vehicle_account="SELECT * FROM vehicle_account va,vehicle v WHERE va.accountNo = $accountNo AND va.vehicleNo = v.vehicleNo";
        $query_vehicle_account=mysqli_query($conn,$sql_vehicle_account);
        $row_vehicle_account=mysqli_num_rows($query_vehicle_account);
?>

<div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
    <div class="col-sm-12 col-md-3 col-lg-2">
        <button class="btn btn-info btn-block" style="margin-right: 10px;" data-toggle="modal" data-target=".carWeg" ><i class="fas fa-truck-moving"></i> เพิ่มรายละอียด/รถ</button>
    </div>
</div>

<form id="frEdit" method="post" action="../api/editAccount.php">

<input type="hidden" name="accountNo" value="<?php echo $accountNo; ?>" />

<div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
    <div class="col-sm-12 col-md-3 col-lg-1">
        <button type="submit" id="editAccount" class="btn btn-success btn-block" style="margin-right: 10px;" ><i class="fas fa-save"></i> บันทึก</button>

        <button id="DisEditAccount" class="btn btn-success btn-block" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
    </div>
</div>

<figure class="highlight">
    <div class="table-responsive-xl">    
        <pre style="font-family: kanit;">
            <table class="table table-bordered" id="myTable">
            <thead class="thead text-center">
                <tr class="d-flex table-warning">
                    <th scope="col" class="col-2" >วันที่</th>
                    <th scope="col" class="col-2" >ลานตัก</th>
                    <th scope="col" class="col-1" >ชนิดข้าว</th>
                    <th scope="col" class="col-1" >นน.เข้า</th>
                    <th scope="col" class="col-1" >เงินซื้อข้าว</th>
                    <th scope="col" class="col-1" >ค่าบริการ</th>
                    <th scope="col" class="col-1" >เฉลี่ย</th>
                    <th scope="col" class="col-1" >เงินเข้า</th>
                    <th scope="col" class="col-1" >ดอกเบี้ย</th>
                    <th scope="col" class="col-1" >เบิก</th>
                    <th scope="col" class="col-2" >หมายเหตุ</th>
                    <th scope="col" class="col-2" >ทะเบียนรถ</th>
                </tr>
            </thead>
            <tbody>
                <tr class="d-flex">
                    <td class="col-2"><input class="form-control" name="date" type="date" value="<?php echo $data["dated"] ?>"><input class="form-control" name="datePost" type="hidden" value="<?php echo $data["datePost"] ?>"></td>
                    <td class="col-2 input-group">
                        <select class="form-control form-control-sm location" stlye="margin" name="location">
                            <?php
                                $locationNo_old=$data["locationNo"];
                                for($i=0;$i<$row_location;$i++){
                                    $data_location=mysqli_fetch_array($query_location);
                                    $locationNo = $data_location["locationNo"];
                                    $location = $data_location["location"];
                                    if($locationNo_old==$locationNo){
                                        if($locationNo!="1"){
                                            echo "<option value='$locationNo' selected>$location</option>";
                                        }else{
                                            echo "<option value='1' selected>---</option>";
                                        }
                                    }else if($locationNo!="1"){
                                        echo "<option value='$locationNo'>$location</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td class="col-1 input-group">
                        <select class="form-control form-control-sm type" stlye="margin" name="type">
                            <?php
                                $typeNo_old=$data["typeNo"];
                                for($i=0;$i<$row_type;$i++){
                                    $data_type=mysqli_fetch_array($query_type);
                                    $typeNo = $data_type["typeNo"];
                                    $type = $data_type["type"];
                                    if($typeNo_old==$typeNo){
                                        if($typeNo!="1"){
                                            echo "<option value='$typeNo' selected>$type</option>";
                                        }else{
                                            echo "<option value='1' selected>---</option>";
                                        }
                                    }else if($type!="noData"){
                                        echo "<option value='$typeNo'>$type</option>";
                                    }
                                }
                            ?>
                        </select>  
                    </td>
                    <td class="col-1"><input class="form-control form-control-sm purchase input-no-spinner" step="0.01" name="purchase" value="<?php echo $data["purchase"]; ?>" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm total input-no-spinner" step="0.01" name="total" value="<?php echo $data["total"]; ?>" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm service input-no-spinner" step="0.01" name="service" value="<?php echo $data["service"]; ?>" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm average input-no-spinner" step="0.01" name="average" value="<?php echo $data["average"]; ?>" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm income input-no-spinner" step="0.01" name="income" value="<?php echo $data["income"]; ?>" type="number">
                        <input name="income_old" value="<?php echo $data["income"]; ?>" type="hidden">
                    </td>
                    <td class="col-1"><input class="form-control form-control-sm interest input-no-spinner" step="0.01" name="interest" value="<?php echo $data["interest"]; ?>" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm withdraw input-no-spinner" step="0.01" name="withdraw" value="<?php echo $data["withdraw"]; ?>" type="number"></td>   
                    <td class="col-2"><input class="form-control form-control-sm note" name="note" value="<?php echo $data["note"]; ?>" type="text"></td>
                    <td class="col-2 input-group">
                        <select multiple class="form-control form-control-sm selectpicker vehicle" name="1[]" dropupAuto="false" data-size="3" data-live-search="true">
                            <?php
                                //selected
                                $store_dataNo="";
                                $store_data="";
                                for($j=0;$j<$row_vehicle_account;$j++){
                                    $data_vehicle_account=mysqli_fetch_array($query_vehicle_account);
                                    $vehicleNo_account = $data_vehicle_account["vehicleNo"];
                                    $vehicle_account = $data_vehicle_account["vehicle"];
                                    echo "<option value='$vehicleNo_account' selected>$vehicle_account</option>";
                                    $store_dataNo.="$vehicleNo_account,";
                                    $store_data.="$vehicle_account,";
                                }
                                //vehicleNo
                                $sub_store_dataNo=substr($store_dataNo,0,-1);
                                $store_dataNo_arr = explode(',', $sub_store_dataNo);

                                //vehicle
                                $sub_store_data=substr($store_data,0,-1);
                                $store_data_arr = explode(',', $sub_store_data);

                                //No Selected
                                $store_dataVeNo="";
                                $store_dataVe="";
                                for($i=0;$i<$row_vehicle;$i++){
                                    $data_vehicle=mysqli_fetch_array($query_vehicle);
                                    $vehicleNo = $data_vehicle["vehicleNo"];
                                    $vehicle = $data_vehicle["vehicle"];
                                    if($vehicle!="noData"){
                                        $store_dataVeNo.="$vehicleNo,";
                                        $store_dataVe.="$vehicle,";
                                    }
                                }
                                //vehicleNo
                                $sub_store_dataVeNo=substr($store_dataVeNo,0,-1);
                                $store_dataVeNo_arr = explode(',', $sub_store_dataVeNo);
                                //vehicle
                                $sub_store_dataVe=substr($store_dataVe,0,-1);
                                $store_dataVe_arr = explode(',', $sub_store_dataVe);

                                //array_diff
                                //vehicleNo
                                $arrDiffNo=array_diff($store_dataVeNo_arr,$store_dataNo_arr);
                                $arrValueNo=array_values($arrDiffNo);

                                //vehicle
                                $arrDiff=array_diff($store_dataVe_arr,$store_data_arr);
                                $arrValue=array_values($arrDiff);

                                $count_arrValueNo=count($arrValueNo);
                                for($k=0;$k<$count_arrValueNo;$k++){
                                    echo "<option value='$arrValueNo[$k]'>$arrValue[$k]</option>";
                                }

                            ?>
                        </select>   
                    </td>
                    
                </tr>
            </tbody>
            </table>
        </pre>
    </div>          
</figure>
<input type="hidden" name="status" id="status">
</form>

<?php
    }
?>

<div class="modal fade carWeg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-truck-moving"></i> เพิ่มรายละเอียด/รถ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
            <h5>เพิ่มรายละเอียด/รถ</h5>

            <form id="frmWeg" method="post">

            <table class="table" id="tableAddRound">
            <thead>
                <tr>
                    <th scope="col">Action</th>
                    <th scope="col">ทะเบียนรถ</th>
                    <th scope="col">นน.ตักออก</th>
                    <th scope="col">นน.ปลายทาง</th>
                    <th scope="col">ค่าชั่ง</th>
                    <th scope="col">ราคาขาย</th>
                    <th scope="col">โรงสีปลายทาง</th>
                </tr>
            </thead>
            <tbody>

            <input type='hidden' name='acc' value="<?php echo $accountNo ?>">
            <?php
                $sql_vehWeg="SELECT * FROM vehicle_account va,vehicle v WHERE va.accountNo = $accountNo AND va.vehicleNo = v.vehicleNo";
                $query_vehWeg=mysqli_query($conn,$sql_vehWeg);
                $row_vehWeg=mysqli_num_rows($query_vehWeg);

                for($k=0;$k<$row_vehWeg;$k++){
                    $data_vehWeg=mysqli_fetch_array($query_vehWeg);

                    $idVehicle = $data_vehWeg['vehicleNo'];
                    $dataVehicle = $data_vehWeg['vehicle'];
                    $wegVehicle = $data_vehWeg['weight'];
                    $desVehicle = $data_vehWeg['destination'];
                    $scaVehicle = $data_vehWeg['scale'];
                    $sellVehicle = $data_vehWeg['sell'];
                    $round = $data_vehWeg['round'];
                    $b=$k+1;
                   
                    if($row_vehWeg!="0"){
                        echo "<tr>";
                        echo "<td><button class='btn addRound' id='btnAddRound$idVehicle$round' data-Veh='$idVehicle' data-round='$round' data-acc='$accountNo' ><i class='fas fa-plus-circle'></i></button></td>";
                        echo "<td><input type='hidden' name='dataRound[]' value='$round' placeholder='$round'>
                        <input type='hidden' name='idVeh[]' value='$idVehicle' placeholder='$idVehicle'>$dataVehicle</td>";
                        echo "<td><input type='number' class='input-no-spinner' name='dataVeh[]' style='width:120px;' placeholder='$dataVehicle' value='$wegVehicle'></td>";
                        echo "<td><input type='number' class='input-no-spinner' name='dataDes[]' style='width:120px;' placeholder='$dataVehicle' value='$desVehicle'></td>";
                        echo "<td><input type='number' class='input-no-spinner' name='dataScale[]' style='width:120px;' placeholder='$dataVehicle' value='$scaVehicle'></td>";
                        echo "<td><input type='number' class='input-no-spinner' name='dataSell[]' style='width:120px;' placeholder='$dataVehicle' value='$sellVehicle'></td>";
                        echo "<td>";
                        echo "<select class='form-control form-control-sm mill' name='mill[]'>";
                                //millAll
                                $sql_mill="SELECT * FROM mill";
                                $query_mill=mysqli_query($conn,$sql_mill);
                                $row_mill=mysqli_num_rows($query_mill);

                                //Select Old
                                $sql_millOld="SELECT * FROM vehicle_account va, mill m WHERE va.millNo=m.millNo AND va.accountNo='$accountNo' AND va.vehicleNo='$idVehicle' AND va.round='$round' ";
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
                }
            ?>

            </tbody>
            </table>

            <?php
                if($row_vehWeg!="0"){
                    echo '<button type="submit" id="subWeg" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</button>';
                }
            ?>

            </form>

      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
 
<script>
    $('.vehicle').selectpicker();
    
    //round
    $('.addRound').click(function(){
        var vehicleNo = $(this).attr('data-Veh');
        var round = $(this).attr('data-round');
        var accountNo = $(this).attr('data-acc');
        var btnAddRound = $(this).attr('id');
        var a = '#'+btnAddRound; //id round
        /*alert(vehicleNo + ' '+ round + ' ' + accountNo);
        alert(a);
        $(a).hide();*/
        var url = "../api/editAddRound.php";
        var data_set = {accountNo : accountNo, idVehicle : vehicleNo};
        $.post(url,data_set,function(data){
            $('#tableAddRound > tbody:last-child').append(data);
            //console.log(data);
        });

        return false;
    });
    
    var status = 0;
    $(".vehicle").click(()=>{
        if(status==0){
            var veh = confirm('การเปลี่ยนแปลงค่าในรายการทะเบียนรถจะต้องใส่ค่า นน.ตักออก และ นน.ปลายทาง ใหม่ทั้งหมดต้องการทำรายการต่อหรอไม่? *** หากกดตกลงต้องใส่ค่า นน.ตักออก และ นน.ปลายทาง ใหม่ทั้งหมด ***');
            if(veh == true) {
                status=1;
                $("#status").val(status);
                //document.getElementById('editAccount').click(); //บังคับปุ่มให้ click
            }else{
                $(this).val($.data(this, 'current')); //ทำให้ค่าข้อมูลใน select box อยู่เหมือนเดิม
                return false;
            }
        }
    });
    $("#status").val(status);

    //frmWeg
    $("#frmWeg").on("submit",function(e){
        e.preventDefault(); 
        var formData = new FormData(this);
        $.ajax({
          url: '../api/editAddWeg.php',
          type: 'POST',
          data: formData,
          beforeSend: function(){
            
          },
          success: function(data){
            $("#alert").show();
            if(data==""){
                $("#alert").removeClass("alert-danger");
                $("#alert").addClass("alert-success");
                $("#txtAlert").html("บันทึกข้อมูลสำเร็จ");
                $(".carWeg").modal('hide')
                setTimeout(function() {
                    window.location.href="../page/editAccount.php";
                },800);
            }else if(data=="Not Query"){
                $("#alert").removeClass("alert-success");
                $("#alert").addClass("alert-danger");
                $("#txtAlert").html("ไม่สามารถเพิ่มข้อมูลได้");
                $(".carWeg").modal('hide')
            }
		  }, // ปิด .success
          async: false,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(data){
            console.log(data);  // console log เพื่อ debug javascript
        }); 
    });

    //ส่งฟอร์ม
    $("#DisEditAccount").hide();
    $("#frEdit").on("submit",function(e){
        e.preventDefault(); 
        var formData = new FormData(this);
        $.ajax({
          url: '../api/editAccount.php',
          type: 'POST',
          data: formData,
          beforeSend: function(){
            $("#DisEditAccount").show();
            $("#editAccount").hide();
          },
          success: function(data){
            $("#alert").show();
            setTimeout(function() {
                $("#DisEditAccount").hide();
                $("#editAccount").show();
            },200);
            if(data=="Not straight"){
                $("#alert").removeClass("alert-success");
                $("#alert").addClass("alert-danger");
                $("#txtAlert").html("ไม่สามารถใส่ตัวอักษรพิเศษได้");
            }else if(data==""){
                $("#alert").removeClass("alert-danger");
                $("#alert").addClass("alert-success");
                $("#txtAlert").html("บันทึกข้อมูลสำเร็จ");
                setTimeout(function() {
                    window.location.href="../page/editAccount.php";
                },800);
            }else if(data=="Not Query"){
                $("#alert").removeClass("alert-success");
                $("#alert").addClass("alert-danger");
                $("#txtAlert").html("ไม่สามารถเพิ่มข้อมูลได้");
            }
		  }, // ปิด .success
          async: false,
          cache: false,
          contentType: false,
          processData: false
        }).done(function(data){
            console.log(data);  // console log เพื่อ debug javascript
        }); 
    });
    </script>