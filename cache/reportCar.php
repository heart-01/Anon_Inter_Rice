<?php
    require_once("menu.php");
    require_once("../api/connect.php");
?>
<!-- Date -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<title>รีพอร์ตรอบวิ่งรถ</title>
<body>
<!--
<div class="col-md-12 text-center" style="margin-top: 20px;font-size:40px;margin-bottom:50px;">
    รีพอร์ตรอบวิ่งรถ
</div>

<form id="frReCar">
<div class="col-md-12 d-flex justify-content-center" style="margin-top: 50px;font-size:18px;">
    <i class="fas fa-search"></i>&nbsp; เริ่มค้นหาวันที่ &nbsp;<input id="datepicker1" width="200" />
    &nbsp; ถึง &nbsp;<input id="datepicker2" width="200" />
    &nbsp; <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
</div>
<form>

<div id="dataCar"></div>
-->

<table class="table">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อลานตัก</th>
      <th scope="col">วันที่</th>
      <th scope="col">ยอดรวม</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql = "SELECT * FROM balance_carry b, location l WHERE b.locationNo = l.locationNo ORDER BY balanceDate";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_num_rows($query);
    for($i=0;$i<$row;$i++){
        $data = mysqli_fetch_array($query);
  ?>
    <tr>
      <th scope="row"><?php echo $i+1;?></th>
      <td><?php echo $data["location"]; ?></td>
      <td><?php echo $data["balanceDate"]; ?></td>
      <td><?php echo number_format( $data["balance"] ,2); ?></td>
    </tr>
  <?php
    }
  ?>
  </tbody>
</table>

    <script>
        $("#Report").addClass("active");
        $("#Type").removeClass("active");
        $("#Home").removeClass("active");
        $("#Mill").removeClass("active");
        $("#Lap").removeClass("active");
        
        $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy'
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy'
        });

        $("#frReCar").on("submit",function(e){
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
              url: '../api/lapAdd.php',
              type: 'POST',
              data: formData,
              success: function(data){
                //console.log(data);
                $("dataCar").html(data);
			  }, // ปิด .success
              async: false,
              cache: false,
              contentType: false,
              processData: false
            });
        });

    </script>
</body>