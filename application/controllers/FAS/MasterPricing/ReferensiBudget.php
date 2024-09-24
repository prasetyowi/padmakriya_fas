<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReferensiBudget extends CI_Controller
{
    private $MenuKode;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('pengguna_id') == 0) :
            redirect(base_url('MainPage/Login'));
        endif;

        $this->MenuKode = "221006000";
        $this->load->model(['FAS/M_ReferensiBudget', 'M_Menu', 'M_MenuAccess', 'M_Function', 'M_Vrbl']);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function ReferensiBudgetMenu()
    {
        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        $data['Title']          = Get_Title_Name();
        $data['Copyright']      = Get_Copyright_Name();
        $data['sidemenu']       = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName']   = $this->session->userdata('pengguna_username');
        $data['css_files']      = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );
        $data['js_files']       = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));
        $data['data_ref']   = $this->M_ReferensiBudget->getReffKode();
        // var_dump($data['data_ref']);
        // die;
        $data['data_unit']  = $this->M_ReferensiBudget->getUnit();

        $this->load->view('layouts/sidebar_header', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/ReferensiBudgetList', $data);
        $this->load->view('layouts/sidebar_footer', $data);
        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/S_ReferensiBudgetList', $data);
    }

    public function addReference()
    {
        $data = array();

        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        $data['Title']          = Get_Title_Name();
        $data['Copyright']      = Get_Copyright_Name();
        $data['sidemenu']       = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName']   = $this->session->userdata('pengguna_username');
        $data['css_files']      = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );
        $data['js_files']       = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        $depo_id                = $this->session->userdata('depo_id');
        $data['tipeData']       = $this->M_ReferensiBudget->getTipeData();
        $data['tipePromo']      = $this->M_ReferensiBudget->getTipePromo();
        $data['principle']      = $this->M_ReferensiBudget->getPrinciple();

        $data['depo']           = $this->M_ReferensiBudget->getDepoGrup($depo_id);
        $data['kategori']       = $this->M_ReferensiBudget->getSkuGrup();
        $data['depoKode']       = $this->M_ReferensiBudget->getDepoKode($depo_id);
        $data['depoGroup']      = $this->M_ReferensiBudget->getDepoGroup($depo_id);
        $data['karyawan_id']    = $this->M_ReferensiBudget->getKaryawanId();
        $data['diskonApprove']  = $this->M_ReferensiBudget->getDiskonApprove();

        $karyawan_id            = $this->M_ReferensiBudget->getKaryawanId();

        if ($karyawan_id['karyawan_id'] == 'AD030BE3-7D9E-4A66-B985-D6085F623DA2') {
            $data['client']         = $this->M_ReferensiBudget->getClientWms();
        } else {
            $data['client']         = $this->M_ReferensiBudget->getClientWmsByKaryawanId($karyawan_id['karyawan_id']);
        }

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Add_Reference', $data);
        $this->load->view('layouts/sidebar_footer', $data);
        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/S_ReferensiBudgetList', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Modal_Source', $data);
    }

    public function duplicateReference($id)
    {
        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        $data['Title']          = Get_Title_Name();
        $data['Copyright']      = Get_Copyright_Name();
        $data['sidemenu']       = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName']   = $this->session->userdata('pengguna_username');
        $data['css_files']      = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );

        $data['js_files'] = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        $depo_id = $this->session->userdata('depo_id');
        $data['tipeData']       = $this->M_ReferensiBudget->getTipeData();
        $data['tipePromo']      = $this->M_ReferensiBudget->getTipePromo();
        $data['principle']      = $this->M_ReferensiBudget->getPrinciple();
        $data['depo']           = $this->M_ReferensiBudget->getDepoGrup($depo_id);
        $data['kategori']       = $this->M_ReferensiBudget->getSkuGrup();
        $data['depoKode']       = $this->M_ReferensiBudget->getDepoKode($depo_id);
        $data['depoGroup']      = $this->M_ReferensiBudget->getDepoGroup($depo_id);
        $data['karyawan_id']    = $this->M_ReferensiBudget->getKaryawanId();

        $karyawan_id            = $this->M_ReferensiBudget->getKaryawanId();

        if ($karyawan_id['karyawan_id'] == 'AD030BE3-7D9E-4A66-B985-D6085F623DA2') {
            $data['client']         = $this->M_ReferensiBudget->getClientWms();
        } else {
            $data['client']         = $this->M_ReferensiBudget->getClientWmsByKaryawanId($karyawan_id['karyawan_id']);
        }

        $data['rbid'] = $this->M_ReferensiBudget->getDataReferenceById($id);
        $data['rbdid'] = $this->M_ReferensiBudget->keyRbd($id);
        $data['count'] = $this->M_ReferensiBudget->count($id);

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Duplicate_Reference', $data);
        $this->load->view('layouts/sidebar_footer', $data);
        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/S_ReferensiBudgetList', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Modal_Source', $data);
    }

    public function EditReference($id)
    {
        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        $data['Title']          = Get_Title_Name();
        $data['Copyright']      = Get_Copyright_Name();
        $data['sidemenu']       = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName']   = $this->session->userdata('pengguna_username');
        $data['css_files']      = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );

        $data['js_files'] = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        $depo_id = $this->session->userdata('depo_id');
        $data['tipeData']       = $this->M_ReferensiBudget->getTipeData();
        $data['tipePromo']      = $this->M_ReferensiBudget->getTipePromo();
        $data['principle']      = $this->M_ReferensiBudget->getPrinciple();
        $data['depo']           = $this->M_ReferensiBudget->getDepoGrup($depo_id);
        $data['kategori']       = $this->M_ReferensiBudget->getSkuGrup();
        $data['depoKode']       = $this->M_ReferensiBudget->getDepoKode($depo_id);
        $data['depoGroup']      = $this->M_ReferensiBudget->getDepoGroup($depo_id);
        $data['karyawan_id']    = $this->M_ReferensiBudget->getKaryawanId();

        $karyawan_id            = $this->M_ReferensiBudget->getKaryawanId();

        if ($karyawan_id['karyawan_id'] == 'AD030BE3-7D9E-4A66-B985-D6085F623DA2') {
            $data['client']         = $this->M_ReferensiBudget->getClientWms();
        } else {
            $data['client']         = $this->M_ReferensiBudget->getClientWmsByKaryawanId($karyawan_id['karyawan_id']);
        }

        $data['rbid'] = $this->M_ReferensiBudget->getDataReferenceById($id);
        $data['rbdid'] = $this->M_ReferensiBudget->keyRbd($id);
        $data['count'] = $this->M_ReferensiBudget->count($id);

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Edit_Reference', $data);
        $this->load->view('layouts/sidebar_footer', $data);
        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/S_ReferensiBudgetList', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Modal_Source', $data);
    }

    public function detailReference($id)
    {
        $data = array();
        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage'));
            exit();
        }

        $data['Title']          = Get_Title_Name();
        $data['Copyright']      = Get_Copyright_Name();
        $data['sidemenu']       = $this->M_Menu->GetMenu_Depo('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName']   = $this->session->userdata('pengguna_username');
        $data['css_files']      = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );

        $data['js_files'] = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        // $data['ReferensiBudget'] = $this->M_ReferensiBudget->Get_ReferensiBudget();
        $depo_id = $this->session->userdata('depo_id');
        $data['tipeData']       = $this->M_ReferensiBudget->getTipeData();
        $data['tipePromo']      = $this->M_ReferensiBudget->getTipePromo();
        $data['principle']      = $this->M_ReferensiBudget->getPrinciple();
        $data['client']         = $this->M_ReferensiBudget->getClientWms();
        $data['depo']           = $this->M_ReferensiBudget->getDepoGrup($depo_id);
        $data['kategori']       = $this->M_ReferensiBudget->getSkuGrup();
        $data['depoKode']       = $this->M_ReferensiBudget->getDepoKode($depo_id);
        $data['depoGroup']      = $this->M_ReferensiBudget->getDepoGroup($depo_id);
        $data['karyawan_id']    = $this->M_ReferensiBudget->getKaryawanId();

        $data['rbid']  = $this->M_ReferensiBudget->getDataReferenceById($id);
        $data['rbdid'] = $this->M_ReferensiBudget->keyRbd($id);
        $data['count'] = $this->M_ReferensiBudget->count($id);

        // var_dump($data['count']);
        // die;

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/sidebar_header', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Detail_Reference', $data);
        $this->load->view('layouts/sidebar_footer', $data);
        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/S_ReferensiBudgetList', $data);
        $this->load->view('FAS/MasterPricing/ReferensiBudget/component/Modal_Source', $data);
    }

    public function getDataReferenceById()
    {
        $id             = $this->input->get("id");
        $data['rb']     = $this->M_ReferensiBudget->getDataReferenceById($id);
        $data['rbd']    = $this->M_ReferensiBudget->getDetailReferenceById($id);
        $data['rbd2']   = $this->M_ReferensiBudget->getDet2ReferenceById($id);

        echo json_encode($data);
    }

    public function getDataDepoByPrincipleId()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getDataDepoByPrincipleId($id);
        echo json_encode($data);
    }

    public function getRelModal()
    {
        $kategori_id = $this->input->post('kategori_id');
        $sku_id      = $this->input->post('sku_id');
        $data        = $this->M_ReferensiBudget->getRelModal($kategori_id, $sku_id);
        echo json_encode($data);
    }

    public function getSkuGrup()
    {
        $id   = $this->input->post('id');
        $data = $this->M_ReferensiBudget->getSkuGrup($id);
        echo json_encode($data);
    }

    public function getNamaGrup()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getNamaGrup($id);
        echo json_encode($data);
    }

    public function certainSku()
    {
        // $rbid        = $this->input->post('rbid');
        $rbdid          = $this->input->post('rbdid');
        $grup_nama      = $this->input->post('grup_nama');
        $grup_sku       = $this->input->post('grup_sku');
        $data['sku']    = $this->M_ReferensiBudget->certainSku($grup_nama, $grup_sku);
        $data['rbd2']   = $this->M_ReferensiBudget->getDetail2ReferenceById($grup_nama, $rbdid);
        echo json_encode($data);
    }

    public function getPrincipleByPrincipleId()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getDataPrincipleByPrincipleId($id);
        echo json_encode($data);
    }

    public function getBrandByPrincipleId()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getBrandByPrincipleId($id);
        echo json_encode($data);
    }

    public function getSkuIndukByPrincipleId()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getSkuIndukByPrincipleId($id);
        echo json_encode($data);
    }

    public function getSkuNamaBySkuGrup()
    {
        $kategori_grup  = $this->input->post('kategori_grup');
        $data           = $this->M_ReferensiBudget->getSkuNamaBySkuGrup($kategori_grup);
        echo json_encode($data);
    }

    public function exceptionGetSkuGrup()
    {
        $grup_sku   = $this->input->post('grup_sku');
        $principle  = $this->input->post('principle');
        $data       = $this->M_ReferensiBudget->exceptionGetSkuGrup($grup_sku, $principle);
        echo json_encode($data);
    }

    public function getDataSku()
    {
        $id     = $this->input->post('id');
        $data   = $this->M_ReferensiBudget->getDataSku($id);
        echo json_encode($data);
    }

    public function searchSkubyFilter()
    {
        $principle  = $this->input->post('principle');
        $skuinduk   = $this->input->post('skuinduk');
        $brand      = $this->input->post('brand');
        $namasku    = $this->input->post('namasku');
        $kodeskuwms = $this->input->post('kodeskuwms');

        $data = $this->M_ReferensiBudget->searchSkubyFilter($skuinduk, $principle, $brand, $namasku, $kodeskuwms);
        echo json_encode($data);
    }

    public function getReferensiBudget()
    {
        $diskon_kode    = $this->input->post('diskon_kode');
        $unit           = $this->input->post('unit');

        $data           = $this->M_ReferensiBudget->getReferensiBudget($diskon_kode, $unit);
        echo json_encode($data);
    }

    public function saveReferensiBudget()
    {
        $rb_id              = $this->M_Vrbl->Get_NewID();
        $rb_id              = $rb_id[0]['NEW_ID'];
        $kode_promo         = $this->input->post('kode_promo');
        $depo_grup_id       = $this->input->post('depo_grup_id');
        $depo_id            = $this->input->post('depo_id');
        $client_wms         = $this->input->post('client_wms');
        $tipe_referensi     = $this->input->post('tipe_referensi');
        $tipe_promo         = $this->input->post('tipe_promo');
        $principle          = $this->input->post('principle');
        $grup_sku           = $this->input->post('grup_sku');
        $no_surat_promo     = $this->input->post('no_surat_promo');
        $tgl_promo_awal     = $this->input->post('tgl_promo_awal');
        $tgl_promo_awal     = str_replace('/', '-', $tgl_promo_awal);
        $tgl1               = date('Y-m-d', strtotime($tgl_promo_awal));
        $tgl_promo_akhir    = $this->input->post('tgl_promo_akhir');
        $tgl_promo_akhir    = str_replace('/', '-', $tgl_promo_akhir);
        $tgl2               = date('Y-m-d', strtotime($tgl_promo_akhir));
        $keterangan         = $this->input->post('keterangan');
        $in_qty             = $this->input->post('in_qty');
        $in_value           = $this->input->post('in_value');
        $total_alokasi      = $this->input->post('total_alokasi');
        $notif_pemakaian    = $this->input->post('notif_pemakaian');
        $status             = $this->input->post('status');
        $createdby          = $this->session->userdata('pengguna_username');
        $karyawan_id        = $this->input->post('karyawan_id');
        $depo_id            = $this->session->userdata('depo_id');
        $approvalParam      = $this->M_ReferensiBudget->Get_ParameterApprovalMutasi();

        if ($status == "In Progress Approval") {
            $this->M_ReferensiBudget->insertReferensiBudget(
                $rb_id,
                $kode_promo,
                $depo_grup_id,
                $depo_id,
                $client_wms,
                $tipe_referensi,
                $tipe_promo,
                $principle,
                $grup_sku,
                $no_surat_promo,
                $tgl1,
                $tgl2,
                $keterangan,
                $in_qty,
                $in_value,
                $total_alokasi,
                $notif_pemakaian,
                $status,
                $createdby
            );
            $this->M_ReferensiBudget->Exec_approval_pengajuan($depo_id, $karyawan_id, $approvalParam, $rb_id, $kode_promo, 0, 0);
        } else {
            $this->M_ReferensiBudget->insertReferensiBudget(
                $rb_id,
                $kode_promo,
                $depo_grup_id,
                $depo_id,
                $client_wms,
                $tipe_referensi,
                $tipe_promo,
                $principle,
                $grup_sku,
                $no_surat_promo,
                $tgl1,
                $tgl2,
                $keterangan,
                $in_qty,
                $in_value,
                $total_alokasi,
                $notif_pemakaian,
                $status,
                $createdby
            );
        }


        $arr_sku_id2 = $this->input->post('arr_sku_id2');

        if ($grup_sku != null || $grup_sku != '') {
            if ($grup_sku == 0) {
                if ($arr_sku_id2 != null) {
                    //tidak menggunakan grup sku
                    foreach ($arr_sku_id2 as $data) {
                        $detail_rb_id                       = $this->M_Vrbl->Get_NewID();
                        $detail_rb_id                       = $detail_rb_id[0]['NEW_ID'];
                        $referensi_diskon_detail_id         = $detail_rb_id;
                        $referensi_diskon_id                = $rb_id;
                        $sku_id                             = $data['sku_id'];
                        $kategori_id                        = $data['kategori_id'];
                        $referensi_diskon_detail_qty        = $data['inQty2'];
                        $referensi_diskon_detail_value      = intval($data['inValue2']);
                        $referensi_diskon_detail_alokasi    = intval($data['alokasi2']);

                        $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                            $referensi_diskon_detail_id,
                            $referensi_diskon_id,
                            $sku_id,
                            $kategori_id,
                            $referensi_diskon_detail_qty,
                            $referensi_diskon_detail_value,
                            $referensi_diskon_detail_alokasi
                        );
                    }
                }
            } else {
                $arr_sku_id1    = $this->input->post('arr_sku_id1');
                $arr_sku_except = $this->input->post('arr_sku_except');

                if ($arr_sku_id1 != null && $arr_sku_except != null) {
                    foreach ($arr_sku_id1 as $data) {
                        $detail2_rb_id_fix                  = $this->M_Vrbl->Get_NewID();
                        $detail2_rb_id_fix                  = $detail2_rb_id_fix[0]['NEW_ID'];
                        $referensi_diskon_detail_id         = $detail2_rb_id_fix;
                        $referensi_diskon_id                = $rb_id;
                        $kategori_id                        = $data['kategori_id'];
                        $referensi_diskon_detail_qty        = $data['inQty1'];
                        $referensi_diskon_detail_value      = intval($data['inValue1']);
                        $referensi_diskon_detail_alokasi    = intval($data['alokasi1']);
                        $sku_id                             = null;

                        $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                            $referensi_diskon_detail_id,
                            $referensi_diskon_id,
                            $sku_id,
                            $kategori_id,
                            $referensi_diskon_detail_qty,
                            $referensi_diskon_detail_value,
                            $referensi_diskon_detail_alokasi
                        );
                    }

                    foreach ($arr_sku_except as $row) {

                        $detail2_rb_id                  = $this->M_Vrbl->Get_NewID();
                        $detail2_rb_id                  = $detail2_rb_id[0]['NEW_ID'];
                        $referensi_diskon_detail2_id    = $detail2_rb_id;
                        $referensi_diskon_id            = $rb_id;
                        $sku_id2                        = $row['chk_except'];
                        $kategori_id                    = $row['kategori_id'];

                        $getDetail = $this->M_ReferensiBudget->getDataRow($referensi_diskon_id, $kategori_id);

                        $this->M_ReferensiBudget->insertReferensiBudgetDetail2(
                            $referensi_diskon_detail2_id,
                            $getDetail->referensi_diskon_detail_id,
                            $referensi_diskon_id,
                            $sku_id2
                        );
                    }
                }
            }
        }
        echo 1;
    }

    public function updateReferensiBudget()
    {
        $rb_id                       = $this->input->post('reff_id');
        $kode_promo                  = $this->input->post('kode_promo');
        $no_surat_promo_tambahan     = $this->input->post('no_surat_promo_tambahan');
        $keterangan                  = $this->input->post('keterangan');
        $notif_pemakaian             = $this->input->post('notif_pemakaian');
        $status                      = $this->input->post('status');
        $karyawan_id                 = $this->input->post('karyawan_id');
        $depo_id                     = $this->session->userdata('depo_id');
        $grup_sku                    = $this->input->post('grup_sku');
        $approvalParam               = $this->M_ReferensiBudget->Get_ParameterApprovalMutasi();

        if ($status == "In Progress Approval") {
            $this->M_ReferensiBudget->updateReferensiBudget(
                $rb_id,
                $no_surat_promo_tambahan,
                $keterangan,
                $notif_pemakaian,
                $status
            );
            $this->M_ReferensiBudget->Exec_approval_pengajuan($depo_id, $karyawan_id, $approvalParam, $rb_id, $kode_promo, 0, 0);
        } else {
            $this->M_ReferensiBudget->updateReferensiBudget(
                $rb_id,
                $no_surat_promo_tambahan,
                $keterangan,
                $notif_pemakaian,
                $status
            );
        }

        $arr_sku_id2 = $this->input->post('arr_sku_id2');

        if ($grup_sku == 0) {
            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail($rb_id);
            }

            //tidak menggunakan grup sku
            foreach ($arr_sku_id2 as $data) {
                $detail_rb_id                       = $this->M_Vrbl->Get_NewID();
                $detail_rb_id                       = $detail_rb_id[0]['NEW_ID'];
                $referensi_diskon_detail_id         = $detail_rb_id;
                $referensi_diskon_id                = $rb_id;
                $sku_id                             = $data['sku_id'];
                $kategori_id                        = $data['kategori_id'];
                $referensi_diskon_detail_qty        = $data['inQty2'];
                $referensi_diskon_detail_value      = intval($data['inValue2']);
                $referensi_diskon_detail_alokasi    = intval($data['alokasi2']);

                $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                    $referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id,
                    $kategori_id,
                    $referensi_diskon_detail_qty,
                    $referensi_diskon_detail_value,
                    $referensi_diskon_detail_alokasi
                );
            }
        } else {
            $arr_sku_id1    = $this->input->post('arr_sku_id1');
            $arr_sku_except = $this->input->post('arr_sku_except');

            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail($rb_id);
            }

            foreach ($arr_sku_id1 as $data) {
                $detail2_rb_id_fix                  = $this->M_Vrbl->Get_NewID();
                $detail2_rb_id_fix                  = $detail2_rb_id_fix[0]['NEW_ID'];
                $referensi_diskon_detail_id         = $detail2_rb_id_fix;
                $referensi_diskon_id                = $rb_id;
                $kategori_id                        = $data['kategori_id'];
                $referensi_diskon_detail_qty        = $data['inQty1'];
                $referensi_diskon_detail_value      = intval($data['inValue1']);
                $referensi_diskon_detail_alokasi    = intval($data['alokasi1']);
                $sku_id                             = null;

                $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                    $referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id,
                    $kategori_id,
                    $referensi_diskon_detail_qty,
                    $referensi_diskon_detail_value,
                    $referensi_diskon_detail_alokasi
                );
            }

            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail2($rb_id);
            }

            foreach ($arr_sku_except as $row) {

                $detail2_rb_id                  = $this->M_Vrbl->Get_NewID();
                $detail2_rb_id                  = $detail2_rb_id[0]['NEW_ID'];
                $referensi_diskon_detail2_id    = $detail2_rb_id;
                $referensi_diskon_id            = $rb_id;
                $sku_id2                        = $row['chk_except'];
                $kategori_id                    = $row['kategori_id'];

                $getDetail = $this->M_ReferensiBudget->getDataRow($referensi_diskon_id, $kategori_id);

                $this->M_ReferensiBudget->insertReferensiBudgetDetail2(
                    $referensi_diskon_detail2_id,
                    $getDetail->referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id2
                );
            }
        }

        echo 1;
    }

    public function editReferensiBudget()
    {
        $rb_id              = $this->input->post('referensi_diskon_id');
        $kode_promo         = $this->input->post('kode_promo');
        $depo_id            = $this->input->post('depo_id');
        $client_wms         = $this->input->post('client_wms');
        $tipe_referensi     = $this->input->post('tipe_referensi');
        $tipe_promo         = $this->input->post('tipe_promo');
        $principle          = $this->input->post('principle');
        $grup_sku           = $this->input->post('grup_sku');
        $no_surat_promo     = $this->input->post('no_surat_promo');
        $tgl_promo_awal     = $this->input->post('tgl_promo_awal');
        $tgl_promo_awal     = str_replace('/', '-', $tgl_promo_awal);
        $tgl1               = date('Y-m-d', strtotime($tgl_promo_awal));
        $tgl_promo_akhir    = $this->input->post('tgl_promo_akhir');
        $tgl_promo_akhir    = str_replace('/', '-', $tgl_promo_akhir);
        $tgl2               = date('Y-m-d', strtotime($tgl_promo_akhir));
        $keterangan         = $this->input->post('keterangan');
        $in_qty             = $this->input->post('in_qty');
        $in_value           = $this->input->post('in_value');
        $total_alokasi      = $this->input->post('total_alokasi');
        $notif_pemakaian    = $this->input->post('notif_pemakaian');
        $status             = $this->input->post('status');
        $createdby          = $this->session->userdata('pengguna_username');
        $karyawan_id        = $this->input->post('karyawan_id');
        $depo_id            = $this->session->userdata('depo_id');
        $approvalParam      = $this->M_ReferensiBudget->Get_ParameterApprovalMutasi();

        if ($status == "In Progress Approval") {
            $this->M_ReferensiBudget->editReferensiBudget(
                $rb_id,
                $kode_promo,
                $client_wms,
                $tipe_referensi,
                $tipe_promo,
                $principle,
                $grup_sku,
                $no_surat_promo,
                $tgl1,
                $tgl2,
                $keterangan,
                $in_qty,
                $in_value,
                $total_alokasi,
                $notif_pemakaian,
                $status,
                $createdby
            );
            $this->M_ReferensiBudget->Exec_approval_pengajuan($depo_id, $karyawan_id, $approvalParam, $rb_id, $kode_promo, 0, 0);
        } else {
            $this->M_ReferensiBudget->editReferensiBudget(
                $rb_id,
                $kode_promo,
                $client_wms,
                $tipe_referensi,
                $tipe_promo,
                $principle,
                $grup_sku,
                $no_surat_promo,
                $tgl1,
                $tgl2,
                $keterangan,
                $in_qty,
                $in_value,
                $total_alokasi,
                $notif_pemakaian,
                $status,
                $createdby
            );
        }

        $arr_sku_id2 = $this->input->post('arr_sku_id2');

        if ($grup_sku == 0) {
            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail($rb_id);
            }

            //tidak menggunakan grup sku
            foreach ($arr_sku_id2 as $data) {
                $detail_rb_id                       = $this->M_Vrbl->Get_NewID();
                $detail_rb_id                       = $detail_rb_id[0]['NEW_ID'];
                $referensi_diskon_detail_id         = $detail_rb_id;
                $referensi_diskon_id                = $rb_id;
                $sku_id                             = $data['sku_id'];
                $kategori_id                        = $data['kategori_id'];
                $referensi_diskon_detail_qty        = $data['inQty2'];
                $referensi_diskon_detail_value      = intval($data['inValue2']);
                $referensi_diskon_detail_alokasi    = intval($data['alokasi2']);

                $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                    $referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id,
                    $kategori_id,
                    $referensi_diskon_detail_qty,
                    $referensi_diskon_detail_value,
                    $referensi_diskon_detail_alokasi
                );
            }
        } else {
            $arr_sku_id1    = $this->input->post('arr_sku_id1');
            $arr_sku_except = $this->input->post('arr_sku_except');

            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail($rb_id);
            }

            foreach ($arr_sku_id1 as $data) {
                $detail2_rb_id_fix                  = $this->M_Vrbl->Get_NewID();
                $detail2_rb_id_fix                  = $detail2_rb_id_fix[0]['NEW_ID'];
                $referensi_diskon_detail_id         = $detail2_rb_id_fix;
                $referensi_diskon_id                = $rb_id;
                $kategori_id                        = $data['kategori_id'];
                $referensi_diskon_detail_qty        = $data['inQty1'];
                $referensi_diskon_detail_value      = intval($data['inValue1']);
                $referensi_diskon_detail_alokasi    = intval($data['alokasi1']);
                $sku_id                             = null;

                $this->M_ReferensiBudget->insertReferensiBudgetDetail(
                    $referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id,
                    $kategori_id,
                    $referensi_diskon_detail_qty,
                    $referensi_diskon_detail_value,
                    $referensi_diskon_detail_alokasi
                );
            }

            if ($rb_id != null) {
                $this->M_ReferensiBudget->deleteReferensiBudgetDetail2($rb_id);
            }

            foreach ($arr_sku_except as $row) {

                $detail2_rb_id                  = $this->M_Vrbl->Get_NewID();
                $detail2_rb_id                  = $detail2_rb_id[0]['NEW_ID'];
                $referensi_diskon_detail2_id    = $detail2_rb_id;
                $referensi_diskon_id            = $rb_id;
                $sku_id2                        = $row['chk_except'];
                $kategori_id                    = $row['kategori_id'];

                $getDetail = $this->M_ReferensiBudget->getDataRow($referensi_diskon_id, $kategori_id);

                $this->M_ReferensiBudget->insertReferensiBudgetDetail2(
                    $referensi_diskon_detail2_id,
                    $getDetail->referensi_diskon_detail_id,
                    $referensi_diskon_id,
                    $sku_id2
                );
            }
        }

        echo 1;
    }
}
