<script>
	var appWindow = Ti.UI.getCurrentWindow();
	
	appWindow.addEventListener(Ti.FOCUSED, function() {
		$('#search-word').focus();
	});
	
	function change_searchEngine(<?php echo $search_engines_attr_string; ?>) {
		$('#form').attr('action', url);
		$('#search-word').attr('name', attr);

		$('.se-change').each(function() {
			$(this).removeClass('active');
		});	
		$('#se-' + id).addClass('active');
		
		$('#search-word').focus();
	}

	$(document).ready(function() {
		$('#form').submit(function() {
			Ti.App.exit();
		});

		$('.se-change a').tooltip();
		$('.se-change').click(function() {
			<?php foreach ($search_engines_attr as $attr) : ?>
			var <?php echo $attr; ?> = $(this).attr('data-<?php echo $attr; ?>');
			<?php endforeach; ?>

			change_searchEngine(<?php echo $search_engines_attr_string; ?>);
		});
	});
</script>