<?php
session_start();
include("../../../include/ketnoi.php");
include("../../../include/chucnang.php");
if(isset($_POST['submit'])&&isset($_POST['nganhhang'])&&isset($_POST['tinh'])&&isset($_POST['huyen'])&&isset($_POST['xa']))
{
    $back       = 0;

    $id_user    = $_SESSION['id_user'];
    $tenshop    = $_POST['tenshop'];
    $sdt        = $_POST['sdt'];
    $danhmuc    = $_POST['nganhhang'];
    $sonha      = $_POST['sonha'];
    $xa         = $_POST['xa'];
    $huyen      = $_POST['huyen'];
    $tinh       = $_POST['tinh'];
    $time       = layThoigian();

    
    //Check thông tin đã điền đầy đủ?
    if(empty($tenshop))
    {
        $_SESSION['error_tenshop'] = "Không được để trống";
        $back++;
    }else if(strlen($tenshop)>40){$_SESSION['error_tenshop'] = "Tối đa 40 kí tự";$back++;}

    if(empty($sdt))
    {
        $_SESSION['error_sdt'] = "Không được để trống";
        $back++;
    }
    if(empty($sonha))
    {
        $_SESSION['error_sonha'] = "Không được để trống";
        $back++;
    }else if(strlen($sonha)>50){$_SESSION['error_sonha'] = "Tối đa 50 kí tự";$back++;}

    
    // Check thông tin có ký tự đặc biệt ?
    $value_check  = [$danhmuc,$tenshop,$sdt,$sonha,$xa,$huyen,$tinh];
    if(CheckSpecialChar($value_check)==true)
    {
        $_SESSION['error_specialChar']="Thông tin nhập vào có chứa ký tự đặc biệt";
        $back++;
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    //Check định dạng số điện thoại
    if(strlen($sdt)!=10)
    {
        $_SESSION['error_sdt'] = "Số điện thoại không đúng";
        $back++;
    }
    //Check danh muc có trong csdl?
    $sql      = "SELECT * FROM danhmuc WHERE id_dm = $danhmuc";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)==0)
    {
            $_SESSION['error_danhmuc'] = "Danh mục không đúng";
            $back++;
    }
    //Check tỉnh có trong csdl?
    if(checktinh($tinh)==false)
        $_SESSION['error_tinh'] = "Tỉnh không đúng";
    if(checkhuyen($huyen)==false)
        $_SESSION['error_huyen'] = "Huyện không đúng";
    if(checkxa($xa)==false)
        $_SESSION['error_xa'] = "Xã không đúng";
    //Check thông tin Email, Tên đăng nhập, Số điện thoại đã có trong CSDL ?
    $sql    = "SELECT * FROM shop WHERE sdt_shop = $sdt";
    $ketqua = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        if($row['sdt_shop']==$sdt)
        {
            $_SESSION['error_sdt'] = "Số điện thoại đã có người sử dụng";
            $back++;
        }
    }
    if($back !=0)
        echo "<script>window.history.back(-1);</script>";
    else
        {
            $col    = ['id_user', 'id_dm', 'ten_shop', 'sdt_shop', 'tenduong_shop', 'tenxa_shop', 'tenhuyen_shop', 'tentinh_shop', 'thoigian_thamgia'];
            $value  = [$id_user,$danhmuc,$tenshop,$sdt,$sonha,$xa,$huyen,$tinh,$time];
            insert_table("shop",$col,$value);
            update_table("user","id_loaiuser",2,"id_user",$id_user);
        }
}
else{
    echo "<script>window.history.back(-1);</script>";
    $_SESSION['error_danhmuc']  = "Danh mục không đúng";
    $_SESSION['error_tinh']     = "Tỉnh không đúng";
    $_SESSION['error_huyen']    = "Huyện không đúng";
    $_SESSION['error_xa']       = "Xã không đúng";
}
include("../../../include/head.php");
?>
<body>
    <div class="thongbao_success">
    <?php if($back==0){ ?>
        <a href="#"><button class="font-shopee2021-bold btn btn-success" style='padding:20px 30px'>Đăng ký thành công !! Bấm vào đây để xem thông tin kênh</button></a>
        <?php } ?>
    </div>
    <?php include("../../../include/footer.php"); ?>
</body>
</html>