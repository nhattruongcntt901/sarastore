<?php 
session_start();
include("../../../include/chucnang.php");

$id_user = $_SESSION['id_user'];
$id_donhang     = $_POST['id_donhang'];
$id_sp          = $_POST['id_sp'];
$noidung        = $_POST['noidungdanhgia'];
$sao            = $_POST['sao'];
$noidung        = htmlspecialchars($noidung);
$sql      = "SELECT * FROM donhang WHERE id_donhang = $id_donhang and id_user = $id_user";
$ketqua   = mysqli_query($ketnoi,$sql);
if(mysqli_num_rows($ketqua)>0)
{
    $col    = ['id_donhang', 'id_sp', 'id_user', 'noidung_danhgia', 'diem_danhgia'];
    $value  = [$id_donhang,$id_sp,$id_user,$noidung,$sao];
    insert_table("danhgiasp",$col,$value);
    $sql = "UPDATE donhang_sanpham SET danhgia=1 WHERE id_donhang = $id_donhang and id_sp = $id_sp";
    mysqli_query($ketnoi,$sql);
}
else
    header("location: ../../../trangchu");


?>