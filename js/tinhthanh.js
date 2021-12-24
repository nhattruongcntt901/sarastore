var url = "http://sandbox.goship.io/api/v2/cities";

var xhr = new XMLHttpRequest();
xhr.open("GET", url);

xhr.setRequestHeader("Accept", "application/json");
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I");

xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
      console.log(xhr.status);
      var  array = xhr.responseText;
      const a = JSON.parse(array);
      var tinh = document.getElementById('tinh');
      a['data'].forEach(element => {
          var option = document.createElement('option');
          option.innerHTML  = element['name'];
          option.value      = element['id'];
          tinh.appendChild(option);
      });
   }};

xhr.send();
function province_update(){
   var url = "http://sandbox.goship.io/api/v2/cities";

var xhr = new XMLHttpRequest();
xhr.open("GET", url);

xhr.setRequestHeader("Accept", "application/json");
xhr.setRequestHeader("Content-Type", "application/json");
xhr.setRequestHeader("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I");

xhr.onreadystatechange = function () {
   if (xhr.readyState === 4) {
      console.log(xhr.status);
      var  array = xhr.responseText;
      const a = JSON.parse(array);
      var tinh = document.getElementById('tinh1');
      a['data'].forEach(element => {
          var option = document.createElement('option');
          option.innerHTML  = element['name'];
          option.value      = element['id'];
          tinh.appendChild(option);
      });
   }};

xhr.send();
}
function after_choose_province(id){
    var url = "http://sandbox.goship.io/api/v2/cities/"+id+"/districts";

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I");
    
    xhr.onreadystatechange = function () {
       if (xhr.readyState === 4) {
          console.log(xhr.status);
          var  array = xhr.responseText;
          const a = JSON.parse(array);
          var huyen = document.getElementById('huyen');
          var xa = document.getElementById('xa');
          xa.innerHTML = "<option disabled selected>Chọn Xã/Phường</option>";
          huyen.innerHTML = "<option disabled selected>Chọn Huyện/Thành Phố</option>";
          a['data'].forEach(element => {
              var option = document.createElement('option');
              option.innerHTML  = element['name'];
              option.value      = element['id'];
              huyen.appendChild(option);
          });
       }};
    
    xhr.send();
}
function after_choose_district(id){
    var url = "http://sandbox.goship.io/api/v2/districts/"+id+"/wards";

    var xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJiNTY0YTFhZjU1Yjg3ODkzZDk1ZDc5MmIxNjcyNzMyNmY5NWJlZTk0ZjYxNjBiNDkxZDViY2YyMzYxMGViYjgzOTg5MDM5MDExNjFjMDJiIn0.eyJhdWQiOiI5IiwianRpIjoiYmI1NjRhMWFmNTViODc4OTNkOTVkNzkyYjE2NzI3MzI2Zjk1YmVlOTRmNjE2MGI0OTFkNWJjZjIzNjEwZWJiODM5ODkwMzkwMTE2MWMwMmIiLCJpYXQiOjE2Mzk3MzE5NDksIm5iZiI6MTYzOTczMTk0OSwiZXhwIjo0Nzk1NDA1NTQ5LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.WlQsbgAcZxvMjyq9bAx_9U5KyXsjxWer9KmlJJPV8bHa9gnQq41oj-qqm9JUyZO6xqzo48RI7aZ5g6AFasG_BSuKCqoyPLXjWViFBZLaT85UW_jU54eBV5pPpxUiqWxswpF5wASPV6bJllOS_3-is4L6C0Onw6t-_QMSZMRUdtk7PsKbUw5XgWAe9AKG0QLxyZmrPnd3sb4KwmYd68iXe51fc6Q74LH75erWg8OCvfAwDsNMjHww0cUY9sNxvKBnkj2cv7DXUni6Em1cd2SXNtyEGwCyRtl3eE9Pfgsy6IA1veBWFeaogsCpj-UKORKY6MLpiaW4G_zPg3bD2kAwmZkigmrEjuyQDaOh015eUtFKbJXl2_a--Z6G2xIcdwxdbQsNFKkUVCm_Ftfsl86J0eEl1uHCXeugDfoKikEkweKh2AktltHlGWQ0FLoZfW1-WoUfvGp3qu7CVnL5GgZSay-3T3SnhvWgxnIX4LViJsU360fLbEtPpVnfJZD9TibsrQoVdra8ytZZcDquNF9wsFG3n-V_U17FU8i5iVC0SOJF1--Mn9bdNl2Zcjd0t30E0zgKiOygIUGgu930IWLAFt2il1AiG4R_tsmCRVW-9lE204JyNIs9WfwLDzpPZZbcXVsXTNIVtDtpxUdG7V2jteWVEiA4OdVS4Opj7lmWo6I");
    
    xhr.onreadystatechange = function () {
       if (xhr.readyState === 4) {
          console.log(xhr.status);
          var  array = xhr.responseText;
          const a = JSON.parse(array);
          var xa = document.getElementById('xa');
          xa.innerHTML = "<option disabled selected>Chọn Xã/Phường</option>";
          a['data'].forEach(element => {
              var option = document.createElement('option');
              option.innerHTML  = element['name'];
              option.value      = element['id'];
              xa.appendChild(option);
          });
       }};
    
    xhr.send();
}