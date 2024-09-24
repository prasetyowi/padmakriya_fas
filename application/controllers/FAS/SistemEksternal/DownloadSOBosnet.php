<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . 'core/ParentController.php';

class DownloadSOBosnet extends CI_Controller
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

		$this->MenuKode = "296001000";
	}

	public function DownloadSOBosnetMenu()
	{
		$this->load->model('M_Menu');
		$this->load->model('FAS/M_SistemEksternal');

		$data = array();

		$data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
		if ($data['Menu_Access']['R'] != 1) {
			redirect(base_url('MainPage/Index'));
			exit();
		}

		$data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

		$data['Ses_UserName'] = $this->session->userdata('pengguna_username');

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

			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
			Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'

		);

		$data['Title'] = Get_Title_Name();
		$data['Copyright'] = Get_Copyright_Name();

		$data['Perusahaan'] = $this->M_SistemEksternal->GetPerusahaan();
		$data['Principle'] = $this->M_SistemEksternal->GetAllPrinciple();

		// Kebutuhan Authority Menu 
		$this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

		$this->load->view('layouts/sidebar_header', $data);
		$this->load->view('FAS/SistemEksternal/DownloadSOBosnet/index', $data);
		$this->load->view('layouts/sidebar_footer', $data);

		$this->load->view('master/S_GlobalVariable', $data);
		$this->load->view('FAS/SistemEksternal/DownloadSOBosnet/s_rupiah', $data);
		$this->load->view('FAS/SistemEksternal/DownloadSOBosnet/script', $data);
	}

	public function GetSalesOrderMenu()
	{
		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_Function');
		$this->load->model('M_MenuAccess');

		$this->load->model('M_Menu');
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

	public function GetSalesOrderBosnet()
	{
		$this->load->model('FAS/M_SistemEksternal');

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));
		$perusahaan = $this->input->post('perusahaan');
		$tipe_so = $this->input->post('tipe_so');
		$tipe_do = $this->input->post('tipe_do');
		$filter_principle_so = $this->input->post('principle');
		$principle = array();

		$sistem_eksternal = "BOSNET";
		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		$arr_principle = $this->M_SistemEksternal->GetPrincipleByPerusahaan($perusahaan);

		$cek_principle = $this->M_SistemEksternal->CheckPrinciplePerusahaan($perusahaan);

		if ($cek_principle > 0) {
			foreach ($arr_principle as $key => $value) {
				$principle[$key] = "'" . $value['principle_kode'] . "'";
			}

			// echo json_encode($principle[0]);

			// $depo = "390";
			// echo $depo;

			if ($depo != "") {
				$data['SalesOrderMenu'] = $this->M_SistemEksternal->Get_SalesOrderBosnet($tgl, $depo, $principle, $tipe_so, $tipe_do, $filter_principle_so);
			} else {
				$data['SalesOrderMenu'] = "CAPTION-ALERT-MAPPINGDEPOTIDAKADA";
			}
		} else {
			$data['SalesOrderMenu'] = "CAPTION-ALERT-PRINCIPLETIDAKDIPILIH";
		}

		echo json_encode($data);
	}

	public function GetSalesOrderBosnetWithoutDO()
	{
		$this->load->model('FAS/M_SistemEksternal');

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));
		$perusahaan = $this->input->post('perusahaan');
		$principle = array();

		$sistem_eksternal = "BOSNET";
		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		$arr_principle = $this->M_SistemEksternal->GetPrincipleByPerusahaan($perusahaan);

		$cek_principle = $this->M_SistemEksternal->CheckPrinciplePerusahaan($perusahaan);

		if ($cek_principle > 0) {
			foreach ($arr_principle as $key => $value) {
				$principle[$key] = "'" . $value['principle_kode'] . "'";
			}

			// echo json_encode($principle[0]);

			// $depo = "390";
			// echo $depo;

			if ($depo != "") {
				$data['SalesOrderMenu'] = $this->M_SistemEksternal->Get_SalesOrderBosnetWithoutDO($tgl, $depo, $principle);
			} else {
				$data['SalesOrderMenu'] = "CAPTION-ALERT-MAPPINGDEPOTIDAKADA";
			}
		} else {
			$data['SalesOrderMenu'] = "CAPTION-ALERT-PRINCIPLETIDAKDIPILIH";
		}

		echo json_encode($data);
	}

	public function GetSalesOrderBosnetInFAS()
	{
		$this->load->model('FAS/M_SistemEksternal');

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));
		$status = $this->input->post('status');
		$sistem_eksternal = "BOSNET";
		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		// $depo = $this->session->userdata('depo_id');

		$data['SOInFAS'] = $this->M_SistemEksternal->Get_SalesOrderBosnetInFAS($tgl, $depo);
		$data['SONotInFAS'] = $this->M_SistemEksternal->Get_SalesOrderBosnetNotInFAS($tgl, $depo, $status);

		echo json_encode($data);
		// echo $depo;
	}

	public function SaveSalesOrderBosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$arr_list_so = $this->input->post('arr_list_so');
		$valdiasi = array();

		// $this->db->trans_begin();
		$totalCommit = 0;
		foreach ($arr_list_so as $i => $val) {
			$so_id = $val;

			$this->db->trans_begin();

			$this->M_SistemEksternal->delete_bosnet_so($so_id);

			$header = $this->M_SistemEksternal->Insert_bosnet_so($so_id);
			$this->M_SistemEksternal->Insert_bosnet_so_detail($so_id);
			$this->M_SistemEksternal->insert_bosnet_so_bonus($so_id);

			// array_push($valdiasi, "1");
			// var_dump($header);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				// array_push($valdiasi, "0");
				$totalCommit = 0;
				array_push($valdiasi, array("kode" => 0, "msg" => "CAPTION-ALERT-DOWNLOADSOEKSTERNALFAILED"));
			} else {
				$this->db->trans_commit();
				// array_push($valdiasi, "1");
				$totalCommit = $totalCommit + 1;
				// array_push($valdiasi, array("kode" => 1, "msg" => $header['affectedrows'] . " SO FAS berhasil diunduh!"));
			}
		}

		if ($totalCommit > 0) {
			array_push($valdiasi, array("kode" => 1, "msg" => $totalCommit . " SO FAS berhasil diunduh!"));
		}
		// $valdiasi_uniq = array_unique($valdiasi);

		// rsort($valdiasi_uniq);
		echo json_encode($valdiasi);
	}

	public function Insert_sales_order()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));
		$sistem_eksternal = "BOSNET";

		$depo_eksternal = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;

		// echo $depo_eksternal;

		$arr_list_so = $this->M_SistemEksternal->Get_bosnet_so_by_filter($tgl, $depo_eksternal);
		$tipe_sales_order_id =  "D5A2AB04-0236-424D-859C-1888B46D6F50";
		$tipe_delivery_order_id = "ADF55030-9802-4C27-9658-F9D37AA01F95";

		$cek_sales = 0;
		$cek_customer = 0;
		$valdiasi = array();

		// echo var_dump($arr_list_so);

		if ($arr_list_so != "0") {

			foreach ($arr_list_so as $i => $value) {
				$so_id = $value['szFSoId'];
				$sales_order_id = $this->M_Vrbl->Get_NewID();
				$sales_order_id = $sales_order_id[0]['NEW_ID'];

				// $str_so = explode("-", $so_id);
				// $str_so = $str_so[0];

				if ($value['szWorkplaceId'] == "777") {
					$tipe_delivery_order_id = "0E626A53-82FC-4EA6-A4A2-1265279D6E1C";
				} else if ($value['szOrderTypeId'] == "RETUR") {
					$tipe_delivery_order_id = "C5BE83E2-01E8-4E24-B766-26BB4158F2CD";
				} else {
					$tipe_delivery_order_id = "ADF55030-9802-4C27-9658-F9D37AA01F95";
				}

				if ($value['szOrderTypeId'] == "JUAL") {
					$tipe_sales_order_id = "D5A2AB04-0236-424D-859C-1888B46D6F50";
				} else if ($value['szOrderTypeId'] == "RETUR") {
					$tipe_sales_order_id = "AD89E05B-46A6-453B-8F19-886514234A21";
				}

				$date_now = date('Y-m-d h:i:s');
				$param =  'KODE_SO';
				$vrbl = $this->M_Vrbl->Get_Kode($param);
				$prefix = $vrbl->vrbl_kode;

				// get prefik depo
				$depo_id = $this->session->userdata('depo_id');
				$depoPrefix = $this->M_SistemEksternal->getDepoPrefix($depo_id);
				$unit = $depoPrefix->depo_kode_preffix;
				$sales_order_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

				$cek_sales_not_mapping = $this->M_SistemEksternal->CheckSalesMapping($so_id);
				$cek_customer_not_mapping = $this->M_SistemEksternal->CheckCustomerMapping($so_id);

				if ($cek_sales_not_mapping != 0) {
					$cek_sales++;
					array_push($valdiasi, "2");
				}

				if ($cek_customer_not_mapping != 0) {
					$cek_customer++;
					array_push($valdiasi, "3");
				}

				if ($cek_sales_not_mapping == 0 && $cek_customer_not_mapping == 0) {

					$cek_so_fas = $this->M_SistemEksternal->Cek_sales_order_by_so_bosnet($so_id);

					if ($cek_so_fas == 0) {

						$this->db->trans_begin();

						$this->M_SistemEksternal->Insert_sales_order($so_id, $sales_order_id, $sales_order_kode, $tipe_sales_order_id, $tipe_delivery_order_id);

						$arr_so_bosnet_detail = $this->M_SistemEksternal->Get_so_bosnet_detail($so_id);
						$arr_so_bosnet_detail_promo = $this->M_SistemEksternal->Get_so_bosnet_detail_promo($so_id);

						if ($arr_so_bosnet_detail != 0) {
							foreach ($arr_so_bosnet_detail as $key => $value) {
								$sales_order_detail_id = $this->M_Vrbl->Get_NewID();
								$sales_order_detail_id = $sales_order_detail_id[0]['NEW_ID'];
								$result = $this->M_SistemEksternal->Insert_sales_order_detail($so_id, $sales_order_id, $value);
								// $this->M_SistemEksternal->Insert_sales_order_detail_2($sales_order_id, $depo_id, $value);

								if ($result == 1) {
									array_push($valdiasi, "1");
								} else {
									array_push($valdiasi, "0");
								}
							}
						}

						if (isset($arr_so_bosnet_detail_promo) && count($arr_so_bosnet_detail_promo) > 0) {
							foreach ($arr_so_bosnet_detail_promo as $key => $value) {
								$result = $this->M_SistemEksternal->Insert_sales_order_detail_promo($so_id, $sales_order_id, $value);
								// $this->M_SistemEksternal->Insert_sales_order_detail_2($sales_order_id, $depo_id, $value);

								if ($result == 1) {
									array_push($valdiasi, "1");
								} else {
									array_push($valdiasi, "0");
								}
							}
						}

						$this->M_SistemEksternal->update_sales_order($sales_order_id);

						if ($this->db->trans_status() === FALSE) {
							$this->db->trans_rollback();
							array_push($valdiasi, "0");
						} else {
							$this->db->trans_commit();
							array_push($valdiasi, "1");
						}
					}
				}
			}
		} else {
			array_push($valdiasi, "0");
		}

		$valdiasi_uniq = array_unique($valdiasi);
		rsort($valdiasi_uniq);
		echo json_encode($valdiasi_uniq);
	}

	public function CheckLastUpdate()
	{
		$szFSoId = $this->input->post('szFSoId');
		$tglUpdate = $this->input->post('tglUpdate');

		$data = $this->M_SistemEksternal->checkDataLastUpdate($szFSoId, $tglUpdate);

		echo json_encode($data);
	}

	public function Sync_customer_bosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$customer_id = $this->input->post('customer_id');
		$szFSoId = $this->input->post('szFSoId');
		$tglUpdate = $this->input->post('tglUpdate');

		$hari = array(
			1 => "Senin",
			2 => "Selasa",
			3 => "Rabu",
			4 => "Kamis",
			5 => "Jumat",
			6 => "Sabtu",
			7 => "Minggu"
		);

		$data = $this->M_SistemEksternal->checkDataLastUpdate($szFSoId, $tglUpdate);

		if ($data == 0) {
			echo json_encode(400);
		} else {
			$updateLastUpdate = $this->M_SistemEksternal->updateLastUpdate($szFSoId);

			$arr_customer_bosnet = $this->M_SistemEksternal->Get_nama_customer_bosnet_by_id($customer_id);
			$customer_nama = $arr_customer_bosnet->szName;
			$customer_alamat = $arr_customer_bosnet->CustszAddress_1;
			$customer_kelurahan = $arr_customer_bosnet->CustszAddress_2;
			$customer_kecamatan = $arr_customer_bosnet->CustszDistrict;
			$customer_kota = $arr_customer_bosnet->CustszCity;
			// $cek_customer_fas = $this->M_SistemEksternal->Check_customer_fas($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota);
			$cek_customer_fas = $this->M_SistemEksternal->Check_customer_fas_by_customer_eksternal_id($customer_id);

			$arr_customer_header = $this->M_SistemEksternal->Get_customer_bosnet_by_id($customer_id);
			// $arr_customer_principle = $this->M_SistemEksternal->Get_customer_bosnet_by_nama($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota);

			$valdiasi = array();
			$is_error = 0;

			$get_area = $this->M_SistemEksternal->Get_area_customer_bosnet($customer_id);
			if ($get_area != "0") {
				$area_id = $get_area->area_id;
				$area = $get_area->area;

				$area_internal = $this->M_SistemEksternal->Check_area_customer_eksternal($area_id, $area);

				if (count($arr_customer_header) > 0) {

					if ($cek_customer_fas == 0) {

						foreach ($arr_customer_header as $value) {

							$client_pt_id = $this->M_Vrbl->Get_NewID();
							$client_pt_id = $client_pt_id[0]['NEW_ID'];

							$this->db->trans_begin();

							$this->M_SistemEksternal->Insert_client_pt($client_pt_id, $area_internal, $value);
							$this->M_SistemEksternal->Insert_client_pt_detail($client_pt_id);

							foreach ($arr_customer_header as $value) {
								$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
								// $principle_id = 0;

								if ($principle_id != "0") {

									$cek_customer_principle = $this->M_SistemEksternal->Check_customer_principle($client_pt_id, $principle_id);

									if ($cek_customer_principle == 0) {
										$client_pt_principle_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_id = $client_pt_principle_id[0]['NEW_ID'];

										$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

										$result = $this->M_SistemEksternal->Insert_client_pt_principle($client_pt_principle_id, $client_pt_id, $principle_id, $value);

										$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

										$data_client_pt_principle_alamat_detail = array();

										for ($i = 1; $i <= 7; $i++) {

											$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

											$data_client_pt_principle_alamat_detail = array(
												"client_pt_detail_hari_urut" => $i,
												"client_pt_detail_hari" => $hari[$i],
												"client_pt_detail_jam_buka" => "07:00:00",
												"client_pt_detail_jam_tutup" => "21:00:00",
											);

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
										}
									} else {

										$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

										$client_pt_principle_id = $this->M_SistemEksternal->get_client_pt_principle_by_id($client_pt_id, $principle_id);

										$cek_client_pt_principle_alamat = $this->M_SistemEksternal->cek_client_pt_principle_alamat($client_pt_principle_id);

										if ($cek_client_pt_principle_alamat == 0) {

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

											$data_client_pt_principle_alamat_detail = array();

											for ($i = 1; $i <= 7; $i++) {

												$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
												$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

												$data_client_pt_principle_alamat_detail = array(
													"client_pt_detail_hari_urut" => $i,
													"client_pt_detail_hari" => $hari[$i],
													"client_pt_detail_jam_buka" => "07:00:00",
													"client_pt_detail_jam_tutup" => "21:00:00",
												);

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
											}
										} else {
											$client_pt_principle_alamat_id = $this->M_SistemEksternal->Get_client_pt_principle_alamat_id($client_pt_principle_id);

											$this->M_SistemEksternal->Update_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

											$this->M_SistemEksternal->Delete_client_pt_principle_alamat_detail($client_pt_principle_alamat_id);

											$data_client_pt_principle_alamat_detail = array();

											for ($i = 1; $i <= 7; $i++) {

												$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
												$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

												$data_client_pt_principle_alamat_detail = array(
													"client_pt_detail_hari_urut" => $i,
													"client_pt_detail_hari" => $hari[$i],
													"client_pt_detail_jam_buka" => "07:00:00",
													"client_pt_detail_jam_tutup" => "21:00:00",
												);

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
											}
										}
									}

									$cek_customer_principle_eksternal = $this->M_SistemEksternal->Check_customer_principle_eksternal($client_pt_id, $principle_id, null);

									if ($cek_customer_principle_eksternal == 0) {
										$sistem_eksternal = "BOSNET";
										$result = $this->M_SistemEksternal->Insert_client_pt_principle_eksternal($client_pt_id, $principle_id, $sistem_eksternal, $value);

										if ($result == 0) {
											$is_error++;
											$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer principle externals " . $customer_id . " sync failed");
											array_push($valdiasi, $msg);
										}
									} else {
										$is_error++;
										$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " already in sync");
										array_push($valdiasi, $msg);
									}
								} else {
									$is_error++;
									$msg = array("StatusMsg" => "401", "ErrMsg" => "Principle " . $value['szCategory_1'] . " not found");
									array_push($valdiasi, $msg);
								}
							}

							if ($this->db->trans_status() === FALSE || $is_error > 0) {
								$this->db->trans_rollback();

								$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " sync failed");
								array_push($valdiasi, $msg);
							} else {
								$this->db->trans_commit();

								$msg = array("StatusMsg" => "200", "ErrMsg" => "Customer " . $customer_id . " sync successful");
								array_push($valdiasi, $msg);
							}
						}
					} else {

						$client_pt_id = $this->M_SistemEksternal->Get_client_pt_id_by_customer_eksternal_id($customer_id);
						// $client_pt_id = $this->M_SistemEksternal->Get_client_pt_id_by_nama($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota)->client_pt_id;

						$this->db->trans_begin();

						foreach ($arr_customer_header as $value) {
							$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
							// $principle_id = 0;

							if ($principle_id != "0") {

								$cek_customer_principle = $this->M_SistemEksternal->Check_customer_principle($client_pt_id, $principle_id);

								if ($cek_customer_principle == 0) {
									$client_pt_principle_id = $this->M_Vrbl->Get_NewID();
									$client_pt_principle_id = $client_pt_principle_id[0]['NEW_ID'];

									$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
									$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

									$result = $this->M_SistemEksternal->Insert_client_pt_principle($client_pt_principle_id, $client_pt_id, $principle_id, $value);

									$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

									$data_client_pt_principle_alamat_detail = array();

									for ($i = 1; $i <= 7; $i++) {

										$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

										$data_client_pt_principle_alamat_detail = array(
											"client_pt_detail_hari_urut" => $i,
											"client_pt_detail_hari" => $hari[$i],
											"client_pt_detail_jam_buka" => "07:00:00",
											"client_pt_detail_jam_tutup" => "21:00:00",
										);

										$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
									}
								} else {

									$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
									$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

									$client_pt_principle_id = $this->M_SistemEksternal->get_client_pt_principle_by_id($client_pt_id, $principle_id);

									$cek_client_pt_principle_alamat = $this->M_SistemEksternal->cek_client_pt_principle_alamat($client_pt_principle_id);

									if ($cek_client_pt_principle_alamat == 0) {

										$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

										$data_client_pt_principle_alamat_detail = array();

										for ($i = 1; $i <= 7; $i++) {

											$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

											$data_client_pt_principle_alamat_detail = array(
												"client_pt_detail_hari_urut" => $i,
												"client_pt_detail_hari" => $hari[$i],
												"client_pt_detail_jam_buka" => "07:00:00",
												"client_pt_detail_jam_tutup" => "21:00:00",
											);

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
										}
									} else {
										$client_pt_principle_alamat_id = $this->M_SistemEksternal->Get_client_pt_principle_alamat_id($client_pt_principle_id);

										$this->M_SistemEksternal->Update_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

										$this->M_SistemEksternal->Delete_client_pt_principle_alamat_detail($client_pt_principle_alamat_id);

										$data_client_pt_principle_alamat_detail = array();

										for ($i = 1; $i <= 7; $i++) {

											$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

											$data_client_pt_principle_alamat_detail = array(
												"client_pt_detail_hari_urut" => $i,
												"client_pt_detail_hari" => $hari[$i],
												"client_pt_detail_jam_buka" => "07:00:00",
												"client_pt_detail_jam_tutup" => "21:00:00",
											);

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
										}
									}
								}

								$cek_customer_principle_eksternal = $this->M_SistemEksternal->Check_customer_principle_eksternal($client_pt_id, $principle_id, null);

								if ($cek_customer_principle_eksternal == 0) {
									$sistem_eksternal = "BOSNET";
									$result = $this->M_SistemEksternal->Insert_client_pt_principle_eksternal($client_pt_id, $principle_id, $sistem_eksternal, $value);

									if ($result == 0) {
										$is_error++;
										$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer principle externals " . $customer_id . " sync failed");
										array_push($valdiasi, $msg);
									}
								}
							} else {
								$is_error++;
								$msg = array("StatusMsg" => "401", "ErrMsg" => "Principle " . $value['szCategory_1'] . " not found");
								array_push($valdiasi, $msg);
							}
						}

						if ($this->db->trans_status() === FALSE || $is_error > 0) {
							$this->db->trans_rollback();

							$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " sync failed");
							array_push($valdiasi, $msg);
						} else {
							$this->db->trans_commit();

							$msg = array("StatusMsg" => "200", "ErrMsg" => "Customer " . $customer_id . " sync successful");
							array_push($valdiasi, $msg);
						}
					}
				} else {
					$msg = array("status" => "400", "msg" => "Customer external " . $customer_id . " not found");
					array_push($valdiasi, $msg);
				}
			} else {
				$msg = array("status" => "400", "msg" => "Area external of customer external " . $customer_id . " not found");
				array_push($valdiasi, $msg);
			}

			$result = array_map("unserialize", array_unique(array_map("serialize", $valdiasi)));
			echo json_encode($result);

			// $valdiasi_uniq = array_unique($valdiasi);
			// rsort($valdiasi_uniq);
			// echo json_encode($valdiasi_uniq);
			// echo json_encode($valdiasi);
		}
	}

	public function Sync_all_customer_bosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$valdiasi = array();

		$sistem_eksternal = "BOSNET";

		$depo = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;
		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));

		$hari = array(
			1 => "Senin",
			2 => "Selasa",
			3 => "Rabu",
			4 => "Kamis",
			5 => "Jumat",
			6 => "Sabtu",
			7 => "Minggu"
		);

		$arr_list_customer = $this->M_SistemEksternal->Get_customer_from_bosnet_so($tgl, $depo);

		if ($arr_list_customer != "0") {

			foreach ($arr_list_customer as $value) {
				$is_error = 0;

				$customer_id = $value['szCustId'];
				$arr_customer_bosnet = $this->M_SistemEksternal->Get_nama_customer_bosnet_by_id($customer_id);
				$customer_nama = $arr_customer_bosnet->szName;
				$customer_alamat = $arr_customer_bosnet->CustszAddress_1;
				$customer_kelurahan = $arr_customer_bosnet->CustszAddress_2;
				$customer_kecamatan = $arr_customer_bosnet->CustszDistrict;
				$customer_kota = $arr_customer_bosnet->CustszCity;
				$cek_customer_fas = $this->M_SistemEksternal->Check_customer_fas($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota);

				$arr_customer_header = $this->M_SistemEksternal->Get_customer_bosnet_by_id($customer_id);
				$arr_customer_principle = $this->M_SistemEksternal->Get_customer_bosnet_by_nama($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota);

				$get_area = $this->M_SistemEksternal->Get_area_customer_bosnet($customer_id);
				if ($get_area != "0") {
					$area_id = $get_area->area_id;
					$area = $get_area->area;

					$area_internal = $this->M_SistemEksternal->Check_area_customer_eksternal($area_id, $area);

					if (count($arr_customer_principle) > 0) {

						if ($cek_customer_fas == 0) {
							$client_pt_id = $this->M_Vrbl->Get_NewID();
							$client_pt_id = $client_pt_id[0]['NEW_ID'];

							$insert_header = $this->M_SistemEksternal->Insert_client_pt($client_pt_id, $area_internal, $arr_customer_header);

							if ($insert_header > 0) {

								$this->db->trans_begin();

								$this->M_SistemEksternal->Insert_client_pt_detail($client_pt_id);

								foreach ($arr_customer_principle as $value) {
									$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
									// $principle_id = 0;

									if ($principle_id != "0") {

										$cek_customer_principle = $this->M_SistemEksternal->Check_customer_principle($client_pt_id, $principle_id);

										if ($cek_customer_principle == 0) {
											$client_pt_principle_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_id = $client_pt_principle_id[0]['NEW_ID'];

											$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

											$result = $this->M_SistemEksternal->Insert_client_pt_principle($client_pt_principle_id, $client_pt_id, $principle_id, $value);

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

											$data_client_pt_principle_alamat_detail = array();

											for ($i = 1; $i <= 7; $i++) {

												$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
												$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

												$data_client_pt_principle_alamat_detail = array(
													"client_pt_detail_hari_urut" => $i,
													"client_pt_detail_hari" => $hari[$i],
													"client_pt_detail_jam_buka" => "07:00:00",
													"client_pt_detail_jam_tutup" => "21:00:00",
												);

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
											}
										} else {

											$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

											$client_pt_principle_id = $this->M_SistemEksternal->get_client_pt_principle_by_id($client_pt_id, $principle_id);

											$cek_client_pt_principle_alamat = $this->M_SistemEksternal->cek_client_pt_principle_alamat($client_pt_principle_id);

											if ($cek_client_pt_principle_alamat == 0) {

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

												$data_client_pt_principle_alamat_detail = array();

												for ($i = 1; $i <= 7; $i++) {

													$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
													$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

													$data_client_pt_principle_alamat_detail = array(
														"client_pt_detail_hari_urut" => $i,
														"client_pt_detail_hari" => $hari[$i],
														"client_pt_detail_jam_buka" => "07:00:00",
														"client_pt_detail_jam_tutup" => "21:00:00",
													);

													$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
												}
											} else {
												$client_pt_principle_alamat_id = $this->M_SistemEksternal->Get_client_pt_principle_alamat_id($client_pt_principle_id);

												$this->M_SistemEksternal->Update_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $arr_customer_header);

												$this->M_SistemEksternal->Delete_client_pt_principle_alamat_detail($client_pt_principle_alamat_id);

												$data_client_pt_principle_alamat_detail = array();

												for ($i = 1; $i <= 7; $i++) {

													$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
													$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

													$data_client_pt_principle_alamat_detail = array(
														"client_pt_detail_hari_urut" => $i,
														"client_pt_detail_hari" => $hari[$i],
														"client_pt_detail_jam_buka" => "07:00:00",
														"client_pt_detail_jam_tutup" => "21:00:00",
													);

													$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
												}
											}
										}

										$cek_customer_principle_eksternal = $this->M_SistemEksternal->Check_customer_principle_eksternal($client_pt_id, $principle_id, null);

										if ($cek_customer_principle_eksternal == 0) {
											$sistem_eksternal = "BOSNET";
											$result = $this->M_SistemEksternal->Insert_client_pt_principle_eksternal($client_pt_id, $principle_id, $sistem_eksternal, $value);

											if ($result == 0) {
												$is_error++;
												$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer principle externals " . $customer_id . " sync failed");
												array_push($valdiasi, $msg);
											}
										} else {
											$is_error++;
											$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " already in sync");
											array_push($valdiasi, $msg);
										}
									} else {
										$is_error++;
										$msg = array("StatusMsg" => "401", "ErrMsg" => "Principle " . $value['szCategory_1'] . " not found");
										array_push($valdiasi, $msg);
									}
								}

								if ($this->db->trans_status() === FALSE || $is_error > 0) {
									$this->db->trans_rollback();

									$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " sync failed");
									array_push($valdiasi, $msg);
								} else {
									$this->db->trans_commit();

									$msg = array("StatusMsg" => "200", "ErrMsg" => "Customer " . $customer_id . " sync successful");
									array_push($valdiasi, $msg);
								}
							}
						} else {

							$client_pt_id = $this->M_SistemEksternal->Get_client_pt_id_by_customer_eksternal_id($customer_id);
							// $client_pt_id = $this->M_SistemEksternal->Get_client_pt_id_by_nama($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota)->client_pt_id;

							$this->db->trans_begin();

							foreach ($arr_customer_principle as $value) {
								$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
								// $principle_id = 0;

								if ($principle_id != "0") {

									$cek_customer_principle = $this->M_SistemEksternal->Check_customer_principle($client_pt_id, $principle_id);

									if ($cek_customer_principle == 0) {
										$client_pt_principle_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_id = $client_pt_principle_id[0]['NEW_ID'];

										$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

										$result = $this->M_SistemEksternal->Insert_client_pt_principle($client_pt_principle_id, $client_pt_id, $principle_id, $value);

										$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

										$data_client_pt_principle_alamat_detail = array();

										for ($i = 1; $i <= 7; $i++) {

											$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
											$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

											$data_client_pt_principle_alamat_detail = array(
												"client_pt_detail_hari_urut" => $i,
												"client_pt_detail_hari" => $hari[$i],
												"client_pt_detail_jam_buka" => "07:00:00",
												"client_pt_detail_jam_tutup" => "21:00:00",
											);

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
										}
									} else {

										$client_pt_principle_alamat_id = $this->M_Vrbl->Get_NewID();
										$client_pt_principle_alamat_id = $client_pt_principle_alamat_id[0]['NEW_ID'];

										$client_pt_principle_id = $this->M_SistemEksternal->get_client_pt_principle_by_id($client_pt_id, $principle_id);

										$cek_client_pt_principle_alamat = $this->M_SistemEksternal->cek_client_pt_principle_alamat($client_pt_principle_id);

										if ($cek_client_pt_principle_alamat == 0) {

											$this->M_SistemEksternal->Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $value);

											$data_client_pt_principle_alamat_detail = array();

											for ($i = 1; $i <= 7; $i++) {

												$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
												$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

												$data_client_pt_principle_alamat_detail = array(
													"client_pt_detail_hari_urut" => $i,
													"client_pt_detail_hari" => $hari[$i],
													"client_pt_detail_jam_buka" => "07:00:00",
													"client_pt_detail_jam_tutup" => "21:00:00",
												);

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
											}
										} else {
											$client_pt_principle_alamat_id = $this->M_SistemEksternal->Get_client_pt_principle_alamat_id($client_pt_principle_id);

											$this->M_SistemEksternal->Update_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_internal, $arr_customer_header);

											$this->M_SistemEksternal->Delete_client_pt_principle_alamat_detail($client_pt_principle_alamat_id);

											$data_client_pt_principle_alamat_detail = array();

											for ($i = 1; $i <= 7; $i++) {

												$client_pt_principle_alamat_detail_id = $this->M_Vrbl->Get_NewID();
												$client_pt_principle_alamat_detail_id = $client_pt_principle_alamat_detail_id[0]['NEW_ID'];

												$data_client_pt_principle_alamat_detail = array(
													"client_pt_detail_hari_urut" => $i,
													"client_pt_detail_hari" => $hari[$i],
													"client_pt_detail_jam_buka" => "07:00:00",
													"client_pt_detail_jam_tutup" => "21:00:00",
												);

												$this->M_SistemEksternal->Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data_client_pt_principle_alamat_detail);
											}
										}
									}

									$cek_customer_principle_eksternal = $this->M_SistemEksternal->Check_customer_principle_eksternal($client_pt_id, $principle_id, null);

									if ($cek_customer_principle_eksternal == 0) {
										$sistem_eksternal = "BOSNET";
										$result = $this->M_SistemEksternal->Insert_client_pt_principle_eksternal($client_pt_id, $principle_id, $sistem_eksternal, $value);

										if ($result == 0) {
											$is_error++;
											$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer principle externals " . $customer_id . " sync failed");
											array_push($valdiasi, $msg);
										}
									}
								} else {
									$is_error++;
									$msg = array("StatusMsg" => "401", "ErrMsg" => "Principle " . $value['szCategory_1'] . " not found");
									array_push($valdiasi, $msg);
								}
							}

							if ($this->db->trans_status() === FALSE || $is_error > 0) {
								$this->db->trans_rollback();

								$msg = array("StatusMsg" => "401", "ErrMsg" => "Customer " . $customer_id . " sync failed");
								array_push($valdiasi, $msg);
							} else {
								$this->db->trans_commit();

								$msg = array("StatusMsg" => "200", "ErrMsg" => "Customer " . $customer_id . " sync successful");
								array_push($valdiasi, $msg);
							}
						}
					} else {
						$msg = array("kode" => "0", "msg" => "CAPTION-ALERT-SYNCCUSTOMERGAGAL");
						array_push($valdiasi, $msg);
					}
				} else {
					$msg = array("kode" => "5", "msg" => "CAPTION-ALERT-AREAEKSTERNALTIDAKADA");
					array_push($valdiasi, $msg);
				}
			}
		}

		$valdiasi_uniq = array_unique($valdiasi);
		rsort($valdiasi_uniq);
		echo json_encode($valdiasi_uniq);
		// echo json_encode($valdiasi);
	}

	public function Sync_sales_bosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$sistem_eksternal = "BOSNET";

		$sales_id = $this->input->post('sales_id');
		$sales_bosnet = $this->M_SistemEksternal->Get_sales_bosnet_by_id($sales_id);
		$depo_eksternal = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal);

		$sales_nama = $sales_bosnet->karyawan_nama;
		$depo_eksternal = $depo_eksternal->depo_eksternal_kode;

		$sales_bosnet_principle = $this->M_SistemEksternal->Get_sales_bosnet_principle_by_id($sales_id);
		$cek_sales_fas = $this->M_SistemEksternal->Check_sales_fas($sales_nama, $this->session->userdata('depo_id'));

		$valdiasi = array();

		if ($sales_bosnet != "0") {

			if ($depo_eksternal != "") {

				if ($cek_sales_fas == 0) {
					$karyawan_id = $this->M_Vrbl->Get_NewID();
					$karyawan_id = $karyawan_id[0]['NEW_ID'];

					$insert_header = $this->M_SistemEksternal->Insert_karyawan($karyawan_id, $sales_bosnet);

					if ($insert_header > 0) {

						$this->M_SistemEksternal->Insert_karyawan_detail($karyawan_id, $sales_bosnet);

						foreach ($sales_bosnet_principle as $value) {
							$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
							// $principle_id = 0;

							if ($principle_id != "0") {

								$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

								if ($cek_sales_principle == 0) {
									$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
									if ($result == 1) {
										$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
										array_push($valdiasi, $msg);
									} else {
										// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
										$msg = array("kode" => "2", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
										array_push($valdiasi, $msg);
									}
								}
							} else {
								// $this->M_SistemEksternal->delete_client_pt($client_pt_id);
								$msg = array("kode" => "4", "msg" => $value['szCategory_1']);
								array_push($valdiasi, $msg);
							}
						}

						$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

						if ($cek_sales_principle_eksternal == 0) {
							$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $sales_id);
							if ($result == 1) {
								$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
								array_push($valdiasi, $msg);
							} else {
								// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
								$msg = array("kode" => "3", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
								array_push($valdiasi, $msg);
							}
						}
					} else {
						// echo $insert_header;
						$msg = array("kode" => "0", "msg" => "CAPTION-ALERT-SYNCSALESGAGAL");
						array_push($valdiasi, $msg);
					}
				} else {

					$karyawan_id = $this->M_SistemEksternal->Get_karyawan_id_by_nama($sales_nama, $this->session->userdata('depo_id'))->karyawan_id;

					foreach ($sales_bosnet_principle as $value) {
						$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
						// $principle_id = 0;

						if ($principle_id != "0") {

							$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

							if ($cek_sales_principle == 0) {
								$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
								if ($result == 1) {
									$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
									array_push($valdiasi, $msg);
								} else {
									// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
									$msg = array("kode" => "2", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
									array_push($valdiasi, $msg);
								}
							}
						} else {
							// $this->M_SistemEksternal->delete_client_pt($client_pt_id);
							$msg = array("kode" => "4", "msg" => $value['szCategory_1']);
							array_push($valdiasi, $msg);
						}
					}

					$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

					if ($cek_sales_principle_eksternal == 0) {
						$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $sales_id);
						if ($result == 1) {
							$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
							array_push($valdiasi, $msg);
						} else {
							// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
							$msg = array("kode" => "3", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
							array_push($valdiasi, $msg);
						}
					}
				}
			} else {
				$msg = array("kode" => "5", "msg" => $depo_eksternal->depo_nama);
				array_push($valdiasi, $msg);
			}
		} else {
			$msg = array("kode" => "0", "msg" => "CAPTION-ALERT-SYNCSALESGAGAL");
			array_push($valdiasi, $msg);
		}

		// $valdiasi_uniq = array_unique($valdiasi);
		// rsort($valdiasi_uniq);
		// echo json_encode($valdiasi_uniq);
		echo json_encode($valdiasi);
	}

	public function Sync_all_sales_bosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$valdiasi = array();

		$sistem_eksternal = "BOSNET";
		$depo_eksternal = $this->M_SistemEksternal->Get_depo_eksternal($this->session->userdata('depo_id'), $sistem_eksternal)->depo_eksternal_kode;

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));

		$arr_list_sales = $this->M_SistemEksternal->Get_sales_from_bosnet_so($tgl, $depo_eksternal);

		// echo $depo_eksternal;

		// echo var_dump($arr_list_sales);

		if ($arr_list_sales != "0") {

			foreach ($arr_list_sales as $value) {
				$sales_id = $value['szSalesId'];
				$sales_bosnet = $this->M_SistemEksternal->Get_sales_bosnet_by_id($sales_id);
				$sales_nama = $sales_bosnet->karyawan_nama;
				$sales_bosnet_principle = $this->M_SistemEksternal->Get_sales_bosnet_principle_by_id($sales_id);
				$cek_sales_fas = $this->M_SistemEksternal->Check_sales_fas($sales_nama, $this->session->userdata('depo_id'));

				if ($sales_bosnet != "0") {

					if ($depo_eksternal != "") {

						if ($cek_sales_fas == 0) {
							$karyawan_id = $this->M_Vrbl->Get_NewID();
							$karyawan_id = $karyawan_id[0]['NEW_ID'];

							$insert_header = $this->M_SistemEksternal->Insert_karyawan($karyawan_id, $sales_bosnet);

							if ($insert_header > 0) {

								$this->M_SistemEksternal->Insert_karyawan_detail($karyawan_id, $sales_bosnet);

								foreach ($sales_bosnet_principle as $value) {
									$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
									// $principle_id = 0;

									if ($principle_id != "0") {

										$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

										if ($cek_sales_principle == 0) {
											$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
											if ($result == 1) {
												$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
												array_push($valdiasi, $msg);
											} else {
												// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
												$msg = array("kode" => "2", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
												array_push($valdiasi, $msg);
											}
										}
									} else {
										// $this->M_SistemEksternal->delete_client_pt($client_pt_id);
										$msg = array("kode" => "4", "msg" => $value['szCategory_1']);
										array_push($valdiasi, $msg);
									}
								}

								$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

								if ($cek_sales_principle_eksternal == 0) {
									$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $sales_id);
									if ($result == 1) {
										$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
										array_push($valdiasi, $msg);
									} else {
										// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
										$msg = array("kode" => "3", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
										array_push($valdiasi, $msg);
									}
								}
							} else {
								// echo $insert_header;
								$msg = array("kode" => "0", "msg" => "CAPTION-ALERT-SYNCSALESGAGAL");
								array_push($valdiasi, $msg);
							}
						} else {

							$karyawan_id = $this->M_SistemEksternal->Get_karyawan_id_by_nama($sales_nama, $this->session->userdata('depo_id'))->karyawan_id;

							foreach ($sales_bosnet_principle as $value) {
								$principle_id = $this->M_SistemEksternal->Get_principle_by_kode($value['szCategory_1']);
								// $principle_id = 0;

								if ($principle_id != "0") {

									$cek_sales_principle = $this->M_SistemEksternal->Check_karyawan_principle($karyawan_id, $principle_id);

									if ($cek_sales_principle == 0) {
										$result = $this->M_SistemEksternal->Insert_karyawan_principle($karyawan_id, $principle_id);
										if ($result == 1) {
											$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
											array_push($valdiasi, $msg);
										} else {
											// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
											$msg = array("kode" => "2", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEGAGAL");
											array_push($valdiasi, $msg);
										}
									}
								} else {
									// $this->M_SistemEksternal->delete_client_pt($client_pt_id);
									$msg = array("kode" => "4", "msg" => $value['szCategory_1']);
									array_push($valdiasi, $msg);
								}
							}

							$cek_sales_principle_eksternal = $this->M_SistemEksternal->Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal);

							if ($cek_sales_principle_eksternal == 0) {
								$result = $this->M_SistemEksternal->Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $sales_id);
								if ($result == 1) {
									$msg = array("kode" => "1", "msg" => "CAPTION-ALERT-SYNCSALESBERHASIL");
									array_push($valdiasi, $msg);
								} else {
									// $this->M_SistemEksternal->delete_client_pt_principle($client_pt_id, $principle_id);
									$msg = array("kode" => "3", "msg" => "CAPTION-ALERT-SYNCSALESPRINCIPLEEKSTERNALGAGAL");
									array_push($valdiasi, $msg);
								}
							}
						}
					} else {
						$msg = array("kode" => "5", "msg" => $depo_eksternal->depo_nama);
						array_push($valdiasi, $msg);
					}
				} else {
					$msg = array("kode" => "0", "msg" => "CAPTION-ALERT-SYNCSALESGAGAL");
					array_push($valdiasi, $msg);
				}
			}
		}

		$valdiasi_uniq = array_unique($valdiasi);
		rsort($valdiasi_uniq);
		echo json_encode($valdiasi_uniq);
		// echo json_encode($valdiasi);
	}

	public function Sync_area_bosnet()
	{
		ini_set('max_execution_time', 0);

		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$valdiasi = array();

		$area_id_new = $this->M_Vrbl->Get_NewID();
		$area_id_new = $area_id_new[0]['NEW_ID'];

		$client_pt_id = $this->input->post('client_pt_id');
		$szCustId = $this->input->post('szCustId');
		$szFSoId = $this->input->post('szFSoId');
		$szDeliveryGroupId = $this->input->post('szDeliveryGroupId');
		$area_id = $this->M_SistemEksternal->Get_area_by_kode($area_id_new, $szDeliveryGroupId);

		if ($client_pt_id != "") {

			$this->db->trans_begin();

			$this->M_SistemEksternal->update_area_customer($client_pt_id, $area_id);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();

				array_push($valdiasi, array("status" => 500, "kode" => $szCustId, "msg" => "CAPTION-ALERT-SYNCAREAFAILED"));
			} else {
				$this->db->trans_commit();

				array_push($valdiasi, array("status" => 200, "kode" => $szCustId, "msg" => "CAPTION-ALERT-SYNCAREASUCCESS"));
			}
		} else {
			array_push($valdiasi, array("status" => 404, "kode" => $szFSoId, "msg" => "CAPTION-ALERT-BELUMSYNCCUSTOMER"));
		}

		$result = array_map("unserialize", array_unique(array_map("serialize", $valdiasi)));
		echo json_encode($result);

		// $valdiasi_uniq = array_unique($valdiasi);
		// rsort($valdiasi_uniq);
		// echo json_encode($valdiasi_uniq);
		// echo json_encode($valdiasi);
	}

	function GetPrincipleByPerusahaan()
	{
		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$perusahaan = $this->input->get('perusahaan');

		$data = $this->M_SistemEksternal->GetPrincipleByPerusahaan($perusahaan);

		echo json_encode($data);
	}

	function proses_maping_so_eksternal_to_so_fas()
	{
		$this->load->model('FAS/M_SistemEksternal');
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');

		$this->load->model('M_Menu');
		if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
			echo 0;
			exit();
		}

		$tgl = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->post('tgl'))));
		$sistem_eksternal = "BOSNET";
		$tipe_sales_order_id = "D5A2AB04-0236-424D-859C-1888B46D6F50";
		$tipe_delivery_order_id = "ADF55030-9802-4C27-9658-F9D37AA01F95";

		$depo_id = $this->session->userdata('depo_id');
		$pengguna_username = $this->session->userdata('pengguna_username');

		$data = $this->M_SistemEksternal->proses_maping_so_eksternal_to_so_fas($tgl, $depo_id, $sistem_eksternal, $tipe_sales_order_id, $tipe_delivery_order_id, $pengguna_username);

		echo json_encode($data);
	}
}
