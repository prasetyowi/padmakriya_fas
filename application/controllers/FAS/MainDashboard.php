<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class MainDashboard extends CI_Controller
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
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Dashboard');
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_PengaturanApproval');
	}

	public function MainDashboardMenu()
	{

		$query['Title'] = Get_Title_Name();
		$query['Copyright'] = Get_Copyright_Name();

		$query['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$query['Perusahaan'] = $this->M_PengaturanApproval->GetPerusahaan();

		$query['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',
			Get_Assets_Url() . 'vendors/jquery-ui/jquery-ui.min.css',
			Get_Assets_Url() . 'assets/css/textimage.css'
		);

		$query['js_files'] 	= array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js',
			Get_Assets_Url() . 'vendors/jquery-ui/jquery-ui.min.js',

		);

		$this->load->view('layouts/sidebar_header', $query);
		$this->load->view('FAS/DashboardMenu', $query);
		$this->load->view('layouts/sidebar_footer', $query);
		$this->load->view('FAS/S_DashboardMenu', $query);
		$this->load->view('master/S_GlobalVariable', $query);
	}

	public function getInfoStatusSO()
	{
		$pt   = $this->input->post('pt');
		$date  = explode(" - ", $this->input->post('date'));
		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $date[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $date[1])));

		$data['so'] = $this->M_Dashboard->getInfoStatusSO($pt, $tgl1, $tgl2);
		$data['apprv'] = $this->M_Dashboard->getInfoStatusApprv($pt, $tgl1, $tgl2);
		$data['pndg'] = $this->M_Dashboard->getInfoStatusPndg($pt, $tgl1, $tgl2);

		echo json_encode($data);
	}
}
