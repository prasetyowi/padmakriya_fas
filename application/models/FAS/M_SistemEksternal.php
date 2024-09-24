<?php

class M_SistemEksternal extends CI_Model
{
	//tes user baru ya

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function GetPerusahaan()
	{
		// $this->db->distinct()
		// 	->select("b.client_wms_nama, b.client_wms_id")
		// 	->from("sku_stock a")
		// 	->join("client_wms b", "a.client_wms_id = b.client_wms_id")
		// 	->where("a.depo_id", $this->session->userdata("depo_id"))
		// 	->order_by("client_wms_nama");
		// $query = $this->db->get();
		$query = $this->db->query("SELECT client_wms_nama, client_wms_id FROM client_wms ORDER BY client_wms_nama");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_data_depo($depo_id)
	{
		$query = $this->db->query("SELECT * FROM depo where depo_id = '$depo_id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetAllPrinciple()
	{
		$this->db->select("*")
			->from("principle")
			->where("principle_is_aktif", 1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPrinciple($perusahaan)
	{
		$this->db->select("*")
			->from("client_wms_principle")
			->where("client_wms_id", $perusahaan);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function GetPrincipleByPerusahaan($perusahaan)
	{
		$query = $this->db->query("SELECT
									a.client_wms_principle_id,
									a.client_wms_id,
									a.principle_id,
									b.principle_kode
									FROM client_wms_principle a
									INNER JOIN principle b
									ON b.principle_id = a.principle_id
									WHERE a.client_wms_id = '$perusahaan'
									ORDER BY b.principle_kode ASC");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function CheckPrinciplePerusahaan($perusahaan)
	{
		$this->db->select("*")
			->from("client_wms_principle")
			->where("client_wms_id", $perusahaan);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Get_depo_eksternal($depo_id, $sistem_eksternal)
	{
		$query = $this->db->query("SELECT
									depo.depo_id,
									depo.depo_nama,
									ISNULL(depo_eksternal.sistem_eksternal,'') AS sistem_eksternal,
									ISNULL(depo_eksternal.depo_eksternal_kode,'') AS depo_eksternal_kode
									FROM depo
									LEFT JOIN MIDDLEWARE.dbo.depo_eksternal
									ON depo_eksternal.depo_id = depo.depo_id
									AND depo_eksternal.sistem_eksternal = '$sistem_eksternal'
									WHERE depo.depo_id = '$depo_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Get_principle_by_kode($principle_kode)
	{
		$query = $this->db->select("*")->from('principle')->where('principle_kode', $principle_kode)->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->principle_id;
		}

		return $query;
	}

	public function getDepoPrefix($depo_id)
	{
		$listDoBatch = $this->db->select("*")->from('depo')->where('depo_id', $depo_id)->get();
		return $listDoBatch->row();
	}

	public function Get_SalesOrderBosnet($tgl, $depo, $principle, $tipe_so, $tipe_do, $filter_principle_so)
	{
		$filter_principle_so = $filter_principle_so != "" ? " AND product.szCategory_1 = '$filter_principle_so' " : "";

		if ($depo == "999") {
			$depo = "AND so.szWorkplaceId IN ('777','$depo')";
		} else {
			$depo = "AND so.szWorkplaceId = '$depo'";
		}

		if ($tipe_so != "") {
			$tipe_so = "AND so.szStatus = '$tipe_so'";
		} else {
			$tipe_so = "";
		}

		if ($tipe_do == "DO_DRAFT") {
			$tipe_do = "AND (do.bApplied = '0' AND do.bVoid = '0')";
		} else if ($tipe_do == "DO_TIDAK_ADA") {
			$tipe_do = "AND do.szDoId IS NULL";
		} else if ($tipe_do == "DO_TERKIRIM") {
			$tipe_do = "AND (do.bApplied = '1' AND do.bVoid = '0')";
		} else {
			$tipe_do = "";
		}

		$principle = implode(",", $principle);

		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									so.szFSoId,
									so.szOrderTypeId,
									FORMAT(so.dtmOrder, 'dd-MM-yyyy') AS dtmOrder,
									product.szCategory_1,
									so.szCustId,
									customer.szName AS cust_name,
									so.decAmount
									FROM BOS_SD_FSo so
									LEFT JOIN BOS_SD_FDo do
									ON do.szFSoId = so.szFSoId
									LEFT JOIN BOS_SD_FSoItem so_item
									ON so.szFSoId = so_item.szFSoId
									AND so_item.szProductId <> ''
									LEFT JOIN BOS_AR_Customer customer
									ON customer.szCustId = so.szCustId
									LEFT JOIN BOS_INV_Product product
									ON product.szProductId = so_item.szProductId
									WHERE FORMAT(so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									" . $tipe_so . "
									AND so.bApplied = '1' AND so.bVoid = '0' 
									" . $tipe_do . "
									AND product.szCategory_1 IN (" . $principle . ")
									" . $depo . "
									" . $filter_principle_so . "
									GROUP BY so.szFSoId,
											so.szOrderTypeId,
											FORMAT(so.dtmOrder, 'dd-MM-yyyy'),
											product.szCategory_1,
											so.szCustId,
											customer.szName,
											so.decAmount
									ORDER BY so.szFSoId ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_SalesOrderBosnetWithoutDO($tgl, $depo, $principle)
	{
		if ($depo == "999") {
			$depo = "AND so.szWorkplaceId IN ('777','$depo')";
		} else {
			$depo = "AND so.szWorkplaceId = '$depo'";
		}

		$principle = implode(",", $principle);

		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									so.szFSoId,
									so.szOrderTypeId,
									FORMAT(so.dtmOrder, 'dd-MM-yyyy') AS dtmOrder,
									product.szCategory_1,
									so.szCustId,
									customer.szName AS cust_name,
									so.decAmount
									FROM BOS_SD_FSo so
									LEFT JOIN BOS_SD_FDo do
									ON do.szFSoId = so.szFSoId
									LEFT JOIN BOS_SD_FSoItem so_item
									ON so.szFSoId = so_item.szFSoId
									AND so_item.szProductId <> ''
									LEFT JOIN BOS_AR_Customer customer
									ON customer.szCustId = so.szCustId
									LEFT JOIN BOS_INV_Product product
									ON product.szProductId = so_item.szProductId
									WHERE FORMAT(so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									AND so.szStatus = 'OPE'
									AND so.bApplied = '1' AND so.bVoid = '0'
									AND product.szCategory_1 IN (" . $principle . ")
									" . $depo . "
									GROUP BY so.szFSoId,
											so.szOrderTypeId,
											FORMAT(so.dtmOrder, 'dd-MM-yyyy'),
											product.szCategory_1,
											so.szCustId,
											customer.szName,
											so.decAmount
									ORDER BY so.szFSoId ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_SalesOrderBosnetInFAS($tgl, $depo)
	{
		$query = $this->db->query("SELECT DISTINCT
									bosnet_so.szFSoId,
									bosnet_so.szOrderTypeId,
									FORMAT(bosnet_so.dtmOrder, 'dd-MM-yyyy') AS dtmOrder,
									ISNULL(convert(nvarchar(36), so.client_pt_id),'') AS client_pt_id,
									client_pt.client_pt_nama,
									ISNULL(principle.principle_kode, '') AS principle_kode,
									so.sales_id,
									karyawan.karyawan_nama,
									bosnet_so.decAmount,
									so.sales_order_id
									FROM MIDDLEWARE.dbo.bosnet_so
									LEFT JOIN sales_order so
									ON so.sales_order_no_po = bosnet_so.szFSoId
									LEFT JOIN client_pt
									ON client_pt.client_pt_id = so.client_pt_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									LEFT JOIN karyawan
									ON karyawan.karyawan_id = so.sales_id
									WHERE so.sales_order_id IS NOT NULL
									AND bosnet_so.szWorkplaceId = '$depo'
									AND FORMAT(bosnet_so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									ORDER BY bosnet_so.szFSoId");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_bosnet_so_by_filter($tgl, $depo_eksternal)
	{
		$query = $this->db->query("SELECT
									szFSoId,
									szSalesOrgId,
									CASE
										WHEN szOrderTypeId IN ('RETUR', 'RETUR-KHUSUS', 'SWAP') THEN 'RETUR'
										ELSE 'JUAL'
									END szOrderTypeId,
									dtmOrder,
									dtmPrice,
									szCustId,
									decAmount,
									decTax,
									decDownPayment,
									szStatus,
									szCcyId,
									szCcyRateId,
									decCcyRate,
									szFInvoiceId,
									szCompletedFInvoiceId,
									szFirstCompletedFInvoiceId,
									bDropShip,
									szSalesId,
									szSalesSupervisorId,
									szSalesSupervisorId_2,
									szSalesSupervisorId_3,
									szSalesDivisionId,
									szSalesDepartmentId,
									szSalesTeamId,
									szRemark,
									szLatitude,
									szLongitude,
									szCustPoId,
									dtmCustPo,
									bCash,
									gdCreditLimitApprovedId,
									bNeedFInvoice,
									szPaymentTermId,
									bResultFrTransfer,
									bVoid,
									bApplied,
									btPrintedCount,
									bTransferred,
									szCompanyId,
									szWorkplaceId,
									szTaxEntityId,
									bNeedApproval,
									gdApprovedId,
									szFJournalId,
									dtmCreated,
									bSystemCreated,
									szUserId,
									dtmLastUpdated,
									bAlreadyTransferred,
									decTonase,
									decCubication,
									bUploadedFromMoDis,
									szFDoReffId,
									dtmStartVisit,
									dtmEndVisit,
									decVisitSpendTime,
									bScanSuccess,
									szScanFailReason,
									szBarcodeScanFailReason,
									decJourneySpendTime,
									AdcId,
									dtmExpiration
									FROM MIDDLEWARE.dbo.bosnet_so
									WHERE FORMAT(dtmOrder, 'yyyy-MM-dd') = '$tgl'
									AND szWorkplaceId = '$depo_eksternal'
									ORDER BY szFSoId ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_customer_from_bosnet_so($tgl, $depo)
	{
		$query = $this->db->query("SELECT
									bosnet_so.szCustId
									FROM MIDDLEWARE.dbo.bosnet_so
									LEFT JOIN sales_order so
									ON so.sales_order_no_po = bosnet_so.szFSoId
									LEFT JOIN MIDDLEWARE.dbo.client_pt_principle_eksternal customer_eksternal
									ON customer_eksternal.customer_eksternal_id = bosnet_so.szCustId
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales_eksternal
									ON sales_eksternal.sales_eksternal_id = bosnet_so.szSalesId
									WHERE so.sales_order_id IS NULL
									AND bosnet_so.szWorkplaceId = '$depo'
									AND FORMAT(bosnet_so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									AND CASE WHEN customer_eksternal.customer_eksternal_id IS NOT NULL THEN 1 ELSE 0 END = 0
									GROUP BY bosnet_so.szCustId
									ORDER BY bosnet_so.szCustId ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}


	public function Get_sales_from_bosnet_so($tgl, $depo)
	{
		$query = $this->db->query("SELECT
									bosnet_so.szSalesId
									FROM MIDDLEWARE.dbo.bosnet_so
									LEFT JOIN sales_order so
									ON so.sales_order_no_po = bosnet_so.szFSoId
									LEFT JOIN MIDDLEWARE.dbo.client_pt_principle_eksternal customer_eksternal
									ON customer_eksternal.customer_eksternal_id = bosnet_so.szCustId
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales_eksternal
									ON sales_eksternal.sales_eksternal_id = bosnet_so.szSalesId
									WHERE so.sales_order_id IS NULL
									AND bosnet_so.szWorkplaceId = '$depo'
									AND FORMAT(bosnet_so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									AND CASE WHEN sales_eksternal.sales_eksternal_id IS NOT NULL THEN 1 ELSE 0 END = 0
									GROUP BY bosnet_so.szSalesId
									ORDER BY bosnet_so.szSalesId ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function Get_SalesOrderBosnetNotInFAS($tgl, $depo, $status)
	{
		if ($status == "1") {
			$status = " AND (CASE WHEN customer_eksternal.customer_eksternal_id IS NOT NULL THEN 1 ELSE 0 END = 1 AND CASE WHEN sales_eksternal.sales_eksternal_id IS NOT NULL THEN 1 ELSE 0 END = 1 AND CASE WHEN area.area_kode = bosnet_so.szDeliveryGroupId THEN 1 ELSE 0 END = 1)";
		} else if ($status == "0") {
			$status = " AND (CASE WHEN customer_eksternal.customer_eksternal_id IS NOT NULL THEN 1 ELSE 0 END <> 1 OR CASE WHEN sales_eksternal.sales_eksternal_id IS NOT NULL THEN 1 ELSE 0 END <> 1 OR CASE WHEN area.area_kode = bosnet_so.szDeliveryGroupId THEN 1 ELSE 0 END <> 1)";
		} else {
			$status = "";
		}

		$query = $this->db->query("SELECT DISTINCT bosnet_so.szFSoId,
													bosnet_so.szOrderTypeId,
													bosnet_so.szCustId,
													bosnet_so.szSalesId,
													ISNULL(convert(nvarchar(36), cp.client_pt_id), '') AS client_pt_id,
													FORMAT(bosnet_so.dtmOrder, 'dd-MM-yyyy') AS dtmOrder,
													bosnet_so.decAmount,
													so.sales_order_id,
													CASE
														WHEN cpa.client_pt_principle_id IS NOT NULL THEN 1
														ELSE 0
													END customer_status,
													CASE
														WHEN sales_eksternal.sales_eksternal_id IS NOT NULL THEN 1
														ELSE 0
													END sales_status,
													bosnet_so.bosnet_so_tgl_update AS tglUpdate,
													area.area_kode,
													bosnet_so.szDeliveryGroupId,
													CASE
														WHEN area.area_kode = bosnet_so.szDeliveryGroupId THEN 1
														ELSE 0
													END area_status
									FROM MIDDLEWARE.dbo.bosnet_so
									LEFT JOIN sales_order so ON so.sales_order_no_po = bosnet_so.szFSoId
									LEFT JOIN MIDDLEWARE.dbo.client_pt_principle_eksternal customer_eksternal ON customer_eksternal.customer_eksternal_id = bosnet_so.szCustId
									LEFT JOIN client_pt_principle cp ON cp.client_pt_id = customer_eksternal.client_pt_id AND cp.principle_id = customer_eksternal.principle_id
									LEFT JOIN client_pt_principle_alamat cpa ON cpa.client_pt_principle_id = cp.client_pt_principle_id
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales_eksternal ON sales_eksternal.sales_eksternal_id = bosnet_so.szSalesId
									LEFT JOIN area ON area.area_id = cpa.area_id
									WHERE so.sales_order_id IS NULL
									AND bosnet_so.szWorkplaceId = '$depo'
									AND FORMAT(bosnet_so.dtmOrder, 'yyyy-MM-dd') = '$tgl'
									" . $status . "
									ORDER BY bosnet_so.szFSoId");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_sales_eksternal_id($depo)
	{
		$query = $this->db->query("select TOP 1
										a.sales_eksternal_id
									from karyawan_sales_eksternal a
									left join karyawan b
									on b.karyawan_id = a.karyawan_id
									where b.depo_id = '$depo'
									AND karyawan_is_client_wms = '1'
									AND a.sistem_eksternal = 'BOSNET' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->sales_eksternal_id;
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function GetDepoBosnetByDepoFas($sales_eksternal_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT szWorkplaceId AS depo FROM BOS_PI_Employee WHERE szEmployeeId = '$sales_eksternal_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->depo;
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_so_bosnet_detail($so_id)
	{
		$query = $this->db->query("SELECT
									so_detail.szFSoId,
									so_detail.shItemNumber,
									so_detail.szOrderItemTypeId,
									so_detail.szProductId,
									so_detail.szPriceId,
									so_detail.szPriceOrderId,
									so_detail.dtmPriceDate,
									so_detail.decDiscProcent,
									so_detail.decQty,
									so_detail.decUomQty,
									so_detail.szUomId,
									so_detail.decPrice,
									so_detail.decDiscount,
									so_detail.bTaxable,
									so_detail.decTax,
									so_detail.decAmount,
									so_detail.decDPP,
									so_detail.szPaymentType,
									so_detail.szPrincipalDiscRefId,
									so_detail.decTonase,
									so_detail.decCubication,
									so_detail.szParentId,
									so_detail.szDistProductId,
									so_detail.decDistQty,
									so_detail.decDistPrice,
									so_detail.szBudgetId,
									so_detail.decPrincipalCostAmount,
									so_detail.decPrincipalCostQty,
									so_detail.bBudgetTransferred,
									so_detail.bBonusFrPriceGroup,
									sku.client_wms_id
									FROM MIDDLEWARE.dbo.bosnet_so so
									LEFT JOIN MIDDLEWARE.dbo.bosnet_so_detail so_detail
									ON so_detail.szFSoId = so.szFSoId
									LEFT JOIN sku
									ON sku.sku_konversi_group = so_detail.szProductId
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales
									ON sales.sales_eksternal_id = so.szSalesId
									WHERE so.szFSoId = '$so_id'
									AND so_detail.szProductId <> ''
									AND sales.sales_eksternal_id IS NOT NULL
									GROUP BY so_detail.szFSoId,
											so_detail.shItemNumber,
											so_detail.szOrderItemTypeId,
											so_detail.szProductId,
											so_detail.szPriceId,
											so_detail.szPriceOrderId,
											so_detail.dtmPriceDate,
											so_detail.decDiscProcent,
											so_detail.decQty,
											so_detail.decUomQty,
											so_detail.szUomId,
											so_detail.decPrice,
											so_detail.decDiscount,
											so_detail.bTaxable,
											so_detail.decTax,
											so_detail.decAmount,
											so_detail.decDPP,
											so_detail.szPaymentType,
											so_detail.szPrincipalDiscRefId,
											so_detail.decTonase,
											so_detail.decCubication,
											so_detail.szParentId,
											so_detail.szDistProductId,
											so_detail.decDistQty,
											so_detail.decDistPrice,
											so_detail.szBudgetId,
											so_detail.decPrincipalCostAmount,
											so_detail.decPrincipalCostQty,
											so_detail.bBudgetTransferred,
											so_detail.bBonusFrPriceGroup,
											sku.client_wms_id
									ORDER BY so_detail.szFSoId, so_detail.shItemNumber");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_so_bosnet_detail_promo($so_id)
	{
		$query = $this->db->query("select
										a.szFSoId,
										a.szProductId,
										a.shItemNumber,
										b.szProductId AS szProductIdReff,
										b.szOrderItemTypeId,
										CASE WHEN ISNULL(b.decBonusQty, 0) > 0 THEN 'BONUS'
										ELSE 'DISKON' END tipe,
										b.szPaymentType,
										b.decBonusAmount,
										b.decBonusQty,
										b.szParentId
									from MIDDLEWARE.dbo.bosnet_so_detail a
									inner join MIDDLEWARE.dbo.bosnet_so_bonus b
									on b.szFSoId = a.szFSoId
									and b.shItemNumber = a.shItemNumber
									where a.szFSoId = '$so_id'
									order by a.shItemNumber asc");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_so_bosnet_detail2($so_id)
	{
		$query = $this->db->query("SELECT
									so_detail.*
									FROM MIDDLEWARE.dbo.bosnet_so so
									LEFT JOIN MIDDLEWARE.dbo.bosnet_so_detail_2 so_detail
									ON so_detail.szFSoId = so.szFSoId
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales
									ON sales.sales_eksternal_id = so.szSalesId
									WHERE so.szFSoId = '$so_id'
									AND sales.sales_eksternal_id IS NOT NULL");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Insert_bosnet_so($so_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);
		$middleware = $this->load->database('middleware', TRUE);

		// $bosnet->select("*")
		// 	->from("BOS_SD_FSo")
		// 	->where("szFSoId", $so_id);

		$query_so = $bosnet->query("SELECT so.*, customer.szDeliveryGroupId FROM BOS_SD_FSo so LEFT JOIN BOS_AR_Customer customer ON so.szCustId = customer.szCustId WHERE szFSoId = '$so_id' ");

		foreach ($query_so->result() as $row) {
			$middleware->set("szFSoId", $row->szFSoId);
			$middleware->set("szSalesOrgId", $row->szSalesOrgId);
			$middleware->set("szOrderTypeId", $row->szOrderTypeId);
			$middleware->set("dtmOrder", $row->dtmOrder);
			$middleware->set("dtmPrice", $row->dtmPrice);
			$middleware->set("szCustId", $row->szCustId);
			$middleware->set("decAmount", round($row->decAmount, 2));
			$middleware->set("decTax", round($row->decTax, 2));
			$middleware->set("decDownPayment", round($row->decDownPayment, 2));
			$middleware->set("szStatus", $row->szStatus);
			$middleware->set("szCcyId", $row->szCcyId);
			$middleware->set("szCcyRateId", $row->szCcyRateId);
			$middleware->set("decCcyRate", round($row->decCcyRate, 2));
			$middleware->set("szFInvoiceId", $row->szFInvoiceId);
			$middleware->set("szCompletedFInvoiceId", $row->szCompletedFInvoiceId);
			$middleware->set("szFirstCompletedFInvoiceId", $row->szFirstCompletedFInvoiceId);
			$middleware->set("bDropShip", $row->bDropShip);
			$middleware->set("szSalesId", $row->szSalesId);
			$middleware->set("szSalesSupervisorId", $row->szSalesSupervisorId);
			$middleware->set("szSalesSupervisorId_2", $row->szSalesSupervisorId_2);
			$middleware->set("szSalesSupervisorId_3", $row->szSalesSupervisorId_3);
			$middleware->set("szSalesDivisionId", $row->szSalesDivisionId);
			$middleware->set("szSalesDepartmentId", $row->szSalesDepartmentId);
			$middleware->set("szSalesTeamId", $row->szSalesTeamId);
			$middleware->set("szRemark", $row->szRemark);
			$middleware->set("szLatitude", $row->szLatitude);
			$middleware->set("szLongitude", $row->szLongitude);
			$middleware->set("szCustPoId", $row->szCustPoId);
			$middleware->set("dtmCustPo", $row->dtmCustPo);
			$middleware->set("bCash", $row->bCash);
			$middleware->set("gdCreditLimitApprovedId", '');
			$middleware->set("bNeedFInvoice", $row->bNeedFInvoice);
			$middleware->set("szPaymentTermId", $row->szPaymentTermId);
			$middleware->set("bResultFrTransfer", $row->bResultFrTransfer);
			$middleware->set("bVoid", $row->bVoid);
			$middleware->set("bApplied", $row->bApplied);
			$middleware->set("btPrintedCount", $row->btPrintedCount);
			$middleware->set("bTransferred", $row->bTransferred);
			$middleware->set("szCompanyId", $row->szCompanyId);
			$middleware->set("szWorkplaceId", $row->szWorkplaceId);
			$middleware->set("szTaxEntityId", $row->szTaxEntityId);
			$middleware->set("bNeedApproval", $row->bNeedApproval);
			$middleware->set("gdApprovedId", '');
			$middleware->set("szFJournalId", $row->szFJournalId);
			$middleware->set("dtmCreated", $row->dtmCreated);
			$middleware->set("bSystemCreated", $row->bSystemCreated);
			$middleware->set("szUserId", $row->szUserId);
			$middleware->set("dtmLastUpdated", $row->dtmLastUpdated);
			$middleware->set("bAlreadyTransferred", $row->bAlreadyTransferred);
			$middleware->set("decTonase", round($row->decTonase, 2));
			$middleware->set("decCubication", round($row->decCubication, 2));
			$middleware->set("bUploadedFromMoDis", $row->bUploadedFromMoDis);
			$middleware->set("szFDoReffId", $row->szFDoReffId);
			$middleware->set("dtmStartVisit", $row->dtmStartVisit);
			$middleware->set("dtmEndVisit", $row->dtmEndVisit);
			$middleware->set("decVisitSpendTime", round($row->decVisitSpendTime, 2));
			$middleware->set("bScanSuccess", $row->bScanSuccess);
			$middleware->set("szScanFailReason", $row->szScanFailReason);
			$middleware->set("szBarcodeScanFailReason", $row->szBarcodeScanFailReason);
			$middleware->set("decJourneySpendTime", round($row->decJourneySpendTime, 2));
			$middleware->set("AdcId", $row->AdcId);
			$middleware->set("dtmExpiration", $row->dtmExpiration);
			$middleware->set("bosnet_so_tgl_update", "GETDATE()", FALSE);
			$middleware->set("bosnet_so_who_update", $this->session->userdata('pengguna_username'));
			$middleware->set("szDeliveryGroupId", $row->szDeliveryGroupId);

			$middleware->insert("bosnet_so");
		}

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		$response = [
			'result' => $queryinsert,
			'affectedrows' => $affectedrows
		];

		return $response;
		// return $middleware->last_query();
	}

	public function Insert_bosnet_so_detail($so_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);
		$middleware = $this->load->database('middleware', TRUE);

		$bosnet->select("*")
			->from("BOS_SD_FSoItem")
			->where("szFSoId", $so_id);
		$query_so_item = $bosnet->get();

		foreach ($query_so_item->result() as $row) {
			$middleware->set("szFSoId", $row->szFSoId);
			$middleware->set("shItemNumber", $row->shItemNumber);
			$middleware->set("szOrderItemTypeId", $row->szOrderItemTypeId);
			$middleware->set("szProductId", $row->szProductId);
			$middleware->set("szPriceId", $row->szPriceId);
			$middleware->set("szPriceOrderId", $row->szPriceOrderId);
			$middleware->set("dtmPriceDate", $row->dtmPriceDate);
			$middleware->set("decDiscProcent", round($row->decDiscProcent, 2));
			$middleware->set("decQty", round($row->decQty, 2));
			$middleware->set("decUomQty", round($row->decUomQty, 2));
			$middleware->set("szUomId", $row->szUomId);
			$middleware->set("decPrice", round($row->decPrice, 2));
			$middleware->set("decDiscount", round($row->decDiscount, 2));
			$middleware->set("bTaxable", $row->bTaxable);
			$middleware->set("decTax", round($row->decTax, 2));
			$middleware->set("decAmount", round($row->decAmount, 2));
			$middleware->set("decDPP", round($row->decDPP, 2));
			$middleware->set("szPaymentType", $row->szPaymentType);
			$middleware->set("szPrincipalDiscRefId", $row->szPrincipalDiscRefId);
			$middleware->set("decTonase", round($row->decTonase, 2));
			$middleware->set("decCubication", round($row->decCubication, 2));
			$middleware->set("szParentId", $row->szParentId);
			$middleware->set("szDistProductId", $row->szDistProductId);
			$middleware->set("decDistQty", round($row->decDistQty, 2));
			$middleware->set("decDistPrice", round($row->decDistPrice, 2));
			$middleware->set("szBudgetId", $row->szBudgetId);
			$middleware->set("decPrincipalCostAmount", round($row->decPrincipalCostAmount, 2));
			$middleware->set("decPrincipalCostQty", round($row->decPrincipalCostQty, 2));
			$middleware->set("bBudgetTransferred", $row->bBudgetTransferred);
			$middleware->set("bBonusFrPriceGroup", $row->bBonusFrPriceGroup);

			$middleware->insert("bosnet_so_detail");
		}

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $middleware->last_query();
	}

	public function Insert_bosnet_so_detail_2($so_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);
		$middleware = $this->load->database('middleware', TRUE);

		$query_so_bonus = $bosnet->query("SELECT DISTINCT
											do.szFSoId,
											do_item.szProductId,
											lot_info.dtmExpired,
											so_item.decQty
											FROM BOS_SD_FSo so
											LEFT JOIN BOS_SD_FSoItem so_item
											ON so_item.szFSoId = so.szFSoId
											LEFT JOIN BOS_SD_FDo do
											ON do.szFSoId = so.szFSoId
											LEFT JOIN BOS_SD_FDoItem do_item
											ON do_item.szDoId = do.szDoId
											AND so_item.szProductId = do_item.szProductId
											AND do_item.szProductId <> ''
											LEFT JOIN (SELECT
											fdjr_tracking.szFDoId,
											fdjr_req.szProductId,
											lot_info.dtmExpired,
											fdjr_req.decQty
											FROM BOS_SD_DjrTracking fdjr_tracking
											INNER JOIN BOS_SD_FDjrProductRequest fdjr_req
											ON fdjr_req.szFDjrId = fdjr_tracking.szFDjrId
											INNER JOIN BOS_SD_FPr fpr
											ON fpr.szFPrId = fdjr_req.szFPrId1
											INNER JOIN BOS_INV_FSod fsod
											ON fsod.szRefDocId = fpr.szFPrId
											INNER JOIN BOS_INV_StockLotHistory lot_history
											ON lot_history.szDocId = fsod.szFSodId
											INNER JOIN BOS_INV_LotInfo lot_info
											ON lot_info.szLotId = lot_history.szLotId
											AND lot_info.szProductId = lot_history.szProductId
											UNION ALL
											SELECT
											fdjr_tracking.szFDoId,
											fdjr_req.szProductId,
											lot_info.dtmExpired,
											fdjr_req.decQty
											FROM BOS_SD_DjrTracking fdjr_tracking
											INNER JOIN BOS_SD_FDjrProductRequest fdjr_req
											ON fdjr_req.szFDjrId = fdjr_tracking.szFDjrId
											INNER JOIN BOS_SD_FPr fpr
											ON fpr.szFPrId = fdjr_req.szFPrId2
											INNER JOIN BOS_INV_FSod fsod
											ON fsod.szRefDocId = fpr.szFPrId
											INNER JOIN BOS_INV_StockLotHistory lot_history
											ON lot_history.szDocId = fsod.szFSodId
											INNER JOIN BOS_INV_LotInfo lot_info
											ON lot_info.szLotId = lot_history.szLotId
											AND lot_info.szProductId = lot_history.szProductId
											UNION ALL
											SELECT
											fdjr_tracking.szFDoId,
											fdjr_req.szProductId,
											lot_info.dtmExpired,
											fdjr_req.decQty
											FROM BOS_SD_DjrTracking fdjr_tracking
											INNER JOIN BOS_SD_FDjrProductRequest fdjr_req
											ON fdjr_req.szFDjrId = fdjr_tracking.szFDjrId
											INNER JOIN BOS_SD_FPr fpr
											ON fpr.szFPrId = fdjr_req.szFPrId3
											INNER JOIN BOS_INV_FSod fsod
											ON fsod.szRefDocId = fpr.szFPrId
											INNER JOIN BOS_INV_StockLotHistory lot_history
											ON lot_history.szDocId = fsod.szFSodId
											INNER JOIN BOS_INV_LotInfo lot_info
											ON lot_info.szLotId = lot_history.szLotId
											AND lot_info.szProductId = lot_history.szProductId
											UNION ALL
											SELECT
											fdjr_tracking.szFDoId,
											fdjr_req.szProductId,
											lot_info.dtmExpired,
											fdjr_req.decQty
											FROM BOS_SD_DjrTracking fdjr_tracking
											INNER JOIN BOS_SD_FDjrProductRequest fdjr_req
											ON fdjr_req.szFDjrId = fdjr_tracking.szFDjrId
											INNER JOIN BOS_SD_FPr fpr
											ON fpr.szFPrId = fdjr_req.szFPrId4
											INNER JOIN BOS_INV_FSod fsod
											ON fsod.szRefDocId = fpr.szFPrId
											INNER JOIN BOS_INV_StockLotHistory lot_history
											ON lot_history.szDocId = fsod.szFSodId
											INNER JOIN BOS_INV_LotInfo lot_info
											ON lot_info.szLotId = lot_history.szLotId
											AND lot_info.szProductId = lot_history.szProductId) lot_info
											ON lot_info.szFDoId = do_item.szDoId
											AND lot_info.szProductId = do_item.szProductId
											WHERE so.szFSoId = '$so_id'");

		foreach ($query_so_bonus->result() as $row) {
			$middleware->set("szFSoId", $row->szFSoId);
			$middleware->set("szProductId", $row->szProductId);
			$middleware->set("dtmExpired", $row->dtmExpired);
			$middleware->set("decQty", round($row->decQty, 2));

			$middleware->insert("bosnet_so_detail_2");
		}

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $middleware->last_query();
	}

	public function insert_bosnet_so_bonus($so_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);
		$middleware = $this->load->database('middleware', TRUE);

		$bosnet->select("*")
			->from("BOS_SD_FSoItemBonusSource")
			->where("szFSoId", $so_id);
		$query_so_bonus = $bosnet->get();

		foreach ($query_so_bonus->result() as $row) {
			$middleware->set("szFSoId", $row->szFSoId);
			$middleware->set("shItemNumber", $row->shItemNumber);
			$middleware->set("szProductId", $row->szProductId);
			$middleware->set("szOrderItemTypeId", $row->szOrderItemTypeId);
			$middleware->set("szPaymentType", $row->szPaymentType);
			$middleware->set("decBonusAmount", round($row->decBonusAmount, 2));
			$middleware->set("decBonusQty", round($row->decBonusQty, 2));
			$middleware->set("szParentId", $row->szParentId);

			$middleware->insert("bosnet_so_bonus");
		}

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $middleware->last_query();
	}

	public function Insert_sales_order($so_id, $sales_order_id, $sales_order_kode, $tipe_sales_order_id, $tipe_delivery_order_id)
	{
		$hari_tgl_kirim = 0;
		$query_hari_tgl_kirim = $this->db->query("select * from vrbl where vrbl_param = 'TGL_KIRIM'");

		if ($query_hari_tgl_kirim->num_rows() == 0) {
			$hari_tgl_kirim = 0;
		} else {
			$hari_tgl_kirim = $query_hari_tgl_kirim->row(0)->vrbl_value_integer;
		}

		$query = $this->db->query("INSERT INTO sales_order (
									sales_order_id,
									depo_id,
									sales_order_kode,
									client_wms_id,
									channel_id,
									sales_order_is_handheld,
									sales_order_status,
									sales_order_approved_by,
									sales_id,
									client_pt_id,
									sales_order_tgl,
									sales_order_tgl_exp,
									sales_order_tgl_harga,
									sales_order_tgl_sj,
									sales_order_tgl_kirim,
									sales_order_tipe_pembayaran,
									tipe_sales_order_id,
									sales_order_no_po,
									sales_order_who_create,
									sales_order_tgl_create,
									sales_order_is_downloaded,
									tipe_delivery_order_id,
									sales_order_is_uploaded,
									sales_order_keterangan,
									is_priority)
									SELECT TOP 1
									'$sales_order_id' AS sales_order_id,
									'" . $this->session->userdata('depo_id') . "' AS depo_id,
									'$sales_order_kode' AS sales_order_kode,
									NULL AS client_wms_id,
									NULL AS channel_id,
									'0' AS sales_order_is_handheld,
									'Draft' AS sales_order_status,
									NULL AS sales_order_approved_by,
									karyawan.karyawan_id AS sales_id,
									customer_eksternal.client_pt_id,
									so.dtmOrder AS sales_order_tgl,
									so.dtmExpiration AS sales_order_tgl_exp,
									so.dtmPrice AS sales_order_tgl_harga,
									DATEADD(DAY, " . $hari_tgl_kirim . ", so.dtmOrder) AS sales_order_tgl_sj,
									DATEADD(DAY, " . $hari_tgl_kirim . ", so.dtmOrder) AS sales_order_tgl_kirim,
									CASE
										WHEN so.bCash = 1 THEN 0
										ELSE 1
									END AS sales_order_tipe_pembayaran,
									'$tipe_sales_order_id' AS tipe_sales_order_id,
									'$so_id' AS sales_order_no_po,
									'" . $this->session->userdata('pengguna_username') . "' sales_order_who_create,
									GETDATE() AS sales_order_tgl_create,
									'1' AS sales_order_is_downloaded,
									'$tipe_delivery_order_id' AS tipe_delivery_order_id,
									'0' AS sales_order_is_uploaded,
									so.szRemark AS sales_order_keterangan,
									'0' AS is_priority
									FROM MIDDLEWARE.dbo.bosnet_so so
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal sales_eksternal
									ON sales_eksternal.sales_eksternal_id = so.szSalesId
									LEFT JOIN karyawan
									ON karyawan.karyawan_id = sales_eksternal.karyawan_id
									LEFT JOIN MIDDLEWARE.dbo.client_pt_principle_eksternal customer_eksternal
									ON customer_eksternal.customer_eksternal_id = so.szCustId
									WHERE so.szFSoId = '$so_id'
									AND sales_eksternal.sales_eksternal_id IS NOT NULL
									ORDER BY so.szFSoId ASC");

		// (select top 1 sku.client_wms_id from MIDDLEWARE.dbo.bosnet_so_detail bosnet_so left join sku on sku.sku_konversi_group = bosnet_so.szProductId where szFSoId = '$so_id' group by sku.client_wms_id) AS client_wms_id

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function update_sales_order($sales_order_id)
	{
		$query = $this->db->query("UPDATE sales_order SET principle_id = 
										( SELECT TOP 1 principle_id 
											FROM sales_order_detail a 
											INNER JOIN sku b ON a.sku_id = b.sku_id 
											WHERE sales_order_id = '$sales_order_id'
										)
									WHERE sales_order_id = '$sales_order_id'");

		$query2 = $this->db->query("UPDATE sales_order SET client_wms_id = 
										( SELECT TOP 1 client_wms_id 
											FROM sales_order_detail a
											WHERE sales_order_id = '$sales_order_id'
										)
									WHERE sales_order_id = '$sales_order_id'");

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$queryupdate = 1;
		} else {
			$queryupdate = 0;
		}

		return $queryupdate;
	}

	public function Insert_sales_order_detail($so_id, $sales_order_id, $data)
	{
		$query = $this->db->query("Exec proses_mapping_so_eksternal_to_so_fas_detail '$so_id','$sales_order_id','" . $data['szProductId'] . "','" . $data['szOrderItemTypeId'] . "' ");
		$queryinsert = 0;

		if ($query === false) {
			$queryinsert = 0;
		} else {
			$query = $query->result_array();

			foreach ($query as $key => $value) {
				$this->db->set("sales_order_detail_id", "NEWID()", FALSE);
				$this->db->set("sales_order_id", $value['sales_order_id']);
				$this->db->set("client_wms_id", $data['client_wms_id']);
				$this->db->set("sku_id", $value['sku_id']);
				$this->db->set("sku_kode", $value['sku_kode']);
				$this->db->set("sku_nama_produk", $value['sku_nama_produk']);
				$this->db->set("sku_harga_satuan", $value['sku_harga_satuan']);
				$this->db->set("sku_disc_percent", $value['sku_disc_percent']);
				$this->db->set("sku_disc_rp", $value['sku_disc_rp']);
				$this->db->set("sku_harga_nett", $value['sku_harga_nett']);
				// $this->db->set("sku_request_expdate", $value['sku_request_expdate']);
				// $this->db->set("sku_filter_expdate", $value['sku_filter_expdate']);
				// $this->db->set("sku_filter_expdatebulan", $value['sku_filter_expdatebulan']);
				// $this->db->set("sku_filter_expdatetahun", $value['sku_filter_expdatetahun']);
				$this->db->set("sku_weight", $value['sku_weight']);
				$this->db->set("sku_weight_unit", $value['sku_weight_unit']);
				$this->db->set("sku_length", $value['sku_length']);
				$this->db->set("sku_length_unit", $value['sku_length_unit']);
				$this->db->set("sku_width", $value['sku_width']);
				$this->db->set("sku_width_unit", $value['sku_width_unit']);
				$this->db->set("sku_height", $value['sku_height']);
				$this->db->set("sku_height_unit", $value['sku_height_unit']);
				$this->db->set("sku_volume", $value['sku_volume']);
				$this->db->set("sku_volume_unit", $value['sku_volume_unit']);
				$this->db->set("sku_qty", round($value['sku_qty']));
				$this->db->set("sku_keterangan", $value['sku_keterangan']);
				$this->db->set("tipe_stock_nama", $value['tipe_stock_nama']);
				$this->db->set("is_promo", $value['is_promo']);
				$this->db->set("sales_order_detail_tipe", $value['sales_order_detail_tipe']);

				$this->db->insert("sales_order_detail");

				$affectedrows = $this->db->affected_rows();
				if ($affectedrows > 0) {
					$queryinsert = 1;
				} else {
					$queryinsert = 0;
				}
			}
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function Insert_sales_order_detail_promo($so_id, $sales_order_id, $data)
	{
		$query = $this->db->query("Exec proses_mapping_so_eksternal_to_so_fas_detail_promo '$so_id','$sales_order_id','" . $data['szProductIdReff'] . "','" . $data['tipe'] . "' ");
		$queryinsert = 0;

		if ($query === false) {
			$queryinsert = 0;
		} else {
			$query = $query->result_array();

			foreach ($query as $key => $value) {
				$this->db->set("sales_order_detail_promo_id", $value['sales_order_detail_promo_id']);
				$this->db->set("sales_order_id", $value['sales_order_id']);
				$this->db->set("sales_order_detail_tipe", $value['sales_order_detail_tipe']);
				$this->db->set("sku_id", $value['sku_id']);
				$this->db->set("referensi_id", $value['referensi_id']);
				$this->db->set("sku_id_bonus", $value['sku_id_bonus']);
				$this->db->set("sku_konversi_group_bonus", $value['sku_konversi_group_bonus']);
				$this->db->set("sku_promo_diskon_amount", $value['sku_promo_diskon_amount']);
				$this->db->set("sku_promo_qty_bonus", $value['sku_promo_qty_bonus']);
				$this->db->set("sku_konversi_group_reff", $value['sku_konversi_group_reff']);
				$this->db->set("no_reff_external", $value['no_reff_external']);
				$this->db->set("external_system", $value['external_system']);

				$this->db->insert("sales_order_detail_promo");

				$affectedrows = $this->db->affected_rows();
				if ($affectedrows > 0) {
					$queryinsert = 1;
				} else {
					$queryinsert = 0;
				}
			}
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function Insert_sales_order_detail_2($sales_order_id, $depo_id, $data)
	{
		$query = $this->db->query("Exec proses_mapping_so_eksternal_to_so_fas_detail2 '$sales_order_id','" . $depo_id . "','" . $data['sku_id'] . "','" . $data['sku_qty'] . "' ");
		// $query = $this->db->query("Exec proses_mapping_so_eksternal_to_so_fas_detail2 '$so_id','$sales_order_id','" . $depo_id . "','" . $data['szProductId'] . "','" . $data['dtmExpired'] . "' ");

		if ($query->num_rows() == 0) {
			$this->db->query("DELETE sales_order_detail_2 WHERE sales_order_detail_id IN (SELECT sales_order_detail_id FROM sales_order_detail WHERE sales_order_id = '$sales_order_id')");
			$this->db->query("DELETE sales_order_detail WHERE sales_order_id = '$sales_order_id')");
			$this->db->query("DELETE sales_order WHERE sales_order_id = '$sales_order_id'");

			$queryinsert = 2;
		} else {
			$query = $query->result_array();

			foreach ($query as $key => $value) {
				$this->db->set("sales_order_detail2_id", "NEWID()", FALSE);
				$this->db->set("sales_order_detail_id", $value['sales_order_detail_id']);
				$this->db->set("sku_id", $value['sku_id']);
				$this->db->set("sku_stock_id", $value['sku_stock_id']);
				$this->db->set("sku_stock_expired_date", $value['sku_stock_expired_date']);
				$this->db->set("sku_qty", $value['sku_qty']);
				$this->db->insert("sales_order_detail_2");

				$affectedrows = $this->db->affected_rows();
				if ($affectedrows > 0) {
					$queryinsert = 1;
				} else {
					$queryinsert = 0;
				}
			}
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function delete_bosnet_so($so_id)
	{
		$middleware = $this->load->database('middleware', TRUE);

		$middleware->where('szFSoId', $so_id);
		$middleware->delete('bosnet_so');

		$middleware->where('szFSoId', $so_id);
		$middleware->delete('bosnet_so_detail');

		$middleware->where('szFSoId', $so_id);
		$middleware->delete('bosnet_so_detail_2');

		$middleware->where('szFSoId', $so_id);
		$middleware->delete('bosnet_so_bonus');

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
		// return $this->db->last_query();
	}

	public function CheckSalesMapping($so_id)
	{
		$query = $this->db->query("SELECT
									a.szSalesId,
									b.sales_eksternal_id
									FROM MIDDLEWARE.dbo.bosnet_so a
									LEFT JOIN MIDDLEWARE.dbo.karyawan_sales_eksternal b
									ON b.sales_eksternal_id = a.szSalesId
									WHERE a.szFsoId = '$so_id'
									AND b.sales_eksternal_id IS NULL
									GROUP BY a.szSalesId,
											b.sales_eksternal_id");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function CheckCustomerMapping($so_id)
	{
		$query = $this->db->query("SELECT
									a.szCustId,
									b.customer_eksternal_id
									FROM MIDDLEWARE.dbo.bosnet_so a
									LEFT JOIN MIDDLEWARE.dbo.client_pt_principle_eksternal b
									ON b.customer_eksternal_id = a.szCustId
									WHERE a.szFsoId = '$so_id'
									AND b.customer_eksternal_id IS NULL
									GROUP BY a.szCustId,
											b.customer_eksternal_id");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Get_sales_order_detail($sales_order_id)
	{
		$this->db->select("*")
			->from("sales_order_detail")
			->where("sales_order_id", $sales_order_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sales_order_for_eksternal($tgl1, $tgl2)
	{
		$query = $this->db->query("SELECT
									hdr.sales_order_id,
									hdr.depo_id,
									hdr.sales_order_kode,
									ISNULL(CONVERT(nvarchar(36), dtl.client_wms_id), '') client_wms_id,
									ISNULL(CONVERT(nvarchar(36), hdr.channel_id), '') channel_id,
									hdr.sales_order_is_handheld,
									hdr.sales_order_status,
									ISNULL(hdr.sales_order_approved_by, '') AS sales_order_approved_by,
									ISNULL(CONVERT(nvarchar(36), hdr.sales_id), '') sales_id,
									ISNULL(CONVERT(nvarchar(36), hdr.client_pt_id), '') client_pt_id,
									ISNULL(hdr.sales_order_tgl, '') sales_order_tgl,
									ISNULL(hdr.sales_order_tgl_exp, '') sales_order_tgl_exp,
									ISNULL(hdr.sales_order_tgl_harga, '') sales_order_tgl_harga,
									ISNULL(hdr.sales_order_tgl_sj, '') sales_order_tgl_sj,
									ISNULL(hdr.sales_order_tgl_kirim, '') sales_order_tgl_kirim,
									ISNULL(hdr.sales_order_tipe_pembayaran, '') sales_order_tipe_pembayaran,
									ISNULL(CONVERT(nvarchar(36), hdr.tipe_sales_order_id), '') tipe_sales_order_id,
									ISNULL(hdr.sales_order_no_po, '') sales_order_no_po,
									ISNULL(hdr.sales_order_who_create, '') sales_order_who_create,
									ISNULL(hdr.sales_order_tgl_create, '') sales_order_tgl_create,
									hdr.sales_order_is_downloaded,
									ISNULL(CONVERT(nvarchar(36), hdr.tipe_delivery_order_id), '') tipe_delivery_order_id,
									hdr.sales_order_is_uploaded,
									ISNULL(SUM(dtl.sku_harga_nett), 0) AS sku_harga_nett,
									CASE WHEN SUM(dtl.is_promo) > 0 THEN 1 ELSE 0 END is_promo
									FROM sales_order hdr
									LEFT JOIN sales_order_detail dtl
									ON dtl.sales_order_id = hdr.sales_order_id
									WHERE FORMAT(hdr.sales_order_tgl_kirim, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									GROUP BY hdr.sales_order_id,
											hdr.depo_id,
											hdr.sales_order_kode,
											ISNULL(CONVERT(nvarchar(36), dtl.client_wms_id), ''),
											ISNULL(CONVERT(nvarchar(36), hdr.channel_id), ''),
											hdr.sales_order_is_handheld,
											hdr.sales_order_status,
											ISNULL(hdr.sales_order_approved_by, ''),
											ISNULL(CONVERT(nvarchar(36), hdr.sales_id), ''),
											ISNULL(CONVERT(nvarchar(36), hdr.client_pt_id), ''),
											ISNULL(hdr.sales_order_tgl, ''),
											ISNULL(hdr.sales_order_tgl_exp, ''),
											ISNULL(hdr.sales_order_tgl_harga, ''),
											ISNULL(hdr.sales_order_tgl_sj, ''),
											ISNULL(hdr.sales_order_tgl_kirim, ''),
											ISNULL(hdr.sales_order_tipe_pembayaran, ''),
											ISNULL(CONVERT(nvarchar(36), hdr.tipe_sales_order_id), ''),
											ISNULL(hdr.sales_order_no_po, ''),
											ISNULL(hdr.sales_order_who_create, ''),
											ISNULL(hdr.sales_order_tgl_create, ''),
											hdr.sales_order_is_downloaded,
											ISNULL(CONVERT(nvarchar(36), hdr.tipe_delivery_order_id), ''),
											hdr.sales_order_is_uploaded
									ORDER BY ISNULL(hdr.sales_order_tgl, '') ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sales_order_detail_for_eksternal($id)
	{
		$query = $this->db->query("SELECT
									dtl.sales_order_detail_id,
									dtl.sales_order_id,
									ISNULL(CONVERT(nvarchar(36), dtl.client_wms_id), '') client_wms_id,
									ISNULL(CONVERT(nvarchar(36), dtl.sku_id), '') sku_id,
									ISNULL(dtl.sku_kode, '') sku_kode,
									ISNULL(dtl.sku_nama_produk, '') sku_nama_produk,
									ISNULL(dtl.sku_harga_satuan, '0') sku_harga_satuan,
									ISNULL(dtl.sku_disc_percent, '0') sku_disc_percent,
									ISNULL(dtl.sku_disc_rp, '0') sku_disc_rp,
									ISNULL(dtl.sku_harga_nett, '0') sku_harga_nett,
									ISNULL(dtl.sku_request_expdate, '0') sku_request_expdate,
									ISNULL(dtl.sku_filter_expdate, '0') sku_filter_expdate,
									ISNULL(dtl.sku_filter_expdatebulan, '0') sku_filter_expdatebulan,
									ISNULL(dtl.sku_filter_expdatetahun, '0') sku_filter_expdatetahun,
									ISNULL(dtl.sku_weight, '0') sku_weight,
									ISNULL(dtl.sku_weight_unit, '') sku_weight_unit,
									ISNULL(dtl.sku_length, '0') sku_length,
									ISNULL(dtl.sku_length_unit, '') sku_length_unit,
									ISNULL(dtl.sku_width, '0') sku_width,
									ISNULL(dtl.sku_width_unit, '') sku_width_unit,
									ISNULL(dtl.sku_height, '0') sku_height,
									ISNULL(dtl.sku_height_unit, '') sku_height_unit,
									ISNULL(dtl.sku_volume, '0') sku_volume,
									ISNULL(dtl.sku_volume_unit, '') sku_volume_unit,
									ISNULL(dtl.sku_qty, '0') sku_qty,
									ISNULL(dtl.sku_keterangan, '') sku_keterangan,
									ISNULL(dtl.tipe_stock_nama, '') tipe_stock_nama,
									ISNULL(dtl.is_promo, '') is_promo
								   FROM sales_order hdr
								   LEFT JOIN sales_order_detail dtl
								   ON dtl.sales_order_id = hdr.sales_order_id 
								   WHERE dtl.sales_order_id = '$id'
								   ORDER BY hdr.sales_order_tgl ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_sales_order_detail_promo_for_eksternal($id)
	{
		$query = $this->db->query("SELECT
									dtl.sales_order_detail_promo_id,
									dtl.sales_order_id,
									ISNULL(dtl.sales_order_detail_tipe, '') sales_order_detail_tipe,
									ISNULL(CONVERT(nvarchar(36), dtl.sku_id), '') sku_id,
									ISNULL(CONVERT(nvarchar(36), dtl.referensi_id), '') referensi_id,
									ISNULL(CONVERT(nvarchar(36), dtl.sku_id_bonus), '') sku_id_bonus,
									ISNULL(dtl.sku_konversi_group_bonus, '') sku_konversi_group_bonus,
									ISNULL(dtl.sku_promo_diskon_amount, '0') sku_promo_diskon_amount,
									ISNULL(dtl.sku_promo_qty_bonus, '0') sku_promo_qty_bonus,
									ISNULL(dtl.sku_konversi_group_reff, '') sku_konversi_group_reff,
									ISNULL(dtl.no_reff_external, '') no_reff_external,
									ISNULL(dtl.external_system, '') external_system
								   FROM sales_order hdr
								   LEFT JOIN sales_order_detail_promo dtl
								   ON dtl.sales_order_id = hdr.sales_order_id 
								   WHERE dtl.sales_order_id = '$id'
								   ORDER BY hdr.sales_order_tgl ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Cek_sales_order_by_so_bosnet($so_id)
	{
		$this->db->select("*")
			->from("sales_order")
			->where("sales_order_no_po", $so_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Check_customer_fas($customer_nama, $client_pt_alamat, $client_pt_kelurahan, $client_pt_kecamatan, $client_pt_kota)
	{
		$this->db->select("*")
			->from("client_pt")
			->where("client_pt_alamat", $client_pt_alamat)
			->where("client_pt_kelurahan", $client_pt_kelurahan)
			->where("client_pt_kecamatan", $client_pt_kecamatan)
			->where("client_pt_kota", $client_pt_kota)
			->where("client_pt_nama", $customer_nama);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Check_customer_fas_by_customer_eksternal_id($customer_eksternal_id)
	{
		$this->db->select("*")
			->from("client_pt_principle_eksternal")
			->where("customer_eksternal_id", $customer_eksternal_id);

		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Check_customer_principle($client_pt_id, $principle_id)
	{
		$this->db->select("*")
			->from("client_pt_principle")
			->where("client_pt_id", $client_pt_id)
			->where("principle_id", $principle_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Check_customer_principle_eksternal($client_pt_id, $principle_id, $customer_eksternal_id)
	{
		$middleware = $this->load->database('middleware', TRUE);

		$middleware->select("*");
		$middleware->from("client_pt_principle_eksternal");
		$middleware->where("client_pt_id", $client_pt_id);
		$middleware->where("principle_id", $principle_id);

		if ($customer_eksternal_id != null) {
			$middleware->where("customer_eksternal_id", $customer_eksternal_id);
		}


		$query = $middleware->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Get_client_pt_id_by_nama($customer_nama, $client_pt_alamat, $client_pt_kelurahan, $client_pt_kecamatan, $client_pt_kota)
	{
		$this->db->select("*")
			->from("client_pt")
			->where("client_pt_alamat", $client_pt_alamat)
			->where("client_pt_kelurahan", $client_pt_kelurahan)
			->where("client_pt_kecamatan", $client_pt_kecamatan)
			->where("client_pt_kota", $client_pt_kota)
			->where("client_pt_nama", $customer_nama);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Get_client_pt_id_by_customer_eksternal_id($customer_eksternal_id)
	{
		$this->db->select("*")
			->from("client_pt_principle_eksternal")
			->where("customer_eksternal_id", $customer_eksternal_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = "";
		} else {
			$query = $query->row(0)->client_pt_id;
		}

		return $query;
	}

	public function Get_karyawan_id_by_nama($karyawan_nama, $depo_id)
	{
		$this->db->select("*")
			->from("karyawan")
			->where("karyawan_nama", $karyawan_nama)
			->where("depo_id", $depo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Get_nama_customer_bosnet_by_id($customer_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
										szCustId,
										CASE
											WHEN CHARINDEX('(', szName) <> 0 THEN CASE
												WHEN CHARINDEX('(', szName) <> 1 THEN REPLACE(szName, RIGHT(szName, LEN(szName) - CHARINDEX('(', szName) + 1), '')
												ELSE REPLACE(RIGHT(szName, LEN(szName) - CHARINDEX(')', szName)), RIGHT(RIGHT(szName, LEN(szName) - CHARINDEX(')', szName)), LEN(RIGHT(szName, LEN(szName) - CHARINDEX(')', szName))) - CHARINDEX('(', RIGHT(szName, LEN(szName) - CHARINDEX(')', szName))) + 1), '')
											END
											ELSE szName
										END szName,
										CustszAddress_1,
										CustszState,
										CustszCity,
										CustszDistrict,
										CustszAddress_2,
										CustszZipCode,
										szLatitude,
										szLongitude,
										CustszContactPerson,
										CustszPhoneNo_1,
										CustszEmail
										FROM BOS_AR_Customer
										WHERE szCustId = '$customer_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Get_customer_bosnet_by_id($customer_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
										NEWID() AS client_pt_id,
										szCustId,
										szName AS client_pt_nama,
										CustszAddress_1 AS client_pt_alamat,
										CustszPhoneNo_1 AS client_pt_telepon,
										CustszState AS client_pt_propinsi,
										CustszCity AS client_pt_kota,
										CustszDistrict AS client_pt_kecamatan,
										CustszAddress_2 AS client_pt_kelurahan,
										CustszZipCode AS client_pt_kodepos,
										szLatitude AS client_pt_latitude,
										szLongitude AS client_pt_longitude,
										CustszContactPerson AS client_pt_nama_contact_person,
										CustszPhoneNo_1 AS client_pt_telepon_contact_person,
										CustszEmail AS client_pt_email_contact_person,
										client_pt_keterangan,
										kelas_jalan_id,
										CASE WHEN szDeliveryGroupId IN ('','0','#N/A') THEN 'N/A' ELSE szDeliveryGroupId END AS area_id,
										client_pt_corporate_id,
										szPaymentTermId AS client_pt_top,
										decCreditLimit AS client_pt_kredit_limit,
										intMaxCountOpenInv AS client_pt_principle_maks_invoice,
										client_pt_acc,
										client_pt_titik_antar_id,
										szCategory_1,
										szCategory_2 AS client_pt_segmen_id1,
										szCategory_3 AS client_pt_segmen_id2,
										szCategory_6 AS client_pt_segmen_id3,
										szCategory_7 AS client_pt_segment_principle_id1,
										szCategory_8 AS client_pt_segment_principle_id2,
										szCategory_9 AS client_pt_segment_principle_id3,
										unit_mandiri_id,
										client_pt_is_deleted,
										client_pt_is_aktif,
										bIsMultiLocation AS client_pt_is_multi_lokasi,
										lokasi_outlet_id,
										kelas_jalan2_id,
										bIsDiffInvoiceAddress AS alamat_penagihan_beda
										FROM (SELECT
										customer.szCustId,
										CASE
											WHEN CHARINDEX('(', customer.szName) <> 0 THEN CASE
												WHEN CHARINDEX('(', customer.szName) <> 1 THEN REPLACE(customer.szName, RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX('(', customer.szName) + 1), '')
												ELSE REPLACE(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), RIGHT(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), LEN(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) - CHARINDEX('(', RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) + 1), '')
											END
											ELSE customer.szName
										END szName,
										customer.CustszAddress_1,
										customer.CustszState,
										customer.CustszCity,
										customer.CustszDistrict,
										customer.CustszAddress_2,
										customer.CustszZipCode,
										customer.szLatitude,
										customer.szLongitude,
										customer.CustszContactPerson,
										customer.CustszPhoneNo_1,
										customer.CustszEmail,
										NULL AS client_pt_keterangan,
										NULL AS kelas_jalan_id,
										customer.szDeliveryGroupId,
										NULL AS client_pt_corporate_id,
										custSales.szPaymentTermId,
										custSales.decCreditLimit,
										custSales.intMaxCountOpenInv,
										NULL AS client_pt_acc,
										NULL AS client_pt_titik_antar_id,
										customer.szCategory_1,
										customer.szCategory_2,
										customer.szCategory_3,
										customer.szCategory_4,
										customer.szCategory_5,
										customer.szCategory_6,
										customer.szCategory_7,
										customer.szCategory_8,
										customer.szCategory_9,
										customer.szCategory_10,
										customer.szCategory_11,
										customer.szCategory_12,
										customer.szCategory_13,
										customer.szCategory_14,
										customer.szCategory_15,
										NULL AS unit_mandiri_id,
										0 AS client_pt_is_deleted,
										1 AS client_pt_is_aktif,
										customer.bIsMultiLocation,
										NULL AS lokasi_outlet_id,
										NULL AS kelas_jalan2_id,
										customer.bIsDiffInvoiceAddress
										FROM BOS_AR_Customer customer
										LEFT JOIN BOS_AR_CustSales custSales
										ON custSales.szCustId = customer.szCustId) customer
										WHERE szCustId = '$customer_id'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_customer_bosnet_by_nama($customer_nama, $customer_alamat, $customer_kelurahan, $customer_kecamatan, $customer_kota)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
										NEWID() AS client_pt_id,
										szCustId,
										szName AS client_pt_nama,
										CustszAddress_1 AS client_pt_alamat,
										CustszPhoneNo_1 AS client_pt_telepon,
										CustszState AS client_pt_propinsi,
										CustszCity AS client_pt_kota,
										CustszDistrict AS client_pt_kecamatan,
										CustszAddress_2 AS client_pt_kelurahan,
										CustszZipCode AS client_pt_kodepos,
										szLatitude AS client_pt_latitude,
										szLongitude AS client_pt_longitude,
										CustszContactPerson AS client_pt_nama_contact_person,
										CustszPhoneNo_1 AS client_pt_telepon_contact_person,
										CustszEmail AS client_pt_email_contact_person,
										client_pt_keterangan,
										kelas_jalan_id,
										CASE WHEN szDeliveryGroupId IN ('','0','#N/A') THEN 'N/A' ELSE szDeliveryGroupId END AS area_id,
										client_pt_corporate_id,
										szPaymentTermId AS client_pt_top,
										decCreditLimit AS client_pt_kredit_limit,
										intMaxCountOpenInv AS client_pt_principle_maks_invoice,
										client_pt_acc,
										client_pt_titik_antar_id,
										szCategory_1,
										szCategory_7 AS client_pt_segment_principle_id1,
										szCategory_8 AS client_pt_segment_principle_id2,
										szCategory_9 AS client_pt_segment_principle_id3,
										unit_mandiri_id,
										client_pt_is_deleted,
										client_pt_is_aktif,
										bIsMultiLocation AS client_pt_is_multi_lokasi,
										lokasi_outlet_id,
										kelas_jalan2_id,
										bIsDiffInvoiceAddress AS alamat_penagihan_beda
										FROM (SELECT
										customer.szCustId,
										CASE
											WHEN CHARINDEX('(', customer.szName) <> 0 THEN CASE
												WHEN CHARINDEX('(', customer.szName) <> 1 THEN REPLACE(customer.szName, RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX('(', customer.szName) + 1), '')
												ELSE REPLACE(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), RIGHT(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName)), LEN(RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) - CHARINDEX('(', RIGHT(customer.szName, LEN(customer.szName) - CHARINDEX(')', customer.szName))) + 1), '')
											END
											ELSE customer.szName
										END szName,
										customer.CustszAddress_1,
										customer.CustszState,
										customer.CustszCity,
										customer.CustszDistrict,
										customer.CustszAddress_2,
										customer.CustszZipCode,
										customer.szLatitude,
										customer.szLongitude,
										customer.CustszContactPerson,
										customer.CustszPhoneNo_1,
										customer.CustszEmail,
										NULL AS client_pt_keterangan,
										NULL AS kelas_jalan_id,
										customer.szDeliveryGroupId,
										NULL AS client_pt_corporate_id,
										custSales.szPaymentTermId,
										custSales.decCreditLimit,
										custSales.intMaxCountOpenInv,
										NULL AS client_pt_acc,
										NULL AS client_pt_titik_antar_id,
										customer.szCategory_1,
										customer.szCategory_2,
										customer.szCategory_3,
										customer.szCategory_4,
										customer.szCategory_5,
										customer.szCategory_6,
										customer.szCategory_7,
										customer.szCategory_8,
										customer.szCategory_9,
										customer.szCategory_10,
										customer.szCategory_11,
										customer.szCategory_12,
										customer.szCategory_13,
										customer.szCategory_14,
										customer.szCategory_15,
										NULL AS unit_mandiri_id,
										0 AS client_pt_is_deleted,
										1 AS client_pt_is_aktif,
										customer.bIsMultiLocation,
										NULL AS lokasi_outlet_id,
										NULL AS kelas_jalan2_id,
										customer.bIsDiffInvoiceAddress
										FROM BOS_AR_Customer customer
										LEFT JOIN BOS_AR_CustSales custSales
										ON custSales.szCustId = customer.szCustId) customer
										WHERE szName = '$customer_nama' 
										AND CustszAddress_1 = '$customer_alamat'
										AND CustszAddress_2 = '$customer_kelurahan' 
										AND CustszDistrict = '$customer_kecamatan' 
										AND CustszCity = '$customer_kota' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Insert_client_pt($client_pt_id, $area_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;
		$client_pt_nama = $data['client_pt_nama'] == '' ? null : $data['client_pt_nama'];
		$client_pt_alamat = $data['client_pt_alamat'] == '' ? null : $data['client_pt_alamat'];
		$client_pt_telepon = $data['client_pt_telepon'] == '' ? null : $data['client_pt_telepon'];
		$client_pt_propinsi = $data['client_pt_propinsi'] == '' ? null : $data['client_pt_propinsi'];
		$client_pt_kota = $data['client_pt_kota'] == '' ? null : $data['client_pt_kota'];
		$client_pt_kecamatan = $data['client_pt_kecamatan'] == '' ? null : $data['client_pt_kecamatan'];
		$client_pt_kelurahan = $data['client_pt_kelurahan'] == '' ? null : $data['client_pt_kelurahan'];
		$client_pt_kodepos = $data['client_pt_kodepos'] == '' ? null : $data['client_pt_kodepos'];
		$client_pt_latitude = $data['client_pt_latitude'] == '' ? null : $data['client_pt_latitude'];
		$client_pt_longitude = $data['client_pt_longitude'] == '' ? null : $data['client_pt_longitude'];
		$client_pt_nama_contact_person = $data['client_pt_nama_contact_person'] == '' ? null : $data['client_pt_nama_contact_person'];
		$client_pt_telepon_contact_person = $data['client_pt_telepon_contact_person'] == '' ? null : $data['client_pt_telepon_contact_person'];
		$client_pt_email_contact_person = $data['client_pt_email_contact_person'] == '' ? null : $data['client_pt_email_contact_person'];
		$client_pt_keterangan = $data['client_pt_keterangan'] == '' ? null : $data['client_pt_keterangan'];
		$kelas_jalan_id = $data['kelas_jalan_id'] == '' ? null : $data['kelas_jalan_id'];
		$area_id = $area_id == '' ? null : $area_id;
		// $area_id = $data['area_id'] == '' ? null : $data['area_id'];
		$client_pt_corporate_id = $data['client_pt_corporate_id'] == '' ? null : $data['client_pt_corporate_id'];
		$client_pt_top = $data['client_pt_top'] == '' ? null : $data['client_pt_top'];
		$client_pt_kredit_limit = $data['client_pt_kredit_limit'] == '' ? null : $data['client_pt_kredit_limit'];
		$client_pt_acc = $data['client_pt_acc'] == '' ? null : $data['client_pt_acc'];
		$client_pt_titik_antar_id = $data['client_pt_titik_antar_id'] == '' ? null : $data['client_pt_titik_antar_id'];
		$client_pt_segmen_id1 = $data['client_pt_segmen_id1'] == '' ? null : $data['client_pt_segmen_id1'];
		$client_pt_segmen_id2 = $data['client_pt_segmen_id2'] == '' ? null : $data['client_pt_segmen_id2'];
		$client_pt_segmen_id3 = $data['client_pt_segmen_id3'] == '' ? null : $data['client_pt_segmen_id3'];
		$unit_mandiri_id = $data['unit_mandiri_id'] == '' ? null : $data['unit_mandiri_id'];
		$client_pt_is_deleted = $data['client_pt_is_deleted'] == '' ? null : $data['client_pt_is_deleted'];
		$client_pt_is_aktif = $data['client_pt_is_aktif'] == '' ? null : $data['client_pt_is_aktif'];
		$client_pt_is_multi_lokasi = $data['client_pt_is_multi_lokasi'] == '' ? null : $data['client_pt_is_multi_lokasi'];
		$lokasi_outlet_id = $data['lokasi_outlet_id'] == '' ? null : $data['lokasi_outlet_id'];
		$kelas_jalan2_id = $data['kelas_jalan2_id'] == '' ? null : $data['kelas_jalan2_id'];

		$query_seg1 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id1' ");

		if ($query_seg1->num_rows() > 0) {
			$client_pt_segmen_id1 = $query_seg1->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id1', $client_pt_segmen_id1);
		}

		$query_seg2 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id2' ");

		if ($query_seg2->num_rows() > 0) {
			$client_pt_segment_id2 = $query_seg2->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id2', $client_pt_segment_id2);
		}

		$query_seg3 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id3' ");

		if ($query_seg3->num_rows() > 0) {
			$client_pt_segment_id3 = $query_seg3->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id3', $client_pt_segment_id3);
		}

		$backend->set("client_pt_id", $client_pt_id);
		$backend->set('client_pt_nama', "dbo.escapechar('" . rtrim(ltrim($client_pt_nama)) . "')", FALSE);
		$backend->set('client_pt_alamat', "dbo.escapechar('" . rtrim(ltrim($client_pt_alamat)) . "')", FALSE);
		// $backend->set('client_pt_nama', $client_pt_nama);
		// $backend->set('client_pt_alamat', $client_pt_alamat);
		$backend->set('client_pt_telepon', $client_pt_telepon);
		$backend->set('client_pt_propinsi', $client_pt_propinsi);
		$backend->set('client_pt_kota', $client_pt_kota);
		$backend->set('client_pt_kecamatan', $client_pt_kecamatan);
		$backend->set('client_pt_kelurahan', $client_pt_kelurahan);
		$backend->set('client_pt_kodepos', $client_pt_kodepos);
		$backend->set('client_pt_latitude', $client_pt_latitude);
		$backend->set('client_pt_longitude', $client_pt_longitude);
		$backend->set('client_pt_nama_contact_person', $client_pt_nama_contact_person);
		$backend->set('client_pt_telepon_contact_person', $client_pt_telepon_contact_person);
		$backend->set('client_pt_email_contact_person', $client_pt_email_contact_person);
		$backend->set('client_pt_keterangan', $client_pt_keterangan);
		$backend->set('kelas_jalan_id', $kelas_jalan_id);
		$backend->set('area_id', $area_id);
		$backend->set('client_pt_corporate_id', $client_pt_corporate_id);
		$backend->set('client_pt_top', $client_pt_top);
		$backend->set('client_pt_kredit_limit', $client_pt_kredit_limit);
		$backend->set('client_pt_acc', $client_pt_acc);
		$backend->set('client_pt_titik_antar_id', $client_pt_titik_antar_id);
		// $backend->set('client_pt_segmen_id1', $client_pt_segmen_id1);
		// $backend->set('client_pt_segmen_id2', $client_pt_segmen_id2);
		// $backend->set('client_pt_segmen_id3', $client_pt_segmen_id3);
		$backend->set('unit_mandiri_id', $unit_mandiri_id);
		$backend->set('client_pt_is_deleted', $client_pt_is_deleted);
		$backend->set('client_pt_is_aktif', $client_pt_is_aktif);
		$backend->set('client_pt_is_multi_lokasi', $client_pt_is_multi_lokasi);
		$backend->set('lokasi_outlet_id', $lokasi_outlet_id);
		$backend->set('kelas_jalan2_id', $kelas_jalan2_id);

		$backend->insert("client_pt");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Insert_client_pt_detail($client_pt_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$hari_kerja = array(["hari_urut" => "1", "hari" => "Senin", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "2", "hari" => "Selasa", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "3", "hari" => "Rabu", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "4", "hari" => "Kamis", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "5", "hari" => "Jumat", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "6", "hari" => "Sabtu", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"], ["hari_urut" => "7", "hari" => "Minggu", "jam_buka" => "07:00:00", "jam_tutup" => "21:00:00"]);

		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;

		foreach ($hari_kerja as $value) {
			$backend->set("client_pt_detail_id", "NEWID()", FALSE);
			$backend->set("client_pt_id", $client_pt_id);
			$backend->set('client_pt_detail_is_open', 1);
			$backend->set('client_pt_detail_hari_urut', $value['hari_urut']);
			$backend->set('client_pt_detail_hari', $value['hari']);
			$backend->set('client_pt_detail_jam_buka', $value['jam_buka']);
			$backend->set('client_pt_detail_jam_tutup', $value['jam_tutup']);
			$backend->set('client_pt_detail_is_deleted', 0);
			$backend->set('client_pt_detail_is_aktif', 1);
			// $backend->set('client_pt_detail_pengiriman', $value['client_pt_detail_pengiriman']);
			// $backend->set('client_pt_detail_penagihan', $value['client_pt_detail_penagihan']);
			$backend->insert("client_pt_detail");
		}

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Insert_client_pt_principle($client_pt_principle_id, $client_pt_id, $principle_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		// $client_pt_principle_id = $data['client_pt_principle_id'] == '' ? null : $data['client_pt_principle_id'];
		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;
		$principle_id = $principle_id == '' ? null : $principle_id;
		$client_pt_principle_top = $data['client_pt_top'] == '' ? null : $data['client_pt_top'];
		$client_pt_principle_kredit_limit = $data['client_pt_kredit_limit'] == '' ? null : $data['client_pt_kredit_limit'];
		$client_pt_principle_is_kredit = $data['client_pt_kredit_limit'] > 0 ? '1' : '0';
		$client_pt_segment_id1 = $data['client_pt_segment_principle_id1'] == '' ? null : $data['client_pt_segment_principle_id1'];
		$client_pt_segment_id2 = $data['client_pt_segment_principle_id2'] == '' ? null : $data['client_pt_segment_principle_id2'];
		$client_pt_segment_id3 = $data['client_pt_segment_principle_id3'] == '' ? null : $data['client_pt_segment_principle_id3'];
		$client_pt_principle_maks_invoice = $data['client_pt_principle_maks_invoice'] == '' ? null : $data['client_pt_principle_maks_invoice'];
		$alamat_penagihan_beda = $data['alamat_penagihan_beda'] == '' ? null : $data['alamat_penagihan_beda'];
		// $client_pt_id_penagihan = $client_pt_id == '' ? null : $client_pt_id;
		// $segment_harga_id = $data['segment_harga_id'] == '' ? null : $data['segment_harga_id'];

		$query_seg1 = $backend->query("SELECT client_pt_segmen_principle_id FROM client_pt_segmen_principle WHERE client_pt_segmen_kode = '$client_pt_segment_id1' ");

		if ($query_seg1->num_rows() > 0) {
			$client_pt_segment_id1 = $query_seg1->row(0)->client_pt_segmen_principle_id;
		} else {

			$client_pt_segmen_principle_id = $backend->query("select newid() as newid")->row(0)->newid;

			$backend->set('client_pt_segmen_principle_id', $client_pt_segmen_principle_id);
			$backend->set('client_pt_segmen_kode', $client_pt_segment_id1);
			$backend->set('client_pt_segmen_nama', $client_pt_segment_id1);
			$backend->set('client_pt_segmen_keterangan', "");
			$backend->set('client_pt_segmen_level', "1");
			$backend->set('client_pt_segmen_is_deleted', "0");
			$backend->set('client_pt_segmen_is_aktif', "1");

			$backend->insert("client_pt_segmen_principle");

			$client_pt_segment_id1 = $client_pt_segmen_principle_id;
		}

		$query_seg2 = $backend->query("SELECT client_pt_segmen_principle_id FROM client_pt_segmen_principle WHERE client_pt_segmen_kode = '$client_pt_segment_id2' ");

		if ($query_seg2->num_rows() > 0) {
			$client_pt_segment_id2 = $query_seg2->row(0)->client_pt_segmen_principle_id;
		} else {

			$client_pt_segmen_principle_id = $backend->query("select newid() as newid")->row(0)->newid;

			$backend->set('client_pt_segmen_principle_id', $client_pt_segmen_principle_id);
			$backend->set('client_pt_segmen_kode', $client_pt_segment_id2);
			$backend->set('client_pt_segmen_nama', $client_pt_segment_id2);
			$backend->set('client_pt_segmen_reff_id', $client_pt_segment_id1);
			$backend->set('client_pt_segmen_keterangan', "");
			$backend->set('client_pt_segmen_level', "2");
			$backend->set('client_pt_segmen_is_deleted', "0");
			$backend->set('client_pt_segmen_is_aktif', "1");

			$backend->insert("client_pt_segmen_principle");

			$client_pt_segment_id2 = $client_pt_segmen_principle_id;
		}

		$query_seg3 = $backend->query("SELECT client_pt_segmen_principle_id FROM client_pt_segmen_principle WHERE client_pt_segmen_kode = '$client_pt_segment_id3' ");

		if ($query_seg3->num_rows() > 0) {
			$client_pt_segment_id3 = $query_seg3->row(0)->client_pt_segmen_principle_id;
		} else {

			$client_pt_segmen_principle_id = $backend->query("select newid() as newid")->row(0)->newid;

			$backend->set('client_pt_segmen_principle_id', $client_pt_segmen_principle_id);
			$backend->set('client_pt_segmen_kode', $client_pt_segment_id3);
			$backend->set('client_pt_segmen_nama', $client_pt_segment_id3);
			$backend->set('client_pt_segmen_reff_id', $client_pt_segment_id2);
			$backend->set('client_pt_segmen_keterangan', "");
			$backend->set('client_pt_segmen_level', "3");
			$backend->set('client_pt_segmen_is_deleted', "0");
			$backend->set('client_pt_segmen_is_aktif', "1");

			$backend->insert("client_pt_segmen_principle");

			$client_pt_segment_id3 = $client_pt_segmen_principle_id;
		}

		$backend->set('client_pt_principle_id', $client_pt_principle_id);
		$backend->set('client_pt_id', $client_pt_id);
		$backend->set('principle_id', $principle_id);
		$backend->set('client_pt_principle_top', preg_replace("/[^0-9]/", "", $client_pt_principle_top));
		$backend->set('client_pt_principle_kredit_limit', $client_pt_principle_kredit_limit);
		$backend->set('client_pt_principle_is_kredit', $client_pt_principle_is_kredit);
		$backend->set('client_pt_principle_maks_invoice', $client_pt_principle_maks_invoice);
		$backend->set('alamat_penagihan_beda', $alamat_penagihan_beda);
		$backend->set('client_pt_id_penagihan', $client_pt_id);
		$backend->set('client_pt_principle_top_retur', 90);
		$backend->set('client_pt_segment_id1', $client_pt_segment_id1);
		$backend->set('client_pt_segment_id2', $client_pt_segment_id2);
		$backend->set('client_pt_segment_id3', $client_pt_segment_id3);
		// $backend->set('segment_harga_id', $segment_harga_id);

		$backend->insert("client_pt_principle");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $this->db->last_query();
	}

	public function Insert_client_pt_principle_eksternal($client_pt_id, $principle_id, $sistem_eksternal, $data)
	{
		$middleware = $this->load->database('middleware', TRUE);

		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;
		$principle_id = $principle_id == '' ? null : $principle_id;
		$sistem_eksternal = $sistem_eksternal == '' ? null : $sistem_eksternal;

		$middleware->set("client_pt_principle_eksternal_id", "NEWID()", FALSE);
		$middleware->set("sistem_eksternal", $sistem_eksternal);
		$middleware->set("client_pt_id", $client_pt_id);
		$middleware->set("principle_id", $principle_id);
		$middleware->set("customer_eksternal_id", $data['szCustId']);

		$middleware->insert("client_pt_principle_eksternal");

		$affectedrows = $middleware->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Insert_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_principle_id = $client_pt_principle_id == '' ? null : $client_pt_principle_id;
		$client_pt_alamat = $data['client_pt_alamat'] == '' ? null : $data['client_pt_alamat'];
		$client_pt_telepon = $data['client_pt_telepon'] == '' ? null : $data['client_pt_telepon'];
		$client_pt_propinsi = $data['client_pt_propinsi'] == '' ? null : $data['client_pt_propinsi'];
		$client_pt_kota = $data['client_pt_kota'] == '' ? null : $data['client_pt_kota'];
		$client_pt_kecamatan = $data['client_pt_kecamatan'] == '' ? null : $data['client_pt_kecamatan'];
		$client_pt_kelurahan = $data['client_pt_kelurahan'] == '' ? null : $data['client_pt_kelurahan'];
		$client_pt_kodepos = $data['client_pt_kodepos'] == '' ? null : $data['client_pt_kodepos'];
		$client_pt_latitude = $data['client_pt_latitude'] == '' ? null : $data['client_pt_latitude'];
		$client_pt_longitude = $data['client_pt_longitude'] == '' ? null : $data['client_pt_longitude'];
		$client_pt_nama_contact_person = $data['client_pt_nama_contact_person'] == '' ? null : $data['client_pt_nama_contact_person'];
		$client_pt_telepon_contact_person = $data['client_pt_telepon_contact_person'] == '' ? null : $data['client_pt_telepon_contact_person'];
		$client_pt_email_contact_person = $data['client_pt_email_contact_person'] == '' ? null : $data['client_pt_email_contact_person'];
		$client_pt_keterangan = $data['client_pt_keterangan'] == '' ? null : $data['client_pt_keterangan'];
		$kelas_jalan_id = $data['kelas_jalan_id'] == '' ? null : $data['kelas_jalan_id'];
		$area_id = $area_id == '' ? null : $area_id;
		// $area_id = $data['area_id'] == '' ? null : $data['area_id'];
		$client_pt_corporate_id = $data['client_pt_corporate_id'] == '' ? null : $data['client_pt_corporate_id'];
		$client_pt_top = $data['client_pt_top'] == '' ? null : $data['client_pt_top'];
		$client_pt_kredit_limit = $data['client_pt_kredit_limit'] == '' ? null : $data['client_pt_kredit_limit'];
		$client_pt_acc = $data['client_pt_acc'] == '' ? null : $data['client_pt_acc'];
		$client_pt_titik_antar_id = $data['client_pt_titik_antar_id'] == '' ? null : $data['client_pt_titik_antar_id'];
		$client_pt_segmen_id1 = $data['client_pt_segmen_id1'] == '' ? null : $data['client_pt_segmen_id1'];
		$client_pt_segmen_id2 = $data['client_pt_segmen_id2'] == '' ? null : $data['client_pt_segmen_id2'];
		$client_pt_segmen_id3 = $data['client_pt_segmen_id3'] == '' ? null : $data['client_pt_segmen_id3'];
		$unit_mandiri_id = $data['unit_mandiri_id'] == '' ? null : $data['unit_mandiri_id'];
		$client_pt_is_deleted = $data['client_pt_is_deleted'] == '' ? null : $data['client_pt_is_deleted'];
		$client_pt_is_aktif = $data['client_pt_is_aktif'] == '' ? null : $data['client_pt_is_aktif'];
		$client_pt_is_multi_lokasi = $data['client_pt_is_multi_lokasi'] == '' ? null : $data['client_pt_is_multi_lokasi'];
		$lokasi_outlet_id = $data['lokasi_outlet_id'] == '' ? null : $data['lokasi_outlet_id'];
		$kelas_jalan2_id = $data['kelas_jalan2_id'] == '' ? null : $data['kelas_jalan2_id'];

		$backend->set('client_pt_principle_alamat_id', $client_pt_principle_alamat_id);
		$backend->set('client_pt_principle_id', $client_pt_principle_id);
		$backend->set('client_pt_alamat', $client_pt_alamat);
		$backend->set('client_pt_telepon', $client_pt_telepon);
		$backend->set('client_pt_propinsi', $client_pt_propinsi);
		$backend->set('client_pt_kota', $client_pt_kota);
		$backend->set('client_pt_kecamatan', $client_pt_kecamatan);
		$backend->set('client_pt_kelurahan', $client_pt_kelurahan);
		$backend->set('client_pt_kodepos', $client_pt_kodepos);
		$backend->set('client_pt_latitude', $client_pt_latitude);
		$backend->set('client_pt_longitude', $client_pt_longitude);
		$backend->set('client_pt_nama_contact_person', $client_pt_nama_contact_person);
		$backend->set('client_pt_telepon_contact_person', $client_pt_telepon_contact_person);
		$backend->set('client_pt_email_contact_person', $client_pt_email_contact_person);
		$backend->set('client_pt_keterangan', $client_pt_keterangan);
		// $backend->set('client_pt_fax', $client_pt_fax);
		// $backend->set('client_pt_npwp', $client_pt_npwp);
		$backend->set('kelas_jalan_id', $kelas_jalan_id);
		$backend->set('kelas_jalan2_id', $kelas_jalan2_id);
		$backend->set('area_id', $area_id);
		$backend->set('flag', "alamat_kirim_sama");

		$backend->insert("client_pt_principle_alamat");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Insert_client_pt_principle_alamat_detail($client_pt_principle_alamat_detail_id, $client_pt_principle_alamat_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_detail_hari_urut = $data['client_pt_detail_hari_urut'] == '' ? null : $data['client_pt_detail_hari_urut'];
		$client_pt_detail_hari = $data['client_pt_detail_hari'] == '' ? null : $data['client_pt_detail_hari'];
		$client_pt_detail_jam_buka = $data['client_pt_detail_jam_buka'] == '' ? null : $data['client_pt_detail_jam_buka'];
		$client_pt_detail_jam_tutup = $data['client_pt_detail_jam_tutup'] == '' ? null : $data['client_pt_detail_jam_tutup'];

		$backend->set('client_pt_principle_alamat_detail_id', $client_pt_principle_alamat_detail_id);
		$backend->set('client_pt_principle_alamat_id', $client_pt_principle_alamat_id);
		$backend->set('client_pt_detail_is_open', "1");
		$backend->set('client_pt_detail_hari_urut', $client_pt_detail_hari_urut);
		$backend->set('client_pt_detail_hari', $client_pt_detail_hari);
		$backend->set('client_pt_detail_jam_buka', $client_pt_detail_jam_buka);
		$backend->set('client_pt_detail_jam_tutup', $client_pt_detail_jam_tutup);
		$backend->set('client_pt_detail_is_deleted', "0");
		$backend->set('client_pt_detail_is_aktif', "1");
		$backend->set('client_pt_detail_pengiriman', "1");
		$backend->set('client_pt_detail_penagihan', "1");

		$backend->insert("client_pt_principle_alamat_detail");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function Update_client_pt($client_pt_id, $area_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;
		$client_pt_nama = $data->client_pt_nama == '' ? null : $data->client_pt_nama;
		$client_pt_alamat = $data->client_pt_alamat == '' ? null : $data->client_pt_alamat;
		$client_pt_telepon = $data->client_pt_telepon == '' ? null : $data->client_pt_telepon;
		$client_pt_propinsi = $data->client_pt_propinsi == '' ? null : $data->client_pt_propinsi;
		$client_pt_kota = $data->client_pt_kota == '' ? null : $data->client_pt_kota;
		$client_pt_kecamatan = $data->client_pt_kecamatan == '' ? null : $data->client_pt_kecamatan;
		$client_pt_kelurahan = $data->client_pt_kelurahan == '' ? null : $data->client_pt_kelurahan;
		$client_pt_kodepos = $data->client_pt_kodepos == '' ? null : $data->client_pt_kodepos;
		$client_pt_latitude = $data->client_pt_latitude == '' ? null : $data->client_pt_latitude;
		$client_pt_longitude = $data->client_pt_longitude == '' ? null : $data->client_pt_longitude;
		$client_pt_nama_contact_person = $data->client_pt_nama_contact_person == '' ? null : $data->client_pt_nama_contact_person;
		$client_pt_telepon_contact_person = $data->client_pt_telepon_contact_person == '' ? null : $data->client_pt_telepon_contact_person;
		$client_pt_email_contact_person = $data->client_pt_email_contact_person == '' ? null : $data->client_pt_email_contact_person;
		$client_pt_keterangan = $data->client_pt_keterangan == '' ? null : $data->client_pt_keterangan;
		$kelas_jalan_id = $data->kelas_jalan_id == '' ? null : $data->kelas_jalan_id;
		$area_id = $area_id == '' ? null : $area_id;
		// $area_id = $data->area_id == '' ? null : $data->area_id;
		$client_pt_corporate_id = $data->client_pt_corporate_id == '' ? null : $data->client_pt_corporate_id;
		$client_pt_top = $data->client_pt_top == '' ? null : $data->client_pt_top;
		$client_pt_kredit_limit = $data->client_pt_kredit_limit == '' ? null : $data->client_pt_kredit_limit;
		$client_pt_acc = $data->client_pt_acc == '' ? null : $data->client_pt_acc;
		$client_pt_titik_antar_id = $data->client_pt_titik_antar_id == '' ? null : $data->client_pt_titik_antar_id;
		$client_pt_segmen_id1 = $data->client_pt_segmen_id1 == '' ? null : $data->client_pt_segmen_id1;
		$client_pt_segmen_id2 = $data->client_pt_segmen_id2 == '' ? null : $data->client_pt_segmen_id2;
		$client_pt_segmen_id3 = $data->client_pt_segmen_id3 == '' ? null : $data->client_pt_segmen_id3;
		$unit_mandiri_id = $data->unit_mandiri_id == '' ? null : $data->unit_mandiri_id;
		$client_pt_is_deleted = $data->client_pt_is_deleted == '' ? null : $data->client_pt_is_deleted;
		$client_pt_is_aktif = $data->client_pt_is_aktif == '' ? null : $data->client_pt_is_aktif;
		$client_pt_is_multi_lokasi = $data->client_pt_is_multi_lokasi == '' ? null : $data->client_pt_is_multi_lokasi;
		$lokasi_outlet_id = $data->lokasi_outlet_id == '' ? null : $data->lokasi_outlet_id;
		$kelas_jalan2_id = $data->kelas_jalan2_id == '' ? null : $data->kelas_jalan2_id;

		$query_seg1 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id1' ");

		if ($query_seg1->num_rows() > 0) {
			$client_pt_segmen_id1 = $query_seg1->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id1', $client_pt_segmen_id1);
		}

		$query_seg2 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id2' ");

		if ($query_seg2->num_rows() > 0) {
			$client_pt_segment_id2 = $query_seg2->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id2', $client_pt_segment_id2);
		}

		$query_seg3 = $this->db->query("SELECT client_pt_segmen_id FROM client_pt_segmen WHERE client_pt_segmen_kode = '$client_pt_segmen_id3' ");

		if ($query_seg3->num_rows() > 0) {
			$client_pt_segment_id3 = $query_seg3->row(0)->client_pt_segmen_id;
			$backend->set('client_pt_segmen_id3', $client_pt_segment_id3);
		}

		$backend->set('client_pt_nama', "dbo.escapechar('" . rtrim(ltrim($client_pt_nama)) . "')", FALSE);
		$backend->set('client_pt_alamat', "dbo.escapechar('" . rtrim(ltrim($client_pt_alamat)) . "')", FALSE);
		// $backend->set('client_pt_nama', $client_pt_nama);
		// $backend->set('client_pt_alamat', $client_pt_alamat);
		$backend->set('client_pt_telepon', $client_pt_telepon);
		$backend->set('client_pt_propinsi', $client_pt_propinsi);
		$backend->set('client_pt_kota', $client_pt_kota);
		$backend->set('client_pt_kecamatan', $client_pt_kecamatan);
		$backend->set('client_pt_kelurahan', $client_pt_kelurahan);
		$backend->set('client_pt_kodepos', $client_pt_kodepos);
		$backend->set('client_pt_latitude', $client_pt_latitude);
		$backend->set('client_pt_longitude', $client_pt_longitude);
		$backend->set('client_pt_nama_contact_person', $client_pt_nama_contact_person);
		$backend->set('client_pt_telepon_contact_person', $client_pt_telepon_contact_person);
		$backend->set('client_pt_email_contact_person', $client_pt_email_contact_person);
		$backend->set('client_pt_keterangan', $client_pt_keterangan);
		$backend->set('kelas_jalan_id', $kelas_jalan_id);
		$backend->set('area_id', $area_id);
		$backend->set('client_pt_corporate_id', $client_pt_corporate_id);
		$backend->set('client_pt_top', $client_pt_top);
		$backend->set('client_pt_kredit_limit', $client_pt_kredit_limit);
		$backend->set('client_pt_acc', $client_pt_acc);
		$backend->set('client_pt_titik_antar_id', $client_pt_titik_antar_id);
		// $backend->set('client_pt_segmen_id1', $client_pt_segmen_id1);
		// $backend->set('client_pt_segmen_id2', $client_pt_segmen_id2);
		// $backend->set('client_pt_segmen_id3', $client_pt_segmen_id3);
		$backend->set('unit_mandiri_id', $unit_mandiri_id);
		$backend->set('client_pt_is_deleted', $client_pt_is_deleted);
		$backend->set('client_pt_is_aktif', $client_pt_is_aktif);
		$backend->set('client_pt_is_multi_lokasi', $client_pt_is_multi_lokasi);
		$backend->set('lokasi_outlet_id', $lokasi_outlet_id);
		$backend->set('kelas_jalan2_id', $kelas_jalan2_id);

		$backend->where("client_pt_id", $client_pt_id);

		$backend->update("client_pt");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Update_client_pt_principle_alamat($client_pt_principle_alamat_id, $client_pt_principle_id, $area_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_principle_id = $client_pt_principle_id == '' ? null : $client_pt_principle_id;
		$client_pt_alamat = $data->client_pt_alamat == '' ? null : $data->client_pt_alamat;
		$client_pt_telepon = $data->client_pt_telepon == '' ? null : $data->client_pt_telepon;
		$client_pt_propinsi = $data->client_pt_propinsi == '' ? null : $data->client_pt_propinsi;
		$client_pt_kota = $data->client_pt_kota == '' ? null : $data->client_pt_kota;
		$client_pt_kecamatan = $data->client_pt_kecamatan == '' ? null : $data->client_pt_kecamatan;
		$client_pt_kelurahan = $data->client_pt_kelurahan == '' ? null : $data->client_pt_kelurahan;
		$client_pt_kodepos = $data->client_pt_kodepos == '' ? null : $data->client_pt_kodepos;
		$client_pt_latitude = $data->client_pt_latitude == '' ? null : $data->client_pt_latitude;
		$client_pt_longitude = $data->client_pt_longitude == '' ? null : $data->client_pt_longitude;
		$client_pt_nama_contact_person = $data->client_pt_nama_contact_person == '' ? null : $data->client_pt_nama_contact_person;
		$client_pt_telepon_contact_person = $data->client_pt_telepon_contact_person == '' ? null : $data->client_pt_telepon_contact_person;
		$client_pt_email_contact_person = $data->client_pt_email_contact_person == '' ? null : $data->client_pt_email_contact_person;
		$client_pt_keterangan = $data->client_pt_keterangan == '' ? null : $data->client_pt_keterangan;
		$kelas_jalan_id = $data->kelas_jalan_id == '' ? null : $data->kelas_jalan_id;
		$area_id = $area_id == '' ? null : $area_id;
		// $area_id = $data->area_id == '' ? null : $data->area_id;
		$client_pt_corporate_id = $data->client_pt_corporate_id == '' ? null : $data->client_pt_corporate_id;
		$client_pt_top = $data->client_pt_top == '' ? null : $data->client_pt_top;
		$client_pt_kredit_limit = $data->client_pt_kredit_limit == '' ? null : $data->client_pt_kredit_limit;
		$client_pt_acc = $data->client_pt_acc == '' ? null : $data->client_pt_acc;
		$client_pt_titik_antar_id = $data->client_pt_titik_antar_id == '' ? null : $data->client_pt_titik_antar_id;
		$client_pt_segmen_id1 = $data->client_pt_segmen_id1 == '' ? null : $data->client_pt_segmen_id1;
		$client_pt_segmen_id2 = $data->client_pt_segmen_id2 == '' ? null : $data->client_pt_segmen_id2;
		$client_pt_segmen_id3 = $data->client_pt_segmen_id3 == '' ? null : $data->client_pt_segmen_id3;
		$unit_mandiri_id = $data->unit_mandiri_id == '' ? null : $data->unit_mandiri_id;
		$client_pt_is_deleted = $data->client_pt_is_deleted == '' ? null : $data->client_pt_is_deleted;
		$client_pt_is_aktif = $data->client_pt_is_aktif == '' ? null : $data->client_pt_is_aktif;
		$client_pt_is_multi_lokasi = $data->client_pt_is_multi_lokasi == '' ? null : $data->client_pt_is_multi_lokasi;
		$lokasi_outlet_id = $data->lokasi_outlet_id == '' ? null : $data->lokasi_outlet_id;
		$kelas_jalan2_id = $data->kelas_jalan2_id == '' ? null : $data->kelas_jalan2_id;

		$backend->set('client_pt_principle_id', $client_pt_principle_id);
		$backend->set('client_pt_alamat', $client_pt_alamat);
		$backend->set('client_pt_telepon', $client_pt_telepon);
		$backend->set('client_pt_propinsi', $client_pt_propinsi);
		$backend->set('client_pt_kota', $client_pt_kota);
		$backend->set('client_pt_kecamatan', $client_pt_kecamatan);
		$backend->set('client_pt_kelurahan', $client_pt_kelurahan);
		$backend->set('client_pt_kodepos', $client_pt_kodepos);
		$backend->set('client_pt_latitude', $client_pt_latitude);
		$backend->set('client_pt_longitude', $client_pt_longitude);
		$backend->set('client_pt_nama_contact_person', $client_pt_nama_contact_person);
		$backend->set('client_pt_telepon_contact_person', $client_pt_telepon_contact_person);
		$backend->set('client_pt_email_contact_person', $client_pt_email_contact_person);
		$backend->set('client_pt_keterangan', $client_pt_keterangan);
		// $backend->set('client_pt_fax', $client_pt_fax);
		// $backend->set('client_pt_npwp', $client_pt_npwp);
		$backend->set('kelas_jalan_id', $kelas_jalan_id);
		$backend->set('kelas_jalan2_id', $kelas_jalan2_id);
		$backend->set('area_id', $area_id);
		$backend->set('flag', "alamat_kirim_sama");
		$backend->where('client_pt_principle_alamat_id', $client_pt_principle_alamat_id);

		$backend->update("client_pt_principle_alamat");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
	}

	public function delete_client_pt($client_pt_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$this->db->where('client_pt_id', $client_pt_id);
		$this->db->delete('client_pt_principle_eksternal');

		$backend->where('client_pt_id', $client_pt_id);
		$backend->delete('client_pt_principle');

		$backend->where('client_pt_id', $client_pt_id);
		$backend->delete('client_pt');

		$affectedrows = $backend->affected_rows();

		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_client_pt_principle($client_pt_id, $principle_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$backend->where('principle_id', $principle_id);
		$backend->where('client_pt_id', $client_pt_id);
		$backend->delete('client_pt_principle');

		$affectedrows = $backend->affected_rows();

		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
		// return $this->db->last_query();
	}

	public function delete_client_pt_principle_eksternal($client_pt_id, $principle_id)
	{
		// $backend = $this->load->database('backend', TRUE);

		$this->db->where('principle_id', $principle_id);
		$this->db->where('client_pt_id', $client_pt_id);
		$this->db->delete('client_pt_principle_eksternal');

		$affectedrows = $this->db->affected_rows();

		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
		// return $this->db->last_query();
	}

	public function Delete_client_pt_principle_alamat_detail($client_pt_principle_alamat_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$backend->where('client_pt_principle_alamat_id', $client_pt_principle_alamat_id);
		$backend->delete('client_pt_principle_alamat_detail');

		$affectedrows = $backend->affected_rows();

		if ($affectedrows > 0) {
			$querydelete = 1;
		} else {
			$querydelete = 0;
		}

		return $querydelete;
		// return $this->db->last_query();
	}

	public function Get_sales_bosnet_by_id($sales_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									szEmployeeId AS karyawan_id,
									'' client_wms_id,
									'' unit_mandiri_id,
									szWorkplaceId AS depo_id,
									szName AS karyawan_nama,
									'' karyawan_telepon,
									'' AS karyawan_email,
									'' AS karyawan_tanggal_lahir,
									'A2A0C245-2265-4402-A20D-952454F4641B' AS karyawan_divisi_id,
									'FF637C9A-F604-4EF6-8AD5-3E9D7FEC766A' AS karyawan_level_id,
									'' AS karyawan_supervisor_id,
									'1' AS karyawan_is_client_wms,
									'' AS karyawan_foto,
									'' AS karyawan_digital_signature,
									'0' AS karyawan_is_deleted,
									'1' AS karyawan_is_aktif,
									'' AS karyawan_is_dewa
									FROM BOS_PI_Employee
									WHERE szEmployeeId = '$sales_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Get_sales_bosnet_principle_by_id($sales_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									sales.szEmployeeId,
									sales.szName,
									product.szCategory_1
								FROM BOS_PI_Employee sales
								LEFT JOIN BOS_SD_Fso so
								ON so.szSalesId = sales.szEmployeeId
								LEFT JOIN BOS_SD_FSoItem so_item
								ON so_item.szFSoId = so.szFSoId
								AND so_item.szProductId <> ''
								LEFT JOIN BOS_INV_Product product
								ON product.szProductId = so_item.szProductId
								WHERE sales.szEmployeeId = '$sales_id' AND YEAR(so.dtmOrder) = '" . date('Y') . "' AND so.bApplied = '1' and so.bVoid = '0'
								GROUP BY sales.szEmployeeId,
									sales.szName,
									product.szCategory_1");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_driver_bosnet_principle_by_id($driver_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									driver.szEmployeeId,
									driver.szName,
									product.szCategory_1
								FROM BOS_PI_Employee driver
								LEFT JOIN BOS_SD_FPr fpr
								ON fpr.szDriverId = driver.szEmployeeId
								LEFT JOIN BOS_SD_FPrItem fpr_item
								ON fpr_item.szFPrId = fpr.szFPrId
								AND fpr_item.szProductId <> ''
								LEFT JOIN BOS_INV_Product product
								ON product.szProductId = fpr_item.szProductId
								WHERE driver.szEmployeeId = '$driver_id' AND YEAR(fpr.dtmRequest) = '" . date('Y') . "' AND fpr.bApplied = '1' and fpr.bVoid = '0'
								GROUP BY driver.szEmployeeId,
									driver.szName,
									product.szCategory_1");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Check_sales_fas($sales_nama, $depo_id)
	{
		$this->db->select("*")
			->from("karyawan")
			->where("karyawan_nama", $sales_nama)
			->where("depo_id", $depo_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Insert_karyawan($karyawan_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$karyawan_id = $karyawan_id == '' ? null : $karyawan_id;
		$client_wms_id = $data->client_wms_id == '' ? null : $data->client_wms_id;
		$unit_mandiri_id = $data->unit_mandiri_id == '' ? null : $data->unit_mandiri_id;
		$depo_id = $data->depo_id == '' ? null : $data->depo_id;
		$karyawan_nama = $data->karyawan_nama == '' ? null : $data->karyawan_nama;
		$karyawan_telepon = $data->karyawan_telepon == '' ? null : $data->karyawan_telepon;
		$karyawan_email = $data->karyawan_email == '' ? null : $data->karyawan_email;
		$karyawan_tanggal_lahir = $data->karyawan_tanggal_lahir == '' ? null : $data->karyawan_tanggal_lahir;
		$karyawan_divisi_id = $data->karyawan_divisi_id == '' ? null : $data->karyawan_divisi_id;
		$karyawan_level_id = $data->karyawan_level_id == '' ? null : $data->karyawan_level_id;
		$karyawan_supervisor_id = $data->karyawan_supervisor_id == '' ? null : $data->karyawan_supervisor_id;
		$karyawan_is_client_wms = $data->karyawan_is_client_wms == '' ? null : $data->karyawan_is_client_wms;
		$karyawan_foto = $data->karyawan_foto == '' ? null : $data->karyawan_foto;
		$karyawan_digital_signature = $data->karyawan_digital_signature == '' ? null : $data->karyawan_digital_signature;
		$karyawan_is_deleted = $data->karyawan_is_deleted == '' ? null : $data->karyawan_is_deleted;
		$karyawan_is_aktif = $data->karyawan_is_aktif == '' ? null : $data->karyawan_is_aktif;
		$karyawan_is_dewa = $data->karyawan_is_dewa == '' ? null : $data->karyawan_is_dewa;

		$backend->set("karyawan_id", $karyawan_id);
		$backend->set("client_wms_id", $client_wms_id);
		$backend->set("unit_mandiri_id", $unit_mandiri_id);
		$backend->set("depo_id", $this->session->userdata('depo_id'));
		$backend->set("karyawan_nama", $karyawan_nama);
		$backend->set("karyawan_telepon", $karyawan_telepon);
		$backend->set("karyawan_email", $karyawan_email);
		$backend->set("karyawan_tanggal_lahir", $karyawan_tanggal_lahir);
		$backend->set("karyawan_divisi_id", $karyawan_divisi_id);
		$backend->set("karyawan_level_id", $karyawan_level_id);
		$backend->set("karyawan_supervisor_id", $karyawan_supervisor_id);
		$backend->set("karyawan_is_client_wms", $karyawan_is_client_wms);
		$backend->set("karyawan_foto", "default.jpg");
		$backend->set("karyawan_digital_signature", $karyawan_digital_signature);
		$backend->set("karyawan_is_deleted", $karyawan_is_deleted);
		$backend->set("karyawan_is_aktif", $karyawan_is_aktif);
		$backend->set("karyawan_is_dewa", $karyawan_is_dewa);

		$backend->insert("karyawan");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Insert_karyawan_detail($karyawan_id, $data)
	{
		$backend = $this->load->database('backend', TRUE);

		$karyawan_id = $karyawan_id == '' ? null : $karyawan_id;

		$backend->set("karyawan_detail_id", "NEWID()", FALSE);
		$backend->set("karyawan_id", $karyawan_id);

		$backend->insert("karyawan_detail");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Check_karyawan_principle($karyawan_id, $principle_id)
	{
		$this->db->select("*")
			->from("karyawan_principle")
			->where("karyawan_id", $karyawan_id)
			->where("principle_id", $principle_id);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Check_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal)
	{
		$middleware = $this->load->database('middleware', TRUE);

		$middleware->select("*")
			->from("karyawan_sales_eksternal")
			->where("karyawan_id", $karyawan_id)
			->where("sistem_eksternal", $sistem_eksternal);
		$query = $middleware->get();

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Insert_karyawan_principle($karyawan_id, $principle_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$karyawan_id = $karyawan_id == '' ? null : $karyawan_id;
		$principle_id = $principle_id == '' ? null : $principle_id;

		$backend->set("karyawan_principle_id", "NEWID()", FALSE);
		$backend->set("karyawan_id", $karyawan_id);
		$backend->set("principle_id", $principle_id);

		$backend->insert("karyawan_principle");

		$affectedrows = $backend->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}


	public function Insert_karyawan_sales_eksternal($karyawan_id, $sistem_eksternal, $sales_id)
	{
		$backend = $this->load->database('backend', TRUE);
		$middleware = $this->load->database('middleware', TRUE);

		$karyawan_id = $karyawan_id == '' ? null : $karyawan_id;
		$sistem_eksternal = $sistem_eksternal == '' ? null : $sistem_eksternal;

		$middleware->set("karyawan_sales_eksternal_id", "NEWID()", FALSE);
		$middleware->set("karyawan_id", $karyawan_id);
		$middleware->set("sistem_eksternal", $sistem_eksternal);
		$middleware->set("sales_eksternal_id", $sales_id);

		$middleware->insert("karyawan_sales_eksternal");

		$affectedrows = $middleware->affected_rows();
		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function checkDataLastUpdate($szFSoId, $tglUpdate)
	{
		$query = $this->db->query("SELECT bosnet_so_tgl_update FROM MIDDLEWARE.dbo.bosnet_so WHERE szFSoId = '$szFSoId'");

		if ($query->num_rows() == 0) {
			return 0;
		} else {
			$bosnet_so_tgl_update = $query->row()->bosnet_so_tgl_update;

			if ($tglUpdate == $bosnet_so_tgl_update) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	public function updateLastUpdate($szFSoId)
	{
		$middleware = $this->load->database('middleware', TRUE);

		$middleware->set("bosnet_so_who_update", $this->session->userdata('pengguna_username'));
		$middleware->set("bosnet_so_tgl_update", "GETDATE()", FALSE);
		$middleware->where("szFSoId", $szFSoId);

		$middleware->update("bosnet_so");
	}

	public function Get_area_customer_bosnet($customer_id)
	{
		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
								CASE
									WHEN customer.szDeliveryGroupId IN ('', '0', '#N/A') THEN 'N/A'
									ELSE customer.szDeliveryGroupId
								END AS area_id,
								CASE
									WHEN area.szDesc IN ('', '0', '#N/A') THEN 'N/A'
									ELSE area.szDesc
								END area
								FROM BOS_AR_Customer customer
								LEFT JOIN BOS_SD_DeliveryGroup area
								ON area.szDeliveryGroupId = customer.szDeliveryGroupId
								WHERE szCustId = '$customer_id'
								GROUP BY CASE
										WHEN customer.szDeliveryGroupId IN ('', '0', '#N/A') THEN 'N/A'
										ELSE customer.szDeliveryGroupId
										END,
										CASE
										WHEN area.szDesc IN ('', '0', '#N/A') THEN 'N/A'
										ELSE area.szDesc
										END");

		if ($query->num_rows() == 0) {
			// $query = 0;
			$query = array("area_id" => "N/A", "area" => "N/A");
		} else {
			$query = $query->row(0);
		}

		return $query;
	}

	public function Check_area_customer_eksternal($area_id, $area)
	{
		$cek = $this->db->query("SELECT * FROM BACKEND.dbo.area WHERE area_kode = '$area_id'");

		if ($cek->num_rows() == 0) {

			if ($area_id == "" || $area_id == "0" || $area_id == "#N/A" || $area_id == "N/A") {
				$area_internal = $this->db->query("SELECT
													*
													FROM area
													WHERE area_header_id = (SELECT
													area_header_id
													FROM depo_area_header
													WHERE depo_id = '" . $this->session->userdata("depo_id") . "')
													AND area_kode = 'N/A'")->row(0)->area_id;
			} else {
				$query = $this->db->query("INSERT INTO BACKEND.dbo.area (area_id,area_wilayah,area_kode,area_nama,area_is_aktif,area_header_id)
									SELECT
									NEWID(),
									CASE
													WHEN CHARINDEX('-', '$area', 1) = 0 THEN '$area'
													ELSE LEFT('', CHARINDEX('-', '$area', 1) - 1)
												END AS area_wilayah,
									'$area_id',
									'$area',
									'1',
									(SELECT TOP 1 area_header_id FROM depo_area_header WHERE convert(nvarchar(36), depo_id) = '" . $this->session->userdata('depo_id') . "') AS area_header_id");

				$area_internal = $this->db->query("SELECT * FROM BACKEND.dbo.area WHERE area_kode = '$area_id'")->row(0)->area_id;
			}
		} else {
			$area_internal = $cek->row(0)->area_id;
		}

		return $area_internal;
	}

	public function Get_client_pt_for_eksternal($customer_id)
	{
		$query = $this->db->query("SELECT
									client_pt_id,
									ISNULL(client_pt_nama, '') client_pt_nama,
									ISNULL(client_pt_alamat, '') client_pt_alamat,
									ISNULL(client_pt_telepon, '') client_pt_telepon,
									ISNULL(client_pt_propinsi, '') client_pt_propinsi,
									ISNULL(client_pt_kota, '') client_pt_kota,
									ISNULL(client_pt_kecamatan, '') client_pt_kecamatan,
									ISNULL(client_pt_kelurahan, '') client_pt_kelurahan,
									ISNULL(client_pt_kodepos, '') client_pt_kodepos,
									ISNULL(client_pt_latitude, '') client_pt_latitude,
									ISNULL(client_pt_longitude, '') client_pt_longitude,
									ISNULL(client_pt_nama_contact_person, '') client_pt_nama_contact_person,
									ISNULL(client_pt_telepon_contact_person, '') client_pt_telepon_contact_person,
									ISNULL(client_pt_email_contact_person, '') client_pt_email_contact_person,
									ISNULL(client_pt_keterangan, '') client_pt_keterangan,
									ISNULL(CONVERT(nvarchar(36), kelas_jalan_id), '') kelas_jalan_id,
									ISNULL(CONVERT(nvarchar(36), area_id), '') area_id,
									ISNULL(CONVERT(nvarchar(36), client_pt_corporate_id), '') client_pt_corporate_id,
									ISNULL(client_pt_top, '0') client_pt_top,
									ISNULL(client_pt_kredit_limit, '0') client_pt_kredit_limit,
									ISNULL(client_pt_acc, '') client_pt_acc,
									ISNULL(CONVERT(nvarchar(36), client_pt_titik_antar_id), '') client_pt_titik_antar_id,
									ISNULL(CONVERT(nvarchar(36), client_pt_segmen_id1), '') client_pt_segmen_id1,
									ISNULL(CONVERT(nvarchar(36), client_pt_segmen_id2), '') client_pt_segmen_id2,
									ISNULL(CONVERT(nvarchar(36), client_pt_segmen_id3), '') client_pt_segmen_id3,
									ISNULL(CONVERT(nvarchar(36), unit_mandiri_id), '') unit_mandiri_id,
									client_pt_is_deleted,
									client_pt_is_aktif,
									client_pt_is_multi_lokasi,
									ISNULL(CONVERT(nvarchar(36), lokasi_outlet_id), '') lokasi_outlet_id,
									ISNULL(CONVERT(nvarchar(36), kelas_jalan2_id), '') kelas_jalan2_id
									FROM client_pt
									WHERE client_pt_id = '$customer_id' ");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function GetPenerimaanBarangBosnet($tgl1, $tgl2, $depo, $principle)
	{
		//mengambil data penerimaan barang bosnet
		if ($depo == "999") {
			$depo = "AND a.szWorkplaceId IN ('777','$depo')";
		} else {
			$depo = "AND a.szWorkplaceId = '$depo'";
		}

		$principle = implode(",", $principle);

		$bosnet = $this->load->database('bosnet', TRUE);

		$query = $bosnet->query("SELECT
									d.szFDjrId,
									a.szFPrId,
									format(a.dtmRequest, 'yyyy-MM-dd') AS dtmRequest,
									a.szDriverId,
									c.szName,
									a.szVehicleId,
									c.szDivisionId,
									a.szStatus,
									a.bVoid,
									a.bApplied,
									a.szWorkplaceId,
									a.szDescription,
									b.szProductId,
									b.decQty,
									p.szCategory_1 AS szPrincipleId
									FROM Padma_Live.dbo.BOS_SD_FPr a
									LEFT JOIN Padma_Live.dbo.BOS_SD_FPrItem b
									ON a.szFPrId = b.szFPrId
									LEFT JOIN Padma_Live.dbo.BOS_PI_Employee c
									ON c.szEmployeeId = a.szDriverId
									LEFT JOIN Padma_Live.dbo.BOS_SD_FDjrProductRequest d
									ON d.szFPrId1 = a.szFPrId
									LEFT JOIN Padma_Live.dbo.BOS_INV_Product p
									ON p.szProductId = b.szProductId
									WHERE a.bApplied = '1'
									--AND a.szStatus = 'OPE'
									AND FORMAT(a.dtmRequest, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									--AND c.szDivisionId = 'SALES'
									AND b.szProductId IS NOT NULL
									AND d.szFDjrId IS NULL
									AND p.szCategory_1 IN (" . $principle . ")
									" . $depo . "
									GROUP BY d.szFDjrId,
											a.szFPrId,
											a.dtmRequest,
											a.szDriverId,
											c.szName,
											a.szVehicleId,
											c.szDivisionId,
											a.szStatus,
											a.bVoid,
											a.bApplied,
											a.szWorkplaceId,
											a.szDescription,
											b.szProductId,
											b.decQty,
											p.szCategory_1
									ORDER BY a.dtmRequest DESC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Insert_bosnet_penerimaan_barang($szFDjrId, $szFPrId, $dtmRequest, $szDriverId, $szName, $szVehicleId, $szDivisionId, $szStatus, $bVoid, $bApplied, $szWorkplaceId, $szDescription, $szProductId, $decQty, $szPrincipleId)
	{
		//koneksi database
		$middleware = $this->load->database('middleware', TRUE);

		$middleware->set("szFDjrId", $szFDjrId);
		$middleware->set("szFPrId", $szFPrId);
		$middleware->set("dtmRequest", $dtmRequest);
		$middleware->set("szDriverId", $szDriverId);
		$middleware->set("szName", $szName);
		$middleware->set("szVehicleId", $szVehicleId);
		$middleware->set("szDivisionId", $szDivisionId);
		$middleware->set("szStatus", $szStatus);
		$middleware->set("bVoid", $bVoid);
		$middleware->set("bApplied", $bApplied);
		$middleware->set("szWorkplaceId", $szWorkplaceId);
		$middleware->set("szDescription", $szDescription);
		$middleware->set("szProductId", $szProductId);
		$middleware->set("decQty", $decQty);
		$middleware->set("szPrincipleId", $szPrincipleId);

		$middleware->insert("bosnet_penerimaan_barang");

		$affectedrows = $middleware->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $middleware->last_query();
	}

	public function GetBosnetPenerimaanBarangHeader($tgl1, $tgl2, $depo, $principle)
	{
		//mengambil data penerimaan barang bosnet

		if ($depo == "999") {
			$depo = "AND szWorkplaceId IN ('777','$depo')";
		} else {
			$depo = "AND szWorkplaceId = '$depo'";
		}

		$principle = $principle = implode(",", $principle);

		$query = $this->db->query("SELECT
									szFPrId,
									dtmRequest,
									szDriverId,
									szName,
									szVehicleId,
									szDivisionId,
									szStatus,
									bVoid,
									bApplied,
									szWorkplaceId,
									szDescription,
									principle.principle_id,
									szPrincipleId
									FROM MIDDLEWARE.dbo.bosnet_penerimaan_barang
									LEFT JOIN principle
									ON principle.principle_kode = bosnet_penerimaan_barang.szPrincipleId
									WHERE FORMAT(dtmRequest, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									AND szPrincipleId IN (" . $principle . ")
									" . $depo . "
									GROUP BY szFPrId,
											dtmRequest,
											szDriverId,
											szName,
											szVehicleId,
											szDivisionId,
											szStatus,
											bVoid,
											bApplied,
											szWorkplaceId,
											szDescription,
											principle.principle_id,
											szPrincipleId
									ORDER BY dtmRequest ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $this->db->last_query();
	}

	public function GetBosnetPenerimaanBarangDetail($tgl1, $tgl2, $depo, $principle)
	{

		//mengambil data penerimaan barang bosnet
		if ($depo == "999") {
			$depo = "AND szWorkplaceId IN ('777','$depo')";
		} else {
			$depo = "AND szWorkplaceId = '$depo'";
		}

		$principle = $principle = implode(",", $principle);

		$query = $this->db->query("SELECT
									*
									FROM MIDDLEWARE.dbo.bosnet_penerimaan_barang
									WHERE FORMAT(dtmRequest, 'yyyy-MM-dd') BETWEEN '$tgl1' AND '$tgl2'
									AND szPrincipleId IN (" . $principle . ")
									" . $depo . "
									ORDER BY dtmRequest ASC");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Exec_proses_mapping_canvas_by_penerimaan_barang_eksternal($canvas_id, $szFPrId, $bosnet_so_product)
	{

		$query = $this->db->query("Exec proses_mapping_canvas_by_penerimaan_barang_eksternal '$canvas_id','$szFPrId','$bosnet_so_product'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
		// return $bosnet->last_query();
	}

	public function Get_karyawan_sales_eksternal($sales_eksternal_id, $sistem_eksternal)
	{
		$query = $this->db->query("SELECT * FROM MIDDLEWARE.dbo.karyawan_sales_eksternal WHERE sales_eksternal_id = '$sales_eksternal_id' AND  sistem_eksternal = '$sistem_eksternal'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->row(0)->karyawan_id;
		}

		return $query;
	}

	public function Get_client_pt_by_driver($driver_id)
	{
		$query = $this->db->query("SELECT * FROM client_pt WHERE client_pt_keterangan = '$driver_id'");

		if ($query->num_rows() == 0) {
			$query = "";
		} else {
			$query = $query->row(0)->client_pt_id;
		}

		return $query;
	}

	public function Cek_bosnet_penerimaan_barang($szFPrId, $szProductId)
	{
		$query = $this->db->query("SELECT * FROM MIDDLEWARE.dbo.bosnet_penerimaan_barang WHERE szFPrId = '$szFPrId' AND  szProductId = '$szProductId'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}

	public function Get_pb_eksternal_detail($szFPrId)
	{
		$query = $this->db->query("SELECT * FROM MIDDLEWARE.dbo.bosnet_penerimaan_barang WHERE szFPrId = '$szFPrId'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function Get_area_by_kode($area_id, $area_kode)
	{
		$query = $this->db->query("SELECT * FROM area WHERE area_kode = '$area_kode'");

		if ($query->num_rows() == 0) {

			$sql_area_na = $this->db->query("INSERT area (area_id,area_wilayah,area_kode,area_nama,area_is_aktif,area_header_id)
												SELECT
												'$area_id' AS area_id,
												CASE
													WHEN CHARINDEX('-', '$area_kode', 1) = 0 THEN '$area_kode'
													ELSE LEFT('', CHARINDEX('-', '$area_kode', 1) - 1)
												END AS area_wilayah,
												'$area_kode' AS area_kode,
												'$area_kode' AS area_nama,
												'1' AS area_is_aktif,
												(SELECT TOP 1 area_header_id FROM depo_area_header WHERE convert(nvarchar(36), depo_id) = '" . $this->session->userdata('depo_id') . "') AS area_header_id");

			if ($sql_area_na->num_rows() == 0) {
				$query = "";
			} else {
				$query = $area_id;
			}
		} else {
			$query = $query->row(0)->area_id;
		}

		return $query;
	}

	public function update_area_customer($client_pt_id, $area_id)
	{

		$area_id = $area_id == "" ? null : $area_id;
		//koneksi database
		$backend = $this->load->database('backend', TRUE);

		$backend->set("area_id", $area_id);
		$backend->where("client_pt_id", $client_pt_id);

		$backend->update("client_pt");

		$affectedrows = $backend->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function Insert_client_pt_driver($client_pt_id, $client_pt_nama, $client_pt_alamat, $client_pt_telepon, $client_pt_propinsi, $client_pt_kota, $client_pt_kecamatan, $client_pt_kelurahan, $client_pt_kodepos, $client_pt_latitude, $client_pt_longitude, $client_pt_nama_contact_person, $client_pt_telepon_contact_person, $client_pt_email_contact_person, $client_pt_keterangan, $kelas_jalan_id, $area_id, $client_pt_corporate_id, $client_pt_top, $client_pt_kredit_limit, $client_pt_acc, $client_pt_titik_antar_id, $client_pt_segmen_id1, $client_pt_segmen_id2, $client_pt_segmen_id3, $unit_mandiri_id, $client_pt_is_deleted, $client_pt_is_aktif, $client_pt_is_multi_lokasi, $lokasi_outlet_id, $kelas_jalan2_id, $client_pt_fax, $client_pt_npwp, $client_pt_status_pkp, $eksternal_id)
	{
		$backend = $this->load->database('backend', TRUE);

		$client_pt_id = $client_pt_id == '' ? null : $client_pt_id;
		$client_pt_nama = $client_pt_nama == '' ? null : $client_pt_nama;
		$client_pt_alamat = $client_pt_alamat == '' ? null : $client_pt_alamat;
		$client_pt_telepon = $client_pt_telepon == '' ? null : $client_pt_telepon;
		$client_pt_propinsi = $client_pt_propinsi == '' ? null : $client_pt_propinsi;
		$client_pt_kota = $client_pt_kota == '' ? null : $client_pt_kota;
		$client_pt_kecamatan = $client_pt_kecamatan == '' ? null : $client_pt_kecamatan;
		$client_pt_kelurahan = $client_pt_kelurahan == '' ? null : $client_pt_kelurahan;
		$client_pt_kodepos = $client_pt_kodepos == '' ? null : $client_pt_kodepos;
		$client_pt_latitude = $client_pt_latitude == '' ? null : $client_pt_latitude;
		$client_pt_longitude = $client_pt_longitude == '' ? null : $client_pt_longitude;
		$client_pt_nama_contact_person = $client_pt_nama_contact_person == '' ? null : $client_pt_nama_contact_person;
		$client_pt_telepon_contact_person = $client_pt_telepon_contact_person == '' ? null : $client_pt_telepon_contact_person;
		$client_pt_email_contact_person = $client_pt_email_contact_person == '' ? null : $client_pt_email_contact_person;
		$client_pt_keterangan = $client_pt_keterangan == '' ? null : $client_pt_keterangan;
		$kelas_jalan_id = $kelas_jalan_id == '' ? null : $kelas_jalan_id;
		$area_id = $area_id == '' ? null : $area_id;
		$client_pt_corporate_id = $client_pt_corporate_id == '' ? null : $client_pt_corporate_id;
		$client_pt_top = $client_pt_top == '' ? null : $client_pt_top;
		$client_pt_kredit_limit = $client_pt_kredit_limit == '' ? null : $client_pt_kredit_limit;
		$client_pt_acc = $client_pt_acc == '' ? null : $client_pt_acc;
		$client_pt_titik_antar_id = $client_pt_titik_antar_id == '' ? null : $client_pt_titik_antar_id;
		$client_pt_segmen_id1 = $client_pt_segmen_id1 == '' ? null : $client_pt_segmen_id1;
		$client_pt_segmen_id2 = $client_pt_segmen_id2 == '' ? null : $client_pt_segmen_id2;
		$client_pt_segmen_id3 = $client_pt_segmen_id3 == '' ? null : $client_pt_segmen_id3;
		$unit_mandiri_id = $unit_mandiri_id == '' ? null : $unit_mandiri_id;
		$client_pt_is_deleted = $client_pt_is_deleted == '' ? null : $client_pt_is_deleted;
		$client_pt_is_aktif = $client_pt_is_aktif == '' ? null : $client_pt_is_aktif;
		$client_pt_is_multi_lokasi = $client_pt_is_multi_lokasi == '' ? null : $client_pt_is_multi_lokasi;
		$lokasi_outlet_id = $lokasi_outlet_id == '' ? null : $lokasi_outlet_id;
		$kelas_jalan2_id = $kelas_jalan2_id == '' ? null : $kelas_jalan2_id;
		$client_pt_fax = $client_pt_fax == '' ? null : $client_pt_fax;
		$client_pt_npwp = $client_pt_npwp == '' ? null : $client_pt_npwp;
		$client_pt_status_pkp = $client_pt_status_pkp == '' ? null : $client_pt_status_pkp;
		$eksternal_id = $eksternal_id == '' ? null : $eksternal_id;

		$backend->set('client_pt_id', $client_pt_id);
		$backend->set('client_pt_nama', $client_pt_nama);
		$backend->set('client_pt_alamat', $client_pt_alamat);
		$backend->set('client_pt_telepon', $client_pt_telepon);
		$backend->set('client_pt_propinsi', $client_pt_propinsi);
		$backend->set('client_pt_kota', $client_pt_kota);
		$backend->set('client_pt_kecamatan', $client_pt_kecamatan);
		$backend->set('client_pt_kelurahan', $client_pt_kelurahan);
		$backend->set('client_pt_kodepos', $client_pt_kodepos);
		$backend->set('client_pt_latitude', $client_pt_latitude);
		$backend->set('client_pt_longitude', $client_pt_longitude);
		$backend->set('client_pt_nama_contact_person', $client_pt_nama_contact_person);
		$backend->set('client_pt_telepon_contact_person', $client_pt_telepon_contact_person);
		$backend->set('client_pt_email_contact_person', $client_pt_email_contact_person);
		$backend->set('client_pt_keterangan', $client_pt_keterangan);
		$backend->set('kelas_jalan_id', $kelas_jalan_id);
		$backend->set('area_id', $area_id);
		$backend->set('client_pt_corporate_id', $client_pt_corporate_id);
		$backend->set('client_pt_top', $client_pt_top);
		$backend->set('client_pt_kredit_limit', $client_pt_kredit_limit);
		$backend->set('client_pt_acc', $client_pt_acc);
		$backend->set('client_pt_titik_antar_id', $client_pt_titik_antar_id);
		$backend->set('client_pt_segmen_id1', $client_pt_segmen_id1);
		$backend->set('client_pt_segmen_id2', $client_pt_segmen_id2);
		$backend->set('client_pt_segmen_id3', $client_pt_segmen_id3);
		$backend->set('unit_mandiri_id', $unit_mandiri_id);
		$backend->set('client_pt_is_deleted', $client_pt_is_deleted);
		$backend->set('client_pt_is_aktif', $client_pt_is_aktif);
		$backend->set('client_pt_is_multi_lokasi', $client_pt_is_multi_lokasi);
		$backend->set('lokasi_outlet_id', $lokasi_outlet_id);
		$backend->set('kelas_jalan2_id', $kelas_jalan2_id);
		$backend->set('client_pt_fax', $client_pt_fax);
		$backend->set('client_pt_npwp', $client_pt_npwp);
		$backend->set('client_pt_status_pkp', $client_pt_status_pkp);
		$backend->set('eksternal_id', $eksternal_id);

		$backend->insert('client_pt');

		$affectedrows = $backend->affected_rows();

		if ($affectedrows > 0) {
			$queryinsert = 1;
		} else {
			$queryinsert = 0;
		}

		return $queryinsert;
		// return $backend->last_query();
	}

	public function proses_maping_so_eksternal_to_so_fas($tgl, $depo_id, $sistem_eksternal, $tipe_sales_order_id, $tipe_delivery_order_id, $pengguna_username)
	{
		$query = $this->db->query("exec proses_maping_so_eksternal_to_so_fas '$tgl', '$depo_id', '$sistem_eksternal', '$tipe_sales_order_id', '$tipe_delivery_order_id', '$pengguna_username'");

		if ($query->num_rows() == 0) {
			$query = array();
		} else {
			$query = $query->result_array();
		}

		return $query;
	}

	public function get_client_pt_principle_by_id($client_pt_id, $principle_id)
	{
		$query = $this->db->query("select client_pt_principle_id from BACKEND.dbo.client_pt_principle WHERE client_pt_id = '$client_pt_id' AND principle_id = '$principle_id'");

		if ($query->num_rows() == 0) {
			$query = "";
		} else {
			$query = $query->row(0)->client_pt_principle_id;
		}

		return $query;
	}

	public function cek_client_pt_principle_alamat($client_pt_principle_id)
	{
		$query = $this->db->query("SELECT * FROM BACKEND.dbo.client_pt_principle_alamat WHERE client_pt_principle_id = '$client_pt_principle_id'");

		if ($query->num_rows() == 0) {
			$query = 0;
		} else {
			$query = $query->num_rows();
		}

		return $query;
	}
}
