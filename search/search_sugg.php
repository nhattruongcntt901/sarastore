<?php
include("../include/ketnoi.php");
$tukhoa = $_GET['key'];
$tukhoa = str_replace(" ","%",$tukhoa);
$sql      = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 and (ten_sp like '%$tukhoa%' or mota_sp like '%$tukhoa%') LIMIT 6";
$ketqua   = mysqli_query($ketnoi,$sql);
if(mysqli_num_rows($ketqua)>0)
{
    while($row = mysqli_fetch_assoc($ketqua))
    {
        $ten_sp = $row['ten_sp'];
        $id_sp  = $row['id_sp'];
        $anh_sp = $row['anh_sp'];
        ?>
            <div class="cart-product click" onClick="location.href='http://localhost/san-pham?id_sp=<?php echo $id_sp; ?>'">
                <div class="product-img" style='width:60px;height:70px'>
                    <img src="http://localhost/img/sanpham/<?php echo $anh_sp; ?>" alt="">
                </div>
                <div class="right">
                    <div class="product-name">
                        <span class="font-shopee2021-regular"><?php echo $ten_sp; ?></span>
                    </div>
                </div>
            </div>
    <?php
    }
}
else
{
    ?>
        <div style='text-align:center' class="font-shopee2021-bold">Không có kết quả phù hợp</div>
    <?php
}

?>
                        