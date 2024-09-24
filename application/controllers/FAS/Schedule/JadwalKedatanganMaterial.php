<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class JadwalKedatanganMaterial extends ParentController
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
		$this->load->model('FAS/Schedule/M_JadwalKedatanganMaterial', 'M_JadwalKedatanganMaterial');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');

		$this->MenuKode = "217402000";
	}

	public function JadwalKedatanganMaterialMenu()
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
		$data['Perusahaan'] = $this->M_JadwalKedatanganMaterial->GetPerusahaan();
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
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/script', $data);
	}

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

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

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
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['Perusahaan'] = $this->M_JadwalKedatanganMaterial->GetPerusahaan();
		$data['Principle'] = $this->M_JadwalKedatanganMaterial->GetPrinciple();
		$data['Bulan'] = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

		$data['act'] = "add";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/form', $data);
		$this->load->view('layouts/sidebar_footer', $data);
		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/s_form', $data);
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

		$data['Header'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_header_by_id($id);
		$data['Detail'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_detail_by_id($id);
		$data['Detail2'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_detail2_by_id($id);
		$data['Detail3'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_detail3_by_id($id);
		$data['Perusahaan'] = $this->M_JadwalKedatanganMaterial->GetPerusahaan();
		$data['Principle'] = $this->M_JadwalKedatanganMaterial->GetPrinciple();
		$data['Bulan'] = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/edit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/s_form', $data);
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

		$data['Perusahaan'] = $this->M_JadwalKedatanganMaterial->GetPerusahaan();

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

		$data['Header'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_header_by_id($id);
		$data['Detail'] = $this->M_JadwalKedatanganMaterial->Get_production_schedule_detail_by_id($id);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/detail', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Schedule/JadwalKedatanganMaterial/script', $data);
	}

	public function Get_list_data_sku()
	{
		$filter_sku = array();
		$principle_id = $this->input->post('principle_id');
		$detail = $this->input->post('detail');

		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $value) {
				array_push($filter_sku, "'" . $value['sku_id'] . "'");
			}
		}

		$data = $this->M_JadwalKedatanganMaterial->Get_list_data_sku($principle_id, $filter_sku);
		echo json_encode($data);
	}

	public function Get_list_data_sku_back_order()
	{
		$filter_sku = array();
		$tahun = $this->input->post('tahun');
		$principle_id = $this->input->post('principle_id');
		$detail = $this->input->post('detail');

		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $value) {
				array_push($filter_sku, "'" . $value['sku_id'] . "'");
			}
		}

		$data = $this->M_JadwalKedatanganMaterial->Get_list_data_sku_back_order($tahun, $principle_id, $filter_sku);
		echo json_encode($data);
	}

	public function proses_view_jadwal_kedatangan()
	{
		$production_schedule_id = $this->input->get('production_schedule_id');

		$data = $this->M_JadwalKedatanganMaterial->proses_view_jadwal_kedatangan($production_schedule_id);
		echo json_encode($data);
	}

	public function GetPrincipleByPerusahaan()
	{
		$perusahaan = $this->input->get('perusahaan');

		$data = $this->M_JadwalKedatanganMaterial->GetPrincipleByPerusahaan($perusahaan);
		echo json_encode($data);
	}


	public function set_sku_stock_exp_date_default()
	{
		$detail = $this->input->post('detail');

		$data = $this->M_JadwalKedatanganMaterial->set_sku_stock_exp_date_default($detail);
		echo json_encode($data);
	}

	public function set_list_production_schedule_detail()
	{
		$detail = $this->input->post('detail');
		$detail2 = $this->input->post('detail2');

		$data = $this->M_JadwalKedatanganMaterial->set_list_production_schedule_detail($detail, $detail2);
		echo json_encode($data);
	}

	public function set_list_production_schedule_detail2()
	{
		$data = array();

		$sku_id = $this->input->post('sku_id');
		$detail = $this->input->post('detail');

		if (isset($detail) && count($detail) > 0) {
			$data = $this->M_JadwalKedatanganMaterial->set_list_production_schedule_detail2($sku_id, $detail);
		} else {
			$data = array();
		}

		echo json_encode($data);
	}

	public function Get_production_schedule_by_filter()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		// $tgl = explode(" - ", $this->input->get('tanggal'));

		// $tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		// $tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));

		$tahun = $this->input->get('tahun');
		$perusahaan = $this->input->get('perusahaan');
		$status = $this->input->get('status');

		$data = $this->M_JadwalKedatanganMaterial->Get_production_schedule_by_filter($tahun, $perusahaan, $status);

		echo json_encode($data);
	}

	public function insert_production_schedule()
	{
		$production_schedule_id = $this->M_Vrbl->Get_NewID();
		$production_schedule_id = $production_schedule_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  "KODE_MPS";
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_JadwalKedatanganMaterial->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$production_schedule_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		// $production_schedule_id = $this->input->post('production_schedule_id');
		// $depo_id = $this->input->post('depo_id');
		$principle_id = $this->input->post('principle_id');
		$client_wms_id = $this->input->post('client_wms_id');
		// $production_schedule_kode = $this->input->post('production_schedule_kode');
		$production_schedule_tgl = $this->input->post('production_schedule_tgl');
		$production_schedule_tahun = $this->input->post('production_schedule_tahun');
		$production_schedule_status = $this->input->post('production_schedule_status');
		$production_schedule_keterangan = $this->input->post('production_schedule_keterangan');
		$production_schedule_who_create = $this->input->post('production_schedule_who_create');
		$production_schedule_tgl_create = $this->input->post('production_schedule_tgl_create');
		$production_schedule_tgl_update = $this->input->post('production_schedule_tgl_update');
		$production_schedule_who_update = $this->input->post('production_schedule_who_update');
		$detail = $this->input->post('detail');
		$detail2 = $this->input->post('detail2');

		$detail2_error = array();

		$cek_production_schedule = $this->M_JadwalKedatanganMaterial->cek_production_schedule($production_schedule_tahun, $client_wms_id, $principle_id);
		$cek_detail2 = $this->M_JadwalKedatanganMaterial->cek_list_production_schedule_detail2($detail, $detail2);

		if ($cek_production_schedule > 0) {
			echo json_encode(array("kode" => 3, "data" => array()));
			die;
		}

		if (count($cek_detail2) > 0) {
			foreach ($cek_detail2 as $key => $value) {
				if ($value['is_cek'] == "0" || $value['is_qty_cek'] == "0") {
					array_push($detail2_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
				}
			}
		}

		if (count($detail2_error) > 0) {
			echo json_encode(array("kode" => 0, "data" => $detail2_error));
			die;
		}

		$this->db->trans_begin();

		$this->M_JadwalKedatanganMaterial->insert_production_schedule($production_schedule_id, $depo_id, $principle_id, $client_wms_id, $production_schedule_kode, $production_schedule_tgl, $production_schedule_tahun, $production_schedule_status, $production_schedule_keterangan, $production_schedule_who_create, $production_schedule_tgl_create, $production_schedule_tgl_update, $production_schedule_who_update);

		foreach ($detail as $value) {
			$production_schedule_detail2_id = $this->M_Vrbl->Get_NewID();
			$production_schedule_detail2_id = $production_schedule_detail2_id[0]['NEW_ID'];

			$sku_id = $value['sku_id'];
			$sku_jumlah_barang = $value['sku_jumlah_barang'];
			$sku_harga = $value['sku_harga'];
			$sku_diskon_percent = $value['sku_diskon_percent'];
			$sku_diskon_rp = $value['sku_diskon_rp'];
			$sku_harga_total = $value['sku_harga_total'];
			$sku_exp_date = $value['sku_exp_date'];

			$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail2($production_schedule_detail2_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date);

			$arr_production_schedule_detail2 = $this->M_JadwalKedatanganMaterial->set_list_production_schedule_detail2($sku_id, $detail2);

			foreach ($arr_production_schedule_detail2 as $key2 => $value2) {
				$production_schedule_detail3_id = $this->M_Vrbl->Get_NewID();
				$production_schedule_detail3_id = $production_schedule_detail3_id[0]['NEW_ID'];

				$bulan = $value2['bulan'];
				$tahun = $value2['tahun'];
				$qty = $value2['qty'];

				$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail3($production_schedule_detail3_id, $production_schedule_detail2_id, $production_schedule_id, $sku_id, $bulan, $tahun, $qty);
			}
		}

		$arr_sku_konversi = $this->db->query("Exec proses_konversi_sku '$production_schedule_id'");

		if ($arr_sku_konversi->num_rows() > 0) {

			foreach ($arr_sku_konversi->result_array() as $value) {
				$production_schedule_detail_id = $this->M_Vrbl->Get_NewID();
				$production_schedule_detail_id = $production_schedule_detail_id[0]['NEW_ID'];

				$sku_id = $value['sku_id'];
				$sku_jumlah_barang = $value['hasil'];
				$sku_harga = 0;
				$sku_diskon_percent = 0;
				$sku_diskon_rp = 0;
				$sku_harga_total = 0;
				$sku_exp_date = $value['sku_expired_date'];

				$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail($production_schedule_detail_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(array("kode" => 0, "data" => array()));
		} else {
			$this->db->trans_commit();
			echo json_encode(array("kode" => 1, "data" => array()));
		}
	}

	public function update_production_schedule()
	{

		$production_schedule_id = $this->input->post('production_schedule_id');
		$depo_id = $this->session->userdata('depo_id');
		$principle_id = $this->input->post('principle_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$production_schedule_kode = $this->input->post('production_schedule_kode');
		$production_schedule_tgl = $this->input->post('production_schedule_tgl');
		$production_schedule_tahun = $this->input->post('production_schedule_tahun');
		$production_schedule_status = $this->input->post('production_schedule_status');
		$production_schedule_keterangan = $this->input->post('production_schedule_keterangan');
		$production_schedule_who_create = $this->input->post('production_schedule_who_create');
		$production_schedule_tgl_create = $this->input->post('production_schedule_tgl_create');
		$production_schedule_tgl_update = $this->input->post('production_schedule_tgl_update');
		$production_schedule_who_update = $this->input->post('production_schedule_who_update');

		$detail = $this->input->post('detail');
		$detail2 = $this->input->post('detail2');

		$detail2_error = array();

		$cek_detail2 = $this->M_JadwalKedatanganMaterial->cek_list_production_schedule_detail2($detail, $detail2);

		if (count($cek_detail2) > 0) {
			foreach ($cek_detail2 as $key => $value) {
				if ($value['is_cek'] == "0" || $value['is_qty_cek'] == "0") {
					array_push($detail2_error, array("sku_id" => $value['sku_id'], "sku_kode" => $value['sku_kode'], "sku_nama_produk" => $value['sku_nama_produk']));
				}
			}
		}

		if (count($detail2_error) > 0) {
			echo json_encode(array("kode" => 0, "data" => $detail2_error));
			die;
		}

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "production_schedule",
			'whereField' => "production_schedule_id",
			'whereValue' => $production_schedule_id,
			'fieldDateUpdate' => "production_schedule_tgl_update",
			'fieldWhoUpdate' => "production_schedule_who_update",
			'lastUpdated' => $production_schedule_tgl_update
		]);

		if ($lastUpdatedChecked['status'] == 400) {
			echo json_encode(array("kode" => 2, "data" => array()));
			return false;
		}

		$this->db->trans_begin();

		$this->M_JadwalKedatanganMaterial->update_production_schedule($production_schedule_id, $depo_id, $principle_id, $client_wms_id, $production_schedule_kode, $production_schedule_tgl, $production_schedule_tahun, $production_schedule_status, $production_schedule_keterangan, $production_schedule_who_create, $production_schedule_tgl_create, $production_schedule_tgl_update, $production_schedule_who_update);

		$this->M_JadwalKedatanganMaterial->delete_production_schedule_detail($production_schedule_id);
		$this->M_JadwalKedatanganMaterial->delete_production_schedule_detail2($production_schedule_id);
		$this->M_JadwalKedatanganMaterial->delete_production_schedule_detail3($production_schedule_id);

		foreach ($detail as $value) {
			$production_schedule_detail2_id = $this->M_Vrbl->Get_NewID();
			$production_schedule_detail2_id = $production_schedule_detail2_id[0]['NEW_ID'];

			$sku_id = $value['sku_id'];
			$sku_jumlah_barang = $value['sku_jumlah_barang'];
			$sku_harga = $value['sku_harga'];
			$sku_diskon_percent = $value['sku_diskon_percent'];
			$sku_diskon_rp = $value['sku_diskon_rp'];
			$sku_harga_total = $value['sku_harga_total'];
			$sku_exp_date = $value['sku_exp_date'];

			$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail2($production_schedule_detail2_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date);

			$arr_production_schedule_detail2 = $this->M_JadwalKedatanganMaterial->set_list_production_schedule_detail2($sku_id, $detail2);

			foreach ($arr_production_schedule_detail2 as $key2 => $value2) {
				$production_schedule_detail3_id = $this->M_Vrbl->Get_NewID();
				$production_schedule_detail3_id = $production_schedule_detail3_id[0]['NEW_ID'];

				$bulan = $value2['bulan'];
				$tahun = $value2['tahun'];
				$qty = $value2['qty'];

				$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail3($production_schedule_detail3_id, $production_schedule_detail2_id, $production_schedule_id, $sku_id, $bulan, $tahun, $qty);
			}
		}

		$arr_sku_konversi = $this->db->query("Exec proses_konversi_sku '$production_schedule_id'");

		if ($arr_sku_konversi->num_rows() > 0) {

			foreach ($arr_sku_konversi->result_array() as $value) {
				$production_schedule_detail_id = $this->M_Vrbl->Get_NewID();
				$production_schedule_detail_id = $production_schedule_detail_id[0]['NEW_ID'];

				$sku_id = $value['sku_id'];
				$sku_jumlah_barang = $value['hasil'];
				$sku_harga = 0;
				$sku_diskon_percent = 0;
				$sku_diskon_rp = 0;
				$sku_harga_total = 0;
				$sku_exp_date = $value['sku_expired_date'];

				$this->M_JadwalKedatanganMaterial->insert_production_schedule_detail($production_schedule_detail_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(array("kode" => 0, "data" => array()));
		} else {
			$this->db->trans_commit();
			echo json_encode(array("kode" => 1, "data" => array()));
		}
	}
}
