<?php

use DeepCopy\Filter\Filter;

date_default_timezone_set('Asia/Jakarta');

class M_AllotmentStockOrder extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		// $this->karyawan_sales_id_global = "644A7B16-2038-4529-A0B9-EC549DD0E6BB";
		$this->karyawan_sales_id_global = $this->session->useradata('karyawan_id');
	}

	public function GetPerusahaan()
	{
		// $this->db->select("*")
		// 	->from("client_wms")
		// 	->order_by("client_wms_nama");
		// $query = $this->db->get();

		if ($this->session->userdata('client_wms_id') == "") {

			$query = $this->db->query("SELECT b.*
						FROM depo_client_wms a
						LEFT JOIN client_WMS b ON a.client_wms_id = b.client_wms_id
						WHERE a.depo_id = '" . $this->session->userdata('depo_id') . "'
						AND b.client_wms_is_aktif = 1
						AND b.client_wms_is_deleted = 0");
		} else {


			$query = $this->db->query("SELECT b.*
						FROM depo_client_wms a
						LEFT JOIN client_WMS b ON a.client_wms_id = b.client_wms_id
						WHERE a.client_wms_id = '" . $this->session->userdata('client_wms_id') . "'
						AND a.depo_id = '" . $this->session->userdata('depo_id') . "'
						AND b.client_wms_is_aktif = 1
						AND b.client_wms_is_deleted = 0");
		}

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPrinciple()
	{

		$query = $this->db->query("SELECT * FROM principle WHERE principle_is_aktif = '1' ORDER BY principle_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPrincipleByPerusahaan($perusahaan)
	{

		$query = $this->db->query("select
										perusahaan.client_wms_id,
										perusahaan.principle_id,
										principle.principle_kode,
										principle.principle_nama
									from client_wms_principle perusahaan
									left join principle
									on perusahaan.principle_id = principle.principle_id
									where perusahaan.client_wms_id = '$perusahaan'
									and principle.principle_is_aktif = '1'
									order by principle.principle_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_back_order($tahun, $temp_id, $perusahaan, $filter_back_order)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND bo.back_order_id NOT IN (" . implode(",", $filter_back_order) . ")";
			}
		}

		$query = $this->db->query("select
										bo.back_order_id,
										bo.back_order_kode,
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy') AS back_order_tgl,
										FORMAT(bo.back_order_tgl_kirim, 'dd-MM-yyyy') AS back_order_tgl_kirim,
										FORMAT(bo.back_order_tgl_sj, 'dd-MM-yyyy') AS back_order_tgl_sj,
										bo.client_pt_id,
										client_pt.client_pt_nama,
										client_pt.client_pt_alamat,
										client_pt.client_pt_kelurahan,
										client_pt.client_pt_kecamatan,
										client_pt.client_pt_kota,
										client_pt.client_pt_propinsi,
										client_pt.client_pt_telepon,
										client_pt.area_id,
										ISNULL(area.area_kode, '') AS area_kode,
										ISNULL(bo.back_order_no_po, '') AS back_order_no_po,
										bo.tipe_back_order_id,
										ISNULL(tipe.tipe_back_order_nama, '') as tipe,
										bo.back_order_status
									from back_order bo
									left join client_pt
									on client_pt.client_pt_id = bo.client_pt_id
									left join area
									on area.area_id = client_pt.area_id
									left join tipe_back_order tipe
									on tipe.tipe_back_order_id = bo.tipe_back_order_id
									where convert(nvarchar(36),bo.client_wms_id) = '$perusahaan'
									and bo.back_order_status = 'Approved'
									and bo.back_order_id IN (select a.back_order_id from back_order_detail a left join allotment_stock_order_detail b on b.sku_id = a.sku_id where b.allotment_stock_order_id = '$temp_id' group by a.back_order_id)
									and bo.back_order_id NOT IN (select back_order_id from allotment_stock_order_detail3)
									" . $filter_back_order_str . "
									order by bo.back_order_tgl desc, bo.back_order_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_back_order_by_customer($tahun, $perusahaan, $client_pt_id, $filter_back_order)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND bo.back_order_id IN (" . implode(",", $filter_back_order) . ")";
			}
		}

		$query = $this->db->query("select
										bo.back_order_id,
										bo.back_order_kode,
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy') AS back_order_tgl,
										FORMAT(bo.back_order_tgl_kirim, 'dd-MM-yyyy') AS back_order_tgl_kirim,
										FORMAT(bo.back_order_tgl_sj, 'dd-MM-yyyy') AS back_order_tgl_sj,
										bo.client_pt_id,
										client_pt.client_pt_nama,
										client_pt.client_pt_alamat,
										client_pt.client_pt_kelurahan,
										client_pt.client_pt_kecamatan,
										client_pt.client_pt_kota,
										client_pt.client_pt_propinsi,
										client_pt.client_pt_telepon,
										client_pt.area_id,
										ISNULL(area.area_kode, '') AS area_kode,
										ISNULL(bo.back_order_no_po, '') AS back_order_no_po,
										bo.tipe_back_order_id,
										ISNULL(tipe.tipe_back_order_nama, '') as tipe,
										bo.back_order_status
									from back_order bo
									left join client_pt
									on client_pt.client_pt_id = bo.client_pt_id
									left join area
									on area.area_id = client_pt.area_id
									left join tipe_back_order tipe
									on tipe.tipe_back_order_id = bo.tipe_back_order_id
									where YEAR(back_order_tgl) = '$tahun' 
									and convert(nvarchar(36),bo.client_wms_id) = '$perusahaan'
									and convert(nvarchar(36),bo.client_pt_id) = '$client_pt_id'
									and bo.back_order_status = 'Approved'
									" . $filter_back_order_str . "
									order by bo.back_order_tgl desc, bo.back_order_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_allotment_stock_order_detail_header($filter_back_order)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND convert(nvarchar(36),bo.back_order_id) IN (" . implode(",", $filter_back_order) . ")";
			}
		} else {
			$filter_back_order_str = " AND convert(nvarchar(36),bo.back_order_id) IN ('')";
		}

		$query = $this->db->query("select
										bo.client_pt_id,
										client_pt.client_pt_nama,
										client_pt.client_pt_alamat,
										client_pt.client_pt_kelurahan,
										client_pt.client_pt_kecamatan,
										client_pt.client_pt_kota,
										client_pt.client_pt_propinsi,
										client_pt.client_pt_telepon,
										client_pt.area_id,
										ISNULL(area.area_kode, '') AS area_kode,
										ISNULL(bo.back_order_no_po, '') AS back_order_no_po,
										bo.back_order_status,
										COUNT(DISTINCT bo.back_order_id) AS jml_bo
									from back_order bo
									left join client_pt
									on client_pt.client_pt_id = bo.client_pt_id
									left join area
									on area.area_id = client_pt.area_id
									where bo.back_order_status = 'Approved'
									" . $filter_back_order_str . "
									group by bo.client_pt_id,
												client_pt.client_pt_nama,
												client_pt.client_pt_alamat,
												client_pt.client_pt_kelurahan,
												client_pt.client_pt_kecamatan,
												client_pt.client_pt_kota,
												client_pt.client_pt_propinsi,
												client_pt.client_pt_telepon,
												client_pt.area_id,
												ISNULL(area.area_kode, ''),
												ISNULL(bo.back_order_no_po, ''),
												bo.back_order_status
									order by client_pt.client_pt_nama asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_allotment_stock_order_detail_summary($temp_id, $tahun, $filter_back_order)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND convert(nvarchar(36),bo.back_order_id) IN (" . implode(",", $filter_back_order) . ")";
			}
		} else {
			$filter_back_order_str = " AND convert(nvarchar(36),bo.back_order_id) IN ('')";
		}

		$query = $this->db->query("select
										bo.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										sku.principle_id,
										principle.principle_kode as principle,
										sku.principle_brand_id,
										brand.principle_brand_nama as brand,
										SUM(ISNULL(asod.sku_qty, 0)) as sku_qty,
										ISNULL(sim.qty, 0) as sku_qty_sim
									from back_order_detail bo
									LEFT JOIN (SELECT asod.sku_id,
										sum(asod2m.sku_subtotal_qty) AS sku_qty
									FROM allotment_stock_order aso
									LEFT JOIN allotment_stock_order_detail asod ON asod.allotment_stock_order_id = aso.allotment_stock_order_id
									LEFT JOIN allotment_stock_order_detail2 asod2 ON asod2.allotment_stock_order_detail_id = asod.allotment_stock_order_detail_id
									LEFT JOIN allotment_stock_order_detail2_sales asod2m ON asod2m.allotment_stock_order_detail2_id = asod2.allotment_stock_order_detail2_id
									WHERE aso.allotment_stock_order_id = '$temp_id'
									AND convert(nvarchar(36), asod2m.karyawan_sales_id) = '$this->karyawan_sales_id_global'
									GROUP BY asod.sku_id) asod
									on asod.sku_id = bo.sku_id
									LEFT JOIN (SELECT sku_id,
											tahun_kirim,
											sum(qty) AS qty
									FROM simulasi_mps_temp2
									WHERE id = '$temp_id'
										AND tahun_kirim = '$tahun'
									GROUP BY sku_id,
												tahun_kirim) sim 
												ON sim.sku_id = bo.sku_id
									left join sku
									on sku.sku_id = bo.sku_id
									left join principle
									on principle.principle_id = sku.principle_id
									left join principle_brand brand
									on brand.principle_brand_id = sku.principle_brand_id
									where bo.back_order_detail_id is not null
									and bo.sku_id in (select sku_id from allotment_stock_order_detail where allotment_stock_order_id = '$temp_id')
									" . $filter_back_order_str . "
									group by bo.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										sku.principle_id,
										principle.principle_kode,
										sku.principle_brand_id,
										brand.principle_brand_nama,
										ISNULL(sim.qty, 0)
									order by principle.principle_kode, sku.sku_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_allotment_stock_order_detail_temp($temp_id, $tahun, $filter_back_order)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND convert(nvarchar(36), a.back_order_id) IN (" . implode(",", $filter_back_order) . ")";
			}
		} else {
			$filter_back_order_str = " AND convert(nvarchar(36), a.back_order_id) IN ('')";
		}

		$query = $this->db->query("SELECT a.sku_id,
										  sku.sku_kode,
										  sku.sku_nama_produk,
										  SUM(a.sku_qty) AS sku_total_qty,
										  ISNULL(b.qty, 0) AS sku_total_qty_simulasi
									FROM back_order_detail a
									LEFT JOIN
									(SELECT sku_id,
											tahun_kirim,
											SUM(qty) AS qty
									FROM simulasi_mps_temp2
									WHERE id = '$temp_id'
									AND tahun_kirim = '$tahun'
									GROUP BY sku_id, tahun_kirim) b ON b.sku_id = a.sku_id
									LEFT JOIN sku
									ON sku.sku_id = a.sku_id
									WHERE a.back_order_id IS NOT NULL
									and a.sku_id in (select sku_id from allotment_stock_order_detail where allotment_stock_order_id = '$temp_id')
									" . $filter_back_order_str . "
									GROUP BY a.sku_id,
										  sku.sku_kode,
										  sku.sku_nama_produk,
										  ISNULL(b.qty, 0)
									ORDER BY sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_back_order_simulasi_mps($temp_id, $tahun, $bulan, $sku_id, $filter_back_order, $back_order_simulasi)
	{

		$filter_back_order_str = "";
		if (isset($filter_back_order) && count($filter_back_order) > 0) {
			foreach ($filter_back_order as $value) {
				$filter_back_order_str = " AND convert(nvarchar(36), bo.back_order_id) IN (" . implode(",", $filter_back_order) . ")";
			}
		} else {
			$filter_back_order_str = " AND convert(nvarchar(36), bo.back_order_id) IN ('')";
		}

		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['back_order_id'] . "' AS back_order_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, " . $value['sku_qty_bo'] . " AS sku_qty_bo, " . $value['sku_qty'] . " AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}

			$query = $this->db->query("select
										bo.back_order_id,
										bo.back_order_kode,
										'$tahun' as tahun,
										'$bulan' as bulan,
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy') AS back_order_tgl,
										bo_detail.sku_id,
										bo.client_pt_id,
										cust.client_pt_nama,
										SUM(ISNULL(bo_detail.sku_qty, 0)) as sku_qty_bo,
										SUM(ISNULL(bo_detail.sku_qty, 0)) - ISNULL((select SUM(sku_qty) as sku_qty from (" . $table_sementara . ") tempa where back_order_id = bo.back_order_id and sku_id = bo_detail.sku_id and tahun = '$tahun'), 0) as sku_qty_sisa,
										ISNULL(temp.sku_qty, 0) as sku_qty
									from back_order bo
									left join (select back_order_id, sku_id, sum(sku_qty) as sku_qty from back_order_detail group by back_order_id, sku_id) bo_detail
									on bo_detail.back_order_id = bo.back_order_id
									left join (select
													back_order_id,
													sku_id,
													tahun,
													bulan,
													SUM(sku_qty) as sku_qty
												from (" . $table_sementara . ") a
												where tahun = '$tahun' and bulan = '$bulan'
												group by back_order_id,
														sku_id,
														tahun,
														bulan) temp
									on temp.back_order_id = bo_detail.back_order_id
									and temp.sku_id = bo_detail.sku_id
									left join client_pt cust
									on cust.client_pt_id = bo.client_pt_id
									where bo_detail.sku_id = '$sku_id'
									" . $filter_back_order_str . "
									group by bo.back_order_id,
										bo.back_order_kode,
										bo_detail.sku_id,
										YEAR(bo.back_order_tgl),
										MONTH(bo.back_order_tgl),
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy'),
										bo_detail.sku_id,
										bo.client_pt_id,
										cust.client_pt_nama,
										ISNULL(temp.sku_qty, 0)
									order by bo.back_order_kode asc");
		} else {
			$query = $this->db->query("select
										bo.back_order_id,
										bo.back_order_kode,
										'$tahun' as tahun,
										'$bulan' as bulan,
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy') AS back_order_tgl,
										bo_detail.sku_id,
										bo.client_pt_id,
										cust.client_pt_nama,
										SUM(ISNULL(bo_detail.sku_qty, 0)) as sku_qty_bo,
										SUM(ISNULL(bo_detail.sku_qty, 0)) as sku_qty_sisa,
										0 as sku_qty
									from back_order bo
									left join (select back_order_id, sku_id, sum(sku_qty) as sku_qty from back_order_detail group by back_order_id, sku_id) bo_detail
									on bo_detail.back_order_id = bo.back_order_id
									left join client_pt cust
									on cust.client_pt_id = bo.client_pt_id
									where bo_detail.sku_id = '$sku_id'
									" . $filter_back_order_str . "
									group by bo.back_order_id,
										bo.back_order_kode,
										bo_detail.sku_id,
										YEAR(bo.back_order_tgl),
										MONTH(bo.back_order_tgl),
										FORMAT(bo.back_order_tgl, 'dd-MM-yyyy'),
										bo_detail.sku_id,
										bo.client_pt_id,
										cust.client_pt_nama
									order by bo.back_order_kode asc");
		}

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_allotment_stock_order_detail2_by_back_order($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['back_order_id'] . "' AS back_order_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['sku_qty_bo'] . "' AS sku_qty_bo, '" . $value['sku_qty'] . "' AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										b.allotment_stock_order_detail2_id,
										a.allotment_stock_order_detail_id,
										temp.back_order_id,
										temp.sku_id,
										temp.tahun,
										temp.bulan,
										temp.sku_qty_bo,
										temp.sku_qty
									from allotment_stock_order_detail a
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail_id = a.allotment_stock_order_detail_id
									inner join (" . $table_sementara . ") temp
									on temp.sku_id = a.sku_id
									and temp.tahun = b.tahun
									and temp.bulan = b.bulan
									where b.allotment_stock_order_id = '$allotment_stock_order_id' and b.tahun = '$allotment_stock_order_tahun'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function Get_NewID()
	{
		$query = $this->db->query("SELECT NEWID() AS kode");
		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->row(0)->kode;
		}

		return $query;
	}

	public function Get_allotment_stock_order_by_filter($tahun, $perusahaan, $status)
	{

		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = " AND a.client_wms_id = '$perusahaan'";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = " AND a.allotment_stock_order_status = '$status'";
		}

		$query = $this->db->query("SELECT
									a.allotment_stock_order_id,
									a.client_wms_id,
									perusahaan.client_wms_nama,
									a.depo_id,
									a.allotment_stock_order_kode,
									a.allotment_stock_order_tahun,
									ISNULL(a.allotment_stock_order_status, '') AS allotment_stock_order_status,
									a.allotment_stock_order_tgl_create,
									a.allotment_stock_order_who_create,
									a.allotment_stock_order_keterangan,
									a.allotment_stock_order_tgl_update,
									a.allotment_stock_order_who_update
									FROM allotment_stock_order a
									LEFT JOIN client_wms perusahaan
									ON perusahaan.client_wms_id = a.client_wms_id
									WHERE a.allotment_stock_order_tahun = '$tahun' 
									" . $perusahaan . "
									" . $status . "
									ORDER BY a.allotment_stock_order_tahun DESC, a.allotment_stock_order_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_header_by_id($id)
	{
		$query = $this->db->query("SELECT
									allotment_stock_order_id,
									client_wms_id,
									depo_id,
									allotment_stock_order_kode,
									allotment_stock_order_tahun,
									allotment_stock_order_status,
									allotment_stock_order_tgl_create,
									allotment_stock_order_who_create,
									allotment_stock_order_keterangan,
									allotment_stock_order_tgl_update,
									allotment_stock_order_who_update
									FROM allotment_stock_order
									WHERE allotment_stock_order_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_detail_by_id($id)
	{
		$query = $this->db->query("SELECT 
										allotment_stock_order_detail_id,
										allotment_stock_order_id,
										sku_id,
										ISNULL(sku_total_qty, 0) AS sku_total_qty,
										ISNULL(sku_total_qty_simulasi, 0) AS sku_total_qty_simulasi
									FROM allotment_stock_order_detail
									WHERE allotment_stock_order_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_detail2_by_id($id)
	{
		$query = $this->db->query("SELECT 
										id,
										sku_id,
										tahun_kirim,
										bulan_kirim,
										tgl_kirim,
										ISNULL(qty, 0) AS qty
									FROM simulasi_mps_temp2
									WHERE id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_detail3_by_id($id)
	{
		$query = $this->db->query("select
										a.back_order_id,
										sls.karyawan_sales_id,
										c.sku_id,
										b.tahun,
										b.bulan,
										SUM(ISNULL(bo_detail.sku_qty,0)) sku_qty_bo,
										ISNULL(a.sku_qty, 0) sku_qty
									from allotment_stock_order_detail3 a
									left join allotment_stock_order_detail2_sales sls
									on sls.allotment_stock_order_detail2_sales_id = a.allotment_stock_order_detail2_sales_id
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail2_id = sls.allotment_stock_order_detail2_id
									left join allotment_stock_order_detail c
									on c.allotment_stock_order_detail_id = b.allotment_stock_order_detail_id
									left join back_order_detail bo_detail
									on bo_detail.back_order_id = a.back_order_id
									and bo_detail.sku_id = c.sku_id
									where a.allotment_stock_order_id = '$id'
									and sls.karyawan_sales_id = '$this->karyawan_sales_id_global'
									group by a.back_order_id,
											sls.karyawan_sales_id,
											c.sku_id,
											b.tahun,
											b.bulan,
											ISNULL(a.sku_qty, 0)");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_back_order_by_id($id)
	{
		$query = $this->db->query("SELECT 
										a.allotment_stock_order_detail3_id,
										a.allotment_stock_order_detail2_id,
										a.allotment_stock_order_id,
										a.back_order_id,
										bo.client_pt_id,
										ISNULL(a.sku_qty, 0) AS sku_qty
									FROM allotment_stock_order_detail3 a
									left join allotment_stock_order_detail2_sales sls
									on sls.allotment_stock_order_detail2_sales_id = a.allotment_stock_order_detail2_sales_id
									LEFT JOIN back_order bo
									ON bo.back_order_id = a.back_order_id
									WHERE a.allotment_stock_order_id = '$id'
									and sls.karyawan_sales_id = '$this->karyawan_sales_id_global' 
									ORDER BY a.back_order_id ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_back_order_by_customer($client_pt_id)
	{
		$query = $this->db->query("SELECT 
										back_order_id,
										client_pt_id
									FROM back_order
									WHERE client_pt_id = '$client_pt_id'
									ORDER BY back_order_id ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function getPrefixPallet($id)
	{
		return $this->db->select("pj.pallet_jenis_kode")
			->from("tr_mutasi_pallet_draft tmpd")
			->join("tr_mutasi_pallet_detail_draft tmpdd", "tmpd.tr_mutasi_pallet_draft_id = tmpdd.tr_mutasi_pallet_draft_id", "left")
			->join("pallet p", "tmpdd.pallet_id = p.pallet_id", "left")
			->join("pallet_jenis pj", "p.pallet_jenis_id = pj.pallet_jenis_id", "left")
			->where("tmpd.tr_mutasi_pallet_draft_id", $id)->get()->row();

		// return $this->db->last_query();
	}

	public function insert_simulasi_mps_temp2($id, $sku_id, $tahun, $bulan, $tgl_kirim, $qty)
	{

		$id = $id == '' ? null : $id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$tahun = $tahun == '' ? null : $tahun;
		$bulan = $bulan == '' ? null : $bulan;
		$tgl_kirim = $tgl_kirim == '' ? null : $tgl_kirim;
		$qty = $qty == '' ? null : $qty;

		$query = $this->db->query("exec cek_exist_simulasi_mps_temp2 '$id','$sku_id','$tahun','$bulan','$tgl_kirim',$qty");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function update_simulasi_mps_temp2($id, $sku_id, $tahun, $bulan, $tgl_kirim, $qty)
	{

		$id = $id == '' ? null : $id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$tahun = $tahun == '' ? null : $tahun;
		$bulan = $bulan == '' ? null : $bulan;
		$tgl_kirim = $tgl_kirim == '' ? null : $tgl_kirim;
		$qty = $qty == '' ? null : $qty;

		$this->db->set('sku_id', $sku_id);
		$this->db->set('tahun_kirim', $tahun);
		$this->db->set('bulan_kirim', $bulan);
		$this->db->set('tgl_kirim', $tgl_kirim);
		$this->db->set('qty', $qty);
		$this->db->set('id', $id);

		$queryinsert = $this->db->update("simulasi_mps_temp2");

		return $queryinsert;
	}

	public function cek_exist_simulasi_mps_temp2_by_allotment($id)
	{

		$query = $this->db->query("exec cek_exist_simulasi_mps_temp2_by_allotment '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_proses_simulasi_mps($tahun, $sku_id, $temp_id)
	{

		$query = $this->db->query("exec proses_simulasi_mps_sales $tahun, '$sku_id', '$temp_id', '$this->karyawan_sales_id_global'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_simulasi_mps_temp2($allotment_stock_order_id, $tahun, $bulan, $sku_id)
	{

		$query = $this->db->query("select
										a.allotment_stock_order_id as id,
										b.sku_id,
										c.tahun as tahun_kirim,
										c.bulan as bulan_kirim,
										concat(c.tahun,'-',c.bulan,'-01') tgl_kirim,
										isnull(sls.sku_subtotal_qty,0) as qty
									from allotment_stock_order a
									left join allotment_stock_order_detail b
									on b.allotment_stock_order_id = a.allotment_stock_order_id
									left join allotment_stock_order_detail2 c
									on c.allotment_stock_order_detail_id = b.allotment_stock_order_detail_id
									left join allotment_stock_order_detail2_sales sls
									on sls.allotment_stock_order_detail2_id = c.allotment_stock_order_detail2_id
									where a.allotment_stock_order_id = '$allotment_stock_order_id'
									and c.tahun = '$tahun'
									and c.bulan = '$bulan'
									and b.sku_id = '$sku_id'
									and sls.karyawan_sales_id = '$this->karyawan_sales_id_global'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_total_qty_simulasi_mps_temp2($allotment_stock_order_id, $tahun, $bulan, $sku_id)
	{

		$query = $this->db->query("select
										SUM(isnull(sls.sku_subtotal_qty,0)) as qty
									from allotment_stock_order a
									left join allotment_stock_order_detail b
									on b.allotment_stock_order_id = a.allotment_stock_order_id
									left join allotment_stock_order_detail2 c
									on c.allotment_stock_order_detail_id = b.allotment_stock_order_detail_id
									left join allotment_stock_order_detail2_sales sls
									on sls.allotment_stock_order_detail2_id = c.allotment_stock_order_detail2_id
									where a.allotment_stock_order_id = '$allotment_stock_order_id'
									and c.tahun = '$tahun'
									and b.sku_id = '$sku_id'
									and sls.karyawan_sales_id = '$this->karyawan_sales_id_global' ");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_total_qty_simulasi_mps_temp2_not_in_bulan($allotment_stock_order_id, $tahun, $bulan, $sku_id)
	{

		$query = $this->db->query("select sum(isnull(qty,0)) as qty from simulasi_mps_temp2 where id = '$allotment_stock_order_id' and tahun_kirim = '$tahun' and bulan_kirim not in ('$bulan') and sku_id = '$sku_id' ");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_allotment_stock_order_detail3_by_karyawan_sales($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['karyawan_sales_id'] . "' AS karyawan_sales_id, '" . $value['back_order_id'] . "' AS back_order_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['sku_qty'] . "' AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										c.allotment_stock_order_detail2_sales_id,
										b.allotment_stock_order_detail2_id,
										a.allotment_stock_order_detail_id,
										temp.karyawan_sales_id,
										temp.back_order_id,
										temp.sku_id,
										temp.tahun,
										temp.bulan,
										temp.sku_qty
									from allotment_stock_order_detail a
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail_id = a.allotment_stock_order_detail_id
									left join allotment_stock_order_detail2_sales c
									on c.allotment_stock_order_detail2_id = b.allotment_stock_order_detail2_id
									inner join (" . $table_sementara . ") temp
									on temp.sku_id = a.sku_id
									and temp.tahun = b.tahun
									and temp.bulan = b.bulan
									and temp.karyawan_sales_id = c.karyawan_sales_id
									where b.allotment_stock_order_id = '$allotment_stock_order_id' and b.tahun = '$allotment_stock_order_tahun'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function insert_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update)
	{
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$depo_id = $depo_id == '' ? null : $depo_id;
		$client_wms_id = $client_wms_id == '' ? null : $client_wms_id;
		$allotment_stock_order_kode = $allotment_stock_order_kode == '' ? null : $allotment_stock_order_kode;
		$allotment_stock_order_tahun = $allotment_stock_order_tahun == '' ? null : $allotment_stock_order_tahun;
		$allotment_stock_order_status = $allotment_stock_order_status == '' ? null : $allotment_stock_order_status;
		$allotment_stock_order_keterangan = $allotment_stock_order_keterangan == '' ? null : $allotment_stock_order_keterangan;
		$allotment_stock_order_who_create = $allotment_stock_order_who_create == '' ? null : $allotment_stock_order_who_create;
		$allotment_stock_order_tgl_create = $allotment_stock_order_tgl_create == '' ? null : $allotment_stock_order_tgl_create;
		$allotment_stock_order_tgl_update = $allotment_stock_order_tgl_update == '' ? null : $allotment_stock_order_tgl_update;
		$allotment_stock_order_who_update = $allotment_stock_order_who_update == '' ? null : $allotment_stock_order_who_update;

		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('allotment_stock_order_kode', $allotment_stock_order_kode);
		$this->db->set('allotment_stock_order_tahun', $allotment_stock_order_tahun);
		$this->db->set('allotment_stock_order_status', $allotment_stock_order_status);
		$this->db->set('allotment_stock_order_keterangan', $allotment_stock_order_keterangan);
		$this->db->set('allotment_stock_order_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('allotment_stock_order_tgl_create', "GETDATE()", FALSE);
		$this->db->set('allotment_stock_order_tgl_update', "GETDATE()", FALSE);
		$this->db->set('allotment_stock_order_who_update', $this->session->userdata('pengguna_username'));

		$queryinsert = $this->db->insert("allotment_stock_order");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail($allotment_stock_order_detail_id, $allotment_stock_order_id, $sku_id, $sku_total_qty, $sku_total_qty_simulasi)
	{
		$allotment_stock_order_detail_id = $allotment_stock_order_detail_id == '' ? null : $allotment_stock_order_detail_id;
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$sku_total_qty = $sku_total_qty == '' ? null : $sku_total_qty;
		$sku_total_qty_simulasi = $sku_total_qty_simulasi == '' ? null : $sku_total_qty_simulasi;

		$this->db->set('allotment_stock_order_detail_id', $allotment_stock_order_detail_id);
		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_total_qty', $sku_total_qty);
		$this->db->set('sku_total_qty_simulasi', $sku_total_qty_simulasi);

		$queryinsert = $this->db->insert("allotment_stock_order_detail");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail2($allotment_stock_order_id, $allotment_stock_order_tahun)
	{
		$queryinsert = $this->db->query("insert allotment_stock_order_detail2 (
											allotment_stock_order_detail2_id,
											allotment_stock_order_detail_id,
											allotment_stock_order_id,
											tahun,
											bulan,
											sku_subtotal_qty
										)
										select
											newid() as allotment_stock_order_detail2_id,
											b.allotment_stock_order_detail_id,
											a.id as allotment_stock_order_id,
											a.tahun_kirim,
											a.bulan_kirim,
											a.qty
										from simulasi_mps_temp2 a
										left join allotment_stock_order_detail b
										on b.allotment_stock_order_id = a.id
										and b.sku_id = a.sku_id
										where a.id = '$allotment_stock_order_id'
										and a.tahun_kirim = '$allotment_stock_order_tahun' ");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail3($allotment_stock_order_detail3_id, $allotment_stock_order_detail2_sales_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $back_order_id, $sku_qty)
	{
		$allotment_stock_order_detail3_id = $allotment_stock_order_detail3_id == '' ? null : $allotment_stock_order_detail3_id;
		$allotment_stock_order_detail2_sales_id = $allotment_stock_order_detail2_sales_id == '' ? null : $allotment_stock_order_detail2_sales_id;
		$allotment_stock_order_detail2_id = $allotment_stock_order_detail2_id == '' ? null : $allotment_stock_order_detail2_id;
		$allotment_stock_order_detail_id = $allotment_stock_order_detail_id == '' ? null : $allotment_stock_order_detail_id;
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$back_order_id = $back_order_id == '' ? null : $back_order_id;
		$sku_qty = $sku_qty == '' ? null : $sku_qty;

		$this->db->set('allotment_stock_order_detail3_id', $allotment_stock_order_detail3_id);
		$this->db->set('allotment_stock_order_detail2_sales_id', $allotment_stock_order_detail2_sales_id);
		$this->db->set('allotment_stock_order_detail2_id', $allotment_stock_order_detail2_id);
		$this->db->set('allotment_stock_order_detail_id', $allotment_stock_order_detail_id);
		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('back_order_id', $back_order_id);
		$this->db->set('sku_qty', $sku_qty);

		$queryinsert = $this->db->insert("allotment_stock_order_detail3");

		return $queryinsert;
	}

	public function update_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update)
	{
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$depo_id = $depo_id == '' ? null : $depo_id;
		$client_wms_id = $client_wms_id == '' ? null : $client_wms_id;
		$allotment_stock_order_kode = $allotment_stock_order_kode == '' ? null : $allotment_stock_order_kode;
		$allotment_stock_order_tahun = $allotment_stock_order_tahun == '' ? null : $allotment_stock_order_tahun;
		$allotment_stock_order_status = $allotment_stock_order_status == '' ? null : $allotment_stock_order_status;
		$allotment_stock_order_keterangan = $allotment_stock_order_keterangan == '' ? null : $allotment_stock_order_keterangan;
		$allotment_stock_order_who_create = $allotment_stock_order_who_create == '' ? null : $allotment_stock_order_who_create;
		$allotment_stock_order_tgl_create = $allotment_stock_order_tgl_create == '' ? null : $allotment_stock_order_tgl_create;
		$allotment_stock_order_tgl_update = $allotment_stock_order_tgl_update == '' ? null : $allotment_stock_order_tgl_update;
		$allotment_stock_order_who_update = $allotment_stock_order_who_update == '' ? null : $allotment_stock_order_who_update;

		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('allotment_stock_order_kode', $allotment_stock_order_kode);
		$this->db->set('allotment_stock_order_tahun', $allotment_stock_order_tahun);
		$this->db->set('allotment_stock_order_status', $allotment_stock_order_status);
		$this->db->set('allotment_stock_order_keterangan', $allotment_stock_order_keterangan);
		$this->db->set('allotment_stock_order_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('allotment_stock_order_tgl_create', "GETDATE()", FALSE);
		$this->db->set('allotment_stock_order_tgl_update', "GETDATE()", FALSE);
		$this->db->set('allotment_stock_order_who_update', $this->session->userdata('pengguna_username'));
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);

		$queryinsert = $this->db->update("allotment_stock_order");

		return $queryinsert;
	}

	public function delete_allotment_stock_order_detail($allotment_stock_order_id)
	{
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail3");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail2");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$queryinsert = $this->db->delete("allotment_stock_order_detail");

		return $queryinsert;
	}

	public function delete_allotment_stock_order_detail3($allotment_stock_order_id)
	{
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$queryinsert = $this->db->delete("allotment_stock_order_detail3");

		return $queryinsert;
	}

	public function delete_simulasi_mps_temp2_by_allotment_stock_order_id($id)
	{
		$queryinsert = $this->db->query("delete from simulasi_mps_temp2 where id = '$id'");

		return $queryinsert;
	}

	public function delete_simulasi_mps_temp2()
	{
		$queryinsert = $this->db->query("delete from simulasi_mps_temp2 where id not in (select allotment_stock_order_id from allotment_stock_order)");

		return $queryinsert;
	}

	public function delete_all_simulasi_mps_temp2()
	{
		$queryinsert = $this->db->query("delete from simulasi_mps_temp2");

		return $queryinsert;
	}

	public function update_back_order_sales_by_allotment($back_order_id, $sales_id)
	{
		$back_order_id = $back_order_id == '' ? null : $back_order_id;
		$sales_id = $sales_id == '' ? null : $sales_id;

		$this->db->set('sales_id', $sales_id);
		$this->db->set('back_order_tgl_update', "GETDATE()", FALSE);
		$this->db->set('back_order_who_update', $this->session->userdata('pengguna_username'));
		$this->db->where('back_order_id', $back_order_id);

		$queryinsert = $this->db->update("back_order");

		return $queryinsert;
	}

	public function update_back_order_detail_by_allotment($back_order_id, $sku_id, $sku_qty_real)
	{
		$back_order_id = $back_order_id == '' ? null : $back_order_id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$sku_qty_real = $sku_qty_real == '' ? null : $sku_qty_real;

		$queryinsert = $this->db->query("exec update_back_order_detail_by_allotment '$back_order_id', '$sku_id', $sku_qty_real");

		return $queryinsert;
	}
}
