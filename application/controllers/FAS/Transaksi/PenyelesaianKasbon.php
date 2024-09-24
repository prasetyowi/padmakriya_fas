<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

require_once APPPATH . 'core/ParentController.php';

defined('BASEPATH') or exit('No direct script access allowed');

class PenyelesaianKasbon extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage/Login'));
		endif;

		$this->load->model('M_Menu');
		// $this->load->model('M_PenyelesaianKasbon');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');
		$this->load->model('FAS/M_PenyelesaianKasbon');

		$this->depo_id = $this->session->userdata('depo_id');
		$this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
		$this->MenuKode = "212005000";
	}

	public function PenyelesaianKasbonMenu()
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
		// $data['listTipeBiaya'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();

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
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonMenu', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/S_PenyelesaianKasbon', $data);
	}

	public function PenyelesaianKasbonForm()
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
		// $data['listTipeBiaya'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		// $data['pemohon'] = $this->M_PenyelesaianKasbon->GetPengajuanDanaWhoCreate();
		// var_dump($data['pemohon']);
		// return false;
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();

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
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonForm', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/S_PenyelesaianKasbon', $data);
	}

	public function PenyelesaianKasbonView()
	{
		$data = array();

		$penyelesaian_kasbon_id = $this->input->get("id");


		$data["penyelesaian_kasbon"] = $this->M_PenyelesaianKasbon->getPenyelesaianKasbonbyId($penyelesaian_kasbon_id);
		$data["penyelesaian_kasbon_detail"] = $this->M_PenyelesaianKasbon->getPenyelesaianKasbonbyIdDetail($penyelesaian_kasbon_id);
		// echo json_encode($data["penyelesaian_kasbon_detail"]);
		// die;
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();
		$data['TransaksiDana'] = $this->M_PenyelesaianKasbon->GetTransaksiDana();
		$data['TransaksiDanaNamaPemohon'] = $this->M_PenyelesaianKasbon->GetTransaksiDanaPemohon();
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
		// $data['listTipeBiaya'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();

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
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonDetail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/S_PenyelesaianKasbon', $data);
	}
	public function PenyelesaianKasbonEdit()
	{
		$data = array();

		$penyelesaian_kasbon_id = $this->input->get("id");

		$data["penyelesaian_kasbon"] = $this->M_PenyelesaianKasbon->getPenyelesaianKasbonbyId($penyelesaian_kasbon_id);
		$data["penyelesaian_kasbon_detail"] = $this->M_PenyelesaianKasbon->getPenyelesaianKasbonbyIdDetail($penyelesaian_kasbon_id);
		// echo json_encode($data["penyelesaian_kasbon_detail"]);
		// die;
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();
		$data['TransaksiDana'] = $this->M_PenyelesaianKasbon->GetTransaksiDana();
		$data['TransaksiDanaNamaPemohon'] = $this->M_PenyelesaianKasbon->GetTransaksiDanaPemohon();
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
		// $data['listTipeBiaya'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// $data['listStatus'] = $this->M_PenyelesaianKasbon->getListTipeBiaya();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		$data['kategori_biaya'] = $this->M_PenyelesaianKasbon->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_PenyelesaianKasbon->Gettipe_biaya();
		$data['bank'] = $this->M_PenyelesaianKasbon->Getbank();
		$data['Perusahaan'] = $this->M_PenyelesaianKasbon->GetPerusahaan();

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
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/PenyelesaianKasbonEdit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Transaksi/PenyelesaianKasbon/S_PenyelesaianKasbon', $data);
	}

	public function getDataSearch()
	{
		$filter_status = $this->input->get('filter_status') == "" ? null : $this->input->get('filter_status');
		$filter_kategori_biaya = $this->input->get('filter_kategori_biaya') == "" ? null : $this->input->get('filter_kategori_biaya');
		$tgl = explode(" - ", $this->input->get('filter_tanggal'));
		$perusahaan = $this->input->get('filter_perusahaan') == "" ? null : $this->input->get('filter_perusahaan');

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$data = $this->M_PenyelesaianKasbon->getDataSearch($filter_kategori_biaya, $filter_status, $tgl1, $tgl2, $perusahaan);

		Header('Content-Type: application/json');
		//output dalam format JSON
		echo json_encode($data);
	}

	public function getDataPermintaanPengeluaran()
	{
		$id = $this->input->post('id') == "" ? null : $this->input->post('id');
		$add_perusahaan = $this->input->post('add_perusahaan') == "" ? null : $this->input->post('add_perusahaan');
		$who_created = $this->input->post('who_created') == "" ? null : $this->input->post('who_created');
		// echo $default_pembayaran . $who_created;
		$data = $this->M_PenyelesaianKasbon->getDataPermintaanPengeluaran($add_perusahaan, $who_created);

		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getAllDataPenyelesaianKasbon()
	{
		$data = $this->M_PenyelesaianKasbon->getAllDataPenyelesaianKasbon();
		Header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function getSubTotal()
	{
		$id = $this->input->post('no') == "" ? null : $this->input->post('no');
		$add_perusahaan = $this->input->post('add_perusahaan') == "" ? null : $this->input->post('add_perusahaan');
		$who_created = $this->input->post('who_created') == "" ? null : $this->input->post('who_created');
		// echo $default_pembayaran . $who_created;
		$data = $this->M_PenyelesaianKasbon->getSubTotal($id, $add_perusahaan, $who_created);

		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}

	public function GetAnggaranDetail2ByYear()
	{
		$data = $this->M_PenyelesaianKasbon->GetAnggaranDetail2ByYear();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function getDataPemohon()
	{
		$pt = $this->input->post("add_perusahaan");
		$data = $this->M_PenyelesaianKasbon->GetPengajuanDanaWhoCreate($pt);
		echo json_encode($data);
	}

	public function SavePenyelesaianKasbon()
	{
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BBK';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PenyelesaianKasbon->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$penyelesaian_kasbon_id = $this->M_Vrbl->Get_NewID();
		$penyelesaian_kasbon_id = $penyelesaian_kasbon_id[0]['NEW_ID'];

		$penyelesaian_kasbon_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$client_wms_id = $this->input->post('perusahaan');
		$add_keterangan = $this->input->post('add_keterangan');
		$nm_penyelesaian = $this->input->post('nm_penyelesaian');
		$no_transaksi = $this->input->post('no_transaksi');
		$pengejuan_dana_id = $this->input->post('pengejuan_dana_id');
		$is_name_file = $this->input->post('is_name_file');
		$value_kasbon = $this->input->post('value_kasbon');
		$total_pengeluaran_dana = $this->input->post('total_pengeluaran_dana');
		$total_penyelesaian_kasbon = $this->input->post('total_penyelesaian_kasbon');
		$penyelesaian_kasbon_nama = $this->input->post('add_nama_penyelesaian');
		$pengajuan_dana_id = "";
		$kosong = "";

		$dataPermintaan = json_decode($this->input->post('dataPermintaan')); //onject
		$name_file = "";
		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PenyelesaianKasbon/";
			$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $penyelesaian_kasbon_kode);
			$name_file = $name_file . '.' . $fileExtension;
			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
			$data = $this->M_PenyelesaianKasbon->SavePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$pengajuan_dana_id,
				$no_transaksi,
				$penyelesaian_kasbon_kode,
				$depo_id,
				$client_wms_id,
				$kosong,
				$kosong,
				$add_keterangan,
				$name_file,
				'Draft',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$kosong,
				$penyelesaian_kasbon_nama
			);
			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file,
					'value_kasbon' => $value_kasbon,
					'no_transaksi' => $no_transaksi
				);
			} else {
				$this->load->helper("file");
				delete_files($uploadPath);
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id
				);
			}
		} else {
			$data = $this->M_PenyelesaianKasbon->SavePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$pengajuan_dana_id,
				$no_transaksi,
				$penyelesaian_kasbon_kode,
				$depo_id,
				$client_wms_id,
				$kosong,
				$kosong,
				$add_keterangan,
				$kosong,
				'Draft',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$kosong,
				$penyelesaian_kasbon_nama
			);

			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file,
					'value_kasbon' => $value_kasbon,
					'no_transaksi' => $no_transaksi
				);
			} else {
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
				);
			}
		}
		echo json_encode($response);
	}

	public function UpdatePenyelesaianKasbon()
	{
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BBK';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PenyelesaianKasbon->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;

		$penyelesaian_kasbon_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$client_wms_id = $this->input->post('perusahaan');
		$add_keterangan = $this->input->post('keterangan');
		$nm_penyelesaian = $this->input->post('nm_penyelesaian');
		$no_transaksi = $this->input->post('no_transaksi');
		$pengejuan_dana_id = $this->input->post('pengejuan_dana_id');
		$name_filepost = $this->input->post('name_file');
		$value_kasbon = $this->input->post('value_kasbon');
		$total_pengeluaran_dana = $this->input->post('total_pengeluaran_dana');
		$total_penyelesaian_kasbon = $this->input->post('total_penyelesaian_kasbon');
		$penyelesaian_kasbon_nama = $this->input->post('penyelesaian_kasbon_nama');
		$penyelesaian_kasbon_id = $this->input->post('penyelesaian_kasbon_id');
		$type = $this->input->post('type_kasbon');
		$pengajuan_dana_id = "";
		$kosong = "";

		$dataPermintaan = json_decode($this->input->post('dataPermintaan')); //onject
		$name_file = "";
		$this->M_PenyelesaianKasbon->DeletePenyelesaianKasbonDetail($penyelesaian_kasbon_id);
		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PenyelesaianKasbon/";
			$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $penyelesaian_kasbon_kode);
			$name_file = $name_file . '.' . $fileExtension;
			if ($name_filepost != '') {
				unlink('assets/uploads/files/PenyelesaianKasbon/' . $name_filepost);
			}

			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
			$data = $this->M_PenyelesaianKasbon->UpdatePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$add_keterangan,
				$name_file,
				'Draft',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$type
			);
			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file
				);
			} else {
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id
				);
			}
		} else {
			$data = $this->M_PenyelesaianKasbon->UpdatePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$add_keterangan,
				$name_file,
				'Draft',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$type
			);

			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file
				);
			} else {
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0
				);
			}
		}
		echo json_encode($response);
	}

	public function KonfirmasiPenyelesaianKasbon()
	{
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BBK';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PenyelesaianKasbon->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;

		$penyelesaian_kasbon_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$client_wms_id = $this->input->post('perusahaan');
		$add_keterangan = $this->input->post('keterangan');
		$nm_penyelesaian = $this->input->post('nm_penyelesaian');
		$no_transaksi = $this->input->post('no_transaksi');
		$pengejuan_dana_id = $this->input->post('pengejuan_dana_id');
		$name_filepost = $this->input->post('name_file');
		$value_kasbon = $this->input->post('value_kasbon');
		$total_pengeluaran_dana = $this->input->post('total_pengeluaran_dana');
		$total_penyelesaian_kasbon = $this->input->post('total_penyelesaian_kasbon');
		$penyelesaian_kasbon_nama = $this->input->post('penyelesaian_kasbon_nama');
		$penyelesaian_kasbon_id = $this->input->post('penyelesaian_kasbon_id');
		$type = $this->input->post('type_kasbon');
		$pengajuan_dana_id = "";
		$kosong = "";

		$dataPermintaan = json_decode($this->input->post('dataPermintaan')); //onject
		$name_file = "";
		$this->M_PenyelesaianKasbon->DeletePenyelesaianKasbonDetail($penyelesaian_kasbon_id);
		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PenyelesaianKasbon/";
			$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $penyelesaian_kasbon_kode);
			$name_file = $name_file . '.' . $fileExtension;
			if ($name_filepost != '') {
				unlink('assets/uploads/files/PenyelesaianKasbon/' . $name_filepost);
			}

			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
			$data = $this->M_PenyelesaianKasbon->UpdatePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$add_keterangan,
				$name_file,
				'Completed',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$type
			);
			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file
				);
			} else {
				$this->load->helper("file");
				delete_files($uploadPath);
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id
				);
			}
		} else {
			$data = $this->M_PenyelesaianKasbon->UpdatePenyelesaianKasbon(
				$penyelesaian_kasbon_id,
				$add_keterangan,
				$name_file,
				'Completed',
				$value_kasbon,
				$total_pengeluaran_dana,
				$total_penyelesaian_kasbon,
				$dataPermintaan,
				$type
			);

			if ($data == 1) {
				$response = array(
					'message' => 'success',
					'status' =>  1,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
					'name_file' => $name_file
				);
			} else {
				$response = array(
					'message' => 'Failed create data !!',
					'status' =>  0,
					'penyelesaian_kasbon_id' => $penyelesaian_kasbon_id,
				);
			}
		}
		echo json_encode($response);
	}

	public function ViewAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PenyelesaianKasbon/";
		$data   = file_get_contents($directory . $name_file);
		header('Content-Type: application/pdf');
		echo $data;
		// force_download($name_file, $data);
	}
	public function downloadAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PenyelesaianKasbon/";
		$data   = file_get_contents($directory . $name_file);
		force_download($name_file, $data);
	}
}
