<?php
session_start();
include("../../../include/ketnoi.php");
include("../../../include/chucnang.php");

if(isset($_POST['btn-submit']))
{
    $back   = 0;

    $id_user= $_SESSION['id_user'];
    $hoten  = $_POST['hoten'];
    $sdt    = $_POST['sdt'];
    $tinh   = $_POST['tinh'];
    $huyen  = $_POST['huyen'];
    $xa     = $_POST['xa'];
    $sonha  = $_POST['sonha'];



    if(empty($hoten))
    {
        $_SESSION['error_hoten'] = "Không được để trống";
        $back++;
    }else if(strlen($hoten)>40){$_SESSION['error_hoten'] = "Tối đa 40 kí tự";$back++;}
    if(empty($sdt))
    {
        $_SESSION['error_sdt'] = "Không được để trống";
        $back++;
    }else if(strlen($sdt)!=10 && is_numeric($sdt)){$_SESSION['error_sdt'] = "Số điện thoại không đúng";$back++;}
    if(empty($tinh))
    {
        $_SESSION['error_tinh'] = "Không được để trống";
        $back++;
    }
    if(empty($huyen))
    {
        $_SESSION['error_huyen'] = "Không được để trống";
        $back++;
    }
    if(empty($xa))
    {
        $_SESSION['error_xa'] = "Không được để trống";
        $back++;
    }
    if(empty($sonha))
    {
        $_SESSION['error_sonha'] = "Không được để trống";
        $back++;
    }
    if($back!=0)
    {
        echo "<script>window.history.back(-1);</script>";
        die();
    }


    $value_check  = [$hoten,$sdt,$sonha,$xa,$huyen,$tinh];
    if(CheckSpecialChar($value_check)==true)
    {
        $_SESSION['error_specialChar']="Thông tin nhập vào có chứa ký tự đặc biệt";
        $back++;
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    if($back!=0)
    {
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    else
    {
        $col    = ["id_user","tennguoinhan","sdt","tenduong","xa","huyen","tinh"];
        $value  = [$id_user,$hoten,$sdt,$sonha,$xa,$huyen,$tinh];

        echo "$id_user,$hoten,$sdt,$sonha,$xa,$huyen,$tinh";
        insert_table("diachiuser",$col,$value);
        header("location: address");
    }
}
echo "hello";
?>