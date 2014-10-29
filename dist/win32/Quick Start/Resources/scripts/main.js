change_searchEngine(id, title, url, attr) {
	
}

$(document).ready(function() {
	$('#form').submit(function() {
		Ti.App.exit();
	});
	
	$('.se-change').click(function() {
		$('#se-nav li').each(function() {
			$(this).removeClass('active');
		});
		
		$(this).addClass('active');
		
		change_searchEngine();
	});
});