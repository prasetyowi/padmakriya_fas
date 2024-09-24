<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

DEBUG - 2023-08-15 03:23:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:23:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:23:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:16 --> Total execution time: 0.0513
DEBUG - 2023-08-15 03:24:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:16 --> Total execution time: 0.2964
DEBUG - 2023-08-15 03:24:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:17 --> Total execution time: 0.0606
DEBUG - 2023-08-15 03:24:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:19 --> Session class already loaded. Second attempt ignored.
DEBUG - 2023-08-15 03:24:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:19 --> Total execution time: 0.2229
DEBUG - 2023-08-15 03:24:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:20 --> Total execution time: 0.1359
DEBUG - 2023-08-15 03:24:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:24 --> Total execution time: 0.0797
DEBUG - 2023-08-15 03:24:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:24 --> Total execution time: 0.0694
DEBUG - 2023-08-15 03:24:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:25 --> Total execution time: 0.0589
DEBUG - 2023-08-15 03:24:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:26 --> Total execution time: 0.3372
DEBUG - 2023-08-15 03:24:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:24:27 --> Total execution time: 0.0450
DEBUG - 2023-08-15 03:24:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:24:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:24:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:24:49 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
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
ERROR - 2023-08-15 03:24:49 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 713
DEBUG - 2023-08-15 03:25:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:25:09 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:25:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:25:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-15 03:25:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-15 03:25:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-15 03:25:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-15 03:25:09 --> Total execution time: 0.2686
DEBUG - 2023-08-15 03:25:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:25:09 --> Total execution time: 0.0526
DEBUG - 2023-08-15 03:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:25:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:25:14 --> Total execution time: 0.0571
DEBUG - 2023-08-15 03:25:14 --> Total execution time: 0.0859
DEBUG - 2023-08-15 03:25:14 --> Total execution time: 0.0788
DEBUG - 2023-08-15 03:25:14 --> Total execution time: 0.1467
DEBUG - 2023-08-15 03:26:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:26:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:26:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:26:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:26:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:26:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:26:03 --> Total execution time: 0.0688
DEBUG - 2023-08-15 03:26:03 --> Total execution time: 0.0792
DEBUG - 2023-08-15 03:26:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:26:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:26:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:26:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:26:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:26:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:26:03 --> Total execution time: 0.1121
DEBUG - 2023-08-15 03:26:03 --> Total execution time: 0.1362
DEBUG - 2023-08-15 03:28:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:28:22 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:28:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:28:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-15 03:28:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 292
ERROR - 2023-08-15 03:28:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
ERROR - 2023-08-15 03:28:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 370
DEBUG - 2023-08-15 03:28:22 --> Total execution time: 0.3282
DEBUG - 2023-08-15 03:28:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:22 --> Total execution time: 0.0558
DEBUG - 2023-08-15 03:28:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:25 --> Total execution time: 0.0554
DEBUG - 2023-08-15 03:28:25 --> Total execution time: 0.0686
DEBUG - 2023-08-15 03:28:25 --> Total execution time: 0.0972
DEBUG - 2023-08-15 03:28:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:26 --> Total execution time: 0.0485
DEBUG - 2023-08-15 03:28:26 --> Total execution time: 0.0755
DEBUG - 2023-08-15 03:28:26 --> Total execution time: 0.0860
DEBUG - 2023-08-15 03:28:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:28 --> Total execution time: 0.0473
DEBUG - 2023-08-15 03:28:28 --> Total execution time: 0.0777
DEBUG - 2023-08-15 03:28:28 --> Total execution time: 0.0843
DEBUG - 2023-08-15 03:28:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:29 --> Total execution time: 0.0563
DEBUG - 2023-08-15 03:28:29 --> Total execution time: 0.0902
DEBUG - 2023-08-15 03:28:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:36 --> Total execution time: 0.0480
DEBUG - 2023-08-15 03:28:36 --> Total execution time: 0.0793
DEBUG - 2023-08-15 03:28:36 --> Total execution time: 0.0885
DEBUG - 2023-08-15 03:28:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:46 --> Total execution time: 0.0733
DEBUG - 2023-08-15 03:28:46 --> Total execution time: 0.0820
DEBUG - 2023-08-15 03:28:46 --> Total execution time: 0.0938
DEBUG - 2023-08-15 03:28:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:28:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:28:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:47 --> Total execution time: 0.0654
DEBUG - 2023-08-15 03:28:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:28:47 --> Total execution time: 0.0983
DEBUG - 2023-08-15 03:32:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:32:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:32:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:32:17 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:32:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:32:17 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:32:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:32:17 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 374
ERROR - 2023-08-15 03:32:17 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 374
DEBUG - 2023-08-15 03:32:17 --> Total execution time: 0.3731
DEBUG - 2023-08-15 03:32:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:32:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:32:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:32:17 --> Total execution time: 0.0657
DEBUG - 2023-08-15 03:32:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:32:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:32:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:32:18 --> Total execution time: 0.0566
DEBUG - 2023-08-15 03:35:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:35:21 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:35:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:35:21 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:35:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:35:21 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:35:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:35:21 --> Total execution time: 0.4212
DEBUG - 2023-08-15 03:35:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:35:22 --> Total execution time: 0.0473
DEBUG - 2023-08-15 03:35:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:35:39 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:35:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:35:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:35:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:35:39 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:35:39 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:35:39 --> Total execution time: 0.3200
DEBUG - 2023-08-15 03:35:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:35:39 --> Total execution time: 0.0474
DEBUG - 2023-08-15 03:35:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:35:40 --> Total execution time: 0.0646
DEBUG - 2023-08-15 03:35:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:35:44 --> Total execution time: 0.0531
DEBUG - 2023-08-15 03:35:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:35:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:35:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:35:46 --> Total execution time: 0.0538
DEBUG - 2023-08-15 03:36:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:36:43 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:36:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:36:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:36:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:36:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:36:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:36:43 --> Total execution time: 0.3621
DEBUG - 2023-08-15 03:36:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:43 --> Total execution time: 0.0497
DEBUG - 2023-08-15 03:36:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:45 --> Total execution time: 0.0741
DEBUG - 2023-08-15 03:36:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:49 --> Total execution time: 0.0617
DEBUG - 2023-08-15 03:36:49 --> Total execution time: 0.0748
DEBUG - 2023-08-15 03:36:49 --> Total execution time: 0.0878
DEBUG - 2023-08-15 03:36:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:50 --> Total execution time: 0.0696
DEBUG - 2023-08-15 03:36:50 --> Total execution time: 0.0823
DEBUG - 2023-08-15 03:36:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:53 --> Total execution time: 0.0513
DEBUG - 2023-08-15 03:36:53 --> Total execution time: 0.0785
DEBUG - 2023-08-15 03:36:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:36:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:36:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:36:57 --> Total execution time: 0.0674
DEBUG - 2023-08-15 03:36:57 --> Total execution time: 0.0759
DEBUG - 2023-08-15 03:40:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:40:07 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:40:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:40:07 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:40:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:40:07 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:40:07 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:40:07 --> Total execution time: 0.2823
DEBUG - 2023-08-15 03:40:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:07 --> Total execution time: 0.0447
DEBUG - 2023-08-15 03:40:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:10 --> Total execution time: 0.0591
DEBUG - 2023-08-15 03:40:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:10 --> Total execution time: 0.0887
DEBUG - 2023-08-15 03:40:10 --> Total execution time: 0.1012
DEBUG - 2023-08-15 03:40:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:11 --> Total execution time: 0.0539
DEBUG - 2023-08-15 03:40:11 --> Total execution time: 0.0825
DEBUG - 2023-08-15 03:40:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:13 --> Total execution time: 0.0442
DEBUG - 2023-08-15 03:40:13 --> Total execution time: 0.0701
DEBUG - 2023-08-15 03:40:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:14 --> Total execution time: 0.0630
DEBUG - 2023-08-15 03:40:14 --> Total execution time: 0.0736
DEBUG - 2023-08-15 03:40:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:19 --> Total execution time: 0.0439
DEBUG - 2023-08-15 03:40:19 --> Total execution time: 0.0737
DEBUG - 2023-08-15 03:40:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:40:37 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:40:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:40:37 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:40:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:40:37 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:40:37 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:40:37 --> Total execution time: 1.9909
DEBUG - 2023-08-15 03:40:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:37 --> Total execution time: 0.0654
DEBUG - 2023-08-15 03:40:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:49 --> Total execution time: 0.0672
DEBUG - 2023-08-15 03:40:49 --> Total execution time: 0.0757
DEBUG - 2023-08-15 03:40:49 --> Total execution time: 0.0868
DEBUG - 2023-08-15 03:40:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:40:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:40:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:40:58 --> Total execution time: 0.0681
DEBUG - 2023-08-15 03:42:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:42:16 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:42:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:42:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:42:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:42:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:42:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:42:16 --> Total execution time: 0.3137
DEBUG - 2023-08-15 03:42:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:17 --> Total execution time: 0.0489
DEBUG - 2023-08-15 03:42:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:19 --> Total execution time: 0.0436
DEBUG - 2023-08-15 03:42:19 --> Total execution time: 0.0578
DEBUG - 2023-08-15 03:42:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:27 --> Total execution time: 0.0596
DEBUG - 2023-08-15 03:42:27 --> Total execution time: 0.0788
DEBUG - 2023-08-15 03:42:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:29 --> Total execution time: 0.0436
DEBUG - 2023-08-15 03:42:30 --> Total execution time: 0.0531
DEBUG - 2023-08-15 03:42:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:36 --> Total execution time: 0.0480
DEBUG - 2023-08-15 03:42:36 --> Total execution time: 0.0573
DEBUG - 2023-08-15 03:42:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:44 --> Total execution time: 0.0560
DEBUG - 2023-08-15 03:42:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:42:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:42:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:42:45 --> Total execution time: 0.0455
DEBUG - 2023-08-15 03:43:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:15 --> Total execution time: 0.0816
DEBUG - 2023-08-15 03:43:15 --> Total execution time: 0.0960
DEBUG - 2023-08-15 03:43:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:18 --> Total execution time: 0.0586
DEBUG - 2023-08-15 03:43:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:35 --> Total execution time: 0.0648
DEBUG - 2023-08-15 03:43:35 --> Total execution time: 0.0896
DEBUG - 2023-08-15 03:43:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:38 --> Total execution time: 0.0598
DEBUG - 2023-08-15 03:43:38 --> Total execution time: 0.0705
DEBUG - 2023-08-15 03:43:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:48 --> Total execution time: 0.0434
DEBUG - 2023-08-15 03:43:48 --> Total execution time: 0.0582
DEBUG - 2023-08-15 03:43:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:51 --> Total execution time: 0.0581
DEBUG - 2023-08-15 03:43:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:43:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:43:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:43:52 --> Total execution time: 0.0424
DEBUG - 2023-08-15 03:45:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:45:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:45:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:45:15 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:45:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:45:15 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:45:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:45:15 --> Total execution time: 0.2843
DEBUG - 2023-08-15 03:45:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:45:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:45:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:45:15 --> Total execution time: 0.0450
DEBUG - 2023-08-15 03:45:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:45:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:45:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:45:41 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:45:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:45:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:45:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:45:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:45:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:45:41 --> Total execution time: 0.3322
DEBUG - 2023-08-15 03:45:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:45:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:45:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:45:41 --> Total execution time: 0.0523
DEBUG - 2023-08-15 03:49:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:49:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:49:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:49:44 --> Severity: error --> Exception: Call to undefined method M_SalesOrder::Get_Principle() C:\xampp\htdocs\padmakriya_fas\application\controllers\FAS\SalesOrder.php 169
DEBUG - 2023-08-15 03:50:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:50:09 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:50:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:50:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:50:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:50:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:50:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:50:09 --> Total execution time: 0.3053
DEBUG - 2023-08-15 03:50:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:09 --> Total execution time: 0.0506
DEBUG - 2023-08-15 03:50:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:11 --> Total execution time: 0.0450
DEBUG - 2023-08-15 03:50:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:11 --> Total execution time: 0.0579
DEBUG - 2023-08-15 03:50:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:31 --> Total execution time: 0.0735
DEBUG - 2023-08-15 03:50:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:32 --> Total execution time: 0.0591
DEBUG - 2023-08-15 03:50:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:33 --> Total execution time: 0.0516
DEBUG - 2023-08-15 03:50:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:34 --> Total execution time: 0.0589
DEBUG - 2023-08-15 03:50:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:35 --> Total execution time: 0.0558
DEBUG - 2023-08-15 03:50:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:36 --> Total execution time: 0.0524
DEBUG - 2023-08-15 03:50:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:50:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:50:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:50:40 --> Total execution time: 0.0556
DEBUG - 2023-08-15 03:51:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:51:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:51:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:51:34 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:51:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:51:34 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:51:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:51:34 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:51:34 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:51:34 --> Total execution time: 0.3700
DEBUG - 2023-08-15 03:51:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:51:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:51:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:51:34 --> Total execution time: 0.0543
DEBUG - 2023-08-15 03:51:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:51:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:51:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:51:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:51:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:51:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:51:37 --> Total execution time: 0.0491
DEBUG - 2023-08-15 03:51:37 --> Total execution time: 0.0745
DEBUG - 2023-08-15 03:51:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:51:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:51:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:51:53 --> Total execution time: 0.0571
DEBUG - 2023-08-15 03:52:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:52:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:52:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:52:00 --> Total execution time: 0.0748
DEBUG - 2023-08-15 03:52:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:52:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:52:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:52:04 --> Total execution time: 0.0528
DEBUG - 2023-08-15 03:52:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:52:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:52:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:52:44 --> Total execution time: 0.0623
DEBUG - 2023-08-15 03:53:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:53:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:53:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:53:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:53:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:53:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:53:00 --> Total execution time: 0.0569
DEBUG - 2023-08-15 03:53:00 --> Total execution time: 0.0739
DEBUG - 2023-08-15 03:53:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:53:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:53:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:53:02 --> Total execution time: 0.0581
DEBUG - 2023-08-15 03:53:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:53:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:53:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:53:03 --> Total execution time: 0.0493
DEBUG - 2023-08-15 03:55:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:55:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:55:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:55:53 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:55:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:55:53 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:55:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:55:53 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:55:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:55:53 --> Total execution time: 0.3994
DEBUG - 2023-08-15 03:55:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:55:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:55:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:55:53 --> Total execution time: 0.0560
DEBUG - 2023-08-15 03:55:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:55:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:55:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:55:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:55:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:55:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:55:58 --> Total execution time: 0.0458
DEBUG - 2023-08-15 03:55:58 --> Total execution time: 0.0705
DEBUG - 2023-08-15 03:56:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:06 --> Total execution time: 0.0470
DEBUG - 2023-08-15 03:56:06 --> Total execution time: 0.0605
DEBUG - 2023-08-15 03:56:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:07 --> Total execution time: 0.0523
DEBUG - 2023-08-15 03:56:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:08 --> Total execution time: 0.0441
DEBUG - 2023-08-15 03:56:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:11 --> Total execution time: 0.1204
DEBUG - 2023-08-15 03:56:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:29 --> Total execution time: 0.1154
DEBUG - 2023-08-15 03:56:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:38 --> Total execution time: 0.0506
DEBUG - 2023-08-15 03:56:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:38 --> Total execution time: 0.0615
DEBUG - 2023-08-15 03:56:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:56:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:56:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:56:41 --> Total execution time: 0.0978
DEBUG - 2023-08-15 03:57:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:57:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:57:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:57:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:57:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:57:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:57:50 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:57:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:57:50 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:57:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:57:50 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:57:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:57:50 --> Total execution time: 0.3216
DEBUG - 2023-08-15 03:57:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:57:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:57:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:57:50 --> Total execution time: 0.0499
DEBUG - 2023-08-15 03:58:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:58:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:58:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:58:31 --> Total execution time: 0.0831
DEBUG - 2023-08-15 03:58:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:58:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:58:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:58:36 --> Total execution time: 0.0770
DEBUG - 2023-08-15 03:58:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:58:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:58:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:58:43 --> Total execution time: 0.0656
DEBUG - 2023-08-15 03:59:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:59:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:59:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:59:09 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:59:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:59:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:59:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:59:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:59:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:59:09 --> Total execution time: 0.2941
DEBUG - 2023-08-15 03:59:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:59:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:59:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:59:10 --> Total execution time: 0.0555
DEBUG - 2023-08-15 03:59:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:59:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:59:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:59:20 --> Total execution time: 0.1306
DEBUG - 2023-08-15 03:59:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:59:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:59:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 03:59:41 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:59:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 03:59:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:59:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 03:59:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 03:59:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 03:59:41 --> Total execution time: 0.2850
DEBUG - 2023-08-15 03:59:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 03:59:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 03:59:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 03:59:42 --> Total execution time: 0.0848
DEBUG - 2023-08-15 04:01:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:01:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:01:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:01:25 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:01:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:01:25 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:01:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:01:25 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:01:25 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:01:25 --> Total execution time: 0.3736
DEBUG - 2023-08-15 04:01:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:01:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:01:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:01:26 --> Total execution time: 0.0611
DEBUG - 2023-08-15 04:01:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:01:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:01:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:01:31 --> Total execution time: 0.1229
DEBUG - 2023-08-15 04:02:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:02:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:02:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:02:05 --> Total execution time: 0.1304
DEBUG - 2023-08-15 04:03:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:03:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:03:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:03:00 --> Total execution time: 0.1129
DEBUG - 2023-08-15 04:03:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:03:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:03:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:03:55 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:03:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:03:55 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:03:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:03:55 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:03:55 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:03:55 --> Total execution time: 0.4401
DEBUG - 2023-08-15 04:03:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:03:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:03:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:03:55 --> Total execution time: 0.0510
DEBUG - 2023-08-15 04:05:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:05:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:05:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:05:59 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:05:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:05:59 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:05:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:05:59 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:05:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:05:59 --> Total execution time: 0.3317
DEBUG - 2023-08-15 04:05:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:05:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:05:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:05:59 --> Total execution time: 0.0568
DEBUG - 2023-08-15 04:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:06:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:06:32 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:06:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:06:32 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:06:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:06:32 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:06:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:06:32 --> Total execution time: 0.3071
DEBUG - 2023-08-15 04:06:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:06:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:06:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:06:33 --> Total execution time: 0.0909
DEBUG - 2023-08-15 04:06:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:06:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:06:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:06:49 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:06:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:06:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:06:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:06:49 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:06:49 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:06:49 --> Total execution time: 0.3228
DEBUG - 2023-08-15 04:06:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:06:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:06:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:06:50 --> Total execution time: 0.0509
DEBUG - 2023-08-15 04:09:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:09:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:09:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:09:27 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:09:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:09:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:09:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:09:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:09:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:09:27 --> Total execution time: 0.3655
DEBUG - 2023-08-15 04:09:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:09:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:09:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:09:27 --> Total execution time: 0.0753
DEBUG - 2023-08-15 04:10:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:10:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:10:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:10:35 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:10:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:10:35 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:10:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:10:35 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:10:35 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:10:35 --> Total execution time: 0.3621
DEBUG - 2023-08-15 04:10:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:10:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:10:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:10:35 --> Total execution time: 0.0679
DEBUG - 2023-08-15 04:11:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:11:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:11:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:11:00 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:11:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:11:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:11:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:11:00 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:11:00 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:11:00 --> Total execution time: 0.3293
DEBUG - 2023-08-15 04:11:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:11:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:11:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:11:01 --> Total execution time: 0.0505
DEBUG - 2023-08-15 04:11:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:11:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:11:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:11:22 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:11:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:11:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:11:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:11:22 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:11:22 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:11:22 --> Total execution time: 0.3547
DEBUG - 2023-08-15 04:11:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:11:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:11:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:11:23 --> Total execution time: 0.0549
DEBUG - 2023-08-15 04:40:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:06 --> Total execution time: 0.5295
DEBUG - 2023-08-15 04:40:06 --> Total execution time: 0.5435
DEBUG - 2023-08-15 04:40:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:24 --> Total execution time: 0.0508
DEBUG - 2023-08-15 04:40:24 --> Total execution time: 0.0583
DEBUG - 2023-08-15 04:40:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:25 --> Total execution time: 0.0552
DEBUG - 2023-08-15 04:40:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:27 --> Total execution time: 0.0456
DEBUG - 2023-08-15 04:40:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:27 --> Total execution time: 0.1306
DEBUG - 2023-08-15 04:40:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:37 --> Total execution time: 0.0817
DEBUG - 2023-08-15 04:40:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:42 --> Total execution time: 0.0669
DEBUG - 2023-08-15 04:40:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:40:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:40:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:40:45 --> Total execution time: 0.0469
DEBUG - 2023-08-15 04:41:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:41:27 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:41:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:41:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:41:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:41:27 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:41:27 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:41:27 --> Total execution time: 0.4169
DEBUG - 2023-08-15 04:41:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:28 --> Total execution time: 0.0621
DEBUG - 2023-08-15 04:41:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:36 --> Total execution time: 0.1237
DEBUG - 2023-08-15 04:41:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:47 --> Total execution time: 0.0897
DEBUG - 2023-08-15 04:41:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:51 --> Total execution time: 0.0624
DEBUG - 2023-08-15 04:41:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:53 --> Total execution time: 0.0580
DEBUG - 2023-08-15 04:41:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:41:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:41:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:41:58 --> Total execution time: 0.0642
DEBUG - 2023-08-15 04:44:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:44:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:44:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:44:59 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:44:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:44:59 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:44:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:44:59 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:44:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:44:59 --> Total execution time: 0.3770
DEBUG - 2023-08-15 04:45:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:00 --> Total execution time: 0.0651
DEBUG - 2023-08-15 04:45:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:05 --> Total execution time: 0.1228
DEBUG - 2023-08-15 04:45:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:12 --> Total execution time: 0.0740
DEBUG - 2023-08-15 04:45:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:17 --> Total execution time: 0.0750
DEBUG - 2023-08-15 04:45:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:45:33 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:45:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:45:33 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:45:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:45:33 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:45:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:45:33 --> Total execution time: 0.4030
DEBUG - 2023-08-15 04:45:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:34 --> Total execution time: 0.0672
DEBUG - 2023-08-15 04:45:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:48 --> Total execution time: 0.0739
DEBUG - 2023-08-15 04:45:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:45:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:45:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:45:52 --> Total execution time: 0.0684
DEBUG - 2023-08-15 04:47:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:47:32 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:47:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:47:32 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:47:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:47:32 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:47:32 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:47:32 --> Total execution time: 0.3242
DEBUG - 2023-08-15 04:47:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:47:33 --> Total execution time: 0.0707
DEBUG - 2023-08-15 04:47:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:47:42 --> Total execution time: 0.1310
DEBUG - 2023-08-15 04:47:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:47:47 --> Total execution time: 0.0650
DEBUG - 2023-08-15 04:47:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:47:50 --> Total execution time: 0.0602
DEBUG - 2023-08-15 04:47:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:47:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:47:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:47:51 --> Total execution time: 0.0435
DEBUG - 2023-08-15 04:48:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:48:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:48:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:48:16 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:48:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:48:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:48:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:48:16 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:48:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:48:17 --> Total execution time: 0.3262
DEBUG - 2023-08-15 04:48:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:48:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:48:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:48:17 --> Total execution time: 0.0613
DEBUG - 2023-08-15 04:48:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:48:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:48:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:48:26 --> Total execution time: 0.1309
DEBUG - 2023-08-15 04:48:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:48:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:48:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:48:34 --> Total execution time: 0.0680
DEBUG - 2023-08-15 04:48:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:48:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:48:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:48:35 --> Total execution time: 0.0466
DEBUG - 2023-08-15 04:49:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:49:05 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:49:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:49:05 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:49:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:49:05 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:49:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:49:05 --> Total execution time: 0.3459
DEBUG - 2023-08-15 04:49:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:49:06 --> Total execution time: 0.0637
DEBUG - 2023-08-15 04:49:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:49:20 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:49:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:49:20 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:49:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:49:20 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:49:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:49:20 --> Total execution time: 0.3605
DEBUG - 2023-08-15 04:49:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:49:21 --> Total execution time: 0.0514
DEBUG - 2023-08-15 04:49:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:49:25 --> Total execution time: 0.1240
DEBUG - 2023-08-15 04:49:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:49:30 --> Total execution time: 0.0654
DEBUG - 2023-08-15 04:49:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:49:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:49:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:49:35 --> Total execution time: 0.0646
DEBUG - 2023-08-15 04:50:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:50:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:50:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:50:13 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:50:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:50:13 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:50:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:50:13 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:50:13 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:50:13 --> Total execution time: 0.3935
DEBUG - 2023-08-15 04:50:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:50:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:50:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:50:14 --> Total execution time: 0.0468
DEBUG - 2023-08-15 04:51:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:51:14 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:51:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:51:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:51:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:51:14 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:51:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:51:14 --> Total execution time: 0.3492
DEBUG - 2023-08-15 04:51:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:51:14 --> Total execution time: 0.0519
DEBUG - 2023-08-15 04:51:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:51:24 --> Total execution time: 0.1346
DEBUG - 2023-08-15 04:51:30 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:30 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:30 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:51:30 --> Total execution time: 0.0818
DEBUG - 2023-08-15 04:51:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:51:34 --> Total execution time: 0.0587
DEBUG - 2023-08-15 04:51:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:51:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:51:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:51:35 --> Total execution time: 0.0487
DEBUG - 2023-08-15 04:52:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:52:02 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:52:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:52:02 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:52:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:52:02 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:52:02 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:52:02 --> Total execution time: 0.3203
DEBUG - 2023-08-15 04:52:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:52:03 --> Total execution time: 0.0503
DEBUG - 2023-08-15 04:52:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:52:08 --> Total execution time: 0.1243
DEBUG - 2023-08-15 04:52:12 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:12 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:12 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:52:12 --> Total execution time: 0.0584
DEBUG - 2023-08-15 04:52:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:52:13 --> Total execution time: 0.0436
DEBUG - 2023-08-15 04:52:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 04:52:54 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:52:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 04:52:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:52:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 04:52:54 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 04:52:54 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 04:52:54 --> Total execution time: 0.3496
DEBUG - 2023-08-15 04:52:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:52:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:52:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:52:54 --> Total execution time: 0.0570
DEBUG - 2023-08-15 04:53:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:05 --> Total execution time: 0.1305
DEBUG - 2023-08-15 04:53:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:15 --> Total execution time: 0.0839
DEBUG - 2023-08-15 04:53:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:18 --> Total execution time: 0.0716
DEBUG - 2023-08-15 04:53:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:20 --> Total execution time: 0.0447
DEBUG - 2023-08-15 04:53:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:22 --> Total execution time: 0.0556
DEBUG - 2023-08-15 04:53:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:25 --> Total execution time: 0.0569
DEBUG - 2023-08-15 04:53:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:28 --> Total execution time: 0.0428
DEBUG - 2023-08-15 04:53:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:39 --> Total execution time: 0.0463
DEBUG - 2023-08-15 04:53:39 --> Total execution time: 0.0567
DEBUG - 2023-08-15 04:53:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:54 --> Total execution time: 0.0429
DEBUG - 2023-08-15 04:53:54 --> Total execution time: 0.0592
DEBUG - 2023-08-15 04:53:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:55 --> Total execution time: 0.0543
DEBUG - 2023-08-15 04:53:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:53:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:53:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:53:57 --> Total execution time: 0.0438
DEBUG - 2023-08-15 04:54:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:54:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:54:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:54:02 --> Total execution time: 0.0625
DEBUG - 2023-08-15 04:54:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:54:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:54:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:54:05 --> Total execution time: 0.0480
DEBUG - 2023-08-15 04:54:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:54:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:54:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:54:07 --> Total execution time: 0.1033
DEBUG - 2023-08-15 04:54:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:54:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:54:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:54:07 --> Total execution time: 0.0438
DEBUG - 2023-08-15 04:55:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:55:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:55:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:55:24 --> Total execution time: 0.0490
DEBUG - 2023-08-15 04:55:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 04:55:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 04:55:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 04:55:24 --> Total execution time: 0.0423
DEBUG - 2023-08-15 05:03:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:03:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:03:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:03:45 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:03:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:03:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:03:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:03:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:03:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:03:45 --> Total execution time: 0.3494
DEBUG - 2023-08-15 05:03:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:03:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:03:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:03:46 --> Total execution time: 0.0558
DEBUG - 2023-08-15 05:03:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:03:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:03:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:03:54 --> Total execution time: 0.1326
DEBUG - 2023-08-15 05:04:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:04:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:04:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:04:00 --> Total execution time: 0.0750
DEBUG - 2023-08-15 05:04:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:04:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:04:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:04:04 --> Total execution time: 0.0569
DEBUG - 2023-08-15 05:04:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:04:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:04:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:04:05 --> Total execution time: 0.0434
DEBUG - 2023-08-15 05:04:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:04:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:04:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:04:07 --> Total execution time: 0.0484
DEBUG - 2023-08-15 05:05:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:05:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:05:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:05:41 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:05:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:05:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:05:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:05:41 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:05:41 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:05:41 --> Total execution time: 0.3917
DEBUG - 2023-08-15 05:05:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:05:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:05:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:05:42 --> Total execution time: 0.0618
DEBUG - 2023-08-15 05:08:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:08:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:08:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:08:05 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:08:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:08:05 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:08:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:08:05 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:08:05 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:08:05 --> Total execution time: 0.3480
DEBUG - 2023-08-15 05:08:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:08:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:08:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:08:06 --> Total execution time: 0.0564
DEBUG - 2023-08-15 05:08:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:08:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:08:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:08:12 --> Total execution time: 0.1585
DEBUG - 2023-08-15 05:29:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:29:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:29:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:29:45 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:29:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:29:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:29:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:29:45 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:29:45 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:29:45 --> Total execution time: 0.2751
DEBUG - 2023-08-15 05:29:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:29:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:29:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:29:45 --> Total execution time: 0.0619
DEBUG - 2023-08-15 05:39:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:39:08 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:39:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:39:08 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:39:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:39:08 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:39:08 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:39:08 --> Total execution time: 0.2867
DEBUG - 2023-08-15 05:39:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:09 --> Total execution time: 0.0945
DEBUG - 2023-08-15 05:39:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:14 --> Total execution time: 0.0436
DEBUG - 2023-08-15 05:39:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:14 --> Total execution time: 0.0577
DEBUG - 2023-08-15 05:39:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:39 --> Total execution time: 0.0509
DEBUG - 2023-08-15 05:39:39 --> Total execution time: 0.0617
DEBUG - 2023-08-15 05:39:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:40 --> Total execution time: 0.0493
DEBUG - 2023-08-15 05:39:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:41 --> Total execution time: 0.0491
DEBUG - 2023-08-15 05:39:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:43 --> Total execution time: 0.1281
DEBUG - 2023-08-15 05:39:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:54 --> Total execution time: 0.0691
DEBUG - 2023-08-15 05:39:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:57 --> Total execution time: 0.0706
DEBUG - 2023-08-15 05:39:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:39:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:39:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:39:59 --> Total execution time: 0.0421
DEBUG - 2023-08-15 05:40:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:40:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:40:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:40:01 --> Total execution time: 0.0422
DEBUG - 2023-08-15 05:40:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:40:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:40:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:40:09 --> Total execution time: 0.0460
DEBUG - 2023-08-15 05:40:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:40:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:40:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:40:15 --> Total execution time: 0.0448
DEBUG - 2023-08-15 05:40:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:40:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:40:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:40:19 --> Total execution time: 0.0425
DEBUG - 2023-08-15 05:41:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:41:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:41:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:41:52 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:41:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:41:52 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:41:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:41:52 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:41:52 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:41:52 --> Total execution time: 0.2879
DEBUG - 2023-08-15 05:41:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:41:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:41:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:41:52 --> Total execution time: 0.0592
DEBUG - 2023-08-15 05:41:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:41:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:41:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:41:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:41:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:41:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:41:59 --> Total execution time: 0.0459
DEBUG - 2023-08-15 05:41:59 --> Total execution time: 0.0560
DEBUG - 2023-08-15 05:42:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:14 --> Total execution time: 0.0500
DEBUG - 2023-08-15 05:42:14 --> Total execution time: 0.0581
DEBUG - 2023-08-15 05:42:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:16 --> Total execution time: 0.0479
DEBUG - 2023-08-15 05:42:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:17 --> Total execution time: 0.0467
DEBUG - 2023-08-15 05:42:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:18 --> Total execution time: 0.1318
DEBUG - 2023-08-15 05:42:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:23 --> Total execution time: 0.0797
DEBUG - 2023-08-15 05:42:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:26 --> Total execution time: 0.0823
DEBUG - 2023-08-15 05:42:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:27 --> Total execution time: 0.0435
DEBUG - 2023-08-15 05:42:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:29 --> Total execution time: 0.0423
DEBUG - 2023-08-15 05:42:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:33 --> Total execution time: 0.0445
DEBUG - 2023-08-15 05:42:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:37 --> Total execution time: 0.0506
DEBUG - 2023-08-15 05:42:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:39 --> Total execution time: 0.0434
DEBUG - 2023-08-15 05:42:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:51 --> Total execution time: 0.0495
DEBUG - 2023-08-15 05:42:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:42:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:42:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:42:51 --> Total execution time: 0.0425
DEBUG - 2023-08-15 05:43:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:43:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:43:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:43:00 --> Total execution time: 0.0501
DEBUG - 2023-08-15 05:43:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:43:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:43:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:43:15 --> Total execution time: 0.0510
DEBUG - 2023-08-15 05:43:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:43:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:43:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:43:15 --> Total execution time: 0.0484
DEBUG - 2023-08-15 05:43:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:43:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:43:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:43:23 --> Total execution time: 0.0429
DEBUG - 2023-08-15 05:44:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:44:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:44:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:44:09 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:44:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:44:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:44:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:44:09 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:44:09 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:44:09 --> Total execution time: 0.2907
DEBUG - 2023-08-15 05:44:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:44:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:44:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:44:10 --> Total execution time: 0.0582
DEBUG - 2023-08-15 05:44:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:44:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:44:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:44:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:44:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:44:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:44:55 --> Total execution time: 0.0467
DEBUG - 2023-08-15 05:44:55 --> Total execution time: 0.0624
DEBUG - 2023-08-15 05:45:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:17 --> Total execution time: 0.0462
DEBUG - 2023-08-15 05:45:17 --> Total execution time: 0.0628
DEBUG - 2023-08-15 05:45:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:19 --> Total execution time: 0.0490
DEBUG - 2023-08-15 05:45:20 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:20 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:20 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:20 --> Total execution time: 0.0463
DEBUG - 2023-08-15 05:45:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:21 --> Total execution time: 0.1209
DEBUG - 2023-08-15 05:45:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:26 --> Total execution time: 0.0869
DEBUG - 2023-08-15 05:45:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:31 --> Total execution time: 0.0666
DEBUG - 2023-08-15 05:45:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:32 --> Total execution time: 0.0433
DEBUG - 2023-08-15 05:45:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:33 --> Total execution time: 0.0424
DEBUG - 2023-08-15 05:45:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:45:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:45:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:45:38 --> Total execution time: 0.0423
DEBUG - 2023-08-15 05:46:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:46:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:46:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:46:42 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:46:42 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:46:42 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:46:42 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:46:42 --> Total execution time: 0.2835
DEBUG - 2023-08-15 05:46:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:46:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:46:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:46:43 --> Total execution time: 0.0602
DEBUG - 2023-08-15 05:46:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:46:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:46:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:46:52 --> Total execution time: 0.1322
DEBUG - 2023-08-15 05:46:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:46:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:46:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:46:59 --> Total execution time: 0.0844
DEBUG - 2023-08-15 05:47:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:47:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:47:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:47:02 --> Total execution time: 0.0915
DEBUG - 2023-08-15 05:47:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:47:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:47:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:47:03 --> Total execution time: 0.0429
DEBUG - 2023-08-15 05:47:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:47:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:47:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:47:04 --> Total execution time: 0.0483
DEBUG - 2023-08-15 05:47:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:47:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:47:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:47:38 --> Total execution time: 0.0513
DEBUG - 2023-08-15 05:49:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:49:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:49:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:49:43 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:49:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 05:49:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:49:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 05:49:43 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 05:49:43 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 05:49:43 --> Total execution time: 0.3592
DEBUG - 2023-08-15 05:49:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:49:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:49:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:49:43 --> Total execution time: 0.0722
DEBUG - 2023-08-15 05:49:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:49:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:49:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:49:50 --> Total execution time: 0.1267
DEBUG - 2023-08-15 05:49:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:49:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:49:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:49:55 --> Total execution time: 0.0653
DEBUG - 2023-08-15 05:49:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:49:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:49:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:49:58 --> Total execution time: 0.0586
DEBUG - 2023-08-15 05:50:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:50:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:50:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:50:01 --> Total execution time: 0.0494
DEBUG - 2023-08-15 05:50:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:50:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:50:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:50:02 --> Total execution time: 0.0514
DEBUG - 2023-08-15 05:50:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:50:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:50:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:50:07 --> Total execution time: 0.0428
DEBUG - 2023-08-15 05:50:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:50:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:50:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:50:54 --> Total execution time: 0.0462
DEBUG - 2023-08-15 05:51:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:00 --> Total execution time: 0.0501
DEBUG - 2023-08-15 05:51:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:03 --> Total execution time: 0.0424
DEBUG - 2023-08-15 05:51:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:07 --> Total execution time: 0.0440
DEBUG - 2023-08-15 05:51:07 --> Total execution time: 0.0520
DEBUG - 2023-08-15 05:51:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:51:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:51:29 --> Global POST, GET and COOKIE data sanitized
ERROR - 2023-08-15 05:51:39 --> Unable to connect to the database
DEBUG - 2023-08-15 05:51:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:51:39 --> Unable to connect to the database
DEBUG - 2023-08-15 05:51:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:51:41 --> Unable to connect to the database
ERROR - 2023-08-15 05:51:41 --> Unable to connect to the database
DEBUG - 2023-08-15 05:51:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:51:45 --> Unable to connect to the database
ERROR - 2023-08-15 05:51:45 --> Unable to connect to the database
DEBUG - 2023-08-15 05:51:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:51:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:51:54 --> Unable to connect to the database
ERROR - 2023-08-15 05:51:54 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: delete from sales_order_detail_2_temp
DEBUG - 2023-08-15 05:51:54 --> Total execution time: 31.3844
ERROR - 2023-08-15 05:52:10 --> Unable to connect to the database
ERROR - 2023-08-15 05:52:10 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id IS NOT NULL
									
									
									
									AND client_pt.area_id = '3A5FB341-1ADD-494B-9761-61B224A17493' 
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-15 05:52:10 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 531
ERROR - 2023-08-15 05:52:26 --> Unable to connect to the database
ERROR - 2023-08-15 05:52:26 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: delete from sales_order_detail_2_temp
DEBUG - 2023-08-15 05:52:26 --> Total execution time: 61.3745
ERROR - 2023-08-15 05:52:41 --> Unable to connect to the database
ERROR - 2023-08-15 05:52:41 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id IS NOT NULL
									
									
									
									AND client_pt.area_id = '3A5FB341-1ADD-494B-9761-61B224A17493' 
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-15 05:52:41 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 531
ERROR - 2023-08-15 05:52:56 --> Unable to connect to the database
ERROR - 2023-08-15 05:52:56 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: SELECT DISTINCT
									client_pt.*,
									ISNULL(area.area_nama, '') AS area_nama
									FROM client_pt
									LEFT JOIN area
									ON client_pt.area_id = area.area_id
									WHERE client_pt.client_pt_id IS NOT NULL
									
									
									
									AND client_pt.area_id = '3A5FB341-1ADD-494B-9761-61B224A17493' 
									ORDER BY client_pt.client_pt_nama ASC
ERROR - 2023-08-15 05:52:56 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 531
ERROR - 2023-08-15 05:53:11 --> Unable to connect to the database
ERROR - 2023-08-15 05:53:11 --> Query error: [Microsoft][ODBC Driver 17 for SQL Server]MAX_PROVS: Error Locating Server/Instance Specified [xFFFFFFFF].  - Invalid query: delete from sales_order_detail_2_temp
DEBUG - 2023-08-15 05:53:11 --> Total execution time: 101.9730
DEBUG - 2023-08-15 05:53:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:36 --> Total execution time: 2.0675
DEBUG - 2023-08-15 05:53:36 --> Total execution time: 2.4601
DEBUG - 2023-08-15 05:53:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:47 --> Total execution time: 0.0686
DEBUG - 2023-08-15 05:53:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:49 --> Total execution time: 0.0518
DEBUG - 2023-08-15 05:53:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:54 --> Total execution time: 1.3265
DEBUG - 2023-08-15 05:53:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:53:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:53:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:53:58 --> Total execution time: 0.1116
DEBUG - 2023-08-15 05:54:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:54:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:54:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:54:02 --> Total execution time: 0.0668
DEBUG - 2023-08-15 05:54:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:54:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:54:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:54:03 --> Total execution time: 0.0466
DEBUG - 2023-08-15 05:54:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:54:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:54:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:54:54 --> Total execution time: 0.0577
DEBUG - 2023-08-15 05:54:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:54:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:54:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:54:58 --> Total execution time: 0.0744
DEBUG - 2023-08-15 05:55:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:55:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:55:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:55:02 --> Total execution time: 0.0432
DEBUG - 2023-08-15 05:55:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:55:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:55:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 05:55:14 --> Total execution time: 0.5023
DEBUG - 2023-08-15 05:55:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 05:55:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 05:55:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 05:55:15 --> Severity: Notice --> Undefined variable: Gudang C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3219
ERROR - 2023-08-15 05:55:15 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3219
DEBUG - 2023-08-15 05:55:15 --> Total execution time: 1.0548
DEBUG - 2023-08-15 06:00:35 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:00:35 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:00:35 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 06:00:36 --> Severity: Notice --> Undefined variable: items C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 06:00:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 217
ERROR - 2023-08-15 06:00:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 06:00:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 294
ERROR - 2023-08-15 06:00:36 --> Severity: Notice --> Undefined variable: Perusahaan C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
ERROR - 2023-08-15 06:00:36 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\form.php 379
DEBUG - 2023-08-15 06:00:36 --> Total execution time: 0.4459
DEBUG - 2023-08-15 06:00:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:00:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:00:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:00:36 --> Total execution time: 0.0618
DEBUG - 2023-08-15 06:02:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:06 --> Total execution time: 0.0672
DEBUG - 2023-08-15 06:02:06 --> Total execution time: 0.0824
DEBUG - 2023-08-15 06:02:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:22 --> Total execution time: 0.0440
DEBUG - 2023-08-15 06:02:22 --> Total execution time: 0.0603
DEBUG - 2023-08-15 06:02:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:24 --> Total execution time: 0.0488
DEBUG - 2023-08-15 06:02:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:26 --> Total execution time: 0.0463
DEBUG - 2023-08-15 06:02:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:28 --> Total execution time: 0.1418
DEBUG - 2023-08-15 06:02:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:38 --> Total execution time: 0.0807
DEBUG - 2023-08-15 06:02:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:42 --> Total execution time: 0.0685
DEBUG - 2023-08-15 06:02:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:43 --> Total execution time: 0.0447
DEBUG - 2023-08-15 06:02:45 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:45 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:45 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:45 --> Total execution time: 0.0823
DEBUG - 2023-08-15 06:02:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:50 --> Total execution time: 0.0435
DEBUG - 2023-08-15 06:02:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:54 --> Total execution time: 0.0505
DEBUG - 2023-08-15 06:02:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:02:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:02:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:02:59 --> Total execution time: 0.0468
DEBUG - 2023-08-15 06:03:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:03:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:03:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:03:10 --> Total execution time: 0.4225
DEBUG - 2023-08-15 06:03:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:03:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:03:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 06:03:11 --> Severity: Notice --> Undefined variable: Gudang C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3219
ERROR - 2023-08-15 06:03:11 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3219
DEBUG - 2023-08-15 06:03:11 --> Total execution time: 0.2905
DEBUG - 2023-08-15 06:19:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:19:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:19:56 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:19:56 --> Total execution time: 0.2543
DEBUG - 2023-08-15 06:19:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:19:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:19:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 06:19:57 --> Total execution time: 0.0648
DEBUG - 2023-08-15 06:20:00 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:20:00 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:20:00 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 06:20:00 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
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
ERROR - 2023-08-15 06:20:00 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 713
DEBUG - 2023-08-15 06:20:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 06:20:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 06:20:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 06:20:36 --> Query error: Memory limit of 10240 KB exceeded for buffered query - Invalid query: SELECT
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
ERROR - 2023-08-15 06:20:36 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp\htdocs\padmakriya_fas\application\models\FAS\M_SalesOrder.php 713
DEBUG - 2023-08-15 07:13:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:13:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:13:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:13:37 --> Total execution time: 0.2811
DEBUG - 2023-08-15 07:13:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:13:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:13:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:13:37 --> Total execution time: 0.0620
DEBUG - 2023-08-15 07:13:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:13:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:13:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 07:13:41 --> Severity: Notice --> Undefined property: SalesOrder::$M_DeliveryOrderDraft C:\xampp\htdocs\padmakriya_fas\application\controllers\FAS\SalesOrder.php 489
ERROR - 2023-08-15 07:13:41 --> Severity: error --> Exception: Call to a member function GetTotalSalesOrderByFilter() on null C:\xampp\htdocs\padmakriya_fas\application\controllers\FAS\SalesOrder.php 489
DEBUG - 2023-08-15 07:14:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:05 --> Total execution time: 0.3253
DEBUG - 2023-08-15 07:14:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:05 --> Total execution time: 0.0562
DEBUG - 2023-08-15 07:14:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:12 --> Total execution time: 0.4185
DEBUG - 2023-08-15 07:14:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:18 --> Total execution time: 0.3783
DEBUG - 2023-08-15 07:14:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:26 --> Total execution time: 0.3842
DEBUG - 2023-08-15 07:14:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:34 --> Total execution time: 0.3916
DEBUG - 2023-08-15 07:14:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:14:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:14:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:14:41 --> Total execution time: 0.3790
DEBUG - 2023-08-15 07:40:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:40:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:40:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:40:06 --> Total execution time: 0.3588
DEBUG - 2023-08-15 07:40:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:40:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:40:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:40:06 --> Total execution time: 0.0731
DEBUG - 2023-08-15 07:40:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:40:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:40:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:40:11 --> Total execution time: 0.3253
DEBUG - 2023-08-15 07:40:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:40:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:40:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:40:22 --> Total execution time: 0.3184
DEBUG - 2023-08-15 07:41:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:03 --> Total execution time: 0.3067
DEBUG - 2023-08-15 07:41:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:04 --> Total execution time: 0.0701
DEBUG - 2023-08-15 07:41:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:07 --> Total execution time: 0.3355
DEBUG - 2023-08-15 07:41:47 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:47 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:47 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:47 --> Total execution time: 0.3172
DEBUG - 2023-08-15 07:41:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:49 --> Total execution time: 0.3151
DEBUG - 2023-08-15 07:41:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:50 --> Total execution time: 0.3894
DEBUG - 2023-08-15 07:41:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:50 --> Total execution time: 0.4762
DEBUG - 2023-08-15 07:41:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:50 --> Total execution time: 0.6445
DEBUG - 2023-08-15 07:41:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:51 --> Total execution time: 0.8020
DEBUG - 2023-08-15 07:41:51 --> Total execution time: 0.9465
DEBUG - 2023-08-15 07:41:51 --> Total execution time: 1.0692
DEBUG - 2023-08-15 07:41:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 07:41:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 07:41:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 07:41:55 --> Total execution time: 0.3817
DEBUG - 2023-08-15 08:26:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:26:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:26:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:26:33 --> Total execution time: 0.2175
DEBUG - 2023-08-15 08:26:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:26:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:26:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:26:42 --> Total execution time: 0.2247
DEBUG - 2023-08-15 08:26:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:26:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:26:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:26:52 --> Total execution time: 0.2745
DEBUG - 2023-08-15 08:26:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:26:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:26:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:26:52 --> Total execution time: 0.0611
DEBUG - 2023-08-15 08:27:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:27:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:27:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:27:51 --> Total execution time: 0.3239
DEBUG - 2023-08-15 08:28:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:28:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:28:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:28:22 --> Total execution time: 0.1278
DEBUG - 2023-08-15 08:31:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:05 --> Total execution time: 0.2103
DEBUG - 2023-08-15 08:31:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:10 --> Total execution time: 0.0603
DEBUG - 2023-08-15 08:31:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:10 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
DEBUG - 2023-08-15 08:31:10 --> Total execution time: 0.3366
DEBUG - 2023-08-15 08:31:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:11 --> Total execution time: 0.0635
DEBUG - 2023-08-15 08:31:11 --> Total execution time: 0.0816
DEBUG - 2023-08-15 08:31:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:17 --> Total execution time: 0.0442
DEBUG - 2023-08-15 08:31:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:31:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
DEBUG - 2023-08-15 08:31:24 --> Total execution time: 0.3377
DEBUG - 2023-08-15 08:31:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:24 --> Total execution time: 0.0544
DEBUG - 2023-08-15 08:31:24 --> Total execution time: 0.0697
DEBUG - 2023-08-15 08:31:51 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:51 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:51 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:51 --> Total execution time: 0.3148
DEBUG - 2023-08-15 08:31:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:52 --> Total execution time: 0.0613
DEBUG - 2023-08-15 08:31:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:31:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:31:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:31:59 --> Total execution time: 0.1381
DEBUG - 2023-08-15 08:32:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:32:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:32:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:32:01 --> Total execution time: 0.0608
DEBUG - 2023-08-15 08:32:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:32:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:32:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:32:02 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
DEBUG - 2023-08-15 08:32:02 --> Total execution time: 0.3625
DEBUG - 2023-08-15 08:32:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:32:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:32:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:32:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:32:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:32:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:32:03 --> Total execution time: 0.0902
DEBUG - 2023-08-15 08:32:03 --> Total execution time: 0.1150
DEBUG - 2023-08-15 08:32:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:32:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:32:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:32:05 --> Total execution time: 0.0490
DEBUG - 2023-08-15 08:33:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:33:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:33:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
ERROR - 2023-08-15 08:33:29 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 349
DEBUG - 2023-08-15 08:33:29 --> Total execution time: 0.3192
DEBUG - 2023-08-15 08:33:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:33:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:33:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:33:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:33:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:33:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:33:29 --> Total execution time: 0.0606
DEBUG - 2023-08-15 08:33:29 --> Total execution time: 0.0793
DEBUG - 2023-08-15 08:34:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:43 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:34:43 --> Total execution time: 0.3507
DEBUG - 2023-08-15 08:34:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:44 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:34:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:34:44 --> Total execution time: 0.0739
DEBUG - 2023-08-15 08:34:44 --> Total execution time: 0.0830
DEBUG - 2023-08-15 08:34:55 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:55 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:55 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:34:56 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:34:56 --> Total execution time: 0.3335
DEBUG - 2023-08-15 08:34:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:56 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:34:56 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:34:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:34:57 --> Total execution time: 0.0843
DEBUG - 2023-08-15 08:34:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:34:57 --> Total execution time: 0.0941
DEBUG - 2023-08-15 08:35:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:35:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:35:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:35:08 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:35:08 --> Total execution time: 0.3104
DEBUG - 2023-08-15 08:35:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:35:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:35:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:35:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:35:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:35:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:35:09 --> Total execution time: 0.1179
DEBUG - 2023-08-15 08:35:09 --> Total execution time: 0.1543
DEBUG - 2023-08-15 08:38:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:38:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:38:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:38:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:38:24 --> Total execution time: 0.3106
DEBUG - 2023-08-15 08:38:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:38:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:38:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:38:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:38:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:38:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:38:25 --> Total execution time: 0.0655
DEBUG - 2023-08-15 08:38:25 --> Total execution time: 0.0888
DEBUG - 2023-08-15 08:38:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:38:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:38:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:38:27 --> Total execution time: 0.0420
DEBUG - 2023-08-15 08:38:31 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:38:31 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:38:31 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:38:31 --> Total execution time: 0.0443
DEBUG - 2023-08-15 08:39:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:39:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:39:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:39:34 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:39:34 --> Total execution time: 0.3087
DEBUG - 2023-08-15 08:39:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:39:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:39:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:39:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:39:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:39:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:39:34 --> Total execution time: 0.0599
DEBUG - 2023-08-15 08:39:34 --> Total execution time: 0.0725
DEBUG - 2023-08-15 08:39:37 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:39:37 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:39:37 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:39:37 --> Total execution time: 0.0494
DEBUG - 2023-08-15 08:39:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:39:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:39:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:39:59 --> Total execution time: 0.0451
DEBUG - 2023-08-15 08:40:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:40:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:40:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:40:01 --> Total execution time: 0.0419
DEBUG - 2023-08-15 08:49:26 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:49:26 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:49:26 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:26 --> Severity: Notice --> Undefined index: sku_stock_expired_date C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 134
DEBUG - 2023-08-15 08:49:26 --> Total execution time: 0.3588
DEBUG - 2023-08-15 08:49:59 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:49:59 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:49:59 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:49:59 --> Severity: Notice --> Undefined index: sku_stock_expired_date C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 134
DEBUG - 2023-08-15 08:49:59 --> Total execution time: 0.3134
DEBUG - 2023-08-15 08:51:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:51:05 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:05 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:05 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:05 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:05 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:06 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:51:06 --> Total execution time: 0.4077
DEBUG - 2023-08-15 08:51:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:06 --> Total execution time: 0.0575
DEBUG - 2023-08-15 08:51:06 --> Total execution time: 0.0731
DEBUG - 2023-08-15 08:51:09 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:09 --> Total execution time: 0.0704
DEBUG - 2023-08-15 08:51:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:16 --> Total execution time: 0.0441
DEBUG - 2023-08-15 08:51:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:21 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:51:21 --> Total execution time: 0.2800
DEBUG - 2023-08-15 08:51:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:22 --> Total execution time: 0.0732
DEBUG - 2023-08-15 08:51:22 --> Total execution time: 0.0832
DEBUG - 2023-08-15 08:51:42 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:42 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:42 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:51:42 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:51:42 --> Total execution time: 0.3212
DEBUG - 2023-08-15 08:51:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:43 --> Total execution time: 0.0769
DEBUG - 2023-08-15 08:51:43 --> Total execution time: 0.1126
DEBUG - 2023-08-15 08:51:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:46 --> Total execution time: 0.0443
DEBUG - 2023-08-15 08:51:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:46 --> Total execution time: 0.0456
DEBUG - 2023-08-15 08:51:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:49 --> Total execution time: 0.0435
DEBUG - 2023-08-15 08:51:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:54 --> Total execution time: 0.0433
DEBUG - 2023-08-15 08:51:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:51:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:51:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:51:57 --> Total execution time: 0.0475
DEBUG - 2023-08-15 08:52:02 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:02 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:02 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:02 --> Total execution time: 0.0468
DEBUG - 2023-08-15 08:52:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:52:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:52:07 --> Total execution time: 0.3694
DEBUG - 2023-08-15 08:52:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:08 --> Total execution time: 0.0578
DEBUG - 2023-08-15 08:52:08 --> Total execution time: 0.0797
DEBUG - 2023-08-15 08:52:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:11 --> Total execution time: 0.0470
DEBUG - 2023-08-15 08:52:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:11 --> Total execution time: 0.0545
DEBUG - 2023-08-15 08:52:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:14 --> Total execution time: 0.0529
DEBUG - 2023-08-15 08:52:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:20 --> Total execution time: 0.0439
DEBUG - 2023-08-15 08:52:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:24 --> Total execution time: 0.0513
DEBUG - 2023-08-15 08:52:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:52:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:52:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:52:28 --> Total execution time: 0.0432
DEBUG - 2023-08-15 08:53:24 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:24 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:24 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:53:24 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:53:24 --> Total execution time: 0.3169
DEBUG - 2023-08-15 08:53:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:25 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:25 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:25 --> Total execution time: 0.0594
DEBUG - 2023-08-15 08:53:25 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:25 --> Total execution time: 0.1067
DEBUG - 2023-08-15 08:53:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:27 --> Total execution time: 0.0521
DEBUG - 2023-08-15 08:53:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:27 --> Total execution time: 0.0445
DEBUG - 2023-08-15 08:53:29 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:29 --> Total execution time: 0.0541
DEBUG - 2023-08-15 08:53:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:33 --> Total execution time: 0.0504
DEBUG - 2023-08-15 08:53:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:53:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:53:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:53:40 --> Total execution time: 0.0478
DEBUG - 2023-08-15 08:57:38 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:57:38 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:57:38 --> Total execution time: 0.3307
DEBUG - 2023-08-15 08:57:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:39 --> Total execution time: 0.0551
DEBUG - 2023-08-15 08:57:39 --> Total execution time: 0.0744
DEBUG - 2023-08-15 08:57:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:41 --> Total execution time: 0.0426
DEBUG - 2023-08-15 08:57:41 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:41 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:41 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:41 --> Total execution time: 0.0435
DEBUG - 2023-08-15 08:57:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:43 --> Total execution time: 0.0477
DEBUG - 2023-08-15 08:57:46 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:46 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:46 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:46 --> Total execution time: 0.0436
DEBUG - 2023-08-15 08:57:52 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:57:52 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:57:52 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:57:52 --> Total execution time: 0.0434
DEBUG - 2023-08-15 08:59:13 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:13 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:13 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 08:59:13 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 08:59:13 --> Total execution time: 0.3635
DEBUG - 2023-08-15 08:59:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:14 --> Total execution time: 0.0676
DEBUG - 2023-08-15 08:59:14 --> Total execution time: 0.0824
DEBUG - 2023-08-15 08:59:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:16 --> Total execution time: 0.0536
DEBUG - 2023-08-15 08:59:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:16 --> Total execution time: 0.0471
DEBUG - 2023-08-15 08:59:17 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:17 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:17 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:17 --> Total execution time: 0.0491
DEBUG - 2023-08-15 08:59:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:20 --> Total execution time: 0.0488
DEBUG - 2023-08-15 08:59:23 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:23 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:23 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:23 --> Total execution time: 0.0534
DEBUG - 2023-08-15 08:59:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:28 --> Total execution time: 0.0426
DEBUG - 2023-08-15 08:59:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:48 --> Total execution time: 0.0521
DEBUG - 2023-08-15 08:59:48 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 08:59:48 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 08:59:48 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 08:59:48 --> Total execution time: 0.0420
DEBUG - 2023-08-15 09:00:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:33 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:00:33 --> Total execution time: 0.3445
DEBUG - 2023-08-15 09:00:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:34 --> Total execution time: 0.0583
DEBUG - 2023-08-15 09:00:34 --> Total execution time: 0.0755
DEBUG - 2023-08-15 09:00:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:36 --> Total execution time: 0.0451
DEBUG - 2023-08-15 09:00:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:36 --> Total execution time: 0.0720
DEBUG - 2023-08-15 09:00:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:40 --> Total execution time: 0.0501
DEBUG - 2023-08-15 09:00:49 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:49 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:49 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:00:49 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:00:49 --> Total execution time: 0.3598
DEBUG - 2023-08-15 09:00:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:50 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:50 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:50 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:50 --> Total execution time: 0.0630
DEBUG - 2023-08-15 09:00:50 --> Total execution time: 0.0918
DEBUG - 2023-08-15 09:00:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:53 --> Total execution time: 0.0459
DEBUG - 2023-08-15 09:00:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:53 --> Total execution time: 0.0428
DEBUG - 2023-08-15 09:00:57 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:00:57 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:00:57 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:00:57 --> Total execution time: 0.0433
DEBUG - 2023-08-15 09:01:06 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:06 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:06 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:01:07 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:01:07 --> Total execution time: 0.3916
DEBUG - 2023-08-15 09:01:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:07 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:07 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:07 --> Total execution time: 0.0568
DEBUG - 2023-08-15 09:01:07 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:07 --> Total execution time: 0.0747
DEBUG - 2023-08-15 09:01:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:10 --> Total execution time: 0.0486
DEBUG - 2023-08-15 09:01:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:10 --> Total execution time: 0.0519
DEBUG - 2023-08-15 09:01:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:15 --> Total execution time: 0.0452
DEBUG - 2023-08-15 09:01:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:18 --> Total execution time: 0.0437
DEBUG - 2023-08-15 09:01:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:18 --> Total execution time: 0.0454
DEBUG - 2023-08-15 09:01:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:28 --> Total execution time: 0.0426
DEBUG - 2023-08-15 09:01:28 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:28 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:28 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:28 --> Total execution time: 0.0430
DEBUG - 2023-08-15 09:01:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:34 --> Total execution time: 0.0422
DEBUG - 2023-08-15 09:01:36 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:36 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:36 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:36 --> Total execution time: 0.0493
DEBUG - 2023-08-15 09:01:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:40 --> Total execution time: 0.0680
DEBUG - 2023-08-15 09:01:43 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:01:43 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:01:43 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:01:43 --> Total execution time: 0.0438
DEBUG - 2023-08-15 09:07:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:07:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:07:53 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:07:53 --> Total execution time: 0.3468
DEBUG - 2023-08-15 09:07:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:07:53 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:07:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:07:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:07:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:07:54 --> Total execution time: 0.0632
DEBUG - 2023-08-15 09:07:54 --> Total execution time: 0.0861
DEBUG - 2023-08-15 09:08:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:01 --> Total execution time: 0.0646
DEBUG - 2023-08-15 09:08:01 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:01 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:01 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:01 --> Total execution time: 0.0493
DEBUG - 2023-08-15 09:08:03 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:03 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:03 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:03 --> Total execution time: 0.0464
DEBUG - 2023-08-15 09:08:11 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:11 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:11 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:11 --> Total execution time: 0.0420
DEBUG - 2023-08-15 09:08:14 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:14 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:14 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:14 --> Total execution time: 0.0627
DEBUG - 2023-08-15 09:08:22 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:08:22 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:08:22 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:08:22 --> Total execution time: 0.0433
DEBUG - 2023-08-15 09:09:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:15 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:09:15 --> Total execution time: 0.3120
DEBUG - 2023-08-15 09:09:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:16 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:16 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:16 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:16 --> Total execution time: 0.0544
DEBUG - 2023-08-15 09:09:16 --> Total execution time: 0.0725
DEBUG - 2023-08-15 09:09:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:18 --> Total execution time: 0.0446
DEBUG - 2023-08-15 09:09:19 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:19 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:19 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:19 --> Total execution time: 0.0466
DEBUG - 2023-08-15 09:09:39 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:39 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:39 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:09:39 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:09:39 --> Total execution time: 0.3840
DEBUG - 2023-08-15 09:09:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:40 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:09:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:40 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:09:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:40 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:09:40 --> Total execution time: 0.1097
DEBUG - 2023-08-15 09:09:40 --> Total execution time: 0.1363
DEBUG - 2023-08-15 09:10:04 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:04 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:04 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_id' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
ERROR - 2023-08-15 09:10:04 --> Severity: Warning --> Illegal string offset 'area_nama' C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\edit.php 351
DEBUG - 2023-08-15 09:10:04 --> Total execution time: 0.4534
DEBUG - 2023-08-15 09:10:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:05 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:05 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:05 --> Total execution time: 0.0576
DEBUG - 2023-08-15 09:10:05 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:05 --> Total execution time: 0.0844
DEBUG - 2023-08-15 09:10:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:08 --> Total execution time: 0.0478
DEBUG - 2023-08-15 09:10:08 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:08 --> Total execution time: 0.0439
DEBUG - 2023-08-15 09:10:10 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:10 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:10 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:10 --> Total execution time: 0.0439
DEBUG - 2023-08-15 09:10:15 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:15 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:15 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:15 --> Total execution time: 0.0435
DEBUG - 2023-08-15 09:10:18 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:18 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:18 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:18 --> Total execution time: 0.0470
DEBUG - 2023-08-15 09:10:21 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:21 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:10:21 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:10:21 --> Total execution time: 0.0586
DEBUG - 2023-08-15 09:10:27 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:27 --> Global POST, GET and COOKIE data sanitized
ERROR - 2023-08-15 09:10:27 --> 404 Page Not Found: FAS/SalesOrder/update_sales_order_retur
DEBUG - 2023-08-15 09:10:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:10:32 --> Global POST, GET and COOKIE data sanitized
ERROR - 2023-08-15 09:10:32 --> 404 Page Not Found: FAS/SalesOrder/update_sales_order_retur
DEBUG - 2023-08-15 09:11:32 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:11:32 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:11:32 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 14:11:32 --> Total execution time: 0.1431
DEBUG - 2023-08-15 09:11:33 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:11:33 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:11:33 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:11:33 --> Total execution time: 0.2853
DEBUG - 2023-08-15 09:11:34 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 09:11:34 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 09:11:34 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 09:11:34 --> Total execution time: 0.0581
DEBUG - 2023-08-15 10:48:54 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 10:48:54 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 10:48:54 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 10:48:55 --> Total execution time: 0.4248
DEBUG - 2023-08-15 10:48:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 10:48:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 10:48:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2023-08-15 10:48:58 --> Total execution time: 0.0824
DEBUG - 2023-08-15 10:48:58 --> UTF-8 Support Enabled
DEBUG - 2023-08-15 10:48:58 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2023-08-15 10:48:58 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
ERROR - 2023-08-15 10:48:59 --> Severity: Notice --> Undefined variable: Gudang C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3449
ERROR - 2023-08-15 10:48:59 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\padmakriya_fas\application\views\FAS\SalesOrder\script.php 3449
DEBUG - 2023-08-15 10:48:59 --> Total execution time: 0.4549
