function loadingUI(str){
	$("#"+str).empty();
	$("#"+str).append('<div class="container" style="padding-top:10%;padding-bottom:3vh;height:50%;font-size:2vh;"><div class="spinner-border" role="status" style="color:#5a5a5c;width:5vh;height:5vh;"></div><div style="color:#5a5a5c;padding-top:1vh;font-size:2.5vh;">請稍後...</div></div>');
}

function cli(){
    if($("select[id='reType']").val()!='...'&&$("input[id='Utxt']").val()!=''){ this.equ(); }
    else{
        if($("input[id='Utxt']").val()==''){ this.errCode("e","請輸入使用者訊息..."); }
        else if($("select[id='reType']").val()=='...'){this.errCode("e","請選擇回覆內容..."); }
        else{ this.errCode("e","請確認表單..."); }
    }
}

function equ(){
    this.errCode('l','');
    let formData = new FormData();
    formData.append('Utxt', $("input[id='Utxt']").val())
    formData.append('reType', $("select[id='reType']").val())
    formData.append('BotText', $("input[id='BotText']").val())
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
            if(response.result=='s'){ reSetForm(); }
            errCode(response.result,response.errCode+' '+response.resultT);
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