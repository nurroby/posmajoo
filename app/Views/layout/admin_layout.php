<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Majoo | <?= (($page_title) ?? 'Ayoo Majoo' ) ?></title>

	<link rel="shortcut icon" href="https://majoo.id/favicon.png" />
	<?= view('css/base_admin') ?>
</head>

<body>

	<div class="wrapper">

		<!-- Preloader -->
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="https://majoo.id/favicon.png" alt="Majoo Logo" height="60" width="60">
		</div>

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light majoo-bg">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link btn btn-outline-success rounded-full elevation-1" href="<?= base_url().'/admin/logout'?>"
						role="button">
						<i class="fas fa-lock"></i> Logout
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<?= $this->include('layout/sidebar_admin') ?>

		<?= $this->renderSection('content') ?>

		<!-- Main Footer -->
		<footer class="main-footer text-center">
			<!-- Default to the left -->
			<strong"> 2019 &copy; PT Majoo Teknologi Indonesia.</strong>
		</footer>
		<!-- Main Footer -->
	</div>

	<?= view('js/base_admin') ?>

</body>

</html>