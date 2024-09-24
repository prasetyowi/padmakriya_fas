<?php

class M_PemasukanFaktur extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function Hai()
	{
		return "Hai";
	}
	public function GetKodePo()
	{
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();


		$client_wms_id = $this->session->userdata('client_wms_id');
		$depo_id = $this->session->userdata('depo_id');
		if ($is_dewa > 0) {
			return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id'")->result_array();
		} else {
			if ($client_wms_id != '') {

				return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id' and psb.client_wms_id='$client_wms_id'")->result_array();
			} else {
				return $this->db->query("select * from penerimaan_sku_barang psb  where psb.penerimaan_sku_barang_status !='Draft' and psb.penerimaan_sku_barang_flag_konfirmasi_harga is null and psb.depo_id ='$depo_id'")->result_array();
			}
		}
	}

	public function GetKodePoAll()
	{
		return $this->db->query("select * from purchase_order ")->result_array();
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

	public function GetKodePenerimaanInFaktur()
	{

		return $this->db->query("select * from validasi_faktur where konfirmasi_hutang_status !='Approved' AND konfirmasi_hutang_status !='In Progress Approval'")->result();
	}
	public function GetKodePenerimaan()
	{
		$client_wms_id = $this->session->userdata('client_wms_id');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		if ($is_dewa > 0) {
			return $this->db->query("select * from penerimaan_sku_barang LEFT JOIN purchase_order po on po.purchase_order_id= penerimaan_sku_barang.purchase_order_id 
		INNER JOIN purchase_request pr on po.purchase_request_id = pr.purchase_request_id where penerimaan_sku_barang.penerimaan_sku_barang_flag_konfirmasi_harga ='1'")->result();
		} else {
			if ($client_wms_id != '') {
				return $this->db->query("select * from penerimaan_sku_barang LEFT JOIN purchase_order po on po.purchase_order_id= penerimaan_sku_barang.purchase_order_id 
				INNER JOIN purchase_request pr on po.purchase_request_id = pr.purchase_request_id where penerimaan_sku_barang.penerimaan_sku_barang_flag_konfirmasi_harga ='1'AND penerimaan_sku_barang.client_wms_id='$client_wms_id'")->result();
			} else {
				return $this->db->query("select * from penerimaan_sku_barang LEFT JOIN purchase_order po on po.purchase_order_id= penerimaan_sku_barang.purchase_order_id 
		INNER JOIN purchase_request pr on po.purchase_request_id = pr.purchase_request_id where penerimaan_sku_barang.penerimaan_sku_barang_flag_konfirmasi_harga ='1'")->result();
			}
		}
	}
	public function GetKodeKonfirmasi()
	{
		$client_wms_id = $this->session->userdata('client_wms_id');
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();
		if ($is_dewa > 0) {
			return $this->db->query("select * from konfirmasi_jasa LEFT JOIN purchase_order po on po.purchase_order_id= konfirmasi_jasa.purchase_order_id 
			INNER JOIN purchase_request pr on po.purchase_request_id = pr.purchase_request_id where konfirmasi_jasa.konfirmasi_jasa_status ='Completed'")->result();
		} else {
			return $this->db->query("select * from konfirmasi_jasa LEFT JOIN purchase_order po on po.purchase_order_id= konfirmasi_jasa.purchase_order_id 
			INNER JOIN purchase_request pr on po.purchase_request_id = pr.purchase_request_id where konfirmasi_jasa.konfirmasi_jasa_status ='Completed' AND konfirmasi_jasa.client_wms_id ='$client_wms_id'")->result();
		}
	}
	public function getDetailByKodeSelected($id, $type)
	{
		if ($type == 2 || $type == '2') {
			return $this->db->query("
				select *, format(kj.konfirmasi_jasa_tgl_create,'dd-MM-yyyy') as formatkonfirmasi_jasa_tgl_create,
				s.supplier_nama,
				s.supplier_id
				 from konfirmasi_jasa kj 

				left join purchase_order po on po.purchase_order_id = kj.purchase_order_id
				inner join purchase_request pr on pr.purchase_request_id = po.purchase_request_id
				left join supplier s on po.supplier_id = s.supplier_id
				where kj.konfirmasi_sku_jasa_id = '$id'")->row();
		}
		if ($type == 1 || $type == '1') {
			return $this->db->query("SELECT
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
				pr.purchase_request_pemohon,
				format(psb.penerimaan_sku_barang_tgl_create,'dd-MM-yyyy') as formatpenerimaan_sku_barang_tgl_create
			FROM penerimaan_sku_barang psb left join  purchase_order po on po.purchase_order_id = psb.purchase_order_id
			INNER JOIN purchase_request pr
				ON po.purchase_request_id = pr.purchase_request_id
				left join gudang g on g.gudang_id = po.gudang_id
				left join supplier s on po.supplier_id = s.supplier_id
			WHERE psb.penerimaan_sku_barang_id = '$id' ")->row();
		}
	}
	public function GetDetailTableByIdKode($id, $type)
	{

		if ($type == 2 || $type == '2') {
			return $this->db->query("
				SELECT
					konfirmasi_jasa_detail.konfirmasi_sku_jasa_detail_id,
					konfirmasi_jasa_detail.sku_jasa_id as sku_barang_id,
					
					sku_barang.sku_barang_kode,
					sku_barang.sku_barang_nama_produk,
					konfirmasi_jasa_detail.sku_jasa_qty_harga as sku_barang_harga,
					sku_barang.sku_barang_satuan,
					sku_barang.sku_barang_kemasan,
					konfirmasi_jasa_detail.sku_jasa_qty AS penerimaan_sku_barang_detail_qty,
					konfirmasi_jasa_detail.sku_jasa_qty - konfirmasi_jasa_detail.sku_jasa_qty_terima AS penerimaan_sku_barang_detail_qty_sisa,
					konfirmasi_jasa_detail.sku_jasa_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
					konfirmasi_jasa.*,
					po.purchase_order_keterangan,
					pod.purchase_order_detail_keterangan
				FROM konfirmasi_jasa_detail
					LEFT JOIN sku_barang
					ON konfirmasi_jasa_detail.sku_jasa_id = sku_barang.sku_barang_id
					LEFT JOIN konfirmasi_jasa
					on konfirmasi_jasa_detail.konfirmasi_sku_jasa_id = konfirmasi_jasa.konfirmasi_sku_jasa_id
					Left join purchase_order po on po.purchase_order_id = konfirmasi_jasa.purchase_order_id
					Left join purchase_order_detail pod on pod.purchase_order_id = po.purchase_order_id
				WHERE konfirmasi_jasa_detail.konfirmasi_sku_jasa_id = '$id' 
				ORDER BY sku_barang.sku_barang_kode ASC
				")->result();
		}
		if ($type == 1 || $type == '1') {
			return $this->db->query("
				SELECT distinct
					penerimaan_sku_barang_detail.penerimaan_sku_barang_detail_id,
					penerimaan_sku_barang_detail.sku_barang_id,
					sku_barang.sku_barang_kode,
					sku_barang.sku_barang_nama_produk,
					penerimaan_sku_barang_detail.sku_barang_harga,
					sku_barang.sku_barang_satuan,
					sku_barang.sku_barang_kemasan,
					penerimaan_sku_barang_detail.sku_barang_qty AS penerimaan_sku_barang_detail_qty,
					penerimaan_sku_barang_detail.sku_barang_qty - penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_sisa,
					penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
					pod.purchase_order_detail_keterangan,
					penerimaan_sku_barang.*,
					po.purchase_order_keterangan
				FROM penerimaan_sku_barang_detail
					LEFT JOIN sku_barang
					ON penerimaan_sku_barang_detail.sku_barang_id = sku_barang.sku_barang_id
					LEFT JOIN penerimaan_sku_barang
					on penerimaan_sku_barang_detail.penerimaan_sku_barang_id=penerimaan_sku_barang.penerimaan_sku_barang_id
					Left join purchase_order po on po.purchase_order_id = penerimaan_sku_barang.purchase_order_id
					Left join purchase_order_detail pod on pod.purchase_order_id = po.purchase_order_id
				WHERE penerimaan_sku_barang_detail.penerimaan_sku_barang_id = '$id' 
				ORDER BY sku_barang.sku_barang_kode ASC")->result();
		}
	}
	public function GetDetailTableByIdKodeArray($id, $type)
	{

		// if ($type == 2 || $type == '2') {
		return $this->db->query("
					SELECT
					validasi_faktur_detail.konfirmasi_hutang_detail_id,
					validasi_faktur_detail.konfirmasi_hutang_id,
					validasi_faktur_detail.sku_barang_id as sku_barang_id,
					
					sku_barang.sku_barang_kode,
					sku_barang.sku_barang_nama_produk,
					validasi_faktur_detail.sku_barang_jasa_harga as sku_barang_harga,
					validasi_faktur_detail.sku_barang_jasa_qty_terima  as penerimaan_sku_barang_detail_qty_terima,
					sku_barang.sku_barang_satuan,
					sku_barang.sku_barang_kemasan,
					po.purchase_order_keterangan
				FROM validasi_faktur_detail
					LEFT JOIN sku_barang
					ON validasi_faktur_detail.sku_barang_id = sku_barang.sku_barang_id
					LEFT JOIN validasi_faktur
					on validasi_faktur_detail.konfirmasi_hutang_id = validasi_faktur.konfirmasi_hutang_id
					left join konfirmasi_jasa on validasi_faktur.konfirmasi_jasa_id = konfirmasi_jasa.konfirmasi_sku_jasa_id
					Left join purchase_order po on po.purchase_order_id = konfirmasi_jasa.purchase_order_id
				WHERE validasi_faktur_detail.konfirmasi_hutang_id = '$id' 
				ORDER BY sku_barang.sku_barang_kode ASC")->result_array();
		// }
		// if ($type == 1 || $type == '1') {
		// 	return $this->db->query("
		// 		SELECT
		// 			penerimaan_sku_barang_detail.penerimaan_sku_barang_detail_id,
		// 			penerimaan_sku_barang_detail.sku_barang_id,
		// 			sku_barang.sku_barang_kode,
		// 			sku_barang.sku_barang_nama_produk,
		// 			sku_barang_harga,
		// 			sku_barang.sku_barang_satuan,
		// 			sku_barang.sku_barang_kemasan,
		// 			penerimaan_sku_barang_detail.sku_barang_qty AS penerimaan_sku_barang_detail_qty,
		// 			penerimaan_sku_barang_detail.sku_barang_qty - penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_sisa,
		// 			penerimaan_sku_barang_detail.sku_barang_qty_terima AS penerimaan_sku_barang_detail_qty_terima,
		// 			penerimaan_sku_barang.*,
		// 			po.purchase_order_keterangan
		// 		FROM penerimaan_sku_barang_detail
		// 			LEFT JOIN sku_barang
		// 			ON penerimaan_sku_barang_detail.sku_barang_id = sku_barang.sku_barang_id
		// 			LEFT JOIN penerimaan_sku_barang
		// 			on penerimaan_sku_barang_detail.penerimaan_sku_barang_id=penerimaan_sku_barang.penerimaan_sku_barang_id
		// 			Left join purchase_order po on po.purchase_order_id = penerimaan_sku_barang.purchase_order_id
		// 		WHERE penerimaan_sku_barang_detail.penerimaan_sku_barang_id = '$id' 
		// 		ORDER BY sku_barang.sku_barang_kode ASC")->result_array();
		// }
	}

	public function GetSubTotalDetailHarga($kf_id)
	{
		return $this->db->query("select sum(hasil.totalhargaqty) as subtotal from validasi_faktur vf
		LEFT JOIN (select isnull(sku_barang_jasa_harga,0) * isnull(sku_barang_jasa_qty_terima,0) as totalhargaqty, konfirmasi_hutang_id from validasi_faktur_detail)as hasil
		on vf.konfirmasi_hutang_id= hasil.konfirmasi_hutang_id where hasil.konfirmasi_hutang_id = '$kf_id'")->row();
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
				$client = "AND vf.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND vf.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("SELECT
			*,Format(vf.konfirmasi_hutang_tgl_create,'dd-MM-yyyy') as tgl_create
		  FROM validasi_faktur vf
		  WHERE FORMAT(vf.konfirmasi_hutang_tgl_create, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
			AND vf.depo_id = '" . $this->session->userdata('depo_id') . "' " . $perusahaan . " 
			" . $divisi . " order by vf.konfirmasi_hutang_tgl_create DESC")->result_array();
		} else {

			if ($client_wms_id == '') {
				$client = '';
			} else {
				$client = "AND vf.client_wms_id = '" . $client_wms_id . "'";
			}
			if ($perusahaan == "") {
				$perusahaan = "";
			} else {
				$perusahaan = "AND vf.client_wms_id = '" . $perusahaan . "' ";
			}

			if ($divisi == "") {
				$divisi = "";
			} else {
				$divisi = "AND approval.approval_divisi_id = '" . $divisi . "' ";
			}
			return $this->db->query("SELECT
			*,Format(vf.konfirmasi_hutang_tgl_create,'dd-MM-yyyy') as tgl_create
		  FROM validasi_faktur vf
		  WHERE FORMAT(vf.konfirmasi_hutang_tgl_create, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
			AND vf.depo_id = '" . $this->session->userdata('depo_id') . "' " . $perusahaan . " 
			" . $divisi . " order by vf.konfirmasi_hutang_tgl_create DESC")->result_array();
		}
	}

	public function GetDataDetailByKodePoDetail($kf, $idbarangjasa, $type)
	{
		if ($type == 2 || $type == '2') {
			return $this->db->query("
			SELECT
			  *
			FROM validasi_faktur vf
			LEFT JOIN konfirmasi_jasa kj
			  ON vf.konfirmasi_jasa_id = kj.konfirmasi_sku_jasa_id
			LEFT JOIN purchase_order po
			  ON po.purchase_order_id = kj.purchase_order_id
			INNER JOIN purchase_request pr
			  ON pr.purchase_request_id = po.purchase_request_id
			LEFT JOIN supplier s
			  ON po.supplier_id = s.supplier_id
			WHERE vf.konfirmasi_hutang_id = '$kf'
			AND kj.konfirmasi_sku_jasa_id = '$idbarangjasa'")->result_array();
		}
		if ($type == 1 || $type == '1') {
			return $this->db->query(" SELECT
			vf.*,
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
			pr.purchase_request_pemohon,
			format(psb.penerimaan_sku_barang_tgl_create,'dd-MM-yyyy') as formatpenerimaan_sku_barang_tgl_create
		FROM validasi_faktur vf
		left join penerimaan_sku_barang psb on vf.penerimaan_sku_barang_id = psb.penerimaan_sku_barang_id
		left join  purchase_order po on po.purchase_order_id = psb.purchase_order_id
		INNER JOIN purchase_request pr
			ON po.purchase_request_id = pr.purchase_request_id
			left join gudang g on g.gudang_id = po.gudang_id
			left join supplier s on po.supplier_id = s.supplier_id
		WHERE  vf.konfirmasi_hutang_id ='$kf' and  psb.penerimaan_sku_barang_id = '$idbarangjasa'")->result_array();
		}
	}
	public function delete_pemasukan_faktur_detail($konfirmasi_hutang_id)
	{
		$this->db->where("konfirmasi_hutang_id", $konfirmasi_hutang_id);
		return $this->db->delete('validasi_faktur_detail');
	}

	public function insert_pemasukan_faktur($konfirmasi_hutang_id, $konfirmasi_hutang_kode, $penerimaan_sku_barang_id, $konfirmasi_jasa_id, $client_wms_id, $konfirmasi_hutang_status, $konfirmasi_hutang_tgl_create, $konfirmasi_hutang_who_create, $konfirmasi_hutang_keterangan, $konfirmasi_hutang_attachment_1, $konfirmasi_hutang_attachment_2, $konfirmasi_hutang_attachment_3)
	{
		$konfirmasi_hutang_id = $konfirmasi_hutang_id == "" ? null : $konfirmasi_hutang_id;
		$konfirmasi_hutang_kode = $konfirmasi_hutang_kode == "" ? null : $konfirmasi_hutang_kode;
		$penerimaan_sku_barang_id = $penerimaan_sku_barang_id == "" ? null : $penerimaan_sku_barang_id;
		$konfirmasi_jasa_id = $konfirmasi_jasa_id == "" ? null : $konfirmasi_jasa_id;
		$konfirmasi_hutang_status = $konfirmasi_hutang_status == "" ? null : $konfirmasi_hutang_status;
		$client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
		$konfirmasi_hutang_keterangan = $konfirmasi_hutang_keterangan == "" ? null : $konfirmasi_hutang_keterangan;
		$konfirmasi_hutang_attachment_1 = $konfirmasi_hutang_attachment_1 == "" ? null : $konfirmasi_hutang_attachment_1;
		$konfirmasi_hutang_attachment_2 = $konfirmasi_hutang_attachment_2 == "" ? null : $konfirmasi_hutang_attachment_2;
		$konfirmasi_hutang_attachment_3 = $konfirmasi_hutang_attachment_3 == "" ? null : $konfirmasi_hutang_attachment_3;

		$this->db->set("konfirmasi_hutang_id", $konfirmasi_hutang_id);
		$this->db->set("konfirmasi_hutang_kode", $konfirmasi_hutang_kode);
		$this->db->set("depo_id", $this->session->userdata('depo_id'));
		$this->db->set("penerimaan_sku_barang_id", $penerimaan_sku_barang_id);
		$this->db->set("konfirmasi_jasa_id", $konfirmasi_jasa_id);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("konfirmasi_hutang_tgl_create", "GETDATE()", FALSE);
		$this->db->set("konfirmasi_hutang_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("konfirmasi_hutang_status", $konfirmasi_hutang_status);
		$this->db->set('konfirmasi_hutang_keterangan', $konfirmasi_hutang_keterangan);
		$this->db->set('konfirmasi_hutang_attachment_1', $konfirmasi_hutang_attachment_1);
		$this->db->set('konfirmasi_hutang_attachment_2', $konfirmasi_hutang_attachment_2);
		$this->db->set('konfirmasi_hutang_attachment_3', $konfirmasi_hutang_attachment_3);

		$queryinsert = $this->db->insert("validasi_faktur");

		return $queryinsert;
	}

	public function insert_pemasukan_faktur_detail($konfirmasi_hutang_id, $value)
	{
		$konfirmasi_hutang_id = $konfirmasi_hutang_id == "" ? null : $konfirmasi_hutang_id;
		$sku_barang_id = $value->sku_barang_id == "" ? null : $value->sku_barang_id;
		$sku_barang_jasa_qty_terima = $value->purchase_order_detail_qty == "" ? null : $value->purchase_order_detail_qty;
		$sku_barang_jasa_harga = $value->sku_barang_harga == "" ? null : $value->sku_barang_harga;
		$konfirmasi_hutang_detail_keterangan = $value->keterangan == "" || "-" ? null : $value->keterangan;


		$this->db->set("konfirmasi_hutang_detail_id", "NEWID()", false);
		$this->db->set("konfirmasi_hutang_id", $konfirmasi_hutang_id);
		$this->db->set("sku_barang_id", $sku_barang_id);
		$this->db->set("sku_barang_jasa_qty_terima", $sku_barang_jasa_qty_terima);
		$this->db->set("sku_barang_jasa_harga", $sku_barang_jasa_harga);
		$this->db->set("konfirmasi_hutang_detail_keterangan", $konfirmasi_hutang_detail_keterangan);


		$queryinsert = $this->db->insert("validasi_faktur_detail");

		return $queryinsert;
	}
	public function update_pemasukan_faktur($konfirmasi_hutang_id, $konfirmasi_hutang_status)

	{
		$this->db->set("konfirmasi_hutang_status", $konfirmasi_hutang_status);
		$this->db->where("konfirmasi_hutang_id", $konfirmasi_hutang_id);
		return $this->db->update("validasi_faktur");
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
		$jenis_pengadaan,
		$konfirmasi_hutang_id
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
		$konfirmasi_hutang_id = $konfirmasi_hutang_id == '' ? null : $konfirmasi_hutang_id;

		$this->db->trans_start();


		$this->db->set('pengajuan_dana_id', 'NEWID()', false);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('kategori_biaya_id', $kategori_biaya_id);
		$this->db->set('tipe_biaya_id', $tipe_biaya_id);
		$this->db->set('pengajuan_dana_kode', $pengajuan_dana_kode);
		$this->db->set('pengajuan_dana_status', 'Draft');
		$this->db->set('pengajuan_dana_judul', $pengajuan_dana_judul);
		$this->db->set('pengajuan_dana_keterangan', $pengajuan_dana_keterangan);
		$this->db->set('pengajuan_dana_tgl_pengajuan',  "GETDATE()", FALSE);
		$this->db->set('pengajuan_dana_tgl_dibutuhkan', null);
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
		$this->db->set('konfirmasi_hutang_id', $konfirmasi_hutang_id);
		$this->db->insert('pengajuan_dana');
		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			return 0;
		}
		$this->db->trans_commit();
		return 1;
	}

	public function getDataByKonfirmasi($konfirmasi_hutang_id)
	{
		$getId =  $this->db->query("select * from validasi_faktur where konfirmasi_hutang_id = '$konfirmasi_hutang_id'")->row();
		if ($getId->konfirmasi_jasa_id != null) {
			return $this->db->query("
			SELECT
			  *
			FROM validasi_faktur vf
			LEFT JOIN konfirmasi_jasa kj
			  ON vf.konfirmasi_jasa_id = kj.konfirmasi_sku_jasa_id
			LEFT JOIN purchase_order po
			  ON po.purchase_order_id = kj.purchase_order_id
			INNER JOIN purchase_request pr
			  ON pr.purchase_request_id = po.purchase_request_id
			LEFT JOIN supplier s
			  ON po.supplier_id = s.supplier_id
			WHERE vf.konfirmasi_hutang_id = '$konfirmasi_hutang_id'
			AND kj.konfirmasi_sku_jasa_id = '$getId->konfirmasi_jasa_id'")->row();
		}
		if ($getId->penerimaan_sku_barang_id != null) {
			return $this->db->query(" SELECT
			vf.*,
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
			pr.purchase_request_pemohon,
			format(psb.penerimaan_sku_barang_tgl_create,'dd-MM-yyyy') as formatpenerimaan_sku_barang_tgl_create
		FROM validasi_faktur vf
		left join penerimaan_sku_barang psb on vf.penerimaan_sku_barang_id = psb.penerimaan_sku_barang_id
		left join  purchase_order po on po.purchase_order_id = psb.purchase_order_id
		INNER JOIN purchase_request pr
			ON po.purchase_request_id = pr.purchase_request_id
			left join gudang g on g.gudang_id = po.gudang_id
			left join supplier s on po.supplier_id = s.supplier_id
		WHERE  vf.konfirmasi_hutang_id ='$konfirmasi_hutang_id' and  psb.penerimaan_sku_barang_id = '$getId->penerimaan_sku_barang_id'")->row();
		}
	}
}
