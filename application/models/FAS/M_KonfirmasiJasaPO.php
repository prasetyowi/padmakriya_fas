<?php
class M_KonfirmasiJasaPO extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}
	public function GetDataPR($purchase_request_id)
	{
		return $this->db->query("select * from purchase_request where purchase_request_id = '$purchase_request_id'")->row();
	}
	public function GetDataPO($po_id)
	{
		return $this->db->query("select * from purchase_order where purchase_order_id = '$po_id'")->row();
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
	public function GetKodePo()
	{
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();


		$client_wms_id = $this->session->userdata('client_wms_id');
		$depo_id = $this->session->userdata('depo_id');
		if ($is_dewa > 0) {
			return $this->db->query("select * from purchase_order po 
				left join purchase_request pr on po.purchase_request_id = pr.purchase_request_id
				where po.purchase_order_status !='Completed' and po.purchase_order_status !='In Progress Receiving' 
			and po.depo_id = '$depo_id' and pr.tipe_pengadaan_id ='9F23F928-F382-4C04-8906-DB1BDEC76476'
			")->result_array();
		} else {
			if ($client_wms_id != '') {
				return $this->db->query("select * from purchase_order po left join purchase_request pr on po.purchase_request_id = pr.purchase_request_id where po.purchase_order_status !='Completed' and po.purchase_order_status !='In Progress Receiving' and pr.tipe_pengadaan_id ='9F23F928-F382-4C04-8906-DB1BDEC76476'
					and po.depo_id = '$depo_id'
					and po.client_wms_id='$client_wms_id'")->result_array();
			} else {
				return $this->db->query("select * from purchase_order po left join purchase_request pr on po.purchase_request_id = pr.purchase_request_id where po.purchase_order_status !='Completed' and po.purchase_order_status !='In Progress Receiving' and pr.tipe_pengadaan_id ='9F23F928-F382-4C04-8906-DB1BDEC76476'
			and po.depo_id = '$depo_id'
			")->result_array();
			}
		}
	}
	public function GetDataDetailByKodePo($po_id)
	{
		$query = $this->db->query("SELECT
                po.*,
                format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
                Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
                pr.tipe_pengadaan_id,
                pr.tipe_transaksi_id,
                pr.tipe_biaya_id,
                pr.kategori_biaya_id,
                pr.purchase_request_id,
                g.gudang_id, g.gudang_nama,
				s.supplier_nama
            FROM purchase_order po
            INNER JOIN purchase_request pr
                ON po.purchase_request_id = pr.purchase_request_id
                left join gudang g on g.gudang_id = po.gudang_id
				left join supplier s on po.supplier_id = s.supplier_id
            WHERE po.purchase_order_id = '$po_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	// public function GetDataDetailByKodePo($po_id, $konfirmasijasa_id)
	// {

	// 	$query = $this->db->query("SELECT po.*,
	//     ks.*,
	//     format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
	//     Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
	//     pr.tipe_pengadaan_id,
	//     pr.tipe_transaksi_id,
	//     pr.tipe_biaya_id,
	//     pr.kategori_biaya_id,
	//     pr.purchase_request_id
	// FROM
	// konfirmasi_jasa ks left join purchase_order po on ks.purchase_order_id = po.purchase_order_id
	// INNER JOIN purchase_request pr
	//     ON po.purchase_request_id = pr.purchase_request_id
	//         WHERE po.purchase_order_id = '$po_id' and ks.konfirmasi_sku_jasa_id='$konfirmasijasa_id'");

	// 	if ($query->num_rows() == 0) {
	// 		$query = 0;
	// 	} else {
	// 		$query = $query->result_array();
	// 	}

	// 	return $query;
	// }

	public function GetKodePoAll()
	{
		return $this->db->query("select * from purchase_order ")->result_array();
	}
	public function GetDataDetailByKodePoDetail($po_id, $konfirmasijasa_id)
	{
		$query = $this->db->query("SELECT po.*,
			kj.*,
			format(pr.purchase_request_tgl_dibutuhkan,'dd-MM-yyyy') as purchase_request_tgl_dibutuhkan,
			Format(po.purchase_order_tgl_create,'dd-MM-yyyy') as purchase_order_tgl_create,
			pr.tipe_pengadaan_id,
			pr.tipe_transaksi_id,
			pr.tipe_biaya_id,
			pr.kategori_biaya_id,
			pr.purchase_request_id,
			po.purchase_order_id,
			po.purchase_order_keterangan

		
		FROM
		konfirmasi_jasa kj left join purchase_order po on kj.purchase_order_id = po.purchase_order_id
		INNER JOIN purchase_request pr
			ON po.purchase_request_id = pr.purchase_request_id
			
            WHERE po.purchase_order_id = '$po_id' and kj.konfirmasi_sku_jasa_id='$konfirmasijasa_id'");

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
            SELECT
                                                    purchase_order_detail.purchase_order_detail_id,
                                                    purchase_order_detail.purchase_order_id,
                                                    purchase_order_detail.sku_barang_id,
                                                    sku_barang.sku_barang_kode,
                                                    sku_barang.sku_barang_nama_produk,
                                                    sku_barang_harga,
                                                    sku_barang.sku_barang_satuan,
                                                    sku_barang.sku_barang_kemasan,
													purchase_order_detail.sku_barang_qty AS purchase_order_detail_qty,
                                                    purchase_order_detail.sku_barang_qty_sisa AS purchase_order_detail_qty_sisa,
                                                    purchase_order_detail.sku_barang_qty_terima AS purchase_order_detail_qty_terima,
                                                    purchase_order_detail.purchase_order_id,
                                                    purchase_order_detail.purchase_order_detail_keterangan,
                                                    purchase_order.*
                                                FROM purchase_order_detail
                                                LEFT JOIN sku_barang
                                                ON purchase_order_detail.sku_barang_id = sku_barang.sku_barang_id
                                            LEFT JOIN purchase_order
                                                on purchase_order_detail.purchase_order_id=purchase_order.purchase_order_id
                                                
                                                WHERE purchase_order_detail.purchase_order_id = '$id' 
                                                ORDER BY sku_barang.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}
	public function GetPurchaseRequestDetailByIdEdit($id, $konfirmasi_jasa_id)
	{
		$query = $this->db->query("	
				select
				po.purchase_order_id,
				po_detail.sku_barang_id,
				po_detail.sku_barang_qty,
				kj.konfirmasi_sku_jasa_id,
				kj_detail.sku_jasa_id,
				kj_detail.sku_jasa_qty,
				kj_detail.sku_jasa_qty_terima as po_akan_diterima,
				kj_detail.sku_jasa_qty,
				po_detail.sku_barang_qty as po_qty,
				po_detail.sku_barang_qty_sisa as po_sisa,
				po_detail.sku_barang_qty_terima as po_terima,
				po_detail.purchase_order_detail_keterangan,
				sku_barang.*,
				po_detail.sku_barang_harga as po_harga,
				po.purchase_order_keterangan,
				po.supplier_id,
				pr.purchase_request_id

				from purchase_order po
				left join purchase_order_detail po_detail
				on po_detail.purchase_order_id = po.purchase_order_id
				left join konfirmasi_jasa kj
				on kj.purchase_order_id = po.purchase_order_id
				left join konfirmasi_jasa_detail kj_detail
				on kj_detail.konfirmasi_sku_jasa_id = kj.konfirmasi_sku_jasa_id
				and kj_detail.sku_jasa_id = po_detail.sku_barang_id
				LEFT JOIN sku_barang
					ON kj_detail.sku_jasa_id = sku_barang.sku_barang_id
					left join purchase_request pr on pr.purchase_request_id = po.purchase_request_id
				where po.purchase_order_id = '$id' AND kj.konfirmasi_sku_jasa_id= '$konfirmasi_jasa_id'
				ORDER BY sku_barang.sku_barang_kode ASC
			");
		// 	$query = $this->db->query("
		// 	SELECT 
		// 	penerimaan_sku_barang.purchase_order_id,
		// 	penerimaan_sku_barang_detail.sku_barang_id,
		// 	sku_barang.sku_barang_kode,
		// 	sku_barang.sku_barang_nama_produk,
		// 	penerimaan_sku_barang_detail.sku_barang_harga,
		// 	sku_barang.sku_barang_satuan,
		// 	sku_barang.sku_barang_kemasan,
		// 	penerimaan_sku_barang_detail.sku_barang_qty AS penerimaan_sku_barang_detail_qty,
		// 	penerimaan_sku_barang_detail.sku_barang_qty_sum_terima AS penerimaan_sku_barang_detail_sum_terima,
		// 	penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
		// 	(penerimaan_sku_barang_detail.sku_barang_qty-penerimaan_sku_barang_detail.sku_barang_qty_terima)as penerimaan_sku_barang_detail_qty_sisa,
		// 	penerimaan_sku_barang.purchase_order_id,
		// 	purchase_order.*

		//   FROM penerimaan_sku_barang_detail
		//   LEFT JOIN sku_barang
		// 	ON penerimaan_sku_barang_detail.sku_barang_id = sku_barang.sku_barang_id
		//   LEFT JOIN penerimaan_sku_barang
		// 	ON penerimaan_sku_barang_detail.penerimaan_sku_barang_id = penerimaan_sku_barang.penerimaan_sku_barang_id
		// 	left join purchase_order 
		// 	on purchase_order.purchase_order_id = penerimaan_sku_barang.purchase_order_id

		//   WHERE penerimaan_sku_barang.purchase_order_id = '$id'
		//   AND penerimaan_sku_barang.penerimaan_sku_barang_id = '$penerimaan_id'
		//   ORDER BY sku_barang.sku_barang_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
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
				$client = "AND kj.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND kj.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("select *,supplier.supplier_nama, FORMAT(kj.konfirmasi_jasa_tgl_create, 'yyyy-MM-dd') as tgl_create, FORMAT(po.purchase_order_tgl_create, 'yyyy-MM-dd') as tgl_create_po from konfirmasi_jasa kj join purchase_order po on po.purchase_order_id = kj.purchase_order_id left join supplier on supplier.supplier_id = po.supplier_id WHERE FORMAT(kj.konfirmasi_jasa_tgl_create,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
			AND kj.depo_id = '" . $this->session->userdata('depo_id') . "'" . $perusahaan . "
			" . $divisi . " order by kj.konfirmasi_jasa_tgl_create DESC")->result_array();
		} else {
			if ($client_wms_id == '') {
				$client = '';
			} else {
				$client = "AND kj.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND kj.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("select *,supplier.supplier_nama, FORMAT(kj.konfirmasi_jasa_tgl_create, 'yyyy-MM-dd') as tgl_create, FORMAT(po.purchase_order_tgl_create, 'yyyy-MM-dd') as tgl_create_po from konfirmasi_jasa kj join purchase_order po on po.purchase_order_id = kj.purchase_order_id left join supplier on supplier.supplier_id = po.supplier_id WHERE FORMAT(kj.konfirmasi_jasa_tgl_create,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
			AND kj.depo_id = '" . $this->session->userdata('depo_id') . "'" . $perusahaan . " " . $client . "
			" . $divisi . " order by kj.konfirmasi_jasa_tgl_create DESC")->result_array();
		}
	}

	public function Exec_proses_stock_barang($penerimaan_id)
	{
		return $this->db->query("exec proses_posting_stock_barang_card 'PENERIMAANPO','$penerimaan_id'")->result_array();
	}

	public function insert_konfirmasi_jasa($konfirmasi_jasa, $konfirmasi_jasa_kode, $purchase_order_id, $depo_id, $client_wms_id, $po_statuspenerimaan)
	{
		// var_dump($konfirmasi_jasa, $konfirmasi_jasa_kode, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_statuspenerimaan);
		$konfirmasi_sku_jasa_id = $konfirmasi_jasa == "" ? null : $konfirmasi_jasa;
		$konfirmasi_sku_jasa_kode = $konfirmasi_jasa_kode == "" ? null : $konfirmasi_jasa_kode;
		$depo_id = $depo_id == "" ? null : $depo_id;

		$client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
		$purchase_order_id = $purchase_order_id == "" ? null : $purchase_order_id;

		$this->db->set("konfirmasi_sku_jasa_id", $konfirmasi_sku_jasa_id);
		$this->db->set("konfirmasi_sku_jasa_kode", $konfirmasi_sku_jasa_kode);
		$this->db->set("purchase_order_id", $purchase_order_id);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("konfirmasi_jasa_tgl_create", "GETDATE()", FALSE);
		$this->db->set("konfirmasi_jasa_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("konfirmasi_jasa_status", $po_statuspenerimaan);

		$queryinsert = $this->db->insert("konfirmasi_jasa");

		return $queryinsert;
		// return $this->db->last_query();
	}
	public function insert_konfirmasi_jasa_detail($konfirmasi_sku_jasa_id, $detail)
	// public function insert_penerimaan_sku_barang_detail($penerimaan_sku_barang_id, $sku_barang_id, $sku_barang_qty, $sku_barang_qty_sum_terima, $sku_barang_qty_terima, $sku_barang_harga, $detail)
	{
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		$sku_barang_qty_sum_terima = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];
		// $sku_barang_qty_sum_terima = $detail['purchase_order_detail_qty_sisa'] != 0 ? ($detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum']) : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_harga = $detail['sku_barang_harga'] == '' ? null : $detail['sku_barang_harga'];

		$this->db->set("konfirmasi_sku_jasa_detail_id", 'NEWID()', FALSE);
		$this->db->set("konfirmasi_sku_jasa_id", $konfirmasi_sku_jasa_id);
		$this->db->set("sku_jasa_id", $sku_barang_id);
		$this->db->set("sku_jasa_qty", $sku_barang_qty);
		$this->db->set("sku_jasa_qty_sum_terima", $sku_barang_qty_sum_terima);
		$this->db->set("sku_jasa_qty_terima", $sku_barang_qty_terima);
		$this->db->set("sku_jasa_qty_harga", $sku_barang_harga);

		$queryinsert = $this->db->insert("konfirmasi_jasa_detail");

		return $queryinsert;
	}
	public function insert_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $detail)
	{
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_stock_awal = $detail['sku_barang_stock_awal'] == '' ? null : $detail['sku_barang_stock_awal'];
		$sku_barang_stock_masuk = $detail['sku_barang_stock_masuk'] == '' ? null : $detail['sku_barang_stock_masuk'];
		$sku_barang_stock_keluar = $detail['sku_barang_stock_keluar'] == '' ? null : $detail['sku_barang_stock_keluar'];
		$sku_barang_stock_akhir = $detail['sku_barang_stock_akhir'] == '' ? null : $detail['sku_barang_stock_akhir'];
		$gudang_id = $gudang_id == '' ? null : $gudang_id;
		// $sku_barang_stock_is_aktif = $detail['sku_barang_stock_is_aktif'] == '' ? null : $detail['sku_barang_stock_is_aktif'];
		// $sku_barang_stock_is_deleted = $detail['sku_barang_stock_is_deleted'] == '' ? null : $detail['sku_barang_stock_is_deleted'];

		$this->db->set("sku_barang_stock_id", 'NEWID()', false);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("gudang_id", $gudang_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_stock_awal", null);
		$this->db->set("sku_barang_stock_masuk", $sku_barang_stock_masuk);
		$this->db->set("sku_barang_stock_keluar", null);
		$this->db->set("sku_barang_stock_akhir", null);
		$this->db->set("sku_barang_stock_is_aktif", '1');
		$this->db->set("sku_barang_stock_is_deleted", 0);


		$queryinsert = $this->db->insert("sku_barang_stock");

		return $queryinsert;
	}
	public function update_penerimaan_sku_barang_stock($depo_id, $gudang_id, $client_wms_id, $detail, $data)
	{
		$sku_barang_stock_id = $data->sku_barang_stock_id == '' ? null : $data->sku_barang_stock_id;
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_stock_awal = $detail['sku_barang_stock_awal'] == '' ? null : $detail['sku_barang_stock_awal'];
		// $sku_barang_stock_masuk = $detail['sku_barang_stock_masuk'] == '' ? null : $detail['sku_barang_stock_masuk'];
		$sku_barang_stock_masuk = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];
		$sku_barang_stock_keluar = $detail['sku_barang_stock_keluar'] == '' ? null : $detail['sku_barang_stock_keluar'];
		$sku_barang_stock_akhir = $detail['sku_barang_stock_akhir'] == '' ? null : $detail['sku_barang_stock_akhir'];
		$gudang_id = $gudang_id == '' ? null : $gudang_id;

		// $sku_barang_stock_is_aktif = $detail['sku_barang_stock_is_aktif'] == '' ? null : $detail['sku_barang_stock_is_aktif'];
		// $sku_barang_stock_is_deleted = $detail['sku_barang_stock_is_deleted'] == '' ? null : $detail['sku_barang_stock_is_deleted'];

		// $this->db->set("sku_barang_stock_id", 'NEWID()', false);
		// $this->db->set("depo_id", $depo_id);
		// $this->db->set("gudang_id", $gudang_id);
		// $this->db->set("client_wms_id", $client_wms_id);
		// $this->db->set("sku_barang_id", $sku_barang_id);
		// $this->db->set("sku_barang_stock_awal", $sku_barang_stock_awal);
		$this->db->set("sku_barang_stock_masuk", $sku_barang_stock_masuk);
		// $this->db->set("sku_barang_stock_keluar", null);
		// $this->db->set("sku_barang_stock_akhir", null);
		// $this->db->set("sku_barang_stock_is_aktif", '1');

		$this->db->where('sku_barang_stock_id', $sku_barang_stock_id);
		$queryinsert = $this->db->update("sku_barang_stock");

		return $queryinsert;
	}

	public function update_sku_barang_supplier($detail)
	{
		$sku_barang_harga = $detail['sku_barang_harga'] == '' ? null : $detail['sku_barang_harga'];
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$supplier_id = $detail['supplier_id'] == '' ? null : $detail['supplier_id'];
		$purchase_order_id = $detail['purchase_order_id'] == '' ? null : $detail['purchase_order_id'];
		$this->db->set('sku_barang_harga', $sku_barang_harga);
		$this->db->set('tgl_last_update', 'GETDATE()', FALSE);
		$this->db->where('supplier_id', $supplier_id);
		$this->db->where('sku_barang_id', $sku_barang_id);
		return $this->db->update('sku_barang_supplier');
	}
	public function update_purchase_order($detail, $po_status)
	{
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		$sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_qty_sisa = $detail['purchase_order_detail_qty_sisa'] == '' ? null : $detail['purchase_order_detail_qty_sisa'];
		$supplier_id = $detail['supplier_id'] == '' ? null : $detail['supplier_id'];
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$purchase_order_id = $detail['purchase_order_id'] == '' ? null : $detail['purchase_order_id'];
		$this->db->set('purchase_order_status', $po_status);
		$this->db->where('purchase_order_id', $purchase_order_id);
		return $this->db->update('purchase_order');
	}
	public function update_purchase_order_detail($detail)
	{
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		// $sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_qty_terima = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];
		$sku_barang_qty_sisa = $detail['purchase_order_detail_qty_sisa'] == '' ? null : $detail['purchase_order_detail_qty_sisa'];
		$supplier_id = $detail['supplier_id'] == '' ? null : $detail['supplier_id'];
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$purchase_order_id = $detail['purchase_order_id'] == '' ? null : $detail['purchase_order_id'];


		$this->db->set('sku_barang_qty_terima', $sku_barang_qty_terima);
		$this->db->set('sku_barang_qty_sisa', $sku_barang_qty_sisa);
		$this->db->where('purchase_order_id', $purchase_order_id);
		$this->db->where('sku_barang_id', $sku_barang_id);
		return $this->db->update('purchase_order_detail');
	}
	public function update_purchase_request_detail($detail, $purchase_request_id)
	{
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		// $sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_qty_terima = $detail['penerimaan_sku_barang_qty_sum'] == '' ? null : $detail['penerimaan_sku_barang_qty_sum'];
		$sku_barang_qty_sisa = $detail['purchase_order_detail_qty_sisa'] == '' ? null : $detail['purchase_order_detail_qty_sisa'];
		$supplier_id = $detail['supplier_id'] == '' ? null : $detail['supplier_id'];
		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$purchase_order_id = $detail['purchase_order_id'] == '' ? null : $detail['purchase_order_id'];


		// $this->db->set('purchase_request_detail_qty_po', $sku_barang_qty);
		$this->db->set('purchase_request_detail_qty_terima', $sku_barang_qty_terima);
		$this->db->where('purchase_order_id', $purchase_order_id);
		$this->db->where('sku_barang_id', $sku_barang_id);
		$this->db->where('supplier_id', $supplier_id);
		$this->db->where('purchase_request_id', $purchase_request_id);
		return $this->db->update('purchase_request_detail');
	}

	public function delete_konfirmasi_jasa_detail($konfirmasi_sku_jasa_id, $detail)
	{

		$sku_barang_id = $detail['sku_barang_id'] == '' ? null : $detail['sku_barang_id'];
		$sku_barang_qty = $detail['purchase_order_detail_qty'] == '' ? null : $detail['purchase_order_detail_qty'];
		$sku_barang_qty_sum_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_qty_terima = $detail['purchase_order_detail_qty_terima'] == '' ? null : $detail['purchase_order_detail_qty_terima'];
		$sku_barang_harga = $detail['sku_barang_harga'] == '' ? null : $detail['sku_barang_harga'];

		$this->db->where("konfirmasi_sku_jasa_id", $konfirmasi_sku_jasa_id);
		$this->db->where("sku_jasa_id", $sku_barang_id);

		$this->db->delete("konfirmasi_jasa_detail");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
	}

	public function update_konfirmasi_jasa($konfirmasi_sku_jasa_id, $purchase_order_id, $depo_id, $gudang_id, $client_wms_id, $po_status)
	{

		$this->db->set('konfirmasi_jasa_status', $po_status);
		$this->db->where("konfirmasi_sku_jasa_id", $konfirmasi_sku_jasa_id);
		$this->db->where("purchase_order_id", $purchase_order_id);
		$this->db->update('konfirmasi_jasa');
		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
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
		$jenis_pengadaan = $jenis_pengadaan == '' ? null : $jenis_pengadaan;
		$no_doc_po = $no_doc_po == '' ? null : $no_doc_po;
		$jenis_asset = $jenis_asset == '' ? null : $jenis_asset;

		$this->db->trans_start();


		$this->db->set('pengajuan_dana_id', 'NEWID()', false);
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
		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();
		return 1;
	}
}
