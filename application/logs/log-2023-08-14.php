<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2023-08-14 04:38:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:04 --> Total execution time: 0.4693
DEBUG - 2023-08-14 04:38:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:05 --> Total execution time: 0.3255
DEBUG - 2023-08-14 04:38:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:05 --> Total execution time: 0.0718
DEBUG - 2023-08-14 04:38:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:08 --> Session class already loaded. Second attempt ignored.
DEBUG - 2023-08-14 04:38:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:08 --> Total execution time: 0.3029
DEBUG - 2023-08-14 04:38:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:09 --> Total execution time: 0.1534
DEBUG - 2023-08-14 04:38:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:11 --> Total execution time: 0.0823
DEBUG - 2023-08-14 04:38:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:13 --> Total execution time: 0.0518
DEBUG - 2023-08-14 04:38:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:13 --> Total execution time: 0.0565
DEBUG - 2023-08-14 04:38:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:15 --> Total execution time: 0.0516
DEBUG - 2023-08-14 04:38:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:16 --> Total execution time: 0.3982
DEBUG - 2023-08-14 04:38:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:16 --> Total execution time: 0.0479
DEBUG - 2023-08-14 04:38:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:38:19 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										sum(sod.sku_harga_nett) as sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									INNER JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '2023-08-01' AND '2023-08-31'
									
									
									
									
									
									
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC
ERROR - 2023-08-14 04:38:19 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 684
DEBUG - 2023-08-14 04:38:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:38:22 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 283
ERROR - 2023-08-14 04:38:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 283
ERROR - 2023-08-14 04:38:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 362
ERROR - 2023-08-14 04:38:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 362
ERROR - 2023-08-14 04:38:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 450
ERROR - 2023-08-14 04:38:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 450
DEBUG - 2023-08-14 04:38:22 --> Total execution time: 0.4147
DEBUG - 2023-08-14 04:38:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:22 --> Total execution time: 0.0489
DEBUG - 2023-08-14 04:38:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:38 --> Total execution time: 0.0547
DEBUG - 2023-08-14 04:38:38 --> Total execution time: 0.0840
DEBUG - 2023-08-14 04:38:38 --> Total execution time: 0.0932
DEBUG - 2023-08-14 04:38:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:46 --> Total execution time: 0.0501
DEBUG - 2023-08-14 04:38:46 --> Total execution time: 0.0701
DEBUG - 2023-08-14 04:38:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:38:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:38:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:38:47 --> Total execution time: 0.0516
DEBUG - 2023-08-14 04:38:47 --> Total execution time: 0.0611
DEBUG - 2023-08-14 04:39:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:00 --> Total execution time: 0.0682
DEBUG - 2023-08-14 04:39:00 --> Total execution time: 0.0798
DEBUG - 2023-08-14 04:39:00 --> Total execution time: 0.0909
DEBUG - 2023-08-14 04:39:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:09 --> Total execution time: 0.2980
DEBUG - 2023-08-14 04:39:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:09 --> Total execution time: 0.0482
DEBUG - 2023-08-14 04:39:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:39:10 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										sum(sod.sku_harga_nett) as sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									INNER JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '2023-08-01' AND '2023-08-31'
									
									
									
									
									
									
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC
ERROR - 2023-08-14 04:39:10 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 684
DEBUG - 2023-08-14 04:39:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:39:16 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										sum(sod.sku_harga_nett) as sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									INNER JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '2023-08-01' AND '2023-08-31'
									
									
									
									
									
									
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC
ERROR - 2023-08-14 04:39:16 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 684
DEBUG - 2023-08-14 04:39:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:21 --> Total execution time: 0.1606
DEBUG - 2023-08-14 04:39:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:34 --> Total execution time: 0.1781
DEBUG - 2023-08-14 04:39:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:46 --> Total execution time: 0.0757
DEBUG - 2023-08-14 04:39:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:39:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:39:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:39:56 --> Total execution time: 0.0940
DEBUG - 2023-08-14 04:40:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:00 --> Total execution time: 0.0499
DEBUG - 2023-08-14 04:40:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:40:00 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 551
DEBUG - 2023-08-14 04:40:00 --> Total execution time: 0.3846
DEBUG - 2023-08-14 04:40:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:01 --> Total execution time: 0.0609
DEBUG - 2023-08-14 04:40:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:04 --> Total execution time: 0.0469
DEBUG - 2023-08-14 04:40:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:04 --> Total execution time: 0.0522
DEBUG - 2023-08-14 04:40:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:28 --> Total execution time: 0.0427
DEBUG - 2023-08-14 04:40:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:40:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:40:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:40:28 --> Total execution time: 0.0420
DEBUG - 2023-08-14 04:48:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-14 04:48:16 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 551
DEBUG - 2023-08-14 04:48:16 --> Total execution time: 0.3417
DEBUG - 2023-08-14 04:48:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:48:16 --> Total execution time: 0.0569
DEBUG - 2023-08-14 04:48:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:48:22 --> Total execution time: 0.3446
DEBUG - 2023-08-14 04:48:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:48:22 --> Total execution time: 0.0512
DEBUG - 2023-08-14 04:48:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:48:30 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,'') sales_order_no_po,
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_create,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_exp,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_sj,'dd-MM-yyyy') AS sales_order_tgl,
										--FORMAT(so.sales_order_tgl_harga,'dd-MM-yyyy') AS sales_order_tgl,
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy') AS sales_order_tgl_kirim,
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd') AS sales_order_tgl_kirim2,
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										sum(sod.sku_harga_nett) as sku_harga_nett,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,'') sales_order_keterangan,
										ISNULL(bs.szCustId,'') as  kode_customer_eksternal,
										ISNULL(bs.szSalesId,'') as  kode_sales,
										sales_order_tgl_update as tglUpdate,
										ISNULL(principle.principle_kode, '') as principle_kode,
										so.sales_order_keterangan
									FROM sales_order so
									LEFT JOIN client_pt cust
									ON cust.client_pt_id = so.client_pt_id
									LEFT JOIN tipe_sales_order tipe
									ON tipe.tipe_sales_order_id = so.tipe_sales_order_id
									LEFT JOIN principle
									ON principle.principle_id = so.principle_id
									INNER JOIN bosnet_so bs
									ON so.sales_order_no_po = bs.szFSoId
									LEFT JOIN karyawan k
									ON so.sales_id = k.karyawan_id
									LEFT JOIN sales_order_detail sod
									ON so.sales_order_id = sod.sales_order_id
									LEFT JOIN client_wms pt
									ON so.client_wms_id = pt.client_wms_id
									WHERE FORMAT(so.sales_order_tgl,'yyyy-MM-dd') BETWEEN '2023-08-01' AND '2023-08-31'
									
									
									
									
									
									
									
									GROUP BY
										so.sales_order_id,
										so.sales_order_kode,
										ISNULL(so.sales_order_no_po,''),
										FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'dd-MM-yyyy'),
										FORMAT(so.sales_order_tgl_kirim,'yyyy-MM-dd'),
										so.client_pt_id,
										cust.client_pt_nama,
										cust.client_pt_alamat,
										so.tipe_sales_order_id,
										tipe.tipe_sales_order_nama,
										so.sales_order_status,
										k.karyawan_nama,
										pt.client_wms_nama,
										ISNULL(so.sales_order_keterangan,''),
										ISNULL(bs.szCustId,''),
										ISNULL(bs.szSalesId,''),
										sales_order_tgl_update,
										ISNULL(principle.principle_kode, ''),
										so.sales_order_keterangan
									ORDER BY FORMAT(so.sales_order_tgl,'dd-MM-yyyy'),so.sales_order_kode ASC
ERROR - 2023-08-14 04:48:30 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 691
DEBUG - 2023-08-14 04:48:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 04:48:43 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 283
ERROR - 2023-08-14 04:48:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 283
ERROR - 2023-08-14 04:48:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 362
ERROR - 2023-08-14 04:48:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 362
ERROR - 2023-08-14 04:48:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 450
ERROR - 2023-08-14 04:48:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 450
DEBUG - 2023-08-14 04:48:43 --> Total execution time: 0.3437
DEBUG - 2023-08-14 04:48:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 04:48:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 04:48:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 04:48:44 --> Total execution time: 0.0547
DEBUG - 2023-08-14 05:34:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:34:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:34:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 05:34:10 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:34:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:34:10 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:34:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:34:10 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 05:34:10 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 05:34:10 --> Total execution time: 0.3572
DEBUG - 2023-08-14 05:34:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:34:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:34:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:34:10 --> Total execution time: 0.0495
DEBUG - 2023-08-14 05:46:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:46:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:46:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 05:46:14 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:46:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:46:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:46:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:46:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 05:46:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 05:46:14 --> Total execution time: 0.3356
DEBUG - 2023-08-14 05:46:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:46:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:46:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:46:15 --> Total execution time: 0.0618
DEBUG - 2023-08-14 05:49:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:49:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:49:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 05:49:36 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:49:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:49:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:49:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:49:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 05:49:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 05:49:36 --> Total execution time: 0.3253
DEBUG - 2023-08-14 05:49:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:49:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:49:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:49:37 --> Total execution time: 0.0575
DEBUG - 2023-08-14 05:49:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:49:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:49:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:49:46 --> Total execution time: 0.1795
DEBUG - 2023-08-14 05:50:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:50:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:50:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 05:50:21 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:50:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 05:50:21 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:50:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 05:50:21 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 05:50:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 05:50:21 --> Total execution time: 0.3993
DEBUG - 2023-08-14 05:50:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:50:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:50:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:50:22 --> Total execution time: 0.0728
DEBUG - 2023-08-14 05:50:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:50:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:50:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:50:26 --> Total execution time: 0.1270
DEBUG - 2023-08-14 05:50:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:50:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:50:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:50:57 --> Total execution time: 0.2032
DEBUG - 2023-08-14 05:50:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:50:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:50:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:50:59 --> Total execution time: 0.1186
DEBUG - 2023-08-14 05:51:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:07 --> Total execution time: 0.0708
DEBUG - 2023-08-14 05:51:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:12 --> Total execution time: 0.1011
DEBUG - 2023-08-14 05:51:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:19 --> Total execution time: 0.0455
DEBUG - 2023-08-14 05:51:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:19 --> Total execution time: 0.0480
DEBUG - 2023-08-14 05:51:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:23 --> Total execution time: 0.0463
DEBUG - 2023-08-14 05:51:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:23 --> Total execution time: 0.0477
DEBUG - 2023-08-14 05:51:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:26 --> Total execution time: 0.0655
DEBUG - 2023-08-14 05:51:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:51:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:51:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:51:26 --> Total execution time: 0.0742
DEBUG - 2023-08-14 05:53:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:53:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:53:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:53:02 --> Total execution time: 0.0515
DEBUG - 2023-08-14 05:53:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:53:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:53:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:53:02 --> Total execution time: 0.0428
DEBUG - 2023-08-14 05:53:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:53:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:53:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:53:05 --> Total execution time: 0.0588
DEBUG - 2023-08-14 05:54:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 05:54:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 05:54:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 05:54:47 --> Total execution time: 0.0766
DEBUG - 2023-08-14 06:12:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:12:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:12:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:12:49 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:12:49 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:12:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:12:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:12:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:12:49 --> Total execution time: 0.0498
DEBUG - 2023-08-14 06:25:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:25:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:25:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:25:33 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:25:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:25:33 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:25:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:25:33 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:25:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:25:33 --> Total execution time: 0.4765
DEBUG - 2023-08-14 06:25:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:25:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:25:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:25:33 --> Total execution time: 0.0470
DEBUG - 2023-08-14 06:25:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:25:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:25:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:25:35 --> Total execution time: 0.1140
DEBUG - 2023-08-14 06:25:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:25:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:25:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:25:39 --> Total execution time: 0.0641
DEBUG - 2023-08-14 06:25:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:25:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:25:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:36:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:36:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:36:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:36:15 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:36:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:36:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:36:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:36:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:36:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:36:15 --> Total execution time: 0.3628
DEBUG - 2023-08-14 06:36:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:36:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:36:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:36:16 --> Total execution time: 0.0927
DEBUG - 2023-08-14 06:38:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:38:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:38:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:38:39 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:38:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:38:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:38:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:38:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:38:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:38:39 --> Total execution time: 0.3114
DEBUG - 2023-08-14 06:38:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:38:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:38:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:38:39 --> Total execution time: 0.0528
DEBUG - 2023-08-14 06:39:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:39:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:39:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:39:14 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:39:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:39:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:39:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:39:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:39:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:39:14 --> Total execution time: 0.3357
DEBUG - 2023-08-14 06:39:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:39:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:39:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:39:15 --> Total execution time: 0.0528
DEBUG - 2023-08-14 06:39:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:39:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:39:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:39:23 --> Total execution time: 0.2641
DEBUG - 2023-08-14 06:39:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:39:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:39:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:39:28 --> Total execution time: 0.0522
DEBUG - 2023-08-14 06:40:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:40:18 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:40:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:40:18 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:40:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:40:18 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:40:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:40:19 --> Total execution time: 0.3320
DEBUG - 2023-08-14 06:40:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:40:19 --> Total execution time: 0.0650
DEBUG - 2023-08-14 06:40:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:40:22 --> Total execution time: 0.2229
DEBUG - 2023-08-14 06:40:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:40:27 --> Total execution time: 0.1544
DEBUG - 2023-08-14 06:40:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:40:29 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:40:29 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:40:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:40:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:40:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:40:29 --> Total execution time: 0.0471
DEBUG - 2023-08-14 06:41:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:41:00 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:41:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:41:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:41:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:41:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:41:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:41:00 --> Total execution time: 0.3274
DEBUG - 2023-08-14 06:41:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:41:01 --> Total execution time: 0.0635
DEBUG - 2023-08-14 06:41:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:41:03 --> Total execution time: 0.1692
DEBUG - 2023-08-14 06:41:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:41:09 --> Total execution time: 0.0603
DEBUG - 2023-08-14 06:41:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:41:11 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:41:11 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:41:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:41:11 --> Total execution time: 0.0426
DEBUG - 2023-08-14 06:41:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:41:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:41:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:41:19 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:41:19 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:42:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:42:15 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:42:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 06:42:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:42:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 06:42:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 06:42:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 06:42:15 --> Total execution time: 0.3880
DEBUG - 2023-08-14 06:42:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:42:15 --> Total execution time: 0.0772
DEBUG - 2023-08-14 06:42:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:42:21 --> Total execution time: 0.1378
DEBUG - 2023-08-14 06:42:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:42:26 --> Total execution time: 0.0538
DEBUG - 2023-08-14 06:42:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:42:29 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:42:29 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:42:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:42:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:42:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 06:42:32 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Column 'sku.principle_id' is invalid in the select list because it is not contained in either an aggregate function or the GROUP BY clause. - Invalid query: SELECT
									sku.principle_id,
									sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual,
									SUM(ISNULL(so.sku_qty,0)) AS sku_qty_so
									FROM sku_stock
									LEFT JOIN sales_order_detail_2_temp so
									ON sku_stock.sku_stock_id = so.sku_stock_id
									LEFT JOIN sku
									ON sku.sku_id = sku_stock.sku_id
									WHERE sku_stock.sku_id = '22607EEB-C219-4520-8656-9374BB8AEBD5'
									GROUP BY sku_stock.sku_id,
									sku.sku_kode,
									sku.sku_nama_produk,
									sku.sku_kemasan,
									sku.sku_satuan,
									sku.sku_harga_jual
ERROR - 2023-08-14 06:42:32 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 974
DEBUG - 2023-08-14 06:43:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:43:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:43:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:43:18 --> Total execution time: 0.0602
DEBUG - 2023-08-14 06:43:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 06:43:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 06:43:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 06:43:27 --> Total execution time: 0.0458
DEBUG - 2023-08-14 08:43:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:43:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:43:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:43:01 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:43:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:43:01 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:43:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:43:01 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:43:01 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:43:01 --> Total execution time: 0.3322
DEBUG - 2023-08-14 08:43:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:43:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:43:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:43:02 --> Total execution time: 0.0669
DEBUG - 2023-08-14 08:46:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:46:00 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:46:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:46:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:46:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:46:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:46:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:46:00 --> Total execution time: 0.3102
DEBUG - 2023-08-14 08:46:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:01 --> Total execution time: 0.0679
DEBUG - 2023-08-14 08:46:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:06 --> Total execution time: 0.1346
DEBUG - 2023-08-14 08:46:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:11 --> Total execution time: 0.0610
DEBUG - 2023-08-14 08:46:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:15 --> Total execution time: 0.0420
DEBUG - 2023-08-14 08:46:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:46:42 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:46:42 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:46:42 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:46:42 --> Total execution time: 0.2932
DEBUG - 2023-08-14 08:46:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:43 --> Total execution time: 0.0865
DEBUG - 2023-08-14 08:46:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:46 --> Total execution time: 0.1231
DEBUG - 2023-08-14 08:46:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:50 --> Total execution time: 0.0555
DEBUG - 2023-08-14 08:46:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:53 --> Total execution time: 0.0689
DEBUG - 2023-08-14 08:46:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:46:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:46:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:46:53 --> Total execution time: 0.0676
DEBUG - 2023-08-14 08:47:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:47:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:47:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:47:05 --> Total execution time: 0.0475
DEBUG - 2023-08-14 08:47:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:47:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:47:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:47:57 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:47:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:47:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:47:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:47:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:47:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:47:57 --> Total execution time: 0.2854
DEBUG - 2023-08-14 08:47:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:47:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:47:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:47:58 --> Total execution time: 0.0611
DEBUG - 2023-08-14 08:48:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:48:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:48:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:48:02 --> Total execution time: 0.1381
DEBUG - 2023-08-14 08:48:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:48:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:48:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:48:06 --> Total execution time: 0.0570
DEBUG - 2023-08-14 08:48:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:48:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:48:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:48:09 --> Total execution time: 0.0486
DEBUG - 2023-08-14 08:48:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:48:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:48:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:48:54 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:48:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:48:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:48:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:48:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:48:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:48:54 --> Total execution time: 0.3067
DEBUG - 2023-08-14 08:48:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:48:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:48:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:48:55 --> Total execution time: 0.0553
DEBUG - 2023-08-14 08:49:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:49:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:49:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:49:24 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:49:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:49:24 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:49:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:49:24 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:49:24 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:49:24 --> Total execution time: 0.3128
DEBUG - 2023-08-14 08:49:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:49:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:49:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:49:24 --> Total execution time: 0.0591
DEBUG - 2023-08-14 08:49:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:49:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:49:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:49:30 --> Total execution time: 0.1167
DEBUG - 2023-08-14 08:49:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:49:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:49:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:49:34 --> Total execution time: 0.0570
DEBUG - 2023-08-14 08:49:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:49:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:49:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:49:36 --> Total execution time: 0.0493
DEBUG - 2023-08-14 08:55:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:55:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:55:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:55:19 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:55:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:55:19 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:55:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:55:19 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:55:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:55:19 --> Total execution time: 0.2409
DEBUG - 2023-08-14 08:55:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:55:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:55:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:55:19 --> Total execution time: 0.0493
DEBUG - 2023-08-14 08:57:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:57:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:57:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 08:57:41 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:57:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 08:57:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:57:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 08:57:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 08:57:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 08:57:41 --> Total execution time: 0.3435
DEBUG - 2023-08-14 08:57:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:57:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:57:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:57:42 --> Total execution time: 0.0605
DEBUG - 2023-08-14 08:57:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:57:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:57:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:57:48 --> Total execution time: 0.1314
DEBUG - 2023-08-14 08:57:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:57:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:57:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:57:53 --> Total execution time: 0.0678
DEBUG - 2023-08-14 08:58:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 08:58:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 08:58:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 08:58:04 --> Total execution time: 0.0421
DEBUG - 2023-08-14 09:15:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:15:25 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:15:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:15:25 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:15:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:15:25 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:15:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:15:25 --> Total execution time: 0.3043
DEBUG - 2023-08-14 09:15:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:15:25 --> Total execution time: 0.0529
DEBUG - 2023-08-14 09:15:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:15:30 --> Total execution time: 0.1144
DEBUG - 2023-08-14 09:15:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:15:34 --> Total execution time: 0.0626
DEBUG - 2023-08-14 09:15:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:15:38 --> Total execution time: 0.0419
DEBUG - 2023-08-14 09:15:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:15:46 --> Total execution time: 0.0426
DEBUG - 2023-08-14 09:15:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:15:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:15:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:16:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:16:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:16:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:16:26 --> Total execution time: 0.0520
DEBUG - 2023-08-14 09:17:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:17:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:17:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:17:03 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:17:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:17:03 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:17:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:17:03 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:17:03 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:17:03 --> Total execution time: 0.3004
DEBUG - 2023-08-14 09:17:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:17:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:17:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:17:04 --> Total execution time: 0.0514
DEBUG - 2023-08-14 09:17:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:17:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:17:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:17:11 --> Total execution time: 0.1323
DEBUG - 2023-08-14 09:17:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:17:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:17:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:17:15 --> Total execution time: 0.0536
DEBUG - 2023-08-14 09:17:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:17:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:17:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:17:17 --> Total execution time: 0.0414
DEBUG - 2023-08-14 09:18:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:18:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:18:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:18:58 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:18:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:18:58 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:18:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:18:58 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:18:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:18:58 --> Total execution time: 0.2991
DEBUG - 2023-08-14 09:18:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:18:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:18:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:18:59 --> Total execution time: 0.0584
DEBUG - 2023-08-14 09:19:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:19:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:19:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:19:36 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:19:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:19:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:19:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:19:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:19:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:19:36 --> Total execution time: 0.2740
DEBUG - 2023-08-14 09:19:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:19:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:19:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:19:36 --> Total execution time: 0.0589
DEBUG - 2023-08-14 09:19:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:19:41 --> Total execution time: 0.1158
DEBUG - 2023-08-14 09:19:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:19:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:19:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:19:46 --> Total execution time: 0.0585
DEBUG - 2023-08-14 09:19:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:19:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:19:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:19:47 --> Total execution time: 0.0403
DEBUG - 2023-08-14 09:20:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:20:11 --> Total execution time: 0.0447
DEBUG - 2023-08-14 09:20:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:20:17 --> Total execution time: 0.0505
DEBUG - 2023-08-14 09:20:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:20:49 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:20:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:20:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:20:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:20:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:20:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:20:49 --> Total execution time: 0.2908
DEBUG - 2023-08-14 09:20:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:20:50 --> Total execution time: 0.0522
DEBUG - 2023-08-14 09:20:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:20:55 --> Total execution time: 0.1129
DEBUG - 2023-08-14 09:20:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:20:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:20:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:20:59 --> Total execution time: 0.0649
DEBUG - 2023-08-14 09:21:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:21:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:21:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:21:00 --> Total execution time: 0.0417
DEBUG - 2023-08-14 09:22:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:22:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:22:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:22:45 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:22:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:22:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:22:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:22:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:22:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:22:45 --> Total execution time: 0.2955
DEBUG - 2023-08-14 09:22:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:22:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:22:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:22:46 --> Total execution time: 0.0518
DEBUG - 2023-08-14 09:22:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:22:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:22:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:22:52 --> Total execution time: 0.1417
DEBUG - 2023-08-14 09:22:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:22:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:22:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:22:56 --> Total execution time: 0.0548
DEBUG - 2023-08-14 09:22:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:22:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:22:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:22:58 --> Total execution time: 0.0420
DEBUG - 2023-08-14 09:23:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:23:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:23:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:23:10 --> Total execution time: 0.0423
DEBUG - 2023-08-14 09:23:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:23:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:23:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:23:39 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:23:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:23:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:23:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:23:39 --> Total execution time: 0.2797
DEBUG - 2023-08-14 09:23:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:23:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:23:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:23:39 --> Total execution time: 0.0655
DEBUG - 2023-08-14 09:24:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:08 --> Total execution time: 0.1273
DEBUG - 2023-08-14 09:24:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:12 --> Total execution time: 0.0571
DEBUG - 2023-08-14 09:24:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:13 --> Total execution time: 0.0423
DEBUG - 2023-08-14 09:24:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:24:49 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:24:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:24:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:24:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:24:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:24:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:24:49 --> Total execution time: 0.3212
DEBUG - 2023-08-14 09:24:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:50 --> Total execution time: 0.0633
DEBUG - 2023-08-14 09:24:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:24:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:24:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:56 --> Total execution time: 0.0898
DEBUG - 2023-08-14 09:24:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:24:56 --> Total execution time: 0.1706
DEBUG - 2023-08-14 09:24:56 --> Total execution time: 0.4452
DEBUG - 2023-08-14 09:25:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:11 --> Total execution time: 0.0616
DEBUG - 2023-08-14 09:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:14 --> Total execution time: 0.0510
DEBUG - 2023-08-14 09:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:14 --> Total execution time: 0.1050
DEBUG - 2023-08-14 09:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:14 --> Total execution time: 0.1257
DEBUG - 2023-08-14 09:25:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:20 --> Total execution time: 0.0516
DEBUG - 2023-08-14 09:25:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:22 --> Total execution time: 0.0406
DEBUG - 2023-08-14 09:25:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:25:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:25:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:25:29 --> Total execution time: 0.0417
DEBUG - 2023-08-14 09:26:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:26:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:26:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:26:58 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:26:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:26:58 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:26:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:26:58 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:26:58 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:26:58 --> Total execution time: 0.2876
DEBUG - 2023-08-14 09:26:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:26:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:26:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:26:59 --> Total execution time: 0.0637
DEBUG - 2023-08-14 09:27:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:27:04 --> Total execution time: 0.1379
DEBUG - 2023-08-14 09:27:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:27:10 --> Total execution time: 0.0543
DEBUG - 2023-08-14 09:27:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:27:11 --> Total execution time: 0.0417
DEBUG - 2023-08-14 09:27:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:27:53 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:27:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:27:53 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:27:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:27:53 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:27:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:27:53 --> Total execution time: 0.3100
DEBUG - 2023-08-14 09:27:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:27:54 --> Total execution time: 0.0635
DEBUG - 2023-08-14 09:27:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:27:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:27:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:27:59 --> Total execution time: 0.1250
DEBUG - 2023-08-14 09:28:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:28:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:28:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:28:03 --> Total execution time: 0.0576
DEBUG - 2023-08-14 09:28:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:28:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:28:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:28:05 --> Total execution time: 0.0409
DEBUG - 2023-08-14 09:28:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:28:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:28:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:28:25 --> Total execution time: 0.0464
DEBUG - 2023-08-14 09:36:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:36:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:36:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:36:57 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:36:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:36:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:36:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:36:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:36:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:36:57 --> Total execution time: 0.2974
DEBUG - 2023-08-14 09:36:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:36:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:36:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:36:58 --> Total execution time: 0.0600
DEBUG - 2023-08-14 09:37:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:37:03 --> Total execution time: 0.1226
DEBUG - 2023-08-14 09:37:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:37:12 --> Total execution time: 0.0549
DEBUG - 2023-08-14 09:37:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:37:16 --> Total execution time: 0.0431
DEBUG - 2023-08-14 09:37:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:18 --> Global POST, GET and COOKIE data sanitized
ERROR - 2023-08-14 09:37:18 --> 404 Page Not Found: WMS/SalesOrder
DEBUG - 2023-08-14 09:37:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:25 --> Global POST, GET and COOKIE data sanitized
ERROR - 2023-08-14 09:37:25 --> 404 Page Not Found: WMS/SalesOrder
DEBUG - 2023-08-14 09:37:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:37:49 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:37:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:37:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:37:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:37:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:37:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:37:49 --> Total execution time: 0.2836
DEBUG - 2023-08-14 09:37:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:37:49 --> Total execution time: 0.0685
DEBUG - 2023-08-14 09:37:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:37:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:37:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:37:58 --> Total execution time: 0.1496
DEBUG - 2023-08-14 09:38:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:38:04 --> Total execution time: 0.0559
DEBUG - 2023-08-14 09:38:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:38:07 --> Total execution time: 0.0419
DEBUG - 2023-08-14 09:38:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:38:09 --> Severity: error --> Exception: Call to undefined method M_SalesOrder::get_so_detail2_sementara() C:\xampp\htdocs\padmakriya_fas\application\controllers\FAS\SalesOrder.php 1048
DEBUG - 2023-08-14 09:38:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:38:12 --> Severity: error --> Exception: Call to undefined method M_SalesOrder::get_so_detail2_sementara() C:\xampp\htdocs\padmakriya_fas\application\controllers\FAS\SalesOrder.php 1048
DEBUG - 2023-08-14 09:38:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:38:24 --> Total execution time: 0.0458
DEBUG - 2023-08-14 09:38:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:38:54 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:38:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:38:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:38:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:38:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:38:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:38:54 --> Total execution time: 0.3500
DEBUG - 2023-08-14 09:38:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:38:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:38:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:38:55 --> Total execution time: 0.0558
DEBUG - 2023-08-14 09:39:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:00 --> Total execution time: 0.1133
DEBUG - 2023-08-14 09:39:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:08 --> Total execution time: 0.0559
DEBUG - 2023-08-14 09:39:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:10 --> Total execution time: 0.0431
DEBUG - 2023-08-14 09:39:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:12 --> Total execution time: 0.0436
DEBUG - 2023-08-14 09:39:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:16 --> Total execution time: 0.0436
DEBUG - 2023-08-14 09:39:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:18 --> Total execution time: 0.0422
DEBUG - 2023-08-14 09:39:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:22 --> Total execution time: 0.0442
DEBUG - 2023-08-14 09:39:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:22 --> Total execution time: 0.0429
DEBUG - 2023-08-14 09:39:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:25 --> Total execution time: 0.0490
DEBUG - 2023-08-14 09:39:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:28 --> Total execution time: 0.0665
DEBUG - 2023-08-14 09:39:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:31 --> Total execution time: 0.0435
DEBUG - 2023-08-14 09:39:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:34 --> Total execution time: 0.0481
DEBUG - 2023-08-14 09:39:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:34 --> Total execution time: 0.0527
DEBUG - 2023-08-14 09:39:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:37 --> Total execution time: 0.0426
DEBUG - 2023-08-14 09:39:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:38 --> Total execution time: 0.0459
DEBUG - 2023-08-14 09:39:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:41 --> Total execution time: 0.0412
DEBUG - 2023-08-14 09:39:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:41 --> Total execution time: 0.0422
DEBUG - 2023-08-14 09:39:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:43 --> Total execution time: 0.0435
DEBUG - 2023-08-14 09:39:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:46 --> Total execution time: 0.0443
DEBUG - 2023-08-14 09:39:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:52 --> Total execution time: 0.0432
DEBUG - 2023-08-14 09:39:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:56 --> Total execution time: 0.0516
DEBUG - 2023-08-14 09:39:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:56 --> Total execution time: 0.0625
DEBUG - 2023-08-14 09:39:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:39:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:39:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:39:59 --> Total execution time: 0.0440
DEBUG - 2023-08-14 09:40:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:40:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:40:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:40:01 --> Total execution time: 0.0444
DEBUG - 2023-08-14 09:40:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:40:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:40:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:40:04 --> Total execution time: 0.0466
DEBUG - 2023-08-14 09:40:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:40:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:40:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:40:05 --> Total execution time: 0.0456
DEBUG - 2023-08-14 09:40:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:40:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:40:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:40:08 --> Total execution time: 0.0667
DEBUG - 2023-08-14 09:40:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:40:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:40:11 --> Total execution time: 0.0424
DEBUG - 2023-08-14 09:43:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:43:35 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:43:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:43:35 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:43:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:43:35 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:43:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:43:35 --> Total execution time: 0.3096
DEBUG - 2023-08-14 09:43:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:35 --> Total execution time: 0.0656
DEBUG - 2023-08-14 09:43:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:40 --> Total execution time: 0.1102
DEBUG - 2023-08-14 09:43:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:44 --> Total execution time: 0.0707
DEBUG - 2023-08-14 09:43:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:45 --> Total execution time: 0.0451
DEBUG - 2023-08-14 09:43:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:46 --> Total execution time: 0.0415
DEBUG - 2023-08-14 09:43:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:49 --> Total execution time: 0.0497
DEBUG - 2023-08-14 09:43:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:43:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:43:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:43:51 --> Total execution time: 0.0411
DEBUG - 2023-08-14 09:44:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:44:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:44:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:44:58 --> Total execution time: 0.0442
DEBUG - 2023-08-14 09:44:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:44:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:44:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:44:58 --> Total execution time: 0.0496
DEBUG - 2023-08-14 09:59:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:59:29 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 09:59:29 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 09:59:29 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 09:59:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 09:59:29 --> Total execution time: 0.3496
DEBUG - 2023-08-14 09:59:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:29 --> Total execution time: 0.0511
DEBUG - 2023-08-14 09:59:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:38 --> Total execution time: 0.0501
DEBUG - 2023-08-14 09:59:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:38 --> Total execution time: 0.0798
DEBUG - 2023-08-14 09:59:38 --> Total execution time: 0.0772
DEBUG - 2023-08-14 09:59:38 --> Total execution time: 0.1460
DEBUG - 2023-08-14 09:59:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:46 --> Total execution time: 0.0510
DEBUG - 2023-08-14 09:59:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 09:59:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 09:59:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 09:59:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 09:59:47 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server][SQL Server]Conversion failed when converting from a character string to uniqueidentifier. - Invalid query: SELECT * FROM client_wms 
									WHERE client_wms_id IN (SELECT client_wms_id FROM karyawan_principle WHERE karyawan_id = '' GROUP BY client_wms_id)
									ORDER BY client_wms_nama ASC
ERROR - 2023-08-14 09:59:47 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 240
DEBUG - 2023-08-14 09:59:47 --> Total execution time: 0.1368
DEBUG - 2023-08-14 10:00:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:00:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:00:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:00:57 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:00:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:00:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:00:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:00:57 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 10:00:57 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 10:00:57 --> Total execution time: 0.3713
DEBUG - 2023-08-14 10:00:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:00:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:00:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:00:57 --> Total execution time: 0.0576
DEBUG - 2023-08-14 10:03:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:36 --> Total execution time: 0.0557
DEBUG - 2023-08-14 10:03:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:36 --> Total execution time: 0.0651
DEBUG - 2023-08-14 10:03:36 --> Total execution time: 0.0620
DEBUG - 2023-08-14 10:03:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:03:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:03:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:03:39 --> Total execution time: 0.0641
DEBUG - 2023-08-14 10:03:39 --> Total execution time: 0.0726
DEBUG - 2023-08-14 10:03:39 --> Total execution time: 0.0764
DEBUG - 2023-08-14 10:04:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:04:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:04:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:05:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:05:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:05:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:05:37 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:05:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:05:37 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:05:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:05:37 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 10:05:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 10:05:37 --> Total execution time: 0.4087
DEBUG - 2023-08-14 10:05:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:05:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:05:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:05:37 --> Total execution time: 0.0553
DEBUG - 2023-08-14 10:06:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:06 --> Total execution time: 0.0515
DEBUG - 2023-08-14 10:06:06 --> Total execution time: 0.0504
DEBUG - 2023-08-14 10:06:06 --> Total execution time: 0.0715
DEBUG - 2023-08-14 10:06:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:19 --> Total execution time: 0.1281
DEBUG - 2023-08-14 10:06:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:06:28 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:06:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:06:28 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:06:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:06:28 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
ERROR - 2023-08-14 10:06:28 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 368
DEBUG - 2023-08-14 10:06:28 --> Total execution time: 0.3101
DEBUG - 2023-08-14 10:06:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:28 --> Total execution time: 0.0555
DEBUG - 2023-08-14 10:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:32 --> Total execution time: 0.0533
DEBUG - 2023-08-14 10:06:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:32 --> Total execution time: 0.0853
DEBUG - 2023-08-14 10:06:32 --> Total execution time: 0.1489
DEBUG - 2023-08-14 10:06:32 --> Total execution time: 0.1579
DEBUG - 2023-08-14 10:06:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:37 --> Total execution time: 0.0480
DEBUG - 2023-08-14 10:06:38 --> Total execution time: 0.0688
DEBUG - 2023-08-14 10:06:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:38 --> Total execution time: 0.1012
DEBUG - 2023-08-14 10:06:38 --> Total execution time: 0.1033
DEBUG - 2023-08-14 10:06:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:06:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:06:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:06:40 --> Total execution time: 0.1517
DEBUG - 2023-08-14 10:10:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:10:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:10:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:10:19 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:10:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:10:19 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:10:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:10:19 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 371
ERROR - 2023-08-14 10:10:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 371
DEBUG - 2023-08-14 10:10:19 --> Total execution time: 0.3357
DEBUG - 2023-08-14 10:10:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:10:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:10:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:10:19 --> Total execution time: 0.0671
DEBUG - 2023-08-14 10:14:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:14:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:14:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:14:16 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:14:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:14:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:14:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:14:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:14:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:14:16 --> Total execution time: 0.3172
DEBUG - 2023-08-14 10:14:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:14:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:14:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:14:17 --> Total execution time: 0.0678
DEBUG - 2023-08-14 10:14:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:14:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:14:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:14:36 --> Total execution time: 0.1167
DEBUG - 2023-08-14 10:15:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:15:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:15:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:15:14 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:15:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:15:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:15:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:15:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:15:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:15:14 --> Total execution time: 0.2969
DEBUG - 2023-08-14 10:15:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:15:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:15:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:15:14 --> Total execution time: 0.0534
DEBUG - 2023-08-14 10:15:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:15:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:15:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:15:18 --> Total execution time: 0.1323
DEBUG - 2023-08-14 10:16:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:09 --> Total execution time: 0.0582
DEBUG - 2023-08-14 10:16:09 --> Total execution time: 0.0761
DEBUG - 2023-08-14 10:16:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:09 --> Total execution time: 0.0999
DEBUG - 2023-08-14 10:16:09 --> Total execution time: 0.1099
DEBUG - 2023-08-14 10:16:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:21 --> Total execution time: 0.0651
DEBUG - 2023-08-14 10:16:21 --> Total execution time: 0.0753
DEBUG - 2023-08-14 10:16:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:21 --> Total execution time: 0.1064
DEBUG - 2023-08-14 10:16:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:22 --> Total execution time: 0.1141
DEBUG - 2023-08-14 10:16:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:29 --> Total execution time: 0.0615
DEBUG - 2023-08-14 10:16:29 --> Total execution time: 0.0721
DEBUG - 2023-08-14 10:16:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:29 --> Total execution time: 0.1210
DEBUG - 2023-08-14 10:16:29 --> Total execution time: 0.1237
DEBUG - 2023-08-14 10:16:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:16:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:16:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:16:34 --> Total execution time: 0.0575
DEBUG - 2023-08-14 10:17:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:30 --> Total execution time: 0.0570
DEBUG - 2023-08-14 10:17:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:30 --> Total execution time: 0.0776
DEBUG - 2023-08-14 10:17:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:30 --> Total execution time: 0.1103
DEBUG - 2023-08-14 10:17:30 --> Total execution time: 0.1184
DEBUG - 2023-08-14 10:17:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:36 --> Total execution time: 0.0700
DEBUG - 2023-08-14 10:17:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:36 --> Total execution time: 0.0778
DEBUG - 2023-08-14 10:17:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:17:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:17:36 --> Total execution time: 0.1295
DEBUG - 2023-08-14 10:17:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:17:36 --> Total execution time: 0.1541
DEBUG - 2023-08-14 10:19:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:19:15 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:19:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:19:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:19:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:19:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:19:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:19:15 --> Total execution time: 0.3240
DEBUG - 2023-08-14 10:19:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:15 --> Total execution time: 0.0483
DEBUG - 2023-08-14 10:19:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:17 --> Total execution time: 0.0579
DEBUG - 2023-08-14 10:19:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:21 --> Total execution time: 0.0527
DEBUG - 2023-08-14 10:19:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:29 --> Total execution time: 0.0621
DEBUG - 2023-08-14 10:19:29 --> Total execution time: 0.1255
DEBUG - 2023-08-14 10:19:29 --> Total execution time: 0.1989
DEBUG - 2023-08-14 10:19:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:31 --> Total execution time: 0.0460
DEBUG - 2023-08-14 10:19:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:31 --> Total execution time: 0.1136
DEBUG - 2023-08-14 10:19:31 --> Total execution time: 0.1181
DEBUG - 2023-08-14 10:19:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:34 --> Total execution time: 0.0501
DEBUG - 2023-08-14 10:19:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:34 --> Total execution time: 0.1623
DEBUG - 2023-08-14 10:19:35 --> Total execution time: 0.1856
DEBUG - 2023-08-14 10:19:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:37 --> Total execution time: 0.0481
DEBUG - 2023-08-14 10:19:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:37 --> Total execution time: 0.1136
DEBUG - 2023-08-14 10:19:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:37 --> Total execution time: 0.1601
DEBUG - 2023-08-14 10:19:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:44 --> Total execution time: 0.0480
DEBUG - 2023-08-14 10:19:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:44 --> Total execution time: 0.1113
DEBUG - 2023-08-14 10:19:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:44 --> Total execution time: 0.1303
DEBUG - 2023-08-14 10:19:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:47 --> Total execution time: 0.0784
DEBUG - 2023-08-14 10:19:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:19:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:19:47 --> Total execution time: 0.1210
DEBUG - 2023-08-14 10:19:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:19:48 --> Total execution time: 0.1489
DEBUG - 2023-08-14 10:20:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:02 --> Total execution time: 0.0517
DEBUG - 2023-08-14 10:20:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:20:02 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									
									
									
									
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-14 10:20:02 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 530
DEBUG - 2023-08-14 10:20:02 --> Total execution time: 0.1215
DEBUG - 2023-08-14 10:20:02 --> Total execution time: 0.1358
DEBUG - 2023-08-14 10:20:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:20:04 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									
									
									
									
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-14 10:20:04 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 530
DEBUG - 2023-08-14 10:20:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:20:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:20:53 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt_id IS NOT NULL
									
									
									
									
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-14 10:20:53 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 531
DEBUG - 2023-08-14 10:20:53 --> Total execution time: 0.1375
DEBUG - 2023-08-14 10:20:53 --> Total execution time: 0.0801
DEBUG - 2023-08-14 10:20:53 --> Total execution time: 0.1666
DEBUG - 2023-08-14 10:21:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:21:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:21:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:21:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:21:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:21:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:21:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:21:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:21:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:21:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:21:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:21:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:21:10 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id IS NOT NULL
									
									
									
									
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-14 10:21:10 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 531
DEBUG - 2023-08-14 10:21:10 --> Total execution time: 0.1354
DEBUG - 2023-08-14 10:21:10 --> Total execution time: 0.1416
DEBUG - 2023-08-14 10:21:10 --> Total execution time: 0.1519
DEBUG - 2023-08-14 10:23:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:49 --> Total execution time: 0.0768
DEBUG - 2023-08-14 10:23:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:49 --> Total execution time: 0.0874
DEBUG - 2023-08-14 10:23:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:49 --> Total execution time: 0.1795
DEBUG - 2023-08-14 10:23:49 --> Total execution time: 0.1811
DEBUG - 2023-08-14 10:23:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:54 --> Total execution time: 0.0609
DEBUG - 2023-08-14 10:23:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:55 --> Total execution time: 0.0550
DEBUG - 2023-08-14 10:23:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:23:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:23:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:23:55 --> Total execution time: 0.1195
DEBUG - 2023-08-14 10:24:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:09 --> Total execution time: 0.0677
DEBUG - 2023-08-14 10:24:09 --> Total execution time: 0.0789
DEBUG - 2023-08-14 10:24:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:09 --> Total execution time: 0.1470
DEBUG - 2023-08-14 10:24:09 --> Total execution time: 0.1535
DEBUG - 2023-08-14 10:24:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:12 --> Total execution time: 0.0713
DEBUG - 2023-08-14 10:24:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:13 --> Total execution time: 0.0580
DEBUG - 2023-08-14 10:24:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:14 --> Total execution time: 0.1333
DEBUG - 2023-08-14 10:24:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:24:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:24:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:24:29 --> Total execution time: 0.0535
DEBUG - 2023-08-14 10:25:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:07 --> Total execution time: 0.0558
DEBUG - 2023-08-14 10:25:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:07 --> Total execution time: 0.0903
DEBUG - 2023-08-14 10:25:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:07 --> Total execution time: 0.1107
DEBUG - 2023-08-14 10:25:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:07 --> Total execution time: 0.1259
DEBUG - 2023-08-14 10:25:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:40 --> Total execution time: 0.0570
DEBUG - 2023-08-14 10:25:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:42 --> Total execution time: 0.0497
DEBUG - 2023-08-14 10:25:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:42 --> Total execution time: 0.1155
DEBUG - 2023-08-14 10:25:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:48 --> Total execution time: 0.1196
DEBUG - 2023-08-14 10:25:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:57 --> Total execution time: 0.0577
DEBUG - 2023-08-14 10:25:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:25:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:25:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:25:59 --> Total execution time: 0.0428
DEBUG - 2023-08-14 10:26:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:26:13 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:26:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:26:13 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:26:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:26:13 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:26:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:26:13 --> Total execution time: 0.3375
DEBUG - 2023-08-14 10:26:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:14 --> Total execution time: 0.0636
DEBUG - 2023-08-14 10:26:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:35 --> Total execution time: 0.1192
DEBUG - 2023-08-14 10:26:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:40 --> Total execution time: 0.0586
DEBUG - 2023-08-14 10:26:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:43 --> Total execution time: 0.0634
DEBUG - 2023-08-14 10:26:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:43 --> Total execution time: 0.1273
DEBUG - 2023-08-14 10:26:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:44 --> Total execution time: 0.1532
DEBUG - 2023-08-14 10:26:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:47 --> Total execution time: 0.0495
DEBUG - 2023-08-14 10:26:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:48 --> Total execution time: 0.1349
DEBUG - 2023-08-14 10:26:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:48 --> Total execution time: 0.1500
DEBUG - 2023-08-14 10:26:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:55 --> Total execution time: 0.0500
DEBUG - 2023-08-14 10:26:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:56 --> Total execution time: 0.1285
DEBUG - 2023-08-14 10:26:56 --> Total execution time: 0.1279
DEBUG - 2023-08-14 10:26:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:59 --> Total execution time: 0.0646
DEBUG - 2023-08-14 10:26:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:26:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:26:59 --> Total execution time: 0.1452
DEBUG - 2023-08-14 10:26:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:26:59 --> Total execution time: 0.1366
DEBUG - 2023-08-14 10:27:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:03 --> Total execution time: 0.0601
DEBUG - 2023-08-14 10:27:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:03 --> Total execution time: 0.1443
DEBUG - 2023-08-14 10:27:03 --> Total execution time: 0.1532
DEBUG - 2023-08-14 10:27:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:10 --> Total execution time: 0.0537
DEBUG - 2023-08-14 10:27:10 --> Total execution time: 0.0830
DEBUG - 2023-08-14 10:27:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:10 --> Total execution time: 0.1103
DEBUG - 2023-08-14 10:27:10 --> Total execution time: 0.1202
DEBUG - 2023-08-14 10:27:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:14 --> Total execution time: 0.0504
DEBUG - 2023-08-14 10:27:14 --> Total execution time: 0.0845
DEBUG - 2023-08-14 10:27:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:14 --> Total execution time: 0.1091
DEBUG - 2023-08-14 10:27:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:14 --> Total execution time: 0.1424
DEBUG - 2023-08-14 10:27:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:19 --> Total execution time: 0.0479
DEBUG - 2023-08-14 10:27:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:20 --> Total execution time: 0.0587
DEBUG - 2023-08-14 10:27:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:20 --> Total execution time: 0.1187
DEBUG - 2023-08-14 10:27:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:23 --> Total execution time: 0.1388
DEBUG - 2023-08-14 10:27:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:28 --> Total execution time: 0.0475
DEBUG - 2023-08-14 10:27:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:30 --> Total execution time: 0.0455
DEBUG - 2023-08-14 10:27:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:27:45 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:27:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:27:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:27:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:27:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:27:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:27:45 --> Total execution time: 0.3553
DEBUG - 2023-08-14 10:27:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:46 --> Total execution time: 0.0847
DEBUG - 2023-08-14 10:27:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:27:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:27:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:27:55 --> Total execution time: 0.1325
DEBUG - 2023-08-14 10:28:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:28:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:28:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:28:02 --> Total execution time: 0.0751
DEBUG - 2023-08-14 10:28:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:28:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:28:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:28:04 --> Total execution time: 0.0492
DEBUG - 2023-08-14 10:48:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:48:14 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:48:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:48:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:48:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:48:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:48:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:48:14 --> Total execution time: 0.3475
DEBUG - 2023-08-14 10:48:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:14 --> Total execution time: 0.0595
DEBUG - 2023-08-14 10:48:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:24 --> Total execution time: 0.1263
DEBUG - 2023-08-14 10:48:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:30 --> Total execution time: 0.0594
DEBUG - 2023-08-14 10:48:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:36 --> Total execution time: 0.0510
DEBUG - 2023-08-14 10:48:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:48:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:48:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:48:51 --> Total execution time: 0.0518
DEBUG - 2023-08-14 10:49:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:49:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:49:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:49:27 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:49:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:49:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:49:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:49:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:49:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:49:27 --> Total execution time: 0.3425
DEBUG - 2023-08-14 10:49:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:49:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:49:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:49:27 --> Total execution time: 0.0670
DEBUG - 2023-08-14 10:49:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:49:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:49:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 10:49:55 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:49:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 10:49:55 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:49:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 10:49:55 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 10:49:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 10:49:55 --> Total execution time: 0.3250
DEBUG - 2023-08-14 10:49:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:49:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:49:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:49:55 --> Total execution time: 0.0497
DEBUG - 2023-08-14 10:50:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:50:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:50:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:50:01 --> Total execution time: 0.1317
DEBUG - 2023-08-14 10:50:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 10:50:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 10:50:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 10:50:06 --> Total execution time: 0.1380
DEBUG - 2023-08-14 11:05:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 11:05:15 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 11:05:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 11:05:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 11:05:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 11:05:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 11:05:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 11:05:15 --> Total execution time: 0.3540
DEBUG - 2023-08-14 11:05:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 11:05:15 --> Total execution time: 0.0597
DEBUG - 2023-08-14 11:05:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 11:05:23 --> Total execution time: 0.1309
DEBUG - 2023-08-14 11:05:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 11:05:26 --> Total execution time: 0.1756
DEBUG - 2023-08-14 11:05:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-14 11:05:29 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 11:05:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-14 11:05:29 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 11:05:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-14 11:05:29 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-14 11:05:29 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-14 11:05:29 --> Total execution time: 0.3503
DEBUG - 2023-08-14 11:05:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 11:05:30 --> Total execution time: 0.0666
DEBUG - 2023-08-14 11:05:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-14 11:05:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-14 11:05:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-14 11:05:34 --> Total execution time: 0.1254
