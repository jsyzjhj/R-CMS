

$('#button-add').click(function() {
	/* Act on the event */
	var url = SCOPE.add_url;
	window.location.href = url;
});

$('#singcms-button-submit').click(function() {
	/* Act on the event */
	var data = $('#singcms-form').serializeArray();
	postData = {};
	$(data).each(function(i) {
		postData[this.name] = this.value;
	});
	var jump_url = SCOPE.jump_url;
	var url = SCOPE.save_url;
	$.post(url,postData, function(result) {
		/*optional stuff to do after success */
		if(result.status == 0){
			return dialog.error(result.message);
		}
		if(result.status == 1){
			return dialog.success(result.message,jump_url);
		}
	},'JSON');
});

//修改操作
$('.singcms-table #singcms-edit').on('click',function(){
	var id = $(this).attr('attr-id');
	var url = SCOPE.edit_url + '&id=' + id;
	window.location.href = url;
});

//删除操作
$('.singcms-table #singcms-delete').on('click',function(){
	var id = $(this).attr('attr-id');
	var url = SCOPE.set_status_url;
	var a = $(this).attr('attr-a');
	var message = $(this).attr('attr-message');

	data = {};
	data['id'] = id;
	data['status'] = -1;

	layer.open({
		type:0,
		title:'是否提交？',
		btn:['yes','no'],
		icon:3,
		closeBtn:2,
		content:'是否确定'+message,
		scrollbar:true,
		yes:function(){
			todelete(url,data)
		},
	})
});

function todelete(url,data){
	$.post(url, data, function(a) {
		if (a.status == 1) {
			return dialog.success(a.message,'');
		}
		return dialog.error(a.message);
	},'JSON');
}

$('#button-listorder').click(function() {
	/* Act on the event */
	var data = $('#singcms-listorder').serializeArray();
	postData = {};
	$(data).each(function(i) {
		postData[this.name] = this.value;
	});
	var url = SCOPE.listorder_url;
	$.post(url,postData, function(result) {
		/*optional stuff to do after success */
		if(result.status == 0){
			return dialog.error(result.message,result['data']['jump_url']);
		}
		if(result.status == 1){
			return dialog.success(result.message,result['data']['jump_url']);
		}
	},'JSON');
});