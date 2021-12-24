<?php
session_start();
include("../../include/chucnang.php");
include("../../include/without_login.php");

$id_user = $_SESSION['id_user'];
$id_donhang = $_GET['id_donhang'];
$sql      = "SELECT * FROM donhang WHERE id_donhang = $id_donhang and id_user = $id_user";
$ketqua   = mysqli_query($ketnoi,$sql);
if(mysqli_num_rows($ketqua)>0)
{
    update_table("donhang","tinhtrang_donhang",1,"id_donhang",$id_donhang);
}
else 
    header("location: ../../trangchu");
include("../../include/head.php");
?>
<body>
    <div class="head-login">
        <div class="logo-login">
            <a href="../"><img src="../img/logo_sara/ngang-trongsuot.png" alt=""></a>
        </div>
        <span class="title font-shopee2021-regular d-none d-md-block">Đánh giá sản phẩm</span>
    </div>
    <div class="body-content">
        <?php
            $sql      = "SELECT * FROM donhang_sanpham WHERE id_donhang = $id_donhang and danhgia = 0";
            $ketqua   = mysqli_query($ketnoi,$sql);
            if(mysqli_num_rows($ketqua)>0)
            {
                while($row = mysqli_fetch_assoc($ketqua))
                {
                    $soluong    = $row['soluongdat'];
                    $ten_sp     = $row['ten_sp'];
                    $id_sp      = $row['id_sp'];
                    $anh_sp     = $row['anh_sp'];
                    $gia_sp     = $row['dongia'];
                    ?>
                    <div id='danhgia_sp<?php echo $id_sp; ?>' class="animate__animated">
                        <div class="cart-product">
                            <div class="product-img">
                                <img src="../../img/sanpham/<?php echo $anh_sp; ?>" alt="">
                            </div>
                            <div class="right">
                                <div class="product-name click"
                                    onClick="location.href='../san-pham?id_sp=<?php echo $id_sp; ?>'">
                                    <span class="font-shopee2021-regular"><?php echo $ten_sp; ?></span>
                                </div>
                                <div class="product-single-price">
                                    <span>₫ <?php echo number_format($gia_sp); ?></span>
                                </div>
                                <div class="product-soluong">
                                    <div>
                                        X<?php echo $soluong; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form style="background-color: white;padding:10px;margin-bottom:40px">
                        <hr width="100%">
                            <div style='display:flex;gap:10px;margin-top:10px'>
                                <input type="radio" name='sao<?php echo $id_sp; ?>' value="1" ><span class="material-icons font-brown">star</span>
                            </div>
                            <div style='display:flex;gap:10px;margin-top:10px'>
                                <input type="radio" name='sao<?php echo $id_sp; ?>' value="2" ><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span>
                            </div>
                            <div style='display:flex;gap:10px;margin-top:10px'>
                                <input type="radio" name='sao<?php echo $id_sp; ?>' value="3" ><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span>
                            </div>
                            <div style='display:flex;gap:10px;margin-top:10px'>
                                <input type="radio" name='sao<?php echo $id_sp; ?>' value="4" ><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span>
                            </div>
                            <div style='display:flex;gap:10px;margin-top:10px'>
                                <input type="radio" name='sao<?php echo $id_sp; ?>' value="5" checked><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span><span class="material-icons font-brown">star</span>
                            </div>
                            <div class="viet-cmt" style='margin-top:20px'>
                                <img style='width:50px;height:50px;border-radius:50%' src="../img/avatar_user/<?php echo $_SESSION['anh_user']; ?>" alt="">
                                <div style='width:100%'>
                                    <textarea id='noidungdanhgia<?php echo $id_sp; ?>'
                                        style='width:100%;padding:10px;border:1px solid rgb(0,0,0,0.1);border-radius:5px'></textarea>
                                    <button type="button" onclick="gui_danhgia(<?php echo $id_sp; ?>)" class="btn btn-warning">Gửi đánh giá</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="font-brown font-shopee2021-bold" style='width:100%;display:flex;justify-content:center;align-items:center;height:80vh;font-size:2em'><span>Bạn đã đánh giá các sản phẩm đơn hàng này</span></div>
                <?php
            }
        ?>
    </div>
    <?php include("../../include/footer.php"); ?>
</body>
<script>
    async function gui_danhgia(id) {
        for(var i=0;i<5;i++)
        {
            if(document.getElementsByName("sao"+id)[i].checked ==true)
            {
                var so_sao = document.getElementsByName("sao"+id)[i].value;
                break;
            }   
        }
    var data = new FormData();
    data.append("sao", so_sao);
    data.append("noidungdanhgia", document.getElementById("noidungdanhgia"+id).value);
    data.append("id_sp", id);
    data.append("id_donhang", <?php echo $id_donhang; ?> );
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../page/nguoimua/chucnang/guidanhgia.php");
    xhr.onload = function () {
        console.log(this.response);
    };
    xhr.send(data);
    document.getElementById("danhgia_sp"+ id).classList.add("animate__backOutRight");
    await sleep(900);
    document.getElementById("danhgia_sp"+ id).remove();

    return false;
}
function sleep(ms) {
return new Promise(resolve => setTimeout(resolve, ms));
}
</script>
</html>