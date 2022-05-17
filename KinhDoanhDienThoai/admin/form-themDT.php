<?php
include "connect.php";
session_start();

$sqlHangsx = "SELECT * FROM `hangsx`";
$resultHangsx = mysqli_query($conn, $sqlHangsx);

$sqlKhuyenMai = "SELECT * FROM `trangthaikm` WHERE MaTTKM='1' OR MaTTKM='3'";
$resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);

//Làm sạch bảng Temp
if (isset($_SESSION['dontCleanTemp'])) { unset($_SESSION['dontCleanTemp']); }else { mysqli_query($conn, "DELETE FROM temp"); }

?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
    // Validate
    var check_name = false; 
    var check_description = false; 
    // Name
    $("#tenDT-them").keyup(function(e) {
      var value = $(this).val();
      if (value.length == 0 || value.length > 25) {
        if (value.length == 0) $(".error_name").text("*Vui lòng nhập tên điện thoại!");
        if (value.length > 25) $(".error_name").text("*Tên điện thoại không được quá 25 ký tự");
        check_name = false;
      } else {
        $(".error_name").text("");
        check_name = true;
      }
    });
    // Description
    $(".description").keyup(function(e) {
      var value = $(this).val();

      if (value.length > 300) {
        if (value.length > 300) $(".error_description").text("*Mô tả quá dài  !");
        check_description = false;

      } else {
        $(".error_description").text("");
        check_description = true;
      }
    });

    // Thêm điện thoại
    $("#add-save").click(function(e) {
      e.preventDefault();
      if (check_name && check_description) {
        const tenDT    = $("#tenDT-them").val();
        const soLuong  = $("#soLuong-them").val();
        const gia      = $("#gia-them").val();
        const giaKM    = $("#giaKM-them").val();
        const maTTKM   = $("#maTTKM-them").val();
        const tenTTKM  = $("#tenTTKM-them").val();
        const hangsx   = $("#hangsx-them").val();
        const namRaMat = $("#namRaMat-them").val();
        const manHinh  = $("#manHinh-them").val();
        const HDH      = $("#HDH-them").val();
        const CPU      = $("#CPU-them").val();
        const GPU      = $("#GPU-them").val();
        const boNhoTrong    = $("#boNhoTrong-them").val();
        const RAM           = $("#RAM-them").val();
        const cameraTruoc   = $("#cameraTruoc-them").val();
        const cameraSau     = $("#cameraSau-them").val();
        const pin           = $("#pin-them").val();
        const SIM           = $("#SIM-them").val();
        const moTa          = $("#moTa-them").val();
        const tenUD1         = $("#tenUD1-them").val();
        const tenUD2         = $("#tenUD2-them").val();
        const tenUD3         = $("#tenUD3-them").val();
        const tenUD4         = $("#tenUD4-them").val();
        const ndUD1          = $("#ndUD1-them").val();
        const ndUD2          = $("#ndUD2-them").val();
        const ndUD3          = $("#ndUD3-them").val();
        const ndUD4          = $("#ndUD4-them").val();

        $.post("form-action.php", {
          tenDT: tenDT,
          soLuong: soLuong,
          gia: gia,
          giaKM: giaKM,
          maTTKM: maTTKM,
          tenTTKM: tenTTKM,
          hangsx: hangsx,
          namRaMat: namRaMat,
          manHinh: manHinh,
          HDH: HDH,
          CPU: CPU,
          GPU: GPU,
          boNhoTrong: boNhoTrong,
          RAM: RAM,
          cameraTruoc: cameraTruoc,
          cameraSau: cameraSau,
          pin: pin,
          SIM: SIM,
          moTa: moTa,
          tenUD1: tenUD1, tenUD2: tenUD2, tenUD3: tenUD3, tenUD4: tenUD4,
          ndUD1: ndUD1, ndUD2: ndUD2, ndUD3: ndUD3, ndUD4: ndUD4,
          them_dienThoai: true
        }, function() {
          $("#content").load("dienthoai.php");
        });
      } else {
        alert("*Dữ liệu đã nhập có vẻ chưa hợp lệ, mời kiểm tra lại!");
        return false; 
      }
    });

    // Thêm ảnh
    // // Thêm và review ảnh index    
    $("#anhIndex").change(function(e) {
        e.preventDefault();

        var files = document.getElementById("anhIndex").files;
        var formData = new FormData();
        formData.append("anhIndex", files[0]);

        $.ajax({
            type: "POST",
            url: "form-action.php",
            success: function () {$("#content").load("form-themDT.php");},
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    });
    // xóa ảnh index
    $("#xoaAnhIndex").click(function(e) {
        e.preventDefault();
        var path = $(this).attr("pathIndexImage");
        $.get("form-action.php", {
            path: path,
            xoa_anhIndex: true
        }, function() {
          $("#content").load("form-themDT.php");
        });
    });
    // // Thêm và review ảnh khác   
    $("#anhDT").change(function(e) {
        e.preventDefault();

        var files = document.getElementById("anhDT").files;
        var formData = new FormData();
        formData.append("anhDT", files[0]);

        $.ajax({
            type: "POST",
            url: "form-action.php",
            success: function () {$("#content").load("form-themDT.php");},
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout: 60000
        });
    });
    // xóa ảnh khác
    $(".xoaAnh").click(function(e) {
        e.preventDefault();
        var maTemp = $(this).attr("maTemp");
        var path = $(this).attr("path");
        $.get("form-action.php", {
            maTemp: maTemp,
            path: path,
            xoa_anh: true
        }, function() {
          $("#content").load("form-themDT.php");
        });
    });
    // close message
    $(".message-overlay").click(function(e) {
      $(".message").hide(500);
      $(".message-overlay").hide();
    });
</script>

<?php if (isset($_SESSION['mess'])) {
    echo '<span class="message-overlay"></span>';
    echo '<span class="message">' . $_SESSION['mess'] . '</span>';
    unset($_SESSION['mess']);
} ?>
<div class="row">
    <div class="col">
        <div class="list-personnel">
            
            <!-- Thêm điện thoại -->
            <div class="row">
                <span class="list-personnel__title"> Thêm điện thoại </span>
            </div>
            <!-- <div class="row form-item justify-content-center">
                <span style="font-size:12px;color:slategray;">*Chọn xong ảnh trước khi nhập nội dung, tránh mất dữ liệu!*</span>
            </div> -->
            <form action="">
                <!-- Line 1 -->
                <div class="row form-item justify-content-between">
                    <!-- Nút thêm ảnh đại diện sp -->
                    <div class="col-4 d-flex flex-wrap justify-content-center">
                        <button type="button" class="form-submit">
                            <label for="anhIndex">Thêm ảnh đại diện sản phẩm</label>
                        </button>
                        <input id="anhIndex" name="anhIndex" type="file" style="display:none;" accept="image/*">
                    </div>
                    <!-- Nút thêm ảnh sp -->
                    <div class="col-6 d-flex flex-wrap justify-content-center">
                        <button type="button" class="form-submit">
                            <label for="anhDT">Thêm ảnh sản phẩm</label>
                        </button>
                        <input id="anhDT" type="file" style="display:none;" accept="image/*">
                    </div>                    
                </div>
                <!-- Line 2 -->
                <div class="row form-item justify-content-between align-items-center">
                    <?php 
                        $sqlTempIndex = mysqli_query($conn, "SELECT TempData FROM temp WHERE TempIndex='1'");

                        if (mysqli_num_rows($sqlTempIndex) != 0) {
                            $resultTempIndex = mysqli_fetch_array($sqlTempIndex);
                            $indexImage = "../Images/Temp/" . $resultTempIndex[0];
                        }
                    ?>
                    <!-- Review ảnh đại điện sp -->
                    <div class="col-4 d-flex flex-wrap justify-content-center">
                        <?php if (isset($indexImage)) : ?>
                            <img id="reviewIndex" width="120px" height="150px"
                            src="<?php echo $indexImage ?>" alt="Ảnh đại diện sản phẩm">                        
                            <button class="far form-icon" style="height:30px;" id="xoaAnhIndex" pathIndexImage="<?php echo $indexImage ?>">X</button>
                        <?php endif; ?>
                    </div>                 
                    <!-- Review ảnh sp -->
                    <div class="col-6 overflow-auto d-flex flex-nowrap">
                        <?php 
                            $sqlTemp = mysqli_query($conn, "SELECT * FROM temp WHERE TempIndex='0'");
                            if (mysqli_num_rows($sqlTemp) != 0) : 
                                while ($imageArr = mysqli_fetch_array($sqlTemp)) {
                                    $i = $imageArr['MaTemp'];
                                    ${"image".$i} = "../Images/Temp/" . $imageArr['TempData'];
                        ?>
                            <img id="review" width="120px" height="150px" src="<?php echo ${"image".$i} ?>" alt="Ảnh sản phẩm">
                            <button class="far form-icon xoaAnh" style="height:30px;" maTemp="<?php echo $i ?>" path="<?php echo ${"image".$i} ?>">X</button>
                        <?php   } endif; ?>
                    </div>                    
                </div>
                <hr><br>
                <!-- Line 3 -->
                <div class="row form-item align-items-center">
                    <div class="col-2">
                        <label for="tenDT-them" class="form-lable">Tên điện thoại: </label>
                    </div>
                    <div class="col-10">
                        <input class="form-input" type="text" name="tenDT-them" id="tenDT-them"/>
                    </div>
                </div>
                <div class="row error error_name"></div>
                <!-- Line 4-->
                <div class="row form-item justify-content-between">
                    <!-- Số lượng -->
                    <div class="col-2">
                        <label for="soLuong-them" class="form-lable">Số lượng: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="soLuong-them" id="soLuong-them" min="0" value="1" />
                    </div>
                    <!-- Giá -->
                    <div class="col-1">
                        <label for="gia-them" class="form-lable">Giá gốc: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="gia-them" id="gia-them" min="0" value="0" />
                    </div>
                    <!-- Giá KM -->
                    <div class="col-1">
                        <label for="giaKM-them" class="form-lable">Giá KM: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="giaKM-them" id="giaKM-them" min="0" value="0" />
                    </div>
                </div>
                <!-- Line 5 -->
                <div class="row form-item justify-content-between">
                    <div class="col-3">
                        <label for="maTTKM-them" class="form-lable">Tình trạng khuyến mãi: </label>
                    </div>
                    <div class="col-2">
                        <select class="form-input" id="maTTKM-them" name="maTTKM-them">
                            <?php foreach ($resultKhuyenMai as $key) : ?>
                                <option value="<?php echo $key['MaTTKM'] ?>"><?php echo $key['TenTTKM'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-2">
                        <label for="tenTTKM-them" class="form-lable">Chi tiết KM: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="tenTTKM-them" id="tenTTKM-them"/>
                    </div>
                </div>
                <!-- Line 6 -->
                <div class="row form-item justify-content-between">
                    <!-- Hãng SX -->
                    <div class="col-3">
                        <label for="hangSX-them" class="form-lable">Hãng SX:</label>
                    </div>
                    <div class="col-2">
                        <select class="form-input" id="hangsx-them" name="hangSX-them">
                            <?php foreach ($resultHangsx as $key) : ?>
                                <option value="<?php echo $key['MaHang'] ?>"><?php echo $key['TenHang'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Năm ra mắt -->
                    <div class="col-2">
                        <label for="namRaMat-them" class="form-lable">Năm ra mắt: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="namRaMat-them" id="namRaMat-them"/>
                    </div>
                </div>  
                <!-- Line 7 -->
                <div class="row form-item justify-content-between">
                    <div class="col-1">
                        <label for="manHinh-them" class="form-lable">Màn hình: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="manHinh-them" id="manHinh-them" />
                    </div>
                    <!-- HDH -->
                    <div class="col-2">
                        <label for="HDH-them" class="form-lable">Hệ điều hành: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="HDH-them" id="HDH-them"/>
                    </div>
                </div> 
                <!-- Line 8   -->
                <div class="row form-item justify-content-between">
                    <!-- CPU -->
                    <div class="col-1">
                        <label for="CPU-them" class="form-lable">CPU: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="CPU-them" id="CPU-them" />
                    </div>
                    <!-- GPU -->
                    <div class="col-1">
                        <label for="GPU-them" class="form-lable">GPU: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="GPU-them" id="GPU-them" />
                    </div>
                </div>
                <!-- Line 9 -->
                <div class="row form-item justify-content-between">
                    <!-- Bộ nhớ trong -->
                    <div class="col-1">
                        <label for="boNhoTrong-them" class="form-lable">Bộ nhớ trong: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="boNhoTrong-them" id="boNhoTrong-them"/>
                    </div>
                    <!-- RAM -->
                    <div class="col-1">
                        <label for="RAM-them" class="form-lable">RAM: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="RAM-them" id="RAM-them"/>
                    </div>
                </div>
                <!-- Line 10 -->
                <div class="row form-item justify-content-between">
                    <!-- Cam trước -->
                    <div class="col-1">
                        <label for="cameraTruoc-them" class="form-lable">Camera trước: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="cameraTruoc-them" id="cameraTruoc-them"/>
                    </div>
                    <!-- Cam sau -->
                    <div class="col-1">
                        <label for="cameraSau-them" class="form-lable">Camera sau: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="cameraSau-them" id="cameraSau-them"/>
                    </div>
                </div>
                <!-- Line 11 -->
                <div class="row form-item justify-content-between">
                    <!-- Pin -->
                    <div class="col-1">
                        <label for="pin-them" class="form-lable">Pin: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="pin-them" id="pin-them"/>
                    </div>
                    <!-- SIM -->
                    <div class="col-1">
                        <label for="SIM-them" class="form-lable">SIM: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="SIM-them" id="SIM-them"/>
                    </div>
                </div>
                <!-- Line 12 -->
                <div class="row form-item align-items-center">
                    <textarea class="description" id="moTa-them" placeholder="Mô tả" rows="3"></textarea>
                </div>
                <div class="row error error_description"></div>
                <!-- Line 13 -->
                <div class="row form-item justify-content-between">
                    <!-- Tên ưu điểm 1 -->
                    <div class="col-2">
                        <label for="tenUD1-them" class="form-lable">Ưu điểm 1: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="tenUD1-them" id="tenUD1-them"/>
                    </div>
                    <!-- Tên ưu điểm 2 -->
                    <div class="col-2">
                        <label for="tenUD2-them" class="form-lable">Ưu điểm 2: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="tenUD2-them" id="tenUD2-them"/>
                    </div>
                </div>
                <!-- Line 14 -->
                <div class="row form-item justify-content-between">
                    <div class="col 4">
                        <textarea class="form-text" id="ndUD1-them" placeholder="Nội dung ưu điểm 1" rows="3"></textarea>
                    </div>      
                    <div class="col 4">
                        <textarea class="form-text" id="ndUD2-them" placeholder="Nội dung ưu điểm 2" rows="3"></textarea>
                    </div>               
                </div>
                <!-- Line 15 -->
                <div class="row form-item justify-content-between">
                    <!-- Tên ưu điểm 3 -->
                    <div class="col-2">
                        <label for="tenUD3-them" class="form-lable">Ưu điểm 3: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="tenUD3-them" id="tenUD3-them"/>
                    </div>
                    <!-- Tên ưu điểm 4 -->
                    <div class="col-2">
                        <label for="tenUD4-them" class="form-lable">Ưu điểm 4: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="tenUD4-them" id="tenUD4-them"/>
                    </div>
                </div>
                <!-- Line 16 -->
                <div class="row form-item justify-content-between">
                    <div class="col 4">
                        <textarea class="form-text" id="ndUD3-them" placeholder="Nội dung ưu điểm 3" rows="3"></textarea>
                    </div>      
                    <div class="col 4">
                        <textarea class="form-text" id="ndUD4-them" placeholder="Nội dung ưu điểm 4" rows="3"></textarea>
                    </div>               
                </div>

                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <button type="submit" class="form-submit" id="add-save">Xác nhận thêm mới</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>