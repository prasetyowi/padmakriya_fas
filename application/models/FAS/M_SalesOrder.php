<?php

class M_SalesOrder extends CI_Model
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

	public function GetTipeSalesOrderDetail()
	{
		$this->db->select("*")
			->from("tipe_sales_order_detail()")
			->where("is_aktif", "1")
			->order_by("no_urut");
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

	// public function GetPerusahaan()
	// {
	// 	$this->db->select("*")
	// 		->from("client_wms")
	// 		->order_by("client_wms_nama");
	// 	$query = $this->db->get();

	// 	if ($query->num_rows() == 0) {
	// 		$query = 0;
	// 	} else {
	// 		$query = $query->result_array();
	// 	}

	// 	return $query;
	// }

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
									sales_order_tgl_update AS tglUpdate,
									principle_id,
									ISNULL(total,'0') AS total,
									ISNULL(diskon_global_percent,'0') AS diskon_global_percent,
									ISNULL(diskon_global_rp,'0') AS diskon_global_rp,
									ISNULL(dasar_kena_pajak,'0') AS dasar_kena_pajak,
									ISNULL(ppn_global_percent,'0') AS ppn_global_percent,
									ISNULL(ppn_global_rp,'0') AS ppn_global_rp,
									ISNULL(adjustment,'0') AS adjustment,
									ISNULL(total_faktur,'0') AS total_faktur,
									ISNULL(total_diskon_item,'0') AS total_diskon_item,
									tipe_ppn,
									ISNULL(keterangan, '') AS keterangan
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
									-- ISNULL(abs(so.sku_qty), '0') AS sku_qty,
									ISNULL(so.sku_qty, '0') AS sku_qty,
									ISNULL(so.sku_keterangan, '') AS sku_keterangan,
									ISNULL(so.tipe_stock_nama, '') AS tipe_stock_nama,
									ISNULL(sku.sku_satuan, '') AS sku_satuan,
									ISNULL(sku.sku_kemasan, '') AS sku_kemasan,
									is_promo,
									ISNULL(so.sku_ppn_percent,'0') AS sku_ppn_percent,
									ISNULL(so.sku_ppn_rp,'0') AS sku_ppn_rp,
									ISNULL(so.sku_diskon_global_percent,'0') AS sku_diskon_global_percent,
									ISNULL(so.sku_diskon_global_rp,'0') AS sku_diskon_global_rp,
									ISNULL(so.sales_order_detail_tipe,'') AS sales_order_detail_tipe
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
			// $query = $this->db->query("SELECT * FROM client_wms 
			// 						ORDER BY client_wms_nama ASC");

			$query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "'
										ORDER BY b.client_wms_nama ASC");

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
				// $query = $this->db->query("SELECT * FROM client_wms 
				// 				" . $client . "
				// 					ORDER BY client_wms_nama ASC");

				$query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "' AND a.client_wms_id= '" . $this->session->userdata('client_wms_id') . "'
										ORDER BY b.client_wms_nama ASC");

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

	public function GetAllPrinciple()
	{
		$query = $this->db->query("SELECT *  FROM principle WHERE principle_is_aktif = '1' ORDER BY principle_kode ASC");

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

	public function GetSelectedSKU($so_id, $sku_id, $tgl_harga)
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
									client_wms.client_wms_tax,
									principle.principle_kode AS principle,
									principle_brand.principle_brand_nama AS brand,
									0 AS sku_nominal_harga,
									0 AS sku_disc_promo_rp,
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
											client_wms.client_wms_tax,
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

	public function GetCustomerByTypePelayanan($perusahaan, $sales, $tipe_pembayaran, $nama, $alamat, $telp, $area)
	{

		// if ($perusahaan == "") {
		// 	$perusahaan = "";
		// } else {
		// 	$perusahaan = "AND client_wms_client_pt.client_wms_id = '" . $perusahaan . "' ";
		// }

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

		if ($area == "") {
			$area = "";
		} else {
			$area = "AND client_pt.area_id = '" . $area . "' ";
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
									" . $area . "
									ORDER BY client_pt.client_pt_nama ASC");

		// $query = $this->db->query("SELECT DISTINCT
		// 							client_pt.*,
		// 							ISNULL(area.area_nama, '') AS area_nama
		// 							FROM client_wms_client_pt
		// 							LEFT JOIN client_pt
		// 							ON client_wms_client_pt.client_pt_id = client_pt.client_pt_id
		// 							LEFT JOIN client_wms
		// 							ON client_wms_client_pt.client_wms_id = client_wms.client_wms_id
		// 							LEFT JOIN area
		// 							ON client_pt.area_id = area.area_id
		// 							LEFT JOIN area_header
		// 							ON area_header.area_header_id = area.area_header_id
		// 							LEFT JOIN depo_area_header
		// 							ON depo_area_header.area_header_id = area_header.area_header_id
		// 							WHERE client_wms_client_pt.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '$sales' GROUP BY client_wms_id)
		// 							" . $perusahaan . "
		// 							" . $nama . "
		// 							" . $alamat . "
		// 							" . $telp . "
		// 							" . $area . "
		// 							ORDER BY client_pt.client_pt_nama ASC");

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

	public function GetSelectedCustomer($customer, $sales)
	{
		$query = $this->db->query("SELECT DISTINCT
									client_pt.client_pt_id,
									client_pt.client_pt_nama,
									client_pt.client_pt_alamat,
									client_pt.client_pt_telepon,
									client_pt.client_pt_propinsi,
									client_pt.client_pt_kota,
									client_pt.client_pt_kecamatan,
									client_pt.client_pt_kelurahan,
									client_pt.client_pt_kodepos,
									client_pt.client_pt_latitude,
									client_pt.client_pt_longitude,
									client_pt.client_pt_nama_contact_person,
									client_pt.client_pt_telepon_contact_person,
									client_pt.client_pt_email_contact_person,
									client_pt.client_pt_keterangan,
									client_pt.kelas_jalan_id,
									client_pt.area_id,
									client_pt.client_pt_corporate_id,
									client_pt.client_pt_top,
									client_pt.client_pt_kredit_limit,
									client_pt.client_pt_acc,
									client_pt.client_pt_titik_antar_id,
									ISNULL(convert(nvarchar(36),client_pt.client_pt_segmen_id1), '') as client_pt_segmen_id1,
									ISNULL(convert(nvarchar(36),client_pt.client_pt_segmen_id2), '') as client_pt_segmen_id2,
									ISNULL(convert(nvarchar(36),client_pt.client_pt_segmen_id3), '') as client_pt_segmen_id3,
									client_pt.unit_mandiri_id,
									client_pt.client_pt_is_deleted,
									client_pt.client_pt_is_aktif,
									client_pt.client_pt_is_multi_lokasi,
									client_pt.lokasi_outlet_id,
									client_pt.kelas_jalan2_id,
									client_pt.client_pt_fax,
									client_pt.client_pt_npwp,
									client_pt.client_pt_status_pkp,
									client_pt.eksternal_id,
									isnull(area.area_nama,'') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id = '$customer'
									ORDER BY client_pt.client_pt_nama ASC");

		// $query = $this->db->query("SELECT DISTINCT
		// 							client_pt.*,
		// 							isnull(area.area_nama,'') AS area_nama
		// 							FROM client_wms_client_pt
		// 							LEFT JOIN client_pt
		// 							ON client_wms_client_pt.client_pt_id = client_pt.client_pt_id
		// 							LEFT JOIN area
		// 							ON client_pt.area_id = area.area_id
		// 							WHERE client_pt.client_pt_id = '$customer'
		// 							AND client_wms_client_pt.client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '$sales' GROUP BY client_wms_id)
		// 							ORDER BY client_pt.client_pt_nama ASC");

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
										so.sales_order_keterangan
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
			$order_by = "ORDER BY is_priority DESC";
		} else if ($order_column == 1) {
			$order_by = "ORDER BY sales_order_tgl " . $order_dir . "";
		} else if ($order_column == 2) {
			$order_by = "ORDER BY sales_order_tgl_kirim " . $order_dir . "";
		} else if ($order_column == 3) {
			$order_by = "ORDER BY sales_order_kode " . $order_dir . "";
		} else if ($order_column == 4) {
			$order_by = "ORDER BY sales_order_no_po " . $order_dir . "";
		} else if ($order_column == 5) {
			$order_by = "ORDER BY kode_sales " . $order_dir . "";
		} else if ($order_column == 6) {
			$order_by = "ORDER BY karyawan_nama " . $order_dir . "";
		} else if ($order_column == 7) {
			$order_by = "ORDER BY kode_customer_eksternal " . $order_dir . "";
		} else if ($order_column == 8) {
			$order_by = "ORDER BY principle_kode " . $order_dir . "";
		} else if ($order_column == 9) {
			$order_by = "ORDER BY client_wms_nama " . $order_dir . "";
		} else if ($order_column == 10) {
			$order_by = "ORDER BY client_pt_nama " . $order_dir . "";
		} else if ($order_column == 11) {
			$order_by = "ORDER BY client_pt_alamat " . $order_dir . "";
		} else if ($order_column == 12) {
			$order_by = "ORDER BY tipe_sales_order_nama " . $order_dir . "";
		} else if ($order_column == 13) {
			$order_by = "ORDER BY sales_order_status " . $order_dir . "";
		} else if ($order_column == 14) {
			$order_by = "ORDER BY sku_harga_nett " . $order_dir . "";
		} else if ($order_column == 15) {
			$order_by = "ORDER BY sales_order_keterangan " . $order_dir . "";
		} else if ($order_column == 16) {
			$order_by = "ORDER BY is_priority " . $order_dir . "";
		}

		$query = $this->db->query("SELECT
										ROW_NUMBER() OVER (ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy') DESC) - 1 AS idx,
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
										ISNULL(so.total_faktur, 0) AS sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										CASE WHEN ISNULL(so.is_priority, 0) = 1 THEN 'Yes' ELSE '' END AS is_priority
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
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									AND ISNULL(so.sales_order_no_reff, '') = ''
									" . $perusahaan . "
									" . $kode . "
									" . $status . "
									" . $tipe . "
									" . $sales . "
									" . $principle . "
									" . $tgl_kirim . "
									" . $is_priority . "
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
									AND ISNULL(so.sales_order_no_reff, '') = ''
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
									AND so.sales_order_status = 'Draft'
									AND ISNULL(so.sales_order_no_reff, '') = ''
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
									so.principle_id,
									sales.karyawan_nama AS sales_nama,
									so.client_wms_id,
									so.client_pt_id,
									cust.client_pt_nama,
									cust.client_pt_alamat,
									cust.area_id,
									ISNULL(convert(nvarchar(36),cust.client_pt_segmen_id1), '') as client_pt_segmen_id1,
									ISNULL(convert(nvarchar(36),cust.client_pt_segmen_id2), '') as client_pt_segmen_id2,
									ISNULL(convert(nvarchar(36),cust.client_pt_segmen_id3), '') as client_pt_segmen_id3,
									ISNULL(cw.client_wms_tax, '0') AS client_wms_tax,
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
									so.tipe_ppn,
									so.keterangan,
									so.sales_order_tgl_update as tglUpdate,
									ISNULL(so.sales_order_no_reff,'') AS sales_order_no_reff,
									ISNULL(so.total,'0') AS total,
									ISNULL(so.diskon_global_percent,'0') AS diskon_global_percent,
									ISNULL(so.diskon_global_rp,'0') AS diskon_global_rp,
									ISNULL(so.dasar_kena_pajak,'0') AS dasar_kena_pajak,
									ISNULL(so.ppn_global_percent,'0') AS ppn_global_percent,
									ISNULL(so.ppn_global_rp,'0') AS ppn_global_rp,
									ISNULL(so.adjustment,'0') AS adjustment,
									ISNULL(so.total_faktur,'0') AS total_faktur,
									ISNULL(so.total_diskon_item,'0') AS total_diskon_item
									FROM sales_order so
									LEFT JOIN client_wms cw
									ON so.client_wms_id = cw.client_wms_id
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
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetSalesOrderDetailById($id)
	{
		$query = $this->db->query("SELECT
									so.sales_order_id,
									so.sales_order_detail_id,
									so.client_wms_id,
									so.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.principle_id,
									principle.principle_kode AS principle,
									sku.principle_brand_id,
									principle_brand.principle_brand_nama AS brand,
									ISNULL(perusahaan.client_wms_tax, '0') client_wms_tax,
									ISNULL(so.sku_weight,'0') sku_weight,
									ISNULL(so.sku_weight_unit,'') sku_weight_unit,
									ISNULL(so.sku_length,'0') sku_length,
									ISNULL(so.sku_length_unit,'') sku_length_unit,
									ISNULL(so.sku_width,'0') sku_width,
									ISNULL(so.sku_width_unit,'') sku_width_unit,
									ISNULL(so.sku_height,'0') sku_height,
									ISNULL(so.sku_height_unit,'') sku_height_unit,
									ISNULL(so.sku_volume,'0') sku_volume,
									ISNULL(so.sku_volume_unit,'') sku_volume_unit,
									so.sku_request_expdate,
									ISNULL(so.sku_filter_expdate,'') AS sku_filter_expdate,
									ISNULL(so.sku_filter_expdatebulan,'') AS sku_filter_expdatebulan,
									ISNULL(so.sku_filter_expdatetahun,'') AS sku_filter_expdatetahun,
									ISNULL(so.sku_harga_satuan,'0') AS sku_harga_satuan,
									ISNULL(abs(so.sku_qty),'0') AS sku_qty,
									ISNULL(so.sku_disc_percent,'0') AS sku_disc_percent,
									ISNULL(so.sku_disc_rp,'0') AS sku_disc_rp,
									ISNULL(so.sku_ppn_percent,'0') AS sku_ppn_percent,
									ISNULL(so.sku_ppn_rp,'0') AS sku_ppn_rp,
									ISNULL(so.sku_diskon_global_percent,'0') AS sku_diskon_global_percent,
									ISNULL(so.sku_diskon_global_rp,'0') AS sku_diskon_global_rp,
									ISNULL(so.sku_harga_nett,'0') AS sub_total,
									ISNULL(so.sku_disc_promo_rp,'0') AS sku_disc_promo_rp,
									ISNULL(so.sku_keterangan,'') AS sku_keterangan,
									ISNULL(so.tipe_stock_nama,'') AS tipe_stock_nama,
									ISNULL(so.sales_order_detail_tipe,'') AS sales_order_detail_tipe
								FROM sales_order_detail so
								LEFT JOIN sku
								ON sku.sku_id = so.sku_id
								LEFT JOIN principle
								ON principle.principle_id = sku.principle_id
								LEFT JOIN principle_brand
								ON principle_brand.principle_brand_id = sku.principle_brand_id
								LEFT JOIN client_wms perusahaan
								ON perusahaan.client_wms_id = so.client_wms_id
								WHERE so.sales_order_id = '$id'
								ORDER BY sku.sku_kode ASC, ISNULL(so.sku_harga_nett,0) DESC");

		if ($query->num_rows() == 0) {
			$query = 0;
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

	public function GetSalesOrderDetailPromoById($id)
	{
		$query = $this->db->query("select 
										a.sku_id,
										'' as sku_promo_id,
										a.referensi_id,
										ISNULL(b.referensi_diskon_kode, '') AS referensi_diskon_kode,
										a.sales_order_detail_tipe AS tipe,
										a.sku_id_bonus,
										ISNULL(a.sku_promo_diskon_amount, 0) AS amount_diskon,
										ISNULL(a.sku_promo_qty_bonus, 0) AS qty_bonus
									from sales_order_detail_promo a
									left join referensi_diskon b
									on b.referensi_diskon_id = a.referensi_id
									where a.sales_order_id = '$id'
									order by a.sku_id");

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

	public function search_filter_chosen_sku($perusahaan, $sales, $client_pt, $tipe_pembayaran, $brand, $principle, $sku_induk, $sku_nama_produk, $sku_kemasan, $sku_satuan)
	{
		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = "AND sku.client_wms_id = '" . $perusahaan . "' ";
		}

		if ($tipe_pembayaran == "0") {
			$tipe_pembayaran = "";
		} else {
			$tipe_pembayaran = "AND principle.client_pt_principle_is_kredit = '1' ";
		}

		if ($brand == "") {
			$brand = "";
		} else {
			$brand = "AND principle_brand.principle_brand_nama LIKE '%" . $brand . "%' ";
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = "AND principle.principle_id LIKE '%" . $principle . "%' ";
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
									FROM sku
									INNER JOIN sku_stock
									ON sku.sku_id = sku_stock.sku_id
									LEFT JOIN sku_induk
									ON sku.sku_induk_id = sku_induk.sku_induk_id
									LEFT JOIN principle
									ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand
									ON principle_brand.principle_brand_id = sku.principle_brand_id
									INNER JOIN client_wms
									ON sku.client_wms_id = client_wms.client_wms_id
									WHERE sku.principle_id IS NOT NULL
									" . $perusahaan . "
									" . $brand . "
									" . $principle . "
									" . $sku_induk . "
									" . $sku_nama_produk . "
									" . $sku_kemasan . "
									" . $sku_satuan . "
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
		$sales_order_no_reff,
		$principle_id,
		$total_global,
		$diskon_global_percent,
		$diskon_global_rp,
		$dasar_kena_pajak,
		$ppn_global_percent,
		$ppn_global_rp,
		$adjustment,
		$total_faktur,
		$total_diskon_item,
		$tipe_ppn,
		$keterangan
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
		$principle_id =  $principle_id ==  "" ? null : $principle_id;
		$total_global =  $total_global ==  "" ? null : $total_global;
		$diskon_global_percent =  $diskon_global_percent ==  "" ? null : $diskon_global_percent;
		$diskon_global_rp =  $diskon_global_rp ==  "" ? null : $diskon_global_rp;
		$dasar_kena_pajak =  $dasar_kena_pajak ==  "" ? null : $dasar_kena_pajak;
		$ppn_global_percent =  $ppn_global_percent ==  "" ? null : $ppn_global_percent;
		$ppn_global_rp =  $ppn_global_rp ==  "" ? null : $ppn_global_rp;
		$adjustment =  $adjustment ==  "" ? null : $adjustment;
		$total_faktur =  $total_faktur ==  "" ? null : $total_faktur;
		$total_diskon_item =  $total_diskon_item ==  "" ? null : $total_diskon_item;
		$tipe_ppn =  $tipe_ppn ==  "0" ? "ppn_global" : "ppn_detail";
		$keterangan =  $keterangan ==  "" ? null : $keterangan;

		// if ($principle_id != null) {
		// 	$principle_id = $this->db->query("SELECT principle_id FROM principle WHERE principle_kode = '$principle_id'")->row(0)->principle_id;
		// }

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
		$this->db->set("principle_id", $principle_id);
		$this->db->set("total", $total_global);
		$this->db->set("diskon_global_percent", $diskon_global_percent);
		$this->db->set("diskon_global_rp", $diskon_global_rp);
		$this->db->set("dasar_kena_pajak", $dasar_kena_pajak);
		$this->db->set("ppn_global_percent", $ppn_global_percent);
		$this->db->set("ppn_global_rp", $ppn_global_rp);
		$this->db->set("adjustment", $adjustment);
		$this->db->set("total_faktur", $total_faktur);
		$this->db->set("total_diskon_item", $total_diskon_item);
		$this->db->set("tipe_ppn", $tipe_ppn);
		$this->db->set("keterangan", $keterangan);

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
		$sku_qty = $data['sku_qty'] == "" ? null : round($data['sku_qty']);
		$sku_keterangan = $data['sku_keterangan'] == "" ? null : $data['sku_keterangan'];
		// $tipe_stock_nama = $data['tipe_stock_nama'] == "" ? null : $data['tipe_stock_nama'];
		$sku_ppn_percent = $data['sku_ppn_percent'] == "" ? null : $data['sku_ppn_percent'];
		$sku_ppn_rp = $data['sku_ppn_rp'] == "" ? null : $data['sku_ppn_rp'];
		$sku_diskon_global_percent = $data['sku_diskon_global_percent'] == "" ? null : $data['sku_diskon_global_percent'];
		$sku_diskon_global_rp = $data['sku_diskon_global_rp'] == "" ? null : $data['sku_diskon_global_rp'];
		$sales_order_detail_tipe = $data['sales_order_detail_tipe'] == "" ? null : $data['sales_order_detail_tipe'];
		$sku_disc_promo_rp = $data['sku_disc_promo_rp'] == "" ? null : $data['sku_disc_promo_rp'];

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
		$this->db->set('tipe_stock_nama', "Good Stock");
		$this->db->set('sku_ppn_percent', $sku_ppn_percent);
		$this->db->set('sku_ppn_rp', $sku_ppn_rp);
		$this->db->set('sku_diskon_global_percent', $sku_diskon_global_percent);
		$this->db->set('sku_diskon_global_rp', $sku_diskon_global_rp);
		$this->db->set('sales_order_detail_tipe', $sales_order_detail_tipe);
		$this->db->set('sku_disc_promo_rp', $sku_disc_promo_rp);

		$queryinsert = $this->db->insert("sales_order_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail_promo($sales_order_id, $sales_order_detail_promo_id, $data)
	{
		// $sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		$sales_order_id = $sales_order_id == "" ? null : $sales_order_id;
		$sales_order_detail_promo_id = $sales_order_detail_promo_id == "" ? null : $sales_order_detail_promo_id;
		$sales_order_detail_tipe = $data['tipe'] == "" ? null : $data['tipe'];
		$sku_id = $data['sku_id'] == "" ? null : $data['sku_id'];
		$referensi_id = $data['referensi_id'] == "" ? null : $data['referensi_id'];
		$sku_id_bonus = $data['sku_id_bonus'] == "" ? null : $data['sku_id_bonus'];
		$sku_promo_diskon_amount = $data['amount_diskon'] == "" ? null : $data['amount_diskon'];
		$sku_promo_qty_bonus = $data['qty_bonus'] == "" ? null : $data['qty_bonus'];

		$this->db->set("sales_order_detail_promo_id", $sales_order_detail_promo_id);
		$this->db->set('sales_order_id', $sales_order_id);
		$this->db->set('sales_order_detail_tipe', $sales_order_detail_tipe);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('referensi_id', $referensi_id);
		$this->db->set('sku_id_bonus', $sku_id_bonus);
		$this->db->set('sku_promo_diskon_amount', $sku_promo_diskon_amount);
		$this->db->set('sku_promo_qty_bonus', $sku_promo_qty_bonus);

		$queryinsert = $this->db->insert("sales_order_detail_promo");

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
		$sku_harga_nett = $data['sku_harga_nett'] == "" ? null : $data['sku_harga_nett'] * -1;
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
		$sku_qty = $data['sku_qty'] == "" ? null : round($data['sku_qty']);
		$sku_keterangan = $data['sku_keterangan'] == "" ? null : $data['sku_keterangan'];
		// $tipe_stock_nama = $data['tipe_stock_nama'] == "" ? null : $data['tipe_stock_nama'];
		$sku_ppn_percent = $data['sku_ppn_percent'] == "" ? null : $data['sku_ppn_percent'];
		$sku_ppn_rp = $data['sku_ppn_rp'] == "" ? null : $data['sku_ppn_rp'];
		$sku_diskon_global_percent = $data['sku_diskon_global_percent'] == "" ? null : $data['sku_diskon_global_percent'];
		$sku_diskon_global_rp = $data['sku_diskon_global_rp'] == "" ? null : $data['sku_diskon_global_rp'];
		$sales_order_detail_tipe = $data['sales_order_detail_tipe'] == "" ? null : $data['sales_order_detail_tipe'];
		$sku_disc_promo_rp = $data['sku_disc_promo_rp'] == "" ? null : $data['sku_disc_promo_rp'];

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
		$this->db->set('tipe_stock_nama', "Good Stock");
		$this->db->set('sku_ppn_percent', $sku_ppn_percent);
		$this->db->set('sku_ppn_rp', $sku_ppn_rp);
		$this->db->set('sku_diskon_global_percent', $sku_diskon_global_percent);
		$this->db->set('sku_diskon_global_rp', $sku_diskon_global_rp);
		$this->db->set('sales_order_detail_tipe', $sales_order_detail_tipe);
		$this->db->set('sku_disc_promo_rp', $sku_disc_promo_rp);

		$queryinsert = $this->db->insert("sales_order_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail2($sod_id, $sku_id)
	{
		// $sales_order_detail_id = $data['sales_order_detail_id'] == "" ? null : $data['sales_order_detail_id'];
		// $sku_expdate = $data['sku_expdate'] == "" ? null : $data['sku_expdate'];
		// $sku_id = $data['sku_id'] == "" ? null : $data['sku_id'];
		// $sku_stock_id = $data['sku_stock_id'] == "" ? null : $data['sku_stock_id'];
		// $sku_qty = $data['sku_qty'] == "" ? null : $data['sku_qty'];

		// $this->db->set('sales_order_detail2_id', "NEWID()", FALSE);
		// $this->db->set('sales_order_detail_id', $sales_order_detail_id);
		// $this->db->set('sku_id', $sku_id);
		// $this->db->set('sku_stock_id', $sku_stock_id);
		// $this->db->set('sku_expdate', $sku_expdate);
		// $this->db->set('sku_qty', $sku_qty);

		// $queryinsert = $this->db->insert("sales_order_detail_2");


		$queryinsert = $this->db->query("INSERT INTO sales_order_detail_2
										SELECT
											NEWID(),
											'$sod_id',
											sku_id,
											sku_stock_id,
											sku_expdate,
											sku_qty
											FROM sales_order_detail_2_temp
											WHERE sku_id = '$sku_id' ");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail2_retur($sod2_id, $sod_id, $sku_stock_id, $sku_id, $sku_expdate, $sku_qty, $delivery_order_reff_id)
	{
		$sod_id = $sod_id == "" ? null : $sod_id;
		$sku_expdate = $sku_expdate == "" ? null : date('Y-m-d', strtotime($sku_expdate));
		$sku_id = $sku_id == "" ? null : $sku_id;
		$sku_stock_id = $sku_stock_id == "" ? null : $sku_stock_id;
		$sku_qty = $sku_qty == "" ? null : $sku_qty;
		$delivery_order_reff_id = $delivery_order_reff_id == "" ? null : $delivery_order_reff_id;

		$this->db->set('sales_order_detail2_id', $sod2_id);
		$this->db->set('sales_order_detail_id', $sod_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_stock_id', $sku_stock_id);
		$this->db->set('sku_expdate', $sku_expdate);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('delivery_order_reff_id', $delivery_order_reff_id);

		$queryinsert = $this->db->insert("sales_order_detail_2");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_sales_order_detail_2_temp($so_id, $sku_stock_id, $sku_id, $sku_expdate, $sku_qty)
	{
		$so_id = $so_id == "" ? null : $so_id;
		$sku_expdate = $sku_expdate == "" ? null : date('Y-m-d', strtotime($sku_expdate));
		$sku_id = $sku_id == "" ? null : $sku_id;
		$sku_stock_id = $sku_stock_id == "" ? null : $sku_stock_id;
		$sku_qty = $sku_qty == "" ? null : $sku_qty;

		$this->db->set('sales_order_detail2_id', "NEWID()", FALSE);
		$this->db->set('sales_order_detail_id', $so_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_stock_id', $sku_stock_id);
		$this->db->set('sku_expdate', $sku_expdate);
		$this->db->set('sku_qty', $sku_qty);

		$queryinsert = $this->db->insert("sales_order_detail_2_temp");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sales_order_detail_2_temp($so_id, $sku_id)
	{
		$this->db->where('sales_order_detail_id', $so_id);
		$this->db->where('sku_id', $sku_id);

		return $this->db->delete('sales_order_detail_2_temp');
	}

	public function delete_sales_order_detail_2_temp_all()
	{
		return $this->db->query('delete from sales_order_detail_2_temp');
	}

	public function update_sales_order(
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
		$sales_order_no_reff,
		$principle_id,
		$total_global,
		$diskon_global_percent,
		$diskon_global_rp,
		$dasar_kena_pajak,
		$ppn_global_percent,
		$ppn_global_rp,
		$adjustment,
		$total_faktur,
		$total_diskon_item,
		$tipe_ppn,
		$keterangan
	) {
		// $sales_order_id =  $sales_order_id ==  "" ? null : $sales_order_id;
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
		$principle_id =  $principle_id ==  "" ? null : $principle_id;
		$total_global =  $total_global ==  "" ? null : $total_global;
		$diskon_global_percent =  $diskon_global_percent ==  "" ? null : $diskon_global_percent;
		$diskon_global_rp =  $diskon_global_rp ==  "" ? null : $diskon_global_rp;
		$dasar_kena_pajak =  $dasar_kena_pajak ==  "" ? null : $dasar_kena_pajak;
		$ppn_global_percent =  $ppn_global_percent ==  "" ? null : $ppn_global_percent;
		$ppn_global_rp =  $ppn_global_rp ==  "" ? null : $ppn_global_rp;
		$adjustment =  $adjustment ==  "" ? null : $adjustment;
		$total_faktur =  $total_faktur ==  "" ? null : $total_faktur;
		$total_diskon_item =  $total_diskon_item ==  "" ? null : $total_diskon_item;
		$tipe_ppn =  $tipe_ppn ==  "0" ? "ppn_global" : "ppn_detail";
		$keterangan =  $keterangan ==  "" ? null : $keterangan;

		// $tgl_ = date_create(str_replace("/", "-", $tgl));
		// $$this->db->set("sales_order_id", $sales_order_id);
		$this->db->set("depo_id", $depo_id);
		// $this->db->set("sales_order_kode", $sales_order_kode);
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
		// $this->db->set("sales_order_who_create", $this->session->userdata('pengguna_username'));
		// $this->db->set("sales_order_tgl_create", "GETDATE()", FALSE);
		$this->db->set("sales_order_is_downloaded", $sales_order_is_downloaded);
		$this->db->set("tipe_delivery_order_id", $tipe_delivery_order_id);
		$this->db->set("sales_order_is_uploaded", $sales_order_is_uploaded);
		$this->db->set("sales_order_no_reff", $sales_order_no_reff);
		$this->db->set("principle_id", $principle_id);
		$this->db->set("total", $total_global);
		$this->db->set("diskon_global_percent", $diskon_global_percent);
		$this->db->set("diskon_global_rp", $diskon_global_rp);
		$this->db->set("dasar_kena_pajak", $dasar_kena_pajak);
		$this->db->set("ppn_global_percent", $ppn_global_percent);
		$this->db->set("ppn_global_rp", $ppn_global_rp);
		$this->db->set("adjustment", $adjustment);
		$this->db->set("total_faktur", $total_faktur);
		$this->db->set("total_diskon_item", $total_diskon_item);
		$this->db->set("tipe_ppn", $tipe_ppn);
		$this->db->set("keterangan", $keterangan);

		$this->db->where("sales_order_id", $sales_order_id);

		$queryinsert = $this->db->update("sales_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function confirm_delivery_order_draft($delivery_order_draft_id)
	{
		$this->db->set("delivery_order_draft_status", "Approved");
		$this->db->set("delivery_order_draft_update_who", $this->session->userdata('pengguna_username'));
		$this->db->set("delivery_order_draft_update_tgl", "GETDATE()", FALSE);
		$this->db->set("delivery_order_draft_approve_who", $this->session->userdata('pengguna_username'));
		$this->db->set("delivery_order_draft_approve_tgl", "GETDATE()", FALSE);

		$this->db->where("delivery_order_draft_id", $delivery_order_draft_id);

		$queryinsert = $this->db->update("delivery_order_draft");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function reject_delivery_order_draft($delivery_order_draft_id)
	{
		$this->db->set("delivery_order_draft_status", "Rejected");
		$this->db->set("delivery_order_draft_update_who", $this->session->userdata('pengguna_username'));
		$this->db->set("delivery_order_draft_update_tgl", "GETDATE()", FALSE);
		$this->db->set("delivery_order_draft_reject_who", $this->session->userdata('pengguna_username'));
		$this->db->set("delivery_order_draft_reject_tgl", "GETDATE()", FALSE);

		$this->db->where("delivery_order_draft_id", $delivery_order_draft_id);

		$queryinsert = $this->db->update("delivery_order_draft");

		return $queryinsert;
		// return $this->db->last_query();
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

	public function delete_sales_order_detail_promo($sales_order_id)
	{
		$this->db->where("sales_order_id", $sales_order_id);
		return $this->db->delete('sales_order_detail_promo');
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function Exec_approval_pengajuan($depo_id, $sales_id, $approvalParam, $sales_order_id, $sales_order_kode, $is_approvaldana, $total_biaya)
	{
		$query = $this->db->query("exec approval_pengajuan '$depo_id', '$sales_id','$approvalParam', '$sales_order_id','$sales_order_kode', '$is_approvaldana','$total_biaya'");

		// $res = $query->result_array();

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$res = 1; // Success
		} else {
			$res = 0; // Success
		}

		return $res;
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

	public function cek_sku_so_detail2($arr_so_detail, $arr_so_detail2)
	{

		$union = " UNION ALL ";
		$table_sementara = "";
		$table_sementara2 = "";

		foreach ($arr_so_detail as $key => $value) {
			$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id";

			if ($key < count($arr_so_detail) - 1) {
				$table_sementara .= $union;
			}
		}

		foreach ($arr_so_detail2 as $key => $value) {
			$table_sementara2 .= "SELECT '" . $value['sku_id'] . "' AS sku_id";

			if ($key < count($arr_so_detail2) - 1) {
				$table_sementara2 .= $union;
			}
		}

		$query = $this->db->query("SELECT
									a.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk
									FROM (" . $table_sementara . ") a
									LEFT JOIN (" . $table_sementara2 . ") b
									ON b.sku_id = a.sku_id
									LEFT JOIN sku
									ON ISNULL(convert(nvarchar(36), sku.sku_id),'') = a.sku_id
									WHERE b.sku_id IS NULL
									GROUP BY a.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk
									ORDER BY sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function get_so_detail2_sementara($sku_id, $arr_so_detail2)
	{

		$union = " UNION ALL ";
		$table_sementara = "";
		$list_sku_id = array();
		foreach ($arr_so_detail2 as $key => $value) {
			array_push($list_sku_id, "'" . $value['sku_id'] . "'");

			$table_sementara .= "SELECT '" . $value['delivery_order_reff_id'] . "' AS delivery_order_reff_id, '" . $value['idx'] . "' AS idx, '" . $value['index_so_detail'] . "' AS index_so_detail, '" . $value['depo_detail_id'] . "' AS depo_detail_id,'" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_stock_expired_date'] . "' AS sku_stock_expired_date," . $value['sku_qty'] . " AS sku_qty";

			if ($key < count($arr_so_detail2) - 1) {
				$table_sementara .= $union;
			}
		}

		$query = $this->db->query("SELECT
									a.delivery_order_reff_id,
									ISNULL(do.delivery_order_kode,'') AS delivery_order_reff_kode,
									idx,
									index_so_detail,
									depo_detail_id,
									sku_id,
									sku_stock_expired_date,
									abs(sku_qty) as sku_qty
									FROM (" . $table_sementara . ") a
									LEFT JOIN delivery_order do
									ON ISNULL(convert(nvarchar(36), do.delivery_order_id),'') = a.delivery_order_reff_id
									WHERE sku_id = '$sku_id'
									ORDER BY idx ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function getDepoDetail()
	{
		$query = $this->db->query("select depo_detail_id from depo_detail where depo_id = '" . $this->session->userdata('depo_id') . "' AND depo_detail_is_qa = '1'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row_array();
		}

		return $query;
	}

	public function cek_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate)
	{
		$query = $this->db->query("select * from sku_stock where depo_id = '" . $this->session->userdata('depo_id') . "' and depo_detail_id = '$depo_detail_id' and format(sku_stock_expired_date,'yyyy-MM-dd') = '$sku_expdate' and sku_id = '$sku_id' ");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function insert_sku_stock_retur($depo_detail_id, $sku_id, $sku_expdate, $sku_qty)
	{
		$query_sku_stock_id = $this->db->query("SELECT NEWID() AS generate_kode");
		$sku_stock_id = $query_sku_stock_id->row(0)->generate_kode;

		$query_sku = $this->db->query("SELECT * from sku where sku_id = '$sku_id'");
		$client_wms_id = $query_sku->row(0)->client_wms_id;
		$sku_induk_id = $query_sku->row(0)->sku_induk_id;

		$this->db->set("sku_stock_id", $sku_stock_id);
		$this->db->set("unit_mandiri_id", $this->session->userdata('unit_mandiri_id'));
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("depo_id", $this->session->userdata('depo_id'));
		$this->db->set("depo_detail_id", $depo_detail_id);
		$this->db->set("sku_induk_id", $sku_induk_id);
		$this->db->set("sku_id", $sku_id);
		$this->db->set("sku_stock_expired_date", $sku_expdate);
		// $this->db->set("sku_stock_batch_no", $sku_stock_penerimaan->sku_stock_batch_no);
		$this->db->set("sku_stock_awal", "0");
		$this->db->set("sku_stock_masuk", "0");
		$this->db->set("sku_stock_alokasi", "0");
		$this->db->set("sku_stock_saldo_alokasi", "0");
		$this->db->set("sku_stock_keluar", "0");
		$this->db->set("sku_stock_akhir", "0");
		$this->db->set("sku_stock_is_jual", "1");
		$this->db->set("sku_stock_is_aktif", "1");
		$this->db->set("sku_stock_is_deleted", "0");

		$this->db->insert("sku_stock");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = $sku_stock_id; // Success
		} else {
			$queryinsert = "";
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $kendaraan_id, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create, $canvas_reff_kode, $client_pt_id, $canvas_tgl_update, $canvas_who_update, $principle_id)
	{
		// $canvas_id =  $canvas_id ==  '' ? null : $canvas_id;
		$depo_id =  $depo_id ==  '' ? null : $depo_id;
		$canvas_kode =  $canvas_kode ==  '' ? null : $canvas_kode;
		$canvas_requestdate =  $canvas_requestdate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $canvas_requestdate)));
		$client_wms_id =  $client_wms_id ==  '' ? null : $client_wms_id;
		$karyawan_id =  $karyawan_id ==  '' ? null : $karyawan_id;
		$kendaraan_id =  $kendaraan_id ==  '' ? null : $kendaraan_id;
		$canvas_keterangan =  $canvas_keterangan ==  '' ? null : $canvas_keterangan;
		$canvas_startdate =  $canvas_startdate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $canvas_startdate)));
		$canvas_enddate =  $canvas_enddate ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $canvas_enddate)));
		$canvas_status =  $canvas_status ==  '' ? null : $canvas_status;
		$canvas_tanggal_create =  $canvas_tanggal_create ==  '' ? null : date('Y-m-d', strtotime(str_replace("/", "-", $canvas_tanggal_create)));
		$canvas_who_create =  $canvas_who_create ==  '' ? null : $canvas_who_create;
		$canvas_reff_kode =  $canvas_reff_kode ==  '' ? null : $canvas_reff_kode;
		$client_pt_id =  $client_pt_id ==  '' ? null : $client_pt_id;
		$canvas_tgl_update =  $canvas_tgl_update ==  '' ? null : $canvas_tgl_update;
		$canvas_who_update =  $canvas_who_update ==  '' ? null : $canvas_who_update;
		$principle_id =  $principle_id ==  '' ? null : $principle_id;

		$this->db->set('canvas_id', $canvas_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('canvas_kode', $canvas_kode);
		$this->db->set('canvas_requestdate', $canvas_requestdate);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('karyawan_id', $karyawan_id);
		$this->db->set('kendaraan_id', $kendaraan_id);
		$this->db->set('canvas_keterangan', $canvas_keterangan);
		$this->db->set('canvas_startdate', $canvas_startdate);
		$this->db->set('canvas_enddate', $canvas_enddate);
		$this->db->set('canvas_status', $canvas_status);
		$this->db->set('canvas_tanggal_create', "GETDATE()", FALSE);
		$this->db->set('canvas_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('canvas_reff_kode', $canvas_reff_kode);
		$this->db->set('client_pt_id', $client_pt_id);
		$this->db->set('principle_id', $principle_id);
		$this->db->set('canvas_tgl_update', "GETDATE()", FALSE);
		$this->db->set('canvas_who_update', $this->session->userdata('pengguna_username'));

		$queryinsert = $this->db->insert("canvas");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function insert_canvas_detail($canvas_detail_id, $canvas_id, $sku_id, $sku_kode, $sku_nama, $sku_kemasan, $sku_satuan, $sku_qty, $sku_keterangan, $tipe_stock_nama)
	{
		// $canvas_detail_id =  $canvas_detail_id ==  '' ? null : $canvas_detail_id;
		$canvas_id =  $canvas_id ==  '' ? null : $canvas_id;
		$sku_id =  $sku_id ==  '' ? null : $sku_id;
		$sku_kode =  $sku_kode ==  '' ? null : $sku_kode;
		$sku_nama =  $sku_nama ==  '' ? null : $sku_nama;
		$sku_kemasan =  $sku_kemasan ==  '' ? null : $sku_kemasan;
		$sku_satuan =  $sku_satuan ==  '' ? null : $sku_satuan;
		$sku_qty =  $sku_qty ==  '' ? null : $sku_qty;
		$sku_keterangan =  $sku_keterangan ==  '' ? null : $sku_keterangan;
		$tipe_stock_nama =  $tipe_stock_nama ==  '' ? null : $tipe_stock_nama;

		$this->db->set('canvas_detail_id', $canvas_detail_id);
		$this->db->set('canvas_id', $canvas_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_kode', $sku_kode);
		$this->db->set('sku_nama', $sku_nama);
		$this->db->set('sku_kemasan', $sku_kemasan);
		$this->db->set('sku_satuan', $sku_satuan);
		$this->db->set('sku_qty', $sku_qty);
		$this->db->set('sku_keterangan', $sku_keterangan);
		$this->db->set('tipe_stock_nama', $tipe_stock_nama);

		$queryinsert = $this->db->insert("canvas_detail");

		return $queryinsert;
		// return $this->db->last_query();
	}
	public function update_sales_order_status($sales_order_id, $sales_order_status)
	{
		// $sales_order_id =  $sales_order_id ==  "" ? null : $sales_order_id;
		$sales_order_status =  $sales_order_status ==  "" ? null : $sales_order_status;
		$this->db->set("sales_order_status", $sales_order_status);
		// $this->db->set("sales_order_who_create", $this->session->userdata('pengguna_username'));
		// $this->db->set("sales_order_tgl_create", "GETDATE()", FALSE);
		$this->db->where("sales_order_id", $sales_order_id);

		$queryinsert = $this->db->update("sales_order");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function Get_sales_order_header_by_id_for_canvas($sales_order_id)
	{
		$query = $this->db->query("SELECT NULL AS canvas_id,
										depo_id,
										NULL AS canvas_kode,
										getdate() canvas_requestdate,
										client_wms_id,
										sales_id AS karyawan_id,
										NULL kendaraan_id,
										sales_order_keterangan AS canvas_keterangan,
										getdate() AS canvas_startdate,
										getdate() AS canvas_enddate,
										'Draft' AS canvas_status,
										getdate() AS canvas_tanggal_create,
										NULL AS canvas_who_create,
										sales_order_kode AS canvas_reff_kode,
										client_pt_id,
										getdate() AS canvas_tgl_update,
										NULL AS canvas_who_update,
										principle_id
									FROM sales_order
									where sales_order_id = '$sales_order_id'");
		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sales_order_detail_by_id_for_canvas($sales_order_id)
	{
		$query = $this->db->query("select
									null as canvas_detail_id,
									null as canvas_id,
									so.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk as sku_nama,
									sku.sku_kemasan,
									sku.sku_satuan,
									so.sku_qty,
									so.sku_keterangan,
									so.tipe_stock_nama
									from sales_order_detail so
									left join sku
									on sku.sku_id = so.sku_id
									where sales_order_id = '$sales_order_id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function insertSimulasiMPSTemp2($sku_id, $qty, $tgl_kirim, $id_temp2)
	{
		$this->db->set("id", $id_temp2);
		$this->db->set("sku_id", $sku_id);
		$this->db->set("tgl_kirim", $tgl_kirim);
		$this->db->set("qty", $qty);

		$queryinsert = $this->db->insert("simulasi_mps_temp2");

		return $queryinsert;
	}

	public function insertSimulasiMPSTemp($value2, $id_temp2)
	{
		$data = [
			'id' => $id_temp2,
			'jenis' => $value2['jenis'],
			'sku' => $value2['sku'],
			'satuan' => $value2['satuan'],
			'principle' => $value2['principle'],
			'urut' => $value2['urut'],
			'"0"' => $value2['0'],
			'"1"' => $value2['1'],
			'"2"' => $value2['2'],
			'"3"' => $value2['3'],
			'"4"' => $value2['4'],
			'"5"' => $value2['5'],
			'"6"' => $value2['6'],
			'"7"' => $value2['7'],
			'"8"' => $value2['8'],
			'"9"' => $value2['9'],
			'"10"' => $value2['10'],
			'"11"' => $value2['11'],
			'"12"' => $value2['12'],
		];

		$queryinsert = $this->db->insert("simulasi_mps_temp", $data);

		return $queryinsert;
	}

	public function ExecProsesSimulasiMPS($tahun, $sku_id, $id_temp2)
	{
		return $this->db->query("exec proses_simulasi_mps " . intval($tahun) . ", '" . $sku_id . "', '" . $id_temp2 . "'")->result_array();
	}

	public function Exec_sku_harga_jual($client_wms_id, $client_pt_segmen_id, $client_pt_id, $tanggal_harga, $sku_id)
	{
		$query =  $this->db->query("exec sku_harga_jual '" . $client_wms_id . "','" . $this->session->userdata('depo_id') . "', '" . $client_pt_id . "','" . $client_pt_segmen_id . "', '" . $tanggal_harga . "' , '" . $sku_id . "' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->sku_nominal_harga;
		}

		return $query;
	}

	public function Exec_sku_promo_jual($client_wms_id, $client_pt_segmen_id, $client_pt_id, $tanggal_harga, $sku_id, $qty, $harga)
	{
		$data = array();

		// Buat koneksi SQLSRV secara langsung
		$conn = $this->db->conn_id;

		// Siapkan dan eksekusi query
		$sql = "exec sku_promo_jual '" . $client_wms_id . "','" . $this->session->userdata('depo_id') . "', '" . $client_pt_id . "','" . $client_pt_segmen_id . "', '" . $tanggal_harga . "', '" . $sku_id . "', $qty, $harga";

		$stmt = sqlsrv_query($conn, $sql);

		if ($stmt === false) {
			die(print_r(sqlsrv_errors(), true));
		}

		do {
			$result_set = array();
			while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
				$result_set[] = $row;
			}
			$data[] = $result_set;
		} while (sqlsrv_next_result($stmt));

		sqlsrv_free_stmt($stmt);

		return $data;
	}

	public function get_so_detail_promo($sku_id, $tipe, $detail_promo)
	{

		$union = " UNION ALL ";
		$table_sementara = "";

		if (isset($detail_promo) && count($detail_promo) > 0) {


			foreach ($detail_promo as $key => $value) {
				$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id, '" . $value['referensi_id'] . "' AS referensi_id, '" . $value['tipe'] . "' AS tipe, '" . $value['sku_id_bonus'] . "' AS sku_id_bonus, '" . $value['amount_diskon'] . "' AS amount_diskon, '" . $value['qty_bonus'] . "' AS qty_bonus";

				if ($key < count($detail_promo) - 1) {
					$table_sementara .= $union;
				}
			}

			$query = $this->db->query("select 
										a.sku_id,
										'' as sku_promo_id,
										a.referensi_id,
										ISNULL(b.referensi_diskon_kode, '') AS referensi_diskon_kode,
										a.tipe AS tipe,
										a.sku_id_bonus,
										ISNULL(a.amount_diskon, '0') AS amount_diskon,
										ISNULL(a.qty_bonus, '0') AS qty_bonus
									from (" . $table_sementara . ") a
									left join referensi_diskon b
									on convert(nvarchar(36), b.referensi_diskon_id) = a.referensi_id
									where a.sku_id = '$sku_id'
									and a.tipe = '$tipe'
									order by b.referensi_diskon_kode asc");

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
}
