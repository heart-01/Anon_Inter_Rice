<?php
    require_once("menu.php");
?>
<title>เพิ่มรายการ</title>
<!-- CSS -->
<link href="../css/addAccount.css" rel="stylesheet"> 
<link href="../css/mill.css" rel="stylesheet"> 

<!--Selected-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<body>
<?php
    date_default_timezone_set("Asia/Bangkok");
    $date=date("Y-m-d");

    require_once '../api/connect.php';
    $sql_location="SELECT * FROM location";
    $query_location=mysqli_query($conn,$sql_location);
    $row_location=mysqli_num_rows($query_location);

    $sql_mill="SELECT * FROM mill";
    $query_mill=mysqli_query($conn,$sql_mill);
    $row_mill=mysqli_num_rows($query_mill);

    $sql_vehicle="SELECT * FROM vehicle";
    $query_vehicle=mysqli_query($conn,$sql_vehicle);
    $row_vehicle=mysqli_num_rows($query_vehicle);

    $sql_type="SELECT * FROM type";
    $query_type=mysqli_query($conn,$sql_type);
    $row_type=mysqli_num_rows($query_type);
?>

<!-- Alert -->
<div id="alert" class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong id="txtAlert">!!Error not support JavaScript</strong>
</div>

<div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
    <div class="col-sm-12 col-md-3 col-lg-2">        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-info btn-sm" id="minus-btn"><i class="fa fa-minus"></i></button>
            </div>
            <input type="number" id="qty_input" class="form-control form-control-sm text-center" value="1" min="1">
            <div class="input-group-prepend">
                <button class="btn btn-info btn-sm" id="plus-btn"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>

<form id="frAdd" method="post" action="../api/addAccount.php">

<input type="hidden" id="cp_qty" name="qty_input" value="1" hiddent class="form-control-sm text-center">

<div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
    <div class="col-sm-12 col-md-3 col-lg-1">
        <button id="DisAddAccount" class="btn btn-success btn-block" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>

        <button type="submit" id="addAccount" class="btn btn-success btn-block" style="margin-right: 10px;" ><i class="fas fa-save"></i> บันทึก</button>

        <button type="button" class="btn btn-primary btn-block" style="margin-right: 10px;" data-toggle="modal" data-target=".dataBalance" ><i class="fas fa-plus-circle"></i> ยอดยกมา</button>
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
                    <th scope="col" class="col-1" >นน.ตักออก</th>
                    <th scope="col" class="col-1" >โรงสีปลายทาง</th>
                    <th scope="col" class="col-2" >นน.ปลายทาง</th>
                    <th scope="col" class="col-1" >ค่าชั่ง</th>
                    <th scope="col" class="col-1" >ราคาขาย</th>
                </tr>
            </thead>
            <tbody>
                <tr class="d-flex">
                    <td class="col-2"><input class="form-control" name="date[]" type="date" value="<?php echo $date ?>"></td>
                    <td class="col-2 input-group">
                        <select class="form-control form-control-sm location" stlye="margin" name="location[]">
                            <?php
                                for($i=0;$i<$row_location;$i++){
                                    $data_location=mysqli_fetch_array($query_location);
                                    $locationNo = $data_location["locationNo"];
                                    $location = $data_location["location"];
                                    
                                    if($location!="noData"){
                                        echo "<option value='$locationNo'>$location</option>";
                                    }
                                }
                            ?>
                                    <option value='noData' selected>---</option>
                        </select>
                    </td>
                    <td class="col-1 input-group">
                        <select class="form-control form-control-sm type" stlye="margin" name="type[]">
                            <?php
                                for($i=0;$i<$row_type;$i++){
                                    $data_type=mysqli_fetch_array($query_type);
                                    $typeNo = $data_type["typeNo"];
                                    $type = $data_type["type"];

                                    if($type!="noData"){
                                        echo "<option value='$typeNo'>$type</option>";
                                    }
                                }
                            ?>
                                    <option value='noData' selected>---</option>
                        </select>                    
                    </td>
                    <td class="col-1"><input class="form-control form-control-sm purchase input-no-spinner" step="0.01" name="purchase[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm total input-no-spinner" step="0.01" name="total[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm service input-no-spinner" step="0.01" name="service[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm average input-no-spinner" step="0.01" name="average[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm income input-no-spinner" step="0.01" name="income[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm interest input-no-spinner" step="0.01" name="interest[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm withdraw input-no-spinner" step="0.01" name="withdraw[]" type="number"></td>   
                    <td class="col-2"><input class="form-control form-control-sm note" name="note[]" type="text"></td>
                    <td class="col-2 input-group">
                        <select multiple class="form-control form-control-sm selectpicker vehicle" name="1[]" id="1" dropupAuto="false" data-size="3" data-live-search="true">
                            <?php
                                for($i=0;$i<$row_vehicle;$i++){
                                    $data_vehicle=mysqli_fetch_array($query_vehicle);
                                    $vehicleNo = $data_vehicle["vehicleNo"];
                                    $vehicle = $data_vehicle["vehicle"];

                                    if($vehicle!="noData"){
                                        echo "<option value='$vehicleNo'>$vehicle</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td class="col-1"><input class="form-control form-control-sm scoop input-no-spinner" step="0.01" name="scoop[]" type="number"></td>
                    <td class="col-1 input-group">
                        <select class="form-control form-control-sm mill" name="mill[]">
                            <?php
                                for($i=0;$i<$row_mill;$i++){
                                    $data_mill=mysqli_fetch_array($query_mill);
                                    $millNo = $data_mill["millNo"];
                                    $mill = $data_mill["mill"];

                                    if($mill!="noData"){
                                        echo "<option value='$millNo'>$mill</option>";
                                    }
                                }
                            ?>
                                    <option value='noData' selected>---</option>
                        </select>                     
                    </td>
                    <td class="col-2"><input class="form-control form-control-sm destination input-no-spinner" step="0.01" name="destination[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm scale input-no-spinner" step="0.01" name="scale[]" type="number"></td>
                    <td class="col-1"><input class="form-control form-control-sm sell input-no-spinner" step="0.01"  name="sell[]" type="number"></td>
                </tr>
            </tbody>
            </table>
        </pre> 
    </div>       
</figure>
</form>

<div class="modal fade dataBalance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ยอดยกมา</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            ลานตัก
            <select class="form-control form-control-sm" id="locat" stlye="margin" name="location[]">
                <?php
                    $sql_location="SELECT * FROM location";
                    $query_location=mysqli_query($conn,$sql_location);
                    $row_location=mysqli_num_rows($query_location);

                    for($i=0;$i<$row_location;$i++){
                        $data_location=mysqli_fetch_array($query_location);
                        $locationNo = $data_location["locationNo"];
                        $location = $data_location["location"];
                        
                        if($location!="noData"){
                            echo "<option value='$locationNo'>$location</option>";
                        }
                    }
                ?>
                        <option value='noData' selected>---</option>
            </select>  
            <br>
            <div class="text-center">
                <input class="form-control input-no-spinner" type="number" id="txtBalance" placeholder="จำนวนยอดคงเหลือ.." maxlength="50"></input>
                <br>
                <input class="form-control input-no-spinner" type="number" id="txtElite" placeholder="เพิ่มยอดยกมา.." maxlength="50"></input>
            </div>
            <br>
            <div class="text-center">
                <button type="button" id="btnAdd" class="btn btn-primary"><i class="fas fa-plus-circle"></i> เพิ่ม</button>
                <button type="button" id="btnEdit" class="btn btn-warning text-white"><i class="far fa-edit"></i> แก้ไข</button>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
        <button type="button" id="btnRe" class="btn btn-info" ><i class="fas fa-undo"></i> รีเซ็ท</button>
        <button type="button" id="btnCon" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</button>
      </div>
    </div>
  </div>
</div>

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
        $("#Home").addClass("active");
        $("#Type").removeClass("active");
        $("#Report").removeClass("active");
        $("#Mill").removeClass("active");
        $("#Lap").removeClass("active");
        
        $('#1').on('changed.bs.select', function () {
            var count = $('#1 option:selected').length;
            alert(count);
        });        

        //ยอดยกมา
        var staEli = 0;
        var staBal = 0;
        $("#txtElite").attr('hidden', true);
        $("#txtBalance").attr('readonly', true);
        $("#locat").change(function(){
            var location = $(this).val();
            var url = "../api/balanceSearch.php";
            var data_set = {location : location};
            $.post(url,data_set,function(data){
                if(data=="No"){
                    alert("ลานตักที่เลือกยังไม่มียอดยกมา กรุณาเพิ่มข้อมูลยอดยกมา");
                    $("#txtBalance").val("");
                    $("#txtElite").val("");
                    $("#btnEdit").attr('disabled', true);
                    $("#btnAdd").attr('disabled', false);
                    $("#txtElite").attr('hidden', true);
                    $("#txtBalance").attr('readonly', true);
                    staEli = 0
                    staBal = 0
                }else{
                    $("#txtBalance").val(data);
                    $("#txtElite").val("");
                    $("#txtElite").attr('hidden', true);
                    $("#btnEdit").attr('disabled', false);
                    staEli = 0
                    staBal = 0
                }
            });
        });
        $("#btnAdd").click(function(){
            if(staEli==0){
                var location = $("#locat").val();
                if(location=="noData"){
                    alert("กรุณาเลือกลานตัก");
                }else{
                    $("#txtElite").attr('hidden', false);
                    $("#btnEdit").attr('disabled', true);
                    staEli = 1;
                }
            }else if(staEli==1){
                $("#txtElite").attr('hidden', true);
                staEli = 0;
            }
        });
        $("#btnEdit").click(function(){
            if(staBal==0){
                var location = $("#locat").val();
                if(location=="noData"){
                    alert("กรุณาเลือกลานตัก");
                }else{
                    $("#txtBalance").attr('readonly', false);
                    $("#btnAdd").attr('disabled', true);
                    staBal = 1;
                }
            }else if(staBal==1){
                $("#txtBalance").attr('readonly', true);
                staBal = 0;
            }
        });
        $("#btnRe").click(function(){
            $("#locat").val("noData");
            $("#txtBalance").val("");
            $("#txtElite").val("");
            $("#btnEdit").attr('disabled', false);
            $("#btnAdd").attr('disabled', false);
            $("#txtElite").attr('hidden', true);
            $("#txtBalance").attr('readonly', true);
            staEli = 0
            staBal = 0
        });
        $("#btnCon").click(function(){
            if(staEli==0&&staBal==0){
                alert("กรุณาเลือกรายการที่ต้องการ");
            }else if(staEli==1){
                var add = $("#txtElite").val();
                var location = $("#locat").val();
                if(add==""){
                    alert("กรุณากรอกจำนวนเงินที่ต้องการเพิ่ม");
                }else{
                    $(this).attr('disabled', true);
                    var url = "../api/balanceAdd.php";
                    var data_set = {add : add, location : location};
                    $.post(url,data_set,function(data){
                        if(data=="Not Query"){
                            alert('ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
                            $('#error').modal('show');
                        }else if(data==""){
                            $('#success').modal('show');
                            setTimeout(function() {
                                $('#success').modal('hide');
                            },1000);

                            $("#locat").val("noData");
                            $("#txtBalance").val("");
                            $("#txtElite").val("");
                            $("#btnEdit").attr('disabled', false);
                            $("#btnAdd").attr('disabled', false);
                            $("#txtElite").attr('hidden', true);
                            $("#txtBalance").attr('readonly', true);
                            staEli = 0
                            staBal = 0
                        }
                        //console.log(data);
                    });
                    $(this).attr('disabled', false);
                }
            }else if(staBal==1){
                var edit = $("#txtBalance").val();
                var location = $("#locat").val();
                if(edit==""){
                    alert("กรุณากรอกจำนวนเงินที่ต้องการแก้ไข");
                }else{
                    $(this).attr('disabled', true);
                    var url = "../api/balanceEdit.php";
                    var data_set = {edit : edit, location : location};
                    $.post(url,data_set,function(data){
                        if(data=="Not Query"){
                            alert('ไม่สามารถแก้ไขข้อมูลได้ติดต่อผู้ดูแลระบบ');
                            $('#error').modal('show');
                        }else if(data==""){
                            $('#success').modal('show');
                            setTimeout(function() {
                                $('#success').modal('hide');
                            },1000);

                            $("#locat").val("noData");
                            $("#txtBalance").val("");
                            $("#txtElite").val("");
                            $("#btnEdit").attr('disabled', false);
                            $("#btnAdd").attr('disabled', false);
                            $("#txtElite").attr('hidden', true);
                            $("#txtBalance").attr('readonly', true);
                            staEli = 0
                            staBal = 0
                        }
                    });
                    $(this).attr('disabled', false);
                }
            }
        });

        //เพิ่มลบตาราง
        $('#qty_input').prop('disabled', true);
        $('#plus-btn').click(function(){
            var txtNum = parseInt($('#qty_input').val());
            if(txtNum<=9){
                $('#qty_input').val(txtNum+1);

                var num = ($('#qty_input').val());
                $("#cp_qty").val(num);
                
                var url = "../api/addAccInsert.php";
                var data_set = {num : num};
                $.post(url,data_set,function(data){
                    $('#myTable > tbody:last-child').append(data);
                    //console.log(data);
                });
            }
            
        });
        $('#minus-btn').click(function(){
    	    $('#qty_input').val(parseInt($('#qty_input').val()) - 1 );
    	    if ($('#qty_input').val() == 0) {
			    $('#qty_input').val(1);
            }
            var num = ($('#qty_input').val());
            $("#cp_qty").val(num);
            $('#myTable > tbody > tr:eq('+num+')').remove();
        });
        
        //ส่งฟอร์ม
        $("#alert").hide();
        $("#DisAddAccount").hide();
        $("#frAdd").on("submit",function(e){
            $("#addAccount").attr('disabled', true); 
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
              url: '../api/addAccount.php',
              type: 'POST',
              data: formData,
              beforeSend: function(){
                $("#DisAddAccount").show();
                $("#addAccount").hide();
              },
              success: function(data){
                $("#alert").show();
                setTimeout(function() {
                    $("#DisAddAccount").hide();
                    $("#addAccount").show();
                },200);
                if(data=="Not straight"){
                    $("#alert").removeClass("alert-success");
                    $("#alert").removeClass("alert-warning");
                    $("#alert").addClass("alert-danger");
                    $("#txtAlert").html("ไม่สามารถใส่ตัวอักษรพิเศษได้");
                    $("#addAccount").attr('disabled', false); 
                }else if(data==""){
                    $("#alert").removeClass("alert-danger");
                    $("#alert").removeClass("alert-warning");
                    $("#alert").addClass("alert-success");
                    $("#txtAlert").html("บันทึกข้อมูลสำเร็จ");
                    setTimeout(function() {
                        window.location.href="./home.php";
                    },800);
                }else if(data=="Not Query"){
                    $("#alert").removeClass("alert-success");
                    $("#alert").removeClass("alert-warning");
                    $("#alert").addClass("alert-danger");
                    $("#txtAlert").html("ไม่สามารถเพิ่มข้อมูลได้");
                    $("#addAccount").attr('disabled', false); 
                }else if(data=="Empty"){
                    $("#alert").removeClass("alert-success");
                    $("#alert").removeClass("alert-danger");
                    $("#alert").addClass("alert-warning");
                    $("#txtAlert").html("กรุณากรอกข้อมูล");
                    $("#addAccount").attr('disabled', false); 
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
</body>