<?php 
$tenmien = "http://localhost";
if(!isset($_SESSION['sp_vuaxem']))
    $_SESSION['sp_vuaxem'] = [];
if(isset($_SESSION['id_user']))
{
    $id_user  = $_SESSION['id_user'];
    $sql      = "SELECT * FROM user WHERE id_user = $id_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            $tendn      = $row['tendangnhap_user'];
            $avatar     = $row['anh_user'];
            $gioitinh   = $row['gioitinh_user'];
            $ho         = $row['ho_user'];
            $ten        = $row['ten_user'];
            $sdt        = $row['sdt_user'];
            $email      = $row['email_user'];
            $ngaysinh   = $row['ngaysinh_user'];
        }
    }
    $sql      = "SELECT * FROM shop WHERE id_user = $id_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            $_SESSION['id_shop'] = $row['id_shop'];
            $id_dm_shop     = $row['id_dm'];
            $ten_shop       = $row['ten_shop'];
            $tenduong       = $row['tenduong_shop'];
            $tinh           = $row['tentinh_shop'];
            $huyen          = $row['tenhuyen_shop'];
            $xa             = $row['tenxa_shop'];
            $sdt_shop       = $row['sdt_shop'];
            $anh_shop       = $row['anh_shop'];
        }
    }
    $shop_id = $_SESSION['id_shop'];
    $sql      = "SELECT * FROM sanpham WHERE id_shop = $shop_id and tinhtrang_sp = 1";
    $ketqua   = mysqli_query($ketnoi,$sql);
    $soluongsanpham = mysqli_num_rows($ketqua);

    $danhgiacuashop = 0;
    $sql      = "SELECT * FROM danhgiasp a, sanpham b, shop c WHERE a.id_sp = b.id_sp and b.id_shop = c.id_shop and b.id_shop = $shop_id";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            $danhgiacuashop = $danhgiacuashop + $row['diem_danhgia'];
        }
        $danhgiacuashop = round($danhgiacuashop/mysqli_num_rows($ketqua),1);
    }

}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/img/logo_sara/logo-vuong-noel.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sara Shopping | Mua và Bán thương mại</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/login.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/color.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/font.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/page.css">
    <link rel="stylesheet" href="<?php echo $tenmien; ?>/css/sanpham.css">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <?php if(isset($_SESSION['id_user'])){ ?>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('fc27c62ee07a76c961f2', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('cart', function(data) {
        var cart = document.getElementsByName('cart');
        cart[0].textContent = data;
        cart[1].textContent = data;
        });
    </script>
    <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('fc27c62ee07a76c961f2', {
    cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('chat<?php echo "$id_user" ?>', function(data){
        console.log(data);
        var new_mes = document.getElementById('new_mess').textContent;
        new_mes++;
        document.getElementById('new_mess').textContent = new_mes;
    });
    channel.bind('sanpham<?php if(isset($id_sp_chat))  echo $id_sp_chat; ?>', function(data) {
    var chat = document.getElementById('chat_body');
    var div  = document.createElement('div');
    var audio_chat = document.getElementById('audio');
    if(data[0]== <?php echo $_SESSION['id_user']; ?>)
    {
       
    }
    else
    {
        if(data[3]=="Nam" && data[2]=="default_avatar.jpg")
        {
            data[2] = "default_avatar_boy.jpg";
        }
        else if((data[3]=="Nữ" || data[3]=="Khác") && data[2]=="default_avatar.jpg")
        {
            data[2] = "default_avatar_girl.jpg";
        }
        audio_chat.autoplay = 'true';
        audio_chat.load();
        div.classList.add('tin-nhan1');
        div.classList.add('animate__animated');
        div.classList.add('animate__bounceInLeft');
        div.innerHTML = "<div class='tn-img'><img style='width: 40px;height: 40px;border-radius:50%' src='../img/avatar_user/"+data[2]+"'></div><div class='tn-body1'><div class='tn-name1'><span>"+data[4]+"</span></div><div class='tn-nd1'><span>"+data[1]+"</span></div></div>";
    }
    chat.appendChild(div);
    
    chat.scrollTop = chat.scrollHeight;
    });
    </script>
    <?php } ?>
    <style>
        img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
            display: none;
        }

    </style>
		<style>

.image_area {
  position: relative;
}

img {
      display: block;
      max-width: 100%;
}

.preview {
      overflow: hidden;
      width: 160px; 
      height: 160px;
      margin: 10px;
      border: 1px solid red;
}

.modal-lg{
      max-width: 1000px !important;
}

.overlay {
  position: absolute;
  bottom: 10px;
  left: 5px;
  right: 0;
  background-color: rgb(255, 255, 255,0.5);
  overflow: hidden;
  height: 0;
  transition: .5s ease;
  width: 95%;
  border-radius: 0px 0px 300px 300px;
}

.image_area:hover .overlay {
  height: 50%;
  cursor: pointer;
}

.text {
  color: #333;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

</style>
</head>