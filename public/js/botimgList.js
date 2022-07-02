let imgFileD=null;
// JSON.parse('{"bimg":[{"imgNum":1,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"ba-chi-niB.jpg"},{"imgNum":2,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Come-clapB.jpg"},{"imgNum":3,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Computer-analysisB.jpg"},{"imgNum":4,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Crying-dad-sleepyB.jpg"},{"imgNum":5,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"How_About_The_TroopsB.jpg"},{"imgNum":7,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"KingZhonghuang-HahahaB.jpg"},{"imgNum":8,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Mao-Bo-is-dry-and-stable-HeyB.jpg"},{"imgNum":9,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"NewCrownSpecialMedicineB.jpg"},{"imgNum":10,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"pig_bitchB.jpg"},{"imgNum":11,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"SimpleEpidemicPreventionB.jpg"},{"imgNum":12,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"SmokingRulesB.jpg"},{"imgNum":13,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Soldiers_cant_tell_theTruthB.jpg"},{"imgNum":14,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_Mask-shut-upB.jpg"},{"imgNum":15,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_scared-sillyB.jpg"},{"imgNum":16,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_soEasyB.jpg"},{"imgNum":17,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_so-funnyB.jpg"},{"imgNum":18,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_What-do-you-want-thatB.jpg"},{"imgNum":19,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"xu_I-knew-it-was-youB.jpg"},{"imgNum":20,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"you-say-chineseB.jpg"},{"imgNum":43,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallB.jpg"},{"imgNum":44,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallB.jpg"},{"imgNum":46,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallB.jpg"},{"imgNum":47,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallB.jpg"},{"imgNum":21,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallB.jpg"}],"simg":[{"imgNum":22,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"ba-chi-niS.jpg"},{"imgNum":23,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Come-clapS.jpg"},{"imgNum":24,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Computer-analysisS.jpg"},{"imgNum":25,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Crying-dad-sleepyS.jpg"},{"imgNum":26,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"How_About_The_TroopsS.jpg"},{"imgNum":27,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"I-want-it-allS.jpg"},{"imgNum":28,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"KingZhonghuang-HahahaS.jpg"},{"imgNum":29,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Mao-Bo-is-dry-and-stable-HeyS.jpg"},{"imgNum":30,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"NewCrownSpecialMedicineS.jpg"},{"imgNum":31,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"pig_bitchS.jpg"},{"imgNum":32,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"SimpleEpidemicPreventionS.jpg"},{"imgNum":33,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"SmokingRulesS.jpg"},{"imgNum":34,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"Soldiers_cant_tell_theTruthS.jpg"},{"imgNum":35,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_Mask-shut-upS.jpg"},{"imgNum":36,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_scared-sillyS.jpg"},{"imgNum":37,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_soEasyS.jpg"},{"imgNum":38,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_so-funnyS.jpg"},{"imgNum":39,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"wang_What-do-you-want-thatS.jpg"},{"imgNum":40,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"xu_I-knew-it-was-youS.jpg"},{"imgNum":41,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"you-say-chineseS.jpg"},{"imgNum":42,"url":"https:\/\/mytpl6.herokuapp.com\/img\/linebot_img\/","imgName":"You-are-talking-about-three-smallS.jpg"}]}');
let imgSameType=null;
let imgType = null;
let loadingDom = '<div class="loadingUI">';//
let loadingUIDom = '<div style="padding-left:45%;padding-top:40vh;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div>';
let divE = '</divE';
function loadingUI(sta,uiDom){
    // $(".loadingUI").css("display","none");
    if(sta=='none'){$(".myUI").empty();}
    else{/*$(".loadingUI").css("display",sta);*/$(".myUI").html(loadingDom+uiDom+divE);}
}

function cli(){
    loadingUI('flex', loadingUIDom);
    if($("select[id='imgType']").val()!='...'&&$("select[id='imgType']").val()!=''&&$("input[id='iUrl']").val()!=''&&$("input[id='imgName']").val()!=''){ 
        // this.equ(); 
        this.errCode('l','');
        let formData = new FormData();
        formData.append('iUrl', $("input[id='iUrl']").val());
        formData.append('imgname', $("input[id='imgName']").val());
        formData.append('imgDir', $("input[id='iDir']").val());
        formData.append('imgType', $("select[id='imgType']").val());
        requestAPI(formData, "api/creatImgAPI");
    }
    else{
        loadingUI('none','');
        if($("input[id='iUrl']").val()==''){ this.errCode("e","請輸入圖片位置..."); }
        else if($("input[id='imgName']").val()=='...'){this.errCode("e","請輸入圖片名稱..."); }
        else{ this.errCode("e","請確認表單..."); }
    }
}
function requestAPI(formData, url){
    errCode("l",'')
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
    let successAlert = '<div class="div-group row alert alert-success" role="alert" id="alert" style="margin:0;"><label class="col-form-label text-md-left" style="width:95%;" id="alertT">';
    let dangerAlert = '<div class="div-group row alert alert-danger" role="alert" id="alert" style="margin:0;"><label class="col-form-label text-md-left" style="width:95%;" id="alertT">';
    let lightAlert = '<div class="div-group row alert alert-light" role="alert" id="alert" style="margin:0;"><label class="col-form-label text-md-left" style="width:95%;" id="alertT">';
    let DomEnd = '</label><label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label></div>';
    if(type=='e'){$(".myAlert").html(dangerAlert+t+DomEnd);}
    else if(type=='s'){$(".myAlert").html(successAlert+t+DomEnd);}
    else if(type=='l'){$(".myAlert").empty();}
    return 1;
}
function reSetForm(){
    $("#imgName").val("");
    // $("#iUrl").val("");
    // $("#iDir").val("");
    // $("#imgType").val(0);
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
    if(imgFileD==null){errCode("l",'');imgdataGet(i);}
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
    let rowDom = '<div class="row justify-content-center align-items-center" style="width:100%;height:10%;">';
    let colDom = '<div class="col imgTitleStyle">';
    let divD = '</div>';
    d = Type==1?imgFileD.bimg:imgFileD.simg;

    imgFileDoms += '<div class="row" style="width:100%;"><div class="row justify-content-center align-items-center" style="width:100%;height:10%;"><div class="col-3 imgTitleStyle"></div><div class="col-6  imgTitleStyle imgTitleStyleC">'+imgFileTitleStr+'</div><div class="col-3 imgTitleStyle imgTitleStyleR"><span onclick="closeBox()">X</span></div>';
    imgFileDoms += '<div class="col-12" style="padding-bottom:5vh;">';
    d.forEach(function callback(value, index) {
        i++;
        if(i==1){imgFileDoms+=rowDom;}
        imgFileDoms += colDom+'<img src="'+value.url+value.imgName+'" class="botImgtyle '+value.imgName+' rounded mx-auto d-block botimgF" onmouseover="bigImg(this)" onmouseout="normalImg(this)" onclick=setImg("'+value.imgName+'","'+Type+'") />'+divD;
        if(i==3){ i=0;imgFileDoms+=divD;}
    });
    if(i==1){imgFileDoms+=colDom+divD+colDom+divD+divD;}
    if(i==2){imgFileDoms+=colDom+divD+divD;}
    imgFileDoms += divD+divD+divD;
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
    loadingUI('flex', loadingUIDom);
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
