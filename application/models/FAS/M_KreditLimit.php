<?php

class M_KreditLimit extends CI_Model
{
	public function getDepoPrefix($depo_id)
	{
		$prefix = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $prefix->row();
	}
	public function getListPelanggan()
	{
		$arrAreaId = [null];
		// Header('Content-Type: application/json');
		// cek apa ada area di depo itu
		if ($this->session->userdata('area')['area_id'] != 0) {
			# code...
			$arrAreaId = [];
			foreach ($this->session->userdata('area')['area_id'] as $key => $value) {
				# code...
				array_push($arrAreaId, $value['area_id']);
			}
			// $query = $this->db->select("*")->from("client_pt")->where("client_pt_is_aktif", 1)->where_in('area_id', $arrAreaId)->get();
		}
		$query = $this->db->select("*")->from("client_pt")->where("client_pt_is_aktif", 1)->where_in('area_id', $arrAreaId)->get();
		// }


		// return $arrAreaId;
		return $query->result_array();
	}
	public function getPelangganByCorporateId($client_pt_corporate_id)
	{
		$query = $this->db->select("*")
			->from("client_pt")
			->where("client_pt_is_aktif", 1)
			->where("client_pt_corporate_id", $client_pt_corporate_id)
			->get();
		return $query->result_array();
	}

	public function getDataSearch($filter_status, $tgl1, $tgl2)
	{
		if ($filter_status != null) {
			$data = $this->db->select("
					pengajuan_kredit.*,
					FORMAT(pengajuan_kredit.pengajuan_kredit_tgl_create, 'yyyy-MM-dd') AS tgl_pengajuan,
				")
				->from('pengajuan_kredit')
				->join("client_pt cp", "cp.client_pt_id = pengajuan_kredit.client_pt_id", "left")
				->where('pengajuan_kredit.pengajuan_kredit_status', $filter_status)
				->where("FORMAT(pengajuan_kredit.pengajuan_kredit_tgl_create, 'yyyy-MM-dd') BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
				->where('depo_id',  $this->session->userdata('depo_id'))
				->order_by('pengajuan_kredit.pengajuan_kredit_tgl_create', 'ASC')
				->get();
			# code...
		} else {
			$data = $this->db->select("
					pengajuan_kredit.*,
					FORMAT(pengajuan_kredit.pengajuan_kredit_tgl_create, 'yyyy-MM-dd') AS tgl,
					cp.client_pt_nama as pelanggan_nama,
					cp.client_pt_alamat as pelanggan_alamat
				")
				->from('pengajuan_kredit')
				->join("client_pt cp", "cp.client_pt_id = pengajuan_kredit.client_pt_id", "left")
				// ->where('pengajuan_kredit.pengajuan_kredit_status', $filter_status)
				->where("FORMAT(pengajuan_kredit.pengajuan_kredit_tgl_create, 'yyyy-MM-dd') BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'")
				->where('depo_id',  $this->session->userdata('depo_id'))
				->order_by('pengajuan_kredit.pengajuan_kredit_tgl_create', 'ASC')
				->get();
		}
		return $data->result_array();
	}

	public function getKreditLimitByKode($kredit_limit_kode)
	{
		$query = $this->db->select("
				pengajuan_kredit.*,
				FORMAT(pengajuan_kredit.pengajuan_kredit_tgl_create, 'yyyy-MM-dd') AS tgl,
				cp.client_pt_nama as pelanggan_nama,
				cp.client_pt_alamat as pelanggan_alamat
			")
			->from('pengajuan_kredit')
			->join("client_pt cp", "cp.client_pt_id = pengajuan_kredit.client_pt_id", "left")
			->where("pengajuan_kredit_kode", $kredit_limit_kode)
			->where('depo_id',  $this->session->userdata('depo_id'))
			->get();
		return $query->row();
	}
	public function getKreditLimitDetailById($kredit_limit_id)
	{
		$query = $this->db->select("
				dtl.*,
				principle.principle_kode,
				cp.client_pt_alamat as alamat_penagihan,
				cs1.client_pt_segmen_nama as nama_segmen1,
				cs2.client_pt_segmen_nama as nama_segmen2,
				cs3.client_pt_segmen_nama as nama_segmen3
			")
			->from('pengajuan_kredit_detail dtl')
			->join("client_pt cp", "cp.client_pt_id = dtl.client_pt_id_penagihan", "left")
			->join("principle", "principle.principle_id = dtl.principle_id", "left")
			->join('client_pt_segmen cs1', 'cs1.client_pt_segmen_id = dtl.client_pt_segmen_id1', 'left')
			->join('client_pt_segmen cs2', 'cs2.client_pt_segmen_id = dtl.client_pt_segmen_id2', 'left')
			->join('client_pt_segmen cs3', 'cs3.client_pt_segmen_id = dtl.client_pt_segmen_id3', 'left')
			->where("pengajuan_kredit_id", $kredit_limit_id)

			->get();
		return $query->result_array();
	}
	public function getAlamatPelangganById($pelanggan_id)
	{
		// $this->load->database('backend', TRUE);
		$query = $this->db->select("pt.client_pt_alamat as alamat,
				pt.client_pt_corporate_id,
				ptc.client_pt_corporate_nama,
				cs1.client_pt_segmen_nama as nama_segmen1,
				cs2.client_pt_segmen_nama as nama_segmen2,
				cs3.client_pt_segmen_nama as nama_segmen3,
				ISNULL(SUM(ptd.client_pt_detail_pengiriman),0) as count_pengiriman,
				ISNULL(SUM(ptd.client_pt_detail_penagihan),0) as count_penagihan")
			->from("client_pt pt")
			->join('client_pt_detail ptd', 'ptd.client_pt_id = pt.client_pt_id')
			->join('client_pt_corporate ptc', 'ptc.client_pt_corporate_id = pt.client_pt_corporate_id', 'left')
			->join('client_pt_segmen cs1', 'cs1.client_pt_segmen_id = pt.client_pt_segmen_id1', 'left')
			->join('client_pt_segmen cs2', 'cs2.client_pt_segmen_id = pt.client_pt_segmen_id2', 'left')
			->join('client_pt_segmen cs3', 'cs3.client_pt_segmen_id = pt.client_pt_segmen_id3', 'left')
			->where("pt.client_pt_id", $pelanggan_id)
			->where("client_pt_is_aktif", 1)
			->group_by('pt.client_pt_alamat')
			->group_by('pt.client_pt_corporate_id')
			->group_by('ptc.client_pt_corporate_nama')
			->group_by('cs1.client_pt_segmen_nama')
			->group_by('cs2.client_pt_segmen_nama')
			->group_by('cs3.client_pt_segmen_nama')
			->get();
		return $query->row();
	}

	public function getDataPrinciple()
	{

		$query = $this->db->select("principle_kode,principle_id")
			->from("principle")
			->where("principle_is_aktif", 1)
			->order_by('principle_kode')
			->get();
		return $query->result_array();
	}
	public function getDataClientSegmen1()
	{
		$query = $this->db->select("*")
			->from("client_pt_segmen")
			->where("client_pt_segmen_level", 1)
			->where("client_pt_segmen_is_aktif", 1)
			->get();
		return $query->result_array();
	}
	public function getDataClientSegmen2($reff_id)
	{
		if ($reff_id == null) {
			# code...
			$query = $this->db->select("*")
				->from("client_pt_segmen")
				->where("client_pt_segmen_level", 2)
				->where("client_pt_segmen_is_aktif", 1)
				->get();
		} else {

			$query = $this->db->select("*")
				->from("client_pt_segmen")
				->where("client_pt_segmen_reff_id", $reff_id)
				->where("client_pt_segmen_level", 2)
				->where("client_pt_segmen_is_aktif", 1)
				->get();
		}
		return $query->result_array();
	}
	public function getDataClientSegmen3($reff_id)
	{
		if ($reff_id == null) {
			$query = $this->db->select("*")
				->from("client_pt_segmen")
				->where("client_pt_segmen_level", 3)
				->where("client_pt_segmen_is_aktif", 1)
				->get();
		} else {
			$query = $this->db->select("*")
				->from("client_pt_segmen")
				->where("client_pt_segmen_reff_id", $reff_id)
				->where("client_pt_segmen_level", 3)
				->where("client_pt_segmen_is_aktif", 1)
				->get();
		}
		return $query->result_array();
	}

	public function getPelangganPrincipleById($pelanggan_id)
	{
		// $db2 = $this->load->database('backend', TRUE);

		$query = $this->db->select("cp.*,principle.principle_kode,ct.client_pt_alamat,
				cs1.client_pt_segmen_nama as nama_segmen1,
				cs2.client_pt_segmen_nama as nama_segmen2,
				cs3.client_pt_segmen_nama as nama_segmen3
			")
			->from("client_pt_principle cp")
			// ->join('client_pt pt', 'pt.client_pt_id = cp.client_pt_id')
			->join('principle', 'principle.principle_id = cp.principle_id', 'left')
			->join('client_pt ct', 'ct.client_pt_id = cp.client_pt_id_penagihan', 'left')
			->join('client_pt_segmen cs1', 'cs1.client_pt_segmen_id = cp.client_pt_segment_id1', 'left')
			->join('client_pt_segmen cs2', 'cs2.client_pt_segmen_id = cp.client_pt_segment_id2', 'left')
			->join('client_pt_segmen cs3', 'cs3.client_pt_segmen_id = cp.client_pt_segment_id3', 'left')
			->where("cp.client_pt_id", $pelanggan_id)
			->get();

		return $query->result_array();
	}

	public function SaveKreditLimit($pengajuan_kredit_kode, $client_pt_id, $pengajuan_kredit_status, $pengajuan_kredit_keterangan, $dataDetail)
	{
		$this->db->trans_start();
		$newID1 = $this->M_Function->Get_NewID();
		$newID = $newID1[0]['kode'];


		$this->db->set('pengajuan_kredit_id', $newID);
		$this->db->set('pengajuan_kredit_kode', $pengajuan_kredit_kode);
		$this->db->set('pengajuan_kredit_status', $pengajuan_kredit_status);
		$this->db->set('pengajuan_kredit_keterangan', $pengajuan_kredit_keterangan);
		$this->db->set('client_pt_id', $client_pt_id);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('pengajuan_kredit_tgl_create', "GETDATE()", FALSE);
		$this->db->set('pengajuan_kredit_who_create', $this->session->userdata('pengguna_username'));
		$this->db->insert('pengajuan_kredit');

		foreach ($dataDetail as $key => $value) {
			$client_pt_penagihan = $value['alamat_penagihan_id'] == '' ? null : $value['alamat_penagihan_id'];
			$this->db->set('pengajuan_kredit_detail_id', 'NEWID()', false);
			$this->db->set('pengajuan_kredit_id', $newID);
			$this->db->set('principle_id', $value['principle_id']);
			$this->db->set('pengajuan_kredit_top', $value['top']);
			$this->db->set('pengajuan_kredit_limit', $value['kredit_limit']);
			$this->db->set('pengajuan_kredit_maks_invoice', $value['max_invoice']);
			$this->db->set('pengajuan_kredit_is_alamat_penagihan_beda', $value['is_alamat_beda']);
			$this->db->set('client_pt_id_penagihan', $value['is_alamat_beda'] == 0 ? $client_pt_id :  $client_pt_penagihan);
			$this->db->set('client_pt_segmen_id1', $value['segment1'] == '' ? null : $value['segment1']);
			$this->db->set('client_pt_segmen_id2', $value['segment2'] == '' ? null : $value['segment2']);
			$this->db->set('client_pt_segmen_id3', $value['segment3'] == '' ? null : $value['segment3']);
			$this->db->set('is_kredit', $value['is_kredit']);
			$this->db->insert('pengajuan_kredit_detail');
		}
		//cek apa status nya in progress approval
		if ($pengajuan_kredit_status == 'In progress approval') {
			# code...
			// exec prosedure approval pengajuan
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where approval_setting_jenis = 'Pengajuan Kredit dan Limit Kredit') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
							exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $newID . "','" . $pengajuan_kredit_kode . "', 0, 0
				");
			$h = $queryProsedure->result_array();

			$ha = $h[0]['ErrMsg'];
			// $ha = $queryProsedure;
			if ($ha != '') {
				$this->db->trans_rollback();
				return $ha;
			}
		}

		// $this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			// return $this->db->error();
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();

		return 1;
	}

	public function UpdateKreditLimit($pengajuan_kredit_kode, $pengajuan_kredit_id, $client_pt_id, $pengajuan_kredit_status, $pengajuan_kredit_keterangan, $dataDetail)
	{
		$this->db->trans_start();


		$this->db->set('pengajuan_kredit_status', $pengajuan_kredit_status);
		$this->db->set('pengajuan_kredit_keterangan', $pengajuan_kredit_keterangan);
		$this->db->where('pengajuan_kredit_kode', $pengajuan_kredit_kode);
		$this->db->update('pengajuan_kredit');
		// call prosedure
		// $queryProsedure = $this->db->query("
		// 	exec kalender_tambah '" . $newID . "'
		// ");
		$this->db->where('pengajuan_kredit_id', $pengajuan_kredit_id);
		$this->db->delete('pengajuan_kredit_detail');

		foreach ($dataDetail as $key => $value) {
			$client_pt_penagihan = $value['alamat_penagihan_id'] == '' ? null : $value['alamat_penagihan_id'];
			$this->db->set('pengajuan_kredit_detail_id', 'NEWID()', false);
			$this->db->set('pengajuan_kredit_id', $pengajuan_kredit_id);
			$this->db->set('principle_id', $value['principle_id']);
			$this->db->set('pengajuan_kredit_top', $value['top']);
			$this->db->set('pengajuan_kredit_limit', $value['kredit_limit']);
			$this->db->set('pengajuan_kredit_maks_invoice', $value['max_invoice']);
			$this->db->set('pengajuan_kredit_is_alamat_penagihan_beda', $value['is_alamat_beda']);
			$this->db->set('client_pt_id_penagihan', $value['is_alamat_beda'] == 0 ? $client_pt_id :  $client_pt_penagihan);
			$this->db->set('client_pt_segmen_id1', $value['segment1'] == '' ? null : $value['segment1']);
			$this->db->set('client_pt_segmen_id2', $value['segment2'] == '' ? null : $value['segment2']);
			$this->db->set('client_pt_segmen_id3', $value['segment3'] == '' ? null : $value['segment3']);
			$this->db->set('is_kredit', $value['is_kredit']);
			$this->db->insert('pengajuan_kredit_detail');
		}
		//cek apa status nya in progress approval
		if ($pengajuan_kredit_status == 'In progress approval') {
			# code...
			// exec prosedure approval pengajuan
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where approval_setting_jenis = 'Pengajuan Kredit dan Limit Kredit') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
							exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $pengajuan_kredit_id . "','" . $pengajuan_kredit_kode . "', 0, 0
				");
			$h = $queryProsedure->result_array();

			$ha = $h[0]['ErrMsg'];
			// $ha = $queryProsedure;
			if ($ha != '') {
				$this->db->trans_rollback();
				return $ha;
			}
		}

		// $this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			// return $this->db->error();
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();

		return 1;
	}
}