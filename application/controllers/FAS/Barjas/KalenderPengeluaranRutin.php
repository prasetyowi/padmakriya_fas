<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/ParentController.php';

class KalenderPengeluaranRutin extends ParentController
{

	private $MenuKode;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('FAS/M_Kalender', 'M_Kalender');
		$this->load->model('M_Vrbl');
		$this->load->model('M_AutoGen');
		$this->MenuKode = "210005000";
	}

	public function KalenderPengeluaranRutinMenu()
	{
		$this->load->model('M_Menu');
		$this->load->model('M_Depo');
		//$this->load->model('M_KalenderPengeluaranRutin');

		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();
		$data['rangeYear'] = range(date('Y') - 5, date('Y') + 5);


		$data['depo'] = $this->M_Depo->Getdepo_by_depo_id($this->session->userdata('depo_id'));
		$data['kategori_biaya'] = $this->M_Kalender->Getkategori_biaya();
		$data['tipe_biaya'] = $this->M_Kalender->Gettipe_biaya();
		$data['bank'] = $this->M_Kalender->Getbank();
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');
		$data['Perusahaan'] = $this->M_Kalender->GetPerusahaan();
		$data['TipeTransaksi'] = $this->M_Kalender->GetTipeTransaksi();
		$data['TipePengadaan'] = $this->M_Kalender->GetTipePengadaan();

		$data['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',
			Get_Assets_Url() . 'vendors/jquery-ui/jquery-ui.min.css',

			Get_Assets_Url() . 'vendors/fullcalendar-5.11/lib/main.css',

			Get_Assets_Url() . 'vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
		);

		$data['js_files'] 	= array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js',
			Get_Assets_Url() . 'vendors/jquery-ui/jquery-ui.min.js',

			Get_Assets_Url() . 'vendors/fullcalendar-5.11/lib/main.js',

			Get_Assets_Url() . 'vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js'
		);

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/Barjas/KalenderPengeluaran/KalenderPengeluaranRutin', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/Barjas/KalenderPengeluaran/S_KalenderPengeluaranRutin', $data);
	}
	public function SaveKalenderPengeluaranRutin()

	{
		// $this->form_validation->set_rules('kategori_biaya_id', 'Kategori Biaya', 'required');
		// $this->form_validation->set_rules('tipe_biaya_id', 'Tipe Biaya', 'required');
		$this->form_validation->set_rules('kalender_judul', 'Judul', 'required');
		// $this->form_validation->set_rules('kalender_nilai', 'Nilai', 'required');
		// $this->form_validation->set_rules('bank_account_id', 'Nama Bank', 'required');
		// // $this->form_validation->set_rules('bank_account_id', 'Nama Bank', 'required');
		// $this->form_validation->set_rules('kalender_no_rekening', 'No rekening', 'required');
		// $this->form_validation->set_rules('kalender_nama_penerima', 'Nama Penerima', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$kategori_biaya_id 		= $this->input->post('kategori_biaya_id');
			$tipe_biaya_id = $this->input->post('tipe_biaya_id');
			$kalender_judul 		= $this->input->post('kalender_judul');
			$kalender_keterangan 		= $this->input->post('kalender_keterangan');
			$kalender_selected_date 	= $this->input->post('kalender_selected_date');
			$kalender_nilai 	= $this->input->post('kalender_nilai');
			$kalender_default_pembayaran 	= $this->input->post('kalender_default_pembayaran');
			$bank_account_id 	= $this->input->post('bank_account_id') == "" ? null : $this->input->post('bank_account_id');
			$kalender_no_rekening 	= $this->input->post('kalender_no_rekening');
			$kalender_nama_penerima 	= $this->input->post('kalender_nama_penerima');
			$kalender_is_recurrence 	= $this->input->post('kalender_is_recurrence');
			$tipe_berulang 	= $this->input->post('tipe_berulang');
			$kalender_warna 	= $this->input->post('kalender_warna');
			$dataBerulang 	= $this->input->post('dataBerulang');
			$perusahaan 	= $this->input->post('perusahaan');
			$jenis_pengadaan 	= $this->input->post('jenis_pengadaan');
			$is_kasbon 	= $this->input->post('iskasbon');
			// return false;
			$dataInsert = $this->M_Kalender->SaveKalenderEvent($kategori_biaya_id, $tipe_biaya_id, $kalender_judul, $kalender_keterangan, $kalender_selected_date, $kalender_nilai, $kalender_default_pembayaran, $bank_account_id, $kalender_no_rekening, $kalender_nama_penerima, $kalender_is_recurrence, $tipe_berulang, $kalender_warna, $dataBerulang, $perusahaan, $jenis_pengadaan, $is_kasbon);
			if ($dataInsert == 1) {
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
	}
	public function UpdateSaveKalenderPengeluaranRutin()
	{

		$kalender_id = $this->input->post('kalender_id') == "" ? null : $this->input->post('kalender_id');
		$kalender_detail_id = $this->input->post('kalender_detail_id') == "" ? null : $this->input->post('kalender_detail_id');

		$kategori_biaya_id 		= $this->input->post('kategori_biaya_id');
		$tipe_biaya_id = $this->input->post('tipe_biaya_id');
		$kalender_judul 		= $this->input->post('kalender_judul');
		$kalender_keterangan 		= $this->input->post('kalender_keterangan');
		$kalender_selected_date 	= $this->input->post('kalender_selected_date');
		$kalender_nilai 	= $this->input->post('kalender_nilai');
		$kalender_default_pembayaran 	= $this->input->post('kalender_default_pembayaran');
		$bank_account_id 	= $this->input->post('bank_account_id') == "" ? null : $this->input->post('bank_account_id');
		$kalender_no_rekening 	= $this->input->post('kalender_no_rekening');
		$kalender_nama_penerima 	= $this->input->post('kalender_nama_penerima');
		$kalender_is_recurrence 	= $this->input->post('kalender_is_recurrence');
		$tipe_berulang 	= $this->input->post('tipe_berulang');
		$kalender_warna 	= $this->input->post('kalender_warna');
		$dataBerulang 	= $this->input->post('dataBerulang');
		$perusahaan 	= $this->input->post('perusahaan');
		$jenis_pengadaan 	= $this->input->post('jenis_pengadaan');
		$is_kasbon 	= $this->input->post('iskasbon');
		$type_edit 	= $this->input->post('type_edit');

		$this->M_Kalender->DeleteKalenderEvent($type_edit, $kalender_id, $kalender_detail_id);
		// return false;
		$dataInsert = $this->M_Kalender->SaveKalenderEvent($kategori_biaya_id, $tipe_biaya_id, $kalender_judul, $kalender_keterangan, $kalender_selected_date, $kalender_nilai, $kalender_default_pembayaran, $bank_account_id, $kalender_no_rekening, $kalender_nama_penerima, $kalender_is_recurrence, $tipe_berulang, $kalender_warna, $dataBerulang, $perusahaan, $jenis_pengadaan, $is_kasbon);
		// var_dump($dataBerulang);
		// return false;
		if ($dataInsert == 1) {
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

	public function GetKalenderPengeluaranRutinMenu()
	{
		$this->load->model('M_Menu');
		$this->load->model('M_Depo');
		$this->load->model('M_Depo_Detail');

		$this->load->model('FAS/M_Kalender', 'M_Kalender');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$data['DepoMenu'] 			= $this->M_Depo->Getdepo();
	}

	public function GetKalenderPengeluaranRutinByDepo()
	{
		$depo_id 	= $this->input->post('depo_id');

		$data['KalenderMenu'] 		= $this->M_Kalender->Getkalender_by_depo_id($depo_id);

		echo json_encode($data);
	}

	public function GetKalenderEvent()
	{
		$jsonevents = array();
		$perusahaan = $this->input->get('perusahaan');
		$tanggal_start = date('Y-m-d', strtotime($this->input->get('start')));;
		$tanggal_end = date('Y-m-d', strtotime($this->input->get('end')));;
		$data = $this->M_Kalender->GetKalenderEvent($tanggal_start, $tanggal_end, $perusahaan);
		foreach ($data as $value) {
			$chk = '';
			$txt = true;
			if ($value['kalender_detail_flag_pengajuan'] != null || $value['kalender_detail_flag_pengajuan'] != "" || $value['kalender_detail_flag_pengajuan'] == 1) {
				$chk = '<span class="fc-title"> <i class="fa fa-solid fa fa-bold fa fa-check" aria-hidden="true"></i></span>';
				$txt = false;
			}
			$jsonevents[] = array(
				'id' => $value['kalender_detail_id'],
				'title' => $value['kalender_judul'] . $chk,
				'start' => $value['kalender_detail_tanggal'],
				'color' => $value['tipe_biaya_warna'],
				// "textEscape" => $txt,
			);
		}


		header('Content-Type: application/json');
		echo json_encode($jsonevents);
		// echo json_encode($data);
	}

	public function GetKalenderByDetailId()
	{

		$kalender_detail_id = $this->input->get('kalender_detail_id');
		$data = $this->M_Kalender->GetKalenderByDetailId($kalender_detail_id);

		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetKalenderBerulang()
	{
		// $kalender_detail_id = $this->input->get('kalender_detail_id');
		$perusahaan = $this->input->get('perusahaan');
		$data = $this->M_Kalender->GetKalenderBerulang($perusahaan);

		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetDetailKalenderByKalenderId()
	{

		$kalender_id = $this->input->get('kalender_id');
		$data = $this->M_Kalender->GetDetailKalenderByKalenderId($kalender_id);

		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetAnggaranDetail2ByYear()
	{
		$data = $this->M_Kalender->GetAnggaranDetail2ByYear();
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetAnggaranDetail2ByYearDepoClient()
	{
		$client_wms_id = $this->input->post("client_wms_id");
		$date = $this->input->post("tahun");
		$data = $this->M_Kalender->GetAnggaranDetail2ByYearDepoClient($client_wms_id, $date);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function GetCountPengajuanDanaRekap()
	{
		$tipe_biaya_id = $this->input->get('tipe_biaya_id');
		$tgl = $this->input->get('tanggal');
		$bulan = date("m", strtotime($tgl));
		$tahun = date("Y", strtotime($tgl));
		$data = $this->M_Kalender->GetCountPengajuanDanaRekap($tipe_biaya_id, $bulan, $tahun);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function DeleteKalenderEvent()
	{
		$mode = $this->input->post('mode');
		$kalender_id = $this->input->post('kalender_id') == "" ? null : $this->input->post('kalender_id');
		$kalender_detail_id = $this->input->post('kalender_detail_id') == "" ? null : $this->input->post('kalender_detail_id');
		$data = $this->M_Kalender->DeleteKalenderEvent($mode, $kalender_id, $kalender_detail_id);

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

	public function SavePengajuanDana()
	{

		try {
			$date_now = date('Y-m-d h:i:s');
			$param =  'KODE_PPD';

			$vrbl = $this->M_Vrbl->Get_Kode($param);
			$prefix = $vrbl->vrbl_kode;
			// get prefik depo
			$depo_id = $this->session->userdata('depo_id');
			$depoPrefix = $this->M_Kalender->getDepoPrefix($depo_id);
			$unit = $depoPrefix->depo_kode_preffix;
			$pengajuan_dana_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
			$kategori_biaya_id = $this->input->post('approval_kategori_biaya_id');
			$tipe_biaya_id = $this->input->post('approval_tipe_biaya_id');
			$pengajuan_dana_status = $this->input->post('approval_status');
			$pengajuan_dana_judul = $this->input->post('approval_kalender_judul');
			$pengajuan_dana_keterangan = $this->input->post('approval_kalender_keterangan');
			$pengajuan_dana_tgl_pengajuan = $this->input->post('approval_kalender_tanggal_pengajuan');
			$pengajuan_dana_tgl_dibutuhkan = $this->input->post('approval_kalender_tanggal');
			$pengajuan_dana_value = $this->input->post('approval_kalender_nilai');
			$pengajuan_dana_default_pembayaran = $this->input->post('approval_kalender_default_pembayaran');
			$bank_account_id = $this->input->post('approval_bank_id');
			$pengajuan_dana_nama_penerima = $this->input->post('approval_kalender_nama_penerima');
			$pengajuan_dana_rekening_penerima = $this->input->post('approval_kalender_no_rekening');
			$anggaran_detail_2_id = $this->input->post('approval_anggaran_detail_2');
			$kalender_detail_id = $this->input->post('kalender_detail_id');
			$perusahaan = $this->input->post('approval_perusahaan_id');
			$approval_tipe_transaksi = $this->input->post('approval_tipe_transaksi');
			$approval_jenis_pengadaan = $this->input->post('approval_jenis_pengadaan');
			$approval_nodocpo = $this->input->post('approval_nodocpo');
			$approval_jenis_asset = $this->input->post('approval_jenis_asset');
			$approval_jenis_asset = $this->input->post('approval_jenis_asset');
			$tipe_transaksikasbon = $this->input->post('tipe_transaksikasbon');
			$tipe_pengadaanid = $this->input->post('tipe_pengadaanid');

			if (!empty($_FILES['file']['name'])) {
				$uploadDirectory = "assets/uploads/files/PengajuanDana/";
				$fileExtensionsAllowed = ['jpeg', 'pdf', 'jpg', 'png', 'gif', 'JPG', 'JPEG']; // Allowed file extensions
				$fileName = $_FILES['file']['name'];
				$fileSize = $_FILES['file']['size'];
				$fileTmpName  = $_FILES['file']['tmp_name'];
				$fileType = $_FILES['file']['type'];
				$fileExtension = strtolower(explode(".", $fileName)[1]);
				// $name_file = 'bukti-' . time() . '.' . $fileExtension;
				$name_file = str_replace("/", "-", $pengajuan_dana_kode);
				$name_file = $name_file . '.' . $fileExtension;

				if (!in_array($fileExtension, $fileExtensionsAllowed)) {
					// echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)", 'kode' => $kode));
					echo json_encode(array('type' => 201, 'message' => "Gagal! File Attactment tidak sesuai ketentuan (JPG & PNG, GIF)"));
				} else {

					$uploadPath = $uploadDirectory . $name_file;
					move_uploaded_file($fileTmpName, $uploadPath);
					$data = $this->M_Kalender->SavePengajuanDana(
						$kalender_detail_id,
						$pengajuan_dana_kode,
						$kategori_biaya_id,
						$tipe_biaya_id,
						$pengajuan_dana_status,
						$pengajuan_dana_judul,
						$pengajuan_dana_keterangan,
						$pengajuan_dana_tgl_pengajuan,
						$pengajuan_dana_tgl_dibutuhkan,
						$pengajuan_dana_value,
						$pengajuan_dana_default_pembayaran,
						$bank_account_id,
						$pengajuan_dana_nama_penerima,
						$pengajuan_dana_rekening_penerima,
						$anggaran_detail_2_id,
						$name_file,
						$perusahaan,
						$tipe_transaksikasbon,
						$tipe_pengadaanid,
						$approval_nodocpo,
						$approval_jenis_asset

					);
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
						$this->load->helper("file");
						delete_files($uploadPath);
						$response = array(
							'message' => 'Failed create data !!',
							'status' =>  0
						);
					}
				}
			} else {
				$data = $this->M_Kalender->SavePengajuanDana(
					$kalender_detail_id,
					$pengajuan_dana_kode,
					$kategori_biaya_id,
					$tipe_biaya_id,
					$pengajuan_dana_status,
					$pengajuan_dana_judul,
					$pengajuan_dana_keterangan,
					$pengajuan_dana_tgl_pengajuan,
					$pengajuan_dana_tgl_dibutuhkan,
					$pengajuan_dana_value,
					$pengajuan_dana_default_pembayaran,
					$bank_account_id,
					$pengajuan_dana_nama_penerima,
					$pengajuan_dana_rekening_penerima,
					$anggaran_detail_2_id,
					null,
					$perusahaan,
					$tipe_transaksikasbon,
					$tipe_pengadaanid,
					$approval_nodocpo,
					$approval_jenis_asset
				);

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
					$response = array(
						'message' => 'Failed create data !!',
						'status' =>  0
					);
				}
			}
			echo json_encode($response);
		} catch (\Throwable $th) {
			$response = array(
				'message' => $th,
				'status' =>  0
			);
			throw $th;
		}
		// $approval_kalender_detail_id = $this->input->post('approval_bank_id');
		// var_dump($approval_kalender_detail_id);
		// return false;
		// $kalender_id = $this->input->post('kalender_id') == "" ? null : $this->input->post('kalender_id');
		// $kalender_detail_id = $this->input->post('kalender_detail_id') == "" ? null : $this->input->post('kalender_detail_id');
		// $data = $this->M_Kalender->DeleteKalenderEvent($mode, $kalender_id, $kalender_detail_id);


		// echo json_encode($response);
	}

	// dsagdkjsabdoa

	public function GetUpdateKalenderPengeluaranRutinMenu()
	{
		$this->load->model('M_Depo');
		$this->load->model('M_DepoDetail');
		$this->load->model('M_Vrbl');
		$this->load->model('M_MenuAccess');
		$this->load->model('M_Menu');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');

		$data['LokasiKerjaMenu'] = $this->M_LokasiKerja->Get_LokasiKerja();
		//$data['UnitMandiriMenu'] = $this->M_UnitMandiri->Get_UnitMandiri();
		$data['SegmentMenu'] = $this->M_Vrbl->Get_Segment();
		$data['PropinsiMenu'] = $this->M_PostalCode->Get_KodePos_Propinsi();
		//$data['KalenderPengeluaranRutinMenu'] = $this->M_KalenderPengeluaranRutin->GetdepoRak_by_KalenderPengeluaranRutin_ID( $KalenderPengeluaranRutin_ID );
		//$data['KalenderPengeluaranRutinDetailMenu'] = $this->M_KalenderPengeluaranRutinDetail->Get_KalenderPengeluaranRutinDetail_By_KalenderPengeluaranRutin_ID( $KalenderPengeluaranRutin_ID );
		//$data['KodePosMenu'] = $this->M_PostalCode->Get_KodePosDetail();

		// Mendapatkan url yang ngarah ke sini :
		$MenuLink = $this->session->userdata('MenuLink');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');

		$data['AuthorityMenu'] = $this->M_MenuAccess->Get_MenuAccess_By_pengguna_grup_id_MenuLink($pengguna_grup_id, $MenuLink);

		echo json_encode($data);
	}

	public function SaveDepoDetail()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_Vrbl');

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('Depo_ID', 'ID Depo', 'required');
		$this->form_validation->set_rules('DepoDetail_Nama', 'Nama Depo', 'required');
		$this->form_validation->set_rules('Depo_Catatan', 'Catatan Depo', 'required');
		$this->form_validation->set_rules('DepoDetail_Length', 'Panjang', 'required');
		$this->form_validation->set_rules('DepoDetail_Width', 'Lebar', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$Depo_ID 			= $this->input->post('Depo_ID');

			$DepoDetail_Nama 		= $this->input->post('DepoDetail_Nama');
			$Depo_Catatan 	= $this->input->post('Depo_Catatan');
			$DepoDetail_Length 	= $this->input->post('DepoDetail_Length');
			$DepoDetail_Width 	= $this->input->post('DepoDetail_Width');
			$flagjual 			= $this->input->post('flagjual');

			$DepoDetail_ID	= $this->M_Vrbl->Get_NewID();
			$DepoDetail_ID 	= $DepoDetail_ID[0]['NEW_ID'];

			$res1 = $this->M_KalenderPengeluaranRutin->Check_DepoDetail_Duplicate_Name($DepoDetail_Nama);

			$data = array();

			if ($res1 == 0) {
				$res = $this->M_KalenderPengeluaranRutin->Insert_DepoDetail(
					$Depo_ID,
					$DepoDetail_ID,
					$DepoDetail_Nama,
					$Depo_Catatan,
					$DepoDetail_Length,
					$DepoDetail_Width,
					$flagjual
				);


				if ($res == 0) {
					$data['resp'] = 2;
				} else {
					$data['resp'] = 1;
					$data['DepoDetail_ID'] = $DepoDetail_ID;
				}
			} else {
				$data['resp'] = 3;
			}

			echo json_encode($data);
		}
	}

	public function SaveKalenderPengeluaranRutinLayout()
	{
		$this->load->model('M_Rak_Lajur');
		$this->load->model('M_Vrbl');

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('depo_id', 'Depo', 'required');
		$this->form_validation->set_rules('depo_detail_id', 'Depo Detail', 'required');
		$this->form_validation->set_rules('rak_kode', 'Kode Rak', 'required');
		$this->form_validation->set_rules('rak_nama', 'Nama Rak', 'required');
		$this->form_validation->set_rules('rak_is_aktif', 'Status Depo', 'required');

		$this->form_validation->set_rules('arrRakLajur[]', 'Rak', 'required');

		$this->form_validation->set_rules('arrRakLajurDetail[]', 'Detail Rak', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$depo_id 		= $this->input->post('depo_id');
			$depo_detail_id = $this->input->post('depo_detail_id');
			$rak_kode 		= $this->input->post('rak_kode');
			$rak_nama 		= $this->input->post('rak_nama');
			$rak_is_aktif 	= $this->input->post('rak_is_aktif');

			$resx = $this->M_Vrbl->Get_NewID();
			$rak_id = $resx[0]['NEW_ID'];

			$res2 = $this->M_Rak_Lajur->Insertrak($rak_id, $depo_id, $depo_detail_id, $rak_kode, $rak_nama, $rak_is_aktif);
			if ($res2 == 1) {
				$arrRakLajur 	= $this->input->post('arrRakLajur');

				foreach ($arrRakLajur as $val) {
					$rand 				= $val['rand'];

					$rak_lajur_x 		= $val['rak_lajur_x'];
					$rak_lajur_y		= $val['rak_lajur_y'];
					$rak_lajur_width 	= $val['rak_lajur_width'];
					$rak_lajur_length 	= $val['rak_lajur_length'];
					$rak_lajur_nama 	= $val['rak_lajur_nama'];
					$rak_lajur_prefix 	= $val['rak_lajur_prefix'];

					$resy = $this->M_Vrbl->Get_NewID();
					$rak_lajur_id = $resy[0]['NEW_ID'];

					$res2 = $this->M_Rak_Lajur->Insertrak_lajur(
						$rak_lajur_id,
						$rak_id,
						$rak_lajur_x,
						$rak_lajur_y,
						$rak_lajur_width,
						$rak_lajur_length,
						$rak_lajur_nama,
						$rak_lajur_prefix
					);

					$arrRakLajurDetail 	= $this->input->post('arrRakLajurDetail');

					foreach ($arrRakLajurDetail as $valdetail) {
						$randParent 			= $valdetail['randParent'];

						$resz = $this->M_Vrbl->Get_NewID();
						$rak_lajur_detail_id = $resz[0]['NEW_ID'];

						$rak_lajur_detail_baris	= $valdetail['rak_lajur_detail_baris'];
						$rak_lajur_detail_kolom	= $valdetail['rak_lajur_detail_kolom'];
						$rak_lajur_detail_nama	= $valdetail['rak_lajur_detail_nama'];

						if ($randParent == $rand) {
							$resdetail = $this->M_Rak_Lajur->Insertrak_lajur_detail($rak_lajur_detail_id, $rak_lajur_id, $rak_id, $rak_lajur_detail_baris, $rak_lajur_detail_kolom, $rak_lajur_detail_nama);
						}
					}
				}

				echo 1;
			}
		}
	}

	public function GetKalenderPengeluaranRutinDetailMenu()
	{
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_KalenderPengeluaranRutin');

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'ID', 'required');


		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');

			$data['KalenderPengeluaranRutinMenu'] = $this->M_KalenderPengeluaranRutin->Get_KalenderPengeluaranRutin_By_KalenderPengeluaranRutin_ID($KalenderPengeluaranRutin_ID);
			$data['KalenderPengeluaranRutinDetailMenu'] = $this->M_KalenderPengeluaranRutinDetail->Get_KalenderPengeluaranRutinDetail_By_KalenderPengeluaranRutin_ID($KalenderPengeluaranRutin_ID);

			echo json_encode($data);
		}
	}

	public function GetKotaMenu()
	{
		$this->load->model('M_PostalCode');

		$Propinsi = $this->input->post('Propinsi');

		$data['KotaMenu'] = $this->M_PostalCode->Get_KodePos_Kabupaten($Propinsi);

		echo json_encode($data);
	}

	public function GetKecamatanMenu()
	{
		$this->load->model('M_PostalCode');

		$Propinsi 	= $this->input->post('Propinsi');
		$Kota 		= $this->input->post('Kota');

		$data['KecamatanMenu'] = $this->M_PostalCode->Get_KodePos_Kecamatan($Propinsi, $Kota);

		echo json_encode($data);
	}

	public function GetKelurahanMenu()
	{
		$this->load->model('M_PostalCode');

		$KodePos_ID = $this->input->post('KodePos_ID');

		$data['KelurahanMenu'] = $this->M_PostalCode->Get_KodePosDetail_By_KodePos_ID($KodePos_ID);

		echo json_encode($data);
	}

	public function ChangeDefaultAddress()
	{
		$this->load->model('M_KalenderPengeluaranRutinDetail');

		$KalenderPengeluaranRutinDetail_ID = $this->input->post('KalenderPengeluaranRutinDetail_ID');
		$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');

		$res = $this->M_KalenderPengeluaranRutinDetail->Update_KalenderPengeluaranRutinDetail_Default_0($KalenderPengeluaranRutin_ID, 0);

		$res2 = $this->M_KalenderPengeluaranRutinDetail->Update_KalenderPengeluaranRutinDetail_Default_1($KalenderPengeluaranRutinDetail_ID, 1);

		echo 1;
	}

	public function CheckEmail()
	{
		$this->load->model('M_KalenderPengeluaranRutin');

		$KalenderPengeluaranRutin_Email = $this->input->post('KalenderPengeluaranRutin_Email');

		$res = $this->M_KalenderPengeluaranRutin->Check_KalenderPengeluaranRutin_Duplicate_Email($KalenderPengeluaranRutin_Email);

		echo $res;
	}

	public function UpdateCheckEmail()
	{
		$this->load->model('M_KalenderPengeluaranRutin');

		$KalenderPengeluaranRutin_ID	= $this->input->post('KalenderPengeluaranRutin_ID');
		$KalenderPengeluaranRutin_Email = $this->input->post('KalenderPengeluaranRutin_Email');

		$res = $this->M_KalenderPengeluaranRutin->Check_KalenderPengeluaranRutin_Duplicate_Email_Other($KalenderPengeluaranRutin_Email, $KalenderPengeluaranRutin_ID);

		echo $res;
	}

	public function SaveAddNewKalenderPengeluaranRutin()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_Menu');
		$this->load->model('M_Vrbl');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		//$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'Kode', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_UserName', 'UserName', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Pass', 'Kata Sandi', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Name', 'Nama', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Phone', 'Kontak', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Email', 'Email', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Birthdate', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Segment', 'Segment', 'required');
		$this->form_validation->set_rules('LokasiKerja_ID', 'Lokasi Kerja', 'required');
		//$this->form_validation->set_rules('UnitMandiri_ID', 'Unit Mandiri', 'required');
		$this->form_validation->set_rules('IsActive', 'Status Aktif', 'required');

		$this->form_validation->set_rules('arrKalenderPengeluaranRutinDetail[]', 'KalenderPengeluaranRutin Detail', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			//$KalenderPengeluaranRutin_ID 		= $this->input->post('KalenderPengeluaranRutin_ID');
			$KalenderPengeluaranRutin_UserName 	= $this->input->post('KalenderPengeluaranRutin_UserName');
			$KalenderPengeluaranRutin_Pass 		= $this->input->post('KalenderPengeluaranRutin_Pass');
			$KalenderPengeluaranRutin_Name 		= $this->input->post('KalenderPengeluaranRutin_Name');
			$KalenderPengeluaranRutin_Phone 	= $this->input->post('KalenderPengeluaranRutin_Phone');
			$KalenderPengeluaranRutin_Email 	= $this->input->post('KalenderPengeluaranRutin_Email');
			$KalenderPengeluaranRutin_Birthdate = $this->input->post('KalenderPengeluaranRutin_Birthdate');
			$KalenderPengeluaranRutin_Segment 	= $this->input->post('KalenderPengeluaranRutin_Segment');

			$LokasiKerja_ID 	= $this->input->post('LokasiKerja_ID');
			//$UnitMandiri_ID 	= $this->input->post('UnitMandiri_ID');
			$IsActive		 	= $this->input->post('IsActive');

			$arrKalenderPengeluaranRutinDetail = $this->input->post('arrKalenderPengeluaranRutinDetail');

			$res = $this->M_KalenderPengeluaranRutin->Check_KalenderPengeluaranRutin_Duplicate_Email($KalenderPengeluaranRutin_Email);
			if ($res == 0) // email baru
			{
				$KalenderPengeluaranRutin_ID = $this->M_Vrbl->Get_NewID();
				$KalenderPengeluaranRutin_ID = $KalenderPengeluaranRutin_ID[0]['NEW_ID'];

				$Pass = password_hash($KalenderPengeluaranRutin_Pass, PASSWORD_BCRYPT, ['cost' => 8]);

				$result = $this->M_KalenderPengeluaranRutin->Insert_KalenderPengeluaranRutin(
					$KalenderPengeluaranRutin_ID,
					$KalenderPengeluaranRutin_UserName,
					$Pass,
					$KalenderPengeluaranRutin_Name,
					$KalenderPengeluaranRutin_Phone,
					$KalenderPengeluaranRutin_Email,
					$KalenderPengeluaranRutin_Birthdate,
					$KalenderPengeluaranRutin_Segment,
					$LokasiKerja_ID,
					$IsActive
				);

				foreach ($arrKalenderPengeluaranRutinDetail as $val) {
					$KalenderPengeluaranRutinDetail_ID = $this->M_Vrbl->Get_NewID();
					$KalenderPengeluaranRutinDetail_ID = $KalenderPengeluaranRutinDetail_ID[0]['NEW_ID'];

					$AddressTitle			= $val['AddressTitle'];
					$Recip_Name				= $val['Recip_Name'];
					$KodePos_ID				= $val['KodePos_ID'];
					$KodePosDetail_ID		= $val['KodePosDetail_ID'];
					$Recip_Address 			= $val['Recip_Address'];
					$Recip_Propinsi			= $val['Recip_Propinsi'];
					$Recip_Kota				= $val['Recip_Kota'];
					$Recip_Kecamatan		= $val['Recip_Kecamatan'];
					$Recip_Kelurahan		= $val['Recip_Kelurahan'];
					$Recip_KodePos			= $val['KodePos'];
					$Recip_Phone			= $val['Recip_Phone'];
					$IsDefaultShipAddress	= $val['IsDefaultShipAddress'];
					$IsActive				= $val['IsActive'];

					$resultdetail = $this->M_KalenderPengeluaranRutinDetail
						->Insert_KalenderPengeluaranRutinDetail(
							$KalenderPengeluaranRutinDetail_ID,
							$KalenderPengeluaranRutin_ID,
							$AddressTitle,
							$Recip_Name,
							$KodePos_ID,
							$KodePosDetail_ID,
							$Recip_Address,
							$Recip_Propinsi,
							$Recip_Kota,
							$Recip_Kecamatan,
							$Recip_Kelurahan,
							$Recip_KodePos,
							$Recip_Phone,
							$IsDefaultShipAddress,
							$IsActive
						);
				}

				echo 1;
			} else {
				echo 4;
			}
		}
	}

	public function UpdateSaveAddNewKalenderPengeluaranRutin()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_Menu');
		$this->load->model('M_Vrbl');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'Kode', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Segment', 'Segment', 'required');
		$this->form_validation->set_rules('LokasiKerja_ID', 'Lokasi Kerja', 'required');
		//$this->form_validation->set_rules('UnitMandiri_ID', 'Unit Mandiri', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Phone', 'Kontak', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Name', 'Nama KalenderPengeluaranRutin', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Birthdate', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Email', 'Email', 'required');
		$this->form_validation->set_rules('IsActive', 'Status Aktif', 'required');

		$this->form_validation->set_rules('arrKalenderPengeluaranRutinDetail[]', 'KalenderPengeluaranRutin Detail baru');
		$this->form_validation->set_rules('arrUKalenderPengeluaranRutinDetail[]', 'KalenderPengeluaranRutin Detail lama', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$KalenderPengeluaranRutin_ID 		= $this->input->post('KalenderPengeluaranRutin_ID');
			$KalenderPengeluaranRutin_Segment 	= $this->input->post('KalenderPengeluaranRutin_Segment');
			$KalenderPengeluaranRutin_Name 		= $this->input->post('KalenderPengeluaranRutin_Name');
			$LokasiKerja_ID 	= $this->input->post('LokasiKerja_ID');
			//$UnitMandiri_ID 	= $this->input->post('UnitMandiri_ID');
			$KalenderPengeluaranRutin_Birthdate = $this->input->post('KalenderPengeluaranRutin_Birthdate');
			$KalenderPengeluaranRutin_Email 	= $this->input->post('KalenderPengeluaranRutin_Email');
			$KalenderPengeluaranRutin_Phone 	= $this->input->post('KalenderPengeluaranRutin_Phone');

			$IsActive		 	= $this->input->post('IsActive');

			$arrKalenderPengeluaranRutinDetail 	= $this->input->post('arrKalenderPengeluaranRutinDetail');
			$arrUKalenderPengeluaranRutinDetail	= $this->input->post('arrUKalenderPengeluaranRutinDetail');

			$isexist = $this->M_KalenderPengeluaranRutin->Check_KalenderPengeluaranRutin_Duplicate_Email_Other($KalenderPengeluaranRutin_Email, $KalenderPengeluaranRutin_ID);

			if ($isexist == 1) {
				echo 4;
			} else {
				$result = $this->M_KalenderPengeluaranRutin->Update_KalenderPengeluaranRutin_Status(
					$KalenderPengeluaranRutin_ID,
					$KalenderPengeluaranRutin_Segment,
					$KalenderPengeluaranRutin_Name,
					$LokasiKerja_ID,
					$KalenderPengeluaranRutin_Birthdate,
					$KalenderPengeluaranRutin_Phone,
					$IsActive
				);

				if ($arrKalenderPengeluaranRutinDetail != '') {
					foreach ($arrKalenderPengeluaranRutinDetail as $val) {
						$KalenderPengeluaranRutinDetail_ID = $this->M_Vrbl->Get_NewID();
						$KalenderPengeluaranRutinDetail_ID = $KalenderPengeluaranRutinDetail_ID[0]['NEW_ID'];

						$AddressTitle			= $val['AddressTitle'];
						$Recip_Name				= $val['Recip_Name'];
						$KodePos_ID				= $val['KodePos_ID'];
						$KodePosDetail_ID		= $val['KodePosDetail_ID'];
						$Recip_Address 			= $val['Recip_Address'];
						$Recip_Propinsi			= $val['Recip_Propinsi'];
						$Recip_Kota				= $val['Recip_Kota'];
						$Recip_Kecamatan		= $val['Recip_Kecamatan'];
						$Recip_Kelurahan		= $val['Recip_Kelurahan'];
						$Recip_KodePos			= $val['KodePos'];
						$Recip_Phone			= $val['Recip_Phone'];
						$IsDefaultShipAddress	= $val['IsDefaultShipAddress'];
						$IsActive				= $val['IsActive'];

						$resultdetail = $this->M_KalenderPengeluaranRutinDetail
							->Insert_KalenderPengeluaranRutinDetail(
								$KalenderPengeluaranRutinDetail_ID,
								$KalenderPengeluaranRutin_ID,
								$AddressTitle,
								$Recip_Name,
								$KodePos_ID,
								$KodePosDetail_ID,
								$Recip_Address,
								$Recip_Propinsi,
								$Recip_Kota,
								$Recip_Kecamatan,
								$Recip_Kelurahan,
								$Recip_KodePos,
								$Recip_Phone,
								$IsDefaultShipAddress,
								$IsActive
							);
					}
				}

				foreach ($arrUKalenderPengeluaranRutinDetail as $val) {
					$KalenderPengeluaranRutinDetail_ID	= $val['KalenderPengeluaranRutinDetail_ID'];
					$IsActive			= $val['IsActive'];

					$resupdetail = $this->M_KalenderPengeluaranRutinDetail->Update_KalenderPengeluaranRutinDetail_Status($KalenderPengeluaranRutinDetail_ID, $IsActive);
				}


				echo 1;
			}
		}
	}

	public function SaveUpdateKalenderPengeluaranRutin()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_Menu');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "U")) {
			echo 0;
			exit();
		}

		//$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'Kode', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_UserName', 'UserName', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Pass', 'Kata Sandi', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Name', 'Nama', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Phone', 'Kontak', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Email', 'Email', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_Birthdate', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_TOP', 'TOP', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_PayIssuer', 'Pay Issuer', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutin_ACC', 'Account', 'required');

		$this->form_validation->set_rules('arrKalenderPengeluaranRutinDetail[]', 'Detail KalenderPengeluaranRutin');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {

			$KalenderPengeluaranRutin_ID 		= $this->input->post('KalenderPengeluaranRutin_ID');
			$KalenderPengeluaranRutin_UserName 	= $this->input->post('KalenderPengeluaranRutin_UserName');
			$KalenderPengeluaranRutin_Pass 		= $this->input->post('KalenderPengeluaranRutin_Pass');
			$KalenderPengeluaranRutin_Name 		= $this->input->post('KalenderPengeluaranRutin_Name');
			$KalenderPengeluaranRutin_Phone 	= $this->input->post('KalenderPengeluaranRutin_Phone');
			$KalenderPengeluaranRutin_Email 	= $this->input->post('KalenderPengeluaranRutin_Email');
			$KalenderPengeluaranRutin_Birthdate = $this->input->post('KalenderPengeluaranRutin_Birthdate');
			$KalenderPengeluaranRutin_TOP 		= $this->input->post('KalenderPengeluaranRutin_TOP');
			$KalenderPengeluaranRutin_PayIssuer = $this->input->post('KalenderPengeluaranRutin_PayIssuer');
			$KalenderPengeluaranRutin_ACC 		= $this->input->post('KalenderPengeluaranRutin_ACC');

			$arrKalenderPengeluaranRutinDetail = $this->input->post('arrKalenderPengeluaranRutinDetail');

			//$KalenderPengeluaranRutin_ID = $this->M_Vrbl->Get_NewID();
			//$KalenderPengeluaranRutin_ID = $KalenderPengeluaranRutin_ID[0]['NEW_ID'];

			$S_UserID = $this->session->userdata('UserID');
			$S_UserName = $this->session->userdata('UserName');

			$result = $this->M_KalenderPengeluaranRutin->Update_KalenderPengeluaranRutin(
				$KalenderPengeluaranRutin_ID,
				$KalenderPengeluaranRutin_UserName,
				$KalenderPengeluaranRutin_Pass,
				$KalenderPengeluaranRutin_Name,
				$KalenderPengeluaranRutin_Phone,
				$KalenderPengeluaranRutin_Email,
				$KalenderPengeluaranRutin_Birthdate,
				$KalenderPengeluaranRutin_TOP,
				$KalenderPengeluaranRutin_PayIssuer,
				$KalenderPengeluaranRutin_ACC
			);


			if ($arrKalenderPengeluaranRutinDetail != "") {
				foreach ($arrKalenderPengeluaranRutinDetail as $val) {
					$KalenderPengeluaranRutinDetail_ID 		= $val['KalenderPengeluaranRutinDetail_ID'];
					$KalenderPengeluaranRutin_ID 			= $val['KalenderPengeluaranRutin_ID'];
					$Recip_Name 			= $val['Recip_Name'];
					$KodePos_ID 			= $val['KodePos_ID'];
					$Recip_Address 			= $val['Recip_Address'];
					$Recip_Propinsi 		= $val['Recip_Propinsi'];
					$Recip_Kota 			= $val['Recip_Kota'];
					$Recip_Kecamatan 		= $val['Recip_Kecamatan'];
					$Recip_Kelurahan 		= $val['Recip_Kelurahan'];
					$Recip_Phone 			= $val['Recip_Phone'];
					$IsDefaultShipAddress 	= $val['IsDefaultShipAddress'];
					$Recip_Lat 				= $val['Recip_Lat'];
					$Recip_Lon		 		= $val['Recip_Lon'];

					$resultdetail = $this->M_KalenderPengeluaranRutinDetail->Insert_KalenderPengeluaranRutinDetail(
						$KalenderPengeluaranRutinDetail_ID,
						$KalenderPengeluaranRutin_ID,
						$Recip_Name,
						$KodePos_ID,
						$Recip_Address,
						$Recip_Propinsi,
						$Recip_Kota,
						$Recip_Kecamatan,
						$Recip_Kelurahan,
						$Recip_Phone,
						$IsDefaultShipAddress,
						$Recip_Lat,
						$Recip_Lon
					);
				}
			}
			echo 1;
		}
	}

	public function UpdateStatusKalenderPengeluaranRutinMenu()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_Menu');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "D")) {
			echo 0;
			exit();
		}

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'KalenderPengeluaranRutin_ID', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');

			$res = $this->M_KalenderPengeluaranRutin->Update_KalenderPengeluaranRutin_NonActive($KalenderPengeluaranRutin_ID, 0);

			echo 1;
		}
	}

	public function DeleteKalenderPengeluaranRutinMenu()
	{
		$this->load->model('M_KalenderPengeluaranRutin');
		$this->load->model('M_KalenderPengeluaranRutinDetail');
		$this->load->model('M_Menu');

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "D")) {
			echo 0;
			exit();
		}

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'KalenderPengeluaranRutin_ID', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');

			$isused = $this->M_KalenderPengeluaranRutin->Check_KalenderPengeluaranRutin_In_TransOrder($KalenderPengeluaranRutin_ID);
			if ($isused == 0) {
				$result3 = $this->M_KalenderPengeluaranRutinDetail->Delete_KalenderPengeluaranRutinDetail_By_KalenderPengeluaranRutin_ID($KalenderPengeluaranRutin_ID);
				$result2 = $this->M_KalenderPengeluaranRutin->Delete_KalenderPengeluaranRutin($KalenderPengeluaranRutin_ID);

				echo 1;
			} else {
				echo 2;
			}
		}
	}

	public function DeleteKalenderPengeluaranRutinDetailMenu()
	{
		$this->load->model('M_KalenderPengeluaranRutinDetail');

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('KalenderPengeluaranRutin_ID', 'KalenderPengeluaranRutin_ID', 'required');
		$this->form_validation->set_rules('KalenderPengeluaranRutinDetail_ID', 'KalenderPengeluaranRutinVA_ID', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$KalenderPengeluaranRutin_ID = $this->input->post('KalenderPengeluaranRutin_ID');
			$KalenderPengeluaranRutinVA_ID = $this->input->post('KalenderPengeluaranRutinVA_ID');

			$result3 = $this->M_KalenderPengeluaranRutinDetail->Count_KalenderPengeluaranRutinDetail_By_ID($KalenderPengeluaranRutin_ID);

			if ($result3 > 1) {
				$result4 = $this->M_KalenderPengeluaranRutinDetail->Delete_KalenderPengeluaranRutinDetail_By_KalenderPengeluaranRutinDetail_ID($KalenderPengeluaranRutinVA_ID);

				echo $result4;
			} else {
				echo 4;
			}
		}
	}

	public function insert_purchase_request()
	{
		// $purchase_request_id = $this->input->post('purchase_request_id');
		// $purchase_request_kode = $this->input->post('purchase_request_kode');
		$kalender_detail_id = $this->input->post('kalender_detail_id');
		$kalender_id = $this->input->post('kalender_id');
		$depo_id = $this->session->userdata('depo_id');
		$gudang_id = $this->input->post('gudang_id');
		$client_wms_id = $this->input->post('client_wms_id');
		$tipe_pengadaan_id = $this->input->post('tipe_pengadaan_id');
		$tipe_transaksi_id = $this->input->post('tipe_transaksi_id');
		$tipe_kepemilikan_id = $this->input->post('tipe_kepemilikan_id');
		$kategori_biaya_id = $this->input->post('kategori_biaya_id');
		$tipe_biaya_id = $this->input->post('tipe_biaya_id');
		$purchase_request_status = $this->input->post('purchase_request_status');
		$purchase_request_tgl = $this->input->post('purchase_request_tgl');
		$purchase_request_tgl_dibutuhkan = $this->input->post('purchase_request_tgl_dibutuhkan');
		$purchase_request_tgl_create = $this->input->post('purchase_request_tgl_create');
		$purchase_request_who_create = $this->session->userdata('pengguna_username');
		$purchase_request_keterangan = $this->input->post('purchase_request_keterangan');
		$purchase_request_pemohon = $this->input->post('purchase_request_pemohon');
		$karyawan_divisi_id = $this->input->post('karyawan_divisi_id');
		$judul = $this->input->post('judul');
		$anggaran_detail_2_id = $this->input->post('anggaran_detail_2_id');
		$nama_penerima = $this->input->post('nama_penerima');
		$nama_pemohon = $this->input->post('nama_pemohon');
		$default_pembayaran = $this->input->post('default_pembayaran');
		$bank_penerima = $this->input->post('bank_penerima');
		$no_rekening = $this->input->post('no_rekening');
		$keterangan = $this->input->post('keterangan');

		$detail = $this->input->post('detail');

		$purchase_request_id = $this->M_Vrbl->Get_NewID();
		$purchase_request_id = $purchase_request_id[0]['NEW_ID'];

		//generate kode
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_PR';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->M_Kalender->getDepoPrefix($depo_id);
		$unit = $depoPrefix->depo_kode_preffix;
		$purchase_request_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);
		$approvalParam = "APPRV_PR_01";

		$this->db->trans_begin();

		$this->M_Kalender->insert_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $kalender_id, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening, $nama_pemohon, $keterangan);
		// die;

		$this->M_Kalender->updateFlagPengajuanAndPurchaseRequest($kalender_detail_id);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}
	public function GetTipeTransaksiByTipePengadaanID()
	{
		$idTipePengadaan = $this->input->post('id_jenis_pengadaan');
		$data = $this->M_Kalender->GetTipeTransaksiByTipePengadaanID($idTipePengadaan);
		echo json_encode($data);
	}
}
