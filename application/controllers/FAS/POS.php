<?php

require_once APPPATH . 'core/ParentController.php';

class POS extends ParentController
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

		$this->MenuKode = "215100100";
		$this->load->model('FAS/M_POS', 'M_POS');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Depo_Detail');
		$this->load->model('FAS/M_Principle', 'M_Principle');
	}

	public function POSMenu()
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

		$data['Perusahaan'] 	= $this->M_POS->GetPerusahaan();
		$data['Status'] 		= $this->M_POS->GetStatusProgress();
		$data['TipeStock'] 		= $this->M_POS->GetTipeStock();
		$data['TipeSalesOrder'] = $this->M_POS->GetTipeSalesOrder();
		$data['Sales'] 			= $this->M_POS->GetSales();
		$data['Gudang'] 		= $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['tipe'] 			= $this->M_Depo_Detail->getTipeSO();
		$data['status'] 	    = $this->M_Depo_Detail->GetStatusSO();
		$data['act'] 			= "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/POS/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/POS/script', $data);
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

		$query['Ses_UserName'] = $this->session->userdata('UserName');

		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		$data['Perusahaan'] = $this->M_POS->GetPerusahaan();
		$data['so_id'] = $so_id;
		$data['TipePelayanan'] = $this->M_POS->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_POS->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_POS->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_POS->GetArea();
		$data['Sales'] = $this->M_POS->GetSales();
		$data['TipeStock'] = $this->M_POS->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/POS/form', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/POS/script', $data);
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

		$query['Ses_UserName'] = $this->session->userdata('UserName');

		$id = $this->input->get('id');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_POS->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_POS->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_POS->GetSalesOrderDetail2ById($id);
		$data['SOPayment'] = $this->M_POS->GetSalesOrderPaymentById($id);
		$data['Perusahaan'] = $this->M_POS->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_POS->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_POS->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_POS->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_POS->GetArea();
		$data['Sales'] = $this->M_POS->GetSales();
		$data['TipeStock'] = $this->M_POS->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/POS/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/POS/script', $data);
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
		$data['SOHeader'] = $this->M_POS->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_POS->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_POS->GetSalesOrderDetail2ById($id);
		$data['SOPayment'] = $this->M_POS->GetSalesOrderPaymentById($id);
		$data['Perusahaan'] = $this->M_POS->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_POS->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_POS->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_POS->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_POS->GetArea();
		$data['Sales'] = $this->M_POS->GetSales();
		$data['TipeStock'] = $this->M_POS->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/POS/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/POS/script', $data);
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

		$id = $this->M_POS->GetSalesOrderId($this->input->get('kode'));
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_POS->GetSalesOrderHeaderById($id);
		$data['SODetail'] = $this->M_POS->GetSalesOrderDetailById($id);
		$data['SODetail2'] = $this->M_POS->GetSalesOrderDetail2ById($id);
		$data['Perusahaan'] = $this->M_POS->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_POS->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_POS->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_POS->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_POS->GetArea();
		$data['Sales'] = $this->M_POS->GetSales();
		$data['TipeStock'] = $this->M_POS->GetTipeStock();
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
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->GetSelectedSKU($so_id, $sku_id);

		echo json_encode($data);
	}

	public function GetCustomerByTypePelayanan()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');
		$client_pt_id = $this->input->post('client_pt_id');

		$data = $this->M_POS->GetCustomerByTypePelayanan($nama, $alamat, $telp, $client_pt_id);

		echo json_encode($data);
	}

	public function GetSelectedPrinciple()
	{
		$customer = $this->input->post('customer');
		$perusahaan = $this->input->post('perusahaan');

		$data = $this->M_POS->GetSelectedPrinciple($customer, $perusahaan);

		echo json_encode($data);
	}

	public function GetSelectedCustomer()
	{
		$customer = $this->input->post('customer');

		$data = $this->M_POS->GetSelectedCustomer($customer);

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

		$totalData 		= $this->M_POS->GetTotalSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

		$totalFiltered 	= $totalData;

		if (empty($this->input->post('search')['value'])) {
			$data 		= $this->M_POS->GetSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);
		} else {
			$search 	= $_POST['search']['value'];
			$data 		= $this->M_POS->GetSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);

			$datacount 	= $this->M_POS->GetTotalSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

			$totalFiltered = $datacount;
		}

		$data = array(
			"draw" => intval($draw),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($data);


		// $data = $this->M_POS->search_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim);
		// $tipeSalesOrder = $this->M_POS->GetTipeSalesOrder();

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

		$data = $this->M_POS->searchEdit_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle);
		$tipeSalesOrder = $this->M_POS->GetTipeSalesOrder();

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

		$data = $this->M_POS->get_ed_sku_header_by_id($sales_order_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->get_ed_sku_header_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->get_ed_sku_header_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->get_ed_sku_by_id($sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->get_ed_sku_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->get_ed_sku_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function search_filter_chosen_sku()
	{
		$filter_sku_stock_id = array();
		$brand = $this->input->post('brand');
		$principle = $this->input->post('principle');
		$sku_induk = $this->input->post('sku_induk');
		$sku_nama_produk = $this->input->post('sku_nama_produk');
		$sku_kemasan = $this->input->post('sku_kemasan');
		$sku_satuan = $this->input->post('sku_satuan');
		$arr_sales_order_detail = $this->input->post('arr_sales_order_detail');

		if (isset($arr_sales_order_detail)) {
			if (count($arr_sales_order_detail) > 0) {
				foreach ($arr_sales_order_detail as $value) {
					if ($value['sku_stock_id'] != "" && $value['sku_stock_id'] != null) {
						array_push($filter_sku_stock_id, "'" . $value['sku_stock_id'] . "'");
					}
				}
			} else {
				$filter_sku_stock_id = array();
			}
		} else {
			$filter_sku_stock_id = array();
		}

		$data = $this->M_POS->search_filter_chosen_sku($brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan, $filter_sku_stock_id);

		echo json_encode($data);
	}

	public function Get_sales_order_by_top_retur_default()
	{
		$client_pt_id = $this->input->post('client_pt_id');

		$data = $this->M_POS->Get_sales_order_by_top_retur_default($client_pt_id);

		echo json_encode($data);
	}

	public function Get_list_sales_order_detail()
	{
		$arr_sales_order_detail = $this->input->post('arr_sales_order_detail');

		$data = $this->M_POS->Get_list_sales_order_detail($arr_sales_order_detail);

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

			$data = $this->M_POS->Get_sales_order_by_top_retur($top, $client_pt_id, $sku_id);
			echo json_encode($data);
		}
	}

	public function search_filter_chosen_sku_retur()
	{
		$sales_order_id = $this->input->post('sales_order_id');

		$data = $this->M_POS->search_filter_chosen_sku_retur($sales_order_id);

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

		$data = $this->M_POS->search_filter_chosen_sku_by_pabrik($client_pt, $perusahaan, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan);

		echo json_encode($data);
	}

	public function insert_sales_order()
	{
		// $sales_order_id = $this->input->post('sales_order_id');
		$depo_id = $this->input->post('depo_id');
		// $sales_order_kode = $this->input->post('sales_order_kode');
		$client_wms_id = $this->input->post('client_wms_id');
		$channel_id = $this->input->post('channel_id');
		$sales_order_is_handheld = $this->input->post('sales_order_is_handheld');
		$sales_order_status = "Draft";
		// $sales_order_status = $this->input->post('sales_order_status');
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
		$total_kurang_bayar = $this->input->post('total_kurang_bayar');

		$detail = $this->input->post('detail');
		$payment = $this->input->post('payment');

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_SO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_POS->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$so_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_SO_01";

		$pallet_id = $this->M_POS->Get_pallet_pos();

		$this->db->trans_begin();

		$this->M_POS->insert_sales_order($so_id, $depo_id, $so_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff);

		$so_detail = $this->M_POS->Get_sales_order_detail_temp_by_so_id($so_id, $detail);

		foreach ($so_detail as $key => $value) {
			$sales_order_detail_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail_id = $sales_order_detail_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail($so_id, $sales_order_detail_id, $value);
		}

		$so_detail2 = $this->M_POS->Get_sales_order_detail2_temp_by_so_id($so_id, $detail);

		foreach ($so_detail2 as $key => $value) {
			$sales_order_detail2_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail2_id = $sales_order_detail2_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail2($sales_order_detail2_id, $value);
		}

		foreach ($payment as $key => $value) {
			$sales_order_detail_payment_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail_payment_id = $sales_order_detail_payment_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail_payment($sales_order_detail_payment_id, $so_id, $value);
		}

		if ((int) $total_kurang_bayar <= 0) {
			$sales_order_status = "Approved";
			$tipe_sku_stock = "keluar";
			$tipe_pallet = "sku_stock_out";

			$this->M_POS->update_sales_order_status($so_id, $sales_order_status);

			foreach ($detail as $key => $value) {
				$this->M_POS->Exec_insertupdate_sku_stock($tipe_sku_stock, $value['sku_stock_id'], "", $value['sku_qty']);
				$this->M_POS->Exec_insertupdate_sku_stock_pallet($tipe_pallet, $pallet_id, $value['sku_stock_id'], $value['sku_qty']);
			}

			if ($client_pt_id != "") {

				$delivery_order_draft_id = $this->M_Vrbl->Get_NewID();
				$delivery_order_draft_id = $delivery_order_draft_id[0]['NEW_ID'];

				//generate kode
				$param_dod =  'KODE_DOD';
				$vrbl_dod = $this->M_Vrbl->Get_Kode($param_dod);

				$prefix_dod = $vrbl_dod->vrbl_kode;
				$delivery_order_draft_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix_dod, $unit);

				$this->M_POS->Insert_delivery_order_draft_from_sales_order($so_id, $delivery_order_draft_id, $delivery_order_draft_kode);

				$so_detail = $this->M_POS->GetSalesOrderDetailByListId($so_id);

				foreach ($so_detail as $key => $value) {
					$delivery_order_detail_draft_id = $this->M_Vrbl->Get_NewID();
					$delivery_order_detail_draft_id = $delivery_order_detail_draft_id[0]['NEW_ID'];

					$this->M_POS->Insert_delivery_order_detail_draft_from_sales_order($value['sales_order_detail_id'], $delivery_order_draft_id, $delivery_order_detail_draft_id);

					$this->M_POS->Insert_delivery_order_detail2_draft_from_sales_order($value['sales_order_detail_id'], $delivery_order_draft_id, $delivery_order_detail_draft_id);
				}
			}
		}

		// echo "tes";
		// $this->db->trans_rollback();
		// die;

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
		$sales_order_status = "Draft";
		// $sales_order_status = $this->input->post('sales_order_status');
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
		$tgl_update = $this->input->post('tgl_update');
		$total_kurang_bayar = $this->input->post('total_kurang_bayar');

		$detail = $this->input->post('detail');
		$payment = $this->input->post('payment');

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_POS->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;

		$pallet_id = $this->M_POS->Get_pallet_pos();

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "sales_order",
			'whereField' => "sales_order_id",
			'whereValue' => $sales_order_id,
			'fieldDateUpdate' => "sales_order_tgl_update",
			'fieldWhoUpdate' => "sales_order_who_update",
			'lastUpdated' => $tgl_update
		]);

		if ($lastUpdatedChecked['status'] == 400) {
			echo json_encode(2);
			return false;
		}

		$this->db->trans_begin();

		$this->M_POS->update_sales_order($sales_order_id, $depo_id, $sales_order_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff);

		$this->M_POS->delete_sales_order_detail_2($sales_order_id);
		$this->M_POS->delete_sales_order_detail($sales_order_id);
		$this->M_POS->delete_sales_order_detail_payment($sales_order_id);

		$so_detail = $this->M_POS->Get_sales_order_detail_temp_by_so_id($sales_order_id, $detail);

		foreach ($so_detail as $key => $value) {
			$sales_order_detail_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail_id = $sales_order_detail_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail($sales_order_id, $sales_order_detail_id, $value);
		}

		$so_detail2 = $this->M_POS->Get_sales_order_detail2_temp_by_so_id($sales_order_id, $detail);

		foreach ($so_detail2 as $key => $value) {
			$sales_order_detail2_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail2_id = $sales_order_detail2_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail2($sales_order_detail2_id, $value);
		}

		foreach ($payment as $key => $value) {
			$sales_order_detail_payment_id = $this->M_Vrbl->Get_NewID();
			$sales_order_detail_payment_id = $sales_order_detail_payment_id[0]['NEW_ID'];

			$this->M_POS->insert_sales_order_detail_payment($sales_order_detail_payment_id, $sales_order_id, $value);
		}

		if ((int) $total_kurang_bayar <= 0) {
			$sales_order_status = "Approved";
			$tipe_sku_stock = "keluar";
			$tipe_pallet = "sku_stock_out";

			$this->M_POS->update_sales_order_status($sales_order_id, $sales_order_status);

			foreach ($detail as $key => $value) {
				$this->M_POS->Exec_insertupdate_sku_stock($tipe_sku_stock, $value['sku_stock_id'], "", $value['sku_qty']);
				$this->M_POS->Exec_insertupdate_sku_stock_pallet($tipe_pallet, $pallet_id, $value['sku_stock_id'], $value['sku_qty']);
			}

			if ($client_pt_id != "") {

				$delivery_order_draft_id = $this->M_Vrbl->Get_NewID();
				$delivery_order_draft_id = $delivery_order_draft_id[0]['NEW_ID'];

				//generate kode
				$param_dod =  'KODE_DOD';
				$vrbl_dod = $this->M_Vrbl->Get_Kode($param_dod);

				$prefix_dod = $vrbl_dod->vrbl_kode;
				$delivery_order_draft_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix_dod, $unit);

				$this->M_POS->Insert_delivery_order_draft_from_sales_order($sales_order_id, $delivery_order_draft_id, $delivery_order_draft_kode);

				$so_detail = $this->M_POS->GetSalesOrderDetailByListId($sales_order_id);

				foreach ($so_detail as $key => $value) {
					$delivery_order_detail_draft_id = $this->M_Vrbl->Get_NewID();
					$delivery_order_detail_draft_id = $delivery_order_detail_draft_id[0]['NEW_ID'];

					$this->M_POS->Insert_delivery_order_detail_draft_from_sales_order($value['sales_order_detail_id'], $delivery_order_draft_id, $delivery_order_detail_draft_id);

					$this->M_POS->Insert_delivery_order_detail2_draft_from_sales_order($value['sales_order_detail_id'], $delivery_order_draft_id, $delivery_order_detail_draft_id);
				}
			}
		}

		// echo "tes";
		// $this->db->trans_rollback();
		// die;

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

		$data = $this->M_POS->GetSalesOrderByFilter($tgl1, $tgl2, $do_no, $customer, $alamat, $tipe_pembayaran, $tipe_layanan, $status, $tipe);

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
			$data['SOHeader'] = $this->M_POS->GetSalesOrderByListId($id);
			echo json_encode($data);
		}
	}

	public function GetSalesOrderDetailByListId()
	{
		$id = $this->input->post('id');
		$data['SODetail'] = $this->M_POS->GetSalesOrderDetailByListId($id);

		echo json_encode($data);
	}

	public function GetPerusahaanById()
	{
		$id = $this->input->post('id');
		$data = $this->M_POS->GetPerusahaanById($id);

		echo json_encode($data);
	}

	public function GetPerusahaanBySales()
	{
		$sales = $this->input->post('sales');
		$data = $this->M_POS->GetPerusahaanBySales($sales);

		echo json_encode($data);
	}

	public function getPrinciple()
	{
		$perusahaanID = $this->input->post('perusahaanID');
		$data = $this->M_POS->getPrinciple($perusahaanID);

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp_all()
	{
		$data = $this->M_POS->delete_sales_order_detail_2_temp_all();

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_POS->delete_sales_order_detail_2_temp($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_so_detail2_sementara()
	{
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2 = $this->input->post('arr_so_detail2');

		$data = $this->M_POS->get_so_detail2_sementara($sku_id, $arr_so_detail2);

		echo json_encode($data);
	}

	public function Get_delivery_order_detail2_by_filter()
	{
		$delivery_order_id = $this->input->post('delivery_order_id');
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2_ed = $this->input->post('arr_so_detail2_ed');

		$data = $this->M_POS->Get_delivery_order_detail2_by_filter($delivery_order_id, $sku_id, $arr_so_detail2_ed);

		echo json_encode($data);
	}
}
