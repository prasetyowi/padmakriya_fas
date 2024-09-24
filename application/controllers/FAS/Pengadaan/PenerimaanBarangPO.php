<?php

use Mpdf\Tag\Em;

require_once APPPATH . 'core/ParentController.php';

class PenerimaanBarangPO extends ParentController
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

		$this->MenuKode = "218005000";
		$this->load->model('FAS/M_PurchaseRequest', 'M_PurchaseRequest');
		$this->load->model('FAS/M_PurchaseOrder', 'M_PurchaseOrder');
		$this->load->model('FAS/M_Principle', 'M_Principle');
		$this->load->model('FAS/M_Penerimaan', 'M_Penerimaan');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->library('pdfgenerator');
	}

	public function PenerimaanBarangPOMenu()
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

		$data['Perusahaan'] = $this->M_Penerimaan->GetPerusahaanOld();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		// $this->load->view('FAS/Pengadaan/PurchaseOrder/index', $data);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/S_Penerimaan', $data);
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
		$data['Perusahaan'] = $this->M_Penerimaan->GetPerusahaanOld();
		$data['Gudang'] = $this->M_Penerimaan->GetGudang();
		$data['Divisi'] = $this->M_Penerimaan->GetDivisi();
		$data['TipePengadaan'] = $this->M_Penerimaan->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_Penerimaan->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_Penerimaan->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_Penerimaan->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_Penerimaan->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_Penerimaan->GetKodePo();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		// $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/add', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/S_Penerimaan', $data);
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
		$data['PNHeader'] = $this->M_Penerimaan->GetDataDetailByKodePoDetail($purchase_order_id, $penerimaan_id);
		$data['PNDetailOld'] = $this->M_Penerimaan->GetPurchaseRequestDetailById($purchase_order_id);
		$data['PNDetail'] = $this->M_Penerimaan->GetPurchaseRequestDetailByIdEdit($purchase_order_id, $penerimaan_id);
		// 
		$data['Perusahaan'] = $this->M_Penerimaan->GetPerusahaanOld();
		$data['Gudang'] = $this->M_Penerimaan->GetGudang();
		$data['Divisi'] = $this->M_Penerimaan->GetDivisi();
		$data['TipePengadaan'] = $this->M_Penerimaan->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_Penerimaan->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_Penerimaan->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_Penerimaan->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_Penerimaan->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_Penerimaan->GetKodePoAll();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/S_Penerimaan', $data);
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
		$data['PNHeader'] = $this->M_Penerimaan->GetDataDetailByKodePoDetail($purchase_order_id, $penerimaan_id);
		// $data['PNDetail'] = $this->M_Penerimaan->GetPurchaseRequestDetailByIdPenerimaanBarang($purchase_order_id, $penerimaan_id);
		$data['PNDetail'] = $this->M_Penerimaan->GetPurchaseRequestDetailByIdEdit($purchase_order_id, $penerimaan_id);
		$data['Perusahaan'] = $this->M_Penerimaan->GetPerusahaan();
		$data['Gudang'] = $this->M_Penerimaan->GetGudang();
		$data['Divisi'] = $this->M_Penerimaan->GetDivisi();
		$data['TipePengadaan'] = $this->M_Penerimaan->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_Penerimaan->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_Penerimaan->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_Penerimaan->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_Penerimaan->GetTipeKepemilikan();
		$data['KodePo'] = $this->M_Penerimaan->GetKodePoAll();
		$data['act'] = "detail";
		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PenerimaanBarangPO/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseOrder/S_PurchaseOrder', $data);
	}


	public function CetakPdf()
	{
		$this->load->library('pdfgenerator');

		$id = $this->input->get('id');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['pr_id'] = $id;
		$data['PRHeader'] = $this->M_PurchaseOrder->GetPurchaseRequestHeaderById($id);
		$data['PRDetail'] = $this->M_PurchaseOrder->GetPurchaseRequestDetailById($id);
		$data['Perusahaan'] = $this->M_PurchaseOrder->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseOrder->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseOrder->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseOrder->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseOrder->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseOrder->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseOrder->GetTipeKepemilikan();
		$data['act'] = "detail";

		// title dari pdf
		$data['title_pdf'] = 'Purchase Order';

		// filename dari pdf ketika didownload
		$file_pdf = 'Penjualan';
		// setting paper
		// $paper = 'A3';
		$paper = array(0, 0, 1000, 500);
		//orientasi paper potrait / landscape
		$orientation = "landscape";

		$html = $this->load->view('FAS/Pengadaan/PurchaseOrder/print', $data, true);

		// run dompdf
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
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


		$data = $this->M_Penerimaan->search_penerimaan_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $divisi);

		echo json_encode($data);
	}

	public function GetDataDetailByKodePo()
	{
		$purchase_order_id = $this->input->post('purchase_order_id');

		$data = $this->M_Penerimaan->GetDataDetailByKodePo($purchase_order_id);

		echo json_encode($data);
	}

	public function GetPurchaseRequestDetailById()
	{
		$po_id = $this->input->post('po_id');

		$data = $this->M_Penerimaan->GetPurchaseRequestDetailById($po_id);

		echo json_encode($data);
	}

	public function insert_penerimaan_barangpo()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$gudang_id = $this->input->post('gudang_id');
		$depo_id = $this->session->userdata('depo_id');
		$purchase_order_id = $this->input->post('po_id');
		$arr_detail = $this->input->post('detail');
		$penerimaan_sku_barang_id = $this->M_Vrbl->Get_NewID();
		$penerimaan_sku_barang_id = $penerimaan_sku_barang_id[0]['NEW_ID'];
		$penerimaan_sku_barang_kode = '';
		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BTBPO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PurchaseRequest->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$penerimaan_sku_barang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$po_status = 'In Progress Receiving';

		$this->db->trans_begin();
		$this->M_Penerimaan->insert_penerimaan_sku_barang($penerimaan_sku_barang_id, $penerimaan_sku_barang_kode, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_status);

		foreach ($arr_detail as $key => $value) {
			$this->M_Penerimaan->insert_penerimaan_sku_barang_detail($penerimaan_sku_barang_id, $value);
			// $this->M_Penerimaan->update_sku_barang_supplier($value);
			$this->M_Penerimaan->update_purchase_order($value, $po_status);
			// $this->M_Penerimaan->update_purchase_order_detail($value);
			// $this->M_Penerimaan->insert_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function update_penerimaan_barangpo()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$gudang_id = $this->input->post('gudang_id');
		$depo_id = $this->session->userdata('depo_id');
		$purchase_order_id = $this->input->post('po_id');
		$penerimaan_id = $this->input->post('penerimaan_id');
		$arr_detail = $this->input->post('detail');
		$countitem = $this->input->post('countitem');
		$arraytempqtysisa = array();
		$type = $this->input->post('type');


		foreach ($arr_detail as $key => $value) {
			array_push($arraytempqtysisa, $value['purchase_order_detail_qty_sisa']);
		}

		if ($type == 'Simpan') {
			$po_status = 'In Progress Receiving';
		}
		if ($type == 'Konfirmasi') {
			if ((array_sum($arraytempqtysisa) == 0) && ((int)$countitem == count($arr_detail))) {
				$po_status = 'Completed';
			} else {
				$po_status = 'Partially Received';
			}
		}

		$this->db->trans_begin();
		$this->M_Penerimaan->update_penerimaan_sku_barang($penerimaan_id, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_status);
		foreach ($arr_detail as $key => $value1) {
			$this->M_Penerimaan->delete_penerimaan_sku_barang_detail($penerimaan_id, $value1);
		}
		foreach ($arr_detail as $key => $value) {
			$this->M_Penerimaan->insert_penerimaan_sku_barang_detail($penerimaan_id, $value);
			$this->M_Penerimaan->update_purchase_order($value, $po_status);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function konfirmasi_update_penerimaan_barangpo()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$gudang_id = $this->input->post('gudang_id');
		$depo_id = $this->session->userdata('depo_id');
		$purchase_order_id = $this->input->post('po_id');
		$purchase_request_id = $this->input->post('pr_id');
		$arr_detail = $this->input->post('detail');
		$countitem = $this->input->post('countitem');
		$penerimaan_sku_barang_id = $this->M_Vrbl->Get_NewID();
		$penerimaan_sku_barang_id = $penerimaan_sku_barang_id[0]['NEW_ID'];
		$penerimaan_sku_barang_kode = '';
		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BTBPO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PurchaseRequest->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$penerimaan_sku_barang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$arraytempqtysisa = array();
		$penerimaan_id = $this->input->post('penerimaan_id');
		foreach ($arr_detail as $key => $value) {
			array_push($arraytempqtysisa, $value['purchase_order_detail_qty_sisa']);
		}
		if ((array_sum($arraytempqtysisa) == 0) && ((int)$countitem == count($arr_detail))) {
			$po_status = 'Completed';
			$po_statuspenerimaan = 'Completed';
		} else {
			$po_status = 'Partially Received';
			$po_statuspenerimaan = 'Completed';
		}


		$this->db->trans_begin();
		// $this->M_Penerimaan->insert_penerimaan_sku_barang($penerimaan_sku_barang_id, $penerimaan_sku_barang_kode, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id);
		$this->M_Penerimaan->update_penerimaan_sku_barang($penerimaan_id, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_statuspenerimaan);
		$this->M_Penerimaan->Exec_proses_stock_barang($penerimaan_id);
		foreach ($arr_detail as $key => $value1) {
			$this->M_Penerimaan->delete_penerimaan_sku_barang_detail($penerimaan_id, $value1);
		}
		foreach ($arr_detail as $key => $value) {
			$this->M_Penerimaan->insert_penerimaan_sku_barang_detail($penerimaan_id, $value);
			$this->M_Penerimaan->update_sku_barang_supplier($value);
			$this->M_Penerimaan->update_purchase_order($value, $po_status);
			$this->M_Penerimaan->update_purchase_order_detail($value);
			$this->M_Penerimaan->update_purchase_request_detail($value, $purchase_request_id);
			$data = $this->M_Penerimaan->cek_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value);
			if (!empty($data)) {
				$this->M_Penerimaan->update_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value, $data);
			} else {
				$this->M_Penerimaan->insert_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value);
			}
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function konfirmasi_penerimaan_barangpo()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$gudang_id = $this->input->post('gudang_id');
		$depo_id = $this->session->userdata('depo_id');
		$purchase_order_id = $this->input->post('po_id');
		$purchase_request_id = $this->input->post('pr_id');
		$arr_detail = $this->input->post('detail');
		$countitem = $this->input->post('countitem');
		$penerimaan_sku_barang_id = $this->M_Vrbl->Get_NewID();
		$penerimaan_sku_barang_id = $penerimaan_sku_barang_id[0]['NEW_ID'];
		$po_kode = $this->input->post('po_kode');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$tipe_transaksi_id = $this->input->post('tipe_transaksi_id');
		$penerimaan_order_tgl = $this->input->post('penerimaan_order_tgl');
		$penerimaan_order_tgl_dibutuhkan = $this->input->post('penerimaan_order_tgl_dibutuhkan');
		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_BTBPO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_Penerimaan->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$penerimaan_sku_barang_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$arraytempqtysisa = array();
		$penerimaan_id = $this->input->post('penerimaan_id');
		foreach ($arr_detail as $key => $value) {
			array_push($arraytempqtysisa, $value['purchase_order_detail_qty_sisa']);
		}
		if ((array_sum($arraytempqtysisa) == 0) && ((int)$countitem == count($arr_detail))) {
			$po_status = 'Completed';
			$po_statuspenerimaan = 'Completed';
		} else {
			$po_status = 'Partially Received';
			$po_statuspenerimaan = 'Completed';
		}

		$this->db->trans_begin();
		$this->M_Penerimaan->insert_penerimaan_sku_barang($penerimaan_sku_barang_id, $penerimaan_sku_barang_kode, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_statuspenerimaan);
		$this->M_Penerimaan->Exec_proses_stock_barang($penerimaan_sku_barang_id);
		foreach ($arr_detail as $key => $value1) {
			$this->M_Penerimaan->delete_penerimaan_sku_barang_detail($penerimaan_id, $value1);
		}
		foreach ($arr_detail as $key => $value) {
			$this->M_Penerimaan->insert_penerimaan_sku_barang_detail($penerimaan_sku_barang_id, $value);
			$this->M_Penerimaan->update_sku_barang_supplier($value);
			$this->M_Penerimaan->update_purchase_order($value, $po_status);
			$this->M_Penerimaan->update_purchase_order_detail($value);
			$this->M_Penerimaan->update_purchase_request_detail($value, $purchase_request_id);
			$data = $this->M_Penerimaan->cek_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value);
			if (!empty($data)) {
				$this->M_Penerimaan->update_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value, $data);
			} else {
				$this->M_Penerimaan->insert_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value);
			}
		}
		// $this->SavePengajuanDana($client_wms_id, $depo_id, $tipe_pengadaan_id, $tipe_transaksi_id, $penerimaan_order_tgl, $penerimaan_order_tgl_dibutuhkan, $purchase_request_id, $po_kode);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function SavePengajuanDana($client_wms_id, $depo_id, $tipe_pengadaan_id, $tipe_transaksi_id, $penerimaan_order_tgl, $penerimaan_order_tgl_dibutuhkan, $purchase_request_id, $po_kode)
	{

		try {
			$data_pr = $this->M_Penerimaan->GetDataPR($purchase_request_id);

			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PPD';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_Penerimaan->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$pengajuan_dana_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$kategori_biaya_id = $data_pr->kategori_biaya_id;
			$tipe_biaya_id = $data_pr->tipe_biaya_id;
			$pengajuan_dana_status = 'Approved';
			$pengajuan_dana_judul = $data_pr->pengajuan_dana_judul;
			$pengajuan_dana_keterangan = '';
			$pengajuan_dana_tgl_pengajuan = $penerimaan_order_tgl;
			$pengajuan_dana_tgl_dibutuhkan = $penerimaan_order_tgl_dibutuhkan;
			$pengajuan_dana_value = '';
			$pengajuan_dana_default_pembayaran = $data_pr->pengajuan_dana_default_pembayaran;
			$bank_account_id = $data_pr->bank_account_id;
			$pengajuan_dana_nama_penerima = $data_pr->pengajuan_dana_penerima;
			$pengajuan_dana_rekening_penerima = $data_pr->pengajuan_dana_rekening_penerima;
			$anggaran_detail_2_id = $data_pr->anggaran_detail_2_id;
			$perusahaan = $client_wms_id;
			$tipe_transaksi = $tipe_transaksi_id;
			$no_doc_po = $po_kode;
			$jenis_asset = null;
			$jenis_pengadaan = $tipe_pengadaan_id;
			$data = $this->M_Penerimaan->SavePengajuanDana(
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
				$response = 1;
			} elseif ($data == 1) {
				$response = 1;
			} else {
				$response = 0;
			}
			return $response;

			// echo json_encode($response);
		} catch (\Throwable $th) {
			return 0;
			throw $th;
		}
	}
}
