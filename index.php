<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Secret Mixtape</title>
	<meta name="description" content="Mixtaper">
	<meta name="author" content="Jackson Willis & Mike Rogers">

    <link rel="stylesheet" href="resources/styles.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="resources/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="scripts/soundcloud.player.api.js"></script>
	<script type="text/javascript">
		var player;

	   	soundcloud.addEventListener('onPlayerReady', function(_player, data) {
			player = _player;
			$('#play').click(function() {
				player.api_play();
				$('#play').toggle();
				$('#pause').toggle();
		   	});
			$('#pause').click(function() {
				player.api_pause();
				$('#pause').toggle();
				$('#play').toggle();
		   	});
	   	});
	</script>
</head>

<body>
	<div class="container">
		<img src="img/tape.jpg" alt="tape image" class="tape" />

		<?php if($_GET['tape']): ?>

			<?php $url = base64_decode($_GET['tape']); ?>

			<div class="player">
				<object height="1" width="100%" id="mixtaper" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
					
					<param name="allowscriptaccess" value="always"></param>
					<embed allowscriptaccess="always" height="81" src="http://player.soundcloud.com/player.swf?url=http%3A%2F%2Fsoundcloud.com%2F<?php echo urlencode($url); ?>&enable_api=true&object_id=mixtaper" type="application/x-shockwave-flash" width="100%" name="mixtaper"></embed>
				</object>

				<button id="play">Play</button>
				<button id="pause">Pause</button>

				

				<div class="row">
					<p>Share this secret mixtape with your friends! Just send them this link</p>
					<div class="col-sm-12 permalink">
						Permalink: <input type="text" id="permalink" value="http://<?php echo $_SERVER['HTTP_HOST'];?>?tape=<?php echo base64_encode($_GET['tape']); ?>" />
					</div>
				</div>
			</div>

		<a href="/" class="new">Make a new Secret mixtape</a>

		<?php elseif($_POST['url']): ?>

				<div class="player">

					<object height="1" width="100%" id="mixtaper" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
						<param name="allowscriptaccess" value="always"></param>
						<embed allowscriptaccess="always" height="81" src="http://player.soundcloud.com/player.swf?url=<?php echo urlencode($_POST['url']); ?>&enable_api=true&object_id=mixtaper" type="application/x-shockwave-flash" width="100%" name="mixtaper"></embed>
					</object>

					<button id="play">Play</button>
					<button id="pause">Pause</button>

					<?php 
						//Remove https://soundcloud.com/ from url
						$url = base64_encode(ltrim (parse_url($_POST['url'])['path'], '/'));

					?>
					<div class="row">
						<div class="col-sm-12 permalink">
							<p>Share this secret mixtape with your friends! Just send them this link</p>
							Permalink: <input type="text" id="permalink" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>?tape=<?php echo $url; ?>" />
						</div>
					</div>
				</div>

		<a href="/" class="new">Make a new Secret mixtape</a>

		<?php else: ?>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<h3>Enter a soundcloud URL to generate a secret mixtape</h3>

					<div class="submit">
						<form id="submitForm" method="POST">
							<input type="text" name="url" id="url" />
							<input type="submit" />
						</form>
					</div>
				</div>
			</div>
		<?php endif; ?>

	</div>
</body>
</html>