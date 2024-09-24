<?php

class M_Anggaran extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
	}
	public function getDepoPrefix($depo_id)
	{
		$prefix = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $prefix->row();
	}
	public function getAnggaranByKode($kode)
	{
		$data = $this->db->select("*")
			->from('anggaran')
			->where('anggaran_kode', $kode)
			->get();
		return $data->row();
	}
	//old
	// public function GetPerusahaan()
	// {
	// 	$query = $this->db->query("SELECT * FROM client_wms 
	// 								WHERE client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
	// 								ORDER BY client_wms_nama ASC");

	// 	if ($query->num_rows() == 0) {
	// 		$query = 0;
	// 	} else {
	// 		$query = $query->result_array();
	// 	}

	// 	return $query;
	// }
	public function GetPerusahaan()
	{
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		if ($is_dewa > 0) {

			// $client = "where client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)";
			$query = $this->db->query("SELECT * FROM client_wms 
									ORDER BY client_wms_nama ASC");
			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result_array();
			}
		} else {

			if ($this->session->userdata('client_wms_id') == '') {
				$query = 0;
			} else {
				$client = "where client_wms_id= '" . $this->session->userdata('client_wms_id') . "'";
				$query = $this->db->query("SELECT * FROM client_wms 
								" . $client . "
									ORDER BY client_wms_nama ASC");
				if ($query->num_rows() == 0) {
					$query = 0;
				} else {
					$query = $query->result_array();
				}
			}
		}
		return $query;
	}

	public function getAnggaranDetailByKode($kode)
	{
		$data = $this->db->select("anggaran_detail.*,anggaran.anggaran_kode,anggaran.anggaran_tahun,anggaran.anggaran_jumlah_level")
			->from('anggaran_detail')
			->join('anggaran', 'anggaran_detail.anggaran_id = anggaran.anggaran_id')
			->where('anggaran_detail.anggaran_detail_kode', $kode)
			// ->where('depo_id',  $this->session->userdata('depo_id'))
			->get();
		return $data->row();
	}

	public function getListDetail2AnggaranById($anggaran_detail_id)
	{
		$data = $this->db->select("anggaran_detail_2.*")
			->from('anggaran_detail_2')
			->where('anggaran_detail_2.anggaran_detail_id', $anggaran_detail_id)
			// ->where('depo_id',  $this->session->userdata('depo_id'))
			->order_by('anggaran_detail_2_kode')
			->order_by('anggaran_detail_2_level', 'DESC')
			->get();
		return $data->result_array();
	}

	public function getListDetail3AnggaranById($anggaran_detail_2_id)
	{
		$data = $this->db->select("anggaran_detail_3.*")
			->from('anggaran_detail_3')
			->where('anggaran_detail_3.anggaran_detail_2_id', $anggaran_detail_2_id)
			// ->where('depo_id',  $this->session->userdata('depo_id'))
			->order_by('anggaran_detail_3_urut_bulan')
			->get();
		return $data->result_array();
	}

	public function getAnggaranById($id)
	{
		$data = $this->db->select("*")
			->from('anggaran')
			->where('anggaran_id', $id)
			->get();
		return $data->row();
	}
	public function getDataAnggaranSearch($anggaran_tahun, $perusahaan)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = " AND anggaran.client_wms_id = '$perusahaan' ";
		}

		if ($anggaran_tahun == "") {
			$anggaran_tahun = "";
		} else {
			$anggaran_tahun = " AND anggaran.anggaran_tahun = '$anggaran_tahun' ";
		}
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		if ($is_dewa > 0) {
			$data = $this->db->query("SELECT 
							anggaran.anggaran_id,
							anggaran.client_wms_id,
							anggaran.anggaran_kode,
							anggaran.anggaran_tahun,
							anggaran.anggaran_tgl_create,
							anggaran.anggaran_who_create,
							client_wms.client_wms_nama,
							COUNT(anggaran_detail.anggaran_detail_status) AS count_detail
							FROM anggaran
							LEFT JOIN anggaran_detail
							ON anggaran_detail.anggaran_id = anggaran.anggaran_id
							left join client_wms on client_wms.client_wms_id = anggaran.client_wms_id
							WHERE anggaran.depo_id = '" . $this->session->userdata('depo_id') . "'
							
							" . $anggaran_tahun . "
							" . $perusahaan . "
							GROUP BY anggaran.anggaran_id,
							anggaran.client_wms_id,
									anggaran.anggaran_kode,
									anggaran.anggaran_tahun,
									anggaran.anggaran_tgl_create,
									anggaran.anggaran_who_create,
									client_wms.client_wms_nama
							ORDER BY anggaran.anggaran_kode ASC
		");
		} else {
			if ($this->session->userdata('client_wms_id') == '') {
				$data = 0;
			} else {
				$data = $this->db->query("SELECT 
							anggaran.anggaran_id,
							anggaran.client_wms_id,
							anggaran.anggaran_kode,
							anggaran.anggaran_tahun,
							anggaran.anggaran_tgl_create,
							anggaran.anggaran_who_create,
							client_wms.client_wms_nama,
							COUNT(anggaran_detail.anggaran_detail_status) AS count_detail
							FROM anggaran
							LEFT JOIN anggaran_detail
							ON anggaran_detail.anggaran_id = anggaran.anggaran_id
							left join client_wms on client_wms.client_wms_id = anggaran.client_wms_id
							WHERE anggaran.depo_id = '" . $this->session->userdata('depo_id') . "'
							and anggaran.client_wms_id='" . $this->session->userdata('client_wms_id') . "'
							GROUP BY anggaran.anggaran_id,
							anggaran.client_wms_id ,
									anggaran.anggaran_kode,
									anggaran.anggaran_tahun,
									anggaran.anggaran_tgl_create,
									anggaran.anggaran_who_create,
							client_wms.client_wms_nama
							ORDER BY anggaran.anggaran_kode ASC
		");
			}
		}
		// if ($this->session->userdata('client_wms_id') == '') {
		// }
		// $data = $this->db->query("SELECT 
		// 					anggaran.anggaran_id,
		// 					anggaran.client_wms_id,
		// 					anggaran.anggaran_kode,
		// 					anggaran.anggaran_tahun,
		// 					anggaran.anggaran_tgl_create,
		// 					anggaran.anggaran_who_create,
		// 					COUNT(anggaran_detail.anggaran_detail_status) AS count_detail
		// 					FROM anggaran
		// 					LEFT JOIN anggaran_detail
		// 					ON anggaran_detail.anggaran_id = anggaran.anggaran_id
		// 					WHERE anggaran.depo_id = '" . $this->session->userdata('depo_id') . "'

		// 					" . $anggaran_tahun . "
		// 					" . $perusahaan . "
		// 					GROUP BY anggaran.anggaran_id,
		// 					anggaran.client_wms_id,
		// 							anggaran.anggaran_kode,
		// 							anggaran.anggaran_tahun,
		// 							anggaran.anggaran_tgl_create,
		// 							anggaran.anggaran_who_create
		// 					ORDER BY anggaran.anggaran_kode ASC
		// ");

		return $data->result_array();
		// return $this->db->last_query();
	}

	public function getListDetail($anggaran_id)
	{
		$data = $this->db->select("anggaran_detail.*,anggaran.anggaran_kode,anggaran.anggaran_tahun")
			->from('anggaran_detail')
			->join('anggaran', 'anggaran_detail.anggaran_id = anggaran.anggaran_id')
			->where('anggaran_detail.anggaran_id', $anggaran_id)
			->order_by('anggaran_detail.anggaran_detail_tgl_create', 'DESC')
			// ->where('depo_id',  $this->session->userdata('depo_id'))
			->get();
		return $data->result_array();
	}

	public function SaveAnggaran($data)
	{
		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_IDBA';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo;
		$depoPrefix = $this->getDepoPrefix($this->session->userdata('depo_id'));
		$unit = $depoPrefix->depo_kode_preffix;
		$generate_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$this->db->set('anggaran_id', "NewID()", FALSE);
		$this->db->set('anggaran_kode', $generate_kode);
		$this->db->set('anggaran_tahun', $data["anggaran_tahun"]);
		$this->db->set('anggaran_jumlah_level', $data["anggaran_jumlah_level"]);
		$this->db->set('client_Wms_id', $data["perusahaan"]);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('anggaran_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('anggaran_tgl_create', "GETDATE()", FALSE);
		$this->db->insert('anggaran');

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			return 0;
		}
		return 1;
	}
	public function SaveAnggaranDetail($data, $detail2, $detail3)
	{
		$this->db->trans_start();

		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_DBA';

		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		// $depo_id = $this->session->userdata('depo_id');
		$depoPrefix = $this->getDepoPrefix($this->session->userdata('depo_id'));
		$unit = $depoPrefix->depo_kode_preffix;
		$generate_kode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$this->db->set('anggaran_id', $data["anggaran_id"]);
		$this->db->set('anggaran_detail_id', $data["anggaran_detail_id"]);
		$this->db->set('anggaran_detail_kode', $generate_kode);
		$this->db->set('anggaran_detail_status', $data["anggaran_detail_status"]);
		$this->db->set('anggaran_detail_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('anggaran_detail_tgl_create', "GETDATE()", FALSE);
		$this->db->insert('anggaran_detail');

		//idetail 2
		foreach ($detail2 as $key => $value) {
			$newIDDet = $this->M_Function->Get_NewID();
			$anggaran_detail_2_id = $newIDDet[0]['kode'];

			$kodeAnggaran2 = $value["kode_anggaran"];

			$this->db->set('anggaran_detail_2_id', $anggaran_detail_2_id);
			$this->db->set('anggaran_detail_id', $data["anggaran_detail_id"]);
			$this->db->set('anggaran_id', $data["anggaran_id"]);
			$this->db->set('anggaran_detail_2_level', $value["level"]);
			$this->db->set('anggaran_detail_2_kode', $value["kode_anggaran"]);
			$this->db->set('anggaran_detail_2_nama_anggaran', $value["nama_anggaran"]);
			$this->db->set('anggaran_detail_2_budget', $value["budget"]);
			$this->db->set('anggaran_detail_2_alokasi', $value["alokasi"]);
			$this->db->set('anggaran_detail_2_terpakai', $value["terpakai"]);
			$this->db->set('anggaran_detail_2_sisa', $value["alokasi"] - $value["terpakai"]);
			$this->db->set('anggaran_detail_2_reff_kode', $value["reff_kode"]);
			$this->db->set('anggaran_detail_2_is_unlimited', $value["unlimit"] == "true" ? 1 : ($value["unlimit"] == 1 ? 1 : 0));
			$this->db->insert('anggaran_detail_2');

			foreach ($detail3 as $key => $item) {

				$kodeAnggaran3 = $item["kode_anggaran"];
				// cek apakah anggaran sama dengan di detail 2
				if ($kodeAnggaran3 == $kodeAnggaran2) {
					// insert budget bulanan
					foreach ($item["budget"] as $key => $value) {
						# code...
						$newIDDet2 = $this->M_Function->Get_NewID();
						$anggaran_detail_3_id = $newIDDet2[0]['kode'];
						$this->db->set('anggaran_detail_3_id', $anggaran_detail_3_id);
						$this->db->set('anggaran_detail_2_id', $anggaran_detail_2_id);
						$this->db->set('anggaran_detail_id', $data["anggaran_detail_id"]);
						$this->db->set('anggaran_id', $data["anggaran_id"]);
						$this->db->set('anggaran_detail_3_urut_bulan', $value["bulan"]);
						$this->db->set('anggaran_detail_3_nama_bulan', $value["nama_bulan"]);
						$this->db->set('anggaran_detail_3_jumlah', $value["qty"]);
						$this->db->insert('anggaran_detail_3');
					}
				}
			}
		}

		$ha = '';
		// call prosedure add aprobval jika status in progress approval
		if ($data["anggaran_detail_status"] == 'In progress approval') {
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '110003000' and approval_setting_jenis = 'Budget Anggaran Tahunan') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
						exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" .  $data["anggaran_detail_id"] . "','" . $generate_kode . "', 0, 0
			");
			// $queryProsedure = $this->db->query("
			// 			exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $data["anggaran_detail_id"] . "','" . $generate_kode . "', 0, 0
			// ");
			$h = $queryProsedure->result_array();

			$ha = $h[0]['ErrMsg'];
			// $ha = $queryProsedure;
			if ($ha != '') {
				// return 'asss';
				$this->db->trans_rollback();
				// echo $ha;
				return $ha;
			}
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.

			$this->db->trans_rollback();
			// echo 0;
			return 0;
		}

		$this->db->trans_commit();
		// echo 1;
		return 1;
	}

	public function UpdateAnggaranDetail($anggaran_detail_id, $anggaran_detail_kode, $data, $detail2, $detail3)
	{
		// return 2;
		$this->db->trans_start();
		// update status detail
		$this->db->set('anggaran_detail_status', $data["anggaran_detail_status"]);
		$this->db->where('anggaran_detail_id', $anggaran_detail_id);
		$this->db->update('anggaran_detail');

		//delete data detail 2 sebelumnya
		$this->db->where('anggaran_detail_id', $anggaran_detail_id);
		$this->db->delete('anggaran_detail_2');
		//delete data detail 3 sebelumnya
		$this->db->where('anggaran_detail_id', $anggaran_detail_id);
		$this->db->delete('anggaran_detail_3');

		//add detail baru
		foreach ($detail2 as $key => $value) {
			$newIDDet = $this->M_Function->Get_NewID();
			$anggaran_detail_2_id = $newIDDet[0]['kode'];

			$kodeAnggaran2 = $value["kode_anggaran"];

			$this->db->set('anggaran_detail_2_id', $anggaran_detail_2_id);
			$this->db->set('anggaran_detail_id', $anggaran_detail_id);
			$this->db->set('anggaran_id', $data["anggaran_id"]);
			$this->db->set('anggaran_detail_2_level', $value["level"]);
			$this->db->set('anggaran_detail_2_kode', $value["kode_anggaran"]);
			$this->db->set('anggaran_detail_2_nama_anggaran', $value["nama_anggaran"]);
			$this->db->set('anggaran_detail_2_budget', $value["budget"]);
			$this->db->set('anggaran_detail_2_alokasi', $value["alokasi"]);
			$this->db->set('anggaran_detail_2_terpakai', $value["terpakai"]);
			$this->db->set('anggaran_detail_2_sisa', $value["alokasi"] - $value["terpakai"]);
			$this->db->set('anggaran_detail_2_reff_kode', $value["reff_kode"]);
			$this->db->set('anggaran_detail_2_is_unlimited', $value["unlimit"] == "true" ? 1 : ($value['unlimit'] == 1 ? 1 : 0));
			$this->db->insert('anggaran_detail_2');

			foreach ($detail3 as $key => $item) {

				$kodeAnggaran3 = $item["kode_anggaran"];
				// cek apakah anggaran sama dengan di detail 2
				if ($kodeAnggaran3 == $kodeAnggaran2) {
					// insert budget bulanan
					foreach ($item["budget"] as $key => $value) {
						# code...
						$newIDDet2 = $this->M_Function->Get_NewID();
						$anggaran_detail_3_id = $newIDDet2[0]['kode'];
						$this->db->set('anggaran_detail_3_id', $anggaran_detail_3_id);
						$this->db->set('anggaran_detail_2_id', $anggaran_detail_2_id);
						$this->db->set('anggaran_detail_id', $anggaran_detail_id);
						$this->db->set('anggaran_id', $data["anggaran_id"]);
						$this->db->set('anggaran_detail_3_urut_bulan', $value["bulan"]);
						$this->db->set('anggaran_detail_3_nama_bulan', $value["nama_bulan"]);
						$this->db->set('anggaran_detail_3_jumlah', $value["qty"]);
						$this->db->insert('anggaran_detail_3');
					}
				}
			}
		}

		$ha = '';
		// call prosedure add aprobval jika status in progress approval
		if ($data["anggaran_detail_status"] == 'In progress approval') {
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '110003000' and approval_setting_jenis = 'Budget Anggaran Tahunan') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
						exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $anggaran_detail_id . "','" . $anggaran_detail_kode . "', 0, 0
			");
			$h = $queryProsedure->result_array();

			$ha = $h[0]['ErrMsg'];
			// $ha = $queryProsedure;
			if ($ha != '') {
				// return 'asss';
				$this->db->trans_rollback();
				// echo $ha;
				return $ha;
			}
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.

			$this->db->trans_rollback();
			// echo 0;
			return 0;
		}

		$this->db->trans_commit();
		// echo 1;
		return 1;
	}
}
