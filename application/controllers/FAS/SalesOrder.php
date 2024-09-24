<?php

require_once APPPATH . 'core/ParentController.php';

class SalesOrder extends ParentController
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

		$this->MenuKode = "215003000";
		$this->load->model('FAS/M_SalesOrder', 'M_SalesOrder');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Depo_Detail');
		$this->load->model('M_DataTable');
		$this->load->model('FAS/M_Principle', 'M_Principle');
	}

	public function SalesOrderMenu()
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

		$data['Perusahaan'] 	= $this->M_SalesOrder->GetPerusahaan();
		$data['Principle'] 		= $this->M_SalesOrder->GetAllPrinciple();
		$data['Status'] 		= $this->M_SalesOrder->GetStatusProgress();
		$data['TipeStock'] 		= $this->M_SalesOrder->GetTipeStock();
		$data['TipeSalesOrder'] = $this->M_SalesOrder->GetTipeSalesOrder();
		$data['Sales'] 			= $this->M_SalesOrder->GetSales();
		$data['Gudang'] 		= $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['tipe'] 			= $this->M_Depo_Detail->getTipeSO();
		$data['status'] 	    = $this->M_Depo_Detail->GetStatusSO();
		$data['act'] 			= "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrder/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrder/script', $data);
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

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		$data['Perusahaan'] = $this->M_SalesOrder->GetPerusahaan();
		$data['so_id'] = $so_id;
		$data['TipePelayanan'] = $this->M_SalesOrder->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrder->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrder->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrder->GetArea();
		$data['Sales'] = $this->M_SalesOrder->GetSales();
		$data['TipeStock'] = $this->M_SalesOrder->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrder->GetAllPrinciple();
		$data['TipeSOD'] = $this->M_SalesOrder->GetTipeSalesOrderDetail();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrder/form', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrder/script', $data);
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

		$id = $this->input->get('id');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_SalesOrder->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrder->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrder->GetSalesOrderDetail2ById($id);
		$data['SODetailPromo'] = $this->M_SalesOrder->GetSalesOrderDetailPromoById($id);
		$data['Perusahaan'] = $this->M_SalesOrder->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrder->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrder->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrder->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrder->GetArea();
		$data['Sales'] = $this->M_SalesOrder->GetSales();
		$data['TipeStock'] = $this->M_SalesOrder->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrder->GetAllPrinciple();
		$data['TipeSOD'] = $this->M_SalesOrder->GetTipeSalesOrderDetail();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrder/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrder/script', $data);
	}

	public function detail()
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

		$query['Ses_UserName'] = $this->session->userdata('UserName');

		$id = $this->input->get('id');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_SalesOrder->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrder->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrder->GetSalesOrderDetail2ById($id);
		$data['SODetailPromo'] = $this->M_SalesOrder->GetSalesOrderDetailPromoById($id);
		$data['Perusahaan'] = $this->M_SalesOrder->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrder->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrder->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrder->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrder->GetArea();
		$data['Sales'] = $this->M_SalesOrder->GetSales();
		$data['TipeStock'] = $this->M_SalesOrder->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrder->GetAllPrinciple();
		$data['TipeSOD'] = $this->M_SalesOrder->GetTipeSalesOrderDetail();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrder/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrder/script', $data);
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

		$query['Ses_UserName'] = $this->session->userdata('UserName');

		$id = $this->M_SalesOrder->GetSalesOrderId($this->input->get('kode'));
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_SalesOrder->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrder->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrder->GetSalesOrderDetail2ById($id);
		$data['Perusahaan'] = $this->M_SalesOrder->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrder->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrder->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrder->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrder->GetArea();
		$data['Sales'] = $this->M_SalesOrder->GetSales();
		$data['TipeStock'] = $this->M_SalesOrder->GetTipeStock();
		$data['Principle'] 		= $this->M_SalesOrder->GetAllPrinciple();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrder/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrder/script', $data);
	}

	public function GetSelectedSKU()
	{
		$so_id = $this->input->post('so_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$client_pt_segmen_id = $this->input->post('client_pt_segmen_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sku_id = $this->input->post('sku_id');
		$tgl_harga = $this->input->post('tgl_harga');
		$tgl_harga = date('Y-m-d', strtotime(str_replace("/", "-", $tgl_harga)));

		$data = $this->M_SalesOrder->GetSelectedSKU($so_id, $sku_id, $tgl_harga);

		if (isset($data) && count($data) > 0) {
			foreach ($data as $key => $value) {

				$sku_nominal_harga = $this->M_SalesOrder->Exec_sku_harga_jual($client_wms_id, $client_pt_segmen_id, $client_pt_id, $tgl_harga, $value->sku_id);

				$data[$key]->sku_nominal_harga = $sku_nominal_harga;
			}
		}

		echo json_encode($data);
	}

	public function GetCustomerByTypePelayanan()
	{
		$perusahaan = $this->input->post('perusahaan');
		$sales = $this->input->post('sales');
		$tipe_pembayaran = $this->input->post('tipe_pembayaran');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$area = $this->input->post('area');

		// $data = $this->M_SalesOrder->GetCustomerByTypePelayanan($perusahaan, $sales, $tipe_pembayaran, $nama, $alamat, $telp, $area);

		if ($nama == "") {
			$nama = "";
		} else {
			$nama = "AND client_pt.client_pt_nama LIKE '%" . $nama . "%' ";
		}

		if ($alamat == "") {
			$alamat = "";
		} else {
			$alamat = "AND client_pt.client_pt_alamat LIKE '%" . $alamat . "%' ";
		}

		if ($telp == "") {
			$telp = "";
		} else {
			$telp = "AND client_pt.client_pt_telepon LIKE '%" . $telp . "%' ";
		}

		if ($area == "") {
			$area = "";
		} else {
			$area = "AND client_pt.area_id = '" . $area . "' ";
		}

		$sql = "SELECT DISTINCT ROW_NUMBER () OVER (ORDER BY client_pt.client_pt_nama ASC) AS idx,
		client_pt.*,
		ISNULL(area.area_nama, '') AS area_nama
		FROM client_pt
		LEFT JOIN area
		ON client_pt.area_id = area.area_id
		WHERE client_pt.client_pt_id IS NOT NULL
		" . $nama . "
		" . $alamat . "
		" . $telp . "
		" . $area . "";
		$response = $this->M_DataTable->dtTableGetList($sql);

		$output = array(
			"draw" => $response['draw'],
			"recordsTotal" => $response['recordsTotal'],
			"recordsFiltered" => $response['recordsFiltered'],
			"data" => $response['data'],
		);

		echo json_encode($output);
	}

	public function GetSelectedPrinciple()
	{
		$customer = $this->input->post('customer');
		$perusahaan = $this->input->post('perusahaan');

		$data = $this->M_SalesOrder->GetSelectedPrinciple($customer, $perusahaan);

		echo json_encode($data);
	}

	public function GetSelectedCustomer()
	{
		$customer = $this->input->post('customer');
		$sales = $this->input->post('sales');

		$data = $this->M_SalesOrder->GetSelectedCustomer($customer, $sales);

		echo json_encode($data);
	}

	public function search_so_by_filter()
	{


		$tgl 			= explode(" - ", $this->input->post('tgl'));
		$tgl1 			= date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 			= date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$tgl_kirim 		= $this->input->post('tgl_kirim');
		$perusahaan 	= $this->input->post('perusahaan');
		$principle 		= $this->input->post('principle');
		$kode 			= $this->input->post('kode');
		$status 		= $this->input->post('status');
		$tipe 			= $this->input->post('tipe');
		$sales 			= $this->input->post('sales');
		$is_priority 	= $this->input->post('is_priority');
		$start 			= $this->input->post('start');
		$end 			= $this->input->post('length');
		$draw 			= $this->input->post('draw');
		$order_column  	= intval($this->input->post('order')[0]['column']);
		$order_dir     	= $this->input->post('order')[0]['dir'];
		$search 		= "";

		$totalData 		= $this->M_SalesOrder->GetTotalSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

		$totalFiltered 	= $totalData;

		if (empty($this->input->post('search')['value'])) {
			$data 		= $this->M_SalesOrder->GetSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);
		} else {
			$search 	= $_POST['search']['value'];
			$data 		= $this->M_SalesOrder->GetSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);

			$datacount 	= $this->M_SalesOrder->GetTotalSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

			$totalFiltered = $datacount;
		}

		$data = array(
			"draw" => intval($draw),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($data);


		// $data = $this->M_SalesOrder->search_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim);
		// $tipeSalesOrder = $this->M_SalesOrder->GetTipeSalesOrder();

		// $response = [
		// 	'data' => $data,
		// 	'tipeSalesOrder' => $tipeSalesOrder
		// ];

		// echo json_encode($response);
	}

	public function searchEdit_so_by_filter()
	{
		$tgl 		= explode(" - ", $this->input->post('tgl'));
		$tgl1 		= date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 		= date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$principle 	= $this->input->post('principle');
		$kode 		= $this->input->post('kode');
		$status 	= $this->input->post('status');
		$tipe 		= $this->input->post('tipe');
		$sales 		= $this->input->post('sales');

		$data = $this->M_SalesOrder->searchEdit_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle);
		$tipeSalesOrder = $this->M_SalesOrder->GetTipeSalesOrder();

		$response = [
			'data' => $data,
			'tipeSalesOrder' => $tipeSalesOrder
		];

		echo json_encode($response);
	}

	public function checkLastUpdate()
	{
		$id = $this->input->post('id');
		$tglUpdate = $this->input->post('tglUpdate');
		// $arr_temp = $this->input->post('arr_temp');

		// if (count($arr_temp) > 0) {
		// 	foreach ($arr_temp as $key => $value) {
		// 		$so_id = $value['so_id'];
		// 		$sales_order_tgl_update = $this->db->query("SELECT sales_order_tgl_update FROM sales_order where sales_order_id = '$so_id'")->row()->sales_order_tgl_update;

		// 		if ($so_id == $value['tglUpdate']) {
		// 			echo json_encode(1);
		// 		} else {
		// 			echo json_encode(0);
		// 		}
		// 	}
		// } else {
		$sales_order_tgl_update = $this->db->query("SELECT sales_order_tgl_update FROM sales_order where sales_order_id = '$id'")->row()->sales_order_tgl_update;

		if ($sales_order_tgl_update == $tglUpdate) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
		// }
	}

	public function get_ed_sku_header_by_id()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_header_by_id($sales_order_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_header_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_header_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_by_id($sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->get_ed_sku_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function search_filter_chosen_sku()
	{
		$perusahaan = $this->input->post('perusahaan');
		$sales = $this->input->post('sales');
		$client_pt = $this->input->post('client_pt');
		$tipe_pembayaran = $this->input->post('tipe_pembayaran');
		$brand = $this->input->post('brand');
		$principle = $this->input->post('principle');
		$sku_induk = $this->input->post('sku_induk');
		$sku_nama_produk = $this->input->post('sku_nama_produk');
		$sku_kemasan = $this->input->post('sku_kemasan');
		$sku_satuan = $this->input->post('sku_satuan');

		$data = $this->M_SalesOrder->search_filter_chosen_sku($perusahaan, $sales, $client_pt, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan);

		echo json_encode($data);
	}

	public function Get_sales_order_by_top_retur_default()
	{
		$client_pt_id = $this->input->post('client_pt_id');

		$data = $this->M_SalesOrder->Get_sales_order_by_top_retur_default($client_pt_id);

		echo json_encode($data);
	}

	public function Get_sales_order_by_top_retur()
	{
		$principle_id = $this->input->post('principle_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sku_id = $this->input->post('sku_id');

		$top = 0;

		$query = $this->db->query("SELECT client_pt_principle.* FROM client_pt_principle INNER JOIN principle ON client_pt_principle.principle_id = principle.principle_id WHERE client_pt_id = '$client_pt_id' AND principle.principle_id = '$principle_id'");

		if ($query->num_rows() == 0) {
			echo json_encode(0);
		} else {
			foreach ($query->result_array() as $value) {
				$top = $value['client_pt_principle_top'];
			}

			$data = $this->M_SalesOrder->Get_sales_order_by_top_retur($top, $client_pt_id, $sku_id);
			echo json_encode($data);
		}
	}

	public function search_filter_chosen_sku_retur()
	{
		$sales_order_id = $this->input->post('sales_order_id');

		$data = $this->M_SalesOrder->search_filter_chosen_sku_retur($sales_order_id);

		echo json_encode($data);
	}

	public function search_filter_chosen_sku_by_pabrik()
	{
		$client_pt = $this->input->post('client_pt');
		$perusahaan = $this->input->post('perusahaan');
		$tipe_pembayaran = $this->input->post('tipe_pembayaran');
		$brand = $this->input->post('brand');
		$principle = $this->input->post('principle');
		$sku_induk = $this->input->post('sku_induk');
		$sku_nama_produk = $this->input->post('sku_nama_produk');
		$sku_kemasan = $this->input->post('sku_kemasan');
		$sku_satuan = $this->input->post('sku_satuan');

		$data = $this->M_SalesOrder->search_filter_chosen_sku_by_pabrik($client_pt, $perusahaan, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan);

		echo json_encode($data);
	}

	public function insert_sales_order()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$depo_id = $this->input->post('depo_id');
		$sales_order_kode = $this->input->post('sales_order_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$channel_id = $this->input->post('channel_id');
		$sales_order_is_handheld = $this->input->post('sales_order_is_handheld');
		$sales_order_status = $this->input->post('sales_order_status');
		$sales_order_approved_by = $this->input->post('sales_order_approved_by');
		$sales_id = $this->input->post('sales_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sales_order_tgl = $this->input->post('sales_order_tgl');
		$sales_order_tgl_exp = $this->input->post('sales_order_tgl_exp');
		$sales_order_tgl_harga = $this->input->post('sales_order_tgl_harga');
		$sales_order_tgl_sj = $this->input->post('sales_order_tgl_sj');
		$sales_order_tgl_kirim = $this->input->post('sales_order_tgl_kirim');
		$sales_order_tipe_pembayaran = $this->input->post('sales_order_tipe_pembayaran');
		$tipe_sales_order_id = $this->input->post('tipe_sales_order_id');
		$sales_order_no_po = $this->input->post('sales_order_no_po');
		$sales_order_who_create = $this->input->post('sales_order_who_create');
		$sales_order_tgl_create = $this->input->post('sales_order_tgl_create');
		$sales_order_is_downloaded = $this->input->post('sales_order_is_downloaded');
		$so_is_need_approval = $this->input->post('so_is_need_approval');
		$tipe_delivery_order_id = $this->input->post('tipe_delivery_order_id');
		$sales_order_is_uploaded = $this->input->post('sales_order_is_uploaded');
		$sales_order_no_reff = $this->input->post('sales_order_no_reff');
		$principle_id = $this->input->post('principle_id');
		$total_global = str_replace(",", ".", $this->input->post('total_global'));
		$diskon_global_percent = str_replace(",", ".", $this->input->post('diskon_global_percent'));
		$diskon_global_rp = str_replace(",", ".", $this->input->post('diskon_global_rp'));
		$dasar_kena_pajak = str_replace(",", ".", $this->input->post('dasar_kena_pajak'));
		$ppn_global_percent = str_replace(",", ".", $this->input->post('ppn_global_percent'));
		$ppn_global_rp = str_replace(",", ".", $this->input->post('ppn_global_rp'));
		$adjustment = str_replace(",", ".", $this->input->post('adjustment'));
		$total_faktur = str_replace(",", ".", $this->input->post('total_faktur'));
		$total_diskon_item = str_replace(",", ".", $this->input->post('total_diskon_item'));

		$detail = $this->input->post('detail');
		$detail_promo = $this->input->post('detail_promo');
		$tipe_ppn = $this->input->post('tipe_ppn');
		$keterangan = $this->input->post('keterangan');

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_SO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_SalesOrder->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$so_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_SO_01";

		$this->db->trans_begin();

		$this->M_SalesOrder->insert_sales_order($so_id, $depo_id, $so_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff, $principle_id, $total_global, $diskon_global_percent, $diskon_global_rp, $dasar_kena_pajak, $ppn_global_percent, $ppn_global_rp, $adjustment, $total_faktur, $total_diskon_item, $tipe_ppn, $keterangan);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrder->insert_sales_order_detail($so_id, $sod_id, $value);
			// $this->M_SalesOrder->insert_sales_order_detail2($sod_id, $value['sku_id']);
			// $this->M_SalesOrder->insert_sales_order_detail2($so_id, $value);
		}

		if (isset($detail_promo) && count($detail_promo) > 0) {

			foreach ($detail_promo as $key => $value) {
				$sodp_id = $this->M_Vrbl->Get_NewID();
				$sodp_id = $sodp_id[0]['NEW_ID'];

				$this->M_SalesOrder->insert_sales_order_detail_promo($so_id, $sodp_id, $value);
				// $this->M_SalesOrder->insert_sales_order_detail2($sod_id, $value['sku_id']);
				// $this->M_SalesOrder->insert_sales_order_detail2($so_id, $value);
			}
		}

		$this->M_SalesOrder->delete_sales_order_detail_2_temp_all();

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrder->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $so_id, $so_kode, 0, 0);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sales_order_retur()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$depo_id = $this->input->post('depo_id');
		$sales_order_kode = $this->input->post('sales_order_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$channel_id = $this->input->post('channel_id');
		$sales_order_is_handheld = $this->input->post('sales_order_is_handheld');
		$sales_order_status = $this->input->post('sales_order_status');
		$sales_order_approved_by = $this->input->post('sales_order_approved_by');
		$sales_id = $this->input->post('sales_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sales_order_tgl = $this->input->post('sales_order_tgl');
		$sales_order_tgl_exp = $this->input->post('sales_order_tgl_exp');
		$sales_order_tgl_harga = $this->input->post('sales_order_tgl_harga');
		$sales_order_tgl_sj = $this->input->post('sales_order_tgl_sj');
		$sales_order_tgl_kirim = $this->input->post('sales_order_tgl_kirim');
		$sales_order_tipe_pembayaran = $this->input->post('sales_order_tipe_pembayaran');
		$tipe_sales_order_id = $this->input->post('tipe_sales_order_id');
		$sales_order_no_po = $this->input->post('sales_order_no_po');
		$sales_order_who_create = $this->input->post('sales_order_who_create');
		$sales_order_tgl_create = $this->input->post('sales_order_tgl_create');
		$sales_order_is_downloaded = $this->input->post('sales_order_is_downloaded');
		$so_is_need_approval = $this->input->post('so_is_need_approval');
		$tipe_delivery_order_id = $this->input->post('tipe_delivery_order_id');
		$sales_order_is_uploaded = $this->input->post('sales_order_is_uploaded');
		$sales_order_no_reff = $this->input->post('sales_order_no_reff');
		$principle_id = $this->input->post('principle_id');
		$total_global = str_replace(",", ".", $this->input->post('total_global'));
		$diskon_global_percent = str_replace(",", ".", $this->input->post('diskon_global_percent'));
		$diskon_global_rp = str_replace(",", ".", $this->input->post('diskon_global_rp'));
		$dasar_kena_pajak = str_replace(",", ".", $this->input->post('dasar_kena_pajak'));
		$ppn_global_percent = str_replace(",", ".", $this->input->post('ppn_global_percent'));
		$ppn_global_rp = str_replace(",", ".", $this->input->post('ppn_global_rp'));
		$adjustment = str_replace(",", ".", $this->input->post('adjustment'));
		$total_faktur = str_replace(",", ".", $this->input->post('total_faktur'));
		$total_diskon_item = str_replace(",", ".", $this->input->post('total_diskon_item'));

		$detail = $this->input->post('detail');
		$detail2 = $this->input->post('detail2');
		$tipe_ppn = $this->input->post('tipe_ppn');
		$keterangan = $this->input->post('keterangan');

		// $cek_sku_so_detail2 = $this->M_SalesOrder->cek_sku_so_detail2($detail, $detail2);

		// if (count($cek_sku_so_detail2) > 0) {
		// 	echo json_encode($cek_sku_so_detail2);
		// 	die;
		// }

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_SO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_SalesOrder->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$so_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_SO_01";

		$this->db->trans_begin();

		$this->M_SalesOrder->insert_sales_order($so_id, $depo_id, $so_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff, $principle_id, $total_global, $diskon_global_percent, $diskon_global_rp, $dasar_kena_pajak, $ppn_global_percent, $ppn_global_rp, $adjustment, $total_faktur, $total_diskon_item, $tipe_ppn, $keterangan);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrder->insert_sales_order_detail_retur($so_id, $sod_id, $value);

			// $so_detail2 = $this->M_SalesOrder->get_so_detail2_sementara($value['sku_id'], $detail2);

			// foreach ($so_detail2 as $key2 => $value2) {
			// 	$sod2_id = $this->M_Vrbl->Get_NewID();
			// 	$sod2_id = $sod2_id[0]['NEW_ID'];

			// 	$depo_detail_id = $value2['depo_detail_id'];
			// 	$sku_expdate = $value2['sku_stock_expired_date'];
			// 	$sku_stock_id = "";
			// 	$sku_id = $value2['sku_id'];
			// 	$sku_qty = $value2['sku_qty'];
			// 	$delivery_order_reff_id = $value2['delivery_order_reff_id'];

			// 	$cek_sku_stock_retur = $this->M_SalesOrder->cek_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate);

			// 	if (count($cek_sku_stock_retur) != 0) {
			// 		foreach ($cek_sku_stock_retur as $val_retur) {
			// 			$sku_stock_id = $val_retur['sku_stock_id'];
			// 		}
			// 	} else {
			// 		$sku_stock_id = $this->M_SalesOrder->insert_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate, $sku_qty);
			// 		if ($sku_stock_id == "") {
			// 			$this->db->trans_rollback();
			// 			echo json_encode(2);
			// 		}
			// 	}

			// 	$this->M_SalesOrder->insert_sales_order_detail2_retur($sod2_id, $sod_id, $sku_stock_id, $sku_id, $sku_expdate, $sku_qty, $delivery_order_reff_id);
			// }
		}

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrder->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $so_id, $so_kode, 0, 0);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sales_order_detail_2_temp()
	{
		$so_id = $this->input->post('so_id');
		$sku_stock_id = $this->input->post('sku_stock_id');
		$sku_id = $this->input->post('sku_id');
		$sku_expdate = $this->input->post('sku_expdate');
		$sku_qty = $this->input->post('sku_qty');

		$this->db->trans_begin();

		$this->M_SalesOrder->insert_sales_order_detail_2_temp($so_id, $sku_stock_id, $sku_id, $sku_expdate, $sku_qty);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sales_order()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$depo_id = $this->input->post('depo_id');
		$sales_order_kode = $this->input->post('sales_order_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$channel_id = $this->input->post('channel_id');
		$sales_order_is_handheld = $this->input->post('sales_order_is_handheld');
		$sales_order_status = $this->input->post('sales_order_status');
		$sales_order_approved_by = $this->input->post('sales_order_approved_by');
		$sales_id = $this->input->post('sales_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sales_order_tgl = $this->input->post('sales_order_tgl');
		$sales_order_tgl_exp = $this->input->post('sales_order_tgl_exp');
		$sales_order_tgl_harga = $this->input->post('sales_order_tgl_harga');
		$sales_order_tgl_sj = $this->input->post('sales_order_tgl_sj');
		$sales_order_tgl_kirim = $this->input->post('sales_order_tgl_kirim');
		$sales_order_tipe_pembayaran = $this->input->post('sales_order_tipe_pembayaran');
		$tipe_sales_order_id = $this->input->post('tipe_sales_order_id');
		$sales_order_no_po = $this->input->post('sales_order_no_po');
		$sales_order_who_create = $this->input->post('sales_order_who_create');
		$sales_order_tgl_create = $this->input->post('sales_order_tgl_create');
		$sales_order_is_downloaded = $this->input->post('sales_order_is_downloaded');
		$so_is_need_approval = $this->input->post('so_is_need_approval');
		$tipe_delivery_order_id = $this->input->post('tipe_delivery_order_id');
		$sales_order_is_uploaded = $this->input->post('sales_order_is_uploaded');
		$detail = $this->input->post('detail');
		$detail_promo = $this->input->post('detail_promo');
		$tgl_update = $this->input->post('tgl_update');
		$sales_order_no_reff = $this->input->post('sales_order_no_reff');
		$principle_id = $this->input->post('principle_id');
		$total_global = str_replace(",", ".", $this->input->post('total_global'));
		$diskon_global_percent = str_replace(",", ".", $this->input->post('diskon_global_percent'));
		$diskon_global_rp = str_replace(",", ".", $this->input->post('diskon_global_rp'));
		$dasar_kena_pajak = str_replace(",", ".", $this->input->post('dasar_kena_pajak'));
		$ppn_global_percent = str_replace(",", ".", $this->input->post('ppn_global_percent'));
		$ppn_global_rp = str_replace(",", ".", $this->input->post('ppn_global_rp'));
		$adjustment = str_replace(",", ".", $this->input->post('adjustment'));
		$total_faktur = str_replace(",", ".", $this->input->post('total_faktur'));
		$total_diskon_item = str_replace(",", ".", $this->input->post('total_diskon_item'));
		$tipe_ppn = $this->input->post('tipe_ppn');
		$keterangan = $this->input->post('keterangan');

		$approvalParam = "APPRV_SO_01";

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "sales_order",
			'whereField' => "sales_order_id",
			'whereValue' => $sales_order_id,
			'fieldDateUpdate' => "sales_order_tgl_update",
			'fieldWhoUpdate' => "sales_order_who_update",
			'lastUpdated' => $tgl_update
		]);

		$this->db->trans_begin();

		$this->M_SalesOrder->update_sales_order($sales_order_id, $depo_id, $sales_order_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff, $principle_id, $total_global, $diskon_global_percent, $diskon_global_rp, $dasar_kena_pajak, $ppn_global_percent, $ppn_global_rp, $adjustment, $total_faktur, $total_diskon_item, $tipe_ppn, $keterangan);

		$this->M_SalesOrder->delete_sales_order_detail_2($sales_order_id);
		$this->M_SalesOrder->delete_sales_order_detail($sales_order_id);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrder->insert_sales_order_detail($sales_order_id, $sod_id, $value);
			// $this->M_SalesOrder->insert_sales_order_detail2($sod_id, $value['sku_id']);
			// $this->M_SalesOrder->insert_sales_order_detail2($so_id, $value);

			if ($tipe_delivery_order_id == 'C5BE83E2-01E8-4E24-B766-26BB4158F2CD') {
				// Dapatkan tanggal saat ini
				$currentDate = date('Y-m-d');
				// Tambah 2 bulan menggunakan strtotime
				$newDate = strtotime('+2 months', strtotime($currentDate));
				// Format tanggal ke format yang diinginkan, misalnya 'Y-m-d'
				$formattedDate = date('Y-m-d', $newDate);

				$depo_detail_id = $this->M_SalesOrder->getDepoDetail();
				$cek_sku_stock_retur = $this->M_SalesOrder->cek_sku_stock_retur($depo_detail_id['depo_detail_id'], $value['sku_id'], $formattedDate);

				if (count($cek_sku_stock_retur) != 0) {
					foreach ($cek_sku_stock_retur as $val_retur) {
						$sku_stock_id = $val_retur['sku_stock_id'];
					}
				} else {
					$sku_stock_id = $this->M_SalesOrder->insert_sku_stock_retur($depo_detail_id['depo_detail_id'], $value['sku_id'], $formattedDate, $value['sku_qty']);
				}

				$sod2_id = $this->M_Vrbl->Get_NewID();
				$sod2_id = $sod2_id[0]['NEW_ID'];

				$this->M_SalesOrder->insert_sales_order_detail2_retur($sod2_id, $sod_id, $sku_stock_id, $value['sku_id'], $formattedDate, $value['sku_qty'], "");
			}
		}

		if (isset($detail_promo) && count($detail_promo) > 0) {

			$this->M_SalesOrder->delete_sales_order_detail_promo($sales_order_id);

			foreach ($detail_promo as $key => $value) {
				$sodp_id = $this->M_Vrbl->Get_NewID();
				$sodp_id = $sodp_id[0]['NEW_ID'];

				$this->M_SalesOrder->insert_sales_order_detail_promo($sales_order_id, $sodp_id, $value);
				// $this->M_SalesOrder->insert_sales_order_detail2($sod_id, $value['sku_id']);
				// $this->M_SalesOrder->insert_sales_order_detail2($so_id, $value);
			}
		}

		$this->M_SalesOrder->delete_sales_order_detail_2_temp_all();

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrder->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $sales_order_id, $sales_order_kode, 0, 0);
		}

		echo json_encode(responseJson((object)[
			'lastUpdatedChecked' => $lastUpdatedChecked,
			'status' => 'Disimpan'
		]));

		// echo json_encode(401);
		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	echo json_encode(0);
		// } else {
		// 	$this->db->trans_commit();
		// 	echo json_encode(1);
		// }
	}

	public function update_sales_order_retur()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$depo_id = $this->input->post('depo_id');
		$sales_order_kode = $this->input->post('sales_order_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$channel_id = $this->input->post('channel_id');
		$sales_order_is_handheld = $this->input->post('sales_order_is_handheld');
		$sales_order_status = $this->input->post('sales_order_status');
		$sales_order_approved_by = $this->input->post('sales_order_approved_by');
		$sales_id = $this->input->post('sales_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$sales_order_tgl = $this->input->post('sales_order_tgl');
		$sales_order_tgl_exp = $this->input->post('sales_order_tgl_exp');
		$sales_order_tgl_harga = $this->input->post('sales_order_tgl_harga');
		$sales_order_tgl_sj = $this->input->post('sales_order_tgl_sj');
		$sales_order_tgl_kirim = $this->input->post('sales_order_tgl_kirim');
		$sales_order_tipe_pembayaran = $this->input->post('sales_order_tipe_pembayaran');
		$tipe_sales_order_id = $this->input->post('tipe_sales_order_id');
		$sales_order_no_po = $this->input->post('sales_order_no_po');
		$sales_order_who_create = $this->input->post('sales_order_who_create');
		$sales_order_tgl_create = $this->input->post('sales_order_tgl_create');
		$sales_order_is_downloaded = $this->input->post('sales_order_is_downloaded');
		$so_is_need_approval = $this->input->post('so_is_need_approval');
		$tipe_delivery_order_id = $this->input->post('tipe_delivery_order_id');
		$sales_order_is_uploaded = $this->input->post('sales_order_is_uploaded');
		$tgl_update = $this->input->post('tgl_update');
		$sales_order_no_reff  = $this->input->post('sales_order_no_reff');
		$principle_id = $this->input->post('principle_id');
		$total_global = $this->input->post('total_global');
		$diskon_global_percent = $this->input->post('diskon_global_percent');
		$diskon_global_rp = $this->input->post('diskon_global_rp');
		$dasar_kena_pajak = $this->input->post('dasar_kena_pajak');
		$ppn_global_percent = $this->input->post('ppn_global_percent');
		$ppn_global_rp = $this->input->post('ppn_global_rp');
		$adjustment = $this->input->post('adjustment');
		$total_faktur = $this->input->post('total_faktur');
		$total_diskon_item = $this->input->post('total_diskon_item');
		$tipe_ppn = $this->input->post('tipe_ppn');
		$keterangan = $this->input->post('keterangan');

		$detail = $this->input->post('detail');
		$detail2 = $this->input->post('detail2');

		// $cek_sku_so_detail2 = $this->M_SalesOrder->cek_sku_so_detail2($detail, $detail2);

		// if (count($cek_sku_so_detail2) > 0) {
		// 	echo json_encode($cek_sku_so_detail2);
		// 	die;
		// }

		$approvalParam = "APPRV_SO_01";

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "sales_order",
			'whereField' => "sales_order_id",
			'whereValue' => $sales_order_id,
			'fieldDateUpdate' => "sales_order_tgl_update",
			'fieldWhoUpdate' => "sales_order_who_update",
			'lastUpdated' => $tgl_update
		]);

		$this->db->trans_begin();

		$this->M_SalesOrder->update_sales_order(
			$sales_order_id,
			$depo_id,
			$sales_order_kode,
			$client_wms_id,
			$channel_id,
			$sales_order_is_handheld,
			$sales_order_status,
			$sales_order_approved_by,
			$sales_id,
			$client_pt_id,
			$sales_order_tgl,
			$sales_order_tgl_exp,
			$sales_order_tgl_harga,
			$sales_order_tgl_sj,
			$sales_order_tgl_kirim,
			$sales_order_tipe_pembayaran,
			$tipe_sales_order_id,
			$sales_order_no_po,
			$sales_order_who_create,
			$sales_order_tgl_create,
			$sales_order_is_downloaded,
			$tipe_delivery_order_id,
			$sales_order_is_uploaded,
			$sales_order_no_reff,
			$principle_id,
			$total_global,
			$diskon_global_percent,
			$diskon_global_rp,
			$dasar_kena_pajak,
			$ppn_global_percent,
			$ppn_global_rp,
			$adjustment,
			$total_faktur,
			$total_diskon_item,
			$tipe_ppn,
			$keterangan
		);

		$this->M_SalesOrder->delete_sales_order_detail_2($sales_order_id);
		$this->M_SalesOrder->delete_sales_order_detail($sales_order_id);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrder->insert_sales_order_detail_retur($sales_order_id, $sod_id, $value);

			// $so_detail2 = $this->M_SalesOrder->get_so_detail2_sementara($value['sku_id'], $detail2);

			// foreach ($so_detail2 as $key2 => $value2) {
			// 	$sod2_id = $this->M_Vrbl->Get_NewID();
			// 	$sod2_id = $sod2_id[0]['NEW_ID'];

			// 	$depo_detail_id = $value2['depo_detail_id'];
			// 	$sku_expdate = $value2['sku_stock_expired_date'];
			// 	$sku_stock_id = "";
			// 	$sku_id = $value2['sku_id'];
			// 	$sku_qty = $value2['sku_qty'];
			// 	$delivery_order_reff_id = $value2['delivery_order_reff_id'];

			// 	$cek_sku_stock_retur = $this->M_SalesOrder->cek_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate);

			// 	// echo json_encode($cek_sku_stock_retur);
			// 	// echo "<br>";
			// 	// $this->db->trans_rollback();

			// 	if (count($cek_sku_stock_retur) != 0) {
			// 		foreach ($cek_sku_stock_retur as $val_retur) {
			// 			$sku_stock_id = $val_retur['sku_stock_id'];
			// 		}
			// 	} else {
			// 		$sku_stock_id = $this->M_SalesOrder->insert_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate, $sku_qty);
			// 		if ($sku_stock_id == "") {
			// 			$this->db->trans_rollback();
			// 			echo json_encode(2);
			// 		}
			// 	}

			// 	$this->M_SalesOrder->insert_sales_order_detail2_retur($sod2_id, $sod_id, $sku_stock_id, $sku_id, $sku_expdate, $sku_qty, $delivery_order_reff_id);
			// }

			// $sod2_id = $this->M_Vrbl->Get_NewID();
			// $sod2_id = $sod2_id[0]['NEW_ID'];

			// $this->M_SalesOrder->insert_sales_order_detail2_retur($sod2_id, $sod_id, "", $value['sku_id'], "", $value['sku_qty'], "");
		}

		$this->M_SalesOrder->delete_sales_order_detail_2_temp_all();

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrder->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $sales_order_id, $sales_order_kode, 0, 0);
		}

		echo json_encode(responseJson((object)[
			'lastUpdatedChecked' => $lastUpdatedChecked,
			'status' => 'Disimpan'
		]));

		// echo json_encode(401);
		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	echo json_encode(0);
		// } else {
		// 	$this->db->trans_commit();
		// 	echo json_encode(1);
		// }
	}

	public function updateDataSalesOrder()
	{
		$arrData = $this->input->post('arrData');

		if (count($arrData) > 0) {

			$tmp = [];

			foreach ($arrData as $key => $value) {
				$sales_order_id = $value['id'];

				$tglUpdate = $this->db->query("SELECT sales_order_tgl_update FROM sales_order WHERE sales_order_id = '$sales_order_id'")->row()->sales_order_tgl_update;

				if ($value['tglUpdate'] != $tglUpdate) {
					array_push($tmp, $tglUpdate);
				}
			}

			if (count($tmp) > 0) {
				echo json_encode(400);
			} else {

				$this->db->trans_begin();

				foreach ($arrData as $key => $value) {
					if ($value['tipe'] != '') {
						$this->db->update("sales_order", [
							'sales_order_tgl_kirim' => $value['tgl_kirim'] . " 00:00:00.000",
							'tipe_sales_order_id' => $value['tipe'],
							'sales_order_tgl_update' => $value['tglUpdate'],
							'is_priority' => $value['is_priority']
						], ['sales_order_id' => $value['id']]);
					} else {
						$this->db->update("sales_order", [
							'sales_order_tgl_kirim' => $value['tgl_kirim'] . " 00:00:00.000",
							'sales_order_tgl_update' => $value['tglUpdate'],
							'is_priority' => $value['is_priority']
						], ['sales_order_id' => $value['id']]);
					}
				}

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					echo json_encode(false);
				} else {
					$this->db->trans_commit();
					echo json_encode(true);
				}
			}
		}
	}

	public function confirm_delivery_order_draft()
	{
		$delivery_order_draft_id = $this->input->post('delivery_order_draft_id');
		$sales_order_id = $this->input->post('sales_order_id');
		$delivery_order_draft_kode = $this->input->post('delivery_order_draft_kode');
		$delivery_order_draft_yourref = $this->input->post('delivery_order_draft_yourref');
		$client_wms_id = $this->input->post('client_wms_id');
		$delivery_order_draft_tgl_buat_do = $this->input->post('delivery_order_draft_tgl_buat_do');
		$delivery_order_draft_tgl_expired_do = $this->input->post('delivery_order_draft_tgl_expired_do');
		$delivery_order_draft_tgl_surat_jalan = $this->input->post('delivery_order_draft_tgl_surat_jalan');
		$delivery_order_draft_tgl_rencana_kirim = $this->input->post('delivery_order_draft_tgl_rencana_kirim');
		$delivery_order_draft_tgl_aktual_kirim = $this->input->post('delivery_order_draft_tgl_aktual_kirim');
		$delivery_order_draft_keterangan = $this->input->post('delivery_order_draft_keterangan');
		$delivery_order_draft_status = $this->input->post('delivery_order_draft_status');
		$delivery_order_draft_is_prioritas = $this->input->post('delivery_order_draft_is_prioritas');
		$delivery_order_draft_is_need_packing = $this->input->post('delivery_order_draft_is_need_packing');
		$delivery_order_draft_tipe_layanan = $this->input->post('delivery_order_draft_tipe_layanan');
		$delivery_order_draft_tipe_pembayaran = $this->input->post('delivery_order_draft_tipe_pembayaran');
		$delivery_order_draft_sesi_pengiriman = $this->input->post('delivery_order_draft_sesi_pengiriman');
		$delivery_order_draft_request_tgl_kirim = $this->input->post('delivery_order_draft_request_tgl_kirim');
		$delivery_order_draft_request_jam_kirim = $this->input->post('delivery_order_draft_request_jam_kirim');
		$tipe_pengiriman_id = $this->input->post('tipe_pengiriman_id');
		$nama_tipe = $this->input->post('nama_tipe');
		$confirm_rate = $this->input->post('confirm_rate');
		$delivery_order_draft_reff_id = $this->input->post('delivery_order_draft_reff_id');
		$delivery_order_draft_reff_no = $this->input->post('delivery_order_draft_reff_no');
		$delivery_order_draft_total = $this->input->post('delivery_order_draft_total');
		$unit_mandiri_id = $this->input->post('unit_mandiri_id');
		$depo_id = $this->input->post('depo_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$delivery_order_draft_kirim_nama = $this->input->post('delivery_order_draft_kirim_nama');
		$delivery_order_draft_kirim_alamat = $this->input->post('delivery_order_draft_kirim_alamat');
		$delivery_order_draft_kirim_telp = $this->input->post('delivery_order_draft_kirim_telp');
		$delivery_order_draft_kirim_provinsi = $this->input->post('delivery_order_draft_kirim_provinsi');
		$delivery_order_draft_kirim_kota = $this->input->post('delivery_order_draft_kirim_kota');
		$delivery_order_draft_kirim_kecamatan = $this->input->post('delivery_order_draft_kirim_kecamatan');
		$delivery_order_draft_kirim_kelurahan = $this->input->post('delivery_order_draft_kirim_kelurahan');
		$delivery_order_draft_kirim_kodepos = $this->input->post('delivery_order_draft_kirim_kodepos');
		$delivery_order_draft_kirim_area = $this->input->post('delivery_order_draft_kirim_area');
		$delivery_order_draft_kirim_invoice_pdf = $this->input->post('delivery_order_draft_kirim_invoice_pdf');
		$delivery_order_draft_kirim_invoice_dir = $this->input->post('delivery_order_draft_kirim_invoice_dir');
		$pabrik_id = $this->input->post('pabrik_id');
		$delivery_order_draft_ambil_nama = $this->input->post('delivery_order_draft_ambil_nama');
		$delivery_order_draft_ambil_alamat = $this->input->post('delivery_order_draft_ambil_alamat');
		$delivery_order_draft_ambil_telp = $this->input->post('delivery_order_draft_ambil_telp');
		$delivery_order_draft_ambil_provinsi = $this->input->post('delivery_order_draft_ambil_provinsi');
		$delivery_order_draft_ambil_kota = $this->input->post('delivery_order_draft_ambil_kota');
		$delivery_order_draft_ambil_kecamatan = $this->input->post('delivery_order_draft_ambil_kecamatan');
		$delivery_order_draft_ambil_kelurahan = $this->input->post('delivery_order_draft_ambil_kelurahan');
		$delivery_order_draft_ambil_kodepos = $this->input->post('delivery_order_draft_ambil_kodepos');
		$delivery_order_draft_ambil_area = $this->input->post('delivery_order_draft_ambil_area');
		$delivery_order_draft_update_who = $this->input->post('delivery_order_draft_update_who');
		$delivery_order_draft_update_tgl = $this->input->post('delivery_order_draft_update_tgl');
		$delivery_order_draft_approve_who = $this->input->post('delivery_order_draft_approve_who');
		$delivery_order_draft_approve_tgl = $this->input->post('delivery_order_draft_approve_tgl');
		$delivery_order_draft_reject_who = $this->input->post('delivery_order_draft_reject_who');
		$delivery_order_draft_reject_tgl = $this->input->post('delivery_order_draft_reject_tgl');
		$delivery_order_draft_reject_reason = $this->input->post('delivery_order_draft_reject_reason');
		$tipe_delivery_order_id = $this->input->post('tipe_delivery_order_id');
		$detail = $this->input->post('detail');

		$this->db->trans_begin();

		//insert ke tr_pemusnahan_stok_draft
		$this->M_SalesOrder->update_delivery_order_draft($delivery_order_draft_id, $sales_order_id, $delivery_order_draft_kode, $delivery_order_draft_yourref, $client_wms_id, $delivery_order_draft_tgl_buat_do, $delivery_order_draft_tgl_expired_do, $delivery_order_draft_tgl_surat_jalan, $delivery_order_draft_tgl_rencana_kirim, $delivery_order_draft_tgl_aktual_kirim, $delivery_order_draft_keterangan, $delivery_order_draft_status, $delivery_order_draft_is_prioritas, $delivery_order_draft_is_need_packing, $delivery_order_draft_tipe_layanan, $delivery_order_draft_tipe_pembayaran, $delivery_order_draft_sesi_pengiriman, $delivery_order_draft_request_tgl_kirim, $delivery_order_draft_request_jam_kirim, $tipe_pengiriman_id, $nama_tipe, $confirm_rate, $delivery_order_draft_reff_id, $delivery_order_draft_reff_no, $delivery_order_draft_total, $unit_mandiri_id, $depo_id, $client_pt_id, $delivery_order_draft_kirim_nama, $delivery_order_draft_kirim_alamat, $delivery_order_draft_kirim_telp, $delivery_order_draft_kirim_provinsi, $delivery_order_draft_kirim_kota, $delivery_order_draft_kirim_kecamatan, $delivery_order_draft_kirim_kelurahan, $delivery_order_draft_kirim_kodepos, $delivery_order_draft_kirim_area, $delivery_order_draft_kirim_invoice_pdf, $delivery_order_draft_kirim_invoice_dir, $pabrik_id, $delivery_order_draft_ambil_nama, $delivery_order_draft_ambil_alamat, $delivery_order_draft_ambil_telp, $delivery_order_draft_ambil_provinsi, $delivery_order_draft_ambil_kota, $delivery_order_draft_ambil_kecamatan, $delivery_order_draft_ambil_kelurahan, $delivery_order_draft_ambil_kodepos, $delivery_order_draft_ambil_area, $delivery_order_draft_update_who, $delivery_order_draft_update_tgl, $delivery_order_draft_approve_who, $delivery_order_draft_approve_tgl, $delivery_order_draft_reject_who, $delivery_order_draft_reject_tgl, $delivery_order_draft_reject_reason, $tipe_delivery_order_id);

		//insert ke tr_pemusnahan_stok_detail_draft

		$this->M_SalesOrder->delete_delivery_order_detail_draft($delivery_order_draft_id);
		foreach ($detail as $key => $value) {
			$this->M_SalesOrder->insert_delivery_order_detail_draft($delivery_order_draft_id, $value);
		}

		$this->M_SalesOrder->confirm_delivery_order_draft($delivery_order_draft_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function reject_delivery_order_draft()
	{
		$delivery_order_draft_id = $this->input->post('delivery_order_draft_id');
		$this->db->trans_begin();

		$this->M_SalesOrder->reject_delivery_order_draft($delivery_order_draft_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function GetSalesOrderByFilter()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$do_no = $this->input->post('do_no');
		$customer = $this->input->post('customer');
		$alamat = $this->input->post('alamat');
		$tipe_pembayaran = $this->input->post('tipe_pembayaran');
		$tipe_layanan = $this->input->post('tipe_layanan');
		$status = $this->input->post('status');
		$tipe = $this->input->post('tipe');

		$data = $this->M_SalesOrder->GetSalesOrderByFilter($tgl1, $tgl2, $do_no, $customer, $alamat, $tipe_pembayaran, $tipe_layanan, $status, $tipe);

		echo json_encode($data);
	}

	public function GetSalesOrderByListId()
	{
		$id = $this->input->post('arr_sales_order');
		$arr_temp = $this->input->post('arr_temp');

		$arrLastUpdate = [];
		foreach ($arr_temp as $key => $value) {
			$so_id = $value['so_id'];
			$sales_order_tgl_update = $this->db->query("SELECT sales_order_tgl_update FROM sales_order where sales_order_id = '$so_id'")->row()->sales_order_tgl_update;

			if ($sales_order_tgl_update != $value['tglUpdate']) {
				array_push($arrLastUpdate, $sales_order_tgl_update);
			}
		}

		if (count($arrLastUpdate) > 0) {
			echo json_encode(400);
		} else {
			$data['SOHeader'] = $this->M_SalesOrder->GetSalesOrderByListId($id);
			echo json_encode($data);
		}
	}

	public function GetSalesOrderDetailByListId()
	{
		$id = $this->input->post('id');
		$data['SODetail'] = $this->M_SalesOrder->GetSalesOrderDetailByListId($id);

		echo json_encode($data);
	}

	public function GetPerusahaanById()
	{
		$id = $this->input->post('id');
		$data = $this->M_SalesOrder->GetPerusahaanById($id);

		echo json_encode($data);
	}

	public function GetPerusahaanBySales()
	{
		$sales = $this->input->post('sales');
		$data = $this->M_SalesOrder->GetPerusahaanBySales($sales);

		echo json_encode($data);
	}

	public function getPrinciple()
	{
		$perusahaanID = $this->input->post('perusahaanID');
		$data = $this->M_SalesOrder->getPrinciple($perusahaanID);

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp_all()
	{
		$data = $this->M_SalesOrder->delete_sales_order_detail_2_temp_all();

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrder->delete_sales_order_detail_2_temp($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_so_detail2_sementara()
	{
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2 = $this->input->post('arr_so_detail2');

		$data = $this->M_SalesOrder->get_so_detail2_sementara($sku_id, $arr_so_detail2);

		echo json_encode($data);
	}

	public function Get_delivery_order_detail2_by_filter()
	{
		$delivery_order_id = $this->input->post('delivery_order_id');
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2_ed = $this->input->post('arr_so_detail2_ed');

		$data = $this->M_SalesOrder->Get_delivery_order_detail2_by_filter($delivery_order_id, $sku_id, $arr_so_detail2_ed);

		echo json_encode($data);
	}

	public function generate_canvas()
	{
		$canvas_id = $this->M_Vrbl->Get_NewID();
		$canvas_id = $canvas_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_CVS';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;

		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_SalesOrder->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$canvas_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$sales_order_id = $this->input->post('sales_order_id');
		$sales_order_status = "Approved";

		$so_header = $this->M_SalesOrder->Get_sales_order_header_by_id_for_canvas($sales_order_id);
		$so_detail = $this->M_SalesOrder->Get_sales_order_detail_by_id_for_canvas($sales_order_id);

		$this->db->trans_begin();

		foreach ($so_header as $key => $value) {
			// $canvas_id = $value['canvas_id'];
			$depo_id = $value['depo_id'];
			// $canvas_kode = $value['canvas_kode'];
			$canvas_requestdate = $value['canvas_requestdate'];
			$client_wms_id = $value['client_wms_id'];
			$karyawan_id = $value['karyawan_id'];
			$kendaraan_id = $value['kendaraan_id'];
			$canvas_keterangan = $value['canvas_keterangan'];
			$canvas_startdate = $value['canvas_startdate'];
			$canvas_enddate = $value['canvas_enddate'];
			$canvas_status = $value['canvas_status'];
			$canvas_tanggal_create = $value['canvas_tanggal_create'];
			$canvas_who_create = $value['canvas_who_create'];
			$canvas_reff_kode = $value['canvas_reff_kode'];
			$client_pt_id = $value['client_pt_id'];
			$canvas_tgl_update = $value['canvas_tgl_update'];
			$canvas_who_update = $value['canvas_who_update'];
			$principle_id = $value['principle_id'];

			$this->M_SalesOrder->insert_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $kendaraan_id, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create, $canvas_reff_kode, $client_pt_id, $canvas_tgl_update, $canvas_who_update, $principle_id);
		}

		foreach ($so_detail as $key => $value) {
			$canvas_detail_id = $this->M_Vrbl->Get_NewID();
			$canvas_detail_id = $canvas_detail_id[0]['NEW_ID'];

			// $canvas_detail_id = $value['canvas_detail_id'];
			// $canvas_id = $value['canvas_id'];
			$sku_id = $value['sku_id'];
			$sku_kode = $value['sku_kode'];
			$sku_nama = $value['sku_nama'];
			$sku_kemasan = $value['sku_kemasan'];
			$sku_satuan = $value['sku_satuan'];
			$sku_qty = $value['sku_qty'];
			$sku_keterangan = $value['sku_keterangan'];
			$tipe_stock_nama = $value['tipe_stock_nama'];

			$this->M_SalesOrder->insert_canvas_detail($canvas_detail_id, $canvas_id, $sku_id, $sku_kode, $sku_nama, $sku_kemasan, $sku_satuan, $sku_qty, $sku_keterangan, $tipe_stock_nama);
		}

		$this->M_SalesOrder->update_sales_order_status($sales_order_id, $sales_order_status);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insertExecProsesSimulasiMPS()
	{
		$tgl_kirim = $this->input->post("tgl_kirim");
		$tgl_kirim = date('Y-m-d', strtotime(str_replace("/", "-", $tgl_kirim)));
		$arrSKUCheck = $this->input->post("arrSKUCheck");
		$id_temp2 = $this->input->post("id_temp2");

		$arrCheck = [];

		$this->db->trans_begin();

		foreach ($arrSKUCheck as $value) {
			$this->M_SalesOrder->insertSimulasiMPSTemp2($value['sku_id'], $value['qty'], $tgl_kirim, $id_temp2);

			$resultExec = $this->M_SalesOrder->ExecProsesSimulasiMPS(date("Y"), $value['sku_id'], $id_temp2);

			foreach ($resultExec as $value2) {

				//$this->M_SalesOrder->insertSimulasiMPSTemp($value2, $id_temp2);

				if ($value2['urut'] == 4) {
					if ($value2['0'] < 0 || $value2['1'] < 0 || $value2['2'] < 0 || $value2['3'] < 0 || $value2['4'] < 0 || $value2['5'] < 0 || $value2['6'] < 0 || $value2['7'] < 0 || $value2['8'] < 0 || $value2['9'] < 0 || $value2['10'] < 0 || $value2['11'] < 0 || $value2['12'] < 0) {
						$arrCheck[] = 'Tidak Cukup';
					} else {
						$arrCheck[] = 'Cukup';
					}
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode($arrCheck);
		}
	}

	public function execProsesSimulasiMPSSingle()
	{
		$tgl_kirim = $this->input->post("tgl_kirim");
		$tgl_kirim = date('Y-m-d', strtotime(str_replace("/", "-", $tgl_kirim)));
		$id_temp = $this->input->post("id_temp");
		$sku_id = $this->input->post("sku_id");
		$qty = $this->input->post("qty");

		$this->db->trans_begin();

		$this->M_SalesOrder->insertSimulasiMPSTemp2($sku_id, $qty, $tgl_kirim, $id_temp);

		$resultExec = $this->M_SalesOrder->ExecProsesSimulasiMPS(date("Y"), $sku_id, $id_temp);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode($resultExec);
		}
	}

	public function get_sku_harga_promo()
	{

		$data = array("detail" => array(), "detail_promo" => array());

		$client_wms_id = $this->input->post('client_wms_id');
		$client_pt_id = $this->input->post('client_pt_id');
		$client_pt_segmen_id = $this->input->post('client_pt_segmen_id');
		$tgl_harga = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('sales_order_tgl_harga'))));
		$detail = $this->input->post('detail');

		if (isset($detail) && count($detail) > 0) {

			foreach ($detail as $key => $value) {

				if ($value != "") {

					# code...
					$sku_id = $value['sku_id'];
					$sku_qty = $value['sku_qty'] != "" ? $value['sku_qty'] : 0;

					$sku_nominal_harga = $this->M_SalesOrder->Exec_sku_harga_jual($client_wms_id, $client_pt_segmen_id, $client_pt_id, $tgl_harga, $value['sku_id']);

					if ($value['sales_order_detail_tipe'] == "JUAL") {

						$sku_promo_list = $this->M_SalesOrder->Exec_sku_promo_jual($client_wms_id, $client_pt_segmen_id, $client_pt_id, $tgl_harga, $sku_id, $sku_qty, $sku_nominal_harga);

						$value['sku_harga_satuan'] = $sku_nominal_harga;

						array_push($data['detail'], $value);

						foreach ($sku_promo_list[0] as $k_promo => $v_promo) {

							$sku_harga_nett = ($sku_qty * $sku_nominal_harga) - $v_promo['value_diskon'];
							$ppn_percent = $value['sku_ppn_percent'];
							$ppn_rp = ($sku_harga_nett - $value['sku_diskon_global_rp']) * $ppn_percent / 100;

							// $data[$key]['sku_disc_percent'] = $v_promo['value_diskon_percent'];
							$data['detail'][$key]['sku_disc_promo_rp'] = $v_promo['value_diskon'];
							$data['detail'][$key]['sku_harga_nett'] = $sku_harga_nett;
							$data['detail'][$key]['ppn_rp'] = $ppn_rp;
						}

						foreach ($sku_promo_list[1] as $k_promo => $v_promo) {

							$random_id = $this->M_Vrbl->Get_NewID();
							$random_id = $random_id[0]['NEW_ID'];

							$data_promo = array(
								'client_wms_id' => $v_promo['client_wms_id'],
								'client_wms_tax' => $v_promo['client_wms_tax'],
								'principle_id' => $v_promo['principle_id'],
								'principle' => $v_promo['principle'],
								'brand' => $v_promo['brand'],
								'sku_id' => $v_promo['sku_id'],
								'sku_kode' => $v_promo['sku_kode'],
								'sku_nama_produk' => $v_promo['sku_nama_produk'],
								'sku_harga_satuan' => 0,
								'sku_disc_percent' => 0,
								'sku_disc_rp' => 0,
								'sku_harga_nett' => 0,
								'sku_weight' => $v_promo['sku_weight'],
								'sku_weight_unit' => $v_promo['sku_weight_unit'],
								'sku_length' => $v_promo['sku_length'],
								'sku_length_unit' => $v_promo['sku_length_unit'],
								'sku_width' => $v_promo['sku_width'],
								'sku_width_unit' => $v_promo['sku_width_unit'],
								'sku_height' => $v_promo['sku_height'],
								'sku_height_unit' => $v_promo['sku_height_unit'],
								'sku_volume' => $v_promo['sku_volume'],
								'sku_volume_unit' => $v_promo['sku_volume_unit'],
								'sku_qty' => $v_promo['so_sku_qty'],
								'sku_keterangan' => "",
								'sku_request_expdate' => $value['sku_request_expdate'],
								'sku_filter_expdate' => $value['sku_filter_expdate'],
								'sku_filter_expdatebulan' => $value['sku_filter_expdatebulan'],
								'sku_satuan' => $v_promo['sku_satuan'],
								'sku_kemasan' => $v_promo['sku_kemasan'],
								'tipe_stock_nama' => $value['tipe_stock_nama'],
								'sku_ppn_percent' => 0,
								'sku_ppn_rp' => 0,
								'random_id' => $random_id,
								'sku_diskon_global_percent' => 0,
								'sku_diskon_global_rp' => 0,
								'sales_order_detail_tipe' => 'BONUS',
								'sku_disc_promo_rp' => 0
							);

							array_push($data['detail'], $data_promo);
						}

						foreach ($sku_promo_list[2] as $k_promo => $v_promo) {

							$random_id = $this->M_Vrbl->Get_NewID();
							$random_id = $random_id[0]['NEW_ID'];

							$data_promo = array(
								'sku_id' => $v_promo['sku_id'],
								'sku_promo_id' => $v_promo['sku_promo_id'],
								'referensi_id' => $v_promo['referensi_id'],
								'referensi_diskon_kode' => $v_promo['referensi_diskon_kode'],
								'tipe' => $v_promo['tipe'],
								'sku_id_bonus' => $v_promo['sku_id_bonus'],
								'amount_diskon' => $v_promo['amount_diskon'],
								'qty_bonus' => $v_promo['qty_bonus']
							);

							array_push($data['detail_promo'], $data_promo);
						}
					}
				}
			}
		}

		echo json_encode($data);
	}

	public function get_so_detail_promo()
	{
		$sku_id = $this->input->post('sku_id');
		$tipe = $this->input->post('tipe');
		$detail_promo = $this->input->post('detail_promo');

		$data = $this->M_SalesOrder->get_so_detail_promo($sku_id, $tipe, $detail_promo);

		echo json_encode($data);
	}
}
