<?php
include("./config.php");
include("./autoload.php");
session_start();

if(isset($_GET['sosao']) && isset($_GET['madt'])) {
    $sosao = $_GET['sosao'];
    $madt = $_GET['madt'];
}
else {
    $sosao = "0";
    $madt = "0";
}

try {
    switch($sosao) {
        case "1":
            $cmt = "Không thích";
            break;
        case "2":
            $cmt = "Tạm được";
            break;
        case "3":
            $cmt = "Bình thường";
            break;
        case "4":
            $cmt = "Hài lòng";
            break;
        case "5":
            $cmt = "Tuyệt vời";
            break;
    }

    $check = "SELECT COUNT(MaDG) ktra FROM danhgia WHERE MaDT = $madt AND MaKH = 1";
    $query_check = mysqli_query($mysqli, $check);
    $row_check = mysqli_fetch_array($query_check);
    if ($row_check['ktra'] == 0) {
        $add_dgia = "INSERT INTO danhgia VALUES (null,1,$madt,$sosao)";
        $mysqli->query($add_dgia);
    }
    else {
        $update_dgia = "UPDATE danhgia SET DiemDG = $sosao WHERE MaDT = $madt AND MaKH = 1";
        $mysqli->query($update_dgia);
    }

    echo '<div style="margin-left: 21px">';
    for ($i = 1; $i <= $sosao; $i++) {
        echo
        '<li onclick="danhgia(\''.$madt.'\')">
            <input type="radio" id="'.$i.'" name="danhgia" value="'.$i.'" style="opacity: 0">
            <label for="'.$i.'">
                <i class="fas fa-star yellow-text"></i>
            </label>
        </li>';
    }

    $sosaoconlai = $sosao + 1;
    for ($i = $sosaoconlai; $i <= 5; $i++) {
        echo
        '<li onclick="danhgia(\''.$madt.'\')">
            <input type="radio" id="'.$i.'" name="danhgia" value="'.$i.'" style="opacity: 0">
            <label for="'.$i.'">
                <i class="fas fa-star grey-text"></i>
            </label>
        </li>';
    }
    echo '
    </div>
    <p style="position:absolute; right: 61px; top: 4px;font-weight:bold;font-size: 14px;color: black">'.$cmt.'</p>';
}
catch(Exception $e) {
    echo
    '<li>
        <input type="radio" id="1" name="danhgia" value="1" style="opacity: 0">
        <label for="1">
            <i class="fas fa-star grey-text"></i>
        </label>
    </li>
    <li>
        <input type="radio" id="2" name="danhgia" value="2" style="opacity: 0">
        <label for="2">
            <i class="fas fa-star grey-text"></i>
        </label>
    </li>
    <li>
        <input type="radio" id="3" name="danhgia" value="3" style="opacity: 0">
        <label for="3">
            <i class="fas fa-star grey-text"></i>
        </label>
    </li>
    <li>
        <input type="radio" id="4" name="danhgia" value="4" style="opacity: 0">
        <label for="4">
            <i class="fas fa-star grey-text"></i>
        </label>
    </li>
    <li>
        <input type="radio" id="5" name="danhgia" value="5" style="opacity: 0">
        <label for="5">
            <i class="fas fa-star grey-text"></i>
        </label>
    </li>';
}

    // <li>
    //     <input type="radio" id="1" name="danhgia" value="1" style="opacity: 1">
    //     <label for="1">
    //         <i class="fas fa-star grey-text"></i>
    //     </label>
    // </li>
    // <li>
    //     <input type="radio" id="2" name="danhgia" value="2" style="opacity: 1">
    //     <label for="2">
    //         <i class="fas fa-star grey-text"></i>
    //     </label>
    // </li>
    // <li>
    //     <input type="radio" id="3" name="danhgia" value="3" style="opacity: 1">
    //     <label for="3">
    //         <i class="fas fa-star grey-text"></i>
    //     </label>
    // </li>
    // <li>
    //     <input type="radio" id="4" name="danhgia" value="4" style="opacity: 1">
    //     <label for="4">
    //         <i class="fas fa-star grey-text"></i>
    //     </label>
    // </li>
    // <li>
    //     <input type="radio" id="5" name="danhgia" value="5" style="opacity: 1">
    //     <label for="5">
    //         <i class="fas fa-star grey-text"></i>
    //     </label>
    // </li>


?>