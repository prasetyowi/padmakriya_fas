<html>

<head>
    <title><?= $title_pdf ?></title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            /* padding-left: 5px; */
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <?php foreach ($PRHeader as $header) : ?>
        <table style='font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td align='left' style=' vertical-align:top'>
                <span style='font-size:12pt'><b>No Purchase Order</b> </span>

            </td>
            <td align='left' style=' vertical-align:top'> :
                <span style='font-size:12pt'><?= $header['purchase_order_kode']; ?>
                </span>
            </td>
        </table>
        <br>

        <table style=' font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>

                <td>Nama Perusahaan</td>
                <td>:
                    <?php foreach ($Perusahaan as $row) : ?>
                        <?= $header['client_wms_id'] == $row['client_wms_id'] ? $row['client_wms_nama'] : ''; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Tanggal Purchase order</td>
                <td>:
                    <?= $header['purchase_order_tgl_create']; ?>
                </td>
            </tr>
            <tr>
                <td>Tanggal Dibutuhkan</td>
                <td>: <?= $header['purchase_request_tgl_dibutuhkan']; ?></td>
            </tr>
            <tr>
                <td>Tipe Pengadaan</td>
                <td>:
                    <?php foreach ($TipePengadaan as $row) : ?>
                        <?= $header['tipe_pengadaan_id'] == $row['tipe_pengadaan_id'] ? $row['tipe_pengadaan_nama']  : ''; ?>
                    <?php endforeach; ?></td>
            </tr>
            <tr>
                <td>Tipe Transaksi</td>
                <td>:
                    <?php foreach ($TipeTransaksi as $row) : ?>
                        <?= $header['tipe_transaksi_id'] == $row['tipe_transaksi_id'] ? $row['tipe_transaksi_nama']  : ''; ?>
                    <?php endforeach; ?></td>
            </tr>
            <tr>
                <td>Kategori Biaya</td>
                <td>:<?php foreach ($KategoriBiaya as $row) : ?>
                    <?= $header['kategori_biaya_id'] == $row['kategori_biaya_id'] ? $row['kategori_biaya_nama']  : ''; ?>
                <?php endforeach; ?></td>
            </tr>
            <tr>
                <td>Tipe Biaya</td>
                <td>:<?php foreach ($TipeBiaya as $row) : ?>
                    <?= $header['tipe_biaya_id'] == $row['tipe_biaya_id'] ? $row['tipe_biaya_nama']  : ''; ?>
                <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:<?php foreach ($Divisi as $row) : ?>
                    <?= $header['karyawan_divisi_id'] == $row['karyawan_divisi_id'] ? $row['karyawan_divisi_nama'] : ''; ?>
                <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <?= $header['purchase_order_status']; ?></td>
            </tr>

        </table>
    <?php endforeach; ?>

    <br>
    <br>
    <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

        <tr align='center'>
            <td width='10%'>Kode Barang</td>
            <td width='20%'>Nama Barang</td>
            <td width='13%'>Satuan</td>
            <td width='4%'>Kemasan</td>
            <td width='7%'>Qty</td>
            <td width='13%'> Harga</td>
            <td width='13%'> Keterangan</td>
        </tr>
        <?php foreach ($PRDetail as $i => $item) : ?>
            <tr id="row-<?= $i ?>">
                <td class="text-center"><?= $item['sku_barang_kode'] ?></td>
                <td class="text-center"><?= $item['sku_barang_nama_produk'] ?></td>
                <td class="text-center"><?= $item['sku_barang_satuan'] ?></td>
                <td class="text-center"><?= $item['sku_barang_kemasan'] ?></td>
                <td class="text-center"><?= $item['purchase_order_detail_qty'] ?></td>
                <td class="text-center">Rp. <?= round($item['sku_barang_harga']) ?></td>
                <td class="text-center"><?= $item['purchase_order_detail_keterangan'] == null ? '-' : $item['purchase_order_detail_keterangan']; ?></td>
            </tr>
        <?php endforeach; ?>

        <!-- <tr>
            <td colspan='5'>
                <div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div>
            </td>
            <td style='text-align:right'>Rp2.460.000,00</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan='6'>
                <div style='text-align:right'>Terbilang : Dua Juta Empat Ratus Enam Puluh Ribu Rupiah</div>
            </td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan='5'>
                <div style='text-align:right'>Cash : </div>
            </td>
            <td style='text-align:right'>Rp2.460.000,00</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan='5'>
                <div style='text-align:right'>Kembalian : </div>
            </td>
            <td style='text-align:right'>Rp0,00</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan='5'>
                <div style='text-align:right'>DP : </div>
            </td>
            <td style='text-align:right'>Rp0,00</td>
            <td>-</td>
        </tr>
        <tr>
            <td colspan='5'>
                <div style='text-align:right'>Sisa : </div>
            </td>
            <td style='text-align:right'>Rp0,00</td>
            <td>-</td>
        </tr> -->
    </table>
    <br>
    <br>

    <table style='width:100%;font-size:7pt;' cellspacing='2' border="0">
        <tr align="left">
            <td align='left' colspan="9">Diterima Oleh,</br></br><u>(............)</u></td>
            <!-- <td style='border:1px solid black; padding:5px; text-align:left; width:30%'></td> -->
            <td align='left'>TTD,</br></br><u>(...........)</u></td>
        </tr>
    </table>
</body>

</html>