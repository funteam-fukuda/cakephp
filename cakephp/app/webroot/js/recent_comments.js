$(function() {
	$.ajax({
		url: 'http://blog.dev/cakephp/posts/recent_comments'
	}).done(function(data) {
		$.ajax({
			url: 'http://blog.dev/cakephp/posts',
			type: 'post',
			data: data,
			dataType: 'json',
			// FormData
			contentType: 'application/x-www-form-urlencoded'
			// payload
			//contentType: 'application/json'
		});

	}).fail(function(data) {
		console.log('fail');
	});
});