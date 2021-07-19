<?php

require_once ("assets/php/tcpdf/tcpdf.php");

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$totalLabaKotor = 0;

$htmlElement = '
<h2>Riwayat Transaksi</h3>
<h4>Tanggal : '.$fromDate.' - '.$toDate.'</h4>

<table border="1">
    <thead>
        <tr>
            <td>Nomor Receipt</td>
            <td>Pelanggan</td>
            <td>Kasir</td>
            <td>Total Penjualan</td>
            <td>Tanggal</td>
        </tr>
    </thead>
    <tbody>
';

foreach($datas as $value){
    $totalLabaKotor += $value['totalHargaTransaksi'];

    $htmlElement .= '
    <tr>
        <td>'.$value['nomorTransaksi'].'</td>
        <td>'.$value['pelangganTransaksi'].'</td>
        <td>'.$value['kasirTransaksi'].'</td>
        <td>Rp. '.number_format($value['totalHargaTransaksi'],2,',','.') .'</td>
        <td>'.$value['tanggalTransaksi'].'</td>
    </tr>';
}
        
    $htmlElement .='
    </tbody>
</table>
    
<span>Total Laba Kotor : </span>
<span>Rp. '.number_format($totalLabaKotor,2,',','.').'</span>
';
// add a page
$pdf->AddPage();

// print a block of text using Write()
$pdf->writeHtml($htmlElement, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('riwayat_transaksi.pdf', 'I');
?>