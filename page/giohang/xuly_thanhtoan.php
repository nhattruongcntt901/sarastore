<?php
session_start();
include("../../include/chucnang.php");


// var_dump($_POST['diachi']);
// echo "<br>";
// var_dump($_POST['id_sp']);
// echo "<br>";
// var_dump($_POST['soluong']);
// echo "<br>";
// var_dump($_POST['nhavanchuyen']);
$id_diachi = $_POST['diachi'];
$sql      = "SELECT * FROM diachiuser WHERE id_diachi = $id_diachi";
$ketqua   = mysqli_query($ketnoi,$sql);
if(mysqli_num_rows($ketqua)>0)
{
    while($row = mysqli_fetch_assoc($ketqua))
    {
        $name_to = $row['tennguoinhan'];
        $sdt_to = $row['sdt'];
        $city_to = $row['tinh'];
        $dis_to = $row['huyen'];
        $ward_to = $row['xa'];
        $street_to = $row['tenduong'];
    }
}
$id_sp  = $_POST['id_sp'];
$soluong= $_POST['soluong'];
$cod    = $_POST['cod'];
$ship   = $_POST['ship'];
$id_user = $_SESSION['id_user'];
$rate = $_POST['id_don'];
$shop = [];
$cart_string="";
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
$i= 0;
$sl = 0;
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
        $sdt_from   = $row['sdt_shop'];
    }
    $sql      = "SELECT * FROM sanpham WHERE id_shop = $value";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $v=0;
        while($row = mysqli_fetch_assoc($ketqua))
        {
            foreach ($id_sp as $key => $a)
            {
                
                if($a == $row['id_sp'])
                {
                    $ten_sp     = $row['ten_sp'];
                    $anh_sp     = $row['anh_sp'];
                    $gia_sp     = $row['dongia_sp'];
                    $chieudai   = $row['chieudai_sp'];
                    $chieurong  = $row['chieurong_sp'];
                    $chieucao   = $row['chieucao_sp'];
                    $khoiluong  = $row['khoiluong_sp'];
                    $soluongkho = $row['soluong_sp'];
                    $dongia     = $row['dongia_sp'];
                    $slban      = $row['soluongdaban_sp'];
                    $v1 = $chieucao*$chieudai*$chieurong;
                    $v = $v + $v1*$soluong[$b];
                    $tongtien = $tongtien + $gia_sp*$soluong[$b];
                    $tongcannang = $tongcannang + $khoiluong*$soluong[$b];

                    $sql = "SELECT MAX(id_donhang) as id_max FROM donhang";
                    $max = mysqli_fetch_assoc(mysqli_query($ketnoi,$sql));
                    $col_d      = ['id_donhang','id_sp','anh_sp','ten_sp','soluongdat','dongia','chieudai','chieurong','chieucao','khoiluong'];
                    if($max['id_max']==null)
                    {
                        $max['id_max'] =0;
                    }
                    $value_d    = [$max['id_max']+1,$a,$anh_sp,$ten_sp,$soluong[$b],$dongia,$chieudai,$chieurong,$chieucao,$khoiluong];
                    insert_table("donhang_sanpham",$col_d,$value_d);
                    update_table("sanpham","soluongdaban_sp",$slban+$soluong[$b],"id_sp",$a);
                    update_table("sanpham","soluong_sp",$soluongkho-$soluong[$b],"id_sp",$a);
                    $b++;
                }
            }
        }
    }
    $kichthuoc = ceil(pow($v,1/3));
    tao_don(
        $rate[$i],
        $tongcannang,
        $kichthuoc,
        $kichthuoc,
        $kichthuoc,
        $ten_shop,
        $street_from,
        $ward_from,
        $dis_from,
        $city_from,
        $sdt_from,
        $name_to,
        $street_to,
        $ward_to,
        $dis_to,
        $city_to,
        $sdt_to,
        $cod[$i]
    );

    $time = layThoigian();
    $madon = lay_ma_don();
    $col            = ['ma_don', 'id_user', 'id_shop', 'shop_province', 'shop_district', 'shop_ward', 'shop_street', 'user_province', 'user_district', 'user_ward', 'user_street', 'gia_cod', 'gia_ship', 'thoigiandat_donhang'];
    $value_data     = [$madon,$id_user,$value,$city_from,$dis_from,$ward_from,$street_from,$city_to,$dis_to,$ward_to,$street_to,$cod[$i],$ship[$i],$time];
    insert_table("donhang",$col,$value_data);
    $i++;
}
$_SESSION['cart']=[];
function tao_don($rate,$cannang,$chieudai,$chieurong,$chieucao,$name_from,$street_from,$ward_from,$dis_from,$city_from,$sdt_from,$name_to,$street_to,$ward_to,$dis_to,$city_to,$sdt_to,$cod){
    $url = "http://sandbox.goship.io/api/v2/shipments";

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
            "rate": "$rate",
            "address_from": {
                "name": "$name_from",
                "phone": "$sdt_from",
                "street": "$street_from",
                "ward": "$ward_from",
                "district": "$dis_from",
                "city": "$city_from"
            },
            "address_to": {
                "name": "$name_to",
                "phone": "$sdt_to",
                "street": "$street_to",
                "ward": "$ward_to",
                "district": "$dis_to",
                "city": "$city_to"
            },
            "parcel": {
                "cod": $cod,
                "weight": "$cannang",
                "width": "$chieurong",
                "height": "$chieucao",
                "length": "$chieudai",
                "metadata": "none"
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
}
function lay_ma_don(){

    $url = "http://sandbox.goship.io/api/v2/shipments";
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Accept: application/json",
       "Content-Type: application/json",
       "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJhNjc2YjgxZTFhMjgwNDY3ZDg3ZDYxNjBkMDExODA5OTk2NmEwZWZkZTI2NjFkMDJmYjFmNzU2ZmFlNjJiZWNiMTBmOTllMTI5NmY2ZjQ5In0.eyJhdWQiOiI5IiwianRpIjoiMmE2NzZiODFlMWEyODA0NjdkODdkNjE2MGQwMTE4MDk5OTY2YTBlZmRlMjY2MWQwMmZiMWY3NTZmYWU2MmJlY2IxMGY5OWUxMjk2ZjZmNDkiLCJpYXQiOjE2Mzk3OTg3NDQsIm5iZiI6MTYzOTc5ODc0NCwiZXhwIjo0Nzk1NDcyMzQ0LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.abbav6gM6tqAaVz6vZkxb_YmCg9bssScqsQPqqMPnc340RMaUZ1-3o51uOegsfHFrMM7DXRIB5t0P24q-htsZbAUwPShYbYn-_oNfQ1r9HirFZmQWg9WaVf6jQY1e1wfBEJdfqrAxdiFKrFbSLlPEJU84Q7iJHjfguxjWqILiMvkR-qIqtSWcy5w1_GRGzTBhZQxWb8kZ0U7P34upOCJfWw_wsbv688cLV3E_srEohTR3JE6sasJG7NQqFB5O-wZeBmosKC1Ob-tf4ZTwgoNHPZMcVIeZ7GFKrehUpChTKhQIxWu1ZRcuBJB8HiatFlMVWwncQrpAHpSAO69sL7IyQ6e0WkcqcsylhETYA_VIF53rLuJAMJpdGA45_ZUQpdHE2lRp0tNHl8R_kk0GatHMbIf4Fog7KX5Es4ws7QvhMrNYt8G49xiuTKnN_E5QjGPVClsigRRyBA0pAIDyQiLAXMc36hPslOqrOL3tNpi_v7EKOZvlu8_ev6STrIOU0_cwEolDRz0e_RJI_FHl6sc_BfIiHpJAh1YM2lKPbMtNoLURx7gzBbSlByXCY06zmqFCvRLa7g3qHOtcUnqKJVs8oDGE5L7GzRuMW8JhMugXgoKZSvImIbh5CMEro9A1vBZ3ggpaQT-z2GdLBkFG57SZF-sAATubLRsoNmV0U_v6i4",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);
    $madon = $array->data[count($array->data)-1];
    return $madon->id;
}
include("../../include/head.php");
?>
<body>
    <?php 
    include("../../include/navbar.php"); 

        ?>
        <div style='width:100%;height:80vh;justify-content:center;font-size:2em;'  class='font-shopee2021-bold flex-center'><a href="../../account/order" style='color:#a58b69'>Thành toán thành công! Theo dõi đơn ngay</a></div>
        <?php
        include("../../include/footer.php");
       
     ?>
    
</body>
</html>