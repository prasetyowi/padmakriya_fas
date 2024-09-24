<?php

class M_PengajuanDana extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('M_AutoGen');
		$this->load->model('M_Vrbl');
	}
	// old
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
	public function GetTipePengadaan()
	{
		$this->db->select("*")
			->from("tipe_pengadaan")
			->where("tipe_pengadaan_is_aktif", "1")
			->order_by("tipe_pengadaan_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeTransaksiByTipePengadaanID($id)
	{
		$this->db->select("*")
			->from("tipe_transaksi")
			->where("tipe_pengadaan_id", $id)
			->where("tipe_transaksi_is_aktif", "1")
			->order_by("tipe_transaksi_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
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
	public function GetAnggaranBudget($client_wms_id)
	{
		$query = $this->db->query(" select * from anggaran a 
		left join anggaran_detail ad on a.anggaran_id = ad.anggaran_id
		left join anggaran_detail_2 ad2 on ad.anggaran_detail_id = ad2.anggaran_detail_id
		where a.depo_id = '" . $this->session->userdata('depo_id') . "' and a.client_wms_id = '$client_wms_id' and ad.anggaran_detail_status ='Approved' and ad2.anggaran_detail_2_level = 0");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeTransaksi()
	{
		$this->db->select("*")
			->from("tipe_transaksi")
			->where("tipe_transaksi_is_aktif", "1")
			->order_by("tipe_transaksi_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function getDepoPrefix($depo_id)
	{
		$prefix = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $prefix->row();
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
	public function getPengajuanDanaByKode($pengajuan_dana_kode)
	{
		$query = $this->db->select("
					pengajuan_dana.*,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_pengajuan, 'yyyy-MM-dd') AS tgl_pengajuan,
					FORMAT(pengajuan_dana.pengajuan_dana_tgl_dibutuhkan, 'yyyy-MM-dd') AS tgl_dibutuhkan,
					FORMAT(pengajuan_dana_tgl_dibutuhkan,'yyyy')as tahun_pengajuan_dana_dibutuhkan,
					tipe_biaya.tipe_biaya_nama,bank.bank_account_nama,
					kategori_biaya.kategori_biaya_nama,
					anggaranD.anggaran_detail_2_kode,
					anggaranD.anggaran_detail_2_nama_anggaran
				")
			->from('pengajuan_dana')
			->join("tipe_biaya", "tipe_biaya.tipe_biaya_id = pengajuan_dana.tipe_biaya_id", "left")
			->join("kategori_biaya", "kategori_biaya.kategori_biaya_id = pengajuan_dana.kategori_biaya_id", "left")
			->join("bank_account bank", "pengajuan_dana.bank_account_id = bank.bank_account_id", "left")
			->join("anggaran_detail_2 anggaranD", "anggaranD.anggaran_detail_2_id = pengajuan_dana.anggaran_detail_2_id", "left")
			->where("pengajuan_dana_kode", $pengajuan_dana_kode)
			->where('depo_id',  $this->session->userdata('depo_id'))
			->order_by('pengajuan_dana.pengajuan_dana_tgl_pengajuan', 'ASC')
			->get();
		return $query->row();
		// return $this->db->last_query();
	}

	public function getDataSearch($filter_tipe_biaya, $filter_status, $tgl1, $tgl2, $filter_perusahaan)
	{
		$sessclient = $this->session->userdata('client_wms_id');
		if ($filter_tipe_biaya == "") {
			$filter_tipe_biaya = "";
		} else {
			$filter_tipe_biaya = " AND pengajuan_dana.tipe_biaya_id = '$filter_tipe_biaya' ";
		}

		if ($filter_status == "") {

			$filter_status = "";
		} else {
			$filter_status = " AND pengajuan_dana.pengajuan_dana_status = '$filter_status' ";
		}
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		if ($is_dewa > 0) {

			if ($filter_perusahaan == "") {
				$filter_perusahaan = "";
			} else {
				if ($this->session->userdata('client_wms_id') == '') {
					$filter_perusahaan = "AND pengajuan_dana.client_wms_id = '$filter_perusahaan'";
				} else {
					$filter_perusahaan = "AND pengajuan_dana.client_wms_id= '$sessclient'";
				}
			}
		} else {
			if ($this->session->userdata('client_wms_id') == '') {
				$filter_perusahaan = "AND pengajuan_dana.client_wms_id = '$filter_perusahaan'";
			} else {
				$filter_perusahaan = "AND pengajuan_dana.client_wms_id= '$sessclient'";
			}
		}
		$data = $this->db->query("SELECT
									pengajuan_dana.*,
									FORMAT(pengajuan_dana.pengajuan_dana_tgl_pengajuan, 'yyyy-MM-dd') AS tgl_pengajuan,
									FORMAT(pengajuan_dana.pengajuan_dana_tgl_dibutuhkan, 'yyyy-MM-dd') AS tgl_dibutuhkan,
									tipe_biaya.tipe_biaya_nama,
									bank.bank_account_nama,
									kategori_biaya.kategori_biaya_nama
									FROM pengajuan_dana
									LEFT JOIN tipe_biaya
									ON tipe_biaya.tipe_biaya_id = pengajuan_dana.tipe_biaya_id
									LEFT JOIN kategori_biaya
									ON kategori_biaya.kategori_biaya_id = pengajuan_dana.kategori_biaya_id
									LEFT JOIN bank_account bank
									ON pengajuan_dana.bank_account_id = bank.bank_account_id
									WHERE FORMAT(pengajuan_dana.pengajuan_dana_tgl_pengajuan, 'yyyy-MM-dd') BETWEEN '" . $tgl1 . "' AND '" . $tgl2 . "'
									AND pengajuan_dana.depo_id = '" . $this->session->userdata('depo_id') . "'
									
									 $filter_tipe_biaya 
									 $filter_status
									 $filter_perusahaan 
									ORDER BY pengajuan_dana.pengajuan_dana_tgl_pengajuan DESC");

		return $data->result_array();
		// AND pengajuan_dana.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
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
	public function GetAnggaranDetail2ByYearByKode($tahun)
	{
		$th = $tahun == null || "" ? date("Y") : $tahun;
		$query = $this->db->query("SELECT
									anggaran_detail_2.*
									FROM anggaran_detail_2
									LEFT JOIN anggaran
									ON anggaran.anggaran_id = anggaran_detail_2.anggaran_id
									LEFT JOIN anggaran_detail
									ON anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id
									WHERE anggaran.anggaran_tahun = '$th'
									AND anggaran_detail.anggaran_detail_status = 'Approved'
									AND anggaran_detail_2.anggaran_detail_2_level = '0'
									AND anggaran.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
									ORDER BY anggaran_detail_2.anggaran_detail_2_kode ASC ");

		return $query->result_array();
	}
	public function GetAnggaranDetail2ByYearDepoClient($client_wms_id, $tahun)
	{

		//get anggaran level 0 and approved and depo and pt
		$query = $this->db->select("anggaran_detail_2.*")->from("anggaran_detail_2")
			->join("anggaran", 'anggaran.anggaran_id = anggaran_detail_2.anggaran_id', 'left')
			->join("anggaran_detail", 'anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id', 'left')
			// ->where("anggaran.anggaran_tahun", date("Y"))
			->where("anggaran.anggaran_tahun", $tahun)
			->where("anggaran.depo_id", $this->session->userdata('depo_id'))
			->where("anggaran.client_wms_id", $client_wms_id)
			->where("anggaran_detail.anggaran_detail_status", "Approved")
			->where("anggaran_detail_2.anggaran_detail_2_level", 0)
			->order_by("anggaran_detail_2.anggaran_detail_2_kode", "ASC")
			->get();
		// 		var_dump("select anggaran_detail_2.* from anggaran_detail_2
		// 			left join anggaran on anggaran.anggaran_id = anggaran_detail_2.anggaran_id
		// 			left join anggaran_detail on anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id
		// 			 where anggaran.anggaran_tahun ='2023'
		// 				and anggaran.depo_id = 'A9DD73D2-B2EA-469E-B9CA-3196EDC1DF26'
		// 			 and anggaran_detail.anggaran_detail_status='Approved'
		// 			 and anggaran_detail_2.anggaran_detail_2_level =0
		// 			 and anggaran.client_wms_id = 'AB4196BF-FBEC-46D7-8D4E-7F8B61BBAD30'

		// 			 order by anggaran_detail_2.anggaran_detail_2_kode asc
		// ");
		return $query->result_array();
	}

	public function SavePengajuanDana(
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
		$pengajuan_dana_attacment_1,
		$perusahaan,
		$tipe_transaksi,
		$no_doc_po,
		$jenis_asset,
		$jenis_pengadaan
	) {

		$pengajuan_dana_kode = $pengajuan_dana_kode == '' ? null : $pengajuan_dana_kode;
		$kategori_biaya_id = $kategori_biaya_id == '' ? null : $kategori_biaya_id;
		$tipe_biaya_id = $tipe_biaya_id == '' ? null : $tipe_biaya_id;
		$pengajuan_dana_status = $pengajuan_dana_status == '' ? null : $pengajuan_dana_status;
		$pengajuan_dana_judul = $pengajuan_dana_judul == '' ? null : $pengajuan_dana_judul;
		$pengajuan_dana_keterangan = $pengajuan_dana_keterangan == '' ? null : $pengajuan_dana_keterangan;
		$pengajuan_dana_tgl_pengajuan = $pengajuan_dana_tgl_pengajuan == '' ? null : $pengajuan_dana_tgl_pengajuan;
		$pengajuan_dana_tgl_dibutuhkan = $pengajuan_dana_tgl_dibutuhkan == '' ? null : $pengajuan_dana_tgl_dibutuhkan;
		$pengajuan_dana_value = $pengajuan_dana_value == '' ? null : $pengajuan_dana_value;
		$pengajuan_dana_default_pembayaran = $pengajuan_dana_default_pembayaran == '' ? null : $pengajuan_dana_default_pembayaran;
		$bank_account_id = $bank_account_id == '' ? null : $bank_account_id;
		$pengajuan_dana_nama_penerima = $pengajuan_dana_nama_penerima == '' ? null : $pengajuan_dana_nama_penerima;
		$pengajuan_dana_rekening_penerima = $pengajuan_dana_rekening_penerima == '' ? null : $pengajuan_dana_rekening_penerima;
		$anggaran_detail_2_id = $anggaran_detail_2_id == '' ? null : $anggaran_detail_2_id;
		$pengajuan_dana_attacment_1 = $pengajuan_dana_attacment_1 == '' ? null : $pengajuan_dana_attacment_1;
		$perusahaan = $perusahaan == '' ? null : $perusahaan;
		$tipe_transaksi = $tipe_transaksi == '' ? null : $tipe_transaksi;
		$no_doc_po = $no_doc_po == '' ? null : $no_doc_po;
		$jenis_asset = $jenis_asset == '' ? null : $jenis_asset;
		$jenis_pengadaan = $jenis_pengadaan == '' ? null : $jenis_pengadaan;

		$this->db->trans_start();

		$newID1 = $this->M_Function->Get_NewID();
		$newID = $newID1[0]['kode'];

		$this->db->set('pengajuan_dana_id', $newID);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('kategori_biaya_id', $kategori_biaya_id);
		$this->db->set('tipe_biaya_id', $tipe_biaya_id);
		$this->db->set('pengajuan_dana_kode', $pengajuan_dana_kode);
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
		$this->db->set('client_wms_id', $perusahaan);
		$this->db->set('pengajuan_dana_jenis_pengadaan', $jenis_pengadaan);
		$this->db->set('pengajuan_dana_no_doc_po', $no_doc_po == "" || null ? '' : $no_doc_po);
		$this->db->set('pengajuan_dana_jenis_asset', $jenis_asset);
		$this->db->set('pengajuan_dana_tipe_transaksi', $tipe_transaksi);
		$this->db->insert('pengajuan_dana');
		//get data pengajuan dana rekap counter by tipe biaya
		// $query  = $this->db->select("*")
		// 	->from("pengajuan_dana_rekap")
		// 	->where("tipe_biaya_id", $tipe_biaya_id)->get();

		// $row = $query->row();
		// //cek apa ada data pengajuan dana rekap
		// if (isset($row)) {
		// 	//update counter rekap pengajuan
		// 	$this->db->set('pengajuan_dana_rekap_counter', $row->pengajuan_dana_rekap_counter + 1);
		// 	$this->db->where("tipe_biaya_id", $tipe_biaya_id);
		// 	$this->db->update('pengajuan_dana_rekap');
		// } else {
		// 	//insert pengajuan rekap
		// 	$this->db->set('pengajuan_dana_rekap_id', "NEWID()", FALSE);
		// 	$this->db->set('depo_id', $this->session->userdata('depo_id'));
		// 	$this->db->set('tipe_biaya_id', $tipe_biaya_id);
		// 	$this->db->set('pengajuan_dana_rekap_bulan', date('m'));
		// 	$this->db->set('pengajuan_dana_rekap_tahun', date('Y'));
		// 	$this->db->set('pengajuan_dana_rekap_counter', 1);
		// 	$this->db->insert('pengajuan_dana_rekap');
		// }
		//cek apa status nya in progress approval
		if ($pengajuan_dana_status == 'In progress approval') {
			# code...
			// exec prosedure approval pengajuan
			// $sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '110005000' and approval_setting_jenis = 'Pengajuan Pengeluaran Dana') ";
			$sql = "select vrbl_param, vrbl_kode from vrbl where vrbl_param in (select approval_setting_parameter from approval_setting where menu_web_kode = '210008000' and approval_setting_jenis = 'Permintaan Pengeluaran Dana') ";
			$get_param = $this->db->query($sql);
			$dataParam = $get_param->row();

			$queryProsedure = $this->db->query("
							exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('karyawan_id') . "', '" . $dataParam->vrbl_param . "', '" . $newID . "','" . $pengajuan_dana_kode . "', 1, '" . $pengajuan_dana_value . "'
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
		$pengajuan_dana_attacment_1,
		$perusahaan,
		$tipe_transaksi,
		$no_doc_po,
		$jenis_asset,
		$jenis_pengadaan
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
		$this->db->set('client_wms_id', $perusahaan);
		$this->db->set('pengajuan_dana_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('pengajuan_dana_jenis_pengadaan', $jenis_pengadaan);
		$this->db->set('pengajuan_dana_no_doc_po', $no_doc_po == "" || null ? '' : $no_doc_po);
		$this->db->set('pengajuan_dana_jenis_asset', $jenis_asset);
		$this->db->set('pengajuan_dana_tipe_transaksi', $tipe_transaksi);
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
		// $this->db->trans_complete();

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
