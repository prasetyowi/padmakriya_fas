<?php

class M_PengeluaranDana extends CI_Model
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
	public function getDataPermintaanPengeluaran($add_perusahaan, $who_created)
	{
		$query = $this->db->query("SELECT 
					pengajuan_dana.*,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_pengajuan, 'yyyy-MM-dd') AS tgl_pengajuan,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_dibutuhkan, 'yyyy-MM-dd') AS tgl_dibutuhkan,
					bank.bank_account_nama,
					anggaranD.anggaran_detail_2_kode,
					anggaranD.anggaran_detail_2_nama_anggaran,
					tipe_transaksi.tipe_transaksi_nama
					FROM pengajuan_dana
					
					LEFT JOIN bank_account bank
					ON pengajuan_dana.bank_account_id = bank.bank_account_id
					LEFT JOIN anggaran_detail_2 anggaranD
					ON anggaranD.anggaran_detail_2_id = pengajuan_dana.anggaran_detail_2_id
					LEFT JOIN tipe_transaksi 
					ON tipe_transaksi.tipe_transaksi_id = pengajuan_dana.pengajuan_dana_tipe_transaksi
					WHERE pengajuan_dana.depo_id = '" . $this->session->userdata('depo_id') . "'
					AND pengajuan_dana.pengajuan_dana_status = 'Approved'
					AND pengajuan_dana.pengajuan_dana_nama_penerima = '$who_created'
					AND pengajuan_dana.client_wms_id = '$add_perusahaan'
					ORDER BY pengajuan_dana.pengajuan_dana_tgl_pengajuan ASC");
		return $query->result_array();
	}
	public function getPengeluaranDanaByKode($pengeluaran_dana_kode)
	{
		$query = $this->db->select("
					transaksi_dana.*,
					FORMAT(transaksi_dana.transaksi_dana_tanggal, 'yyyy-MM-dd') AS tgl,
					bank_pengirim.bank_account_nama as bank_pengirim,
					bank_penerima.bank_account_nama as bank_penerima,
					kategori_biaya.kategori_biaya_nama,
				")
			->from('transaksi_dana')
			->join("kategori_biaya", "kategori_biaya.kategori_biaya_id = transaksi_dana.kategori_biaya_id", "left")
			->join("bank_account bank_penerima", "transaksi_dana.bank_account_id_penerima = bank_penerima.bank_account_id", "left")
			->join("bank_account bank_pengirim", "transaksi_dana.bank_account_id_pengirim = bank_pengirim.bank_account_id", "left")
			->where("transaksi_dana_kode", $pengeluaran_dana_kode)
			->where('depo_id',  $this->session->userdata('depo_id'))
			->order_by('transaksi_dana.transaksi_dana_tanggal', 'ASC')
			->get();
		return $query->row();
	}

	public function getPengeluaranDanaDetailByID($pengeluaran_dana_id)
	{
		$query = $this->db->select("
					transaksi_dana_detail.*,
					pengajuan_dana.*,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_pengajuan, 'yyyy-MM-dd') AS tgl_pengajuan,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_dibutuhkan, 'yyyy-MM-dd') AS tgl_dibutuhkan,
					tipe_biaya.tipe_biaya_nama,bank.bank_account_nama,
					kategori_biaya.kategori_biaya_nama,
					anggaranD.anggaran_detail_2_kode,
					anggaranD.anggaran_detail_2_nama_anggaran
				")
			->from('transaksi_dana_detail')
			->join("pengajuan_dana", "pengajuan_dana.pengajuan_dana_id = transaksi_dana_detail.pengajuan_dana_id", "left")
			->join("tipe_biaya", "tipe_biaya.tipe_biaya_id = pengajuan_dana.tipe_biaya_id", "left")
			->join("kategori_biaya", "kategori_biaya.kategori_biaya_id = pengajuan_dana.kategori_biaya_id", "left")
			->join("bank_account bank", "pengajuan_dana.bank_account_id = bank.bank_account_id", "left")
			->join("anggaran_detail_2 anggaranD", "anggaranD.anggaran_detail_2_id = pengajuan_dana.anggaran_detail_2_id", "left")
			->where("transaksi_dana_id", $pengeluaran_dana_id)
			// ->order_by('transaksi_dana.transaksi_dana_tanggal', 'ASC')
			->get();
		return $query->result_array();
	}

	public function GetPengajuanDanaWhoCreate($pt)
	{
		$depo_id =  $this->session->userdata('depo_id');
		$query = $this->db->query("select DISTINCT pengajuan_dana_nama_penerima as pemohon from pengajuan_dana where pengajuan_dana_nama_penerima is not null and pengajuan_dana_nama_penerima !='' and depo_id = '$depo_id' and client_wms_id ='$pt' and pengajuan_dana_status ='Approved'");

		return $query->result_array();
	}

	public function getDataSearch($filter_kategori_biaya, $filter_status, $tgl1, $tgl2, $perusahaan)
	{
		if ($filter_kategori_biaya == "") {
			$filter_kategori_biaya = "";
		} else {
			$filter_kategori_biaya = " AND transaksi_dana.kategori_biaya_id = '$filter_kategori_biaya' ";
		}

		if ($filter_status == "") {
			$filter_status = "";
		} else {
			$filter_status = " AND transaksi_dana.transaksi_dana_status = '$filter_status' ";
		}

		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = " AND transaksi_dana.client_wms_id = '$perusahaan' ";
		}

		$data = $this->db->query("SELECT 
					transaksi_dana.*,
					FORMAT(transaksi_dana.transaksi_dana_tanggal, 'yyyy-MM-dd') AS tgl,
					kategori_biaya.kategori_biaya_nama
					FROM transaksi_dana
					LEFT JOIN kategori_biaya
					ON kategori_biaya.kategori_biaya_id = transaksi_dana.kategori_biaya_id
					WHERE FORMAT(transaksi_dana.transaksi_dana_tanggal, 'yyyy-MM-dd') BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'
					AND transaksi_dana.depo_id = '" . $this->session->userdata('depo_id') . "'
					--AND transaksi_dana.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)		
					" . $filter_kategori_biaya . "
					" . $filter_status . "
					" . $perusahaan . "
					ORDER BY transaksi_dana.transaksi_dana_tanggal DESC");
		// --AND transaksi_dana.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
		return $data->result_array();
		// return $this->db->last_query();
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

		//get anggaran level 0 and approved
		// $query = $this->db->select("anggaran_detail_2.*")->from("anggaran_detail_2")
		// 	->join("anggaran", 'anggaran.anggaran_id = anggaran_detail_2.anggaran_id', 'left')
		// 	->join("anggaran_detail", 'anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id', 'left')
		// 	->where("anggaran.anggaran_tahun", date("Y"))
		// 	->where("anggaran_detail.anggaran_detail_status", "Approved")
		// 	->where("anggaran_detail_2.anggaran_detail_2_level", 0)
		// 	->order_by("anggaran_detail_2.anggaran_detail_2_kode", "ASC")
		// 	->get();
		return $query->result_array();
	}

	public function SavePengeluaranDana(
		$transaksi_dana_kode,
		$kategori_biaya_id,
		$transaksi_dana_status,
		$transaksi_dana_nama_pemohon,
		$transaksi_dana_keterangan,
		$transaksi_dana_tanggal,
		$transaksi_dana_jumlah,
		$transaksi_dana_pembayaran,
		$bank_account_id_penerima,
		$bank_account_id_pengirim,
		$transaksi_dana_nama_penerima,
		$transaksi_dana_rekening_penerima,
		$transaksi_dana_nama_pengirim,
		$transaksi_dana_rekening_pengirim,
		$dataPermintaan,
		$attachment,
		$perusahaan
	) {
		$transaksi_dana_kode = $transaksi_dana_kode == '' ? null : $transaksi_dana_kode;
		$kategori_biaya_id = $kategori_biaya_id == '' ? null : $kategori_biaya_id;
		$transaksi_dana_status = $transaksi_dana_status == '' ? null : $transaksi_dana_status;
		$transaksi_dana_nama_pemohon = $transaksi_dana_nama_pemohon == '' ? null : $transaksi_dana_nama_pemohon;
		$transaksi_dana_keterangan = $transaksi_dana_keterangan == '' ? null : $transaksi_dana_keterangan;
		$transaksi_dana_tanggal = $transaksi_dana_tanggal == '' ? null : $transaksi_dana_tanggal;
		$transaksi_dana_jumlah = $transaksi_dana_jumlah == '' ? null : $transaksi_dana_jumlah;
		$transaksi_dana_pembayaran = $transaksi_dana_pembayaran == '' ? null : $transaksi_dana_pembayaran;
		$bank_account_id_penerima = $bank_account_id_penerima == '' ? null : $bank_account_id_penerima;
		$bank_account_id_pengirim = $bank_account_id_pengirim == '' ? null : $bank_account_id_pengirim;
		$transaksi_dana_nama_penerima = $transaksi_dana_nama_penerima == '' ? null : $transaksi_dana_nama_penerima;
		$transaksi_dana_rekening_penerima = $transaksi_dana_rekening_penerima == '' ? null : $transaksi_dana_rekening_penerima;
		$transaksi_dana_nama_pengirim = $transaksi_dana_nama_pengirim == '' ? null : $transaksi_dana_nama_pengirim;
		$transaksi_dana_rekening_pengirim = $transaksi_dana_rekening_pengirim == '' ? null : $transaksi_dana_rekening_pengirim;
		$dataPermintaan = $dataPermintaan == '' ? null : $dataPermintaan;
		$attachment = $attachment == '' ? null : $attachment;
		$perusahaan = $perusahaan == '' ? null : $perusahaan;

		// $this->db->trans_begin();
		$newID1 = $this->M_Function->Get_NewID();
		$newID = $newID1[0]['kode'];

		$this->db->set('transaksi_dana_id', $newID);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('kategori_biaya_id', $kategori_biaya_id);
		$this->db->set('transaksi_dana_kode', $transaksi_dana_kode);
		$this->db->set('transaksi_dana_kode', $transaksi_dana_kode);
		$this->db->set('transaksi_dana_status', 'Sukses');
		$this->db->set('transaksi_dana_jenis', 'K'); //kredit
		$this->db->set('transaksi_dana_nama_pemohon', $transaksi_dana_nama_pemohon);
		$this->db->set('transaksi_dana_keterangan', $transaksi_dana_keterangan);
		$this->db->set('transaksi_dana_tanggal', $transaksi_dana_tanggal);
		$this->db->set('transaksi_dana_jumlah', $transaksi_dana_jumlah);
		$this->db->set('transaksi_dana_pembayaran', $transaksi_dana_pembayaran);
		$this->db->set('bank_account_id_penerima', $bank_account_id_penerima == "" ? null : $bank_account_id_penerima);
		$this->db->set('bank_account_id_pengirim', $bank_account_id_pengirim == "" ? null : $bank_account_id_pengirim);
		$this->db->set('transaksi_dana_nama_penerima', $transaksi_dana_nama_penerima);
		$this->db->set('transaksi_dana_rekening_penerima', $transaksi_dana_rekening_penerima);
		$this->db->set('transaksi_dana_nama_pengirim', $transaksi_dana_nama_pengirim);
		$this->db->set('transaksi_dana_rekening_pengirim', $transaksi_dana_rekening_pengirim);
		$this->db->set('transaksi_dana_attacment', $attachment);
		$this->db->set('client_wms_id', $perusahaan);
		$this->db->set('transaksi_dana_who_create', $this->session->userdata('pengguna_username'));
		$this->db->insert('transaksi_dana');


		foreach ($dataPermintaan as $key => $value) {
			$this->db->set('transaksi_dana_detail_id', 'NEWID()', false);
			$this->db->set('transaksi_dana_id', $newID);
			$this->db->set('pengajuan_dana_id', $value->id);
			$this->db->set('tipe_transaksi_id', $value->tipe_transaksi_id == "null" ? null : $value->tipe_transaksi_id);
			$this->db->set('transaksi_dana_detail_plan_value', $value->nominal);
			$this->db->set('transaksi_dana_detail_aktual_value', $value->nominal_aktual);
			$this->db->insert('transaksi_dana_detail');

			$this->db->set('pengajuan_dana_status', 'Paid');
			$this->db->where('pengajuan_dana_id', $value->id);
			$this->db->update('pengajuan_dana');

			// exec prosedure untuk akumulasi anggaran
			$queryProsedure = $this->db->query("
							exec pengeluaran_dana_akumulasi_anggaran '" .  $value->id . "', '" . $value->nominal . "'
				");
			$h = $queryProsedure->result_array();
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

	public function UpdatePengajuanDana(
		$pengajuan_dana_id,
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
		$pengajuan_dana_attacment_1
	) {
		$this->db->trans_start();

		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('kategori_biaya_id', $kategori_biaya_id);
		$this->db->set('tipe_biaya_id', $tipe_biaya_id);
		// $this->db->set('pengajuan_dana_kode', $pengajuan_dana_kode);
		$this->db->set('pengajuan_dana_status', $pengajuan_dana_status);
		$this->db->set('pengajuan_dana_judul', $pengajuan_dana_judul);
		$this->db->set('pengajuan_dana_keterangan', $pengajuan_dana_keterangan);
		$this->db->set('pengajuan_dana_tgl_pengajuan', $pengajuan_dana_tgl_pengajuan);
		$this->db->set('pengajuan_dana_tgl_dibutuhkan', $pengajuan_dana_tgl_dibutuhkan);
		$this->db->set('anggaran_detail_2_id', $anggaran_detail_2_id);
		$this->db->set('pengajuan_dana_value', $pengajuan_dana_value);
		$this->db->set('pengajuan_dana_default_pembayaran', $pengajuan_dana_default_pembayaran);
		$this->db->set('bank_account_id', $bank_account_id == "" ? null : $bank_account_id);
		$this->db->set('pengajuan_dana_nama_penerima', $pengajuan_dana_nama_penerima);
		$this->db->set('pengajuan_dana_rekening_penerima', $pengajuan_dana_rekening_penerima);
		$this->db->set('pengajuan_dana_attacment_1', $pengajuan_dana_attacment_1);
		$this->db->set('pengajuan_dana_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('pengajuan_dana_who_create', $this->session->userdata('pengguna_username'));
		$this->db->where("pengajuan_dana_kode", $pengajuan_dana_kode);
		$this->db->update('pengajuan_dana');

		//cek apa status nya in progress approval
		if ($pengajuan_dana_status == 'In progress approval') {
			# code...
			// exec prosedure approval pengajuan
			// $sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '110005000' and approval_setting_jenis = 'Pengajuan Pengeluaran Dana') ";
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '210008000' and approval_setting_jenis = 'Permintaan Pengeluaran Dana') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
							exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $pengajuan_dana_id . "','" . $pengajuan_dana_kode . "', 1, '" . $pengajuan_dana_value . "'
				");
			$h = $queryProsedure->result_array();

			$ha = $h[0]['ErrMsg'];
			// return $h;
			// $ha = $queryProsedure;
			if ($ha != '') {
				$this->db->trans_rollback();
				return $ha;
			}
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
}
