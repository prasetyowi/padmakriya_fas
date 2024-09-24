<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupingSOCanvas extends CI_Controller
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
			redirect(base_url('MainPage/Login'));
		endif;

		$this->MenuKode = "217005000";
		// $this->MenuKode = "103002000";
		$this->load->model([array('FAS/M_GroupingSOCanvas', 'M_GroupingSOCanvas'), 'M_Function', 'M_MenuAccess', 'M_Menu', array('FAS/M_SistemEksternal', 'M_SistemEksternal')]);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function GroupingSOCanvasMenu()
	{

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

		$data['Perusahaan'] = $this->M_GroupingSOCanvas->GetPerusahaan();
		$data['sales'] = $this->M_GroupingSOCanvas->getSales();

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

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/OperasionalCanvas/GroupingSOCanvas/Page/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/OperasionalCanvas/GroupingSOCanvas/Component/Script/S_GroupingSOCanvas', $data);
		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function form($canvasId)
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
			redirect(base_url('Main/MainDepo/DepoMenu'));
		}

		$data['dataCanvas'] = $this->M_GroupingSOCanvas->getDataCanvas($canvasId);

		// echo json_encode($data['dataCanvas']);
		// die;

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

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/OperasionalCanvas/GroupingSOCanvas/Page/form', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/OperasionalCanvas/GroupingSOCanvas/Component/Script/S_GroupingSOCanvas', $data);
		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function getKodeAutoComplete()
	{
		$response = $this->db->select("canvas_id, canvas_kode")
			->from("canvas")
			->where("depo_id", $this->session->userdata('depo_id'))
			->like("canvas_kode", $this->input->get('params'))->get()->result();

		echo json_encode($response);
	}

	public function getDataByFilter()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_GroupingSOCanvas->getDataByFilter($dataPost));
	}

	public function getDataSOByTypeCanvas()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));
		echo json_encode($this->M_GroupingSOCanvas->getDataSOByTypeCanvas($dataPost));
	}

	// public function getBrandByClientWms($clientWmsId)
	// {
	// 	echo json_encode($this->M_GroupingSOCanvas->getBrandByClientWms($clientWmsId));
	// }

	public function getSalesByClientWms()
	{
		$perusahaan = $this->input->get('perusahaan');
		$data = $this->M_GroupingSOCanvas->getSalesByClientWms($perusahaan);

		echo json_encode($data);
	}

	public function summaryDetailDataSOChoose()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));
		echo json_encode($this->M_GroupingSOCanvas->summaryDetailDataSOChoose($dataPost));
	}

	public function checkTempCanvasGrouping($canvasId, $type)
	{
		echo json_encode($this->M_GroupingSOCanvas->checkTempCanvasGrouping($canvasId, $type));
	}

	public function saveData()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));
		echo json_encode($this->M_GroupingSOCanvas->saveData($dataPost));
	}

	public function confirmationData()
	{
		header('Content-Type: application/json');
		$dataPost = json_decode(file_get_contents("php://input"));
		echo json_encode($this->M_GroupingSOCanvas->confirmationData($dataPost));
	}
}
