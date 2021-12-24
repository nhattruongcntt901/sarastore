function chuyentrang(id) {
    document.getElementById('huyen').innerHTML = "";
    document.getElementById('xa').innerHTML = "<option disabled selected>Chọn Xã/Phường</option>";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('huyen').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../vitri/huyen.php?idtinh=' + id, true);
    xhttp.send();
}
function chuyentrang2(id) {
    document.getElementById('xa').innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('xa').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../vitri/xa.php?idhuyen=' + id, true);
    xhttp.send();
}
function chuyentrang3(id) {
    document.getElementById('huyen').innerHTML = "";
    document.getElementById('xa').innerHTML = "<option disabled selected>Chọn Xã/Phường</option>";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('huyen').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../vitri/huyen.php?idtinh=' + id, true);
    xhttp.send();
}
function chuyentrang4(id) {
    document.getElementById('xa').innerHTML = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('xa').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../vitri/xa.php?idhuyen=' + id, true);
    xhttp.send();
}
function open_address_update(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('update_address_data').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../page/nguoimua/chucnang/address_update.php?id_diachi=' + id, true);
    xhttp.send();
}
function open_product_update(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('update_product_data').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../page/nguoiban/chucnang/product_update.php?id_sp=' + id, true);
    xhttp.send();
}