<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class Harga extends CI_Controller
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

		$this->load->model('FAS/M_HargaDanPromo', 'M_HargaDanPromo');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->MenuKode = "221003001";
	}

	public function HargaMenu()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_HargaDanPromo');

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

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Harga'] = $this->M_HargaDanPromo->GetAllSKUHarga();

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/script', $data);
	}


	public function create()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_HargaDanPromo');

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

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1();

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/format_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/form', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/script', $data);
	}

	public function edit()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_HargaDanPromo');

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

		$segmen = array();
		$sku_harga_id = $this->input->get('id');
		$data['sku_harga_id'] = $sku_harga_id;

		// $sku_harga_id_new = $this->M_Vrbl->Get_NewID();
		$data['sku_harga_id_new'] = $sku_harga_id;

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepoByHarga($sku_harga_id);
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroupByHarga($sku_harga_id);
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1ByHarga($sku_harga_id);

		foreach ($data['Segmen1'] as $key => $value) {
			if ($value['client_pt_segmen_id_harga'] != "") {
				array_push($segmen, "'" . $value['client_pt_segmen_id'] . "'");
			}
		}

		$data['Customer'] = $this->M_HargaDanPromo->GetClientPtByHarga($sku_harga_id, $segmen);
		$data['HargaHeader'] = $this->M_HargaDanPromo->Get_harga_header_by_id($sku_harga_id);
		$data['HargaDetail'] = $this->M_HargaDanPromo->Get_harga_detail_by_id($sku_harga_id);
		$data['act'] = "edit";

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/format_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/edit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_edit', $data);
	}

	public function duplicate()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_HargaDanPromo');

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

		$segmen = array();
		$sku_harga_id = $this->input->get('id');
		$data['sku_harga_id'] = $sku_harga_id;

		$sku_harga_id_new = $this->M_Vrbl->Get_NewID();
		$data['sku_harga_id_new'] = $sku_harga_id_new[0]['NEW_ID'];

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepoByHarga($sku_harga_id);
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroupByHarga($sku_harga_id);
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1ByHarga($sku_harga_id);
		foreach ($data['Segmen1'] as $key => $value) {
			if ($value['client_pt_segmen_id_harga'] != "") {
				array_push($segmen, "'" . $value['client_pt_segmen_id'] . "'");
			}
		}
		$data['Customer'] = $this->M_HargaDanPromo->GetClientPtByHarga($sku_harga_id, $segmen);
		$data['HargaHeader'] = $this->M_HargaDanPromo->Get_harga_header_by_id($sku_harga_id);
		$data['HargaDetail'] = $this->M_HargaDanPromo->Get_harga_detail_by_id($sku_harga_id);
		$data['act'] = "duplicate";

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/format_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/duplicate', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_edit', $data);
	}

	public function detail()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_HargaDanPromo');

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

		$segmen = array();
		$sku_harga_id = $this->input->get('id');
		$data['sku_harga_id'] = $sku_harga_id;

		// $sku_harga_id_new = $this->M_Vrbl->Get_NewID();
		$data['sku_harga_id_new'] = $sku_harga_id;

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepoByHarga($sku_harga_id);
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroupByHarga($sku_harga_id);
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1ByHarga($sku_harga_id);
		foreach ($data['Segmen1'] as $key => $value) {
			if ($value['client_pt_segmen_id_harga'] != "") {
				array_push($segmen, "'" . $value['client_pt_segmen_id'] . "'");
			}
		}
		$data['Customer'] = $this->M_HargaDanPromo->GetClientPtByHarga($sku_harga_id, $segmen);
		$data['HargaHeader'] = $this->M_HargaDanPromo->Get_harga_header_by_id($sku_harga_id);
		$data['HargaDetail'] = $this->M_HargaDanPromo->Get_harga_detail_by_id($sku_harga_id);
		$data['act'] = "detail";

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/format_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/detail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_rupiah', $data);
		$this->load->view('FAS/HargaDanPromo/Harga/s_edit', $data);
	}

	public function getPrincipleByClientWMS()
	{
		$client_wms_id = $this->input->post('client_wms_id');
		$data = $this->M_HargaDanPromo->getPrincipleByClientWMS($client_wms_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function search_sku_harga_by_filter()
	{
		$sku_harga_kode = $this->input->get('sku_harga_kode');
		$client_wms_id = $this->input->get('client_wms_id');
		$sku_harga_is_aktif = $this->input->get('sku_harga_is_aktif');
		$depo_group_id = "";
		$depo_id = "";
		// $depo_group_id = $this->input->get('depo_group_id');
		// $depo_id = $this->input->get('depo_id');

		$data = $this->M_HargaDanPromo->search_sku_harga_by_filter($sku_harga_kode, $client_wms_id, $sku_harga_is_aktif);

		echo json_encode($data);
		// echo $depo;
	}

	public function search_filter_chosen_sku_harga()
	{
		$perusahaan = $this->input->post('perusahaan');
		$brand = $this->input->post('brand');
		$principle = $this->input->post('principle');
		$sku_induk = $this->input->post('sku_induk');
		$sku_nama_produk = $this->input->post('sku_nama_produk');

		$data = $this->M_HargaDanPromo->search_filter_chosen_sku_harga($perusahaan, $brand, $principle, $sku_induk, $sku_nama_produk);

		echo json_encode($data);
	}

	public function search_depo_by_group()
	{
		$depo_group_nama = $this->input->post('depo_group_nama');

		$data = $this->M_HargaDanPromo->search_depo_by_group($depo_group_nama);

		echo json_encode($data);
	}

	public function GetSelectedSKU()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_HargaDanPromo->GetSelectedSKU($sku_id);

		echo json_encode($data);
	}

	public function GetSelectedSKUEdit()
	{
		$sku_harga_id = $this->input->post('sku_harga_id');
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_HargaDanPromo->GetSelectedSKUEdit($sku_harga_id, $sku_id);

		echo json_encode($data);
	}

	public function insert_sku_harga()
	{
		// $sku_harga_id = $this->input->post('sku_harga_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$depo_id = $this->input->post('depo_id');
		$depo_group_nama = $this->input->post('depo_group_nama');
		$sku_harga_kode = $this->input->post('sku_harga_kode');
		$sku_harga_keterangan = $this->input->post('sku_harga_keterangan');
		$sku_harga_startdate = $this->input->post('sku_harga_startdate');
		$sku_harga_enddate = $this->input->post('sku_harga_enddate');
		$sku_harga_status = $this->input->post('sku_harga_status');
		$sku_harga_who_create = $this->input->post('sku_harga_who_create');
		$sku_harga_tgl_create = $this->input->post('sku_harga_tgl_create');
		$sku_harga_who_approve = $this->input->post('sku_harga_who_approve');
		$sku_harga_tgl_approve = $this->input->post('sku_harga_tgl_approve');
		$sku_harga_is_aktif = $this->input->post('sku_harga_is_aktif');
		$sku_harga_is_delete = $this->input->post('sku_harga_is_delete');
		$sku_harga_id_before = $this->input->post('sku_harga_id_before');
		$sku_harga_is_need_approval = $this->input->post('sku_harga_is_need_approval');
		$is_khusus = $this->input->post('is_khusus');
		$client_pt_segmen = $this->input->post('client_pt_segmen');
		$client_pt_id = $this->input->post('client_pt_id');
		$detail = $this->input->post('detail');

		$validasi = array();

		$sku_harga_id = $this->M_Vrbl->Get_NewID();
		$sku_harga_id = $sku_harga_id[0]['NEW_ID'];

		$approvalParam = "APPRV_KATALOGHARGA_01";

		// $depo_nama = $this->M_HargaDanPromo->GetNamaDepoById($depo_id);
		$perusahaan_nama = $this->M_HargaDanPromo->GetNamaPerusahaanById($client_wms_id);
		$arr_depo_group = $this->M_HargaDanPromo->search_depo_group_by_multi_depo($depo_id);

		$cek_sku_harga = $this->M_HargaDanPromo->cek_sku_harga($sku_harga_startdate, $sku_harga_enddate, $client_wms_id, $depo_id);

		// if ($cek_sku_harga == 0) {

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_harga(
			$sku_harga_id,
			$client_wms_id,
			$depo_id,
			$depo_group_nama,
			$sku_harga_kode,
			$sku_harga_keterangan,
			$sku_harga_startdate,
			$sku_harga_enddate,
			$sku_harga_status,
			$sku_harga_who_create,
			$sku_harga_tgl_create,
			$sku_harga_who_approve,
			$sku_harga_tgl_approve,
			$sku_harga_is_aktif,
			$sku_harga_is_delete,
			$sku_harga_id_before,
			$is_khusus
		);

		foreach ($detail as $key => $value) {
			$sku_harga_detail_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_detail_id = $sku_harga_detail_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_detail($sku_harga_id, $sku_harga_detail_id, $value);
			// $this->M_HargaDanPromo->insert_sku_harga_detail2($so_id, $value);
		}

		foreach ($arr_depo_group as $value) {
			$this->M_HargaDanPromo->insert_sku_harga_lokasi($sku_harga_id, $value['depo_group_nama'], $value['depo_id']);
		}

		foreach ($client_pt_segmen as $value) {

			$sku_harga_segmen_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_segmen_id = $sku_harga_segmen_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_segmen($sku_harga_segmen_id, $sku_harga_id, str_replace("'", "", $value));
		}

		$arr_client_pt_by_segmen = $this->M_HargaDanPromo->Get_sku_harga_segmen_for_client_pt($sku_harga_id, $client_pt_id);

		foreach ($arr_client_pt_by_segmen as $value) {

			$sku_harga_segmen_detail_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_segmen_detail_id = $sku_harga_segmen_detail_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_segmen_detail($sku_harga_segmen_detail_id, $value['sku_harga_segmen_id'], $sku_harga_id, $value['client_pt_id']);
		}

		if ($sku_harga_is_need_approval == "1") {
			$depo_id = $this->session->userdata("depo_id");
			$this->M_HargaDanPromo->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_id'), $approvalParam, $sku_harga_id, $sku_harga_kode, 0, 0);
			// foreach ($arr_depo_group as $value) {
			// 	$this->M_HargaDanPromo->Exec_approval_pengajuan($value['depo_id'], $this->session->userdata('pengguna_id'), $approvalParam, $sku_harga_id, $sku_harga_kode, 0, 0);
			// }
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			$msg = array("kode" => "0", "start_date" => $sku_harga_startdate, "end_date" => $sku_harga_enddate, "perusahaan" => $perusahaan_nama);
			array_push($validasi, $msg);
		} else {
			$this->db->trans_commit();

			$msg = array("kode" => "1", "start_date" => $sku_harga_startdate, "end_date" => $sku_harga_enddate, "perusahaan" => $perusahaan_nama);
			array_push($validasi, $msg);
		}
		// } else {

		// 	$msg = array("kode" => "2", "start_date" => $sku_harga_startdate, "end_date" => $sku_harga_enddate, "perusahaan" => $perusahaan_nama);
		// 	array_push($validasi, $msg);
		// }

		// $validasi_uniq = array_unique($validasi);
		// rsort($validasi_uniq);
		// echo json_encode($validasi_uniq);
		echo json_encode($validasi);
	}

	public function update_sku_harga()
	{
		$sku_harga_id = $this->input->post('sku_harga_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$depo_id = $this->input->post('depo_id');
		$depo_group_nama = $this->input->post('depo_group_nama');
		$sku_harga_kode = $this->input->post('sku_harga_kode');
		$sku_harga_keterangan = $this->input->post('sku_harga_keterangan');
		$sku_harga_startdate = $this->input->post('sku_harga_startdate');
		$sku_harga_enddate = $this->input->post('sku_harga_enddate');
		$sku_harga_status = $this->input->post('sku_harga_status');
		$sku_harga_who_create = $this->input->post('sku_harga_who_create');
		$sku_harga_tgl_create = $this->input->post('sku_harga_tgl_create');
		$sku_harga_who_approve = $this->input->post('sku_harga_who_approve');
		$sku_harga_tgl_approve = $this->input->post('sku_harga_tgl_approve');
		$sku_harga_is_aktif = $this->input->post('sku_harga_is_aktif');
		$sku_harga_is_delete = $this->input->post('sku_harga_is_delete');
		$sku_harga_id_before = $this->input->post('sku_harga_id_before');
		$sku_harga_is_need_approval = $this->input->post('sku_harga_is_need_approval');
		$is_khusus = $this->input->post('is_khusus');
		$client_pt_segmen = $this->input->post('client_pt_segmen');
		$client_pt_id = $this->input->post('client_pt_id');
		$detail = $this->input->post('detail');

		$approvalParam = "APPRV_KATALOGHARGA_01";

		$validasi = array();

		// $depo_nama = $this->M_HargaDanPromo->GetNamaDepoById($depo_id);
		$perusahaan_nama = $this->M_HargaDanPromo->GetNamaPerusahaanById($client_wms_id);
		$arr_depo_group = $this->M_HargaDanPromo->search_depo_group_by_multi_depo($depo_id);

		$this->db->trans_begin();

		$this->M_HargaDanPromo->update_sku_harga(
			$sku_harga_id,
			$client_wms_id,
			$depo_id,
			$depo_group_nama,
			$sku_harga_kode,
			$sku_harga_keterangan,
			$sku_harga_startdate,
			$sku_harga_enddate,
			$sku_harga_status,
			$sku_harga_who_create,
			$sku_harga_tgl_create,
			$sku_harga_who_approve,
			$sku_harga_tgl_approve,
			$sku_harga_is_aktif,
			$sku_harga_is_delete,
			$sku_harga_id_before,
			$is_khusus
		);

		$this->M_HargaDanPromo->delete_sku_harga_detail($sku_harga_id);

		foreach ($detail as $key => $value) {
			$sku_harga_detail_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_detail_id = $sku_harga_detail_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_detail($sku_harga_id, $sku_harga_detail_id, $value);
			// $this->M_HargaDanPromo->insert_sku_harga_detail2($so_id, $value);
		}

		$this->M_HargaDanPromo->delete_sku_harga_lokasi($sku_harga_id);
		$this->M_HargaDanPromo->delete_sku_harga_segmen($sku_harga_id);
		$this->M_HargaDanPromo->delete_sku_harga_segmen_detail($sku_harga_id);

		foreach ($arr_depo_group as $value) {
			$this->M_HargaDanPromo->insert_sku_harga_lokasi($sku_harga_id, $value['depo_group_nama'], $value['depo_id']);
		}

		foreach ($client_pt_segmen as $value) {

			$sku_harga_segmen_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_segmen_id = $sku_harga_segmen_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_segmen($sku_harga_segmen_id, $sku_harga_id, str_replace("'", "", $value));
		}

		$arr_client_pt_by_segmen = $this->M_HargaDanPromo->Get_sku_harga_segmen_for_client_pt($sku_harga_id, $client_pt_id);

		foreach ($arr_client_pt_by_segmen as $value) {

			$sku_harga_segmen_detail_id = $this->M_Vrbl->Get_NewID();
			$sku_harga_segmen_detail_id = $sku_harga_segmen_detail_id[0]['NEW_ID'];

			$this->M_HargaDanPromo->insert_sku_harga_segmen_detail($sku_harga_segmen_detail_id, $value['sku_harga_segmen_id'], $sku_harga_id, $value['client_pt_id']);
		}

		if ($sku_harga_is_need_approval == "1") {
			$depo_id = $this->session->userdata("depo_id");
			$this->M_HargaDanPromo->Exec_approval_pengajuan($depo_id, $this->session->userdata('pengguna_grup_id'), $approvalParam, $sku_harga_id, $sku_harga_kode, 0, 0);
			// foreach ($arr_depo_group as $value) {
			// 	$this->M_HargaDanPromo->Exec_approval_pengajuan($value['depo_id'], $this->session->userdata('pengguna_grup_id'), $approvalParam, $sku_harga_id, $sku_harga_kode, 0, 0);
			// }
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			$msg = array("kode" => "0", "start_date" => $sku_harga_startdate, "end_date" => $sku_harga_enddate, "perusahaan" => $perusahaan_nama);
			array_push($validasi, $msg);
		} else {
			$this->db->trans_commit();

			$msg = array("kode" => "1", "start_date" => $sku_harga_startdate, "end_date" => $sku_harga_enddate, "perusahaan" => $perusahaan_nama);
			array_push($validasi, $msg);
		}

		// $validasi_uniq = array_unique($validasi);
		// rsort($validasi_uniq);
		// echo json_encode($validasi_uniq);
		echo json_encode($validasi);
	}

	public function GetHargaDepo()
	{
		$sku_harga_id = $this->input->get('sku_harga_id');

		$data = $this->M_HargaDanPromo->GetHargaDepo($sku_harga_id);

		echo json_encode($data);
	}

	public function GetPelangganBySegmen()
	{
		$segmen = $this->input->post('segmen');

		$data = $this->M_HargaDanPromo->GetPelangganBySegmen($segmen);

		echo json_encode($data);
	}
}
