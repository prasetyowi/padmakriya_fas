<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class SistemEksternal extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // if ($this->session->has_userdata('pengguna_id') == 0) :
        //     redirect(base_url('MainPage'));
        // endif;

        $this->depo_id = $this->session->userdata('depo_id');
        $this->unit_mandiri_id = $this->session->userdata('unit_mandiri_id');
        $this->load->model('FAS/M_SistemEksternal', 'M_SistemEksternal');
    }

    public function SalesOrderHeader_get()
    {
        $tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl1'))));
        $tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl2'))));

        $data = $this->M_SistemEksternal->Get_sales_order_for_eksternal($tgl1, $tgl2);

        if ($data != 0) {
            // Set the response and exit
            $this->response($data, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No data were found'
            ], 404);
        }
    }

    public function SalesOrderDetail_get()
    {
        // $tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl1'))));
        // $tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl2'))));
        $sales_order_id = $this->input->get('sales_order_id');
        // $client_wms_id = $this->input->get('client_wms_id');

        // $data = $this->M_SistemEksternal->Get_sales_order_detail_for_eksternal($sales_order_id, $client_wms_id);

        $data = $this->M_SistemEksternal->Get_sales_order_detail_for_eksternal($sales_order_id);

        if ($data != 0) {
            // Set the response and exit
            $this->response($data, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No data were found'
            ], 404);
        }
    }

    public function SalesOrderDetailPromo_get()
    {
        // $tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl1'))));
        // $tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $this->input->get('tgl2'))));
        $sales_order_id = $this->input->get('sales_order_id');
        // $client_wms_id = $this->input->get('client_wms_id');

        // $data = $this->M_SistemEksternal->Get_sales_order_detail_for_eksternal($sales_order_id, $client_wms_id);

        $data = $this->M_SistemEksternal->Get_sales_order_detail_promo_for_eksternal($sales_order_id);

        if ($data != 0) {
            // Set the response and exit
            $this->response($data, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No data were found'
            ], 404);
        }
    }

    public function Customer_get()
    {
        $customer_id = $this->input->get('customer_id');

        $data = $this->M_SistemEksternal->Get_client_pt_for_eksternal($customer_id);

        if ($data != 0) {
            // Set the response and exit
            $this->response($data, 200);
        } else {
            // Set the response and exit
            $this->response([
                'status' => false,
                'message' => 'No data were found'
            ], 404);
        }
    }
}
