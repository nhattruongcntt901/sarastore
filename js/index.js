var timeleft = document.getElementById('time_left');
async function time_left_email(year,month,day,hours,minute,seconds){
    while(true)
    {

        var actualTime = new Date(Date.now());

        var endOfDay = new Date(year,month,day,hours,minute,seconds);
        var timeRemaining = endOfDay.getTime() - actualTime.getTime();
        var second = Math.floor(timeRemaining/1000);
        var min = Math.floor(second/60);
        if(min<10)
            min = "0"+min;
        var sec = second - min*60;
        if(sec<10)
            sec = "0"+sec;
        if((min<=0&&sec<=0)||second<=0)
            {
                timeleft.innerHTML = "Hết thời gian, Vui lòng đăng ký lại email!"
                break;
            }
        timeleft.innerHTML = min +":"+ sec;
        await sleep(1000);
    }
}
function sleep(ms) {
return new Promise(resolve => setTimeout(resolve, ms));
}

function open_dialog(id_dialog){
    var dialog = document.getElementById(id_dialog);
    dialog.open = true;
}
function close_dialog(id_dialog){
    var dialog = document.getElementById(id_dialog);
    dialog.open = false;
}
function open_product_update(id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('update_product_data').innerHTML =
                this.responseText;
        }
    };
    xhttp.open('GET', '../../page/nguoiban/chucnang/product_update.php?id_sanpham=' + id, true);
    xhttp.send();
}