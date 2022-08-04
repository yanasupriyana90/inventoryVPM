<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Sistem Inventory PT. VPM</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="/assets/img/Vpm Logo.ico" type="image/x-icon" />
	<!-- Fonts and icons -->
	<script src="/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['/assets/css/fonts.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/azzara.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="/assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="light-blue">
			<!-- Logo Header -->
			<div class="logo-header">
				<a href="/home" class="logo">
					<img src="/assets/img/Vpm Landscape.png" alt="navbar brand" class="navbar-brand" height="40" width="165">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">

				<div class="container-fluid">
					<H1 style="color: black">Welcome Back, {{ auth()->user()->name }}</H1>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="/assets/img/Vpm Logo Profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="/assets/img/Vpm Logo Profile.jpg" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4>{{ auth()->user()->name }}</h4>
											<p class="text-muted">{{ auth()->user()->email }}</p>
										</div>
									</div>
								</li>
								<li>
									{{-- <div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="fa fa-user"></i> My Profile</a> --}}
									<div class="dropdown-divider"></div>
									<form action="/logout" method="POST">
										@csrf
										<button type="submit" class=" dropdown-item bg-light border-0"><i class="fa fa-power-off"></i> Logout</a>
										</button>
									</form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar">
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="/assets/img/Vpm Logo Profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ auth()->user()->name }}
									<span class="user-level">{{ auth()->user()->email }}</span>
								</span>
							</a>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
							<a href="/home">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						@if(Auth::user()->level == 1)
						<li class="nav-item {{ Request::is('kategori', 'barang') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Data Master Cobaan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li class="{{ Request::is('kategori') ? 'active' : '' }}">
										<a href="/kategori">
											<span><i class="fas fa-file-alt"></i> Data Kategori</span>
										</a>
									</li>
									<li class="{{ Request::is('barang') ? 'active' : '' }}">
										<a href="/barang">
											<span><i class="fas fa-box"></i> Data Barang</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif

						@if(Auth::user()->level == 1 || Auth::user()->level == 2)
						<li class="nav-item {{ Request::is('brg_masuk', 'brg_keluar') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#transaksi">
								<i class="fas fa-dollar-sign"></i>
								<p>Transaksi</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="transaksi">
								<ul class="nav nav-collapse">
									<li class="{{ Request::is('brg_masuk') ? 'active' : '' }}">
										<a href="/brg_masuk">
											<span><i class="fas fa-sign-in-alt"></i> Barang Masuk</span>
										</a>
									</li>
									<li class="{{ Request::is('brg_keluar') ? 'active' : '' }}">
										<a href="/brg_keluar">
											<span><i class="fas fa-sign-out-alt"></i> Barang Keluar</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif

						@if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3)
						<li class="nav-item {{ Request::is('lap_kategori', 'lap_barang', 'lap_brg_masuk', 'lap_brg_keluar') ? 'active' : '' }}">
							<a data-toggle="collapse" href="#laporan">
								<i class="fas fa-chart-line"></i>
								<p>Data Laporan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="laporan">
								<ul class="nav nav-collapse">
									<li class="{{ Request::is('lap_kategori') ? 'active' : '' }}">
										<a href="/lap_kategori">
											<span><i class="fas fa-file-alt"></i> Laporan Data Kategori</span>
										</a>
									</li>
									<li class="{{ Request::is('lap_barang') ? 'active' : '' }}">
										<a href="/lap_barang">
											<span><i class="fas fa-box"></i> Laporan Data Barang</span>
										</a>
									</li>
									<li class="{{ Request::is('lap_brg_masuk') ? 'active' : '' }}">
										<a href="/lap_brg_masuk">
											<span><i class="fas fa-sign-in-alt"></i> Laporan Barang Masuk</span>
										</a>
									</li>
									<li class="{{ Request::is('lap_brg_keluar') ? 'active' : '' }}">
										<a href="/lap_brg_keluar">
											<span><i class="fas fa-sign-out-alt"></i> Laporan Barang Keluar</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</div>

		@yield('content')

	</div>
	<!--   Core JS Files   -->
	<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="/assets/js/core/popper.min.js"></script>
	<script src="/assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="/assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Azzara JS -->
	<script src="/assets/js/ready.min.js"></script>
	<!-- Azzara DEMO methods, don't include it in your project! -->
	<script src="/assets/js/setting-demo.js"></script>

	<!-- Sweet Alert -->
	<script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	@if (session('success'))
	<script>
		//== Class definition
		var SweetAlert2Demo = function() {

			//== Demos
			var initDemos = function() {

				swal({
					title: "{{ session('success') }}",
					text: "{{ session('success') }}",
					icon: "success",
					button: {
						confirm: {
							text: "Confirm Me",
							value: true,
							visible: true,
							className: "btn btn-success",
							closeModal: true
						}
					}
				});
			};

			return {
				//== Init
				init: function() {
					initDemos();
				},
			};
		}();

		//== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
	</script>
	@endif

	@if (session('error'))
	<script>
		//== Class definition
		var SweetAlert2Demo = function() {

			//== Demos
			var initDemos = function() {

				swal({
					title: "{{ session('error') }}",
					text: "{{ session('error') }}",
					icon: "error",
					button: {
						confirm: {
							text: "Confirm Me",
							value: true,
							visible: true,
							className: "btn btn-success",
							closeModal: true
						}
					}
				});
			};

			return {
				//== Init
				init: function() {
					initDemos();
				},
			};
		}();

		//== Class Initialization
		jQuery(document).ready(function() {
			SweetAlert2Demo.init();
		});
	</script>
	@endif

	<script>
		$(document).ready(function() {
			$('#add-row').DataTable({

			});
		});
	</script>

</body>

</html>