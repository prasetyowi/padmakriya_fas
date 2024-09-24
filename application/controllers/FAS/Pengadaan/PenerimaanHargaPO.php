<?php

require_once APPPATH . 'core/ParentController.php';

class PenerimaanHargaPO extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		// echo "<pre>".print_r($_SESSION, 1)."</pre>";
		// die();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage'));
		endif;

		// $this->MenuKode = "218008000";
		$this->MenuKode = "218005004";
		$this->load->model('FAS/M_PenerimaanHargaPO', 'M_PenerimaanHargaPO');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->library('pdfgenerator');
	}

	public function PenerimaanHargaPOMenu()
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

		$data['Perusahaan'] = $this->M_PenerimaanHargaPO->GetPerusahaanOld();
		$data['Divisi'] = $this->M_PenerimaanHargaPO->GetDivisi();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		// $this->load->view('FAS/Pengadaan/PenerimaanHargaPO/index', $data);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/S_PenerimaanHargaPO', $data);
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
		$data['Perusahaan'] = $this->M_PenerimaanHargaPO->GetPerusahaanOld();
		$data['Gudang'] = $this->M_PenerimaanHargaPO->GetGudang();
		$data['Divisi'] = $this->M_PenerimaanHargaPO->GetDivisi();
		$data['TipePengadaan'] = $this->M_PenerimaanHargaPO->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PenerimaanHargaPO->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PenerimaanHargaPO->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PenerimaanHargaPO->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PenerimaanHargaPO->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PenerimaanHargaPO->GetKodePo();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		// $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/add', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/S_PenerimaanHargaPO', $data);
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

		$purchase_order_id = $this->input->get('id');
		$penerimaan_id = $this->input->get('pnid');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['purchase_order_id'] = $purchase_order_id;
		$data['penerimaan_id'] = $penerimaan_id;
		$data['PNHeader'] = $this->M_PenerimaanHargaPO->GetDataDetailByKodePoDetail($purchase_order_id, $penerimaan_id);
		$data['PNDetailOld'] = $this->M_PenerimaanHargaPO->GetPurchaseRequestDetailById($purchase_order_id);
		$data['PNDetail'] = $this->M_PenerimaanHargaPO->GetPurchaseRequestDetailByIdEdit($purchase_order_id, $penerimaan_id);
		// 
		$data['Perusahaan'] = $this->M_PenerimaanHargaPO->GetPerusahaanOld();
		$data['Gudang'] = $this->M_PenerimaanHargaPO->GetGudang();
		$data['Divisi'] = $this->M_PenerimaanHargaPO->GetDivisi();
		$data['TipePengadaan'] = $this->M_PenerimaanHargaPO->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PenerimaanHargaPO->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PenerimaanHargaPO->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PenerimaanHargaPO->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PenerimaanHargaPO->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PenerimaanHargaPO->GetKodePoAllPenerimaan();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/S_PenerimaanHargaPO', $data);
	}

	public function view()
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

		$purchase_order_id = $this->input->get('id');
		$penerimaan_id = $this->input->get('pnid');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['purchase_order_id'] = $purchase_order_id;
		$data['penerimaan_id'] = $penerimaan_id;
		$data['PNHeader'] = $this->M_PenerimaanHargaPO->GetDataDetailByKodePoDetail($purchase_order_id, $penerimaan_id);
		// $data['PNDetail'] = $this->M_PenerimaanHargaPO->GetPurchaseRequestDetailByIdPenerimaanBarang($purchase_order_id, $penerimaan_id);
		$data['PNDetail'] = $this->M_PenerimaanHargaPO->GetPurchaseRequestDetailByIdEdit($purchase_order_id, $penerimaan_id);
		$data['Perusahaan'] = $this->M_PenerimaanHargaPO->GetPerusahaan();
		$data['Gudang'] = $this->M_PenerimaanHargaPO->GetGudang();
		$data['Divisi'] = $this->M_PenerimaanHargaPO->GetDivisi();
		$data['TipePengadaan'] = $this->M_PenerimaanHargaPO->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PenerimaanHargaPO->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PenerimaanHargaPO->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PenerimaanHargaPO->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PenerimaanHargaPO->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_PenerimaanHargaPO->GetKodePoAllPenerimaan();
		$data['act'] = "detail";
		$data['Perusahaan'] = $this->M_PenerimaanHargaPO->GetPerusahaanOld();
		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanHargaPO/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseOrder/S_PurchaseOrder', $data);
	}
	public function GetDataDetailByKodePo()
	{
		$penerimaan_id = $this->input->post('penerimaan_id');

		$data = $this->M_PenerimaanHargaPO->GetDataDetailByKodePo($penerimaan_id);

		echo json_encode($data);
	}
	public function GetPurchaseRequestDetailById()
	{
		$penerimaan_id = $this->input->post('penerimaan_id');
		$data = $this->M_PenerimaanHargaPO->GetPurchaseRequestDetailById($penerimaan_id);
		echo json_encode($data);
	}

	public function update_harga_penerimaan_sku_barang_detail()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$gudang_id = $this->input->post('gudang_id');
		$depo_id = $this->session->userdata('depo_id');
		$penerimaan_id = $this->input->post('pn_id');
		$arr_detail = $this->input->post('detail');
		$status = $this->input->post('status');
		// $penerimaan_sku_barang_id = $this->M_Vrbl->Get_NewID();
		// $penerimaan_sku_barang_id = $penerimaan_sku_barang_id[0]['NEW_ID'];
		$penerimaan_sku_barang_flag_konfirmasi_harga = '';
		$type = $this->input->post('type');
		if ($type == '1' || $type == 1) {
			$penerimaan_sku_barang_flag_konfirmasi_harga = 1;
		} else {
			$penerimaan_sku_barang_flag_konfirmasi_harga = 0;
		}


		$this->db->trans_begin();
		foreach ($arr_detail as $key => $value) {
			$this->M_PenerimaanHargaPO->update_harga_penerimaan_sku_barang($penerimaan_id, $penerimaan_sku_barang_flag_konfirmasi_harga, $status);
			$this->M_PenerimaanHargaPO->update_harga_penerimaan_sku_barang_detail($penerimaan_id, $value);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function search_penerimaan_by_filter()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$kode = $this->input->post('kode');
		$status = $this->input->post('status');
		$divisi = $this->input->post('divisi');


		$data = $this->M_PenerimaanHargaPO->search_penerimaan_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $divisi);

		echo json_encode($data);
	}
}
