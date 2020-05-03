<?php
    date_default_timezone_set("Asia/Bangkok");
    $date=date("Y-m-d");

    if(isset($_POST["num"])){
        $num = $_POST["num"];
        $name = $num."[]";
    }

    require_once '../api/connect.php';
    $sql_location="SELECT * FROM location";
    $query_location=mysqli_query($conn,$sql_location);
    $row_location=mysqli_num_rows($query_location);

    $sql_vehicle="SELECT * FROM vehicle";
    $query_vehicle=mysqli_query($conn,$sql_vehicle);
    $row_vehicle=mysqli_num_rows($query_vehicle);

    $sql_type="SELECT * FROM type";
    $query_type=mysqli_query($conn,$sql_type);
    $row_type=mysqli_num_rows($query_type);
?>
<tr class="d-flex">
    <td class="col-2"><input class="form-control" name="date[]" type="date" value="<?php echo $date ?>"></td>
    <td class="col-2 input-group">
        <select class="form-control form-control-sm location" stlye="margin" name="location[]">
            <?php
                for($i=0;$i<$row_location;$i++){
                    $data_location=mysqli_fetch_array($query_location);
                    $locationNo = $data_location["locationNo"];
                    $location = $data_location["location"];
                    
                    if($location!="noData"){
                        echo "<option value='$locationNo'>$location</option>";
                    }
                }
            ?>
                    <option value='noData' selected>---</option>
        </select>
    </td>
    <td class="col-1 input-group">
        <select class="form-control form-control-sm type" stlye="margin" name="type[]">
            <?php
                for($i=0;$i<$row_type;$i++){
                    $data_type=mysqli_fetch_array($query_type);
                    $typeNo = $data_type["typeNo"];
                    $type = $data_type["type"];

                    if($type!="noData"){
                        echo "<option value='$typeNo'>$type</option>";
                    }
                }
            ?>
                    <option value='noData' selected>---</option>
        </select>                    
    </td>
    <td class="col-1"><input class="form-control form-control-sm purchase input-no-spinner" step="0.01" name="purchase[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm total input-no-spinner" step="0.01" name="total[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm service input-no-spinner" step="0.01" name="service[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm average input-no-spinner" step="0.01" name="average[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm income input-no-spinner" step="0.01" name="income[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm interest input-no-spinner" step="0.01" name="interest[]" type="number"></td>
    <td class="col-1"><input class="form-control form-control-sm withdraw input-no-spinner" step="0.01" name="withdraw[]" type="number"></td>   
    <td class="col-2"><input class="form-control form-control-sm note" name="note[]" type="text"></td>
    <td class="col-2 input-group">
        <select multiple class="form-control form-control-sm selectpicker vehicle" name="<?php echo $name; ?>" dropupAuto="false" data-size="3" data-live-search="true">
            <?php
                for($i=0;$i<$row_vehicle;$i++){
                    $data_vehicle=mysqli_fetch_array($query_vehicle);
                    $vehicleNo = $data_vehicle["vehicleNo"];
                    $vehicle = $data_vehicle["vehicle"];

                    if($vehicle!="noData"){
                        echo "<option value='$vehicleNo'>$vehicle</option>";
                    }
                }
            ?>
        </select>       
    </td>
</tr>

<script>
    $('.vehicle').selectpicker();
</script>