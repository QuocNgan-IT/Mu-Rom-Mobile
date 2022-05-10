<?php
include "connect.php";
session_start();

if (isset($_POST['sua_dienthoai'])) {
    $maDT = $_POST['MaDT'];

    $sqlDienThoai = "SELECT * FROM `dienthoai`,`cauhinhdt` WHERE `dienthoai`.MaDT=`cauhinhdt`.MaDT AND `dienthoai`.MaDT='$maDT'";
}

$sqlHangsx = "SELECT * FROM `hangsx`";
$resultHangsx = mysqli_query($conn, $sqlHangsx);

$sqlKhuyenMai = "SELECT * FROM `trangthaikm`";
$resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
    // Validate
    var check_name = false; 
    var check_description = false; 
    // Name
    $("#tenDT-sua").keyup(function(e) {
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

    // Sửa điện thoại
    $("#edit-save").click(function(e) {
      e.preventDefault();
      if (check_name && check_description) {
        const tenDT    = $("#tenDT-sua").val();
        const soLuong  = $("#soLuong-sua").val();
        const gia      = $("#gia-sua").val();
        const giaKM    = $("#giaKM-sua").val();
        const maTTKM   = $("#maTTKM-sua").val();
        const tenTTKM  = $("#tenTTKM-sua").val();
        const hangsx   = $("#hangsx-sua").val();
        const namRaMat = $("#namRaMat-sua").val();
        const manHinh  = $("#manHinh-sua").val();
        const HDH      = $("#HDH-sua").val();
        const CPU      = $("#CPU-sua").val();
        const GPU      = $("#GPU-sua").val();
        const boNhoTrong    = $("#boNhoTrong-sua").val();
        const RAM           = $("#RAM-sua").val();
        const cameraTruoc   = $("#cameraTruoc-sua").val();
        const cameraSau     = $("#cameraSau-sua").val();
        const pin           = $("#pin-sua").val();
        const SIM           = $("#SIM-sua").val();
        const moTa          = $("#moTa-sua").val();

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
          boNhoTrong: boNhoTrong,
          RAM: RAM,
          cameraTruoc: cameraTruoc,
          cameraSau: cameraSau,
          pin: pin,
          SIM: SIM,
          moTa: moTa,
          sua_dienThoai: true
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
    $("#anhIndex-sua").change(function(e) {
        e.preventDefault();

        var files = document.getElementById("anhIndex-sua").files;
        var formData = new FormData();
        formData.append("anhIndex-sua", files[0]);

        $.ajax({
            type: "POST",
            url: "form-action.php",
            success: function () {$("#content").load("form-suaDT.php");},
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
          $("#content").load("form-suaDT.php");
        });
    });
    // // Thêm và review ảnh khác   
    $("#anhDT-sua").change(function(e) {
        e.preventDefault();

        var files = document.getElementById("anhDT-sua").files;
        var formData = new FormData();
        formData.append("anhDT-sua", files[0]);

        $.ajax({
            type: "POST",
            url: "form-action.php",
            success: function () {$("#content").load("form-suaDT.php");},
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
          $("#content").load("form-suaDT.php");
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
            
            <!-- Sửa điện thoại -->
            <div class="row">
                <span class="list-personnel__title"> Sửa thông tin điện thoại </span>
            </div>
            <div class=" form-item justify-content-end">
                <span style="font-size:12px;color:slategray;">*Chọn xong ảnh trước khi nhập nội dung, tránh mất dữ liệu!*</span>
            </div>
            <form action="">
                <!-- Line 1 -->
                <div class="row form-item justify-content-between">
                    <!-- Nút thêm ảnh đại diện sp -->
                    <div class="col-4">
                        <button type="button" class="form-submit">
                            <label for="anhIndex-sua">Thêm ảnh đại diện sản phẩm</label>
                        </button>
                        <input id="anhIndex-sua" name="anhIndex-sua" type="file" style="display:none;" accept="image/*">
                    </div>
                    <!-- Nút thêm ảnh sp -->
                    <div class="col-6">
                        <button type="button" class="form-submit">
                            <label for="anhDT-sua">Thêm ảnh sản phẩm</label>
                        </button>
                        <input id="anhDT-sua" type="file" style="display:none;" accept="image/*">
                    </div>                    
                </div>
                <!-- Line 2 -->
                <div class="row form-item d-flex flex-wrap justify-content-between align-items-center">
                    <?php 
                        $sqlTempIndex = mysqli_query($conn, "SELECT TempData FROM temp WHERE TempIndex='1'");

                        if (mysqli_num_rows($sqlTempIndex) != 0) {
                            $resultTempIndex = mysqli_fetch_array($sqlTempIndex);
                            $indexImage = "../Images/Temp/" . $resultTempIndex[0];
                        }
                    ?>
                    <!-- Review ảnh đại điện sp -->
                    <div class="col-4">
                        <?php if (isset($indexImage)) : ?>
                            <img id="reviewIndex" width="120px" height="150px"
                            src="<?php echo $indexImage ?>" alt="Ảnh đại diện sản phẩm">                        
                            <button class="far form-icon" id="xoaAnhIndex" pathIndexImage="<?php echo $indexImage ?>">X</button>
                        <?php endif; ?>
                    </div>                 
                    <!-- Review ảnh sp -->
                    <div class="col-6" style="overflow-x:auto;white-space:nowrap">
                        <?php 
                            $sqlTemp = mysqli_query($conn, "SELECT * FROM temp WHERE TempIndex='0'");
                            if (mysqli_num_rows($sqlTemp) != 0) : 
                                while ($imageArr = mysqli_fetch_array($sqlTemp)) {
                                    $i = $imageArr['MaTemp'];
                                    ${"image".$i} = "../Images/Temp/" . $imageArr['TempData'];
                        ?>
                            <img id="review" width="120px" height="150px" src="<?php echo ${"image".$i} ?>" alt="Ảnh sản phẩm">
                            <button class="far form-icon xoaAnh" maTemp="<?php echo $i ?>" path="<?php echo ${"image".$i} ?>">X</button>
                        <?php   } endif; ?>
                    </div>                    
                </div>
                <hr><br>
                <!-- Line 3 -->
                <div class="row form-item align-items-center">
                    <div class="col-2">
                        <label for="tenDT-sua" class="form-lable">Tên điện thoại: </label>
                    </div>
                    <div class="col-10">
                        <input class="form-input" type="text" name="tenDT-sua" id="tenDT-sua"/>
                    </div>
                </div>
                <div class="row error error_name"></div>
                <!-- Line 4-->
                <div class="row form-item justify-content-between">
                    <!-- Số lượng -->
                    <div class="col-2">
                        <label for="soLuong-sua" class="form-lable">Số lượng: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="soLuong-sua" id="soLuong-sua" min="0" value="1" />
                    </div>
                    <!-- Giá -->
                    <div class="col-1">
                        <label for="gia-sua" class="form-lable">Giá: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="gia-sua" id="gia-sua" min="0" value="0" />
                    </div>
                    <!-- Giá KM -->
                    <div class="col-1">
                        <label for="giaKM-sua" class="form-lable">Giá KM: </label>
                    </div>
                    <div class="col-2">
                        <input type="number" name="giaKM-sua" id="giaKM-sua" min="0" value="0" />
                    </div>
                </div>
                <!-- Line 5 -->
                <div class="row form-item justify-content-between">
                    <div class="col-3">
                        <label for="maTTKM-sua" class="form-lable">Tình trạng khuyến mãi: </label>
                    </div>
                    <div class="col-2">
                        <select class="form-input" id="maTTKM-sua" name="maTTKM-sua">
                            <?php foreach ($resultKhuyenMai as $key) : ?>
                                <option value="<?php echo $key['MaTTKM'] ?>"><?php echo $key['TenTTKM'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-2">
                        <label for="tenTTKM-sua" class="form-lable">Chi tiết KM: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="tenTTKM-sua" id="tenTTKM-sua"/>
                    </div>
                </div>
                <!-- Line 6 -->
                <div class="row form-item justify-content-between">
                    <!-- Hãng SX -->
                    <div class="col-3">
                        <label for="hangSX-sua" class="form-lable">Hãng SX:</label>
                    </div>
                    <div class="col-2">
                        <select class="form-input" id="hangsx-sua" name="hangSX-sua">
                            <?php foreach ($resultHangsx as $key) : ?>
                                <option value="<?php echo $key['MaHang'] ?>"><?php echo $key['TenHang'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Năm ra mắt -->
                    <div class="col-2">
                        <label for="namRaMat-sua" class="form-lable">Năm ra mắt: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="namRaMat-sua" id="namRaMat-sua"/>
                    </div>
                </div>  
                <!-- Line 7 -->
                <div class="row form-item justify-content-between">
                    <div class="col-1">
                        <label for="manHinh-sua" class="form-lable">Màn hình: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="manHinh-sua" id="manHinh-sua" />
                    </div>
                    <!-- HDH -->
                    <div class="col-2">
                        <label for="HDH-sua" class="form-lable">Hệ điều hành: </label>
                    </div>
                    <div class="col-3">
                        <input class="form-input" type="text" name="HDH-sua" id="HDH-sua"/>
                    </div>
                </div> 
                <!-- Line 8   -->
                <div class="row form-item justify-content-between">
                    <!-- CPU -->
                    <div class="col-1">
                        <label for="CPU-sua" class="form-lable">CPU: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="CPU-sua" id="CPU-sua" />
                    </div>
                    <!-- GPU -->
                    <div class="col-1">
                        <label for="GPU-sua" class="form-lable">GPU: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="GPU-sua" id="GPU-sua" />
                    </div>
                </div>
                <!-- Line 9 -->
                <div class="row form-item justify-content-between">
                    <!-- Bộ nhớ trong -->
                    <div class="col-1">
                        <label for="boNhoTrong-sua" class="form-lable">Bộ nhớ trong: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="boNhoTrong-sua" id="boNhoTrong-sua"/>
                    </div>
                    <!-- RAM -->
                    <div class="col-1">
                        <label for="RAM-sua" class="form-lable">RAM: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="RAM-sua" id="RAM-sua"/>
                    </div>
                </div>
                <!-- Line 10 -->
                <div class="row form-item justify-content-between">
                    <!-- Cam trước -->
                    <div class="col-1">
                        <label for="cameraTruoc-sua" class="form-lable">Camera trước: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="cameraTruoc-sua" id="cameraTruoc-sua"/>
                    </div>
                    <!-- Cam sau -->
                    <div class="col-1">
                        <label for="cameraSau-sua" class="form-lable">Camera sau: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="cameraSau-sua" id="cameraSau-sua"/>
                    </div>
                </div>
                <!-- Line 11 -->
                <div class="row form-item justify-content-between">
                    <!-- Pin -->
                    <div class="col-1">
                        <label for="pin-sua" class="form-lable">Pin: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="pin-sua" id="pin-sua"/>
                    </div>
                    <!-- SIM -->
                    <div class="col-1">
                        <label for="SIM-sua" class="form-lable">SIM: </label>
                    </div>
                    <div class="col-4">
                        <input class="form-input" type="text" name="SIM-sua" id="SIM-sua"/>
                    </div>
                </div>
                <!-- Line 12 -->
                <div class="row form-item align-items-center">
                    <textarea class="description" id="moTa-sua" placeholder="Mô tả" rows="3"></textarea>
                </div>
                <div class="row error error_description"></div>
                
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <button type="submit" class="form-submit" id="edit-save">Xác nhận sửa</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>