<!-- modal Del -->
<div class="modal fade" id="delData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-white bg-danger">
        <h5 class="modal-title" id="exampleModalLabel">ลบข้อมูลรายการ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
            if(isset($_POST["accountNo"])){
               $accountNo = $_POST["accountNo"];

               require_once '../api/connect.php';
               $sql = "SELECT accountNo FROM rice_account WHERE accountNo='$accountNo'";
               $query  = mysqli_query($conn,$sql);
               $data = mysqli_fetch_array($query);
        ?> 
               ต้องการลบข้อมูลเลขที่ '<?php echo $data["accountNo"]; ?>' นี้ใช่หรือไม่ ? 
        <?php
            }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
        <button type="button" id="<?php echo $accountNo;?>"  class="btn btn-danger confirm"><i class="far fa-share-square"></i> ยืนยัน</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(".confirm").click(function(){
      var accountNo = $(this).attr('id');
      var url = "../api/editDel.php";
      var data_set = {accountNo: accountNo};
      $.post(url,data_set,function(data){
        //console.log(data);
        if(data==""){
          $('#success').modal('show');
          setTimeout(function() {
            window.location.href="editAccount";
          },1000);
        }else if(data=="Not Query"){
          alert('ไม่สามารถลบข้อมูลได้ติดต่อผู้ดูแลระบบ');
          $('#error').modal('show');
        }
      });
        return false;
    });
</script>