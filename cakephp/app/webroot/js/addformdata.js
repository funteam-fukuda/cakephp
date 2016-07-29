$(function() {
	$('#addFormData').click(function() {
		$('.file').append('<div><input type="file"></div>');
		$('.file').find('input').each(function(i) {
			$(this).attr({'name':'data[Attachment][' + i + '][photo]', 'id':'Attachment' + i + 'Photo'});
		})
	});
});