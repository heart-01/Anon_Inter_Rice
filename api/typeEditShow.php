<!-- modal EditData -->
<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-warning">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fab fa-pagelines"></i> แก้ไขข้อมูลชนิดข้าว</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="message-text" class="col-form-label">ชื่อชนิดข้าว:</label>
            <?php
                if(isset($_POST["editData"])){
                    require_once '../api/connect.php';
                    $typeNo = $_POST["editData"];
                    $sql="SELECT * FROM type WHERE typeNo='$typeNo'";
                    $query=mysqli_query($conn,$sql);
                    $data=mysqli_fetch_array($query);
                    ?><input class="form-control EditMessage-text" name="mill" id="<?php echo $typeNo; ?>" maxlength="50" value="<?php echo $data["type"]; ?>" required></input><?php
                }
            ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
        <button type="button" id="" class="btn btn-primary btnEdit"><i class="far fa-share-square"></i> ยืนยัน</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(".btnEdit").click(function(){
      var message = $(".EditMessage-text").val();
      var typeNo = $(".EditMessage-text").attr('id');
      if(message==""){
        alert('ไม่สามารถใส่ค่าว่างได้');
        $('#error').modal('show');
        $("#message-text").focus();
      }else if(!/^[\dA-zก-๙/.\s]+$/.test(message) ){
        alert('ไม่สามารถใส่อักษรพิเศษได้');
        $('#error').modal('show');
        $("#message-text").focus();
      }else{

        $.ajax({
          url: '../api/typeEdit.php',
          type: 'POST',
          data: { typeNo: typeNo, type: message},
          success: function(data){
            //console.log(data);
            if(data==""){
              $('#success').modal('show');
              setTimeout(function() {
                window.location.href="detailType";
              },1000);
            }else if(data=="Not Query"){
              alert('ไม่สามารถแก้ไขข้อมูลได้ติดต่อผู้ดูแลระบบ');
              $('#error').modal('show');
            }
			    }
        });

      }
      return false;
	});
</script>