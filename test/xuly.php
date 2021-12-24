
<?php
session_start();
include("../include/chucnang.php");
include("../include/head.php");
// $url = "http://sandbox.goship.io/api/v2/rates";

// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// $headers = array(
//    "Accept: application/json",
//    "Content-Type: application/json",
//    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I",
// );
// curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// $data = <<<DATA
// {
//     "shipment": {
//         "address_from": {
//             "district": "660100",
//             "city": "660000"
//         },
//         "address_to": {
//             "district": "660600",
//             "city": "660000"
//         },
//         "parcel": {
//             "cod": 500000,
//             "weight": "220",
//             "width": "15",
//             "height": "15",
//             "length": "15"
//         }
//     }
// }
// DATA;

// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
// //for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// $resp = curl_exec($curl);
// curl_close($curl);
// $array = json_decode($resp);
// // var_dump($array);
// foreach($array->data as $value)
// {
//         echo "<img style='width:50px;hieght:50px' src='".$value->carrier_logo."'><br>".$value->id."<br>".$value->carrier_name."<br>".$value->expected."<br>".$value->total_amount."<br><br>";
// }
// function test($madon){
//     $url = "http://sandbox.goship.io/api/v2/shipments";

//     $curl = curl_init($url);
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
//     $headers = array(
//        "Accept: application/json",
//        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE1ZTJiNDlkYTNmOTFhYTFiZDk1NzlkYWMwNjcwOWU3OTliMGQ5NmVkZDY5ZWY3NjU1MDMwZDljZmZjMWU5YTY0NjAzZDkwMWIwNDUwMWI3In0.eyJhdWQiOiI5IiwianRpIjoiMTVlMmI0OWRhM2Y5MWFhMWJkOTU3OWRhYzA2NzA5ZTc5OWIwZDk2ZWRkNjllZjc2NTUwMzBkOWNmZmMxZTlhNjQ2MDNkOTAxYjA0NTAxYjciLCJpYXQiOjE2Mzk5MDA2MzQsIm5iZiI6MTYzOTkwMDYzNCwiZXhwIjo0Nzk1NTc0MjM0LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.Qvl3wjoPkqynUUyXNDJReMuWRV2T6oo8HtT5pqMnVOCl8TVZD6Nxgw20X_Xqnhw_nY4HJlgyaEtuYHJ-rLYgJYCe69KCUxZHDaL_JC_7dRNS9OgTrXbSQS-S2a192u_IQ2r0vqpClpuQEX_3bDjCYIKs4509wnduQxq4ow8RG-NbAsCIAf2iRTcu_ag4OTyIaGXTE_0QdYwKhdKHfcZ8PNN_HBP5x68Dk_YiUVuKCgpqSuovb88tkeooxzolZtZfOUmyAOvqWrITky-lq3DJBv-HRDY4nMlchn9vkpfm8uj5sw7opBmnDCHNZsv4pe95dOaC2KiZJitUBe4a_TiLLK7Y7FA4Jet-JKidoUGg_XONu-dU5ibn6Btl_eYZvYY6njv_EGnO9WcPR66Ke2vHwWHd6wR1m0dRXTn7itnvFgrQuF_ClWxSNzKCdLxv5jI2G3XkIVIXcA3EbCxBmIWeJWeRRVpUsbL46T98BMr9Sla0VLVwYhZO1H9IuSvYPsqpfTtBOs1toCBWY1OajT3qPsOYBQKjN_DTryRxys4D76DW91n-uUs2_vezMRTay9rmqEwsZielzyATnqJvlOuLq2ZOMEfdPHdhC03OvtTp9MOQz5NJjBePEZaMKytewLhOXhOgn2OrhYJnEqdw2BbQHgBKmXGgVlCSLe74W0DUwyY",
//     );
//     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//     //for debug only!
//     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
//     $resp = curl_exec($curl);
//     curl_close($curl);
//     $array = json_decode($resp);
//     $temp = [];
//         foreach($array->data as $value)
//         {
//             if($value->id == $madon)
//             {
//                 $temp[0] = $value->address_to;
//                 $temp[1] = $value->status_text;
//                 $temp[2] = $value->carrier_name;
//                 $temp[3] = $value->expected;
//                 $temp[4] = $value->created_at;
//             }
//         }
// return $temp;
// }
// $a = test("GSZ96RBQLB");
// echo $a[3];
// update_table("user","id_loaiuser",2,"id_user",$id_user);
$t = ['trường','nhật'];
foreach($t as $v)
{
    echo "<br>$v";
}
array_unshift($t,"hello");
foreach($t as $v)
{
    echo "<br>$v";
}
?>
