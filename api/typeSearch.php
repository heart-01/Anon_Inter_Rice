    <?php
      $txtSearch = $_GET["txtSearch"];
      echo "<input type='hidden' id='valSearch' value='$txtSearch'>";
      require_once '../api/connect.php';
      $sql_count="SELECT * FROM type WHERE typeNo!=1 AND type LIKE'%$txtSearch%'";
      $query_count=mysqli_query($conn,$sql_count);
      $row_count=mysqli_num_rows($query_count);

      $pf=0;
      $pl=10;

      if(isset($_GET["pf"]))
      {
        $pf=$_GET["pf"];
        $pl=$_GET["pl"];
      }
      $page=ceil($row_count/10);

      $sql = "SELECT * FROM type WHERE typeNo!=1 AND type LIKE'%$txtSearch%' LIMIT 10 OFFSET $pf";
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
            echo "<a href='' onclick='return searchPage($first_post,$last_post)' >" . $p . "</a>";  if($p!=$page){echo " , ";}
            $first_post=$first_post+10;
            $last_post=$last_post+10;
	    }	
	    echo " </p></div>";
    ?>

<script>
    function searchPage(f,l){
        var valSearch = $("#valSearch").val();
        var url = "../api/typeSearch.php";
		var data_set = { pf : f, pl : l, txtSearch : valSearch };
        $.get(url,data_set,function(data){
            $(".typeDetail").html(data);
            //console.log(data);
        });
        return false;
    }

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

</script>