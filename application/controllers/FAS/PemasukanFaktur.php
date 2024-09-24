<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class PemasukanFaktur extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage'));
		endif;

		$this->load->model('M_Menu');
		$this->load->model('FAS/M_PemasukanFaktur', 'M_PemasukanFaktur');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');

		$this->depo_id = $this->session->userdata('depo_id');
		$this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
		$this->MenuKode = "210003000";
	}

	public function PemasukanFakturMenu()
	{
		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");
		$data['act'] = "";

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);
		$data['Perusahaan'] = $this->M_PemasukanFaktur->GetPerusahaanOld();
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}



		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] =  $this->session->userdata('pengguna_username');

		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Hutang/PemasukanFaktur/PemasukanFakturMenu', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Hutang/PemasukanFaktur/S_PemasukanFaktur', $data);
	}
	public function create()
	{
		$this->load->model('M_Menu');

		$data = array();

		$data = array();
		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage'));
			exit();
		}

		if (!$this->session->has_userdata('pengguna_id')) {
			redirect(base_url('MainPage'));
		}

		if (!$this->session->has_userdata('depo_id')) {
			redirect(base_url('Main/MainDepo/DepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$query['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$query['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$query['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();

		$pr_id = $this->M_Vrbl->Get_NewID();
		$pr_id = $pr_id[0]['NEW_ID'];

		// $data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['pr_id'] = $pr_id;
		$data['Perusahaan'] = $this->M_PemasukanFaktur->GetPerusahaanOld();
		$data['Gudang'] = $this->M_PemasukanFaktur->GetGudang();
		$data['Divisi'] = $this->M_PemasukanFaktur->GetDivisi();
		$data['TipePengadaan'] = $this->M_PemasukanFaktur->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PemasukanFaktur->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PemasukanFaktur->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PemasukanFaktur->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PemasukanFaktur->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PemasukanFaktur->GetKodePo();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		// $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Hutang/PemasukanFaktur/add', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Hutang/PemasukanFaktur/S_PemasukanFaktur', $data);
	}

	public function edit()
	{
		$this->load->model('M_Menu');

		$data = array();

		$data = array();
		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage'));
			exit();
		}

		if (!$this->session->has_userdata('pengguna_id')) {
			redirect(base_url('MainPage'));
		}

		if (!$this->session->has_userdata('depo_id')) {
			redirect(base_url('Main/MainDepo/DepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$query['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$query['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$query['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$kf = $this->input->get('id');
		$idbarangjasa = $this->input->get('idbarangjasa');
		$typeid = $this->input->get('typeid');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['konfirmasi_hutang_id'] = $kf;
		$data['typeid'] = $typeid;
		$data['idbarangjasa'] = $idbarangjasa;
		$data['PNHeader'] = $this->M_PemasukanFaktur->GetDataDetailByKodePoDetail($kf, $idbarangjasa, $typeid);
		// $data['PNDetailOld'] = $this->M_PemasukanFaktur->GetPurchaseRequestDetailById($purchase_order_id);
		$data['PNDetail'] = $this->M_PemasukanFaktur->GetDetailTableByIdKodeArray($kf, $typeid);
		// echo json_encode($data['PNDetail']);
		// die;
		// 
		$data['Perusahaan'] = $this->M_PemasukanFaktur->GetPerusahaanOld();
		$data['Gudang'] = $this->M_PemasukanFaktur->GetGudang();
		$data['Divisi'] = $this->M_PemasukanFaktur->GetDivisi();
		$data['TipePengadaan'] = $this->M_PemasukanFaktur->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PemasukanFaktur->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PemasukanFaktur->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PemasukanFaktur->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PemasukanFaktur->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PemasukanFaktur->GetKodePoAll();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Hutang/PemasukanFaktur/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Hutang/PemasukanFaktur/S_PemasukanFaktur', $data);
	}

	public function detail()
	{
		$this->load->model('M_Menu');

		$data = array();

		$data = array();
		// $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		// if ($data['Menu_Access']['R'] != 1) {
		// 	redirect(base_url('MainPage'));
		// 	exit();
		// }

		if (!$this->session->has_userdata('pengguna_id')) {
			redirect(base_url('MainPage'));
		}

		if (!$this->session->has_userdata('depo_id')) {
			redirect(base_url('Main/MainDepo/DepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$query['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
		);

		$query['js_files'] = array(
			Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
			Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
			Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$query['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$kf = $this->input->get('id');
		$idbarangjasa = $this->input->get('idbarangjasa');
		$typeid = $this->input->get('typeid');
		$data['konfirmasi_hutang_id'] = $kf;
		$data['typeid'] = $typeid;
		$data['idbarangjasa'] = $idbarangjasa;
		$data['PNHeader'] = $this->M_PemasukanFaktur->GetDataDetailByKodePoDetail($kf, $idbarangjasa, $typeid);
		// $data['PNDetailOld'] = $this->M_PemasukanFaktur->GetPurchaseRequestDetailById($purchase_order_id);
		$data['PNDetail'] = $this->M_PemasukanFaktur->GetDetailTableByIdKodeArray($kf, $typeid);
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");


		$data['Perusahaan'] = $this->M_PemasukanFaktur->GetPerusahaanOld();
		$data['Gudang'] = $this->M_PemasukanFaktur->GetGudang();
		$data['Divisi'] = $this->M_PemasukanFaktur->GetDivisi();
		$data['TipePengadaan'] = $this->M_PemasukanFaktur->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PemasukanFaktur->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PemasukanFaktur->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PemasukanFaktur->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PemasukanFaktur->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PemasukanFaktur->GetKodePoAll();
		$data['act'] = "detail";
		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Hutang/PemasukanFaktur/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseOrder/S_PurchaseOrder', $data);
	}
	public function search_hutang_by_filter()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$kode = $this->input->post('kode');
		$status = $this->input->post('status');
		$divisi = $this->input->post('divisi');


		$data = $this->M_PemasukanFaktur->search_penerimaan_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $divisi);

		echo json_encode($data);
	}
	public function GetKodePenerimaanInFaktur()
	{
		$data = $this->M_PemasukanFaktur->GetKodePenerimaanInFaktur();
		echo json_encode($data);
	}
	public function GetKodePenerimaan()
	{
		$data = $this->M_PemasukanFaktur->GetKodePenerimaan();
		echo json_encode($data);
	}
	public function GetKodeKonfirmasi()
	{
		$data = $this->M_PemasukanFaktur->GetKodeKonfirmasi();
		echo json_encode($data);
	}
	public function GetDetailDataByKodePO()
	{
		$id = $this->input->post('id');
		$type = $this->input->post('type');

		$data = $this->M_PemasukanFaktur->getDetailByKodeSelected($id, $type);
		echo json_encode($data);
	}
	public function GetDetailTableByIdKode()
	{
		$pemasukan_id = $this->input->post('pemasukan_id');
		$type = $this->input->post('type');
		$data = $this->M_PemasukanFaktur->GetDetailTableByIdKode($pemasukan_id, $type);
		echo json_encode($data);
	}
	public function ViewAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PemasukanFaktur/";
		$data   = file_get_contents($directory . $name_file);
		header('Content-Type: application/pdf');
		echo $data;
		// force_download($name_file, $data);
	}

	public function save_pemasukan_faktur()
	{

		$typepo = $this->input->post('typepo');
		$hpf_id = $this->input->post('hpf_id');
		$penerimaan_sku_barang_id = '';
		$konfirmasi_jasa_id = '';
		$konfirmasi_hutang_tgl_create = '';
		$konfirmasi_hutang_who_create = '';
		if ($typepo == 1 || $typepo == '1') {
			//pobarang
			$penerimaan_sku_barang_id = $hpf_id;
		}
		if ($typepo == 2 || $typepo == '2') {
			//pojasa
			$konfirmasi_jasa_id = $hpf_id;
		}

		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$pemasukanfaktur_tgl = $this->input->post('pemasukanfaktur_tgl');
		$pemasukanfaktur_status = $this->input->post('pemasukanfaktur_status');
		$pemasukanfaktur_keterangan = $this->input->post('pemasukanfaktur_keterangan');
		$detail = json_decode($this->input->post('detail'));

		$konfirmasi_hutang_id = $this->M_Vrbl->Get_NewID();
		$konfirmasi_hutang_id = $konfirmasi_hutang_id[0]['NEW_ID'];
		$name_file = '';

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_INV';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PemasukanFaktur->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$konfirmasi_hutang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = 'APPRV_INV_01';

		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PemasukanFaktur/";
			// $fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $konfirmasi_hutang_kode);
			$name_file = $name_file . '.' . $fileExtension;

			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
		}
		$this->db->trans_begin();
		$this->M_PemasukanFaktur->insert_pemasukan_faktur($konfirmasi_hutang_id, $konfirmasi_hutang_kode, $penerimaan_sku_barang_id, $konfirmasi_jasa_id, $client_wms_id, $pemasukanfaktur_status, $konfirmasi_hutang_tgl_create, $konfirmasi_hutang_who_create, $pemasukanfaktur_keterangan, $name_file, '', '');

		foreach ($detail as $key => $value) {
			$this->M_PemasukanFaktur->insert_pemasukan_faktur_detail($konfirmasi_hutang_id, $value);
		}

		if ($pemasukanfaktur_status == "In Progress Approval") {
			$this->M_PemasukanFaktur->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $konfirmasi_hutang_id, $konfirmasi_hutang_kode, 0, 0);
		}
		$res = $this->M_PemasukanFaktur->getDataByKonfirmasi($konfirmasi_hutang_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode([
				'respon' => 0,
			]);
		} else {
			$this->db->trans_commit();
			echo json_encode([
				'respon' => 1,
				'konfirmasi_hutang_attachment_1' => $res->konfirmasi_hutang_attachment_1,
				'konfirmasi_hutang_id' => $konfirmasi_hutang_id,
				'purchase_request_id' => $res->purchase_request_id,
				'purchase_order_id' => $res->purchase_order_id,
			]);
		}
	}

	public function update_pemasukan_faktur()
	{
		$typepo = $this->input->post('typepo');
		$hpf_id = $this->input->post('hpf_id');
		$penerimaan_sku_barang_id = '';
		$konfirmasi_jasa_id = '';
		$konfirmasi_hutang_tgl_create = '';
		$konfirmasi_hutang_who_create = '';
		if ($typepo == 1 || $typepo == '1') {
			//pobarang
			$penerimaan_sku_barang_id = $hpf_id;
		}
		if ($typepo == 2 || $typepo == '2') {
			//pojasa
			$konfirmasi_jasa_id = $hpf_id;
		}

		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$pemasukanfaktur_tgl = $this->input->post('pemasukanfaktur_tgl');
		$pemasukanfaktur_status = $this->input->post('pemasukanfaktur_status');
		$pemasukanfaktur_keterangan = $this->input->post('pemasukanfaktur_keterangan');
		$name_filepost = $this->input->post('name_file');

		$detail = json_decode($this->input->post('detail'));

		// $konfirmasi_hutang_id = $this->M_Vrbl->Get_NewID();
		// $konfirmasi_hutang_id = $konfirmasi_hutang_id[0]['NEW_ID'];
		$konfirmasi_hutang_id = $this->input->post('konfirmasi_hutang_id');
		$name_file = '';

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_INV';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PemasukanFaktur->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$konfirmasi_hutang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = 'APPRV_INV_01';

		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PemasukanFaktur/";
			// $fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $konfirmasi_hutang_kode);
			$name_file = $name_file . '.' . $fileExtension;

			if ($name_filepost != '') {
				unlink('assets/uploads/files/PemasukanFaktur/' . $name_filepost);
			}
			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
		}
		$this->db->trans_begin();
		$this->M_PemasukanFaktur->update_pemasukan_faktur($konfirmasi_hutang_id, $pemasukanfaktur_status);
		$this->M_PemasukanFaktur->delete_pemasukan_faktur_detail($konfirmasi_hutang_id);

		foreach ($detail as $key => $value) {
			$this->M_PemasukanFaktur->insert_pemasukan_faktur_detail($konfirmasi_hutang_id, $value);
		}

		// if ($pemasukanfaktur_status == "In Progress Approval") {
		// 	$this->M_PemasukanFaktur->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $konfirmasi_hutang_id, $konfirmasi_hutang_kode, 0, 0);
		// }
		$res = $this->M_PemasukanFaktur->getDataByKonfirmasi($konfirmasi_hutang_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode([
				'respon' => 0,
			]);
		} else {
			$this->db->trans_commit();
			echo json_encode([
				'respon' => 1,
				'konfirmasi_hutang_attachment_1' => $res->konfirmasi_hutang_attachment_1,
				'konfirmasi_hutang_id' => $konfirmasi_hutang_id,
				'purchase_request_id' => $res->purchase_request_id,
				'purchase_order_id' => $res->purchase_order_id,
			]);
		}
	}
	public function konfirmasi_update_pemasukan_faktur()
	{
		$typepo = $this->input->post('typepo');
		$hpf_id = $this->input->post('hpf_id');
		$penerimaan_sku_barang_id = '';
		$konfirmasi_jasa_id = '';
		$konfirmasi_hutang_tgl_create = '';
		$konfirmasi_hutang_who_create = '';
		if ($typepo == 1 || $typepo == '1') {
			//pobarang
			$penerimaan_sku_barang_id = $hpf_id;
		}
		if ($typepo == 2 || $typepo == '2') {
			//pojasa
			$konfirmasi_jasa_id = $hpf_id;
		}

		$purchase_request_id = $this->input->post('purchase_request_id');
		$po_kode = $this->input->post('po_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$pemasukanfaktur_tgl = $this->input->post('pemasukanfaktur_tgl');
		$pemasukanfaktur_tgl_dibutuhkan = $this->input->post('pemasukanfaktur_tgl_dibutuhkan');
		$pemasukanfaktur_status = $this->input->post('pemasukanfaktur_status');
		$pemasukanfaktur_keterangan = $this->input->post('pemasukanfaktur_keterangan');
		$name_filepost = $this->input->post('name_file');

		$detail = json_decode($this->input->post('detail'));

		// $konfirmasi_hutang_id = $this->M_Vrbl->Get_NewID();
		// $konfirmasi_hutang_id = $konfirmasi_hutang_id[0]['NEW_ID'];
		$konfirmasi_hutang_id = $this->input->post('konfirmasi_hutang_id');
		$name_file = '';

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_INV';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PemasukanFaktur->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$konfirmasi_hutang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = 'APPRV_INV_01';

		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PemasukanFaktur/";
			// $fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $konfirmasi_hutang_kode);
			$name_file = $name_file . '.' . $fileExtension;

			if ($name_filepost != '') {
				unlink('assets/uploads/files/PemasukanFaktur/' . $name_filepost);
			}
			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
		}
		$data_subtotal = $this->M_PemasukanFaktur->GetSubTotalDetailHarga($konfirmasi_hutang_id);
		$totalvalue = $data_subtotal->subtotal;
		$this->db->trans_begin();
		$this->M_PemasukanFaktur->update_pemasukan_faktur($konfirmasi_hutang_id, $pemasukanfaktur_status);
		$this->M_PemasukanFaktur->delete_pemasukan_faktur_detail($konfirmasi_hutang_id);

		foreach ($detail as $key => $value) {
			$this->M_PemasukanFaktur->insert_pemasukan_faktur_detail($konfirmasi_hutang_id, $value);
		}

		if ($pemasukanfaktur_status == "In Progress Approval") {
			$this->M_PemasukanFaktur->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $konfirmasi_hutang_id, $konfirmasi_hutang_kode, 0, 0);
		}

		$this->SavePengajuanDana($client_wms_id, $depo_id, $tipe_pengadaan_id, null, $pemasukanfaktur_tgl, $pemasukanfaktur_tgl_dibutuhkan, $purchase_request_id, $po_kode, $konfirmasi_hutang_id);
		$res = $this->M_PemasukanFaktur->getDataByKonfirmasi($konfirmasi_hutang_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode([
				'respon' => 0,
			]);
		} else {
			$this->db->trans_commit();
			echo json_encode([
				'respon' => 1,
				// 'konfirmasi_hutang_attachment_1' => $res->konfirmasi_hutang_attachment_1
			]);
		}
	}
	public function SavePengajuanDana($client_wms_id, $depo_id, $tipe_pengadaan_id, $tipe_transaksi_id, $penerimaan_order_tgl, $penerimaan_order_tgl_dibutuhkan, $purchase_request_id, $po_kode, $konfirmasi_hutang_id)
	{

		$po_id = $po_kode;
		$data_pr = $this->M_PemasukanFaktur->GetDataPR($purchase_request_id);
		$data_po = $this->M_PemasukanFaktur->GetDataPO($po_id);
		$data_subtotal = $this->M_PemasukanFaktur->GetSubTotalDetailHarga($konfirmasi_hutang_id);


		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_PPD';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PemasukanFaktur->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$pengajuan_dana_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$kategori_biaya_id = $data_pr->kategori_biaya_id;
		$tipe_biaya_id = $data_pr->tipe_biaya_id;
		$pengajuan_dana_status = 'Approved';
		$pengajuan_dana_judul = $data_pr->pengajuan_dana_judul;
		$pengajuan_dana_keterangan = '';
		$pengajuan_dana_tgl_pengajuan = $penerimaan_order_tgl;
		$pengajuan_dana_tgl_dibutuhkan = $penerimaan_order_tgl_dibutuhkan;
		$pengajuan_dana_value = $data_subtotal->subtotal;
		$pengajuan_dana_default_pembayaran = $data_pr->pengajuan_dana_default_pembayaran;
		$bank_account_id = $data_pr->bank_account_id;
		$pengajuan_dana_nama_penerima = $data_pr->pengajuan_dana_penerima;
		$pengajuan_dana_rekening_penerima = $data_pr->pengajuan_dana_rekening_penerima;
		$anggaran_detail_2_id = $data_pr->anggaran_detail_2_id;
		$perusahaan = $client_wms_id;
		$tipe_transaksi = $tipe_transaksi_id;
		$no_doc_po = $data_po->purchase_order_kode;
		$jenis_asset = null;
		$jenis_pengadaan = $tipe_pengadaan_id;
		$konfirmasi_hutang_id = $konfirmasi_hutang_id;
		$data = $this->M_PemasukanFaktur->SavePengajuanDana(
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
			$jenis_pengadaan,
			$konfirmasi_hutang_id
		);


		// echo json_encode($response);

	}
}
