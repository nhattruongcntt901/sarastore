<?php
    $ketnoi = mysqli_connect('localhost','root','','sara');
        if(!$ketnoi)
            die("Kết nối thất bại!!!".mysqli_connect_error());
    $ketnoi1 = mysqli_connect('localhost','root','','tinhthanh');
        if(!$ketnoi1)
            die("Kết nối thất bại!!!".mysqli_connect_error());           
?>
<?php 
    include('PHPMailer-5.2.26/class.smtp.php');
    include "PHPMailer-5.2.26/class.phpmailer.php";
    
    require 'PHPMailer-6.5.3/src/Exception.php';
    require 'PHPMailer-6.5.3/src/PHPMailer.php';
    require 'PHPMailer-6.5.3/src/SMTP.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    
        
    
    
    
    
    
        
    function layThoigian(){
        date_default_timezone_set("Asia/Ho_Chi_Minh");    
        return date("d-m-Y  H:i:s"); 
    }
    function CheckSpecialChar($string){
        foreach($string as $value)
        {
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)==true)
                return true;
        }
        return false;     
    }
    function CheckSpecialChar_ngaysinh($string){
        foreach($string as $value)
        {
            if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬]/', $value)==true)
                return true;
        }
        return false;     
    }
    function CheckNumChar($string){
        if(preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $string)==true)
        {
            return true;
        }
        else  
            return false;
    }
    function guimail($tennguoinhan,$emailnguoinhan,$maso){
    
        $nFrom = "Sara cần xác nhận Email của bạn";    //mail duoc gui tu dau, thuong de ten cong ty ban
        $mFrom = 'guimailxacnhan@gmail.com';  //dia chi email cua ban 
        $mPass = 'nhattruong9012';       //mat khau email cua ban
        $nTo = $tennguoinhan; //Ten nguoi nhan
        $mTo = $emailnguoinhan;   //dia chi nhan mail
        $mail             = new PHPMailer();
        $body             = "    <div>
        <div style='font-family: Nunito, sans-serif;'>
        <div style='background-color: #a58b69;width:100%;height:300px;border-radius:10px;'>
            <div style='display: flex !important;align-items: center !important;'>
            <div style='margin-left:auto;margin-right: auto;'>
                <h2 align='center' style='color:white'>MÃ XÁC NHẬN MAIL TỪ SARA</h2>
                <p align='center' style='font-size:25px;padding: 20px;background-color:white'><b>$maso</b></p>
            </div>
            </div>
        </div>
        </div>
    </div>";   // Noi dung email
        $title = 'Mã code xác nhận';   //Tieu de gui mail
        $mail->IsSMTP();             
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";    // sever gui mail.
        $mail->Port       = 465;         // cong gui mail de nguyen
        // xong phan cau hinh bat dau phan gui mail
        $mail->Username   = $mFrom;  // khai bao dia chi email
        $mail->Password   = $mPass;              // khai bao mat khau
        $mail->SetFrom($mFrom, $nFrom);
        $mail->AddReplyTo('truong.nhn.60cntt@ntu.edu.vn', 'quanlyduan901.000webhostapp.com'); //khi nguoi dung phan hoi se duoc gui den email nay
        $mail->Subject    = $title;// tieu de email 
        $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
        $mail->AddAddress($mTo, $nTo);
        // thuc thi lenh gui mail 
        if(!$mail->Send()) {
            echo 'Co loi!';
            
        } else {
            
            // echo "<p style='color:white'>mail của bạn đã được gửi đi hãy kiếm tra hộp thư đến để xem kết quả.</p> ";
        }
    }
    function guimail1($email,$maso){
        require '../vendor/autoload.php';
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->CharSet  = "utf-8";
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'guimailxacnhan@gmail.com';                     //SMTP username
            $mail->Password   = 'nhattruong9012';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('guimailxacnhan@gmail.com', 'Xác Nhận Tài Khoản Email Từ SaraStore');
            $mail->addAddress("$email", "$email");     //Add a recipient              
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
           
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mã Xác Nhận Tài Khoản Email SaraStore';
            $mail->Body    = "    <div>
        <div style='font-family: Nunito, sans-serif;'>
        <div style='background-color: #a58b69;width:100%;height:300px;border-radius:10px;'>
            <div style='display: flex !important;align-items: center !important;'>
            <div style='margin-left:auto;margin-right: auto;'>
                <h2 align='center' style='color:white'>MÃ XÁC NHẬN MAIL TỪ SARA</h2>
                <p align='center' style='font-size:25px;padding: 20px;background-color:white'><b>$maso</b></p>
            </div>
            </div>
        </div>
        </div>
    </div>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    function checkEmail($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else
            return false;
     }
    function insert_table($table,$array_col,$array_value){
        global $ketnoi;
        $array_col_a = [];
        $array_value_a= [];
        $mang = "";
        $mang_value = "";
    
        $i = 0;
        $array_col_a = $array_col;
        $array_value_a = $array_value;
        $soluong_pt = count($array_col_a);
        foreach ($array_col_a as $value){
            $i++;
            if($i==$soluong_pt)
                $mang .= "`".$value."`";
            else 
                $mang .= "`".$value."`,"; 
        }
        $i=0;
        foreach ($array_value_a as $value){
            $i++;
            if($i==$soluong_pt)
                $mang_value .= "'".$value."'";
            else 
                $mang_value .= "'".$value."',"; 
        }
        $sql = "INSERT INTO `$table`($mang) VALUES ($mang_value)";
        mysqli_query($ketnoi,$sql);
    
    }
    function delete_table($table,$tencot,$id){
        global $ketnoi;
        $sql = "DELETE FROM `$table` WHERE `$tencot` = $id";
        mysqli_query($ketnoi,$sql);
    }
    function update_table($table,$tencot,$value,$tencot1,$id){
        global $ketnoi;
        $sql = "UPDATE `$table` SET `$tencot` = '$value' WHERE $tencot1='$id'";
        mysqli_query($ketnoi,$sql);
    }
    function upload_music_file($thumuc,$name,$ten_file){
    
        $upload_name    = $_FILES["$name"]["name"];
        $upload_size    = $_FILES["$name"]["size"];
        $upload_tmpname = $_FILES["$name"]['tmp_name'];
    
    
        $file_path = $thumuc.$upload_name;
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $tenfile = $ten_file.".".$file_type;
        $file_path = $thumuc.$tenfile;
        $type = array('mp3','wav');
        
        if(in_array($file_type,$type))
        {
            $dk = true;
            if(isset($_POST["submit"])) 
            {
                if($upload_size>2097152)
                    {
                        echo "File dung lượng lớn";
                        $dk = false;
                    }
                if(file_exists($file_path))
                    {
                        echo "File Trùng";
                        $dk = false;
                    }
            }
        }
        if($dk == true)
        {
            move_uploaded_file($upload_tmpname,$file_path);
        }
    } 
    function upload_image_file($thumuc,$name,$ten_file){
    
        $upload_name    = $_FILES["$name"]["name"];
        $upload_size    = $_FILES["$name"]["size"];
        $upload_tmpname = $_FILES["$name"]['tmp_name'];
    
    
        $file_path = $thumuc.$upload_name;
        $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $tenfile = $ten_file.".".$file_type;
        $file_path = $thumuc.$tenfile;
        $type = array('jpg','jpeg','png','gif');
        
        if(in_array($file_type,$type))
        {
            $dk = true;
            if(isset($_POST["submit"])) 
            {
                $check = getimagesize($upload_tmpname);
                if($check !== false) 
                {
                  echo "Đây là hình- " . $check["mime"] . ".";
                  $dk = true;
                  if($upload_size>2097152)
                    {
                        echo "File dung lượng lớn";
                        $dk = false;
                    }
                    if(file_exists($file_path))
                    {
                        echo "File Trùng";
                        $dk = false;
                    }
                } 
                else
                {
                  echo "File is not an image.";
                  $dk = false;
                }
            }
        }
        if($dk == true)
        {
            move_uploaded_file($upload_tmpname,$file_path);
        }
    } 

//     ví dụ
// $name_input = "files";
// $thumuc = "upload/";
// $ten_file = "chau";

// upload_multi_img_files($name_input,$thumuc,$ten_file);

function upload_multi_img_files($name_input,$thumuc,$ten_file){
    $a = 0;
    foreach($_FILES['files'] as $value)
    {
            $upload_name    = $_FILES["$name_input"]["name"][$a];
            $upload_size    = $_FILES["$name_input"]["size"][$a];
            $upload_tmpname = $_FILES["$name_input"]['tmp_name'][$a];
            
        
            $file_path = $thumuc.$upload_name;
            $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
            $tenfile = "$ten_file-$a.$file_type";
            $file_path = $thumuc.$tenfile;
            $type = array('jpg','jpeg','png','gif');
            if($a<count($_FILES['files'])-2)
                $a++;
            if(in_array($file_type,$type))
            {
                $dk = true;
                if(isset($_POST["submit"])) 
                {
                    $check = getimagesize($upload_tmpname);
                    if($check !== false) 
                    {
                    echo "Đây là hình- " . $check["mime"] . ".";
                    $dk = true;
                    if($upload_size>2097152)
                        {
                            echo "File dung lượng lớn";
                            $dk = false;
                        }
                        if(file_exists($file_path))
                        {
                            echo "File Trùng";
                            $dk = false;
                        }
                    } 
                    else
                    {
                    echo "File is not an image.";
                    $dk = false;
                    }
                }
            }
            if($dk == true)
            {
                move_uploaded_file($upload_tmpname,$file_path);
            }
    }
}
function checktinh($id){
    $url = "http://sandbox.goship.io/api/v2/cities";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);

    foreach($array->data as $value)
    {
            if($value->id == $id)
                    return true;
    }
    return false;
}
function checkhuyen($id){
    $url = "http://sandbox.goship.io/api/v2/cities/$id/districts";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);

    foreach($array->data as $value)
    {
            if($value->id==$id)
                    return true;
    }
    return false;
}
function checkxa($id){
    $url = "http://sandbox.goship.io/api/v2/districts/$id/wards";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);

    foreach($array->data as $value)
    {
            if($value->id==$id)
                    return true;
    }
    return false;
}
function tracuu_don($madon){
    $url = "http://sandbox.goship.io/api/v2/shipments";
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $headers = array(
       "Accept: application/json",
       "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE1ZTJiNDlkYTNmOTFhYTFiZDk1NzlkYWMwNjcwOWU3OTliMGQ5NmVkZDY5ZWY3NjU1MDMwZDljZmZjMWU5YTY0NjAzZDkwMWIwNDUwMWI3In0.eyJhdWQiOiI5IiwianRpIjoiMTVlMmI0OWRhM2Y5MWFhMWJkOTU3OWRhYzA2NzA5ZTc5OWIwZDk2ZWRkNjllZjc2NTUwMzBkOWNmZmMxZTlhNjQ2MDNkOTAxYjA0NTAxYjciLCJpYXQiOjE2Mzk5MDA2MzQsIm5iZiI6MTYzOTkwMDYzNCwiZXhwIjo0Nzk1NTc0MjM0LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.Qvl3wjoPkqynUUyXNDJReMuWRV2T6oo8HtT5pqMnVOCl8TVZD6Nxgw20X_Xqnhw_nY4HJlgyaEtuYHJ-rLYgJYCe69KCUxZHDaL_JC_7dRNS9OgTrXbSQS-S2a192u_IQ2r0vqpClpuQEX_3bDjCYIKs4509wnduQxq4ow8RG-NbAsCIAf2iRTcu_ag4OTyIaGXTE_0QdYwKhdKHfcZ8PNN_HBP5x68Dk_YiUVuKCgpqSuovb88tkeooxzolZtZfOUmyAOvqWrITky-lq3DJBv-HRDY4nMlchn9vkpfm8uj5sw7opBmnDCHNZsv4pe95dOaC2KiZJitUBe4a_TiLLK7Y7FA4Jet-JKidoUGg_XONu-dU5ibn6Btl_eYZvYY6njv_EGnO9WcPR66Ke2vHwWHd6wR1m0dRXTn7itnvFgrQuF_ClWxSNzKCdLxv5jI2G3XkIVIXcA3EbCxBmIWeJWeRRVpUsbL46T98BMr9Sla0VLVwYhZO1H9IuSvYPsqpfTtBOs1toCBWY1OajT3qPsOYBQKjN_DTryRxys4D76DW91n-uUs2_vezMRTay9rmqEwsZielzyATnqJvlOuLq2ZOMEfdPHdhC03OvtTp9MOQz5NJjBePEZaMKytewLhOXhOgn2OrhYJnEqdw2BbQHgBKmXGgVlCSLe74W0DUwyY",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    $resp = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($resp);
    $temp = [];
        foreach($array->data as $value)
        {
            if($value->id == $madon)
            {
                $temp[0] = $value->address_to;
                $temp[1] = $value->status_text;
                $temp[2] = $value->carrier_name;
                $temp[3] = $value->expected_delivery_date;
                $temp[4] = $value->created_at;
                break;
            }
        }
        return $temp;
    }
    function getNameAddress($id_xa,$id_huyen,$id_tinh){
        $result = [];
        $url = "http://sandbox.goship.io/api/v2/districts/$id_huyen/wards";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $array = json_decode($resp);

        foreach($array->data as $value)
        {
                if($value->id == $id_xa)
                {
                    array_push($result,$value->name);
                    break;
                }  
        }
        $url = "http://sandbox.goship.io/api/v2/cities/$id_tinh/districts";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $array = json_decode($resp);

        foreach($array->data as $value)
        {
                if($value->id == $id_huyen)
                {
                    array_push($result,$value->name);
                    break;
                }  
        }
        $url = "http://sandbox.goship.io/api/v2/cities";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $array = json_decode($resp);

        foreach($array->data as $value)
        {
                if($value->id == $id_tinh)
                {
                    array_push($result,$value->name);
                    break;
                }  
        }
        
        return $result;
    }
    ?>