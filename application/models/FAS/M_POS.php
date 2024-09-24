<?php

class M_POS extends CI_Model
{
	public function GetStatusProgress()
	{
		$this->db->select("*")
			->from("status_progress")
			->where("status_progress_modul", "Delivery Order")
			->order_by("status_progress_no");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeStock()
	{
		$this->db->select("*")
			->from("gettipestock()")
			->where("tipe_stock_is_aktif", "1")
			->order_by("tipe_stock_urut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeSalesOrder()
	{
		$this->db->select("*")
			->from("tipe_sales_order")
			->where("tipe_sales_order_is_aktif", 1)
			->order_by("tipe_sales_order_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeDeliveryOrder()
	{
		$this->db->select("*")
			->from("tipe_delivery_order")
			->order_by("tipe_delivery_order_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetTipeLayanan()
	{
		$this->db->select("*")
			->from("tipe_layanan")
			->where("tipe_layanan_is_aktif", "1")
			->order_by("tipe_layanan_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}
	public function GetSalesOrderByListId($id)
	{
		$id = implode(",", $id);

		$query = $this->db->query("SELECT
									sales_order_id,
									depo_id,
									sales_order_kode,
									ISNULL(CONVERT(varchar(50), client_wms_id), '') AS client_wms_id,
									ISNULL(CONVERT(varchar(50), channel_id), '') AS channel_id,
									sales_order_is_handheld,
									sales_order_status,
									ISNULL(sales_order_approved_by, '') AS sales_order_approved_by,
									ISNULL(CONVERT(varchar(50), sales_id), '') AS sales_id,
									ISNULL(CONVERT(varchar(50), client_pt_id), '') AS client_pt_id,
									FORMAT(sales_order_tgl, 'dd/MM/yyyy') AS sales_order_tgl,
									FORMAT(sales_order_tgl_exp, 'dd/MM/yyyy') AS sales_order_tgl_exp,
									FORMAT(sales_order_tgl_harga, 'dd/MM/yyyy') AS sales_order_tgl_harga,
									FORMAT(sales_order_tgl_sj, 'dd/MM/yyyy') AS sales_order_tgl_sj,
									FORMAT(sales_order_tgl_kirim, 'dd/MM/yyyy') AS sales_order_tgl_kirim,
									ISNULL(sales_order_tipe_pembayaran, '') AS sales_order_tipe_pembayaran,
									ISNULL(CONVERT(varchar(50), tipe_sales_order_id), '') AS tipe_sales_order_id,
									ISNULL(sales_order_no_po, '') AS sales_order_no_po,
									ISNULL(sales_order_who_create, '') AS sales_order_who_create,
									sales_order_tgl_create,
									sales_order_is_downloaded,
									ISNULL(CONVERT(varchar(50), tipe_delivery_order_id), '') AS tipe_delivery_order_id,
									sales_order_is_uploaded,
									sales_order_keterangan,
									ISNULL(sales_order_no_reff,'') as sales_order_no_reff,
									sales_order_tgl_update AS tglUpdate
									FROM sales_order 
									WHERE sales_order_id IN (" . $id . ")
									ORDER BY sales_order_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderDetailByListId($id)
	{
		$query = $this->db->query("SELECT
									so.sales_order_detail_id,
									so.sales_order_id,
									ISNULL(CONVERT(varchar(50), so.client_wms_id), '') AS client_wms_id,
									ISNULL(CONVERT(varchar(50), so.sku_id), '') AS sku_id,
									ISNULL(sku.sku_kode, '') AS sku_kode,
									ISNULL(sku.sku_nama_produk, '') AS sku_nama_produk,
									ISNULL(so.sku_harga_satuan, '0') AS sku_harga_satuan,
									ISNULL(so.sku_disc_percent, '0') AS sku_disc_percent,
									ISNULL(so.sku_disc_rp, '0') AS sku_disc_rp,
									ISNULL(so.sku_harga_nett, '0') AS sku_harga_nett,
									ISNULL(so.sku_request_expdate, '0') AS sku_request_expdate,
									ISNULL(so.sku_filter_expdate, '0') AS sku_filter_expdate,
									ISNULL(so.sku_filter_expdatebulan, '0') AS sku_filter_expdatebulan,
									ISNULL(so.sku_filter_expdatetahun, '0') AS sku_filter_expdatetahun,
									ISNULL(so.sku_weight, '0') AS sku_weight,
									ISNULL(so.sku_weight_unit, '') AS sku_weight_unit,
									ISNULL(so.sku_length, '0') AS sku_length,
									ISNULL(so.sku_length_unit, '') AS sku_length_unit,
									ISNULL(so.sku_width, '0') AS sku_width,
									ISNULL(so.sku_width_unit, '') AS sku_width_unit,
									ISNULL(so.sku_height, '0') AS sku_height,
									ISNULL(so.sku_height_unit, '') AS sku_height_unit,
									ISNULL(so.sku_volume, '0') AS sku_volume,
									ISNULL(so.sku_volume_unit, '') AS sku_volume_unit,
									ISNULL(abs(so.sku_qty), '0') AS sku_qty,
									ISNULL(so.sku_keterangan, '') AS sku_keterangan,
									ISNULL(so.tipe_stock_nama, '') AS tipe_stock_nama,
									ISNULL(sku.sku_satuan, '') AS sku_satuan,
									ISNULL(sku.sku_kemasan, '') AS sku_kemasan,
									is_promo
									FROM sales_order_detail so
									LEFT JOIN sku
									ON sku.sku_id = so.sku_id
									WHERE so.sales_order_id = '$id'
									ORDER BY sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
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

	public function getPrinciple($perusahaanID)
	{
		$query = $this->db->query("SELECT p.principle_id, p.principle_kode, p.principle_nama FROM client_wms_principle cwp
		LEFT JOIN principle p ON p.principle_id = cwp.principle_id
		WHERE cwp.client_wms_id = '$perusahaanID' ORDER BY p.principle_kode ASC");

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
			$query = [];
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

	public function GetSelectedSKU($so_id, $sku_id)
	{
		$sku_id = implode(",", $sku_id);

		$query = $this->db->query("SELECT
									sku.sku_id,
									sku.sku_kode,
									sku.sku_varian,
									sku.sku_induk_id,
									ISNULL(sku.sku_weight,'0') sku_weight,
									ISNULL(sku.sku_weight_unit,'') sku_weight_unit,
									ISNULL(sku.sku_length,'0') sku_length,
									ISNULL(sku.sku_length_unit,'') sku_length_unit,
									ISNULL(sku.sku_width,'0') sku_width,
									ISNULL(sku.sku_width_unit,'') sku_width_unit,
									ISNULL(sku.sku_height,'0') sku_height,
									ISNULL(sku.sku_height_unit,'') sku_height_unit,
									ISNULL(sku.sku_volume,'0') sku_volume,
									ISNULL(sku.sku_volume_unit,'') sku_volume_unit,
									ISNULL(sku.sku_satuan,'') sku_satuan,
									ISNULL(sku.sku_kemasan,'') sku_kemasan,
									sku.kemasan_id,
									ISNULL(sku.sku_harga_jual,'0') AS sku_harga_jual,
									sku.kategori1_id,
									sku.kategori2_id,
									sku.kategori3_id,
									sku.kategori4_id,
									sku.kategori5_id,
									sku.kategori6_id,
									sku.kategori7_id,
									sku.kategori8_id,
									sku.principle_id,
									sku.principle_brand_id,
									sku.sku_nama_produk,
									ISNULL(sku.sku_deskripsi,'') sku_deskripsi,
									ISNULL(sku.sku_origin,'') sku_origin,
									ISNULL(sku.sku_kondisi,'') sku_kondisi,
									ISNULL(sku.sku_sales_min_qty,'0') sku_sales_min_qty,
									ISNULL(sku.sku_ppnbm_persen,'0') sku_ppnbm_persen,
									ISNULL(sku.sku_ppn_persen,'0') sku_ppn_persen,
									ISNULL(sku.sku_pph,'0') sku_pph,
									sku.sku_is_aktif,
									sku.sku_is_jual,
									sku.sku_is_paket,
									sku.sku_is_deleted,
									ISNULL(sku.sku_weight_netto,'0') sku_weight_netto,
									ISNULL(sku.sku_weight_netto_unit,'') sku_weight_netto_unit,
									ISNULL(sku.sku_weight_product,'0') sku_weight_product,
									ISNULL(sku.sku_weight_product_unit,'') sku_weight_product_unit,
									ISNULL(sku.sku_weight_packaging,'0') sku_weight_packaging,
									ISNULL(sku.sku_weight_packaging_unit,'') sku_weight_packaging_unit,
									ISNULL(sku.sku_weight_gift,'0') sku_weight_gift,
									ISNULL(sku.sku_weight_gift_unit,'') sku_weight_gift_unit,
									sku.sku_bosnet_id,
									sku.sku_is_hadiah,
									sku.sku_is_from_import,
									ISNULL(sku.sku_kode_sku_principle,'') sku_kode_sku_principle,
									sku.client_wms_id,
									client_wms.client_wms_nama,
									principle.principle_kode AS principle,
									principle_brand.principle_brand_nama AS brand,
  									SUM(ISNULL(so_temp.sku_qty,'0')) AS so_sku_qty,
									CAST(ISNULL(sku.sku_harga_jual,0) * SUM(ISNULL(so_temp.sku_qty, '0')) AS int) AS sub_total
									FROM sku
									LEFT JOIN sales_order_detail_2_temp so_temp
									ON so_temp.sku_id = sku.sku_id
									AND so_temp.sales_order_detail_id = '$so_id'
									LEFT JOIN client_wms
									ON client_wms.client_wms_id = sku.client_wms_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									WHERE sku.sku_id IN (" . $sku_id . ")
									GROUP BY sku.sku_id,
											sku.sku_kode,
											sku.sku_varian,
											sku.sku_induk_id,
											ISNULL(sku.sku_weight, '0'),
											ISNULL(sku.sku_weight_unit, ''),
											ISNULL(sku.sku_length, '0'),
											ISNULL(sku.sku_length_unit, ''),
											ISNULL(sku.sku_width, '0'),
											ISNULL(sku.sku_width_unit, ''),
											ISNULL(sku.sku_height, '0'),
											ISNULL(sku.sku_height_unit, ''),
											ISNULL(sku.sku_volume, '0'),
											ISNULL(sku.sku_volume_unit, ''),
											ISNULL(sku.sku_satuan, ''),
											ISNULL(sku.sku_kemasan, ''),
											sku.kemasan_id,
											sku.sku_harga_jual,
											sku.kategori1_id,
											sku.kategori2_id,
											sku.kategori3_id,
											sku.kategori4_id,
											sku.kategori5_id,
											sku.kategori6_id,
											sku.kategori7_id,
											sku.kategori8_id,
											sku.principle_id,
											sku.principle_brand_id,
											sku.sku_nama_produk,
											ISNULL(sku.sku_deskripsi, ''),
											ISNULL(sku.sku_origin, ''),
											ISNULL(sku.sku_kondisi, ''),
											ISNULL(sku.sku_sales_min_qty, '0'),
											ISNULL(sku.sku_ppnbm_persen, '0'),
											ISNULL(sku.sku_ppn_persen, '0'),
											ISNULL(sku.sku_pph, '0'),
											sku.sku_is_aktif,
											sku.sku_is_jual,
											sku.sku_is_paket,
											sku.sku_is_deleted,
											ISNULL(sku.sku_weight_netto, '0'),
											ISNULL(sku.sku_weight_netto_unit, ''),
											ISNULL(sku.sku_weight_product, '0'),
											ISNULL(sku.sku_weight_product_unit, ''),
											ISNULL(sku.sku_weight_packaging, '0'),
											ISNULL(sku.sku_weight_packaging_unit, ''),
											ISNULL(sku.sku_weight_gift, '0'),
											ISNULL(sku.sku_weight_gift_unit, ''),
											sku.sku_bosnet_id,
											sku.sku_is_hadiah,
											sku.sku_is_from_import,
											ISNULL(sku.sku_kode_sku_principle, ''),
											sku.client_wms_id,
											client_wms.client_wms_nama,
											principle.principle_kode,
											principle_brand.principle_brand_nama
									ORDER BY client_wms.client_wms_nama, sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetCustomerByTypePelayanan($nama, $alamat, $telp, $client_pt_id)
	{

		if ($nama == "") {
			$nama = "";
		} else {
			$nama = "AND client_pt.client_pt_nama LIKE '%" . $nama . "%' ";
		}

		if ($alamat == "") {
			$alamat = "";
		} else {
			$alamat = "AND client_pt.client_pt_alamat LIKE '%" . $alamat . "%' ";
		}

		if ($telp == "") {
			$telp = "";
		} else {
			$telp = "AND client_pt.client_pt_telepon LIKE '%" . $telp . "%' ";
		}

		if ($client_pt_id == "") {
			$client_pt_id = "";
		} else {
			$client_pt_id = "AND client_pt.client_pt_id NOT IN ('" . $client_pt_id . "') ";
		}

		$query = $this->db->query("SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id IS NOT NULL
									" . $nama . "
									" . $alamat . "
									" . $telp . "
									" . $client_pt_id . "
									ORDER BY client_pt.client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSelectedPrinciple($customer, $perusahaan)
	{
		$query = $this->db->query("SELECT
									principle.*,
									isnull(area.area_nama,'') AS area_nama
									FROM client_wms_principle
									LEFT JOIN principle
									ON principle.principle_id = client_wms_principle.principle_id
									LEFT JOIN area
									ON principle.area_id = area.area_id
									WHERE principle.principle_id = '$customer'
									AND client_wms_principle.client_wms_id = '$perusahaan'
									ORDER BY principle.principle_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSelectedCustomer($customer)
	{
		$query = $this->db->query("SELECT DISTINCT
									client_pt.*,
									isnull(area.area_nama,'') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id = '$customer'
									ORDER BY client_pt.client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function search_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND so.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND so.principle_id = '" . $principle . "' ";
		}

		if ($kode == "") {
			$kode = "";
		} else {
			$kode = "AND so.sales_order_kode LIKE '%" . $kode . "%' ";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = "AND so.sales_order_status= '$status' ";
		}

		if ($tipe == "") {
			$tipe = "";
		} else {
			$tipe = "AND so.tipe_sales_order_id = '" . $tipe . "' ";
		}

		if ($sales == "") {
			$sales = "";
		} else {
			$sales = "AND so.sales_id = '" . $sales . "' ";
		}

		if ($tgl_kirim == "") {
			$tgl_kirim = "";
		} else {
			$tgl_kirim = "AND so.sales_order_tgl_kirim = '" . $tgl_kirim . "' ";
		}

		$query = $this->db->query("SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										cust.client_pt_telepon,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										SUM(ISNULL(sod.sku_harga_nett,0)) as sku_harga_nett,
										SUM(ISNULL(payment.sales_order_detail_payment_nominal,0)) as sales_order_detail_payment_nominal,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan
									FROM sales_order so
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN sales_order_detail_payment payment
									ON payment.sales_order_id = so.sales_order_id
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									LEFT JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									" . $perusahaan . "
									" . $kode . "
									" . $status . "
									" . $tipe . "
									" . $sales . "
									" . $principle . "
									" . $tgl_kirim . "
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										cust.client_pt_telepon,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $start, $end, $search, $order_column, $order_dir, $is_priority)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND so.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND so.principle_id = '" . $principle . "' ";
		}

		if ($kode == "") {
			$kode = "";
		} else {
			$kode = "AND so.sales_order_kode LIKE '%" . $kode . "%' ";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = "AND so.sales_order_status= '$status' ";
		}

		if ($tipe == "") {
			$tipe = "";
		} else {
			$tipe = "AND so.tipe_sales_order_id = '" . $tipe . "' ";
		}

		if ($sales == "") {
			$sales = "";
		} else {
			$sales = "AND so.sales_id = '" . $sales . "' ";
		}

		if ($tgl_kirim == "") {
			$tgl_kirim = "";
		} else {
			$tgl_kirim = "AND FORMAT(so.sales_order_tgl_kirim, 'yyyy-MM-dd') = '" . $tgl_kirim . "' ";
		}

		if ($is_priority == "") {
			$is_priority = "";
		} else {
			$is_priority = "AND is_priority = '" . $is_priority . "' ";
		}

		$order_by = '';
		if ($order_column == 0) {
			$order_by = "ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy') DESC";
		} else if ($order_column == 1) {
			$order_by = "ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy') " . $order_dir . "";
		} else if ($order_column == 2) {
			$order_by = "ORDER BY so.sales_order_kode " . $order_dir . "";
		} else if ($order_column == 3) {
			$order_by = "ORDER BY so.sales_order_status " . $order_dir . "";
		} else if ($order_column == 4) {
			$order_by = "ORDER BY tipe.tipe_sales_order_nama " . $order_dir . "";
		} else if ($order_column == 5) {
			$order_by = "ORDER BY tipe.tipe_sales_order_nama " . $order_dir . "";
		} else if ($order_column == 6) {
			$order_by = "ORDER BY cust.client_pt_nama " . $order_dir . "";
		} else if ($order_column == 7) {
			$order_by = "ORDER BY cust.client_pt_alamat " . $order_dir . "";
		} else if ($order_column == 8) {
			$order_by = "ORDER BY cust.client_pt_telepon " . $order_dir . "";
		} else if ($order_column == 9) {
			$order_by = "ORDER BY sod.sku_harga_nett " . $order_dir . "";
		} else if ($order_column == 10) {
			$order_by = "ORDER BY payment.sales_order_detail_payment_nominal " . $order_dir . "";
		}

		$query = $this->db->query("SELECT
										ROW_NUMBER() OVER (ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy') DESC) - 1 AS idx,
										ROW_NUMBER() OVER (ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy') DESC) AS no_urut,
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										cust.client_pt_telepon,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										SUM(ISNULL(sod.sku_harga_nett,0)) as sku_harga_nett,
										SUM(ISNULL(payment.sales_order_detail_payment_nominal,0)) as sales_order_detail_payment_nominal,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										CASE WHEN ISNULL(so.is_priority, 0) = 1 THEN 'Yes' ELSE '' END AS is_priority
									FROM sales_order so
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN sales_order_detail_payment payment
									ON payment.sales_order_id = so.sales_order_id
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									LEFT JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									" . $perusahaan . "
									" . $kode . "
									" . $status . "
									" . $tipe . "
									" . $sales . "
									" . $principle . "
									" . $tgl_kirim . "
									" . $is_priority . "
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										cust.client_pt_telepon,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan,
										CASE WHEN ISNULL(so.is_priority, 0) = 1 THEN 'Yes' ELSE '' END
									" . $order_by . "
									OFFSET " . $start . " ROWS
									FETCH NEXT " . $end . " ROWS ONLY");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetTotalSalesOrderByFilter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle, $tgl_kirim, $search, $is_priority)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND so.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND so.principle_id = '" . $principle . "' ";
		}

		if ($kode == "") {
			$kode = "";
		} else {
			$kode = "AND so.sales_order_kode LIKE '%" . $kode . "%' ";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = "AND so.sales_order_status= '$status' ";
		}

		if ($tipe == "") {
			$tipe = "";
		} else {
			$tipe = "AND so.tipe_sales_order_id = '" . $tipe . "' ";
		}

		if ($sales == "") {
			$sales = "";
		} else {
			$sales = "AND so.sales_id = '" . $sales . "' ";
		}

		if ($is_priority == "") {
			$is_priority = "";
		} else {
			$is_priority = "AND so.is_priority = '" . $is_priority . "' ";
		}

		if ($tgl_kirim == "") {
			$tgl_kirim = "";
		} else {
			$tgl_kirim = "AND FORMAT(so.sales_order_tgl_kirim, 'yyyy-MM-dd') = '" . $tgl_kirim . "' ";
		}

		$query = $this->db->query("SELECT
										COUNT(DISTINCT so.sales_order_id) AS jumlah
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									LEFT JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									" . $perusahaan . "
									" . $kode . "
									" . $status . "
									" . $tipe . "
									" . $sales . "
									" . $principle . "
									" . $is_priority . "
									" . $tgl_kirim . "");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->row(0)->jumlah;
		}

		return $query;
		// return $this->db->last_query();
	}

	public function searchEdit_so_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status, $tipe, $sales, $principle)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND so.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND so.principle_id = '" . $principle . "' ";
		}

		if ($kode == "") {
			$kode = "";
		} else {
			$kode = "AND so.sales_order_kode LIKE '%" . $kode . "%' ";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = "AND so.sales_order_status= '$status' ";
		}

		if ($tipe == "") {
			$tipe = "";
		} else {
			$tipe = "AND so.tipe_sales_order_id = '" . $tipe . "' ";
		}

		if ($sales == "") {
			$sales = "";
		} else {
			$sales = "AND so.sales_id = '" . $sales . "' ";
		}

		$query = $this->db->query("SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										sum(sod.sku_harga_nett) as sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan,
										so.is_priority
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									LEFT JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									-- AND so.sales_order_status = 'Draft'
									" . $perusahaan . "
									" . $kode . "
									" . $tipe . "
									" . $status . "
									" . $sales . "
									" . $principle . "
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan,
										so.is_priority
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderHeaderById($id)
	{
		$query = $this->db->query("SELECT
									so.sales_order_id,
									so.sales_order_kode,
									FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
									FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl_create,
									FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl_exp,
									FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl_harga,
									FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
									FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl_sj,
									so.sales_id,
									sales.karyawan_nama AS sales_nama,
									so.client_wms_id,
									so.client_pt_id,
									cust.client_pt_nama,
									cust.client_pt_alamat,
									cust.area_id,
									area.area_nama,
									ISNULL(so.sales_order_no_po,'') AS sales_order_no_po,
									so.sales_order_tipe_pembayaran,
									so.sales_order_status,
									so.tipe_sales_order_id,
									tipe.tipe_sales_order_nama,
									ISNULL(so.sales_order_approved_by,'') AS sales_order_approved_by,
									so.sales_order_is_handheld,
									so.sales_order_is_downloaded,
									so.tipe_delivery_order_id,
									so.sales_order_is_uploaded,
									so.sales_order_tgl_update as tglUpdate,
									ISNULL(so.sales_order_no_reff,'') AS sales_order_no_reff
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN area
									ON cust.area_id = area.area_id
									LEFT JOIN karyawan sales
									ON sales.karyawan_id = so.sales_id
									WHERE so.sales_order_id ='$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderDetailById($id)
	{
		$query = $this->db->query("SELECT dtl2.sales_order_detail2_id,
											dtl2.sales_order_detail_id,
											dtl.sales_order_id,
											dtl2.sku_id,
											dtl2.sku_stock_id,
											dtl2.sku_expdate,
											dtl2.sku_qty,
											ISNULL(dtl.sku_disc_rp, 0) sku_disc_rp,
											ISNULL(dtl.sku_harga_nett, 0) sku_harga_nett,
											ISNULL(CONVERT(NVARCHAR(36), dtl2.delivery_order_reff_id), '') delivery_order_reff_id
										FROM sales_order_detail_2 dtl2
										LEFT JOIN sales_order_detail dtl
											ON dtl.sales_order_detail_id = dtl2.sales_order_detail_id
										WHERE dtl.sales_order_id = '$id'
										ORDER BY dtl2.sku_id ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderPaymentById($id)
	{
		$query = $this->db->query("SELECT sales_order_detail_payment_id,
										sales_order_id,
										sales_order_detail_payment_nominal,
										sales_order_detail_payment_tipe
									FROM sales_order_detail_payment
									WHERE sales_order_id = '$id'
									ORDER BY sales_order_detail_payment_tipe ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderDetail2ById($id)
	{
		$query = $this->db->query("SELECT
									so.sales_order_detail2_id,
									so.sales_order_detail_id,
									so.sku_id,
									so.sku_stock_id,
									sku_stock.depo_detail_id,
									FORMAT(so.sku_expdate,'yyyy-MM-dd') as sku_expdate,
									ISNULL(so.sku_qty,0) AS sku_qty,
									ISNULL(convert(nvarchar(36), delivery_order_reff_id),'') AS delivery_order_reff_id
								FROM sales_order_detail_2 so
								LEFT JOIN sku_stock
								ON sku_stock.sku_stock_id = so.sku_stock_id
								WHERE sales_order_detail_id IN (select sales_order_detail_id from sales_order_detail where sales_order_id = '$id') ");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_header_by_id($sales_order_id, $sku_id)
	{
		$query = $this->db->query("SELECT
										sku.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										sku.sku_harga_jual,
										sku.principle_id,
										SUM(ISNULL(ABS(so.sku_qty), 0)) AS sku_qty_so
									FROM sku
									LEFT JOIN sales_order_detail_2_temp so
										ON sku.sku_id = so.sku_id
										AND so.sales_order_detail_id in (select sales_order_detail_id from sales_order_detail where sales_order_id = '$sales_order_id')
									WHERE sku.sku_id = '$sku_id'
									GROUP BY sku.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											sku.sku_kemasan,
											sku.sku_satuan,
											sku.sku_harga_jual,
											sku.principle_id");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_header_by_id2($so_id, $sku_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(abs(so.sku_qty),0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2 so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '$sku_id'
									AND so.sales_order_detail_id in (select sales_order_detail_id from sales_order_detail where sales_order_id = '$so_id' and sku_id = '$sku_id')
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_header_by_id3($so_id, $sku_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(abs(so.sku_qty),0)) AS sku_qty_so
									FROM sales_order_detail_2 so
									LEFT JOIN sku_stock
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '$sku_id'
									AND so.sales_order_detail_id in (select sales_order_detail_id from sales_order_detail where sales_order_id = '$so_id' and sku_id = '$sku_id')
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_by_id($sku_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.depo_detail_id,
									ISNULL(depo_detail.depo_detail_nama,'') AS depo_detail_nama,
									sku_stock.sku_stock_id,
									sku_stock.sku_id,
									FORMAT(sku_stock.sku_stock_expired_date, 'dd-MM-yyy') AS sku_stock_expired_date,
									ISNULL(sku_stock.sku_stock_awal, 0) + ISNULL(sku_stock.sku_stock_masuk, 0) - ISNULL(sku_stock.sku_stock_saldo_alokasi, 0) - ISNULL(sku_stock.sku_stock_keluar, 0) AS sku_stock_akhir,
									ISNULL(so.sku_qty, 0) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN depo_detail
									ON sku_stock.depo_detail_id = depo_detail.depo_detail_id
									WHERE sku_stock.sku_stock_is_jual = '1'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND sku_stock.sku_id = '$sku_id'
									ORDER BY sku_stock.sku_stock_expired_date ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_retur_by_id($sku_id, $principle_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.depo_detail_id,
									ISNULL(depo_detail.depo_detail_nama,'') AS depo_detail_nama,
									sku_stock.sku_stock_id,
									sku_stock.sku_id,
									FORMAT(sku_stock.sku_stock_expired_date, 'dd-MM-yyy') AS sku_stock_expired_date,
									ISNULL(sku_stock.sku_stock_awal, 0) + ISNULL(sku_stock.sku_stock_masuk, 0) - ISNULL(sku_stock.sku_stock_saldo_alokasi, 0) - ISNULL(sku_stock.sku_stock_keluar, 0) AS sku_stock_akhir,
									ISNULL(so.sku_qty, 0) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN depo_detail
									ON sku_stock.depo_detail_id = depo_detail.depo_detail_id
									WHERE sku_stock.sku_stock_is_jual = '1'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND sku_stock.sku_id = '$sku_id'
									ORDER BY sku_stock.sku_stock_expired_date ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_by_id2($so_id, $sku_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.depo_detail_id,
									ISNULL(depo_detail.depo_detail_nama,'') AS depo_detail_nama,
									sku_stock.sku_stock_id,
									sku_stock.sku_id,
									FORMAT(sku_stock.sku_stock_expired_date, 'dd-MM-yyy') AS sku_stock_expired_date,
									ISNULL(sku_stock.sku_stock_awal,0) + ISNULL(sku_stock.sku_stock_masuk,0) - ISNULL(sku_stock.sku_stock_saldo_alokasi,0) - ISNULL(sku_stock.sku_stock_keluar,0) AS sku_stock_akhir,
									ISNULL(so.sku_qty,0) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2 so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									AND so.sales_order_detail_id in (select sales_order_detail_id from sales_order_detail where sales_order_id = '$so_id' and sku_id = '$sku_id')
									LEFT JOIN depo_detail
									ON sku_stock.depo_detail_id = depo_detail.depo_detail_id
									WHERE sku_stock.sku_stock_is_jual = '1'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND sku_stock.sku_id = '$sku_id'
									ORDER BY sku_stock.sku_stock_expired_date ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_ed_sku_by_id3($so_id, $sku_id)
	{
		$query = $this->db->query("SELECT
									sku_stock.depo_detail_id,
									ISNULL(depo_detail.depo_detail_nama,'') AS depo_detail_nama,
									sku_stock.sku_stock_id,
									sku_stock.sku_id,
									FORMAT(sku_stock.sku_stock_expired_date, 'dd-MM-yyy') AS sku_stock_expired_date,
									ISNULL(sku_stock.sku_stock_awal,0) + ISNULL(sku_stock.sku_stock_masuk,0) - ISNULL(sku_stock.sku_stock_saldo_alokasi,0) - ISNULL(sku_stock.sku_stock_keluar,0) AS sku_stock_akhir,
									ISNULL(so.sku_qty,0) AS sku_qty_so
									FROM sales_order_detail_2 so
									LEFT JOIN sku_stock
									ON sku_stock.sku_stock_id = so.sku_stock_id
									AND so.sales_order_detail_id in (select sales_order_detail_id from sales_order_detail where sales_order_id = '$so_id' and sku_id = '$sku_id')
									LEFT JOIN depo_detail
									ON sku_stock.depo_detail_id = depo_detail.depo_detail_id
									WHERE sku_stock.sku_stock_is_jual = '1'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND sku_stock.sku_id = '$sku_id'
									ORDER BY sku_stock.sku_stock_expired_date ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_filter_chosen_sku($brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan, $arr_sku_stock_id)
	{
		$arr_sku_stock_id_str = "";

		if ($brand == "") {
			$brand = "";
		} else {
			$brand = "AND principle_brand.principle_brand_nama LIKE '%" . $brand . "%' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND principle.principle_kode LIKE '%" . $principle . "%' ";
		}

		if ($sku_induk == "") {
			$sku_induk = "";
		} else {
			$sku_induk = "AND sku_induk.sku_induk_nama LIKE '%" . $sku_induk . "%' ";
		}

		if ($sku_nama_produk == "") {
			$sku_nama_produk = "";
		} else {
			$sku_nama_produk = "AND sku.sku_nama_produk LIKE '%" . $sku_nama_produk . "%' ";
		}

		if ($sku_kemasan == "") {
			$sku_kemasan = "";
		} else {
			$sku_kemasan = "AND sku.sku_kemasan LIKE '%" . $sku_kemasan . "%' ";
		}

		if ($sku_satuan == "") {
			$sku_satuan = "";
		} else {
			$sku_satuan = "AND sku.sku_satuan LIKE '%" . $sku_satuan . "%' ";
		}

		if (isset($arr_sku_stock_id)) {
			if (count($arr_sku_stock_id) > 0) {
				$arr_sku_stock_id_str = "AND sku_stock.sku_stock_id NOT IN (" . implode(",", $arr_sku_stock_id) . ")";
			} else {
				$arr_sku_stock_id_str = "";
			}
		} else {
			$arr_sku_stock_id_str = "";
		}

		$query = $this->db->query("SELECT
									sku_stock.sku_stock_id
									,sku.sku_id
									,sku.sku_kode
									,sku.sku_nama_produk
									,sku.principle_id
									,principle.principle_kode AS principle
									,sku.principle_brand_id
									,principle_brand.principle_brand_nama AS brand
									,sku.sku_kemasan
									,sku.sku_satuan
									,sku.sku_induk_id
									,sku_induk.sku_induk_nama AS sku_induk
									,FORMAT(sku_stock.sku_stock_expired_date, 'yyyy-MM-dd') AS sku_expdate
									,ISNULL(sku_stock.sku_stock_awal, 0) + ISNULL(sku_stock.sku_stock_masuk, 0) - ISNULL(sku_stock.sku_stock_saldo_alokasi, 0) - ISNULL(sku_stock.sku_stock_keluar, 0) AS sku_stock_qty
									FROM sku_stock
									INNER JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									LEFT JOIN sku_induk
									ON sku.sku_induk_id = sku_induk.sku_induk_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									LEFT JOIN depo_detail
									ON depo_detail.depo_detail_id = sku_stock.depo_detail_id
									WHERE sku_stock.sku_stock_id IS NOT NULL
									AND depo_detail.depo_detail_flag_jual = 1
									AND depo_detail.depo_detail_is_pos = 1
									" . $brand . "
									" . $principle . "
									" . $sku_induk . "
									" . $sku_nama_produk . "
									" . $sku_kemasan . "
									" . $sku_satuan . "
									" . $arr_sku_stock_id_str . "
									ORDER BY principle.principle_kode, sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function search_filter_chosen_sku_retur($sales_order_id)
	{

		$query = $this->db->query("SELECT
									sku.client_wms_id,
									client_wms.client_wms_nama,
									sku.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.principle_id,
									principle.principle_kode AS principle,
									sku.principle_brand_id,
									principle_brand.principle_brand_nama AS brand,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_induk_id,
									sku_induk.sku_induk_nama AS sku_induk
									FROM WMS.dbo.delivery_order_detail do
									INNER JOIN sku
									ON sku.sku_id = do.sku_id
									LEFT JOIN sku_induk
									ON sku.sku_induk_id = sku_induk.sku_induk_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									INNER JOIN client_wms
									ON sku.client_wms_id = client_wms.client_wms_id
									WHERE delivery_order_id IN (SELECT
									delivery_order_id
									FROM WMS.dbo.delivery_order
									WHERE sales_order_id = '$sales_order_id')
									GROUP BY sku.client_wms_id,
											client_wms.client_wms_nama,
											sku.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											sku.principle_id,
											principle.principle_kode,
											sku.principle_brand_id,
											principle_brand.principle_brand_nama,
											sku.sku_kemasan,
											sku.sku_satuan,
											sku.sku_induk_id,
											sku_induk.sku_induk_nama
									ORDER BY client_wms.client_wms_nama, principle.principle_kode, sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sales_order_by_top_retur_default($client_pt_id)
	{
		// $query = $this->db->query("SELECT TOP 10 * from delivery_orderorder by delivery_order_kode desc");

		$query = $this->db->query("SELECT
										delivery_order_id,
										delivery_order_kode
									FROM WMS.dbo.delivery_order
									WHERE FORMAT(delivery_order_tgl_aktual_kirim,'yyyy-MM-dd') BETWEEN DATEADD(day, -90, convert(date, GETDATE())) AND GETDATE()
									AND client_pt_id = '$client_pt_id'
									AND delivery_order_status IN ('delivered')");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function Get_sales_order_by_top_retur($top, $client_pt_id, $sku_id)
	{
		if ($top != "") {
			// $query = $this->db->query("SELECT TOP 10 * from delivery_order order by delivery_order_kode desc");

			$query = $this->db->query("SELECT
										do.delivery_order_id,
										do.delivery_order_kode
										FROM WMS.dbo.delivery_order do
										LEFT JOIN delivery_order_detail do_detail
										ON do_detail.delivery_order_id = do.delivery_order_id
										LEFT JOIN sku
										ON sku.sku_id = do_detail.sku_id
										WHERE FORMAT(delivery_order_tgl_aktual_kirim, 'yyyy-MM-dd') BETWEEN DATEADD(DAY, " . -1 * $top . ", CONVERT(date, GETDATE())) AND GETDATE()
										AND client_pt_id = '$client_pt_id'
										AND do_detail.sku_id = '$sku_id'
										AND delivery_order_status IN ('delivered')
										GROUP BY do.delivery_order_id,
												do.delivery_order_kode
										ORDER BY do.delivery_order_kode ASC");

			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result();
			}
		} else {
			$query = 0;
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_delivery_order_detail2_by_filter($delivery_order_id, $sku_id, $arr_so_detail2_ed)
	{

		if ($delivery_order_id != "") {
			$delivery_order_id = implode(",", $delivery_order_id);

			$union = " UNION ALL ";
			$table_sementara = "";
			$list_sku_id = array();

			if ($arr_so_detail2_ed != "") {

				foreach ($arr_so_detail2_ed as $key => $value) {
					array_push($list_sku_id, "'" . $value['sku_id'] . "'");

					$table_sementara .= "SELECT '" . $value['delivery_order_reff_id'] . "' AS delivery_order_reff_id, '" . $value['idx'] . "' AS idx, '" . $value['index_so_detail'] . "' AS index_so_detail, '" . $value['depo_detail_id'] . "' AS depo_detail_id,'" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_stock_expired_date'] . "' AS sku_stock_expired_date," . $value['sku_qty'] . " AS sku_qty";

					if ($key < count($arr_so_detail2_ed) - 1) {
						$table_sementara .= $union;
					}
				}
			} else {
				$table_sementara .= "SELECT NULL AS delivery_order_reff_id, NULL AS idx, NULL AS index_so_detail, NULL AS depo_detail_id, NULL AS sku_id, NULL AS sku_stock_expired_date ,NULL AS sku_qty";
			}

			$query = $this->db->query("SELECT
										delivery_order_id,
										sku_id,
										sku_expdate,
										SUM(sku_qty) AS sku_qty
										FROM delivery_order_detail2 WHERE delivery_order_id IN (" . $delivery_order_id . ") AND sku_id = '$sku_id' AND delivery_order_id NOT IN (select delivery_order_reff_id from (" . $table_sementara . ") a WHERE sku_id = '$sku_id')
										GROUP BY delivery_order_id,
												sku_id,
												sku_expdate
										ORDER BY sku_expdate ASC");

			// $query = $this->db->query("SELECT TOP 2 * FROM delivery_order_detail2 WHERE sku_id = '$sku_id' AND delivery_order_id NOT IN (select delivery_order_reff_id from (" . $table_sementara . ") a WHERE sku_id = '$sku_id')");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function insert_sales_order(
		$sales_order_id,
		$depo_id,
		$sales_order_kode,
		$client_wms_id,
		$channel_id,
		$sales_order_is_handheld,
		$sales_order_status,
		$sales_order_approved_by,
		$sales_id,
		$client_pt_id,
		$sales_order_tgl,
		$sales_order_tgl_exp,
		$sales_order_tgl_harga,
		$sales_order_tgl_sj,
		$sales_order_tgl_kirim,
		$sales_order_tipe_pembayaran,
		$tipe_sales_order_id,
		$sales_order_no_po,
		$sales_order_who_create,
		$sales_order_tgl_create,
		$sales_order_is_downloaded,
		$tipe_delivery_order_id,
		$sales_order_is_uploaded,
		$sales_order_no_reff
	) {
		// $tgl = $tgl . " " . date('H:i:s');

		$sales_order_id =  $sales_order_id ==  "" ? null : $sales_order_id;
		$depo_id =  $depo_id ==  "" ? null : $depo_id;
		$sales_order_kode =  $sales_order_kode ==  "" ? null : $sales_order_kode;
		$client_wms_id =  $client_wms_id ==  "" ? null : $client_wms_id;
		$channel_id =  $channel_id ==  "" ? null : $channel_id;
		$sales_order_is_handheld =  $sales_order_is_handheld ==  "" ? null : $sales_order_is_handheld;
		$sales_order_status =  $sales_order_status ==  "" ? null : $sales_order_status;
		$sales_order_approved_by =  $sales_order_approved_by ==  "" ? null : $sales_order_approved_by;
		$sales_id =  $sales_id ==  "" ? null : $sales_id;
		$client_pt_id =  $client_pt_id ==  "" ? null : $client_pt_id;
		$sales_order_tgl =  $sales_order_tgl ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl)));
		$sales_order_tgl_exp =  $sales_order_tgl_exp ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_exp)));
		$sales_order_tgl_harga =  $sales_order_tgl_harga ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_harga)));
		$sales_order_tgl_sj =  $sales_order_tgl_sj ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_sj)));
		$sales_order_tgl_kirim =  $sales_order_tgl_kirim ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_kirim)));
		$sales_order_tipe_pembayaran =  $sales_order_tipe_pembayaran ==  "" ? null : $sales_order_tipe_pembayaran;
		$tipe_sales_order_id =  $tipe_sales_order_id ==  "" ? null : $tipe_sales_order_id;
		$sales_order_no_po =  $sales_order_no_po ==  "" ? null : $sales_order_no_po;
		$sales_order_who_create =  $sales_order_who_create ==  "" ? null : $sales_order_who_create;
		$sales_order_tgl_create =  $sales_order_tgl_create ==  "" ? null : $sales_order_tgl_create;
		$sales_order_is_downloaded =  $sales_order_is_downloaded ==  "" ? null : $sales_order_is_downloaded;
		$tipe_delivery_order_id =  $tipe_delivery_order_id ==  "" ? null : $tipe_delivery_order_id;
		$sales_order_is_uploaded =  $sales_order_is_uploaded ==  "" ? null : $sales_order_is_uploaded;
		$sales_order_no_reff =  $sales_order_no_reff ==  "" ? null : $sales_order_no_reff;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$this->db->set("sales_order_id", $sales_order_id);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("sales_order_kode", $sales_order_kode);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("channel_id", $channel_id);
		$this->db->set("sales_order_is_handheld", $sales_order_is_handheld);
		$this->db->set("sales_order_status", $sales_order_status);
		$this->db->set("sales_order_approved_by", $sales_order_approved_by);
		$this->db->set("sales_id", $sales_id);
		$this->db->set("client_pt_id", $client_pt_id);
		$this->db->set("sales_order_tgl", $sales_order_tgl);
		$this->db->set("sales_order_tgl_exp", $sales_order_tgl_exp);
		$this->db->set("sales_order_tgl_harga", $sales_order_tgl_harga);
		$this->db->set("sales_order_tgl_sj", $sales_order_tgl_sj);
		$this->db->set("sales_order_tgl_kirim", $sales_order_tgl_kirim);
		$this->db->set("sales_order_tipe_pembayaran", $sales_order_tipe_pembayaran);
		$this->db->set("tipe_sales_order_id", $tipe_sales_order_id);
		$this->db->set("sales_order_no_po", $sales_order_no_po);
		$this->db->set("sales_order_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("sales_order_tgl_create", "GETDATE()", FALSE);
		$this->db->set("sales_order_is_downloaded", $sales_order_is_downloaded);
		$this->db->set("tipe_delivery_order_id", $tipe_delivery_order_id);
		$this->db->set("sales_order_is_uploaded", $sales_order_is_uploaded);
		$this->db->set("sales_order_no_reff", $sales_order_no_reff);

		$queryinsert = $this->db->insert("sales_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail($so_id, $sod_id, $data)
	{
		// $sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		$sales_order_id = $so_id == "" ? null : $so_id;
		$client_wms_id = $data['client_wms_id'] == "" ? null : $data['client_wms_id'];
		$sku_id = $data['sku_id'] == "" ? null : $data['sku_id'];
		$sku_kode = $data['sku_kode'] == "" ? null : $data['sku_kode'];
		$sku_nama_produk = $data['sku_nama_produk'] == "" ? null : $data['sku_nama_produk'];
		$sku_harga_satuan = $data['sku_harga_satuan'] == "" ? null : $data['sku_harga_satuan'];
		$sku_disc_percent = $data['sku_disc_percent'] == "" ? null : $data['sku_disc_percent'];
		$sku_disc_rp = $data['sku_disc_rp'] == "" ? null : $data['sku_disc_rp'];
		$sku_harga_nett = $data['sku_harga_nett'] == "" ? null : $data['sku_harga_nett'];
		// $sku_request_expdate = $data['sku_request_expdate'] == "" ? null : $data['sku_request_expdate'];
		// $sku_filter_expdate = $data['sku_filter_expdate'] == "" ? null : $data['sku_filter_expdate'];
		// $sku_filter_expdatebulan = $data['sku_filter_expdatebulan'] == "" ? null : $data['sku_filter_expdatebulan'];
		// $sku_filter_expdatetahun = $data['sku_filter_expdatetahun'] == "" ? null : $data['sku_filter_expdatetahun'];
		$sku_weight = $data['sku_weight'] == "" ? null : $data['sku_weight'];
		$sku_weight_unit = $data['sku_weight_unit'] == "" ? null : $data['sku_weight_unit'];
		$sku_length = $data['sku_length'] == "" ? null : $data['sku_length'];
		$sku_length_unit = $data['sku_length_unit'] == "" ? null : $data['sku_length_unit'];
		$sku_width = $data['sku_width'] == "" ? null : $data['sku_width'];
		$sku_width_unit = $data['sku_width_unit'] == "" ? null : $data['sku_width_unit'];
		$sku_height = $data['sku_height'] == "" ? null : $data['sku_height'];
		$sku_height_unit = $data['sku_height_unit'] == "" ? null : $data['sku_height_unit'];
		$sku_volume = $data['sku_volume'] == "" ? null : $data['sku_volume'];
		$sku_volume_unit = $data['sku_volume_unit'] == "" ? null : $data['sku_volume_unit'];
		$sku_qty = $data['sku_qty'] == "" ? null : $data['sku_qty'];
		$sku_keterangan = $data['sku_keterangan'] == "" ? null : $data['sku_keterangan'];
		$tipe_stock_nama = $data['tipe_stock_nama'] == "" ? null : $data['tipe_stock_nama'];

		// $this->db->set("sales_order_detail_id", "NEWID()", FALSE);
		$this->db->set("sales_order_detail_id", $sod_id);
		$this->db->set('sales_order_id', $sales_order_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_kode', $sku_kode);
		$this->db->set('sku_nama_produk', $sku_nama_produk);
		$this->db->set('sku_harga_satuan', $sku_harga_satuan);
		$this->db->set('sku_disc_percent', $sku_disc_percent);
		$this->db->set('sku_disc_rp', $sku_disc_rp);
		$this->db->set('sku_harga_nett', $sku_harga_nett);
		// $this->db->set('sku_request_expdate', $sku_request_expdate);
		// $this->db->set('sku_filter_expdate', $sku_filter_expdate);
		// $this->db->set('sku_filter_expdatebulan', $sku_filter_expdatebulan);
		// $this->db->set('sku_filter_expdatetahun', $sku_filter_expdatetahun);
		// $this->db->set('sku_filter_expdatetahun', null);
		$this->db->set('sku_weight', $sku_weight);
		$this->db->set('sku_weight_unit', $sku_weight_unit);
		$this->db->set('sku_length', $sku_length);
		$this->db->set('sku_length_unit', $sku_length_unit);
		$this->db->set('sku_width', $sku_width);
		$this->db->set('sku_width_unit', $sku_width_unit);
		$this->db->set('sku_height', $sku_height);
		$this->db->set('sku_height_unit', $sku_height_unit);
		$this->db->set('sku_volume', $sku_volume);
		$this->db->set('sku_volume_unit', $sku_volume_unit);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('sku_keterangan', $sku_keterangan);
		$this->db->set('tipe_stock_nama', $tipe_stock_nama);

		$queryinsert = $this->db->insert("sales_order_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail_retur($so_id, $sod_id, $data)
	{
		// $sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		$sales_order_id = $so_id == "" ? null : $so_id;
		$client_wms_id = $data['client_wms_id'] == "" ? null : $data['client_wms_id'];
		$sku_id = $data['sku_id'] == "" ? null : $data['sku_id'];
		$sku_kode = $data['sku_kode'] == "" ? null : $data['sku_kode'];
		$sku_nama_produk = $data['sku_nama_produk'] == "" ? null : $data['sku_nama_produk'];
		$sku_harga_satuan = $data['sku_harga_satuan'] == "" ? null : $data['sku_harga_satuan'];
		$sku_disc_percent = $data['sku_disc_percent'] == "" ? null : $data['sku_disc_percent'];
		$sku_disc_rp = $data['sku_disc_rp'] == "" ? null : $data['sku_disc_rp'];
		$sku_harga_nett = $data['sku_harga_nett'] == "" ? null : $data['sku_harga_nett'];
		// $sku_request_expdate = $data['sku_request_expdate'] == "" ? null : $data['sku_request_expdate'];
		// $sku_filter_expdate = $data['sku_filter_expdate'] == "" ? null : $data['sku_filter_expdate'];
		// $sku_filter_expdatebulan = $data['sku_filter_expdatebulan'] == "" ? null : $data['sku_filter_expdatebulan'];
		// $sku_filter_expdatetahun = $data['sku_filter_expdatetahun'] == "" ? null : $data['sku_filter_expdatetahun'];
		$sku_weight = $data['sku_weight'] == "" ? null : $data['sku_weight'];
		$sku_weight_unit = $data['sku_weight_unit'] == "" ? null : $data['sku_weight_unit'];
		$sku_length = $data['sku_length'] == "" ? null : $data['sku_length'];
		$sku_length_unit = $data['sku_length_unit'] == "" ? null : $data['sku_length_unit'];
		$sku_width = $data['sku_width'] == "" ? null : $data['sku_width'];
		$sku_width_unit = $data['sku_width_unit'] == "" ? null : $data['sku_width_unit'];
		$sku_height = $data['sku_height'] == "" ? null : $data['sku_height'];
		$sku_height_unit = $data['sku_height_unit'] == "" ? null : $data['sku_height_unit'];
		$sku_volume = $data['sku_volume'] == "" ? null : $data['sku_volume'];
		$sku_volume_unit = $data['sku_volume_unit'] == "" ? null : $data['sku_volume_unit'];
		$sku_qty = $data['sku_qty'] == "" ? null : -1 * $data['sku_qty'];
		$sku_keterangan = $data['sku_keterangan'] == "" ? null : $data['sku_keterangan'];
		$tipe_stock_nama = $data['tipe_stock_nama'] == "" ? null : $data['tipe_stock_nama'];

		// $this->db->set("sales_order_detail_id", "NEWID()", FALSE);
		$this->db->set("sales_order_detail_id", $sod_id);
		$this->db->set('sales_order_id', $sales_order_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_kode', $sku_kode);
		$this->db->set('sku_nama_produk', $sku_nama_produk);
		$this->db->set('sku_harga_satuan', $sku_harga_satuan);
		$this->db->set('sku_disc_percent', $sku_disc_percent);
		$this->db->set('sku_disc_rp', $sku_disc_rp);
		$this->db->set('sku_harga_nett', $sku_harga_nett);
		// $this->db->set('sku_request_expdate', $sku_request_expdate);
		// $this->db->set('sku_filter_expdate', $sku_filter_expdate);
		// $this->db->set('sku_filter_expdatebulan', $sku_filter_expdatebulan);
		// $this->db->set('sku_filter_expdatetahun', $sku_filter_expdatetahun);
		// $this->db->set('sku_filter_expdatetahun', null);
		$this->db->set('sku_weight', $sku_weight);
		$this->db->set('sku_weight_unit', $sku_weight_unit);
		$this->db->set('sku_length', $sku_length);
		$this->db->set('sku_length_unit', $sku_length_unit);
		$this->db->set('sku_width', $sku_width);
		$this->db->set('sku_width_unit', $sku_width_unit);
		$this->db->set('sku_height', $sku_height);
		$this->db->set('sku_height_unit', $sku_height_unit);
		$this->db->set('sku_volume', $sku_volume);
		$this->db->set('sku_volume_unit', $sku_volume_unit);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('sku_keterangan', $sku_keterangan);
		$this->db->set('tipe_stock_nama', $tipe_stock_nama);

		$queryinsert = $this->db->insert("sales_order_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail2($sales_order_detail2_id, $data)
	{
		$sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		$sku_expdate = $data['sku_expdate'] == "" ? null : date('Y-m-d', strtotime($data['sku_expdate']));
		$sku_id = $data['sku_id'] == "" ? null : $data['sku_id'];
		$sku_stock_id = $data['sku_stock_id'] == "" ? null : $data['sku_stock_id'];
		$sku_qty = $data['sku_qty'] == "" ? null : $data['sku_qty'];
		$delivery_order_reff_id = $data['delivery_order_reff_id'] == "" ? null : $data['delivery_order_reff_id'];

		$this->db->set('sales_order_detail2_id', $sales_order_detail2_id);
		$this->db->set('sales_order_detail_id', $sales_order_detail_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_stock_id', $sku_stock_id);
		$this->db->set('sku_expdate', $sku_expdate);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('delivery_order_reff_id', $delivery_order_reff_id);

		$queryinsert = $this->db->insert("sales_order_detail_2");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail_payment($sales_order_detail_payment_id, $so_id, $data)
	{
		// $sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		$sales_order_id = $so_id == "" ? null : $so_id;
		$sales_order_detail_payment_tipe = $data['sales_order_detail_payment_tipe'] == "" ? null : $data['sales_order_detail_payment_tipe'];
		$sales_order_detail_payment_nominal = $data['sales_order_detail_payment_nominal'] == "" ? 0 : $data['sales_order_detail_payment_nominal'];

		// $this->db->set("sales_order_detail_id", "NEWID()", FALSE);
		$this->db->set("sales_order_detail_payment_id", $sales_order_detail_payment_id);
		$this->db->set('sales_order_id', $sales_order_id);
		$this->db->set('sales_order_detail_payment_tipe', $sales_order_detail_payment_tipe);
		$this->db->set('sales_order_detail_payment_nominal', $sales_order_detail_payment_nominal);

		$queryinsert = $this->db->insert("sales_order_detail_payment");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sales_order($sales_order_id, $depo_id, $sales_order_kode, $client_wms_id, $channel_id, $sales_order_is_handheld, $sales_order_status, $sales_order_approved_by, $sales_id, $client_pt_id, $sales_order_tgl, $sales_order_tgl_exp, $sales_order_tgl_harga, $sales_order_tgl_sj, $sales_order_tgl_kirim, $sales_order_tipe_pembayaran, $tipe_sales_order_id, $sales_order_no_po, $sales_order_who_create, $sales_order_tgl_create, $sales_order_is_downloaded, $tipe_delivery_order_id, $sales_order_is_uploaded, $sales_order_no_reff)
	{
		// $tgl = $tgl . " " . date('H:i:s');

		$sales_order_id =  $sales_order_id ==  "" ? null : $sales_order_id;
		$depo_id =  $depo_id ==  "" ? null : $depo_id;
		$sales_order_kode =  $sales_order_kode ==  "" ? null : $sales_order_kode;
		$client_wms_id =  $client_wms_id ==  "" ? null : $client_wms_id;
		$channel_id =  $channel_id ==  "" ? null : $channel_id;
		$sales_order_is_handheld =  $sales_order_is_handheld ==  "" ? null : $sales_order_is_handheld;
		$sales_order_status =  $sales_order_status ==  "" ? null : $sales_order_status;
		$sales_order_approved_by =  $sales_order_approved_by ==  "" ? null : $sales_order_approved_by;
		$sales_id =  $sales_id ==  "" ? null : $sales_id;
		$client_pt_id =  $client_pt_id ==  "" ? null : $client_pt_id;
		$sales_order_tgl =  $sales_order_tgl ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl)));
		$sales_order_tgl_exp =  $sales_order_tgl_exp ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_exp)));
		$sales_order_tgl_harga =  $sales_order_tgl_harga ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_harga)));
		$sales_order_tgl_sj =  $sales_order_tgl_sj ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_sj)));
		$sales_order_tgl_kirim =  $sales_order_tgl_kirim ==  "" ? null : date('Y-m-d', strtotime(str_replace("/", "-", $sales_order_tgl_kirim)));
		$sales_order_tipe_pembayaran =  $sales_order_tipe_pembayaran ==  "" ? null : $sales_order_tipe_pembayaran;
		$tipe_sales_order_id =  $tipe_sales_order_id ==  "" ? null : $tipe_sales_order_id;
		$sales_order_no_po =  $sales_order_no_po ==  "" ? null : $sales_order_no_po;
		$sales_order_who_create =  $sales_order_who_create ==  "" ? null : $sales_order_who_create;
		$sales_order_tgl_create =  $sales_order_tgl_create ==  "" ? null : $sales_order_tgl_create;
		$sales_order_is_downloaded =  $sales_order_is_downloaded ==  "" ? null : $sales_order_is_downloaded;
		$tipe_delivery_order_id =  $tipe_delivery_order_id ==  "" ? null : $tipe_delivery_order_id;
		$sales_order_is_uploaded =  $sales_order_is_uploaded ==  "" ? null : $sales_order_is_uploaded;
		$sales_order_no_reff =  $sales_order_no_reff ==  "" ? null : $sales_order_no_reff;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		$this->db->set("depo_id", $depo_id);
		$this->db->set("sales_order_kode", $sales_order_kode);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("channel_id", $channel_id);
		$this->db->set("sales_order_is_handheld", $sales_order_is_handheld);
		$this->db->set("sales_order_status", $sales_order_status);
		$this->db->set("sales_order_approved_by", $sales_order_approved_by);
		$this->db->set("sales_id", $sales_id);
		$this->db->set("client_pt_id", $client_pt_id);
		$this->db->set("sales_order_tgl", $sales_order_tgl);
		$this->db->set("sales_order_tgl_exp", $sales_order_tgl_exp);
		$this->db->set("sales_order_tgl_harga", $sales_order_tgl_harga);
		$this->db->set("sales_order_tgl_sj", $sales_order_tgl_sj);
		$this->db->set("sales_order_tgl_kirim", $sales_order_tgl_kirim);
		$this->db->set("sales_order_tipe_pembayaran", $sales_order_tipe_pembayaran);
		$this->db->set("tipe_sales_order_id", $tipe_sales_order_id);
		$this->db->set("sales_order_no_po", $sales_order_no_po);
		$this->db->set("sales_order_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("sales_order_tgl_create", "GETDATE()", FALSE);
		$this->db->set("sales_order_is_downloaded", $sales_order_is_downloaded);
		$this->db->set("tipe_delivery_order_id", $tipe_delivery_order_id);
		$this->db->set("sales_order_is_uploaded", $sales_order_is_uploaded);
		$this->db->set("sales_order_no_reff", $sales_order_no_reff);

		$this->db->where("sales_order_id", $sales_order_id);

		$queryinsert = $this->db->update("sales_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sales_order_status($sales_order_id, $sales_order_status)
	{
		$sales_order_status =  $sales_order_status ==  "" ? null : $sales_order_status;

		$this->db->set("sales_order_status", $sales_order_status);
		$this->db->set("sales_order_who_create", $this->session->userdata('pengguna_username'));
		$this->db->set("sales_order_tgl_create", "GETDATE()", FALSE);
		$this->db->where("sales_order_id", $sales_order_id);

		$queryinsert = $this->db->update("sales_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function GetSalesOrderId($kode)
	{ {
			$this->db->select("sales_order_id")
				->from("sales_order")
				->where("sales_order_kode", $kode);
			$query = $this->db->get();

			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->row(0)->sales_order_id;
			}

			return $query;
		}
	}

	public function Get_list_sales_order_detail($arr_sales_order_detail)
	{
		if (isset($arr_sales_order_detail)) {

			if (count($arr_sales_order_detail) > 0) {

				$union = " UNION ALL ";
				$table_sementara = "";


				foreach ($arr_sales_order_detail as $key => $value) {
					$table_sementara .= "SELECT 
									'" . $value['idx'] . "' AS idx, 
									'" . $value['sku_id'] . "' AS sku_id,
									'" . $value['sku_stock_id'] . "' AS sku_stock_id, 
									'" . $value['sku_expdate'] . "' AS sku_expdate, 
									" . $value['sku_qty'] . " AS sku_qty, 
									" . $value['sku_disc_rp'] . " AS sku_disc_rp, 
									" . $value['sku_harga_nett'] . " AS sku_harga_nett, 
									'" . $value['delivery_order_reff_id'] . "' AS delivery_order_reff_id";

					if ($key < count($arr_sales_order_detail) - 1) {
						$table_sementara .= $union;
					}
				}

				$query = $this->db->query("SELECT
									so.idx,
									so.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.principle_id,
									principle.principle_kode AS principle,
									sku.principle_brand_id,
									principle_brand.principle_brand_nama AS brand,
									sku.sku_kemasan,
									sku.sku_satuan,
									ISNULL(CONVERT(INT,sku.sku_harga_jual),0) AS sku_harga_satuan,
									so.sku_stock_id,
									so.sku_expdate,
									so.sku_qty,
									so.sku_disc_rp,
									so.sku_harga_nett,
									so.delivery_order_reff_id
									FROM (" . $table_sementara . ") so
									LEFT JOIN sku
									ON sku.sku_id = so.sku_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									ORDER BY sku.sku_kode ASC");

				if ($query->num_rows() == 0) {
					$query = array();
				} else {
					$query = $query->result_array();
				}
			} else {
				$query = array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sales_order_detail_temp_by_so_id($so_id, $arr_sales_order_detail)
	{
		if (isset($arr_sales_order_detail)) {

			if (count($arr_sales_order_detail) > 0) {

				$union = " UNION ALL ";
				$table_sementara = "";


				foreach ($arr_sales_order_detail as $key => $value) {
					$table_sementara .= "SELECT 
									'" . $value['idx'] . "' AS idx, 
									'" . $value['sku_id'] . "' AS sku_id,
									'" . $value['sku_stock_id'] . "' AS sku_stock_id, 
									'" . $value['sku_expdate'] . "' AS sku_expdate, 
									" . $value['sku_qty'] . " AS sku_qty, 
									" . $value['sku_disc_rp'] . " AS sku_disc_rp, 
									" . $value['sku_harga_nett'] . " AS sku_harga_nett, 
									'" . $value['delivery_order_reff_id'] . "' AS delivery_order_reff_id";

					if ($key < count($arr_sales_order_detail) - 1) {
						$table_sementara .= $union;
					}
				}

				$query = $this->db->query("SELECT sku.sku_id,
												sku.sku_kode,
												sku.sku_varian,
												sku.sku_induk_id,
												ISNULL(sku.sku_weight, '0') sku_weight,
												ISNULL(sku.sku_weight_unit, '') sku_weight_unit,
												ISNULL(sku.sku_length, '0') sku_length,
												ISNULL(sku.sku_length_unit, '') sku_length_unit,
												ISNULL(sku.sku_width, '0') sku_width,
												ISNULL(sku.sku_width_unit, '') sku_width_unit,
												ISNULL(sku.sku_height, '0') sku_height,
												ISNULL(sku.sku_height_unit, '') sku_height_unit,
												ISNULL(sku.sku_volume, '0') sku_volume,
												ISNULL(sku.sku_volume_unit, '') sku_volume_unit,
												ISNULL(sku.sku_satuan, '') sku_satuan,
												ISNULL(sku.sku_kemasan, '') sku_kemasan,
												sku.kemasan_id,
												ISNULL(sku.sku_harga_jual, '0') AS sku_harga_satuan,
												sku.kategori1_id,
												sku.kategori2_id,
												sku.kategori3_id,
												sku.kategori4_id,
												sku.kategori5_id,
												sku.kategori6_id,
												sku.kategori7_id,
												sku.kategori8_id,
												sku.principle_id,
												sku.principle_brand_id,
												sku.sku_nama_produk,
												ISNULL(sku.sku_deskripsi, '') sku_deskripsi,
												ISNULL(sku.sku_origin, '') sku_origin,
												ISNULL(sku.sku_kondisi, '') sku_kondisi,
												ISNULL(sku.sku_sales_min_qty, '0') sku_sales_min_qty,
												ISNULL(sku.sku_ppnbm_persen, '0') sku_ppnbm_persen,
												ISNULL(sku.sku_ppn_persen, '0') sku_ppn_persen,
												ISNULL(sku.sku_pph, '0') sku_pph,
												sku.sku_is_aktif,
												sku.sku_is_jual,
												sku.sku_is_paket,
												sku.sku_is_deleted,
												ISNULL(sku.sku_weight_netto, '0') sku_weight_netto,
												ISNULL(sku.sku_weight_netto_unit, '') sku_weight_netto_unit,
												ISNULL(sku.sku_weight_product, '0') sku_weight_product,
												ISNULL(sku.sku_weight_product_unit, '') sku_weight_product_unit,
												ISNULL(sku.sku_weight_packaging, '0') sku_weight_packaging,
												ISNULL(sku.sku_weight_packaging_unit, '') sku_weight_packaging_unit,
												ISNULL(sku.sku_weight_gift, '0') sku_weight_gift,
												ISNULL(sku.sku_weight_gift_unit, '') sku_weight_gift_unit,
												sku.sku_bosnet_id,
												sku.sku_is_hadiah,
												sku.sku_is_from_import,
												ISNULL(sku.sku_kode_sku_principle, '') sku_kode_sku_principle,
												sku.client_wms_id,
												client_wms.client_wms_nama,
												principle.principle_kode AS principle,
												principle_brand.principle_brand_nama AS brand,
												NULL AS sku_keterangan,
												NULL AS tipe_stock_nama,
												SUM(ISNULL(so.sku_qty, 0)) AS sku_qty,
												0 AS sku_disc_percent,
												SUM(ISNULL(so.sku_disc_rp, 0)) AS sku_disc_rp,
												SUM(ISNULL(so.sku_harga_nett, 0)) AS sku_harga_nett,
												CAST(ISNULL(sku.sku_harga_jual, 0) * SUM(ISNULL(so.sku_qty, 0)) AS INT) AS sub_total
											FROM (" . $table_sementara . ") so
											LEFT JOIN sku
												ON CONVERT(NVARCHAR(36),sku.sku_id) = so.sku_id
											LEFT JOIN client_wms
												ON client_wms.client_wms_id = sku.client_wms_id
											LEFT JOIN principle
												ON principle.principle_id = sku.principle_id
											LEFT JOIN principle_brand
												ON principle_brand.principle_brand_id = sku.principle_brand_id
											GROUP BY sku.sku_id,
													sku.sku_kode,
													sku.sku_varian,
													sku.sku_induk_id,
													ISNULL(sku.sku_weight, '0'),
													ISNULL(sku.sku_weight_unit, ''),
													ISNULL(sku.sku_length, '0'),
													ISNULL(sku.sku_length_unit, ''),
													ISNULL(sku.sku_width, '0'),
													ISNULL(sku.sku_width_unit, ''),
													ISNULL(sku.sku_height, '0'),
													ISNULL(sku.sku_height_unit, ''),
													ISNULL(sku.sku_volume, '0'),
													ISNULL(sku.sku_volume_unit, ''),
													ISNULL(sku.sku_satuan, ''),
													ISNULL(sku.sku_kemasan, ''),
													sku.kemasan_id,
													sku.sku_harga_jual,
													sku.kategori1_id,
													sku.kategori2_id,
													sku.kategori3_id,
													sku.kategori4_id,
													sku.kategori5_id,
													sku.kategori6_id,
													sku.kategori7_id,
													sku.kategori8_id,
													sku.principle_id,
													sku.principle_brand_id,
													sku.sku_nama_produk,
													ISNULL(sku.sku_deskripsi, ''),
													ISNULL(sku.sku_origin, ''),
													ISNULL(sku.sku_kondisi, ''),
													ISNULL(sku.sku_sales_min_qty, '0'),
													ISNULL(sku.sku_ppnbm_persen, '0'),
													ISNULL(sku.sku_ppn_persen, '0'),
													ISNULL(sku.sku_pph, '0'),
													sku.sku_is_aktif,
													sku.sku_is_jual,
													sku.sku_is_paket,
													sku.sku_is_deleted,
													ISNULL(sku.sku_weight_netto, '0'),
													ISNULL(sku.sku_weight_netto_unit, ''),
													ISNULL(sku.sku_weight_product, '0'),
													ISNULL(sku.sku_weight_product_unit, ''),
													ISNULL(sku.sku_weight_packaging, '0'),
													ISNULL(sku.sku_weight_packaging_unit, ''),
													ISNULL(sku.sku_weight_gift, '0'),
													ISNULL(sku.sku_weight_gift_unit, ''),
													sku.sku_bosnet_id,
													sku.sku_is_hadiah,
													sku.sku_is_from_import,
													ISNULL(sku.sku_kode_sku_principle, ''),
													sku.client_wms_id,
													client_wms.client_wms_nama,
													principle.principle_kode,
													principle_brand.principle_brand_nama
											ORDER BY client_wms.client_wms_nama,
													sku.sku_kode ASC");

				if ($query->num_rows() == 0) {
					$query = array();
				} else {
					$query = $query->result_array();
				}
			} else {
				$query = array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_sales_order_detail2_temp_by_so_id($so_id, $arr_sales_order_detail)
	{
		if (isset($arr_sales_order_detail)) {

			if (count($arr_sales_order_detail) > 0) {

				$union = " UNION ALL ";
				$table_sementara = "";


				foreach ($arr_sales_order_detail as $key => $value) {
					$table_sementara .= "SELECT 
									'" . $value['idx'] . "' AS idx, 
									'" . $value['sku_id'] . "' AS sku_id,
									'" . $value['sku_stock_id'] . "' AS sku_stock_id, 
									'" . $value['sku_expdate'] . "' AS sku_expdate, 
									" . $value['sku_qty'] . " AS sku_qty, 
									" . $value['sku_disc_rp'] . " AS sku_disc_rp, 
									" . $value['sku_harga_nett'] . " AS sku_harga_nett, 
									'" . $value['delivery_order_reff_id'] . "' AS delivery_order_reff_id";

					if ($key < count($arr_sales_order_detail) - 1) {
						$table_sementara .= $union;
					}
				}

				$query = $this->db->query("SELECT 
												so_detail.sales_order_detail_id,
												so_detail2.sku_id,
												so_detail2.sku_stock_id,
												so_detail2.sku_expdate,
												so_detail2.sku_qty,
												so_detail2.delivery_order_reff_id
											FROM (" . $table_sementara . ") so_detail2
											LEFT JOIN sales_order_detail so_detail
											ON CONVERT(NVARCHAR(36),so_detail.sku_id) = so_detail2.sku_id
											AND so_detail.sales_order_id = '$so_id'");

				if ($query->num_rows() == 0) {
					$query = array();
				} else {
					$query = $query->result_array();
				}
			} else {
				$query = array();
			}
		} else {
			$query = array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_pallet_pos()
	{
		$query = $this->db->query("SELECT 
										pallet.pallet_id,
										pallet.pallet_kode
									FROM pallet
									LEFT JOIN rak_lajur_detail_pallet
										ON rak_lajur_detail_pallet.pallet_id = pallet.pallet_id
									LEFT JOIN rak_lajur_detail
										ON rak_lajur_detail.rak_lajur_detail_id = rak_lajur_detail_pallet.rak_lajur_detail_id
									LEFT JOIN rak_lajur
										ON rak_lajur.rak_lajur_id = rak_lajur_detail.rak_lajur_id
									LEFT JOIN rak
										ON rak.rak_id = rak_lajur.rak_id
									LEFT JOIN depo_detail
										ON depo_detail.depo_detail_id = rak.depo_detail_id
									WHERE depo_detail.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND depo_detail.depo_detail_is_pos = '1'");

		if ($query->num_rows() == 0) {
			$query = "";
		} else {
			$query = $query->row(0)->pallet_id;
		}

		return $query;
	}

	public function Exec_insertupdate_sku_stock($tipe, $sku_stock_id, $client_wms_id, $qty)
	{
		$query = $this->db->query("exec WMS.dbo.insertupdate_sku_stock '$tipe','$sku_stock_id',NULL," . $qty . "");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Exec_insertupdate_sku_stock_pallet($tipe, $pallet_id, $sku_stock_id, $qty)
	{
		$query = $this->db->query("exec WMS.dbo.insertupdate_sku_stock_pallet '$tipe','$pallet_id','$sku_stock_id'," . $qty . "");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Insert_delivery_order_draft_from_sales_order($sales_order_id, $delivery_order_draft_id, $delivery_order_draft_kode)
	{
		$query = $this->db->query("INSERT INTO WMS.dbo.delivery_order_draft(delivery_order_draft_id,
										sales_order_id,
										delivery_order_draft_kode,
										delivery_order_draft_yourref,
										client_wms_id,
										delivery_order_draft_tgl_buat_do,
										delivery_order_draft_tgl_expired_do,
										delivery_order_draft_tgl_surat_jalan,
										delivery_order_draft_tgl_rencana_kirim,
										delivery_order_draft_tgl_aktual_kirim,
										delivery_order_draft_keterangan,
										delivery_order_draft_status,
										delivery_order_draft_is_prioritas,
										delivery_order_draft_is_need_packing,
										delivery_order_draft_tipe_layanan,
										delivery_order_draft_tipe_pembayaran,
										delivery_order_draft_sesi_pengiriman,
										delivery_order_draft_request_tgl_kirim,
										delivery_order_draft_request_jam_kirim,
										tipe_pengiriman_id,
										nama_tipe,
										confirm_rate,
										delivery_order_draft_reff_id,
										delivery_order_draft_reff_no,
										delivery_order_draft_total,
										unit_mandiri_id,
										depo_id,
										client_pt_id,
										delivery_order_draft_kirim_nama,
										delivery_order_draft_kirim_alamat,
										delivery_order_draft_kirim_telp,
										delivery_order_draft_kirim_provinsi,
										delivery_order_draft_kirim_kota,
										delivery_order_draft_kirim_kecamatan,
										delivery_order_draft_kirim_kelurahan,
										delivery_order_draft_kirim_kodepos,
										delivery_order_draft_kirim_area,
										delivery_order_draft_kirim_invoice_pdf,
										delivery_order_draft_kirim_invoice_dir,
										pabrik_id,
										delivery_order_draft_ambil_nama,
										delivery_order_draft_ambil_alamat,
										delivery_order_draft_ambil_telp,
										delivery_order_draft_ambil_provinsi,
										delivery_order_draft_ambil_kota,
										delivery_order_draft_ambil_kecamatan,
										delivery_order_draft_ambil_kelurahan,
										delivery_order_draft_ambil_kodepos,
										delivery_order_draft_ambil_area,
										delivery_order_draft_update_who,
										delivery_order_draft_update_tgl,
										delivery_order_draft_approve_who,
										delivery_order_draft_approve_tgl,
										delivery_order_draft_reject_who,
										delivery_order_draft_reject_tgl,
										delivery_order_draft_reject_reason,
										tipe_delivery_order_id,
										is_from_so,
										delivery_order_draft_nominal_tunai,
										delivery_order_draft_attachment,
										is_promo,
										is_canvas,
										canvas_id)
										SELECT '$delivery_order_draft_id' AS delivery_order_draft_id,
										so.sales_order_id,
										'$delivery_order_draft_kode' AS delivery_order_draft_kode,
										NULL AS delivery_order_draft_yourref,
										so.client_wms_id,
										GETDATE() AS delivery_order_draft_tgl_buat_do,
										GETDATE() AS delivery_order_draft_tgl_expired_do,
										GETDATE() AS delivery_order_draft_tgl_surat_jalan,
										GETDATE() AS delivery_order_draft_tgl_rencana_kirim,
										GETDATE() AS delivery_order_draft_tgl_aktual_kirim,
										so.sales_order_keterangan AS delivery_order_draft_keterangan,
										'Approved' AS delivery_order_draft_status,
										NULL AS delivery_order_draft_is_prioritas,
										NULL AS delivery_order_draft_is_need_packing,
										NULL AS delivery_order_draft_tipe_layanan,
										so.sales_order_tipe_pembayaran AS delivery_order_draft_tipe_pembayaran,
										NULL AS delivery_order_draft_sesi_pengiriman,
										NULL AS delivery_order_draft_request_tgl_kirim,
										NULL AS delivery_order_draft_request_jam_kirim,
										so.tipe_delivery_order_id AS tipe_pengiriman_id,
										'' AS nama_tipe,
										NULL AS confirm_rate,
										NULL AS delivery_order_draft_reff_id,
										NULL AS delivery_order_draft_reff_no,
										NULL AS delivery_order_draft_total,
										NULL AS unit_mandiri_id,
										so.depo_id,
										so.client_pt_id,
										client_pt.client_pt_nama AS delivery_order_draft_kirim_nama,
										client_pt.client_pt_alamat AS delivery_order_draft_kirim_alamat,
										client_pt.client_pt_telepon AS delivery_order_draft_kirim_telp,
										client_pt.client_pt_propinsi AS delivery_order_draft_kirim_provinsi,
										client_pt.client_pt_kota AS delivery_order_draft_kirim_kota,
										client_pt.client_pt_kecamatan AS delivery_order_draft_kirim_kecamatan,
										client_pt.client_pt_kelurahan AS delivery_order_draft_kirim_kelurahan,
										client_pt.client_pt_kodepos AS delivery_order_draft_kirim_kodepos,
										area.area_kode AS delivery_order_draft_kirim_area,
										NULL AS delivery_order_draft_kirim_invoice_pdf,
										NULL AS delivery_order_draft_kirim_invoice_dir,
										NULL AS pabrik_id,
										NULL AS delivery_order_draft_ambil_nama,
										NULL AS delivery_order_draft_ambil_alamat,
										NULL AS delivery_order_draft_ambil_telp,
										NULL AS delivery_order_draft_ambil_provinsi,
										NULL AS delivery_order_draft_ambil_kota,
										NULL AS delivery_order_draft_ambil_kecamatan,
										NULL AS delivery_order_draft_ambil_kelurahan,
										NULL AS delivery_order_draft_ambil_kodepos,
										NULL AS delivery_order_draft_ambil_area,
										NULL AS delivery_order_draft_update_who,
										NULL AS delivery_order_draft_update_tgl,
										NULL AS delivery_order_draft_approve_who,
										NULL AS delivery_order_draft_approve_tgl,
										NULL AS delivery_order_draft_reject_who,
										NULL AS delivery_order_draft_reject_tgl,
										NULL AS delivery_order_draft_reject_reason,
										tipe_delivery_order_id,
										1 AS is_from_so,
										NULL AS delivery_order_draft_nominal_tunai,
										NULL AS delivery_order_draft_attachment,
										NULL AS is_promo,
										NULL AS is_canvas,
										NULL AS canvas_id
									FROM sales_order so
									LEFT JOIN client_pt
										ON client_pt.client_pt_id = so.client_pt_id
									LEFT JOIN area
										ON client_pt.area_id = area.area_id
									WHERE CONVERT(NVARCHAR(36),so.sales_order_id) = '$sales_order_id'");

		return $query;
	}

	public function Insert_delivery_order_detail_draft_from_sales_order($sales_order_detail_id, $delivery_order_draft_id, $delivery_order_detail_draft_id)
	{
		$query = $this->db->query("INSERT INTO WMS.dbo.delivery_order_detail_draft(delivery_order_detail_draft_id,
									delivery_order_draft_id,
									sku_id,
									gudang_id,
									gudang_detail_id,
									sku_kode,
									sku_nama_produk,
									sku_harga_satuan,
									sku_disc_percent,
									sku_disc_rp,
									sku_harga_nett,
									sku_request_expdate,
									sku_filter_expdate,
									sku_filter_expdatebulan,
									sku_filter_expdatetahun,
									sku_weight,
									sku_weight_unit,
									sku_length,
									sku_length_unit,
									sku_width,
									sku_width_unit,
									sku_height,
									sku_height_unit,
									sku_volume,
									sku_volume_unit,
									sku_qty,
									sku_keterangan,
									tipe_stock_nama)
									SELECT '$delivery_order_detail_draft_id' AS delivery_order_detail_draft_id,
										'$delivery_order_draft_id' AS delivery_order_draft_id,
										sku_id,
										NULL AS gudang_id,
										NULL AS gudang_detail_id,
										sku_kode,
										sku_nama_produk,
										sku_harga_satuan,
										sku_disc_percent,
										sku_disc_rp,
										sku_harga_nett,
										sku_request_expdate,
										sku_filter_expdate,
										sku_filter_expdatebulan,
										sku_filter_expdatetahun,
										sku_weight,
										sku_weight_unit,
										sku_length,
										sku_length_unit,
										sku_width,
										sku_width_unit,
										sku_height,
										sku_height_unit,
										sku_volume,
										sku_volume_unit,
										sku_qty,
										sku_keterangan,
										tipe_stock_nama
									FROM sales_order_detail
									WHERE CONVERT(NVARCHAR(36), sales_order_detail_id) = '$sales_order_detail_id'");

		return $query;
	}

	public function Insert_delivery_order_detail2_draft_from_sales_order($sales_order_detail_id, $delivery_order_draft_id, $delivery_order_detail_draft_id)
	{
		$query = $this->db->query("INSERT INTO WMS.dbo.delivery_order_detail2_draft(delivery_order_detail2_draft_id,
										delivery_order_detail_draft_id,
										delivery_order_draft_id,
										sku_id,
										sku_stock_id,
										sku_expdate,
										sku_qty,
										sku_qty_composite)
										SELECT NEWID() AS delivery_order_detail2_draft_id,
										'$delivery_order_detail_draft_id' AS delivery_order_detail_draft_id,
										'$delivery_order_draft_id' AS delivery_order_draft_id,
										so.sku_id,
										sku_stock_id,
										sku_expdate,
										sku_qty,
										ISNULL(sku_qty, 0) * ISNULL(sku.sku_konversi_faktor, 0) AS sku_qty_composite
									FROM sales_order_detail_2 so
									LEFT JOIN sku
										ON sku.sku_id = so.sku_id
									WHERE CONVERT(NVARCHAR(36),so.sales_order_detail_id) = '$sales_order_detail_id'");

		return $query;
	}

	public function delete_sales_order_detail_2($sales_order_id)
	{
		$query = $this->db->query("DELETE FROM sales_order_detail_2 WHERE sales_order_detail_id IN (select sales_order_detail_id from sales_order_detail where sales_order_id = '$sales_order_id')");
		return $query;
		// return $this->db->last_query();
	}

	public function delete_sales_order_detail($sales_order_id)
	{
		$this->db->where("sales_order_id", $sales_order_id);
		return $this->db->delete('sales_order_detail');
	}

	public function delete_sales_order_detail_payment($sales_order_id)
	{
		$this->db->where("sales_order_id", $sales_order_id);
		return $this->db->delete('sales_order_detail_payment');
	}
}
