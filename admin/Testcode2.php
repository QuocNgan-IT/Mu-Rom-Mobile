<?php
include "connect.php";
include "ham.php";
session_start();

// Thêm ảnh TempIndex    
if (isset($_FILES['anhIndex']['name'])) { 
    // file name
    $filename = $_FILES['anhIndex']['name'];
    // Location
    $location = '../Images/Temp/' . $filename;
       
    // Upload file
    if (move_uploaded_file($_FILES['anhIndex']['tmp_name'], $location)) {
        //mysqli_query($conn, "DELETE FROM temp WHERE TempIndex='1'");
        //mysqli_query($conn, "INSERT INTO temp VALUE(null,'$filename','1')");
        ReloadContent("form");
    }      
}