<?php 
include("./config.php");
session_start();

$maKH = $_SESSION['khachhang']['MaKH'];

if (isset($_GET['xoaDH']) && isset($_GET['maGHxoa'])) {
    $maGHxoa = $_GET['maGHxoa'];
    $sql_xoa = "delete from giohang where MaGH='$maGHxoa'";
    mysqli_query($mysqli, $sql_xoa);

    //Cập nhật lại số SP mua
    // (new SQL)->reloadCartArea(); 
    // reload_parent();
}

if (isset($_GET['maGH'])) {
    $maGHchange = $_GET['maGH'];

    $sql = "SELECT * from dienthoai,giohang where dienthoai.MaDT=giohang.MaDT and giohang.MaGH='$maGHchange'";
    $sqlResult = $mysqli->query($sql)->fetch_array();

    $soLuongMua = $sqlResult['SoLuongMua'];
    $hangCon = $sqlResult['SoLuong']-$sqlResult['DaBan'];
    // Event nút giảm
    if (isset($_GET['giamSL'])) {
        if ($soLuongMua <= 1) {
            $_SESSION['err'] = "Số lượng đặt hàng đạt tối thiểu, mời xóa nêu muốn!";
        } else {
            $mysqli->query("UPDATE giohang set SoLuongMua=SoLuongMua-1 where giohang.MaGH='$maGHchange'");
        }
    }
    // Event nút tăng
    if (isset($_GET['tangSL'])) {
        if ($soLuongMua > $hangCon) {
            $_SESSION['err'] = "Số lượng đặt hàng đạt tối đa!";
        } else {
            $mysqli->query("UPDATE giohang set SoLuongMua=SoLuongMua+1 where giohang.MaGH='$maGHchange'");
        }
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
// Material Select Initialization
$(document).ready(function () {
    $(".btn-xoa").click(function(e) {
        e.preventDefault();
        //$("#test").load("temp.php");
        var maGHxoa = $(this).attr("maGHxoa");

        $.get("noidung-giohang.php", {
            maGHxoa: maGHxoa,
            xoaDH: true
      }, function(data) {
        $("#cart-content").html(data);
      }); 
    });

    $(".giamSL").click(function(e) {
        e.preventDefault();
        var maGH = $(this).attr("maGH");

        $.get("noidung-giohang.php", {
            maGH: maGH,
            giamSL: true
      }, function(data) {
        $("#cart-content").html(data);
      }); 
    });

    $(".tangSL").click(function(e) {
        e.preventDefault();
        var maGH = $(this).attr("maGH");

        $.get("noidung-giohang.php", {
            maGH: maGH,
            tangSL: true
      }, function(data) {
        $("#cart-content").html(data);
      }); 
    });

    $("#order-btn").click(function(e) {
        e.preventDefault();
        $("#order-content").load("bieumaumuahang.php");
    });

});
</script>
<table class="table product-table table-cart-v-2">
    <thead class="mdb-color danger-color-dark">
        <tr style="color: white">
            <th></th>
            <th class="font-weight-bold">
                <strong>Tên sản phẩm</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Màu sắc</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Giá</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Số lượng</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Tổng</strong>
            </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sql_giohang = "SELECT * FROM giohang, dienthoai WHERE giohang.MaDT = dienthoai.MaDT AND giohang.MaKH ='$maKH'";
            $query_giohang = mysqli_query($mysqli, $sql_giohang);
            $tongTien=0;
            while ($row_giohang = mysqli_fetch_array($query_giohang)) {
        ?>
        <tr>
            <th scope="row">
                <img src="./Images/AnhDT/<?php 
                    $sql_anhdt = "SELECT * FROM hinhanh WHERE Hinh_index = 1 AND MaDT = ".' '.$row_giohang['MaDT'];
                    $query_anhdt = mysqli_query($mysqli, $sql_anhdt);
                    $row_anhdt = mysqli_fetch_array($query_anhdt);
                    echo $row_anhdt['TenHinh'] ?>"
                    alt="" class="img-fluid z-depth-0" width="120px" height="120px">
            </th>
            <td>
                <h5 class="mt-3">
                    <strong><?php echo $row_giohang['TenDT'] ?></strong>
                </h5>
                <p class="text-muted"><?php
                    $sql_hang = "SELECT * FROM dienthoai, hangsx WHERE dienthoai.MaHang = hangsx.MaHang AND MaDT = ".' '.$row_giohang['MaDT'];
                    $query_hang = mysqli_query($mysqli, $sql_hang);
                    $row_hang = mysqli_fetch_array($query_hang);
                    echo $row_hang['TenHang'];
                ?></p>
            </td>
            <td><?php 
                $sql_mausacdt = "SELECT * FROM giohang, mausacdt WHERE giohang.MauSac = mausacdt.MaMS AND giohang.MaDT = mausacdt.MaDT AND giohang.MaGH = ".' '.$row_giohang['MaGH'];
                $query_mausacdt = mysqli_query($mysqli, $sql_mausacdt);
                $row_mausacdt = mysqli_fetch_array($query_mausacdt);
                echo $row_mausacdt['TenMS'];
            ?></td>
            <td style="color: red; font-size: 18px;font-weight:bold"><?php echo number_format($row_giohang['GiaKhuyenMai'], 0, '', '.') ?> đ</td>
            <td class="text-center text-md-left">
                <span class="qty"><?php echo $row_giohang['SoLuongMua'] ?></span>
                <div class="btn-group radio-group ml-2" data-toggle="buttons">
                <label class="btn btn-sm btn-danger btn-rounded giamSL" maGH="<?php echo $row_giohang['MaGH'] ?>">
                    <input type="radio" name="options">-
                </label>
                <label class="btn btn-sm btn-danger btn-rounded tangSL" maGH="<?php echo $row_giohang['MaGH'] ?>">
                    <input type="radio" name="options">+
                </label>
                </div>
            </td>
            <td style="color: red; font-size: 18px;font-weight:bold"><?php $tien=$row_giohang['GiaKhuyenMai']*$row_giohang['SoLuongMua']; $tongTien+=$tien;  echo number_format($tien, 0, '', '.') ?> đ</td>
            <td>
                <button type="button" class="btn btn-sm btn-danger btn-xoa" data-toggle="tooltip" data-placement="top" maGHxoa="<?php echo $row_giohang['MaGH'] ?>" title="Remove item">X
                </button>
            </td>
        </tr>
        <?php
            }
        ?>
        <tr>
            <td colspan="3"><div style="color:red;font-weight:bold"><?php if (isset($_SESSION['err'])) {echo $_SESSION['err']; unset($_SESSION['err']);} ?></div></td>
            <td>
                <h4 class="mt-2">
                    <strong>Tổng tiền:</strong>
                </h4>
            </td>
            <td class="text-right">
                <h4 class="mt-2">
                    <strong style="color: red"><?php echo number_format($tongTien, 0, '', '.') ?></strong>
                </h4>
            </td>
            <td colspan="3" class="text-right">
                <button type="button" class="btn btn-danger btn-rounded" id="order-btn">THANH TOÁN
                </button>
            </td>
        </tr>
    </tbody>
</table>