<?php
    require_once("menu.php");
?>
<title>Report</title>
<body>
<div class="col-md-12 text-center" style="margin-top: 20px;font-size:40px;margin-bottom:50px;">
    Report
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">
            <div class="col-sm-5" style="margin-bottom:50px;">
                <button type="button" id="btnReCar" class="btn btn-info btn-lg btn-block"><i class="fas fa-car-alt"></i> รอบวิ่งรถ</button>
            </div>
        </div>
        <div class="col-sm-12 col-sm-12 d-flex justify-content-center">
            <div class="col-sm-5" style="margin-bottom:50px;">
                <button type="button" id="btnReMill" class="btn btn-info btn-lg btn-block"><i class="fas fa-igloo"></i> โรงสี</button>
            </div>
        </div>
        <div class="col-sm-12 col-sm-12 d-flex justify-content-center">
            <div class="col-sm-5">
                <button type="button" id="btnRelap" class="btn btn-info btn-lg btn-block"><i class="fas fa-campground"></i> ลานตัก</button>
            </div>
        </div>
    </div>
</div>

    <script>
        $("#Type").removeClass("active");
        $("#Home").removeClass("active");
        $("#Mill").removeClass("active");
        $("#Lap").removeClass("active");
        $("#Vehicle").removeClass("active");
        $("#Report").addClass("active");

        $("#btnReCar").click(function(){
          window.location.href="./reportCar";
        });
        $("#btnReMill").click(function(){
          window.location.href="./reportMill";
        });
        $("#btnRelap").click(function(){
          window.location.href="./reportLap";
        });

    </script>
</body>