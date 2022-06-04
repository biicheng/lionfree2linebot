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
}
