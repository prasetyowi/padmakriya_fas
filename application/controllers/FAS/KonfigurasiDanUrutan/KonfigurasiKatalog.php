<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class KonfigurasiKatalog extends CI_Controller
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

		$this->MenuKode = "223002000";

		$this->load->model('FAS/M_KonfigurasiKatalog', 'M_KonfigurasiKatalog');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Menu');
		$this->load->model('M_Function');
		$this->load->model('M_MenuAccess');
	}

	public function KonfigurasiKatalogMenu()
	{
		$data = array();
		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
		);

		$data['js_files'] 	= array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// $data['Depo'] = $this->M_KonfigurasiKatalog->GetDepo();
		// $data['DepoGroup'] = $this->M_KonfigurasiKatalog->GetDepoGroup();
		// $data['Kategori'] = $this->M_KonfigurasiKatalog->GetKategori();
		// $data['KategoriGroup'] = $this->M_KonfigurasiKatalog->GetKategoriGroup();
		// $data['Principle'] = $this->M_KonfigurasiKatalog->GetPrinciple();
		// $data['Brand'] = $this->M_KonfigurasiKatalog->GetBrand();
		// $data['Promo'] = $this->M_KonfigurasiKatalog->GetAllSKUPromo();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/s_index', $data);
	}

	public function create()
	{
		$data = array();
		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
		);

		$data['js_files'] 	= array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$sku_katalog_setting_id = $this->M_Vrbl->Get_NewID();
		$data['sku_katalog_setting_id'] = $sku_katalog_setting_id[0]['NEW_ID'];
		$data['Depo'] = $this->M_KonfigurasiKatalog->GetDepo();
		$data['KategoriGroup'] = $this->M_KonfigurasiKatalog->GetKategoriGroup();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/form', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/s_form', $data);
	}

	public function edit()
	{
		$data = array();
		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
		);

		$data['js_files'] 	= array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$sku_katalog_setting_id = $this->input->get('id');

		$data['KonfigurasiHeader'] = $this->M_KonfigurasiKatalog->GetKonfigurasiHeader($sku_katalog_setting_id);
		$data['KonfigurasiDetail'] = $this->M_KonfigurasiKatalog->GetKonfigurasiDetail($sku_katalog_setting_id);
		$data['Depo'] = $this->M_KonfigurasiKatalog->GetDepo();
		$data['KategoriGroup'] = $this->M_KonfigurasiKatalog->GetKategoriGroup();
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/edit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/KonfigurasiKatalog/s_edit', $data);
	}

	public function GetKategoriByTipeKategori()
	{
		$tipe_kategori = $this->input->get('tipe_kategori');

		$data = $this->M_KonfigurasiKatalog->GetKategoriByTipeKategori($tipe_kategori);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetKategoriBySKUOutlet()
	{
		$id = $this->input->get('id');
		$kategori = $this->input->get('kategori');

		$data = $this->M_KonfigurasiKatalog->GetKategoriBySKUOutlet($id, $kategori);

		echo json_encode($data);
		// echo $depo;
	}


	public function getByKategori()
	{
		$kategori = $this->input->post('kategori');

		$data = $this->M_KonfigurasiKatalog->getByKategori($kategori);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetAllSKUHarga()
	{
		$data = $this->M_KonfigurasiKatalog->GetAllSKUHarga();

		echo json_encode($data);
		// echo $depo;
	}

	public function GetAllSKUPromo()
	{
		$data = $this->M_KonfigurasiKatalog->GetAllSKUPromo();

		echo json_encode($data);
		// echo $depo;
	}

	public function GetKonfigurasiKatalogByFilter()
	{

		$sku_katalog_setting_id = $this->input->get('sku_katalog_setting_id');
		$data = $this->M_KonfigurasiKatalog->GetKonfigurasiKatalogByFilter($sku_katalog_setting_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function insert_sku_katalog_setting()
	{
		$sku_katalog_setting_id = $this->input->post('sku_katalog_setting_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$depo_id = $this->input->post('depo_id');
		$sku_katalog_setting_kode = $this->input->post('sku_katalog_setting_kode');
		$sku_katalog_setting_keterangan = $this->input->post('sku_katalog_setting_keterangan');
		$sku_katalog_setting_status = $this->input->post('sku_katalog_setting_status');
		$sku_katalog_setting_who_create = $this->input->post('sku_katalog_setting_who_create');
		$sku_katalog_setting_tgl_create = $this->input->post('sku_katalog_setting_tgl_create');
		$sku_katalog_setting_who_approve = $this->input->post('sku_katalog_setting_who_approve');
		$sku_katalog_setting_tgl_approve = $this->input->post('sku_katalog_setting_tgl_approve');
		$sku_katalog_setting_is_aktif = $this->input->post('sku_katalog_setting_is_aktif');

		$detail = $this->input->post('detail');

		$validasi = array();

		$sku_katalog_setting_id = $this->M_Vrbl->Get_NewID();
		$sku_katalog_setting_id = $sku_katalog_setting_id[0]['NEW_ID'];

		$approvalParam = "APPRV_KATALOGHARGA_01";

		$cek_sku_katalog_setting = $this->M_KonfigurasiKatalog->cek_sku_katalog_setting($sku_katalog_setting_kode);

		if ($cek_sku_katalog_setting == 0) {

			$this->db->trans_begin();

			$this->M_KonfigurasiKatalog->insert_sku_katalog_setting($sku_katalog_setting_id, $client_wms_id, $depo_id, $sku_katalog_setting_kode, $sku_katalog_setting_keterangan, $sku_katalog_setting_status, $sku_katalog_setting_who_create, $sku_katalog_setting_tgl_create, $sku_katalog_setting_who_approve, $sku_katalog_setting_tgl_approve, $sku_katalog_setting_is_aktif);

			foreach ($detail as $key => $value) {
				$sku_katalog_setting_detail = $this->M_Vrbl->Get_NewID();
				$sku_katalog_setting_detail = $sku_katalog_setting_detail[0]['NEW_ID'];

				$this->M_KonfigurasiKatalog->insert_sku_katalog_setting_detail($sku_katalog_setting_detail, $sku_katalog_setting_id, $value);
				// $this->M_KonfigurasiKatalog->insert_sku_katalog_setting_detail2($so_id, $value);
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$msg = array("kode" => "0", "katalog_kode" => $sku_katalog_setting_kode);
				echo json_encode($msg);
			} else {
				$this->db->trans_commit();
				$msg = array("kode" => "1", "katalog_kode" => $sku_katalog_setting_kode);
				echo json_encode($msg);
			}
		} else {
			$msg = array("kode" => "2", "katalog_kode" => $sku_katalog_setting_kode);
			echo json_encode($msg);
		}
	}

	public function update_sku_katalog_setting()
	{
		$sku_katalog_setting_id = $this->input->post('sku_katalog_setting_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$depo_id = $this->input->post('depo_id');
		$sku_katalog_setting_kode = $this->input->post('sku_katalog_setting_kode');
		$sku_katalog_setting_keterangan = $this->input->post('sku_katalog_setting_keterangan');
		$sku_katalog_setting_status = $this->input->post('sku_katalog_setting_status');
		$sku_katalog_setting_who_create = $this->input->post('sku_katalog_setting_who_create');
		$sku_katalog_setting_tgl_create = $this->input->post('sku_katalog_setting_tgl_create');
		$sku_katalog_setting_who_approve = $this->input->post('sku_katalog_setting_who_approve');
		$sku_katalog_setting_tgl_approve = $this->input->post('sku_katalog_setting_tgl_approve');
		$sku_katalog_setting_is_aktif = $this->input->post('sku_katalog_setting_is_aktif');

		$detail = $this->input->post('detail');

		$validasi = array();

		$approvalParam = "APPRV_KATALOGHARGA_01";

		$this->db->trans_begin();

		$this->M_KonfigurasiKatalog->update_sku_katalog_setting($sku_katalog_setting_id, $client_wms_id, $depo_id, $sku_katalog_setting_kode, $sku_katalog_setting_keterangan, $sku_katalog_setting_status, $sku_katalog_setting_who_create, $sku_katalog_setting_tgl_create, $sku_katalog_setting_who_approve, $sku_katalog_setting_tgl_approve, $sku_katalog_setting_is_aktif);

		$this->M_KonfigurasiKatalog->delete_sku_katalog_setting_detail($sku_katalog_setting_id);

		foreach ($detail as $key => $value) {
			$sku_katalog_setting_detail = $this->M_Vrbl->Get_NewID();
			$sku_katalog_setting_detail = $sku_katalog_setting_detail[0]['NEW_ID'];

			$this->M_KonfigurasiKatalog->insert_sku_katalog_setting_detail($sku_katalog_setting_detail, $sku_katalog_setting_id, $value);
			// $this->M_KonfigurasiKatalog->insert_sku_katalog_setting_detail2($so_id, $value);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$msg = array("kode" => "0", "katalog_kode" => $sku_katalog_setting_kode);
			echo json_encode($msg);
		} else {
			$this->db->trans_commit();
			$msg = array("kode" => "1", "katalog_kode" => $sku_katalog_setting_kode);
			echo json_encode($msg);
		}
	}
}
