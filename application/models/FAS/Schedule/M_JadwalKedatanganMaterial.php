<?php

use DeepCopy\Filter\Filter;

date_default_timezone_set('Asia/Jakarta');

class M_JadwalKedatanganMaterial extends CI_Model
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

	public function cek_production_schedule($production_schedule_tahun, $client_wms_id, $principle_id)
	{

		$query = $this->db->query("SELECT * FROM production_schedule WHERE production_schedule_tahun = '$production_schedule_tahun' and client_wms_id = '$client_wms_id' and principle_id = '$principle_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}


	public function Get_list_data_sku($principle_id, $filter_sku)
	{

		$filter_sku_str = "";
		if (isset($filter_sku) && count($filter_sku) > 0) {
			foreach ($filter_sku as $value) {
				$filter_sku_str = " AND sku.sku_id NOT IN (" . implode(",", $filter_sku) . ")";
			}
		}

		$query = $this->db->query("select
										sku.sku_id,
										sku.sku_induk_id,
										sku_induk.sku_induk_nama,
										principle.principle_kode as principle,
										brand.principle_brand_nama as brand,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										ISNULL(sku.sku_harga_jual,0) as sku_harga_jual
									from sku
									left join sku_induk
									on sku_induk.sku_induk_id = sku.sku_induk_id
									left join principle
									on principle.principle_id = sku.principle_id
									left join principle_brand brand
									on brand.principle_brand_id = sku.principle_brand_id
									where convert(nvarchar(36),principle.principle_id) = '$principle_id'
									" . $filter_sku_str . "
									order by principle.principle_kode, brand.principle_brand_nama,sku.sku_kode asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_list_data_sku_back_order($tahun, $principle_id, $filter_sku)
	{

		$filter_sku_str = "";
		if (isset($filter_sku) && count($filter_sku) > 0) {
			foreach ($filter_sku as $value) {
				$filter_sku_str = " AND sku.sku_id NOT IN (" . implode(",", $filter_sku) . ")";
			}
		}

		$query = $this->db->query("SELECT sku.sku_id,
										sku.sku_induk_id,
										sku_induk.sku_induk_nama,
										principle.principle_kode AS principle,
										brand.principle_brand_nama AS brand,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										ISNULL(sku.sku_harga_jual, 0) AS sku_harga_jual,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '1' THEN bod.sku_qty ELSE 0 END) sku_qty_1,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '2' THEN bod.sku_qty ELSE 0 END) sku_qty_2,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '3' THEN bod.sku_qty ELSE 0 END) sku_qty_3,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '4' THEN bod.sku_qty ELSE 0 END) sku_qty_4,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '5' THEN bod.sku_qty ELSE 0 END) sku_qty_5,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '6' THEN bod.sku_qty ELSE 0 END) sku_qty_6,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '7' THEN bod.sku_qty ELSE 0 END) sku_qty_7,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '8' THEN bod.sku_qty ELSE 0 END) sku_qty_8,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '9' THEN bod.sku_qty ELSE 0 END) sku_qty_9,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '10' THEN bod.sku_qty ELSE 0 END) sku_qty_10,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '11' THEN bod.sku_qty ELSE 0 END) sku_qty_11,
										SUM(CASE WHEN MONTH(bo.back_order_tgl) = '12' THEN bod.sku_qty ELSE 0 END) sku_qty_12
									FROM back_order bo
									LEFT JOIN back_order_detail bod ON bo.back_order_id = bod.back_order_id 
									LEFT JOIN sku ON bod.sku_id = sku.sku_id
									LEFT JOIN sku_induk ON sku_induk.sku_induk_id = sku.sku_induk_id
									LEFT JOIN principle ON principle.principle_id = sku.principle_id
									LEFT JOIN principle_brand brand ON brand.principle_brand_id = sku.principle_brand_id
									WHERE YEAR(bo.back_order_tgl) = '$tahun'
									AND bo.back_order_status = 'Approved'
									AND convert(nvarchar(36), principle.principle_id) = '$principle_id'
									" . $filter_sku_str . "
									GROUP BY sku.sku_id,
										sku.sku_induk_id,
										sku_induk.sku_induk_nama,
										principle.principle_kode,
										brand.principle_brand_nama,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_kemasan,
										sku.sku_satuan,
										ISNULL(sku.sku_harga_jual, 0)
									ORDER BY principle.principle_kode,
											brand.principle_brand_nama,
											sku.sku_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function set_sku_stock_exp_date_default($detail)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $key => $value) {

				$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_jumlah_barang'] . "' AS sku_jumlah_barang, '" . $value['sku_harga'] . "' AS sku_harga, '" . $value['sku_diskon_percent'] . "' AS sku_diskon_percent, '" . $value['sku_diskon_rp'] . "' AS sku_diskon_rp,'" . $value['sku_harga_total'] . "' AS sku_harga_total,'" . $value['sku_exp_date'] . "' AS sku_exp_date,'" . $value['is_default_sku_exp_date'] . "' AS is_default_sku_exp_date ";

				if ($key < count($detail) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		$query = $this->db->query("select
										sku_id,
										sku_harga,
										sku_jumlah_barang,
										sku_diskon_percent,
										sku_diskon_rp,
										sku_harga_total,
										CASE WHEN ISNULL(sku_exp_date,'') = '' THEN (select top 1 FORMAT(DATEADD(month, s.sku_minimum_expired_date, GETDATE()),'yyyy-MM-dd') as sku_minimum_expired_date from sku s where s.sku_id = a.sku_id) ELSE sku_exp_date END sku_exp_date,
										CASE WHEN ISNULL(sku_exp_date,'') = '' THEN '1' ELSE '0' END is_default_sku_exp_date
									from (" . $table_sementara . ") a");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function set_list_production_schedule_detail($detail, $detail2)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		$table_sementara2 = "";

		if (isset($detail) && count($detail) > 0) {

			if (isset($detail2) && count($detail2) > 0) {
				foreach ($detail as $key => $value) {

					$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_jumlah_barang'] . "' AS sku_jumlah_barang, '" . $value['sku_harga'] . "' AS sku_harga, '" . $value['sku_diskon_percent'] . "' AS sku_diskon_percent, '" . $value['sku_diskon_rp'] . "' AS sku_diskon_rp,'" . $value['sku_harga_total'] . "' AS sku_harga_total,'" . $value['sku_exp_date'] . "' AS sku_exp_date,'" . $value['is_default_sku_exp_date'] . "' AS is_default_sku_exp_date, '" . $value['is_error'] . "' AS is_error ";

					if ($key < count($detail) - 1) {
						$table_sementara .= $union;
					}
				}

				foreach ($detail2 as $key => $value) {

					$table_sementara2 .= "SELECT '" . $value['idx'] . "' AS idx, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, " . $value['qty'] . " AS qty ";

					if ($key < count($detail2) - 1) {
						$table_sementara2 .= $union;
					}
				}

				$query = $this->db->query("select
										a.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_satuan,
										sku.sku_kemasan,
										a.sku_harga,
										a.sku_jumlah_barang,
										a.sku_diskon_percent,
										a.sku_diskon_rp,
										a.sku_harga_total,
										a.sku_exp_date,
										a.is_default_sku_exp_date,
										a.is_error,
										case when a.sku_jumlah_barang = b.qty then '1' else '0' end as is_cocok
									from (" . $table_sementara . ") a
									left join (select sku_id, sum(qty) as qty from (" . $table_sementara2 . ") tabel group by sku_id) b
									on b.sku_id = a.sku_id
									left join sku
									on sku.sku_id = a.sku_id");

				if ($query->num_rows() == 0) {
					$query = array();
				} else {
					$query = $query->result_array();
				}
			} else {
				foreach ($detail as $key => $value) {

					$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_jumlah_barang'] . "' AS sku_jumlah_barang, '" . $value['sku_harga'] . "' AS sku_harga, '" . $value['sku_diskon_percent'] . "' AS sku_diskon_percent, '" . $value['sku_diskon_rp'] . "' AS sku_diskon_rp,'" . $value['sku_harga_total'] . "' AS sku_harga_total,'" . $value['sku_exp_date'] . "' AS sku_exp_date,'" . $value['is_default_sku_exp_date'] . "' AS is_default_sku_exp_date, '" . $value['is_error'] . "' AS is_error ";

					if ($key < count($detail) - 1) {
						$table_sementara .= $union;
					}
				}

				$query = $this->db->query("select
										a.sku_id,
										sku.sku_kode,
										sku.sku_nama_produk,
										sku.sku_satuan,
										sku.sku_kemasan,
										a.sku_harga,
										a.sku_jumlah_barang,
										a.sku_diskon_percent,
										a.sku_diskon_rp,
										a.sku_harga_total,
										a.sku_exp_date,
										a.is_default_sku_exp_date,
										a.is_error,
										'0' as is_cocok
									from (" . $table_sementara . ") a
									left join sku
									on sku.sku_id = a.sku_id");

				if ($query->num_rows() == 0) {
					$query = array();
				} else {
					$query = $query->result_array();
				}
			}
		} else {
			$query = array();
		}

		return $query;
	}

	public function set_list_production_schedule_detail2($sku_id, $detail)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $key => $value) {

				$table_sementara .= "SELECT '" . $value['idx'] . "' AS idx, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, '" . $value['qty'] . "' AS qty ";

				if ($key < count($detail) - 1) {
					$table_sementara .= $union;
				}
			}

			$query = $this->db->query("select
									idx,
									sku_id,
									tahun,
									bulan,
									qty
									from (" . $table_sementara . ") a
									where sku_id = '$sku_id'
									order by CAST(ISNULL(bulan,0) AS int) asc");

			if ($query->num_rows() == 0) {
				$query = array();
			} else {
				$query = $query->result_array();
			}
		} else {
			$query = array();
		}

		return $query;
	}

	public function cek_list_production_schedule_detail2($detail, $detail2)
	{
		$union = " UNION ALL ";
		$table_sementara = "";
		$table_sementara2 = "";

		if (isset($detail) && count($detail) > 0) {
			foreach ($detail as $key => $value) {

				$table_sementara .= "SELECT '" . $value['sku_id'] . "' AS sku_id, '" . $value['sku_jumlah_barang'] . "' AS sku_jumlah_barang, '" . $value['sku_harga'] . "' AS sku_harga, '" . $value['sku_diskon_percent'] . "' AS sku_diskon_percent, '" . $value['sku_diskon_rp'] . "' AS sku_diskon_rp,'" . $value['sku_harga_total'] . "' AS sku_harga_total,'" . $value['sku_exp_date'] . "' AS sku_exp_date,'" . $value['is_default_sku_exp_date'] . "' AS is_default_sku_exp_date, '" . $value['is_error'] . "' AS is_error ";

				if ($key < count($detail) - 1) {
					$table_sementara .= $union;
				}
			}
		}

		if (isset($detail2) && count($detail2) > 0) {
			foreach ($detail2 as $key => $value) {

				$table_sementara2 .= "SELECT '" . $value['idx'] . "' AS idx, '" . $value['sku_id'] . "' AS sku_id, '" . $value['tahun'] . "' AS tahun, '" . $value['bulan'] . "' AS bulan, " . $value['qty'] . " AS qty ";

				if ($key < count($detail2) - 1) {
					$table_sementara2 .= $union;
				}
			}
		}

		$query = $this->db->query("select
									a.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_satuan,
									sku.sku_kemasan,
									CASE WHEN b.sku_id IS NOT NULL THEN '1' ELSE '0' END is_cek,
									CASE WHEN a.sku_jumlah_barang = SUM(b.qty) THEN '1' ELSE '0' END is_qty_cek
									from (" . $table_sementara . ") a
									left join (" . $table_sementara2 . ") b
									on b.sku_id = a.sku_id
									left join sku
									on sku.sku_id = a.sku_id
									GROUP BY a.sku_id,
											sku.sku_kode,
											sku.sku_nama_produk,
											sku.sku_satuan,
											sku.sku_kemasan,
											a.sku_jumlah_barang,
											CASE
												WHEN b.sku_id IS NOT NULL THEN '1'
												ELSE '0'
											END");

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

	public function GetJumlahBayarDO($tanggal, $perusahaan)
	{
		$query = $this->db->query("SELECT principle.principle_id,
										ISNULL(principle.principle_kode, 'UNKNOWN') AS principle_kode,
										ISNULL(client_wms_rek_detail.nama_bank, '') AS nama_bank,
										ISNULL(client_wms_rek_detail.no_rekening, '') AS no_rekening,
										SUM(do.delivery_order_jumlah_bayar) AS delivery_order_jumlah_bayar
									FROM delivery_order DO
									LEFT JOIN delivery_order_detail do_dtl ON do_dtl.delivery_order_id = do.delivery_order_id
									LEFT JOIN sku ON sku.sku_id = do_dtl.sku_id
									LEFT JOIN principle ON principle.principle_id = sku.principle_id
									LEFT JOIN client_wms_rek ON client_wms_rek.client_wms_id = do.client_wms_id
									LEFT JOIN client_wms_rek_detail ON client_wms_rek_detail.client_wms_rek_id = client_wms_rek.client_wms_rek_id
									AND client_wms_rek_detail.principle_id = principle.principle_id
									AND convert(nvarchar(36), client_wms_rek_detail.depo_id) = '" . $this->session->userdata('depo_id') . "'
									WHERE FORMAT(do.delivery_order_tgl_aktual_kirim,'yyyy-MM-dd') = '$tanggal'
									AND convert(nvarchar(36), do.depo_id) = '" . $this->session->userdata('depo_id') . "'
									AND convert(nvarchar(36), do.client_wms_id) = '$perusahaan'
									GROUP BY principle.principle_id,
											ISNULL(principle.principle_kode, 'UNKNOWN'),
											ISNULL(client_wms_rek_detail.nama_bank, ''),
											ISNULL(client_wms_rek_detail.no_rekening, '')
									ORDER BY ISNULL(principle.principle_kode, 'UNKNOWN') ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function Get_production_schedule_by_filter($tahun, $perusahaan, $status)
	{

		if ($perusahaan == "") {
			$perusahaan = "";
		} else {
			$perusahaan = " AND a.client_wms_id = '$perusahaan'";
		}

		if ($status == "") {
			$status = "";
		} else {
			$status = " AND a.production_schedule_status = '$status'";
		}

		$query = $this->db->query("SELECT
									a.production_schedule_id,
									a.client_wms_id,
									perusahaan.client_wms_nama,
									a.principle_id,
									principle.principle_kode as principle,
									a.depo_id,
									a.production_schedule_kode,
									FORMAT(a.production_schedule_tgl, 'dd-MM-yyyy') AS production_schedule_tgl,
									a.production_schedule_tahun,
									ISNULL(a.production_schedule_status, '') AS production_schedule_status,
									a.production_schedule_tgl_create,
									a.production_schedule_who_create,
									a.production_schedule_keterangan,
									a.production_schedule_tgl_update,
									a.production_schedule_who_update
									FROM production_schedule a
									LEFT JOIN principle
									ON principle.principle_id = a.principle_id
									LEFT JOIN client_wms perusahaan
									ON perusahaan.client_wms_id = a.client_wms_id
									WHERE a.production_schedule_tahun = '$tahun' 
									" . $perusahaan . "
									" . $status . "
									ORDER BY a.production_schedule_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function proses_view_jadwal_kedatangan($id)
	{

		$query = $this->db->query("exec proses_view_jadwal_kedatangan '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_production_schedule_header_by_id($id)
	{
		$query = $this->db->query("SELECT
									production_schedule_id,
									client_wms_id,
									principle_id,
									depo_id,
									production_schedule_kode,
									FORMAT(production_schedule_tgl, 'yyyy-MM-dd') AS production_schedule_tgl,
									production_schedule_tahun,
									production_schedule_status,
									production_schedule_tgl_create,
									production_schedule_who_create,
									production_schedule_keterangan,
									production_schedule_tgl_update,
									production_schedule_who_update
									FROM production_schedule
									WHERE production_schedule_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_production_schedule_detail_by_id($id)
	{
		$query = $this->db->query("SELECT 
										production_schedule_detail_id,
										production_schedule_id,
										sku_id,
										ISNULL(sku_jumlah_barang, 0) AS sku_jumlah_barang,
										ISNULL(sku_harga, 0) AS sku_harga,
										ISNULL(sku_diskon_percent, 0) AS sku_diskon_percent,
										ISNULL(sku_diskon_rp, 0) AS sku_diskon_rp,
										ISNULL(sku_harga_total, 0) AS sku_harga_total,
										sku_exp_date
									FROM production_schedule_detail
									WHERE production_schedule_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_production_schedule_detail2_by_id($id)
	{
		$query = $this->db->query("SELECT 
										production_schedule_detail2_id,
										production_schedule_id,
										sku_id,
										ISNULL(sku_jumlah_barang, 0) AS sku_jumlah_barang,
										ISNULL(sku_harga, 0) AS sku_harga,
										ISNULL(sku_diskon_percent, 0) AS sku_diskon_percent,
										ISNULL(sku_diskon_rp, 0) AS sku_diskon_rp,
										ISNULL(sku_harga_total, 0) AS sku_harga_total,
										sku_exp_date
									FROM production_schedule_detail2
									WHERE production_schedule_id = '$id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_production_schedule_detail3_by_id($id)
	{
		$query = $this->db->query("SELECT 
										production_schedule_detail3_id,
										production_schedule_detail2_id,
										production_schedule_id,
										sku_id,
										ISNULL(tahun, '') AS tahun,
										ISNULL(bulan, '') AS bulan,
										ISNULL(qty, 0) AS qty
									FROM production_schedule_detail3
									WHERE production_schedule_id = '$id'
									ORDER BY production_schedule_detail2_id ASC");

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

	public function insert_production_schedule($production_schedule_id, $depo_id, $principle_id, $client_wms_id, $production_schedule_kode, $production_schedule_tgl, $production_schedule_tahun, $production_schedule_status, $production_schedule_keterangan, $production_schedule_who_create, $production_schedule_tgl_create, $production_schedule_tgl_update, $production_schedule_who_update)
	{
		$production_schedule_id = $production_schedule_id == '' ? null : $production_schedule_id;
		$depo_id = $depo_id == '' ? null : $depo_id;
		$principle_id = $principle_id == '' ? null : $principle_id;
		$client_wms_id = $client_wms_id == '' ? null : $client_wms_id;
		$production_schedule_kode = $production_schedule_kode == '' ? null : $production_schedule_kode;
		$production_schedule_tgl = $production_schedule_tgl == '' ? null : $production_schedule_tgl;
		$production_schedule_tahun = $production_schedule_tahun == '' ? null : $production_schedule_tahun;
		$production_schedule_status = $production_schedule_status == '' ? null : $production_schedule_status;
		$production_schedule_keterangan = $production_schedule_keterangan == '' ? null : $production_schedule_keterangan;
		$production_schedule_who_create = $production_schedule_who_create == '' ? null : $production_schedule_who_create;
		$production_schedule_tgl_create = $production_schedule_tgl_create == '' ? null : $production_schedule_tgl_create;
		$production_schedule_tgl_update = $production_schedule_tgl_update == '' ? null : $production_schedule_tgl_update;
		$production_schedule_who_update = $production_schedule_who_update == '' ? null : $production_schedule_who_update;

		$this->db->set('production_schedule_id', $production_schedule_id);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('principle_id', $principle_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('production_schedule_kode', $production_schedule_kode);
		$this->db->set('production_schedule_tgl', $production_schedule_tgl);
		$this->db->set('production_schedule_tahun', $production_schedule_tahun);
		$this->db->set('production_schedule_status', $production_schedule_status);
		$this->db->set('production_schedule_keterangan', $production_schedule_keterangan);
		$this->db->set('production_schedule_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('production_schedule_tgl_create', "GETDATE()", FALSE);
		$this->db->set('production_schedule_tgl_update', "GETDATE()", FALSE);
		$this->db->set('production_schedule_who_update', $this->session->userdata('pengguna_username'));

		$queryinsert = $this->db->insert("production_schedule");

		return $queryinsert;
	}

	public function insert_production_schedule_detail($production_schedule_detail_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date)
	{
		$production_schedule_detail_id = $production_schedule_detail_id == '' ? null : $production_schedule_detail_id;
		$production_schedule_id = $production_schedule_id == '' ? null : $production_schedule_id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$sku_jumlah_barang = $sku_jumlah_barang == '' ? 0 : $sku_jumlah_barang;
		$sku_harga = $sku_harga == '' ? 0 : $sku_harga;
		$sku_diskon_percent = $sku_diskon_percent == '' ? 0 : $sku_diskon_percent;
		$sku_diskon_rp = $sku_diskon_rp == '' ? 0 : $sku_diskon_rp;
		$sku_harga_total = $sku_harga_total == '' ? 0 : $sku_harga_total;
		$sku_exp_date = $sku_exp_date == '' ? null : $sku_exp_date;

		$this->db->set('production_schedule_detail_id', $production_schedule_detail_id);
		$this->db->set('production_schedule_id', $production_schedule_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_jumlah_barang', $sku_jumlah_barang);
		$this->db->set('sku_harga', $sku_harga);
		$this->db->set('sku_diskon_percent', $sku_diskon_percent);
		$this->db->set('sku_diskon_rp', $sku_diskon_rp);
		$this->db->set('sku_harga_total', $sku_harga_total);
		$this->db->set('sku_exp_date', $sku_exp_date);

		$queryinsert = $this->db->insert("production_schedule_detail");

		return $queryinsert;
	}

	public function insert_production_schedule_detail2($production_schedule_detail2_id, $production_schedule_id, $sku_id, $sku_jumlah_barang, $sku_harga, $sku_diskon_percent, $sku_diskon_rp, $sku_harga_total, $sku_exp_date)
	{
		$production_schedule_detail2_id = $production_schedule_detail2_id == '' ? null : $production_schedule_detail2_id;
		$production_schedule_id = $production_schedule_id == '' ? null : $production_schedule_id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$sku_jumlah_barang = $sku_jumlah_barang == '' ? 0 : $sku_jumlah_barang;
		$sku_harga = $sku_harga == '' ? 0 : $sku_harga;
		$sku_diskon_percent = $sku_diskon_percent == '' ? 0 : $sku_diskon_percent;
		$sku_diskon_rp = $sku_diskon_rp == '' ? 0 : $sku_diskon_rp;
		$sku_harga_total = $sku_harga_total == '' ? 0 : $sku_harga_total;
		$sku_exp_date = $sku_exp_date == '' ? null : $sku_exp_date;

		$this->db->set('production_schedule_detail2_id', $production_schedule_detail2_id);
		$this->db->set('production_schedule_id', $production_schedule_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('sku_jumlah_barang', $sku_jumlah_barang);
		$this->db->set('sku_harga', $sku_harga);
		$this->db->set('sku_diskon_percent', $sku_diskon_percent);
		$this->db->set('sku_diskon_rp', $sku_diskon_rp);
		$this->db->set('sku_harga_total', $sku_harga_total);
		$this->db->set('sku_exp_date', $sku_exp_date);

		$queryinsert = $this->db->insert("production_schedule_detail2");

		$getKonversiKomposite = $this->db->select("sku_konversi_faktor")->from('sku')->where('sku_id', $sku_id)->get()->row();

		//insert ke table konversi_temp
		$this->db->set("sku_konversi_temp_id", $production_schedule_id);
		$this->db->set("sku_id", $sku_id);
		$this->db->set("sku_expired_date", $sku_exp_date);
		$this->db->set("sku_qty", $sku_jumlah_barang);
		$this->db->set("sku_qty_composite", $sku_jumlah_barang * $getKonversiKomposite->sku_konversi_faktor);
		$this->db->set("sku_qty_composite", $sku_jumlah_barang * $getKonversiKomposite->sku_konversi_faktor);
		// $this->db->set("batch_no", $value->batch_no);

		$this->db->insert("sku_konversi_temp");


		return $queryinsert;
	}

	public function insert_production_schedule_detail3($production_schedule_detail3_id, $production_schedule_detail2_id, $production_schedule_id, $sku_id, $bulan, $tahun, $qty)
	{
		$production_schedule_detail3_id = $production_schedule_detail3_id == '' ? null : $production_schedule_detail3_id;
		$production_schedule_detail2_id = $production_schedule_detail2_id == '' ? null : $production_schedule_detail2_id;
		$production_schedule_id = $production_schedule_id == '' ? null : $production_schedule_id;
		$sku_id = $sku_id == '' ? null : $sku_id;
		$bulan = $bulan == '' ? null : $bulan;
		$tahun = $tahun == '' ? null : $tahun;
		$qty = $qty == '' ? 0 : $qty;

		$this->db->set('production_schedule_detail3_id', $production_schedule_detail3_id);
		$this->db->set('production_schedule_detail2_id', $production_schedule_detail2_id);
		$this->db->set('production_schedule_id', $production_schedule_id);
		$this->db->set('sku_id', $sku_id);
		$this->db->set('bulan', $bulan);
		$this->db->set('tahun', $tahun);
		$this->db->set('qty', $qty);

		$queryinsert = $this->db->insert("production_schedule_detail3");

		return $queryinsert;
	}

	public function update_production_schedule($production_schedule_id, $depo_id, $principle_id, $client_wms_id, $production_schedule_kode, $production_schedule_tgl, $production_schedule_tahun, $production_schedule_status, $production_schedule_keterangan, $production_schedule_who_create, $production_schedule_tgl_create, $production_schedule_tgl_update, $production_schedule_who_update)
	{
		$production_schedule_id = $production_schedule_id == '' ? null : $production_schedule_id;
		$depo_id = $depo_id == '' ? null : $depo_id;
		$principle_id = $principle_id == '' ? null : $principle_id;
		$client_wms_id = $client_wms_id == '' ? null : $client_wms_id;
		$production_schedule_kode = $production_schedule_kode == '' ? null : $production_schedule_kode;
		$production_schedule_tgl = $production_schedule_tgl == '' ? null : $production_schedule_tgl;
		$production_schedule_tahun = $production_schedule_tahun == '' ? null : $production_schedule_tahun;
		$production_schedule_status = $production_schedule_status == '' ? null : $production_schedule_status;
		$production_schedule_keterangan = $production_schedule_keterangan == '' ? null : $production_schedule_keterangan;
		$production_schedule_who_create = $production_schedule_who_create == '' ? null : $production_schedule_who_create;
		$production_schedule_tgl_create = $production_schedule_tgl_create == '' ? null : $production_schedule_tgl_create;
		$production_schedule_tgl_update = $production_schedule_tgl_update == '' ? null : $production_schedule_tgl_update;
		$production_schedule_who_update = $production_schedule_who_update == '' ? null : $production_schedule_who_update;

		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('principle_id', $principle_id);
		$this->db->set('client_wms_id', $client_wms_id);
		$this->db->set('production_schedule_kode', $production_schedule_kode);
		$this->db->set('production_schedule_tgl', $production_schedule_tgl);
		$this->db->set('production_schedule_tahun', $production_schedule_tahun);
		$this->db->set('production_schedule_status', $production_schedule_status);
		$this->db->set('production_schedule_keterangan', $production_schedule_keterangan);
		$this->db->set('production_schedule_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('production_schedule_tgl_create', "GETDATE()", FALSE);
		$this->db->set('production_schedule_tgl_update', "GETDATE()", FALSE);
		$this->db->set('production_schedule_who_update', $this->session->userdata('pengguna_username'));
		$this->db->where('production_schedule_id', $production_schedule_id);

		$queryinsert = $this->db->update("production_schedule");

		return $queryinsert;
	}

	public function delete_production_schedule_detail($production_schedule_id)
	{
		$this->db->where('production_schedule_id', $production_schedule_id);
		$queryinsert = $this->db->delete("production_schedule_detail");

		return $queryinsert;
	}

	public function delete_production_schedule_detail2($production_schedule_id)
	{
		$this->db->where('production_schedule_id', $production_schedule_id);
		$queryinsert = $this->db->delete("production_schedule_detail2");

		return $queryinsert;
	}

	public function delete_production_schedule_detail3($production_schedule_id)
	{
		$this->db->where('production_schedule_id', $production_schedule_id);
		$queryinsert = $this->db->delete("production_schedule_detail3");

		return $queryinsert;
	}
}
