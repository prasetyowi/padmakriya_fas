<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SyncDataPelanggan extends CI_Controller
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
		$this->load->model(['M_Menu', 'FAS/M_SyncDataPelanggan', 'M_Function', 'M_MenuAccess']);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function SyncDataPelangganMenu()
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

		$data['Perusahaan'] = $this->M_SyncDataPelanggan->GetPerusahaan();
		$data['Sistem'] = $this->M_SyncDataPelanggan->GetSistemEksternal();
		$data['act'] = "index";

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/ManagementPelanggan/SyncDataPelanggan/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/ManagementPelanggan/SyncDataPelanggan/script', $data);
	}

	public function Insert_client_pt_principle_eksternal()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$valdiasi = array();
		$sistem_eksternal = $this->input->post('sistem_eksternal');

		if ($sistem_eksternal == "BOSNET") {

			$this->db->trans_begin();

			$list_customer = $this->M_SyncDataPelanggan->Get_customer_bosnet();

			foreach ($list_customer as $key => $value) {
				$cek_customer = $this->M_SyncDataPelanggan->Check_client_pt_principle_eksternal($sistem_eksternal, $value['szCustId']);
				if ($cek_customer == 0) {
					$this->M_SyncDataPelanggan->Insert_client_pt_principle_eksternal($sistem_eksternal, $value);
				} else {
					array_push($valdiasi, "2");
				}
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				array_push($valdiasi, "0");
			} else {
				$this->db->trans_commit();
				array_push($valdiasi, "1");
			}
		}

		$valdiasi_uniq = array_unique($valdiasi);
		rsort($valdiasi_uniq);
		echo json_encode($valdiasi_uniq);
	}
}
