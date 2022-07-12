function editMessageStatus(code, str){
    let url = '/api/messageStatusE';
    let formData = new FormData();
    formData.append('oc', code);
    formData.append('ut', str);
    errCode("l",'');
    cdCss('.statusImgS','display','none');
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
			if(response.result=='s'){ location.reload(); $('.colorLabel').css('color',code==0?'#0F0':'#ffc400'); }
            errCode(response.result,response.errCode+' '+response.resultT);
            cdCss('.statusImgS','display','flex');
		},
		error: function(xhr, ajaxOptions, thrownError){
            let e = errCode("e","伺服器異常...");
            cdCss('.statusImgS','display','flex');
		}
	});
}

