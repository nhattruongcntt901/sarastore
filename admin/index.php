<?php
session_start();
if(!isset($_SESSION['id_loaiuser']))
{
  header("location: ../login/dangnhap.php?admin_page=true");
  die();
}
else
{
  if($_SESSION['id_loaiuser']==1 || $_SESSION['id_loaiuser'] == 2)
  {
    header("location: ../trangchu");
    die();
  }
}
include("../include/ketnoi.php");
include("include/head.php");
$sql      = 'SELECT * FROM website';
$ketqua   = mysqli_query($ketnoi,$sql);
$row = mysqli_fetch_assoc($ketqua);
$truycap = $row['luottruycap'];
$sql = "SELECT * FROM donhang";
$ketqua1 = mysqli_query($ketnoi, $sql);
if(mysqli_num_rows($ketqua1) > 0)
{
    $doanhthu = 0;
    
    while($row = mysqli_fetch_assoc($ketqua1))
    {
        $gia_cod        = $row['gia_cod'];
        $time           = $row['thoigiandat_donhang'];

        $timestamp = strtotime($time);
        $year   = date('Y', $timestamp);
        $month  = date('m', $timestamp);
        $day    = date('d', $timestamp);

        
        if(!empty($_GET['nam']) && !empty($_GET['thang']) && !empty($_GET['ngay']))
        {
            if($year == $_GET['nam'] && $month == $_GET['thang'] && $day == $_GET['ngay'])
                $doanhthu = $doanhthu + ($gia_cod*2)/100;
        }
        else if(!empty($_GET['nam'])&& !empty($_GET['thang']))
        {
            if($year == $_GET['nam'] && $month == $_GET['thang'])
            $doanhthu = $doanhthu + ($gia_cod*2)/100;
        }
        else if(!empty($_GET['nam']))
        {
            if($year == $_GET['nam'])
            $doanhthu = $doanhthu + ($gia_cod*2)/100;
        }
        else if($year == date('Y') && $month == date('m') && $day == date('d'))
        {
            $doanhthu = $doanhthu + ($gia_cod*2)/100;
        }
    }
}
?>
<body>
    <link rel="stylesheet" href="include/admin.css">
    <div class="content">
        <div class="nav">
            <div class="nav-head">
                <img src="../img/avatar_user/<?php echo $_SESSION['anh_user']; ?>" style='border-radius:50%;width:50px;height:50px' alt="">
                <span class="font-shopee2021-light">Chào, <?php echo $_SESSION['ten_user']; ?></span>
            </div>
            <div class="nav-body">
                <?php $index = true; include("include/nav.php"); ?>
            </div>
        </div>
        <div class="nav-content">
            <div class="content-head">
                <h3 class="font-shopee2021-bold">TRANG CHỦ</h3>
            </div>
            <div class="content-body">
                <div class="thongtin">
                    <div class="thongtin-item" style="background-color: #81ca8e;">
                        <div class="thongtin-icon">
                            <span class="material-icons-outlined" style='font-size: 4rem;'>public</span>
                        </div>
                        <div class="thongtin-title">
                            <span class="font-shopee2021-regular" style='font-size: 1.5em;'>Lượt Truy Cập</span><br>
                            <span class="font-shopee2021-bold" style='font-size: 2em;'><?php echo $truycap; ?></span>
                        </div>
                    </div>
                    <div class="thongtin-item" style="background-color: #cac981;">
                        <div class="thongtin-icon">
                            <span class="material-icons-outlined" style='font-size: 4em;'>account_circle</span>
                        </div>
                        <div class="thongtin-title">
                            <span class="font-shopee2021-regular" style='font-size: 1.5em;'>User</span><br>
                            <span class="font-shopee2021-bold" style='font-size: 2em;'><?php echo $sl_user; ?></span>
                        </div>
                    </div>
                    <div class="thongtin-item" style="background-color: #ca81ae;"> 
                        <div class="thongtin-icon">
                            <span class="material-icons-outlined" style='font-size: 4em;'>shopping_cart</span>
                        </div>
                        <div class="thongtin-title">
                            <span class="font-shopee2021-regular" style='font-size: 1.5em;'>Đơn Hàng</span><br>
                            <span class="font-shopee2021-bold" style='font-size: 2em;'><?php echo $sl_don; ?></span>
                        </div>
                    </div>
                    <div class="thongtin-item" style="background-color: #81a1ca;">
                        <div class="thongtin-icon">
                            <span class="material-icons-outlined" style='font-size: 4em;'>monetization_on</span>
                        </div>
                        <div class="thongtin-title">
                            <span class="font-shopee2021-regular" style='font-size: 1.5em;'>Doanh Thu</span><br>
                            <span class="font-shopee2021-bold" style='font-size: 2em;'><?php echo number_format($doanhthu); ?> VNĐ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>