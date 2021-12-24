var allow_upload = true;
function check_data(){
    var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
    var tensp   = document.getElementById('tensp').value;
    var giasp   = document.getElementById('giasp').value;
    var soluong = document.getElementById('soluongsp').value;
    var danhmuc = document.getElementById('danhmuc').value;
    var chieudai= document.getElementById('chieudai').value;
   var chieurong= document.getElementById('chieurong').value;
    var chieucao= document.getElementById('chieucao').value;
    var loi = document.getElementsByClassName('error');
    var image = document.getElementById('hinhdaidien');

    if(image.files.length == 0)
    {
        loi[7].innerHTML = "Vui lòng nhập ảnh";
        allow_upload = false;
    }

    var tieuchi = [tensp,giasp,soluong,danhmuc,chieudai,chieurong,chieucao];

    for(var i=0;i<tieuchi.length;i++)
    {
        if(tieuchi[i]=="")
        {
            loi[i].innerHTML = "Không được để trống";
            allow_upload = false;
        }
        if(tieuchi[i].match(format)){
            allow_upload = false;
          }
    }

    if(tensp.length > 50)
    {
        loi[0].innerHTML = "Tên sản phẩm lớn hơn 50 kí tự";
        allow_upload = false;
    }
        
    if(Number.isFinite(giasp)==false&& giasp!="") 
    {
        loi[1].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
       
    if(Number.isFinite(soluong)==false&& soluong!="")
    {
        loi[2].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
    if(Number.isFinite(danhmuc)==false&& danhmuc!="")
    {
        loi[3].innerHTML = "Vui lòng chọn danh mục";
        allow_upload = false;
    }
    if(Number.isFinite(chieudai)==false&& chieudai!="")
    {
        loi[4].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
    if(Number.isFinite(chieurong)==false&& chieurong!="")
    {
        loi[5].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
    if(Number.isFinite(chieucao)==false&& chieucao!="")
    {
        loi[6].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }     
}
function product_add(){
    var data = new FormData();
    data.append("tensp", document.getElementById("tensp").value);
    data.append("giasp", document.getElementById("giasp").value);
    data.append("soluongsp", document.getElementById("soluongsp").value);
    data.append("danhmuc", document.getElementById("danhmuc").value);
    data.append("chieudai", document.getElementById("chieudai").value);
    data.append("chieurong", document.getElementById("chieurong").value);
    data.append("chieucao", document.getElementById("chieucao").value);
    data.append("mota", document.getElementById("mota").value);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "product-add");
    xhr.onload = function () {
        console.log(this.response);
    };
    xhr.send(data);
    return false;
}