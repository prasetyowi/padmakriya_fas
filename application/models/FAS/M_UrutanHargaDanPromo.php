<?php

class M_UrutanHargaDanPromo extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetDepo()
	{
		$this->db->select("*")
			->from("depo")
			->order_by("depo_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetKonfigurasiKatalog()
	{
		$this->db->select("*")
			->from("sku_katalog_setting")
			->where("depo_id", $this->session->userdata('depo_id'))
			->order_by("sku_katalog_setting_kode");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetUrutanByDepo()
	{
		$this->db->select("*")
			->from("sku_urutan_harga_promo")
			->where("depo_id", $this->session->userdata('depo_id'))
			->order_by("no_urut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function cek_sku_urutan_harga_promo($sku_katalog_setting_id)
	{
		$this->db->select("*")
			->from("sku_urutan_harga_promo")
			->where("sku_katalog_setting_id", $sku_katalog_setting_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function GetUrutanHargaPromoByDepo()
	{
		$this->db->select("*")
			->from("sku_urutan_harga_promo")
			->where("depo_id", $this->session->userdata('depo_id'))
			->order_by("no_urut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetKonfigurasiHeader($sku_katalog_setting_id)
	{
		$query = $this->db->query("SELECT
									hdr.sku_katalog_setting_id,
									hdr.client_wms_id,
									hdr.depo_id,
									hdr.sku_katalog_setting_kode,
									hdr.sku_katalog_setting_keterangan,
									hdr.sku_katalog_setting_status,
									hdr.sku_katalog_setting_who_create,
									FORMAT(hdr.sku_katalog_setting_tgl_create, 'dd-MM-yyyy') AS sku_katalog_setting_tgl_create,
									ISNULL(hdr.sku_katalog_setting_who_approve,'') AS sku_katalog_setting_who_approve,
									ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),'') AS sku_katalog_setting_tgl_approve,
									CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END sku_katalog_setting_is_aktif,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), '') AS tipe_kategori1,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), '') AS tipe_kategori2,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), '') AS tipe_kategori3,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), '') AS tipe_kategori4,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), '') AS tipe_kategori5,
									ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '') AS tipe_kategori6
									FROM sku_katalog_setting hdr
									LEFT JOIN sku_katalog_setting_detail dtl
									ON dtl.sku_katalog_setting_id = hdr.sku_katalog_setting_id
									WHERE hdr.sku_katalog_setting_id = '$sku_katalog_setting_id'
									GROUP BY hdr.sku_katalog_setting_id,
											hdr.client_wms_id,
											hdr.depo_id,
											hdr.sku_katalog_setting_kode,
											hdr.sku_katalog_setting_keterangan,
											hdr.sku_katalog_setting_status,
											hdr.sku_katalog_setting_who_create,
											hdr.sku_katalog_setting_tgl_create,
											ISNULL(hdr.sku_katalog_setting_who_approve,''),
											ISNULL(FORMAT(hdr.sku_katalog_setting_tgl_approve, 'dd-MM-yyyy'),''),
											CASE WHEN hdr.sku_katalog_setting_is_aktif = 1 THEN 'ACTIVE' ELSE 'NOT ACTIVE' END,
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori1), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori2), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori3), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori4), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori5), ''),
											ISNULL(CONVERT(varchar(50), dtl.tipe_kategori6), '')");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetKonfigurasiDetail($sku_katalog_setting_id)
	{
		$query = $this->db->query("SELECT
									sku_katalog_setting_detail,
									sku_katalog_setting_id,
									ISNULL(tipe_kategori1, '') AS tipe_kategori1,
									ISNULL(CONVERT(varchar(50), kategori1_id), '') AS kategori1_id,
									ISNULL(tipe_kategori2, '') AS tipe_kategori2,
									ISNULL(CONVERT(varchar(50), kategori2_id), '') AS kategori2_id,
									ISNULL(tipe_kategori3, '') AS tipe_kategori3,
									ISNULL(CONVERT(varchar(50), kategori3_id), '') AS kategori3_id,
									ISNULL(tipe_kategori4, '') AS tipe_kategori4,
									ISNULL(CONVERT(varchar(50), kategori4_id), '') AS kategori4_id,
									ISNULL(tipe_kategori5, '') AS tipe_kategori5,
									ISNULL(CONVERT(varchar(50), kategori5_id), '') AS kategori5_id,
									ISNULL(tipe_kategori6, '') AS tipe_kategori6,
									ISNULL(CONVERT(varchar(50), kategori6_id), '') AS kategori6_id,
									ISNULL(CONVERT(varchar(50), sku_harga_id), '') AS sku_harga_id,
									ISNULL(CONVERT(varchar(50), sku_promo_id), '') AS sku_promo_id
									FROM sku_katalog_setting_detail
									WHERE sku_katalog_setting_id = '$sku_katalog_setting_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetKeteranganKatalogSetting($sku_katalog_setting_id)
	{
		$query = $this->db->query("SELECT
									CASE WHEN sku_harga_id IS NOT NULL THEN 'Harga' ELSE '' END sku_harga_id,
									CASE WHEN sku_promo_id IS NOT NULL THEN 'Promo' ELSE '' END sku_promo_id
									FROM sku_katalog_setting_detail
									WHERE sku_katalog_setting_id = '$sku_katalog_setting_id'
									GROUP BY CASE WHEN sku_harga_id IS NOT NULL THEN 'Harga' ELSE '' END,
											 CASE WHEN sku_promo_id IS NOT NULL THEN 'Promo' ELSE '' END");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetKategoriByTipeKategori($tipe_kategori, $kategori_id)
	{
		if ($tipe_kategori == "Principle") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Principle' AND kategori_id = '$kategori_id' ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Brand") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Brand' AND kategori_id = '$kategori_id'  ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Category") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Category' AND kategori_id = '$kategori_id'  ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Sub Category") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Sub Category' AND kategori_id = '$kategori_id'  ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Jenis") {
			$query = $this->db->query("select kategori_id, kategori_nama from kategori where kategori_grup = 'Jenis' AND kategori_id = '$kategori_id'  ORDER BY kategori_nama ASC");
		} else if ($tipe_kategori == "Segment1") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '1' AND client_pt_segmen_id = '$kategori_id' ORDER BY client_pt_segmen_nama ASC");
		} else if ($tipe_kategori == "Segment2") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '2' AND client_pt_segmen_id = '$kategori_id' ORDER BY client_pt_segmen_nama ASC");
		} else if ($tipe_kategori == "Segment3") {
			$query = $this->db->query("select client_pt_segmen_id AS kategori_id, client_pt_segmen_nama AS kategori_nama from client_pt_segmen where client_pt_segmen_level = '3' AND client_pt_segmen_id = '$kategori_id' ORDER BY client_pt_segmen_nama ASC");
		} else {
			$query = "";
		}

		if ($query == "") {
			$query = 0;
		} else {

			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result_array();
			}
		}

		return $query;

		// return $this->db->last_query();
	}

	public function insert_sku_urutan_harga_promo($sku_urutan_harga_promo_id, $no_urut, $data)
	{
		$sku_urutan_harga_promo_id = $sku_urutan_harga_promo_id == '' ? null : $sku_urutan_harga_promo_id;
		$no_urut = $no_urut + 1;
		$sku_katalog_setting_id = $data['katalog'] == '' ? null : $data['katalog'];
		$is_perhitungan = $data['perhitungan'] == '' ? null : $data['perhitungan'];

		$this->db->set('sku_urutan_harga_promo_id', $sku_urutan_harga_promo_id);
		$this->db->set('depo_id', $this->session->userdata('depo_id'));
		$this->db->set('no_urut', $no_urut);
		$this->db->set('sku_katalog_setting_id', $sku_katalog_setting_id);
		$this->db->set('is_perhitungan', $is_perhitungan);
		$this->db->set('sku_urutan_harga_promo_who_create', $this->session->userdata('pengguna_username'));
		$this->db->set('sku_urutan_harga_promo_tgl_create', "GETDATE()", FALSE);


		$queryinsert = $this->db->insert("sku_urutan_harga_promo");

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_sku_urutan_harga_promo()
	{
		$this->db->where('depo_id', $this->session->userdata('depo_id'));
		$querydelete = $this->db->delete("sku_urutan_harga_promo");

		return $querydelete;
		// return $this->db->last_query();
	}
}
