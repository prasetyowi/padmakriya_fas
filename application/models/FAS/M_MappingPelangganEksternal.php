<?php

class M_MappingPelangganEksternal extends CI_Model
{

	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetPerusahaan()
	{
		$query = $this->db->query("SELECT * FROM client_wms WHERE client_wms_is_aktif = '1' ORDER BY client_wms_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function GetSistemEksternal()
	{
		$query = $this->db->query("SELECT * FROM getsistemeksternalid() ORDER BY nourut ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function GetCustomerByFilter($perusahaan)
	{
		$query = $this->db->query("SELECT
									b.*
									FROM client_wms_client_pt a
									LEFT JOIN client_pt b
									ON b.client_pt_id = a.client_pt_id
									WHERE a.client_wms_id = '$perusahaan'
									AND b.client_pt_is_aktif = '1'
									ORDER BY b.client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function GetCustomerPrincipleById($client_pt_id)
	{
		$query = $this->db->query("SELECT
									a.*,
									b.principle_id,
									p.principle_kode,
									ISNULL(c.sistem_eksternal,'') AS sistem_eksternal,
									ISNULL(c.customer_eksternal_id,'') AS customer_eksternal_id
									FROM client_pt a
									LEFT JOIN client_pt_principle b
									ON b.client_pt_id = a.client_pt_id
									LEFT JOIN principle p
									ON p.principle_id = b.principle_id
									LEFT JOIN client_pt_principle_eksternal c
									ON c.client_pt_id = a.client_pt_id
									AND c.principle_id = b.principle_id
									WHERE a.client_pt_id = '$client_pt_id' AND b.principle_id IS NOT NULL
									ORDER BY a.client_pt_nama ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function Check_client_pt_principle_eksternal($client_pt_id, $sistem_eksternal, $principle_id)
	{
		$query = $this->db->query("SELECT * FROM client_pt_principle_eksternal 
									WHERE client_pt_id = '$client_pt_id' 
									AND sistem_eksternal = '$sistem_eksternal'
									AND principle_id = '$principle_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function Insert_client_pt_principle_eksternal($client_pt_id, $data)
	{
		$this->db->set("client_pt_principle_eksternal_id", "NEWID()", FALSE);
		$this->db->set("sistem_eksternal", $data['sistem_eksternal']);
		$this->db->set("client_pt_id", $client_pt_id);
		$this->db->set("principle_id", $data['principle_id']);
		$this->db->set("customer_eksternal_id", $data['customer_eksternal_id']);

		$this->db->insert("client_pt_principle_eksternal");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Update_client_pt_principle_eksternal($client_pt_id, $data)
	{
		$this->db->set("customer_eksternal_id", $data['customer_eksternal_id']);

		$this->db->where("client_pt_id", $client_pt_id);
		$this->db->where("principle_id", $data['principle_id']);
		$this->db->where("sistem_eksternal", $data['sistem_eksternal']);

		$this->db->update("client_pt_principle_eksternal");

		$affectedrows = $this->db->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}
}
