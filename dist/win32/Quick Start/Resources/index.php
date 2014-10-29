<?php

date_default_timezone_set('Europe/Berlin');
ini_set('default_charset', 'utf8');
ini_set('display_errors', 'Off');

$search_engines_attr = array('id', 'title', 'url', 'attr');
$search_engines_attr_string = implode(', ', $search_engines_attr);

$search_engines = array(
	array('id' => 'google-web', 'title' => 'Google Web', 'url' => 'https://www.google.com/search', 'attr' => 'q'),
	array('id' => 'google-images', 'title' => 'Google Images', 'url' => 'https://www.google.com/images', 'attr' => 'q'),
	array('id' => 'wikipedia', 'title' => 'Wikipedia DE', 'url' => 'http://de.wikipedia.org/wiki/Spezial:Search', 'attr' => 'search')
);
$search_engines_default = 0;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">                
        <link rel="stylesheet" href="styles/main.css">           
    </head>

    <body>
        <div id="search-area">
			<div class="container">

				<ul class="nav nav-pills" id="se-nav">
					<?php for ($i = 0; $i < count($search_engines); $i++) : $search_engine = $search_engines[$i]; ?>
					<li 
						id="se-<?php echo $search_engine['id']; ?>" 
						class="se-change <?php if ($i == $search_engines_default) : ?>active<?php endif; ?>" 

						<?php foreach ($search_engines_attr as $attr) : ?>
						data-<?php echo $attr; ?>="<?php echo $search_engine[$attr]; ?>"
						<?php endforeach; ?>
					>
						<a href="javascript:void(0);" title="<?php echo $search_engine['title']; ?>">
							<img src="images/se/<?php echo $search_engine['id']; ?>.png">
						</a>
					</li>
					<?php endfor; ?>
				</ul>

				<form action="<?php echo $search_engines[$search_engines_default]['url']; ?>" method="get" target="_blank" id="form">
					<div class="input-group">
						<input id="search-word" type="text" name="<?php echo $search_engines[$search_engines_default]['attr']; ?>" spellcheck="false" class="input-lg form-control" autofocus>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</form>
			</div>
		</div><!-- search-area -->

		<script src="lib/jquery/jquery-1.11.1.min.js"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>
		<?php include 'scripts/main.js.php'; ?>
    </body>
</html>