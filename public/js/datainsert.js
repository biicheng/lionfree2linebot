let imgFileD=null;
let imgSameType=null;
let imgType = null;
let loadingDom = '<div style="padding-left:50%;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div>';
function loadingUI(sta,uiDom){
    $(".loadingUI").css("display","none");
    if(sta=='none'){$(".loadingUI").empty();}
    else{$(".loadingUI").css("display",sta);$(".loadingUI").html('<div class="loadingUIDiv">'+uiDom+'</div>');}
}

function cli(){
    loadingUI('flex', loadingDom);
    if($("select[id='reType']").val()!='...'&&$("input[id='Utxt']").val()!=''){ this.equ(); }
    else{
        loadingUI('none','');
        if($("input[id='Utxt']").val()==''){ this.errCode("e","請輸入使用者訊息..."); }
        else if($("select[id='reType']").val()=='...'){this.errCode("e","請選擇回覆內容..."); }
        else{ this.errCode("e","請確認表單..."); }
    }
}

function equ(){
    this.errCode('l','');
    let formData = new FormData();
    let reType = $("select[id='reType']").val();
    formData.append('reType', reType);
    formData.append('Utxt', $("input[id='Utxt']").val());
    formData.append('reType', reType);
    if(reType=="img"){
        formData.append('imgType', imgType);
        formData.append('imgSameType', imgSameType);
        if(imgType==1){
            formData.append('bImg', $('#bImg')[0].files[0]);
            formData.append('sImg', $('#sImg')[0].files[0]);
        }
        if(imgType==2){
            formData.append('bImg', $('#bImg').val());
            formData.append('sImg',$('#sImg').val());
        }
        requestAPI(formData, "api/insertAPI");
    }
    if(reType=="text"){
        formData.append('BotText', $("input[id='BotText']").val());
        requestAPI(formData, "api/insertAPI");
    }
}
function requestAPI(formData, url){
    $.ajax({
		type: "POST",
		charset:"utf-8",
		cache:"true",
		dataType: "json",
		async:true,
		url: url,
        data: formData,
        processData:false,
        contentType:false,
		success: function(response){
                loadingUI('none','');
                if(response.result=='s'){ 
                    reSetForm();
                    removeDom('.botReText');
                    removeDom("#imgD");
                }
                let e = errCode(response.result,response.errCode+' '+response.resultT);
		},
		error: function(xhr, ajaxOptions, thrownError){
            loadingUI('none','');
            let e = errCode("e","伺服器異常...");
		}
	});
}

function errCode(type,t){
    if(type=='e'){
        this.reAlertLight();
        this.reAlertSuccess();
        this.alertDanger();
        this.addCss('flex');
    }
    else if(type=='s'){
        this.reAlertLight();
        this.reAlertDanger();
        this.alertSuccess();
        this.addCss('flex');
    }
    else if(type=='l'){
        this.reAlertDanger();
        this.reAlertSuccess();
        this.alertLight();
        this.addCss('none');
    }
    $('[id$=alertT]').text(t);
    return 1;
}
function alertText(t){
    $("#alert").removeClass("alert alert-light");
}
function reAlertLight(){
    $("#alert").removeClass("alert alert-light");
}
function reAlertDanger(){
    $("#alert").removeClass("alert alert-danger");
}
function reAlertSuccess(){
    $("#alert").removeClass("alert alert-success");
}
function alertLight(){
    $("#alert").addClass("alert alert-light");
}
function alertDanger(){
    $("#alert").addClass("alert alert-danger");
}
function alertSuccess(){
    $("#alert").addClass("alert alert-success");
}
function addCss(t){
    if(t=="flex"){$("#alert").css("display","flex");}
    if(t=="none"){$("#alert").css("display","none");}
    return 1;
}
function reSetForm(){
    $("#Utxt").val("");
    $("#BotText").val("");
    $("#reType").val(0);
    $("#bImg").val("");
    $("#sImg").val("");
}
function btnStatus(sta){
    $(".btn").attr("disabled", sta);
}

function uType(type){
    removeDom('.botReText');
    removeDom('.imgD');
    if(type=='img'){
        $(".botReText").html('<div class="col-md-6"><fieldset id="imgType"><div class="form-check"><input class="form-check-input" type="radio" name="imgType" id="flexRadioDefault1" value="update" onclick="updaType(1)" disabled>上傳圖片<label class="form-check-label" for="flexRadioDefault1"></label></div><div class="form-check"><input class="form-check-input" type="radio" name="imgType" id="flexRadioDefault2" value="use" onclick="updaType(2)">使用圖片<label class="form-check-label" for="flexRadioDefault2"></label></div></fieldset></div>');
    }
    if(type=='text'){
        $(".botReText").html('<label for="Utxt" class="col-md-12 col-form-label text-md-left">Bot回覆訊息</label><div class="col-md-6"><input id="BotText" type="text" class="form-control" name="BotText" value=""></div>');
    }
}
function removeDom(DName){
    $(DName).empty();
}
function appendDom(DName,val){
    $(DName).append(val);
}
function editVal(name,val){
    $(name).val(val);
}
function updaType(val){
    imgType = val;
    removeDom(".imgD");
    if(val==1){
        $(".imgD").html('<div class="mb-3 uplo"><label for="formFile" class="form-label">Bot回覆大圖</label><input class="form-control" type="file" id="bImg" name="bImg" accept=".png, .jpg, .jpeg" style="width:90%;"></div><div class="mb-3 uplo"><label for="formFile" class="form-label">Bot回覆小圖</label><input class="form-control" type="file" id="sImg" name="sImg" accept=".png, .jpg, .jpeg" style="width:90%;"></div>');
    }
    if(val==2){
        $(".imgD").html('<fieldset id="same">圖片內容<div class="form-check"><input class="form-check-input" type="radio" name="same" id="flexRadioDefault1" value="usame" onclick="imgSame(1)">不同圖片<label class="form-check-label" for="flexRadioDefault1"></label></div><div class="form-check"><input class="form-check-input" type="radio" name="same" id="flexRadioDefault2" value="same" onclick="imgSame(2)">相同圖片<label class="form-check-label" for="flexRadioDefault2"></label></div></fieldset><div class="mb-3" style="margin-top:2.5vh;"><button type="button" class="btn btn-primary btn" id="bImgBtn" onclick="imgFile(1)" disabled="disabled">選擇大圖</button><label class="form-label bImg" id="bImg" value="">Bot回覆大圖</label></div><div class="mb-3" style="margin-top:2.5vh;"><button type="button" class="btn btn-primary btn" id="sImgBtn" onclick="imgFile(2)" disabled="disabled">選擇小圖</button><label class="form-label sImg" id="sImg" value="">Bot回覆小圖</label></div>');
    }
}
function imgSame(i){
    imgSameType = i;
    if(i==1){
        removeDisa("#bImgBtn");
        removeDisa("#sImgBtn");
    }
    if(i==2){
        removeDisa("#bImgBtn");
        attrDisa("#sImgBtn");
    }
}
function removeDisa(className){
    $(className).removeAttr("disabled");
}
function attrDisa(className){
    $(className).attr("disabled","disabled");
}
function imgFile(i){
    if(imgFileD==null){imgdataGet(i);}
    if(imgFileD!=null){imgFileDom(i);}
}
function imgFileDom(Type){
    let imgFileDoms = '';
    let i = 0;
    /*
    水平    justify-content-center  
    垂直    align-items-center
    */
   let imgFileTitleStr = imgSameType==2?"請選擇圖片":Type=='bimg'?"請選擇大圖":"請選擇小圖";
    let rowDom = '<div class="row row-cols-sm-3 justify-content-center">';
    let colDom = '<div class="col colStyle">';
    let divD = '</div>';
    d = Type==1?imgFileD.bimg:imgFileD.simg;
    imgFileDoms += '<div class="container">';
    imgFileDoms +=rowDom+'<div class="col-3 imgTitleStyle"></div><div class="col-6 justify-content-center align-items-center imgTitleStyle imgTitleStyleC">'+imgFileTitleStr+'</div><div class="col-3 justify-content-end imgTitleStyle imgTitleStyleR"><span onclick="closeBox()">X</span></div>'+divD;
    imgFileDoms += '<div class="container imgFileDiv">';
    d.forEach(function callback(value, index) {
        i++;
        if(i==1){imgFileDoms+=rowDom;}
        imgFileDoms += colDom+'<img src="'+value.url+value.imgName+'" class="botImgtyle '+value.imgName+' rounded mx-auto d-block botimgF" onmouseover="bigImg(this)" onmouseout="normalImg(this)" onclick=setImg("'+value.imgName+'","'+Type+'") />'+divD;
        if(i==3){ i=0;imgFileDoms+=divD;}
    });
    if(i==1){imgFileDoms+=colDom+divD+colDom+divD+divD;}
    if(i==2){imgFileDoms+=colDom+divD+divD;}
    imgFileDoms += divD+divD;
    i = 0;
    loadingUI('flex',imgFileDoms);
}
function setImg(val, Type){
    if(imgSameType==1){
        if(Type==2){
            removeDom('#sImg');
            appendDom('#sImg',val);
            editVal('#sImg',val);
        }
        if(Type==1){
            removeDom('#bImg');
            appendDom('#bImg',val);
            editVal('#bImg',val);
        }
    }
    if(imgSameType==2){
        removeDom('#bImg');
        appendDom('#bImg',val);
        editVal('#bImg',val);
        removeDom('#sImg');
        appendDom('#sImg',val);
        editVal('#sImg',val);
    }
    closeBox();
}
function imgdataGet(val){
    loadingUI('flex', loadingDom);
    $.ajax({
		type: "POST",
		charset:"utf-8",
		cache:"true",
		dataType: "json",
		async:true,
		url: "api/imgMaps",
        data: 1,
        processData:false,
        contentType:false,
		success: function(response){
            loadingUI('none','');
            imgFileD = response;
            imgFileDom(val);
		},
		error: function(xhr, ajaxOptions, thrownError){
            loadingUI('none','');
            btnStatus(false);
            errCode("e","伺服器異常...");
		}
	});
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
