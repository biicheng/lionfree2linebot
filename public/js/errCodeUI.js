
function loadingUI(sta,uiDom){
    if(sta=='none'){$(".myUI").empty();}
    else{$(".myUI").html(loadingDom+uiDom+divE);}
}


function errCode(type,t){
    let successAlert = '<div class="div-group row alert alert-success" role="alert" id="alert" style="margin:0;"><div class="col-10 text-left" id="alertT">';
    let dangerAlert = '<div class="div-group row alert alert-danger" role="alert" id="alert" style="margin:0;"><div class="col-10 text-left" id="alertT">';
    let lightAlert = '<div class="div-group row alert alert-light" role="alert" id="alert" style="margin:0;"><div class="col-10 text-left" id="alertT">';
    let DomEnd = '</div><div class="col-2 text-right" onclick="errCode(0)"><a>X</a></div></div>';
    if(type=='e'){$(".myAlert").html(dangerAlert+t+DomEnd);}
    else if(type=='s'){$(".myAlert").html(successAlert+t+DomEnd);}
    else if(type=='l'||type==0){$(".myAlert").empty();}
    return 1;
}

function domDis(n,sta){
    $(n).attr("disabled", sta);
}


function closeBox(){
    loadingUI('none','');
}
function bigImg(x){
    x.style.width="42vh";
}

function normalImg(x){
    x.style.width="30vh";
}

