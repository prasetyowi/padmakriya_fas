<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
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

		$this->MenuKode = "222001000";
		$this->load->model(['M_Menu', 'M_Outlet', 'M_Function', 'M_MenuAccess', 'M_Vrbl']);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function OutletMenu()
	{
		$data = array();
		$id = '';

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage'));
			exit();
		}

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['KelasJalan'] = $this->M_Outlet->Get_Data_KelasJalan();

		$data['KelasJalan2'] = $this->M_Outlet->Get_Data_KelasJalan2();
		$data['Area'] = $this->M_Outlet->Get_Data_Area();
		$data['Segment1'] = $this->M_Outlet->Get_Data_Segmen1();
		$data['Provinsi'] = $this->M_Outlet->Get_Data_Provinsi();
		$data['AreaHeader'] = $this->M_Outlet->Get_Data_Area_Header();

		$data['segmen2'] = $this->M_Outlet->Get_Data_Segmen2($id);
		$data['segmen3'] = $this->M_Outlet->Get_Data_Segmen3($id);

		$array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$data['Day'] = $array;

		$data['css_files'] = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
		);

		$data['js_files']     = array(
			Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
			Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

			// Get_Assets_Url() . 'vendors/select2/dist/js/select2.min.js',

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
		);

		$data['OutletMenu'] = $this->M_Outlet->Get_Outlet();
		$data['clientPtCorporate'] = $this->db->select("client_pt_corporate_id as id, client_pt_corporate_nama as nama")->from("client_pt_corporate")->order_by('client_pt_corporate_nama', 'ASC')->get()->result();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/ManagementPelanggan/Outlet/OutletList', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/ManagementPelanggan/Outlet/S_Outlet', $data);
	}

	public function GetOutletMenu()
	{

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		// $data['OutletMenu'] = $this->M_Outlet->Get_Outlet();
		$data['KelasJalan'] = $this->M_Outlet->Get_Data_KelasJalan();
		$data['KelasJalan2'] = $this->M_Outlet->Get_Data_KelasJalan2();
		$data['Area'] = $this->M_Outlet->Get_Data_Area();
		$data['Segment1'] = $this->M_Outlet->Get_Data_Segmen1();
		$data['Provinsi'] = $this->M_Outlet->Get_Data_Provinsi();
		$data['AreaHeader'] = $this->M_Outlet->Get_Data_Area_Header();

		$array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$data['Day'] = $array;


		// Mendapatkan url yang ngarah ke sini :
		$MenuLink = $this->session->userdata('MenuLink');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');

		$data['AuthorityMenu'] = $this->M_MenuAccess->Get_MenuAccess_By_UserGroupID_MenuLink($pengguna_grup_id, $MenuLink);

		$data['pengguna_grup_id'] = $this->session->userdata('pengguna_grup_id');
		$data['MenuLink'] = $this->session->userdata('MenuLink');

		echo json_encode($data);
	}

	public function GetOutletInternal()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		// Mendapatkan url yang ngarah ke sini :
		$MenuLink = $this->session->userdata('MenuLink');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$data['AuthorityMenu'] = $this->M_MenuAccess->Get_MenuAccess_By_UserGroupID_MenuLink($pengguna_grup_id, $MenuLink);
		$data['pengguna_grup_id'] = $this->session->userdata('pengguna_grup_id');
		$data['MenuLink'] = $this->session->userdata('MenuLink');

		echo json_encode($data);
	}

	public function Get_Outlet()
	{
		// $total_data     = $this->M_Outlet->count_all_data();
		// $draw           = intval($this->input->post('draw'));
		// $start          = intval($this->input->post('start'));
		// $length         = intval($this->input->post('length'));
		// $search_value   = $this->input->post('search')['value'];
		// $order_column   = intval($this->input->post('order')[0]['column']);
		// $order_dir      = $this->input->post('order')[0]['dir'];

		// $records_filtered   = $total_data['total'];
		// $data               = $this->M_Outlet->get_filtered_data($start, $length, $search_value, $order_column, $order_dir);

		// $response = array(
		// 	'draw'              => $draw,
		// 	'recordsTotal'      => $total_data['total'],
		// 	'recordsFiltered'   => $records_filtered,
		// 	'data'              => $data
		// );

		$response = $this->M_Outlet->get_dt_outlet_cabang();
		echo json_encode($response);
	}

	public function Get_OutletInternal()
	{
		$total_data     = $this->M_Outlet->count_all_dataInternal();
		$draw           = intval($this->input->post('draw'));
		$start          = intval($this->input->post('start'));
		$length         = intval($this->input->post('length'));
		$search_value   = $this->input->post('search')['value'];
		$order_column   = intval($this->input->post('order')[0]['column']);
		$order_dir      = $this->input->post('order')[0]['dir'];

		$records_filtered   = $total_data['total'];
		$data               = $this->M_Outlet->get_filtered_dataInternal($start, $length, $search_value, $order_column, $order_dir);

		$response = array(
			'draw'              => $draw,
			'recordsTotal'      => $total_data['total'],
			'recordsFiltered'   => $records_filtered,
			'data'              => $data
		);

		echo json_encode($response);
	}

	public function getOutletCorporate()
	{
		echo json_encode($this->M_Outlet->getOutletCorporate());
	}

	public function getInternal()
	{
		$data = $this->M_Outlet->getInternal();

		echo json_encode($data);
	}

	public function EditData()
	{


		$data = array();
		$data['KelasJalan'] = $this->M_Outlet->Get_Data_KelasJalan();
		$data['KelasJalan2'] = $this->M_Outlet->Get_Data_KelasJalan2();
		$data['Area'] = $this->M_Outlet->Get_Data_Area();
		$data['Segment1'] = $this->M_Outlet->Get_Data_Segmen1();
		$data['Provinsi'] = $this->M_Outlet->Get_Data_Provinsi();
		$data['id'] = $this->uri->segment(5);
		$data['clientPtCorporate'] = $this->db->select("client_pt_corporate_id as id, client_pt_corporate_nama as nama")->from("client_pt_corporate")->order_by('client_pt_corporate_nama', 'ASC')->get()->result();
		$data['clientPt'] = $this->db->select("client_pt_corporate_id")->from('client_pt')->where('client_pt_id', $this->uri->segment(5))->get()->row();
		// $query = $this->db->select("client_pt_segmen_id1 as segment1")->from("client_pt")->where('client_pt_id', $id)->get()->row();
		// $data['segment'] = $query;
		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage'));
			exit();
		}

		$array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
		$data['Day'] = $array;

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		// Kebutuhan Authority Menu
		$this->session->set_userdata('MenuLink', ltrim(current_url(), base_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/ManagementPelanggan/Outlet/component/EditData', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/ManagementPelanggan/Outlet/script', $data);
	}

	public function GetDataByIdForEdit()
	{
		$OutletId = $this->input->post('id');
		$type = $this->input->post('type');
		echo json_encode($this->M_Outlet->getDataOutletById($OutletId, $type));
		// if ($OutletId != "") {
		// 	$res = $this->M_Outlet->Get_Outlet_By_Id($OutletId);
		// 	if ($res != null) {
		// 		$kec_id = $this->M_Outlet->Get_Kecamatan_Id($res);
		// 		// $multi_lok = $this->M_Outlet->Get_Outlet_Kec_Id($res);
		// 		$data = $this->M_Outlet->Get_All_Id($kec_id);
		// 		echo json_encode($data);
		// 	}
		// } else {
		// 	$data = [];
		// }

		// echo json_encode($data);
	}

	public function Get_Request_Data_Area()
	{

		$kotaId = $this->input->post("kota");
		$id = $this->input->post("id");
		$data = $this->M_Outlet->Get_Data_Area_By_ID($id);
		$output = '<option value="">--Pilih Wilayah--</option>';
		foreach ($data as $row) {
			if ($kotaId) {
				if ($kotaId == $row['nama']) {
					$output .= '<option value="' . $row['id'] . '" selected>' . $row['nama'] . '</option>';
				} else {
					$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
				}
			} else {
				$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
			}
		}
		// $this->output->set_content_type('application/json')->set_output(json_encode($output));
		echo json_encode($output);
	}

	public function Get_Request_Data_Kota()
	{

		$kotaId = $this->input->post("kota");
		$id = $this->input->post("id");
		$data = $this->M_Outlet->Get_Data_Kota($id);
		$output = '<option value="">--Pilih Kota</option>';
		foreach ($data as $row) {
			if ($kotaId) {
				if ($kotaId == $row['region_nama']) {
					$output .= '<option value="' . $row['region_nama'] . '" selected>' . $row['region_nama'] . '</option>';
				} else {
					$output .= '<option value="' . $row['region_nama'] . '">' . $row['region_nama'] . '</option>';
				}
			} else {
				$output .= '<option value="' . $row['region_nama'] . '">' . $row['region_nama'] . '</option>';
			}
		}
		// $this->output->set_content_type('application/json')->set_output(json_encode($output));
		echo json_encode($output);
	}

	public function Get_Request_Data_Kecamatan()
	{
		$provinsi = $this->input->post("provinsi");
		$id = $this->input->post("id");
		$kecamatanId = $this->input->post("kecamatan");
		$data = $this->M_Outlet->Get_Data_Kecamatan($provinsi, $id);

		$output = '<option value="">--Pilih kecamatan</option>';
		foreach ($data as $row) {
			if ($kecamatanId) {
				if ($kecamatanId == $row['kode_pos_id']) {
					$output .= '<option value="' . $row['kode_pos_id'] . '" selected>' . $row['kode_pos_kecamatan'] . '</option>';
				} else {
					$output .= '<option value="' . $row['kode_pos_id'] . '">' . $row['kode_pos_kecamatan'] . '</option>';
				}
			} else {
				$output .= '<option value="' . $row['kode_pos_id'] . '">' . $row['kode_pos_kecamatan'] . '</option>';
			}
		}

		// $this->output->set_content_type('application/json')->set_output(json_encode($output));
		echo json_encode($output);
	}

	public function Get_Request_Data_Kelurahan()
	{

		$id = $this->input->post("id");
		$kelurahanId = $this->input->post("kelurahan");
		$data = $this->M_Outlet->Get_Data_Kelurahan($id);

		$output = '<option value="">--Pilih Kelurahan</option>';
		foreach ($data as $row) {
			if ($kelurahanId) {
				if ($kelurahanId == $row['kode_pos_kelurahan_nama']) {
					$output .= '<option value="' . $row['kode_pos_kode'] . '" selected>' . $row['kode_pos_kelurahan_nama'] . '</option>';
				} else {
					$output .= '<option value="' . $row['kode_pos_kode'] . '">' . $row['kode_pos_kelurahan_nama'] . '</option>';
				}
			} else {
				$output .= '<option value="' . $row['kode_pos_kode'] . '">' . $row['kode_pos_kelurahan_nama'] . '</option>';
			}
		}

		echo json_encode($output);
	}

	public function Get_Request_Data_Segment2()
	{

		$id = $this->input->post("id");
		$segment2 = $this->input->post("segment2");
		if ($id != "") {
			$data = $this->M_Outlet->Get_Data_Segmen2($id);
			$output = '<option value="">--Pilih Segmentasi 2</option>';
			foreach ($data as $row) {
				if ($segment2 != "") {
					if ($segment2 == $row['id']) {
						$output .= '<option value="' . $row['id'] . '" selected>' . $row['nama'] . '</option>';
					} else {
						$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
					}
				} else {
					$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
				}
			}
			echo json_encode($output);
		}
	}

	public function Get_Request_Data_Segment3()
	{
		$id = $this->input->post("id");
		$Segment3 = $this->input->post("Segment3");
		if ($id != "") {
			$data = $this->M_Outlet->Get_Data_Segmen3($id);
			$output = '<option value="">--Pilih Segmentasi 3</option>';
			foreach ($data as $row) {
				if ($Segment3) {
					if ($Segment3 == $row['id']) {
						$output .= '<option value="' . $row['id'] . '" selected>' . $row['nama'] . '</option>';
					} else {
						$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
					}
				} else {
					$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
				}
			}

			echo json_encode($output);
		}


		// echo json_encode($data);
	}

	public function Get_Request_Data_Multi_Lokasi()
	{

		$lokasi_outlet_id = $this->input->post("lokasi_outlet_id");
		$kode_id = $this->input->post("kode_id");
		$data = $this->M_Outlet->Get_Data_Multi_lokasi($kode_id);

		$output = '<option value="">--Pilih Lokasi</option>';
		foreach ($data as $row) {

			if ($lokasi_outlet_id) {
				if ($lokasi_outlet_id == $row['id']) {
					$output .= '<option value="' . $row['id'] . '" selected>' . $row['nama'] . '</option>';
				} else {
					$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
				}
			} else {
				$output .= '<option value="' . $row['id'] . '">' . $row['nama'] . '</option>';
			}
		}

		echo json_encode($output);
	}

	public function SaveAddNewOutlet()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$modesave = $this->input->post("modesave");
		$headOffice = $this->input->post("headOffice");

		$name_corporate = $this->input->post("name_corporate");
		$address_corporate = $this->input->post("address_corporate");
		$phone_corporate = $this->input->post("phone_corporate");
		// $corporate_group = $this->input->post("corporate_group");
		$lattitude_corporate = $this->input->post("lattitude_corporate");
		$longitude_corporate = $this->input->post("longitude_corporate");
		$stretclass_corporate = $this->input->post("stretclass_corporate");
		$stretclass2_corporate = $this->input->post("stretclass2_corporate");
		$area_corporate = $this->input->post("area_corporate");
		$province = $this->input->post("province");
		$city = $this->input->post("city");
		$districts = $this->input->post("districts");
		$ward = $this->input->post("ward");
		$kodepos_corporate = $this->input->post("kodepos_corporate");
		$name_contact_person = $this->input->post("name_contact_person");
		$phone_contact_person = $this->input->post("phone_contact_person");
		$kreditlimit_contact_person = $this->input->post("kreditlimit_contact_person");
		$segment1_contact_person = $this->input->post("segment1_contact_person");
		$segment2_contact_person = $this->input->post("segment2_contact_person");
		$segment3_contact_person = $this->input->post("segment3_contact_person");
		$isValidMultiLocation = $this->input->post("isValidMultiLocation");
		$listcontactperson_location = $this->input->post("listcontactperson_location");
		$IsAktif = $this->input->post("status");
		$modeCb = $this->input->post("modeCb");
		$client_pt_fax = $this->input->post("client_pt_fax");
		$client_pt_npwp = $this->input->post("client_pt_npwp");
		$client_pt_status_pkp = $this->input->post("client_pt_status_pkp");

		// $UnitMandiriId = $this->session->userdata('unit_mandiri_id');
		// $IsAktif = 1;
		$isDeleted = 0;

		$timeoperasional = $this->input->post("timeoperasional");

		if ($modeCb != '2') {
			$this->form_validation->set_rules('name_corporate', 'Nama Outlet', 'trim|required', [
				'required' => 'Nama Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('address_corporate', 'Alamat Outlet', 'trim|required', [
				'required' => 'Alamat Outlet tidak boleh kosong!'
			]);
			// $this->form_validation->set_rules('corporate_group', 'Corporate Group', 'required');
			$this->form_validation->set_rules('phone_corporate', 'Telepon Outlet', 'trim|required|is_unique[client_pt.client_pt_telepon]', [
				'is_unique' => 'Telepon Outlet Sudah digunakan',
				'required' => 'Telepon Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('province', 'Provinsi Outlet', 'trim|required', [
				'required' => 'Provinsi Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('city', 'Kota Outlet', 'trim|required', [
				'required' => 'Kota Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('districts', 'Kecamatan Outlet', 'trim|required', [
				'required' => 'Kecamatan Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('ward', 'Kelurahan Outlet', 'trim|required', [
				'required' => 'Kelurahan Outlet tidak boleh kosong!'
			]);
			$this->form_validation->set_rules('kodepos_corporate', 'Kode Pos Outlet', 'trim|required', [
				'is_unique' => 'Kode Pos Outlet Sudah digunakan'
			]);
			// $this->form_validation->set_rules('lattitude_corporate', 'Lattitude Outlet', 'trim|required|is_unique[client_pt.client_pt_latitude]', [
			// 	'is_unique' => 'Latitude Outlet Sudah digunakan',
			// 	'required' => 'Latitude Outlet tidak boleh kosong!'
			// ]);
			// $this->form_validation->set_rules('longitude_corporate', 'Longitude Outlet', 'trim|required|is_unique[client_pt.client_pt_longitude]', [
			// 	'is_unique' => 'Longitude Outlet Sudah digunakan',
			// 	'required' => 'Longitude Outlet tidak boleh kosong!'
			// ]);
			// $this->form_validation->set_rules('stretclass_corporate', 'Kelas Jalan Berdasarkan beban muatan', 'trim|required', [
			// 	'required' => 'Kelas Jalan Berdasarkan beban muatan tidak boleh kosong!'
			// ]);
			// $this->form_validation->set_rules('stretclass2_corporate', 'Kelas Jalan Berdasarkan fungsi jalan', 'trim|required', [
			// 	'required' => 'Kelas Jalan Berdasarkan fungsi jalan tidak boleh kosong!'
			// ]);
			$this->form_validation->set_rules('area_corporate', 'Area Outlet', 'trim|required', [
				'required' => 'Area Outlet tidak boleh kosong!'
			]);
			// $this->form_validation->set_rules('name_contact_person', 'Nama Contact Person', 'trim|required', [
			// 	'required' => 'Nama Contact Person tidak boleh kosong!'
			// ]);
			// $this->form_validation->set_rules('phone_contact_person', 'Telepon Contact Person', 'trim|required|is_unique[client_pt.client_pt_telepon_contact_person]', [
			// 	'is_unique' => 'Telepon Contact Person Sudah digunakan',
			// 	'required' => 'Telepon Contact Person tidak boleh kosong!'
			// ]);
			// $this->form_validation->set_rules('kreditlimit_contact_person', 'Kredit Limit Contact Person', 'trim|required', [
			// 	'required' => 'Kredit Limit Contact Person tidak boleh kosong!'
			// ]);

			if ($isValidMultiLocation == 1) {
				$this->form_validation->set_rules('listcontactperson_location', 'Lokasi', 'trim|required', [
					'required' => 'Lokasi tidak boleh kosong!'
				]);
			}

			if ($this->form_validation->run() == FALSE) {
				log_message('debug', validation_errors());

				echo validation_errors();
			}
			// // $this->form_validation->set_rules('listcontactperson-segment1', 'Segmentasi 1 Contact Person', 'required');
			// // $this->form_validation->set_rules('listcontactperson-segment2', 'Segmentasi 2 Contact Person', 'required');
			// // $this->form_validation->set_rules('listcontactperson-segment3', 'Segmentasi 3 Contact Person', 'required');
		}

		// $S_UserID = $this->session->userdata('UserID');
		// $S_UserName = $this->session->userdata('UserName');

		$outlet_id = $this->M_Outlet->Get_NewID();
		$outlet_id = $outlet_id[0]['NEW_ID'];

		if ($isValidMultiLocation == 1) {
			$listcontactperson_location = $listcontactperson_location;
		} else {
			$listcontactperson_location = NULL;
		}

		$this->db->trans_begin();

		if ($modesave == 'HO') {
			$data = $this->M_Outlet->Insert_Outlet_Corporate($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person,	$phone_contact_person, $kreditlimit_contact_person,	$stretclass_corporate, $stretclass2_corporate, $area_corporate,	$province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person,	$segment3_contact_person, $isDeleted, $IsAktif, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp);
		}

		if ($modesave == 'CB') {
			$data = $this->M_Outlet->Insert_Outlet($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $isValidMultiLocation, $listcontactperson_location, $headOffice, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp);
		}

		if ($modeCb == '2') {
			$data = $this->M_Outlet->Insert_Internal($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $isValidMultiLocation, $listcontactperson_location, $stretclass_corporate, $stretclass2_corporate, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp);
		}

		foreach ($timeoperasional as $val) {
			$no_urut = $val['no_urut'];
			$hari = $val['hari'];
			$buka = $val['buka'];
			$tutup = $val['tutup'];
			$status = $val['status'];
			$pengiriman = $val['pengiriman'];
			$penagihan = $val['penagihan'];

			if ($modesave == 'HO') {
				$this->M_Outlet->Insert_Outlet_Corporate_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
			}

			if ($modesave == 'CB') {
				$this->M_Outlet->Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
			}

			if ($modeCb == '2') {
				$this->M_Outlet->Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
			}
		}

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			echo json_encode(0);
		} else {
			$this->db->trans_commit();
			echo json_encode(1);
		}
	}

	public function Get_Data_Outlet_By_Id()
	{
		$OutletID = $this->input->post("OutletId");
		$type = $this->input->post("type");
		// $OutletID = "3D887AA5-C47A-4AB6-856E-3BED8E256816";
		$arr = $this->M_Outlet->Get_Data_Outlet_By_Id($OutletID, $type);

		$tmpgroup = [];
		$group = [];

		foreach ($arr as $key => $data) {
			$tmpdata = $data;
			unset($tmpdata['id']);
			unset($tmpdata['nama']);
			unset($tmpdata['alamat']);
			unset($tmpdata['telepon']);
			unset($tmpdata['provinsi']);
			unset($tmpdata['kota']);
			unset($tmpdata['kecamatan']);
			unset($tmpdata['kelurahan']);
			unset($tmpdata['kodepos']);
			unset($tmpdata['lattitude']);
			unset($tmpdata['longitude']);
			unset($tmpdata['nama_cp']);
			unset($tmpdata['telepon_cp']);
			unset($tmpdata['kredit_limit_cp']);
			unset($tmpdata['kelas_jalan']);
			unset($tmpdata['kelas_jalan2']);
			unset($tmpdata['area']);
			unset($tmpdata['aktif']);
			unset($tmpdata['segment1']);
			unset($tmpdata['segment2']);
			unset($tmpdata['segment3']);
			unset($tmpdata['checklist']);
			unset($tmpdata['lokasi_id']);
			unset($tmpdata['client_pt_fax']);
			unset($tmpdata['client_pt_npwp']);
			unset($tmpdata['client_pt_status_pkp']);
			$tmpgroup[$data['id']]['id'] = $data['id'];
			$tmpgroup[$data['id']]['nama'] = $data['nama'];
			$tmpgroup[$data['id']]['alamat'] = $data['alamat'];
			$tmpgroup[$data['id']]['telepon'] = $data['telepon'];
			$tmpgroup[$data['id']]['provinsi'] = $data['provinsi'];
			$tmpgroup[$data['id']]['kota'] = $data['kota'];
			$tmpgroup[$data['id']]['kecamatan'] = $data['kecamatan'];
			$tmpgroup[$data['id']]['kelurahan'] = $data['kelurahan'];
			$tmpgroup[$data['id']]['kodepos'] = $data['kodepos'];
			$tmpgroup[$data['id']]['lattitude'] = $data['lattitude'];
			$tmpgroup[$data['id']]['longitude'] = $data['longitude'];
			$tmpgroup[$data['id']]['nama_cp'] = $data['nama_cp'];
			$tmpgroup[$data['id']]['telepon_cp'] = $data['telepon_cp'];
			$tmpgroup[$data['id']]['kredit_limit_cp'] = $data['kredit_limit_cp'];
			$tmpgroup[$data['id']]['kelas_jalan'] = $data['kelas_jalan'];
			$tmpgroup[$data['id']]['kelas_jalan2'] = $data['kelas_jalan2'];
			$tmpgroup[$data['id']]['area'] = $data['area'];
			$tmpgroup[$data['id']]['aktif'] = $data['aktif'];
			$tmpgroup[$data['id']]['segment1'] = $data['segment1'];
			$tmpgroup[$data['id']]['segment2'] = $data['segment2'];
			$tmpgroup[$data['id']]['segment3'] = $data['segment3'];
			$tmpgroup[$data['id']]['client_pt_fax'] = $data['client_pt_fax'];
			$tmpgroup[$data['id']]['client_pt_npwp'] = $data['client_pt_npwp'];
			$tmpgroup[$data['id']]['client_pt_status_pkp'] = $data['client_pt_status_pkp'];
			// $tmpgroup[$data['id']]['lokasi_id'] = $data['lokasi_id'];
			$tmpgroup[$data['id']]['data'][] = $tmpdata; /* harus tetap ada key-nya, dalam hal ini 'data' */
		}
		foreach ($tmpgroup as $key => $data) {
			$tmpdata = $data;
			unset($tmpdata['id']);
			$group[$data['id']] = $tmpdata;
		};

		$data2 = [];
		$data3 = [];
		$group2 = [];
		$arr_multiple_alamat = [];

		if ($type == 'cabang') {
			$data2 = $this->M_Outlet->getDetailClientPTPrinciple($OutletID);
			$arr2 = $this->M_Outlet->getClientPtPrincipleAlamat($OutletID);

			if ($arr2 != 0) {
				foreach ($arr2 as $key => $value) {
					$client_pt_principle_alamat_detail = $this->M_Outlet->getClientPtPrincipleAlamatDetail($value['client_pt_principle_alamat_id']);

					// if (array_values($group)[0]['alamat'] != $value['client_pt_alamat']) {
					// Format data ke dalam array yang diinginkan
					$arr_multiple_alamat[] = [
						'client_pt_principle_id' => $value['client_pt_principle_id'],
						'random_id' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'), 0, 10),
						'flag' => $value['flag'],
						'alamat' => $value['client_pt_alamat'] ?? '',
						'telepon' => $value['client_pt_telepon'] ?? '',
						'provinsi' => $value['client_pt_propinsi'] ?? '',
						'kota' => $value['client_pt_kota'] ?? '',
						'kecamatan' => $value['kode_pos_id'] ?? '',
						'kecamatan_nama' => $value['client_pt_kecamatan'] ?? '',
						'kelurahan' => $value['kode_pos_kode'] ?? '',
						'kelurahan_nama' => $value['client_pt_kelurahan'] ?? '',
						'kode_pos' => $value['client_pt_kodepos'] ?? '',
						'area' => $value['area_id'] ?? '',
						'kelas_jalan1' => $value['kelas_jalan_id'] ?? '',
						'kelas_jalan2' => $value['kelas_jalan2_id'] ?? '',
						'lattitude' => $value['client_pt_latitude'] ?? '',
						'longitude' => $value['client_pt_longitude'] ?? '',
						'nama_person' => $value['client_pt_nama_contact_person'] ?? '',
						'telepon_person' => $value['client_pt_telepon_contact_person'] ?? '',
						'fax_person' => $value['client_pt_fax'] ?? '',
						'npwp_person' => $value['client_pt_npwp'] ?? '',
						'waktu_operasional' => [] // Untuk menyimpan waktu operasional dari $client_pt_principle_alamat_detail
					];

					// Tambahkan waktu operasional dari detail
					foreach ($client_pt_principle_alamat_detail as $detail) {
						$arr_multiple_alamat[$key]['waktu_operasional'][] = [
							'status' => $detail['client_pt_detail_is_open'],
							'no_urut' => $detail['client_pt_detail_hari_urut'],
							'hari' => $detail['client_pt_detail_hari'],
							'jam_buka' => $detail['client_pt_detail_jam_buka'] == '00:00' ? '' : $detail['client_pt_detail_jam_buka'],
							'jam_tutup' => $detail['client_pt_detail_jam_tutup'] == '00:00' ? '' : $detail['client_pt_detail_jam_tutup'],
							'pengiriman' => $detail['client_pt_detail_pengiriman'],
							'penagihan' => $detail['client_pt_detail_penagihan']
						];
					}
					// }
				}
			}
		}

		$response = [
			'data' => $group,
			'data2' => $data2,
			'data3' => $arr_multiple_alamat,
		];

		// echo json_encode($group);
		echo json_encode($response);
	}

	public function SaveUpdateOutlet()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "U")) {
			echo 0;
			exit();
		}

		$outlet_id = $this->input->post("outlet_id");
		$name_corporate = $this->input->post("name_corporate_update");
		$address_corporate = $this->input->post("address_corporate_update");
		$phone_corporate = $this->input->post("phone_corporate_update");
		// $corporate_group = $this->input->post("corporate_group_update");
		$lattitude_corporate = $this->input->post("lattitude_corporate_update");
		$longitude_corporate = $this->input->post("longitude_corporate_update");
		$stretclass_corporate = $this->input->post("stretclass_corporate_update");
		$stretclass2_corporate = $this->input->post("stretclass2_corporate_update");
		$area_corporate = $this->input->post("area_corporate_update");
		$province = $this->input->post("province_update");
		$city = $this->input->post("city_update");
		$districts = $this->input->post("districts_update");
		$ward = $this->input->post("ward_update");
		$kodepos_corporate = $this->input->post("kodepos_corporate_update");
		$name_contact_person = $this->input->post("name_contact_person_update");
		$phone_contact_person = $this->input->post("phone_contact_person_update");
		$kreditlimit_contact_person = $this->input->post("kreditlimit_contact_person_update");
		$segment1_contact_person = $this->input->post("segment1_contact_person_update");
		$segment2_contact_person = $this->input->post("segment2_contact_person_update");
		$segment3_contact_person = $this->input->post("segment3_contact_person_update");
		$isValidMultiLocation = $this->input->post("isValidMultiLocation");
		$listcontactperson_location = $this->input->post("listcontactperson_location");
		$timeoperasionall = $this->input->post("timeoperasional_update");
		$headOffice = $this->input->post("headOffice");
		$status = $this->input->post("status");
		$type = $this->input->post("type");
		$client_pt_fax = $this->input->post("client_pt_fax");
		$client_pt_npwp = $this->input->post("client_pt_npwp");
		$client_pt_status_pkp = $this->input->post("client_pt_status_pkp");
		$arr_multiple_alamat = $this->input->post("arr_multiple_alamat");
		$arr_flag = $this->input->post("arr_flag");


		$this->form_validation->set_rules('name_corporate_update', 'Nama Corporate', 'trim|required', [
			'required' => 'Nama Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('address_corporate_update', 'Alamat Corporate', 'trim|required', [
			'required' => 'Alamat Corporate tidak boleh kosong!'
		]);
		// $this->form_validation->set_rules('corporate_group', 'Corporate Group', 'required');
		$this->form_validation->set_rules('phone_corporate_update', 'Telepon Corporate', 'trim|required', [
			'required' => 'Telepon Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('province_update', 'Provinsi Corporate', 'trim|required', [
			'required' => 'Provinsi Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('city_update', 'Kota Corporate', 'trim|required', [
			'required' => 'Kota Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('districts_update', 'Kecamatan Corporate', 'trim|required', [
			'required' => 'Kecamatan Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('ward_update', 'Kelurahan Corporate', 'trim|required', [
			'required' => 'Kelurahan Corporate tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('kodepos_corporate_update', 'Kode Pos Corporate', 'trim|required', [
			'is_unique' => 'Kode Pos Corporate Sudah digunakan'
		]);
		// $this->form_validation->set_rules('lattitude_corporate_update', 'Lattitude Corporate', 'trim|required', [
		// 	'required' => 'Latitude Corporate tidak boleh kosong!'
		// ]);
		// $this->form_validation->set_rules('longitude_corporate_update', 'Longitude Corporate', 'trim|required', [
		// 	'required' => 'Longitude Corporate tidak boleh kosong!'
		// ]);
		// $this->form_validation->set_rules('stretclass_corporate_update', 'Kelas Berdasarkan barang muatan', 'trim|required', [
		// 	'required' => 'Kelas Berdasarkan barang muatan tidak boleh kosong!'
		// ]);
		// $this->form_validation->set_rules('stretclass2_corporate_update', 'Kelas Berdasarkan fungsi jalan', 'trim|required', [
		// 	'required' => 'Kelas Berdasarkan fungsi jalan tidak boleh kosong!'
		// ]);
		$this->form_validation->set_rules('area_corporate_update', 'Area Corporate', 'trim|required', [
			'required' => 'Area Corporate tidak boleh kosong!'
		]);
		// $this->form_validation->set_rules('name_contact_person_update', 'Nama Contact Person', 'trim|required', [
		// 	'required' => 'Nama Contact Person tidak boleh kosong!'
		// ]);
		// $this->form_validation->set_rules('phone_contact_person_update', 'Telepon Contact Person', 'trim|required', [
		// 	'required' => 'Telepon Contact Person tidak boleh kosong!'
		// ]);
		// $this->form_validation->set_rules('kreditlimit_contact_person_update', 'Kredit Limit Contact Person', 'trim|required', [
		// 	'required' => 'Kredit Limit Contact Person tidak boleh kosong!'
		// ]);

		// $this->db->trans_begin();

		if ($isValidMultiLocation == 1) {
			$this->form_validation->set_rules('listcontactperson_location', 'Lokasi', 'trim|required', [
				'required' => 'Lokasi tidak boleh kosong!'
			]);
		}
		// $this->form_validation->set_rules('listcontactperson-segment1', 'Segmentasi 1 Contact Person', 'required');
		// $this->form_validation->set_rules('listcontactperson-segment2', 'Segmentasi 2 Contact Person', 'required');
		// $this->form_validation->set_rules('listcontactperson-segment3', 'Segmentasi 3 Contact Person', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$result = '';
			$this->db->trans_begin();

			$S_UserID = $this->session->userdata('UserID');
			$S_UserName = $this->session->userdata('UserName');

			if ($type == 'cabang') {
				if ($isValidMultiLocation == 1) {
					$listcontactperson_location = $listcontactperson_location;
				} else {
					$listcontactperson_location = NULL;
				}

				$data = $this->M_Outlet->Update_Outlet($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isValidMultiLocation, $listcontactperson_location, $status, $headOffice, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp);

				$this->M_Outlet->deleteClientPTPrincipleAlamatdanDetail($outlet_id);

				if ($arr_multiple_alamat != null) {

					foreach ($arr_multiple_alamat as $key => $value) {
						$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
						$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

						$this->M_Outlet->insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $value);

						foreach ($value['waktu_operasional'] as $key => $val) {
							$id_detail = $client_pt_principle_alamat_id;
							$no_urut = $val['no_urut'];
							$hari = $val['hari'];
							$buka = $val['jam_buka'];
							$tutup = $val['jam_tutup'];
							$status = $val['status'];
							$pengiriman = $val['pengiriman'];
							$penagihan = $val['penagihan'];

							$res = $this->M_Outlet->insertClientPTPrincipleAlamatDetail($id_detail, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
						}
					}
				}

				foreach ($arr_flag as $key => $value) {
					if ($value['total'] == 0) {
						$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
						$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

						$result_client_pt = $this->M_Outlet->getClientPTDefault($outlet_id);
						$this->M_Outlet->insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $result_client_pt, $value);

						$result_client_pt_detail = $this->M_Outlet->getClientPTDetail($outlet_id);

						foreach ($result_client_pt_detail as $key => $val) {
							$id_detail = $client_pt_principle_alamat_id;
							$no_urut = $val['no_urut'];
							$hari = $val['hari'];
							$buka = $val['jam_buka'];
							$tutup = $val['jam_tutup'];
							$status = $val['status'];
							$pengiriman = $val['pengiriman'];
							$penagihan = $val['penagihan'];

							$res = $this->M_Outlet->insertClientPTPrincipleAlamatDetail($id_detail, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
						}
					}
				}
			}

			if ($type == 'head') {
				$data = $this->M_Outlet->Update_Outlet_Corporate($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $status, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp);
			}

			if ($data) {
				if ($timeoperasionall != null) {
					foreach ($timeoperasionall as $val) {
						$id_detail = $val['id_detail'];
						$no_urut = $val['no_urut'];
						$hari = $val['hari'];
						$buka = $val['buka'];
						$tutup = $val['tutup'];
						$status = $val['status'];
						$pengiriman = $val['pengiriman'];
						$penagihan = $val['penagihan'];

						if ($type == 'cabang') {
							$res = $this->M_Outlet->Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
							// $res = $this->M_Outlet->Update_Outlet_detail($status, $buka, $tutup, $pengiriman, $penagihan);
							if ($res) {
								$this->db->where_in('client_pt_detail_id', $id_detail);
								$this->db->delete('client_pt_detail');
							} else {
								$result =  'gagal';
								// echo 'gagal';
							}
						}

						if ($type == 'head') {
							$res = $this->M_Outlet->Insert_Outlet_Corporate_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan);
							if ($res) {
								$this->db->where_in('client_pt_corporate_detail_id', $id_detail);
								$this->db->delete('client_pt_corporate_detail');
							} else {
								$result =  'gagal';
								// echo 'gagal';
							}
						}
					}
				}
				$result =  1;
				// echo 1;
			} else {
				$result =  0;
				// echo 0;
			}

			if ($result == 'gagal' || $result == 0) {
				$this->db->trans_rollback();
				echo $result;
			} else if ($this->db->trans_status() == FALSE) {
				$this->db->trans_rollback();
				echo 0;
			} else {
				$this->db->trans_commit();
				echo $result;
			}
		}


		// $this->db->trans_rollback();
	}

	public function DeleteOutletMenu()
	{

		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "D")) {
			echo 0;
			exit();
		}


		$this->form_validation->set_rules('OutletID', 'ID', 'required');

		if ($this->form_validation->run() == FALSE) {
			log_message('debug', validation_errors());

			echo validation_errors();
		} else {
			$OutletID = $this->input->post('OutletID');

			$result = $this->M_Outlet->Delete_Outlet($OutletID);

			echo $result;
		}
	}

	public function sync_client_masar()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$status = array();

		$client_pt_id = $this->input->post('client_pt_id');
		$client_pt_nama = $this->input->post('client_pt_nama');

		if ($client_pt_id == "") {
			array_push($status, array("status" => 404, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-CLIENTPTTIDAKADA"));
			die;
		}

		$data_client_pt = $this->M_Outlet->data_sync_client_pt_masar($client_pt_id);

		foreach ($data_client_pt as $value) {

			$cek_masar = $this->M_Outlet->cek_masar_by_client_pt($value['client_pt_principle_id']);

			if ($cek_masar == 0) {

				$this->db->trans_begin();

				$this->M_Outlet->sync_client_masar($client_pt_id, $value);

				if ($this->db->trans_status() == FALSE) {
					$this->db->trans_rollback();
					array_push($status, array("status" => 500, "client_pt" => $value['nama'], "msg" => "CAPTION-ALERT-SYNCCUSTOMERGAGAL"));
				} else {
					$this->db->trans_commit();
					array_push($status, array("status" => 200, "client_pt" => $value['nama'], "msg" => "CAPTION-ALERT-SYNCCUSTOMERBERHASIL"));
				}
			} else {
				array_push($status, array("status" => 501, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-SUDAHSYNCCUSTOMER"));
			}
		}

		echo json_encode($status);
	}

	public function sync_client_masap()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$status = array();

		$client_pt_id = $this->input->post('client_pt_id');
		$client_pt_nama = $this->input->post('client_pt_nama');

		if ($client_pt_id == "") {
			array_push($status, array("status" => 404, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-CLIENTPTTIDAKADA"));
			die;
		}

		$data_client_pt = $this->M_Outlet->data_sync_client_pt_masap($client_pt_id);

		$cek_masar = $this->M_Outlet->cek_masap_by_client_pt($client_pt_id);

		if ($cek_masar == 0) {

			$this->db->trans_begin();

			foreach ($data_client_pt as $value) {
				$this->M_Outlet->sync_client_masap($client_pt_id, $value);
			}

			if ($this->db->trans_status() == FALSE) {
				$this->db->trans_rollback();
				array_push($status, array("status" => 500, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-SYNCSUPPLIERGAGAL"));
			} else {
				$this->db->trans_commit();
				array_push($status, array("status" => 200, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-SYNCSUPPLIERBERHASIL"));
			}
		} else {
			array_push($status, array("status" => 501, "client_pt" => $client_pt_nama, "msg" => "CAPTION-ALERT-SUDAHSYNCSUPPLIER"));
		}

		echo json_encode($status);
	}

	public function Get_masap_by_client_pt()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_id = $this->input->get('client_pt_id');
		$data = $this->M_Outlet->Get_masap_by_client_pt($client_pt_id);

		echo json_encode($data);
	}

	public function Get_masar_by_client_pt()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$client_pt_id = $this->input->get('client_pt_id');
		$data = $this->M_Outlet->Get_masar_by_client_pt($client_pt_id);

		echo json_encode($data);
	}

	public function Get_masar_by_id()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
			echo 0;
			exit();
		}

		$masar_id = $this->input->get('masar_id');
		$data = $this->M_Outlet->Get_masar_by_id($masar_id);

		echo json_encode($data);
	}

	public function search_no_perkiraan_all()
	{
		$term = $this->input->get('q');

		$data = $this->M_Outlet->search_no_perkiraan_all($term);

		$results = array();
		foreach ($data as $item) {
			$results[] = array(
				'id' => $item->id,
				'text' => $item->text // Assuming 'name' is the field you want to display
			);
		}

		echo json_encode($results);
	}

	public function Update_masar()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "U")) {
			echo 0;
			exit();
		}

		$masar_id = $this->input->post('masar_id');
		$masar_no = $this->input->post('masar_no');
		$masar_nama = $this->input->post('masar_nama');
		$masar_alamat = $this->input->post('masar_alamat');
		$masar_telepon = $this->input->post('masar_telepon');
		$masar_fax = $this->input->post('masar_fax');
		$masar_jatuh_tempo = $this->input->post('masar_jatuh_tempo');
		$masar_npwp = $this->input->post('masar_npwp');
		$masar_limit = $this->input->post('masar_limit');
		$masar_contact1 = $this->input->post('masar_contact1');
		$masar_position1 = $this->input->post('masar_position1');
		$masar_no_piutang = $this->input->post('masar_no_piutang');
		$masar_no_disc = $this->input->post('masar_no_disc');
		$masar_no_penj = $this->input->post('masar_no_penj');
		$masar_no_ppn = $this->input->post('masar_no_ppn');
		$masar_no_retur = $this->input->post('masar_no_retur');
		$updtgl = $this->input->post('updtgl');
		$updwho = $this->input->post('updwho');

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "BackOffice.dbo.masar",
			'whereField' => "masar_id",
			'whereValue' => $masar_id,
			'fieldDateUpdate' => "updtgl",
			'fieldWhoUpdate' => "updwho",
			'lastUpdated' => $updtgl
		]);

		$this->db->trans_begin();

		$this->M_Outlet->Update_masar($masar_id, $masar_no, $masar_nama, $masar_alamat, $masar_telepon, $masar_fax, $masar_jatuh_tempo, $masar_npwp, $masar_limit, $masar_contact1, $masar_position1, $masar_no_piutang, $masar_no_disc, $masar_no_penj, $masar_no_ppn, $masar_no_retur, $updtgl, $updwho);

		echo json_encode(responseJson((object)[
			'lastUpdatedChecked' => $lastUpdatedChecked,
			'status' => 'Disimpan'
		]));
	}

	public function Update_masap()
	{
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "U")) {
			echo 0;
			exit();
		}

		$masap_id = $this->input->post('masap_id');
		$supp_kode = $this->input->post('supp_kode');
		$supp_nama = $this->input->post('supp_nama');
		$supp_alamat = $this->input->post('supp_alamat');
		$supp_kota = $this->input->post('supp_kota');
		$supp_tilpun = $this->input->post('supp_tilpun');
		$supp_fax = $this->input->post('supp_fax');
		$supp_contact1 = $this->input->post('supp_contact1');
		$supp_position1 = $this->input->post('supp_position1');
		$supp_keterangan = $this->input->post('supp_keterangan');
		$supp_ac = $this->input->post('supp_ac');
		$supp_bank = $this->input->post('supp_bank');
		$updtgl = $this->input->post('updtgl');
		$updwho = $this->input->post('updwho');
		$supp_status = $this->input->post('supp_status');
		$supp_per_htng = $this->input->post('supp_per_htng');
		$supp_per_disc = $this->input->post('supp_per_disc');
		$supp_per_beli = $this->input->post('supp_per_beli');
		$supp_per_ppn = $this->input->post('supp_per_ppn');
		$isexpedisi = $this->input->post('isexpedisi');


		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "BackOffice.dbo.masap",
			'whereField' => "masap_id",
			'whereValue' => $masap_id,
			'fieldDateUpdate' => "updtgl",
			'fieldWhoUpdate' => "updwho",
			'lastUpdated' => $updtgl
		]);

		$this->db->trans_begin();

		$this->M_Outlet->Update_masap($masap_id, $supp_kode, $supp_nama, $supp_alamat, $supp_tilpun, $supp_fax, $supp_contact1, $supp_position1, $supp_keterangan, $supp_ac, $supp_bank, $updtgl, $updwho, $supp_status, $supp_per_htng, $supp_per_disc, $supp_per_beli, $supp_per_ppn, $isexpedisi);

		echo json_encode(responseJson((object)[
			'lastUpdatedChecked' => $lastUpdatedChecked,
			'status' => 'Disimpan'
		]));
	}

	public function getDetailClientPTPrinciple()
	{
		$client_pt_id = $this->input->post('id');

		$data = $this->M_Outlet->getDetailClientPTPrinciple($client_pt_id);

		echo json_encode($data);
	}

	public function getClientPTDefault()
	{
		$outlet_id = $this->input->post('id');
		$result_client_pt = $this->M_Outlet->getClientPTDefault($outlet_id);
		$result_client_pt_detail = $this->M_Outlet->getClientPTDetail($outlet_id);

		$response = [
			'header' => $result_client_pt,
			'detail' => $result_client_pt_detail
		];

		echo json_encode($response);
	}
}
