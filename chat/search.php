<?php
$user = $_GET['user'];
$user = str_replace(" ", "%", $user);
include("../include/ketnoi.php");
?>
<?php
    $sql      = "SELECT * FROM user WHERE id_user like '$user' or CONCAT_WS(' ',ho_user,ten_user) like '%$user%'";
    $ketqua   = mysqli_query($ketnoi,$sql);
    if(mysqli_num_rows($ketqua)>0)
    {
        while($row = mysqli_fetch_assoc($ketqua))
        {
                $ten1 = $row['ten_user'];
                $anh_user1 = $row['anh_user'];
                $id_user = $row['id_user'];
            ?>
            <div class="list-item" onClick="location.href='chat_page.php?chat_user=<?php echo $id_user; ?>'">
                <img src="../img/avatar_user/<?php echo $anh_user1; ?>" style='width:55px;height:55px;border-radius: 50%;' alt="">
                <div>
                    <span class="font-shopee2021-regular" style='font-size: 1.2em;'><?php echo $ten1; ?></span><br>
                </div>
            </div>
            <?php
        }
    }
?>