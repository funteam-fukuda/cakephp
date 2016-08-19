$(function() {
	$.ajax({
		url: 'http://blog.dev/cakephp/posts/recent_comments'
	}).done(function(data) {
		//console.log(data);
		//var json = $.parseJSON(data);
		$.ajax({
			url: 'http://blog.dev/cakephp/posts/get_recent_comments',
			type: 'post',
			data: data,
			//data: {"data": {"Post": {"b":20}}},
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

function getset_recent_comments(json) {
	var html;
	$.each(json, function(index, elem) {
		html += '<li><dt><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' + elem.Comment.commenter;
		html += '<span class="recent-title"> on ' + elem.Post.title + ' - <span class="recente-create">' + elem.Comment.created + '</span></span>';
		html += '</dt><dd>' + elem.Comment.body + '</dd></dl></li>';
	});
	$('#recent_comments').empty().append(html);
}