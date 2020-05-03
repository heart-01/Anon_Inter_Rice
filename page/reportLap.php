<?php
    require_once("menu.php");
?>
<!-- Date -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<title>รีพอร์ตลานตัก</title>
<body>

<div class="col-md-12 text-center" style="margin-top: 20px;font-size:40px;margin-bottom:50px;">
    รีพอร์ตลานตัก
</div>

<form id="frReLap">
<div class="col-md-12 d-flex justify-content-center" style="margin-top: 50px;font-size:18px;">
    <i class="fas fa-search"></i>&nbsp; เริ่มค้นหาวันที่ &nbsp;<input id="datepicker1" width="200" />
    &nbsp; ถึง &nbsp;<input id="datepicker2" width="200" />
    &nbsp; <button type="submit" class="btn btn-outline-primary">ค้นหา</button>
</div>
<form>

<div id="dataLap"></div>

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

        $("#frReLap").on("submit",function(e){
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
              url: '../api/lapAdd.php',
              type: 'POST',
              data: formData,
              success: function(data){
                //console.log(data);
                $("dataLap").html(data);
			  }, // ปิด .success
              async: false,
              cache: false,
              contentType: false,
              processData: false
            });
        });

    </script>
</body>