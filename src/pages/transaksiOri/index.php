<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                        <a href="/transaksi/<?= $value['idTransaksi']?>/print-receipt" class="cetakReceipt">Cetak</a>
                        <a href="/transaksi/<?= $value['idTransaksi']?>/retur">Retur</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>