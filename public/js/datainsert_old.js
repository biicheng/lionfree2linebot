function loadingUI(str){
	$("#"+str).empty();
	$("#"+str).append('<div class="container" style="padding-top:10%;padding-bottom:3vh;height:50%;font-size:2vh;"><div class="spinner-border" role="status" style="color:#5a5a5c;width:5vh;height:5vh;"></div><div style="color:#5a5a5c;padding-top:1vh;font-size:2.5vh;">請稍後...</div></div>');
}

function cli(){
    let Utxt = $("input[id='Utxt']").val();
    let reType = $("select[id='reType']").val();
    let BotText = $("input[id='BotText']").val();
    let bImg = $("input[id='bImg']").val();
    let sImg = $("input[id='sImg']").val();
    if(reType!='...'&&Utxt!=''){
        this.checkF(Utxt,reType,BotText,bImg,sImg);
    }
    else{
        this.errCode("e","請再確認表單內容...");
    }
}
function checkF(Utxt,reType,BotText,bImg,sImg){
    if(reType=="text"&&BotText!=''){
        this.equ(Utxt,reType,BotText,bImg,sImg);
    }
    else if(reType=="img"&&bImg!=''&&sImg!=''){
        this.equ(Utxt,reType,BotText,bImg,sImg);
    }
    else{
        this.errCode("e","請再確認表單內容...");
    }
}

function equ(Utxt,reType,BotText,bImg,sImg){
    this.errCode('l','');
    let formData = new FormData(document.getElementById('form'));
    formData.append('Utxt', Utxt)
    formData.append('reType', reType)
    formData.append('BotText', BotText)
    formData.append('bImg', $('#bImg')[0].files[0])
    formData.append('sImg', $('#sImg')[0].files[0])
    $.ajax({
		type: "POST",
		charset:"utf-8",
		cache:"true",
		dataType: "json",
		async:true,
		url: "api/insertAPI",
        data: formData,//data,//
        processData:false,
        contentType:false,
		success: function(response){
            errCode(response.result,response.resultT);
		},
		error: function(xhr, ajaxOptions, thrownError){
            errCode("e","伺服器異常...");
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
}
function succCode(){
    $e = this.addCss('flex');
    $("#alert").removeClass("alert alert-light");
    $("#alert").removeClass("alert alert-danger");
    $("#alert").addClass("alert alert-success");
    $('[id$=alertT]').text('新增成功');
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
    // $("#alert").removeClass("display",t=="flex"?t:"none");
    if(t=="flex"){$("#alert").css("display","flex");}
    if(t=="none"){$("#alert").css("display","none");}
    // $("#alert").css("display",t=="flex"?t:"none");
    return 1;
}