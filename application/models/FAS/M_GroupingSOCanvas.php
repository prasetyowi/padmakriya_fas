<?php

use Mpdf\Utils\Arrays;

class M_GroupingSOCanvas extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model(['M_AutoGen', 'M_Vrbl', 'M_Function']);
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

	function getSales(): array
	{

		return $this->db->select('client_pt_id, client_pt_nama')->from('client_pt')
			->where('client_pt_segmen_id3', '96E77207-836B-40B1-ADA4-76E80F625B52')->get()->result();
	}

	public function getDataByFilter($dataPost)
	{
		$exlodeTanggal = explode(' - ', $dataPost->tanggal);

		$this->db->select("canvas.canvas_id,
											 canvas.canvas_kode,
											 FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') as canvas_requestdate,
											 FORMAT(canvas.canvas_startdate, 'yyyy-MM-dd') as canvas_startdate,
											 FORMAT(canvas.canvas_enddate, 'yyyy-MM-dd') as canvas_enddate,
											 client_wms.client_wms_nama,
											 isnull(client_pt.client_pt_nama, '') as sales,
											 canvas.canvas_status")
			->from('canvas')
			->join('client_wms', 'canvas.client_wms_id = client_wms.client_wms_id', 'left')
			->join('client_pt', 'canvas.client_pt_id = client_pt.client_pt_id', 'left')
			->where('canvas.depo_id', $this->session->userdata('depo_id'))
			->where("FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') >=", date('Y-m-d', strtotime(str_replace("/", "-", $exlodeTanggal[0]))))
			->where("FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') <=", date('Y-m-d', strtotime(str_replace("/", "-", $exlodeTanggal[1]))));
		if ($dataPost->canvasId !== 'all') $this->db->where('canvas.canvas_id', $dataPost->canvasId);
		if ($dataPost->perusahaan !== 'all') $this->db->where('canvas.client_wms_id', $dataPost->perusahaan);
		if ($dataPost->sales !== 'all') $this->db->where('canvas.client_pt_id', $dataPost->sales);
		if ($dataPost->status !== 'all') $this->db->where('canvas.canvas_status', $dataPost->status);
		return $this->db->order_by('canvas.canvas_kode', 'ASC')->get()->result();
	}

	public function getDataCanvas($canvasId)
	{
		$response = [];
		$area = [];

		$response['header'] = $this->db->select("canvas.canvas_id,
																						canvas.canvas_kode,
																						FORMAT(canvas.canvas_requestdate, 'yyyy-MM-dd') as canvas_requestdate,
																						FORMAT(canvas.canvas_startdate, 'yyyy-MM-dd') as canvas_startdate,
																						FORMAT(canvas.canvas_enddate, 'yyyy-MM-dd') as canvas_enddate,
																						client_wms.client_wms_nama,
																						client_wms.client_wms_id,
																						isnull(client_pt.client_pt_nama, '') as sales,
																						canvas.canvas_status,
																						canvas.canvas_tgl_update")
			->from('canvas')
			->join('client_wms', 'canvas.client_wms_id = client_wms.client_wms_id', 'left')
			->join('client_pt', 'canvas.client_pt_id = client_pt.client_pt_id', 'left')
			->where('canvas.canvas_id', $canvasId)->get()->row();


		$getAreaCanvas = $this->db->select('area.area_kode')
			->from('canvas_detail_3 a')
			->join('area', 'a.area_id = area.area_id', 'left')
			->where('a.canvas_id', $canvasId)->get()->result();

		if ($getAreaCanvas) {
			foreach ($getAreaCanvas as $key => $val) {
				$area[] = $val->area_kode;
			}
		}

		$response['header']->area = $area;

		return (object) $response;
	}

	public function getDataSOByTypeCanvas($dataPost)
	{
		$this->db->distinct()->select("so.sales_order_id,
															FORMAT(so.sales_order_tgl, 'yyyy-MM-dd') as tanggal,
															so.sales_order_kode,
															so.sales_order_no_po,
															so.sales_id,
															k.karyawan_nama as sales,
															client_pt.client_pt_nama as customer,
															client_pt.client_pt_alamat as alamat,
															so.sales_order_keterangan")
			->from("sales_order so")
			->join('client_pt', 'so.client_pt_id = client_pt.client_pt_id', 'left')
			->join('tipe_sales_order tso', 'so.tipe_sales_order_id = tso.tipe_sales_order_id', 'left')
			->join('karyawan k', 'k.karyawan_id = so.sales_id', 'left')
			// ->join('client_wms_principle cwp', 'so.client_wms_id = cwp.client_wms_id', 'left')
			// ->join('principle p', 'cwp.principle_id = p.principle_id', 'left')
			// ->join('principle_brand pb', 'p.principle_id = p.principle_id', 'left')
			->where('so.client_wms_id', $dataPost->clientWmsId)
			->where('so.tipe_sales_order_id', '81887BB5-AD0F-45AF-BDE9-C2AE49061510')
			->where('so.depo_id', $this->session->userdata("depo_id"));
		// if ($dataPost->principleBrandId !== "all") $this->db->where('pb.principle_brand_id', $dataPost->principleBrandId);
		if ($dataPost->salesId !== "all") $this->db->where('so.sales_id', $dataPost->salesId);
		return $this->db->where('so.canvas_id', NULL)
			->where('tso.tipe_sales_order_nama', 'CANVAS')
			->where('so.sales_order_status', 'Approved')
			->order_by('so.sales_order_kode', 'ASC')->get()->result();
	}

	// public function getBrandByClientWms($clientWmsId)
	// {
	// 	return $this->db->select("pb.principle_brand_id as id, pb.principle_brand_nama as brand")
	// 		->from("client_wms_principle cwp")
	// 		->join('principle p', 'cwp.principle_id = p.principle_id', 'left')
	// 		->join('principle_brand pb', 'p.principle_id = pb.principle_id', 'left')
	// 		->where('cwp.client_wms_id', $clientWmsId)
	// 		->where('pb.principle_brand_id !=', NULL)
	// 		->order_by('pb.principle_brand_nama', 'ASC')->get()->result();
	// }

	public function getSalesByClientWms($clientWmsId)
	{
		return $this->db->select("k.karyawan_id as id, k.karyawan_nama as nama")
			->from("karyawan k")
			->join('karyawan_divisi kd', 'k.karyawan_divisi_id = kd.karyawan_divisi_id', 'left')
			->where('k.client_wms_id', $clientWmsId)
			->where('k.depo_id', $this->session->userdata('depo_id'))
			->where('kd.karyawan_divisi_nama', 'sales')
			->order_by('k.karyawan_nama', 'ASC')->get()->result();
	}

	public function summaryDetailDataSOChoose($dataPost)
	{

		if (!$dataPost->salesOrderId) return [];

		$salesOrderId = [];

		for ($i = 0; $i < count($dataPost->salesOrderId); $i++) {
			$salesOrderId[$i] = "'" . $dataPost->salesOrderId[$i] . "'";
		}

		return $this->db->query("SELECT b.sku_konversi_group, b.sku_nama_produk,
																left(b.compositeCanvas,Len(b.compositeCanvas)-1) As composite_satuan,
																isnull(left(b.QtyCanvas,Len(b.QtyCanvas)-1), '0') As qty_canvas,
																--left(mergecomposite.composite,Len(mergecomposite.composite)-1) As composite_satuan_terjual,
																isnull(left(mergecomposite.Qty,Len(mergecomposite.Qty)-1), b.valuecomposite) As qty_terjual
														from (
															select distinct b2.sku_konversi_group, b2.sku_nama_produk, 
																			(
																					select cast(a1.sku_qty as varchar(255)) + '/' as [text()]
																						from (
																							select sku_qty, sku_konversi_group, sku_konversi_level
																							from (
																									select sum(a1.sku_qty) sku_qty, b1.sku_konversi_group, b1.sku_konversi_level
																										from sales_order_detail a1
																								inner join sku b1 on a1.sku_id = b1.sku_id
																										where b1.sku_konversi_group = b2.sku_konversi_group
																											and sales_order_id in (" . implode(',', $salesOrderId) . ")
																									group by b1.sku_konversi_group, b1.sku_konversi_level
																										union
																									select 0 as sku_qty, sku_konversi_group, sku_konversi_level
																										from sku
																										where sku_id not in (select sku_id
																															from sales_order_detail
																																where sales_order_id in (" . implode(',', $salesOrderId) . ")
																															)
																											and sku_konversi_group in (select b.sku_konversi_group 
																																	from sales_order_detail a
																																inner join sku b on a.sku_id = b.sku_id 
																																		where sales_order_id in (" . implode(',', $salesOrderId) . "))
																											and sku.sku_konversi_group =  b2.sku_konversi_group
																									) as xx
																									) as a1
																					order by sku_konversi_group, sku_konversi_level desc
																				for xml path (''), type
																			).value('text()[1]','nvarchar(max)') [Qty],
																			(
																					select b1.sku_satuan + '/' as [text()]
																						from sales_order_detail a1
																				inner join sku b1 on a1.sku_id = b1.sku_id
																						where b1.sku_konversi_group = b2.sku_konversi_group
																							and sales_order_id in (" . implode(',', $salesOrderId) . ")
																					order by a1.sku_kode
																				for xml path (''), type
																			).value('text()[1]','nvarchar(max)') [composite]
																from sales_order_detail a2
														inner join SKU b2 on a2.sku_id = b2.sku_id
																where sales_order_id in (" . implode(',', $salesOrderId) . ")
																) mergecomposite
														right join (
															select distinct b2.sku_konversi_group, b2.sku_nama_produk, 
																			(
																					select cast(a.sku_qty as varchar(255)) + '/' as [text()] 
																						from (
																							select cast(a1.sku_qty as varchar(255)) as sku_qty, b1.sku_konversi_group, b1.sku_konversi_level
																							from canvas_detail a1
																						inner join sku b1 on a1.sku_id = b1.sku_id
																								where canvas_id = '$dataPost->canvasId'
																								and b1.sku_konversi_group =  b2.sku_konversi_group
																								union
																							select 0 as sku_qty, sku_konversi_group, sku_konversi_level
																							from sku
																								where sku_id not in (select sku_id
																													from canvas_detail
																													where canvas_id = '$dataPost->canvasId')
																								and sku_konversi_group in (select b.sku_konversi_group 
																															from canvas_detail a
																													inner join sku b on a.sku_id = b.sku_id 
																															where canvas_id = '$dataPost->canvasId')
																								and sku.sku_konversi_group =  b2.sku_konversi_group
																								) as a
																					order by sku_konversi_level desc
																				for xml path (''), type
																			).value('text()[1]','nvarchar(max)') [QtyCanvas],
																			(
																					select b1.sku_satuan + '/' as [text()]
																						from sku b1
																						where b1.sku_konversi_group in (select b.sku_konversi_group 
																															from canvas_detail a
																													inner join sku b on a.sku_id = b.sku_id 
																														where canvas_id = '$dataPost->canvasId')
																							and b1.sku_konversi_group = b2.sku_konversi_group
																					order by b1.sku_konversi_level desc
																				for xml path (''), type
																			).value('text()[1]','nvarchar(max)') [compositeCanvas],
																			maxcomposite.valuecomposite
																from canvas_detail a2
														inner join SKU b2 on a2.sku_id = b2.sku_id
														left join (
															select sku_konversi_group, maxcomposite,
																	case when maxcomposite = 1 then '0'
																	when maxcomposite = 2 then '0/0'
																	when maxcomposite = 3 then '0/0/0'
																	end as valuecomposite
															from(
																select count(sku_konversi_group) maxcomposite, sku_konversi_group from sku group by sku_konversi_group
																) as a
															) as maxcomposite on maxcomposite.sku_konversi_group = b2.sku_konversi_group
																where canvas_id = '$dataPost->canvasId'
																) as b on mergecomposite.sku_konversi_group = b.sku_konversi_group")->result();

		// return $this->db->query("SELECT
		// 														sku_id,
		// 														sku_kode,
		// 														sku_nama,
		// 														sku_kemasan,
		// 														sku_satuan,
		// 														SUM(sku_qty_canvas) AS sku_qty_canvas,
		// 														SUM(sku_qty_so) AS sku_qty_so,
		// 														SUM(sku_qty_canvas) - SUM(sku_qty_so) as sisa
		// 													FROM (SELECT
		// 																sod.sku_id,
		// 																sku.sku_kode,
		// 																sku.sku_nama_produk as sku_nama,
		// 																sku.sku_kemasan,
		// 																sku.sku_satuan,
		// 																SUM(sod.sku_qty) AS sku_qty_so,
		// 																0 AS sku_qty_canvas,
		// 																'so' AS ket
		// 															FROM sales_order_detail sod
		// 															LEFT JOIN sku ON sod.sku_id = sku.sku_id
		// 															WHERE sod.sales_order_id IN (" . implode(',', $salesOrderId) . ")
		// 															GROUP BY sod.sku_id,sod.sku_id,sku.sku_kode,sku.sku_nama_produk,sku.sku_kemasan,sku.sku_satuan
		// 															UNION ALL
		// 															SELECT
		// 																sku_id,
		// 																sku_kode,
		// 																sku_nama,
		// 																sku_kemasan,
		// 																sku_satuan,
		// 																0 AS sku_qty_so,
		// 																SUM(sku_qty) AS sku_qty_canvas,
		// 																'canvas' AS ket
		// 															FROM canvas_detail
		// 															WHERE canvas_id = '$dataPost->canvasId'
		// 															GROUP BY sku_id, sku_id,sku_kode,sku_nama,sku_kemasan,sku_satuan) a
		// 													GROUP BY sku_id,sku_kode,sku_nama,sku_kemasan,sku_satuan
		// 													ORDER BY sku_kode")->result();
	}

	public function checkTempCanvasGrouping($canvasId, $type)
	{

		if ($type === 'edit') {
			return $this->db->select("gsct.sales_order_id,
															FORMAT(so.sales_order_tgl, 'yyyy-MM-dd') as tanggal,
															so.sales_order_kode,
															so.sales_order_no_po,
															client_pt.client_pt_nama as customer,
															client_pt.client_pt_alamat as alamat,
															so.sales_order_keterangan")
				->from("grouping_so_canvas_temp gsct")
				->join('sales_order so', 'gsct.sales_order_id = so.sales_order_id', 'left')
				->join('client_pt', 'so.client_pt_id = client_pt.client_pt_id', 'left')
				->join('tipe_sales_order tso', 'so.tipe_sales_order_id = tso.tipe_sales_order_id', 'left')
				->where('gsct.canvas_id', $canvasId)
				->order_by('so.sales_order_kode', 'ASC')->get()->result();
		}

		if ($type === 'view') {
			return $this->db->select("so.sales_order_id,
															FORMAT(so.sales_order_tgl, 'yyyy-MM-dd') as tanggal,
															so.sales_order_kode,
															so.sales_order_no_po,
															client_pt.client_pt_nama as customer,
															client_pt.client_pt_alamat as alamat,
															so.sales_order_keterangan")
				->from("sales_order so")
				->join('client_pt', 'so.client_pt_id = client_pt.client_pt_id', 'left')
				->join('tipe_sales_order tso', 'so.tipe_sales_order_id = tso.tipe_sales_order_id', 'left')
				->where('so.canvas_id', $canvasId)
				->order_by('so.sales_order_kode', 'ASC')->get()->result();
		}
	}

	public function saveData($dataPost)
	{
		$this->db->trans_begin();

		$getSalesOrderTemp = $this->db->select("sales_order_id")->from('grouping_so_canvas_temp')->where('canvas_id', $dataPost->canvasId)->get()->result();
		if ($getSalesOrderTemp) {
			foreach ($getSalesOrderTemp as $key => $value) {
				$this->db->update('sales_order', [
					'canvas_id' => NULL,
				], ['sales_order_id' => $value->sales_order_id]);
			}
		}

		$this->db->delete('grouping_so_canvas_temp', ['canvas_id' => $dataPost->canvasId]);

		$lastUpdatedChecked = checkLastUpdatedData((object) [
			'table' => "canvas",
			'whereField' => "canvas_id",
			'whereValue' => $dataPost->canvasId,
			'fieldDateUpdate' => "canvas_tgl_update",
			'fieldWhoUpdate' => "canvas_who_update",
			'lastUpdated' => $dataPost->lastUpdated
		]);

		if (COUNT($dataPost->dataSO) > 0) {
			foreach ($dataPost->dataSO as $key => $value) {
				$canvasGroupingTempId = $this->M_Function->Get_NewID()[0]['kode'];

				$this->db->insert('grouping_so_canvas_temp', [
					'grouping_so_canvas_temp_id' => $canvasGroupingTempId,
					'canvas_id' => $dataPost->canvasId,
					'sales_order_id' => $value
				]);

				$this->db->update('sales_order', [
					'canvas_id' => $dataPost->canvasId,
				], ['sales_order_id' => $value]);
			}
		}

		$this->db->update('canvas', ['canvas_status' => 'in progress'], ['canvas_id' => $dataPost->canvasId]);

		return responseJson((object)[
			'lastUpdatedChecked' => $lastUpdatedChecked,
			'status' => 'Disimpan'
		]);
	}

	// public function confirmationData($dataPost)
	// {
	// 	$this->db->trans_begin();

	// 	$this->db->delete('grouping_so_canvas_temp', ['canvas_id' => $dataPost->canvasId]);

	// 	$lastUpdatedChecked = checkLastUpdatedData((object) [
	// 		'table' => "canvas",
	// 		'whereField' => "canvas_id",
	// 		'whereValue' => $dataPost->canvasId,
	// 		'fieldDateUpdate' => "canvas_tgl_update",
	// 		'fieldWhoUpdate' => "canvas_who_update",
	// 		'lastUpdated' => $dataPost->lastUpdated
	// 	]);

	// 	$this->db->update('canvas', ['canvas_status' => 'in progress'], ['canvas_id' => $dataPost->canvasId]);

	// 	foreach ($dataPost->dataSO as $key => $value) {
	// 		$this->db->update('sales_order', [
	// 			'canvas_id' => $dataPost->canvasId,
	// 		], ['sales_order_id' => $value]);
	// 	}

	// 	return responseJson((object)[
	// 		'lastUpdatedChecked' => $lastUpdatedChecked,
	// 		'status' => 'Dikonfirmasi'
	// 	]);
	// }
}
