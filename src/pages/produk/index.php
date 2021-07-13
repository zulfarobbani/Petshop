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
                <td>Supplier</td>
                <td><?= $values['kuantitiItem']?></td>
                <td>Satuan</td>
                <td><?= $values['dateCreate']?></td>
                <td>Waktu Expiry</td>
                <td><a href="produk/edit/<?= $values['idItem']?>">EDIT</a>||<a href="produk/delete/<?= $values['idItem']?>">DELETE</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>