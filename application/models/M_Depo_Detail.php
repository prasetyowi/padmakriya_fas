<?php

class M_Depo_Detail extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function Getdepo_detail_by_stock_type_kode($stock_type_kode)
	{
		$this->db->select("depo_detail_id, depo_detail_nama")
			->from('depo_detail')
			->where('stock_type_kode', $stock_type_kode);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Getdepo_detail()
	{
		$this->db->select("depo_detail_id, depo_detail_nama, g.depo_id, g.depo_nama, stock_type_kode, depo_detail_length, depo_detail_width")
			->from("depo_detail as g1")
			->join("depo as g", "g.depo_id = g1.depo_id", "inner")
			->order_by("g.depo_nama");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			return $query->result_array();
		}
	}

	public function Getdepo_detail_2()
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->order_by("depo_detail_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Getdepo_detail_by_depo_detail_flag_qa()
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->where("depo_id", $this->session->userdata('depo_id'))
			->where("depo_detail_is_qa", 1)
			->order_by("depo_detail_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getTipeSO()
	{
		$query = $this->db->query("SELECT tipe_sales_order_nama, tipe_sales_order_id FROM tipe_sales_order WHERE tipe_sales_order_is_aktif = 1");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getTipeBO()
	{
		$query = $this->db->query("SELECT tipe_back_order_nama, tipe_back_order_id FROM tipe_back_order WHERE tipe_back_order_is_aktif = 1");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getStatusSO()
	{
		$query = $this->db->query("SELECT DISTINCT sales_order_status FROM sales_order");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getStatusBO()
	{
		$query = $this->db->query("SELECT DISTINCT back_order_status FROM back_order");

		if ($query->num_rows() == 0) {
			$query = [];
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Getdepo_detail_by_depo_detail_flag_jual()
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->where("depo_detail_flag_jual", 1)
			->order_by("depo_detail_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Getdepo_detail_by_depo_detail_nama($depo_detail_nama)
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->where("depo_detail_nama", $depo_detail_nama);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Getdepo_detail_by_depo_detail_id($depo_detail_id)
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->where("depo_detail_id", $depo_detail_id)
			->order_by("depo_detail_nama", "ASC");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Getdepo_detail_by_depo_id($depo_id)
	{
		$this->db->select("depo_detail_id, depo_detail_nama, depo_id, depo_detail_catatan, depo_detail_updwho, depo_detail_updtgl, depo_detail_flag_jual, depo_detail_is_gudang_penerima")
			->from("depo_detail")
			->where("depo_id", $depo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Countdepo_detail_by_depo_id($depo_id)
	{
		$this->db->select("depo_id")
			->from("depo_detail")
			->where("depo_id", $depo_id);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function Insertdepo_detail(
		$depo_detail_nama,
		$depo_id,
		$depo_detail_catatan,
		$depo_detail_flag_jual,
		$depo_detail_is_gudang_penerima,
		$depo_detail_length,
		$depo_detail_width,
		$stock_type_kode,
		$client_id,
		$sub_client_kode
	) {
		$this->db->set("depo_detail_id", "NEWID()", FALSE);
		$this->db->set("depo_detail_nama", $depo_detail_nama);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("depo_detail_catatan", $depo_detail_catatan);
		$this->db->set("depo_detail_flag_jual", $depo_detail_flag_jual);
		$this->db->set("depo_detail_is_gudang_penerima", $depo_detail_is_gudang_penerima);

		$this->db->set("depo_detail_length", $depo_detail_length);
		$this->db->set("depo_detail_width", $depo_detail_width);
		$this->db->set("sub_client_kode", $sub_client_kode);
		$this->db->set("client_id", $client_id);
		$this->db->set("stock_type_kode", $stock_type_kode);

		$this->db->insert("depo_detail");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Deletedepo_detail_by_depo_id($depo_id)
	{
		$this->db->where("depo_id", $depo_id);

		$this->db->delete("depo_detail");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
	}

	public function Deletedepo_detail_by_depo_detail_id($depo_detail_id)
	{
		$this->db->where("depo_detail_id", $depo_detail_id);

		$this->db->delete("depo_detail");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
	}
}
