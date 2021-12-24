<?php 
session_start();
include("../../include/chucnang.php");
include("../../include/head.php");
$soluong = $_POST['soluong'];
if(!isset($_POST['diachi']))
{
    echo "<script>alert('Vui lòng chọn địa chỉ giao hàng');window.history.back(-1);</script>";
    die();
}
$id_diachi = $_POST['diachi'];
$cart_string = "";
$shop = [];
$tongthanhtoan = [];

$sql      = "SELECT * FROM diachiuser WHERE id_diachi = $id_diachi";
$ketqua   = mysqli_query($ketnoi,$sql);
if(mysqli_num_rows($ketqua)>0)
{
    while($row = mysqli_fetch_assoc($ketqua))
    {
        $city_to = $row['tinh'];
        $dis_to = $row['huyen'];
        $ward_to = $row['xa'];
        $street = $row['tenduong'];
    }
}
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

<body>
    <?php include("../../include/navbar.php");  ?>
    <div class="body-content">
        <form action="xuly_thanhtoan.php" method="post">
            <input type="number" style="display:none" value="<?php echo $id_diachi;?>" name="diachi">
            
            <div class="cart-area">
                <?php
                $b = 0;
                $c=0;
                
                foreach($shop as $value)
                {
                    $tongtien = 0;
                    $tongcannang = 0;
                    $sql      = "SELECT * FROM shop WHERE id_shop = $value";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        $row = mysqli_fetch_assoc($ketqua);
                        $ten_shop = $row['ten_shop'];
                        $city_from = $row['tentinh_shop'];
                        $dis_from = $row['tenhuyen_shop'];
                        $ward_from  = $row['tenxa_shop'];
                        $street_from = $row['tenduong_shop'];
                    }
            ?>
                <div class="shop-name">
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
                        $v = 0;
                        while($row = mysqli_fetch_assoc($ketqua))
                        {
                            
                            foreach ($_SESSION['cart'] as $key => $a)
                            {
                                
                                if($a == $row['id_sp'])
                                {
                                    
                                    $anh_sp     = $row['anh_sp'];
                                    $ten_sp     = $row['ten_sp'];
                                    $gia_sp     = $row['dongia_sp'];
                                    $chieudai   = $row['chieudai_sp'];
                                    $chieurong  = $row['chieurong_sp'];
                                    $chieucao   = $row['chieucao_sp'];
                                    $khoiluong  = $row['khoiluong_sp'];
                                    $soluongkho = $row['soluong_sp'];
                                    $v1 = $chieucao*$chieudai*$chieurong;
                                    $v = $v + $v1*$soluong[$b];
                                    $tongtien = $tongtien + $gia_sp*$soluong[$b];
                                    $tongcannang = $tongcannang + $khoiluong*$soluong[$b];
                                    ?>
                                    <input name='id_sp[]' value="<?php echo $a;?>" style='display:none' />
                                    <input name='soluong[]' value="<?php echo $soluong[$b];?>" style='display:none' />
                                    <div class="cart-product">
                                        <div class="product-img">
                                            <img src="../../img/sanpham/<?php echo $anh_sp; ?>" alt="">
                                        </div>
                                        <div class="right">
                                            <div class="product-name">
                                                <span class="font-shopee2021-regular"><?php echo $ten_sp; ?></span>
                                            </div>
                                            <div class="product-single-price">
                                                <span>₫ <?php echo number_format($gia_sp); ?></span>
                                            </div>
                                            <div class="product-soluong">
                                                <span><?php echo $soluong[$b]; ?></span>
                                            </div>
                                            <div class="product-price">
                                                <span>₫ </span><span
                                                    id='thanhtien<?php echo $a ?>'><?php echo number_format($gia_sp*$soluong[$b]); ?></span>
                                            </div>
                                            <div class="product-delete">

                                            </div>
                                        </div>

                                    </div>  
                                <?php
                                    $b++;
                                }
                            }
                        }
                    }


                ?>

                <div class="van-chuyen font-shopee2021-bold" style='border-top:1px solid gray;margin-bottom:0px;color:green'>
                    <div style="display:flex;align-items:center;gap:10px;margin:10px" class="font-shopee2021-bold">
                        <span class="material-icons">local_shipping</span>
                        <span>NHÀ VẬN CHUYỂN</span>
                    </div>
                    <?php 
                    $kichthuoc = ceil(pow($v,1/3));
                    
                    $nvc = tinh_phi_ship($tongcannang,$kichthuoc,$kichthuoc,$kichthuoc,$dis_from,$city_from,$dis_to,$city_to,$tongtien);
                    if(!isset($nvc[4]))
                    {
                        $loi = true;
                        
                    }
                    else
                    {
                        array_push($tongthanhtoan,$tongtien+$nvc[4]);
                    }
                       
                    if(count($nvc)!=0){
                    ?>
                    <div>
                        <input type="text" style="display:none" name='cod[]' value="<?php echo $tongtien;?>">
                        <input type="text" style="display:none" name='ship[]' value="<?php echo $nvc[4];?>">
                        <input type="text" style="display:none" name='id_don[]' value="<?php echo $nvc[0];?>">
                        <img src="<?php echo $nvc[2]; ?>" style='width:100px;height:100px'><span><?php echo $nvc[1]; ?></span><br>
                        <span style='margin-right:10px'>Giá vận chuyển:</span><span>₫<?php echo number_format($nvc[4]); ?></span><br>
                        <span style='margin-right:10px'>Thời gian dự kiến giao hàng:</span><span><?php echo $nvc[3]; ?></span><br>
                    </div>
                </div>
                <div class="thanh-toan-shop font-shopee2021-regular" style='margin-bottom:40px;font-size:1.5em'>
                    <span class="font-shopee2021-regular">Tổng số tiền thanh toán cho shop <span
                            class="font-shopee2021-bold" style='color:#a56969'><?php echo $ten_shop; ?>: </span><span
                            class="font-shopee2021-bold" style="font-size:1.2em;color:#a56969">₫
                            <?php echo number_format($tongtien+$nvc[4]); ?><?php  ?></span> <span style="margin-left:20px">(Đã bao gồm phí vận chuyển)</span></span>
                </div>
                <?php }else{
                    ?>
                    <div class="font-shopee2021-bold">Khu vực của shop này chưa có nhà vận chuyển nào hỗ trợ</div>
                    <?php
                }
            } ?>
            </div>
            <div class="thanh-toan" style='margin-top:40px'>
                <?php
            $tien = 0; 
                foreach($tongthanhtoan as $value)
                {
                    $tien = $tien + $value;
                }
            ?>
                <span class="font-shopee2021-bold" style='color:#a56969;font-size:1.5em'>Thành tiền: <span
                        style='font-size:2em'>₫ <?php if(!isset($loi)) echo number_format($tien); else echo "Lỗi";?></span></span>
            </div>
            <button onclick="loading_cart()" class="btn bg-brown w-100 font-shopee2021-bold font-white"
                style='margin-bottom:40px;padding:15px'>ĐẶT HÀNG</button>
                <style>
                    .lds-facebook {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-facebook div {
  display: inline-block;
  position: absolute;
  left: 8px;
  width: 16px;
  background: #a58b69;
  animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
}
.lds-facebook div:nth-child(1) {
  left: 8px;
  animation-delay: -0.24s;
}
.lds-facebook div:nth-child(2) {
  left: 32px;
  animation-delay: -0.12s;
}
.lds-facebook div:nth-child(3) {
  left: 56px;
  animation-delay: 0;
}
@keyframes lds-facebook {
  0% {
    top: 8px;
    height: 64px;
  }
  50%, 100% {
    top: 24px;
    height: 32px;
  }
}
                </style>
                <div style='width:100%;display:flex;justify-content:center'><div id='loading' class="lds-facebook d-none d-md-none"><div></div><div></div><div></div></div></div>
                <script>
                    function loading_cart(){
                        document.getElementById('loading').classList.remove('d-none');
                        document.getElementById('loading').classList.remove('d-md-none');
                    }
                </script>
        </form>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>

</html>
<?php
function tinh_phi_ship($cannang,$chieudai,$chieurong,$chieucao,$dis_from,$city_from,$dis_to,$city_to,$cod){

    $min = [];
    $url = "http://sandbox.goship.io/api/v2/rates";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $data = <<<DATA
    {
        "shipment": {
            "address_from": {
                "district": "$dis_from",
                "city": "$city_from"
            },
            "address_to": {
                "district": "$dis_to",
                "city": "$city_to"
            },
            "parcel": {
                "cod": $cod,
                "width": $chieurong,
                "height": $chieucao,
                "length": $chieudai,
                "weight": $cannang
            }
        }
    }
    DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);
    $i=0;
    foreach($array->data as $value)
    {
        if($i==0)
        {
           $min[0] = $value->id; 
           $min[1] = $value->carrier_name;
           $min[2] = $value->carrier_logo;
           $min[3] = $value->expected;
           $min[4] = $value->total_fee;
           $i++;
        }
        else
        {
            if($value->total_fee<$min[4])
            {
                $min[0] = $value->id; 
                $min[1] = $value->carrier_name;
                $min[2] = $value->carrier_logo;
                $min[3] = $value->expected;
                $min[4] = $value->total_fee;
            }
        }   
    }
    return $min;
}


?>