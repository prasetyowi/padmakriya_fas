<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class AllotmentStockOrder extends ParentController
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage'));
		endif;

		$this->load->model('M_Menu');
		$this->load->model('FAS/Schedule/M_AllotmentStockOrder', 'M_AllotmentStockOrder');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');

		$this->MenuKode = "217403000";
	}

	public function AllotmentStockOrderMenu()
	{

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
			redirect(base_url('Main/MainDepo/MainDepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Perusahaan'] = $this->M_AllotmentStockOrder->GetPerusahaan();
		$data['act'] = "index";

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

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


		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/script', $data);
	}

	public function edit()
	{
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
			redirect(base_url('Main/MainDepo/MainDepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['act'] = "edit";

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

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
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js',
			Get_Assets_Url() . 'node_modules/html5-qrcode/html5-qrcode.min.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$id = $this->input->get('id');

		$data['Header'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_header_by_id($id);
		$data['Detail'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail_by_id($id);
		$data['Detail2'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail2_by_id($id);
		$data['Detail3'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail3_by_id($id);
		$data['DetailBO'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_back_order_by_id($id);
		$data['Perusahaan'] = $this->M_AllotmentStockOrder->GetPerusahaan();
		$data['Principle'] = $this->M_AllotmentStockOrder->GetPrinciple();
		$data['Bulan'] = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$this->M_AllotmentStockOrder->delete_simulasi_mps_temp2();
		$this->M_AllotmentStockOrder->cek_exist_simulasi_mps_temp2_by_allotment($id);

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/edit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/s_form', $data);
	}


	public function detail()
	{
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
			redirect(base_url('Main/MainDepo/MainDepoMenu'));
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['Perusahaan'] = $this->M_AllotmentStockOrder->GetPerusahaan();

		$data['act'] = "detail";

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

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
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js',
			Get_Assets_Url() . 'node_modules/html5-qrcode/html5-qrcode.min.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$id = $this->input->get('id');

		$data['Header'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_header_by_id($id);
		$data['Detail'] = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail_by_id($id);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/detail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/AllotmentStockOrder/script', $data);
	}

	public function Get_list_back_order()
	{
		$filter_back_order = array();
		$tahun = $this->input->post('tahun');
		$temp_id = $this->input->post('temp_id');
		$perusahaan = $this->input->post('perusahaan');
		$arr_list_back_order = $this->input->post('arr_list_back_order');

		if (isset($arr_list_back_order) && count($arr_list_back_order) > 0) {
			foreach ($arr_list_back_order as $value) {
				array_push($filter_back_order, "'" . $value['back_order_id'] . "'");
			}
		}

		$data = $this->M_AllotmentStockOrder->Get_list_back_order($tahun, $temp_id, $perusahaan, $filter_back_order);
		echo json_encode($data);
	}

	public function Get_list_back_order_by_customer()
	{
		$filter_back_order = array();
		$tahun = $this->input->post('tahun');
		$perusahaan = $this->input->post('perusahaan');
		$client_pt_id = $this->input->post('client_pt_id');
		$arr_list_back_order = $this->input->post('arr_list_back_order');

		if (isset($arr_list_back_order) && count($arr_list_back_order) > 0) {
			foreach ($arr_list_back_order as $value) {
				array_push($filter_back_order, "'" . $value['back_order_id'] . "'");
			}
		}

		$data = $this->M_AllotmentStockOrder->Get_list_back_order_by_customer($tahun, $perusahaan, $client_pt_id, $filter_back_order);
		echo json_encode($data);
	}

	public function Get_list_allotment_stock_order_detail()
	{
		$filter_back_order = array();
		$temp_id = $this->input->post('temp_id');
		$tahun = $this->input->post('tahun');
		$arr_list_back_order = $this->input->post('arr_list_back_order');

		if (isset($arr_list_back_order) && count($arr_list_back_order) > 0) {
			foreach ($arr_list_back_order as $value) {
				array_push($filter_back_order, "'" . $value['back_order_id'] . "'");
			}
		}

		$data['Header'] = $this->M_AllotmentStockOrder->Get_list_allotment_stock_order_detail_header($filter_back_order);
		$data['Summary'] = $this->M_AllotmentStockOrder->Get_list_allotment_stock_order_detail_summary($temp_id, $tahun, $filter_back_order);

		echo json_encode($data);
	}

	public function Get_list_back_order_simulasi_mps()
	{
		$filter_back_order = array();
		$temp_id = $this->input->post('temp_id');
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$sku_id = $this->input->post('sku_id');
		$arr_list_back_order = $this->input->post('arr_list_back_order');
		$arr_list_back_order_simulasi = $this->input->post('arr_list_back_order_simulasi');

		if (isset($arr_list_back_order) && count($arr_list_back_order) > 0) {
			foreach ($arr_list_back_order as $value) {
				array_push($filter_back_order, "'" . $value['back_order_id'] . "'");
			}
		}

		$data = $this->M_AllotmentStockOrder->Get_list_back_order_simulasi_mps($temp_id, $tahun, $bulan, $sku_id, $filter_back_order, $arr_list_back_order_simulasi);

		echo json_encode($data);
	}

	public function Get_simulasi_mps_temp2()
	{
		$allotment_stock_order_id = $this->input->get('allotment_stock_order_id');
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		$sku_id = $this->input->get('sku_id');

		$data['Header'] = $this->M_AllotmentStockOrder->Get_simulasi_mps_temp2($allotment_stock_order_id, $tahun, $bulan, $sku_id);
		$data['Total'] = $this->M_AllotmentStockOrder->Get_total_qty_simulasi_mps_temp2($allotment_stock_order_id, $tahun, $bulan, $sku_id);

		echo json_encode($data);
	}

	public function Get_total_qty_simulasi_mps_temp2_not_in_bulan()
	{
		$allotment_stock_order_id = $this->input->get('allotment_stock_order_id');
		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		$sku_id = $this->input->get('sku_id');

		$data = $this->M_AllotmentStockOrder->Get_total_qty_simulasi_mps_temp2_not_in_bulan($allotment_stock_order_id, $tahun, $bulan, $sku_id);

		echo json_encode($data);
	}

	public function Get_back_order_by_customer()
	{
		$customer = $this->input->get('customer');

		$data = $this->M_AllotmentStockOrder->Get_back_order_by_customer($customer);

		echo json_encode($data);
	}

	public function insert_simulasi_mps_temp2()
	{

		$allotment_stock_order_id = $this->input->post('allotment_stock_order_id');
		$sku_id = $this->input->post('sku_id');
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$qty = $this->input->post('qty');
		$tgl_kirim = $tahun . "-" . $bulan . "-01";

		$result = $this->M_AllotmentStockOrder->insert_simulasi_mps_temp2($allotment_stock_order_id, $sku_id, $tahun, $bulan, $tgl_kirim, $qty);

		echo json_encode($result);
	}

	public function Get_proses_simulasi_mps()
	{
		$allotment_stock_order_id = $this->input->post('allotment_stock_order_id');
		$tahun = $this->input->post('tahun');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_AllotmentStockOrder->Get_proses_simulasi_mps($tahun, $sku_id, $allotment_stock_order_id);

		echo json_encode($data);
	}


	public function GetPrincipleByPerusahaan()
	{
		$perusahaan = $this->input->get('perusahaan');

		$data = $this->M_AllotmentStockOrder->GetPrincipleByPerusahaan($perusahaan);
		echo json_encode($data);
	}

	public function Get_allotment_stock_order_by_filter()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$tahun = $this->input->get('tahun');
		$perusahaan = $this->input->get('perusahaan');
		$status = $this->input->get('status');

		$data = $this->M_AllotmentStockOrder->Get_allotment_stock_order_by_filter($tahun, $perusahaan, $status);

		echo json_encode($data);
	}

	public function delete_simulasi_mps_temp2_by_allotment_stock_order_id()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$id = $this->input->post('id');

		$this->db->trans_begin();

		$this->M_AllotmentStockOrder->delete_simulasi_mps_temp2_by_allotment_stock_order_id($id);
		$this->M_AllotmentStockOrder->delete_allotment_stock_order_detail3($id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_allotment_stock_order_detail3_by_id()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$id = $this->input->post('id');

		$this->db->trans_begin();
		$this->M_AllotmentStockOrder->delete_allotment_stock_order_detail3($id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_allotment_stock_order()
	{
		// $allotment_stock_order_id = $this->M_Vrbl->Get_NewID();
		// $allotment_stock_order_id = $allotment_stock_order_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  "KODE_ASO";
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_AllotmentStockOrder->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$allotment_stock_order_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$allotment_stock_order_id = $this->input->post('allotment_stock_order_id');
		// $depo_id = $this->input->post('depo_id');
		$client_wms_id = $this->input->post('client_wms_id');
		// $allotment_stock_order_kode = $this->input->post('allotment_stock_order_kode');
		$allotment_stock_order_tahun = $this->input->post('allotment_stock_order_tahun');
		$allotment_stock_order_status = $this->input->post('allotment_stock_order_status');
		$allotment_stock_order_keterangan = $this->input->post('allotment_stock_order_keterangan');
		$allotment_stock_order_who_create = $this->input->post('allotment_stock_order_who_create');
		$allotment_stock_order_tgl_create = $this->input->post('allotment_stock_order_tgl_create');
		$allotment_stock_order_tgl_update = $this->input->post('allotment_stock_order_tgl_update');
		$allotment_stock_order_who_update = $this->input->post('allotment_stock_order_who_update');

		$detail = $this->input->post('detail');
		$back_order_simulasi = $this->input->post('back_order_simulasi');

		$filter_bo = array();
		$detail_error = array();

		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $key => $value) {
				array_push($filter_bo, "'" . $value['back_order_id'] . "'");
			}
		}

		$allotment_stock_order_detail_temp = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail_temp($allotment_stock_order_id, $allotment_stock_order_tahun, $filter_bo);

		if (isset($allotment_stock_order_detail_temp) && count($allotment_stock_order_detail_temp) > 0) {
			foreach ($allotment_stock_order_detail_temp as $key => $value) {
				if ($value['sku_total_qty_simulasi'] == 0 || $value['sku_total_qty_simulasi'] > $value['sku_total_qty']) {
					array_push($detail_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
				}
			}
		}

		if (count($detail_error) > 0) {
			echo json_encode(array("kode" => 0, "data" => $detail_error));
			die;
		}

		$this->db->trans_begin();

		$this->M_AllotmentStockOrder->insert_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update);

		foreach ($allotment_stock_order_detail_temp as $value) {
			$allotment_stock_order_detail_id = $this->M_Vrbl->Get_NewID();
			$allotment_stock_order_detail_id = $allotment_stock_order_detail_id[0]['NEW_ID'];

			$sku_id = $value['sku_id'];
			$sku_total_qty = $value['sku_total_qty'];
			$sku_total_qty_simulasi = $value['sku_total_qty_simulasi'];

			$this->M_AllotmentStockOrder->insert_allotment_stock_order_detail($allotment_stock_order_detail_id, $allotment_stock_order_id, $sku_id, $sku_total_qty, $sku_total_qty_simulasi);
		}

		$this->M_AllotmentStockOrder->insert_allotment_stock_order_detail2($allotment_stock_order_id, $allotment_stock_order_tahun);

		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			$allotment_stock_order_detail2 = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail2_by_back_order($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi);

			foreach ($allotment_stock_order_detail2 as $value) {
				$allotment_stock_order_detail3_id = $this->M_Vrbl->Get_NewID();
				$allotment_stock_order_detail3_id = $allotment_stock_order_detail3_id[0]['NEW_ID'];

				$allotment_stock_order_detail2_id = $value['allotment_stock_order_detail2_id'];
				$allotment_stock_order_detail_id = $value['allotment_stock_order_detail_id'];
				$back_order_id = $value['back_order_id'];
				$sku_qty = $value['sku_qty'];

				if ($sku_qty != "0") {
					$this->M_AllotmentStockOrder->insert_allotment_stock_order_detail3($allotment_stock_order_detail3_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $back_order_id, $sku_qty);
				}
			}
		}

		// $this->M_AllotmentStockOrder->delete_all_simulasi_mps_temp2();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(array("kode" => 0, "data" => array()));
		} else {
			$this->db->trans_commit();
			echo json_encode(array("kode" => 1, "data" => array()));
		}
	}

	public function update_allotment_stock_order()
	{
		$allotment_stock_order_id = $this->input->post('allotment_stock_order_id');
		$depo_id = $this->input->post('depo_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$allotment_stock_order_kode = $this->input->post('allotment_stock_order_kode');
		$allotment_stock_order_tahun = $this->input->post('allotment_stock_order_tahun');
		$allotment_stock_order_status = $this->input->post('allotment_stock_order_status');
		$allotment_stock_order_keterangan = $this->input->post('allotment_stock_order_keterangan');
		$allotment_stock_order_who_create = $this->input->post('allotment_stock_order_who_create');
		$allotment_stock_order_tgl_create = $this->input->post('allotment_stock_order_tgl_create');
		$allotment_stock_order_tgl_update = $this->input->post('allotment_stock_order_tgl_update');
		$allotment_stock_order_who_update = $this->input->post('allotment_stock_order_who_update');

		$detail = $this->input->post('detail');
		$back_order_simulasi = $this->input->post('back_order_simulasi');

		$filter_bo = array();
		$detail_error = array();

		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $key => $value) {
				array_push($filter_bo, "'" . $value['back_order_id'] . "'");
			}
		}

		$allotment_stock_order_detail_temp = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail_temp($allotment_stock_order_id, $allotment_stock_order_tahun, $filter_bo);

		// if (isset($allotment_stock_order_detail_temp) && count($allotment_stock_order_detail_temp) > 0) {
		// 	foreach ($allotment_stock_order_detail_temp as $key => $value) {
		// 		if ($value['sku_total_qty_simulasi'] == 0 || $value['sku_total_qty_simulasi'] > $value['sku_total_qty']) {
		// 			array_push($detail_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
		// 		}
		// 	}
		// }

		// if (count($detail_error) > 0) {
		// 	echo json_encode(array("kode" => 0, "data" => $detail_error));
		// 	die;
		// }

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "allotment_stock_order",
			'whereField' => "allotment_stock_order_id",
			'whereValue' => $allotment_stock_order_id,
			'fieldDateUpdate' => "allotment_stock_order_tgl_update",
			'fieldWhoUpdate' => "allotment_stock_order_who_update",
			'lastUpdated' => $allotment_stock_order_tgl_update
		]);

		if ($lastUpdatedChecked['status'] == 400) {
			echo json_encode(array("kode" => 2, "data" => array()));
			return false;
		}

		$this->db->trans_begin();

		$this->M_AllotmentStockOrder->update_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update);

		$this->M_AllotmentStockOrder->delete_allotment_stock_order_detail3($allotment_stock_order_id);

		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			$allotment_stock_order_detail2 = $this->M_AllotmentStockOrder->Get_allotment_stock_order_detail3_by_karyawan_sales($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi);

			foreach ($allotment_stock_order_detail2 as $value) {
				$allotment_stock_order_detail3_id = $this->M_Vrbl->Get_NewID();
				$allotment_stock_order_detail3_id = $allotment_stock_order_detail3_id[0]['NEW_ID'];

				$allotment_stock_order_detail2_sales_id = $value['allotment_stock_order_detail2_sales_id'];
				$allotment_stock_order_detail2_id = $value['allotment_stock_order_detail2_id'];
				$allotment_stock_order_detail_id = $value['allotment_stock_order_detail_id'];
				$back_order_id = $value['back_order_id'];
				$karyawan_sales_id = $value['karyawan_sales_id'];
				$sku_id = $value['sku_id'];
				$sku_qty = $value['sku_qty'];

				$this->M_AllotmentStockOrder->update_back_order_sales_by_allotment($back_order_id, $karyawan_sales_id);
				$this->M_AllotmentStockOrder->update_back_order_detail_by_allotment($back_order_id, $sku_id, $sku_qty);

				if ($sku_qty != "0") {
					$this->M_AllotmentStockOrder->insert_allotment_stock_order_detail3($allotment_stock_order_detail3_id, $allotment_stock_order_detail2_sales_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $back_order_id, $sku_qty);
				}
			}
		}

		// $this->M_AllotmentStockOrder->delete_all_simulasi_mps_temp2();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(array("kode" => 0, "data" => array()));
		} else {
			$this->db->trans_commit();
			echo json_encode(array("kode" => 1, "data" => array()));
		}
	}
}
