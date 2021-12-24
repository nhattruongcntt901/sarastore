<?php
session_start();
ob_start();
include("../include/ketnoi.php");
include("../include/chucnang.php");

if(!empty($_GET['id_sp']))
{
    $id_sp = $_GET['id_sp'];
    $id_sp_chat = $id_sp;

    $sao = 0.0;
    $sql      = "SELECT * FROM danhgiasp WHERE id_sp = $id_sp";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            $sao = $sao + $row['diem_danhgia'];
        }
        $sao = round($sao/mysqli_num_rows($ketqua),1);
    }
    

    $sql = "SELECT count(id_sp) as slbinhluan FROM binhluan WHERE id_sp = $id_sp";
    $row    = mysqli_fetch_assoc(mysqli_query($ketnoi,$sql));
    $soluongbl = $row['slbinhluan'];

    if(isset($_SESSION['id_user']))
    {
        $id_user = $_SESSION['id_user'];
        $sql      = "SELECT * FROM user WHERE id_user = $id_user";
    
        $ketqua   = mysqli_query($ketnoi,$sql);
        if(mysqli_num_rows($ketqua)>0)
        {
            $row = mysqli_fetch_assoc($ketqua);
            $anh_user = $row['anh_user'];
            $ten_user1= $row['ten_user'];
        }
    }



    $sql      = "SELECT * FROM sanpham a, danhmuc b, shop c WHERE a.id_shop = c.id_shop and c.id_dm = b.id_dm and id_sp = $id_sp";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $id_shop1    = $row['id_shop'];
        $ten_shop1  = $row['ten_shop'];
        $soluongkho = $row['soluong_sp'];
        $anh_sp     = $row['anh_sp'];
        $tendm      = $row['ten_dm'];
        $chieudai   = $row['chieudai_sp'];
        $chieurong  = $row['chieurong_sp'];
        $chieucao   = $row['chieucao_sp'];
        $anh_shop1   = $row['anh_shop'];
        $huyenshop  = $row['tenhuyen_shop'];
        $tinhshop   = $row['tentinh_shop'];
        $time_join  = $row['thoigian_thamgia'];
        $tensp      = $row['ten_sp'];
        $daban      = $row['soluongdaban_sp'];
        $gia        = "₫ ".number_format($row['dongia_sp']);
        $mota       = $row['mota_sp'];
        
        $timestamp_join = strtotime($time_join);
        $songaythamgia = round((((strtotime(layThoigian()) - $timestamp_join)/60)/60)/24);
    }
    else
        header("location: ../trangchu");
}
else
{
    header("location: ../trangchu");
}
include("../include/head.php");
?>

<body>
    <audio id='audio' autoplay>
        <source src="../audio/mess.mp3"/>
    </audio>
    <?php include("../include/navbar.php"); ?>
<?php if(isset($_SESSION['id_user'])){ ?>
<div id='chat_area' class="chat d-none d-md-none d-lg-block">
    <div class="chat-head"  onclick="chat_on()">
        <span class="font-shopee2021-bold"><?php echo $ten_shop1; ?></span>
        <span id='close_btn' class="material-icons click">close</span>
    </div>
    <div id='chat_body' class="chat-body">

 
    </div>
    <div class="chat-footer">
        <input id='input_chat' style='color:black;width:100%;height:30px;border-radius:5px;border:none;padding:5px' type="text">
        <span onclick="chat_add()" class="material-icons click">send</span>
    </div>
</div>
<script>
function chat_add(){
    var data = new FormData();
    data.append("input_chat", document.getElementById("input_chat").value);
    data.append("id_sp",<?php echo $id_sp;?>);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $tenmien; ?>/chat/chat_sp.php");
    xhr.onload = function () {
        console.log(this.response);
    };
    xhr.send(data);
    var chat = document.getElementById('chat_body');
    var div  = document.createElement('div');
    div.classList.add('tin-nhan');
    div.innerHTML = "<div class='tn-body'><div class='tn-nd'><span>"+document.getElementById("input_chat").value+"</span></div></div>";
    chat.appendChild(div);
    
    chat.scrollTop = chat.scrollHeight;
    document.getElementById("input_chat").value = "";
    return false;
}
document.addEventListener('keydown', function (event) {
  if (event.key === 'Enter') {
    chat_add();
  }
});
var a_chat = true;
function chat_on(){
    var chat = document.getElementsByClassName('chat');
    var chat_btn = document.getElementById('close_btn');
    if(a_chat == true)
    {
        chat_btn.innerHTML = "expand_less";
        chat[0].classList.add('chat-off');
        chat[0].classList.remove('chat-on');
        a_chat = false;
    }
    else
    {
        chat_btn.innerHTML = "close";
        chat[0].classList.add('chat-on');
        chat[0].classList.remove('chat-off');
        a_chat = true;
    }
    
}
async function add_cart(id){

        

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('thongbao_cart').innerHTML =
            this.responseText;
    }
};
xhttp.open('GET', '<?php echo $tenmien; ?>/page/giohang/chucnang/add_giohang.php?id_sp='+id, true);
xhttp.send();
await sleep(2000);
document.getElementById('animate').classList.remove('animate__bounceInDown');
document.getElementById('animate').classList.add('animate__bounceOutDown');
await sleep(1000);
document.getElementById('thongbao_cart').innerHTML = "";


}
function sleep(ms) {
return new Promise(resolve => setTimeout(resolve, ms));
}
</script>
<?php } ?>
    <div class="body-content">

    <div id="thongbao_cart"></div>
        <div class="info-product-area">
            <div class="info-img">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../img/sanpham/<?php echo $anh_sp;?>" alt="">
                        </div>
                        <?php
                            $sql      = "SELECT * FROM anhsanpham WHERE id_sp = $id_sp";
                            $ketqua   = mysqli_query($ketnoi,$sql);
                            if(mysqli_num_rows($ketqua)>0)
                            {
                                while($row = mysqli_fetch_assoc($ketqua))
                                {
                                    $linkanh = $row['linkanh_sp'];
                                    ?>
                                    <div class="carousel-item">
                                        <img src="../img/sanpham/<?php echo $linkanh;?>" alt="">
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="info-title font-shopee2021-regular">
                <h3><?php echo $tensp; ?></h3>
                <div class="thongtin-danhgia-sp">
                    <div class="flex-center">
                        <span style="font-size:1.2em"><?php echo $sao; ?></span>
                        <div style="font-size:0.2em">
                        <?php
                        if($sao != 0)
                            for($i = 1; $i<=floor($sao);$i++)
                            {
                                ?>
                                <span class="material-icons font-brown">star</span>
                                <?php
                            }
                            else
                                echo "<span class='font-brown' style='font-size:7em'>Chưa có đánh giá</span>"
                        
                        ?>
                        </div>
                    </div>

                    <span class="d-none d-md-none d-lg-block">|</span>
                    <div class="flex-center">
                        <span style="font-size:1.2em">Bình Luận</span>
                        <span style="font-size:1em"><?php echo $soluongbl; ?></span>
                    </div>
                    <span class="d-none d-md-none d-lg-block">|</span>
                    <div class="flex-center">
                        <span style="font-size:1.2em">Đã Bán</span>
                        <span style="font-size:1em"><?php echo $daban; ?></span>
                    </div>

                </div>
                <div class="giatien-sp">
                    <?php echo $gia; ?>
                </div>
                <div class="row-login padding" style='flex-wrap:nowrap'>
                    <div class="colume" style='width:110px'>Kho hàng:</div>
                    <div class="colume" style='width:110px'><?php echo $soluongkho;?></div>
                    <div class="colume" style='width:110px'>Chiều dài:</div>
                    <div class="colume" style='width:110px'><?php echo $chieudai;?> cm</div>
                </div>
                <div class="row-login padding" style='flex-wrap:nowrap'>
                    <div class="colume" style='width:110px'>Chiều cao:</div>
                    <div class="colume" style='width:110px'><?php echo $chieucao;?> cm</div>
                    <div class="colume" style='width:110px'>Chiều rộng:</div>
                    <div class="colume" style='width:110px'><?php echo $chieurong;?> cm</div>
                </div>
                <div class="soluong-sp">
                    <span>Số Lượng</span>
                    <div class="input-tangso">
                        <button onclick="remove()"
                            style='border: 1px solid rgb(0,0,0,0.2);width:25px;height:30px;padding:0px'
                            class="flex-center click"><span class="material-icons">remove</span></button>
                        <div style="border: 1px solid rgb(0,0,0,0.2);height:30px"><input onkeyup="check_soluong()"
                                style="width:50px;border:none;text-align:center;padding:4px" type="number" min='1'
                                max='<?php echo $soluongkho; ?>' value="1" id='soluong'></div>
                        <button onclick="add()"
                            style='border: 1px solid rgb(0,0,0,0.2);width:25px;height:30px;padding:0px'
                            class="flex-center click"><span class="material-icons">add</span></button>
                        <span class="d-none d-md-block" style='padding-left:10px'><?php echo $soluongkho; ?> Sản Phẩm Có
                            Sẵn</span>
                        <script>
                        function add() {
                            var a = document.getElementById('soluong').value;
                            a++;
                            if (a <= <?php echo $soluongkho;?>)
                                document.getElementById('soluong').value = a;
                        }

                        function remove() {
                            var a = document.getElementById('soluong').value;
                            a--;
                            if (a > 0)
                                document.getElementById('soluong').value = a;
                        }

                        function check_soluong() {
                            var a = document.getElementById('soluong').value;
                            if (a > <?php echo $soluongkho;?>)
                                document.getElementById('soluong').value = <?php echo $soluongkho;?>;
                            if (a <= 0)
                                document.getElementById('soluong').value = 1;
                        }
                        </script>
                    </div>
                </div>
                <div class="gio-hang-mua-ngay">
                    <button onclick="add_cart(<?php echo $id_sp;?>)" class="btn flex-center add-giohang"
                        style='background-color:rgb(165,139,105,0.3);color:#4d3d28;padding:18px 30px'><span
                            class="material-icons">add_shopping_cart</span>Thêm Vào Giỏ Hàng</button>
                    <button onclick="add_cart(<?php echo $id_sp;?>);location.href='../cart'" class="btn flex-center mua-hang"
                        style='background-color:rgb(165,139,105,1);color:white;padding:20px 30px;'>Mua Ngay</button>
                </div>
            </div>
        </div>

        <div class="info-shop-area font-shopee2021-regular">
            <div onClick="location.href='../cua-hang?shop=<?php echo $id_shop1;?>'" class="info-img-name-shop click">
                <div class="img-shop">
                    <img style='border-radius:50%' src="../img/avatar_shop/<?php echo $anh_shop1;?>" alt="">
                </div>
                <div class="name-shop">
                    <span style='font-weight:bold;font-size:1.2em'><?php echo $ten_shop1; ?></span><br>
                    <button class="btn bg-brown font-white flex-center"
                        style='font-size:1em;margin-top:5px;padding:5px'><span class="material-icons">store</span>Thăm
                        Shop</button>
                </div>
            </div>
            <div class="another-info-shop">
                <div class="flex-center" style='flex-wrap:wrap;gap:0px;width:100%;padding:0px'>
                    <div class="colume3">
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
                    </div>
                    <div class="colume3">
                        <div class="title-icon">
                            <span class="material-icons-outlined" style='font-size:1.5em'>store</span>
                            <span class="font-shopee2021-regular">ID Shop:</span>
                            <span style='color:#8d704a'><?php echo $id_shop1; ?></span>
                        </div>
                        <div class="title-icon">
                            <span class="material-icons-outlined" style='font-size:1.5em'>local_offer</span>
                            <span class="font-shopee2021-regular">Danh Mục Chuyên:</span>
                            <span style='color:#8d704a'><?php echo $tendm;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mo-ta-aria">
            <div class="mo-ta-left font-shopee2021-regular">
                <h4>MÔ TẢ SẢN PHẨM</h4>
                <hr width="100%" />
                <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
                <style>
                textarea#note {
                    width: 100%;
                    box-sizing: border-box;
                    border: none;
                    background-color: white;
                    display: block;
                    max-width: 100%;
                    overflow-y: hidden;
                    min-height: 95px;
                    border-bottom: 1px solid rgb(0, 0, 0, 0.2);
                    resize: none;
                }
                </style>
                <textarea id="note" disabled><?php echo $mota; ?></textarea>
                <div id="xem_them" style='display:flex;justify-content:center;margin-top:10px'><button
                        onclick="xemthem()" class="btn btn-warning">Xem Thêm</button></div>
                <script>
                function xemthem() {
                    autosize(document.getElementById("note"));
                    document.getElementById('xem_them').classList.add("d-none");

                }
                </script>
            </div>
        </div>
          
        <div class="mo-ta-aria font-shopee2021-regular">
            <div class="mo-ta-left">
                <h4>ĐÁNH GIÁ VỀ SẢN PHẨM</h4>
                <hr width="100%" />
                <div class="cmt-aria" id="cmt_area1">

                    <?php 
                        $sql      = "SELECT * FROM danhgiasp a, user b WHERE id_sp = $id_sp and a.id_user = b.id_user";
                        $ketqua   = mysqli_query($ketnoi,$sql);
                        if(mysqli_num_rows($ketqua)>0)
                        {
                            while($row = mysqli_fetch_assoc($ketqua))
                            {
                                $diem_danhgia           = $row['diem_danhgia'];
                                $noidung                = $row['noidung_danhgia'];
                                $id_user_danhgia        = $row['id_user'];
                                $ten_user_danhgia       = $row['ten_user'];
                                $anh_user_danhgia       = $row['anh_user'];
                                ?>

                                <div class="cmt">
                                    <div class="cmt-img">
                                        <img style="width:50px;height:50px;border-radius:50%" src="../img/avatar_user/<?php echo $anh_user_danhgia; ?>">
                                    </div>
                                    <div class="noidung-area">
                                    <span style="color:gray;width:100%"><?php echo $ten_user_danhgia; ?></span>
                                        <div style="width:100%;height:50px">
                                            <div class="cmt-noidung">
                                                <?php echo $noidung; ?>
                                            </div>
                                        </div>
                                        <div style='display:flex;align-items:center'>
                                        <?php
                                             for($i = 1; $i<=floor($diem_danhgia);$i++)
                                             {
                                                 ?>
                                                 <span class="material-icons font-brown">star</span>
                                                 <?php
                                             }   
                                        ?>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                            
                        }
                        else
                            echo "<div style='width:100%;height:50px;text-align:center' id='mess'><b>Chưa có đánh giá</b></div>";
                       

                    ?>


                </div>
            </div>
        </div>

        <div class="mo-ta-aria font-shopee2021-regular">
            <div class="mo-ta-left">
                <h4>BÌNH LUẬN VỀ SẢN PHẨM</h4>
                <hr width="100%" />
                <div class="cmt-aria" id="cmt_area">

                    <?php 
                        $sql      = "SELECT * FROM binhluan a, user b WHERE a.id_user = b.id_user and id_sp = $id_sp ORDER BY id_bl ASC";
                        $ketqua   = mysqli_query($ketnoi,$sql);
                        if(mysqli_num_rows($ketqua)>0)
                        {
                            while($row = mysqli_fetch_assoc($ketqua))
                            {
                                $anh_user_bl   = $row['anh_user'];
                                $noidung    = $row['noidung_bl'];
                                $time       = $row['thoigian_bl'];
                                $ten_user   = $row['ten_user'];
                                ?>

                                <div class="cmt">
                                    <div class="cmt-img">
                                        <img style="width:50px;height:50px;border-radius:50%" src="../img/avatar_user/<?php echo $anh_user_bl; ?>">
                                    </div>
                                    <div class="noidung-area">
                                    <span style="color:gray;width:100%"><?php echo $ten_user; ?></span>
                                        <div style="width:100%;height:50px">
                                            <div class="cmt-noidung">
                                                <?php echo $noidung; ?>
                                            </div>
                                        </div>
                                        <span style="color:gray;width:100%"><?php echo $time; ?></span>
                                    </div>
                                </div>
                    <?php
                            }
                            
                        }
                        else
                            echo "<div style='width:100%;height:50px;text-align:center' id='mess'><b>Chưa có bình luận</b></div>";
                       

                    ?>


                </div>
                <?php if(isset($_SESSION['id_user'])){ ?>
                <div class="viet-cmt">
                    <img style='width:50px;height:50px;border-radius:50%' src="../img/avatar_user/<?php echo $anh_user; ?>" alt="">
                    <div style='width:100%'>
                        <textarea class="d-none d-md-none" id='id_sp'><?php echo $id_sp; ?></textarea>
                        <textarea id='noidung_binhluan'
                            style='width:100%;padding:10px;border:1px solid rgb(0,0,0,0.1);border-radius:5px'></textarea>
                        <button onclick="add_bl()" class="btn btn-warning">Bình Luận</button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    border: 1px solid rgb(0, 0, 0,0.1);"
            class="font-shopee2021-regular">SẢN PHẨM KHÁC CỦA SHOP</div>
        <!-- Danh sách sản phẩm -->
        
            <?php
            $sql      = "SELECT * FROM sanpham WHERE id_shop = $id_shop1 and tinhtrang_sp = 1 and soluongdaban_sp >= 0 ORDER BY soluongdaban_sp DESC LIMIT 5";
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
               echo "</div>";
            }?>
        <script>



        function add_bl() {
            var noidung = document.getElementById('noidung_binhluan').value;
            if(document.getElementById('mess')!=null)
                document.getElementById('mess').classList.add("d-none");
            if (noidung != "") {
                var div_cmt = document.createElement('div');
                div_cmt.innerHTML =
                    "<div class='cmt-img'><img style='width:50px;height:50px;border-radius:50%' src='../img/avatar_user/<?php echo $anh_user; ?>'></div><div class='noidung-area'><span style='color:gray;width:100%'><?php echo $ten_user1; ?></span><div style='width:100%;height:50px'><div class='cmt-noidung'>" +
                    noidung + "</div></div><span style='color:gray;width:100%'>Bây giờ</span></div>";
                div_cmt.classList.add('cmt');
                var cmt_area = document.getElementById('cmt_area');
                cmt_area.appendChild(div_cmt);
                var chatHistory = document.getElementById("cmt_area");
                chatHistory.scrollTop = chatHistory.scrollHeight;
                them_bl();
                document.getElementById('noidung_binhluan').value = "";
            }
        }

        function them_bl() {
            var data = new FormData();
            data.append("noidung_binhluan", document.getElementById('noidung_binhluan').value);
            data.append("id_sp", document.getElementById('id_sp').value);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../page/binhluan.php");
            xhr.onload = function() {
                console.log(this.response);
            };
            xhr.send(data);
            return false;
        }
        </script>
        <?php 
        if(isset($_GET['id_sp']))
        {
            $add = true;
            foreach($_SESSION['sp_vuaxem'] as $v)
            {
                if($v == $_GET['id_sp'])
                    $add = false;
            }
            if($add == true)
                array_unshift($_SESSION['sp_vuaxem'], $_GET['id_sp']);
        }
        ?>
        <?php include("../include/sanphamvuaxem.php"); ?>
    </div>
    <?php
include("../include/footer.php");
?>
<script src="../js/add_cart.js"></script>
</body>

</html>
