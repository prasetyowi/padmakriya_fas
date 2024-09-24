<?php

require_once APPPATH . 'core/ParentController.php';

class PurchaseRequest extends ParentController
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

		$this->MenuKode = "218001000";
		$this->load->model('FAS/M_PurchaseRequest', 'M_PurchaseRequest');
		$this->load->model('FAS/M_Principle', 'M_Principle');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
	}

	public function PurchaseRequestMenu()
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
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
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
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
		$data['Area'] = $this->M_PurchaseRequest->GetArea();
		$data['bank'] = $this->M_PurchaseRequest->Getbank();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/form', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/S_Principle', $data);
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
		$data['pr_id'] = $id;
		$data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
		$data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
		$data['Area'] = $this->M_PurchaseRequest->GetArea();
		$data['bank'] = $this->M_PurchaseRequest->Getbank();
		$data['act'] = "edit";
		$data['Anggaran'] = $this->M_PurchaseRequest->GetAnggaranDetail2ByYearDepoClient();
		// echo json_encode($data['PRDetail']);
		// die;

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/edit', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/S_Principle', $data);
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

		$query['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$id = $this->input->get('id');
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['pr_id'] = $id;
		$data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
		$data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
		$data['bank'] = $this->M_PurchaseRequest->Getbank();

		$data['Anggaran'] = $this->M_PurchaseRequest->GetAnggaranDetail2ByYearDepoClient();


		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
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

		$id = $this->M_PurchaseRequest->GetPurchaseRequestId($this->input->get('kode'));
		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();
		$data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
		$data['pr_id'] = $id;
		$data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
		$data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
		$data['Anggaran'] = $this->M_PurchaseRequest->GetAnggaranDetail2ByYearDepoClient();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/detail', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
	}
	public function generatePO()
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
		$data['pr_id'] = $id;
		$data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
		$data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
		$data['PRDetailSupplier'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailSupplierById($id);
		$data['PRDetailSupplierIsDisabled'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailSupplierByIdInPo($id);
		$data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
		$data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
		$data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
		$data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
		$data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
		$data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
		$data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/generatePO/addpo', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/generatePO/s_generatepo', $data);
		$this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
	}

	public function GetSelectedSKU()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_PurchaseRequest->GetSelectedSKU($sku_id);

		echo json_encode($data);
	}

	public function GetSupplier()
	{
		$data = $this->M_PurchaseRequest->GetSupplier();

		echo json_encode($data);
	}

	public function search_purchase_request_by_filter()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$kode = $this->input->post('kode');
		$divisi = $this->input->post('divisi');
		$status = $this->input->post('status');
		$tipetransaksi = $this->input->post('tptransaksi');


		$data = $this->M_PurchaseRequest->search_purchase_request_by_filter($tgl1, $tgl2, $perusahaan, $divisi, $tipetransaksi);

		echo json_encode($data);
	}

	public function search_filter_chosen_sku()
	{
		$perusahaan = $this->input->post('perusahaan');
		$sku_kode = $this->input->post('sku_kode');
		$sku_nama_produk = $this->input->post('sku_nama_produk');
		$tipe_pengadaan = $this->input->post('tipe_pengadaan');

		$data = $this->M_PurchaseRequest->search_filter_chosen_sku($perusahaan, $sku_kode, $sku_nama_produk, $tipe_pengadaan);

		echo json_encode($data);
	}

	public function insert_purchase_request()
	{
		// $purchase_request_id = $this->input->post('purchase_request_id');
		// $purchase_request_kode = $this->input->post('purchase_request_kode');

		$depo_id = $this->session->userdata('depo_id');
		$gudang_id = $this->input->post('gudang_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$tipe_transaksi_id = $this->input->post('tipe_transaksi_id');
		$tipe_kepemilikan_id = $this->input->post('tipe_kepemilikan_id');
		$kategori_biaya_id = $this->input->post('kategori_biaya_id');
		$tipe_biaya_id = $this->input->post('tipe_biaya_id');
		$purchase_request_status = $this->input->post('purchase_request_status');
		$purchase_request_tgl = $this->input->post('purchase_request_tgl');
		$purchase_request_tgl_dibutuhkan = $this->input->post('purchase_request_tgl_dibutuhkan');
		$purchase_request_tgl_create = $this->input->post('purchase_request_tgl_create');
		$purchase_request_who_create = $this->session->userdata('pengguna_username');
		$purchase_request_keterangan = $this->input->post('purchase_request_keterangan');
		$purchase_request_pemohon = $this->input->post('purchase_request_pemohon');
		$judul = $this->input->post('judul');
		$anggaran_detail_2_id = $this->input->post('anggaran_detail_2_id');
		$nama_penerima = $this->input->post('nama_penerima');
		$default_pembayaran = $this->input->post('default_pembayaran');
		$bank_penerima = $this->input->post('bank_penerima');
		$no_rekening = $this->input->post('no_rekening');
		$karyawan_divisi_id = $this->input->post('karyawan_divisi_id');

		$detail = json_decode($this->input->post('detail'));

		$purchase_request_id = $this->M_Vrbl->Get_NewID();
		$purchase_request_id = $purchase_request_id[0]['NEW_ID'];
		$name_file = '';

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_PR';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_PurchaseRequest->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$purchase_request_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_PR_01";

		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PurchaseRequest/";
			// $fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName  = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $purchase_request_kode);
			$name_file = $name_file . '.' . $fileExtension;

			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
		}
		$this->db->trans_begin();

		$this->M_PurchaseRequest->insert_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $name_file, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening);

		foreach ($detail as $key => $value) {
			$this->M_PurchaseRequest->insert_purchase_request_detail($purchase_request_id, $value);
		}

		if ($purchase_request_status == "In Progress Approval") {
			$this->M_PurchaseRequest->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $purchase_request_id, $purchase_request_kode, 0, 0);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_purchase_request()
	{
		// return false;
		$purchase_request_id = $this->input->post('purchase_request_id');
		$purchase_request_kode = $this->input->post('purchase_request_kode');
		$depo_id = $this->session->userdata('depo_id');
		$gudang_id = $this->input->post('gudang_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$tipe_transaksi_id = $this->input->post('tipe_transaksi_id');
		$tipe_kepemilikan_id = $this->input->post('tipe_kepemilikan_id');
		$kategori_biaya_id = $this->input->post('kategori_biaya_id');
		$tipe_biaya_id = $this->input->post('tipe_biaya_id');
		$purchase_request_status = $this->input->post('purchase_request_status');
		$purchase_request_tgl = $this->input->post('purchase_request_tgl');
		$purchase_request_tgl_dibutuhkan = $this->input->post('purchase_request_tgl_dibutuhkan');
		$purchase_request_tgl_create = $this->input->post('purchase_request_tgl_create');
		$purchase_request_who_create = $this->session->userdata('pengguna_username');
		$purchase_request_keterangan = $this->input->post('purchase_request_keterangan');
		$purchase_request_pemohon = $this->input->post('purchase_request_pemohon');
		$karyawan_divisi_id = $this->input->post('karyawan_divisi_id');
		$judul = $this->input->post('judul');
		$anggaran_detail_2_id = $this->input->post('anggaran_detail_2_id');
		$nama_penerima = $this->input->post('nama_penerima');
		$default_pembayaran = $this->input->post('default_pembayaran');
		$bank_penerima = $this->input->post('bank_penerima');
		$no_rekening = $this->input->post('no_rekening');
		$is_name_file = $this->input->post('is_name_file');
		$file = $this->input->post('file');



		$detail = json_decode($this->input->post('detail'));
		$name_file = '';
		$this->db->trans_begin();

		$approvalParam = "APPRV_PR_01";
		if (!empty($_FILES['file']['name'])) {
			$uploadDirectory = "assets/uploads/files/PurchaseRequest/";
			// $fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileTmpName = $_FILES['file']['tmp_name'];
			$fileType = $_FILES['file']['type'];
			$fileExtension = strtolower(explode(".", $fileName)[1]);
			// $name_file = 'bukti-' . time() . '.' . $fileExtension;
			$name_file = str_replace("/", "-", $purchase_request_kode);
			$name_file = $name_file . '.' . $fileExtension;
			if ($is_name_file != '0') {
				unlink('assets/uploads/files/PurchaseRequest/' . $is_name_file);
			}

			$uploadPath = $uploadDirectory . $name_file;
			move_uploaded_file($fileTmpName, $uploadPath);
			$this->M_PurchaseRequest->update_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $name_file, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening, 1);
		} else {
			$this->M_PurchaseRequest->update_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $name_file, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening, 0);
		}

		$this->M_PurchaseRequest->delete_purchase_request_detail($purchase_request_id);

		foreach ($detail as $key => $value) {
			$this->M_PurchaseRequest->insert_purchase_request_detail($purchase_request_id, $value);
		}

		if ($purchase_request_status == "In Progress Approval") {
			$this->M_PurchaseRequest->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $purchase_request_id, $purchase_request_kode, 0, 0);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function InsertSkuBarangSupplier()
	{
		$arrSkuBarangSupplier = $this->input->post('arrSkuBarangSupplier');
		$sku_barang_supplier_id = $this->input->post('sku_barang_supplier_id');
		// foreach ($arrSkuBarangSupplier as $key => $val) {
		// 	$data = $this->M_PurchaseRequest->cek_data_supplier_by_id($val);
		// }

		// if ($data == 0 && $data === 0) {
		foreach ($arrSkuBarangSupplier as $key => $value) {
			$sk_id = $this->M_Vrbl->Get_NewID();
			$sk_id = $sk_id[0]['NEW_ID'];
			if ($value['sku_barang_supplier_id'] == null || $value['sku_barang_supplier_id'] == "" || $value['sku_barang_supplier_id'] == "null") {
				$data['respon_insert'] = $this->M_PurchaseRequest->InsertSkuBarangSupplier($sk_id, $value);
			}
			if ($sku_barang_supplier_id != '') {
				$data['respon_update'] = $this->M_PurchaseRequest->UpdateSkuBarangSupplier($sku_barang_supplier_id, $value);
			}
			// $data['sku_barang_supplier_id'] = $sk_id;
		}
		// } else {
		// 	$data['respon_insert'] = false;
		// }
		echo json_encode($data);
	}

	public function insert_purchase_order()
	{
		// $purchase_request_id = $this->input->post('purchase_request_id');
		// $purchase_request_kode = $this->input->post('purchase_request_kode');
		$depo_id = $this->session->userdata('depo_id');
		$gudang_id = $this->input->post('gudang_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$tipe_transaksi_id = $this->input->post('tipe_transaksi_id');
		$tipe_kepemilikan_id = $this->input->post('tipe_kepemilikan_id');
		$kategori_biaya_id = $this->input->post('kategori_biaya_id');
		$tipe_biaya_id = $this->input->post('tipe_biaya_id');
		$purchase_request_status = $this->input->post('purchase_request_status');
		$purchase_request_tgl = $this->input->post('purchase_request_tgl');
		$purchase_request_tgl_dibutuhkan = $this->input->post('purchase_request_tgl_dibutuhkan');
		$purchase_request_tgl_create = $this->input->post('purchase_request_tgl_create');
		$purchase_request_who_create = $this->session->userdata('pengguna_username');
		$purchase_request_keterangan = $this->input->post('purchase_request_keterangan');
		$purchase_request_pemohon = $this->input->post('purchase_request_pemohon');
		$karyawan_divisi_id = $this->input->post('karyawan_divisi_id');

		$pr_id = $this->input->post('pr_id');
		$detail = $this->input->post('detail');

		// $purchase_order_id = $this->M_Vrbl->Get_NewID();
		// $purchase_order_id = $purchase_order_id[0]['NEW_ID'];
		//generate kode

		$this->db->trans_begin();

		foreach ($detail as $key => $value) {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PO';
			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_PurchaseRequest->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$purchase_request_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$purchase_order_id = $this->M_Vrbl->Get_NewID();
			$purchase_order_id = $purchase_order_id[0]['NEW_ID'];

			$this->M_PurchaseRequest->insert_purchase_order($purchase_order_id, $pr_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $value);

			$datadetail = $this->M_PurchaseRequest->GetPurchaseRequestDetailByIdandSupplierId($pr_id, $value);
			foreach ($datadetail as $key => $valuedetail) {
				// echo json_encode($valuedetail->purchase_request_detail_qty_req);
				// if ($value == $valuedetail->supplier_id) {
				$this->M_PurchaseRequest->update_purchase_request_kode_only($purchase_order_id, $pr_id, $purchase_request_kode, $valuedetail, $value);
				$this->M_PurchaseRequest->insert_purchase_order_detail($purchase_order_id, $valuedetail);
				// }
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
	public function ViewAttachment()
	{
		$this->load->helper('download');
		$name_file = $this->input->get("file");
		$directory = "assets/uploads/files/PurchaseRequest/";
		$data   = file_get_contents($directory . $name_file);
		header('Content-Type: application/pdf');
		echo $data;
		// force_download($name_file, $data);
	}
	public function GetDataPobyId()
	{
		$pr_id = $this->input->post('pr_id');
		$data = $this->M_PurchaseRequest->GetDataPobyId($pr_id);
		echo json_encode($data);
	}

	public function GetPrincipleMenu()
	{
		$data['PrincipleMenu'] = $this->M_Principle->Get_Principle();
		$data['KelasJalan'] = $this->M_Principle->Get_Data_KelasJalan();
		$data['KelasJalan2'] = $this->M_Principle->Get_Data_KelasJalan2();
		$data['Area'] = $this->M_Principle->Get_Data_Area();
		$data['Provinsi'] = $this->M_Principle->Get_Data_Provinsi();

		$array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$data['Day'] = $array;

		echo json_encode($data);
	}
	public function GetSupplierMenu()
	{
		$skubarangid = $this->input->post('skubid');

		// $data['Supplier'] = $this->M_Principle->Get_Supplier();

		$data['SupplierBySkuBarangId'] = $this->M_Principle->Get_SupplierBySkuBarangId($skubarangid);
		$data['PrincipleMenu'] = $this->M_Principle->Get_Principle();
		$data['KelasJalan'] = $this->M_Principle->Get_Data_KelasJalan();
		$data['KelasJalan2'] = $this->M_Principle->Get_Data_KelasJalan2();
		$data['Area'] = $this->M_Principle->Get_Data_Area();
		$data['AreaHeader'] = $this->M_Principle->Get_Data_Area_Header();
		$data['Provinsi'] = $this->M_Principle->Get_Data_Provinsi();

		$array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$data['Day'] = $array;

		echo json_encode($data);
	}

	public function PilihSupplier()
	{
		$arrtemp = $this->input->post('arrtempSupplierid');
		$data = $this->M_Principle->GetAllSupplier($arrtemp);
		echo json_encode($data);
	}
	public function GetPurchaseRequestDetailSupplierById()
	{
		$id = $this->input->post('pr_id');
		$data =  $this->M_PurchaseRequest->GetPurchaseRequestDetailSupplierById($id);
		echo json_encode($data);
	}
	public function GetPurchaseRequestDetailSupplierByIdDisabled()
	{
		$id = $this->input->post('pr_id');
		$data =  $this->M_PurchaseRequest->GetPurchaseRequestDetailSupplierByIdInPo($id);
		echo json_encode($data);
	}

	public function EditPRById()
	{
		$id = $this->input->get('id');
		$data = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
		echo json_encode($data);
	}
	public function GetDataPOSupplierByIdPo()
	{
		$pr_id = $this->input->post('pr_id');
		$po_id = $this->input->post('po_id');
		$data = $this->M_PurchaseRequest->GetDataPOSupplierByIdPo($pr_id, $po_id);
		echo json_encode($data);
	}
	public function GetSupplierByArea()
	{
		$area_id = $this->input->post('area_id');
		$nama_supplier = $this->input->post('nama_supplier');
		$arrtempSupplierid = $this->input->post('arrtempSupplierid');
		$data = $this->M_PurchaseRequest->GetSupplierByArea($area_id, $nama_supplier, $arrtempSupplierid);
		echo json_encode($data);
	}

	public function SaveAddNewSupplier()
	{
		// if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
		//     echo 0;
		//     exit();
		// }

		$modesave = $this->input->post("modesave");

		$name_supplier = $this->input->post("name_supplier");
		$address_supplier = $this->input->post("address_supplier");
		$phone_supplier = $this->input->post("phone_supplier");
		// $supplier_group = $this->input->post("supplier_group");
		$lattitude_supplier = $this->input->post("lattitude_supplier");
		$longitude_supplier = $this->input->post("longitude_supplier");
		$stretclass_supplier = $this->input->post("stretclass_supplier");
		$stretclass2_supplier = $this->input->post("stretclass2_supplier");
		$area_supplier = $this->input->post("area_supplier");
		$province = $this->input->post("province");
		$city = $this->input->post("city");
		$districts = $this->input->post("districts");
		$ward = $this->input->post("ward");
		$kodepos_supplier = $this->input->post("kodepos_supplier");
		$name_contact_person = $this->input->post("name_contact_person");
		$phone_contact_person = $this->input->post("phone_contact_person");
		$kreditlimit_contact_person = $this->input->post("kreditlimit_contact_person");
		$segment1_contact_person = $this->input->post("segment1_contact_person");
		$segment2_contact_person = $this->input->post("segment2_contact_person");
		$segment3_contact_person = $this->input->post("segment3_contact_person");
		$isValidMultiLocation = $this->input->post("isValidMultiLocation");
		$listcontactperson_location = $this->input->post("listcontactperson_location");
		$IsAktif = $this->input->post("status");

		// $UnitMandiriId = $this->session->userdata('unit_mandiri_id');
		// $IsAktif = 1;
		$isDeleted = 0;

		// echo json_encode($UnitMandiriId);

		$timeoperasional = $this->input->post("timeoperasional");



		// $S_UserID = $this->session->userdata('UserID');
		// $S_UserName = $this->session->userdata('UserName');

		$outlet_id = $this->M_Vrbl->Get_NewID();
		$outlet_id = $outlet_id[0]['NEW_ID'];

		if ($isValidMultiLocation == 1) {
			$listcontactperson_location = $listcontactperson_location;
		} else {
			$listcontactperson_location = NULL;
		}

		// if ($modesave == 'HO') {
		//     $data = $this->M_PurchaseRequest->Insert_Outlet_supplier(
		//         $outlet_id,
		//         $name_corporate,
		//         $address_corporate,
		//         $phone_corporate,
		//         $lattitude_corporate,
		//         $longitude_corporate,
		//         $name_contact_person,
		//         $phone_contact_person,
		//         $kreditlimit_contact_person,
		//         $stretclass_corporate,
		//         $stretclass2_corporate,
		//         $area_corporate,
		//         $province,
		//         $city,
		//         $districts,
		//         $ward,
		//         $kodepos_corporate,
		//         $segment1_contact_person,
		//         $segment2_contact_person,
		//         $segment3_contact_person,
		//         $isDeleted,
		//         $IsAktif
		//     );
		// } else if ($modesave == 'CB') {
		$data = $this->M_PurchaseRequest->Insert_Supplier($outlet_id, $name_supplier, $address_supplier, $phone_supplier, $lattitude_supplier, $longitude_supplier, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_supplier, $stretclass2_supplier, $area_supplier, $province, $city, $districts, $ward, $kodepos_supplier, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $isValidMultiLocation, $listcontactperson_location);
		// }

		if ($data) {
			// foreach ($timeoperasional as $val) {
			//     $no_urut = $val['no_urut'];
			//     $hari = $val['hari'];
			//     $buka = $val['buka'];
			//     $tutup = $val['tutup'];
			//     $status = $val['status'];
			//     $pengiriman = $val['pengiriman'];
			//     $penagihan = $val['penagihan'];
			//     // kurang insert ke databse;

			//     if ($modesave == 'HO') {
			//         $this->M_Outlet->Insert_Outlet_supplier_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
			//     } else if ($modesave == 'CB') {
			//         $this->M_Outlet->Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
			//     }
			// }

			echo 1;
		} else {
			echo 0;
		}
	}
}
