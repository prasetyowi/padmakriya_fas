<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class UrutanHargaDanPromo extends CI_Controller
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

		$this->MenuKode = "223004000";

		$this->load->model('FAS/M_UrutanHargaDanPromo', 'M_UrutanHargaDanPromo');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_Menu');
		$this->load->model('M_Function');
		$this->load->model('M_MenuAccess');
	}

	// public function UrutanHargaDanPromoMenu()
	// {
	// 	$data = array();
	// 	$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
	// 	if ($data['Menu_Access']['R'] != 1) {
	// 		redirect(base_url('MainPage/Index'));
	// 		exit();
	// 	}

	// 	$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

	// 	$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

	// 	$data['css_files'] = array(
	// 		base_url('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'),
	// 		base_url('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'),

	// 		base_url('/vendors/pnotify/dist/pnotify.css'),
	// 		base_url('/vendors/pnotify/dist/pnotify.buttons.css'),
	// 		base_url('/vendors/pnotify/dist/pnotify.nonblock.css')
	// 	);

	// 	$data['js_files'] 	= array(
	// 		base_url('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'),
	// 		base_url('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'),

	// 		base_url('/vendors/pnotify/dist/pnotify.js'),
	// 		base_url('/vendors/pnotify/dist/pnotify.buttons.js'),
	// 		base_url('/vendors/pnotify/dist/pnotify.nonblock.js')
	// 	);

	// 	$data['Title'] = Get_Title_Name();
	// 	$data['Copyright'] = Get_Copyright_Name();

	// 	// $data['Depo'] = $this->M_UrutanHargaDanPromo->GetDepo();
	// 	// $data['DepoGroup'] = $this->M_UrutanHargaDanPromo->GetDepoGroup();
	// 	// $data['Kategori'] = $this->M_UrutanHargaDanPromo->GetKategori();
	// 	// $data['KategoriGroup'] = $this->M_UrutanHargaDanPromo->GetKategoriGroup();
	// 	// $data['Principle'] = $this->M_UrutanHargaDanPromo->GetPrinciple();
	// 	// $data['Brand'] = $this->M_UrutanHargaDanPromo->GetBrand();
	// 	// $data['Promo'] = $this->M_UrutanHargaDanPromo->GetAllSKUPromo();

	// 	// Kebutuhan Authority Menu 
	// 	$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

	// 	$this->load->view('layouts/sidebar_header', $data);
	// 	$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/index', $data);
	// 	$this->load->view('layouts/sidebar_footer', $data);

	// 	$this->load->view('master/S_GlobalVariable', $data);
	// 	$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/s_index', $data);
	// }

	public function UrutanHargaDanPromoMenu()
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
			base_url('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'),
			base_url('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'),

			base_url('/vendors/pnotify/dist/pnotify.css'),
			base_url('/vendors/pnotify/dist/pnotify.buttons.css'),
			base_url('/vendors/pnotify/dist/pnotify.nonblock.css')
		);

		$data['js_files'] 	= array(
			base_url('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'),
			base_url('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'),

			base_url('/vendors/pnotify/dist/pnotify.js'),
			base_url('/vendors/pnotify/dist/pnotify.buttons.js'),
			base_url('/vendors/pnotify/dist/pnotify.nonblock.js')
		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['Depo'] = $this->M_UrutanHargaDanPromo->GetDepo();
		$data['KatalogHeader'] = $this->M_UrutanHargaDanPromo->GetKonfigurasiKatalog();
		$data['UrutanDepo'] = $this->M_UrutanHargaDanPromo->GetUrutanByDepo();
		$data['UrutanHargaPromo'] = $this->M_UrutanHargaDanPromo->GetUrutanHargaPromoByDepo();
		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/form', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/s_form', $data);
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
			base_url('/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css'),
			base_url('/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css'),

			base_url('/vendors/pnotify/dist/pnotify.css'),
			base_url('/vendors/pnotify/dist/pnotify.buttons.css'),
			base_url('/vendors/pnotify/dist/pnotify.nonblock.css')
		);

		$data['js_files'] 	= array(
			base_url('/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js'),
			base_url('/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js'),

			base_url('/vendors/pnotify/dist/pnotify.js'),
			base_url('/vendors/pnotify/dist/pnotify.buttons.js'),
			base_url('/vendors/pnotify/dist/pnotify.nonblock.js')
		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$sku_katalog_setting_id = $this->input->get('id');

		$data['KonfigurasiHeader'] = $this->M_UrutanHargaDanPromo->GetKonfigurasiHeader($sku_katalog_setting_id);
		$data['KonfigurasiDetail'] = $this->M_UrutanHargaDanPromo->GetKonfigurasiDetail($sku_katalog_setting_id);
		$data['Depo'] = $this->M_UrutanHargaDanPromo->GetDepo();
		$data['KategoriGroup'] = $this->M_UrutanHargaDanPromo->GetKategoriGroup();
		$data['act'] = "detail";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/detail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/KonfigurasiDanUrutan/UrutanHargaDanPromo/s_detail', $data);
	}

	public function GetKategoriByTipeKategori()
	{
		$tipe_kategori = $this->input->get('tipe_kategori');

		$data = $this->M_UrutanHargaDanPromo->GetKategoriByTipeKategori($tipe_kategori);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetAllSKUHarga()
	{
		$data = $this->M_UrutanHargaDanPromo->GetAllSKUHarga();

		echo json_encode($data);
		// echo $depo;
	}

	public function GetAllSKUPromo()
	{
		$data = $this->M_UrutanHargaDanPromo->GetAllSKUPromo();

		echo json_encode($data);
		// echo $depo;
	}

	public function GetKeteranganKatalogSetting()
	{
		$sku_katalog_setting_id = $this->input->get('sku_katalog_setting_id');
		$data = $this->M_UrutanHargaDanPromo->GetKeteranganKatalogSetting($sku_katalog_setting_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function GetUrutanHargaDanPromoMenuByFilter()
	{

		$sku_katalog_setting_id = $this->input->get('sku_katalog_setting_id');
		$data = $this->M_UrutanHargaDanPromo->GetUrutanHargaDanPromoMenuByFilter($sku_katalog_setting_id);

		echo json_encode($data);
		// echo $depo;
	}

	public function insert_sku_urutan_harga_promo()
	{
		$validasi = array();

		$detail = $this->input->post('detail');

		foreach ($detail as $key => $value) {

			$cek_sku_urutan_harga_promo = $this->M_UrutanHargaDanPromo->cek_sku_urutan_harga_promo($value['katalog']);

			if ($cek_sku_urutan_harga_promo == 0) {

				$this->db->trans_begin();

				$sku_urutan_harga_promo_id = $this->M_Vrbl->Get_NewID();
				$sku_urutan_harga_promo_id = $sku_urutan_harga_promo_id[0]['NEW_ID'];

				$this->M_UrutanHargaDanPromo->insert_sku_urutan_harga_promo($sku_urutan_harga_promo_id, $key, $value);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					array_push($validasi, 0);
					// echo json_encode(0);
				} else {
					$this->db->trans_commit();
					array_push($validasi, 1);
					// echo json_encode(1);
				}
			} else {
				array_push($validasi, 2);
				// echo json_encode(2);
			}
		}

		$validasi_uniq = array_unique($validasi);
		rsort($validasi_uniq);
		echo json_encode($validasi_uniq);
	}

	public function update_sku_urutan_harga_promo()
	{
		$validasi = array();

		$detail = $this->input->post('detail');

		$this->M_UrutanHargaDanPromo->delete_sku_urutan_harga_promo();

		foreach ($detail as $key => $value) {

			$cek_sku_urutan_harga_promo = $this->M_UrutanHargaDanPromo->cek_sku_urutan_harga_promo($value['katalog']);

			if ($cek_sku_urutan_harga_promo == 0) {

				$this->db->trans_begin();

				$sku_urutan_harga_promo_id = $this->M_Vrbl->Get_NewID();
				$sku_urutan_harga_promo_id = $sku_urutan_harga_promo_id[0]['NEW_ID'];

				$this->M_UrutanHargaDanPromo->insert_sku_urutan_harga_promo($sku_urutan_harga_promo_id, $key, $value);

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					array_push($validasi, 0);
					// echo json_encode(0);
				} else {
					$this->db->trans_commit();
					array_push($validasi, 1);
					// echo json_encode(1);
				}
			} else {
				array_push($validasi, 2);
				// echo json_encode(2);
			}
		}

		$validasi_uniq = array_unique($validasi);
		rsort($validasi_uniq);
		echo json_encode($validasi_uniq);
	}
}
