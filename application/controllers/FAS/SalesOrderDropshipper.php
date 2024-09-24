<?php

require_once APPPATH . 'core/ParentController.php';

class SalesOrderDropshipper extends ParentController
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

		$this->MenuKode = "215005000";
		$this->load->model('FAS/M_SalesOrderDropshipper', 'M_SalesOrderDropshipper');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Depo_Detail');
		$this->load->model('M_DataTable');
		$this->load->model('FAS/M_Principle', 'M_Principle');
	}

	public function SalesOrderDropshipperMenu()
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

		$data['Perusahaan'] 	= $this->M_SalesOrderDropshipper->GetPerusahaan();
		$data['Principle'] 		= $this->M_SalesOrderDropshipper->GetAllPrinciple();
		$data['Status'] 		= $this->M_SalesOrderDropshipper->GetStatusProgress();
		$data['TipeStock'] 		= $this->M_SalesOrderDropshipper->GetTipeStock();
		$data['TipeSalesOrder'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();
		$data['Sales'] 			= $this->M_SalesOrderDropshipper->GetSales();
		$data['Gudang'] 		= $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['tipe'] 			= $this->M_Depo_Detail->getTipeSO();
		$data['status'] 	    = $this->M_Depo_Detail->GetStatusSO();
		$data['TipeSOD'] 		= $this->M_SalesOrderDropshipper->GetTipeSalesOrderDetail();
		$data['act'] 			= "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrderDropshipper/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrderDropshipper/script', $data);
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

		$data['Perusahaan'] = $this->M_SalesOrderDropshipper->GetPerusahaan();
		$data['so_id'] = $so_id;
		$data['TipePelayanan'] = $this->M_SalesOrderDropshipper->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrderDropshipper->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrderDropshipper->GetArea();
		$data['Sales'] = $this->M_SalesOrderDropshipper->GetSales();
		$data['TipeStock'] = $this->M_SalesOrderDropshipper->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrderDropshipper->GetAllPrinciple();
		$data['SODropshipper'] 	= $this->M_SalesOrderDropshipper->Get_sales_order_dropshipper();
		$data['TipeSOD'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrderDetail();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrderDropshipper/form', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrderDropshipper/s_form', $data);
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
		$data['SOHeader'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetail2ById($id);
		$data['Perusahaan'] = $this->M_SalesOrderDropshipper->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrderDropshipper->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrderDropshipper->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrderDropshipper->GetArea();
		$data['Sales'] = $this->M_SalesOrderDropshipper->GetSales();
		$data['TipeStock'] = $this->M_SalesOrderDropshipper->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrderDropshipper->GetAllPrinciple();
		$data['SODropshipper'] 	= $this->M_SalesOrderDropshipper->Get_sales_order_dropshipper();
		$data['TipeSOD'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrderDetail();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrderDropshipper/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrderDropshipper/s_form', $data);
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
		$data['SOHeader'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetail2ById($id);
		$data['Perusahaan'] = $this->M_SalesOrderDropshipper->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrderDropshipper->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrderDropshipper->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrderDropshipper->GetArea();
		$data['Sales'] = $this->M_SalesOrderDropshipper->GetSales();
		$data['TipeStock'] = $this->M_SalesOrderDropshipper->GetTipeStock();
		$data['Principle'] = $this->M_Principle->Get_Principle();
		$data['Gudang'] = $this->M_Depo_Detail->Getdepo_detail_by_depo_detail_flag_qa();
		$data['Principle'] 		= $this->M_SalesOrderDropshipper->GetAllPrinciple();
		$data['SODropshipper'] 	= $this->M_SalesOrderDropshipper->Get_sales_order_dropshipper();
		$data['TipeSOD'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrderDetail();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrderDropshipper/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		// $this->load->view('FAS/SalesOrderDropshipper/script', $data);
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

		$id = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperId($this->input->get('kode'));
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['so_id'] = $id;
		$data['SOHeader'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperHeaderById($id);
		$data['SODetail'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetailById($id);
		$data['SODetail2'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetail2ById($id);
		$data['Perusahaan'] = $this->M_SalesOrderDropshipper->GetPerusahaan();
		$data['TipePelayanan'] = $this->M_SalesOrderDropshipper->GetTipeLayanan();
		$data['TipeSalesOrder'] = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();
		$data['TipeDeliveryOrder'] = $this->M_SalesOrderDropshipper->GetTipeDeliveryOrder();
		$data['Area'] = $this->M_SalesOrderDropshipper->GetArea();
		$data['Sales'] = $this->M_SalesOrderDropshipper->GetSales();
		$data['TipeStock'] = $this->M_SalesOrderDropshipper->GetTipeStock();
		$data['Principle'] 		= $this->M_SalesOrderDropshipper->GetAllPrinciple();
		$data['SODropshipper'] 	= $this->M_SalesOrderDropshipper->Get_sales_order_dropshipper();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/SalesOrderDropshipper/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SalesOrderDropshipper/script', $data);
	}

	public function GetSelectedSKU()
	{
		$arr_sales_order_detail_temp = array();

		$so_id = $this->input->post('so_id');
		$arr_sales_order_detail = $this->input->post('arr_sales_order_detail');
		$so_drop_id = $this->input->post('so_drop_id');
		$sku_id = $this->input->post('sku_id');
		$tgl_harga = $this->input->post('tgl_harga');
		$tgl_harga = date('Y-m-d', strtotime(str_replace("/", "-", $tgl_harga)));

		if (isset($arr_sales_order_detail) && count($arr_sales_order_detail) > 0) {

			foreach ($arr_sales_order_detail as $key => $value) {
				if ($value != "") {
					array_push($arr_sales_order_detail_temp, $value);
				}
			}
		}

		$data = $this->M_SalesOrderDropshipper->GetSelectedSKU($so_id, $sku_id, $tgl_harga, $so_drop_id, $arr_sales_order_detail_temp);

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

		// $data = $this->M_SalesOrderDropshipper->GetCustomerByTypePelayanan($perusahaan, $sales, $tipe_pembayaran, $nama, $alamat, $telp, $area);

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

		$data = $this->M_SalesOrderDropshipper->GetSelectedPrinciple($customer, $perusahaan);

		echo json_encode($data);
	}

	public function GetSelectedCustomer()
	{
		$customer = $this->input->post('customer');
		$sales = $this->input->post('sales');

		$data = $this->M_SalesOrderDropshipper->GetSelectedCustomer($customer, $sales);

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

		$totalData 		= $this->M_SalesOrderDropshipper->GetTotalSalesOrderDropshipperByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

		$totalFiltered 	= $totalData;

		if (empty($this->input->post('search')['value'])) {
			$data 		= $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);
		} else {
			$search 	= $_POST['search']['value'];
			$data 		= $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority);

			$datacount 	= $this->M_SalesOrderDropshipper->GetTotalSalesOrderDropshipperByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority);

			$totalFiltered = $datacount;
		}

		$data = array(
			"draw" => intval($draw),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($data);


		// $data = $this->M_SalesOrderDropshipper->search_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim);
		// $tipeSalesOrderDropshipper = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();

		// $response = [
		// 	'data' => $data,
		// 	'tipeSalesOrderDropshipper' => $tipeSalesOrderDropshipper
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

		$data = $this->M_SalesOrderDropshipper->searchEdit_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle);
		$tipeSalesOrderDropshipper = $this->M_SalesOrderDropshipper->GetTipeSalesOrder();

		$response = [
			'data' => $data,
			'tipeSalesOrderDropshipper' => $tipeSalesOrderDropshipper
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

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_header_by_id($sales_order_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_header_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_header_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_header_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_by_id($sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id2()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_by_id2($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_ed_sku_by_id3()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->get_ed_sku_by_id3($so_id, $sku_id);

		echo json_encode($data);
	}

	public function search_filter_chosen_sku()
	{
		$filter_sku = array();

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
		$sales_order_id = $this->input->post('sales_order_id');
		$arr_sales_order_detail = $this->input->post('arr_sales_order_detail');

		if (isset($arr_sales_order_detail) && count($arr_sales_order_detail) > 0) {
			foreach ($arr_sales_order_detail as $key => $value) {
				if ($value != "") {
					array_push($filter_sku, "'" . $value['sku_id'] . "'");
				}
			}
		}

		$data = $this->M_SalesOrderDropshipper->search_filter_chosen_sku($perusahaan, $sales, $client_pt, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan, $sales_order_id, $filter_sku);

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

		$data = $this->M_SalesOrderDropshipper->search_filter_chosen_sku_by_pabrik($client_pt, $perusahaan, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan);

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
		$tipe_ppn = $this->input->post('tipe_ppn');
		$keterangan = $this->input->post('keterangan');

		$data_sku_error = array();

		$so_id = $this->M_Vrbl->Get_NewID();
		$so_id = $so_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_SO';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_SalesOrderDropshipper->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$so_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_SO_01";

		$arr_sisa_qty = $this->M_SalesOrderDropshipper->cek_sisa_qty_sales_order_reff($sales_order_no_reff, $detail);

		foreach ($arr_sisa_qty as $key => $value) {
			if ($value['is_cocok'] == "0") {
				array_push($data_sku_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
			}
		}

		if (count($data_sku_error) > 0) {
			echo json_encode(array("kode" => "400", "message" => "sisa qty tidak mencukupi", "data" => $data_sku_error));
			die;
		}

		$this->db->trans_begin();

		$this->M_SalesOrderDropshipper->insert_sales_order($so_id, $depo_id, $so_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff, $principle_id, $total_global, $diskon_global_percent, $diskon_global_rp, $dasar_kena_pajak, $ppn_global_percent, $ppn_global_rp, $adjustment, $total_faktur, $total_diskon_item, $tipe_ppn, $keterangan);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrderDropshipper->insert_sales_order_detail($so_id, $sod_id, $value);
			// $this->M_SalesOrderDropshipper->insert_sales_order_detail2($sod_id, $value['sku_id']);
			// $this->M_SalesOrderDropshipper->insert_sales_order_detail2($so_id, $value);
		}

		$this->M_SalesOrderDropshipper->delete_sales_order_detail_2_temp_all();

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrderDropshipper->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $so_id, $so_kode, 0, 0);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(array("kode" => "500", "message" => "error", "data" => array()));
		} else {
			$this->db->trans_commit();
			echo json_encode(array("kode" => "200", "message" => "success", "data" => array()));
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

		$data_sku_error = array();

		$arr_sisa_qty = $this->M_SalesOrderDropshipper->cek_sisa_qty_sales_order_reff($sales_order_no_reff, $detail);

		foreach ($arr_sisa_qty as $key => $value) {
			if ($value['is_cocok'] == "0") {
				array_push($data_sku_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
			}
		}

		if (count($data_sku_error) > 0) {
			echo json_encode(array("kode" => "401", "message" => "sisa qty tidak mencukupi", "data" => $data_sku_error));
			die;
		}

		$this->db->trans_begin();

		$this->M_SalesOrderDropshipper->update_sales_order($sales_order_id, $depo_id, $sales_order_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff, $principle_id, $total_global, $diskon_global_percent, $diskon_global_rp, $dasar_kena_pajak, $ppn_global_percent, $ppn_global_rp, $adjustment, $total_faktur, $total_diskon_item, $tipe_ppn, $keterangan);

		$this->M_SalesOrderDropshipper->delete_sales_order_detail_2($sales_order_id);
		$this->M_SalesOrderDropshipper->delete_sales_order_detail($sales_order_id);

		foreach ($detail as $key => $value) {
			$sod_id = $this->M_Vrbl->Get_NewID();
			$sod_id = $sod_id[0]['NEW_ID'];

			$this->M_SalesOrderDropshipper->insert_sales_order_detail($sales_order_id, $sod_id, $value);
			// $this->M_SalesOrderDropshipper->insert_sales_order_detail2($sod_id, $value['sku_id']);
			// $this->M_SalesOrderDropshipper->insert_sales_order_detail2($so_id, $value);
		}

		$this->M_SalesOrderDropshipper->delete_sales_order_detail_2_temp_all();

		if ($so_is_need_approval == "1") {
			$this->M_SalesOrderDropshipper->Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $sales_order_id, $sales_order_kode, 0, 0);
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

	public function confirm_sales_order()
	{
		$sales_order_id = $this->input->post('sales_order_id');
		$tgl_update = $this->input->post('tgl_update');

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "sales_order",
			'whereField' => "sales_order_id",
			'whereValue' => $sales_order_id,
			'fieldDateUpdate' => "sales_order_tgl_update",
			'fieldWhoUpdate' => "sales_order_who_update",
			'lastUpdated' => $tgl_update
		]);

		$data_sku_error = array();

		$this->db->trans_begin();

		$cek_error = $this->M_SalesOrderDropshipper->confirm_sales_order($sales_order_id);

		if (count($cek_error) > 0) {
			foreach ($cek_error as $key => $value) {
				array_push($data_sku_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
			}
		}

		if (count($data_sku_error) > 0) {
			echo json_encode(array("status" => "401", "message" => "sisa qty tidak mencukupi", "data" => $data_sku_error));
			$this->db->trans_rollback();
		} else {
			echo json_encode(responseJson((object)[
				'lastUpdatedChecked' => $lastUpdatedChecked,
				'status' => 'Disimpan'
			]));
		}

		// echo json_encode(401);
		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	echo json_encode(0);
		// } else {
		// 	$this->db->trans_commit();
		// 	echo json_encode(1);
		// }
	}

	public function updateDataSalesOrderDropshipper()
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
		$this->M_SalesOrderDropshipper->update_delivery_order_draft($delivery_order_draft_id, $sales_order_id, $delivery_order_draft_kode, $delivery_order_draft_yourref, $client_wms_id, $delivery_order_draft_tgl_buat_do, $delivery_order_draft_tgl_expired_do, $delivery_order_draft_tgl_surat_jalan, $delivery_order_draft_tgl_rencana_kirim, $delivery_order_draft_tgl_aktual_kirim, $delivery_order_draft_keterangan, $delivery_order_draft_status, $delivery_order_draft_is_prioritas, $delivery_order_draft_is_need_packing, $delivery_order_draft_tipe_layanan, $delivery_order_draft_tipe_pembayaran, $delivery_order_draft_sesi_pengiriman, $delivery_order_draft_request_tgl_kirim, $delivery_order_draft_request_jam_kirim, $tipe_pengiriman_id, $nama_tipe, $confirm_rate, $delivery_order_draft_reff_id, $delivery_order_draft_reff_no, $delivery_order_draft_total, $unit_mandiri_id, $depo_id, $client_pt_id, $delivery_order_draft_kirim_nama, $delivery_order_draft_kirim_alamat, $delivery_order_draft_kirim_telp, $delivery_order_draft_kirim_provinsi, $delivery_order_draft_kirim_kota, $delivery_order_draft_kirim_kecamatan, $delivery_order_draft_kirim_kelurahan, $delivery_order_draft_kirim_kodepos, $delivery_order_draft_kirim_area, $delivery_order_draft_kirim_invoice_pdf, $delivery_order_draft_kirim_invoice_dir, $pabrik_id, $delivery_order_draft_ambil_nama, $delivery_order_draft_ambil_alamat, $delivery_order_draft_ambil_telp, $delivery_order_draft_ambil_provinsi, $delivery_order_draft_ambil_kota, $delivery_order_draft_ambil_kecamatan, $delivery_order_draft_ambil_kelurahan, $delivery_order_draft_ambil_kodepos, $delivery_order_draft_ambil_area, $delivery_order_draft_update_who, $delivery_order_draft_update_tgl, $delivery_order_draft_approve_who, $delivery_order_draft_approve_tgl, $delivery_order_draft_reject_who, $delivery_order_draft_reject_tgl, $delivery_order_draft_reject_reason, $tipe_delivery_order_id);

		//insert ke tr_pemusnahan_stok_detail_draft

		$this->M_SalesOrderDropshipper->delete_delivery_order_detail_draft($delivery_order_draft_id);
		foreach ($detail as $key => $value) {
			$this->M_SalesOrderDropshipper->insert_delivery_order_detail_draft($delivery_order_draft_id, $value);
		}

		$this->M_SalesOrderDropshipper->confirm_delivery_order_draft($delivery_order_draft_id);

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

		$this->M_SalesOrderDropshipper->reject_delivery_order_draft($delivery_order_draft_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function GetSalesOrderDropshipperByFilter()
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

		$data = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperByFilter($tgl1, $tgl2, $do_no, $customer, $alamat, $tipe_pembayaran, $tipe_layanan, $status, $tipe);

		echo json_encode($data);
	}

	public function GetSalesOrderDropshipperByListId()
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
			$data['SOHeader'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperByListId($id);
			echo json_encode($data);
		}
	}

	public function GetSalesOrderDropshipperDetailByListId()
	{
		$id = $this->input->post('id');
		$data['SODetail'] = $this->M_SalesOrderDropshipper->GetSalesOrderDropshipperDetailByListId($id);

		echo json_encode($data);
	}

	public function GetPerusahaanById()
	{
		$id = $this->input->post('id');
		$data = $this->M_SalesOrderDropshipper->GetPerusahaanById($id);

		echo json_encode($data);
	}

	public function GetPerusahaanBySales()
	{
		$sales = $this->input->post('sales');
		$data = $this->M_SalesOrderDropshipper->GetPerusahaanBySales($sales);

		echo json_encode($data);
	}

	public function getPrinciple()
	{
		$perusahaanID = $this->input->post('perusahaanID');
		$data = $this->M_SalesOrderDropshipper->getPrinciple($perusahaanID);

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp_all()
	{
		$data = $this->M_SalesOrderDropshipper->delete_sales_order_detail_2_temp_all();

		echo json_encode($data);
	}

	public function delete_sales_order_detail_2_temp()
	{
		$so_id = $this->input->post('so_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_SalesOrderDropshipper->delete_sales_order_detail_2_temp($so_id, $sku_id);

		echo json_encode($data);
	}

	public function get_so_detail2_sementara()
	{
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2 = $this->input->post('arr_so_detail2');

		$data = $this->M_SalesOrderDropshipper->get_so_detail2_sementara($sku_id, $arr_so_detail2);

		echo json_encode($data);
	}

	public function Get_delivery_order_detail2_by_filter()
	{
		$delivery_order_id = $this->input->post('delivery_order_id');
		$sku_id = $this->input->post('sku_id');
		$arr_so_detail2_ed = $this->input->post('arr_so_detail2_ed');

		$data = $this->M_SalesOrderDropshipper->Get_delivery_order_detail2_by_filter($delivery_order_id, $sku_id, $arr_so_detail2_ed);

		echo json_encode($data);
	}

	public function Get_data_sales_order_dropshipper_by_id()
	{
		$sales_order_id = $this->input->get('sales_order_id');

		$data = $this->M_SalesOrderDropshipper->Get_data_sales_order_dropshipper_by_id($sales_order_id);

		echo json_encode($data);
	}
}
