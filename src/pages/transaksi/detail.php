<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <h1>Rincian Transaksi</h1>
    <table>
        <tr>
            <td>Nomor Transaksi</td>
            <td> : </td>
            <td><?= $detail['nomorTransaksi']?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td> : </td>
            <td><?= $detail['pelangganTransaksi']?></td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td> : </td>
            <td><?= $detail['kasirTransaksi']?></td>
        </tr>
        <tr>
            <td>Tanggal Transaksi</td>
            <td> : </td>
            <td><?= date('d F Y', strtotime($detail['tanggalTransaksi'])) ?></td>
        </tr>
        <tr>
            <td>Client</td>
            <td> : </td>
            <td><?= $detail['idClient']?></td>
        </tr>
        <tr>
            <td>Produk</td>
            <td> : </td>
            <td>
                <ol>
                    <?php foreach($groupItem as $value) {?>
                        <li>
                            <ul>
                                <li><?= $value['namaItem']?></li>
                                <li><?= $value['kuantitiItem']?></li>
                                <li><?= $value['pengurangItem']?></li>
                            </ul>
                        </li>
                    <?php }?>
                </ol>
            </td>
        </tr>
    </table>
</body>
</html>