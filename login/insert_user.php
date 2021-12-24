<?php
session_start();
include("../include/chucnang.php");
$back = 0;
if(isset($_POST['submit']))
{
    $email      = $_SESSION['email_dangki'];
    $tendn      = $_POST['tendangnhap'];
    $sdt        = $_POST['sdt'];
    $mk         = $_POST['matkhau'];
    $nlmk       = $_POST['nlmatkhau'];
    $ho         = $_POST['ho'];
    $ten        = $_POST['ten'];
    $gioitinh   = $_POST['gioitinh'];

    $time       = layThoigian();
    $col    = ['ho_user', 'ten_user', 'sdt_user', 'email_user', 'tendangnhap_user', 'matkhau_user', 'ngaythamgia_user', 'gioitinh_user'];
    $value  = [$ho,$ten,$sdt,$email,$tendn,$mk,$time,$gioitinh];
    //Check thông tin đã điền đầy đủ?
    if(empty($tendn))
    {
        $_SESSION['error_tendangnhap'] = "Không được để trống";
        $back++;
    }else if(strlen($tendn)>20){$_SESSION['error_tendangnhap'] = "Tối đa 20 kí tự";$back++;}
    if(empty($mk))
    {
        $_SESSION['error_pass2'] = "Không được để trống";
        $back++;
    }
    if(empty($nlmk))
    {
        $_SESSION['error_pass3'] = "Không được để trống";
        $back++;
    }
    if(empty($ho))
    {
        $_SESSION['error_ho'] = "Không được để trống";
        $back++;
    }else if(strlen($ho)>30){$_SESSION['error_ho'] = "Tối đa 30 kí tự";$back++;}
    if(empty($ten))
    {
        $_SESSION['error_ten'] = "Không được để trống";
        $back++;
    }else if(strlen($ten)>10){$_SESSION['error_ten'] = "Tối đa 10 kí tự";$back++;}
    if($back!=0)
    {
        echo "<script>window.history.back(-1);</script>";
        die();
    }  
    // Check thông tin có ký tự đặc biệt ?
    $value_check  = [$ho,$ten,$sdt,$tendn,$gioitinh];
    if(CheckSpecialChar($value_check)==true)
    {
        $_SESSION['error_specialChar']="Thông tin nhập vào có chứa ký tự đặc biệt";
        $back++;
        echo "<script>window.history.back(-1);</script>";
        die();
    }
    // Check mật khẩu có thỏa
    if($mk==$nlmk)
    {
        if(strlen($mk)>=8)
        {
            if(CheckNumChar($mk)==false)
            {
                $_SESSION['error_pass2']="Mật khẩu phải có chữ và số";
                $back++;
            }   
        }
        else
        {
            $_SESSION['error_pass2']="Mật khẩu ít nhất 8 kí tự";
            $back++;
        }
    }
    else
    {
        $_SESSION['error_pass3'] = "Nhập lại mật khẩu không khớp";
    }
    //Check định dạng số điện thoại
    if(strlen($sdt)!=10)
    {
        $_SESSION['error_sdt'] = "Số điện thoại không đúng";
        $back++;
    }  
    //Check thông tin Email, Tên đăng nhập, Số điện thoại đã có trong CSDL ?
    $sql    = "SELECT * FROM user WHERE email_user = '$email' or tendangnhap_user = '$tendn' or sdt_user = '$sdt'";
    $ketqua = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        if($row['tendangnhap_user']==$tendn)
        {
            $_SESSION['error_tendangnhap'] = "Tên đăng nhập đã có người sử dụng";
            $back++;
        }
        if($row['sdt_user']==$sdt)
        {
            $_SESSION['error_sdt'] = "Số điện thoại đã có người sử dụng";
            $back++;
        }
    }
    if($back !=0)
        echo "<script>window.history.back(-1);</script>";
    else
        {
            insert_table("user",$col,$value);
            session_unset();
        }
}
include("../include/head.php");
?>
<body>
    <div class="thongbao_success">
        <a href="dangnhap.php"><button class="font-shopee2021-bold btn btn-success" style='padding:20px 30px'>Đăng ký thành công !! Bấm vào đây để đăng nhập </button></a>
    </div>
    <?php include("../include/footer.php"); ?>
</body>
</html>