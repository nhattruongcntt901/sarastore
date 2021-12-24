function check_data(){
	var allow_upload = true;
    var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
    var tensp   = document.getElementById('tensp').value;
    var giasp   = document.getElementById('giasp').value;
    var soluong = document.getElementById('soluongsp').value;
    var danhmuc = document.getElementById('danhmuc').value;
    var chieudai= document.getElementById('chieudai').value;
   var chieurong= document.getElementById('chieurong').value;
    var chieucao= document.getElementById('chieucao').value;
	var khoiluong= document.getElementById('khoiluong').value;
	var image = document.getElementById('hinhdaidien');
    var loi = document.getElementsByClassName('error');
    var loi1 = document.getElementsByClassName('error1');

    if(image.files.length == 0)
    {
        loi1[0].innerHTML = "Vui lòng nhập ảnh";
        allow_upload = false;
    }

    var tieuchi = [tensp,giasp,soluong,danhmuc,chieudai,chieurong,chieucao,khoiluong];

    for(var i=0;i<tieuchi.length;i++)
    {

        if(tieuchi[i]=="")
        {
            loi[i].innerHTML = "Không được để trống";
            allow_upload = false;
        }
		else
		{
			loi[i].innerHTML = "";
		}
        if(tieuchi[i].match(format)){
            allow_upload = false;
          }
    }

    if(tensp.length > 100)
    {
        loi[0].innerHTML = "Tên sản phẩm lớn hơn 100 kí tự";
        allow_upload = false;
    }
        
    if(Number.isFinite(giasp)==false && giasp =="") 
    {
        loi[1].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
	else{
		loi[1].innerHTML = "";
	}
       
    if(Number.isFinite(soluong)==false&& soluong=="")
    {
        loi[2].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
	else{
		loi[2].innerHTML = "";
	}
    if(Number.isFinite(danhmuc)==false&& danhmuc=="Chọn Danh Mục")
    {
        loi[3].innerHTML = "Vui lòng chọn danh mục";
        allow_upload = false;
    }
	else{
		loi[3].innerHTML = "";
	}
    if(Number.isFinite(chieudai)==false&& chieudai=="")
    {
        loi[4].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
	else{
		loi[4].innerHTML = "";
	}
    if(Number.isFinite(chieurong)==false&& chieurong=="")
    {
        loi[5].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
	else{
		loi[5].innerHTML = "";
	}
    if(Number.isFinite(chieucao)==false&& chieucao=="")
    {
        loi[6].innerHTML = "Vui lòng nhập số";
        allow_upload = false;
    }
	else{
		loi[6].innerHTML = "";
	}
	
	
	if(allow_upload == true)
	{
		return true;
	}
	else
		return false;
}
// function product_add(){
//     var data = new FormData();
//     data.append("tensp", document.getElementById("tensp").value);
//     data.append("giasp", document.getElementById("giasp").value);
//     data.append("soluongsp", document.getElementById("soluongsp").value);
//     data.append("danhmuc", document.getElementById("danhmuc").value);
//     data.append("chieudai", document.getElementById("chieudai").value);
//     data.append("chieurong", document.getElementById("chieurong").value);
//     data.append("chieucao", document.getElementById("chieucao").value);
// 	data.append("mota", document.getElementById("mota").value);

// }
var hinh=[];
var stt=0;
$(document).ready(function(){

	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#hinhdaidien').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:273,
			height:200
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				hinh[stt] = base64data;
				stt++;
				anh_preview();
				$modal.modal('hide');
			};
		});
	});
	$('#submit').click(function(){
		if(check_data()==true)
		{
			var tensp   = document.getElementById('tensp').value;
			var giasp   = document.getElementById('giasp').value;
			var soluong = document.getElementById('soluongsp').value;
			var danhmuc = document.getElementById('danhmuc').value;
			var chieudai= document.getElementById('chieudai').value;
		   var chieurong= document.getElementById('chieurong').value;
			var chieucao= document.getElementById('chieucao').value;
			var mota= document.getElementById('mota').value;
			$.ajax({
				url:'product-add',
				method:'POST',
				data:{image:hinh,tensp:tensp,giasp:giasp,soluongsp:soluong,danhmuc:danhmuc,chieudai:chieudai,chieurong:chieurong,chieucao:chieucao,mota:mota},
				success:function(data)
				{
					document.getElementById('preview-img').src = "../../img/sanpham/img-default.png";
					document.getElementById('themsp').reset();
					document.getElementById('thongbao_success').innerHTML = "<div class='font-shopee2021-regular' style='background-color:#04522b;width:auto;display:flex;align-items:center;gap:10px;padding:10px 20px;border-radius:5px'><span class='material-icons font-white'>check_circle</span><span style='color:white'>Thêm sản phẩm thành công</span></div><hr width='95%'>";
					var reset_error = document.getElementsByClassName('error');
					for(var i=0;i<reset_error.length;i++)
					{
						reset_error[i].innerHTML = "";
					}
					hinh = [];
					stt = 0;
					document.getElementById('chuahinh').innerHTML = "<img id='preview-img' src='../../img/sanpham/img-default.png' style='width:75px;height:75px'>";
				}
			});
		}		
	});
	
});