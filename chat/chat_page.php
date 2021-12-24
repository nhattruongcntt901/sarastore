<?php
session_start();
include("../include/ketnoi.php");
if(isset($_SESSION['id_user']))
{
    if(empty($_GET['chat_user']))
    {
        $_GET['id_user'] =8;
    }
    $id_user    = $_SESSION['id_user'];
    $chat_user  = $_GET['chat_user'];
    
    $sql    = "UPDATE `chat` SET `dadoc` = 1 WHERE (user_from = $chat_user or user_from = $id_user) and (user_to = $chat_user or user_to = $id_user)";
    mysqli_query($ketnoi,$sql);
    $sql      = "SELECT * FROM user WHERE id_user = $chat_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $ten = $row['ten_user'];
        $anh_user = $row['anh_user'];
    }
    $sql      = "SELECT * FROM shop WHERE id_user = $chat_user";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
            $id_shop        = $row['id_shop'];
            $ten_shop       = $row['ten_shop'];
        }
    }
    $sql      = "SELECT count(dadoc) as soluong FROM chat WHERE (user_to = $id_user or user_from = $id_user) and dadoc = 0";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        $row = mysqli_fetch_assoc($ketqua);
        $soluong = $row['soluong'];
    }
} 
else
    {
        header("location: ../");
        die();
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
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://localhost/css/style.css">
    <link rel="stylesheet" href="http://localhost/css/login.css">
    <link rel="stylesheet" href="http://localhost/css/color.css">
    <link rel="stylesheet" href="http://localhost/css/font.css">
    <link rel="stylesheet" href="http://localhost/css/page.css">
    <link rel="stylesheet" href="http://localhost/css/sanpham.css">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('list_items').innerHTML =
                    this.responseText;
            }
        };
        xhttp.open('GET', 'http://localhost/chat/sort_list.php', true);
        xhttp.send();
    });
    channel.bind('chat<?php echo "$id_user$chat_user" ?>', function(data) {
        var chat = document.getElementById('chats');
        var div = document.createElement('div');
        // var audio_chat = document.getElementById('audio');
        if (data[0] == <?php echo $id_user; ?>) {

        } else {
            if (data[3] == "Nam" && data[2] == "default_avatar.jpg") {
                data[2] = "default_avatar_boy.jpg";
            } else if ((data[3] == "Nữ" || data[3] == "Khác") && data[2] == "default_avatar.jpg") {
                data[2] = "default_avatar_girl.jpg";
            }
            div.classList.add('tin-nhan1');
            div.classList.add('animate__animated');
            div.classList.add('animate__bounceInLeft');
            div.innerHTML =
                "<div class='tn-img'><img style='width: 40px;height: 40px;border-radius:50%' src='../img/avatar_user/" +
                data[2] + "'></div><div class='tn-body1'><div class='tn-name1'><span>" + data[4] +
                "</span></div><div class='tn-nd1'><span>" + data[1] + "</span></div><div class='tn-name1'><span class='font-shopee2021-regular' style='font-size:0.7em;color:gray'>"+data[5]+"</span></div></div>";
        }
        chat.appendChild(div);

        chat.scrollTop = chat.scrollHeight;

    });
    </script>
<style>
    img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
        display: none;
    }

    
</style>
<link rel="stylesheet" href="../css/chat.css">
</head>

<body style='background-color: white;display: flex;'>
    <div class="user-chat-list">
        <div style='display:flex;gap:10px;align-items: center;'>
            <img style='width:35px;height:35px;border-radius: 50%;'
                src="../img/avatar_user/<?php echo $_SESSION['anh_user']; ?>" alt="">
            <h3 class="font-shopee2021-bold">Chat</h3>
        </div>
        
        <div class="input-search">
            <span class="material-icons">search</span>
            <input onkeyup="search(this.value)" onblur="unsearch()" style='border: none;width: 100%;height: 100%;background-color: transparent;'
                placeholder="Tìm kiếm trên SaraMess" type="text">
        </div>

        <div style='width:100%;height:50px;padding:10px'>
            <button class="btn font-shopee2021-regular" style='padding:10px;color:black;border:1px solid #a58b69;border-radius:30px'>Tin nhắn mới</button>
            <span class="cart-soluong font-shopee2021-light" id='new_mess'><?php echo $soluong; ?></span>
        </div>

        <div class="list-items" id='list_items'>
            <?php
                    $sql      = "SELECT * FROM chat WHERE user_to = $id_user AND id in (SELECT MAX(id) FROM chat WHERE user_to = $id_user GROUP BY user_from) ORDER BY id DESC";
                    $ketqua   = mysqli_query($ketnoi,$sql);
                    if(mysqli_num_rows($ketqua)>0)
                    {
                        while($row = mysqli_fetch_assoc($ketqua))
                        {
                            $nd = $row['noidung'];
                            $user_from = $row['user_from'];
                            $dadoc = $row['dadoc'];
                            $sql      = "SELECT * FROM user WHERE id_user = $user_from";
                            $ketqua1   = mysqli_query($ketnoi,$sql);
                            if(mysqli_num_rows($ketqua1)>0)
                            {
                                $row1 = mysqli_fetch_assoc($ketqua1);
                                $ten1 = $row1['ten_user'];
                                $anh_user1 = $row1['anh_user'];
                            }
                            if($dadoc==0){

                                ?>
                                 <div class="list-item" onClick="location.href='chat_page.php?chat_user=<?php echo $user_from; ?>'">
                                    <img src="../img/avatar_user/<?php echo $anh_user1; ?>"
                                        style='width:55px;height:55px;border-radius: 50%;' alt="">
                                    <div>
                                        <span class="font-shopee2021-regular" style='font-size: 1.2em;'><?php echo $ten1; ?></span><br>
                                        <span class="font-shopee2021-bold xemtruoc" style='font-size: 1em;color: black;'><?php echo $nd; ?></span>
                                    </div>
                                    <div class="new font-shopee2021-light" id='new_mess'></div>
                                </div>
                                <?php
                            }
                            else{
                            ?>

            <div class="list-item" onClick="location.href='chat_page.php?chat_user=<?php echo $user_from; ?>'">
                <img src="../img/avatar_user/<?php echo $anh_user1; ?>"
                    style='width:55px;height:55px;border-radius: 50%;' alt="">
                <div>
                    <span class="font-shopee2021-regular" style='font-size: 1.2em;'><?php echo $ten1; ?></span><br>
                    <span class="font-shopee2021-light xemtruoc" style='font-size: 1em;color: gray;'><?php echo $nd; ?></span>
                </div>
            </div>
            <?php
                            }
                        }
                    }
                ?>

        </div>
    </div>
    <div class="chat-body1">
        <div class="body-head">
            <div style='display:flex;gap:10px;align-items: center;'>
                <img style='width:35px;height:35px;border-radius: 50%;'
                    src="../img/avatar_user/<?php echo $anh_user; ?>" alt="">
                <h3 class="font-shopee2021-bold">
                    <?php echo $ten; ?><?php if(isset($ten_shop)) echo "<a href='http://localhost/cua-hang?shop=$id_shop' style='color:#a58b69'> ($ten_shop)</a>"; ?>
                </h3>
            </div>
        </div>
        <div class="chats" id='chats'>
            <?php
                $sql      = "SELECT * FROM chat WHERE (user_from = $id_user or user_from = $chat_user) and (user_to = $id_user or user_to = $chat_user)";
                $ketqua   = mysqli_query($ketnoi,$sql);
                if(mysqli_num_rows($ketqua)>0)
                {
                    while($row = mysqli_fetch_assoc($ketqua))
                    {
                        $user_from  = $row['user_from'];
                        $user_to    = $row['user_to'];
                        $nd         = $row['noidung'];
                        $time       = $row['time'];
                        if($user_from == $id_user)
                        {
                            ?>
            <div class="tin-nhan">
                <div class='tn-body'>
                    <div class='tn-nd'>
                        <span><?php echo $nd; ?></span>
                    </div>
                </div>
            </div>
            <?php
                        }
                        else if($user_from == $_GET['chat_user'])
                        {
                            ?>
            <div class="tin-nhan1">
                <div class='tn-img'>
                    <img style='width: 40px;height: 40px;border-radius:50%'
                        src='../img/avatar_user/<?php echo $anh_user; ?>'>
                </div>
                <div class='tn-body1'>
                    <div class='tn-name1'>
                        <span class="font-shopee2021-regular"><?php echo $ten; ?></span>
                    </div>
                    <div class='tn-nd1'>
                        <span><?php echo $nd; ?></span>
                    </div>
                    <div class='tn-name1'>
                        <span class="font-shopee2021-regular" style='font-size:0.7em;color:gray'><?php echo $time; ?></span>
                    </div>
                </div>
            </div>
            <?php
                        }
                    }
                }
            ?>





        </div>
        <div style="padding: 0px 20px;display: flex;align-items: center;">
            <div class="input-chat">
                <input id='input_chat' style='border: none;width: 100%;height: 100%;background-color: transparent;'
                    placeholder="Gửi tin nhắn...." type="text">
            </div>
            <span onclick="chat_add()" class="material-icons btn" style="font-size: 2em;color: #a58b69;">send</span>
        </div>
    </div>
</body>
<script>
var chat = document.getElementById('chats');

function chat_add() {
    if(document.getElementById("input_chat").value != "")
    {
        var data = new FormData();
        data.append("input_chat", document.getElementById("input_chat").value);
        data.append("chat_user", <?php echo $_GET['chat_user']; ?>)
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/chat/chat_user.php");
        xhr.onload = function() {
            console.log(this.response);
        };
        xhr.send(data);

    

        var div = document.createElement('div');
        div.classList.add('tin-nhan');
        div.innerHTML = "<div class='tn-body'><div class='tn-nd'><span>" + document.getElementById("input_chat").value +
            "</span></div></div>";
        chat.appendChild(div);

        chat.scrollTop = chat.scrollHeight;
        document.getElementById("input_chat").value = "";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('list_items').innerHTML =
                    this.responseText;
            }
        };
        xhttp.open('GET', 'http://localhost/chat/sort_list.php', true);
        xhttp.send();

        return false;
    }
    
}
document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        chat_add();
    }
});
chat.scrollTop = chat.scrollHeight;
function search(value){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('list_items').innerHTML =
                    this.responseText;
            }
        };
        xhttp.open('GET', 'http://localhost/chat/search.php?user='+ value, true);
        xhttp.send();
}
async function unsearch(){
    await sleep(500);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('list_items').innerHTML =
                    this.responseText;
            }
        };
        xhttp.open('GET', 'http://localhost/chat/sort_list.php', true);
        xhttp.send();
}
function sleep(ms) {
return new Promise(resolve => setTimeout(resolve, ms));
}
</script>

</html>