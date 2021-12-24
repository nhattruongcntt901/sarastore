<?php
session_start();
echo $_SESSION['id_user'];
include("../include/ketnoi.php");
include("../include/head.php");
$tukhoa = $_GET['key'];
?>
<body>
    <?php include('../include/navbar.php');  ?>

    <div class="body-content">
        <div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);" class="font-shopee2021-regular">Từ Khóa tìm kiếm '<?php echo $tukhoa; ?>'</div>
        <?php
        $tukhoa = str_replace(" ","%",$tukhoa);
        $sql      = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 and (ten_sp like '%$tukhoa%' or mota_sp like '%$tukhoa%') LIMIT 6";
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
            <div class="sanpham click" onClick="location.href='https://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
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
        else
        {
            ?>
                <div style='display:flex;justify-content:center;align-items:center;font-size:2em;height:30vh;width:100%' class="font-shopee2021-bold">Không có kết quả phù hợp</div>
            <?php
        }

        ?>
        
    </div>
    <?php include("../include/footer.php"); ?>
</body>

                        