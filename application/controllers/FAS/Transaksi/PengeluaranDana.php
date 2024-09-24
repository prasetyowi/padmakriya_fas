<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

require_once APPPATH . 'core/ParentController.php';

defined('BASEPATH') or exit('No direct script access allowed');

class PengeluaranDana extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage/Login'));
		endif;

		$this->load->model('M_Menu');
		// $this->load->model('M_PengeluaranDana');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');
		$this->load->model('FAS/M_PengeluaranDana');

		$this->depo_id = $this->session->userdata('depo_id');
		$this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
		$this->MenuKode = "212002000";
	}

	public function PengeluaranDanaMenu()
	{
		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		// $data['listTipeBiaya'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengeluaranDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengeluaranDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengeluaranDana->Getbank();
		$data['Perusahaan'] = $this->M_PengeluaranDana->GetPerusahaan();

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/button.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/card.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/image.min.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',
			Get_Assets_Url() . 'assets/css/buttondesign.css',

			Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));



		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Transaksi/PengeluaranDana/PengeluaranDanaMenu', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PengeluaranDana/S_PengeluaranDanaMenu', $data);
	}

	public function PengeluaranDanaForm()
	{
		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		// $data['listTipeBiaya'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengeluaranDana->Getkategori_biaya();
		// $data['pemohon'] = $this->M_PengeluaranDana->GetPengajuanDanaWhoCreate();
		// var_dump($data['pemohon']);
		// return false;
		$data['tipe_biaya'] = $this->M_PengeluaranDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengeluaranDana->Getbank();
		$data['Perusahaan'] = $this->M_PengeluaranDana->GetPerusahaan();

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/button.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/card.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/image.min.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',
			Get_Assets_Url() . 'assets/css/buttondesign.css',

			Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));



		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Transaksi/PengeluaranDana/PengeluaranDanaForm', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PengeluaranDana/S_PengeluaranDanaForm', $data);
	}

	public function PengeluaranDanaView()
	{
		$data = array();

		$pengeluaran_dana_kode = $this->input->get("kode");

		$data["pengeluaran_dana"] = $this->M_PengeluaranDana->getPengeluaranDanaByKode($pengeluaran_dana_kode);
		$data["pengeluaran_dana_detail"] = $this->M_PengeluaranDana->getPengeluaranDanaDetailByID($data["pengeluaran_dana"]->transaksi_dana_id);
		// var_dump($data["pengeluaran_dana_detail"]);
		// return false;

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		// $data['listTipeBiaya'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengeluaranDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengeluaranDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengeluaranDana->Getbank();
		$data['Perusahaan'] = $this->M_PengeluaranDana->GetPerusahaan();

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/button.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/card.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/image.min.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',
			Get_Assets_Url() . 'assets/css/buttondesign.css',

			Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));



		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Transaksi/PengeluaranDana/PengeluaranDanaView', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		// $this->load->view('FAS/Transaksi/PengeluaranDana/S_PengeluaranDanaView', $data);
	}
	public function PengajuanPengeluaranDanaEdit()
	{
		$data = array();

		$pengajuan_dana_kode = $this->input->get("kode");

		$data["pengajuan_dana"] = $this->M_PengeluaranDana->getPengajuanDanaByKode($pengajuan_dana_kode);
		$data["anggaran_detail_2"] = $this->M_PengeluaranDana->GetAnggaranDetail2ByYear();
		$data['kategori_biaya'] = $this->M_PengeluaranDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengeluaranDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengeluaranDana->Getbank();
		$data['Perusahaan'] = $this->M_PengeluaranDana->GetPerusahaan();
		// var_dump($data["pengajuan_dana"]);
		// return false;

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		// $data['listTipeBiaya'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengeluaranDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengeluaranDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengeluaranDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengeluaranDana->Getbank();
		$data['Perusahaan'] = $this->M_PengeluaranDana->GetPerusahaan();

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/button.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/card.min.css',
			Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/components/image.min.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',
			Get_Assets_Url() . 'assets/css/buttondesign.css',

			Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-FAS/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-FAS/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));



		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaEdit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas//PengajuanPengeluaranDana/S_PengajuanPengeluaranDanaEdit', $data);
	}

	public function getDataSearch()
	{
		$filter_status = $this->input->get('filter_status') == "" ? null : $this->input->get('filter_status');
		$filter_kategori_biaya = $this->input->get('filter_kategori_biaya') == "" ? null : $this->input->get('filter_kategori_biaya');
		$tgl = explode(" - ", $this->input->get('filter_tanggal'));
		$perusahaan = $this->input->get('filter_perusahaan') == "" ? null : $this->input->get('filter_perusahaan');

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$data = $this->M_PengeluaranDana->getDataSearch($filter_kategori_biaya, $filter_status, $tgl1, $tgl2, $perusahaan);

		Header('Content-Type: application/json');
		//output dalam format JSON
		echo json_encode($data);
	}

	public function getDataPermintaanPengeluaran()
	{
		$add_perusahaan = $this->input->get('add_perusahaan') == "" ? null : $this->input->get('add_perusahaan');
		$who_created = $this->input->get('who_created') == "" ? null : $this->input->get('who_created');
		// echo $default_pembayaran . $who_created;
		$data = $this->M_PengeluaranDana->getDataPermintaanPengeluaran($add_perusahaan, $who_created);

		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}

	public function GetAnggaranDetail2ByYear()
	{
		$data = $this->M_PengeluaranDana->GetAnggaranDetail2ByYear();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function getDataPemohon()
	{
		$pt = $this->input->post("add_perusahaan");
		$data = $this->M_PengeluaranDana->GetPengajuanDanaWhoCreate($pt);
		echo json_encode($data);
	}

	public function SavePengeluaranDana()
	{

		// die;
		try {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_BBK';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_PengeluaranDana->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;

			$transaksi_dana_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$kategori_biaya_id = $this->input->post('add_kategori_biaya');

			$transaksi_dana_status = $this->input->post('add_status');
			$transaksi_dana_nama_pemohon =  $this->input->post('add_pemohon');;
			$transaksi_dana_keterangan = $this->input->post('add_keterangan');
			$transaksi_dana_tanggal = $this->input->post('add_tanggal_pengeluaran');
			$transaksi_dana_jumlah = $this->input->post('input_nominal');
			$transaksi_dana_pembayaran = $this->input->post('add_default_pembayaran');

			$bank_account_id_penerima = $this->input->post('add_bank_penerima');
			$bank_account_id_pengirim = $this->input->post('add_bank_pengirim');
			$transaksi_dana_nama_penerima = $this->input->post('add_nama_penerima');
			$transaksi_dana_rekening_penerima = $this->input->post('add_no_rekening_penerima');
			$transaksi_dana_nama_pengirim = $this->input->post('add_nama_pengirim');
			$transaksi_dana_rekening_pengirim = $this->input->post('add_no_rekening_pengirim');
			$perusahaan = $this->input->post('add_perusahaan');

			$dataPermintaan = json_decode($this->input->post('dataPermintaan')); //onject


			if (!empty($_FILES['file']['name'])) {
				$uploadDirectory = "assets/uploads/files/PengeluaranDana/";
				$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
				$fileName = $_FILES['file']['name'];
				$fileSize = $_FILES['file']['size'];
				$fileTmpName  = $_FILES['file']['tmp_name'];
				$fileType = $_FILES['file']['type'];
				$fileExtension = strtolower(explode(".", $fileName)[1]);
				// $name_file = 'bukti-' . time() . '.' . $fileExtension;
				$name_file = str_replace("/", "-", $transaksi_dana_kode);
				$name_file = $name_file . '.' . $fileExtension;

				if (!in_array($fileExtension, $fileExtensionsAllowed)) {
					echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)"));
				} else {

					$uploadPath = $uploadDirectory . $name_file;
					move_uploaded_file($fileTmpName, $uploadPath);
					$data = $this->M_PengeluaranDana->SavePengeluaranDana(
						$transaksi_dana_kode,
						null,
						$transaksi_dana_status,
						$transaksi_dana_nama_pemohon,
						$transaksi_dana_keterangan,
						$transaksi_dana_tanggal,
						$transaksi_dana_jumlah,
						$transaksi_dana_pembayaran,
						$bank_account_id_penerima,
						$bank_account_id_pengirim,
						$transaksi_dana_nama_penerima,
						$transaksi_dana_rekening_penerima,
						$transaksi_dana_nama_pengirim,
						$transaksi_dana_rekening_pengirim,
						$dataPermintaan,
						$name_file,
						$perusahaan
					);
					if (is_string($data) == 1) {
						$response = array(
							'message' => $data,
							'status' =>  0
						);
					} elseif ($data == 1) {
						$response = array(
							'message' => 'success',
							'status' =>  1
						);
					} else {
						$this->load->helper("file");
						delete_files($uploadPath);
						$response = array(
							'message' => 'Failed create data !!',
							'status' =>  0
						);
					}
				}
			} else {
				$data = $this->M_PengeluaranDana->SavePengeluaranDana(
					$transaksi_dana_kode,
					null,
					$transaksi_dana_status,
					$transaksi_dana_nama_pemohon,
					$transaksi_dana_keterangan,
					$transaksi_dana_tanggal,
					$transaksi_dana_jumlah,
					$transaksi_dana_pembayaran,
					$bank_account_id_penerima,
					$bank_account_id_pengirim,
					$transaksi_dana_nama_penerima,
					$transaksi_dana_rekening_penerima,
					$transaksi_dana_nama_pengirim,
					$transaksi_dana_rekening_pengirim,
					$dataPermintaan,
					null,
					$perusahaan
				);

				if (is_string($data) == 1) {
					$response = array(
						'message' => $data,
						'status' =>  0
					);
				} elseif ($data == 1) {
					$response = array(
						'message' => 'success',
						'status' =>  1
					);
				} else {
					$response = array(
						'message' => 'Failed create data !!',
						'status' =>  0
					);
				}
			}
			echo json_encode($response);
		} catch (\Throwable $th) {
			$response = array(
				'message' => $th,
				'status' =>  0
			);
			throw $th;
		}
	}

	public function UpdatePengajuanDana()
	{
		try {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PPD';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');

			$pengajuan_dana_kode = $this->input->post('kode');
			$pengajuan_dana_id = $this->input->post('id');

			$kategori_biaya_id = $this->input->post('add_kategori_biaya');
			$tipe_biaya_id = $this->input->post('add_tipe_biaya');
			$pengajuan_dana_status = $this->input->post('add_status');
			$pengajuan_dana_judul = $this->input->post('add_judul');
			$pengajuan_dana_keterangan = $this->input->post('add_keterangan');
			$pengajuan_dana_tgl_pengajuan = $this->input->post('add_tanggal_pengajuan');
			$pengajuan_dana_tgl_dibutuhkan = $this->input->post('add_tanggal');
			$pengajuan_dana_value = $this->input->post('add_nilai');
			$pengajuan_dana_default_pembayaran = $this->input->post('add_default_pembayaran');
			$bank_account_id = $this->input->post('add_bank_id');
			$pengajuan_dana_nama_penerima = $this->input->post('add_nama_penerima');
			$pengajuan_dana_rekening_penerima = $this->input->post('add_no_rekening');
			$anggaran_detail_2_id = $this->input->post('add_anggaran_detail_2');
			$perusahaan = $this->input->post('add_perusahaan');

			if (!empty($_FILES['file']['name'])) {
				$uploadDirectory = "assets/uploads/files/PengajuanDana/";
				$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
				$fileName = $_FILES['file']['name'];
				$fileSize = $_FILES['file']['size'];
				$fileTmpName  = $_FILES['file']['tmp_name'];
				$fileType = $_FILES['file']['type'];
				$fileExtension = strtolower(explode(".", $fileName)[1]);
				// $name_file = 'bukti-' . time() . '.' . $fileExtension;
				$name_file = str_replace("/", "-", $pengajuan_dana_kode);
				$name_file = $name_file . '.' . $fileExtension;

				if (!in_array($fileExtension, $fileExtensionsAllowed)) {
					echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)"));
				} else {
					$uploadPath = $uploadDirectory . $name_file;
					move_uploaded_file($fileTmpName, $uploadPath);
					$data = $this->M_PengeluaranDana->UpdatePengajuanDana(
						$pengajuan_dana_id,
						$pengajuan_dana_kode,
						$kategori_biaya_id,
						$tipe_biaya_id,
						$pengajuan_dana_status,
						$pengajuan_dana_judul,
						$pengajuan_dana_keterangan,
						$pengajuan_dana_tgl_pengajuan,
						$pengajuan_dana_tgl_dibutuhkan,
						$pengajuan_dana_value,
						$pengajuan_dana_default_pembayaran,
						$bank_account_id,
						$pengajuan_dana_nama_penerima,
						$pengajuan_dana_rekening_penerima,
						$anggaran_detail_2_id,
						$name_file
					);
					if (is_string($data) == 1) {
						$response = array(
							'message' => $data,
							'status' =>  0
						);
					} elseif ($data == 1) {
						$response = array(
							'message' => 'success',
							'status' =>  1
						);
					} else {
						// $this->load->helper("file");
						// unlink($uploadPath);
						$response = array(
							'message' => 'Failed create data !!',
							'status' =>  0
						);
					}
				}
			} else {
				$name_file = str_replace("/", "-", $pengajuan_dana_kode);
				$name_file = $name_file . '.' . 'pdf';
				$data = $this->M_PengeluaranDana->UpdatePengajuanDana(
					$pengajuan_dana_id,
					$pengajuan_dana_kode,
					$kategori_biaya_id,
					$tipe_biaya_id,
					$pengajuan_dana_status,
					$pengajuan_dana_judul,
					$pengajuan_dana_keterangan,
					$pengajuan_dana_tgl_pengajuan,
					$pengajuan_dana_tgl_dibutuhkan,
					$pengajuan_dana_value,
					$pengajuan_dana_default_pembayaran,
					$bank_account_id,
					$pengajuan_dana_nama_penerima,
					$pengajuan_dana_rekening_penerima,
					$anggaran_detail_2_id,
					$name_file
				);
				// $uploadDirectory1 = "assets/uploads/files/PengajuanDana/";
				// $name_file1 = str_replace("/", "-", $pengajuan_dana_kode);
				// $name_file1 = $name_file1 . '.pdf';
				// $uploadPath1 = $uploadDirectory1 . $name_file1;
				if (is_string($data) == 1) {
					$response = array(
						'message' => $data,
						'status' =>  0
					);
				} elseif ($data == 1) {
					// $this->load->helper("file");
					// unlink($uploadPath1);
					$response = array(
						'message' => 'success',
						'status' =>  1
					);
				} else {
					$response = array(
						'message' => 'Failed create data !!',
						'status' =>  0
					);
				}
			}
			echo json_encode($response);
		} catch (\Throwable $th) {
			$response = array(
				'message' => $th,
				'status' =>  0
			);
			throw $th;
		}
	}

	public function ViewAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PengeluaranDana/";
		$data   = file_get_contents($directory . $name_file);
		header('Content-Type: application/pdf');
		echo $data;
		// force_download($name_file, $data);
	}
	public function downloadAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PengajuanDana/";
		$data   = file_get_contents($directory . $name_file);
		force_download($name_file, $data);
	}
}
