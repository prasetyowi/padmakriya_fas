<?php

class M_Canvas extends CI_Model
{
    public function Insert_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $no_kendaraan, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create)
    {
        // $canvas_id = $canvas_id == "" ? null : $canvas_id;
        $depo_id = $depo_id == "" ? null : $depo_id;
        $canvas_kode = $canvas_kode == "" ? null : $canvas_kode;
        $canvas_requestdate = $canvas_requestdate == "" ? null : $canvas_requestdate;
        $client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
        $karyawan_id = $karyawan_id == "" ? null : $karyawan_id;
        $no_kendaraan = $no_kendaraan == "" ? null : $no_kendaraan;
        $canvas_keterangan = $canvas_keterangan == "" ? null : $canvas_keterangan;
        $canvas_startdate = $canvas_startdate == "" ? null : $canvas_startdate;
        $canvas_enddate = $canvas_enddate == "" ? null : $canvas_enddate;
        $canvas_status = $canvas_status == "" ? null : $canvas_status;
        $canvas_tanggal_create = $canvas_tanggal_create == "" ? null : $canvas_tanggal_create;
        $canvas_who_create = $canvas_who_create == "" ? null : $canvas_who_create;

        $this->db->set("canvas_id", $canvas_id);
        $this->db->set("depo_id", $depo_id);
        $this->db->set("canvas_kode", $canvas_kode);
        $this->db->set("canvas_requestdate", $canvas_requestdate);
        $this->db->set("client_wms_id", $client_wms_id);
        $this->db->set("karyawan_id", $karyawan_id);
        $this->db->set("no_kendaraan", $no_kendaraan);
        $this->db->set("canvas_keterangan", $canvas_keterangan);
        $this->db->set("canvas_startdate", $canvas_startdate);
        $this->db->set("canvas_enddate", $canvas_enddate);
        $this->db->set("canvas_status", $canvas_status);
        $this->db->set("canvas_tanggal_create", "GETDATE()", FALSE);
        $this->db->set("canvas_who_create", $canvas_who_create);

        $this->db->insert("canvas");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $this->db->last_query();
    }

    public function Insert_canvas_detail($canvas_detail_id, $canvas_id, $sku_id, $sku_kode, $sku_nama, $sku_kemasan, $sku_satuan, $sku_qty, $sku_keterangan, $tipe_stock_nama)
    {
        // $canvas_detail_id = $canvas_detail_id ==  "" ? null : $canvas_detail_id;
        $canvas_id = $canvas_id ==  "" ? null : $canvas_id;
        $sku_id = $sku_id ==  "" ? null : $sku_id;
        $sku_kode = $sku_kode ==  "" ? null : $sku_kode;
        $sku_nama = $sku_nama ==  "" ? null : $sku_nama;
        $sku_kemasan = $sku_kemasan ==  "" ? null : $sku_kemasan;
        $sku_satuan = $sku_satuan ==  "" ? null : $sku_satuan;
        $sku_qty = $sku_qty ==  "" ? null : $sku_qty;
        $sku_keterangan = $sku_keterangan ==  "" ? null : $sku_keterangan;
        $tipe_stock_nama = $tipe_stock_nama ==  "" ? null : $tipe_stock_nama;

        $this->db->set("canvas_detail_id", $canvas_detail_id);
        $this->db->set("canvas_id", $canvas_id);
        $this->db->set("sku_id", $sku_id);
        $this->db->set("sku_kode", $sku_kode);
        $this->db->set("sku_nama", $sku_nama);
        $this->db->set("sku_kemasan", $sku_kemasan);
        $this->db->set("sku_satuan", $sku_satuan);
        $this->db->set("sku_qty", $sku_qty);
        $this->db->set("sku_keterangan", $sku_keterangan);
        $this->db->set("tipe_stock_nama", $tipe_stock_nama);

        $this->db->insert("canvas_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $this->db->last_query();
    }

    public function Insert_canvas_detail_2($canvas_detail_2_id, $canvas_detail_id, $canvas_id, $sku_id, $sku_stock_id, $sku_expdate, $sku_qty)
    {
        // $canvas_detail_id = $canvas_detail_id ==  "" ? null : $canvas_detail_id;
        $canvas_detail_2_id =  $canvas_detail_2_id ==  "" ? null : $canvas_detail_2_id;
        $canvas_detail_id =  $canvas_detail_id ==  "" ? null : $canvas_detail_id;
        $canvas_id =  $canvas_id ==  "" ? null : $canvas_id;
        $sku_id =  $sku_id ==  "" ? null : $sku_id;
        $sku_stock_id =  $sku_stock_id ==  "" ? null : $sku_stock_id;
        $sku_expdate =  $sku_expdate ==  "" ? null : $sku_expdate;
        $sku_qty =  $sku_qty ==  "" ? null : $sku_qty;

        $this->db->set("canvas_detail_2_id", $canvas_detail_2_id);
        $this->db->set("canvas_detail_id", $canvas_detail_id);
        $this->db->set("canvas_id", $canvas_id);
        $this->db->set("sku_id", $sku_id);
        $this->db->set("sku_stock_id", $sku_stock_id);
        $this->db->set("sku_expdate", $sku_expdate);
        $this->db->set("sku_qty", $sku_qty);

        $this->db->insert("canvas_detail_2");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryinsert = 1;
        } else {
            $queryinsert = 0;
        }

        return $queryinsert;
        // return $this->db->last_query();
    }

    public function Update_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $no_kendaraan, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create)
    {
        // $canvas_id = $canvas_id == "" ? null : $canvas_id;
        $depo_id = $depo_id == "" ? null : $depo_id;
        $canvas_kode = $canvas_kode == "" ? null : $canvas_kode;
        $canvas_requestdate = $canvas_requestdate == "" ? null : $canvas_requestdate;
        $client_wms_id = $client_wms_id == "" ? null : $client_wms_id;
        $karyawan_id = $karyawan_id == "" ? null : $karyawan_id;
        $no_kendaraan = $no_kendaraan == "" ? null : $no_kendaraan;
        $canvas_keterangan = $canvas_keterangan == "" ? null : $canvas_keterangan;
        $canvas_startdate = $canvas_startdate == "" ? null : $canvas_startdate;
        $canvas_enddate = $canvas_enddate == "" ? null : $canvas_enddate;
        $canvas_status = $canvas_status == "" ? null : $canvas_status;
        $canvas_tanggal_create = $canvas_tanggal_create == "" ? null : $canvas_tanggal_create;
        $canvas_who_create = $canvas_who_create == "" ? null : $canvas_who_create;

        $this->db->set("depo_id", $depo_id);
        $this->db->set("canvas_kode", $canvas_kode);
        $this->db->set("canvas_requestdate", $canvas_requestdate);
        $this->db->set("client_wms_id", $client_wms_id);
        $this->db->set("karyawan_id", $karyawan_id);
        $this->db->set("no_kendaraan", $no_kendaraan);
        $this->db->set("canvas_keterangan", $canvas_keterangan);
        $this->db->set("canvas_startdate", $canvas_startdate);
        $this->db->set("canvas_enddate", $canvas_enddate);
        $this->db->set("canvas_status", $canvas_status);
        $this->db->set("canvas_tanggal_create", "GETDATE()", FALSE);
        $this->db->set("canvas_who_create", $canvas_who_create);

        $this->db->where("canvas_id", $canvas_id);

        $this->db->update("canvas");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
        // return $this->db->last_query();
    }

    public function Update_canvas_detail($canvas_detail_id, $canvas_id, $sku_id, $sku_kode, $sku_nama, $sku_kemasan, $sku_satuan, $sku_qty, $sku_keterangan, $tipe_stock_nama)
    {
        // $canvas_detail_id = $canvas_detail_id == "" ? null : $canvas_detail_id;
        $canvas_id = $canvas_id == "" ? null : $canvas_id;
        $sku_id = $sku_id == "" ? null : $sku_id;
        $sku_kode = $sku_kode == "" ? null : $sku_kode;
        $sku_nama = $sku_nama == "" ? null : $sku_nama;
        $sku_kemasan = $sku_kemasan == "" ? null : $sku_kemasan;
        $sku_satuan = $sku_satuan == "" ? null : $sku_satuan;
        $sku_qty = $sku_qty == "" ? null : $sku_qty;
        $sku_keterangan = $sku_keterangan == "" ? null : $sku_keterangan;
        $tipe_stock_nama = $tipe_stock_nama == "" ? null : $tipe_stock_nama;

        $this->db->set("canvas_id", $canvas_id);
        $this->db->set("sku_id", $sku_id);
        $this->db->set("sku_kode", $sku_kode);
        $this->db->set("sku_nama", $sku_nama);
        $this->db->set("sku_kemasan", $sku_kemasan);
        $this->db->set("sku_satuan", $sku_satuan);
        $this->db->set("sku_qty", $sku_qty);
        $this->db->set("sku_keterangan", $sku_keterangan);
        $this->db->set("tipe_stock_nama", $tipe_stock_nama);

        $this->db->where("canvas_detail_id", $canvas_detail_id);

        $this->db->update("canvas_detail");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
        // return $this->db->last_query();
    }

    public function Update_canvas_detail_2($canvas_detail_2_id, $canvas_detail_id, $canvas_id, $sku_id, $sku_stock_id, $sku_expdate, $sku_qty)
    {
        // $canvas_detail_id = $canvas_detail_id == "" ? null : $canvas_detail_id;
        $canvas_detail_2_id = $canvas_detail_2_id == "" ? null : $canvas_detail_2_id;
        $canvas_detail_id = $canvas_detail_id == "" ? null : $canvas_detail_id;
        $canvas_id = $canvas_id == "" ? null : $canvas_id;
        $sku_id = $sku_id == "" ? null : $sku_id;
        $sku_stock_id = $sku_stock_id == "" ? null : $sku_stock_id;
        $sku_expdate = $sku_expdate == "" ? null : $sku_expdate;
        $sku_qty = $sku_qty == "" ? null : $sku_qty;

        $this->db->set("canvas_detail_id", $canvas_detail_id);
        $this->db->set("canvas_id", $canvas_id);
        $this->db->set("sku_id", $sku_id);
        $this->db->set("sku_stock_id", $sku_stock_id);
        $this->db->set("sku_expdate", $sku_expdate);
        $this->db->set("sku_qty", $sku_qty);

        $this->db->where("canvas_detail_2_id", $canvas_detail_2_id);

        $this->db->update("canvas_detail_2");

        $affectedrows = $this->db->affected_rows();

        if ($affectedrows > 0) {
            $queryupdate = 1;
        } else {
            $queryupdate = 0;
        }

        return $queryupdate;
        // return $this->db->last_query();
    }
}
