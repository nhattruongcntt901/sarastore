<?php
session_start();
$cart_string = "";
$shop = [];
include("../../include/chucnang.php");
include("../../include/head.php");
?>

<body>
    <?php
    include("../../include/navbar.php"); 
        if(!isset($_SESSION['cart']))
        {
            ?>
    <div style='width:100%;height:60vh;justify-content:center;font-size:2em;min-height:50vh' class='font-shopee2021-bold flex-center'>
        <a href="../../login/dangnhap.php" style='color:#a58b69'>Vui lòng đăng nhập</a></div>
    <?php
            echo "<div style='max-width:1066px;margin-left:auto;margin-right:auto'>";
            include("../../include/sanphamvuaxem.php");
            echo "</div>";
            include("../../include/footer.php");
            die();
        }
        else if(count($_SESSION['cart'])==0)
        {
            ?>
    <div style='width:100%;height:60vh;justify-content:center;font-size:2em;min-height:50vh' class='font-shopee2021-bold flex-center'>
        <a href="../" style='color:#a58b69'>Hình như bạn chưa có gì trong giỏ hàng</a></div>
    <?php
            echo "<div style='max-width:1066px;margin-left:auto;margin-right:auto'>";
            include("../../include/sanphamvuaxem.php");
            echo "</div>";
            include("../../include/footer.php");
            die();
        }

    ?>
    <?php
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($key != count($_SESSION['cart'])-1)
            {
                $cart_string .= "id_sp = $value or ";
            }
            else
            {
                $cart_string .= "id_sp = $value";
            }
        }
        $sql      = "SELECT id_shop FROM sanpham WHERE $cart_string GROUP BY id_shop";
        $ketqua   = mysqli_query($ketnoi,$sql);
        if(mysqli_num_rows($ketqua)>0)
        {
            while($row = mysqli_fetch_assoc($ketqua))
            {
                array_push($shop,$row['id_shop']);
            }
        }
    
    ?>


    <div class="body-content" >
        <form action="page/giohang/thanhtoan.php" method="post">
        <div class="shop-name">
                <div class="name-shop1">
                    <span class="material-icons">location_on</span>
                    <span class="font-shopee2021-bold">Chọn địa chỉ giao hàng</span>
                    <span class="bg-brown font-shopee2021-bold font-white click" onClick="location.href='../account/address'" style='padding:10px;border-radius:5px;margin-left:auto'>Thêm địa chỉ</span>
                </div>
            </div>
            <div class="dia-chi">

                <?php
                $id_user  = $_SESSION['id_user'];  
                $sql      = "SELECT * FROM diachiuser WHERE id_user = $id_user";
                $ketqua   = mysqli_query($ketnoi,$sql);
                if(mysqli_num_rows($ketqua)>0)
                {
                    while($row = mysqli_fetch_assoc($ketqua))
                    {
                        $id_xa = $row['xa'];
                        $id_huyen = $row['huyen'];
                        $id_tinh = $row['tinh'];
                        $ten_duong = $row['tenduong'];
                        $name_address = getNameAddress($row['xa'],$row['huyen'],$row['tinh']);
                        $xa = $name_address[0];
                        $huyen = $name_address[1];
                        $tinh = $name_address[2];
                        $id_diachi = $row['id_diachi'];
                    ?>
                <div style='display:flex;align-items:center;width:100%'>
                    <div class="radio-diachi">
                        <input type="radio" name='diachi' value="<?php echo $id_diachi; ?>">
                    </div>
                    <div class="info-diachi">
                        <div style='display:flex;border-bottom:1px solid rgb(0,0,0,0.1);margin-bottom:20px'>
                            <div class="edit-form font-shopee2021-regular" style="width:80%">
                                <div class="form">
                                    <div class="demuc-form" style="font-size:1.2em">
                                        <span>Họ Và Tên</span>
                                    </div>
                                    <div class="thongtin-form" style='font-size:1.1em'>
                                        <span><?php echo $row['tennguoinhan'];?></span>
                                    </div>
                                </div>
                                <div class="form">
                                    <div class="demuc-form" style="font-size:1.2em">
                                        <span>Số Điện Thoại</span>
                                    </div>
                                    <div class="thongtin-form" style='font-size:1.1em'>
                                        <span><?php echo $row['sdt'];?></span>
                                    </div>
                                </div>
                                <div class="form">
                                    <div class="demuc-form" style='align-items:flex-start;font-size:1.2em'>
                                        <span>Địa Chỉ</span>
                                    </div>
                                    <div class="thongtin-form" style='flex-wrap:wrap;font-size:1.1em'>
                                        <span style="width:100%"><?php echo $row['tenduong'];?></span>
                                        <span style="width:100%"><?php echo $xa;?></span>
                                        <span style="width:100%"><?php echo $huyen;?></span>
                                        <span style="width:100%"><?php echo $tinh;?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                else{
                    ?>
                <div style='display:flex;justify-content:center;align-items:center;width:100%;height:60%'>
                    <span class="font-shopee2021-bold">Hình Như Bạn Chưa Có Địa Chỉ Giao Hàng Thì Phải !! ^^</span>
                </div>
                <?php
                }
                ?>

            </div>

            <div class="cart-area">
                <?php
                foreach($shop as $value)
                {
                    $sql      = "SELECT ten_shop FROM shop WHERE id_shop = $value";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        $row = mysqli_fetch_assoc($ketqua);
                        $ten_shop = $row['ten_shop'];
                    }
            ?>
                <div class="shop-name" style='margin-top:40px'>
                    <div class="name-shop1">
                        <span class="material-icons">store</span>
                        <span class="font-shopee2021-bold"><?php echo $ten_shop; ?></span>
                    </div>
                </div>
                <div class="title-cart">
                    <div class="product-name" style="width:15%;color:gray">
                        <span class="font-shopee2021-bold" style="font-size: 1em;">Tên sản phẩm</span>
                    </div>
                    <div class="product-single-price" style="font-size: 1em;color:gray">
                        <span class="font-shopee2021-bold">Đơn giá</span>
                    </div>
                    <div class="product-soluong" style='color:gray'>
                        <div>
                            <span class="font-shopee2021-bold">Số lượng</span>
                        </div>
                    </div>
                    <div class="product-price" style="font-size: 1em;color:gray">
                        <span class="font-shopee2021-bold">Tổng cộng</span>
                    </div>
                    <div class="product-delete">

                    </div>
                </div>
                <?php
                    $sql      = "SELECT * FROM sanpham WHERE id_shop = $value";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        while($row = mysqli_fetch_assoc($ketqua))
                        {
                            foreach ($_SESSION['cart'] as $key => $a)
                            {
                                if($a == $row['id_sp'])
                                {
                                    $id_sp = $row['id_sp'];
                                    $anh_sp     = $row['anh_sp'];
                                    $ten_sp     = $row['ten_sp'];
                                    $gia_sp     = $row['dongia_sp'];
                                    $chieudai   = $row['chieudai_sp'];
                                    $chieurong  = $row['chieurong_sp'];
                                    $chieucao   = $row['chieucao_sp'];
                                    $soluongkho = $row['soluong_sp'];
                                    ?>
                <input name='id_sp[]' value="<?php echo $a;?>" style='display:none' />
                <div class="cart-product">
                    <div class="product-img">
                        <img src="../../img/sanpham/<?php echo $anh_sp; ?>" alt="">
                    </div>
                    <div class="right">
                        <div class="product-name click" onClick="location.href='san-pham?id_sp=<?php echo $id_sp; ?>'">
                            <span class="font-shopee2021-regular"><?php echo $ten_sp; ?></span>
                        </div>
                        <div class="product-single-price">
                            <span>₫ <?php echo number_format($gia_sp); ?></span>
                        </div>
                        <div class="product-soluong">
                            <div>
                                <div class="input-tangso">
                                    <button type="button" onclick='remove(<?php echo "$a,$gia_sp" ?>)'
                                        style='border: 1px solid rgb(0,0,0,0.2);width:25px;height:30px;padding:0px'
                                        class="flex-center click"><span class="material-icons">remove</span></button>
                                    <div style="border: 1px solid rgb(0,0,0,0.2);height:30px">
                                        <input onkeyup='check_soluong(<?php echo "$soluongkho,$a,$gia_sp"; ?>)'
                                            style="width:50px;border:none;text-align:center;padding:4px" type="number"
                                            min='1' max='<?php echo $soluongkho; ?>' name='soluong[]' value="1"
                                            id='soluong<?php echo $a; ?>'>
                                    </div>
                                    <button type="button" onclick='add(<?php echo "$soluongkho,$a,$gia_sp"; ?>)'
                                        style='border: 1px solid rgb(0,0,0,0.2);width:25px;height:30px;padding:0px'
                                        class="flex-center click"><span class="material-icons">add</span></button>
                                </div>
                            </div>
                        </div>
                        <div class="product-price">
                            <span>₫ </span><span
                                id='thanhtien<?php echo $a ?>'><?php echo number_format($gia_sp); ?></span>
                        </div>
                        <div class="product-delete">
                            <span
                                onClick="location.href='../page/giohang/chucnang/remove_giohang.php?id_sp=<?php echo $id_sp; ?>'"
                                class="material-icons click">delete</span>
                        </div>
                    </div>

                </div>
                <?php
                                }
                            }
                        }
                    }


                ?>
                <?php } ?>
            </div>
            <button class="btn bg-brown w-100 font-shopee2021-bold font-white"
                style='margin-bottom:40px;padding:15px'>TIẾP THEO</button>
        </form>
        <?php include("../../include/sanphamvuaxem.php"); ?>
    </div>
    <script>
    function add(soluongkho, id, dongia) {
        var a = document.getElementById('soluong' + id).value;
        a++;

        if (a <= soluongkho) {
            document.getElementById('soluong' + id).value = a;
            document.getElementById('thanhtien' + id).innerHTML = new Intl.NumberFormat().format(a * dongia);
        }
    }

    function remove(id, dongia) {
        var a = document.getElementById('soluong' + id).value;
        a--;
        if (a > 0) {
            document.getElementById('soluong' + id).value = a;
            document.getElementById('thanhtien' + id).innerHTML = new Intl.NumberFormat().format(a * dongia);
        }
    }

    function check_soluong(soluongkho, id, dongia) {
        var a = document.getElementById('soluong' + id).value;
        if (a > soluongkho) {
            document.getElementById('soluong' + id).value = soluongkho;
            document.getElementById('thanhtien' + id).innerHTML = new Intl.NumberFormat().format(soluongkho * dongia);
        } else if (a <= 0) {
            document.getElementById('thanhtien' + id).innerHTML = new Intl.NumberFormat().format(dongia);
            document.getElementById('soluong' + id).value = 1;
        } else {
            document.getElementById('thanhtien' + id).innerHTML = new Intl.NumberFormat().format(a * dongia);
        }
    }
    </script>
    
    <?php include("../../include/footer.php"); ?>
</body>

</html>