<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class PengajuanPengeluaranDana extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_Menu');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');
		$this->load->model('FAS/M_PengajuanDana', 'M_PengajuanDana');

		$this->depo_id = $this->session->userdata('depo_id');
		$this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
		$this->MenuKode = "210008000";
	}

	public function PengajuanPengeluaranDanaMenu()
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
		// $data['listTipeBiaya'] = $this->M_PengajuanDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengajuanDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengajuanDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengajuanDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengajuanDana->Getbank();
		$data['Perusahaan'] = $this->M_PengajuanDana->GetPerusahaan();
		$data['TipeTransaksi'] = $this->M_PengajuanDana->GetTipeTransaksi();
		$data['TipePengadaan'] = $this->M_PengajuanDana->GetTipePengadaan();
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		// $data['Ses_UserName'] = $this->session->userdata('UserName');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaMenu', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/S_PengajuanPengeluaranDanaMenu', $data);
	}

	public function PengajuanPengeluaranDanaView()
	{
		$data = array();

		$pengajuan_dana_kode = $this->input->get("kode");

		$data["pengajuan_dana"] = $this->M_PengajuanDana->getPengajuanDanaByKode($pengajuan_dana_kode);
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
		// $data['listTipeBiaya'] = $this->M_PengajuanDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengajuanDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengajuanDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengajuanDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengajuanDana->Getbank();
		$data['Perusahaan'] = $this->M_PengajuanDana->GetPerusahaan();
		$data['TipeTransaksi'] = $this->M_PengajuanDana->GetTipeTransaksi();
		$data['TipePengadaan'] = $this->M_PengajuanDana->GetTipePengadaan();
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		// $data['Ses_UserName'] = $this->session->userdata('UserName');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaView', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/S_PengajuanPengeluaranDanaView', $data);
	}
	public function PengajuanPengeluaranDanaEdit()
	{
		$data = array();

		$pengajuan_dana_kode = $this->input->get("kode");

		$data["pengajuan_dana"] = $this->M_PengajuanDana->getPengajuanDanaByKode($pengajuan_dana_kode);

		$data["anggaran_detail_2"] = $this->M_PengajuanDana->GetAnggaranDetail2ByYearByKode($data["pengajuan_dana"]->tahun_pengajuan_dana_dibutuhkan);
		// $data["anggaran_detail_2"] = $this->M_PengajuanDana->GetAnggaranDetail2ByYear();
		$data['kategori_biaya'] = $this->M_PengajuanDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengajuanDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengajuanDana->Getbank();
		$data['Perusahaan'] = $this->M_PengajuanDana->GetPerusahaan();
		$data['TipeTransaksi'] = $this->M_PengajuanDana->GetTipeTransaksi();
		$data['TipePengadaan'] = $this->M_PengajuanDana->GetTipePengadaan();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		// $data['listTipeBiaya'] = $this->M_PengajuanDana->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PengajuanDana->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PengajuanDana->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PengajuanDana->Gettipe_biaya();
		$data['bank'] = $this->M_PengajuanDana->Getbank();

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$data['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		// $data['Ses_UserName'] = $this->session->userdata('UserName');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/PengajuanPengeluaranDanaEdit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/PengajuanPengeluaranDana/S_PengajuanPengeluaranDanaEdit', $data);
	}

	public function getDataSearch()
	{
		$filter_status = $this->input->post('filter_status') == "" ? null : $this->input->post('filter_status');
		$filter_tipe_biaya = $this->input->post('filter_tipe_biaya') == "" ? null : $this->input->post('filter_tipe_biaya');
		$filter_perusahaan = $this->input->post('filter_perusahaan') == "" ? null : $this->input->post('filter_perusahaan');
		$tgl = explode(" - ", $this->input->post('filter_tanggal'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$data = $this->M_PengajuanDana->getDataSearch($filter_tipe_biaya, $filter_status, $tgl1, $tgl2, $filter_perusahaan);

		Header('Content-Type: application/json');
		//output dalam format JSON
		echo json_encode($data);
	}

	public function GetAnggaranDetail2ByYear()
	{
		$data = $this->M_PengajuanDana->GetAnggaranDetail2ByYear();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetAnggaranDetail2ByYearDepoClient()
	{
		$client_wms_id = $this->input->post("client_wms_id");
		$date = $this->input->post("tahun");
		$data = $this->M_PengajuanDana->GetAnggaranDetail2ByYearDepoClient($client_wms_id, $date);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetAnggaranBudget()
	{
		$client_wms_id = $this->input->post("client_wms_id");
		$data = $this->M_PengajuanDana->GetAnggaranBudget($client_wms_id);
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function SavePengajuanDana()
	{
		try {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PPD';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_PengajuanDana->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$pengajuan_dana_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
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
			$tipe_transaksi = $this->input->post('add_tipe_transaksi');
			$no_doc_po = $this->input->post('add_nodocpo');
			$jenis_asset = $this->input->post('add_jenis_asset');
			$jenis_pengadaan = $this->input->post('add_jenis_pengadaan');


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
					$data = $this->M_PengajuanDana->SavePengajuanDana(
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
						$name_file,
						$perusahaan,
						$tipe_transaksi,
						$no_doc_po,
						$jenis_asset,
						$jenis_pengadaan
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
				$data = $this->M_PengajuanDana->SavePengajuanDana(
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
					null,
					$perusahaan,
					$tipe_transaksi,
					$no_doc_po,
					$jenis_asset,
					$jenis_pengadaan
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
			$tipe_transaksi = $this->input->post('add_tipe_transaksi');
			$no_doc_po = $this->input->post('add_nodocpo');
			$jenis_asset = $this->input->post('add_jenis_asset');
			$jenis_pengadaan = $this->input->post('add_jenis_pengadaan');


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
					// echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)", 'kode' => $kode));
					echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)"));
				} else {
					$uploadPath = $uploadDirectory . $name_file;
					move_uploaded_file($fileTmpName, $uploadPath);
					$data = $this->M_PengajuanDana->UpdatePengajuanDana(
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
						$name_file,
						$perusahaan,
						$tipe_transaksi,
						$no_doc_po,
						$jenis_asset,
						$jenis_pengadaan
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
				$data = $this->M_PengajuanDana->UpdatePengajuanDana(
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
					$name_file,
					$perusahaan,
					$tipe_transaksi,
					$no_doc_po,
					$jenis_asset,
					$jenis_pengadaan
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
		$directory = "assets/uploads/files/PengajuanDana/";
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

	public function GetTipeTransaksiByTipePengadaanID()
	{
		$idTipePengadaan = $this->input->post('id_jenis_pengadaan');
		$data = $this->M_PengajuanDana->GetTipeTransaksiByTipePengadaanID($idTipePengadaan);
		echo json_encode($data);
	}
	public function GetTipePengadaan()
	{
		$this->db->select("*")
			->from("tipe_pengadaan")
			->where("tipe_pengadaan_is_aktif", "1")
			->order_by("tipe_pengadaan_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
}
