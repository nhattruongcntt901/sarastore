<?php
session_start();
include("../include/ketnoi.php");
include("../include/chucnang.php");

    date_default_timezone_set("Asia/Ho_Chi_Minh");    

    $id_user    = $_SESSION['id_user'];
    $id_sp      = $_POST['id_sp'];
    $noidung    = $_POST['noidung_binhluan'];
    $noidung    = htmlspecialchars($noidung); 
    $time       = date("d-m-Y  g:i a"); 

    $col = ['id_user', 'id_sp', 'noidung_bl', 'thoigian_bl'];
    $value  =[$id_user,$id_sp,$noidung,$time];
    if($noidung != "")
        insert_table("binhluan",$col,$value);
    

