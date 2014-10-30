<script>
	var db = Ti.Database.open('mydb');
	var table = 'search_engines';
	
	//Create a table and insert values into it
	db.execute("CREATE TABLE IF NOT EXISTS " + table + "(id INTEGER, title TEXT, url TEXT, attr TEXT)");
	
	function list_rows() {
		var rows = db.execute("SELECT * FROM search_engines");
		var output = '';
		while (rows.isValidRow()) {
			//Alert the value of fields id and firstName from the Users database
			output += '<p>The user id is '+rows.fieldByName('id')+', and user name is '+rows.fieldByName('title') + ', url: ' + rows.fieldByName('url') + ', url: ' + rows.fieldByName('attr') + '</p>';
			rows.next();    
		}
		
		$('#db-content').html(output);

		//Release memory once you are done with the resultset and the database
		rows.close();		
	}
	
	function add_to_db(<?php echo $search_engines_attr_string; ?>) {
		var execute = '';
		execute += 'INSERT INTO ' + table + ' VALUES(';

		
		<?php foreach ($search_engines_attr as $attr) : ?>
		execute += '"' + <?php echo $attr; ?> + '",';
		<?php endforeach; ?>
		execute = execute.substring(0, execute.length-1);
		execute += ')';
		
		db.execute(execute);
		
		//Select from Table
		list_rows();
		db.close();
	}
	
	function remove_db(db) {
		db.remove();
		location.reload();
	}
	
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
		list_rows();
		
		$('#add_to_db').submit(function() {
			<?php foreach ($search_engines_attr as $attr) : ?>
			var <?php echo $attr; ?> = $(this).find('input[name="<?php echo $attr; ?>"]').val();
			<?php endforeach; ?>
			
			add_to_db(<?php echo $search_engines_attr_string; ?>);
		});
		
		$('#remove_db').click(function() {
			remove_db(db);
		});
		
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