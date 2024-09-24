<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $Title ?></title>

	<!-- BOOTSTRAP & CSS -->

	<!-- Bootstrap -->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<!--<link href="<?php echo Get_Assets_Url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"-->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
	<!-- DataTables.css -->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Get_Assets_Url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">



	<!-- bootstrap-daterangepicker -->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- select2 -->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet" media="screen">
	<link href="<?php echo Get_Assets_Url(); ?>vendors/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet" media="screen">
	<!-- sweetalert -->
	<link href="<?php echo Get_Assets_Url(); ?>vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" media="screen">

	<!-- Custom Theme Style -->
	<link href="<?php echo Get_Assets_Url(); ?>assets/css/custom.css" rel="stylesheet">

	<!-- Screen Style -->
	<link href="<?php echo Get_Assets_Url(); ?>assets/css/screen.css" rel="stylesheet" media="screen">
	<!-- Print Style -->
	<link href="<?php echo Get_Assets_Url(); ?>assets/css/print.css" rel="stylesheet" media="print">

	<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo Get_Assets_Url(); ?>vendors/bootstrap-select/bootstrap-select.min.css">
	
	<link rel="stylesheet" href="<?php echo Get_Assets_Url(); ?>vendors/leaflet/leaflet.css" />
	<link rel="stylesheet" href="<?php echo Get_Assets_Url(); ?>vendors/leaflet/leaflet-defaulticon-compatibility.css" />
	<link rel="stylesheet" href="<?php echo Get_Assets_Url(); ?>vendors/leaflet/leaflet-defaulticon-compatibility.webpack.css" />
	<link rel="stylesheet" href="<?php echo Get_Assets_Url(); ?>vendors/leaflet/leaflet-control-geocoder.css" />
	
	<link href="<?php echo Get_Assets_Url(); ?>Global/gojs-customshape.css" rel="stylesheet">
	<style type="text/css">
		.modal-body {
			max-height: calc(100vh - 210px);
			overflow-x: auto;
			overflow-y: auto;
		}
		
		.dark-mode 
		{
			background-color: #27272a !important;
			/*background-color: #0f172a !important;*/
			color: white !important;
			transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
			transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
			transition-duration: 1000ms;
		}
		
		@media only screen and (max-width: 600px) 
		{
			#menustep
			{
				height: 100vh;
			}
		  }

		  /* Small devices (portrait tablets and large phones, 600px and up) /
		  @media only screen and (min-width: 600px) {
			#menustep
			{
				height: 100vh;
			}
		  }

		  / Medium devices (landscape tablets, 768px and up) /
		  @media only screen and (min-width: 768px) {

			#menustep
			{
				height: 100vh;
			}
		  }

		  / Large devices (laptops/desktops, 992px and up) */
		  @media only screen and (min-width: 992px) 
		  {
			  #menustep
			{
				height: 100vh;
			}
		  }
	</style>


	<?php if (isset($css_files)) : ?>

		<?php foreach ($css_files as $file) : ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
	<?php endif; ?>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

</head>

<body class="nav-md" style="font-family: 'Quicksand', Georgia, 'Times New Roman', Times, serif;">
	<div class="container body">
		<div class="main_container">

			<div class="col-md-3 left_col">
				<!-- menu_fixed mCustomScrollbar -->
				<div class="left_col scroll-view">


					<!-- menu profile quick info -->

					<div class="navbar nav_title" style="border: 0; height:0; min-height:0">

					</div>

					<div class="clearfix"></div>
					<div class="profile clearfix">
						<div class="profile_pic">

						</div>
						<div class="profile_info">
							<span name="CAPTION-SELAMATDATANG">Selamat Datang </span>
							<h2><?php echo $Ses_UserName; ?></h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<div class="clearfix"></div>



					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<?php echo $sidemenu; ?>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<!--<a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
					<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
				  </a>-->
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>
			<div class="top_nav">
				<div class="nav_menu">

					<div class="nav toggle" style="width: 200px;">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						<i style="cursor: pointer;" onclick="ShowLanguage()">&nbsp;<label style="font-size: 14pt;"><img src="<?= Get_Assets_Url() ;?>assets/images/flag/<?= $_SESSION['Bahasa']; ?>.png" style="width: 26px; height: 26px;" />&nbsp;<?= $_SESSION['Bahasa']; ?></label></i>
						<button type="button" style="border: none; background-color: transparent;" id="btndarkmode" onclick="ToggleMode()"><i style="font-size: 14pt; color: #eab308;" id="dark" class="fa fa-sun"></i></button>
						
					</div>
					<ul class="nav navbar-nav navbar-right">

						<li class="">

							<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<img style="pointer-events: none;" src="<?= Get_Assets_Url() ;?>assets/images/karyawan/<?= $this->session->userdata('karyawan_foto'); ?>" />
								<?= $this->session->userdata('pengguna_username');	?>
								<span class="fa fa-angle-down"></span>
							</a>
							<ul class="dropdown-menu dropdown-usermenu pull-right">
								<li><a href="<?= $_SESSION['backend_url'] . 'HakAkses/ProfilKaryawan/ProfilKaryawanMenu'; ?>" name="CAPTION-PROFILKARYAWAN">Profil Karyawan</a></li>
								<li>
									<hr>
								</li>
								<li><a href="<?= $_SESSION['backend_url'] . 'MainPage/Logout'; ?>"><i class="fa fa-sign-out pull-right"></i><label name="CAPTION-LOGOUT">Log Out</label></a></li>
							</ul>
						</li>
						<?php
						if ($this->session->userdata('depo_nama') != '0') {
						?>
							<li class="">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<strong>
										<?php
										echo $this->session->userdata('depo_nama');
										?>
									</strong>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="<?= base_url('Main/MainDepo/MainDepoMenu') ?>" name="CAPTION-PILIHUNIT">Pilih Unit</a></li>

								</ul>
							</li>
						<?php
						}

						if ($this->session->userdata('Mode') != '0') {
						?>
							<li class="">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<strong>
										<?php
										echo $this->session->userdata('ModeKet');
										?>
									</strong>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="<?= $_SESSION['backend_url'] . 'Main/MainAplikasi/BackToAplikasiMenu' ?>" name="CAPTION-PILIHAPLIKASI">Pilih Aplikasi</a></li>
								</ul>
							</li>
						<?php
						}
						?>
					</ul>

					
				</div>
			</div>
			
			<div class="modal fade" id="previewshowlanguage" role="dialog" data-keyboard="false" data-backdrop="static">
				<div class="modal-dialog modal-sm">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header bg-primary">
							<!--button type="button" class="close" data-dismiss="modal">&times;</button-->
							<h4 class="modal-title" name="CAPTION-PILIHBAHASA">Pilih Bahasa</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<table width="100%" id="tbFlag">
									
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal" id="btnyespilihbahasa"><label name="CAPTION-YESPILIH">Iya</label></button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" id="btnnopilihbahasa"><label name="CAPTION-NOPILIH">Tidak</label></button>
						</div>
					</div>
				</div>
			</div>
			<!-- top navigation -->