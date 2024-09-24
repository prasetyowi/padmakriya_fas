<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class Anggaran extends ParentController
{
	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->has_userdata('pengguna_id') == 0) :
			redirect(base_url('MainPage'));
		endif;

		$this->load->model('M_Menu');
		$this->load->model('FAS/M_Anggaran', 'M_Anggaran');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');

		$this->depo_id = $this->session->userdata('depo_id');
		$this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
		$this->MenuKode = "210003000";
	}

	public function AnggaranMenu()
	{
		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);

		$date = date("dmY");

		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);
		$data['Perusahaan'] = $this->M_Anggaran->GetPerusahaan();

		// $data['listDoBatch'] = $this->M_PengirimanBarang->getListDoBatchPick();
		// $data['listPickOrder'] = $this->M_PengirimanBarang->getListPickOrder();
		// var_dump($data);return false;
		// $data['listPicking'] = $this->M_PengirimanBarang->getDataPickingList();
		// $data['listLayanan'] = $this->M_PengirimanBarang->getListLayanan();
		// $data['listPengiriman'] = $this->M_PengirimanBarang->getListPengiriman();
		// $data['listArea'] = $this->M_PengirimanBarang->getArea();

		// $data['listTipeDO'] = $this->M_PengirimanBarang->getTipeDO();

		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}



		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] =  $this->session->userdata('pengguna_username');

		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/Anggaran/AnggaranMenu', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/Anggaran/S_AnggaranMenu', $data);
	}

	public function AnggaranForm()
	{
		$data = array();

		$anggaran_kode = $this->input->get("anggaran_kode");

		$menu_application = $this->session->userdata('Mode');

		$data = $this->M_Function->Get_Function_GetApplicationName_By_Aplikasi_Kode($menu_application);

		$aplikasi_url = $data[0]['aplikasi_url'];

		$data["anggaran"] = $this->M_Anggaran->getAnggaranByKode($anggaran_kode);
		$arrNamaBulan = array(
			"1" => "Januari",
			"2" => "Februari",
			"3" => "Maret",
			"4" => "April",
			"5" => "Mei",
			"6" => "Juni",
			"7" => "Juli",
			"8" => "Agustus",
			"9" => "September",
			"10" => "Oktober",
			"11" => "November",
			"12" => "Desember"
		);


		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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

		// $data['Ses_UserName'] = $this->session->userdata('UserName');
		$data['Perusahaan'] = $this->M_Anggaran->GetPerusahaan();

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));
		// var_dump($data);
		// exit;
		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/Anggaran/AnggaranForm', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/Anggaran/S_AnggaranForm');
	}

	public function AnggaranEdit()
	{
		$data = array();

		$anggaran_detail_kode = $this->input->get("kode");
		$data["anggaran_detail"] = $this->M_Anggaran->getAnggaranDetailByKode($anggaran_detail_kode);
		// var_dump($data["anggaran_detail"]);
		// return;

		$data['sidemenu'] = $this->M_Menu->GetMenu('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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

		// $data['Ses_UserName'] = $this->session->userdata('UserName');
		$data['Perusahaan'] = $this->M_Anggaran->GetPerusahaan();

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/Anggaran/AnggaranEdit', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/Anggaran/S_AnggaranEdit');
	}

	public function AnggaranAddNew()
	{
		$data = array();

		$anggaran_detail_kode = $this->input->get("kode");
		$data["anggaran_detail"] = $this->M_Anggaran->getAnggaranDetailByKode($anggaran_detail_kode);
		// var_dump($data["anggaran_detail"]);
		// return;

		$data['sidemenu'] = $this->M_Menu->GetMenu('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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
		$data['Perusahaan'] = $this->M_Anggaran->GetPerusahaan();

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/Anggaran/AnggaranAddNew', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/Anggaran/S_AnggaranAddNew');
	}

	public function AnggaranView()
	{
		$data = array();

		$anggaran_detail_kode = $this->input->get("kode");
		$data["anggaran_detail"] = $this->M_Anggaran->getAnggaranDetailByKode($anggaran_detail_kode);
		// var_dump($data["anggaran_detail"]);
		// return;

		$data['sidemenu'] = $this->M_Menu->GetMenu('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$data['css_files'] = array(
			Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
			Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

			//Get_Assets_Url() . 'assets/css/bootstrap-switch.min.css',
			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'assets/css/custom/scrollbar.css',

			//Get_Assets_Url() . 'assets/css/clock.css'
			//Get_Assets_Url() . 'assets/css/bootstrap-input-spinner.css'
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

		// $data['Ses_UserName'] = $this->session->userdata('UserName');

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();
		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/Anggaran/AnggaranView', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/Anggaran/S_AnggaranView');
	}

	public function SaveAnggaran()
	{
		$anggaran_kode = $this->input->post('anggaran_kode');
		$anggaran_tahun = $this->input->post('anggaran_tahun');
		$anggaran_jumlah_level = $this->input->post('anggaran_jumlah_level');
		$perusahaan = $this->input->post('perusahaan');

		$newid1 = $this->M_Function->Get_NewID();
		$newid = $newid1[0]['kode'];

		$data = array(
			'anggaran_tahun' => $anggaran_tahun,
			'anggaran_jumlah_level' => $anggaran_jumlah_level,
			'perusahaan' => $perusahaan
		);


		$data = $this->M_Anggaran->SaveAnggaran($data);
		if ($data == 1) {
			$response = array(
				'message' => 'success',
				'status' =>  1
			);
		} else {
			$response = array(
				'message' => 'Failed create data !!',
				'status' =>  0
			);
		}
		echo json_encode($response);
	}

	public function SaveAnggaranDetail()
	{
		$anggaran_id = $this->input->post('anggaran_id');
		$anggaran_detail_status = $this->input->post('anggaran_detail_status');
		$detail2 = $this->input->post('detail2');
		$detail3 = $this->input->post('detail3');

		$newid1 = $this->M_Function->Get_NewID();
		$newid = $newid1[0]['kode'];

		$data = array(
			'anggaran_id' => $anggaran_id,
			'anggaran_detail_id' => $newid,
			'anggaran_detail_status' => $anggaran_detail_status,
		);
		// $DT = $detail3[0]["budget"];
		// var_dump($DT["bulan"]);
		// return false;
		$data = $this->M_Anggaran->SaveAnggaranDetail($data, $detail2, $detail3);
		if (is_string($data) == 1) {
			$response = array(
				'message' => $data,
				'status' =>  0
			);
		} elseif ($data == 1) {
			$response = array(
				'message' => 'success',
				'status' =>  1
			);
		} else {
			//respone == 0
			$response = array(
				'message' => 'Failed create data !!',
				'status' =>  0
			);
		}
		echo json_encode($response);
	}

	public function UpdateAnggaranDetail()
	{
		$anggaran_detail_id = $this->input->post('anggaran_detail_id');
		$anggaran_detail_kode = $this->input->post('anggaran_detail_kode');
		$anggaran_id = $this->input->post('anggaran_id');
		$anggaran_detail_status = $this->input->post('anggaran_detail_status');
		$detail2 = $this->input->post('detail2');
		$detail3 = $this->input->post('detail3');

		$newid1 = $this->M_Function->Get_NewID();
		$newid = $newid1[0]['kode'];

		$data = array(
			'anggaran_id' => $anggaran_id,
			'anggaran_detail_status' => $anggaran_detail_status,
		);
		// echo  $this->session->userdata('depo_id');
		// return false;
		// $DT = $detail3[0]["budget"];
		// var_dump($DT["bulan"]);
		$data = $this->M_Anggaran->UpdateAnggaranDetail($anggaran_detail_id, $anggaran_detail_kode, $data, $detail2, $detail3);
		// var_dump($data);
		// return false;
		if (is_string($data) == 1) {
			$response = array(
				'message' => $data,
				'status' =>  0
			);
		} elseif ($data == 1) {
			$response = array(
				'message' => 'success',
				'status' =>  1
			);
		} else {
			//respone == 0
			$response = array(
				'message' => 'Failed create data !!',
				'status' =>  0
			);
		}
		echo json_encode($response);
	}

	public function getDataAnggaranSearch()
	{
		$anggaran_tahun = $this->input->post('anggaran_tahun');
		$perusahaan = $this->input->post('perusahaan');

		$data = $this->M_Anggaran->getDataAnggaranSearch($anggaran_tahun, $perusahaan);

		Header('Content-Type: application/json');
		//output dalam format JSON
		echo json_encode($data);
	}

	public function getListDetail()
	{
		$anggaran_id = $this->input->post('anggaran_id');

		$data = $this->M_Anggaran->getListDetail($anggaran_id);
		// var_dump($data);return false;
		header('Content-Type: application/json');

		$data = json_encode($data);

		echo $data;
	}

	public function getListDetail2AnggaranById()
	{
		$anggaran_detail_id = $this->input->post('anggaran_detail_id');

		$data = $this->M_Anggaran->getListDetail2AnggaranById($anggaran_detail_id);
		// var_dump($data);return false;
		header('Content-Type: application/json');

		$data = json_encode($data);

		echo $data;
	}
	public function getListDetail3AnggaranById()
	{
		$anggaran_detail_2_id = $this->input->post('anggaran_detail_2_id');

		$data = $this->M_Anggaran->getListDetail3AnggaranById($anggaran_detail_2_id);
		// var_dump($anggaran_detail_2_id);
		// return false;
		header('Content-Type: application/json');

		$data = json_encode($data);

		echo $data;
	}
}
