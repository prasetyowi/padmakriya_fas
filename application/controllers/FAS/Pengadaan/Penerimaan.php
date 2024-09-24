<?php

require_once APPPATH . 'core/ParentController.php';

class Penerimaan extends ParentController
{
    private $MenuKode;

    public function __construct()
    {
        parent::__construct();

        // echo "<pre>".print_r($_SESSION, 1)."</pre>";
        // die();

        if ($this->session->has_userdata('pengguna_id') == 0) :
            redirect(base_url('MainPage'));
        endif;

        $this->MenuKode = "218001000";
        $this->load->model('FAS/M_PurchaseRequest', 'M_PurchaseRequest');
        $this->load->model('FAS/M_PurchaseOrder', 'M_PurchaseOrder');
        $this->load->model('FAS/M_Principle', 'M_Principle');
        $this->load->model('FAS/M_Penerimaan', 'M_Penerimaan');
        $this->load->model('M_AutoGen');
        $this->load->model('M_Vrbl');
        $this->load->library('pdfgenerator');
    }

    public function PurchaseOrderMenu()
    {
        $this->load->model('M_Menu');


        $data = array();

        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        if (!$this->session->has_userdata('pengguna_id')) {
            redirect(base_url('MainPage'));
        }

        if (!$this->session->has_userdata('depo_id')) {
            redirect(base_url('Main/MainDepo/DepoMenu'));
        }

        $data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['css_files'] = array(
            Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

            Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
            Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
        );

        $query['js_files'] = array(
            Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
            Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
            Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
            //Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
        );

        $query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $query['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();

        $data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
        $data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
        $data['act'] = "index";

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $query);
        // $this->load->view('FAS/Pengadaan/PurchaseOrder/index', $data);
        $this->load->view('FAS/Pengadaan/Penerimaan/index', $data);
        $this->load->view('layouts/sidebar_footer', $query);
        $this->load->view('FAS/Pengadaan/PurchaseOrder/S_PurchaseOrder', $data);
    }

    public function create()
    {
        $this->load->model('M_Menu');

        $data = array();

        $data = array();
        // $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        // if ($data['Menu_Access']['R'] != 1) {
        //     redirect(base_url('MainPage'));
        //     exit();
        // }

        // if (!$this->session->has_userdata('pengguna_id')) {
        //     redirect(base_url('MainPage'));
        // }

        // if (!$this->session->has_userdata('depo_id')) {
        //     redirect(base_url('Main/MainDepo/DepoMenu'));
        // }

        $data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['css_files'] = array(
            Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

            Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
            Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
        );

        $query['js_files'] = array(
            Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
            Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
            Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
            //Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
        );

        $query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $query['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();

        $pr_id = $this->M_Vrbl->Get_NewID();
        $pr_id = $pr_id[0]['NEW_ID'];

        // $data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
        $data['pr_id'] = $pr_id;
        $data['Perusahaan'] = $this->M_Penerimaan->GetPerusahaan();
        $data['Gudang'] = $this->M_Penerimaan->GetGudang();
        $data['Divisi'] = $this->M_Penerimaan->GetDivisi();
        $data['TipePengadaan'] = $this->M_Penerimaan->GetTipePengadaan();
        $data['TipeTransaksi'] = $this->M_Penerimaan->GetTipeTransaksi();
        $data['KategoriBiaya'] = $this->M_Penerimaan->GetKategoriBiaya();
        $data['TipeBiaya'] = $this->M_Penerimaan->GetTipeBiaya();
        $data['TipeKepemilikan'] = $this->M_Penerimaan->GetTipeKepemilikan();
        $data['KodePo'] = $this->M_Penerimaan->GetKodePo();
        $data['act'] = "add";

        // Kebutuhan Authority Menu 
        // $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $query);
        $this->load->view('FAS/Pengadaan/Penerimaan/add', $data);
        $this->load->view('layouts/sidebar_footer', $query);
        $this->load->view('FAS/Pengadaan/Penerimaan/S_Penerimaan', $data);
    }

    public function edit()
    {
        $this->load->model('M_Menu');

        $data = array();

        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        if (!$this->session->has_userdata('pengguna_id')) {
            redirect(base_url('MainPage'));
        }

        if (!$this->session->has_userdata('depo_id')) {
            redirect(base_url('Main/MainDepo/DepoMenu'));
        }

        $data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['css_files'] = array(
            Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

            Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
            Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
        );

        $query['js_files'] = array(
            Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
            Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
            Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
            //Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
        );

        $query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $query['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $id = $this->input->get('id');
        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();
        $data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
        $data['pr_id'] = $id;
        $data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
        $data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
        $data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
        $data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
        $data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
        $data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
        $data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
        $data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
        $data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
        $data['act'] = "edit";

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $query);
        $this->load->view('FAS/Pengadaan/PurchaseRequest/edit', $data);
        $this->load->view('layouts/sidebar_footer', $query);
        $this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
        $this->load->view('FAS/Pengadaan/PurchaseRequest/S_Principle', $data);
    }

    public function detail()
    {
        $this->load->model('M_Menu');

        $data = array();

        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        if (!$this->session->has_userdata('pengguna_id')) {
            redirect(base_url('MainPage'));
        }

        if (!$this->session->has_userdata('depo_id')) {
            redirect(base_url('Main/MainDepo/DepoMenu'));
        }

        $data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['css_files'] = array(
            Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

            Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
            Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
        );

        $query['js_files'] = array(
            Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
            Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
            Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
            //Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
        );

        $query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $query['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $id = $this->input->get('id');
        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();
        $data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
        $data['pr_id'] = $id;
        $data['PRHeader'] = $this->M_PurchaseOrder->GetPurchaseRequestHeaderById($id);
        $data['PRDetail'] = $this->M_PurchaseOrder->GetPurchaseRequestDetailById($id);
        $data['Perusahaan'] = $this->M_PurchaseOrder->GetPerusahaan();
        $data['Divisi'] = $this->M_PurchaseOrder->GetDivisi();
        $data['TipePengadaan'] = $this->M_PurchaseOrder->GetTipePengadaan();
        $data['TipeTransaksi'] = $this->M_PurchaseOrder->GetTipeTransaksi();
        $data['KategoriBiaya'] = $this->M_PurchaseOrder->GetKategoriBiaya();
        $data['TipeBiaya'] = $this->M_PurchaseOrder->GetTipeBiaya();
        $data['TipeKepemilikan'] = $this->M_PurchaseOrder->GetTipeKepemilikan();
        $data['act'] = "detail";

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $query);
        $this->load->view('FAS/Pengadaan/PurchaseOrder/detail', $data);
        $this->load->view('layouts/sidebar_footer', $query);
        $this->load->view('FAS/Pengadaan/PurchaseOrder/S_PurchaseOrder', $data);
    }

    public function view()
    {
        $this->load->model('M_Menu');

        $data = array();

        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        if (!$this->session->has_userdata('pengguna_id')) {
            redirect(base_url('MainPage'));
        }

        if (!$this->session->has_userdata('depo_id')) {
            redirect(base_url('Main/MainDepo/DepoMenu'));
        }

        $data['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $query['css_files'] = array(
            Get_Assets_Url() . 'assets/css/custom/bootstrap4-toggle.min.css',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css',

            Get_Assets_Url() . 'assets/css/custom/horizontal-scroll.css',
            Get_Assets_Url() . 'assets/css/custom/scrollbar.css'
        );

        $query['js_files'] = array(
            Get_Assets_Url() . 'assets/js/bootstrap4-toggle.min.js',
            Get_Assets_Url() . 'assets/js/bootstrap-touchspin-master/dist/jquery.bootstrap-touchspin.js',
            Get_Assets_Url() . 'assets/js/bootstrap-input-spinner.js',
            Get_Assets_Url() . 'vendors/Chart.js/dist/Chart.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
            //Get_Assets_Url() . 'assets/css/custom/Semantic-UI-master/dist/semantic.min.js'
        );

        $query['sidemenu'] = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));

        $query['Ses_UserName'] = $this->session->userdata('pengguna_username');

        $id = $this->M_PurchaseRequest->GetPurchaseRequestId($this->input->get('kode'));
        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();
        $data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
        $data['pr_id'] = $id;
        $data['PRHeader'] = $this->M_PurchaseRequest->GetPurchaseRequestHeaderById($id);
        $data['PRDetail'] = $this->M_PurchaseRequest->GetPurchaseRequestDetailById($id);
        $data['Perusahaan'] = $this->M_PurchaseRequest->GetPerusahaan();
        $data['Divisi'] = $this->M_PurchaseRequest->GetDivisi();
        $data['TipePengadaan'] = $this->M_PurchaseRequest->GetTipePengadaan();
        $data['TipeTransaksi'] = $this->M_PurchaseRequest->GetTipeTransaksi();
        $data['KategoriBiaya'] = $this->M_PurchaseRequest->GetKategoriBiaya();
        $data['TipeBiaya'] = $this->M_PurchaseRequest->GetTipeBiaya();
        $data['TipeKepemilikan'] = $this->M_PurchaseRequest->GetTipeKepemilikan();
        $data['act'] = "detail";

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $query);
        $this->load->view('FAS/Pengadaan/PurchaseRequest/detail', $data);
        $this->load->view('layouts/sidebar_footer', $query);
        $this->load->view('FAS/Pengadaan/PurchaseRequest/script', $data);
    }

    public function CetakPdf()
    {
        $this->load->library('pdfgenerator');

        $id = $this->input->get('id');
        $query['Title'] = Get_Title_Name();
        $query['Copyright'] = Get_Copyright_Name();
        $data['Bulan'] = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");
        $data['pr_id'] = $id;
        $data['PRHeader'] = $this->M_PurchaseOrder->GetPurchaseRequestHeaderById($id);
        $data['PRDetail'] = $this->M_PurchaseOrder->GetPurchaseRequestDetailById($id);
        $data['Perusahaan'] = $this->M_PurchaseOrder->GetPerusahaan();
        $data['Divisi'] = $this->M_PurchaseOrder->GetDivisi();
        $data['TipePengadaan'] = $this->M_PurchaseOrder->GetTipePengadaan();
        $data['TipeTransaksi'] = $this->M_PurchaseOrder->GetTipeTransaksi();
        $data['KategoriBiaya'] = $this->M_PurchaseOrder->GetKategoriBiaya();
        $data['TipeBiaya'] = $this->M_PurchaseOrder->GetTipeBiaya();
        $data['TipeKepemilikan'] = $this->M_PurchaseOrder->GetTipeKepemilikan();
        $data['act'] = "detail";

        // title dari pdf
        $data['title_pdf'] = 'Purchase Order';

        // filename dari pdf ketika didownload
        $file_pdf = 'Penjualan';
        // setting paper
        // $paper = 'A3';
        $paper = array(0, 0, 1000, 500);
        //orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = $this->load->view('FAS/Pengadaan/PurchaseOrder/print', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }



    public function GetDataDetailByKodePo()
    {
        $po_id = $this->input->post('purchase_order_id');

        $data = $this->M_Penerimaan->GetDataDetailByKodePo($po_id);

        echo json_encode($data);
    }
    public function GetPurchaseRequestDetailById()
    {
        $po_id = $this->input->post('po_id');

        $data = $this->M_Penerimaan->GetPurchaseRequestDetailById($po_id);

        echo json_encode($data);
    }
    public function  GetPurchaseRequestHeaderById()
    {

        // return $this->db->last_query();
    }

    public function GetSupplier()
    {
        $data = $this->M_PurchaseRequest->GetSupplier();

        echo json_encode($data);
    }

    public function search_purchase_request_by_filter()
    {
        $tgl = explode(" - ", $this->input->post('tgl'));

        $tgl1 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[0])));
        $tgl2 = date('Y-m-d', strtotime(str_replace("/", "-", $tgl[1])));
        $perusahaan = $this->input->post('perusahaan');
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');


        $data = $this->M_PurchaseOrder->search_purchase_request_by_filter($tgl1, $tgl2, $perusahaan, $kode, $status);

        echo json_encode($data);
    }

    public function search_filter_chosen_sku()
    {
        $perusahaan = $this->input->post('perusahaan');
        $sku_kode = $this->input->post('sku_kode');
        $sku_nama_produk = $this->input->post('sku_nama_produk');

        $data = $this->M_PurchaseRequest->search_filter_chosen_sku($perusahaan, $sku_kode, $sku_nama_produk);

        echo json_encode($data);
    }

    public function insert_penerimaan_sku_barang()
    {
    }
}
