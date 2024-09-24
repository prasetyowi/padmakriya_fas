<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class Promo extends CI_Controller
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

		$this->MenuKode = "221003002";

		$this->load->model('FAS/M_HargaDanPromo', 'M_HargaDanPromo');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Menu');
		$this->load->model('M_Function');
		$this->load->model('M_MenuAccess');
	}

	public function PromoMenu()
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

		$sku_promo_id = $this->M_Vrbl->Get_NewID();
		$data['sku_promo_id'] = $sku_promo_id[0]['NEW_ID'];

		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['Kategori'] = $this->M_HargaDanPromo->GetKategori();
		$data['KategoriGroup'] = $this->M_HargaDanPromo->GetKategoriGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Brand'] = $this->M_HargaDanPromo->GetBrand();
		$data['Promo'] = $this->M_HargaDanPromo->GetAllSKUPromo();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/s_index', $data);
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

		$sku_promo_id = $this->M_Vrbl->Get_NewID();
		$data['sku_promo_id'] = $sku_promo_id[0]['NEW_ID'];

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['Kategori'] = $this->M_HargaDanPromo->GetKategori();
		$data['KategoriGroup'] = $this->M_HargaDanPromo->GetKategoriGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Brand'] = $this->M_HargaDanPromo->GetBrand();
		$data['ReferensiDiskon'] = $this->M_HargaDanPromo->GetReferensiDiskon();
		$data['TipeDiskon'] = $this->M_HargaDanPromo->GetTipeDiskon();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/form', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/s_rupiah');
		$this->load->view('FAS/HargaDanPromo/Promo/script', $data);
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

		$sku_promo_id = $this->input->get('id');
		$data['sku_promo_id'] = $sku_promo_id;
		$data['sku_promo_id_new'] = $sku_promo_id;

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['Depo2'] = $this->M_HargaDanPromo->GetDepoByPromo($sku_promo_id);
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['DepoGroup2'] = $this->M_HargaDanPromo->GetDepoGroupByPromo($sku_promo_id);
		$data['Kategori'] = $this->M_HargaDanPromo->GetKategori();
		$data['KategoriGroup'] = $this->M_HargaDanPromo->GetKategoriGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Brand'] = $this->M_HargaDanPromo->GetBrand();
		$data['PromoHeader'] = $this->M_HargaDanPromo->Get_promo_temp_by_id($sku_promo_id);
		$data['ReferensiDiskon'] = $this->M_HargaDanPromo->GetReferensiDiskon();
		$data['TipeDiskon'] = $this->M_HargaDanPromo->GetTipeDiskon();

		$segmen = array();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1ByPromo($sku_promo_id);
		foreach ($data['Segmen1'] as $key => $value) {
			if ($value['client_pt_segmen_id_promo'] != "") {
				array_push($segmen, "'" . $value['client_pt_segmen_id'] . "'");
			}
		}
		$data['Customer'] = $this->M_HargaDanPromo->GetClientPtByPromo($sku_promo_id, $segmen);
		$data['act'] = "edit";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/edit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/s_edit', $data);
	}

	public function detail()
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

		$sku_promo_id = $this->input->get('id');
		$data['sku_promo_id'] = $sku_promo_id;
		$data['sku_promo_id_new'] = $sku_promo_id;

		$DepoGroupNama = $this->M_HargaDanPromo->getDepoGroupNamaSkuPromoLokasi($sku_promo_id);
		$depoGroupNamaArray = array_column($DepoGroupNama, 'depo_group_nama');
		$data['DepoGroupNama'] = implode(", ", $depoGroupNamaArray);

		$Depo = $this->M_HargaDanPromo->getDepoSkuPromoLokasi($sku_promo_id);
		$depoNamaArray = array_column($Depo, 'depo_nama');
		$data['Depo'] = implode(", ", $depoNamaArray);

		$Segmen = $this->M_HargaDanPromo->getSkuPromoSegmen($sku_promo_id);
		$segmenNamaArray = array_column($Segmen, 'segmen');
		$data['Segmen'] = implode(", ", $segmenNamaArray);

		$data['Customer'] = $this->M_HargaDanPromo->getSkuPromoSegmenDetail($sku_promo_id);

		$data['Kategori'] = $this->M_HargaDanPromo->GetKategori();
		$data['KategoriGroup'] = $this->M_HargaDanPromo->GetKategoriGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Brand'] = $this->M_HargaDanPromo->GetBrand();
		$data['PromoHeader'] = $this->M_HargaDanPromo->Get_promo_by_id($sku_promo_id);
		$data['ReferensiDiskon'] = $this->M_HargaDanPromo->GetReferensiDiskon();
		$data['TipeDiskon'] = $this->M_HargaDanPromo->GetTipeDiskon();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/detail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/s_detail', $data);
	}

	public function duplicate()
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

		$sku_promo_id = $this->input->get('id');
		$data['sku_promo_id'] = $sku_promo_id;
		$data['sku_promo_id_new'] = $sku_promo_id;

		$data['Perusahaan'] = $this->M_HargaDanPromo->GetPerusahaan();
		$data['Depo'] = $this->M_HargaDanPromo->GetDepo();
		$data['Depo2'] = $this->M_HargaDanPromo->GetDepoByPromo($sku_promo_id);
		$data['DepoGroup'] = $this->M_HargaDanPromo->GetDepoGroup();
		$data['DepoGroup2'] = $this->M_HargaDanPromo->GetDepoGroupByPromo($sku_promo_id);
		$data['Kategori'] = $this->M_HargaDanPromo->GetKategori();
		$data['KategoriGroup'] = $this->M_HargaDanPromo->GetKategoriGroup();
		$data['Principle'] = $this->M_HargaDanPromo->GetPrinciple();
		$data['Brand'] = $this->M_HargaDanPromo->GetBrand();
		$data['PromoHeader'] = $this->M_HargaDanPromo->Get_promo_by_id($sku_promo_id);
		$data['ReferensiDiskon'] = $this->M_HargaDanPromo->GetReferensiDiskon();
		$data['TipeDiskon'] = $this->M_HargaDanPromo->GetTipeDiskon();

		$segmen = array();
		$data['Segmen1'] = $this->M_HargaDanPromo->GetClientPtSegmen1ByPromo($sku_promo_id);
		foreach ($data['Segmen1'] as $key => $value) {
			if ($value['client_pt_segmen_id_promo'] != "") {
				array_push($segmen, "'" . $value['client_pt_segmen_id'] . "'");
			}
		}
		$data['Customer'] = $this->M_HargaDanPromo->GetClientPtByPromo($sku_promo_id, $segmen);
		$data['act'] = "duplicate";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/duplicate', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/HargaDanPromo/Promo/s_duplicate', $data);
	}

	public function search_filter_chosen_sku()
	{
		$sku_kode_wms = $this->input->post('sku_kode_wms');
		$sku_kode_pabrik = $this->input->post('sku_kode_pabrik');
		$brand = $this->input->post('brand');
		$principle = $this->input->post('principle');
		$sku_induk = $this->input->post('sku_induk');
		$sku_nama_produk = $this->input->post('sku_nama_produk');
		$sku_group_id = $this->input->post('sku_group_id');
		$sku_group_nama = $this->input->post('sku_group_nama');
		$perusahaan = $this->input->post('perusahaan');

		$data = $this->M_HargaDanPromo->search_filter_chosen_sku($sku_kode_wms, $sku_kode_pabrik, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_group_id, $sku_group_nama, $perusahaan);

		echo json_encode($data);
		// echo $depo;
	}

	public function search_sku_promo_by_filter()
	{
		$sku_promo_kode = $this->input->get('sku_promo_kode');
		$depo_group_id = "";
		$depo_id = "";
		// $depo_group_id = $this->input->get('depo_group_id');
		// $depo_id = $this->input->get('depo_id');

		$data = $this->M_HargaDanPromo->search_sku_promo_by_filter($sku_promo_kode, $depo_group_id, $depo_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetSelectedSKU()
	{
		$sku_id = $this->input->post('sku_id');

		$data = $this->M_HargaDanPromo->GetSelectedSKU($sku_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetReferensiDiskonByKategori()
	{
		$kategori = $this->input->get('kategori');

		$data = $this->M_HargaDanPromo->GetReferensiDiskonByKategori($kategori);

		echo json_encode($data);
		// echo $depo;
	}


	// public function insert_sku_promo_from_temp_edit()
	// {
	// 	$sku_promo_id = $this->input->post('sku_promo_id');

	// 	$arr_detail1 = $this->M_HargaDanPromo->Get_sku_promo_detail1($sku_promo_id);

	// 	$this->db->trans_begin();

	// 	if ($arr_detail1 != 0) {

	// 		foreach ($arr_detail1 as $detail1) {

	// 			$sku_promo_detail1_id = $detail1['sku_promo_detail1_id'];
	// 			$sku_promo_detail1_use_groupsku = $detail1['sku_promo_detail1_use_groupsku'];
	// 			$sku_promo_detail1_jenis_groupsku = $detail1['sku_promo_detail1_jenis_groupsku'];
	// 			$sku_promo_detail1_use_qty_order = $detail1['sku_promo_detail1_use_qty_order'];
	// 			$sku_promo_detail1_use_value_order = $detail1['sku_promo_detail1_use_value_order'];
	// 			$sku_promo_detail1_min_order_sku = $detail1['sku_promo_detail1_min_order_sku'];
	// 			$sku_promo_detail1_use_bonus = $detail1['sku_promo_detail1_use_bonus'];
	// 			$sku_promo_detail1_use_diskon = $detail1['sku_promo_detail1_use_diskon'];

	// 			$this->M_HargaDanPromo->insert_sku_promo_detail1_temp($sku_promo_detail1_id, $sku_promo_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon);

	// 			$arr_detail2 = $this->M_HargaDanPromo->Get_sku_promo_detail2($sku_promo_detail1_id, $sku_promo_id);

	// 			foreach ($arr_detail2 as $detail2) {

	// 				$sku_promo_detail2_id = $detail2['sku_promo_detail2_id'];
	// 				$sku_id = $detail2['sku_id'];
	// 				$kategori_grup = $detail2['kategori_grup'];
	// 				$kategori_id = $detail2['kategori_id'];
	// 				$qty = $detail2['qty'];

	// 				$this->M_HargaDanPromo->insert_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $kategori_grup, $kategori_id, $qty);

	// 				$arr_detail2_diskon = $this->M_HargaDanPromo->Get_sku_promo_detail2_diskon($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

	// 				if ($arr_detail2_diskon != 0) {

	// 					foreach ($arr_detail2_diskon as $diskon) {

	// 						$sku_promo_detail2_diskon_id = $diskon['sku_promo_detail2_diskon_id'];
	// 						$sku_promo_detail2_id = $diskon['sku_promo_detail2_id'];
	// 						$sku_qty_diskon = $diskon['sku_qty_diskon'];
	// 						$tipe_diskon_id = $diskon['tipe_diskon_id'];
	// 						$value_diskon = $diskon['value_diskon'];
	// 						$referensi_diskon_id = $diskon['referensi_diskon_id'];
	// 						$is_hitung_diskon = $diskon['is_hitung_diskon'];

	// 						$this->M_HargaDanPromo->insert_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon);
	// 					}
	// 				}

	// 				$arr_detail2_bonus = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

	// 				if ($arr_detail2_bonus != 0) {

	// 					foreach ($arr_detail2_bonus as $bonus) {

	// 						$sku_promo_detail2_bonus_id = $bonus['sku_promo_detail2_bonus_id'];
	// 						$sku_min_qty = $bonus['sku_min_qty'];
	// 						$is_berkelipatan = $bonus['is_berkelipatan'];

	// 						$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan);

	// 						$arr_detail2_bonus_detail = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_detail($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

	// 						if ($arr_detail2_bonus_detail != 0) {

	// 							foreach ($arr_detail2_bonus_detail as $bonus_detail) {

	// 								$sku_promo_detail2_bonus2_id = $bonus_detail['sku_promo_detail2_bonus2_id'];
	// 								$sku_promo_detail2_bonus_id = $bonus_detail['sku_promo_detail2_bonus_id'];
	// 								$sku_id = $bonus_detail['sku_id'];
	// 								$sku_tipe_id = $bonus_detail['sku_tipe_id'];
	// 								$referensi_diskon_id = $bonus_detail['referensi_diskon_id'];
	// 								$sku_qty_bonus = $bonus_detail['sku_qty_bonus'];

	// 								$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $sku_tipe_id, $referensi_diskon_id, $sku_qty_bonus);
	// 							}
	// 						}
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}

	// 	if ($this->db->trans_status() === FALSE) {
	// 		$this->db->trans_rollback();
	// 		echo json_encode(0);
	// 	} else {
	// 		$this->db->trans_commit();
	// 		echo json_encode(1);
	// 	}
	// }

	public function insert_sku_promo_from_temp_duplicate()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_id_new = $this->input->post('sku_promo_id_new');

		// $this->M_HargaDanPromo->insert_sku_promo_from_temp($sku_promo_id, $sku_promo_id_new);

		$arr_sku_promo = $this->M_HargaDanPromo->Get_promo_by_id($sku_promo_id);
		$arr_sku_promo_lokasi = $this->M_HargaDanPromo->Get_sku_promo_lokasi_by_id($sku_promo_id);
		$arr_detail1 = $this->M_HargaDanPromo->Get_sku_promo_detail1($sku_promo_id);
		// $arr_detail2 = $this->M_HargaDanPromo->Get_sku_promo_detail2($sku_promo_id);
		// $arr_detail2_diskon = $this->M_HargaDanPromo->Get_sku_promo_detail2_diskon($sku_promo_id);
		// $arr_detail2_bonus = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus($sku_promo_id);
		// $arr_detail2_bonus_detail = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_detail($sku_promo_id);
		// $arr_detail2_sku = $this->M_HargaDanPromo->Get_sku_promo_detail2_sku($sku_promo_id);
		// return false;
		$this->db->trans_begin();

		if ($arr_sku_promo != 0) {
			$sku_promo_status = "Draft";
			$sku_promo_tgl_create = date('Y-m-d');
			$sku_promo_who_create = $this->session->userdata('pengguna_username');

			foreach ($arr_sku_promo as $header) {
				$this->M_HargaDanPromo->insert_sku_promo_temp($sku_promo_id_new, $header['depo_group_id'], $header['depo_id'], $header['client_wms_id'], $header['sku_promo_kode'], $header['sku_promo_tgl_berlaku_awal'], $header['sku_promo_tgl_berlaku_akhir'], $header['sku_promo_keterangan'], $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create);
			}

			foreach ($arr_sku_promo_lokasi as $lokasi) {
				$this->M_HargaDanPromo->insert_sku_promo_lokasi($lokasi['sku_promo_id'], $lokasi['depo_group_nama'], $lokasi['depo_id']);
			}

			if ($arr_detail1 != 0) {

				foreach ($arr_detail1 as $detail1) {
					$sku_promo_detail1_id_new = $this->M_Vrbl->Get_NewID();
					$sku_promo_detail1_id_new = $sku_promo_detail1_id_new[0]['NEW_ID'];

					$sku_promo_detail1_id = $detail1['sku_promo_detail1_id'];
					$principle_id = $detail1['principle_id'];
					$sku_promo_detail1_use_groupsku = $detail1['sku_promo_detail1_use_groupsku'];
					$sku_promo_detail1_jenis_groupsku = $detail1['sku_promo_detail1_jenis_groupsku'];
					$sku_promo_detail1_use_qty_order = $detail1['sku_promo_detail1_use_qty_order'];
					$sku_promo_detail1_use_value_order = $detail1['sku_promo_detail1_use_value_order'];
					$sku_promo_detail1_min_order_sku = $detail1['sku_promo_detail1_min_order_sku'];
					$sku_promo_detail1_use_bonus = $detail1['sku_promo_detail1_use_bonus'];
					$sku_promo_detail1_use_diskon = $detail1['sku_promo_detail1_use_diskon'];
					$sku_promo_detail1_nourut = $detail1['sku_promo_detail1_nourut'];

					$this->M_HargaDanPromo->insert_sku_promo_detail1_temp($sku_promo_detail1_id_new, $sku_promo_id_new, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut);

					$arr_detail2 = $this->M_HargaDanPromo->Get_sku_promo_detail2($sku_promo_id, $sku_promo_detail1_id);

					if ($arr_detail2 != 0) {
						foreach ($arr_detail2 as $detail2) {
							$sku_promo_detail2_id_new = $this->M_Vrbl->Get_NewID();
							$sku_promo_detail2_id_new = $sku_promo_detail2_id_new[0]['NEW_ID'];

							$sku_promo_detail2_id = $detail2['sku_promo_detail2_id'];
							$sku_id = $detail2['sku_id'];
							$kategori_grup = $detail2['kategori_grup'];
							$kategori_id = $detail2['kategori_id'];
							$qty = $detail2['qty'];

							$this->M_HargaDanPromo->insert_sku_promo_detail2_temp($sku_promo_detail2_id_new, $sku_promo_detail1_id, $sku_promo_id_new, $sku_id, $kategori_grup, $kategori_id, $qty);

							$this->M_HargaDanPromo->update_sku_promo_detail2_temp_detail1_id($sku_promo_detail1_id, $sku_promo_detail1_id_new);

							$arr_detail2_diskon = $this->M_HargaDanPromo->Get_sku_promo_detail2_diskon($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

							if ($arr_detail2_diskon != 0) {

								foreach ($arr_detail2_diskon as $diskon) {

									$sku_promo_detail2_diskon_id_new = $this->M_Vrbl->Get_NewID();
									$sku_promo_detail2_diskon_id_new = $sku_promo_detail2_diskon_id_new[0]['NEW_ID'];

									$sku_promo_detail2_id = $diskon['sku_promo_detail2_id'];
									$sku_qty_diskon = $diskon['sku_qty_diskon'];
									$tipe_diskon_id = $diskon['tipe_diskon_id'];
									$value_diskon = $diskon['value_diskon'];
									$referensi_diskon_id = $diskon['referensi_diskon_id'];
									$is_hitung_diskon = $diskon['is_hitung_diskon'];
									$sku_promo_detail2_diskon_nourut = $diskon['sku_promo_detail2_diskon_nourut'];

									$this->M_HargaDanPromo->insert_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id_new, $sku_promo_detail2_id, $sku_promo_detail1_id_new, $sku_promo_id_new, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut);

									$this->M_HargaDanPromo->update_sku_promo_detail2_diskon_temp_detail2_id($sku_promo_detail2_id, $sku_promo_detail2_id_new);
								}
							}

							$arr_detail2_bonus = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

							if ($arr_detail2_bonus != 0) {

								foreach ($arr_detail2_bonus as $bonus) {
									$sku_promo_detail2_bonus_id_new = $this->M_Vrbl->Get_NewID();
									$sku_promo_detail2_bonus_id_new = $sku_promo_detail2_bonus_id_new[0]['NEW_ID'];

									$sku_promo_detail2_bonus_id = $bonus['sku_promo_detail2_bonus_id'];
									$sku_min_qty = $bonus['sku_min_qty'];
									$sku_min_value = $bonus['sku_min_value'];
									$is_berkelipatan = $bonus['is_berkelipatan'];
									$sku_promo_detail2_bonus_nourut = $bonus['sku_promo_detail2_bonus_nourut'];

									if ($sku_min_qty == null) {
										$dasar_jumlah_order = 'value order';
										$sku_min_qty = $sku_min_value;
									} else {
										$dasar_jumlah_order = '';
									}

									$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id_new, $sku_promo_detail2_id_new, $sku_promo_detail1_id_new, $sku_promo_id_new, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasar_jumlah_order);

									$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_temp_detail2_id($sku_promo_detail2_id, $sku_promo_detail2_id_new);

									$arr_detail2_bonus_detail = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_detail($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

									if ($arr_detail2_bonus_detail != 0) {

										foreach ($arr_detail2_bonus_detail as $bonus_detail) {

											$sku_promo_detail2_bonus2_id = $this->M_Vrbl->Get_NewID();
											$sku_promo_detail2_bonus2_id = $sku_promo_detail2_bonus2_id[0]['NEW_ID'];

											$sku_promo_detail2_bonus_id = $bonus_detail['sku_promo_detail2_bonus_id'];
											$sku_id = $bonus_detail['sku_id'];
											$sku_tipe_id = $bonus_detail['sku_tipe_id'];
											$referensi_diskon_id = $bonus_detail['referensi_diskon_id'];
											$sku_qty_bonus = $bonus_detail['sku_qty_bonus'];

											$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id_new, $sku_promo_detail2_id_new, $sku_promo_detail1_id_new, $sku_promo_id_new, $sku_id, $sku_tipe_id, $referensi_diskon_id, $sku_qty_bonus);

											$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_detail_temp_bonus_id($sku_promo_detail2_bonus_id, $sku_promo_detail2_bonus_id_new);
										}
									}
								}
							}

							$arr_sku_promo_detail2_sku = $this->M_HargaDanPromo->Get_sku_promo_detail2_sku_by_filter($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);

							if ($arr_sku_promo_detail2_sku != 0) {
								foreach ($arr_sku_promo_detail2_sku as $sku) {
									$this->M_HargaDanPromo->insert_sku_promo_detail2_sku_temp($sku_promo_detail2_id_new, $sku_promo_detail1_id_new, $sku_promo_id_new, $sku['sku_id'], $sku['is_pengecualian']);
								}
							}
						}
					}
				}
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

	public function insert_sku_promo()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_id = $this->input->post('sku_promo_id');
		$depo_group_id = $this->input->post('depo_group_id');
		$depo_id = $this->input->post('depo_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$sku_promo_kode = $this->input->post('sku_promo_kode');
		$sku_promo_tgl_berlaku_awal = $this->input->post('sku_promo_tgl_berlaku_awal');
		$sku_promo_tgl_berlaku_akhir = $this->input->post('sku_promo_tgl_berlaku_akhir');
		$sku_promo_keterangan = $this->input->post('sku_promo_keterangan');
		$sku_promo_status = $this->input->post('sku_promo_status');
		$sku_promo_tgl_create = $this->input->post('sku_promo_tgl_create');
		$sku_promo_who_create = $this->input->post('sku_promo_who_create');
		$is_khusus = $this->input->post('is_khusus');
		$client_pt_segmen = $this->input->post('client_pt_segmen');
		$client_pt_id = $this->input->post('client_pt_id');

		$arr_depo_group = $this->M_HargaDanPromo->search_depo_group_by_multi_depo($depo_id);

		$approvalParam = "APPRV_KATALOGPROMO_01";

		$this->db->trans_begin();

		if ($sku_promo_status == "Approved") {

			$this->M_HargaDanPromo->insert_sku_promo($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus);
		} else {

			$this->M_HargaDanPromo->insert_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus);
		}

		foreach ($arr_depo_group as $value) {
			$this->M_HargaDanPromo->insert_sku_promo_lokasi($sku_promo_id, $value['depo_group_nama'], $value['depo_id']);
		}

		if ($client_pt_segmen != "") {

			foreach ($client_pt_segmen as $value) {

				$sku_promo_segmen_id = $this->M_Vrbl->Get_NewID();
				$sku_promo_segmen_id = $sku_promo_segmen_id[0]['NEW_ID'];

				$this->M_HargaDanPromo->insert_sku_promo_segmen($sku_promo_segmen_id, $sku_promo_id, str_replace("'", "", $value));
			}
		}

		if ($client_pt_id != "") {

			$arr_client_pt_by_segmen = $this->M_HargaDanPromo->Get_sku_promo_segmen_for_client_pt($sku_promo_id, $client_pt_id);

			if (isset($arr_client_pt_by_segmen) && count($arr_client_pt_by_segmen) > 0) {

				foreach ($arr_client_pt_by_segmen as $value) {

					$sku_promo_segmen_detail_id = $this->M_Vrbl->Get_NewID();
					$sku_promo_segmen_detail_id = $sku_promo_segmen_detail_id[0]['NEW_ID'];

					$this->M_HargaDanPromo->insert_sku_promo_segmen_detail($sku_promo_segmen_detail_id, $value['sku_promo_segmen_id'], $sku_promo_id, $value['client_pt_id']);
				}
			}
		}

		if ($sku_promo_status == "In Progress Approval") {
			foreach ($arr_depo_group as $value) {
				$this->M_HargaDanPromo->Exec_approval_pengajuan($value['depo_id'], $this->session->userdata('pengguna_id'), $approvalParam, $sku_promo_id, $sku_promo_kode, 0, 0);
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

	public function update_sku_promo()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_id = $this->input->post('sku_promo_id');
		$depo_group_id = $this->input->post('depo_group_id');
		$depo_id = $this->input->post('depo_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$sku_promo_kode = $this->input->post('sku_promo_kode');
		$sku_promo_tgl_berlaku_awal = $this->input->post('sku_promo_tgl_berlaku_awal');
		$sku_promo_tgl_berlaku_akhir = $this->input->post('sku_promo_tgl_berlaku_akhir');
		$sku_promo_keterangan = $this->input->post('sku_promo_keterangan');
		$sku_promo_status = $this->input->post('sku_promo_status');
		$sku_promo_tgl_create = $this->input->post('sku_promo_tgl_create');
		$sku_promo_who_create = $this->input->post('sku_promo_who_create');
		$is_khusus = $this->input->post('is_khusus');
		$client_pt_segmen = $this->input->post('client_pt_segmen');
		$client_pt_id = $this->input->post('client_pt_id');

		$arr_depo_group = $this->M_HargaDanPromo->search_depo_group_by_multi_depo($depo_id);

		$approvalParam = "APPRV_KATALOGPROMO_01";

		$this->db->trans_begin();

		$this->M_HargaDanPromo->update_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus);

		foreach ($arr_depo_group as $value) {
			$this->M_HargaDanPromo->insert_sku_promo_lokasi($sku_promo_id, $value['depo_group_nama'], $value['depo_id']);
		}

		if ($client_pt_segmen != "") {

			foreach ($client_pt_segmen as $value) {

				$sku_promo_segmen_id = $this->M_Vrbl->Get_NewID();
				$sku_promo_segmen_id = $sku_promo_segmen_id[0]['NEW_ID'];

				$this->M_HargaDanPromo->insert_sku_promo_segmen($sku_promo_segmen_id, $sku_promo_id, str_replace("'", "", $value));
			}
		}

		if ($client_pt_id != "") {

			$arr_client_pt_by_segmen = $this->M_HargaDanPromo->Get_sku_promo_segmen_for_client_pt($sku_promo_id, $client_pt_id);

			if (isset($arr_client_pt_by_segmen) && count($arr_client_pt_by_segmen) > 0) {

				foreach ($arr_client_pt_by_segmen as $value) {

					$sku_promo_segmen_detail_id = $this->M_Vrbl->Get_NewID();
					$sku_promo_segmen_detail_id = $sku_promo_segmen_detail_id[0]['NEW_ID'];

					$this->M_HargaDanPromo->insert_sku_promo_segmen_detail($sku_promo_segmen_detail_id, $value['sku_promo_segmen_id'], $sku_promo_id, $value['client_pt_id']);
				}
			}
		}

		if ($sku_promo_status == "In Progress Approval") {
			foreach ($arr_depo_group as $value) {
				$this->M_HargaDanPromo->Exec_approval_pengajuan($value['depo_id'], $this->session->userdata('pengguna_id'), $approvalParam, $sku_promo_id, $sku_promo_kode, 0, 0);
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

	public function duplicate_sku_promo()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_id = $this->input->post('sku_promo_id');
		$depo_group_id = $this->input->post('depo_group_id');
		$depo_id = $this->input->post('depo_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$sku_promo_kode = $this->input->post('sku_promo_kode');
		$sku_promo_tgl_berlaku_awal = $this->input->post('sku_promo_tgl_berlaku_awal');
		$sku_promo_tgl_berlaku_akhir = $this->input->post('sku_promo_tgl_berlaku_akhir');
		$sku_promo_keterangan = $this->input->post('sku_promo_keterangan');
		$sku_promo_status = $this->input->post('sku_promo_status');
		$sku_promo_tgl_create = date('Y-m-d');
		$sku_promo_who_create = $this->input->post('sku_promo_who_create');
		$is_khusus = $this->input->post('is_khusus');
		$client_pt_segmen = $this->input->post('client_pt_segmen');
		$client_pt_id = $this->input->post('client_pt_id');

		$arr_depo_group = $this->M_HargaDanPromo->search_depo_group_by_multi_depo($depo_id);

		$approvalParam = "APPRV_KATALOGPROMO_01";

		$sku_promo_id_new = $this->M_Vrbl->Get_NewID();
		$sku_promo_id_new = $sku_promo_id_new[0]['NEW_ID'];

		$this->db->trans_begin();

		$this->M_HargaDanPromo->duplicate_sku_promo_temp($sku_promo_id, $depo_group_id, $depo_id, $client_wms_id, $sku_promo_kode, $sku_promo_tgl_berlaku_awal, $sku_promo_tgl_berlaku_akhir, $sku_promo_keterangan, $sku_promo_status, $sku_promo_tgl_create, $sku_promo_who_create, $is_khusus);

		foreach ($arr_depo_group as $value) {
			$this->M_HargaDanPromo->insert_sku_promo_lokasi($sku_promo_id, $value['depo_group_nama'], $value['depo_id']);
		}

		if ($client_pt_segmen != "") {

			foreach ($client_pt_segmen as $value) {

				$sku_promo_segmen_id = $this->M_Vrbl->Get_NewID();
				$sku_promo_segmen_id = $sku_promo_segmen_id[0]['NEW_ID'];

				$this->M_HargaDanPromo->insert_sku_promo_segmen($sku_promo_segmen_id, $sku_promo_id, str_replace("'", "", $value));
			}
		}

		if ($client_pt_id != "") {

			$arr_client_pt_by_segmen = $this->M_HargaDanPromo->Get_sku_promo_segmen_for_client_pt($sku_promo_id, $client_pt_id);

			if (isset($arr_client_pt_by_segmen) && count($arr_client_pt_by_segmen) > 0) {

				foreach ($arr_client_pt_by_segmen as $value) {

					$sku_promo_segmen_detail_id = $this->M_Vrbl->Get_NewID();
					$sku_promo_segmen_detail_id = $sku_promo_segmen_detail_id[0]['NEW_ID'];

					$this->M_HargaDanPromo->insert_sku_promo_segmen_detail($sku_promo_segmen_detail_id, $value['sku_promo_segmen_id'], $sku_promo_id, $value['client_pt_id']);
				}
			}
		}

		if ($sku_promo_status == "In Progress Approval") {
			foreach ($arr_depo_group as $value) {
				$this->M_HargaDanPromo->Exec_approval_pengajuan($value['depo_id'], $this->session->userdata('pengguna_id'), $approvalParam, $sku_promo_id, $sku_promo_kode, 0, 0);
			}
		}

		$this->M_HargaDanPromo->Update_new_sku_promo_id($sku_promo_id, $sku_promo_id_new);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail1_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail1_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail1_id = $sku_promo_detail1_id[0]['NEW_ID'];

		$sku_promo_id = $this->input->post('sku_promo_id');
		$principle_id = "";
		$sku_promo_detail1_use_groupsku = "";
		$sku_promo_detail1_jenis_groupsku = "";
		$sku_promo_detail1_use_qty_order = "";
		$sku_promo_detail1_use_value_order = "";
		$sku_promo_detail1_min_order_sku = "";
		$sku_promo_detail1_use_bonus = "";
		$sku_promo_detail1_use_diskon = "";
		$sku_promo_detail1_nourut = $this->db->select("*")->from("sku_promo_detail1_temp")->where("sku_promo_id", $sku_promo_id)->get()->num_rows() + 1;

		// $sku_promo_detail1_use_groupsku = $this->input->post('sku_promo_detail1_use_groupsku');
		// $sku_promo_detail1_jenis_groupsku = $this->input->post('sku_promo_detail1_jenis_groupsku');
		// $sku_promo_detail1_use_qty_order = $this->input->post('sku_promo_detail1_use_qty_order');
		// $sku_promo_detail1_use_value_order = $this->input->post('sku_promo_detail1_use_value_order');
		// $sku_promo_detail1_min_order_sku = $this->input->post('sku_promo_detail1_min_order_sku');
		// $sku_promo_detail1_use_bonus = $this->input->post('sku_promo_detail1_use_bonus');
		// $sku_promo_detail1_use_diskon = $this->input->post('sku_promo_detail1_use_diskon');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail1_temp($sku_promo_detail1_id, $sku_promo_id, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail2_id = $sku_promo_detail2_id[0]['NEW_ID'];

		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_id = "";
		$kategori_grup = "";
		$kategori_id = "";
		$qty = "";
		// $sku_id = $this->input->post('sku_id');
		// $kategori_grup = $this->input->post('kategori_grup');
		// $kategori_id = $this->input->post('kategori_id');
		// $qty = $this->input->post('qty');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $kategori_grup, $kategori_id, $qty);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_temp_by_sku()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail2_id = $sku_promo_detail2_id[0]['NEW_ID'];

		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_id = $this->input->post('sku_id');
		$kategori_grup = "";
		$kategori_id = "";
		$qty = "";
		// $sku_id = $this->input->post('sku_id');
		// $kategori_grup = $this->input->post('kategori_grup');
		// $kategori_id = $this->input->post('kategori_id');
		// $qty = $this->input->post('qty');

		$this->db->trans_begin();

		$cek = $this->db->select("*")
			->from("sku_promo_detail2_temp")
			->where("sku_promo_id", $sku_promo_id)
			->where("sku_promo_detail1_id", $sku_promo_detail1_id)
			->where("sku_id", $sku_id)->get()->num_rows();

		if ($cek == 0) {
			$this->M_HargaDanPromo->insert_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $kategori_grup, $kategori_id, $qty);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_diskon_temp_all_kategori()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		// $sku_promo_detail2_diskon_id = $this->M_Vrbl->Get_NewID();
		// $sku_promo_detail2_diskon_id = $sku_promo_detail2_diskon_id[0]['NEW_ID'];

		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');

		$arr_sku_promo_detail2_temp = $this->M_HargaDanPromo->Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);

		// $sku_min_qty = $this->input->post('sku_min_qty');
		// $is_berkelipatan = $this->input->post('is_berkelipatan');

		$this->db->trans_begin();

		foreach ($arr_sku_promo_detail2_temp as $value) {
			$sku_promo_detail2_diskon_id = $this->M_Vrbl->Get_NewID();
			$sku_promo_detail2_diskon_id = $sku_promo_detail2_diskon_id[0]['NEW_ID'];

			$sku_promo_detail2_id = $value->sku_promo_detail2_id;
			$sku_qty_diskon = "";
			$tipe_diskon_id = "";
			$value_diskon = "";
			$referensi_diskon_id = "";
			$is_hitung_diskon = "";
			$sku_promo_detail2_diskon_nourut = $this->db->select("*")->from("sku_promo_detail2_diskon_temp")->where("sku_promo_id", $sku_promo_id)->where("sku_promo_detail1_id", $sku_promo_detail1_id)->where("sku_promo_detail2_id", $sku_promo_detail2_id)->get()->num_rows() + 1;

			$this->M_HargaDanPromo->insert_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_diskon_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_diskon_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail2_diskon_id = $sku_promo_detail2_diskon_id[0]['NEW_ID'];

		// $sku_promo_detail2_diskon_id = $this->input->post('sku_promo_detail2_diskon_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_qty_diskon = "";
		$tipe_diskon_id = "";
		$value_diskon = "";
		$referensi_diskon_id = "";
		$is_hitung_diskon = "";
		$sku_promo_detail2_diskon_nourut = $this->db->select("*")->from("sku_promo_detail2_diskon_temp")->where("sku_promo_id", $sku_promo_id)->where("sku_promo_detail1_id", $sku_promo_detail1_id)->where("sku_promo_detail2_id", $sku_promo_detail2_id)->get()->num_rows() + 1;

		// $sku_id = $this->input->post('sku_id');
		// $kategori_grup = $this->input->post('kategori_grup');
		// $kategori_id = $this->input->post('kategori_id');
		// $qty = $this->input->post('qty');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_bonus_temp_bonus_detail_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$dasar_jumlah_order = $this->input->post('dasar_jumlah_order');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$arr_data = $this->input->post('arr_data');

		$arr_sku_promo_detail2_temp = $this->M_HargaDanPromo->Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);

		$this->db->trans_begin();

		// delete sku_promo_detail2_bonus_temp dan sku_promo_detail2_bonus_detail_temp
		$this->M_HargaDanPromo->delete_sku_promo_detail2_bonus_temp_dan_bonus_detail_temp($sku_promo_id, $sku_promo_detail1_id);

		foreach ($arr_sku_promo_detail2_temp as $key => $value) {
			$sku_promo_detail2_id = $value->sku_promo_detail2_id;

			foreach ($arr_data as $key => $val) {
				$sku_promo_detail2_bonus_id = $this->M_Vrbl->Get_NewID();
				$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id[0]['NEW_ID'];

				$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $val['sku_min_qty'], $val['kelipatan'], $key + 1, $dasar_jumlah_order);

				foreach ($val['detail'] as $detail) {
					$sku_promo_detail2_bonus2_id = $this->M_Vrbl->Get_NewID();
					$sku_promo_detail2_bonus2_id = $sku_promo_detail2_bonus2_id[0]['NEW_ID'];

					$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $detail['sku_id'], '', $detail['referensi_diskon'], $detail['qty_bonus']);
				}
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

	public function insert_sku_promo_detail2_bonus_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		// $sku_promo_detail2_bonus_id = $this->M_Vrbl->Get_NewID();
		// $sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id[0]['NEW_ID'];

		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');

		$arr_sku_promo_detail2_temp = $this->M_HargaDanPromo->Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);

		// $sku_min_qty = $this->input->post('sku_min_qty');
		// $is_berkelipatan = $this->input->post('is_berkelipatan');

		$this->db->trans_begin();

		foreach ($arr_sku_promo_detail2_temp as $value) {
			$sku_promo_detail2_bonus_id = $this->M_Vrbl->Get_NewID();
			$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id[0]['NEW_ID'];

			$sku_promo_detail2_id = $value->sku_promo_detail2_id;
			$sku_min_qty = "";
			$is_berkelipatan = "";
			$sku_promo_detail2_bonus_nourut = $this->db->select("*")->from("sku_promo_detail2_bonus_temp")->where("sku_promo_id", $sku_promo_id)->where("sku_promo_detail1_id", $sku_promo_detail1_id)->get()->num_rows() + 1;

			$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_bonus_temp2()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');

		$arr_sku_promo_detail2_temp = $this->M_HargaDanPromo->Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);

		$this->db->trans_begin();

		foreach ($arr_sku_promo_detail2_temp as $value) {
			$sku_promo_detail2_bonus_id = $this->M_Vrbl->Get_NewID();
			$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id[0]['NEW_ID'];

			$sku_promo_detail2_id = $value->sku_promo_detail2_id;
			$sku_min_qty = "";
			$is_berkelipatan = "";
			$sku_promo_detail2_bonus_nourut = $this->db->select("*")->from("sku_promo_detail2_bonus_temp")->where("sku_promo_id", $sku_promo_id)->where("sku_promo_detail1_id", $sku_promo_detail1_id)->get()->num_rows() + 1;

			$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_bonus_detail_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_bonus2_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail2_bonus2_id = $sku_promo_detail2_bonus2_id[0]['NEW_ID'];

		$sku_promo_detail2_bonus_id = $this->input->post('sku_promo_detail2_bonus_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_id = $this->input->post('sku_id');
		$sku_tipe_id = "";
		$referensi_diskon_id = "";
		$sku_qty_bonus = "";

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $sku_tipe_id, $referensi_diskon_id, $sku_qty_bonus);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_bonus_temp_by_one()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_bonus_id = $this->M_Vrbl->Get_NewID();
		$sku_promo_detail2_bonus_id = $sku_promo_detail2_bonus_id[0]['NEW_ID'];

		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$dasar_jumlah_order = $this->input->post('dasar_jumlah_order');
		$sku_min_qty = "";
		$is_berkelipatan = "";
		$sku_promo_detail2_bonus_nourut = $this->db->select("*")->from("sku_promo_detail2_bonus_temp")->where("sku_promo_id", $sku_promo_id)->where("sku_promo_detail1_id", $sku_promo_detail1_id)->where("sku_promo_detail2_id", $sku_promo_detail2_id)->get()->num_rows() + 1;

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasar_jumlah_order);

		// echo $sku_promo_detail2_bonus_nourut;

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function insert_sku_promo_detail2_sku_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_id = $this->input->post('sku_id');
		$is_pengecualian = $this->input->post('is_pengecualian');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->insert_sku_promo_detail2_sku_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $is_pengecualian);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail2_bonus_header_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$arr_header = $this->input->post('arr_header');
		$dasarJumlahOrder = $this->input->post('dasarJumlahOrder');

		// echo var_dump($arr_header);
		// echo var_dump($arr_detail);

		$this->db->trans_begin();

		foreach ($arr_header as $i => $value) {
			$sku_promo_detail2_bonus_id = $value['sku_promo_detail2_bonus_id'];
			$sku_promo_detail2_id = $value['sku_promo_detail2_id'];
			$sku_promo_detail1_id = $value['sku_promo_detail1_id'];
			$sku_promo_id = $value['sku_promo_id'];
			$sku_min_qty = $value['sku_min_qty'];
			$is_berkelipatan = $value['is_berkelipatan'];
			$sku_promo_detail2_bonus_nourut = $value['sku_promo_detail2_bonus_nourut'];

			$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasarJumlahOrder);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail2_bonus_detail_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$arr_detail = $this->input->post('arr_detail');

		// echo var_dump($arr_header);
		// echo var_dump($arr_detail);

		$this->db->trans_begin();

		foreach ($arr_detail as $i => $value) {
			$sku_promo_detail2_bonus2_id = $value['sku_promo_detail2_bonus2_id'];
			$sku_promo_detail2_bonus_id = $value['sku_promo_detail2_bonus_id'];
			$sku_promo_detail2_id = $value['sku_promo_detail2_id'];
			$sku_promo_detail1_id = $value['sku_promo_detail1_id'];
			$sku_promo_id = $value['sku_promo_id'];
			$sku_id = $value['sku_id'];
			$sku_qty_bonus = $value['sku_qty_bonus'];
			$sku_tipe_id = $value['sku_tipe_id'];
			$referensi_diskon_id = $value['referensi_diskon_id'];

			$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id, $sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_id, $sku_qty_bonus, $sku_tipe_id, $referensi_diskon_id);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail2_diskon_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$arr_detail = $this->input->post('arr_detail');

		// echo var_dump($arr_header);
		// echo var_dump($arr_detail);

		$this->db->trans_begin();

		foreach ($arr_detail as $i => $value) {
			$sku_promo_detail2_diskon_id = $value['sku_promo_detail2_diskon_id'];
			$sku_promo_detail2_id = $value['sku_promo_detail2_id'];
			$sku_promo_detail1_id = $value['sku_promo_detail1_id'];
			$sku_qty_diskon = $value['sku_qty_diskon'];
			$tipe_diskon_id = $value['tipe_diskon_id'];
			$value_diskon = $value['value_diskon'];
			$referensi_diskon_id = $value['referensi_diskon_id'];
			$is_hitung_diskon = $value['is_hitung_diskon'];
			$sku_promo_detail2_diskon_nourut = $value['sku_promo_detail2_diskon_nourut'];

			$this->M_HargaDanPromo->update_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_qty_diskon, $tipe_diskon_id, $value_diskon, $referensi_diskon_id, $is_hitung_diskon, $sku_promo_detail2_diskon_nourut);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail2_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$kategori_id = $this->input->post('kategori_id');
		$qty = $this->input->post('qty');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->update_sku_promo_detail2_temp($sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $kategori_id, $qty);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail1_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$principle_id = $this->input->post('principle_id');
		$sku_promo_detail1_use_groupsku = $this->input->post('sku_promo_detail1_use_groupsku');
		$sku_promo_detail1_jenis_groupsku = $this->input->post('sku_promo_detail1_jenis_groupsku');
		$sku_promo_detail1_use_qty_order = $this->input->post('sku_promo_detail1_use_qty_order');
		$sku_promo_detail1_use_value_order = $this->input->post('sku_promo_detail1_use_value_order');
		$sku_promo_detail1_min_order_sku = $this->input->post('sku_promo_detail1_min_order_sku');
		$sku_promo_detail1_use_bonus = $this->input->post('sku_promo_detail1_use_bonus');
		$sku_promo_detail1_use_diskon = $this->input->post('sku_promo_detail1_use_diskon');
		$sku_promo_detail1_nourut = $this->input->post('sku_promo_detail1_nourut');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->update_sku_promo_detail_temp($sku_promo_detail1_id, $sku_promo_id, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function update_sku_promo_detail2_bonus_temp()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sku_promo_detail2_bonus_id = $this->input->post('sku_promo_detail2_bonus_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_min_qty = $this->input->post('sku_min_qty');
		$is_berkelipatan = $this->input->post('is_berkelipatan');
		$sku_promo_detail2_bonus_nourut = $this->input->post('sku_promo_detail2_bonus_nourut');
		$dasarJumlahOrder = $this->input->post('dasarJumlahOrder');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasarJumlahOrder);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function Get_sku_promo_detail1_temp()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$perusahaan = $this->input->get('perusahaan');
		$data = $this->M_HargaDanPromo->Get_sku_promo_detail1_temp($sku_promo_id);
		$principle = $this->M_HargaDanPromo->getPrincipleByPerusahaan($perusahaan);

		$response = [
			"data" => $data,
			"principle" => $principle
		];

		echo json_encode($response);
	}

	public function Get_sku_promo_detail1()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$data = $this->M_HargaDanPromo->Get_sku_promo_detail1($sku_promo_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_temp()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail22()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$data = $this->M_HargaDanPromo->Get_sku_promo_detail22($sku_promo_id, $sku_promo_detail1_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_bonus_temp_by_one()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_temp_by_one($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_bonus_by_one()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_by_one($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_bonus_temp()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_temp($sku_promo_id, $sku_promo_detail1_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_diskon_temp_all_kategori()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_diskon_temp_all_kategori($sku_promo_id, $sku_promo_detail1_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_diskon_temp()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_diskon_temp($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_bonus_detail_temp()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');
		$sku_promo_detail2_bonus_id = $this->input->get('sku_promo_detail2_bonus_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_detail_temp($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id, $sku_promo_detail2_bonus_id);

		echo json_encode($data);
	}

	public function Get_sku_promo_detail2_bonus_detail2()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');
		$sku_promo_detail1_id = $this->input->get('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');
		$sku_promo_detail2_bonus_id = $this->input->get('sku_promo_detail2_bonus_id');

		$data = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_detail2($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id, $sku_promo_detail2_bonus_id);

		echo json_encode($data);
	}

	public function GetKategoriByGroup()
	{
		$sku_promo_detail2_id = $this->input->get('sku_promo_detail2_id');
		$group = $this->input->get('group');
		$principle_id = $this->input->get('principle_id');

		$this->M_HargaDanPromo->Update_kategori_sku_promo_detail_by_id($sku_promo_detail2_id, $group);

		// $data = $this->M_HargaDanPromo->GetKategoriByGroup($group);
		$data = $this->M_HargaDanPromo->GetKategoriByPrincipleKategori($principle_id, $group);

		echo json_encode($data);
	}

	public function delete_sku_promo_detail_temp()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail_temp($sku_promo_id, $sku_promo_detail1_id);
		$arr_sku_promo_detail1_temp = $this->M_HargaDanPromo->Get_sku_promo_detail1_temp($sku_promo_id);

		$this->db->trans_begin();

		if ($arr_sku_promo_detail1_temp != "0") {

			foreach ($arr_sku_promo_detail1_temp as $key => $value) {
				$sku_promo_detail1_id = $value->sku_promo_detail1_id;
				$sku_promo_id = $value->sku_promo_id;
				$principle_id = $value->principle_id;
				$sku_promo_detail1_use_groupsku = $value->sku_promo_detail1_use_groupsku;
				$sku_promo_detail1_jenis_groupsku = $value->sku_promo_detail1_jenis_groupsku;
				$sku_promo_detail1_use_qty_order = $value->sku_promo_detail1_use_qty_order;
				$sku_promo_detail1_use_value_order = $value->sku_promo_detail1_use_value_order;
				$sku_promo_detail1_min_order_sku = $value->sku_promo_detail1_min_order_sku;
				$sku_promo_detail1_use_bonus = $value->sku_promo_detail1_use_bonus;
				$sku_promo_detail1_use_diskon = $value->sku_promo_detail1_use_diskon;
				$sku_promo_detail1_nourut = $key + 1;

				$this->M_HargaDanPromo->update_sku_promo_detail_temp($sku_promo_detail1_id, $sku_promo_id, $principle_id, $sku_promo_detail1_use_groupsku, $sku_promo_detail1_jenis_groupsku, $sku_promo_detail1_use_qty_order, $sku_promo_detail1_use_value_order, $sku_promo_detail1_min_order_sku, $sku_promo_detail1_use_bonus, $sku_promo_detail1_use_diskon, $sku_promo_detail1_nourut);
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

	public function delete_sku_promo_detail2_temp()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		// $this->M_HargaDanPromo->delete_sku_promo_detail_temp($sku_promo_id, $sku_promo_detail1_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_detail2_temp_by_id()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');

		$this->db->trans_begin();

		$this->M_HargaDanPromo->delete_sku_promo_detail2_temp_by_id($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id);
		// $this->M_HargaDanPromo->delete_sku_promo_detail_temp($sku_promo_id, $sku_promo_detail1_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_detail2_bonus_temp()
	{
		$sku_promo_detail2_bonus_id = $this->input->post('sku_promo_detail2_bonus_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');
		$sku_promo_id = $this->input->post('sku_promo_id');
		$dasarJumlahOrder = $this->input->post('dasarJumlahOrder');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id);
		$arr_sku_promo_detail1_temp = $this->M_HargaDanPromo->Get_sku_promo_detail2_bonus_temp_by_one($sku_promo_id, $sku_promo_detail1_id, $sku_promo_detail2_id);

		if ($arr_sku_promo_detail1_temp != "") {

			foreach ($arr_sku_promo_detail1_temp as $key => $value) {
				$sku_promo_detail2_bonus_id = $value->sku_promo_detail2_bonus_id;
				$sku_promo_detail2_id = $value->sku_promo_detail2_id;
				$sku_promo_detail1_id = $value->sku_promo_detail1_id;
				$sku_promo_id = $value->sku_promo_id;
				$sku_min_qty = $value->sku_min_qty;
				$is_berkelipatan = $value->is_berkelipatan;
				$sku_promo_detail2_bonus_nourut = $key + 1;

				$this->M_HargaDanPromo->update_sku_promo_detail2_bonus_temp($sku_promo_detail2_bonus_id, $sku_promo_detail2_id, $sku_promo_detail1_id, $sku_promo_id, $sku_min_qty, $is_berkelipatan, $sku_promo_detail2_bonus_nourut, $dasarJumlahOrder);
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

	public function delete_sku_promo_detail2_bonus_detail_temp()
	{
		$sku_promo_detail2_bonus2_id = $this->input->post('sku_promo_detail2_bonus2_id');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail2_bonus_detail_temp($sku_promo_detail2_bonus2_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_detail2_diskon_temp()
	{
		$sku_promo_detail2_diskon_id = $this->input->post('sku_promo_detail2_diskon_id');
		$sku_promo_detail2_id = $this->input->post('sku_promo_detail2_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail2_diskon_temp($sku_promo_detail2_diskon_id, $sku_promo_detail2_id, $sku_promo_detail1_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_detail2_diskon_temp_by_detail1()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail2_diskon_temp_by_detail1($sku_promo_id, $sku_promo_detail1_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_detail2_bonus_temp_by_detail1()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');
		$sku_promo_detail1_id = $this->input->post('sku_promo_detail1_id');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_detail2_bonus_temp_by_detail1($sku_promo_id, $sku_promo_detail1_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_all_sku_promo_temp()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_all_sku_promo_temp($sku_promo_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_all_sku_promo_temp_tanpa_id()
	{
		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_all_sku_promo_temp_tanpa_id();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_lokasi()
	{
		$sku_promo_kode = $this->input->post('sku_promo_kode');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_lokasi($sku_promo_kode);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_segmen()
	{
		$sku_promo_id = $this->input->post('sku_promo_kode');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_segmen($sku_promo_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function delete_sku_promo_segmen_detail()
	{
		$sku_promo_id = $this->input->post('sku_promo_kode');

		$this->db->trans_begin();

		// $this->M_HargaDanPromo->delete_sku_promo_detail2_temp($sku_promo_id, $sku_promo_detail1_id);
		$this->M_HargaDanPromo->delete_sku_promo_segmen_detail($sku_promo_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function cek_sku_promo_detail2_bonus()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');

		$data = $this->M_HargaDanPromo->cek_sku_promo_detail2_bonus($sku_promo_id);

		echo json_encode($data);
	}

	public function cek_sku_promo_detail2_diskon()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');

		$data = $this->M_HargaDanPromo->cek_sku_promo_detail2_diskon($sku_promo_id);

		echo json_encode($data);
	}

	public function search_depo_by_multi_group()
	{
		$depo_group_nama = $this->input->post('depo_group_nama');

		$data = $this->M_HargaDanPromo->search_depo_by_multi_group($depo_group_nama);

		echo json_encode($data);
	}

	public function cek_qty_bonus()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');

		$data = $this->M_HargaDanPromo->cek_qty_bonus($sku_promo_id);

		echo json_encode($data);
	}

	public function GetPromoDepo()
	{
		$sku_promo_id = $this->input->get('sku_promo_id');

		$data = $this->M_HargaDanPromo->GetPromoDepo($sku_promo_id);

		echo json_encode($data);
	}

	public function Get_brand_by_principle()
	{
		$principle_id = $this->input->get('principle_id');
		$data = $this->M_HargaDanPromo->Get_brand_by_principle($principle_id);

		echo json_encode($data);
	}

	public function GetReferensiDiskon()
	{
		$data = $this->M_HargaDanPromo->GetReferensiDiskon();

		echo json_encode($data);
	}

	public function GetKategoriByPrincipleKategori()
	{
		$principle_id = $this->input->get('principle_id');
		$kategori_grup = $this->input->get('kategori_grup');

		$data = $this->M_HargaDanPromo->GetKategoriByPrincipleKategori($principle_id, $kategori_grup);

		echo json_encode($data);
	}

	public function GetPelangganBySegmen()
	{
		$segmen = $this->input->post('segmen');

		$data = $this->M_HargaDanPromo->GetPelangganBySegmen($segmen);

		echo json_encode($data);
	}

	public function proses_duplicate_sku_promo()
	{
		$sku_promo_id = $this->input->post('sku_promo_id');

		$data = $this->M_HargaDanPromo->proses_duplicate_sku_promo($sku_promo_id);

		echo json_encode($data);
	}
}
