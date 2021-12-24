<?php if(isset($_SESSION['sp_vuaxem'])){ if(count($_SESSION['sp_vuaxem'])!=0){?>
    
<div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid rgb(0, 0, 0,0.1);"
            class="font-shopee2021-regular">SẢN PHẨM VỪA XEM</div>
        <!-- Danh sách sản phẩm -->
        <div class='sanphams'>
            <?php
            $i = 0;
            foreach($_SESSION['sp_vuaxem'] as $value)
            {
                $sql      = "SELECT * FROM sanpham WHERE id_sp = $value and tinhtrang_sp = 1";
                $ketqua   = mysqli_query($ketnoi,$sql);
                if(mysqli_num_rows($ketqua)>0)
                {
                        $row = mysqli_fetch_assoc($ketqua);
                        $id_sp = $row['id_sp'];
                        $anhsp = $row['anh_sp'];
                        $tensp = $row['ten_sp'];
                        $daban = $row['soluongdaban_sp'];
                        $gia   = number_format($row['dongia_sp']);
                        ?>
                    <div class="sanpham click" onClick="location.href='<?php echo $tenmien; ?>/san-pham?id_sp=<?php echo $id_sp; ?>'">
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
                $i++;
                if($i == 5)
                    break;
            }
            ?>
        </div>
<?php } } ?>