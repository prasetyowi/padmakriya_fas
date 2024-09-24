<?php

class M_Kalender extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model('M_Function');
	}
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
	public function getDepoPrefix($depo_id)
	{
		$prefix = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $prefix->row();
	}
	// do 
	public function Getkategori_biaya()
	{
		$query = $this->db->select("*")->from("kategori_biaya")->where("kategori_biaya_is_aktif", 1)->get();
		return $query->result_array();
	}
	public function GetAnggaranDetail2ByYear()
	{
		//get anggaran level 0 and approved
		$query = $this->db->select("anggaran_detail_2.*")->from("anggaran_detail_2")
			->join("anggaran", 'anggaran.anggaran_id = anggaran_detail_2.anggaran_id', 'left')
			->join("anggaran_detail", 'anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id', 'left')
			->where("anggaran.anggaran_tahun", date("Y"))
			->where("anggaran_detail.anggaran_detail_status", "Approved")
			->where("anggaran_detail_2.anggaran_detail_2_level", 0)
			->order_by("anggaran_detail_2.anggaran_detail_2_kode", "ASC")
			->get();
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
		// var_dump("select anggaran_detail_2.* from anggaran_detail_2
		// 			left join anggaran on anggaran.anggaran_id = anggaran_detail_2.anggaran_id
		// 			left join anggaran_detail on anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id
		// 			 where anggaran.anggaran_tahun ='$tahun'
		// 				and anggaran.depo_id = 'A9DD73D2-B2EA-469E-B9CA-3196EDC1DF26'
		// 			 and anggaran_detail.anggaran_detail_status='Approved'
		// 			 and anggaran_detail_2.anggaran_detail_2_level =0
		// 			 and anggaran.client_wms_id = 'AB4196BF-FBEC-46D7-8D4E-7F8B61BBAD30'

		// 			 order by anggaran_detail_2.anggaran_detail_2_kode asc
		// ");
		return $query->result_array();
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

	public function Getkalender_temp()
	{
		$this->db->select("	kalender_temp_id, kalender_id, depo_id, anggaran_detail_2_id, kalender_selected_date, 
								kalender_kode, kalender_judul, kalender_keterangan, kalender_nilai, kalender_default_pembayaran, 
								kalender_warna, kalender_is_recurrence, kalender_tgl_create, kalender_who_create, kalender_tgl_update,
								kalender_who_update, kalender_value1, kalender_value2, 
								kalender_senin, kalender_selasa, kalender_rabu, kalender_kamis, 
								kalender_jumat, kalender_sabtu, kalender_minggu, 
								kalender_recurrencebulanan, kalender_modeberakhir, kalender_modeberakhirtanggal, kalender_no_rekening")
			->from("kalender_temp")
			->order_by("kalender_kode", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}
	public function GetKalenderEvent($tanggal_start, $tanggal_end, $perusahaan)
	{
		$this->db->select("kalender_detail_tanggal, tipe_biaya.tipe_biaya_warna, kalender_detail_id,kalender.kalender_id,kalender.kalender_judul,kalender.kalender_warna,kalender_detail_flag_pengajuan")
			->from("kalender_detail")
			->join("kalender", "kalender.kalender_id = kalender_detail.kalender_id", "left")
			->join("tipe_biaya", "tipe_biaya.tipe_biaya_id = kalender.tipe_biaya_id", "left")
			->where("kalender.client_wms_id", $perusahaan)
			->where("kalender.depo_id", $this->session->userdata('depo_id'))
			->where("kalender_detail_tanggal BETWEEN '$tanggal_start' AND '$tanggal_end'")
			->order_by("kalender_detail_tanggal", "DESC");
		$query = $this->db->get();

		return $query->result_array();
	}

	public function GetKalenderByDetailId($kalender_detail_id)
	{
		$this->db->select("kalender_detail_flag_pengajuan,tipe_pengadaan.tipe_pengadaan_nama,kalender.kalender_id,tipe_biaya.tipe_biaya_nama,tipe_biaya.tipe_biaya_id,kategori_biaya.kategori_biaya_nama,kategori_biaya.kategori_biaya_id,tipe_biaya.tipe_biaya_warna,kalender_detail_id,depo_id,kalender_detail_tanggal, agr.anggaran_detail_2_id,agr.anggaran_detail_2_nama_anggaran, kalender_kode, kalender_judul,
				kalender_keterangan,kalender_nama_penerima, kalender_nilai, kalender_default_pembayaran, kalender_no_rekening, kalender_warna,
				kalender_is_recurrence, kalender_tgl_create, bank.bank_account_nama,bank.bank_account_id,
				kalender_who_create, kalender_tgl_update, kalender_who_update, kalender.client_wms_id, perusahaan.client_wms_nama, kalender.tipe_pengadaan_id, ISNULL(kalender.is_kasbon,0) as is_kasbon")
			->from("kalender_detail")
			->join("kalender", "kalender.kalender_id = kalender_detail.kalender_id", "left")
			->join("tipe_biaya", "tipe_biaya.tipe_biaya_id = kalender.tipe_biaya_id", "left")
			->join("tipe_pengadaan", "tipe_pengadaan.tipe_pengadaan_id = kalender.tipe_pengadaan_id", "left")
			->join("kategori_biaya", "kategori_biaya.kategori_biaya_id = kalender.kategori_biaya_id", "left")
			->join("anggaran_detail_2 agr", "kalender.anggaran_detail_2_id = agr.anggaran_detail_2_id", "left")
			->join("bank_account bank", "kalender.bank_account_id = bank.bank_account_id", "left")
			->join("client_wms perusahaan", "perusahaan.client_wms_id = kalender.client_wms_id", "left")
			->where("kalender_detail_id", $kalender_detail_id)

			->order_by("kalender_detail_tanggal", "DESC");
		$query = $this->db->get();

		return $query->row();
	}

	public function GetKalenderBerulang($perusahaan)
	{
		$this->db->select("*")
			->from("kalender")
			->where("kalender_is_recurrence", 1)
			->where("client_wms_id", $perusahaan)
			->order_by("kalender_tgl_create", "DESC");
		$query = $this->db->get();

		return $query->result_array();
	}
	public function GetDetailKalenderByKalenderId($kalender_id)
	{
		$this->db->select("*")
			->from("kalender_detail")

			->where("kalender_id", $kalender_id)

			->order_by("kalender_detail_tanggal", "ASC");
		$query = $this->db->get();

		return $query->result_array();
	}

	public function Getkalender()
	{
		$this->db->select("	kalender_id, depo_id, anggaran_detail_2_id, kalender_kode, kalender_judul,
								kalender_keterangan, kalender_nilai, kalender_default_pembayaran, kalender_no_rekening, kalender_warna,
								kalender_is_recurrence, kalender_tgl_create, 
								kalender_who_create, kalender_tgl_update, kalender_who_update")
			->from("kalender")
			->order_by("kalender_kode", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}
	public function GetCountPengajuanDanaRekap($tipe_biaya_id, $bulan, $tahun)
	{
		$this->db->select("ISNULL(pengajuan_dana_rekap_counter, 0)as count")
			->from("pengajuan_dana_rekap")
			->where("tipe_biaya_id", $tipe_biaya_id)
			->where("pengajuan_dana_rekap_bulan", $bulan)
			->where("pengajuan_dana_rekap_tahun", $tahun);
		// ->order_by("kalender_kode", "ASC");
		$query = $this->db->get();

		// if ($query->num_rows() == 0) {
		// 	return 0;
		// } else {
		return $query->row();
		// }
	}

	public function SaveKalenderEvent($kategori_biaya_id, $tipe_biaya_id, $kalender_judul, $kalender_keterangan, $kalender_selected_date, $kalender_nilai, $kalender_default_pembayaran, $bank_account_id, $kalender_no_rekening, $kalender_nama_penerima, $kalender_is_recurrence, $tipe_berulang, $kalender_warna, $dataBerulang, $perusahaan, $jenis_pengadaan, $is_kasbon)
	{
		$this->db->trans_start();
		$newID1 = $this->M_Function->Get_NewID();
		$newID = $newID1[0]['kode'];

		$this->db->set('kalender_temp_id', $newID);
		$this->db->set('kategori_biaya_id', $kategori_biaya_id == '' ? null : $kategori_biaya_id);
		$this->db->set('tipe_biaya_id', $tipe_biaya_id == '' ? null : $tipe_biaya_id);
		$this->db->set('kalender_selected_date', $kalender_selected_date);
		$this->db->set('kalender_judul', $kalender_judul);
		$this->db->set('kalender_keterangan', $kalender_keterangan);
		$this->db->set('kalender_nilai', (int)$kalender_nilai);
		$this->db->set('kalender_default_pembayaran', $kalender_default_pembayaran);
		$this->db->set('kalender_warna', $kalender_warna);
		$this->db->set('bank_account_id', $bank_account_id);
		$this->db->set('kalender_nama_penerima', $kalender_nama_penerima);
		$this->db->set('kalender_no_rekening', $kalender_no_rekening);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('kalender_tgl_create', "GETDATE()", FALSE);
		$this->db->set('kalender_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('kalender_is_recurrence', $kalender_is_recurrence);
		$this->db->set('client_wms_id', $perusahaan);
		$this->db->set('tipe_pengadaan_id', $jenis_pengadaan);
		$this->db->set('is_kasbon', $is_kasbon);
		//jika berulang
		if ($kalender_is_recurrence == 1) {
			//perulangan harian
			if ($tipe_berulang == 1) {
				$this->db->set('kalender_value1', $dataBerulang['kalender_value1']);
				$this->db->set('kalender_value2', $dataBerulang['kalender_value2']);
				$this->db->set('kalender_modeberakhir', $dataBerulang['kalender_modeberakhir']);
				$this->db->set('kalender_modeberakhirtanggal', $dataBerulang['kalender_modeberakhirtanggal']);
			}
			//perulangan mingguan
			if ($tipe_berulang == 2) {
				$this->db->set('kalender_value1', $dataBerulang['kalender_value1']);
				$this->db->set('kalender_value2', $dataBerulang['kalender_value2']);
				$this->db->set('kalender_senin', $dataBerulang['kalender_senin']);
				$this->db->set('kalender_selasa', $dataBerulang['kalender_selasa']);
				$this->db->set('kalender_rabu', $dataBerulang['kalender_rabu']);
				$this->db->set('kalender_kamis', $dataBerulang['kalender_kamis']);
				$this->db->set('kalender_jumat', $dataBerulang['kalender_jumat']);
				$this->db->set('kalender_sabtu', $dataBerulang['kalender_sabtu']);
				$this->db->set('kalender_minggu', $dataBerulang['kalender_minggu']);
				$this->db->set('kalender_modeberakhir', $dataBerulang['kalender_modeberakhir']);
				$this->db->set('kalender_modeberakhirtanggal', $dataBerulang['kalender_modeberakhirtanggal']);
			}
			if ($tipe_berulang == 3) {
				$this->db->set('kalender_value1', $dataBerulang['kalender_value1']);
				$this->db->set('kalender_value2', $dataBerulang['kalender_value2']);
				$this->db->set('kalender_recurrencebulanan', $dataBerulang['kalender_recurrencebulanan']);
				$this->db->set('kalender_modeberakhir', $dataBerulang['kalender_modeberakhir']);
				$this->db->set('kalender_modeberakhirtanggal', $dataBerulang['kalender_modeberakhirtanggal']);
			}
			if ($tipe_berulang == 4) {
				$this->db->set('kalender_value1', $dataBerulang['kalender_value1']);
				$this->db->set('kalender_value2', $dataBerulang['kalender_value2']);
				$this->db->set('kalender_modeberakhir', $dataBerulang['kalender_modeberakhir']);
				$this->db->set('kalender_modeberakhirtanggal', $dataBerulang['kalender_modeberakhirtanggal']);
			}
		}

		$this->db->insert('kalender_temp');
		// call prosedure
		$queryProsedure = $this->db->query("
			exec kalender_tambah '" . $newID . "'
		");

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			return 0;
		}


		return 1;
	}
	public function DeleteKalenderEvent($mode, $kalender_id, $kalender_detail_id)
	{
		$this->db->trans_start();
		// call prosedure
		if ($kalender_detail_id == null) {
			# code...
			$queryProsedure = $this->db->query("
				exec kalender_hapus '" . $mode . "' ,'" . $kalender_id . "',null
			");
		} else if ($kalender_id == null) {
			# code...
			$queryProsedure = $this->db->query("
				exec kalender_hapus '" . $mode . "' ,null,'" . $kalender_detail_id . "'
			");
		} else {
			$queryProsedure = $this->db->query("
				exec kalender_hapus '" . $mode . "' ,'" . $kalender_id . "','" . $kalender_detail_id . "'
			");
		}

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			return 0;
		}

		return 1;
	}

	public function SavePengajuanDana(
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
		$pengajuan_dana_attacment_1,
		$perusahaan,
		$tipe_transaksi,
		$jenis_pengadaan,
		$no_doc_po,
		$jenis_asset

	) {
		$kalender_detail_id = $kalender_detail_id == '' ? null : $kalender_detail_id;
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
		$jenis_pengadaan = $jenis_pengadaan == '' ? null : $jenis_pengadaan;
		$no_doc_po = $no_doc_po == '' ? null : $no_doc_po;
		$jenis_asset = $jenis_asset == '' ? null : $jenis_asset;
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
		$this->db->set('pengajuan_dana_dari_kalender', 1);
		$this->db->set('pengajuan_dana_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('client_wms_id', $perusahaan);
		$this->db->set('pengajuan_dana_jenis_pengadaan', $jenis_pengadaan);
		$this->db->set('pengajuan_dana_no_doc_po', $no_doc_po == "" || null ? '' : $no_doc_po);
		$this->db->set('pengajuan_dana_jenis_asset', $jenis_asset);
		$this->db->set('pengajuan_dana_tipe_transaksi', $tipe_transaksi);
		$this->db->insert('pengajuan_dana');
		//get data pengajuan dana rekap counter by tipe biaya
		$query  = $this->db->select("*")
			->from("pengajuan_dana_rekap")
			->where("tipe_biaya_id", $tipe_biaya_id)->get();

		$row = $query->row();
		//cek apa ada data pengajuan dana rekap
		if (isset($row)) {
			//update counter rekap pengajuan
			$this->db->set('pengajuan_dana_rekap_counter', $row->pengajuan_dana_rekap_counter + 1);
			$this->db->where("tipe_biaya_id", $tipe_biaya_id);
			$this->db->update('pengajuan_dana_rekap');
		} else {
			//insert pengajuan rekap
			$this->db->set('pengajuan_dana_rekap_id', "NEWID()", FALSE);
			$this->db->set('depo_id', $this->session->userdata('depo_id'));
			$this->db->set('tipe_biaya_id', $tipe_biaya_id);
			$this->db->set('pengajuan_dana_rekap_bulan', date('m'));
			$this->db->set('pengajuan_dana_rekap_tahun', date('Y'));
			$this->db->set('pengajuan_dana_rekap_counter', 1);
			$this->db->insert('pengajuan_dana_rekap');
		}
		//update flag pengajuan in kalender detail
		$this->db->set('kalender_detail_flag_pengajuan', 1);
		$this->db->where("kalender_detail_id", $kalender_detail_id);
		$this->db->update('kalender_detail');

		// exec prosedure approval pengajuan
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
		// $this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();
		return 1;
	}
	/*
	public function Getkalender_top_3_closest()
	{
		$query = $this->db->query("	kalender_id, depo_id, anggaran_detail_2_id, kalender_kode, kalender_judul,
									kalender_keterangan, kalender_nilai, kalender_default_pembayaran, kalender_warna,
									kalender_is_recurrence, kalender_tgl_create, 
									kalender_who_create, kalender_tgl_update, kalender_who_update")
					->from("kalender")
					->order_by("kalender_kode","ASC");
		
		if( $query->num_rows() == 0 )	{ 	return 0;						}
		else							{ 	return $query->result_array();	}
	}
	*/
	public function Getkalender_by_depo_id($depo_id)
	{
		$this->db->select("	kalender_id, depo_id, anggaran_detail_2_id, kalender_kode, kalender_judul,
								kalender_keterangan, kalender_nilai, kalender_default_pembayaran, kalender_warna,
								kalender_is_recurrence, kalender_tgl_create, 
								kalender_who_create, kalender_tgl_update, kalender_who_update")
			->from("kalender")
			->where("depo_id", $depo_id)
			->order_by("kalender_kode", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Getkalender_detail_by_kalender_id($kalender_id)
	{
		$this->db->select("	kalender_detail_id, kalender_id, kalender_detail_tanggal")
			->from("kalender_detail")
			->where("kalender_id", $kalender_id)
			->order_by("kalender_detail_tanggal", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Getkalender_temp_by_kalender_id($kalender_id)
	{
		$this->db->select("	kalender_temp_id, kalender_id, depo_id, anggaran_detail_2_id, kalender_selected_date, kalender_kode,
								kalender_judul, kalender_keterangan, kalender_nilai, kalender_default_pembayaran, kalender_warna,
								kalender_is_recurrence, kalender_tgl_create, kalender_who_create, kalender_tgl_update, kalender_who_update,
								kalender_value1, kalender_value2, 
								kalender_senin, kalender_selasa, kalender_rabu, kalender_kamis, 
								kalender_jumat, kalender_sabtu, kalender_minggu,
								kalender_recurrencebulanan, kalender_modeberakhir, kalender_modeberakhirtanggal ")
			->from("kalender_detail")
			->where("kalender_id", $kalender_id)
			->order_by("kalender_detail_tanggal", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Checkkalender_duplicate_kode($kalender_kode)
	{
		$this->db->select("kalender_kode")
			->from("kalender")
			->where("kalender_kode", $kalender_kode);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Checkkalender_duplicate_nama($kalender_nama)
	{
		$this->db->select("kalender_nama")
			->from("kalender")
			->where("kalender_nama", $kalender_nama);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Checkkalender_duplicate_kode_others($kalender_id, $kalender_lajur_kode)
	{
		$this->db->select("kalender_kode")
			->from("kalender")
			// ->where("kalender_kode", $kalender_kode)
			->where("kalender_kode", $kalender_lajur_kode)
			->where("kalender_id <>", $kalender_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Checkkalender_duplicate_nama_others($kalender_id, $kalender_nama)
	{
		$this->db->select("kalender_nama")
			->from("kalender")
			->where("kalender_nama", $kalender_nama)
			->where("kalender_id <>", $kalender_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	// Rak Lajur
	public function Getkalender_lajur_by_kalender_id($kalender_id)
	{
		$this->db->select("kalender_lajur_id, kalender_id, kalender_lajur_x, kalender_lajur_y, kalender_lajur_width, kalender_lajur_length")
			->from("kalender_lajur")
			->where("kalender_id", $kalender_id)
			->order_by("kalender_lajur_kode", "ASC")
			->order_by("kalender_lajur_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	// Rak Lajur Detail
	public function Getkalender_lajur_detail_by_kalender_lajur_id($kalender_lajur_id)
	{
		$this->db->select("	kalender_lajur_detail_id, kalender_lajur_id, kalender_lajur_detail_baris, kalender_lajur_detail_baris_alias, 
								kalender_lajur_detail_kolom, kalender_lajur_detail_kolom_alias, kalender_lajur_detail_nama")
			->from("kalender_lajur_detail")
			->where("kalender_lajur_id", $kalender_lajur_id)
			->order_by("kalender_lajur_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Insertkalender($kalender_id, $depo_id, $depo_detail_id, $kalender_kode, $kalender_nama, $kalender_is_aktif)
	{
		$this->db->set("kalender_id", $kalender_id);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("depo_detail_id", $depo_detail_id);
		$this->db->set("kalender_kode", $kalender_kode);
		$this->db->set("kalender_nama", $kalender_nama);
		$this->db->set("kalender_is_aktif", $kalender_is_aktif);

		$this->db->insert("kalender");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows == 0) {
			return 0;
		} else {
			return 1;
		}
	}

	public function Insertkalender_lajur(
		$kalender_lajur_id,
		$kalender_id,
		$kalender_lajur_x,
		$kalender_lajur_y,
		$kalender_lajur_width,
		$kalender_lajur_length,
		$kalender_lajur_nama,
		$kalender_lajur_prefix
	) {
		$this->db->set("kalender_lajur_id", $kalender_lajur_id);
		$this->db->set("kalender_id", $kalender_id);
		$this->db->set("kalender_lajur_x", $kalender_lajur_x);
		$this->db->set("kalender_lajur_y", $kalender_lajur_y);
		$this->db->set("kalender_lajur_width", $kalender_lajur_width);
		$this->db->set("kalender_lajur_length", $kalender_lajur_length);
		$this->db->set("kalender_lajur_nama", $kalender_lajur_nama);
		$this->db->set("kalender_lajur_prefix", $kalender_lajur_prefix);

		$this->db->insert("kalender_lajur");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows == 0) {
			return 0;
		} else {
			return 1;
		}
	}

	public function Insertkalender_lajur_detail($kalender_lajur_detail_id, $kalender_lajur_id, $kalender_id, $kalender_lajur_detail_baris, $kalender_lajur_detail_kolom, $kalender_lajur_detail_nama)
	{
		$this->db->set("kalender_lajur_detail_id", $kalender_lajur_detail_id);
		$this->db->set("kalender_lajur_id", $kalender_lajur_id);
		$this->db->set("kalender_id", $kalender_id);
		$this->db->set("kalender_lajur_detail_baris", $kalender_lajur_detail_baris);
		$this->db->set("kalender_lajur_detail_kolom", $kalender_lajur_detail_kolom);
		$this->db->set("kalender_lajur_detail_nama", $kalender_lajur_detail_nama);

		$this->db->insert("kalender_lajur_detail");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows == 0) {
			return 0;
		} else {
			return 1;
		}
	}

	public function insert_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $kalender_id, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening, $nama_pemohon, $keterangan)
	{

		$purchase_request_id = $purchase_request_id == "" ? null : $purchase_request_id;
		$purchase_request_kode = $purchase_request_kode == "" ? null : $purchase_request_kode;

		$depo_id = $depo_id == "" ? null : $depo_id;
		$gudang_id = $gudang_id == "" ? null : $gudang_id;
		$client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
		$tipe_pengadaan_id = $tipe_pengadaan_id == "" ? null : $tipe_pengadaan_id;
		$tipe_transaksi_id = $tipe_transaksi_id == "" ? null : $tipe_transaksi_id;
		$tipe_kepemilikan_id = $tipe_kepemilikan_id == "" ? null : $tipe_kepemilikan_id;
		$kategori_biaya_id = $kategori_biaya_id == "" ? null : $kategori_biaya_id;
		$tipe_biaya_id = $tipe_biaya_id == "" ? null : $tipe_biaya_id;
		$purchase_request_status = $purchase_request_status == "" ? null : $purchase_request_status;
		$purchase_request_tgl = $purchase_request_tgl == "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $purchase_request_tgl)));
		$purchase_request_tgl_dibutuhkan = $purchase_request_tgl_dibutuhkan == "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $purchase_request_tgl_dibutuhkan)));
		// $purchase_request_tgl_create = $purchase_request_tgl_create == "" ? null : $purchase_request_tgl_create;
		// $purchase_request_who_create = $purchase_request_who_create == "" ? null : $purchase_request_who_create;
		$purchase_request_keterangan = $purchase_request_keterangan == "" ? null : $purchase_request_keterangan;
		$purchase_request_pemohon = $purchase_request_pemohon == "" ? null : $purchase_request_pemohon;
		$karyawan_divisi_id = $karyawan_divisi_id == "" ? null : $karyawan_divisi_id;
		$kalender_id = $kalender_id == "" ? null : $kalender_id;
		$judul = $judul == "" ? null : $judul;
		$anggaran_detail_2_id = $anggaran_detail_2_id == "" ? null : $anggaran_detail_2_id;
		$default_pembayaran = $default_pembayaran == "" ? null : $default_pembayaran;
		$bank_penerima = $bank_penerima == "" ? null : $bank_penerima;
		$nama_penerima = $nama_penerima == "" ? null : $nama_penerima;
		$no_rekening = $no_rekening == "" ? null : $no_rekening;
		$nama_pemohon = $nama_pemohon == "" ? null : $nama_pemohon;
		$keterangan = $keterangan == "" ? null : $keterangan;

		$this->db->set("purchase_request_id", $purchase_request_id);
		$this->db->set("purchase_request_kode", $purchase_request_kode);
		$this->db->set("depo_id", $this->session->userdata('depo_id'));
		$this->db->set("gudang_id", $gudang_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("tipe_pengadaan_id", $tipe_pengadaan_id);
		$this->db->set("tipe_transaksi_id", $tipe_transaksi_id);
		$this->db->set("tipe_kepemilikan_id", $tipe_kepemilikan_id);
		$this->db->set("kategori_biaya_id", $kategori_biaya_id);
		$this->db->set("tipe_biaya_id", $tipe_biaya_id);
		$this->db->set("purchase_request_status", $purchase_request_status);
		$this->db->set("purchase_request_tgl", "GETDATE()", false);
		$this->db->set("purchase_request_tgl_dibutuhkan", $purchase_request_tgl_dibutuhkan);
		$this->db->set("purchase_request_tgl_create", "GETDATE()", FALSE);
		$this->db->set("purchase_request_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("purchase_request_keterangan", $keterangan);
		$this->db->set("purchase_request_pemohon", $nama_pemohon);
		$this->db->set("karyawan_divisi_id", $karyawan_divisi_id);
		$this->db->set("kalender_id", $kalender_id);
		$this->db->set("pengajuan_dana_judul", $judul);
		$this->db->set("anggaran_detail_2_id", $anggaran_detail_2_id);
		$this->db->set("pengajuan_dana_default_pembayaran", $default_pembayaran);
		$this->db->set("bank_account_id", $bank_penerima);
		$this->db->set("pengajuan_dana_penerima", $nama_penerima);
		$this->db->set("pengajuan_dana_rekening_penerima", $no_rekening);

		$queryinsert = $this->db->insert("purchase_request");

		return $queryinsert;
		// return $this->db->last_query();
	}
	public function updateFlagPengajuanAndPurchaseRequest($kalender_detail_id)
	{

		$this->db->set('kalender_detail_flag_pengajuan', 1);
		$this->db->where("kalender_detail_id", $kalender_detail_id);

		return $this->db->update('kalender_detail');
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
}
