<?php
session_start();
$id_user = $_SESSION['id_user'];
include("../include/ketnoi.php");
?>
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
