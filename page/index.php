<!doctype html>
<html lang="en">
  <head>
    <title>หจก.อานนท์ อินเตอร์ไรซ์</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../css/login.css" rel="stylesheet"> 
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  </head>
  <body>
    <?php
      session_start();
      if(isset($_SESSION["staffNo"])){
        echo "<script>window.location.href='./home'</script>";
        exit();
      }
    ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <div class="fadeIn first" style="margin-top: 30px;margin-bottom: 30px;">
            <H4 style="color: black;font-family: kanit;">หจก.อานนท์ อินเตอร์ไรซ์ ยินดีต้อนรับ</H4>
          </div>

          <!-- Error -->
          <div id="err" class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong id="txtErr">!!Error not support JavaScript</strong>
          </div>

          <!-- Login Form -->
          <form id="frLogin">
            <input type="text" id="user" class="fadeIn second" name="user" maxlength="20" placeholder="username" required>
            <input type="password" id="pass" class="fadeIn third" name="pass" maxlength="20" placeholder="password" required>
            <input type="submit" id="sub" class="fadeIn fourth" value="Log In">
          </form>
      
          <!-- Remind Passowrd -->
          <div id="formFooter">
            <a class="underlineHover" href="#" data-toggle="modal" data-target="#exampleModalCenter">Forgot Password?</a>
          </div>
        </div>
    </div>    

    <!-- Modal Login -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Forgot Password?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            กรุณาติดต่อผู้ดูแลระบบ
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $("#err").hide();

        $("#frLogin").on("submit",function(e){
          if(!/^[\dA-z]+$/.test($("#user").val()) || !/^[\dA-z]+$/.test($("#pass").val())){
              $("#err").show();
              $("#txtErr").html("Username or Password is incorrect..");
              $("#user").focus();
              return false;
          }else{
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
              url: '../api/login.php',
              type: 'POST',
              data: formData,
              success: function(data){
                if(data==1){
                  window.location.href="home";
                }else if(data==2){
                  $("#err").show();
                  $("#txtErr").html("Username or Password is incorrect..");
                  $("#user").focus();
                }
					    }, // ปิด .success
              async: false,
              cache: false,
              contentType: false,
              processData: false
            }).done(function(data){
                console.log(data);  // console log เพื่อ debug javascript
            }); 
          }
        });

      });
    </script>

      
  </body>
</html>