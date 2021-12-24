<?php
session_start();
$shop = true;

include("../../include/ketnoi.php");
include("../../include/chucnang.php");
include("../../include/head.php");
if(!empty($_GET['shop']))
{
    $id_shop1  = $_GET['shop'];
    $sql      = "SELECT * FROM shop a, danhmuc b WHERE a.id_dm = b.id_dm and id_shop = $id_shop1";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row        = mysqli_fetch_assoc($ketqua);
        $anh_shop   = $row['anh_shop'];
        $tenshop    = $row['ten_shop'];
        $sdt_shop        = $row['sdt_shop'];
        $tenduong   = $row['tenduong_shop'];
        $id_user_shop = $row['id_user'];
        $diachi     = getNameAddress($row['tenxa_shop'],$row['tenhuyen_shop'],$row['tentinh_shop']);
        $xa         = $diachi[0];
        $huyen      = $diachi[1];
        $tinh       = $diachi[2];
        $danhmuc    = $row['ten_dm'];
        $time_join  = $row['thoigian_thamgia'];
        $time_now   = layThoigian();

        $timestamp_join = strtotime($time_join);
        $timestamp_now  = strtotime($time_now);

        $songaythamgia = round(((($timestamp_now - $timestamp_join)/60)/60)/24);


        $user       = $row['id_user'];
        if(isset($_SESSION['id_user']))
            if($user==$_SESSION['id_user'])
            {
                $flag = true;
            }
    }
    else
    {
        header("location: ../../");
        die();
    }
}
else
    {
        header("location: ../../");
        die();
    }




?>
<body>
    <?php include("../../include/navbar.php"); ?>
    
    <!-- body -->
    <div class="body-content">
        <?php if(isset($flag)){ ?>
        <a href="../seller/product-manager"><button class="login-btn font-shopee2021-bold"  style='background-color:#a09744'>VÀO TRANG QUẢN LÝ CỦA NGƯỜI BÁN</button></a>
        <?php } ?>
        <!-- info shop -->
        <div class="shop-info-area">
            <div class="shop-avatar">
                <img style='width: 100px;height: 100px;border-radius:50%' src="../../img/avatar_shop/<?php echo $anh_shop; ?>" alt="">
                <div style='color:white;padding-left:20px;text-align:center'>
                    <span style='font-size: 1.8em;' class="font-shopee2021-bold"><?php echo $tenshop; ?></span><br>
                    <span >Tham gia vào <?php echo $songaythamgia; ?> ngày trước</span><br>
                    <button class="click btn font-brown" style='padding:5px;border-radius:10px;background-color:rgba(255, 255, 255, 0.555);margin-top:10px' onClick="location.href='../chat/chat_page.php?chat_user=<?php echo $id_user_shop; ?>'">Nhắn tin</button>
                </div>
            </div>
            <div class="shop-info">
                <div class="colume colume1">
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>inventory_2</span>
                        <span class="font-shopee2021-regular">Sản Phẩm:</span>
                        <span style='color:#8d704a'><?php echo $soluongsanpham; ?></span>
                    </div>
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>grade</span>
                        <span class="font-shopee2021-regular">Đánh Giá:</span>
                        <span style='color:#8d704a'><?php echo $danhgiacuashop; ?></span>
                    </div>
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>phone</span>
                        <span class="font-shopee2021-regular">Số Điện Thoại:</span>
                        <span style='color:#8d704a'><?php echo $sdt_shop; ?></span>
                    </div>
                </div>
                <div class="colume colume2">
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>store</span>
                        <span class="font-shopee2021-regular">ID Shop:</span>
                        <span style='color:#8d704a'><?php echo $_GET['shop']; ?></span>
                    </div>
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>local_offer</span>
                        <span class="font-shopee2021-regular">Danh Mục Chuyên:</span>
                        <span style='color:#8d704a'><?php echo $danhmuc;?></span>
                    </div>
                    <div class="title-icon">
                        <span class="material-icons-outlined" style='font-size:1.5em'>location_on</span>
                        <span class="font-shopee2021-regular" style='word-wrap:normal;width:13%'>Địa chỉ:</span>
                        <span style='color:#8d704a'><?php echo "$tenduong, $xa, $huyen, $tinh"; ?></span>
                    </div>        
                </div>
            </div>
        </div>
        <!-- Sản phẩm được mua nhiều nhất -->
        <div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid rgb(0, 0, 0,0.1);"
            class="font-shopee2021-regular">SẢN PHẨM HOT</div>
        <!-- Danh sách sản phẩm -->
        
            <?php
            $sql      = "SELECT * FROM sanpham WHERE id_shop = $id_shop1 and tinhtrang_sp = 1 and soluongdaban_sp > 0 ORDER BY soluongdaban_sp DESC LIMIT 5";
            $ketqua   = mysqli_query($ketnoi,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                echo "<div class='sanphams'>";
                while($row = mysqli_fetch_assoc($ketqua))
                { 
                    $id_sp = $row['id_sp'];
                    $anhsp = $row['anh_sp'];
                    $tensp = $row['ten_sp'];
                    $daban = $row['soluongdaban_sp'];
                    $gia   = number_format($row['dongia_sp']);
                    ?>
                <div class="sanpham click" onClick="location.href='http://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
                    <div class="sp-img">
                        <img src="../../img/sanpham/<?php echo $anhsp;?>" style='width:100%' alt="">
                    </div>
                    <div class="sp-title">
                        <?php echo $tensp; ?>
                    </div>
                    <div class="sp-price">
                        <span class="font-shopee2021-light price">₫ <?php echo $gia;?></span>
                        <span class="font-shopee2021-light sp-daban">Đã bán <?php echo $daban;?></span>
                    </div>
                </div>
               <?php }
               echo "</div>";
            }
            else{ ?>
                <div style='display:flex;justify-content:center;align-items:center;width:100%;height:50px'>
                        <b>Chưa có sản phẩm nào HOT</b>
                </div>
            <?php }
            
            ?>
            
                
               
        <!-- Sản phẩm -->
        <div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid rgb(0, 0, 0,0.1);"
            class="font-shopee2021-regular">SẢN PHẨM CỦA SHOP</div>
        <!-- Danh sách sản phẩm -->
        <div class="sanphams">
            <?php
            $sql      = "SELECT * FROM sanpham WHERE id_shop = $id_shop1 and tinhtrang_sp = 1";
            $ketqua   = mysqli_query($ketnoi,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                while($row = mysqli_fetch_assoc($ketqua))
                { 
                    $id_sp = $row['id_sp'];
                    $anhsp = $row['anh_sp'];
                    $tensp = $row['ten_sp'];
                    $daban = $row['soluongdaban_sp'];
                    $gia   = number_format($row['dongia_sp']);
                    ?>
                <div class="sanpham click" onClick="location.href='http://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
                    <div class="sp-img">
                        <img src="../../img/sanpham/<?php echo $anhsp;?>" style='width:100%' alt="">
                    </div>
                    <div class="sp-title">
                        <?php echo $tensp; ?>
                    </div>
                    <div class="sp-price">
                        <span class="font-shopee2021-light price">₫ <?php echo $gia;?></span>
                        <span class="font-shopee2021-light sp-daban">Đã bán <?php echo $daban;?></span>
                    </div>
                </div>
               <?php }
            }
            
            ?>
            
                
            </div>    
    </div>
    <?php include("../../include/footer.php"); ?>
</body>
</html>