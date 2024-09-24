<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MappingPelangganEksternal extends CI_Controller
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

		$this->MenuKode = "222006000";
		$this->load->model(['M_Menu', 'FAS/M_MappingPelangganEksternal', 'M_Function', 'M_MenuAccess']);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function MappingPelangganEksternalMenu()
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
			Get_Assets_Url() . 'node_modules/html5-qrcode/html5-qrcode.min.js'
			// base_url('/node_modules/html5-qrcode/html5-qrcode.min.js'
			// 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'
			//Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
		);


		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['Perusahaan'] = $this->M_MappingPelangganEksternal->GetPerusahaan();
		$data['Sistem'] = $this->M_MappingPelangganEksternal->GetSistemEksternal();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/ManagementPelanggan/MappingPelangganEksternal/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/ManagementPelanggan/MappingPelangganEksternal/script', $data);
	}

	public function GetCustomerByFilter()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$perusahaan = $this->input->post('perusahaan');

		$data = $this->M_MappingPelangganEksternal->GetCustomerByFilter($perusahaan);

		echo json_encode($data);
	}

	public function GetCustomerPrincipleById()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_id = $this->input->post('client_pt_id');

		$data = $this->M_MappingPelangganEksternal->GetCustomerPrincipleById($client_pt_id);

		echo json_encode($data);
	}

	public function Insert_client_pt_principle_eksternal()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_id = $this->input->post('client_pt_id');
		$list_customer = $this->input->post('list_customer');

		$this->db->trans_begin();

		foreach ($list_customer as $key => $value) {
			$cek_customer = $this->M_MappingPelangganEksternal->Check_client_pt_principle_eksternal($client_pt_id, $value['sistem_eksternal'], $value['principle_id']);
			if ($cek_customer == 0) {
				$this->M_MappingPelangganEksternal->Insert_client_pt_principle_eksternal($client_pt_id, $value);
			} else {
				$this->M_MappingPelangganEksternal->Update_client_pt_principle_eksternal($client_pt_id, $value);
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
}
