<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>Nomor Receipt</td>
                <td>Pelanggan</td>
                <td>Kasir</td>
                <td>Total Penjualan</td>
                <td>Tanggal</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $value) {?>
                <tr>
                    <td><?= $value['nomorTransaksi']?></td>
                    <td><?= $value['pelangganTransaksi']?></td>
                    <td><?= $value['kasirTransaksi']?></td>
                    <td>Rp. 1.000.000 (Static Data)</td>
                    <td><?= date('d F Y', strtotime($value['tanggalTransaksi'])) ?></td>
                    <td>
                        <a href="/transaksi/<?= $value['idTransaksi']?>/edit">Edit</a>
                        <a href="/transaksi/<?= $value['idTransaksi']?>/detail">Detail</a>
                        <a href="">Cetak ???</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>