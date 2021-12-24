<?php
session_start();
if(!isset($_SESSION['id_loaiuser']))
{
  header("location: ../login/dangnhap.php?admin_page=true");
  die();
}
else
{
  if($_SESSION['id_loaiuser']==1 || $_SESSION['id_loaiuser'] == 2 || $_SESSION['id_loaiuser'] == 3 || $_SESSION['id_loaiuser'] == 4)
  {
    header("location: ../trangchu");
    die();
  }
}
include("../include/ketnoi.php");
include("include/head.php");



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
            <?php $doanhso = true; include("include/nav.php"); ?>
            </div>
        </div>
        <div class="nav-content">
            <div class="content-head">
                <h3 class="font-shopee2021-bold">SẢN PHẨM</h3>
            </div>
            <div class="content-body">
                <form action="doanhso.php" method="get" style='width:100%;'>
                    <h3 style='width:100%;' align='center'>Doanh số</h3>
                    <div style='width:100%;display:flex;justify-content:center;margin-top:20px;gap:10px'>
                        <select class="input-form" name="nam" id="" style='color:black;width:10%'>
                        <option disabled selected>Chọn Năm</option>
                                    <?php 
                                        for($i = date("Y");$i>=2000;$i--)
                                            if(isset($_GET['nam']))
                                            {
                                                if($i == $_GET['nam'])
                                                    echo "<option value='$i' selected>$i</option>";
                                                else
                                                    echo "<option value='$i'>$i</option>";
                                            }
                                            else
                                                echo "<option value='$i'>$i</option>";

                                    ?>
                        </select>
                        <select class="input-form" name="thang" id="" style='color:black;width:10%'>
                        <option disabled selected>Chọn Tháng</option>
                                    <?php 
                                        for($i = 12;$i>=1;$i--)
                                            if(isset($_GET['thang']))
                                            {
                                                if($i == $_GET['thang'])
                                                    echo "<option value='$i' selected>$i</option>";
                                                else
                                                    echo "<option value='$i'>$i</option>";
                                            }
                                            else
                                                echo "<option value='$i'>$i</option>";

                                    ?>
                        </select>
                        <select class="input-form" name="ngay" id="" style='color:black;width:10%'>
                        <option disabled selected>Chọn Ngày</option>
                                    <?php 
                                        for($i = 31;$i>=1;$i--)
                                            if(isset($_GET['ngay']))
                                            {
                                                if($i == $_GET['ngay'])
                                                    echo "<option value='$i' selected>$i</option>";
                                                else
                                                    echo "<option value='$i'>$i</option>";
                                            }
                                            else
                                                echo "<option value='$i'>$i</option>";

                                    ?>
                        </select>
                    </div>
                    <div style='width:100%;display:flex;justify-content:center;margin-top:20px'>
                        <button class="btn bg-brown font-white" style='margin-left:auto;margin-right:auto'>Tra Cứu</button>
                    </div>
                </form>
                <div style='display:flex;justify-content:center;margin-top:30px'>
                    <div class="thongtin-item" style="background-color: #81ca8e;">
                        <div class="thongtin-icon">
                            <span class="material-icons-outlined" style='font-size: 4rem;'>money</span>
                        </div>
                        <div class="thongtin-title">
                            <span class="font-shopee2021-regular" style='font-size: 1.5em;'>DOANH THU</span><br>
                            <span class="font-shopee2021-bold" style='font-size: 2em;'><?php echo number_format($doanhthu) ?> VNĐ</span><br>
                            <?php if(!empty($_GET['nam']) && !empty($_GET['thang']) && !empty($_GET['ngay'])){ ?>
                                    <span class="font-shopee2021-light" style='font-size: 1em;'><?php echo "Danh thu ". $_GET['nam']."-".$_GET['thang']."-".$_GET['ngay']; ?></span>
                                <?php } else if(!empty($_GET['nam']) && !empty($_GET['thang'])){?>
                                    <span class="font-shopee2021-light" style='font-size: 1em;'><?php echo "Danh thu ". $_GET['nam']."-".$_GET['thang']; ?></span>
                            <?php } else if(!empty($_GET['nam'])){?>
                                <span class="font-shopee2021-light" style='font-size: 1em;'><?php echo "Danh thu ". $_GET['nam']; ?></span>
                            <?php }else{ ?>
                            <span class="font-shopee2021-light" style='font-size: 1em;'><?php echo "Danh thu ". date('Y-m-d'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>