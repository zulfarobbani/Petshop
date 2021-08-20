<?php

require_once(__DIR__ . "/../../../web/assets/php/tcpdf/tcpdf.php");

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$totalLabaKotor = 0;

$htmlElement = '
<h2>Riwayat Transaksi SAMBAT FAUNA SHOP</h3>

<table border="1">
    <thead>
        <tr>
            <td>No</td>
            <td><b>Nomor Receipt</b></td>
            <td><b>Pelanggan</b></td>
            <td><b>Kasir</b></td>
            <td><b>Total Penjualan</b></td>
            <td><b>Jenis Transaksi</b></td>
            <td><b>Tanggal</b></td>
        </tr>
    </thead>
    <tbody>
';

foreach ($datas as $key => $value) {
    $htmlElement .= '
    <tr>
        <td>' . ($key += 1) . '</td>
        <td>' . $value['nomorTransaksi'] . '</td>
        <td>' . $value['pelangganTransaksi'] . '</td>
        <td>' . $value['namaUser'] . '</td>
        <td>Rp. ' . number_format($value['totalHargaTransaksi'], 2, ',', '.') . '</td>
        <td>' . ($value['jenisTransaksi'] == '1' ? 'Grosir' : 'Eceran') . '</td>
        <td>' . $value['dateTransaksi'] . '</td>
    </tr>';

    $htmlElement .= '
    <tr><td colspan="7">
        <table border="1" style="padding: 0px 0px 0px 10px;">';

    foreach ($value['detail'] as $key1 => $value1) {
        $htmlElement .= '
            <tr>
                <td><b>Nama Produk</b></td>
                <td><b>Satuan Produk</b></td>
                <td><b>Jumlah Beli</b></td>
                <td><b>Harga</b></td>
                <td><b>Total Harga</b></td>
            </tr>
            <tr>
                <td>' . $value1['namaItem'] . '</td>
                <td>' . $value1['satuanItemGroup'] . '</td>
                <td>' . $value1['groupkuantitiItem'] . '</td>
                <td>Rp.' . number_format($value1['hargaItemGroup'], 2, ',', '.') . '</td>
                <td>Rp.' . number_format($value1['totalHarga'], 2, ',', '.') . '</td>
            </tr>';
        if (intval($value1['pengurangItem']) > 0) {
            $htmlElement .=
                '<tr>
                <td colspan="5">
                    <table border="1" style="padding: 0px 0px 0px 10px;">
                        <tr>
                            <td><b>Kuantiti retur</b></td>
                            <td><b>Kuantiti akhir pembelian</b></td>
                            <td><b>Total akhir pembelian</b></td>
                        </tr>
                        <tr>
                            <td>'.$value1['pengurangItem'].'</td>
                            <td>'.(intval($value1['groupkuantitiItem'])-intval($value1['pengurangItem'])).'</td>
                            <td>Rp.'.number_format($value1['totalHargaRetur'], 2, ',', '.').'</td>
                        </tr>
                    </table>
                </td>
            </tr>
        ';
        }
    }

    $htmlElement .= '</table></td></tr>
    ';
}

$htmlElement .= '
    </tbody>
</table>
<span>Laba Kotor : </span>
<span>Rp. ' . number_format($labaKotor, 2, ',', '.') . '</span><br>
<span>Laba Bersih : </span>
<span>Rp. ' . number_format($labaBersih, 2, ',', '.') . '</span>
';
// add a page
$pdf->AddPage();

// print a block of text using Write()
$pdf->writeHtml($htmlElement, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('riwayat_transaksi.pdf', 'D');
