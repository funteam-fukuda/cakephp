$(function() {
	$.ajax({
		url: 'http://blog.dev/cakephp/posts/recent_comments'
	}).done(function(data) {
		var json = $.parseJSON(data);
		getset_recent_comments(json);
	}).fail(function(data) {
		console.log('fail');
	});
});

function getset_recent_comments(json) {
	$.each(json, function(index, elem) {
		console.log(elem.Comment.commenter);
		console.log(elem.Comment.body);
		console.log(elem.Comment.created);
	});
}