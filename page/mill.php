<?php
    require_once("menu.php");
?>
<title>ข้อมูลโรงสี</title>
<body>
<!-- CSS -->
<link href="../css/mill.css" rel="stylesheet"> 

<div class="col-md-12 text-center" style="margin-top: 20px;font-size:40px;">
    ข้อมูลโรงสี
</div>

<div class="container">

    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
      <div class="input-group-btn">
        <button class="btn btn-default" disabled ><i class="fas fa-search"></i></button>
      </div>
      <input type="text" class="form-control col-3" maxlength="50" placeholder="ค้นหาโรงสี" id="txtSearch" name="txtSearch">
    </div>

    <div class="row millDetail">

    <?php
      require_once '../api/connect.php';
      $sql_count="SELECT * FROM mill WHERE millNo!=1";
      $query_count=mysqli_query($conn,$sql_count);
      $row_count=mysqli_num_rows($query_count);

      $pf=0;
      $pl=10;
      $indexPage=1;

      if(isset($_GET["pf"]))
      {
        $pf=$_GET["pf"];
        $pl=$_GET["pl"];
        $indexPage=$_GET["index"];
      }
      $page=ceil($row_count/10);

      $sql = "SELECT * FROM mill WHERE millNo!=1 LIMIT 10 OFFSET $pf";
      $query = mysqli_query($conn,$sql);
      $row = mysqli_num_rows($query);
    ?>

    <table class="table table-striped table-hover">
    <thead>
    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;margin-bottom: 20px">
        <a href="#" class="btn btn-primary btn-sm pull-right" id="btnAddData" data-toggle="modal" data-target="#addData"><b><i class="fas fa-plus-circle"></i></b> เพิ่มข้อมูลโรงสี</a>
    </div>
        <tr>
            <th>รหัส</th>
            <th>ชื่อโรงสี</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($i=0;$i<$row;$i++){
                $data = mysqli_fetch_array($query);
        ?>
        <tr>
            <td><?php echo $data["millNo"]; ?></td>
            <td><?php echo $data["mill"]; ?></td>
            <td class="text-center">
              <a class='btn btn-warning btn-sm text-white editData' data-toggle="modal" data-target="#editData" id="<?php echo $data["millNo"]; ?>" href=""><i class="far fa-edit"></i> แก้ไข</a> 
              <a href="#" class="btn btn-danger btn-sm delData" data-toggle="modal" data-target="#delData" id="<?php echo $data["millNo"]; ?>"><i class="fas fa-trash-alt"></i> ลบ</a>
            </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
    </table>

    <?php
	    $first_post = 0;
	    $last_post = 10;
        if($page!=0){
            echo "<div class='text-center col-sm-12'><p style='font-size:18px;'><i class='fas fa-book-open'></i> หน้าที่ ";
        }    
	    for($p=1;$p<=$page;$p++)
	    {
		    echo "<a href='detailMill?pf=$first_post&pl=$last_post&index=$p' class='Lpage'>" . $p . "</a>";  if($p!=$page){echo " , ";}
		    $first_post=$first_post+10;
        $last_post=$last_post+10;
	    }	
	    echo " </p></div>";
    ?>

    </div>
</div>

<!-- modal AddData -->
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-igloo"></i> เพิ่มข้อมูลโรงสี</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frAddMill">
          <div class="form-group">
            <label for="message-text" class="col-form-label">ชื่อโรงสี:</label>
            <input class="form-control" name="mill" id="message-text" maxlength="50" required></input>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
        <button type="submit" id="btnCon" class="btn btn-primary"><i class="far fa-share-square"></i> ยืนยัน</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- modal edit -->
<div id="showEdit"></div>

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
        $("#Type").removeClass("active");
        $("#Report").removeClass("active");
        $("#Home").removeClass("active");
        $("#Vehicle").removeClass("active");
        $("#Lap").removeClass("active");
        $("#Mill").addClass("active");
        
        $(".delData").click(function(){
          var millNo = $(this).attr('id');
          var url = "../api/millDelShow.php";
			    var data_set = { delData : millNo };
          $.post(url,data_set,function(data){
            $("#showDel").html(data);
            $('#delData').modal('show');
            //console.log(data);
          });
          return false;
       });

       $(".editData").click(function(){
          var millNo = $(this).attr('id');
          var url = "../api/millEditShow.php";
			    var data_set = { editData : millNo };
          $.post(url,data_set,function(data){
            $("#showEdit").html(data);
            $('#editData').modal('show');
            //console.log(data);
          });
            return false;
       });

       $("#txtSearch").keyup(function(){
          var txtSearch = $(this).val();
          var url = "../api/millSearch.php";
			    var data_set = { txtSearch : txtSearch };
          $.get(url,data_set,function(data){
            $(".millDetail").html(data);
            //console.log(data);
          });
          return false;
       });

        $("#frAddMill").on("submit",function(e){
          if(!/^[\dA-zก-๙/.\s]+$/.test($("#message-text").val()) ){
            alert('ไม่สามารถใส่อักษรพิเศษได้');
            $('#error').modal('show');
            $("#message-text").focus();
            return false;
          }else{
            $("#btnCon").attr('disabled', true); 
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
              url: '../api/millAdd.php',
              type: 'POST',
              data: formData,
              success: function(data){
                //console.log(data);
                if(data==""){
                  $('#success').modal('show');
                  setTimeout(function() {
                    window.location.href="detailMill";
                  },1000);
                }else if(data=="Not Query"){
                  alert('ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
                  $('#error').modal('show');
                  $("#btnCon").attr('disabled', false);
                }else if(data=="Duplicate"){
                  alert('มีชื่อโรงสีนี้อยู่แล้ว');
                  $('#error').modal('show');
                  $("#btnCon").attr('disabled', false); 
                }
			        }, // ปิด .success
              async: false,
              cache: false,
              contentType: false,
              processData: false
            });
          }
        });
    </script>

</body>