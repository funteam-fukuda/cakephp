$(function() {
	$('div.editimg').appendTo($('#regist_img'));
	$('#addimg').append('<button id="addFormData" class="btn btn-primary" onclick="return false;">Add Image</button>');

	$('#addFormData').click(function() {
		$('#uploadform').append('<div class="upitem"><input type="file" style="display:none;"><div class="input-group"><input type="text" class="form-control" placeholder="select file..."><span class="input-group-btn"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button></span></div></div>');
		$('#uploadform').find('.upitem').each(function(i, e) {
			$(e).find('input').eq(0).attr('id', 'lefile' + (i+1));
			$(e).find('input').eq(0).attr('name', 'data[Attachment][' + (i+1) + '][photo]');
			$(e).find('input').eq(1).attr('class', 'form-control upimg' + (i+1));
			$(e).find('input').eq(1).attr('id', 'photoCover' + (i+1));
			$(e).find('button').attr('onclick', '$(\'input[id=lefile' + (i+1) + ']\').click();');
			$('input[id=lefile' + (i+1)).change(function() {
				$('.upimg' + (i+1)).val($(this).val());
			});
		});
	});
});