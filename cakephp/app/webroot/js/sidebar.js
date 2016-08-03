$(function() {
	var duration = 300;
	var aside = $('.page-main > aside');
	var asideBtn = aside.find('button').click(function() {
		aside.toggleClass('open');
		if (aside.hasClass('open')) {
			aside.stop(true).animate({left:'-70px'}, duration, 'easeOutBack');
			asideBtn.find('img').attr('src', 'http://blog.dev/cakephp/img/btn_open.png');
		} else {
			aside.stop(true).animate({left: '-350px'}, duration, 'easeInBack');
			asideBtn.find('img').attr('src', 'http://blog.dev/cakephp/img/btn_open.png');
		}
	});
});