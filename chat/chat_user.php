<?php
    session_start();
    include("../include/ketnoi.php");
    include("../include/chucnang.php");
?>
<?php
if($_POST['input_chat']!="")
{
    require __DIR__ . './../vendor/autoload.php';
    $id_user = $_SESSION['id_user'];
    $sql = "SELECT * FROM user WHERE id_user= $id_user";
    $row = mysqli_fetch_assoc(mysqli_query($ketnoi,$sql));
    $gioitinh = $row['gioitinh_user'];
    $nd      = $_POST['input_chat'];
    $nd = htmlspecialchars($nd);
    $anh_user= $_SESSION['anh_user'];
    $ten    =$_SESSION['ten_user'];
    $chat_user = $_POST['chat_user'];
    $time = layThoigian();
    $chat = [
        $id_user,
        $nd,
        $anh_user,
        $gioitinh,
        $ten,
        $time
    ];
    
      $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
      );
      $pusher = new Pusher\Pusher(
        'fc27c62ee07a76c961f2',
        '4268d3cab499d7eda5e0',
        '1314889',
        $options
      );
    
      $pusher->trigger('my-channel', "chat$id_user$chat_user", $chat);
      $pusher->trigger('my-channel', "chat$chat_user$id_user", $chat);
      $pusher->trigger('my-channel', "chat$chat_user", $chat);
      $col      = ['user_from','user_to','noidung','time'];
      $value    = [$id_user,$chat_user,$nd,layThoigian()];
      insert_table("chat",$col,$value);
}

?>