<?php
class M_DataTable extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function dtTableGetList($sql)
    {
        $data = $this->input->post();
        // echo json_encode(($data)); exit();

        $dt_draw = $this->input->post("draw");
        $dt_start = $this->input->post("start");
        $dt_length = $this->input->post("length");

        $dt_columns_arr = $this->input->post("columns");
        $dt_order_arr = $this->input->post("order");
        $dt_search = $this->input->post("search")['value'];

        $this->db->from('(' . $sql . ') t1');
        $TotalRecords = $this->db->count_all_results();
        // echo $this->db->last_query(); exit();

        $this->dtTableGetList_query($sql, $dt_columns_arr, $dt_search);
        $TotalRecordsWithFilter = $this->db->count_all_results();
        // echo $this->db->last_query(); exit();

        $this->dtTableGetList_query($sql, $dt_columns_arr, $dt_search);
        $this->db->limit($dt_length, $dt_start);
        foreach ($dt_order_arr as $key => $o_value) {
            $this->db->order_by($dt_columns_arr[$o_value['column']]['data'], $o_value['dir']);
        }
        $AllRecords = $this->db->get()->result_array();
        // echo $this->db->last_query(); exit();

        $output = array(
            "draw" => $dt_draw,
            "recordsTotal" => $TotalRecords,
            "recordsFiltered" => $TotalRecordsWithFilter,
            "data" => $AllRecords,
        );
        return $output;
    }
    function dtTableGetList_query($sql,  $dt_columns_arr, $dt_search)
    {
        $this->db->from('(' . $sql . ') t1');
        if ($dt_search != '') {
            foreach ($dt_columns_arr as $key => $column) {
                if ($column['searchable'] == 'true') {
                    $searchValueArr = explode(' ', $dt_search);
                    if (count($searchValueArr) > 1) {
                        $x = 0;
                        foreach ($searchValueArr as $key => $s_value) {
                            if ($x == 0) {
                                $x++;
                                $this->db->or_like($column['data'], $s_value);
                            } else {
                                $this->db->like($column['data'], $s_value);
                            }
                        }
                    } else {
                        $this->db->or_like($column['data'], $dt_search);
                    }
                }
            }
        }
    }
}
