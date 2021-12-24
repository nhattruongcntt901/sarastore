async function add_cart(id){

        

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('thongbao_cart').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', 'https://localhost/page/giohang/chucnang/add_giohang.php?id_sp='+id, true);
    xhttp.send();
    await sleep(2000);
    document.getElementById('animate').classList.remove('animate__bounceInDown');
    document.getElementById('animate').classList.add('animate__bounceOutDown');
    await sleep(1000);
    document.getElementById('thongbao_cart').innerHTML = "";

    
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
    }
var a_chat = true;
function chat_on(){
    var chat = document.getElementsByClassName('chat');
    var chat_btn = document.getElementById('close_btn');
    if(a_chat == true)
    {
        chat_btn.innerHTML = "expand_less";
        chat[0].classList.add('chat-off');
        chat[0].classList.remove('chat-on');
        a_chat = false;
    }
    else
    {
        chat_btn.innerHTML = "close";
        chat[0].classList.add('chat-on');
        chat[0].classList.remove('chat-off');
        a_chat = true;
    }
    
}
