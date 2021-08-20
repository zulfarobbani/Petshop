<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="produk/create">Tambah </a>
    <table border="1">
        <thead>
            <tr>
                <td>Nama</td>
                <td>Supplier</td>
                <td>Kuantiti</td>
                <td>Satuan</td>
                <td>Waktu Masuk</td>
                <td>Waktu Expiry</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $key => $values) { ?>
            <tr>
                <td><?= $values['namaItem']?></td>
                <td><?= $values['supplierItem'] ?></td>
                <td><?= $values['kuantitiItem']?></td>
                <td><?= $values['satuanItem'] ?></td>
                <td><?= $values['tanggalmasukProduk']?></td>
                <td><?= $values['tanggalexpiryProduk'] ?></td>
                <td><a href="produk/<?= $values['idItem']?>/edit">EDIT</a>||<a href="produk/<?= $values['idItem']?>/delete">DELETE</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    
    <form action="/produk" method="get">
        Waktu Masuk<br>
        dari<input type="date" name="filterWaktumasukFrom" value="<?= $filterWaktumasukFrom ?>">
        sampai<input type="date" name="filterWaktumasukTo" value="<?= $filterWaktumasukTo ?>">
        <br>
        Waktu Expiry<br>
        dari<input type="date" name="filterWaktuexpiryFrom" value="<?= $filterWaktuexpiryFrom ?>">
        sampai<input type="date" name="filterWaktuexpiryTo" value="<?= $filterWaktuexpiryTo ?>">
        <br>
        <button type="reset">Reset</button>
        <button type="submit">Submit</button>
    </form>
</body>
</html>