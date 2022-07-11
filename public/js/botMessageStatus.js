function editMessageStatus(code, str){
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
		url: 'api/messageStatusE',
        data: formData,
        processData:false,
        contentType:false,
		success: function(response){
            errCode(response.result,response.errCode+' '+response.resultT);
			if(response.result=='s'){ location.reload(); }
            cdCss('.statusImgS','display','flex');
		},
		error: function(xhr, ajaxOptions, thrownError){
            let e = errCode("e","伺服器異常...");
            cdCss('.statusImgS','display','flex');
		}
	});
}

