<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class PengaturanKreditLimit extends ParentController

{
	private $MenuKode;
	private $url = 'FAS/ManagementPelanggan/PengaturanKreditLimit';

	public function __construct(String $url = '')
	{
		parent::__construct();

		$this->load->model('M_Menu');
		$this->load->model('FAS/M_Anggaran', 'M_Anggaran');
		$this->load->model('M_Depo');
		$this->load->model('M_Function');
		$this->load->model('M_Vrbl');
		$this->load->model('FAS/M_Kalender', 'M_Kalender');
		$this->load->model('FAS/M_KreditLimit', 'M_KreditLimit');
		$this->load->library('menusession');
		$this->load->library('loadview');
		// $this->load->model('FAS/M_Approval', 'M_Approval');
		$this->MenuKode = "222003000";
		$this->$url = $url;

		$this->menusession->checkMenuAccess($this->MenuKode);
	}

	public function PengaturanKreditLimitMenu()
	{

		$data = array();
		$data['area_id'] = $this->M_Depo->Getarea_by_depo_id($this->session->userdata('depo_id'));
		$this->session->set_userdata('area', $data);

		// $this->menusession->checkMenuAccess($this->MenuKode);
		//load data menu and css file yg digunakan di header n sidebar
		$dataMenu = $this->menusession->getDataMenu();

		$data['depo'] = $this->M_Depo->Getdepo_by_depo_id($this->session->userdata('depo_id'));
		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitMenu', $data);
		$this->load->view('layouts/sidebar_footer', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/s_PengaturanKreditLimitMenu', $data);

		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function PengaturanKreditLimitForm()
	{
		// $data = array();
		// $depo_id = $this->input->post('depo_id');

		$data = array();
		$data['area_id'] = $this->M_Depo->Getarea_by_depo_id($this->session->userdata('depo_id'));
		$this->session->set_userdata('area', $data);
		// var_dump($this->session->userdata('area'));
		// exit;
		$this->menusession->checkMenuAccess($this->MenuKode);
		//load data menu and css file yg digunakan di header n sidebar
		$dataMenu = $this->menusession->getDataMenu();

		$data['pelanggan'] = $this->M_KreditLimit->getListPelanggan();
		$data['principle'] = $this->M_KreditLimit->getDataPrinciple();
		// Header('Content-Type: application/json');
		// echo json_encode($data['pelanggan']);
		// exit;

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitForm', $data);
		$this->load->view('layouts/sidebar_footer', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/S_PengaturanKreditLimitForm', $data);

		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function PengaturanKreditLimitEdit()
	{

		$data = array();
		$kredit_limit_kode = $this->input->get("kode");
		// $this->menusession->checkMenuAccess($this->MenuKode);
		//load data menu and css file yg digunakan di header n sidebar
		$dataMenu = $this->menusession->getDataMenu();

		$data["kredit_limit"] = $this->M_KreditLimit->getKreditLimitByKode($kredit_limit_kode);
		$data["kredit_limit_detail"] = $this->M_KreditLimit->getKreditLimitDetailByID($data["kredit_limit"]->pengajuan_kredit_id);
		$data["kredit_limit_pelanggan"] = $this->M_KreditLimit->getAlamatPelangganById($data["kredit_limit"]->client_pt_id);

		$data['pelanggan'] = $this->M_KreditLimit->getListPelanggan();

		$data['principle'] = $this->M_KreditLimit->getDataPrinciple();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitEdit', $data);
		$this->load->view('layouts/sidebar_footer', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/S_PengaturanKreditLimitEdit', $data);

		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function PengaturanKreditLimitView()
	{

		$data = array();
		$kredit_limit_kode = $this->input->get("kode");

		$data["kredit_limit"] = $this->M_KreditLimit->getKreditLimitByKode($kredit_limit_kode);
		$data["kredit_limit_detail"] = $this->M_KreditLimit->getKreditLimitDetailByID($data["kredit_limit"]->pengajuan_kredit_id);
		$data["kredit_limit_pelanggan"] = $this->M_KreditLimit->getAlamatPelangganById($data["kredit_limit"]->client_pt_id);
		// Header('Content-Type: application/json');
		// //output dalam format JSON
		// echo json_encode($data);
		// exit;
		//load data menu and css file yg digunakan di header n sidebar
		$dataMenu = $this->menusession->getDataMenu();

		$data['pelanggan'] = $this->M_KreditLimit->getListPelanggan();
		$data['principle'] = $this->M_KreditLimit->getDataPrinciple();
		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitView', $data);
		$this->load->view('layouts/sidebar_footer', $dataMenu);
		$this->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/S_PengaturanKreditLimitView', $data);

		$this->load->view('master/S_GlobalVariable', $data);
	}

	public function SaveKreditLimit()
	{
		try {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PKL';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_KreditLimit->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$pengajuan_kredit_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$client_pt_id = $this->input->post("id_pelanggan");
			$pengajuan_kredit_keterangan = $this->input->post("keterangan");
			$pengajuan_kredit_status = $this->input->post("status");
			$dataDetail = $this->input->post("dataDetail");
			$data = $this->M_KreditLimit->SaveKreditLimit($pengajuan_kredit_kode, $client_pt_id, $pengajuan_kredit_status, $pengajuan_kredit_keterangan, $dataDetail);
			// Header('Content-Type: application/json');
			// //output dalam format JSON 
			// echo json_encode($data);
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
		} catch (\Throwable $th) {
			//throw $th;
		}
	}

	public function UpdateKreditLimit()
	{
		try {

			$pengajuan_kredit_id = $this->input->post("pengajuan_kredit_id");
			$pengajuan_kredit_kode = $this->input->post("pengajuan_kredit_kode");

			$client_pt_id = $this->input->post("id_pelanggan");
			$pengajuan_kredit_keterangan = $this->input->post("keterangan");
			$pengajuan_kredit_status = $this->input->post("status");
			$dataDetail = $this->input->post("dataDetail");
			$data = $this->M_KreditLimit->UpdateKreditLimit($pengajuan_kredit_kode, $pengajuan_kredit_id, $client_pt_id, $pengajuan_kredit_status, $pengajuan_kredit_keterangan, $dataDetail);
			// Header('Content-Type: application/json');
			// //output dalam format JSON 
			// echo json_encode($data);
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
		} catch (\Throwable $th) {
			//throw $th;
		}
	}

	public function getDataSearch()
	{
		$filter_status = $this->input->get('filter_status') == "" ? null : $this->input->post('filter_status');

		$tgl = explode(" - ", $this->input->get('filter_tanggal'));

		$tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
		$tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
		$data = $this->M_KreditLimit->getDataSearch($filter_status, $tgl1, $tgl2);

		Header('Content-Type: application/json');
		//output dalam format JSON
		echo json_encode($data);
	}
	public function getAlamatPelangganById()
	{
		$pelanggan_id = $this->input->get("id_pelanggan");
		$data = $this->M_KreditLimit->getAlamatPelangganById($pelanggan_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}

	public function getKreditLimitDetailByID()
	{

		$kredit_limit_id = $this->input->get("kredit_limit_id");
		$data = $this->M_KreditLimit->getKreditLimitDetailByID($kredit_limit_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getPelangganPrincipleById()
	{
		$pelanggan_id = $this->input->get("pelanggan_id");
		$data = $this->M_KreditLimit->getPelangganPrincipleById($pelanggan_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}

	public function getPelangganByCorporateId()
	{
		$client_pt_corporate_id = $this->input->get("client_pt_corporate_id");
		$data = $this->M_KreditLimit->getPelangganByCorporateId($client_pt_corporate_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getDataPrinciple()
	{
		$data = $this->M_KreditLimit->getDataPrinciple();
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getDataClientSegmen1()
	{
		$data = $this->M_KreditLimit->getDataClientSegmen1();
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getDataClientSegmen2()
	{
		$reff_id = $this->input->get("reff_id");
		// echo $reff_id;
		if (empty($reff_id)) {
			$reff_id = null;
		}
		$data = $this->M_KreditLimit->getDataClientSegmen2($reff_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
	public function getDataClientSegmen3()
	{
		$reff_id = $this->input->get("reff_id");
		if (empty($reff_id)) {
			$reff_id = null;
		}
		$data = $this->M_KreditLimit->getDataClientSegmen2($reff_id);
		Header('Content-Type: application/json');
		//output dalam format JSON 
		echo json_encode($data);
	}
}