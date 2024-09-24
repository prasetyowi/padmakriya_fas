<?php

class M_SyncDataPelanggan extends CI_Model
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

	public function Get_customer_bosnet()
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT TOP 10
									customer.szCustId,
									CASE
										WHEN CHARINDEX('(', customer.szName) <> 0 THEN CASE
											WHEN CHARINDEX('(', customer.szName) <> 1 THEN REPLACE(customer.szName, RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX('(', customer.szName) + 1), '')
											ELSE REPLACE(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), RIGHT(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), LEN(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) - CHARINDEX('(', RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) + 1), '')
										END
										ELSE customer.szName
									END CustszContactPerson,
									product.szCategory_1
									FROM BOS_AR_Customer customer
									INNER JOIN BOS_SD_FSo so
									ON so.szCustId = customer.szCustId
									INNER JOIN BOS_SD_FSoItem so_item
									ON so_item.szFSoId = so.szFSoId
									INNER JOIN BOS_INV_Product product
									ON product.szProductId = so_item.szProductId
									WHERE YEAR(so.dtmOrder) = YEAR(GETDATE())
									GROUP BY customer.szCustId,
											customer.szName,
											product.szCategory_1
									ORDER BY customer.szName, product.szCategory_1 ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Check_client_pt_principle_eksternal($sistem_eksternal, $customer_eksternal_id)
	{
		$query = $this->db->query("SELECT * FROM client_pt_principle_eksternal 
									WHERE sistem_eksternal = '$sistem_eksternal'
									AND customer_eksternal_id = '$customer_eksternal_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		// return $this->db->last_query();
		return $query;
	}

	public function Insert_client_pt_principle_eksternal($sistem_eksternal, $data)
	{

		$query = $this->db->query("Exec insert_client_pt_principle_eksternal '" . $data['szCustId'] . "','" . $data['CustszContactPerson'] . "','" . $data['szCategory_1'] . "','$sistem_eksternal'");

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
