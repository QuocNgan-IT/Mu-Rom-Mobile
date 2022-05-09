<?php
include "connect.php";
session_start();

$sql = "SELECT * FROM `hangsx`";

if (isset($_GET['search']) && isset($_GET['key'])) {
  $key = $_GET['key'];

  $sql = "SELECT * FROM `hangsx` WHERE TenHang LIKE '%$key%'";
}
$result = mysqli_query($conn, $sql);
?>

<script src="bootstrap/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function() {
    // Validate
    var check_name = true; //form edit
    // Name
    $(".name").keyup(function(e) {
      var value = $(this).val();
      if (value.length == 0 || value.length > 25) {
        if (value.length == 0) $(".error_name").text("*Vui lòng nhập tên sản phẩm!");
        if (value.length > 25) $(".error_name").text("*Tên sản phẩm không được quá 25 ký tự");
        check_name = false;
      } else {
        $(".error_name").text("");
        check_name = true;
      }
    });
    // Them hangsx
    $("#add-hangsx").click(function(e) {
      check_name = false;

      $(".form-add").show(500);
      $(".form-layout").show();
    });

    $("#add-save").click(function(e) {
      e.preventDefault();
      if (check_name) {

        const name = $("#name-add").val(); //Tên hãng sản xuất

        $.get("action.php", {
          name: name,
          them_hangsx: true

        }, function() {
          $("#content").load("hangsx.php");
        });
      } else return false;

    });

    // Sua hangsx
    $(".edit-hangsx").click(function() {
      var MaHang = $(this).attr("MaHang");

      $.post("hangsx.php", {
          id: MaHang,
          edit_hangsx: true
        },
        function(data) {
          $("#content").html(data);

          $(".form-edit").show(500);
          $(".form-layout").show();
        }
      );
    });

    $("#edit-save").click(function(e) {
      e.preventDefault();
      if (check_name) {

        const MaHang = $("#MaHang").val(); 
        const name = $("#name").val(); 

        $.get("action.php", {
          MaHang: MaHang,
          name: name,
          sua_hangsx: true

        }, function() {
          $("#content").load("hangsx.php");
        });
      } else return false;

    });

    // Xoa hangsx
    $(".delete-hangsx").click(function() {
      var MaHang = $(this).attr("MaHang");

      $.get("action.php", {
          MaHang: MaHang,
          xoa_hangsx: true
        },
        function(data) {
          $("#content").load("hangsx.php");
        }
      );

    });

    // Search
    $("#form-search").click(function(e) {
      e.preventDefault();
      var key = $("#search").val();

      // console.log(key);

      $.get("hangsx.php", {
        key: key,
        search: true
      }, function(data) {
        $("#content").html(data);
      });

    });

    // Close
    $(".icon-close").click(function() {

      $(".form").hide(500);
      $(".form-layout").hide();
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
        <span class="list-personnel__title"> Danh sách hãng điện thoại </span>
      </div>
      <div class="row align-items-center justify-content-end">
        <div class="col-3">
          <form action="">
            <input type="text" name="" id="search" class="form-input" placeholder="Search" />
            <button type="submit" class="form-search" id="form-search">
              <i class="fas fa-search"></i>
            </button>
          </form>
        </div>
      </div>
      <table class="table">
        <thead>
          <tr>
            <!-- <th scope="col">ảnh hãng</th> -->
            <th scope="col">Mã hãng</th>
            <th scope="col">Tên hãng</th>
            <th scope="col">Tùy chọn</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key) : ?>
            <tr>
              <td scope="row"><?php echo $key['MaHang'] ?></td>
              <td><?php echo $key['TenHang'] ?></td>
              <td>
                <span class="edit-hangsx" MaHang="<?php echo $key['MaHang'] ?>">
                  <i class="far fa-edit form-icon"></i>
                </span>
                <span class="delete-hangsx" MaHang="<?php echo $key['MaHang'] ?>">
                  <i class="far fa-trash-alt form-icon"></i>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="row justify-content-end">
        <span class="icon-add" id="add-hangsx">
          Thêm <i class="fas fa-plus"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Form thêm hãng điện thoại -->
<div class="form-layout"></div>
<div class="form form-add">
  <div class="col">
    <div class="row justify-content-end">
      <i class="fas fa-times icon-close" id="icon-close"></i>
    </div>
    <div class="row">
      <span class="form-title">THÊM HÃNG ĐIỆN THOẠI</span>
    </div>
    <form action="">
      <div class="row form-item align-items-center">
        <input class="form-input name" type="text" id="name-add" placeholder="Tên hãng điện thoại" value="" />
      </div>
      <div class="row error error_name"></div>
      <br />
      <div class="row justify-content-center">
        <div class="col-md-7">
          <button type="submit" class="form-submit" id="add-save">Thêm mới</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php
if (isset($_POST['edit_hangsx']) && isset($_POST['id'])) {
  $id = $_POST['id'];

  $sql = "SELECT * FROM `hangsx` WHERE MaHang = '$id'";
  $temp = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($temp);
?>

<!-- Form sửa hãng điện thoại -->
<div class="form form-edit">
  <div class=" col">
    <div class="row justify-content-end">
      <i class="fas fa-times icon-close" id="icon-close"></i>
    </div>
    <div class="row">
      <span class="form-title">CHỈNH SỬA THÔNG TIN HÃNG DT</span>
    </div>
    <form action="">
      <div class="row form-item align-items-center">
        <input class="form-input name" type="text" id="name" placeholder="Tên hãng điện thoại" value="<?php echo $data['TenHang'] ?>" />
        <input type="hidden" id="MaHang" value="<?php echo $data['MaHang'] ?>" />
      </div>
      <div class="row error error_name"></div>
      <br>
      <div class="row justify-content-center">
        <div class="col-md-7">
          <button type="submit" class="form-submit" id="edit-save">Chỉnh sửa</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php } ?>