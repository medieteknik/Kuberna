<?php
// we require login!
define('REQUIRE_LOGIN', true);

// load system
require_once 'system.php';

// get nominee data
$datafile = file_get_contents('data/nominees.json');
$data = json_decode($datafile, true);
?>
<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
	<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Kuberna - Medietekniksektionen</title>
		<meta name="description" content="">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">

		<!-- CSS files -->
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" />
		<link rel="stylesheet/less" type="text/css" href="web/css/style.less" />

		<!-- load less -->
		<script src="web/js/less.js" type="text/javascript"></script>
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>Kuberna</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<p>
						Kuberna är ett årligt tvådelat pris som delas ut till studenter vid
						Civilingenjör i medieteknik-programmet på Linköpings Universitet.
					</p>
					<p>
						Priset består av två kuber – en grå för teknisk excellens och en orange
						för kreativitet. Nytt för i år är att du som medlem i sektionen kan rösta
						på det bidrag du tycker ska vinna.
					</p>
				</div>
			</div>
		</div><!-- end .container -->

		<div class="title" id="gray">
			<h2>
				Grå kuben<br />
				<small>
					<?php echo nicenumber(sizeof($data['gray']), 'en'); ?>
					nominera<?php echo sizeof($data['gray']) == 1 ? 'd' : 'de'; ?>
				</small>
			</h2>
		</div>

		<div class="container nominees">
			<?php
			$i = 0;

			foreach($data['gray'] as $nominee)
			{
				?>
				<div class="row">
					<div class="col-sm-4<?php echo $i % 2 == 0 ? ' col-sm-push-8' : ''; ?>">
						<img src="data/img/<?php echo $nominee['id']; ?>.jpg"
							 alt="<?php echo $nominee['name']; ?>"
							 class="img-responsive">
					</div>
					<div class="col-sm-8<?php echo $i % 2 == 0 ? ' col-sm-pull-4' : ''; ?>">
						<h3>
							<?php echo $nominee['name']; ?>
							<small>
								<?php echo $nominee['type']; ?> av <?php echo $nominee['who']; ?>
							</small>
						</h3>
						<p>
							<?php echo $nominee['nomination']; ?>
						</p>
						<?php
						if(!empty($nominee['link']))
						{
							?>
							<h4>
								<a href="<?php echo $nominee['link']; ?>" target="_blank">
									<?php
									echo empty($nominee['linktext']) ? 'Mer info' : $nominee['linktext'];
									?>
								</a>
							</h4>
							<?php
						}
						?>
					</div>
				</div>
				<?php
				$i++;
			}
			?>
		</div><!-- end .container -->

		<div class="title" id="orange">
			<h2 id="orange">
				Orange kuben<br />
				<small>
					<?php echo nicenumber(sizeof($data['orange']), 'en'); ?>
					nominera<?php echo sizeof($data['orange']) == 1 ? 'd' : 'de'; ?>
				</small>
			</h2>
		</div>

		<div class="container nominees">
			<?php
			$i = 1;
			foreach($data['orange'] as $nominee)
			{
				?>
				<div class="row">
					<div class="col-sm-4<?php echo $i % 2 == 0 ? ' col-sm-push-8' : ''; ?>">
						<img src="data/img/<?php echo $nominee['id']; ?>.jpg"
							 alt="<?php echo $nominee['name']; ?>"
							 class="img-responsive">
					</div>
					<div class="col-sm-8<?php echo $i % 2 == 0 ? ' col-sm-pull-4' : ''; ?>">
						<h3>
							<?php echo $nominee['name']; ?>
							<small>
								<?php echo $nominee['type']; ?> av <?php echo $nominee['who']; ?>
							</small>
						</h3>
						<p>
							<?php echo $nominee['nomination']; ?>
						</p>
						<?php
						if(!empty($nominee['link']))
						{
							?>
							<h4>
								<a href="<?php echo $nominee['link']; ?>" target="_blank">
									<?php
									echo empty($nominee['linktext']) ? 'Mer info' : $nominee['linktext'];
									?>
								</a>
							</h4>
							<?php
						}
						?>
					</div>
				</div>
				<?php
				$i++;
			}
			?>

		</div><!-- end .container -->

		<?php
			if(!phpCAS::isAuthenticated()) // logged in?
			{
				?>
				<div class="title" id="black">
					<h2>
						Rösta!<br />
						<small>
							Först måste du <a href="?login#black" class="btn btn-info">Logga in!</a>
						</small>
					</h2>
				</div>
				<?php
			}
			elseif($votes = has_voted(phpCAS::getUser(), $sysdb)) // has voted?
			{
				?>
				<div class="title" id="black">
					<h2>
						Tack för din röst!<br />
						<small>
							Du röstade på
							<?php
							// find the correct nominee indices for the votes
							$grayindex = array_search2d($votes['gray'], $data['gray']);
							$orangeindex = array_search2d($votes['orange'], $data['orange']);

							// should we print out the gray vote?
							if($grayindex !== FALSE)
								echo $data['gray'][$grayindex]['name'];
							// no blank votes?
							if($grayindex !== FALSE && $orangeindex !== FALSE)
								echo ' och ';
							// orange vote?
							if($orangeindex !== FALSE)
								echo $data['orange'][$orangeindex]['name'];

							// tell the user about the double blank vote
							if($grayindex === FALSE && $orangeindex === FALSE)
								echo ' blanka alternativ enbart!'
							?>
							<br />
							<a href="?logout" class="btn btn-info">Logga ut!</a>
						</small>
					</h2>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="title" id="black">
					<h2>
						Rösta nu!<br />
						<small>
							Inloggad som <?php echo phpCAS::getUser(); ?> <a href="?logout" class="btn btn-info">Logga ut!</a>
						</small>
					</h2>
				</div>
				<div class="container">
					<form action="vote.php" method="post">
						<div class="row">
							<div class="col-sm-4">
								<h3>
									Grå kuben
								</h3>
								<p>
									Välj vilket bidrag du tycker ska vinna för <strong>teknisk excellens</strong>.
								</p>
								<ul class="list-unstyled">
									<?php
									foreach ($data['gray'] as $nominee) {
										?>
										<li>
											<label>
												<input type="radio" name="gray" value="<?php echo $nominee['id']; ?>">
												<strong><?php echo $nominee['name']; ?></strong>
												<em><?php echo $nominee['type']; ?></em>
											</label>
										</li>
										<?php
									}
									?>
									<li>
										<label>
											<input type="radio" name="gray" value="" checked>
											<strong>Blankt</strong>
											<em>Välj denna om du vill rösta blankt.</em>
										</label>
									</li>
								</ul>
							</div>
							<div class="col-sm-4">
								<h3>
									Orange kuben
								</h3>
								<p>
									Välj vilket bidrag du tycker ska vinna för <strong>kreativitet</strong>.
								</p>
								<ul class="list-unstyled">
									<?php
									foreach ($data['orange'] as $nominee) {
										?>
										<li>
											<label>
												<input type="radio" name="orange" value="<?php echo $nominee['id']; ?>">
												<strong><?php echo $nominee['name']; ?></strong>
												<em><?php echo $nominee['type']; ?></em>
											</label>
										</li>
										<?php
									}
									?>
									<li>
										<label>
											<input type="radio" name="orange" value="" checked>
											<strong>Blankt</strong>
											<em>Välj denna om du vill rösta blankt.</em>
										</label>
									</li>
								</ul>
							</div>
							<div class="col-sm-4">
								<h3>
									Skicka!
								</h3>
								<p>
									Tänk på att du inte kan ångra dig och att du bara har en röst. Endast MT-studenters röster
									räknas.
								</p>
								<p>
									<input type="submit" value="Rösta!" name="vote" class="btn btn-primary" />
								</p>
								<p>
									<small>
										När du röstar accepterar du att vi lagrar ditt LiU-id.
									</small>
								</p>
							</div>
						</div>
					</form>
				</div><!-- end .container -->
			<?php
			} // else phpcas auth check
			?>
			<div class="container">
				<div class="row margin">
					<div class="col-sm-4 col-sm-offset-4
								col-md-2 col-md-offset-5
								col-xs-6 col-xs-offset-3">
						<a href="http://medieteknik.nu">
							<img src="web/img/mt.png" alt="Civilingenjör i Medieteknik" class="img-responsive">
						</a>
					</div>
				</div>
				<div class="row margin">
					<div class="col-sm-4 col-sm-offset-4">
						<p class="text-center text-muted">
							Frågor? Kontaka oss på <a href="mailto:styrelsen@medieteknik.nu" target="_blank">styrelsen@medieteknik.nu</a>.
							· Se koden på
							<a href="https://github.com/medieteknik/kuberna/"title="Se koden på GitHub" target="_blank">GitHub</a>.
						</p>
					</div>
				</div>
			</div>
	</body>
</html>
