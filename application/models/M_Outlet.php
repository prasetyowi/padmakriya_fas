<?php
class M_Outlet extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_DataTable']);
    }

    public function Get_Outlet()
    {
        $query = $this->db->query("SELECT c.client_pt_id, 
                                        c.client_pt_nama, c.client_pt_alamat, c.client_pt_telepon, c.client_pt_nama_contact_person, c.client_pt_telepon_contact_person, c.client_pt_email_contact_person, c.client_pt_is_aktif, c.client_pt_segmen_id1, s.client_pt_segmen_nama
                                    FROM client_pt AS c
                                    LEFT JOIN client_pt_segmen AS s ON c.client_pt_segmen_id1 = s.client_pt_segmen_id
                                    WHERE c.client_pt_is_deleted = 0
                                    ORDER BY c.client_pt_nama");
        // $this->db->select("client_pt_id, client_pt_nama, client_pt_alamat, client_pt_telepon, client_pt_nama_contact_person, client_pt_telepon_contact_person, client_pt_email_contact_person, client_pt_is_aktif")
        //     ->from("client_pt")
        //     ->where("client_pt_is_deleted", 0)
        //     ->order_by("client_pt_nama");
        // $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getDetailClientPTPrinciple($id)
    {
        $query = $this->db->query("SELECT a.client_pt_principle_id, b.principle_kode, a.client_pt_principle_top, a.client_pt_principle_kredit_limit, client_pt_principle_is_kredit, ISNULL(c1.client_pt_segmen_nama, '') AS segmen1, ISNULL(c2.client_pt_segmen_nama, '') AS segmen2,
                                    ISNULL(c3.client_pt_segmen_nama, '') AS segmen3, a.client_pt_principle_maks_invoice, a.alamat_penagihan_beda, d.client_pt_alamat, a.client_pt_principle_top_retur
                                    FROM client_pt_principle a
                                    LEFT JOIN principle b ON a.principle_id = b.principle_id
                                    LEFT JOIN client_pt_segmen c1 ON a.client_pt_segment_id1 = c1.client_pt_segmen_id
                                    LEFT JOIN client_pt_segmen c2 ON a.client_pt_segment_id2 = c2.client_pt_segmen_id
                                    LEFT JOIN client_pt_segmen c3 ON a.client_pt_segment_id3 = c2.client_pt_segmen_id
                                    LEFT JOIN client_pt d ON a.client_pt_id_penagihan = d.client_pt_id
                                    WHERE a.client_pt_id = '$id'
                                    ORDER BY b.principle_kode ASC");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function count_all_data()
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('client_pt c');
        $this->db->join('client_pt_segmen s', 'c.client_pt_segmen_id1 = s.client_pt_segmen_id', 'left');
        $this->db->where('c.client_pt_is_deleted', 0);

        return $this->db->get()->row_array();
    }
    public function get_filtered_data($start, $length, $search_value, $order_column, $order_dir)
    {
        // fungsi false sebagai teks SQL mentah dan bukan sebagai ekspresi yang disisipkan langsung ke dalam query yang dibangun oleh CodeIgniter. contoh (format date sql server)
        $this->db->select("c.client_pt_id, 
        c.client_pt_nama, c.client_pt_alamat, c.client_pt_telepon, c.client_pt_nama_contact_person, c.client_pt_telepon_contact_person, c.client_pt_email_contact_person, CASE WHEN c.client_pt_is_aktif = 0 THEN 'Non Aktif' ELSE 'Aktif' END AS Status_PT, c.client_pt_segmen_id1, s.client_pt_segmen_nama", FALSE);
        $this->db->from('client_pt c');
        $this->db->join('client_pt_segmen s', 'c.client_pt_segmen_id1 = s.client_pt_segmen_id', 'left');
        $this->db->where('c.client_pt_is_deleted', 0);
        $this->db->where_not_in('s.client_pt_segmen_kode', 'INT');

        // Kolom yang dapat diurutkan
        $sortable_columns = array(
            'client_pt_nama',
            'client_pt_nama_contact_person',
            'client_pt_alamat',
            'client_pt_segmen_nama'
        );

        // Kolom yang dapat dicari
        $searchable_columns = array(
            'client_pt_nama',
            'client_pt_nama_contact_person',
            "client_pt_alamat",
            'client_pt_segmen_nama'
        );

        // Cari
        if (!empty($search_value)) {
            $search_value = $this->db->escape_str($search_value);
            $this->db->group_start();
            foreach ($searchable_columns as $column) {
                $this->db->or_like($column, $search_value);
            }
            $this->db->group_end();
        }

        // Urutkan
        if ($order_column == 0) {
            $this->db->order_by('c.client_pt_nama', 'desc');
        } else {
            if ($order_column <= count($sortable_columns)) {
                $this->db->order_by($sortable_columns[$order_column], $order_dir);
            }
        }

        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }
    public function count_all_dataInternal()
    {

        $this->db->select('COUNT(*) as total');
        $this->db->from('client_pt c');
        $this->db->join('client_pt_segmen s', 'c.client_pt_segmen_id1 = s.client_pt_segmen_id', 'left');
        $this->db->where('c.client_pt_is_deleted', 0);
        $this->db->where('s.client_pt_segmen_kode', 'INT');

        return $this->db->get()->row_array();
    }
    public function get_filtered_dataInternal($start, $length, $search_value, $order_column, $order_dir)
    {
        // fungsi false sebagai teks SQL mentah dan bukan sebagai ekspresi yang disisipkan langsung ke dalam query yang dibangun oleh CodeIgniter. contoh (format date sql server)
        $this->db->select("c.client_pt_id, 
        c.client_pt_nama, c.client_pt_alamat, c.client_pt_telepon, c.client_pt_nama_contact_person, c.client_pt_telepon_contact_person, c.client_pt_email_contact_person, CASE WHEN c.client_pt_is_aktif = 0 THEN 'Non Aktif' ELSE 'Aktif' END AS Status_PT, c.client_pt_segmen_id1, s.client_pt_segmen_nama", FALSE);
        $this->db->from('client_pt c');
        $this->db->join('client_pt_segmen s', 'c.client_pt_segmen_id1 = s.client_pt_segmen_id', 'left');
        $this->db->where('c.client_pt_is_deleted', 0);
        $this->db->where('s.client_pt_segmen_kode', 'INT');

        // Kolom yang dapat diurutkan
        $sortable_columns = array(
            'client_pt_nama',
            'client_pt_nama_contact_person',
            'client_pt_alamat',
            'client_pt_segmen_nama'
        );

        // Kolom yang dapat dicari
        $searchable_columns = array(
            'client_pt_nama',
            'client_pt_nama_contact_person',
            "client_pt_alamat",
            'client_pt_segmen_nama'
        );

        // Cari
        if (!empty($search_value)) {
            $search_value = $this->db->escape_str($search_value);
            $this->db->group_start();
            foreach ($searchable_columns as $column) {
                $this->db->or_like($column, $search_value);
            }
            $this->db->group_end();
        }

        // Urutkan
        if ($order_column == 0) {
            $this->db->order_by('c.client_pt_nama', 'desc');
        } else {
            if ($order_column <= count($sortable_columns)) {
                $this->db->order_by($sortable_columns[$order_column], $order_dir);
            }
        }

        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }
    // new ver
    public function get_dt_outlet_cabang()
    {
        $sql = "SELECT
                    c.client_pt_id,
                    c.client_pt_nama,
                    c.client_pt_alamat,
                    c.client_pt_telepon,
                    c.client_pt_nama_contact_person,
                    c.client_pt_telepon_contact_person,
                    c.client_pt_email_contact_person,
                    c.client_pt_segmen_id1,
                    s.client_pt_segmen_nama,
                    CASE
                        WHEN c.client_pt_is_aktif = 0 THEN 'Non Aktif'
                        ELSE 'Aktif'
                    END AS Status_PT,
                    COUNT(DISTINCT masar.masar_id) AS is_masar,
                    COUNT(DISTINCT masap.masap_id) AS is_masap
                    FROM client_pt c
                    LEFT JOIN client_pt_principle AS p
                    ON p.client_pt_id = c.client_pt_id
                    LEFT JOIN BackOffice.dbo.masar
                    ON masar.client_pt_principle_id = p.client_pt_principle_id
                    LEFT JOIN BackOffice.dbo.masap
                    ON masap.client_pt_id = c.client_pt_id
                    LEFT JOIN client_pt_segmen s
                    ON c.client_pt_segmen_id1 = s.client_pt_segmen_id
                    WHERE c.client_pt_is_deleted = 0
                    AND s.client_pt_segmen_kode NOT IN ('INT')
                    GROUP BY c.client_pt_id,
                            c.client_pt_nama,
                            c.client_pt_alamat,
                            c.client_pt_telepon,
                            c.client_pt_nama_contact_person,
                            c.client_pt_telepon_contact_person,
                            c.client_pt_email_contact_person,
                            c.client_pt_segmen_id1,
                            s.client_pt_segmen_nama,
                            CASE
                                WHEN c.client_pt_is_aktif = 0 THEN 'Non Aktif'
                                ELSE 'Aktif'
                            END";
        $response = $this->M_DataTable->dtTableGetList($sql);

        $output = array(
            "draw" => $response['draw'],
            "recordsTotal" => $response['recordsTotal'],
            "recordsFiltered" => $response['recordsFiltered'],
            "data" => $response['data'],
        );
        return $output;
    }


    // -----------------------------------------------------------------------
    public function getInternal()
    {
        $depo_id = $this->session->userdata('depo_id');
        $query = $this->db->query("SELECT d.depo_alamat, d.depo_no_telp, a.area_header_id, a.area_header_nama
                                    FROM depo AS d
                                    LEFT JOIN area_header AS a ON d.area_header_id = a.area_header_id
                                    WHERE d.depo_id = '$depo_id'");

        if ($query->num_rows() == 0) {
            $query = [];
        } else {
            $query = $query->row_array();
        }

        return $query;
    }

    public function getOutletCorporate()
    {
        $this->db->select("client_pt_corporate_id, client_pt_corporate_nama, client_pt_corporate_alamat, client_pt_corporate_telepon, client_pt_corporate_nama_contact_person, client_pt_corporate_telepon_contact_person, client_pt_corporate_email_contact_person, client_pt_corporate_is_aktif")
            ->from("client_pt_corporate")
            ->where("client_pt_corporate_is_deleted", 0)
            ->order_by("client_pt_corporate_nama");
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function getDataOutletById($outletID, $type)
    {
        if ($type == 'head') {
            return $this->db->query("SELECT a.client_pt_corporate_propinsi as provinsi, 
                                            a.client_pt_corporate_kota as kota, 
                                            a.client_pt_corporate_kecamatan as kecamatan, 
                                            a.client_pt_corporate_kelurahan as kelurahan, 
                                            a.client_pt_corporate_kodepos as kodepos, 
                                            a.kelas_jalan_id as kelas_jalan, 
                                            a.area_id as area, 
                                            a.kelas_jalan_id2 as kelas_jalan2, 
                                            a.client_pt_corporate_segmen_id1 as segment1, 
                                            a.client_pt_corporate_segmen_id2 as segment2, 
                                            a.client_pt_corporate_segmen_id3 as segment3,
                                            b.kode_pos_id,
                                            b.kode_pos_kecamatan as nama_kode_pos_kecamatan,
                                            c.lokasi_outlet_id,
                                            c.lokasi_outlet_nama
                                    FROM client_pt_corporate a
                                    LEFT JOIN kode_pos b ON a.client_pt_corporate_propinsi = b.kode_pos_propinsi
                                        AND a.client_pt_corporate_kota = b.kode_pos_kabupaten
                                        AND a.client_pt_corporate_kecamatan = b.kode_pos_kecamatan
                                    LEFT JOIN lokasi_outlet c ON b.kode_pos_id = c.kode_pos_id
                                    WHERE a.client_pt_corporate_id = '$outletID'")->row();
        }

        if ($type == 'cabang') {
            return $this->db->query("SELECT a.client_pt_propinsi as provinsi, 
                                            a.client_pt_kota as kota, 
                                            a.client_pt_kecamatan as kecamatan, 
                                            a.client_pt_kelurahan as kelurahan, 
                                            a.client_pt_kodepos as kodepos, 
                                            a.kelas_jalan_id as kelas_jalan, 
                                            a.area_id as area, 
                                            a.kelas_jalan2_id as kelas_jalan2, 
                                            a.client_pt_segmen_id1 as segment1, 
                                            a.client_pt_segmen_id2 as segment2, 
                                            a.client_pt_segmen_id3 as segment3, 
                                            a.lokasi_outlet_id as outlet_id,
                                            b.kode_pos_id,
                                            b.kode_pos_kecamatan as nama_kode_pos_kecamatan,
                                            c.lokasi_outlet_id,
                                            c.lokasi_outlet_nama
                                    FROM client_pt a
                                    LEFT JOIN kode_pos b ON a.client_pt_propinsi = b.kode_pos_propinsi
                                        AND a.client_pt_kota = b.kode_pos_kabupaten
                                        AND a.client_pt_kecamatan = b.kode_pos_kecamatan
                                    LEFT JOIN lokasi_outlet c ON b.kode_pos_id = c.kode_pos_id
                                    WHERE a.client_pt_id = '$outletID'")->row();
        }
    }

    public function Get_Outlet_By_Id($OutletId)
    {
        return $this->db->select("client_pt_propinsi as provinsi, client_pt_kota as kota, client_pt_kecamatan as kecamatan, client_pt_kelurahan as kelurahan, client_pt_kodepos as kodepos, kelas_jalan_id as kelas_jalan, area_id as area, kelas_jalan2_id as kelas_jalan2, client_pt_segmen_id1 as segment1, client_pt_segmen_id2 as segment2, client_pt_segmen_id3 as segment3, lokasi_outlet_id as outlet_id")
            ->from("client_pt")
            ->where("client_pt_id", $OutletId)->get()->row_array();
    }

    public function getDataById($id)
    {
        return $this->db->get_where('client_pt', array('client_pt_id' => $id))->row_array();
    }

    public function Get_Kecamatan_Id($res)
    {
        $provinsi = $res['provinsi'] != null ? $res['provinsi'] : '';
        $kota = $res['kota'] != null ? $res['kota'] : '';
        $kecamatan = $res['kecamatan'] != null ? $res['kecamatan'] : '';
        $kelurahan = $res['kelurahan'] != null ? $res['kelurahan'] : '';
        $kodepos = $res['kodepos'] != null ? $res['kodepos'] : '';
        $kelas_jalan = $res['kelas_jalan'] != null ? $res['kelas_jalan'] : '';
        $area = $res['area'] != null ? $res['area'] : '';
        $kelas_jalan2 = $res['kelas_jalan2'] != null ? $res['kelas_jalan2'] : '';
        $segment1 = $res['segment1'] != null ? $res['segment1'] : '';
        $segment2 = $res['segment2'] != null ? $res['segment2'] : '';
        $segment3 = $res['segment3'] != null ? $res['segment3'] : '';
        $outlet_id = $res['outlet_id'] != null ? $res['outlet_id'] : '';
        $query = $this->db->select("kode_pos_id, kode_pos_kecamatan")
            ->from("kode_pos")
            ->where("kode_pos_propinsi", $provinsi)
            ->where("kode_pos_kabupaten", $kota)
            ->where("kode_pos_kecamatan", $kecamatan)
            ->get()->row_array();
        $arr[] = ['provinsi' => $provinsi, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'kodepos' => $kodepos, 'kelas_jalan' => $kelas_jalan, 'area' => $area, 'kelas_jalan2' => $kelas_jalan2, 'segment1' => $segment1, 'segment2' => $segment2, 'segment3' => $segment3, 'outlet_id' => $outlet_id, 'kode_pos_id' => $query['kode_pos_id'], 'nama_kode_pos_kecamatan' => $query['kode_pos_kecamatan']];
        // var_dump($provinsi, $kota, $kecamatan);
        // die;
        return $arr;
    }

    public function Get_Outlet_Kec_Id($val)
    {
        $query = $this->db->select("kode_pos_kelurahan_nama, kode_pos_kode")
            ->from("kode_pos_detail")
            ->where("kode_pos_id", $val[0]['kode_pos_id'])
            ->where("kode_pos_kelurahan_nama", $val[0]['kelurahan'])
            ->get()->row_array();
        $arr[] = ['provinsi' => $val[0]['provinsi'], 'kota' => $val[0]['kota'], 'kecamatan' => $val[0]['kecamatan'], 'kelurahan' => $val[0]['kelurahan'], 'kodepos' => $val[0]['kodepos'], 'kode_pos_id' => $val[0]['kode_pos_id']];
        return $arr;
    }

    public function Get_All_Id($value)
    {
        $arr = array();
        $query = $this->db->select("lokasi_outlet_id, lokasi_outlet_nama")
            ->from("lokasi_outlet")
            ->where("kode_pos_id", $value[0]['kode_pos_id'])->get();

        $query = $query->result_array();
        // if ($query->num_rows() > 0) {
        //     return $query->result_array();
        // } else {
        //     return array();
        // }
        foreach ($query as $data) {
            if ($value[0]['outlet_id'] != null) {
                if ($value[0]['outlet_id'] == $data['lokasi_outlet_id']) {
                    $arr[] = ['provinsi' => $value[0]['provinsi'], 'kota' => $value[0]['kota'], 'kecamatan' => $value[0]['kecamatan'], 'kelurahan' => $value[0]['kelurahan'], 'kodepos' => $value[0]['kodepos'], 'kelas_jalan' => $value[0]['kelas_jalan'], 'area' => $value[0]['area'], 'kelas_jalan2' => $value[0]['kelas_jalan2'], 'segment1' => $value[0]['segment1'], 'segment2' => $value[0]['segment2'], 'segment3' => $value[0]['segment3'], 'kode_pos_id' => $value[0]['kode_pos_id'], 'lokasi_outlet_id' => $data['lokasi_outlet_id'], 'lokasi_outlet_nama' => $data['lokasi_outlet_nama']];
                }
            } else {
                $arr[] = ['provinsi' => $value[0]['provinsi'], 'kota' => $value[0]['kota'], 'kecamatan' => $value[0]['kecamatan'], 'kelurahan' => $value[0]['kelurahan'], 'kodepos' => $value[0]['kodepos'], 'kelas_jalan' => $value[0]['kelas_jalan'], 'area' => $value[0]['area'], 'kelas_jalan2' => $value[0]['kelas_jalan2'], 'segment1' => $value[0]['segment1'], 'segment2' => $value[0]['segment2'], 'segment3' => $value[0]['segment3'], 'kode_pos_id' => $value[0]['kode_pos_id']];
            }
        }
        // var_dump($query->result());
        // die;
        return $arr;
    }

    public function Get_Data_Provinsi()
    {
        $this->db->select("reffregion_tier, reffregion_nama")
            ->from("region")
            ->distinct()
            ->where("reffregion_tier", 2)
            ->order_by("reffregion_nama");
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function Get_Data_Kota($provinsi)
    {
        $query = $this->db->select("region_nama")
            ->from("region")
            ->where("reffregion_nama", $provinsi)
            ->order_by("region_nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Kecamatan($provinsi, $kota)
    {
        $query = $this->db->select("kode_pos_id, kode_pos_kecamatan")
            ->from("kode_pos")
            ->where("kode_pos_propinsi", $provinsi)
            ->where("kode_pos_kabupaten", $kota)
            ->order_by("kode_pos_kecamatan", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Kelurahan($id)
    {
        $query = $this->db->select("kode_pos_kelurahan_nama, kode_pos_kode")
            ->from("kode_pos_detail")
            ->where("kode_pos_id", $id)
            ->order_by("kode_pos_kelurahan_nama", "ASC")
            ->get()->result_array();

        return $query;
    }

    public function Get_Data_KelasJalan()
    {
        $query = $this->db->select("kelas_jalan_id as id, kelas_jalan_nama as nama")
            ->from("kelas_jalan")
            ->where("kelas_jalan_klasifikasi", "Beban Muatan")
            ->order_by("kelas_jalan_nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_KelasJalan2()
    {
        $query = $this->db->select("kelas_jalan_id as id, kelas_jalan_nama as nama")
            ->from("kelas_jalan")
            ->where("kelas_jalan_klasifikasi", "Fungsi Jalan")
            ->order_by("kelas_jalan_nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Area_Header()
    {
        $query = $this->db->select("area_header_id as id, area_header_nama as nama")
            ->from("area_header")
            ->distinct()
            ->where("area_header_is_aktif", 1)
            ->order_by("area_header_nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Area()
    {
        $query = $this->db->select("area_id as id, area_nama as nama")
            ->from("area")
            ->distinct()
            ->order_by("nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Area_By_ID($area_header_id)
    {
        $query = $this->db->select("area_id as id, area_nama as nama")
            ->from("area")
            ->distinct()
            ->where("area_header_id", $area_header_id)
            ->order_by("nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Segmen1()
    {
        $query = $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
            ->from("client_pt_segmen")
            ->where('client_pt_segmen_level', 1)
            ->order_by("nama", "ASC")
            ->get()->result_array();
        return $query;
    }

    public function Get_Data_Segmen2($SegmentId)
    {
        $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
            ->from("client_pt_segmen");

        if ($SegmentId != '') {
            $this->db->where("client_pt_segmen_reff_id", $SegmentId);
        }

        $this->db->order_by("client_pt_segmen_nama", "ASC");
        $query = $this->db->get()->result_array();
        return $query;
    }


    public function Get_Data_Segmen3($SegmentId2)
    {
        $this->db->select("client_pt_segmen_id as id, client_pt_segmen_nama as nama")
            ->from("client_pt_segmen")
            ->where("client_pt_segmen_level", 3)
            ->order_by("client_pt_segmen_nama", "ASC");

        if ($SegmentId2 != '') {
            $this->db->where("client_pt_segmen_reff_id", $SegmentId2);
        }

        $query = $this->db->get()->result_array();
        return $query;
    }


    public function Get_Data_Multi_lokasi($kode_id)
    {
        $query = $this->db->select("lokasi_outlet_id as id,
                            lokasi_outlet_nama as nama")
            ->from("lokasi_outlet")
            // ->join("kode_pos", "kode_pos.kode_pos_id = lokasi_outlet.kode_pos_id")
            ->distinct()
            ->where("kode_pos_id", $kode_id)
            // ->where("area_id", $area)
            ->get()->result_array();

        return $query;
    }

    public function Insert_Outlet($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $isValidMultiLocation, $listcontactperson_location, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp)
    {
        $name_corporate = $name_corporate == '' ? null : $name_corporate;
        $address_corporate = $address_corporate == '' ? null : $address_corporate;
        $phone_corporate = $phone_corporate == '' ? null : $phone_corporate;
        $lattitude_corporate = $lattitude_corporate == '' ? null : $lattitude_corporate;
        $longitude_corporate = $longitude_corporate == '' ? null : $longitude_corporate;
        $name_contact_person = $name_contact_person == '' ? null : $name_contact_person;
        $phone_contact_person = $phone_contact_person == '' ? null : $phone_contact_person;
        $kreditlimit_contact_person = $kreditlimit_contact_person == '' ? null : $kreditlimit_contact_person;
        $stretclass_corporate = $stretclass_corporate == '' ? null : $stretclass_corporate;
        $stretclass2_corporate = $stretclass2_corporate == '' ? null : $stretclass2_corporate;
        $area_corporate = $area_corporate == '' ? null : $area_corporate;
        $province = $province == '' ? null : $province;
        $city = $city == '' ? null : $city;
        $districts = $districts == '' ? null : $districts;
        $ward = $ward == '' ? null : $ward;
        $kodepos_corporate = $kodepos_corporate == '' ? null : $kodepos_corporate;
        $segment1_contact_person = $segment1_contact_person == '' ? null : $segment1_contact_person;
        $segment2_contact_person = $segment2_contact_person == '' ? null : $segment2_contact_person;
        $segment3_contact_person = $segment3_contact_person == '' ? null : $segment3_contact_person;
        $isDeleted = $isDeleted == '' ? null : $isDeleted;
        $IsAktif = $IsAktif == '' ? null : $IsAktif;
        $isValidMultiLocation = $isValidMultiLocation == '' ? null : $isValidMultiLocation;
        $listcontactperson_location = $listcontactperson_location == '' ? null : $listcontactperson_location;
        $client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
        $client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
        $client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;

        $this->db->set("client_pt_id", $outlet_id);
        $this->db->set("client_pt_nama", $name_corporate);
        $this->db->set("client_pt_alamat", $address_corporate);
        $this->db->set("client_pt_telepon", $phone_corporate);
        $this->db->set("client_pt_latitude", $lattitude_corporate);
        $this->db->set("client_pt_longitude", $longitude_corporate);
        $this->db->set("client_pt_propinsi", $province);
        $this->db->set("client_pt_kota", $city);
        $this->db->set("client_pt_kecamatan", $districts);
        $this->db->set("client_pt_kelurahan", $ward);
        $this->db->set("client_pt_kodepos", $kodepos_corporate);
        $this->db->set("client_pt_nama_contact_person", $name_contact_person);
        $this->db->set("client_pt_telepon_contact_person", $phone_contact_person);
        $this->db->set("client_pt_kredit_limit", $kreditlimit_contact_person);
        $this->db->set("kelas_jalan_id", $stretclass_corporate);
        $this->db->set("area_id", $area_corporate);
        // $this->db->set("unit_mandiri_id", $UnitMandiriId);
        $this->db->set("client_pt_is_deleted", $isDeleted);
        $this->db->set("client_pt_is_aktif", $IsAktif);
        $this->db->set("client_pt_is_multi_lokasi", $isValidMultiLocation);
        $this->db->set("lokasi_outlet_id", $listcontactperson_location);
        $this->db->set("kelas_jalan2_id", $stretclass2_corporate);
        $this->db->set("client_pt_fax", $client_pt_fax);
        $this->db->set("client_pt_npwp", $client_pt_npwp);
        $this->db->set("client_pt_status_pkp", $client_pt_status_pkp);

        if ($segment1_contact_person != "") {
            $this->db->set("client_pt_segmen_id1", $segment1_contact_person);
        }
        if ($segment2_contact_person != "") {
            $this->db->set("client_pt_segmen_id2", $segment2_contact_person);
        }
        if ($segment3_contact_person != "") {
            $this->db->set("client_pt_segmen_id3", $segment3_contact_person);
        }

        $this->db->insert("client_pt");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function Insert_Internal(
        $outlet_id,
        $name_corporate,
        $address_corporate,
        $phone_corporate,
        $lattitude_corporate,
        $longitude_corporate,
        $name_contact_person,
        $phone_contact_person,
        $kreditlimit_contact_person,
        $area_corporate,
        $province,
        $city,
        $districts,
        $ward,
        $kodepos_corporate,
        $segment1_contact_person,
        $segment2_contact_person,
        $segment3_contact_person,
        $isDeleted,
        $IsAktif,
        $isValidMultiLocation,
        $listcontactperson_location,
        $stretclass_corporate,
        $stretclass2_corporate,
        $client_pt_fax,
        $client_pt_npwp,
        $client_pt_status_pkp
    ) {

        $name_corporate = $name_corporate == '' ? null : $name_corporate;
        $address_corporate = $address_corporate == '' ? null : $address_corporate;
        $phone_corporate = $phone_corporate == '' ? null : $phone_corporate;
        $lattitude_corporate = $lattitude_corporate == '' ? null : $lattitude_corporate;
        $longitude_corporate = $longitude_corporate == '' ? null : $longitude_corporate;
        $name_contact_person = $name_contact_person == '' ? null : $name_contact_person;
        $phone_contact_person = $phone_contact_person == '' ? null : $phone_contact_person;
        $kreditlimit_contact_person = $kreditlimit_contact_person == '' ? null : $kreditlimit_contact_person;
        $area_corporate = $area_corporate == '' ? null : $area_corporate;
        $province = $province == '' ? null : $province;
        $city = $city == '' ? null : $city;
        $districts = $districts == '' ? null : $districts;
        $ward = $ward == '' ? null : $ward;
        $kodepos_corporate = $kodepos_corporate == '' ? null : $kodepos_corporate;
        $segment1_contact_person = $segment1_contact_person == '' ? null : $segment1_contact_person;
        $segment2_contact_person = $segment2_contact_person == '' ? null : $segment2_contact_person;
        $segment3_contact_person = $segment3_contact_person == '' ? null : $segment3_contact_person;
        $isDeleted = $isDeleted == '' ? null : $isDeleted;
        $IsAktif = $IsAktif == '' ? null : $IsAktif;
        $isValidMultiLocation = $isValidMultiLocation == '' ? null : $isValidMultiLocation;
        $listcontactperson_location = $listcontactperson_location == '' ? null : $listcontactperson_location;
        $stretclass_corporate = $stretclass_corporate == '' ? null : $stretclass_corporate;
        $stretclass2_corporate = $stretclass2_corporate == '' ? null : $stretclass2_corporate;
        $client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
        $client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
        $client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;

        $this->db->set("client_pt_id", $outlet_id);
        $this->db->set("client_pt_nama", $name_corporate);
        $this->db->set("client_pt_alamat", $address_corporate);
        $this->db->set("client_pt_telepon", $phone_corporate);
        $this->db->set("client_pt_latitude", $lattitude_corporate);
        $this->db->set("client_pt_longitude", $longitude_corporate);
        $this->db->set("client_pt_propinsi", $province);
        $this->db->set("client_pt_kota", $city);
        $this->db->set("client_pt_kecamatan", $districts);
        $this->db->set("client_pt_kelurahan", $ward);
        $this->db->set("client_pt_kodepos", $kodepos_corporate);
        $this->db->set("client_pt_nama_contact_person", $name_contact_person);
        $this->db->set("client_pt_telepon_contact_person", $phone_contact_person);
        $this->db->set("client_pt_kredit_limit", $kreditlimit_contact_person);
        $this->db->set("area_id", $area_corporate);
        // $this->db->set("unit_mandiri_id", $UnitMandiriId);
        $this->db->set("client_pt_is_deleted", $isDeleted);
        $this->db->set("client_pt_is_aktif", $IsAktif);
        $this->db->set("client_pt_is_multi_lokasi", $isValidMultiLocation);
        $this->db->set("lokasi_outlet_id", $listcontactperson_location);
        $this->db->set("kelas_jalan2_id", $stretclass2_corporate);
        $this->db->set("kelas_jalan_id", $stretclass_corporate);
        $this->db->set("client_pt_fax", $client_pt_fax);
        $this->db->set("client_pt_npwp", $client_pt_npwp);
        $this->db->set("client_pt_status_pkp", $client_pt_status_pkp);

        if ($segment1_contact_person != "") {
            $this->db->set("client_pt_segmen_id1", $segment1_contact_person);
        }
        if ($segment2_contact_person != "") {
            $this->db->set("client_pt_segmen_id2", $segment2_contact_person);
        }
        if ($segment3_contact_person != "") {
            $this->db->set("client_pt_segmen_id3", $segment3_contact_person);
        }

        $this->db->insert("client_pt");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function Insert_Outlet_Corporate($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isDeleted, $IsAktif, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp)
    {

        $name_corporate = $name_corporate == '' ? null : $name_corporate;
        $address_corporate = $address_corporate == '' ? null : $address_corporate;
        $phone_corporate = $phone_corporate == '' ? null : $phone_corporate;
        $lattitude_corporate = $lattitude_corporate == '' ? null : $lattitude_corporate;
        $longitude_corporate = $longitude_corporate == '' ? null : $longitude_corporate;
        $name_contact_person = $name_contact_person == '' ? null : $name_contact_person;
        $phone_contact_person = $phone_contact_person == '' ? null : $phone_contact_person;
        $kreditlimit_contact_person = $kreditlimit_contact_person == '' ? null : $kreditlimit_contact_person;
        $stretclass_corporate = $stretclass_corporate == '' ? null : $stretclass_corporate;
        $stretclass2_corporate = $stretclass2_corporate == '' ? null : $stretclass2_corporate;
        $area_corporate = $area_corporate == '' ? null : $area_corporate;
        $province = $province == '' ? null : $province;
        $city = $city == '' ? null : $city;
        $districts = $districts == '' ? null : $districts;
        $ward = $ward == '' ? null : $ward;
        $kodepos_corporate = $kodepos_corporate == '' ? null : $kodepos_corporate;
        $segment1_contact_person = $segment1_contact_person == '' ? null : $segment1_contact_person;
        $segment2_contact_person = $segment2_contact_person == '' ? null : $segment2_contact_person;
        $segment3_contact_person = $segment3_contact_person == '' ? null : $segment3_contact_person;
        $isDeleted = $isDeleted == '' ? null : $isDeleted;
        $IsAktif = $IsAktif == '' ? null : $IsAktif;
        $client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
        $client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
        $client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;


        $this->db->set("client_pt_corporate_id", $outlet_id);
        $this->db->set("client_pt_corporate_nama", $name_corporate);
        $this->db->set("client_pt_corporate_alamat", $address_corporate);
        $this->db->set("client_pt_corporate_telepon", $phone_corporate);
        // $this->db->set("client_pt_corporate_id", $corporate_group);
        $this->db->set("client_pt_corporate_latitude", $lattitude_corporate);
        $this->db->set("client_pt_corporate_longitude", $longitude_corporate);
        $this->db->set("client_pt_corporate_propinsi", $province);
        $this->db->set("client_pt_corporate_kota", $city);
        $this->db->set("client_pt_corporate_kecamatan", $districts);
        $this->db->set("client_pt_corporate_kelurahan", $ward);
        $this->db->set("client_pt_corporate_kodepos", $kodepos_corporate);
        $this->db->set("client_pt_corporate_nama_contact_person", $name_contact_person);
        $this->db->set("client_pt_corporate_telepon_contact_person", $phone_contact_person);
        $this->db->set("client_pt_corporate_kredit_limit", $kreditlimit_contact_person);
        $this->db->set("kelas_jalan_id", $stretclass_corporate);
        $this->db->set("area_id", $area_corporate);
        // $this->db->set("unit_mandiri_id", $UnitMandiriId);
        $this->db->set("client_pt_corporate_is_deleted", 0);
        $this->db->set("client_pt_corporate_is_aktif", 1);
        //$this->db->set("client_pt_is_multi_lokasi", $isValidMultiLocation);
        // $this->db->set("lokasi_outlet_id", $listcontactperson_location);
        $this->db->set("kelas_jalan_id2", $stretclass2_corporate);
        $this->db->set("client_pt_fax", $client_pt_fax);
        $this->db->set("client_pt_npwp", $client_pt_npwp);
        $this->db->set("client_pt_status_pkp", $client_pt_status_pkp);

        if ($segment1_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id1", $segment1_contact_person);
        }
        if ($segment2_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id2", $segment2_contact_person);
        }
        if ($segment3_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id3", $segment3_contact_person);
        }


        $this->db->insert("client_pt_corporate");

        // $insert_id = $this->db->insert_id();

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function Insert_Outlet_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan)
    {
        $this->db->set("client_pt_detail_id", "NewID()", FALSE);
        $this->db->set("client_pt_id", $outlet_id);
        $this->db->set("client_pt_detail_is_open", $status);
        $this->db->set("client_pt_detail_hari_urut", $no_urut);
        $this->db->set("client_pt_detail_hari", $hari);
        $this->db->set("client_pt_detail_jam_buka", $buka);
        $this->db->set("client_pt_detail_jam_tutup", $tutup);
        $this->db->set("client_pt_detail_pengiriman", $pengiriman);
        $this->db->set("client_pt_detail_penagihan", $penagihan);
        $this->db->set("client_pt_detail_is_deleted", 0);
        $this->db->set("client_pt_detail_is_aktif", 1);

        $queryinsert = $this->db->insert("client_pt_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function Insert_Outlet_Corporate_detail($outlet_id, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan)
    {
        $this->db->set("client_pt_corporate_detail_id", "NewID()", FALSE);
        $this->db->set("client_pt_corporate_id", $outlet_id);
        $this->db->set("client_pt_corporate_detail_is_open", $status);
        $this->db->set("client_pt_corporate_detail_hari_urut", $no_urut);
        $this->db->set("client_pt_corporate_detail_hari", $hari);
        $this->db->set("client_pt_corporate_detail_jam_buka", $buka);
        $this->db->set("client_pt_corporate_detail_jam_tutup", $tutup);
        $this->db->set("client_pt_corporate_detail_is_deleted", 0);
        $this->db->set("client_pt_corporate_detail_is_aktif", 1);
        $this->db->set("client_pt_corporate_detail_pengiriman", $pengiriman);
        $this->db->set("client_pt_corporate_detail_penagihan", $penagihan);

        $queryinsert = $this->db->insert("client_pt_corporate_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }


    public function Update_Outlet($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $isValidMultiLocation, $listcontactperson_location, $status, $headOffice, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp)
    {
        $name_corporate = $name_corporate == '' ? null : $name_corporate;
        $address_corporate = $address_corporate == '' ? null : $address_corporate;
        $phone_corporate = $phone_corporate == '' ? null : $phone_corporate;
        $lattitude_corporate = $lattitude_corporate == '' ? null : $lattitude_corporate;
        $longitude_corporate = $longitude_corporate == '' ? null : $longitude_corporate;
        $name_contact_person = $name_contact_person == '' ? null : $name_contact_person;
        $phone_contact_person = $phone_contact_person == '' ? null : $phone_contact_person;
        $kreditlimit_contact_person = $kreditlimit_contact_person == '' ? null : $kreditlimit_contact_person;
        $stretclass_corporate = $stretclass_corporate == '' ? null : $stretclass_corporate;
        $stretclass2_corporate = $stretclass2_corporate == '' ? null : $stretclass2_corporate;
        $area_corporate = $area_corporate == '' ? null : $area_corporate;
        $province = $province == '' ? null : $province;
        $city = $city == '' ? null : $city;
        $districts = $districts == '' ? null : $districts;
        $ward = $ward == '' ? null : $ward;
        $kodepos_corporate = $kodepos_corporate == '' ? null : $kodepos_corporate;
        $segment1_contact_person = $segment1_contact_person == '' ? null : $segment1_contact_person;
        $segment2_contact_person = $segment2_contact_person == '' ? null : $segment2_contact_person;
        $segment3_contact_person = $segment3_contact_person == '' ? null : $segment3_contact_person;
        $isValidMultiLocation = $isValidMultiLocation == '' ? null : $isValidMultiLocation;
        $listcontactperson_location = $listcontactperson_location == '' ? null : $listcontactperson_location;
        $status = $status == '' ? null : $status;
        $headOffice = $headOffice == '' ? null : $headOffice;
        $client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
        $client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
        $client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;


        $this->db->set("client_pt_nama", $name_corporate);
        $this->db->set("client_pt_alamat", $address_corporate);
        $this->db->set("client_pt_telepon", $phone_corporate);
        $this->db->set("client_pt_corporate_id", $headOffice);
        $this->db->set("client_pt_latitude", $lattitude_corporate);
        $this->db->set("client_pt_longitude", $longitude_corporate);
        $this->db->set("client_pt_propinsi", $province);
        $this->db->set("client_pt_kota", $city);
        $this->db->set("client_pt_kecamatan", $districts);
        $this->db->set("client_pt_kelurahan", $ward);
        $this->db->set("client_pt_kodepos", $kodepos_corporate);
        $this->db->set("client_pt_nama_contact_person", $name_contact_person);
        $this->db->set("client_pt_telepon_contact_person", $phone_contact_person);
        $this->db->set("client_pt_kredit_limit", $kreditlimit_contact_person);
        $this->db->set("kelas_jalan_id", $stretclass_corporate);
        $this->db->set("kelas_jalan2_id", $stretclass2_corporate);
        $this->db->set("area_id", $area_corporate);
        $this->db->set("client_pt_is_aktif", $status);
        $this->db->set("client_pt_is_multi_lokasi", $isValidMultiLocation);
        $this->db->set("lokasi_outlet_id", $listcontactperson_location);
        $this->db->set("client_pt_fax", $client_pt_fax);
        $this->db->set("client_pt_npwp", $client_pt_npwp);
        $this->db->set("client_pt_status_pkp", $client_pt_status_pkp);
        if ($segment1_contact_person != "") {
            $this->db->set("client_pt_segmen_id1", $segment1_contact_person);
        }
        if ($segment2_contact_person != "") {
            $this->db->set("client_pt_segmen_id2", $segment2_contact_person);
        }
        if ($segment3_contact_person != "") {
            $this->db->set("client_pt_segmen_id3", $segment3_contact_person);
        }

        $this->db->where("client_pt_id", $outlet_id);

        $this->db->update("client_pt");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $this->db->last_query();
    }

    public function Update_Outlet_Corporate($outlet_id, $name_corporate, $address_corporate, $phone_corporate, $lattitude_corporate, $longitude_corporate, $name_contact_person, $phone_contact_person, $kreditlimit_contact_person, $stretclass_corporate, $stretclass2_corporate, $area_corporate, $province, $city, $districts, $ward, $kodepos_corporate, $segment1_contact_person, $segment2_contact_person, $segment3_contact_person, $status, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp)
    {

        $name_corporate = $name_corporate == '' ? null : $name_corporate;
        $address_corporate = $address_corporate == '' ? null : $address_corporate;
        $phone_corporate = $phone_corporate == '' ? null : $phone_corporate;
        $lattitude_corporate = $lattitude_corporate == '' ? null : $lattitude_corporate;
        $longitude_corporate = $longitude_corporate == '' ? null : $longitude_corporate;
        $name_contact_person = $name_contact_person == '' ? null : $name_contact_person;
        $phone_contact_person = $phone_contact_person == '' ? null : $phone_contact_person;
        $kreditlimit_contact_person = $kreditlimit_contact_person == '' ? null : $kreditlimit_contact_person;
        $stretclass_corporate = $stretclass_corporate == '' ? null : $stretclass_corporate;
        $stretclass2_corporate = $stretclass2_corporate == '' ? null : $stretclass2_corporate;
        $area_corporate = $area_corporate == '' ? null : $area_corporate;
        $province = $province == '' ? null : $province;
        $city = $city == '' ? null : $city;
        $districts = $districts == '' ? null : $districts;
        $ward = $ward == '' ? null : $ward;
        $kodepos_corporate = $kodepos_corporate == '' ? null : $kodepos_corporate;
        $segment1_contact_person = $segment1_contact_person == '' ? null : $segment1_contact_person;
        $segment2_contact_person = $segment2_contact_person == '' ? null : $segment2_contact_person;
        $segment3_contact_person = $segment3_contact_person == '' ? null : $segment3_contact_person;
        $status = $status == '' ? null : $status;
        $client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
        $client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
        $client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;

        $this->db->set("client_pt_corporate_nama", $name_corporate);
        $this->db->set("client_pt_corporate_alamat", $address_corporate);
        $this->db->set("client_pt_corporate_telepon", $phone_corporate);
        $this->db->set("client_pt_corporate_latitude", $lattitude_corporate);
        $this->db->set("client_pt_corporate_longitude", $longitude_corporate);
        $this->db->set("client_pt_corporate_propinsi", $province);
        $this->db->set("client_pt_corporate_kota", $city);
        $this->db->set("client_pt_corporate_kecamatan", $districts);
        $this->db->set("client_pt_corporate_kelurahan", $ward);
        $this->db->set("client_pt_corporate_kodepos", $kodepos_corporate);
        $this->db->set("client_pt_corporate_nama_contact_person", $name_contact_person);
        $this->db->set("client_pt_corporate_telepon_contact_person", $phone_contact_person);
        $this->db->set("client_pt_corporate_kredit_limit", $kreditlimit_contact_person);
        $this->db->set("kelas_jalan_id", $stretclass_corporate);
        $this->db->set("kelas_jalan_id2", $stretclass2_corporate);
        $this->db->set("area_id", $area_corporate);
        $this->db->set("client_pt_corporate_is_aktif", $status);
        $this->db->set("client_pt_fax", $client_pt_fax);
        $this->db->set("client_pt_npwp", $client_pt_npwp);
        $this->db->set("client_pt_status_pkp", $client_pt_status_pkp);
        if ($segment1_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id1", $segment1_contact_person);
        }
        if ($segment2_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id2", $segment2_contact_person);
        }
        if ($segment3_contact_person != "") {
            $this->db->set("client_pt_corporate_segmen_id3", $segment3_contact_person);
        }

        $this->db->where("client_pt_corporate_id", $outlet_id);

        $this->db->update("client_pt_corporate");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function Update_Outlet_detail($id_detail, $status, $buka, $tutup)
    {
        $this->db->set("client_pt_detail_is_open", $status);
        $this->db->set("client_pt_detail_jam_buka", $buka);
        $this->db->set("client_pt_detail_jam_tutup", $tutup);

        $this->db->where_in("client_pt_detail_id", $id_detail);

        $affectedrows = $this->db->update("client_pt_detail");

        // $affectedrows = $this->db->affected_rows();

        // if($affectedrows > 0)	{	$queryinsert = 1;	}
        // else					{	$queryinsert = 0;	}

        return $affectedrows;
    }

    public function Get_NewID()
    {
        $querybatuid = $this->db->query("select newid() as NEW_ID");

        return $querybatuid->result_array();
    }

    public function Get_Data_Outlet_By_Id($OutletID, $type)
    {

        if ($type == 'cabang') {
            $query = $this->db->query("select 
                                    a.client_pt_id as id,
                                    a.client_pt_nama as nama,
                                    a.client_pt_alamat as alamat,
                                    a.client_pt_telepon as telepon,
                                    a.client_pt_propinsi as provinsi,
                                    a.client_pt_kota as kota,
                                    a.client_pt_kecamatan as kecamatan,
                                    a.client_pt_kelurahan as kelurahan,
                                    a.client_pt_kodepos as kodepos,
                                    a.client_pt_latitude as lattitude,
                                    a.client_pt_longitude as longitude,
                                    a.client_pt_nama_contact_person as nama_cp,
                                    a.client_pt_telepon_contact_person as telepon_cp,
                                    a.client_pt_kredit_limit as kredit_limit_cp,
                                    a.kelas_jalan_id as kelas_jalan,
                                    a.kelas_jalan2_id as kelas_jalan2,
                                    a.area_id as area,
                                    a.client_pt_is_aktif as aktif,
                                    a.client_pt_segmen_id1 as segment1,
                                    a.client_pt_segmen_id2 as segment2,
                                    a.client_pt_segmen_id3 as segment3,
                                    a.client_pt_is_multi_lokasi as checklist,
                                    a.lokasi_outlet_id as lokasi_id,
                                    b.client_pt_detail_id as id_detail,
                                    b.client_pt_detail_is_open as status,
                                    b.client_pt_detail_hari_urut as no_urut,
                                    b.client_pt_detail_hari as hari,
                                    b.client_pt_detail_jam_buka as buka,
                                    b.client_pt_detail_pengiriman as pengiriman,
                                    b.client_pt_detail_penagihan as penagihan,
                                    b.client_pt_detail_jam_tutup as tutup,
                                    a.client_pt_fax,
                                    a.client_pt_npwp,
                                    a.client_pt_status_pkp
                                from client_pt as a left join client_pt_detail as b on b.client_pt_id = a.client_pt_id 
                                where a.client_pt_id = '$OutletID' order by b.client_pt_detail_hari_urut ASC");
        }

        if ($type == 'head') {
            $query =  $this->db->query("select 
                                    a.client_pt_corporate_id as id,
                                    a.client_pt_corporate_nama as nama,
                                    a.client_pt_corporate_alamat as alamat,
                                    a.client_pt_corporate_telepon as telepon,
                                    a.client_pt_corporate_propinsi as provinsi,
                                    a.client_pt_corporate_kota as kota,
                                    a.client_pt_corporate_kecamatan as kecamatan,
                                    a.client_pt_corporate_kelurahan as kelurahan,
                                    a.client_pt_corporate_kodepos as kodepos,
                                    a.client_pt_corporate_latitude as lattitude,
                                    a.client_pt_corporate_longitude as longitude,
                                    a.client_pt_corporate_nama_contact_person as nama_cp,
                                    a.client_pt_corporate_telepon_contact_person as telepon_cp,
                                    a.client_pt_corporate_kredit_limit as kredit_limit_cp,
                                    a.kelas_jalan_id as kelas_jalan,
                                    a.kelas_jalan_id2 as kelas_jalan2,
                                    a.area_id as area,
                                    a.client_pt_corporate_is_aktif as aktif,
                                    a.client_pt_corporate_segmen_id1 as segment1,
                                    a.client_pt_corporate_segmen_id2 as segment2,
                                    a.client_pt_corporate_segmen_id3 as segment3,
                                    b.client_pt_corporate_detail_id as id_detail,
                                    b.client_pt_corporate_detail_is_open as status,
                                    b.client_pt_corporate_detail_hari_urut as no_urut,
                                    b.client_pt_corporate_detail_hari as hari,
                                    b.client_pt_corporate_detail_jam_buka as buka,
                                    b.client_pt_corporate_detail_pengiriman as pengiriman,
                                    b.client_pt_corporate_detail_penagihan as penagihan,
                                    b.client_pt_corporate_detail_jam_tutup as tutup,
                                    a.client_pt_fax,
                                    a.client_pt_npwp,
                                    a.client_pt_status_pkp
                                from client_pt_corporate as a left join client_pt_corporate_detail as b on b.client_pt_corporate_id = a.client_pt_corporate_id 
                                where a.client_pt_corporate_id = '$OutletID' ORDER BY b.client_pt_corporate_detail_hari_urut ASC");
        }


        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function Delete_Outlet($OutletID)
    {

        $this->db->trans_begin();

        $this->db->set('client_pt_is_deleted', 1);
        $this->db->where("client_pt_id", $OutletID);
        $this->db->update("client_pt");

        // $this->db->where("client_pt_id", $OutletID);
        // $this->db->delete("client_pt");

        $error = $this->db->error();

        if ($error['message'] != '' || $error['message'] != null)
        //if( $error['message'] != '' && $error['message'] != null )
        {
            $res = $error['message']; // Error

            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();

            $affectedrows = $this->db->affected_rows();
            if (abs($affectedrows) > 0) {
                $res = 1; // Success
            } else {
                $res = 0; // Success
            }
        }

        return $res;
    }

    public function data_sync_client_pt_masar($client_pt_id)
    {
        $query = $this->db->query("SELECT
                                    a.client_pt_id,
                                    b.client_pt_principle_id,
                                    NULL AS kode,
                                    CONCAT(client_pt_nama, ' (', p.principle_kode, ')') AS nama,
                                    client_pt_alamat AS alamat,
                                    client_pt_kota AS kota,
                                    client_pt_kodepos AS kodepos,
                                    NULL AS negara,
                                    client_pt_telepon AS telepon,
                                    NULL AS fax,
                                    NULL AS npwp,
                                    NULL AS bentuk,
                                    NULL AS pelanggan,
                                    b.client_pt_principle_top AS jatuh_tempo,
                                    b.client_pt_principle_kredit_limit AS limit,
                                    NULL AS diskon,
                                    NULL AS kodegab,
                                    NULL AS namagab,
                                    NULL AS saldo_awal,
                                    NULL AS debet,
                                    NULL AS kredit,
                                    NULL AS debet_memo,
                                    NULL AS kredit_memo,
                                    NULL AS saldo_akhir,
                                    NULL AS lunas_kas,
                                    NULL AS lunas_cek,
                                    NULL AS umur0,
                                    NULL AS umur1,
                                    NULL AS umur2,
                                    NULL AS umur3,
                                    NULL AS umur4,
                                    NULL AS no_penj,
                                    NULL AS no_disc,
                                    NULL AS no_ppn,
                                    NULL AS no_piutang,
                                    NULL AS no_retur,
                                    NULL AS no_contact1,
                                    NULL AS no_position1,
                                    NULL AS no_contact2,
                                    NULL AS no_position2,
                                    NULL AS no_contact3,
                                    NULL AS no_position3,
                                    NULL AS expdate,
                                    NULL AS email,
                                    NULL AS no_perk,
                                    NULL AS no_sort,
                                    NULL AS no_sort_nama,
                                    NULL AS no_remark,
                                    NULL AS no_market,
                                    NULL AS no_cancel,
                                    NULL AS no_dept,
                                    NULL AS no_perjanjian,
                                    NULL AS flag_penanggung,
                                    NULL AS jenis_penanggung,
                                    NULL AS jenis_debitur,
                                    NULL AS kelasID,
                                    NULL AS masterkelasID,
                                    NULL AS updwho,
                                    NULL AS updtgl,
                                    NULL AS valuta_id,
                                    NULL AS saldo_awal,
                                    NULL AS debetF,
                                    NULL AS kreditF,
                                    NULL AS saldo_akhirF,
                                    NULL AS lunas_kasF,
                                    NULL AS lunas_cekF,
                                    NULL AS debet_memoF,
                                    NULL AS kredit_memoF,
                                    NULL AS rencanabyr,
                                    NULL AS ExpedisiID,
                                    NULL AS discountf
                                    FROM client_pt a
                                    LEFT JOIN client_pt_principle b
                                    ON b.client_pt_id = a.client_pt_id
									LEFT JOIN principle p
									ON b.principle_id = p.principle_id
                                    WHERE convert(nvarchar(36), a.client_pt_id) = '$client_pt_id'");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result_array();
        }

        return $query;
        // return $this->db->last_query();
    }

    public function data_sync_client_pt_masap($client_pt_id)
    {
        $query = $this->db->query("SELECT
                                    NULL AS kode,
                                    client_pt_nama AS nama,
                                    client_pt_alamat AS alamat,
                                    client_pt_kota AS kota,
                                    NULL AS status,
                                    NULL AS npwp,
                                    NULL AS tahun,
                                    NULL AS limit,
                                    NULL AS bulan,
                                    NULL AS per_htng,
                                    NULL AS per_disc,
                                    NULL AS per_beli,
                                    NULL AS per_ppn,
                                    NULL AS per_biaya,
                                    NULL AS beli,
                                    NULL AS disc,
                                    NULL AS retur,
                                    NULL AS biaya,
                                    NULL AS lunas_kas,
                                    NULL AS lunas_cek,
                                    NULL AS awal_ppn,
                                    NULL AS awal_brg,
                                    NULL AS debet_ppn,
                                    NULL AS debet_brg,
                                    NULL AS kredit_ppn,
                                    NULL AS kredit_brg,
                                    NULL AS akhir_ppn,
                                    NULL AS akhir_brg,
                                    NULL AS umur0,
                                    NULL AS umur1,
                                    NULL AS umur2,
                                    NULL AS umur3,
                                    NULL AS umur4,
                                    NULL AS flag,
                                    NULL AS debet_memo,
                                    NULL AS kredit_memo,
                                    client_pt_telepon AS tilpun,
                                    NULL AS fax,
                                    NULL AS keterangan,
                                    NULL AS ac,
                                    NULL AS bank,
                                    NULL AS contact1,
                                    NULL AS position1,
                                    NULL AS updwho,
                                    NULL AS updtgl,
                                    NULL AS valuta_id,
                                    NULL AS awal_brgF,
                                    NULL AS debet_brgF,
                                    NULL AS kredit_brgF,
                                    NULL AS akhir_brgF,
                                    NULL AS lunas_kasF,
                                    NULL AS lunas_cekF,
                                    NULL AS debet_memoF,
                                    NULL AS kredit_memoF,
                                    NULL AS discf,
                                    NULL AS isexpedisi
                                    FROM client_pt
                                    WHERE convert(nvarchar(36), client_pt_id) = '$client_pt_id'");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function cek_masap_by_client_pt($client_pt_id)
    {
        $query = $this->db->query("SELECT * FROM BackOffice.dbo.masap WHERE convert(nvarchar(36), client_pt_id) = '$client_pt_id'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->num_rows();
        }

        return $query;
    }

    public function sync_client_masar($client_pt_id, $data)
    {

        $backoffice = $this->load->database('backoffice', TRUE);

        $masar_no = $data['kode'] != '' ? $data['kode'] : null;
        $masar_nama = $data['nama'] != '' ? $data['nama'] : null;
        $masar_alamat = $data['alamat'] != '' ? $data['alamat'] : null;
        $masar_kota = $data['kota'] != '' ? $data['kota'] : null;
        $masar_zip = $data['kodepos'] != '' ? $data['kodepos'] : null;
        $masar_negara = $data['negara'] != '' ? $data['negara'] : null;
        $masar_telepon = $data['telepon'] != '' ? $data['telepon'] : null;
        $masar_fax = $data['fax'] != '' ? $data['fax'] : null;
        $masar_npwp = $data['npwp'] != '' ? $data['npwp'] : null;
        $masar_bentuk = $data['bentuk'] != '' ? $data['bentuk'] : null;
        $masar_pelanggan = $data['pelanggan'] != '' ? $data['pelanggan'] : null;
        $masar_jatuh_tempo = $data['jatuh_tempo'] != '' ? $data['jatuh_tempo'] : null;
        $masar_limit = $data['limit'] != '' ? $data['limit'] : null;
        $masar_discount = $data['diskon'] != '' ? $data['diskon'] : null;
        $masar_kodegab = $data['kodegab'] != '' ? $data['kodegab'] : null;
        $masar_namagab = $data['namagab'] != '' ? $data['namagab'] : null;
        $masar_saldo_awal = $data['saldo_awal'] != '' ? $data['saldo_awal'] : null;
        $masar_debet = $data['debet'] != '' ? $data['debet'] : null;
        $masar_kredit = $data['kredit'] != '' ? $data['kredit'] : null;
        $masar_debet_memo = $data['debet_memo'] != '' ? $data['debet_memo'] : null;
        $masar_kredit_memo = $data['kredit_memo'] != '' ? $data['kredit_memo'] : null;
        $masar_saldo_akhir = $data['saldo_akhir'] != '' ? $data['saldo_akhir'] : null;
        $masar_lunas_kas = $data['lunas_kas'] != '' ? $data['lunas_kas'] : null;
        $masar_lunas_cek = $data['lunas_cek'] != '' ? $data['lunas_cek'] : null;
        $masar_umur0 = $data['umur0'] != '' ? $data['umur0'] : null;
        $masar_umur1 = $data['umur1'] != '' ? $data['umur1'] : null;
        $masar_umur2 = $data['umur2'] != '' ? $data['umur2'] : null;
        $masar_umur3 = $data['umur3'] != '' ? $data['umur3'] : null;
        $masar_umur4 = $data['umur4'] != '' ? $data['umur4'] : null;
        $masar_no_penj = $data['no_penj'] != '' ? $data['no_penj'] : null;
        $masar_no_disc = $data['no_disc'] != '' ? $data['no_disc'] : null;
        $masar_no_ppn = $data['no_ppn'] != '' ? $data['no_ppn'] : null;
        $masar_no_piutang = $data['no_piutang'] != '' ? $data['no_piutang'] : null;
        $masar_no_retur = $data['no_retur'] != '' ? $data['no_retur'] : null;
        $masar_contact1 = $data['no_contact1'] != '' ? $data['no_contact1'] : null;
        $masar_position1 = $data['no_position1'] != '' ? $data['no_position1'] : null;
        $masar_contact2 = $data['no_contact2'] != '' ? $data['no_contact2'] : null;
        $masar_position2 = $data['no_position2'] != '' ? $data['no_position2'] : null;
        $masar_contact3 = $data['no_contact3'] != '' ? $data['no_contact3'] : null;
        $masar_position3 = $data['no_position3'] != '' ? $data['no_position3'] : null;
        $masar_expdate = $data['expdate'] != '' ? $data['expdate'] : null;
        $masar_email = $data['email'] != '' ? $data['email'] : null;
        $masar_no_perk = $data['no_perk'] != '' ? $data['no_perk'] : null;
        $masar_sort = $data['no_sort'] != '' ? $data['no_sort'] : null;
        $masar_sort_nama = $data['no_sort_nama'] != '' ? $data['no_sort_nama'] : null;
        $masar_remark = $data['no_remark'] != '' ? $data['no_remark'] : null;
        $masar_market = $data['no_market'] != '' ? $data['no_market'] : null;
        $masar_cancel = $data['no_cancel'] != '' ? $data['no_cancel'] : null;
        $masar_dept = $data['no_dept'] != '' ? $data['no_dept'] : null;
        $masar_no_perjanjian = $data['no_perjanjian'] != '' ? $data['no_perjanjian'] : null;
        $masar_flag_penanggung = $data['flag_penanggung'] != '' ? $data['flag_penanggung'] : null;
        $masar_jenis_penanggung = $data['jenis_penanggung'] != '' ? $data['jenis_penanggung'] : null;
        $masar_jenis_debitur = $data['jenis_debitur'] != '' ? $data['jenis_debitur'] : null;
        $KelasID = $data['kelasID'] != '' ? $data['kelasID'] : null;
        $MasterKelasID = $data['masterkelasID'] != '' ? $data['masterkelasID'] : null;
        $updwho = $data['updwho'] != '' ? $data['updwho'] : null;
        $updtgl = $data['updtgl'] != '' ? $data['updtgl'] : null;
        $valuta_id = $data['valuta_id'] != '' ? $data['valuta_id'] : null;
        $masar_saldo_awalF = $data['saldo_awal'] != '' ? $data['saldo_awal'] : null;
        $masar_debetF = $data['debetF'] != '' ? $data['debetF'] : null;
        $masar_kreditF = $data['kreditF'] != '' ? $data['kreditF'] : null;
        $masar_saldo_akhirF = $data['saldo_akhirF'] != '' ? $data['saldo_akhirF'] : null;
        $masar_lunas_kasF = $data['lunas_kasF'] != '' ? $data['lunas_kasF'] : null;
        $masar_lunas_cekF = $data['lunas_cekF'] != '' ? $data['lunas_cekF'] : null;
        $masar_debet_memoF = $data['debet_memoF'] != '' ? $data['debet_memoF'] : null;
        $masar_kredit_memoF = $data['kredit_memoF'] != '' ? $data['kredit_memoF'] : null;
        $masar_rencanabyr = $data['rencanabyr'] != '' ? $data['rencanabyr'] : null;
        $ExpedisiID = $data['ExpedisiID'] != '' ? $data['ExpedisiID'] : null;
        $masar_discountf = $data['discountf'] != '' ? $data['discountf'] : null;
        $client_pt_principle_id = $data['client_pt_principle_id'] != '' ? $data['client_pt_principle_id'] : null;

        $backoffice->set('masar_id', "NEWID()", FALSE);
        $backoffice->set('masar_no', "CONVERT(varchar(10),'" . $masar_nama . "')", FALSE);
        $backoffice->set('masar_nama', $masar_nama);
        $backoffice->set('masar_alamat', $masar_alamat);
        $backoffice->set('masar_kota', $masar_kota);
        $backoffice->set('masar_zip', $masar_zip);
        $backoffice->set('masar_negara', $masar_negara);
        $backoffice->set('masar_telepon', $masar_telepon);
        $backoffice->set('masar_fax', $masar_fax);
        $backoffice->set('masar_npwp', $masar_npwp);
        $backoffice->set('masar_bentuk', $masar_bentuk);
        $backoffice->set('masar_pelanggan', $masar_pelanggan);
        $backoffice->set('masar_jatuh_tempo', $masar_jatuh_tempo);
        $backoffice->set('masar_limit', $masar_limit);
        $backoffice->set('masar_discount', $masar_discount);
        $backoffice->set('masar_kodegab', $masar_kodegab);
        $backoffice->set('masar_namagab', $masar_namagab);
        $backoffice->set('masar_saldo_awal', $masar_saldo_awal);
        $backoffice->set('masar_debet', $masar_debet);
        $backoffice->set('masar_kredit', $masar_kredit);
        $backoffice->set('masar_debet_memo', $masar_debet_memo);
        $backoffice->set('masar_kredit_memo', $masar_kredit_memo);
        $backoffice->set('masar_saldo_akhir', $masar_saldo_akhir);
        $backoffice->set('masar_lunas_kas', $masar_lunas_kas);
        $backoffice->set('masar_lunas_cek', $masar_lunas_cek);
        $backoffice->set('masar_umur0', $masar_umur0);
        $backoffice->set('masar_umur1', $masar_umur1);
        $backoffice->set('masar_umur2', $masar_umur2);
        $backoffice->set('masar_umur3', $masar_umur3);
        $backoffice->set('masar_umur4', $masar_umur4);
        $backoffice->set('masar_no_penj', $masar_no_penj);
        $backoffice->set('masar_no_disc', $masar_no_disc);
        $backoffice->set('masar_no_ppn', $masar_no_ppn);
        $backoffice->set('masar_no_piutang', $masar_no_piutang);
        $backoffice->set('masar_no_retur', $masar_no_retur);
        $backoffice->set('masar_contact1', $masar_contact1);
        $backoffice->set('masar_position1', $masar_position1);
        $backoffice->set('masar_contact2', $masar_contact2);
        $backoffice->set('masar_position2', $masar_position2);
        $backoffice->set('masar_contact3', $masar_contact3);
        $backoffice->set('masar_position3', $masar_position3);
        $backoffice->set('masar_expdate', $masar_expdate);
        $backoffice->set('masar_email', $masar_email);
        $backoffice->set('masar_no_perk', $masar_no_perk);
        $backoffice->set('masar_sort', $masar_sort);
        $backoffice->set('masar_sort_nama', $masar_sort_nama);
        $backoffice->set('masar_remark', $masar_remark);
        $backoffice->set('masar_market', $masar_market);
        $backoffice->set('masar_cancel', $masar_cancel);
        $backoffice->set('masar_dept', $masar_dept);
        $backoffice->set('masar_no_perjanjian', $masar_no_perjanjian);
        $backoffice->set('masar_flag_penanggung', $masar_flag_penanggung);
        $backoffice->set('masar_jenis_penanggung', $masar_jenis_penanggung);
        $backoffice->set('masar_jenis_debitur', $masar_jenis_debitur);
        $backoffice->set('KelasID', $KelasID);
        $backoffice->set('MasterKelasID', $MasterKelasID);
        $backoffice->set('updwho', $updwho);
        $backoffice->set('updtgl', $updtgl);
        $backoffice->set('valuta_id', $valuta_id);
        $backoffice->set('masar_saldo_awalF', $masar_saldo_awalF);
        $backoffice->set('masar_debetF', $masar_debetF);
        $backoffice->set('masar_kreditF', $masar_kreditF);
        $backoffice->set('masar_saldo_akhirF', $masar_saldo_akhirF);
        $backoffice->set('masar_lunas_kasF', $masar_lunas_kasF);
        $backoffice->set('masar_lunas_cekF', $masar_lunas_cekF);
        $backoffice->set('masar_debet_memoF', $masar_debet_memoF);
        $backoffice->set('masar_kredit_memoF', $masar_kredit_memoF);
        $backoffice->set('masar_rencanabyr', $masar_rencanabyr);
        $backoffice->set('ExpedisiID', $ExpedisiID);
        $backoffice->set('masar_discountf', $masar_discountf);
        $backoffice->set('client_pt_principle_id', $client_pt_principle_id);

        $backoffice->insert("masar");

        $affectedrows = $backoffice->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $backoffice->last_query();
    }

    public function sync_client_masap($client_pt_id, $data)
    {
        $backoffice = $this->load->database('backoffice', TRUE);

        $supp_kode = $data['kode'] != '' ? $data['kode'] : null;
        $supp_nama = $data['nama'] != '' ? $data['nama'] : null;
        $supp_alamat = $data['alamat'] != '' ? $data['alamat'] : null;
        $supp_kota = $data['kota'] != '' ? $data['kota'] : null;
        $supp_status = $data['status'] != '' ? $data['status'] : null;
        $supp_npwp = $data['npwp'] != '' ? $data['npwp'] : null;
        $supp_tahun = $data['tahun'] != '' ? $data['tahun'] : null;
        $supp_limit = $data['limit'] != '' ? $data['limit'] : null;
        $supp_bulan = $data['bulan'] != '' ? $data['bulan'] : null;
        $supp_per_htng = $data['per_htng'] != '' ? $data['per_htng'] : null;
        $supp_per_disc = $data['per_disc'] != '' ? $data['per_disc'] : null;
        $supp_per_beli = $data['per_beli'] != '' ? $data['per_beli'] : null;
        $supp_per_ppn = $data['per_ppn'] != '' ? $data['per_ppn'] : null;
        $supp_per_biaya = $data['per_biaya'] != '' ? $data['per_biaya'] : null;
        $supp_beli = $data['beli'] != '' ? $data['beli'] : null;
        $supp_disc = $data['disc'] != '' ? $data['disc'] : null;
        $supp_retur = $data['retur'] != '' ? $data['retur'] : null;
        $supp_biaya = $data['biaya'] != '' ? $data['biaya'] : null;
        $supp_lunas_kas = $data['lunas_kas'] != '' ? $data['lunas_kas'] : null;
        $supp_lunas_cek = $data['lunas_cek'] != '' ? $data['lunas_cek'] : null;
        $supp_awal_ppn = $data['awal_ppn'] != '' ? $data['awal_ppn'] : null;
        $supp_awal_brg = $data['awal_brg'] != '' ? $data['awal_brg'] : null;
        $supp_debet_ppn = $data['debet_ppn'] != '' ? $data['debet_ppn'] : null;
        $supp_debet_brg = $data['debet_brg'] != '' ? $data['debet_brg'] : null;
        $supp_kredit_ppn = $data['kredit_ppn'] != '' ? $data['kredit_ppn'] : null;
        $supp_kredit_brg = $data['kredit_brg'] != '' ? $data['kredit_brg'] : null;
        $supp_akhir_ppn = $data['akhir_ppn'] != '' ? $data['akhir_ppn'] : null;
        $supp_akhir_brg = $data['akhir_brg'] != '' ? $data['akhir_brg'] : null;
        $supp_umur0 = $data['umur0'] != '' ? $data['umur0'] : null;
        $supp_umur1 = $data['umur1'] != '' ? $data['umur1'] : null;
        $supp_umur2 = $data['umur2'] != '' ? $data['umur2'] : null;
        $supp_umur3 = $data['umur3'] != '' ? $data['umur3'] : null;
        $supp_umur4 = $data['umur4'] != '' ? $data['umur4'] : null;
        $supp_flag = $data['flag'] != '' ? $data['flag'] : null;
        $supp_debet_memo = $data['debet_memo'] != '' ? $data['debet_memo'] : null;
        $supp_kredit_memo = $data['kredit_memo'] != '' ? $data['kredit_memo'] : null;
        $supp_tilpun = $data['tilpun'] != '' ? $data['tilpun'] : null;
        $supp_fax = $data['fax'] != '' ? $data['fax'] : null;
        $supp_keterangan = $data['keterangan'] != '' ? $data['keterangan'] : null;
        $supp_ac = $data['ac'] != '' ? $data['ac'] : null;
        $supp_bank = $data['bank'] != '' ? $data['bank'] : null;
        $supp_contact1 = $data['contact1'] != '' ? $data['contact1'] : null;
        $supp_position1 = $data['position1'] != '' ? $data['position1'] : null;
        $updwho = $data['updwho'] != '' ? $data['updwho'] : null;
        $updtgl = $data['updtgl'] != '' ? $data['updtgl'] : null;
        $valuta_id = $data['valuta_id'] != '' ? $data['valuta_id'] : null;
        $supp_awal_brgF = $data['awal_brgF'] != '' ? $data['awal_brgF'] : null;
        $supp_debet_brgF = $data['debet_brgF'] != '' ? $data['debet_brgF'] : null;
        $supp_kredit_brgF = $data['kredit_brgF'] != '' ? $data['kredit_brgF'] : null;
        $supp_akhir_brgF = $data['akhir_brgF'] != '' ? $data['akhir_brgF'] : null;
        $supp_lunas_kasF = $data['lunas_kasF'] != '' ? $data['lunas_kasF'] : null;
        $supp_lunas_cekF = $data['lunas_cekF'] != '' ? $data['lunas_cekF'] : null;
        $supp_debet_memoF = $data['debet_memoF'] != '' ? $data['debet_memoF'] : null;
        $supp_kredit_memoF = $data['kredit_memoF'] != '' ? $data['kredit_memoF'] : null;
        $supp_discf = $data['discf'] != '' ? $data['discf'] : null;
        $isexpedisi = $data['isexpedisi'] != '' ? $data['isexpedisi'] : null;


        $backoffice->set('masap_id', "NEWID()", FALSE);
        $backoffice->set('supp_kode', "CONVERT(varchar(10),'" . $supp_nama . "')", FALSE);
        $backoffice->set('supp_nama', $supp_nama);
        $backoffice->set('supp_alamat', $supp_alamat);
        $backoffice->set('supp_kota', $supp_kota);
        $backoffice->set('supp_status', $supp_status);
        $backoffice->set('supp_npwp', $supp_npwp);
        $backoffice->set('supp_tahun', $supp_tahun);
        $backoffice->set('supp_limit', $supp_limit);
        $backoffice->set('supp_bulan', $supp_bulan);
        $backoffice->set('supp_per_htng', $supp_per_htng);
        $backoffice->set('supp_per_disc', $supp_per_disc);
        $backoffice->set('supp_per_beli', $supp_per_beli);
        $backoffice->set('supp_per_ppn', $supp_per_ppn);
        $backoffice->set('supp_per_biaya', $supp_per_biaya);
        $backoffice->set('supp_beli', $supp_beli);
        $backoffice->set('supp_disc', $supp_disc);
        $backoffice->set('supp_retur', $supp_retur);
        $backoffice->set('supp_biaya', $supp_biaya);
        $backoffice->set('supp_lunas_kas', $supp_lunas_kas);
        $backoffice->set('supp_lunas_cek', $supp_lunas_cek);
        $backoffice->set('supp_awal_ppn', $supp_awal_ppn);
        $backoffice->set('supp_awal_brg', $supp_awal_brg);
        $backoffice->set('supp_debet_ppn', $supp_debet_ppn);
        $backoffice->set('supp_debet_brg', $supp_debet_brg);
        $backoffice->set('supp_kredit_ppn', $supp_kredit_ppn);
        $backoffice->set('supp_kredit_brg', $supp_kredit_brg);
        $backoffice->set('supp_akhir_ppn', $supp_akhir_ppn);
        $backoffice->set('supp_akhir_brg', $supp_akhir_brg);
        $backoffice->set('supp_umur0', $supp_umur0);
        $backoffice->set('supp_umur1', $supp_umur1);
        $backoffice->set('supp_umur2', $supp_umur2);
        $backoffice->set('supp_umur3', $supp_umur3);
        $backoffice->set('supp_umur4', $supp_umur4);
        $backoffice->set('supp_flag', $supp_flag);
        $backoffice->set('supp_debet_memo', $supp_debet_memo);
        $backoffice->set('supp_kredit_memo', $supp_kredit_memo);
        $backoffice->set('supp_tilpun', $supp_tilpun);
        $backoffice->set('supp_fax', $supp_fax);
        $backoffice->set('supp_keterangan', $supp_keterangan);
        $backoffice->set('supp_ac', $supp_ac);
        $backoffice->set('supp_bank', $supp_bank);
        $backoffice->set('supp_contact1', $supp_contact1);
        $backoffice->set('supp_position1', $supp_position1);
        $backoffice->set('updwho', $updwho);
        $backoffice->set('updtgl', $updtgl);
        $backoffice->set('valuta_id', $valuta_id);
        $backoffice->set('supp_awal_brgF', $supp_awal_brgF);
        $backoffice->set('supp_debet_brgF', $supp_debet_brgF);
        $backoffice->set('supp_kredit_brgF', $supp_kredit_brgF);
        $backoffice->set('supp_akhir_brgF', $supp_akhir_brgF);
        $backoffice->set('supp_lunas_kasF', $supp_lunas_kasF);
        $backoffice->set('supp_lunas_cekF', $supp_lunas_cekF);
        $backoffice->set('supp_debet_memoF', $supp_debet_memoF);
        $backoffice->set('supp_kredit_memoF', $supp_kredit_memoF);
        $backoffice->set('supp_discf', $supp_discf);
        $backoffice->set('isexpedisi', $isexpedisi);
        $backoffice->set('client_pt_id', $client_pt_id);

        $backoffice->insert("masap");

        // $affectedrows = $backoffice->affected_rows();
        // if ($affectedrows > 0) {
        //     $queryinsert = 1;
        // } else {
        //     $queryinsert = 0;
        // }

        // return $queryinsert;

        return $backoffice->last_query();
    }

    public function cek_masar_by_client_pt($client_pt_principle_id)
    {
        $query = $this->db->query("SELECT * FROM BackOffice.dbo.masar WHERE convert(nvarchar(36), client_pt_principle_id) = '$client_pt_principle_id'");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->num_rows();
        }

        return $query;
    }

    public function Get_masar_by_client_pt($client_pt_id)
    {
        $query = $this->db->query("SELECT
                                    cp.client_pt_id,
                                    m.masar_id,
                                    m.masar_nama
                                    FROM client_pt_principle cp
                                    LEFT JOIN BackOffice.dbo.masar m
                                    ON cp.client_pt_principle_id = m.client_pt_principle_id
                                    WHERE cp.client_pt_id = '$client_pt_id'
                                    ORDER BY m.masar_nama ASC");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function Get_masar_by_id($masar_id)
    {
        $query = $this->db->query("SELECT
                                    masar_id,
                                    masar_no,
                                    masar_nama,
                                    masar_alamat,
                                    masar_kota,
                                    masar_zip,
                                    masar_negara,
                                    masar_telepon,
                                    masar_fax,
                                    masar_npwp,
                                    masar_bentuk,
                                    masar_pelanggan,
                                    masar_jatuh_tempo,
                                    masar_limit,
                                    masar_discount,
                                    masar_kodegab,
                                    masar_namagab,
                                    ISNULL(masar_saldo_awal,'0') as masar_saldo_awal,
                                    ISNULL(masar_debet,'0') as masar_debet,
                                    ISNULL(masar_kredit,'0') as masar_kredit,
                                    ISNULL(masar_saldo_akhir,'0') as masar_saldo_akhir,
                                    ISNULL(masar_lunas_kas,'0') as masar_lunas_kas,
                                    ISNULL(masar_lunas_cek,'0') as masar_lunas_cek,
                                    ISNULL(masar_debet_memo,'0') as masar_debet_memo,
                                    ISNULL(masar_kredit_memo,'0') as masar_kredit_memo,
                                    masar_umur0,
                                    masar_umur1,
                                    masar_umur2,
                                    masar_umur3,
                                    masar_umur4,
                                    ISNULL(masar_no_penj,'') as masar_no_penj,
                                    ISNULL(masar_no_penj.gl02,'') as masar_no_penj_ket,
                                    ISNULL(masar_no_disc,'') as masar_no_disc,
                                    ISNULL(masar_no_disc.gl02,'') as masar_no_disc_ket,
                                    ISNULL(masar_no_ppn,'') as masar_no_ppn,
                                    ISNULL(masar_no_ppn.gl02,'') as masar_no_ppn_ket,
                                    ISNULL(masar_no_piutang,'') as masar_no_piutang,
                                    ISNULL(masar_no_piutang.gl02,'') as masar_no_piutang_ket,
                                    ISNULL(masar_no_retur,'') as masar_no_retur,
                                    ISNULL(masar_no_retur.gl02,'') as masar_no_retur_ket,
                                    masar_contact1,
                                    masar_position1,
                                    masar_contact2,
                                    masar_position2,
                                    masar_contact3,
                                    masar_position3,
                                    masar_expdate,
                                    masar_email,
                                    masar_no_perk,
                                    masar_sort,
                                    masar_sort_nama,
                                    masar_remark,
                                    masar_market,
                                    masar_cancel,
                                    masar_dept,
                                    masar_no_perjanjian,
                                    masar_flag_penanggung,
                                    masar_jenis_penanggung,
                                    masar_jenis_debitur,
                                    KelasID,
                                    MasterKelasID,
                                    masar.updwho,
                                    masar.updtgl,
                                    valuta_id,
                                    ISNULL(masar_saldo_awalF,'0') as masar_saldo_awalF,
                                    ISNULL(masar_debetF,'0') as masar_debetF,
                                    ISNULL(masar_kreditF,'0') as masar_kreditF,
                                    ISNULL(masar_saldo_akhirF,'0') as masar_saldo_akhirF,
                                    ISNULL(masar_lunas_kasF,'0') as masar_lunas_kasF,
                                    ISNULL(masar_lunas_cekF,'0') as masar_lunas_cekF,
                                    ISNULL(masar_debet_memoF,'0') as masar_debet_memoF,
                                    ISNULL(masar_kredit_memoF,'0') as masar_kredit_memoF,
                                    ISNULL(masar_rencanabyr,'0') as masar_rencanabyr,
                                    ExpedisiID,
                                    masar_discountf,
                                    client_pt_principle_id
                                    FROM BackOffice.dbo.masar
                                    left join BackOffice.dbo.msgl masar_no_penj
                                    on masar_no_penj.gl01 = masar.masar_no_penj
                                    left join BackOffice.dbo.msgl masar_no_disc
                                    on masar_no_disc.gl01 = masar.masar_no_disc
                                    left join BackOffice.dbo.msgl masar_no_ppn
                                    on masar_no_ppn.gl01 = masar.masar_no_ppn
                                    left join BackOffice.dbo.msgl masar_no_piutang
                                    on masar_no_piutang.gl01 = masar.masar_no_piutang
                                    left join BackOffice.dbo.msgl masar_no_retur
                                    on masar_no_retur.gl01 = masar.masar_no_retur
                                    WHERE convert(nvarchar(36), masar_id) = '$masar_id'");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function Get_masap_by_client_pt($client_pt_id)
    {
        $query = $this->db->query("SELECT
                                    masap_id,
                                    supp_kode,
                                    supp_nama,
                                    supp_alamat,
                                    supp_kota,
                                    supp_status,
                                    supp_npwp,
                                    supp_tahun,
                                    supp_limit,
                                    supp_bulan,
                                    ISNULL(supp_per_htng, '') AS supp_per_htng,
                                    ISNULL(supp_per_disc, '') AS supp_per_disc,
                                    ISNULL(supp_per_beli, '') AS supp_per_beli,
                                    ISNULL(supp_per_ppn, '') AS supp_per_ppn,
                                    ISNULL(supp_per_biaya, '') AS supp_per_biaya,
                                    ISNULL(supp_per_htng.gl02, '') AS supp_per_htng_ket,
                                    ISNULL(supp_per_disc.gl02, '') AS supp_per_disc_ket,
                                    ISNULL(supp_per_beli.gl02, '') AS supp_per_beli_ket,
                                    ISNULL(supp_per_ppn.gl02, '') AS supp_per_ppn_ket,
                                    ISNULL(supp_beli, '0') AS supp_beli,
                                    ISNULL(supp_disc, '0') AS supp_disc,
                                    ISNULL(supp_retur, '0') AS supp_retur,
                                    ISNULL(supp_biaya, '0') AS supp_biaya,
                                    ISNULL(supp_lunas_kas, '0') AS supp_lunas_kas,
                                    ISNULL(supp_lunas_cek, '0') AS supp_lunas_cek,
                                    ISNULL(supp_awal_ppn, '0') AS supp_awal_ppn,
                                    ISNULL(supp_awal_brg, '0') AS supp_awal_brg,
                                    ISNULL(supp_debet_ppn, '0') AS supp_debet_ppn,
                                    ISNULL(supp_debet_brg, '0') AS supp_debet_brg,
                                    ISNULL(supp_kredit_ppn, '0') AS supp_kredit_ppn,
                                    ISNULL(supp_kredit_brg, '0') AS supp_kredit_brg,
                                    ISNULL(supp_akhir_ppn, '0') AS supp_akhir_ppn,
                                    ISNULL(supp_akhir_brg, '0') AS supp_akhir_brg,
                                    supp_umur0,
                                    supp_umur1,
                                    supp_umur2,
                                    supp_umur3,
                                    supp_umur4,
                                    supp_flag,
                                    ISNULL(supp_debet_memo, '0') AS supp_debet_memo,
                                    ISNULL(supp_kredit_memo, '0') AS supp_kredit_memo,
                                    supp_tilpun,
                                    supp_fax,
                                    supp_keterangan,
                                    supp_ac,
                                    supp_bank,
                                    supp_contact1,
                                    supp_position1,
                                    masap.updwho,
                                    masap.updtgl,
                                    valuta_id,
                                    ISNULL(supp_awal_brgF, '0') AS supp_awal_brgF,
                                    ISNULL(supp_debet_brgF, '0') AS supp_debet_brgF,
                                    ISNULL(supp_kredit_brgF, '0') AS supp_kredit_brgF,
                                    ISNULL(supp_akhir_brgF, '0') AS supp_akhir_brgF,
                                    ISNULL(supp_lunas_kasF, '0') AS supp_lunas_kasF,
                                    ISNULL(supp_lunas_cekF, '0') AS supp_lunas_cekF,
                                    ISNULL(supp_debet_memoF, '0') AS supp_debet_memoF,
                                    ISNULL(supp_kredit_memoF, '0') AS supp_kredit_memoF,
                                    ISNULL(supp_discf, '0') AS supp_discf,
                                    isexpedisi,
                                    client_pt_id
                                    FROM BackOffice.dbo.masap
                                    LEFT JOIN BackOffice.dbo.msgl supp_per_disc
                                    ON supp_per_disc.gl01 = masap.supp_per_disc
                                    LEFT JOIN BackOffice.dbo.msgl supp_per_ppn
                                    ON supp_per_ppn.gl01 = masap.supp_per_ppn
                                    LEFT JOIN BackOffice.dbo.msgl supp_per_htng
                                    ON supp_per_htng.gl01 = masap.supp_per_htng
                                    LEFT JOIN BackOffice.dbo.msgl supp_per_beli
                                    ON supp_per_beli.gl01 = masap.supp_per_beli
                                    WHERE convert(nvarchar(36), client_pt_id) = '$client_pt_id'");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function search_no_perkiraan_all($no_perkiraan)
    {
        $query = $this->db->query("SELECT
									ISNULL(gl01, '') AS id,
									CONCAT(ISNULL(gl01, ''),' || ',ISNULL(gl02, '')) AS text
									FROM BackOffice.dbo.msgl
									WHERE (ISNULL(gl01, '') LIKE '%" . $no_perkiraan . "%' OR ISNULL(gl02, '') LIKE '%" . $no_perkiraan . "%')
									AND gl03 = 0
									AND is_aktif = '1'
									ORDER BY ISNULL(gl01, '') ASC");

        if ($query->num_rows() == 0) {
            $query = array();
        } else {
            $query = $query->result();
        }

        return $query;
    }

    public function Update_masar($masar_id, $masar_no, $masar_nama, $masar_alamat, $masar_telepon, $masar_fax, $masar_jatuh_tempo, $masar_npwp, $masar_limit, $masar_contact1, $masar_position1, $masar_no_piutang, $masar_no_disc, $masar_no_penj, $masar_no_ppn, $masar_no_retur, $updtgl, $updwho)
    {

        $backoffice = $this->load->database('backoffice', TRUE);

        $masar_id = $masar_id == '' ? null : $masar_id;
        $masar_no = $masar_no == '' ? null : $masar_no;
        $masar_nama = $masar_nama == '' ? null : $masar_nama;
        $masar_alamat = $masar_alamat == '' ? null : $masar_alamat;
        $masar_telepon = $masar_telepon == '' ? null : $masar_telepon;
        $masar_fax = $masar_fax == '' ? null : $masar_fax;
        $masar_jatuh_tempo = $masar_jatuh_tempo == '' ? null : $masar_jatuh_tempo;
        $masar_npwp = $masar_npwp == '' ? null : $masar_npwp;
        $masar_limit = $masar_limit == '' ? null : $masar_limit;
        $masar_contact1 = $masar_contact1 == '' ? null : $masar_contact1;
        $masar_position1 = $masar_position1 == '' ? null : $masar_position1;
        $masar_no_piutang = $masar_no_piutang == '' ? null : $masar_no_piutang;
        $masar_no_disc = $masar_no_disc == '' ? null : $masar_no_disc;
        $masar_no_penj = $masar_no_penj == '' ? null : $masar_no_penj;
        $masar_no_ppn = $masar_no_ppn == '' ? null : $masar_no_ppn;
        $masar_no_retur = $masar_no_retur == '' ? null : $masar_no_retur;

        $backoffice->set('masar_no', $masar_no);
        $backoffice->set('masar_nama', $masar_nama);
        $backoffice->set('masar_alamat', $masar_alamat);
        $backoffice->set('masar_telepon', $masar_telepon);
        $backoffice->set('masar_fax', $masar_fax);
        $backoffice->set('masar_npwp', $masar_npwp);
        $backoffice->set('masar_jatuh_tempo', $masar_jatuh_tempo);
        $backoffice->set('masar_limit', $masar_limit);
        $backoffice->set('masar_no_penj', $masar_no_penj);
        $backoffice->set('masar_no_disc', $masar_no_disc);
        $backoffice->set('masar_no_ppn', $masar_no_ppn);
        $backoffice->set('masar_no_piutang', $masar_no_piutang);
        $backoffice->set('masar_no_retur', $masar_no_retur);
        $backoffice->set('masar_contact1', $masar_contact1);
        $backoffice->set('masar_position1', $masar_position1);
        $backoffice->set('updwho', $this->session->userdata('pengguna_username'));
        $backoffice->set('updtgl', "GETDATE()", FALSE);

        $backoffice->where('masar_id', $masar_id);

        $backoffice->update("masar");

        $affectedrows = $backoffice->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $backoffice->last_query();
    }

    public function Update_masap($masap_id, $supp_kode, $supp_nama, $supp_alamat, $supp_tilpun, $supp_fax, $supp_contact1, $supp_position1, $supp_keterangan, $supp_ac, $supp_bank, $updtgl, $updwho, $supp_status, $supp_per_htng, $supp_per_disc, $supp_per_beli, $supp_per_ppn, $isexpedisi)
    {

        $backoffice = $this->load->database('backoffice', TRUE);

        $supp_kode = $supp_kode == '' ? Null : $supp_kode;
        $supp_nama = $supp_nama == '' ? Null : $supp_nama;
        $supp_alamat = $supp_alamat == '' ? Null : $supp_alamat;
        $supp_tilpun = $supp_tilpun == '' ? Null : $supp_tilpun;
        $supp_fax = $supp_fax == '' ? Null : $supp_fax;
        $supp_contact1 = $supp_contact1 == '' ? Null : $supp_contact1;
        $supp_position1 = $supp_position1 == '' ? Null : $supp_position1;
        $supp_keterangan = $supp_keterangan == '' ? Null : $supp_keterangan;
        $supp_ac = $supp_ac == '' ? Null : $supp_ac;
        $supp_bank = $supp_bank == '' ? Null : $supp_bank;
        $updtgl = $updtgl == '' ? Null : $updtgl;
        $updwho = $updwho == '' ? Null : $updwho;
        $supp_status = $supp_status == '' ? Null : $supp_status;
        $supp_per_htng = $supp_per_htng == '' ? Null : $supp_per_htng;
        $supp_per_disc = $supp_per_disc == '' ? Null : $supp_per_disc;
        $supp_per_beli = $supp_per_beli == '' ? Null : $supp_per_beli;
        $supp_per_ppn = $supp_per_ppn == '' ? Null : $supp_per_ppn;


        $backoffice->set('supp_kode', $supp_kode);
        $backoffice->set('supp_nama', $supp_nama);
        $backoffice->set('supp_alamat', $supp_alamat);
        $backoffice->set('supp_tilpun', $supp_tilpun);
        $backoffice->set('supp_fax', $supp_fax);
        $backoffice->set('supp_contact1', $supp_contact1);
        $backoffice->set('supp_position1', $supp_position1);
        $backoffice->set('supp_keterangan', $supp_keterangan);
        $backoffice->set('supp_ac', $supp_ac);
        $backoffice->set('supp_bank', $supp_bank);
        $backoffice->set('supp_status', $supp_status);
        $backoffice->set('supp_per_htng', $supp_per_htng);
        $backoffice->set('supp_per_disc', $supp_per_disc);
        $backoffice->set('supp_per_beli', $supp_per_beli);
        $backoffice->set('supp_per_ppn', $supp_per_ppn);
        $backoffice->set('isexpedisi', $isexpedisi);
        $backoffice->set('updwho', $this->session->userdata('pengguna_username'));
        $backoffice->set('updtgl', "GETDATE()", FALSE);

        $backoffice->where('masap_id', $masap_id);

        $backoffice->update("masap");

        $affectedrows = $backoffice->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $backoffice->last_query();
    }

    public function insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $value, $data = null)
    {
        $client_pt_alamat = $value['alamat'] == '' ? null : $value['alamat'];
        $client_pt_telepon = $value['telepon'] == '' ? null : $value['telepon'];
        $client_pt_propinsi = $value['provinsi'] == '' ? null : $value['provinsi'];
        $client_pt_kota = $value['kota'] == '' ? null : $value['kota'];
        $client_pt_kecamatan = $value['kecamatan_nama'] == '' ? null : $value['kecamatan_nama'];
        $client_pt_kelurahan = $value['kelurahan_nama'] == '' ? null : $value['kelurahan_nama'];
        $client_pt_kodepos = $value['kode_pos'] == '' ? null : $value['kode_pos'];
        $client_pt_latitude = $value['lattitude'] == '' ? null : $value['lattitude'];
        $client_pt_longitude = $value['longitude'] == '' ? null : $value['longitude'];
        $client_pt_nama_contact_person = $value['nama_person'] == '' ? null : $value['nama_person'];
        $client_pt_telepon_contact_person = $value['telepon_person'] == '' ? null : $value['telepon_person'];
        // $client_pt_email_contact_person = $value['client_pt_email_contact_person'] == '' ? null : $value['client_pt_email_contact_person'];
        // $client_pt_keterangan = $value['client_pt_keterangan'] == '' ? null : $value['client_pt_keterangan'];
        $kelas_jalan_id = $value['kelas_jalan1'] == '' ? null : $value['kelas_jalan1'];
        $kelas_jalan_id2 = $value['kelas_jalan2'] == '' ? null : $value['kelas_jalan2'];
        $fax_person = $value['fax_person'] == '' ? null : $value['fax_person'];
        $npwp_person = $value['npwp_person'] == '' ? null : $value['npwp_person'];
        $area_id = $value['area'] == '' ? null : $value['area'];

        $this->db->set("client_pt_principle_alamat_id", $client_pt_principle_alamat_id);
        $this->db->set("client_pt_principle_id", $data == null ? $value['client_pt_principle_id'] : $data['client_pt_principle_id']);
        $this->db->set("client_pt_alamat", $client_pt_alamat);
        $this->db->set("client_pt_telepon", $client_pt_telepon);
        $this->db->set("client_pt_propinsi", $client_pt_propinsi);
        $this->db->set("client_pt_kota", $client_pt_kota);
        $this->db->set("client_pt_kecamatan", $client_pt_kecamatan);
        $this->db->set("client_pt_kelurahan", $client_pt_kelurahan);
        $this->db->set("client_pt_kodepos", $client_pt_kodepos);
        $this->db->set("client_pt_latitude", $client_pt_latitude);
        $this->db->set("client_pt_longitude", $client_pt_longitude);
        $this->db->set("client_pt_nama_contact_person", $client_pt_nama_contact_person);
        $this->db->set("client_pt_telepon_contact_person", $client_pt_telepon_contact_person);
        // $this->db->set("client_pt_email_contact_person", $client_pt_email_contact_person);
        // $this->db->set("client_pt_keterangan", $client_pt_keterangan);
        $this->db->set("kelas_jalan_id", $kelas_jalan_id);
        $this->db->set("kelas_jalan2_id", $kelas_jalan_id2);
        $this->db->set("client_pt_fax", $fax_person);
        $this->db->set("client_pt_npwp", $npwp_person);
        $this->db->set("area_id", $area_id);
        $this->db->set("flag", $data == null ? $value['flag'] . '_' . $value['flag2'] : $data['flag']);

        $this->db->insert("client_pt_principle_alamat");

        $affectedrows = $this->db->affected_rows();
        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function getClientPTDefault($outlet_id)
    {
        $result = $this->db->query("SELECT a.*, c.kode_pos_id, d.kode_pos_kode FROM client_pt a LEFT JOIN kode_pos AS c ON a.client_pt_propinsi = c.kode_pos_propinsi AND a.client_pt_kota = c.kode_pos_kabupaten AND a.client_pt_kecamatan = c.kode_pos_kecamatan LEFT JOIN kode_pos_detail AS d ON a.client_pt_kelurahan = d.kode_pos_kelurahan_nama AND c.kode_pos_id = d.kode_pos_id WHERE client_pt_id = '$outlet_id'")->row_array();

        $formatted_result = array(
            'client_pt_principle_id' => isset($result['client_pt_corporate_id']) ? $result['client_pt_corporate_id'] : null,
            'flag' => isset($result['client_pt_is_aktif']) ? $result['client_pt_is_aktif'] : null,
            'random_id' => isset($result['client_pt_id']) ? $result['client_pt_id'] : null,
            'alamat' => isset($result['client_pt_alamat']) ? $result['client_pt_alamat'] : '',
            'telepon' => isset($result['client_pt_telepon']) ? $result['client_pt_telepon'] : '',
            'provinsi' => isset($result['client_pt_propinsi']) ? $result['client_pt_propinsi'] : '',
            'kota' => isset($result['client_pt_kota']) ? $result['client_pt_kota'] : '',
            'kecamatan' => isset($result['kode_pos_id']) ? $result['kode_pos_id'] : '',
            'kecamatan_nama' => isset($result['client_pt_kecamatan']) ? $result['client_pt_kecamatan'] : '',
            'kelurahan' => isset($result['kode_pos_kode']) ? $result['kode_pos_kode'] : '',
            'kelurahan_nama' => isset($result['client_pt_kelurahan']) ? $result['client_pt_kelurahan'] : '',
            'kode_pos' => isset($result['client_pt_kodepos']) ? $result['client_pt_kodepos'] : '',
            'area' => isset($result['area_id']) ? $result['area_id'] : '',
            'kelas_jalan1' => isset($result['kelas_jalan_id']) ? $result['kelas_jalan_id'] : '',
            'kelas_jalan2' => isset($result['kelas_jalan2_id']) ? $result['kelas_jalan2_id'] : '',
            'lattitude' => isset($result['client_pt_latitude']) ? $result['client_pt_latitude'] : '',
            'longitude' => isset($result['client_pt_longitude']) ? $result['client_pt_longitude'] : '',
            'nama_person' => isset($result['client_pt_nama_contact_person']) ? $result['client_pt_nama_contact_person'] : '',
            'telepon_person' => isset($result['client_pt_telepon_contact_person']) ? $result['client_pt_telepon_contact_person'] : '',
            'fax_person' => isset($result['client_pt_fax']) ? $result['client_pt_fax'] : '',
            'npwp_person' => isset($result['client_pt_npwp']) ? $result['client_pt_npwp'] : '',
        );

        return $formatted_result;
    }

    function deleteClientPTPrincipleAlamatdanDetail($outlet_id)
    {
        $this->db->query("DELETE client_pt_principle_alamat WHERE client_pt_principle_id = (SELECT client_pt_principle_id FROM client_pt_principle WHERE client_pt_id = '$outlet_id')");
        $this->db->query("DELETE client_pt_principle_alamat_detail WHERE client_pt_principle_alamat_id IN (SELECT a.client_pt_principle_alamat_id FROM client_pt_principle_alamat a LEFT JOIN
                        client_pt_principle b ON a.client_pt_principle_id = b.client_pt_principle_id WHERE b.client_pt_id = '$outlet_id')");
    }

    public function insertClientPTPrincipleAlamatDetail($id_detail, $status, $no_urut, $hari, $buka, $tutup, $pengiriman, $penagihan)
    {
        $this->db->set("client_pt_principle_alamat_detail_id", "NewID()", FALSE);
        $this->db->set("client_pt_principle_alamat_id", $id_detail);
        $this->db->set("client_pt_detail_is_open", $status);
        $this->db->set("client_pt_detail_hari_urut", $no_urut);
        $this->db->set("client_pt_detail_hari", $hari);
        $this->db->set("client_pt_detail_jam_buka", $buka);
        $this->db->set("client_pt_detail_jam_tutup", $tutup);
        $this->db->set("client_pt_detail_pengiriman", $pengiriman);
        $this->db->set("client_pt_detail_penagihan", $penagihan);
        $this->db->set("client_pt_detail_is_deleted", 0);
        $this->db->set("client_pt_detail_is_aktif", 1);

        $queryinsert = $this->db->insert("client_pt_principle_alamat_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
    }

    public function getClientPTDetail($outlet_id)
    {
        return $this->db->query("SELECT client_pt_detail_is_open as status, client_pt_detail_hari_urut as no_urut, client_pt_detail_hari as hari, CONVERT(VARCHAR(5), client_pt_detail_jam_buka, 108) as jam_buka, CONVERT(VARCHAR(5), client_pt_detail_jam_tutup, 108) as jam_tutup, client_pt_detail_pengiriman as pengiriman, client_pt_detail_penagihan as penagihan FROM client_pt_detail WHERE client_pt_id = '$outlet_id' order by client_pt_detail_hari_urut asc")->result_array();
    }

    public function getClientPtPrincipleAlamat($OutletID)
    {
        $query = $this->db->query("SELECT 
        a.client_pt_principle_alamat_id
        ,a.client_pt_principle_id
        ,a.client_pt_alamat
        ,a.client_pt_telepon
        ,a.client_pt_propinsi
        ,a.client_pt_kota
        ,a.client_pt_kecamatan
        ,c.kode_pos_id
        ,a.client_pt_kelurahan
        ,d.kode_pos_kode
        ,a.client_pt_kodepos
        ,a.client_pt_latitude
        ,a.client_pt_longitude
        ,a.client_pt_nama_contact_person
        ,a.client_pt_telepon_contact_person
        ,a.client_pt_email_contact_person
        ,a.client_pt_keterangan
        ,a.client_pt_fax
        ,a.client_pt_npwp
        ,a.kelas_jalan_id
        ,a.kelas_jalan2_id
        ,a.area_id
        ,a.flag
    	from client_pt_principle_alamat as a 
	left join client_pt_principle as cpp on cpp.client_pt_principle_id = cpp.client_pt_principle_id 
	left join kode_pos as c on a.client_pt_propinsi = c.kode_pos_propinsi and a.client_pt_kota = c.kode_pos_kabupaten and a.client_pt_kecamatan = c.kode_pos_kecamatan
    left join kode_pos_detail as d on a.client_pt_kelurahan = d.kode_pos_kelurahan_nama and c.kode_pos_id = d.kode_pos_id
    where cpp.client_pt_id = '$OutletID' order by a.client_pt_nama_contact_person ASC");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }

    public function getClientPtPrincipleAlamatDetail($client_pt_principle_alamat_id)
    {
        $query = $this->db->query("SELECT client_pt_detail_hari_urut, client_pt_detail_hari, CONVERT(VARCHAR(5), client_pt_detail_jam_buka, 108) as client_pt_detail_jam_buka, CONVERT(VARCHAR(5), client_pt_detail_jam_tutup, 108) as client_pt_detail_jam_tutup,
                client_pt_detail_is_open, client_pt_detail_pengiriman, client_pt_detail_penagihan
                FROM client_pt_principle_alamat_detail 
                WHERE client_pt_principle_alamat_id = '$client_pt_principle_alamat_id'
                ORDER BY client_pt_detail_hari_urut asc");

        if ($query->num_rows() == 0) {
            $query = 0;
        } else {
            $query = $query->result_array();
        }

        return $query;
    }
}
