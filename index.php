<?php
require 'function.php';

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
	header("Location: login.php");
	exit();
}

// query kategori
$sqlCat = "SELECT COUNT(*) AS total_kategori FROM kategori";
$resultCat = $conn->query($sqlCat);

// query produk
$sqlStok = "SELECT SUM(stok) AS total_stok FROM produk";
$resultStok = $conn->query($sqlStok);

// query nota
$sqlNota = "SELECT SUM(total) AS total_nota FROM nota";
$resultNota = $conn->query($sqlNota);

// query kasir
$sqlKasir = "SELECT COUNT(*) AS sum_nota FROM nota";
$resultKasir = $conn->query($sqlKasir);


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/sidebar.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/content.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
		integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
	<title>Dashboard</title>

</head>

<body>
	<div>
		<div class="sidebar p-4 bg-primary" id="sidebar">
			<h4 class="mb-5 text-white">Kantin IM</h4>
			<li>
				<!-- dashboard, produk, kategori, report, kasir -->
				<a class="text-white" href="#">
					<i class="bi bi-house mr-2"></i>
					Dashboard
				</a>
			</li>
			<li>
				<a class="text-white" href="barang/index.php">
					<i class="bi bi-basket2-fill mr-2"></i>
					Barang
				</a>
			</li>
			<li>
				<a class="text-white" href="Kategori/index.php">
					<i class="bi bi-boxes mr-2"></i>
					Kategori
				</a>
			</li>
			<li>
				<a class="text-white" href="kasir/kasir.php">
					<i class="bi bi-shop mr-2"></i>
					Penjualan
				</a>
			</li>
			<li>
				<a class="text-white" href="nota/index.php">
					<i class="bi bi-newspaper mr-2"></i>
					Laporan
				</a>
			</li>
		</div>


		<div>
			<section class="p-4" id="main-content">
				<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
					<div class="container-fluid">
						<button class="btn btn-primary" id="button-toggle">
							<i class="bi bi-list"></i>
						</button>
						<a class="navbar-brand" href="#">
							<img src="http://elearning.stmik-im.ac.id/pluginfile.php/1/theme_klass/footerlogo/1623432954/PTIMKecilSekali.png"
								alt="">
							<b id="name">Kantin IM</b>
						</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
							data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
							aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
							<ul class="navbar-nav mt-auto">
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle bg-secondary" href="#"
										id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
										aria-expanded="false">
										<i class="bi bi-person-circle"></i> Profile
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
										<li><a class="dropdown-item" href="logout.php">logout</a></li>
									</ul>

								</li>
							</ul>
						</div>
					</div>
				</nav>

				<div class="badan">
					<div class="card mt-5">
						<div class="card-body">
							<h4>Lorem Ipsum</h4>
							<p>
								Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque
								animi maxime at minima. Totam vero omnis ducimus commodi placeat
								accusamus, repudiandae nemo, harum magni aperiam esse voluptates.
								Non, sapiente vero?
							</p>
						</div>
					</div>
					<br>
					<?php if ($resultCat && $resultStok && $resultKasir && $resultNota) {
						$rowcat = $resultCat->fetch_assoc();
						$total_kategori = $rowcat['total_kategori'];

						// Ambil nilai total stok produk
						$rowStok = $resultStok->fetch_assoc();
						$totalStok = $rowStok['total_stok'];

						// Ambil nilai banyaknya query kasir
						$rowKasir = $resultKasir->fetch_assoc();
						$totalKasir = $rowKasir['sum_nota'];

						// Ambil nilai total nota
						$rowNota = $resultNota->fetch_assoc();
						$totalNota = $rowNota['total_nota'];
						?>
						<div class="d-flex flex-row bd-highlight mb-3">
							<div class="col-md-3 mb-3">
								<div class="card">
									<div class="card-header bg-primary text-white">
										<h6 class="pt-2"><i class="fas fa-chart-bar"></i> Stok Barang</h6>
									</div>
									<div class="card-body">
										<center>
											<h1>
												<?= $totalStok ?>
											</h1>
										</center>
									</div>
									<div class="card-footer">
										<a href='barang/index.php'>Tabel
											Barang <i class='fa fa-angle-double-right'></i></a>
									</div>
								</div>
								<!--/grey-card -->
							</div>
							<div class="col-md-3 mb-3">

								<div class="card">
									<div class="card-header bg-primary text-white">
										<h6 class="pt-2"><i class="fas fa-chart-bar"></i> Kategori</h6>
									</div>
									<div class="card-body">
										<center>
											<h1>
												<?= $total_kategori ?>
											</h1>
										</center>
									</div>
									<div class="card-footer">
										<a href='Kategori/index.php'>Tabel Kategori <i
												class='fa fa-angle-double-right'></i></a>
									</div>
								</div>

								<!--/grey-card -->
							</div>
							<div class="col-md-3 mb-3">
								<div class="card">
									<div class="card-header bg-primary text-white">
										<h6 class="pt-2"><i class="fas fa-chart-bar"></i> Penjualan</h6>
									</div>
									<div class="card-body">
										<center>
											<h1>
												<?= $totalKasir ?>
											</h1>
										</center>
									</div>
									<div class="card-footer">
										<a href='kasir/kasir.php'>Kasir <i class='fa fa-angle-double-right'></i></a>
									</div>
								</div>
								<!--/grey-card -->
							</div>
							<div class="col-md-3 mb-3">
								<div class="card">
									<div class="card-header bg-primary text-white">
										<h6 class="pt-2"><i class="fas fa-chart-bar"></i> Pendapatan</h6>
									</div>
									<div class="card-body">
										<center>
											<h1>
												<?= "Rp.", number_format($totalNota, 2, ",", ".") ?>
											</h1>
										</center>
									</div>
									<div class="card-footer">
										<a href='#'>Tabel
											Barang <i class='fa fa-angle-double-right'></i></a>
									</div>
								</div>
								<!--/grey-card -->
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="footer">
					<center style="float: bottom;">
						<p>2023 - Project pengembangan aplikasi kasir</p>
					</center>
					<center style="float: bottom;">
						<p>Oleh Kelompok 4</p>
					</center>
				</div>
			</section>
		</div>
	</div>

	<script>
		// event will be executed when the toggle-button is clicked
		document.getElementById("button-toggle").addEventListener("click", () => {

			// when the button-toggle is clicked, it will add/remove the active-sidebar class
			document.getElementById("sidebar").classList.toggle("active-sidebar");

			// when the button-toggle is clicked, it will add/remove the active-main-content class
			document.getElementById("main-content").classList.toggle("active-main-content");
		});


	</script>
</body>

</html>