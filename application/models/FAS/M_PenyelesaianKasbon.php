<?php

class M_PenyelesaianKasbon extends CI_Model
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
	public function Getkategori_biaya()
	{
		$query = $this->db->select("*")->from("kategori_biaya")->where("kategori_biaya_is_aktif", 1)->get();
		return $query->result_array();
	}
	public function Gettipe_biaya()
	{
		$query = $this->db->select("*")->from("tipe_biaya")->where("tipe_biaya_is_aktif", 1)->get();
		return $query->result_array();
	}
	public function Getbank()
	{
		$query = $this->db->select("*")->from("bank_account")->where("bank_account_is_aktif", 1)->get();
		return $query->result_array();
	}
	public function GetTransaksiDana()
	{
		$query = $this->db->select("*")->from("transaksi_dana")->get();
		return $query->result_array();
	}
	public function GetTransaksiDanaPemohon()
	{
		$depo_id =  $this->session->userdata('depo_id');
		$query = $this->db->query("select distinct transaksi_dana.transaksi_dana_nama_pemohon as pemohon from transaksi_dana where transaksi_dana_nama_pemohon is not null and transaksi_dana_nama_pemohon !='' and depo_id = '$depo_id'");

		return $query->result_array();
	}
	public function getDataPermintaanPengeluaran($add_perusahaan, $who_created)
	{
		$query = $this->db->query("select distinct tr.* from transaksi_dana tr
		where tr.transaksi_dana_nama_pemohon ='$who_created'
		and tr.depo_id='" . $this->session->userdata('depo_id') . "'
		and tr.client_wms_id = '$add_perusahaan'
		");
		return $query->result_array();
	}
	public function getAllDataPenyelesaianKasbon()
	{
		$query = $this->db->query("select distinct penyelesaian_kasbon_nama as pemohon from penyelesaian_kasbon
		");
		return $query->result_array();
	}
	public function getSubTotal($id, $add_perusahaan, $who_created)
	{
		$query = $this->db->query("select sum(trd.transaksi_dana_detail_aktual_value) as total from transaksi_dana_detail trd
		left join transaksi_dana tr on tr.transaksi_dana_id = tr.transaksi_dana_id 
		where tr.transaksi_dana_nama_pemohon ='$who_created'
		and tr.transaksi_dana_id = '$id'
		and tr.depo_id='" . $this->session->userdata('depo_id') . "'
		and tr.client_wms_id = '$add_perusahaan'
		and trd.tipe_transaksi_id = 'DB009D0F-14A7-492F-9BD2-CAB2902D789B'
		");
		return $query->row();
	}
	public function getPenyelesaianKasbonbyId($penyelesaian_kasbon)
	{
		$query = $this->db->select("
					penyelesaian_kasbon.*,
					FORMAT(penyelesaian_kasbon.penyelesaian_kasbon_tgl_create, 'yyyy-MM-dd') AS tgl,
				")
			->from('penyelesaian_kasbon')
			->where("penyelesaian_kasbon_id", $penyelesaian_kasbon)
			->where('depo_id',  $this->session->userdata('depo_id'))
			->get();
		return $query->row();
	}

	public function getPenyelesaianKasbonbyIdDetail($penyelesaian_kasbon)
	{
		$query = $this->db->select("penyelesaian_kasbon_detail.*
				")
			->from('penyelesaian_kasbon_detail')
			->where("penyelesaian_kasbon_id", $penyelesaian_kasbon)
			->get();
		return $query->result_array();
	}

	public function GetPengajuanDanaWhoCreate($pt)
	{
		$depo_id =  $this->session->userdata('depo_id');
		$query = $this->db->query("select distinct transaksi_dana.transaksi_dana_nama_pemohon as pemohon from transaksi_dana where transaksi_dana_nama_pemohon is not null and transaksi_dana_nama_pemohon !='' and depo_id = '$depo_id' and client_wms_id ='$pt'");

		return $query->result_array();
	}

	public function getDataSearch($filter_kategori_biaya, $filter_status, $tgl1, $tgl2, $perusahaan)
	{

		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = " AND penyelesaian_kasbon.client_wms_id = '$perusahaan' ";
		}

		$data = $this->db->query("SELECT 
					penyelesaian_kasbon.*,
					FORMAT(penyelesaian_kasbon.penyelesaian_kasbon_tgl_create, 'yyyy-MM-dd') AS tgl
					FROM penyelesaian_kasbon
					WHERE FORMAT(penyelesaian_kasbon.penyelesaian_kasbon_tgl_create, 'yyyy-MM-dd') BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'
					AND penyelesaian_kasbon.depo_id = '" . $this->session->userdata('depo_id') . "'
					" . $perusahaan . "
					ORDER BY penyelesaian_kasbon.penyelesaian_kasbon_tgl_create DESC");
		// --AND transaksi_dana.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
		return $data->result_array();
	}
	public function GetAnggaranDetail2ByYear()
	{
		$query = $this->db->query("SELECT
									anggaran_detail_2.*
									FROM anggaran_detail_2
									LEFT JOIN anggaran
									ON anggaran.anggaran_id = anggaran_detail_2.anggaran_id
									LEFT JOIN anggaran_detail
									ON anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id
									WHERE anggaran.anggaran_tahun = '" . date("Y") . "'
									AND anggaran_detail.anggaran_detail_status = 'Approved'
									AND anggaran_detail_2.anggaran_detail_2_level = '0'
									AND anggaran.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
									ORDER BY anggaran_detail_2.anggaran_detail_2_kode ASC ");
		return $query->result_array();
	}

	public function SavePenyelesaianKasbon(
		$penyelesaian_kasbon_id,
		$pengajuan_dana_id,
		$transaksi_dana_detail_id,
		$penyelesaian_kasbon_kode,
		$depo_id,
		$client_wms_id,
		$penyelesaian_kasbon_tgl_create,
		$penyelesaian_kasbon_who_create,
		$penyelesaian_kasbon_keterangan,
		$penyelesaian_kasbon_attachment,
		$penyelesaian_kasbon_status,
		$kasbon_value,
		$penyelesaian_kasbon_sum_value,
		$penyelesaian_kasbon_aktual,
		$dataPermintaan,
		$penyelesaian_kasbon_type,
		$penyelesaian_kasbon_nama
	) {
		$penyelesaian_kasbon_id = $penyelesaian_kasbon_id == '' ? null : $penyelesaian_kasbon_id;
		$transaksi_dana_detail_id = $transaksi_dana_detail_id == '' ? null : $transaksi_dana_detail_id;
		$penyelesaian_kasbon_kode = $penyelesaian_kasbon_kode == '' ? null : $penyelesaian_kasbon_kode;
		$depo_id = $depo_id == '' ? null : $depo_id;
		$client_wms_id = $client_wms_id == '' ? null : $client_wms_id;
		$penyelesaian_kasbon_tgl_create = $penyelesaian_kasbon_tgl_create == '' ? null : $penyelesaian_kasbon_tgl_create;
		$penyelesaian_kasbon_who_create = $penyelesaian_kasbon_who_create == '' ? null : $penyelesaian_kasbon_who_create;
		$penyelesaian_kasbon_keterangan = $penyelesaian_kasbon_keterangan == '' ? null : $penyelesaian_kasbon_keterangan;
		$penyelesaian_kasbon_attachment = $penyelesaian_kasbon_attachment == '' ? null : $penyelesaian_kasbon_attachment;
		$penyelesaian_kasbon_status = $penyelesaian_kasbon_status == '' ? null : $penyelesaian_kasbon_status;
		$kasbon_value = $kasbon_value == '' ? null : $kasbon_value;
		$penyelesaian_kasbon_sum_value = $penyelesaian_kasbon_sum_value == '' ? null : $penyelesaian_kasbon_sum_value;
		$penyelesaian_kasbon_aktual = $penyelesaian_kasbon_aktual == '' ? null : $penyelesaian_kasbon_aktual;
		$dataPermintaan = $dataPermintaan == '' ? null : $dataPermintaan;
		$penyelesaian_kasbon_type = $penyelesaian_kasbon_type == '' ? null : $penyelesaian_kasbon_type;
		$penyelesaian_kasbon_nama = $penyelesaian_kasbon_nama == '' ? null : $penyelesaian_kasbon_nama;

		// $this->db->trans_begin();
		$newID1 = $this->M_Function->Get_NewID();
		$newID = $newID1[0]['kode'];

		$this->db->set('penyelesaian_kasbon_id', $penyelesaian_kasbon_id);
		$this->db->set('penyelesaian_kasbon_nama', $penyelesaian_kasbon_nama);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('transaksi_dana_id', $transaksi_dana_detail_id);
		$this->db->set('penyelesaian_kasbon_kode', $penyelesaian_kasbon_kode);
		$this->db->set('penyelesaian_kasbon_tgl_create', 'GETDATE()', false);
		$this->db->set('penyelesaian_kasbon_status', $penyelesaian_kasbon_status);
		$this->db->set('penyelesaian_kasbon_keterangan', $penyelesaian_kasbon_keterangan);
		$this->db->set('penyelesaian_kasbon_attachment', $penyelesaian_kasbon_attachment);
		$this->db->set('kasbon_value', $kasbon_value);
		$this->db->set('penyelesaian_kasbon_sum_value', $penyelesaian_kasbon_sum_value);
		$this->db->set('penyelesaian_kasbon_aktual', $penyelesaian_kasbon_aktual);
		$this->db->set('penyelesaian_kasbon_attachment', $penyelesaian_kasbon_attachment);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('penyelesaian_kasbon_who_create', $this->session->userdata('pengguna_username'));
		$this->db->insert('penyelesaian_kasbon');

		foreach ($dataPermintaan as $key => $value) {
			$this->db->set('penyelesaian_kasbon_detail_id', 'NEWID()', false);
			$this->db->set('penyelesaian_kasbon_id', $penyelesaian_kasbon_id);
			$this->db->set('nama_pengeluaran_detail', $value->name);
			$this->db->set('qty_pengeluaran_detail', $value->qty);
			$this->db->set('harga_pengeluaran_detail', $value->harga);
			$this->db->insert('penyelesaian_kasbon_detail');
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();

		return 1;
	}

	public function UpdatePenyelesaianKasbon(
		$penyelesaian_kasbon_id,
		$penyelesaian_kasbon_keterangan,
		$penyelesaian_kasbon_attachment,
		$penyelesaian_kasbon_status,
		$kasbon_value,
		$penyelesaian_kasbon_sum_value,
		$penyelesaian_kasbon_aktual,
		$dataPermintaan,
		$penyelesaian_kasbon_type
	) {
		$penyelesaian_kasbon_id = $penyelesaian_kasbon_id == '' ? null : $penyelesaian_kasbon_id;


		$penyelesaian_kasbon_keterangan = $penyelesaian_kasbon_keterangan == '' ? null : $penyelesaian_kasbon_keterangan;
		$penyelesaian_kasbon_attachment = $penyelesaian_kasbon_attachment == '' ? null : $penyelesaian_kasbon_attachment;
		$penyelesaian_kasbon_status = $penyelesaian_kasbon_status == '' ? null : $penyelesaian_kasbon_status;
		$kasbon_value = $kasbon_value == '' ? null : $kasbon_value;
		$penyelesaian_kasbon_sum_value = $penyelesaian_kasbon_sum_value == '' ? null : $penyelesaian_kasbon_sum_value;
		$penyelesaian_kasbon_aktual = $penyelesaian_kasbon_aktual == '' ? null : $penyelesaian_kasbon_aktual;
		$dataPermintaan = $dataPermintaan == '' ? null : $dataPermintaan;
		$penyelesaian_kasbon_type = $penyelesaian_kasbon_type == '' ? null : $penyelesaian_kasbon_type;

		$this->db->trans_start();


		$this->db->set('penyelesaian_kasbon_status', $penyelesaian_kasbon_status);
		$this->db->set('penyelesaian_kasbon_keterangan', $penyelesaian_kasbon_keterangan);
		$this->db->set('penyelesaian_kasbon_attachment', $penyelesaian_kasbon_attachment);
		$this->db->set('kasbon_value', $kasbon_value);
		$this->db->set('penyelesaian_kasbon_sum_value', $penyelesaian_kasbon_sum_value);
		$this->db->set('penyelesaian_kasbon_aktual', $penyelesaian_kasbon_aktual);
		$this->db->set('penyelesaian_kasbon_attachment', $penyelesaian_kasbon_attachment);
		$this->db->set('penyelesaian_kasbon_type', $penyelesaian_kasbon_type);
		// $this->db->set('penyelesaian_kasbon_id', $penyelesaian_kasbon_id);
		$this->db->where('penyelesaian_kasbon_id', $penyelesaian_kasbon_id);
		$this->db->update('penyelesaian_kasbon');

		//cek apa status nya in progress approval
		foreach ($dataPermintaan as $key => $value) {
			$this->db->set('penyelesaian_kasbon_detail_id', 'NEWID()', false);
			$this->db->set('penyelesaian_kasbon_id', $penyelesaian_kasbon_id);
			$this->db->set('nama_pengeluaran_detail', $value->name);
			$this->db->set('qty_pengeluaran_detail', $value->qty);
			$this->db->set('harga_pengeluaran_detail', $value->harga);
			$this->db->insert('penyelesaian_kasbon_detail');
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();

		return 1;
	}

	public function DeletePenyelesaianKasbonDetail($penyelesaian_kasbon_id)
	{
		$this->db->where("penyelesaian_kasbon_id", $penyelesaian_kasbon_id);
		return $this->db->delete('penyelesaian_kasbon_detail');
	}
}
