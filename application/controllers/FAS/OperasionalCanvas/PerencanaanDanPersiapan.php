<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PerencanaanDanPersiapan extends CI_Controller
{
	//
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

		$this->MenuKode = "217002000";
		// $this->MenuKode = "103002000";
		$this->load->model([array('FAS/M_PerencanaanDanPersiapan', 'M_PerencanaanDanPersiapan'), 'M_Function', 'M_MenuAccess', 'M_Menu', array('FAS/M_SistemEksternal', 'M_SistemEksternal')]);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function PerencanaanDanPersiapanMenu()
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

		$data['rangeYear'] = range(date('Y') - 10, date('Y') + 10);
		$data['rangeMonth'] = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);

		$data['Perusahaan'] = $this->M_PerencanaanDanPersiapan->GetPerusahaan();
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
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Page/index', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Script/S_PerencanaanDanPersiapan', $data);
	}

	public function getDataByFilter()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->getDataByFilter($dataPost));
	}


	/** Tambah Data */
	public function create()
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

		$sessionRoleLogin = $this->db->select("pengguna_grup_is_dewa")->from('pengguna_grup')->where('pengguna_grup_id', $this->session->userdata('pengguna_grup_id'))->get()->row();

		if ($sessionRoleLogin->pengguna_grup_is_dewa != 1) {
			// $data['clientPT'] = $this->db->select("client_wms_nama")->from("client_wms")->where("client_wms_id", $this->session->userdata('client_wms_id'))->get()->row();
			$data['clientPT'] = $query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "' AND a.client_wms_id= '" . $this->session->userdata('client_wms_id') . "'
										ORDER BY b.client_wms_nama ASC")->row();
		} else {
			// $data['clientWMS'] = $this->db->select("client_wms_id as id, client_wms_nama as nama")->from('client_wms')->where('client_wms_is_aktif', 1)->order_by('client_wms_nama', 'ASC')->get()->result();

			$data['clientWMS'] = $this->db->query("select
											b.client_wms_id as id,
											b.client_wms_nama as nama
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "'
										ORDER BY b.client_wms_nama ASC")->result();
		}

		$data['tipeStock'] = $this->M_PerencanaanDanPersiapan->getTipeStock();

		$data['kendaraans'] = $this->M_PerencanaanDanPersiapan->getKendaraans();

		$data['sales'] = $this->M_PerencanaanDanPersiapan->getSales();

		$data['areas'] = $this->M_PerencanaanDanPersiapan->getAreas();

		$data['Principle'] = $this->M_PerencanaanDanPersiapan->GetAllPrinciple();

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
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Page/tambah', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Script/S_PerencanaanDanPersiapan', $data);
		$this->load->view('master/S_GlobalVariable', $data);
	}
	/** End Tambah Data */

	/** Edit Data */

	public function edit()
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

		$sessionRoleLogin = $this->db->select("pengguna_grup_is_dewa")->from('pengguna_grup')->where('pengguna_grup_id', $this->session->userdata('pengguna_grup_id'))->get()->row();

		if ($sessionRoleLogin->pengguna_grup_is_dewa != 1) {
			$data['clientPT'] = $this->db->select("client_wms_nama")->from("client_wms")->where("client_wms_id", $this->session->userdata('client_wms_id'))->get()->row();
		} else {
			$data['clientWMS'] = $this->db->select("client_wms_id as id, client_wms_nama as nama")->from('client_wms')->where('client_wms_is_aktif', 1)->order_by('client_wms_nama', 'ASC')->get()->result();
		}

		$data['tipeStock'] = $this->M_PerencanaanDanPersiapan->getTipeStock();

		$data['kendaraans'] = $this->M_PerencanaanDanPersiapan->getKendaraans();

		$data['sales'] = $this->M_PerencanaanDanPersiapan->getSales();

		$data['Principle'] = $this->M_PerencanaanDanPersiapan->GetAllPrinciple();

		$data['areas'] = $this->M_PerencanaanDanPersiapan->getAreas();

		$data['dataCanvas'] = $this->M_PerencanaanDanPersiapan->getDataCanvasById($_GET['id']);

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
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Page/tambah', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Script/S_PerencanaanDanPersiapan', $data);
		$this->load->view('master/S_GlobalVariable', $data);
	}

	/** End Edit Data */

	/** View Data */

	public function view()
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

		$sessionRoleLogin = $this->db->select("pengguna_grup_is_dewa")->from('pengguna_grup')->where('pengguna_grup_id', $this->session->userdata('pengguna_grup_id'))->get()->row();

		if ($sessionRoleLogin->pengguna_grup_is_dewa != 1) {
			$data['clientPT'] = $this->db->select("client_wms_nama")->from("client_wms")->where("client_wms_id", $this->session->userdata('client_wms_id'))->get()->row();
		} else {
			$data['clientWMS'] = $this->db->select("client_wms_id as id, client_wms_nama as nama")->from('client_wms')->where('client_wms_is_aktif', 1)->order_by('client_wms_nama', 'ASC')->get()->result();
		}

		$data['tipeStock'] = $this->M_PerencanaanDanPersiapan->getTipeStock();

		$data['kendaraans'] = $this->M_PerencanaanDanPersiapan->getKendaraans();

		$data['sales'] = $this->M_PerencanaanDanPersiapan->getSales();

		$data['areas'] = $this->M_PerencanaanDanPersiapan->getAreas();

		$data['Principle'] = $this->M_PerencanaanDanPersiapan->GetAllPrinciple();

		$data['dataCanvas'] = $this->M_PerencanaanDanPersiapan->getDataCanvasById($_GET['id']);

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
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Page/tambah', $data);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/OperasionalCanvas/PerencanaanDanPersiapan/Component/Script/S_PerencanaanDanPersiapan', $data);
		$this->load->view('master/S_GlobalVariable', $data);
	}

	/** End View Data */

	public function GetSelectedSKU()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->GetSelectedSKU($dataPost));
	}

	public function getEdSkuById()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->getEdSkuById($dataPost));
	}

	public function saveData()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->saveData($dataPost));
	}

	public function requestDataDetailCanvas()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->requestDataDetailCanvas($dataPost));
	}

	public function deleteDataCanvas()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->deleteDataCanvas($dataPost));
	}

	public function getSKUbyPerusahaan()
	{
		header('Content-Type: application/json');

		$dataPost = json_decode(file_get_contents("php://input"));

		echo json_encode($this->M_PerencanaanDanPersiapan->getDataSkuByClientPt($dataPost));
	}

	public function GetBosnetPenerimaanBarang()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));
		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$sistem_eksternal = "BOSNET";
		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		$arr_principle = $this->M_SistemEksternal->GetPrincipleByPerusahaan($perusahaan);
		$cek_principle = $this->M_SistemEksternal->CheckPrinciplePerusahaan($perusahaan);
		// $depo = $this->session->userdata('depo_id');
		// $depo = "989";

		if ($cek_principle > 0) {
			foreach ($arr_principle as $key => $value) {
				$principle[$key] = "'" . $value['principle_kode'] . "'";
			}

			$data['BosnetPenerimaanBarangHeader'] = $this->M_SistemEksternal->GetBosnetPenerimaanBarangHeader($tgl1, $tgl2, $depo, $principle);
			$data['BosnetPenerimaanBarangDetail'] = $this->M_SistemEksternal->GetBosnetPenerimaanBarangDetail($tgl1, $tgl2, $depo, $principle);
		} else {
			$data['BosnetPenerimaanBarangHeader'] = "0";
			$data['BosnetPenerimaanBarangDetail'] = "0";
		}

		echo json_encode($data);
	}

	public function GetPenerimaanBarangBosnet()
	{
		$tgl = explode(" - ", $this->input->post('tgl'));
		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$perusahaan = $this->input->post('perusahaan');
		$sistem_eksternal = "BOSNET";
		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		$arr_principle = $this->M_SistemEksternal->GetPrincipleByPerusahaan($perusahaan);
		$cek_principle = $this->M_SistemEksternal->CheckPrinciplePerusahaan($perusahaan);
		// $depo = $this->session->userdata('depo_id');
		// $depo = "989";

		if ($cek_principle > 0) {
			foreach ($arr_principle as $key => $value) {
				$principle[$key] = "'" . $value['principle_kode'] . "'";
			}

			$data = $this->M_SistemEksternal->GetPenerimaanBarangBosnet($tgl1, $tgl2, $depo, $principle);
		} else {
			$data = 2;
		}

		echo json_encode($data);
	}

	public function GetCanvasByFilter()
	{
		$perusahaan = $this->input->post('perusahaan');
		$tgl = explode(" - ", $this->input->post('tgl'));
		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));

		$data = $this->M_PerencanaanDanPersiapan->GetCanvasByFilter($tgl1, $tgl2, $perusahaan);

		echo json_encode($data);
	}

	public function Insert_canvas()
	{
		$arr_msg = array();
		$arr_cek_data = array();

		$client_wms_id = $this->input->post('perusahaan');
		$data_pb_eksternal_header = $this->input->post('data_pb_eksternal_header');
		// $data_pb_eksternal_detail = $this->input->post('data_pb_eksternal_detail');

		// foreach ($data_pb_eksternal_header as $header) {
		// 	$canvas_id = $this->M_Vrbl->Get_NewID();
		// 	$canvas_id = $canvas_id[0]['NEW_ID'];

		// 	//generate kode
		// 	$date_now = date('Y-m-d h:i:s');
		// 	$param =  'KODE_SO';
		// 	$vrbl = $this->M_Vrbl->Get_Kode($param);
		// 	$prefix = $vrbl->vrbl_kode;

		// 	// get prefik depo
		// 	$depo_id = $this->session->userdata('depo_id');
		// 	$depoPrefix = $this->M_PerencanaanDanPersiapan->getDepoPrefix($depo_id);
		// 	$unit = $depoPrefix->depo_kode_preffix;
		// 	$canvas_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		// 	$approvalParam = "APPRV_SO_01";

		// 	$CekDuplikatCanvas = $this->M_PerencanaanDanPersiapan->CekDuplikatCanvas($canvas_kode);
		// 	$CekDuplikatCanvasByReffId = $this->M_PerencanaanDanPersiapan->CekDuplikatCanvasByReffId($header['szFPrId']);

		// 	$sistem_eksternal = "BOSNET";

		// 	$depo_id = $depo_id;
		// 	$canvas_kode = $canvas_kode;
		// 	$canvas_requestdate = $header['dtmRequest'];
		// 	$client_wms_id = $client_wms_id;
		// 	$cek_karyawan_id = $this->M_SistemEksternal->Get_karyawan_sales_eksternal($header['szDriverId'], $sistem_eksternal);
		// 	$cek_client_pt_id = $this->M_SistemEksternal->Get_client_pt_by_driver($header['szDriverId']);
		// 	$karyawan_id = "";
		// 	$client_pt_id = "";
		// 	// $karyawan_id = "5BC03A2A-7A4A-44D7-9B30-B51E8BC9F2D1";
		// 	$no_kendaraan = $header['szVehicleId'];
		// 	$canvas_keterangan = $header['szDescription'];
		// 	$canvas_startdate = $header['dtmRequest'];
		// 	$canvas_enddate = $header['dtmRequest'];
		// 	$canvas_status = "Draft";
		// 	$canvas_tanggal_create = date('Y-m-d h:i:s');
		// 	$canvas_who_create = $this->session->userdata('pengguna_username');
		// 	$canvas_reff_kode = $header['szFPrId'];
		// 	$principle_id = $header['principle_id'];

		// 	echo "canvas_reff_kode " . $canvas_reff_kode . " || principle_id  " . $principle_id . "<br>";
		// }

		// echo json_encode($data_pb_eksternal_header);
		// die;

		foreach ($data_pb_eksternal_header as $header) {
			$canvas_id = $this->M_Vrbl->Get_NewID();
			$canvas_id = $canvas_id[0]['NEW_ID'];

			//generate kode
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_SO';
			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;

			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_PerencanaanDanPersiapan->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$canvas_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$approvalParam = "APPRV_SO_01";

			$CekDuplikatCanvas = $this->M_PerencanaanDanPersiapan->CekDuplikatCanvas($canvas_kode);
			$CekDuplikatCanvasByReffId = $this->M_PerencanaanDanPersiapan->CekDuplikatCanvasByReffId($header['szFPrId']);

			$sistem_eksternal = "BOSNET";

			$depo_id = $depo_id;
			$canvas_kode = $canvas_kode;
			$canvas_requestdate = $header['dtmRequest'];
			$client_wms_id = $client_wms_id;
			$cek_karyawan_id = $this->M_SistemEksternal->Get_karyawan_sales_eksternal($header['szDriverId'], $sistem_eksternal);
			$cek_client_pt_id = $this->M_SistemEksternal->Get_client_pt_by_driver($header['szDriverId']);
			$karyawan_id = "";
			$client_pt_id = "";
			// $karyawan_id = "5BC03A2A-7A4A-44D7-9B30-B51E8BC9F2D1";
			$no_kendaraan = $header['szVehicleId'];
			$canvas_keterangan = $header['szDescription'];
			$canvas_startdate = $header['dtmRequest'];
			$canvas_enddate = $header['dtmRequest'];
			$canvas_status = "Draft";
			$canvas_tanggal_create = date('Y-m-d h:i:s');
			$canvas_who_create = $this->session->userdata('pengguna_username');
			$canvas_reff_kode = $header['szFPrId'];
			$principle_id = $header['principle_id'];

			if ($cek_karyawan_id != 0) {
				$karyawan_id = $cek_karyawan_id;
			} else {
				$sales_bosnet = $this->M_SistemEksternal->Get_sales_bosnet_by_id($header['szDriverId']);
				$depo_eksternal = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal);

				$sales_nama = $sales_bosnet->karyawan_nama;
				$depo_eksternal = $depo_eksternal->depo_eksternal_kode;

				$sales_bosnet_principle = $this->M_SistemEksternal->Get_driver_bosnet_principle_by_id($header['szDriverId']);
				$cek_sales_fas = $this->M_SistemEksternal->Check_sales_fas($sales_nama, $this->session->userdata('depo_id'));

				if ($cek_sales_fas == 0) {
					$karyawan_id = $this->M_Vrbl->Get_NewID();
					$karyawan_id = $karyawan_id[0]['NEW_ID'];

					$insert_header = $this->M_SistemEksternal->Insert_karyawan($karyawan_id, $sales_bosnet);

					if ($insert_header > 0) {

						$this->M_SistemEksternal->Insert_karyawan_detail($karyawan_id, $sales_bosnet);

						foreach ($sales_bosnet_principle as $value) {
							// $principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
							// $principle_id = 0;

							if ($principle_id != "0") {

								$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

								if ($cek_sales_principle == 0) {
									$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
									if ($result != 1) {
										// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
										$msg = array("kode" => "12", "reff_id" => "", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
										array_push($arr_msg, $msg);

										echo json_encode($arr_msg);
										return false;
									}
								}
							} else {
								// $this->M_SistemEksternal->delete_client_pt($client_pt_id);
								$msg = array("kode" => "14", "reff_id" => $value['szCategory_1'], "msg" => "CAPTION-ALERT-PRINCIPLETIDAKADA");
								array_push($arr_msg, $msg);

								echo json_encode($arr_msg);
								return false;
							}
						}

						$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

						if ($cek_sales_principle_eksternal == 0) {
							$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $header['szDriverId']);
							if ($result != 1) {
								// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
								$msg = array("kode" => "13", "reff_id" => "", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
								array_push($arr_msg, $msg);

								echo json_encode($arr_msg);
								return false;
							}
						}
					} else {
						// echo $insert_header;
						$msg = array("kode" => "10", "reff_id" => "", "msg" => "CAPTION-ALERT-SYNCSALESGAGAL");
						array_push($arr_msg, $msg);

						echo json_encode($arr_msg);
						return false;
					}
				} else {

					$karyawan_id = $this->M_SistemEksternal->Get_karyawan_id_by_nama($sales_nama, $this->session->userdata('depo_id'))->karyawan_id;

					foreach ($sales_bosnet_principle as $value) {
						// $principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
						// $principle_id = 0;

						if ($principle_id != "0") {

							$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

							if ($cek_sales_principle == 0) {
								$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
								if ($result != 1) {
									$msg = array("kode" => "12", "reff_id" => "", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
									array_push($arr_msg, $msg);

									echo json_encode($arr_msg);
									return false;
								}
							}
						} else {
							$msg = array("kode" => "14", "reff_id" => $value['szCategory_1'], "msg" => "CAPTION-ALERT-PRINCIPLETIDAKADA");
							array_push($arr_msg, $msg);

							echo json_encode($arr_msg);
							return false;
						}
					}

					$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

					if ($cek_sales_principle_eksternal == 0) {
						$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $header['szDriverId']);
						if ($result != 1) { //tes
							// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
							$msg = array("kode" => "13", "reff_id" => "", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
							array_push($arr_msg, $msg);

							echo json_encode($arr_msg);
							return false;
						}
					}
				}

				$karyawan_id = $this->M_SistemEksternal->Get_karyawan_sales_eksternal($header['szDriverId'], $sistem_eksternal);
			}

			if ($client_pt_id != "") {
				$client_pt_id = $cek_client_pt_id;
			} else {

				$client_pt_id = $this->M_Vrbl->Get_NewID();
				$client_pt_id = $client_pt_id[0]['NEW_ID'];

				$client_pt_nama = $header['szName'];
				$client_pt_alamat = "";
				$client_pt_telepon = "";
				$client_pt_propinsi = "";
				$client_pt_kota = "";
				$client_pt_kecamatan = "";
				$client_pt_kelurahan = "";
				$client_pt_kodepos = "";
				$client_pt_latitude = "";
				$client_pt_longitude = "";
				$client_pt_nama_contact_person = $header['szName'];
				$client_pt_telepon_contact_person = "";
				$client_pt_email_contact_person = "";
				$client_pt_keterangan = $header['szDriverId'];
				$kelas_jalan_id = "";
				$area_id = "";
				$client_pt_corporate_id = "";
				$client_pt_top = "";
				$client_pt_kredit_limit = "";
				$client_pt_acc = "";
				$client_pt_titik_antar_id = "";
				$client_pt_segmen_id1 = "CE06C67C-D9A3-44DB-B07C-9759B558B1AD";
				$client_pt_segmen_id2 = "C160266E-0BC7-4E0A-A820-5FD27635C235";
				$client_pt_segmen_id3 = "96E77207-836B-40B1-ADA4-76E80F625B52";
				$unit_mandiri_id = "";
				$client_pt_is_deleted = "0";
				$client_pt_is_aktif = "1";
				$client_pt_is_multi_lokasi = "";
				$lokasi_outlet_id = "";
				$kelas_jalan2_id = "";
				$client_pt_fax = "";
				$client_pt_npwp = "";
				$client_pt_status_pkp = "";
				$eksternal_id = "";

				$data_depo = $this->M_SistemEksternal->Get_data_depo($this->session->userdata('depo_id'));

				if (count($data_depo) > 0) {
					foreach ($data_depo as $depo) {
						$client_pt_alamat = $depo['depo_alamat'];
						$client_pt_latitude = $depo['depo_latitude'];
						$client_pt_longitude = $depo['depo_longitude'];
					}
				}

				$result = $this->M_SistemEksternal->Insert_client_pt_driver($client_pt_id, $client_pt_nama, $client_pt_alamat, $client_pt_telepon, $client_pt_propinsi, $client_pt_kota, $client_pt_kecamatan, $client_pt_kelurahan, $client_pt_kodepos, $client_pt_latitude, $client_pt_longitude, $client_pt_nama_contact_person, $client_pt_telepon_contact_person, $client_pt_email_contact_person, $client_pt_keterangan, $kelas_jalan_id, $area_id, $client_pt_corporate_id, $client_pt_top, $client_pt_kredit_limit, $client_pt_acc, $client_pt_titik_antar_id, $client_pt_segmen_id1, $client_pt_segmen_id2, $client_pt_segmen_id3, $unit_mandiri_id, $client_pt_is_deleted, $client_pt_is_aktif, $client_pt_is_multi_lokasi, $lokasi_outlet_id, $kelas_jalan2_id, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp, $eksternal_id);

				if ($result != "1") {
					$msg = array("kode" => "15", "reff_id" => $header['szDriverId'], "msg" => "CAPTION-ALERT-SYNCCUSTOMERGAGAL");
					array_push($arr_msg, $msg);

					echo json_encode($arr_msg);
					return false;
				}
			}

			$data_pb_eksternal_detail = $this->M_SistemEksternal->Get_pb_eksternal_detail($header['szFPrId']);

			if ($karyawan_id != "0") {
				if ($CekDuplikatCanvasByReffId == 0) {
					if ($CekDuplikatCanvas == 0) {

						$this->db->trans_begin();

						$this->M_PerencanaanDanPersiapan->Insert_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $no_kendaraan, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create, $canvas_reff_kode, $principle_id, $client_pt_id);

						foreach ($data_pb_eksternal_detail as $detail) {
							$detail_mapping_canvas = $this->M_SistemEksternal->Exec_proses_mapping_canvas_by_penerimaan_barang_eksternal($canvas_id, $detail['szFPrId'], $detail['szProductId']);

							if (count($detail_mapping_canvas) > 0) {
								foreach ($detail_mapping_canvas as $detail_mapping_canvas) {
									$canvas_detail_id = $this->M_Vrbl->Get_NewID();
									$canvas_detail_id = $canvas_detail_id[0]['NEW_ID'];

									$sku_id = $detail_mapping_canvas['sku_id'];
									$sku_kode = $detail_mapping_canvas['sku_kode'];
									$sku_nama = $detail_mapping_canvas['sku_nama_produk'];
									$sku_kemasan = $detail_mapping_canvas['sku_kemasan'];
									$sku_satuan = $detail_mapping_canvas['sku_satuan'];
									$sku_qty = (int) $detail_mapping_canvas['sku_qty'];
									$sku_keterangan = $detail_mapping_canvas['sku_keterangan'];
									$tipe_stock_nama = $detail_mapping_canvas['tipe_stock_nama'];

									$CekCanvasById = $this->M_PerencanaanDanPersiapan->CekCanvasById($canvas_id);

									if ($CekCanvasById > 0) {
										$this->M_PerencanaanDanPersiapan->Insert_canvas_detail($canvas_detail_id, $canvas_id, $sku_id, $sku_kode, $sku_nama, $sku_kemasan, $sku_satuan, $sku_qty, $sku_keterangan, $tipe_stock_nama);
									}
								}
							} else {
								$this->db->trans_rollback();

								array_push($arr_msg, array("kode" => 4, "reff_id" => $header['szFPrId'], "sku_konversi_group" => $detail['szProductId']));
							}
						}

						if ($this->db->trans_status() === FALSE) {
							$this->db->trans_rollback();
							array_push($arr_msg, array("kode" => 0, "reff_id" => ""));

							// echo json_encode($arr_msg);
						} else {
							$this->db->trans_commit();
							array_push($arr_msg, array("kode" => 1, "reff_id" => ""));

							// echo json_encode($arr_msg);
						}
					}
				} else {
					array_push($arr_msg, array("kode" => 2, "reff_id" => $header['szFPrId']));
				}
			} else {
				array_push($arr_msg, array("kode" => 3, "reff_id" => $header['szDriverId']));
				// echo json_encode($arr_msg);
			}
		}

		echo json_encode($arr_msg);
	}

	public function Insert_bosnet_penerimaan_barang()
	{
		$data_pb_bosnet = $this->input->post('data_pb_bosnet');

		$this->db->trans_begin();

		foreach ($data_pb_bosnet as $value) {
			$szFDjrId = $value['szFDjrId'];
			$szFPrId = $value['szFPrId'];
			$dtmRequest = $value['dtmRequest'];
			$szDriverId = $value['szDriverId'];
			$szName = $value['szName'];
			$szVehicleId = $value['szVehicleId'];
			$szDivisionId = $value['szDivisionId'];
			$szStatus = $value['szStatus'];
			$bVoid = $value['bVoid'];
			$bApplied = $value['bApplied'];
			$szWorkplaceId = $value['szWorkplaceId'];
			$szDescription = $value['szDescription'];
			$szProductId = $value['szProductId'];
			$decQty = $value['decQty'];
			$szPrincipleId = $value['szPrincipleId'];

			$cek_duplikat_pb = $this->M_SistemEksternal->Cek_bosnet_penerimaan_barang($szFPrId, $szProductId);

			if ($cek_duplikat_pb == 0) {

				$this->M_SistemEksternal->Insert_bosnet_penerimaan_barang($szFDjrId, $szFPrId, $dtmRequest, $szDriverId, $szName, $szVehicleId, $szDivisionId, $szStatus, $bVoid, $bApplied, $szWorkplaceId, $szDescription, $szProductId, $decQty, $szPrincipleId);
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

	public function GetPrincipleByPerusahaan()
	{
		$perusahaan = $this->input->get('perusahaan');

		$data = $this->M_PerencanaanDanPersiapan->GetPrincipleByPerusahaan($perusahaan);

		echo json_encode($data);
	}
}
