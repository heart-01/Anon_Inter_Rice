<?php
    require_once("menu.php");
?>
<title>ข้อมูลชนิดข้าว</title>
<body>
<!-- CSS -->
<link href="../css/type.css" rel="stylesheet"> 

<div class="col-md-12 text-center" style="margin-top: 20px;font-size:40px;">
    ข้อมูลชนิดข้าว
</div>

<div class="container">

    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;">
      <div class="input-group-btn">
        <button class="btn btn-default" disabled ><i class="fas fa-search"></i></button>
      </div>
      <input type="text" class="form-control col-3" maxlength="50" placeholder="ค้นหาชนิดข้าว" id="txtSearch" name="txtSearch">
    </div>

    <div class="row typeDetail">

    <?php
      require_once '../api/connect.php';
      $sql_count="SELECT * FROM type WHERE typeNo!=1";
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

      $sql = "SELECT * FROM type WHERE typeNo!=1 LIMIT 10 OFFSET $pf";
      $query = mysqli_query($conn,$sql);
      $row = mysqli_num_rows($query);
    ?>

    <table class="table table-striped table-hover">
    <thead>
    <div class="col-md-12 d-flex justify-content-end" style="margin-top: 20px;margin-bottom: 20px">
        <a href="#" class="btn btn-primary btn-sm pull-right" id="btnAddData" data-toggle="modal" data-target="#addData"><b><i class="fas fa-plus-circle"></i></b> เพิ่มข้อมูลชนิดข้าว</a>
    </div>
        <tr>
            <th>รหัส</th>
            <th>ชื่อชนิดข้าว</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            for($i=0;$i<$row;$i++){
                $data = mysqli_fetch_array($query);
        ?>
        <tr>
            <td><?php echo $data["typeNo"]; ?></td>
            <td><?php echo $data["type"]; ?></td>
            <td class="text-center">
              <a class='btn btn-warning text-white btn-sm editData' data-toggle="modal" data-target="#editData" id="<?php echo $data["typeNo"]; ?>" href=""><i class="far fa-edit"></i> แก้ไข</a> 
              <a href="#" class="btn btn-danger btn-sm delData" data-toggle="modal" data-target="#delData" id="<?php echo $data["typeNo"]; ?>"><i class="fas fa-trash-alt"></i> ลบ</a>
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
		    echo "<a href='detailType?pf=$first_post&pl=$last_post&index=$p' class='Lpage'>" . $p . "</a>";  if($p!=$page){echo " , ";}
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fab fa-pagelines"></i> เพิ่มข้อมูลชนิดข้าว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frAdd">
          <div class="form-group">
            <label for="message-text" class="col-form-label">ชื่อชนิดข้าว:</label>
            <input class="form-control" name="type" id="message-text" maxlength="50" required></input>
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
        $("#Report").removeClass("active");
        $("#Home").removeClass("active");
        $("#Mill").removeClass("active");
        $("#Lap").removeClass("active");
        $("#Vehicle").removeClass("active");
        $("#Type").addClass("active");

        $(".delData").click(function(){
          var typeNo = $(this).attr('id');
          var url = "../api/typeDelShow.php";
		      var data_set = { delData : typeNo };
          $.post(url,data_set,function(data){
            $("#showDel").html(data);
            $('#delData').modal('show');
            //console.log(data);
          });
          return false;
       });

       $(".editData").click(function(){
          var typeNo = $(this).attr('id');
          var url = "../api/typeEditShow.php";
		      var data_set = { editData : typeNo };
          $.post(url,data_set,function(data){
            $("#showEdit").html(data);
            $('#editData').modal('show');
            //console.log(data);
          });
            return false;
       });

       $("#txtSearch").keyup(function(){
          var txtSearch = $(this).val();
          var url = "../api/typeSearch.php";
			    var data_set = { txtSearch : txtSearch };
          $.get(url,data_set,function(data){
            $(".typeDetail").html(data);
            //console.log(data);
          });
          return false;
       });

        $("#frAdd").on("submit",function(e){
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
              url: '../api/typeAdd.php',
              type: 'POST',
              data: formData,
              success: function(data){
                //console.log(data);
                if(data==""){
                  $('#success').modal('show');
                  setTimeout(function() {
                    window.location.href="detailType";
                  },1000);
                }else if(data=="Not Query"){
                  alert('ไม่สามารถเพิ่มข้อมูลได้ติดต่อผู้ดูแลระบบ');
                  $('#error').modal('show');
                  $("#btnCon").attr('disabled', false); 
                }else if(data=="Duplicate"){
                  alert('มีชื่อชนิดข้าวนี้อยู่แล้ว');
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