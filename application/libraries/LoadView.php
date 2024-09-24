<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LoadView
{

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->database('default');
		$this->CI->load->model('M_Menu');
		$this->CI->load->model('M_Depo');
		$this->CI->load->model('M_Function');
		$this->CI->load->model('M_Vrbl');
	}

	public function getDataView($dataMenu, $data)
	{
		$this->CI->load->view('layouts/sidebar_header', $dataMenu);
		$this->CI->load->view('FAS/ManagementPelanggan/PengaturanKreditLimit/PengaturanKreditLimitMenu', $data);
		$this->CI->load->view('layouts/sidebar_footer', $dataMenu);

		$this->CI->load->view('master/S_GlobalVariable', $data);
	}
}