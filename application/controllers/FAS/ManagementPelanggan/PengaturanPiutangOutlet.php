<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengaturanPiutangOutlet extends CI_Controller
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

		$this->MenuKode = "222023000";
		$this->load->model(['M_Menu', 'FAS/M_PengaturanPiutangOutlet', 'M_Function', 'M_MenuAccess', 'M_Vrbl']);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function PengaturanPiutangOutletMenu()
	{
		$this->load->model('M_Menu');

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
			base_url('/node_modules/html5-qrcode/html5-qrcode.min.js')
			// 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);


		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['Perusahaan'] = $this->M_PengaturanPiutangOutlet->GetPerusahaan();
		$data['Category'] = $this->M_PengaturanPiutangOutlet->GetCategory();
		// $data['Sistem'] = $this->M_PengaturanPiutangOutlet->GetSistemEksternal();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/ManagementPelanggan/PengaturanPiutangOutlet/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/ManagementPelanggan/PengaturanPiutangOutlet/script', $data);
	}

	public function Get_pengaturan_piutang_outlet()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$perusahaan = $this->input->get('perusahaan');
		$brand = $this->input->get('brand');
		$sku_induk = $this->input->get('sku_induk');

		$data = $this->M_PengaturanPiutangOutlet->Get_pengaturan_piutang_outlet($perusahaan, $brand, $sku_induk);

		echo json_encode($data);
	}

	public function Get_pengaturan_piutang_outlet_by_id()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$id = $this->input->get('id');

		$data['header'] = $this->M_PengaturanPiutangOutlet->Get_pengaturan_piutang_outlet_by_id($id);
		$data['detail'] = $this->M_PengaturanPiutangOutlet->Get_client_pt_setting_piutang_khusus_by_id($id);

		echo json_encode($data);
	}

	public function insert_client_pt_setting_piutang()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_setting_piutang_id = $this->M_Vrbl->Get_NewID();
		$client_pt_setting_piutang_id = $client_pt_setting_piutang_id[0]['NEW_ID'];

		$client_pt_setting_segment1 = $this->input->post('client_pt_setting_segment1');
		$client_pt_setting_segment2 = $this->input->post('client_pt_setting_segment2');
		$client_pt_setting_segment3 = $this->input->post('client_pt_setting_segment3');
		$client_pt_setting_category = $this->input->post('client_pt_setting_category');
		$client_pt_setting_brand = $this->input->post('client_pt_setting_brand');
		$client_pt_setting_sku_id = $this->input->post('client_pt_setting_sku_id');
		$client_pt_setting_top = $this->input->post('client_pt_setting_top');
		$client_pt_setting_is_aktif = $this->input->post('client_pt_setting_is_aktif');
		$client_wms_id = $this->input->post('client_wms_id');
		$detail = $this->input->post('detail');


		$this->db->trans_begin();

		$this->M_PengaturanPiutangOutlet->insert_client_pt_setting_piutang($client_pt_setting_piutang_id, $client_pt_setting_segment1, $client_pt_setting_segment2, $client_pt_setting_segment3, $client_pt_setting_category, $client_pt_setting_brand, $client_pt_setting_sku_id, $client_pt_setting_top, $client_pt_setting_is_aktif, $client_wms_id);

		if ($detail != "") {

			foreach ($detail as $key => $value) {
				$client_pt_setting_piutang_khusus_id = $this->M_Vrbl->Get_NewID();
				$client_pt_setting_piutang_khusus_id = $client_pt_setting_piutang_khusus_id[0]['NEW_ID'];

				$this->M_PengaturanPiutangOutlet->insert_client_pt_setting_piutang_khusus($client_pt_setting_piutang_khusus_id, $client_pt_setting_piutang_id, $value['client_pt_id']);
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

	public function update_client_pt_setting_piutang()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_setting_piutang_id = $this->input->post('client_pt_setting_piutang_id');
		$client_pt_setting_segment1 = $this->input->post('client_pt_setting_segment1');
		$client_pt_setting_segment2 = $this->input->post('client_pt_setting_segment2');
		$client_pt_setting_segment3 = $this->input->post('client_pt_setting_segment3');
		$client_pt_setting_category = $this->input->post('client_pt_setting_category');
		$client_pt_setting_brand = $this->input->post('client_pt_setting_brand');
		$client_pt_setting_sku_id = $this->input->post('client_pt_setting_sku_id');
		$client_pt_setting_top = $this->input->post('client_pt_setting_top');
		$client_pt_setting_is_aktif = $this->input->post('client_pt_setting_is_aktif');
		$client_wms_id = $this->input->post('client_wms_id');
		$updtgl = $this->input->post('updtgl');
		$updwho = $this->input->post('updwho');
		$detail = $this->input->post('detail');


		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "BACKEND.dbo.client_pt_setting_piutang",
			'whereField' => "client_pt_setting_piutang_id",
			'whereValue' => $client_pt_setting_piutang_id,
			'fieldDateUpdate' => "updtgl",
			'fieldWhoUpdate' => "updwho",
			'lastUpdated' => $updtgl,
			'app' => "fas"
		]);

		if ($lastUpdatedChecked['status'] == 400) {
			echo json_encode(2);
			return false;
		}

		$this->db->trans_begin();

		$this->M_PengaturanPiutangOutlet->update_client_pt_setting_piutang($client_pt_setting_piutang_id, $client_pt_setting_segment1, $client_pt_setting_segment2, $client_pt_setting_segment3, $client_pt_setting_category, $client_pt_setting_brand, $client_pt_setting_sku_id, $client_pt_setting_top, $client_pt_setting_is_aktif, $client_wms_id);

		$this->M_PengaturanPiutangOutlet->delete_client_pt_setting_piutang_khusus($client_pt_setting_piutang_id);

		if ($detail != "") {

			foreach ($detail as $key => $value) {
				$client_pt_setting_piutang_khusus_id = $this->M_Vrbl->Get_NewID();
				$client_pt_setting_piutang_khusus_id = $client_pt_setting_piutang_khusus_id[0]['NEW_ID'];

				$this->M_PengaturanPiutangOutlet->insert_client_pt_setting_piutang_khusus($client_pt_setting_piutang_khusus_id, $client_pt_setting_piutang_id, $value['client_pt_id']);
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

	public function delete_client_pt_setting_piutang()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_setting_piutang_id = $this->input->post('client_pt_setting_piutang_id');

		$this->db->trans_begin();

		$this->M_PengaturanPiutangOutlet->delete_client_pt_setting_piutang($client_pt_setting_piutang_id);
		$this->M_PengaturanPiutangOutlet->delete_client_pt_setting_piutang_khusus($client_pt_setting_piutang_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function get_segment1()
	{
		$term = $this->input->get('q');

		$data = $this->M_PengaturanPiutangOutlet->get_segment1($term);

		$results = array();
		$results[] = array(
			'id' => "all",
			'text' => "** Choose Segment 1 **" // Assuming 'name' is the field you want to display
		);
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function get_segment2()
	{
		$term = $this->input->get('q');

		$data = $this->M_PengaturanPiutangOutlet->get_segment2($term);

		$results = array();
		$results[] = array(
			'id' => "all",
			'text' => "** Choose Segment 2 **" // Assuming 'name' is the field you want to display
		);
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function get_segment3()
	{
		$term = $this->input->get('q');

		$data = $this->M_PengaturanPiutangOutlet->get_segment3($term);

		$results = array();
		$results[] = array(
			'id' => "all",
			'text' => "** Choose Segment 3 **" // Assuming 'name' is the field you want to display
		);
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function get_brand()
	{
		$term = $this->input->get('q');

		$data = $this->M_PengaturanPiutangOutlet->get_brand($term);

		$results = array();
		$results[] = array(
			'id' => "all",
			'text' => "** Choose Brand **" // Assuming 'name' is the field you want to display
		);
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function get_sku()
	{
		$term = $this->input->get('q');

		$data = $this->M_PengaturanPiutangOutlet->get_sku($term);

		$results = array();
		$results[] = array(
			'id' => "all",
			'text' => "** Choose SKU **" // Assuming 'name' is the field you want to display
		);
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function search_client_pt()
	{
		$client_pt = $this->input->get('query');

		$data = array();
		$arr_no_perk = $this->M_PengaturanPiutangOutlet->search_client_pt($client_pt);

		foreach ($arr_no_perk as $value) {
			$value["data"] = $value["client_pt_id"];
			$value["value"] = $value["client_pt_nama"];

			array_push($data, $value);
		}

		$hasil = array();
		$hasil["suggestions"] = $data;
		echo json_encode($hasil);
	}

	public function Get_brand_by_sku()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}
		$sku_id = $this->input->get('sku_id');
		$data = $this->M_PengaturanPiutangOutlet->Get_brand_by_sku($sku_id);

		echo json_encode($data);
	}
}
