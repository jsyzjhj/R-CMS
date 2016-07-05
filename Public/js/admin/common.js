

$('#button-add').click(function() {
	/* Act on the event */
	var url = SCOPE.add_url;
	window.location.href = url;
});

$('#rcms-button-submit').click(function() {
	/* Act on the event */
	var data = $('#rcms-form').serializeArray();
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
$('.rcms-table #rcms-edit').on('click',function(){
	var id = $(this).attr('attr-id');
	var url = SCOPE.edit_url + '&id=' + id;
	window.location.href = url;
});

//删除操作
$('.rcms-table #rcms-delete').on('click',function(){
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
	var data = $('#rcms-listorder').serializeArray();
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

//修改状态
$('.rcms-table #rcms-on-off').on('click',function(){
	var id = $(this).attr('attr-id');
	var url = SCOPE.set_status_url;
	var status = $(this).attr('attr-status');

	data = {};
	data['id'] = id;
	data['status'] = status;

	layer.open({
		type:0,
		title:'是否提交？',
		btn:['yes','no'],
		icon:3,
		closeBtn:2,
		content:'是否确定更改状态',
		scrollbar:true,
		yes:function(){
			todelete(url,data)
		},
	})
});

$("#rcms-push").click(function() {
	var id = $("#select-push").val();
	var url = SCOPE.push_url;
	var push = {};
	var postData = {};
	$("input[name='pushcheck']:checked").each(function(i) {
		push[i] = $(this).val();
	});
	postData['push'] = push;
	postData['position_id'] = id;
	$.post(url, postData, function(result) {
		if(result.status === 0) {
			//失败
			return dialog.error(result['message']);
		}
		if(result.status === 1) {
			//成功
			return dialog.success(result['message'],result['data']['jump_url']);
		}
	},'json');
});