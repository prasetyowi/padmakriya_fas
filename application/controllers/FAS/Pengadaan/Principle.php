<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principle extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    private $MenuKode;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->has_userdata('pengguna_id') == 0) :
            redirect(base_url('MainPage/Login'));
        endif;

        $this->MenuKode = "011001000";
        // $this->MenuKode = "103002000";
        $this->load->model(['FAS/M_Principle', 'M_Function', 'M_MenuAccess', 'M_Menu']);
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function PrincipleMenu()
    {

        $data = array();

        $data['Menu_Access'] = $this->M_Menu->Getmenu_access_web($this->session->userdata('pengguna_grup_id'), $this->MenuKode);
        if ($data['Menu_Access']['R'] != 1) {
            redirect(base_url('MainPage/Index'));
            exit();
        }

        $data['sidemenu'] = $this->M_Menu->GetMenu('', $this->session->userdata('pengguna_grup_id'));

        $data['Ses_UserName'] = $this->session->userdata('UserName');

        $data['css_files'] = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',

            // Get_Assets_Url() . 'vendors/select2/dist/css/select2.min.css',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.css',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.css'
        );

        $data['js_files']     = array(
            Get_Assets_Url() . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
            Get_Assets_Url() . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',

            // Get_Assets_Url() . 'vendors/select2/dist/js/select2.min.js',

            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.buttons.js',
            Get_Assets_Url() . 'vendors/pnotify/dist/pnotify.nonblock.js'
        );

        $data['PrincipleMenu'] = $this->M_Principle->Get_Principle();

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/header', $data);
        $this->load->view('master/Principle/Principle', $data);
        $this->load->view('layouts/footer', $data);

        $this->load->view('master/S_GlobalVariable', $data);
        $this->load->view('master/Principle/S_Principle', $data);
    }

    public function GetPrincipleMenu()
    {
        // if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "R")) {
        //     echo 0;
        //     exit();
        // }

        $data['PrincipleMenu'] = $this->M_Principle->Get_Principle();
        $data['KelasJalan'] = $this->M_Principle->Get_Data_KelasJalan();
        $data['KelasJalan2'] = $this->M_Principle->Get_Data_KelasJalan2();
        $data['Area'] = $this->M_Principle->Get_Data_Area();
        $data['Provinsi'] = $this->M_Principle->Get_Data_Provinsi();

        $array = array('1' => 'Senin', '2' => 'Selasa', '3' => 'Rabu', '4' => 'Kamis', '5' => 'Jumat', '6' => 'Sabtu', '7' => 'Minggu');
        $data['Day'] = $array;

        // Mendapatkan url yang ngarah ke sini :
        $MenuLink = $this->session->userdata('MenuLink');
        $pengguna_grup_id = $this->session->userdata('pengguna_grup_id');

        $data['AuthorityMenu'] = $this->M_MenuAccess->Get_MenuAccess_By_UserGroupID_MenuLink($pengguna_grup_id, $MenuLink);

        $data['pengguna_grup_id'] = $this->session->userdata('pengguna_grup_id');
        $data['MenuLink'] = $this->session->userdata('MenuLink');

        echo json_encode($data);
    }

    public function EditData($id)
    {
        $data = array();
        $data['KelasJalan'] = $this->M_Principle->Get_Data_KelasJalan();
        $data['KelasJalan2'] = $this->M_Principle->Get_Data_KelasJalan2();
        $data['Area'] = $this->M_Principle->Get_Data_Area();
        $data['Provinsi'] = $this->M_Principle->Get_Data_Provinsi();
        $data['id'] = $id;
        $data['sidemenu'] = $this->M_Menu->GetMenu('', $this->session->userdata('pengguna_grup_id'));
        $data['Ses_UserName'] = $this->session->userdata('UserName');

        // Kebutuhan Authority Menu 
        $this->session->set_userdata('MenuLink', str_replace(base_url(), '', current_url()));

        $this->load->view('layouts/header', $data);
        $this->load->view('master/Principle/component/EditData', $data);
        $this->load->view('layouts/footer', $data);

        $this->load->view('master/Principle/script', $data);
    }

    public function GetDataByIdForEdit()
    {
        $data = array();
        $PrincipleId = $this->input->post('id');
        if ($PrincipleId != "") {
            // echo json_encode($PrincipleId);
            $res = $this->M_Principle->Get_Principle_By_Id($PrincipleId);
            if ($res['provinsi'] || $res['kota'] || $res['kecamatan'] || $res['kelurahan'] || $res['kodepos'] != null) {
                $kec_id = $this->M_Principle->Get_Kecamatan_Id($res);
                $data = $this->M_Principle->Get_All_Id($kec_id);
            }
        } else {
            $data = [];
        }

        echo json_encode($data);
    }

    public function Get_Request_Data_Kota()
    {
        $kotaId = $this->input->post("kota");
        $provinsi = $this->input->post("id");
        $data = $this->M_Principle->Get_Data_Kota($provinsi);

        $output = '<option value="">--Pilih Kota</option>';
        foreach ($data as $row) {
            if ($kotaId) {
                if ($kotaId == $row['region_nama']) {
                    $output .= '<option value="' . $row['region_nama'] . '" selected>' . $row['region_nama'] . '</option>';
                } else {
                    $output .= '<option value="' . $row['region_nama'] . '">' . $row['region_nama'] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row['region_nama'] . '">' . $row['region_nama'] . '</option>';
            }
        }
        echo json_encode($output);
    }

    public function Get_Request_Data_Kecamatan()
    {
        $provinsi = $this->input->post("provinsi");
        $id = $this->input->post("id");
        $kecamatanId = $this->input->post("kecamatan");
        $data = $this->M_Principle->Get_Data_Kecamatan($provinsi, $id);

        $output = '<option value="">--Pilih kecamatan</option>';
        foreach ($data as $row) {
            if ($kecamatanId) {
                if ($kecamatanId == $row['kode_pos_id']) {
                    $output .= '<option value="' . $row['kode_pos_id'] . '" selected>' . $row['kode_pos_kecamatan'] . '</option>';
                } else {
                    $output .= '<option value="' . $row['kode_pos_id'] . '">' . $row['kode_pos_kecamatan'] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row['kode_pos_id'] . '">' . $row['kode_pos_kecamatan'] . '</option>';
            }
        }

        echo json_encode($output);
    }

    public function Get_Request_Data_Kelurahan()
    {
        $id = $this->input->post("id");
        $kelurahanId = $this->input->post("kelurahan");
        $data = $this->M_Principle->Get_Data_Kelurahan($id);

        $output = '<option value="">--Pilih Kelurahan</option>';
        foreach ($data as $row) {
            if ($kelurahanId) {
                if ($kelurahanId == $row['kode_pos_kelurahan_nama']) {
                    $output .= '<option value="' . $row['kode_pos_kode'] . '" selected>' . $row['kode_pos_kelurahan_nama'] . '</option>';
                } else {
                    $output .= '<option value="' . $row['kode_pos_kode'] . '">' . $row['kode_pos_kelurahan_nama'] . '</option>';
                }
            } else {
                $output .= '<option value="' . $row['kode_pos_kode'] . '">' . $row['kode_pos_kelurahan_nama'] . '</option>';
            }
        }

        echo json_encode($output);
    }

    public function SaveAddNewPrinciple()
    {
        // if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "C")) {
        //     echo 0;
        //     exit();
        // }

        $kode_corporate = $this->input->post("kode_corporate");
        $name_corporate = $this->input->post("name_corporate");
        $address_corporate = $this->input->post("address_corporate");
        $phone_corporate = $this->input->post("phone_corporate");
        // $corporate_group = $this->input->post("corporate_group");
        $lattitude_corporate = $this->input->post("lattitude_corporate");
        $longitude_corporate = $this->input->post("longitude_corporate");
        $stretclass_corporate = $this->input->post("stretclass_corporate");
        $stretclass2_corporate = $this->input->post("stretclass2_corporate");
        $area_corporate = $this->input->post("area_corporate");
        $province = $this->input->post("province");
        $city = $this->input->post("city");
        $districts = $this->input->post("districts");
        $ward = $this->input->post("ward");
        $kodepos_corporate = $this->input->post("kodepos_corporate");
        $name_contact_person = $this->input->post("name_contact_person");
        $phone_contact_person = $this->input->post("phone_contact_person");
        $kreditlimit_contact_person = $this->input->post("kreditlimit_contact_person");
        $IsAktif = $this->input->post("status");

        // $IsAktif = 1;
        $isDeleted = 0;

        $timeoperasional = $this->input->post("timeoperasional");
        $principle_brand = $this->input->post("principle_brand");

        $this->form_validation->set_rules('kode_corporate', 'Kode Corporate', 'trim|required|is_unique[principle.principle_kode]', [
            'is_unique' => 'Kode Principle sudah digunakan',
            'required' => 'Kode Principle tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('name_corporate', 'Nama Corporate', 'trim|required', [
            'required' => 'Nama Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('address_corporate', 'Alamat Corporate', 'trim|required', [
            'required' => 'Alamat Principle tidak boleh kosong!'
        ]);
        // $this->form_validation->set_rules('corporate_group', 'Corporate Group', 'required');
        $this->form_validation->set_rules('phone_corporate', 'Telepon Corporate', 'trim|required|is_unique[principle.principle_telepon]', [
            'is_unique' => 'Telepon Principle sudah digunakan',
            'required' => 'Telepon Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('province', 'Provinsi Corporate', 'trim|required', [
            'required' => 'Provinsi Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('city', 'Kota Corporate', 'trim|required', [
            'required' => 'Kota Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('districts', 'Kecamatan Corporate', 'trim|required', [
            'required' => 'Kecamatan Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('ward', 'Kelurahan Corporate', 'trim|required', [
            'required' => 'Kelurahan Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('kodepos_corporate', 'Kode Pos Corporate', 'trim|required', [
            'is_unique' => 'Kode Pos Principle sudah digunakan'
        ]);
        $this->form_validation->set_rules('lattitude_corporate', 'Lattitude Corporate', 'trim|required|is_unique[principle.principle_latitude]', [
            'is_unique' => 'Latitude Principle sudah digunakan',
            'required' => 'Latitude Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('longitude_corporate', 'Longitude Corporate', 'trim|required|is_unique[principle.principle_longitude]', [
            'is_unique' => 'Longitude Principle sudah digunakan',
            'required' => 'Longitude Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('stretclass_corporate', 'Kelas Jalan berdasarkan barang muatan', 'trim|required', [
            'required' => 'Kelas Jalan berdasarkan barang muatan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('stretclass2_corporate', 'Kelas Jalan berdasarkan fungsi jalan', 'trim|required', [
            'required' => 'Kelas Jalan berdasarkan fungsi jalan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('area_corporate', 'Area Corporate', 'trim|required', [
            'required' => 'Area Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('name_contact_person', 'Nama Contact Person', 'trim|required', [
            'required' => 'Nama Contact Person tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('phone_contact_person', 'Telepon Contact Person', 'trim|required|is_unique[principle.principle_telepon_contact_person]', [
            'is_unique' => 'Telepon Contact Person Sudah digunakan',
            'required' => 'Telepon Contact Person tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('kreditlimit_contact_person', 'Kredit Limit Contact Person', 'trim|required', [
            'required' => 'Kredit Limit Contact Person tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            log_message('debug', validation_errors());

            echo validation_errors();
        } else {

            // $S_UserID = $this->session->userdata('UserID');
            // $S_UserName = $this->session->userdata('UserName');

            $principle_id = $this->M_Principle->Get_NewID();
            $principle_id = $principle_id[0]['NEW_ID'];

            $data = $this->M_Principle->Insert_Principle($principle_id, $kode_corporate, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $isDeleted, $IsAktif);
            // echo json_encode($data);
            if ($data) {
                foreach ($timeoperasional as $val) {
                    $no_urut = $val['no_urut'];
                    $hari = $val['hari'];
                    $buka = $val['buka'];
                    $tutup = $val['tutup'];
                    $status = $val['status'];

                    $this->M_Principle->Insert_Principle_detail($principle_id, $status, $no_urut, $hari, $buka, $tutup);
                }

                foreach ($principle_brand as $value) {
                    $this->M_Principle->Insert_Principle_brand($principle_id, $value);
                }
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function Get_Data_Principle_By_Id()
    {
        $PrincipleID = $this->input->post("PrincipleId");
        // $PrincipleID = "3D887AA5-C47A-4AB6-856E-3BED8E256816";
        $arr = $this->M_Principle->Get_Data_Principle_By_Id($PrincipleID);

        $tmpgroup = [];
        $group = [];

        foreach ($arr as $key => $data) {
            $tmpdata = $data;
            // $brand = $data;
            unset($tmpdata['id']);
            unset($tmpdata['kode']);
            unset($tmpdata['nama']);
            unset($tmpdata['alamat']);
            unset($tmpdata['telepon']);
            unset($tmpdata['provinsi']);
            unset($tmpdata['kota']);
            unset($tmpdata['kecamatan']);
            unset($tmpdata['kelurahan']);
            unset($tmpdata['kodepos']);
            unset($tmpdata['lattitude']);
            unset($tmpdata['longitude']);
            unset($tmpdata['nama_cp']);
            unset($tmpdata['telepon_cp']);
            unset($tmpdata['kredit_limit_cp']);
            unset($tmpdata['kelas_jalan']);
            unset($tmpdata['kelas_jalan2']);
            unset($tmpdata['area']);
            unset($tmpdata['aktif']);
            // unset($brand['id_detail']);
            // unset($brand['buka']);
            // unset($brand['tutup']);
            // unset($brand['hari']);
            // unset($brand['no_urut']);
            // unset($brand['status']);
            $tmpgroup[$data['id']]['id'] = $data['id'];
            $tmpgroup[$data['id']]['kode'] = $data['kode'];
            $tmpgroup[$data['id']]['nama'] = $data['nama'];
            $tmpgroup[$data['id']]['alamat'] = $data['alamat'];
            $tmpgroup[$data['id']]['telepon'] = $data['telepon'];
            $tmpgroup[$data['id']]['provinsi'] = $data['provinsi'];
            $tmpgroup[$data['id']]['kota'] = $data['kota'];
            $tmpgroup[$data['id']]['kecamatan'] = $data['kecamatan'];
            $tmpgroup[$data['id']]['kelurahan'] = $data['kelurahan'];
            $tmpgroup[$data['id']]['kodepos'] = $data['kodepos'];
            $tmpgroup[$data['id']]['lattitude'] = $data['lattitude'];
            $tmpgroup[$data['id']]['longitude'] = $data['longitude'];
            $tmpgroup[$data['id']]['nama_cp'] = $data['nama_cp'];
            $tmpgroup[$data['id']]['telepon_cp'] = $data['telepon_cp'];
            $tmpgroup[$data['id']]['kredit_limit_cp'] = $data['kredit_limit_cp'];
            $tmpgroup[$data['id']]['kelas_jalan'] = $data['kelas_jalan'];
            $tmpgroup[$data['id']]['kelas_jalan2'] = $data['kelas_jalan2'];
            $tmpgroup[$data['id']]['area'] = $data['area'];
            $tmpgroup[$data['id']]['aktif'] = $data['aktif'];
            $tmpgroup[$data['id']]['data'][] = $tmpdata; /* harus tetap ada key-nya, dalam hal ini 'data' */
            // $tmpgroup[$data['id']]['brand'][] = $brand; /* harus tetap ada key-nya, dalam hal ini 'data' */
        }
        foreach ($tmpgroup as $key => $data) {
            $tmpdata = $data;
            unset($tmpdata['id']);
            $group[$data['id']] = $tmpdata;
        }

        echo json_encode($group);
    }

    public function Get_Data_Principle_Brand_By_Id()
    {
        $PrincipleID = $this->input->post("PrincipleId");
        // $PrincipleID = "3D887AA5-C47A-4AB6-856E-3BED8E256816";
        $Databrand = $this->M_Principle->Get_Data_Principle_Brand_By_Id($PrincipleID);

        $cek_principle_brand_id = $this->db->select("principle_brand_id")->from("sku")->get()->result_array();
        $arr = array();
        foreach ($cek_principle_brand_id as $key => $data) {
            $arr[] = $data['principle_brand_id'];
        }

        $html = '';
        foreach ($Databrand as $value) {
            if (in_array($value['id'], $arr)) {
                $html .= '<div class="new-row"><input type="hidden" name="txthidePrincipleBrandId_update" class="form-control" value="' . $value['id'] . '" /><button type="button" class="principle-brand-btn-no-delete" data-toggle="tooltip" data-placement="top" title="Tidak bisa delete brand ini" disabled><span></span><text class="check-length">' . $value['nama'] . '</text></button><input type="hidden" name="data_principle_brand_update" class="form-control" value="' . $value['nama'] . '" /></div>';
                // $html .= 'ada <br>';
            } else {
                // $html .= 'tidak ada <br>';
                $html .= '<div class="new-row"><input type="hidden" name="txthidePrincipleBrandId_update" class="form-control" value="' . $value['id'] . '" /><button type="button" class="principle-brand-btn"><span></span><text class="check-length">' . $value['nama'] . '</text></button><input type="hidden" name="data_principle_brand_update" class="form-control" value="' . $value['nama'] . '" /></div>';
            }
        }
        echo json_encode($html);
    }

    // public function get_data_sku_by_principle_brand()
    // {
    //     $query = $this->db->select("principle_brand_id")->from("sku")->get()->result_array();
    //     echo json_encode($query);
    // }

    public function SaveUpdatePrinciple()
    {
        if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "U")) {
            echo 0;
            exit();
        }

        $principle_id = $this->input->post("principle_id");
        $principle_brand_id = $this->input->post("principle_brand_id");
        $principle_brand = $this->input->post("principle_brand");
        $kode_corporate = $this->input->post("kode_corporate_update");
        $name_corporate = $this->input->post("name_corporate_update");
        $address_corporate = $this->input->post("address_corporate_update");
        $phone_corporate = $this->input->post("phone_corporate_update");
        // $corporate_group = $this->input->post("corporate_group_update");
        $lattitude_corporate = $this->input->post("lattitude_corporate_update");
        $longitude_corporate = $this->input->post("longitude_corporate_update");
        $stretclass_corporate = $this->input->post("stretclass_corporate_update");
        $stretclass2_corporate = $this->input->post("stretclass2_corporate_update");
        $area_corporate = $this->input->post("area_corporate_update");
        $province = $this->input->post("province_update");
        $city = $this->input->post("city_update");
        $districts = $this->input->post("districts_update");
        $ward = $this->input->post("ward_update");
        $kodepos_corporate = $this->input->post("kodepos_corporate_update");
        $name_contact_person = $this->input->post("name_contact_person_update");
        $phone_contact_person = $this->input->post("phone_contact_person_update");
        $kreditlimit_contact_person = $this->input->post("kreditlimit_contact_person_update");
        $timeoperasionall = $this->input->post("timeoperasional_update");
        $status = $this->input->post("status");


        $this->form_validation->set_rules('kode_corporate_update', 'Kode Corporate', 'trim|required', [
            'required' => 'Kode Principle tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('name_corporate_update', 'Nama Corporate', 'trim|required', [
            'required' => 'Nama Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('address_corporate_update', 'Alamat Corporate', 'trim|required', [
            'required' => 'Alamat Principle tidak boleh kosong!'
        ]);
        // $this->form_validation->set_rules('corporate_group', 'Corporate Group', 'required');
        $this->form_validation->set_rules('phone_corporate_update', 'Telepon Corporate', 'trim|required', [
            'required' => 'Telepon Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('province_update', 'Provinsi Corporate', 'trim|required', [
            'required' => 'Provinsi Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('city_update', 'Kota Corporate', 'trim|required', [
            'required' => 'Kota Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('districts_update', 'Kecamatan Corporate', 'trim|required', [
            'required' => 'Kecamatan Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('ward_update', 'Kelurahan Corporate', 'trim|required', [
            'required' => 'Kelurahan Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('kodepos_corporate_update', 'Kode Pos Corporate', 'trim|required', [
            'is_unique' => 'Kode Pos Principle sudah digunakan'
        ]);
        $this->form_validation->set_rules('lattitude_corporate_update', 'Lattitude Corporate', 'trim|required', [
            'required' => 'Latitude Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('longitude_corporate_update', 'Longitude Corporate', 'trim|required', [
            'required' => 'Longitude Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('stretclass_corporate_update', 'Kelas Jalan berdasarkan barang muatan', 'trim|required', [
            'required' => 'Kelas Jalan berdasarkan barang muatan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('stretclass2_corporate_update', 'Kelas Jalan berdasarkan fungsi jalan', 'trim|required', [
            'required' => 'Kelas Jalan berdasarkan fungsi jalan tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('area_corporate_update', 'Area Corporate', 'trim|required', [
            'required' => 'Area Principle tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('name_contact_person_update', 'Nama Contact Person', 'trim|required', [
            'required' => 'Nama Contact Person tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('phone_contact_person_update', 'Telepon Contact Person', 'trim|required', [
            'required' => 'Telepon Contact Person tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('kreditlimit_contact_person_update', 'Kredit Limit Contact Person', 'trim|required', [
            'required' => 'Kredit Limit Contact Person tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            log_message('debug', validation_errors());

            echo validation_errors();
        } else {

            $S_UserID = $this->session->userdata('UserID');
            $S_UserName = $this->session->userdata('UserName');

            $data = $this->M_Principle->Update_Principle($principle_id, $kode_corporate, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $status);


            // echo json_encode($data);

            if ($data) {
                $res = array();
                if ($timeoperasionall != null) {
                    foreach ($timeoperasionall as $val) {
                        $id_detail = $val['id_detail'];
                        $no_urut = $val['no_urut'];
                        $hari = $val['hari'];
                        $buka = $val['buka'];
                        $tutup = $val['tutup'];
                        $status = $val['status'];

                        $res = $this->M_Principle->Insert_Principle_detail($principle_id, $status, $no_urut, $hari, $buka, $tutup);
                        if ($res) {
                            $this->db->where_in('principle_detail_id', $id_detail);
                            $this->db->delete('principle_detail');
                        } else {
                            echo 'gagal';
                        }
                    }
                }

                $cek_brand_id = $this->db->select("principle_brand_id, principle_brand_nama")->from("principle_brand")->where("principle_id", $principle_id)->get()->result_array();
                $arr_id = array();
                $arr_nama = array();
                foreach ($cek_brand_id as $key => $data) {
                    $arr_id[] = $data['principle_brand_id'];
                    $arr_nama[] = $data['principle_brand_nama'];
                }


                $updateArray = array();
                if (count($principle_brand_id) != count($arr_id)) {
                    //check jika ada yg didelete makan delete juga di database
                    $this->db->where('principle_id', $principle_id);
                    $this->db->where_not_in('principle_brand_id', $principle_brand_id);
                    $this->db->delete('principle_brand');
                } else if (count($principle_brand_id) == count($arr_id)) {
                    //check jika ada di database maka update
                    foreach ($principle_brand_id as $key => $asu) {
                        if (in_array($asu, $arr_id)) {
                            $updateArray[] = array(
                                'principle_brand_id' => $principle_brand_id[$key],
                                'principle_brand_nama' => $principle_brand[$key],
                            );
                            $this->db->update_batch('principle_brand', $updateArray, 'principle_brand_id');
                        }
                    }
                }

                //check jika di database tidak ada maka insert
                foreach ($principle_brand as $value) {
                    if (!in_array($value, $arr_nama)) {
                        $this->M_Principle->Insert_Principle_brand($principle_id, $value);
                    }
                }

                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function DeletePrincipleMenu()
    {

        if (!$this->M_Menu->CheckMenu($this->session->userdata('pengguna_grup_id'), $this->MenuKode, "D")) {
            echo 0;
            exit();
        }

        $this->form_validation->set_rules('PrincipleID', 'ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            log_message('debug', validation_errors());

            echo validation_errors();
        } else {
            $PrincipleID = $this->input->post('PrincipleID');

            $result = $this->M_Principle->Delete_Principle($PrincipleID);

            echo $result;
        }
    }
}
