<?php
include "connect.php";
session_start();

//Tính toán số dữ liệu để hiển thị theo trang
// $numOfData = 15; //Số dữ liệu hiển thị trong 1 trang
// $sql = "select count(*) from dienthoai";
// $sql_1 = $conn->query($sql)->fetch_array();
// $numOfPages = ceil($sql_1[0]/$numOfData);

// if (!isset($_GET['page'])) {
//     //Vị trí bắt đầu
//     $vtbd = 0;
// } else {
//     $vtbd = ($_GET['page']-1) * $numOfData;
// }

$sql_hangsx = "SELECT * FROM `hangsx`";
$sql = "SELECT * FROM `dienthoai`,`hangsx` WHERE `dienthoai`.MaHang=`hangsx`.MaHang ORDER BY `dienthoai`.MaDT DESC";// LIMIT $vtbd,$numOfData";

if (isset($_GET['search']) && isset($_GET['key'])) {
  $key = $_GET['key'];
  $sql = "SELECT * FROM `dienthoai`,`hangsx` WHERE `dienthoai`.MaHang=`hangsx`.MaHang  AND `dienthoai`.TenDT LIKE '%$key%' ORDER BY `dienthoai`.MaDT DESC";// LIMIT $vtbd,$numOfData";
}

$result_hangsx = mysqli_query($conn, $sql_hangsx);
$result = mysqli_query($conn, $sql);
?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>

<script>
  $(document).ready(function() {
    // Pagination
    // $(".page-item").click(function(e) {
    //   e.preventDefault();

    //   var Page = $(this).attr("Page");

    //   $.get("dienthoai.php", {
    //     page: Page,
    //     pagination: true
    //   }, function(data) {
    //     $("#content").html(data);
    //   });

    //   $(".page-item").click(function() {
    //     $(".page-item").removeClass("active");
    //     $(this).toggleClass("active");
    //   });
    // });

    // Thêm sản phẩm mới
    $("#them-dienthoai").click(function(e) {
      check_name = false;
      check_rule = false;

      $("#content").load("form-themDT.php");
    });

    // Sửa thông tin điện thoại
    $(".sua-dienthoai").click(function() {
      let MaDT = $(this).attr("MaDT-sua");

      $.post("form-action.php", {
          maDT: MaDT,
          sua_dienthoai: true
        }, function() {
          $("#content").load("form-suaDT.php");
        }
      );
    });

    $("#edit-save").click(function(e) {
      e.preventDefault();

      if (check_name && check_rule && check_description) {
        const MSHH = $("#MSHH").val(); //Mã hàng hóa
        const name = $("#name").val(); //Tên hàng hóa
        const rule = $("#rule").val(); //Quy cách
        const quantity = $("#quantity").val(); //Số lượng
        const price = $("#price").val(); //Giá
        const category = $("#category-id").val(); //Loại hàng 
        const description = $("#description").val(); //Ghi chú

        $.get("action.php", {
          MSHH: MSHH,
          name: name,
          rule: rule,
          quantity: quantity,
          price: price,
          category: category,
          description: description,
          sub_edit_product: true

        }, function() {
          $("#content").load("product.php");
        });
      } else return false;
    });

    // Xóa sản phẩm
    $(".xoa-dienthoai").click(function() {
      let MaDT = $(this).attr("MaDT-xoa");

      $.get("action.php", {
          maDT: MaDT,
          xoa_dienthoai: true
        }, function() {
          $("#content").load("dienthoai.php");
        }
      );
    });

    // Close
    $(".icon-close").click(function() {
      $(".form").hide(500);
      $(".form-layout").hide();
    });

    // Search
    $("#form-search").click(function(e) {
      e.preventDefault();
      var key = $("#search").val();
      $.get("dienthoai.php", {
        key: key,
        search: true
      }, function(data) {
        $("#content").html(data);
      });
    });

    // Mess
    $(".message-overlay").click(function(e) {
      $(".message").hide(500);
      $(".message-overlay").hide();
    });

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
      <div class="row">
        <span class="list-personnel__title"> Danh sách điện thoại </span>
      </div>
      <div class="row align-items-center justify-content-end">
      <div class="col justify-content-start">
        <span class="icon-add" id="them-dienthoai">
          Thêm <i class="fas fa-plus"></i>
        </span>
      </div>
        <div class="col-3">
          <form action="">
            <input type="text" name="" id="search" class="form-input" placeholder="Search"/>
            <button type="submit" class="form-search" id="form-search">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>            
            <th scope="col">Mã DT</th>
            <th scope="col"></th>
            <th scope="col">Tên điện thoại</th>
            <th scope="col">Giá gốc</th>
            <th scope="col">Giá KM</th>
            <!-- <th scope="col">TTKM</th> -->
            <th scope="col">Loại KM</th>
            <!-- <th scope="col">Mô tả</th> -->
            <!-- <th scope="col">Số lượng</th> -->
            <th scope="col">Đã bán</th>
            <th scope="col">Hãng Sx</th>
            <th scope="col">Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key) : ?>
            <tr>
              <th scope="row"><?php echo $key['MaDT'] ?></th>
              <td>
                <?php 
                  $sql_hinhanh = mysqli_query($conn, "SELECT TenHinh FROM `hinhanh` WHERE MaDT='" . $key['MaDT'] . "' AND `hinhanh`.Hinh_index='1'"); 
                  $result_hinhanh = mysqli_fetch_array($sql_hinhanh);
                ?>
                <img center width="80px" height="100px" src="../Images/AnhDT/<?php echo $result_hinhanh[0] ?>">
              </td>
              <td><?php echo $key['TenDT'] ?></td>
              <td><?php echo number_format($key['GiaGoc'], 0, '', '.') ?></td>
              <td><?php echo number_format($key['GiaKhuyenMai'], 0, '', '.') ?></td>
              <!-- <td><?php echo $key['TrangThaiKM'] ?></td> -->
              <td><?php echo $key['TenTTKM'] ?></td>
              <!-- <td><?php echo $key['MoTa'] ?></td> -->
              <!-- <td><?php echo $key['SoLuong'] ?></td> -->
              <td><?php echo $key['DaBan'] ."/". $key['SoLuong'] ?></td>
              <td><?php echo $key['TenHang'] ?></td>
              <td>
                <span class="sua-dienthoai" MaDT-sua="<?php echo $key['MaDT'] ?>">
                  <i class="far fa-edit form-icon"></i>
                </span>
                <span class="xoa-dienthoai" MaDT-xoa="<?php echo $key['MaDT'] ?>">
                  <i class="far fa-trash-alt form-icon"></i>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>