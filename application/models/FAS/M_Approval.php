<?php

class M_Approval extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
	}

	public function ApprovalProses($dataAcc, $dataReject)
	{
		$this->db->trans_start();
		// data yg di approv
		if ($dataAcc) {
			# code...
			foreach ($dataAcc as $key => $value) {
				$queryProsedure = $this->db->query("
							exec approval_proses '" . $value["approval_id"] . "', '" . $this->session->userdata('karyawan_id') . "', 1, '" . $value["approval_keterangan"] . "'
				");
			}
		}
		// data yg di reject
		if ($dataReject) {
			# code...
			foreach ($dataReject as $key => $value) {
				$queryProsedure = $this->db->query("
							exec approval_proses '" . $value["approval_id"] . "', '" . $this->session->userdata('karyawan_id') . "', 0, '" . $value["approval_keterangan"] . "'
				");
			}
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			return 0;
		}

		return 1;
	}

	public function getOutstandingApproval($perusahaan)
	{

		$arrGroup = [];
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$karyawan_id = $this->session->userdata('karyawan_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();
		$dataGroup = $this->db->query("SELECT b.approval_group_id from approval_group a LEFT JOIN approval_group_detail b on b.approval_group_id = a.approval_group_id where b.karyawan_id = '$karyawan_id'")->result_array();
		foreach ($dataGroup as $key => $value) {
			// array_push($arrGroup, $value['approval_group_id']);
			$arrGroup[$key] = "'" . $value['approval_group_id'] . "'";
		}
		// var_dump($dataGroup);
		$list = implode(", ", $arrGroup);
		// die;

		if ($is_dewa > 0) {
			if ($perusahaan == '') {
				$data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,COUNT(apv1.approval_id) as jumlah")
					->from('approval_setting apv')
					->join('approval as apv1', "apv1.approval_setting_id = apv.approval_setting_id AND apv1.approval_status = 'In progress' AND apv1.depo_id = '" . $this->session->userdata('depo_id') . "'", 'left')
					// ->join('approval as apv2', "apv2.approval_setting_id = apv.approval_setting_id AND apv2.approval_status = 'In progress' AND apv2.depo_id = '" . $this->session->userdata('depo_id') . "'", 'left')
					->where('apv.depo_id',  $this->session->userdata('depo_id'))
					->where('apv.approval_setting_is_aktif', 1)

					// ->where('anggaran_detail.anggaran_detail_kode', $kode)
					->group_by('apv.approval_setting_id')
					->group_by('apv.approval_setting_keterangan')
					->group_by('apv.approval_setting_jenis')
					->order_by('COUNT(apv1.approval_id)', 'asc')
					->order_by('approval_setting_jenis', 'asc')
					->get();
			} else {
				$data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,COUNT(apv1.approval_id) as jumlah")
					->from('approval_setting apv')
					->join('approval as apv1', "apv1.approval_setting_id = apv.approval_setting_id AND apv1.approval_status = 'In progress' AND apv1.depo_id = '" . $this->session->userdata('depo_id') . "'", 'left')
					// ->join('approval as apv2', "apv2.approval_setting_id = apv.approval_setting_id AND apv2.approval_status = 'In progress' AND apv2.depo_id = '" . $this->session->userdata('depo_id') . "'", 'left')
					->where('apv.depo_id',  $this->session->userdata('depo_id'))
					->where('apv.client_wms_id', $perusahaan)
					->where('apv.approval_setting_is_aktif', 1)

					// ->where('anggaran_detail.anggaran_detail_kode', $kode)
					->group_by('apv.approval_setting_id')
					->group_by('apv.approval_setting_keterangan')
					->group_by('apv.approval_setting_jenis')
					->order_by('COUNT(apv1.approval_id)', 'asc')
					->order_by('approval_setting_jenis', 'asc')
					->get();
			}
		} else {
			if ($this->session->userdata('client_wms_id') == '') {
				echo json_encode(0);
				die;
			} else {
				// $data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,(COUNT(apv1.approval_id)+COUNT(apv2.approval_id)) as jumlah")
				$data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,COUNT(apv1.approval_id) as jumlah")
					->from('approval_setting apv')
					->join('approval as apv1', "apv1.approval_setting_id = apv.approval_setting_id AND apv1.approval_status = 'In progress' AND apv1.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv1.approval_group_id in ($list)", 'left')
					// ->join('approval as apv2', "apv2.approval_setting_id = apv.approval_setting_id AND apv2.approval_status = 'In progress' AND apv2.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv2.approval_is_direct_spv = 1 AND apv2.approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'", 'left')
					->where('apv.depo_id',  $this->session->userdata('depo_id'))
					->where('apv.client_wms_id',  $this->session->userdata('client_wms_id'))
					->where('apv.approval_setting_is_aktif', 1)
					// ->where('anggaran_detail.anggaran_detail_kode', $kode)
					->group_by('apv.approval_setting_id')
					->group_by('apv.approval_setting_keterangan')
					->group_by('apv.approval_setting_jenis')
					->order_by('COUNT(apv1.approval_id)', 'asc')
					// ->order_by('COUNT(apv1.approval_id)+COUNT(apv2.approval_id)', 'asc')
					->order_by('approval_setting_jenis', 'asc')
					->get();
			}
		}
		// if ($this->session->userdata('pengguna_grup_id') == '' || $this->session->userdata('client_wms_id') == null) {
		// 	$data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,(COUNT(apv1.approval_id)+COUNT(apv2.approval_id)) as jumlah")
		// 		->from('approval_setting apv')
		// 		->join('approval as apv1', "apv1.approval_setting_id = apv.approval_setting_id AND apv1.approval_status = 'In progress' AND apv1.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv1.approval_is_direct_spv = 0 AND apv1.approval_level_id = '" . $this->session->userdata('karyawan_level_id') . "' AND apv1.approval_divisi_id = '" . $this->session->userdata('karyawan_divisi_id') . "'", 'left')
		// 		->join('approval as apv2', "apv2.approval_setting_id = apv.approval_setting_id AND apv2.approval_status = 'In progress' AND apv2.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv2.approval_is_direct_spv = 1 AND apv2.approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'", 'left')
		// 		->where('apv.depo_id',  $this->session->userdata('depo_id'))
		// 		// ->where('anggaran_detail.anggaran_detail_kode', $kode)
		// 		->group_by('apv.approval_setting_id')
		// 		->group_by('apv.approval_setting_keterangan')
		// 		->group_by('apv.approval_setting_jenis')
		// 		->order_by('COUNT(apv1.approval_id)+COUNT(apv2.approval_id)', 'asc')
		// 		->order_by('approval_setting_jenis', 'asc')
		// 		->get();
		// } else {
		// 	$data = $this->db->select("apv.approval_setting_id,apv.approval_setting_keterangan,apv.approval_setting_jenis,(COUNT(apv1.approval_id)+COUNT(apv2.approval_id)) as jumlah")
		// 		->from('approval_setting apv')
		// 		->join('approval as apv1', "apv1.approval_setting_id = apv.approval_setting_id AND apv1.approval_status = 'In progress' AND apv1.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv1.approval_is_direct_spv = 0 AND apv1.approval_level_id = '" . $this->session->userdata('karyawan_level_id') . "' AND apv1.approval_divisi_id = '" . $this->session->userdata('karyawan_divisi_id') . "'", 'left')
		// 		->join('approval as apv2', "apv2.approval_setting_id = apv.approval_setting_id AND apv2.approval_status = 'In progress' AND apv2.depo_id = '" . $this->session->userdata('depo_id') . "' AND apv2.approval_is_direct_spv = 1 AND apv2.approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'", 'left')
		// 		->where('apv.depo_id',  $this->session->userdata('depo_id'))
		// 		->where('apv.client_wms_id',  $this->session->userdata('client_wms_id'))
		// 		// ->where('anggaran_detail.anggaran_detail_kode', $kode)
		// 		->group_by('apv.approval_setting_id')
		// 		->group_by('apv.approval_setting_keterangan')
		// 		->group_by('apv.approval_setting_jenis')
		// 		->order_by('COUNT(apv1.approval_id)+COUNT(apv2.approval_id)', 'asc')
		// 		->order_by('approval_setting_jenis', 'asc')
		// 		->get();
		// }

		return $data->result_array();
	}

	public function getHistoryApproval($approval_reff_dokumen_kode)
	{
		$data = $this->db->select("approval_id,FORMAT(approval_tanggal, 'dd-MM-yyyy') as tgl,approval_reff_dokumen_jenis,approval_reff_dokumen_kode,approval_status,kry.karyawan_nama,approval_keterangan,approval_group.approval_group_nama ")
			->from('approval')
			->join('karyawan as kry', "kry.karyawan_id = approval.approval_karyawan_id", 'left')
			->join('approval_group_detail', "approval_group_detail.karyawan_id = approval.approval_karyawan_id AND approval.approval_group_id = approval_group_detail.approval_group_id", 'left')
			->join('approval_group', "approval_group.approval_group_id = approval_group_detail.approval_group_id", 'left')

			->where('approval.approval_pengajuan_id', $approval_reff_dokumen_kode)
			->where("approval.approval_status != 'In Progress'")
			->where("approval.approval_status != 'Pending'")
			->order_by('approval_tanggal', 'DESC')
			->get();
		return $data->result_array();
	}

	public function getApprovalByApprovalSettingId($approval_setting_id)
	{
		// $pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		// $is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		// if ($is_dewa > 0) {
		// 	$query = "SELECT 
		// 			approval_id,
		// 			approval_pengajuan_id,
		// 			approval_reff_dokumen_id,
		// 			approval_reff_dokumen_kode,
		// 			approval_reff_dokumen_jenis,
		// 			kry.karyawan_nama as diajukan_oleh,
		// 			aps.approval_setting_reff_url as url_doc,
		// 			FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
		// 		FROM approval
		// 		left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
		// 		LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
		// 		LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
		// 		WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
		// 			AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
		// 			AND approval_is_direct_spv = 0 
		// 			--AND approval_level_id = '" . $this->session->userdata('karyawan_level_id') . "' AND approval_divisi_id = '" . $this->session->userdata('karyawan_divisi_id') . "'

		// 		UNION
		// 		SELECT
		// 			approval_id,
		// 			approval_pengajuan_id,
		// 			approval_reff_dokumen_id,
		// 			approval_reff_dokumen_kode,
		// 			approval_reff_dokumen_jenis,
		// 			kry.karyawan_nama as diajukan_oleh,
		// 			aps.approval_setting_reff_url as url_doc,
		// 			FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
		// 		FROM approval
		// 		left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
		// 		LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
		// 		LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
		// 		WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
		// 			AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
		// 			AND approval_is_direct_spv = 1 AND approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'
		// ";
		// } else {
		// 	$query = "SELECT 
		// 			approval_id,
		// 			approval_pengajuan_id,
		// 			approval_reff_dokumen_id,
		// 			approval_reff_dokumen_kode,
		// 			approval_reff_dokumen_jenis,
		// 			kry.karyawan_nama as diajukan_oleh,
		// 			aps.approval_setting_reff_url as url_doc,
		// 			FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
		// 		FROM approval
		// 		left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
		// 		LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
		// 		LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
		// 		WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
		// 			AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
		// 			AND approval_is_direct_spv = 0 
		// 			AND approval_level_id = '" . $this->session->userdata('karyawan_level_id') . "' AND approval_divisi_id = '" . $this->session->userdata('karyawan_divisi_id') . "'

		// 		UNION
		// 		SELECT
		// 			approval_id,
		// 			approval_pengajuan_id,
		// 			approval_reff_dokumen_id,
		// 			approval_reff_dokumen_kode,
		// 			approval_reff_dokumen_jenis,
		// 			kry.karyawan_nama as diajukan_oleh,
		// 			aps.approval_setting_reff_url as url_doc,
		// 			FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
		// 		FROM approval
		// 		left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
		// 		LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
		// 		LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
		// 		WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
		// 			AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
		// 			AND approval_is_direct_spv = 1 AND approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'
		// ";
		// }
		// return $query;
		$query = "SELECT 
					approval_id,
					approval_pengajuan_id,
					approval_reff_dokumen_id,
					approval_reff_dokumen_kode,
					approval_reff_dokumen_jenis,
					kry.karyawan_nama as diajukan_oleh,
					aps.approval_setting_reff_url as url_doc,
					FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
				FROM approval
			--	left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
				--LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
				
LEFT JOIN karyawan kry ON approval.approval_karyawan_create_id = kry.karyawan_id
				LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
				WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
				--	AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
					AND approval_is_direct_spv = 0 
					--AND approval_level_id = '" . $this->session->userdata('karyawan_level_id') . "' AND approval_divisi_id = '" . $this->session->userdata('karyawan_divisi_id') . "'
				
				UNION
				SELECT
					approval_id,
					approval_pengajuan_id,
					approval_reff_dokumen_id,
					approval_reff_dokumen_kode,
					approval_reff_dokumen_jenis,
					kry.karyawan_nama as diajukan_oleh,
					aps.approval_setting_reff_url as url_doc,
					FORMAT(approval_tanggal_create, 'dd-MM-yyyy') as tgl 
				FROM approval
			--	left join pengguna peng on peng.pengguna_id = approval.approval_karyawan_create_id
				--LEFT JOIN karyawan kry ON peng.karyawan_id = kry.karyawan_id
				
LEFT JOIN karyawan kry ON approval.approval_karyawan_create_id = kry.karyawan_id
				LEFT JOIN approval_setting aps ON approval.approval_setting_id = aps.approval_setting_id
				WHERE approval_status = 'In progress' AND approval.approval_setting_id ='" . $approval_setting_id . "' 
					--AND approval.depo_id = '" . $this->session->userdata('depo_id') . "' 
				AND approval_is_direct_spv = 1 --AND approval_karyawan_id = '" . $this->session->userdata('karyawan_id') . "'
		";
		$data = $this->db->query($query);

		return $data->result_array();
	}
}
