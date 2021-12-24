<?php
session_start();
    include("../../include/ketnoi.php");
    include("../../include/chucnang.php");

    $id_sp = $_GET['id_sp'];
    $sql      = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        if($_SESSION['id_loaiuser']==4||$_SESSION['id_loaiuser']==5)
            update_table("sanpham","tinhtrang_sp",0,"id_sp",$id_sp);
    }
    echo "<script>window.history.back(-1);</script>";
    
?>