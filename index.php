<?php
// we require login!
define('REQIRE_LOGIN', true);

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
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" />

		<style>
		body {
		}
		h1, h2 {
		}
		</style>
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
				<div class="col-sm-12">
					<p>
						Kuberna är ett årligt tvådelat pris som delas ut till studenter vid
						Civilingenjör i medieteknik-programmet på Linköpings Universitet.
					</p>
					<p>
						Priset består av två kuber – en grå för teknisk prestation och en orange
						för kreativitet. Nytt för i år är att du som medlem i sektionen kan rösta
						på det bidrag du tycker ska vinna.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
						Grå kuben
						<small>
							<?php echo nicenumber(sizeof($data['gray']), 'en'); ?>
							nominera<?php echo sizeof($data['gray']) == 1 ? 'd' : 'de'; ?>
						</small>
				</div>
			</div>
			<?php
			foreach($data['gray'] as $nominee)
			{
				?>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<h3>
							<?php echo $nominee['name']; ?>
							<small>
								<?php echo $nominee['type']; ?> av <?php echo $nominee['who']; ?>
							</small>
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<img src="data/img/<?php echo $nominee['id']; ?>.jpg"
							 alt="<?php echo $nominee['name']; ?>"
							 class="img-responsive">
					</div>
					<div class="col-sm-8">
						<p>
							<?php echo $nominee['nomination']; ?>
						</p>
						<h4>
							<a href="<?php echo $nominee['link']; ?>" target="_blank">Mer info!</a>
						</h4>
					</div>
				</div>
				<?php
			}
			?>

			<div class="row">
				<div class="col-sm-12">
					<h2>
						Orange kuben
						<small>
							<?php echo nicenumber(sizeof($data['orange']), 'en'); ?>
							nominera<?php echo sizeof($data['orange']) == 1 ? 'd' : 'de'; ?>
						</small>
					</h2>
				</div>
			</div>
			<?php
			foreach($data['orange'] as $nominee)
			{
				?>
				<div class="row">
					<div class="col-sm-8 col-sm-offset-4">
						<h3>
							<?php echo $nominee['name']; ?>
							<small>
								<?php echo $nominee['type']; ?> av <?php echo $nominee['who']; ?>
							</small>
						</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<img src="data/img/<?php echo $nominee['id']; ?>.jpg"
							 alt="<?php echo $nominee['name']; ?>"
							 class="img-responsive">
					</div>
					<div class="col-sm-8">
						<p>
							<?php echo $nominee['nomination']; ?>
						</p>
						<h4>
							<a href="<?php echo $nominee['link']; ?>" target="_blank">Mer info!</a>
						</h4>
					</div>
				</div>
				<?php
			}
			?>
			<h2>
				Rösta
			</h2>
			<?php
				if(!phpCAS::isAuthenticated())
				{
					echo '<p><a href="?login" class="btn btn-info">Logga in med ditt LiU-id!</a> Du måste logga in för att kunna rösta.</p>';
				}
				else
				{
					?>
					<p>
						<a href="?logout" class="btn btn-info">Logga ut!</a>
						Du är inloggad som <strong><?php echo phpCAS::getUser(); ?></strong>.
					</p>
					<form action="vote.php" method="post">
						<div class="row">
							<div class="col-sm-4">
								<h3>
									Grå kuben
								</h3>
								<p>
									Välj vilket bidrag du tycker ska vinna för <strong>teknisk prestation</strong>.
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
					<?php
				} // else phpcas auth check
			?>
			<?php
			// do_dump($data);
			?>
		</div><!-- end .container -->
	</body>
</html>
