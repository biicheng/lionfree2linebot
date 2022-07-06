function changeStatus(str){
    // loadingUI('flex', loadingUIDom);
    $('#statusImg').attr('disabled', 'disabled');
    console.log(typeof(str))
    // $.ajax({
	// 	type: "POST",
	// 	charset:"utf-8",
	// 	cache:"true",
	// 	dataType: "json",
	// 	async:true,
	// 	url: "api/imgMaps",
    //     data: 1,
    //     processData:false,
    //     contentType:false,
	// 	success: function(response){
    //         loadingUI('none','');
    //         imgFileD = response;
    //         imgFileDom(val);
	// 	},
	// 	error: function(xhr, ajaxOptions, thrownError){
    //         loadingUI('none','');
    //         btnStatus(false);
    //         errCode("e","伺服器異常...");
	// 	}
	// });
}
