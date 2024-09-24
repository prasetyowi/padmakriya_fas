<?php

use Matrix\Functions;

class M_PenerimaanHargaPO extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function Hai()
	{
		return "Hai";
	}
	public function GetDataPR($purchase_request_id)
	{
		return $this->db->query("select * from purchase_request where purchase_request_id = '$purchase_request_id'")->row();
	}
	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}
	// public function GetKodePo()
	// {
	// 	$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
	// 	$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();


	// 	$client_wms_id = $this->session->userdata('client_wms_id');
	// 	$depo_id = $this->session->userdata('depo_id');
	// 	if ($is_dewa > 0) {
	// 		return $this->db->query("select * from purchase_order where purchase_order_status !='Completed' and purchase_order_status !='In Progress Receiving' 
	// 		and purchase_order.depo_id = '$depo_id'
	// 		")->result_array();
	// 	} else {
	// 		if ($client_wms_id != '') {

	// 			return $this->db->query("select * from purchase_order where purchase_order_status !='Completed' and purchase_order_status !='In Progress Receiving' 
	// 				and purchase_order.depo_id = '$depo_id'
	// 				and purchase_order.client_wms_id='$client_wms_id'")->result_array();
	// 		} else {
	// 			return $this->db->query("select * from purchase_order where purchase_order_status !='Completed' and purchase_order_status !='In Progress Receiving' 
	// 		and purchase_order.depo_id = '$depo_id'
	// 		")->result_array();
	// 		}
	// 	}
	// }
	public function GetKodePo()
	{
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();


		$client_wms_id = $this->session->userdata('client_wms_id');
		$depo_id = $this->session->userdata('depo_id');
		if ($is_dewa > 0) {
			return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_status !='In Progress Receiving' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id'")->result_array();
		} else {
			if ($client_wms_id != '') {

				return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_status !='In Progress Receiving' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id' and psb.client_wms_id='$client_wms_id'")->result_array();
			} else {
				return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_status !='In Progress Receiving' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id'")->result_array();
			}
		}
	}

	public function GetKodePoAll()
	{
		return $this->db->query("select * from purchase_order ")->result_array();
	}
	public function GetKodePoAllPenerimaan()
	{
		return $this->db->query("select * from penerimaan_sku_barang ")->result_array();
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
	public function GetGudang()
	{
		$client_wms_id = $this->session->userdata('client_wms_id');
		if ($client_wms_id == '') {

			$client = "";
		} else {
			$client = "AND client_wms_id = '" . $client_wms_id . "' ";
		}

		$depo_id = $this->session->userdata('depo_id');
		$query = $this->db->query("select * from gudang where depo_id ='$depo_id' and gudang_is_deleted='0' and gudang_is_gudang_penerima='1' " . $client . "");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function GetPerusahaan()
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
	public function GetPerusahaanOld()
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
	public function GetDataDetailByKodePo($pn_id)
	{
		$query = $this->db->query("SELECT
		psb.*,
		po.*,
		format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
		Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
		pr.tipe_pengadaan_id,
		pr.tipe_transaksi_id,
		pr.tipe_biaya_id,
		pr.kategori_biaya_id,
		pr.purchase_request_id,
		g.gudang_id, g.gudang_nama,
		s.supplier_nama,

		po.purchase_order_kode
	FROM penerimaan_sku_barang psb left join  purchase_order po on po.purchase_order_id = psb.purchase_order_id
	INNER JOIN purchase_request pr
		ON po.purchase_request_id = pr.purchase_request_id
		left join gudang g on g.gudang_id = psb.gudang_id
		left join supplier s on po.supplier_id = s.supplier_id
	WHERE psb.penerimaan_sku_barang_id = '$pn_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function GetPenerimaanBarangDetailById($po_id, $penerimaan_id)
	{
		$query = $this->db->query("SELECT po.*,
        ps.*,
        format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
        Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
        pr.tipe_pengadaan_id,
        pr.tipe_transaksi_id,
        pr.tipe_biaya_id,
        pr.kategori_biaya_id,
        pr.purchase_request_id,
        g.gudang_id, g.gudang_nama
    FROM
    penerimaan_sku_barang ps left join purchase_order po on ps.purchase_order_id = po.purchase_order_id
    INNER JOIN purchase_request pr
        ON po.purchase_request_id = pr.purchase_request_id
        left join gudang g on g.gudang_id = ps.gudang_id
            WHERE po.purchase_order_id = '$po_id' and ps.penerimaan_sku_barang_id='$penerimaan_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function cek_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $value)
	{
		$sku_barang_id = $value['sku_barang_id'];
		return $this->db->query("select * from sku_barang_stock
        where depo_id = '$depo_id' 
        and gudang_id = '$gudang_id' 
        and client_wms_id = '$client_wms_id' 
        and sku_barang_id = '$sku_barang_id'
        ")->row();
	}


	public function GetPurchaseRequestDetailById($id)
	{
		$query = $this->db->query("
		SELECT distinct
		penerimaan_sku_barang_detail.penerimaan_sku_barang_detail_id,
		penerimaan_sku_barang_detail.penerimaan_sku_barang_id,
		penerimaan_sku_barang_detail.sku_barang_id,
		penerimaan_sku_barang.penerimaan_sku_barang_id,
		sku_barang.sku_barang_kode,
		sku_barang.sku_barang_nama_produk,
		penerimaan_sku_barang_detail.sku_barang_harga,
		sku_barang.sku_barang_satuan,
		sku_barang.sku_barang_kemasan,
		penerimaan_sku_barang_detail.sku_barang_qty AS penerimaan_sku_barang_detail_qty,
		penerimaan_sku_barang_detail.sku_barang_qty - penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_sisa,
		penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
		penerimaan_sku_barang.*,
		po.purchase_order_keterangan,
		pod.purchase_order_detail_keterangan
	FROM penerimaan_sku_barang_detail
	LEFT JOIN sku_barang
	ON penerimaan_sku_barang_detail.sku_barang_id = sku_barang.sku_barang_id
	LEFT JOIN penerimaan_sku_barang
	on penerimaan_sku_barang_detail.penerimaan_sku_barang_id=penerimaan_sku_barang.penerimaan_sku_barang_id
	Left join purchase_order po on po.purchase_order_id =penerimaan_sku_barang.purchase_order_id
	Left join purchase_order_detail pod on pod.purchase_order_id =penerimaan_sku_barang.purchase_order_id and pod.sku_barang_id = penerimaan_sku_barang_detail.sku_barang_id

													
	WHERE penerimaan_sku_barang_detail.penerimaan_sku_barang_id = '$id' 
	ORDER BY sku_barang.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
	public function GetPurchaseRequestDetailByIdEdit($id, $penerimaan_id)
	{
		$query = $this->db->query("
		SELECT distinct
		penerimaan_sku_barang_detail.penerimaan_sku_barang_detail_id,
		penerimaan_sku_barang_detail.penerimaan_sku_barang_id,
		penerimaan_sku_barang_detail.sku_barang_id,
		penerimaan_sku_barang.penerimaan_sku_barang_id,
		sku_barang.sku_barang_kode,
		sku_barang.sku_barang_nama_produk,
		penerimaan_sku_barang_detail.sku_barang_harga,
		sku_barang.sku_barang_satuan,
		sku_barang.sku_barang_kemasan,
		penerimaan_sku_barang_detail.sku_barang_qty AS penerimaan_sku_barang_detail_qty,
		penerimaan_sku_barang_detail.sku_barang_qty - penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_sisa,
		penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
		penerimaan_sku_barang.*,
		po.purchase_order_keterangan,
		pod.purchase_order_detail_keterangan
	FROM penerimaan_sku_barang_detail
	LEFT JOIN sku_barang
	ON penerimaan_sku_barang_detail.sku_barang_id = sku_barang.sku_barang_id
	LEFT JOIN penerimaan_sku_barang
	on penerimaan_sku_barang_detail.penerimaan_sku_barang_id=penerimaan_sku_barang.penerimaan_sku_barang_id
	Left join purchase_order po on po.purchase_order_id =penerimaan_sku_barang.purchase_order_id
	Left join purchase_order_detail pod on pod.purchase_order_id =penerimaan_sku_barang.purchase_order_id and pod.sku_barang_id = penerimaan_sku_barang_detail.sku_barang_id

													
	WHERE penerimaan_sku_barang_detail.penerimaan_sku_barang_id = '$penerimaan_id' 
	ORDER BY sku_barang.sku_barang_kode ASC
");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function GetPurchaseRequestDetailByIdPenerimaanBarang($id, $penerimaan_id)
	{
		$query = $this->db->query("select sku_barang.sku_barang_kode,
        sku_barang.sku_barang_nama_produk,
        sku_barang.sku_barang_satuan,
        sku_barang.sku_barang_kemasan
        ,ps.*,psd.*,
        psd.sku_barang_qty AS penerimaan_sku_barang_qty,
        psd.sku_barang_qty_sum_terima AS penerimaan_sku_barang_qty_sum,
        psd.sku_barang_qty_terima AS penerimaan_sku_barang_qty_terima,
		(psd.sku_barang_qty-psd.sku_barang_qty_terima)as penerimaan_sku_barang_qty_sisa,
		po.*
        FROM penerimaan_sku_barang_detail psd left join penerimaan_sku_barang ps on psd.penerimaan_sku_barang_id = ps.penerimaan_sku_barang_id
                                                    
        LEFT JOIN sku_barang
        ON psd.sku_barang_id = sku_barang.sku_barang_id
        left join purchase_order po on po.purchase_order_id = ps.purchase_order_id
        WHERE ps.purchase_order_id = '$id'  and ps.penerimaan_sku_barang_id ='$penerimaan_id'
        ORDER BY sku_barang.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
	public function search_penerimaan_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $divisi)
	{
		$client_wms_id = $this->session->userdata('client_wms_id');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();


		$client_wms_id = $this->session->userdata('client_wms_id');
		$depo_id = $this->session->userdata('depo_id');
		if ($is_dewa > 0) {

			if ($client_wms_id == '') {
				$client = '';
			} else {
				$client = "AND pb.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND pb.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("select *,supplier.supplier_nama,FORMAT(pb.penerimaan_sku_barang_tgl_create,'yyyy-MM-dd') as tgl_create_penerimaan, FORMAT(po.purchase_order_tgl_create,'yyyy-MM-dd') as tgl_create_po from penerimaan_sku_barang pb left join purchase_order po on po.purchase_order_id = pb.purchase_order_id left join supplier on supplier.supplier_id = po.supplier_id WHERE FORMAT(pb.penerimaan_sku_barang_tgl_create,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2' AND pb.penerimaan_sku_barang_flag_konfirmasi_harga is not null
			AND pb.depo_id = '" . $this->session->userdata('depo_id') . "' " . $perusahaan . " 
			" . $divisi . " order by pb.penerimaan_sku_barang_tgl_create DESC")->result_array();
		} else {

			if ($client_wms_id == '') {
				$client = '';
			} else {
				$client = "AND pb.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND pb.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("select *,supplier.supplier_nama,FORMAT(pb.penerimaan_sku_barang_tgl_create,'yyyy-MM-dd') as tgl_create_penerimaan, FORMAT(po.purchase_order_tgl_create,'yyyy-MM-dd') as tgl_create_po from penerimaan_sku_barang pb left join purchase_order po on po.purchase_order_id = pb.purchase_order_id left join supplier on supplier.supplier_id = po.supplier_id WHERE FORMAT(pb.penerimaan_sku_barang_tgl_create,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
			AND pb.depo_id = '" . $this->session->userdata('depo_id') . "' " . $perusahaan . " 
			" . $divisi . " order by pb.penerimaan_sku_barang_tgl_create DESC")->result_array();
		}
	}
	public function GetDataDetailByKodePoDetail($po_id, $penerimaan_id)
	{
		$query = $this->db->query("SELECT po.*,
        ps.*,
        format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
        Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
        pr.tipe_pengadaan_id,
        pr.tipe_transaksi_id,
        pr.tipe_biaya_id,
        pr.kategori_biaya_id,
        pr.purchase_request_id,
        g.gudang_id, g.gudang_nama,
		s.supplier_nama
    FROM
    penerimaan_sku_barang ps left join purchase_order po on ps.purchase_order_id = po.purchase_order_id
    INNER JOIN purchase_request pr
        ON po.purchase_request_id = pr.purchase_request_id
        left join gudang g on g.gudang_id = ps.gudang_id
		left join supplier s on s.supplier_id = po.supplier_id
            WHERE po.purchase_order_id = '$po_id' and ps.penerimaan_sku_barang_id='$penerimaan_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function insert_penerimaan_sku_barang($penerimaan_sku_barang_id, $penerimaan_sku_barang_kode, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_status)
	{
		$penerimaan_sku_barang_id = $penerimaan_sku_barang_id == "" ? null : $penerimaan_sku_barang_id;
		$penerimaan_sku_barang_kode = $penerimaan_sku_barang_kode == "" ? null : $penerimaan_sku_barang_kode;
		$depo_id = $depo_id == "" ? null : $depo_id;
		$gudang_id = $gudang_id == "" ? null : $gudang_id;
		$client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
		$purchase_order_id = $purchase_order_id == "" ? null : $purchase_order_id;

		$this->db->set("penerimaan_sku_barang_id", $penerimaan_sku_barang_id);
		$this->db->set("penerimaan_sku_barang_kode", $penerimaan_sku_barang_kode);
		$this->db->set("purchase_order_id", $purchase_order_id);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("gudang_id", $gudang_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("penerimaan_sku_barang_tgl_create", "GETDATE()", FALSE);
		$this->db->set("penerimaan_sku_barang_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set('penerimaan_sku_barang_status', $po_status);

		$queryinsert = $this->db->insert("penerimaan_sku_barang");

		return $queryinsert;
	}
	public function insert_penerimaan_sku_barang_detail($penerimaan_sku_barang_id, $detail)

	{
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		$sku_barang_qty_sum_terima = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];

		$sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_harga = $detail['sku_barang_harga'] == '' ? null : $detail['sku_barang_harga'];

		$this->db->set("penerimaan_sku_barang_detail_id", 'NEWID()', FALSE);
		$this->db->set("penerimaan_sku_barang_id", $penerimaan_sku_barang_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_qty", $sku_barang_qty);
		$this->db->set("sku_barang_qty_sum_terima", $sku_barang_qty_sum_terima);
		$this->db->set("sku_barang_qty_terima", $sku_barang_qty_terima);
		$this->db->set("sku_barang_harga", $sku_barang_harga);

		$queryinsert = $this->db->insert("penerimaan_sku_barang_detail");

		return $queryinsert;
	}
	public function update_harga_penerimaan_sku_barang($penerimaan_sku_barang_id, $penerimaan_sku_barang_flag_konfirmasi_harga, $status)

	{
		$penerimaan_sku_barang_flag_konfirmasi_harga = $penerimaan_sku_barang_flag_konfirmasi_harga == '' ? 0 : $penerimaan_sku_barang_flag_konfirmasi_harga;
		$status = $status == '' ? null : $status;
		$this->db->set('penerimaan_sku_barang_flag_konfirmasi_harga', $penerimaan_sku_barang_flag_konfirmasi_harga);
		$this->db->set('penerimaan_sku_barang_status_harga', $status);

		$this->db->where("penerimaan_sku_barang_id", $penerimaan_sku_barang_id);

		$queryinsert = $this->db->update("penerimaan_sku_barang");

		return $queryinsert;
	}
	public function update_harga_penerimaan_sku_barang_detail($penerimaan_sku_barang_id, $detail)

	{
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		$sku_barang_qty_sum_terima = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];

		$sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_harga = $detail['sku_barang_harga'] == '' ? null : $detail['sku_barang_harga'];


		$this->db->set("sku_barang_harga", $sku_barang_harga);

		$this->db->where("penerimaan_sku_barang_id", $penerimaan_sku_barang_id);
		$this->db->where('sku_barang_id', $sku_barang_id);

		$queryinsert = $this->db->update("penerimaan_sku_barang_detail");

		return $queryinsert;
	}
}
