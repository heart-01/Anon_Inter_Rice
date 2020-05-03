<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link href="../src/fontawesome/css/all.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../css/home.css" rel="stylesheet"> 
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION["staffNo"])){
        echo "<script>window.location.href='./index'</script>";
        exit();
      }
    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top navbar-custom">
        <a class="navbar-brand" href="./home"> <H5 style="color: black;"><i class="far fa-building"></i> หจก.อานนท์ อินเตอร์ไรซ์</H5> </a>
        <div class="ml-auto mr-1"></div>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav nav nav-pills text-right ml-auto mr-1">
                <li class="nav-item">
                    <a class="nav-link" id="Home" data-toggle="pill" href="#" ><i class="fas fa-home"></i> หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Mill" data-toggle="pill" href="#" ><i class="fas fa-igloo"></i> ข้อมูลโรงสี</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Lap" data-toggle="pill" href="#" ><i class="fas fa-campground"></i> ข้อมูลลานตัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Type" data-toggle="pill" href="#" ><i class="fab fa-pagelines"></i> ข้อมูลชนิดข้าว</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Vehicle" data-toggle="pill" href="#" ><i class="fas fa-truck-moving"></i> ข้อมูลทะเบียนรถ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Report" data-toggle="pill" href="#" ><i class="fas fa-file-invoice"></i> Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Logout" data-toggle="pill" href="#" ><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $("#Home").click(function(){
          window.location.href="./home";
        });
        $("#Report").click(function(){
          window.location.href="./report";
        });
        $("#Mill").click(function(){
          window.location.href="./detailMill";
        });
        $("#Lap").click(function(){
          window.location.href="./detailLap";
        });
        $("#Type").click(function(){
          window.location.href="./detailType";
        });
        $("#Vehicle").click(function(){
          window.location.href="./vehicle";
        });
        $("#Logout").click(function(){
          $.post( "./logout.php", function(data) {
            window.location.href="./index";
          }).done(function(data) { console.log(data); });
        });
      });
    </script>
  </body>
</html>