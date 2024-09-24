<?php

class M_PerencanaanDanPersiapan extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model(['M_AutoGen', 'M_Vrbl', 'M_Function']);
	}

	public function GetAllPrinciple()
	{
		$query = $this->db->query("SELECT * FROM principle WHERE principle_is_aktif = '1' ORDER BY principle_kode ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function GetPrincipleByPerusahaan($perusahaan)
	{
		$query = $this->db->query("SELECT p.principle_id, p.principle_kode, p.principle_nama FROM client_wms_principle cwp
		LEFT JOIN principle p ON p.principle_id = cwp.principle_id
		WHERE cwp.client_wms_id = '$perusahaan' ORDER BY p.principle_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function getDataByFilter($dataPost)
	{

		$response = [];

		$wherestatus = "";
		$whereclient = "";
		if ($dataPost->status != "") {
			$wherestatus = "AND canvas.canvas_status = '$dataPost->status' ";
		} else {
			$wherestatus = "";
		}
		if ($this->session->userdata('client_wms_id') == '') {
			if ($dataPost->perusahaan != "") {
				$whereclient = "AND canvas.client_wms_id='$dataPost->perusahaan'";
			} else {
				$whereclient = "";
			}
		} else {
			if ($dataPost->perusahaan != "") {
				$whereclient = "AND canvas.client_wms_id='$dataPost->perusahaan'";
			} else {
				$whereclient = "AND canvas.client_wms_id='" . $this->session->userdata('client_wms_id') . "'";
			}
		}

		$datas = $this->db->query("SELECT canvas.canvas_id,
									canvas.depo_id,
									canvas.canvas_kode,
									FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') AS canvas_requestdate,
									canvas.client_wms_id,
									canvas.karyawan_id,
									canvas.kendaraan_id,
									canvas.canvas_keterangan,
									canvas.canvas_startdate,
									canvas.canvas_enddate,
									canvas.canvas_status,
									canvas.canvas_tanggal_create,
									canvas.canvas_who_create,
									ISNULL(canvas.canvas_reff_kode,'') AS canvas_reff_kode,
									canvas.client_pt_id,
									canvas.canvas_tgl_update,
									canvas.canvas_who_update,
									canvas.principle_id,
									cw.client_wms_nama,
									ISNULL(cp.client_pt_nama, '') AS sales,
									FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') AS tanggal,
									principle.principle_kode,
									CASE
										WHEN canvas_reff_kode IS NOT NULL THEN 'YES'
										ELSE 'NO'
									END AS is_download
								FROM canvas
								LEFT JOIN client_wms cw ON canvas.client_wms_id = cw.client_wms_id
								LEFT JOIN client_pt cp ON canvas.client_pt_id = cp.client_pt_id
								LEFT JOIN principle ON canvas.principle_id = principle.principle_id
								WHERE YEAR(canvas.canvas_requestdate) = '$dataPost->tahun'
								AND MONTH(canvas.canvas_requestdate) ='$dataPost->bulan'
                                AND canvas.depo_id ='" . $this->session->userdata('depo_id') . "'
								$wherestatus $whereclient order by canvas.canvas_kode")->result();

		if ($datas) {
			foreach ($datas as $key => $value) {
				$area = [];
				$getArea = $this->db->select('area.area_kode')
					->from('canvas_detail_3 a')
					->join('area', 'a.area_id = area.area_id', 'left')
					->where('a.canvas_id', $value->canvas_id)->get()->result();

				if ($getArea) {
					foreach ($getArea as $key => $val) {
						$area[] = $val->area_kode;
					}
				}

				array_push($response, [
					'canvas_id' => $value->canvas_id,
					'canvas_kode' => $value->canvas_kode,
					'client_wms_nama' => $value->client_wms_nama,
					'tanggal' => $value->tanggal,
					'canvas_startdate' => $value->canvas_startdate,
					'canvas_enddate' => $value->canvas_enddate,
					'sales' => $value->sales,
					'area' => $area,
					'canvas_status' => $value->canvas_status,
					'canvas_tgl_update' => $value->canvas_tgl_update,
					'principle_kode' => $value->principle_kode,
					'canvas_reff_kode' => $value->canvas_reff_kode,
					'is_download' => $value->is_download,
				]);
			}
		}

		return $response;
	}

	public function GetCanvasByFilter($tgl1, $tgl2, $perusahaan)
	{
		$query = $this->db->query("select
										canvas.canvas_id,
										canvas.depo_id,
										canvas.canvas_kode,
										FORMAT(canvas.canvas_requestdate,'dd-MM-yyyy') AS canvas_requestdate,
										canvas.client_wms_id,
										canvas.karyawan_id,
										canvas.kendaraan_id,
										canvas.canvas_keterangan,
										FORMAT(canvas.canvas_startdate,'dd-MM-yyyy') AS canvas_startdate,
										FORMAT(canvas.canvas_enddate,'dd-MM-yyyy') AS canvas_enddate,
										canvas.canvas_status,
										canvas.canvas_tanggal_create,
										canvas.canvas_who_create,
										ISNULL(canvas.canvas_reff_kode,'') AS canvas_reff_kode,
										canvas.client_pt_id,
										canvas.canvas_tgl_update,
										canvas.canvas_who_update,
										canvas.principle_id,
										cw.client_wms_nama,
										ISNULL(karyawan.karyawan_nama,'') AS karyawan_nama,
										client_pt.area_id,
										ISNULL(area.area_kode,'') AS area_kode,
										principle.principle_kode,
										CASE
											WHEN canvas_reff_kode IS NOT NULL THEN 'YES'
											ELSE 'NO'
										END AS is_download
									FROM canvas
									LEFT JOIN client_wms cw
									ON canvas.client_wms_id = cw.client_wms_id
									left join karyawan
									ON karyawan.karyawan_id = canvas.karyawan_id
									left join client_pt
									on client_pt.client_pt_id = canvas.client_pt_id
									left join area
									on area.area_id = client_pt.area_id
									LEFT JOIN principle ON canvas.principle_id = principle.principle_id
									WHERE FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									AND canvas.depo_id = '" . $this->session->userdata('depo_id') . "'
									AND canvas.client_wms_id = '$perusahaan'
									ORDER BY canvas_kode");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function getDataSkuByClientPt($dataPost)
	{

		return $this->db->query("SELECT
                              client_wms.client_wms_nama,
                              sku.sku_id,
                              sku.sku_kode,
                              sku.sku_nama_produk,
                              sku.principle_id,
                              principle.principle_kode AS principle,
                              sku.principle_brand_id,
                              principle_brand.principle_brand_nama AS brand,
                              sku.sku_kemasan,
                              sku.sku_satuan,
                              sku.sku_induk_id,
                              sku_induk.sku_induk_nama AS sku_induk
                            FROM client_wms_principle
                            INNER JOIN sku
                              ON client_wms_principle.principle_id = sku.principle_id
                            INNER JOIN sku_stock
                              ON sku.sku_id = sku_stock.sku_id
                            LEFT JOIN sku_induk
                              ON sku.sku_induk_id = sku_induk.sku_induk_id
                            LEFT JOIN principle
                              ON principle.principle_id = sku.principle_id
                            LEFT JOIN principle_brand
                              ON principle_brand.principle_brand_id = sku.principle_brand_id
                            INNER JOIN client_wms
                              ON client_wms_principle.client_wms_id = client_wms.client_wms_id
							WHERE client_wms_principle.client_wms_id = '$dataPost->perusahaan' AND sku.principle_id = '$dataPost->principle_id'
                            GROUP BY 
                                client_wms.client_wms_nama, 
                                sku.sku_id,
                                sku.sku_kode,
                                sku.sku_nama_produk,
                                sku.principle_id,
                                principle.principle_kode,
                                sku.principle_brand_id,
                                principle_brand.principle_brand_nama,
                                sku.sku_kemasan,
                                sku.sku_satuan,
                                sku.sku_induk_id,
                                sku_induk.sku_induk_nama
                            ORDER BY sku.sku_id ASC")->result();
	}

	public function GetSelectedSKU($dataPost)
	{
		// return $dataPost->arr_sku;
		return $this->db->select("sku.sku_id,
                              p.principle_kode as principle,
                              pb.principle_brand_nama as brand,
                              sku.sku_kode,
                              sku.sku_nama_produk,
                              sku.sku_kemasan,
                              sku.sku_satuan")
			->from("sku")
			->join("principle p", "sku.principle_id = p.principle_id", "left")
			->join("principle_brand pb", "sku.principle_brand_id = pb.principle_brand_id", "left")
			->where_in("sku.sku_id", $dataPost->arr_sku)->get()->result();
	}
	public function GetPerusahaan()
	{
		$pengguna_grup_id = $this->session->userdata('pengguna_grup_id');
		$is_dewa = $this->db->query("select * from pengguna_grup where pengguna_grup_id ='$pengguna_grup_id' and pengguna_grup_is_dewa =1")->num_rows();

		if ($is_dewa > 0) {

			// $client = "where client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '" . $this->session->userdata('karyawan_id') . "' GROUP BY client_wms_id)";
			// $query = $this->db->query("SELECT * FROM client_wms 
			// 						ORDER BY client_wms_nama ASC");

			$query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "'
										ORDER BY b.client_wms_nama ASC");


			if ($query->num_rows() == 0) {
				$query = 0;
			} else {
				$query = $query->result_array();
			}
		} else {

			if ($this->session->userdata('client_wms_id') == '') {
				$query = 0;
			} else {
				$client = "where client_wms_id= '" . $this->session->userdata('client_wms_id') . "'";
				// $query = $this->db->query("SELECT * FROM client_wms 
				// 				" . $client . "
				// 					ORDER BY client_wms_nama ASC");

				$query = $this->db->query("select
											b.*
										from depo_client_wms a
										left join client_wms b
										on b.client_wms_id = a.client_wms_id 
										where a.depo_id = '" . $this->session->userdata('depo_id') . "' AND a.client_wms_id= '" . $this->session->userdata('client_wms_id') . "'
										ORDER BY b.client_wms_nama ASC");

				if ($query->num_rows() == 0) {
					$query = 0;
				} else {
					$query = $query->result_array();
				}
			}
		}
		return $query;
	}

	public function getTipeStock()
	{
		$this->db->select("*")
			->from("gettipestock()")
			->where("tipe_stock_is_aktif", "1")
			->order_by("tipe_stock_urut");
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
	}

	public function getEdSkuById($dataPost)
	{
		$query = $this->db->query("SELECT
									sku_stock.depo_detail_id,
									ISNULL(depo_detail.depo_detail_nama,'') AS depo_detail_nama,
									sku_stock.sku_stock_id,
									sku_stock.sku_id,
									FORMAT(sku_stock.sku_stock_expired_date, 'MM-dd-yyyy') AS sku_stock_expired_date,
									ISNULL(sku_stock.sku_stock_awal, 0) + ISNULL(sku_stock.sku_stock_masuk, 0) - ISNULL(sku_stock.sku_stock_saldo_alokasi, 0) - ISNULL(sku_stock.sku_stock_keluar, 0) - (select
										ISNULL(SUM(dtl2.sku_qty),0) AS sku_qty
									from canvas hdr
									left join canvas_detail_2 dtl2
									on dtl2.canvas_id = hdr.canvas_id
									left join delivery_order_draft do
									on do.canvas_id = hdr.canvas_id
									where hdr.canvas_status IN ('Draft','In Progress Approval','Approved','In Progress')
									and do.canvas_id IS NULL
									and dtl2.sku_stock_id = sku_stock.sku_stock_id) AS sku_stock_akhir
									FROM sku_stock
									LEFT JOIN depo_detail
									ON sku_stock.depo_detail_id = depo_detail.depo_detail_id
									WHERE sku_stock.sku_stock_is_jual = '1'
									AND depo_detail.depo_detail_flag_jual = '1'
									AND depo_detail.depo_detail_is_flashout = '0'
									AND depo_detail.depo_detail_is_kirimulang = '0'
									AND depo_detail.depo_detail_is_qa = '0'
									AND depo_detail.depo_detail_is_bonus = '0'
									AND depo_detail.depo_detail_is_bs = '0'
									AND sku_stock.sku_id = '$dataPost->sku_id'
									ORDER BY sku_stock.sku_stock_expired_date ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function getDepoPrefix($depo_id)
	{
		$data = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $data->row();
	}

	public function saveData($dataPost)
	{
		$this->db->trans_begin();

		//insert canvas
		$canvasId = $this->M_Function->Get_NewID();
		$canvasId = $canvasId[0]['kode'];

		$date_now = date('Y-m-d h:i:s');
		$param =  'KODE_CVS';
		$vrbl = $this->M_Vrbl->Get_Kode($param);
		$prefix = $vrbl->vrbl_kode;
		// get prefik depo
		$depoPrefix = $this->getDepoPrefix($this->session->userdata('depo_id'));
		$unit = $depoPrefix->depo_kode_preffix;
		$generateKode = $this->M_AutoGen->Exec_CodeGenGeneralTanggal($date_now, $prefix, $unit);

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "canvas",
			'whereField' => "canvas_id",
			'whereValue' => $dataPost->mode == 'new' ? $canvasId : $dataPost->canvasId,
			'fieldDateUpdate' => "canvas_tgl_update",
			'fieldWhoUpdate' => "canvas_who_update",
			'lastUpdated' => $dataPost->lastUpdated
		]);

		if ($dataPost->mode == 'new') {
			$this->db->set('canvas_id', $canvasId);
			$this->db->set('depo_id', $this->session->userdata('depo_id'));
			$this->db->set('canvas_kode', $generateKode);
			$this->db->set('canvas_requestdate', "GETDATE()", false);
			$this->db->set('client_wms_id',  $dataPost->perusahaan);
			// $this->db->set('karyawan_id', $this->session->userdata('karyawan_id'));
			$this->db->set('kendaraan_id', $dataPost->kendaraanId);
			$this->db->set('canvas_keterangan', $dataPost->keterangan == "" ? NULL : $dataPost->keterangan);
			$this->db->set('canvas_startdate', $dataPost->tglMulai);
			$this->db->set('canvas_enddate', $dataPost->tglAkgir);
			$this->db->set('canvas_status', $dataPost->status);
			$this->db->set('principle_id', $dataPost->principle_id);
			$this->db->set('canvas_tanggal_create', "GETDATE()", false);
			$this->db->set('canvas_who_create', $this->session->userdata('pengguna_username'));

			// $this->db->set('canvas_tgl_update', "GETDATE()", false);
			// $this->db->set('canvas_who_update', $this->session->userdata('pengguna_username'));

			$this->db->set('client_pt_id', $dataPost->sales);
			$insert = $this->db->insert('canvas');
		}

		if ($dataPost->mode == 'edit') {

			$this->db->set('kendaraan_id', $dataPost->kendaraanId);
			$this->db->set('canvas_keterangan', $dataPost->keterangan == "" ? NULL : $dataPost->keterangan);
			$this->db->set('canvas_startdate', $dataPost->tglMulai);
			$this->db->set('canvas_enddate', $dataPost->tglAkgir);
			$this->db->set('canvas_status', $dataPost->status);
			$this->db->set('client_pt_id', $dataPost->sales);
			$this->db->set('principle_id', $dataPost->principle_id);
			$this->db->where('canvas_id', $dataPost->canvasId);

			$insert = $this->db->update('canvas');

			$this->db->where('canvas_id', $dataPost->canvasId);
			$this->db->delete("canvas_detail");

			$this->db->where('canvas_id', $dataPost->canvasId);
			$this->db->delete("canvas_detail_2");

			$this->db->where('canvas_id', $dataPost->canvasId);
			$this->db->delete("canvas_detail_3");
		}

		//insert canvas detail
		foreach ($dataPost->canvasDetail as $key => $detail) {

			$canvasDetailId = $this->M_Function->Get_NewID();
			$canvasDetailId = $canvasDetailId[0]['kode'];

			$this->db->set('canvas_detail_id', $canvasDetailId);
			if ($dataPost->mode == 'new') {
				$this->db->set('canvas_id', $canvasId);
			}
			if ($dataPost->mode == 'edit') {
				$this->db->set('canvas_id', $dataPost->canvasId);
			}
			$this->db->set('sku_id', $detail->sku_id);
			$this->db->set('sku_kode', $detail->sku_kode);
			$this->db->set('sku_nama', $detail->sku_nama_produk);
			$this->db->set('sku_kemasan',  $detail->sku_kemasan);
			$this->db->set('sku_satuan', $detail->sku_satuan);
			$this->db->set('sku_qty', $detail->qty);
			$this->db->set('sku_keterangan', $detail->keterangan == "" ? NULL : $detail->keterangan);
			$this->db->set('tipe_stock_nama', $detail->type);
			$insert1 = $this->db->insert('canvas_detail');
			if (!$insert1) {
				return $this->db->error()['message'];
			} else {
				// foreach ($dataPost->canvasDetail2 as $key => $detail2) {
				// 	if ($detail->sku_id == $detail2->sku_id) {
				// 		if ($detail2->sku_qty != "") {
				// 			$this->db->set('canvas_detail_2_id', "NEWID()", false);
				// 			$this->db->set('canvas_detail_id', $canvasDetailId);
				// 			if ($dataPost->mode == 'new') {
				// 				$this->db->set('canvas_id', $canvasId);
				// 			}
				// 			if ($dataPost->mode == 'edit') {
				// 				$this->db->set('canvas_id', $dataPost->canvasId);
				// 			}
				// 			$this->db->set('sku_id', $detail2->sku_id);
				// 			$this->db->set('sku_stock_id', $detail2->sku_stock_id);
				// 			$this->db->set('sku_expdate',  date("Y-m-d", strtotime(str_replace("-", "/", $detail2->exp_date))));
				// 			$this->db->set('sku_qty', $detail2->sku_qty);
				// 			$insert2 = $this->db->insert('canvas_detail_2');

				// 			if (!$insert2) {
				// 				return $this->db->error()['message'];
				// 			}
				// 		}
				// 	}
				// }
			}
		}

		foreach ($dataPost->areas as $key => $value) {
			$canvasDetail3Id = $this->M_Function->Get_NewID()[0]['kode'];

			$this->db->insert('canvas_detail_3', [
				'canvas_detail_3_id' => $canvasDetail3Id,
				'canvas_id' => $dataPost->mode == 'new' ? $canvasId : ($dataPost->mode == 'edit' ? $dataPost->canvasId : ''),
				'area_id' => $value,
			]);
		}

		if ($dataPost->mode == 'new') {
			$cId = $canvasId;
			$kode = $generateKode;
		}

		if ($dataPost->mode == 'edit') {
			$cId = $dataPost->canvasId;
			$kode = $dataPost->kodeDokumen;
		}

		// if ($dataPost->status == "In Progress Approval") {
		// 	$this->db->query("exec approval_pengajuan '" . $this->session->userdata('depo_id') . "', '" . $this->session->userdata('pengguna_id') . "', 'APPRV_CVS_01', '$cId', '$kode', 0, 0");
		// }

		if (!$insert) {
			$this->db->trans_rollback();
			return $this->db->error()['message'];
		}

		if ($lastUpdatedChecked['status'] === 400) {
			$this->db->trans_rollback();
			$response = [
				'status' => 400,
				'message' => 'Data Gagal Disimpan',
			];
		} else if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$response = [
				'status' => 401,
				'message' => 'Data Gagal Disimpan',
			];
		} else {
			$this->db->trans_commit();
			$response = [
				'status' => 200,
				'message' => 'Data Berhasil Disimpan',
			];
		}

		return $response;

		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	return $this->db->error()['message'];
		// } else {
		// 	$this->db->trans_commit();
		// 	return true;
		// }
	}

	public function getDataCanvasById($id)
	{
		$queryAreas = $this->db->select("area_id")->from('canvas_detail_3')->where('canvas_id', $id)->get()->result();
		$detailAreas = [];

		if ($queryAreas) {
			foreach ($queryAreas as $key => $value) {
				$detailAreas[] = $value->area_id;
			}
		}

		return (object) [
			'header' => $this->db->select("canvas.*, FORMAT(canvas_requestdate, 'yyyy-MM-dd') as canvas_requestdate")->from('canvas')->where('canvas_id', $id)->get()->row(),
			'detailAreas' => $detailAreas,
		];
	}

	public function requestDataDetailCanvas($dataPost)
	{
		$canvasDetail =  $this->db->query("SELECT cd.canvas_detail_id,
											cd.canvas_id,
											cd.sku_id,
											cd.sku_kode,
											cd.sku_nama,
											cd.sku_kemasan,
											cd.sku_satuan,
											cd.sku_qty,
											SUM(cd2.sku_qty) AS sku_qty_dtl2,
											cd.sku_keterangan,
											cd.tipe_stock_nama,
											p.principle_nama AS principle,
											pb.principle_brand_nama AS brand,
											CASE
												WHEN SUM(cd2.sku_qty) = cd.sku_qty THEN '1'
												ELSE '0'
											END is_cocok
										FROM canvas_detail cd
										LEFT JOIN canvas_detail_2 cd2 ON cd2.canvas_detail_id = cd.canvas_detail_id
										LEFT JOIN sku ON cd.sku_id = sku.sku_id
										LEFT JOIN principle p ON sku.principle_id = p.principle_id
										LEFT JOIN principle_brand pb ON sku.principle_brand_id = pb.principle_brand_id
										WHERE cd.canvas_id = '$dataPost->canvasId'
										GROUP BY cd.canvas_detail_id,
												cd.canvas_id,
												cd.sku_id,
												cd.sku_kode,
												cd.sku_nama,
												cd.sku_kemasan,
												cd.sku_satuan,
												cd.sku_keterangan,
												cd.tipe_stock_nama,
												p.principle_nama,
												pb.principle_brand_nama,
												cd.sku_qty
										ORDER BY cd.sku_kode ASC")->result();

		$canvasDetail2 =  $this->db->select("sku_id, sku_stock_id, FORMAT(sku_expdate, 'MM-dd-yyyy') as exp_date, sku_qty")->from('canvas_detail_2')->where('canvas_id', $dataPost->canvasId)->get()->result();

		$result = [
			'canvasDetail' => $canvasDetail,
			'canvasDetail2' => $canvasDetail2
		];
		return $result;
	}

	public function deleteDataCanvas($dataPost)
	{
		$this->db->trans_begin();

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "canvas",
			'whereField' => "canvas_id",
			'whereValue' => $dataPost->canvasId,
			'fieldDateUpdate' => "canvas_tgl_update",
			'fieldWhoUpdate' => "canvas_who_update",
			'lastUpdated' => $dataPost->lastUpdated
		]);

		$this->db->where('canvas_id', $dataPost->canvasId);
		$this->db->delete("canvas");


		$this->db->where('canvas_id', $dataPost->canvasId);
		$this->db->delete("canvas_detail");


		$this->db->where('canvas_id', $dataPost->canvasId);
		$this->db->delete("canvas_detail_2");

		if ($lastUpdatedChecked['status'] === 400) {
			$this->db->trans_rollback();
			$response = [
				'status' => 400,
				'message' => 'Data Gagal Dihapus',
			];
		} else if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$response = [
				'status' => 401,
				'message' => 'Data Gagal Dihapus',
			];
		} else {
			$this->db->trans_commit();
			$response = [
				'status' => 200,
				'message' => 'Data Berhasil Dihapus',
			];
		}

		return $response;

		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	return $this->db->error()['message'];
		// } else {
		// 	$this->db->trans_commit();
		// 	return true;
		// }
	}

	public function Insert_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $no_kendaraan, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create, $canvas_reff_kode, $principle_id, $client_pt_id)
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
		$canvas_reff_kode = $canvas_reff_kode == "" ? null : $canvas_reff_kode;
		$principle_id = $principle_id == "" ? null : $principle_id;
		$client_pt_id = $client_pt_id == "" ? null : $client_pt_id;

		$this->db->set("canvas_id", $canvas_id);
		$this->db->set("depo_id", $depo_id);
		$this->db->set("canvas_kode", $canvas_kode);
		$this->db->set("canvas_requestdate", $canvas_requestdate);
		$this->db->set("client_wms_id", $client_wms_id);
		$this->db->set("karyawan_id", $karyawan_id);
		// $this->db->set("no_kendaraan", $no_kendaraan);
		$this->db->set("canvas_keterangan", $canvas_keterangan);
		$this->db->set("canvas_startdate", $canvas_startdate);
		$this->db->set("canvas_enddate", $canvas_enddate);
		$this->db->set("canvas_status", $canvas_status);
		$this->db->set("canvas_tanggal_create", "GETDATE()", FALSE);
		$this->db->set("canvas_who_create", $canvas_who_create);
		$this->db->set("canvas_reff_kode", $canvas_reff_kode);
		$this->db->set("principle_id", $principle_id);
		$this->db->set("client_pt_id", $client_pt_id);
		$this->db->set("canvas_tgl_update", "GETDATE()", FALSE);
		$this->db->set("canvas_who_update", $this->session->userdata('pengguna_username'));

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

	public function Update_canvas($canvas_id, $depo_id, $canvas_kode, $canvas_requestdate, $client_wms_id, $karyawan_id, $no_kendaraan, $canvas_keterangan, $canvas_startdate, $canvas_enddate, $canvas_status, $canvas_tanggal_create, $canvas_who_create, $principle_id)
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
		$principle_id = $principle_id == "" ? null : $principle_id;

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
		$this->db->set("principle_id", $principle_id);
		$this->db->set("canvas_tgl_update", "GETDATE()", FALSE);
		$this->db->set("canvas_who_update", $this->session->userdata('pengguna_username'));

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

	public function CekDuplikatCanvas($canvas_kode)
	{
		$this->db->select("*")
			->from("canvas")
			->where("canvas_kode", $canvas_kode);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function CekDuplikatCanvasByReffId($canvas_reff_kode)
	{
		$this->db->select("*")
			->from("canvas")
			->where("canvas_reff_kode", $canvas_reff_kode);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function CekCanvasById($canvas_id)
	{
		$this->db->select("*")
			->from("canvas")
			->where("canvas_id", $canvas_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	function getKendaraans(): array
	{
		return $this->db->select('kendaraan_id, kendaraan_nopol')->from('kendaraan')
			->where('depo_id', $this->session->userdata('depo_id'))
			->where('kendaraan_is_aktif', 1)->get()->result();
	}

	function getAreas(): array
	{
		$getAreaHeader = $this->db->select('area_header_id')->from('depo_area_header')->where('depo_id', $this->session->userdata('depo_id'))->get()->result();
		$areaheaderId = [];
		if ($getAreaHeader) {
			foreach ($getAreaHeader as $key => $value) {
				$areaheaderId[] = $value->area_header_id;
			}
		}

		return $this->db->select('area_id, area_kode, area_nama')->from('area')
			->where_in('area_header_id', $areaheaderId)->get()->result();
	}

	function getSales(): array
	{

		return $this->db->select('client_pt_id, client_pt_nama')->from('client_pt')
			->where('client_pt_segmen_id3', '96E77207-836B-40B1-ADA4-76E80F625B52')->get()->result();
	}
}
