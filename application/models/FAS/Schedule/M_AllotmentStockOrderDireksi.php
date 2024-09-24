<?php

use DeepCopy\Filter\Filter;

date_default_timezone_set('Asia/Jakarta');

class M_AllotmentStockOrderDireksi extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
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

		if ($this->session->userdata('client_wms_id') == "") {

			$query_principle = "SELECT a.client_wms_id
								FROM depo_client_wms a
								LEFT JOIN client_WMS b ON a.client_wms_id = b.client_wms_id
								WHERE a.depo_id = '" . $this->session->userdata('depo_id') . "'
								AND b.client_wms_is_aktif = 1
								AND b.client_wms_is_deleted = 0";

			$query = $this->db->query("select
										perusahaan.client_wms_id,
										perusahaan.principle_id,
										principle.principle_kode,
										principle.principle_nama
									from client_wms_principle perusahaan
									left join principle
									on perusahaan.principle_id = principle.principle_id
									where perusahaan.client_wms_id in (" . $query_principle . ")
									and principle.principle_is_aktif = '1'
									order by principle.principle_kode asc");
		} else {

			$query_principle = "SELECT a.client_wms_id
								FROM depo_client_wms a
								LEFT JOIN client_WMS b ON a.client_wms_id = b.client_wms_id
								WHERE a.client_wms_id = '" . $this->session->userdata('client_wms_id') . "'
								AND a.depo_id = '" . $this->session->userdata('depo_id') . "'
								AND b.client_wms_is_aktif = 1
								AND b.client_wms_is_deleted = 0";

			$query = $this->db->query("select
										perusahaan.client_wms_id,
										perusahaan.principle_id,
										principle.principle_kode,
										principle.principle_nama
									from client_wms_principle perusahaan
									left join principle
									on perusahaan.principle_id = principle.principle_id
									where perusahaan.client_wms_id in (" . $query_principle . ")
									and principle.principle_is_aktif = '1'
									order by principle.principle_kode asc");
		}

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

	public function GetDireksiByPerusahaan($perusahaan)
	{

		$query = $this->db->query("select 
										karyawan.karyawan_id,
										karyawan.karyawan_nama,
										divisi.karyawan_divisi_nama as divisi,
										level.karyawan_level_nama as level
									from karyawan
									left join karyawan_divisi divisi
									on divisi.karyawan_divisi_id = karyawan.karyawan_divisi_id
									left join karyawan_level level
									on level.karyawan_level_id = karyawan.karyawan_level_id
									where karyawan.karyawan_level_id = '2EF6D0ED-0BF3-46D6-9B3D-33FC5BA1429F'
									--AND karyawan.client_wms_id = '$perusahaan'
									order by karyawan.karyawan_nama asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_direksi()
	{
		if ($this->session->userdata('karyawan_id') == "") {

			$query = $this->db->query("select 
										karyawan.karyawan_id,
										karyawan.karyawan_nama,
										divisi.karyawan_divisi_nama as divisi,
										level.karyawan_level_nama as level
									from karyawan
									left join karyawan_divisi divisi
									on divisi.karyawan_divisi_id = karyawan.karyawan_divisi_id
									left join karyawan_level level
									on level.karyawan_level_id = karyawan.karyawan_level_id
									where karyawan.karyawan_level_id = '2EF6D0ED-0BF3-46D6-9B3D-33FC5BA1429F'
									and karyawan.karyawan_is_aktif = '1'
									order by karyawan.karyawan_nama asc");
		} else {

			$query = $this->db->query("select 
										karyawan.karyawan_id,
										karyawan.karyawan_nama,
										divisi.karyawan_divisi_nama as divisi,
										level.karyawan_level_nama as level
									from karyawan
									left join karyawan_divisi divisi
									on divisi.karyawan_divisi_id = karyawan.karyawan_divisi_id
									left join karyawan_level level
									on level.karyawan_level_id = karyawan.karyawan_level_id
									where convert(nvarchar(36), karyawan.karyawan_id) = '" . $this->session->userdata('karyawan_id') . "'
									order by karyawan.karyawan_nama asc");
		}

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_karyawan($perusahaan, $filter_karyawan, $direksi)
	{
		$filter_karyawan_str = "";
		if (isset($filter_karyawan) && count($filter_karyawan) > 0) {
			$filter_karyawan_str = " AND karyawan.karyawan_id NOT IN (" . implode(",", $filter_karyawan) . ")";
		}

		$query = $this->db->query("select
										karyawan.karyawan_id,
										karyawan.karyawan_nama,
										divisi.karyawan_divisi_nama as divisi,
										level.karyawan_level_nama as level
									from karyawan
									left join karyawan_divisi divisi
									on divisi.karyawan_divisi_id = karyawan.karyawan_divisi_id
									left join karyawan_level level
									on level.karyawan_level_id = karyawan.karyawan_level_id
									where karyawan.client_wms_id is not null
									AND karyawan.karyawan_is_aktif = '1'
									--AND karyawan.karyawan_supervisor_id = '$direksi'
									--AND karyawan.client_wms_id = '$perusahaan'
									" . $filter_karyawan_str . "
									order by karyawan.karyawan_nama asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_back_order($tahun, $perusahaan, $filter_back_order)
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
									" . $filter_back_order_str . "
									order by bo.back_order_tgl desc, bo.back_order_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_sku_back_order($tahun, $perusahaan, $principle, $filter_sku)
	{

		$filter_sku_str = "";
		if (isset($filter_sku) && count($filter_sku) > 0) {
			foreach ($filter_sku as $value) {
				$filter_sku_str = " AND bod.sku_id NOT IN (" . implode(",", $filter_sku) . ")";
			}
		}

		if ($principle == "") {
			$principle = "";
		} else {
			$principle = " AND sku.principle_id = '$principle'";
		}

		$query = $this->db->query("SELECT bod.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										sku.principle_id,
										principle.principle_kode AS principle,
										sku.principle_brand_id,
										brand.principle_brand_nama AS brand,
										SUM(ISNULL(bod.sku_qty, 0)) AS sku_qty
									FROM back_order bo
									INNER JOIN back_order_detail bod ON bod.back_order_id = bo.back_order_id
									LEFT JOIN sku ON sku.sku_id = bod.sku_id
									LEFT JOIN principle ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand brand ON brand.principle_brand_id = sku.principle_brand_id
									WHERE bo.back_order_id not in (SELECT back_order_id FROM allotment_stock_order_detail3)
									AND bo.back_order_status = 'Approved'
									AND bo.client_wms_id = '$perusahaan'
									" . $principle . "
									" . $filter_sku_str . "
									GROUP BY bod.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											sku.sku_kemasan,
											sku.sku_satuan,
											sku.principle_id,
											principle.principle_kode,
											sku.principle_brand_id,
											brand.principle_brand_nama
									ORDER BY principle.principle_kode, sku.sku_kode ASC");

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

	public function Get_list_allotment_stock_order_detail_summary($temp_id, $tahun, $filter_sku)
	{

		$filter_sku_str = "";
		if (isset($filter_sku) && count($filter_sku) > 0) {
			foreach ($filter_sku as $value) {
				$filter_sku_str = " AND convert(nvarchar(36),bod.sku_id) IN (" . implode(",", $filter_sku) . ")";
			}
		} else {
			$filter_sku_str = " AND convert(nvarchar(36),bod.sku_id) IN ('')";
		}

		$query = $this->db->query("SELECT bod.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										sku.principle_id,
										principle.principle_kode AS principle,
										sku.principle_brand_id,
										brand.principle_brand_nama AS brand,
										SUM(ISNULL(bod.sku_qty, 0)) AS sku_qty,
										ISNULL(sim.qty, 0) as sku_qty_sim
									FROM back_order bo
									INNER JOIN back_order_detail bod ON bod.back_order_id = bo.back_order_id
									LEFT JOIN sku ON sku.sku_id = bod.sku_id
									LEFT JOIN principle ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand brand ON brand.principle_brand_id = sku.principle_brand_id
									LEFT JOIN (SELECT sku_id,
										tahun_kirim,
										sum(qty) AS qty
									FROM simulasi_mps_temp2
									WHERE id = '$temp_id'
									AND tahun_kirim = '$tahun'
									GROUP BY sku_id,
											tahun_kirim) sim 
											ON sim.sku_id = bod.sku_id
									WHERE bo.back_order_status = 'Approved'
									" . $filter_sku_str . "
									GROUP BY bod.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											sku.sku_kemasan,
											sku.sku_satuan,
											sku.principle_id,
											principle.principle_kode,
											sku.principle_brand_id,
											brand.principle_brand_nama,
											ISNULL(sim.qty, 0)
									ORDER BY principle.principle_kode, sku.sku_kode ASC");

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
				$filter_back_order_str = " AND convert(nvarchar(36), bod.sku_id) IN (" . implode(",", $filter_back_order) . ")";
			}
		} else {
			$filter_back_order_str = " AND convert(nvarchar(36), bod.sku_id) IN ('')";
		}

		$query = $this->db->query("SELECT bod.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										SUM(ISNULL(bod.sku_qty, 0)) AS sku_total_qty,
										ISNULL(sim.qty, 0) AS sku_total_qty_simulasi
									FROM back_order bo
									INNER JOIN back_order_detail bod ON bod.back_order_id = bo.back_order_id
									LEFT JOIN (SELECT sku_id,
										tahun_kirim,
										sum(qty) AS qty
									FROM simulasi_mps_temp2
									WHERE id = '$temp_id'
									AND tahun_kirim = '$tahun'
									GROUP BY sku_id,
											tahun_kirim) sim 
											ON sim.sku_id = bod.sku_id
									left join sku on sku.sku_id = bod.sku_id
									WHERE bo.back_order_status = 'Approved' 
									" . $filter_back_order_str . "
									GROUP BY bod.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											ISNULL(sim.qty, 0)
									ORDER BY sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_karyawan_manager_simulasi_mps($temp_id, $tahun, $bulan, $sku_id, $filter_karyawan, $arr_list_karyawan_manager_simulasi)
	{

		$filter_karyawan_str = "";
		if (isset($filter_karyawan) && count($filter_karyawan) > 0) {
			foreach ($filter_karyawan as $value) {
				$filter_karyawan_str = " AND convert(nvarchar(36), a.karyawan_manager_id) IN (" . implode(",", $filter_karyawan) . ")";
			}
		} else {
			$filter_karyawan_str = " AND convert(nvarchar(36), a.karyawan_manager_id) IN ('')";
		}

		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($arr_list_karyawan_manager_simulasi) && count($arr_list_karyawan_manager_simulasi) > 0) {
			foreach ($arr_list_karyawan_manager_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['karyawan_manager_id'] . "' AS karyawan_manager_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, " . $value['sku_qty'] . " AS sku_qty ";

				if ($key < count($arr_list_karyawan_manager_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}

			$query = $this->db->query("select
											karyawan.karyawan_id as karyawan_manager_id,
											karyawan.karyawan_nama,
											divisi.karyawan_divisi_nama as divisi,
											level.karyawan_level_nama as level,
											a.sku_id,
											a.tahun,
											a.bulan,
											SUM(ISNULL(a.sku_qty, 0)) as sku_qty
										from (" . $table_sementara . ") a
										left join karyawan
										on karyawan.karyawan_id = a.karyawan_manager_id
										left join karyawan_divisi divisi
										on divisi.karyawan_divisi_id = karyawan.karyawan_divisi_id
										left join karyawan_level level
										on level.karyawan_level_id = karyawan.karyawan_level_id
										where a.tahun = '$tahun'
										and a.bulan = '$bulan'
										and a.sku_id = '$sku_id'
										" . $filter_karyawan_str . "
										group by karyawan.karyawan_id,
												karyawan.karyawan_nama,
												divisi.karyawan_divisi_nama,
												level.karyawan_level_nama,
												a.sku_id,
												a.tahun,
												a.bulan
										order by karyawan.karyawan_nama asc");
		} else {
			$query = array();
			return $query;
			die;
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

	public function Get_allotment_stock_order_detail2_by_karywan_manager($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['karyawan_manager_id'] . "' AS karyawan_manager_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['sku_qty'] . "' AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										b.allotment_stock_order_detail2_id,
										a.allotment_stock_order_detail_id,
										temp.karyawan_manager_id,
										temp.sku_id,
										temp.tahun,
										temp.bulan,
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

	public function Get_allotment_stock_order_detail2_by_karywan_supervisor($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['karyawan_supervisor_id'] . "' AS karyawan_supervisor_id, '" . $value['karyawan_manager_id'] . "' AS karyawan_manager_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['sku_qty'] . "' AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										c.allotment_stock_order_detail2_manager_id,
										b.allotment_stock_order_detail2_id,
										a.allotment_stock_order_detail_id,
										temp.karyawan_supervisor_id,
										temp.sku_id,
										temp.tahun,
										temp.bulan,
										temp.sku_qty
									from allotment_stock_order_detail a
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail_id = a.allotment_stock_order_detail_id
									left join allotment_stock_order_detail2_manager c
									on c.allotment_stock_order_detail2_id = b.allotment_stock_order_detail2_id
									inner join (" . $table_sementara . ") temp
									on temp.sku_id = a.sku_id
									and temp.tahun = b.tahun
									and temp.bulan = b.bulan
									and temp.karyawan_manager_id = c.karyawan_manager_id
									where b.allotment_stock_order_id = '$allotment_stock_order_id' and b.tahun = '$allotment_stock_order_tahun'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_allotment_stock_order_detail2_by_karyawan_sales($allotment_stock_order_id, $allotment_stock_order_tahun, $back_order_simulasi)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($back_order_simulasi) && count($back_order_simulasi) > 0) {
			foreach ($back_order_simulasi as $key => $value) {

				$table_sementara .= "SELECT '" . $value['karyawan_sales_id'] . "' AS karyawan_sales_id, '" . $value['karyawan_supervisor_id'] . "' AS karyawan_supervisor_id, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['sku_qty'] . "' AS sku_qty ";

				if ($key < count($back_order_simulasi) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										d.allotment_stock_order_detail2_supervisor_id,
										c.allotment_stock_order_detail2_manager_id,
										b.allotment_stock_order_detail2_id,
										a.allotment_stock_order_detail_id,
										temp.karyawan_sales_id,
										temp.sku_id,
										temp.tahun,
										temp.bulan,
										temp.sku_qty
									from allotment_stock_order_detail a
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail_id = a.allotment_stock_order_detail_id
									left join allotment_stock_order_detail2_manager c
									on c.allotment_stock_order_detail2_id = b.allotment_stock_order_detail2_id
									left join allotment_stock_order_detail2_supervisor d
									on d.allotment_stock_order_detail2_manager_id = c.allotment_stock_order_detail2_manager_id
									inner join (" . $table_sementara . ") temp
									on temp.sku_id = a.sku_id
									and temp.tahun = b.tahun
									and temp.bulan = b.bulan
									and temp.karyawan_supervisor_id = d.karyawan_supervisor_id
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
									allotment_stock_order_who_update,
									karyawan_direksi_id
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

	public function Get_allotment_stock_order_detail2_manager_by_id($id)
	{
		$query = $this->db->query("select
										a.karyawan_manager_id,
										c.sku_id,
										b.tahun,
										b.bulan,
										SUM(ISNULL(a.sku_subtotal_qty, 0)) sku_qty
									from allotment_stock_order_detail2_manager a
									left join allotment_stock_order_detail2 b
									on b.allotment_stock_order_detail2_id = a.allotment_stock_order_detail2_id
									left join allotment_stock_order_detail c
									on c.allotment_stock_order_detail_id = b.allotment_stock_order_detail_id
									where a.allotment_stock_order_id = '$id'
									group by a.karyawan_manager_id,
											c.sku_id,
											b.tahun,
											b.bulan");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_detail2_supervisor_by_id($id)
	{
		$query = $this->db->query("select
										a.karyawan_supervisor_id,
										b.karyawan_manager_id,
										d.sku_id,
										a.tahun,
										a.bulan,
										SUM(ISNULL(a.sku_subtotal_qty, 0)) sku_qty
									from allotment_stock_order_detail2_supervisor a
									left join allotment_stock_order_detail2_manager b
									on b.allotment_stock_order_detail2_manager_id = a.allotment_stock_order_detail2_manager_id
									left join allotment_stock_order_detail2 c
									on c.allotment_stock_order_detail2_id = b.allotment_stock_order_detail2_id
									left join allotment_stock_order_detail d
									on d.allotment_stock_order_detail_id = c.allotment_stock_order_detail_id
									where a.allotment_stock_order_id = '$id'
									group by 
										a.karyawan_supervisor_id,
										b.karyawan_manager_id,
										d.sku_id,
										a.tahun,
										a.bulan");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_allotment_stock_order_detail2_sales_by_id($id)
	{
		$query = $this->db->query("select
										a.karyawan_sales_id,
										b.karyawan_supervisor_id,
										d.sku_id,
										a.tahun,
										a.bulan,
										SUM(ISNULL(a.sku_subtotal_qty, 0)) sku_qty
									from allotment_stock_order_detail2_sales a
									left join allotment_stock_order_detail2_supervisor b
									on b.allotment_stock_order_detail2_supervisor_id = a.allotment_stock_order_detail2_supervisor_id
									left join allotment_stock_order_detail2 c
									on c.allotment_stock_order_detail2_id = b.allotment_stock_order_detail2_id
									left join allotment_stock_order_detail d
									on d.allotment_stock_order_detail_id = c.allotment_stock_order_detail_id
									where a.allotment_stock_order_id = '$id'
									group by 
										a.karyawan_sales_id,
										b.karyawan_supervisor_id,
										d.sku_id,
										a.tahun,
										a.bulan");

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
									LEFT JOIN back_order bo
									ON bo.back_order_id = a.back_order_id
									WHERE a.allotment_stock_order_id = '$id'
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

		$query = $this->db->query("exec proses_simulasi_mps $tahun, '$sku_id', '$temp_id'");

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
									id,
									sku_id,
									tahun_kirim,
									bulan_kirim,
									tgl_kirim,
									isnull(qty,0) as qty 
									from simulasi_mps_temp2 
									where id = '$allotment_stock_order_id' 
									and tahun_kirim = '$tahun' 
									and bulan_kirim = '$bulan' 
									and sku_id = '$sku_id' ");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_total_qty_simulasi_mps_temp2($allotment_stock_order_id, $tahun, $bulan, $sku_id)
	{

		$query = $this->db->query("select sum(isnull(qty,0)) as qty from simulasi_mps_temp2 where id = '$allotment_stock_order_id' and tahun_kirim = '$tahun' and sku_id = '$sku_id' ");

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

	public function insert_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update, $karyawan_direksi_id)
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
		$karyawan_direksi_id = $karyawan_direksi_id == '' ? null : $karyawan_direksi_id;

		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('depo_id', $depo_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('allotment_stock_order_kode', $allotment_stock_order_kode);
		$this->db->set('allotment_stock_order_tahun', $allotment_stock_order_tahun);
		$this->db->set('allotment_stock_order_status', $allotment_stock_order_status);
		$this->db->set('allotment_stock_order_keterangan', $allotment_stock_order_keterangan);
		$this->db->set('karyawan_direksi_id', $karyawan_direksi_id);
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
										and a.tahun_kirim = '$allotment_stock_order_tahun'
										and b.allotment_stock_order_detail_id IS NOT NULL ");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail2_manager($allotment_stock_order_detail2_manager_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $karyawan_manager_id, $sku_id, $tahun, $bulan, $sku_subtotal_qty)
	{
		$allotment_stock_order_detail2_manager_id = $allotment_stock_order_detail2_manager_id == '' ? null : $allotment_stock_order_detail2_manager_id;
		$allotment_stock_order_detail2_id = $allotment_stock_order_detail2_id == '' ? null : $allotment_stock_order_detail2_id;
		$allotment_stock_order_detail_id = $allotment_stock_order_detail_id == '' ? null : $allotment_stock_order_detail_id;
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$karyawan_manager_id = $karyawan_manager_id == '' ? null : $karyawan_manager_id;
		$sku_subtotal_qty = $sku_subtotal_qty == '' ? null : $sku_subtotal_qty;

		$this->db->set('allotment_stock_order_detail2_manager_id', $allotment_stock_order_detail2_manager_id);
		$this->db->set('allotment_stock_order_detail2_id', $allotment_stock_order_detail2_id);
		$this->db->set('allotment_stock_order_detail_id', $allotment_stock_order_detail_id);
		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('karyawan_manager_id', $karyawan_manager_id);
		// $this->db->set('sku_id', $sku_id);
		$this->db->set('tahun', $tahun);
		$this->db->set('bulan', $bulan);
		$this->db->set('sku_subtotal_qty', $sku_subtotal_qty);

		$queryinsert = $this->db->insert("allotment_stock_order_detail2_manager");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail2_supervisor($allotment_stock_order_detail2_supervisor_id, $allotment_stock_order_detail2_manager_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $karyawan_supervisor_id, $sku_id, $tahun, $bulan, $sku_subtotal_qty)
	{
		$allotment_stock_order_detail2_supervisor_id = $allotment_stock_order_detail2_supervisor_id == '' ? null : $allotment_stock_order_detail2_supervisor_id;
		$allotment_stock_order_detail2_manager_id = $allotment_stock_order_detail2_manager_id == '' ? null : $allotment_stock_order_detail2_manager_id;
		$allotment_stock_order_detail2_id = $allotment_stock_order_detail2_id == '' ? null : $allotment_stock_order_detail2_id;
		$allotment_stock_order_detail_id = $allotment_stock_order_detail_id == '' ? null : $allotment_stock_order_detail_id;
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$karyawan_supervisor_id = $karyawan_supervisor_id == '' ? null : $karyawan_supervisor_id;
		$tahun = $tahun == '' ? null : $tahun;
		$bulan = $bulan == '' ? null : $bulan;
		$sku_subtotal_qty = $sku_subtotal_qty == '' ? null : $sku_subtotal_qty;

		$this->db->set('allotment_stock_order_detail2_supervisor_id', $allotment_stock_order_detail2_supervisor_id);
		$this->db->set('allotment_stock_order_detail2_manager_id', $allotment_stock_order_detail2_manager_id);
		$this->db->set('allotment_stock_order_detail2_id', $allotment_stock_order_detail2_id);
		$this->db->set('allotment_stock_order_detail_id', $allotment_stock_order_detail_id);
		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('karyawan_supervisor_id', $karyawan_supervisor_id);
		// $this->db->set('sku_id', $sku_id);
		$this->db->set('tahun', $tahun);
		$this->db->set('bulan', $bulan);
		$this->db->set('sku_subtotal_qty', $sku_subtotal_qty);

		$queryinsert = $this->db->insert("allotment_stock_order_detail2_supervisor");

		return $queryinsert;
	}

	public function insert_allotment_stock_order_detail2_sales($allotment_stock_order_detail2_sales_id, $allotment_stock_order_detail2_supervisor_id, $allotment_stock_order_detail2_id, $allotment_stock_order_detail_id, $allotment_stock_order_id, $karyawan_sales_id, $sku_id, $tahun, $bulan, $sku_subtotal_qty)
	{
		$allotment_stock_order_detail2_sales_id = $allotment_stock_order_detail2_sales_id == '' ? null : $allotment_stock_order_detail2_sales_id;
		$allotment_stock_order_detail2_supervisor_id = $allotment_stock_order_detail2_supervisor_id == '' ? null : $allotment_stock_order_detail2_supervisor_id;
		$allotment_stock_order_detail2_id = $allotment_stock_order_detail2_id == '' ? null : $allotment_stock_order_detail2_id;
		$allotment_stock_order_detail_id = $allotment_stock_order_detail_id == '' ? null : $allotment_stock_order_detail_id;
		$allotment_stock_order_id = $allotment_stock_order_id == '' ? null : $allotment_stock_order_id;
		$karyawan_sales_id = $karyawan_sales_id == '' ? null : $karyawan_sales_id;
		$tahun = $tahun == '' ? null : $tahun;
		$bulan = $bulan == '' ? null : $bulan;
		$sku_subtotal_qty = $sku_subtotal_qty == '' ? null : $sku_subtotal_qty;

		$this->db->set('allotment_stock_order_detail2_sales_id', $allotment_stock_order_detail2_sales_id);
		$this->db->set('allotment_stock_order_detail2_supervisor_id', $allotment_stock_order_detail2_supervisor_id);
		$this->db->set('allotment_stock_order_detail2_id', $allotment_stock_order_detail2_id);
		$this->db->set('allotment_stock_order_detail_id', $allotment_stock_order_detail_id);
		$this->db->set('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->set('karyawan_sales_id', $karyawan_sales_id);
		// $this->db->set('sku_id', $sku_id);
		$this->db->set('tahun', $tahun);
		$this->db->set('bulan', $bulan);
		$this->db->set('sku_subtotal_qty', $sku_subtotal_qty);

		$queryinsert = $this->db->insert("allotment_stock_order_detail2_sales");

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

	public function update_allotment_stock_order($allotment_stock_order_id, $depo_id, $client_wms_id, $allotment_stock_order_kode, $allotment_stock_order_tahun, $allotment_stock_order_status, $allotment_stock_order_keterangan, $allotment_stock_order_who_create, $allotment_stock_order_tgl_create, $allotment_stock_order_tgl_update, $allotment_stock_order_who_update, $karyawan_direksi_id)
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
		$karyawan_direksi_id = $karyawan_direksi_id == '' ? null : $karyawan_direksi_id;

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
		$this->db->set('karyawan_direksi_id', $karyawan_direksi_id);
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);

		$queryinsert = $this->db->update("allotment_stock_order");

		return $queryinsert;
	}

	public function delete_allotment_stock_order_detail($allotment_stock_order_id)
	{
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail3");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail2_sales");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail2_supervisor");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail2_manager");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$this->db->delete("allotment_stock_order_detail2");

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$queryinsert = $this->db->delete("allotment_stock_order_detail");

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

	public function delete_simulasi_mps_temp2_by_sku_id($allotment_stock_order_id, $sku_id)
	{
		$this->db->where('sku_id', $sku_id);
		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$queryinsert = $this->db->delete("simulasi_mps_temp2");

		return $queryinsert;
	}

	public function delete_allotment_stock_order_detail2_sales($allotment_stock_order_id)
	{

		$this->db->where('allotment_stock_order_id', $allotment_stock_order_id);
		$queryinsert = $this->db->delete("allotment_stock_order_detail2_sales");

		return $queryinsert;
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
}
