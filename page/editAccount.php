<?php
    require_once("menu.php");
?>
<!-- CSS -->
<link href="../css/editAcc.css" rel="stylesheet"> 
<!-- Date -->
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<!--Selected-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" integrity="sha256-sJQnfQcpMXjRFWGNJ9/BWB1l6q7bkQYsRqToxoHlNJY=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.bundle.js" integrity="sha256-rZJJisswIJ6XB4c6vC5kGxApmapgl5U5bSDwCKerj3w=" crossorigin="anonymous"></script>

<title>แก้ไขรายการ</title>
<body>
<!-- Alert -->
<div id="alert" class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong id="txtAlert">!!Error not support JavaScript</strong>
</div>

<div class="col-md-12 d-flex justify-content-center" style="margin-top: 50px;">
    <p style="font-size:28px;" class="text-center" ><i class="fas fa-search"></i> ค้นหาวันที่<br><br><input id="datepicker" width="300" /></p>
</div>

<div id="listAcc"></div>

    <script>
        $("#Home").addClass("active");
        $("#Type").removeClass("active");
        $("#Report").removeClass("active");
        $("#Mill").removeClass("active");
        $("#Lap").removeClass("active");
        
        //ค้นหา
        $("#alert").hide();
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd-mm-yyyy',
            change: function (e) {
                var txtDate = $(this).val();
                var url = "../api/editAccSearch.php";
				var data_set = { date : txtDate };
                $.post(url,data_set,function(data){
					$("#listAcc").html(data);
                    //console.log(data);
				});
            }
        });
    </script>
</body>