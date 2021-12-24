<?php
session_start();
include("../../include/without_login.php");
include("../../include/chucnang.php");
include("../../include/ketnoi.php");
include("../../include/head.php");
$thongkedoanhso = true;
if(!isset($_SESSION['id_shop']))
    header("location:../../trangchu");
$id_shop = $_SESSION['id_shop'];
$sql = "SELECT * FROM donhang WHERE id_shop = $id_shop";
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
                $doanhthu = $doanhthu + ($gia_cod*98)/100;
        }
        else if(!empty($_GET['nam'])&& !empty($_GET['thang']))
        {
            if($year == $_GET['nam'] && $month == $_GET['thang'])
            $doanhthu = $doanhthu + ($gia_cod*98)/100;
        }
        else if(!empty($_GET['nam']))
        {
            if($year == $_GET['nam'])
            $doanhthu = $doanhthu + ($gia_cod*98)/100;
        }
        else if($year == date('Y') && $month == date('m') && $day == date('d'))
        {
            $doanhthu = $doanhthu + ($gia_cod*98)/100;
        }
    }
}
?>

<body>
    <style>
        .thongtin{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    margin-top: 30px;
}
.thongtin-item{
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0px 0px 10px rgb(0, 0, 0,0.2);
    color: white;
}
    </style>
    <?php include("../../include/navbar_nguoiban.php"); ?>
    <!-- body content -->
    <div class="body-content" style="display: flex;margin-bottom:40px">
        <div class="sidebar">
            <div style='display:flex;align-items:center'>
                <div class="account-img">
                    <img src="../img/avatar_shop/<?php echo $anh_shop;?>" alt="">
                </div>
                <div class="acount-name">
                    <span class="font-shopee2021-bold"><?php echo $ten_shop;?></span>
                </div>
            </div>
            <hr width="90%" style="color: rbg(255,255,255,0.5);">
            <div class="sidebar-item" onClick="location.href='product-manager'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a04444;">inventory_2</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Sản Phẩm</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='info'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thông Tin Shop</span>
                </div>
            </div>
            <div class="sidebar-item" onClick="location.href='don-mua'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #44a072;">shopping_basket</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Đơn hàng</span>
                </div>
            </div>
            <div class="sidebar-item item-sidebar-checked" onClick="location.href='thong-ke'">
                <div class="item-logo-sidebar">
                    <span class="material-icons" style="color: #a09744;">shopping_cart_checkout</span>
                </div>
                <div class="item-title-sidebar">
                    <span>Thống Kê Doanh Số</span>
                </div>
            </div>
        </div>
        <div class="noi-dung">
            <div class="title-info address-title">
                <div class="my-address">
                    <h5>THỐNG KÊ DOANH SỐ</h5>
                    <span style="font-size: 0.9em;color:rgb(0,0,0,0.6)">Doanh số của bạn</span>
                </div>
            </div>
            <hr width="95%">
            <form action="thong-ke" method="get" style='width:100%;'>
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
                            <br><span class="font-shopee2021-bold" style='font-size: 0.8em;'><i>(Đã trừ đi chiết khấu 2% mỗi đơn hàng cho Sara)</i></span>
                        </div>
                    </div>
                </div>
               
            
        </div>
    </div>
    <script src="../../js/index.js"></script>
    <script src="../../js/vitri.js"></script>
    <script src="../../js/cathinh.js"></script>
    <?php
    include("../../include/footer.php");
    ?>
</body>

</html>