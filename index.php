<?php
header('Access-Control-Allow-Origin: *');
session_start();
include("include/ketnoi.php");
include("include/head.php");
$sql      = 'SELECT * FROM website';
$ketqua   = mysqli_query($ketnoi,$sql);
$row = mysqli_fetch_assoc($ketqua);
$truycap = $row['luottruycap'];
$truycap++;
$sql      = "UPDATE website SET luottruycap = $truycap";
mysqli_query($ketnoi,$sql);
?>

<body>
    <?php include("include/navbar.php"); ?>
    <audio id='audio'>
        <source src="audio/mess.mp3"/>
    </audio>
    <?php if(isset($_SESSION['id_user'])){ ?>
<div id='chat_area' class="chat d-none d-md-none d-lg-block">
    <div class="chat-head"  onclick="chat_on()">
        <span class="font-shopee2021-bold">Kênh Chat Tổng SARA</span>
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
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/chat/chat.php");
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
</script>
<?php } ?>
    <!-- body content -->
    <div class="body-content">
        <!-- Banner -->
        <div class="banner">
            <!-- slide ảnh-->
            <div class="slide-anh">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100"
                                src="https://cf.shopee.vn/file/40c061cbd68105c20b73f2a753834504_xxhdpi"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                src="https://cf.shopee.vn/file/40c061cbd68105c20b73f2a753834504_xxhdpi"
                                alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100"
                                src="https://cf.shopee.vn/file/40c061cbd68105c20b73f2a753834504_xxhdpi"
                                alt="Third slide">
                        </div>
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
            <!-- banner cố định -->
            <div class="banner-codinh">
                <div class="banner-item float-right">
                    <img class="d-block w-100" src="https://cf.shopee.vn/file/40c061cbd68105c20b73f2a753834504_xxhdpi"
                        alt="First slide">
                </div>
                <div class="banner-item float-right">
                    <img class="d-block w-100" src="https://cf.shopee.vn/file/40c061cbd68105c20b73f2a753834504_xxhdpi"
                        alt="First slide">
                </div>
            </div>
        </div>
        <!-- Danh mục nổi bật -->
        <div class="danh-muc-noi-bat">
            <div class="danh-muc-items">
                <?php
                    $sql      = "SELECT * FROM danhmuc ORDER BY click DESC LIMIT 9";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        while($row = mysqli_fetch_assoc($ketqua))
                        {
                            $ten_dm     = $row['ten_dm'];
                            $anh_dm     = $row['anh_dm'];
                            $id_dm      = $row['id_dm']; ?>
                                <div class="danh-muc-item click" onclick="location.href='search/danhmuc.php?key=<?php echo $id_dm; ?>'">
                                    <div class="child">
                                        <div class="item-icon">
                                            <img src="img/danhmuc/<?php echo $anh_dm; ?>" alt="">
                                        </div>
                                        <div class="item-title" style='text-align:center'>
                                            <span><?php echo $ten_dm; ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
        </div>
        <!-- Quảng cáo -->
        <div class="quang-cao">
            <img src="img/banner/banner1.jfif" alt="">
        </div>
        <!-- Tất cả danh mục -->
        <div style="padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);"
            class="font-shopee2021-regular">DANH MỤC</div>
        <div class="danh-mucs">
            <?php
                $sql      = 'SELECT * FROM danhmuc';
                $ketqua   = mysqli_query($ketnoi,$sql);
                if(mysqli_num_rows($ketqua)>0)
                {
                    while($row = mysqli_fetch_assoc($ketqua))
                    {
                        $ten_dm     = $row['ten_dm'];
                        $anh_dm     = $row['anh_dm'];
                        $id_dm      = $row['id_dm']; ?>
                    <div class="danh-muc click" onclick="location.href='search/danhmuc.php?key=<?php echo $id_dm; ?>'">
                <div class="dm-icon">
                    <img src="img/danhmuc/<?php echo $anh_dm;?>" alt="">
                </div>
                <div class="dm-title">
                    <span><?php echo $ten_dm; ?></span>
                </div>
            </div>

                <?php
                    }
                }

                ?>
        </div>
        <!-- sanpham -->
        <div style="margin-top:20px;padding: 20px;background-color: white;font-size: 1.4em;color: rgba(0, 0, 0, 0.555);"
            class="font-shopee2021-regular">SẢN PHẨM MỚI ĐƯỢC ĐĂNG BÁN</div>
            <?php
            $sql      = "SELECT * FROM sanpham WHERE tinhtrang_sp = 1 ORDER BY id_sp DESC LIMIT 25";
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
            } ?>
    </div>
    <!-- Footer -->
    <?php include("include/footer.php"); ?>
<script src="js/add_cart.js"></script>
</body>

</html>