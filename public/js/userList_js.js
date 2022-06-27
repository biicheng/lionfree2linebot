
let loadingDom = '<div style="padding-left:50%;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div>';
let loadUI = '<div class="UIDivTitle"><span onclick="UIDivTitleClose()">X</span></div><div class="row justify-content-center uiStyle"><div class="loadingUIText" style="font-size: 3.5vh;color: #9400cb;">請稍後...</div></div>';
function UIDivTitleClose(){
    allWindowDis('none');
}
function allWindowUI(imgUrl,uName){
    allWindowDis('block');
    let ui = '<div class="UIDivTitle"><span onclick="UIDivTitleClose()">X</span></div><div class="row justify-content-center uiStyle"><div class="col-12 UIText"><img class="jsUserImg" src="'+imgUrl+'" title=""></div><div class="col-12 UIText">'+uName+'</div></div>';
    $('.allWindowUI').html(ui);
}
function allWindowDis(sta){
    $(".allWindowUI").css("display",sta);
    if(sta=='none'){ $('.allWindowUI').empty(); }
}

function updateUser(str){
    allWindowDis('block');
    $('.allWindowUI').html(loadUI);
    allWindowDis('none');
    // alert(str)
}
