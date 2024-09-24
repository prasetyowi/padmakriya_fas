<?php

class M_Dashboard extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getInfoStatusSO($pt, $tgl1, $tgl2)
    {
        $query = $this->db->query("SELECT COUNT(sales_order_status) AS jmlSO FROM sales_order WHERE client_wms_id = '$pt' AND sales_order_tgl BETWEEN '$tgl1' AND '$tgl2'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row_array();
        }

        return $query;
    }

    public function getInfoStatusApprv($pt, $tgl1, $tgl2)
    {
        $query = $this->db->query("SELECT COUNT(sales_order_status) AS jmlApprv FROM sales_order WHERE client_wms_id = '$pt' AND sales_order_tgl BETWEEN '$tgl1' AND '$tgl2' AND sales_order_status = 'Approved'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row_array();
        }

        return $query;
    }

    public function getInfoStatusPndg($pt, $tgl1, $tgl2)
    {
        $query = $this->db->query("SELECT COUNT(sales_order_status) AS jmlPndg FROM sales_order WHERE client_wms_id = '$pt' AND sales_order_tgl BETWEEN '$tgl1' AND '$tgl2' AND sales_order_status = 'Draft'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->row_array();
        }

        return $query;
    }
}