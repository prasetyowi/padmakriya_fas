<?php

class M_PurchaseRequest extends CI_Model
{
	public function Getbank()
	{
		$query = $this->db->select("*")->from("bank_account")->where("bank_account_is_aktif", 1)->get();
		return $query->result_array();
	}
	public function GetAnggaranDetail2ByYearDepoClient()
	{

		//get anggaran level 0 and approved and depo and pt
		$query = $this->db->select("anggaran_detail_2.*")->from("anggaran_detail_2")
			->join("anggaran", 'anggaran.anggaran_id = anggaran_detail_2.anggaran_id', 'left')
			->join("anggaran_detail", 'anggaran_detail.anggaran_detail_id = anggaran_detail_2.anggaran_detail_id', 'left')
			// ->where("anggaran.anggaran_tahun", date("Y"))
			->where("anggaran.anggaran_tahun", date('Y'))
			// ->where("anggaran.depo_id", $this->session->userdata('depo_id'))
			// ->where("anggaran.client_wms_id", $client_wms_id)
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

	public function GetKategoriBiaya()
	{
		$this->db->select("*")
			->from("kategori_biaya")
			->where("kategori_biaya_is_aktif", "1")
			->order_by("kategori_biaya_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeBiaya()
	{
		$this->db->select("*")
			->from("tipe_biaya")
			->where("tipe_biaya_is_aktif", "1")
			->order_by("tipe_biaya_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeKepemilikan()
	{
		$this->db->select("*")
			->from("tipe_kepemilikan")
			->where("tipe_kepemilikan_is_aktif", "1")
			->order_by("tipe_kepemilikan_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetDivisi()
	{
		$this->db->select("*")
			->from("karyawan_divisi")
			->where("karyawan_divisi_is_aktif", "1")
			->order_by("karyawan_divisi_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPerusahaanOld()
	{
		$query = $this->db->query("SELECT * FROM client_wms 
									WHERE client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
									ORDER BY client_wms_nama ASC");

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

	public function GetSupplier()
	{
		$this->db->select("*")
			->from("principle")
			->where("principle_is_aktif", "1")
			// ->where("principle_is_for_procurement", "1")
			// ->where("principle_is_deleted", "0")
			->order_by("principle_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPerusahaanBySales($sales)
	{

		$query = $this->db->query("SELECT * FROM client_wms 
									WHERE client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '$sales' GROUP BY client_wms_id)
									ORDER BY client_wms_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetSales()
	{
		$this->db->select("*")
			->from("karyawan")
			->where("depo_id", $this->session->userdata('depo_id'))
			->where("karyawan_divisi_id", 'A2A0C245-2265-4402-A20D-952454F4641B')
			// ->where("karyawan_id", 'A8601C5F-741B-4088-BD9E-883DDFA11A3F')
			->order_by("karyawan_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPerusahaanById($id)
	{
		$this->db->select("*")
			->from("client_wms")
			->where("client_wms_id", $id)
			->order_by("client_wms_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}


	public function GetArea()
	{
		$query = $this->db->query("SELECT
										area.*
									FROM depo_area_header
									LEFT JOIN area_header
									ON depo_area_header.area_header_id = area_header.area_header_id
									LEFT JOIN area
									ON area_header.area_header_id = area.area_header_id
									WHERE depo_area_header.depo_id = '" . $this->session->userdata('depo_id') . "'
									ORDER BY area.area_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function search_purchase_request_by_filter($tgl1, $tgl2, $perusahaan, $divisi, $tipe_transaksi_id)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND purchase_request.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($divisi == "") {
			$divisi = "";
		} else {
			$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
		}
		if ($tipe_transaksi_id == "") {
			$tipe_transaksi_id = "";
		} else {
			$tipe_transaksi_id = "AND purchase_request.tipe_transaksi_id  = '" . $tipe_transaksi_id . "' ";
		}

		$query = $this->db->query("SELECT
										purchase_request.karyawan_divisi_id,
										karyawan_divisi.karyawan_divisi_nama,
										purchase_request.purchase_request_id,
										purchase_request.purchase_request_kode,
										tipe_transaksi.tipe_transaksi_nama,
										FORMAT(purchase_request.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') AS purchase_request_tgl,
										purchase_request.purchase_request_status,
										purchase_request.purchase_request_pemohon,
										purchase_request.purchase_request_who_create,
										FORMAT(purchase_request.purchase_request_tgl_create,'dd-MM-yyyy') AS purchase_request_tgl_create,
										approval.approval_karyawan_id AS approval_by_id,
										ISNULL(approval_by.karyawan_nama,'') AS approval_by_nama,
										ISNULL(karyawan_level.karyawan_level_nama,'') AS jabatan,
										ISNULL(FORMAT(approval.approval_tanggal,'dd-MM-yyyy'),'') AS approval_tanggal,
										tipe_pengadaan.tipe_pengadaan_nama
									FROM purchase_request
									LEFT JOIN purchase_request_detail
									ON purchase_request.purchase_request_id = purchase_request_detail.purchase_order_id
									LEFT JOIN approval
									ON purchase_request.purchase_request_id = approval.approval_reff_dokumen_id
									LEFT JOIN karyawan approval_by
									ON approval_by.karyawan_id = approval.approval_karyawan_id
									LEFT JOIN karyawan_divisi
									ON karyawan_divisi.karyawan_divisi_id = purchase_request.karyawan_divisi_id
									LEFT JOIN karyawan_level
									ON karyawan_level.karyawan_level_id = approval_by.karyawan_level_id
									LEFT JOIN tipe_transaksi 
									ON tipe_transaksi.tipe_transaksi_id = purchase_request.tipe_transaksi_id
									LEFT JOIN tipe_pengadaan
									ON tipe_pengadaan.tipe_pengadaan_id = purchase_request.tipe_pengadaan_id
									WHERE FORMAT(purchase_request.purchase_request_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									AND purchase_request.depo_id = '" . $this->session->userdata('depo_id') . "'
									--AND purchase_request.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
									" . $perusahaan . "
									" . $divisi . "
									
									ORDER BY purchase_request.purchase_request_tgl_create DESC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetPurchaseRequestHeaderById($id)
	{
		$query = $this->db->query("SELECT
									purchase_request_id,
									purchase_request_kode,
									depo_id,
									gudang_id,
									client_wms_id,
									karyawan_divisi_id,
									tipe_pengadaan_id,
									tipe_transaksi_id,
									tipe_kepemilikan_id,
									kategori_biaya_id,
									tipe_biaya_id,
									purchase_request_status,
									FORMAT(purchase_request_tgl, 'dd-MM-yyyy') AS purchase_request_tgl,
									FORMAT(purchase_request_tgl_dibutuhkan, 'dd-MM-yyyy') AS purchase_request_tgl_dibutuhkan,
									purchase_request_tgl_create,
									purchase_request_who_create,
									purchase_request_keterangan,
									purchase_request_pemohon,
									pengajuan_dana_judul,
									anggaran_detail_2_id,
									pengajuan_dana_default_pembayaran,
									bank_account_id,
									pengajuan_dana_penerima,
									pengajuan_dana_rekening_penerima,
									pengajuan_dana_attacment_1
									FROM purchase_request
									WHERE purchase_request_id = '$id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetPurchaseRequestDetailByIdandSupplierId($id, $sp_id)
	{
		// $arrOpnameId = [];

		// for ($i = 0; $i < count($sp_id); $i++) {
		// 	$arrOpnameId[$i] = "'" . $sp_id[$i] . "'";
		// }
		$query = $this->db->query("SELECT
					purchase_request_detail.purchase_request_detail_id,
					purchase_request_detail.purchase_request_id,
					purchase_request_detail.supplier_id,
					supplier.supplier_id,
					supplier.supplier_nama,
					purchase_request_detail.sku_barang_id,
					purchase_request_detail.sku_barang_kode,
					purchase_request_detail.sku_barang_nama_produk,
					sku_barang_harga,
					sku_barang.sku_barang_satuan,
					sku_barang.sku_barang_kemasan,
					ISNULL(purchase_request_detail.purchase_request_detail_qty_req, 0) AS purchase_request_detail_qty_req,
					ISNULL(purchase_request_detail.purchase_request_detail_qty_approve, 0) AS purchase_request_detail_qty_approve,
					ISNULL(purchase_request_detail.purchase_request_detail_qty_po, 0) AS purchase_request_detail_qty_po,
					ISNULL(purchase_request_detail.purchase_request_detail_qty_terima, 0) AS purchase_request_detail_qty_terima,
					purchase_request_detail.purchase_order_id,
					purchase_request_detail.purchase_order_kode,
					purchase_request_detail.purchase_request_detail_keterangan
				FROM purchase_request_detail
				LEFT JOIN sku_barang
				ON purchase_request_detail.sku_barang_id = sku_barang.sku_barang_id
				LEFT JOIN supplier
				ON purchase_request_detail.supplier_id = supplier.supplier_id
				WHERE purchase_request_detail.supplier_id ='$sp_id' and purchase_request_detail.purchase_request_id = '$id'
				ORDER BY purchase_request_detail.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetDataPobyId($pr_id)
	{
		$query = $this->db->query("select *,FORMAT(purchase_order_tgl_create, 'dd-MM-yyyy') as tgl_po from purchase_order po left join
		supplier s on s.supplier_id = po.supplier_id  where po.purchase_request_id ='$pr_id'");
		// $query = $this->db->query("select * from purchase_order po left join purchase_order_detail pod on
		// po.purchase_order_id = pod.purchase_order_id where po.purchase_request_id = '$pr_id'");
		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function cek_po($pr_id, $sp_id)
	{
		$query = $this->db->query("select * from purchase_order po where po.purchase_request_id ='$pr_id' and po.supplier_id ='$sp_id'");
		// $query = $this->db->query("select * from purchase_order po left join purchase_order_detail pod on
		// po.purchase_order_id = pod.purchase_order_id where po.purchase_request_id = '$pr_id'");
		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}
	public function GetDataPOSupplierByIdPo($pr_id, $po_id)
	{
		$query = $this->db->query("select *,pod.sku_barang_qty as qty from purchase_order_detail pod left join sku_barang sk on sk.sku_barang_id  = pod.sku_barang_id where purchase_order_id= '$po_id'");
		// $query = $this->db->query("select * from purchase_order po left join purchase_order_detail pod on
		// po.purchase_order_id = pod.purchase_order_id where po.purchase_request_id = '$pr_id'");
		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function GetSupplierByArea($area_id, $nama_supplier, $arr)
	{
		// if ($nama_supplier == "") {
		// 	$nama_supplier = "";
		// } else {
		// 	$nama_supplier = "and supplier_nama like '%$nama_supplier%'";
		// }
		$arrSupplierId = [];


		if (empty($arr)) {
			$not = '';
		} else {
			for ($i = 0; $i < count($arr); $i++) {
				$arrSupplierId[$i] = "'" . $arr[$i] . "'";
			}
			$not = "and supplier_id not in (" . implode(',', $arrSupplierId) . ")";
		}

		$query = $this->db->query("select * from supplier where supplier_nama like '%$nama_supplier%' " . $not . "");

		// $query = $this->db->query("select * from purchase_order po left join purchase_order_detail pod on
		// po.purchase_order_id = pod.purchase_order_id where po.purchase_request_id = '$pr_id'");
		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPurchaseRequestDetailById($id)
	{
		$query = $this->db->query("SELECT
										purchase_request_detail.purchase_request_detail_id,
										purchase_request_detail.purchase_request_id,
										purchase_request_detail.supplier_id,
										supplier.supplier_id,
										supplier.supplier_nama,
										purchase_request_detail.sku_barang_id,
										purchase_request_detail.sku_barang_kode,
										purchase_request_detail.sku_barang_nama_produk,
										sku_barang_harga,
										sku_barang.sku_barang_satuan,
										sku_barang.sku_barang_kemasan,
										ISNULL(purchase_request_detail.purchase_request_detail_qty_req, 0) AS purchase_request_detail_qty_req,
										ISNULL(purchase_request_detail.purchase_request_detail_qty_approve, 0) AS purchase_request_detail_qty_approve,
										ISNULL(purchase_request_detail.purchase_request_detail_qty_po, 0) AS purchase_request_detail_qty_po,
										ISNULL(purchase_request_detail.purchase_request_detail_qty_terima, 0) AS purchase_request_detail_qty_terima,
										purchase_request_detail.purchase_order_id,
										purchase_request_detail.purchase_order_kode,
										purchase_request_detail.purchase_request_detail_keterangan
									FROM purchase_request_detail
									LEFT JOIN sku_barang
									ON purchase_request_detail.sku_barang_id = sku_barang.sku_barang_id
									LEFT JOIN supplier
									ON purchase_request_detail.supplier_id = supplier.supplier_id
									WHERE purchase_request_detail.purchase_request_id = '$id'
									ORDER BY purchase_request_detail.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
	public function GetPurchaseRequestDetailSupplierById($id)
	{
		$query = $this->db->query("SELECT
					purchase_request_detail.purchase_request_id,
					purchase_request_detail.supplier_id,
					supplier.supplier_id,
					supplier.supplier_nama
				FROM purchase_request_detail
				LEFT JOIN supplier
				ON purchase_request_detail.supplier_id = supplier.supplier_id
				WHERE purchase_request_detail.purchase_request_id = '$id'
				group by purchase_request_detail.purchase_request_id,
					purchase_request_detail.supplier_id,
					supplier.supplier_id,
					supplier.supplier_nama");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
	public function GetPurchaseRequestDetailSupplierByIdInPo($id)
	{
		$query = $this->db->query("select po.supplier_id from purchase_order po where po.purchase_request_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_filter_chosen_sku($perusahaan, $sku_kode, $sku_nama_produk, $tipe_pengadaan)
	{
		$perusahaan = $perusahaan == "" ? "" : " AND sku_barang.client_wms_id = '" . $perusahaan . "' ";
		$sku_kode = $sku_kode == "" ? "" : " AND sku_barang_kode LIKE '%" . $sku_kode . "%' ";
		$sku_nama_produk = $sku_nama_produk == "" ? "" : " AND sku_barang_nama_produk LIKE '%" . $sku_nama_produk . "%' ";

		$getpengadaan = $this->db->query("select tipe_pengadaan_nama from tipe_pengadaan where tipe_pengadaan_id='$tipe_pengadaan' ")->row();


		if ($getpengadaan->tipe_pengadaan_nama == "Non PO") {
			$tipe_pengadaan = '';
		} else {
			$tipe_pengadaan = $tipe_pengadaan == "" ? "" : " AND tipe_pengadaan_id = '$tipe_pengadaan'";
		}

		$query = $this->db->query("SELECT
									sku_barang_id,
									sku_barang.depo_id,
									gudang_id,
									sku_barang.client_wms_id,
									ISNULL(sku_barang_kode,'') AS sku_barang_kode,
									ISNULL(sku_barang_satuan,'') AS sku_barang_satuan,
									ISNULL(sku_barang_kemasan,'') AS sku_barang_kemasan,
									kemasan_id,
									ISNULL(sku_barang_qty,0) AS sku_barang_qty,
									ISNULL(sku_barang_harga_jual,0) AS sku_barang_harga_jual,
									ISNULL(sku_barang_harga_beli,0) AS sku_barang_harga_beli,
									ISNULL(sku_barang_nama_produk,'') AS sku_barang_nama_produk,
									sku_barang_deskripsi,
									sku_barang_is_aktif,
									sku_barang_is_deleted
									FROM sku_barang
									where sku_barang_is_aktif = '1'
									AND ISNULL(sku_barang_is_deleted,'0') = '0'
									" . $tipe_pengadaan . "
									" . $perusahaan . "
									" . $sku_kode . "
									" . $sku_nama_produk . "
									ORDER BY sku_barang_kode ASC");
		// $query = $this->db->query("SELECT
		// 							sku_barang_id,
		// 							sku_barang.depo_id,
		// 							gudang_id,
		// 							sku_barang.client_wms_id,
		// 							client_wms.client_wms_nama,
		// 							ISNULL(sku_barang_kode,'') AS sku_barang_kode,
		// 							ISNULL(sku_barang_satuan,'') AS sku_barang_satuan,
		// 							ISNULL(sku_barang_kemasan,'') AS sku_barang_kemasan,
		// 							kemasan_id,
		// 							ISNULL(sku_barang_qty,0) AS sku_barang_qty,
		// 							ISNULL(sku_barang_harga_jual,0) AS sku_barang_harga_jual,
		// 							ISNULL(sku_barang_harga_beli,0) AS sku_barang_harga_beli,
		// 							ISNULL(sku_barang_nama_produk,'') AS sku_barang_nama_produk,
		// 							sku_barang_deskripsi,
		// 							sku_barang_is_aktif,
		// 							sku_barang_is_deleted
		// 							FROM sku_barang
		// 							LEFT JOIN client_wms
		// 							ON client_wms.client_wms_id = sku_barang.client_wms_id
		// 							WHERE sku_barang.depo_id = '" . $this->session->userdata('depo_id') . "' 
		// 							AND sku_barang.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)
		// 							AND sku_barang_is_aktif = '1'
		// 							AND ISNULL(sku_barang_is_deleted,'0') = '0'
		// 							" . $perusahaan . "
		// 							" . $sku_kode . "
		// 							" . $sku_nama_produk . "
		// 							ORDER BY sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSelectedSKU($sku_id)
	{
		$sku_id = implode(",", $sku_id);

		$query = $this->db->query("SELECT
									sku_barang_id,
									sku_barang.depo_id,
									gudang_id,
									sku_barang.client_wms_id,
									client_wms.client_wms_nama,
									ISNULL(sku_barang_kode,'') AS sku_barang_kode,
									ISNULL(sku_barang_satuan,'') AS sku_barang_satuan,
									ISNULL(sku_barang_kemasan,'') AS sku_barang_kemasan,
									kemasan_id,
									ISNULL(sku_barang_qty,0) AS sku_barang_qty,
									ISNULL(sku_barang_harga_jual,0) AS sku_barang_harga_jual,
									ISNULL(sku_barang_harga_beli,0) AS sku_barang_harga_beli,
									ISNULL(sku_barang_nama_produk,'') AS sku_barang_nama_produk,
									sku_barang_deskripsi,
									sku_barang_is_aktif,
									sku_barang_is_deleted
									FROM sku_barang
									LEFT JOIN client_wms
									ON client_wms.client_wms_id = sku_barang.client_wms_id
									WHERE sku_barang.sku_barang_id IN (" . $sku_id . ")
									ORDER BY sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function insert_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $name_file, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening)
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
		$judul = $judul == "" ? null : $judul;
		$anggaran_detail_2_id = $anggaran_detail_2_id == "" ? null : $anggaran_detail_2_id;
		$default_pembayaran = $default_pembayaran == "" ? null : $default_pembayaran;
		$bank_penerima = $bank_penerima == "" ? null : $bank_penerima;
		$no_rekening = $no_rekening == "" ? null : $no_rekening;
		$name_file = $name_file == "" ? null : $name_file;

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
		$this->db->set("purchase_request_tgl", $purchase_request_tgl);
		$this->db->set("purchase_request_tgl_dibutuhkan", $purchase_request_tgl_dibutuhkan);
		$this->db->set("purchase_request_tgl_create", "GETDATE()", FALSE);
		$this->db->set("purchase_request_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("purchase_request_keterangan", $purchase_request_keterangan);
		$this->db->set("purchase_request_pemohon", $purchase_request_pemohon);
		$this->db->set("pengajuan_dana_judul", $judul);
		$this->db->set("anggaran_detail_2_id", $anggaran_detail_2_id);
		$this->db->set("pengajuan_dana_default_pembayaran", $default_pembayaran);
		$this->db->set("bank_account_id", $bank_penerima);
		$this->db->set("pengajuan_dana_penerima", $nama_penerima);
		$this->db->set("pengajuan_dana_rekening_penerima", $no_rekening);
		$this->db->set("karyawan_divisi_id", $karyawan_divisi_id);
		$this->db->set("pengajuan_dana_attacment_1", $name_file);

		$queryinsert = $this->db->insert("purchase_request");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_purchase_request_detail($purchase_request_id, $data)
	{
		// $purchase_request_detail_id = $data['purchase_request_detail_id'] == "" ? null : $data['purchase_request_detail_id'];
		// $purchase_request_id = $data['purchase_request_id'] == "" ? null : $data['purchase_request_id'];
		$principle_id = $data->principle_id == "" ? null : $data->principle_id;
		$sku_barang_id = $data->sku_barang_id == "" ? null : $data->sku_barang_id;
		$sku_barang_kode = $data->sku_barang_kode == "" ? null : $data->sku_barang_kode;
		$sku_barang_nama_produk = $data->sku_barang_nama_produk == "" ? null : $data->sku_barang_nama_produk;
		$sku_barang_harga = $data->sku_barang_harga == "" ? null : $data->sku_barang_harga;
		$purchase_request_detail_qty_req = $data->purchase_request_detail_qty_req == "" ? null : $data->purchase_request_detail_qty_req;
		$purchase_request_detail_qty_approve = $data->purchase_request_detail_qty_approve == "" ? null : $data->purchase_request_detail_qty_approve;
		$purchase_request_detail_qty_po = $data->purchase_request_detail_qty_po == "" ? null : $data->purchase_request_detail_qty_po;
		$purchase_request_detail_qty_terima = $data->purchase_request_detail_qty_terima == "" ? null : $data->purchase_request_detail_qty_terima;
		// $purchase_order_id = $data->purchase_order_id == "" ? null : $data->purchase_order_id;
		// $purchase_order_kode = $data->purchase_order_kode == "" ? null : $data->purchase_order_kode;
		$purchase_request_detail_keterangan = $data->purchase_request_detail_keterangan == "" ? null : $data->purchase_request_detail_keterangan;

		$this->db->set("purchase_request_detail_id", "NEWID()", FALSE);
		$this->db->set("purchase_request_id", $purchase_request_id);
		$this->db->set("supplier_id", $principle_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_kode", $sku_barang_kode);
		$this->db->set("sku_barang_nama_produk", $sku_barang_nama_produk);
		$this->db->set("sku_barang_harga", $sku_barang_harga);
		$this->db->set("purchase_request_detail_qty_req", $purchase_request_detail_qty_req);
		$this->db->set("purchase_request_detail_qty_approve", $purchase_request_detail_qty_approve);
		$this->db->set("purchase_request_detail_qty_po", $purchase_request_detail_qty_po);
		$this->db->set("purchase_request_detail_qty_terima", $purchase_request_detail_qty_terima);
		// $this->db->set("purchase_order_id", $purchase_order_id);
		// $this->db->set("purchase_order_kode", $purchase_order_kode);
		$this->db->set("purchase_request_detail_keterangan", $purchase_request_detail_keterangan);

		$queryinsert = $this->db->insert("purchase_request_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_purchase_request($purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $tipe_pengadaan_id, $tipe_transaksi_id, $tipe_kepemilikan_id, $kategori_biaya_id, $tipe_biaya_id, $purchase_request_status, $purchase_request_tgl, $purchase_request_tgl_dibutuhkan, $purchase_request_tgl_create, $purchase_request_who_create, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $name_file, $judul, $anggaran_detail_2_id, $nama_penerima, $default_pembayaran, $bank_penerima, $no_rekening, $type)
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
		$judul = $judul == "" ? null : $judul;
		$anggaran_detail_2_id = $anggaran_detail_2_id == "" ? null : $anggaran_detail_2_id;
		$default_pembayaran = $default_pembayaran == "" ? null : $default_pembayaran;
		$bank_penerima = $bank_penerima == "" ? null : $bank_penerima;
		$no_rekening = $no_rekening == "" ? null : $no_rekening;
		$name_file = $name_file == "" ? null : $name_file;


		// $this->db->set("purchase_request_id", $purchase_request_id);
		// $this->db->set("purchase_request_kode", $purchase_request_kode);
		// $this->db->set("depo_id", $this->session->userdata('depo_id'));
		// $this->db->set("gudang_id", $gudang_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("tipe_pengadaan_id", $tipe_pengadaan_id);
		$this->db->set("tipe_transaksi_id", $tipe_transaksi_id);
		$this->db->set("tipe_kepemilikan_id", $tipe_kepemilikan_id);
		$this->db->set("kategori_biaya_id", $kategori_biaya_id);
		$this->db->set("tipe_biaya_id", $tipe_biaya_id);
		$this->db->set("purchase_request_status", $purchase_request_status);
		$this->db->set("purchase_request_tgl", $purchase_request_tgl);
		$this->db->set("purchase_request_tgl_dibutuhkan", $purchase_request_tgl_dibutuhkan);
		// $this->db->set("purchase_request_tgl_create", "GETDATE()", FALSE);
		// $this->db->set("purchase_request_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("purchase_request_keterangan", $purchase_request_keterangan);
		$this->db->set("purchase_request_pemohon", $purchase_request_pemohon);
		$this->db->set("karyawan_divisi_id", $karyawan_divisi_id);
		$this->db->set("pengajuan_dana_judul", $judul);
		$this->db->set("anggaran_detail_2_id", $anggaran_detail_2_id);
		$this->db->set("pengajuan_dana_default_pembayaran", $default_pembayaran);
		$this->db->set("bank_account_id", $bank_penerima);
		$this->db->set("pengajuan_dana_penerima", $nama_penerima);
		$this->db->set("pengajuan_dana_rekening_penerima", $no_rekening);
		if ($type == 1) {
			$this->db->set("pengajuan_dana_attacment_1", $name_file);
		}
		$this->db->where("purchase_request_id", $purchase_request_id);

		$queryinsert = $this->db->update("purchase_request");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_purchase_request_detail($purchase_request_id)
	{
		$this->db->where("purchase_request_id", $purchase_request_id);
		return $this->db->delete('purchase_request_detail');
	}

	public function insert_purchase_order($purchase_order_id, $purchase_request_id, $purchase_request_kode, $depo_id, $gudang_id, $client_wms_id, $purchase_request_keterangan, $purchase_request_pemohon, $karyawan_divisi_id, $supplier_id)
	{
		$purchase_request_id = $purchase_request_id == "" ? null : $purchase_request_id;
		$purchase_request_kode = $purchase_request_kode == "" ? null : $purchase_request_kode;
		$depo_id = $depo_id == "" ? null : $depo_id;
		$gudang_id = $gudang_id == "" ? null : $gudang_id;
		$client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
		$purchase_request_keterangan = $purchase_request_keterangan == "" ? null : $purchase_request_keterangan;
		$purchase_request_pemohon = $purchase_request_pemohon == "" ? null : $purchase_request_pemohon;
		$karyawan_divisi_id = $karyawan_divisi_id == "" ? null : $karyawan_divisi_id;
		$supplier_id = $supplier_id == "" ? null : $supplier_id;

		// $this->db->set("purchase_order_id", "NEWID()", FALSE);
		$this->db->set("purchase_order_id", $purchase_order_id);
		$this->db->set("purchase_request_id", $purchase_request_id);
		$this->db->set("purchase_order_kode", $purchase_request_kode);
		$this->db->set("depo_id", $this->session->userdata('depo_id'));
		$this->db->set("gudang_id", $gudang_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("karyawan_divisi_id", $karyawan_divisi_id);
		$this->db->set("supplier_id", $supplier_id);
		$this->db->set("purchase_order_status", "In Progress");
		$this->db->set("purchase_order_tgl_create", "GETDATE()", FALSE);
		$this->db->set("purchase_order_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("purchase_order_keterangan", $purchase_request_keterangan);

		$queryinsert = $this->db->insert("purchase_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_purchase_order_detail($purchase_order_id, $data)
	{

		$sku_barang_id = $data->sku_barang_id == "" ? null : $data->sku_barang_id;
		$sku_barang_satuan = $data->sku_barang_satuan == "" ? null : $data->sku_barang_satuan;
		$sku_barang_qty_terima = $data->purchase_request_detail_qty_terima == "" ? null : $data->purchase_request_detail_qty_terima;
		$sku_barang_harga = $data->sku_barang_harga == "" ? null : $data->sku_barang_harga;
		$sku_barang_qty = $data->purchase_request_detail_qty_req == "" ? null : $data->purchase_request_detail_qty_req;
		$sku_barang_qty_sisa = $data->purchase_request_detail_qty_approve == "" ? null : $data->purchase_request_detail_qty_approve;

		$purchase_order_detail_keterangan = $data->purchase_request_detail_keterangan == "" ? null : $data->purchase_request_detail_keterangan;

		$this->db->set("purchase_order_detail_id", "NEWID()", FALSE);
		$this->db->set("purchase_order_id", $purchase_order_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_satuan", $sku_barang_satuan);
		$this->db->set("sku_barang_qty", $sku_barang_qty);
		$this->db->set("sku_barang_harga", $sku_barang_harga);
		$this->db->set("sku_barang_qty_terima", NULL);
		$this->db->set("sku_barang_qty_sisa", NULL);
		// $this->db->set("purchase_order_id", $purchase_order_id);
		// $this->db->set("purchase_order_kode", $purchase_order_kode);
		$this->db->set("purchase_order_detail_keterangan", $purchase_order_detail_keterangan);

		$queryinsert = $this->db->insert("purchase_order_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}
	public function update_purchase_request_kode_only($purchase_order_id, $purchase_request_id, $purchase_request_kode, $data, $supplier_id)
	{
		$purchase_request_detail_qty_po = $data->purchase_request_detail_qty_req == "" ? null : $data->purchase_request_detail_qty_req;
		$sku_barang_id = $data->sku_barang_id == "" ? null : $data->sku_barang_id;
		$this->db->set("purchase_order_id", $purchase_order_id);
		$this->db->set("purchase_order_kode", $purchase_request_kode);
		$this->db->set("purchase_request_detail_qty_po", $purchase_request_detail_qty_po);

		$this->db->where("purchase_request_id", $purchase_request_id);
		$this->db->where("supplier_id", $supplier_id);
		$this->db->where("sku_barang_id", $sku_barang_id);

		$queryinsert = $this->db->update("purchase_request_detail");

		return $queryinsert;
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $purchase_request_id, $purchase_request_kode, $is_approvaldana, $total_biaya)
	{
		$query = $this->db->query("exec approval_pengajuan '$depo_id', '$sales_id','$approvalParam', '$purchase_request_id','$purchase_request_kode', '$is_approvaldana','$total_biaya'");

		// $res = $query->result_array();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$res = 1; // Success
		} else {
			$res = 0; // Success
		}

		return $res;
	}

	public function Insert_Principle($principle_id, $kode_corporate, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $isDeleted, $IsAktif)
	{

		$this->db->set("principle_id", $principle_id);
		$this->db->set("principle_kode", $kode_corporate);
		$this->db->set("principle_nama", $name_corporate);
		$this->db->set("principle_alamat", $address_corporate);
		$this->db->set("principle_telepon", $phone_corporate);
		// $this->db->set("principle_corporate_id", $corporate_group);
		$this->db->set("principle_latitude", $lattitude_corporate);
		$this->db->set("principle_longitude", $longitude_corporate);
		$this->db->set("principle_propinsi", $province);
		$this->db->set("principle_kota", $city);
		$this->db->set("principle_kecamatan", $districts);
		$this->db->set("principle_kelurahan", $ward);
		$this->db->set("principle_kodepos", $kodepos_corporate);
		$this->db->set("principle_nama_contact_person", $name_contact_person);
		$this->db->set("principle_telepon_contact_person", $phone_contact_person);
		$this->db->set("principle_kredit_limit", $kreditlimit_contact_person);
		$this->db->set("kelas_jalan_id", $stretclass_corporate);
		$this->db->set("kelas_jalan2_id", $stretclass2_corporate);
		$this->db->set("area_id", $area_corporate);
		$this->db->set("principle_is_deleted", $isDeleted);
		$this->db->set("principle_is_aktif", $IsAktif);


		$this->db->insert("principle");

		// $insert_id = $this->db->insert_id();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Insert_Principle_detail($principle_id, $status, $no_urut, $hari, $buka, $tutup)
	{
		$this->db->set("principle_detail_id", "NewID()", FALSE);
		$this->db->set("principle_id", $principle_id);
		$this->db->set("principle_detail_is_open", $status);
		$this->db->set("principle_detail_hari_urut", $no_urut);
		$this->db->set("principle_detail_hari", $hari);
		$this->db->set("principle_detail_jam_buka", $buka);
		$this->db->set("principle_detail_jam_tutup", $tutup);
		$this->db->set("principle_detail_is_deleted", 0);
		$this->db->set("principle_detail_is_aktif", 1);

		$this->db->insert("principle_detail");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $affectedrows;
	}

	public function Insert_Principle_brand($principle_id, $nama)
	{
		$this->db->set("principle_brand_id", "NewID()", FALSE);
		$this->db->set("principle_id", $principle_id);
		$this->db->set("principle_brand_nama", $nama);
		$this->db->set("principle_brand_is_deleted", 0);
		$this->db->set("principle_brand_is_aktif", 1);

		$this->db->insert("principle_brand");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $affectedrows;
	}
	public function cek_data_supplier_by_id($arrskubarang)
	{
		$supllier_id = $arrskubarang['supplier_id'] == "" ? null : $arrskubarang['supplier_id'];
		$sku_barang_id =  $arrskubarang['sku_barang_id'] == "" ? null : $arrskubarang['sku_barang_id'];
		$sku_barang_harga =  $arrskubarang['sku_barang_harga'] == "" ? null : $arrskubarang['sku_barang_harga'];

		$data = $this->db->query("select * from sku_barang_supplier where sku_barang_id ='$sku_barang_id' and supplier_id ='$supllier_id'");
		return $data->num_rows();
	}

	public function InsertSkuBarangSupplier($sk_id, $arrskubarang)
	{
		$supllier_id = $arrskubarang['supplier_id'] == "" ? null : $arrskubarang['supplier_id'];
		$sku_barang_id =  $arrskubarang['sku_barang_id'] == "" ? null : $arrskubarang['sku_barang_id'];
		$sku_barang_harga =  $arrskubarang['sku_barang_harga'] == "" ? null : $arrskubarang['sku_barang_harga'];
		$tgl_last_update = "";
		$this->db->set("sku_barang_supplier_id", "NEWID()", FALSE);
		$this->db->set("supplier_id", $supllier_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_harga", $sku_barang_harga);
		$this->db->set("tgl_last_update", "GETDATE()", FALSE);
		$this->db->set("who_last_update", $this->session->userdata('pengguna_username'));

		return $this->db->insert("sku_barang_supplier");
	}
	public function UpdateSkuBarangSupplier($sk_id, $arrskubarang)
	{
		$supllier_id = $arrskubarang['supplier_id'] == "" ? null : $arrskubarang['supplier_id'];
		$sku_barang_id =  $arrskubarang['sku_barang_id'] == "" ? null : $arrskubarang['sku_barang_id'];
		$sku_barang_harga =  $arrskubarang['sku_barang_harga'] == "" ? null : $arrskubarang['sku_barang_harga'];
		$tgl_last_update = "";
		$this->db->set("sku_barang_harga", $sku_barang_harga);
		$this->db->set("who_last_update", $this->session->userdata('pengguna_username'));
		$this->db->set("tgl_last_update", "GETDATE()", FALSE);
		$this->db->where("sku_barang_supplier_id", $sk_id);

		return $this->db->update("sku_barang_supplier");
	}
	public function getInsertSkuBarangSupplier()
	{
	}

	public function Get_Kecamatan_Id($res)
	{
		$arr = array();
		$provinsi = $res['provinsi'] != null ? $res['provinsi'] : '';
		$kota = $res['kota'] != null ? $res['kota'] : '';
		$kecamatan = $res['kecamatan'] != null ? $res['kecamatan'] : '';
		$kelurahan = $res['kelurahan'] != null ? $res['kelurahan'] : '';
		$kodepos = $res['kodepos'] != null ? $res['kodepos'] : '';
		$kelas_jalan = $res['kelas_jalan'] != null ? $res['kelas_jalan'] : '';
		$area = $res['area'] != null ? $res['area'] : '';
		$kelas_jalan2 = $res['kelas_jalan2'] != null ? $res['kelas_jalan2'] : '';
		$query = $this->db->select("kode_pos_id, kode_pos_kecamatan")
			->from("kode_pos")
			->where("kode_pos_propinsi", $provinsi)
			->where("kode_pos_kabupaten", $kota)
			->where("kode_pos_kecamatan", $kecamatan)
			->get()->row_array();
		if ($query != null) {
			$arr[] = ['provinsi' => $provinsi, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'kodepos' => $kodepos, 'kelas_jalan' => $kelas_jalan, 'area' => $area, 'kelas_jalan2' => $kelas_jalan2, 'kode_pos_id' => $query['kode_pos_id'], 'nama_kode_pos_kecamatan' => $query['kode_pos_kecamatan']];
		} else {
			$arr[] = ['provinsi' => $provinsi, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'kodepos' => $kodepos, 'kelas_jalan' => $kelas_jalan, 'area' => $area, 'kelas_jalan2' => $kelas_jalan2, 'kode_pos_id' => null, 'nama_kode_pos_kecamatan' => null];
		}
		return $arr;
	}

	public function Get_All_Id($val)
	{
		$arr = array();
		$kode_pos_id = $val[0]['kode_pos_id'] != null ? $val[0]['kode_pos_id'] : null;
		$query = $this->db->select("kode_pos_kelurahan_nama, kode_pos_kode")
			->from("kode_pos_detail")
			->where("kode_pos_id", $kode_pos_id)
			->where("kode_pos_kelurahan_nama", $val[0]['kelurahan'])
			->get()->row_array();
		if ($query != null) {
			$arr[] = ['provinsi' => $val[0]['provinsi'], 'kota' => $val[0]['kota'], 'kecamatan' => $val[0]['kecamatan'], 'kelurahan' => $val[0]['kelurahan'], 'kodepos' => $val[0]['kodepos'], 'kelas_jalan' => $val[0]['kelas_jalan'], 'area' => $val[0]['area'], 'kelas_jalan2' => $val[0]['kelas_jalan2'], 'kode_pos_id' => $val[0]['kode_pos_id'], 'kode_pos_kelurahan_nama' => $query['kode_pos_kelurahan_nama']];
		} else {
			$arr[] = ['provinsi' => $val[0]['provinsi'], 'kota' => $val[0]['kota'], 'kecamatan' => $val[0]['kecamatan'], 'kelurahan' => $val[0]['kelurahan'], 'kodepos' => $val[0]['kodepos'], 'kelas_jalan' => $val[0]['kelas_jalan'], 'area' => $val[0]['area'], 'kelas_jalan2' => $val[0]['kelas_jalan2'], 'kode_pos_id' => $val[0]['kode_pos_id']];
		}
		return $arr;
	}

	public function Get_Data_Provinsi()
	{
		$this->db->select("reffregion_tier, reffregion_nama")
			->from("region")
			->distinct()
			->where("reffregion_tier", 2)
			->order_by("reffregion_nama");
		$query = $this->db->get()->result_array();

		return $query;
	}

	public function Get_Data_Kota($provinsi)
	{
		$query = $this->db->select("region_tier, region_tipe, region_nama")
			->from("region")
			->where("reffregion_nama", $provinsi)
			->order_by("region_nama", "ASC")
			->get()->result_array();

		return $query;
	}

	public function Get_Data_Kecamatan($provinsi, $kota)
	{
		$query = $this->db->select("kode_pos_id, kode_pos_kecamatan")
			->from("kode_pos")
			->where("kode_pos_propinsi", $provinsi)
			->where("kode_pos_kabupaten", $kota)
			->order_by("kode_pos_kecamatan", "ASC")
			->get()->result_array();

		return $query;
	}

	public function Get_Data_Kelurahan($kecamatan)
	{
		$query = $this->db->select("kode_pos_kelurahan_nama, kode_pos_kode")
			->from("kode_pos_detail")
			->where("kode_pos_id", $kecamatan)
			->order_by("kode_pos_kelurahan_nama", "ASC")
			->get()->result_array();


		return $query;
	}

	public function Get_Data_KelasJalan()
	{
		$query = $this->db->select("kelas_jalan_id as id, kelas_jalan_nama as nama")
			->from("kelas_jalan")
			->where("kelas_jalan_klasifikasi", "Beban Muatan")
			->order_by("kelas_jalan_nama", "ASC")
			->get()->result_array();
		return $query;
	}

	public function Get_Data_KelasJalan2()
	{
		$query = $this->db->select("kelas_jalan_id as id, kelas_jalan_nama as nama")
			->from("kelas_jalan")
			->where("kelas_jalan_klasifikasi", "Fungsi Jalan")
			->order_by("kelas_jalan_nama", "ASC")
			->get()->result_array();
		return $query;
	}

	public function Get_Data_Area()
	{
		$query = $this->db->select("area_id as id, area_nama as nama")
			->from("area")
			->distinct()
			->order_by("nama", "ASC")
			->get()->result_array();
		return $query;
	}

	public function GetPurchaseRequestId($kode)
	{
		$this->db->select("purchase_request_id")
			->from("purchase_request")
			->where("purchase_request_kode", $kode);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->purchase_request_id;
		}

		return $query;
	}


	public function Insert_Outlet_Corporate($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif)
	{

		$this->db->set("client_pt_corporate_id", $outlet_id);
		$this->db->set("client_pt_corporate_nama", $name_corporate);
		$this->db->set("client_pt_corporate_alamat", $address_corporate);
		$this->db->set("client_pt_corporate_telepon", $phone_corporate);
		// $this->db->set("client_pt_corporate_id", $corporate_group);
		$this->db->set("client_pt_corporate_latitude", $lattitude_corporate);
		$this->db->set("client_pt_corporate_longitude", $longitude_corporate);
		$this->db->set("client_pt_corporate_propinsi", $province);
		$this->db->set("client_pt_corporate_kota", $city);
		$this->db->set("client_pt_corporate_kecamatan", $districts);
		$this->db->set("client_pt_corporate_kelurahan", $ward);
		$this->db->set("client_pt_corporate_kodepos", $kodepos_corporate);
		$this->db->set("client_pt_corporate_nama_contact_person", $name_contact_person);
		$this->db->set("client_pt_corporate_telepon_contact_person", $phone_contact_person);
		$this->db->set("client_pt_corporate_kredit_limit", $kreditlimit_contact_person);
		$this->db->set("kelas_jalan_id", $stretclass_corporate);
		$this->db->set("area_id", $area_corporate);
		// $this->db->set("unit_mandiri_id", $UnitMandiriId);
		$this->db->set("client_pt_corporate_is_deleted", $isDeleted);
		$this->db->set("client_pt_corporate_is_aktif", $IsAktif);
		//$this->db->set("client_pt_is_multi_lokasi", $isValidMultiLocation);
		// $this->db->set("lokasi_outlet_id", $listcontactperson_location);
		// $this->db->set("kelas_jalan2_id", $stretclass2_corporate);

		if ($segment1_contact_person != "") {
			$this->db->set("client_pt_corporate_segmen_id1", $segment1_contact_person);
		}
		if ($segment2_contact_person != "") {
			$this->db->set("client_pt_corporate_segmen_id2", $segment2_contact_person);
		}
		if ($segment3_contact_person != "") {
			$this->db->set("client_pt_corporate_segmen_id3", $segment3_contact_person);
		}


		$this->db->insert("client_pt_corporate");

		// $insert_id = $this->db->insert_id();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup)
	{
		$this->db->set("client_pt_detail_id", "NewID()", FALSE);
		$this->db->set("client_pt_id", $outlet_id);
		$this->db->set("client_pt_detail_is_open", $status);
		$this->db->set("client_pt_detail_hari_urut", $no_urut);
		$this->db->set("client_pt_detail_hari", $hari);
		$this->db->set("client_pt_detail_jam_buka", $buka);
		$this->db->set("client_pt_detail_jam_tutup", $tutup);
		$this->db->set("client_pt_detail_is_deleted", 0);
		$this->db->set("client_pt_detail_is_aktif", 1);

		$queryinsert = $this->db->insert("client_pt_detail");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}
	public function Insert_Supplier($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $isValidMultiLocation, $listcontactperson_location)
	{

		$this->db->set("supplier_id", $outlet_id);
		$this->db->set("supplier_nama", $name_corporate);
		$this->db->set("supplier_alamat", $address_corporate);
		$this->db->set("supplier_telepon", $phone_corporate);
		// $this->db->set("supplier_corporate_id", $corporate_group);
		$this->db->set("supplier_latitude", $lattitude_corporate);
		$this->db->set("supplier_longitude", $longitude_corporate);
		$this->db->set("supplier_propinsi", $province);
		$this->db->set("supplier_kota", $city);
		$this->db->set("supplier_kecamatan", $districts);
		$this->db->set("supplier_kelurahan", $ward);
		$this->db->set("supplier_kodepos", $kodepos_corporate);
		$this->db->set("supplier_nama_contact_person", $name_contact_person);
		$this->db->set("supplier_telepon_contact_person", $phone_contact_person);
		$this->db->set("supplier_kredit_limit", $kreditlimit_contact_person);
		$this->db->set("kelas_jalan_id", $stretclass_corporate);
		$this->db->set("area_id", $area_corporate);
		// $this->db->set("unit_mandiri_id", $UnitMandiriId);
		$this->db->set("supplier_is_deleted", $isDeleted);
		$this->db->set("supplier_is_aktif", $IsAktif);
		$this->db->set("supplier_is_multi_lokasi", $isValidMultiLocation);
		$this->db->set("lokasi_outlet_id", $listcontactperson_location);
		$this->db->set("kelas_jalan2_id", $stretclass2_corporate);

		if ($segment1_contact_person != "") {
			$this->db->set("supplier_segmen_id1", $segment1_contact_person);
		}
		if ($segment2_contact_person != "") {
			$this->db->set("supplier_segmen_id2", $segment2_contact_person);
		}
		if ($segment3_contact_person != "") {
			$this->db->set("supplier_segmen_id3", $segment3_contact_person);
		}


		$this->db->insert("supplier");

		// $insert_id = $this->db->insert_id();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}
	public function Get_Data_Segmen1()
	{
		$query = $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
			->from("client_pt_segmen")
			->where('client_pt_segmen_level', 1)
			->order_by("nama", "ASC")
			->get()->result_array();
		return $query;
	}

	public function Get_Data_Segmen2($SegmentId)
	{
		$query = $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
			->from("client_pt_segmen")
			->where("client_pt_segmen_reff_id", $SegmentId)
			->order_by("client_pt_segmen_nama", "ASC")
			->get()->result_array();
		return $query;
	}

	public function Get_Data_Segmen3($SegmentId2)
	{
		$query = $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
			->from("client_pt_segmen")
			->where("client_pt_segmen_reff_id", $SegmentId2)
			->where("client_pt_segmen_level", 3)
			->order_by("client_pt_segmen_nama", "ASC")
			->get()->result_array();
		return $query;
	}
}
