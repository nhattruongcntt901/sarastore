function tinh_gia_ship(cod,chieudai,chieurong,chieucao,cannang,dis_from,city_from,dis_to,city_to){
    var url = "http://sandbox.goship.io/api/v2/rates";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJhNjc2YjgxZTFhMjgwNDY3ZDg3ZDYxNjBkMDExODA5OTk2NmEwZWZkZTI2NjFkMDJmYjFmNzU2ZmFlNjJiZWNiMTBmOTllMTI5NmY2ZjQ5In0.eyJhdWQiOiI5IiwianRpIjoiMmE2NzZiODFlMWEyODA0NjdkODdkNjE2MGQwMTE4MDk5OTY2YTBlZmRlMjY2MWQwMmZiMWY3NTZmYWU2MmJlY2IxMGY5OWUxMjk2ZjZmNDkiLCJpYXQiOjE2Mzk3OTg3NDQsIm5iZiI6MTYzOTc5ODc0NCwiZXhwIjo0Nzk1NDcyMzQ0LCJzdWIiOiIzMDc0Iiwic2NvcGVzIjpbXX0.abbav6gM6tqAaVz6vZkxb_YmCg9bssScqsQPqqMPnc340RMaUZ1-3o51uOegsfHFrMM7DXRIB5t0P24q-htsZbAUwPShYbYn-_oNfQ1r9HirFZmQWg9WaVf6jQY1e1wfBEJdfqrAxdiFKrFbSLlPEJU84Q7iJHjfguxjWqILiMvkR-qIqtSWcy5w1_GRGzTBhZQxWb8kZ0U7P34upOCJfWw_wsbv688cLV3E_srEohTR3JE6sasJG7NQqFB5O-wZeBmosKC1Ob-tf4ZTwgoNHPZMcVIeZ7GFKrehUpChTKhQIxWu1ZRcuBJB8HiatFlMVWwncQrpAHpSAO69sL7IyQ6e0WkcqcsylhETYA_VIF53rLuJAMJpdGA45_ZUQpdHE2lRp0tNHl8R_kk0GatHMbIf4Fog7KX5Es4ws7QvhMrNYt8G49xiuTKnN_E5QjGPVClsigRRyBA0pAIDyQiLAXMc36hPslOqrOL3tNpi_v7EKOZvlu8_ev6STrIOU0_cwEolDRz0e_RJI_FHl6sc_BfIiHpJAh1YM2lKPbMtNoLURx7gzBbSlByXCY06zmqFCvRLa7g3qHOtcUnqKJVs8oDGE5L7GzRuMW8JhMugXgoKZSvImIbh5CMEro9A1vBZ3ggpaQT-z2GdLBkFG57SZF-sAATubLRsoNmV0U_v6i4");
    
    xhr.onreadystatechange = function () {
       if (xhr.readyState === 4) {
          console.log(xhr.status);
          console.log(xhr.responseText);
       }};
    var temp ={
        "shipment": {
            "address_from": {
                "district": dis_from,
                "city": city_from
            },
            "address_to": {
                "district": dis_to,
                "city": city_to
            },
            "parcel": {
                "cod": cod,
                "width":  chieurong,
                "height": chieucao,
                "length": chieudai,
                "weight": cannang
            }
        }
    };
    console.log(temp);
    var data = "`"+temp+"`";
    
    xhr.send(data);
}