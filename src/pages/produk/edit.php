<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
    <form action="/produk/<?= $datas['idItem']?>/update" method="POST" enctype="multipart/form-data">
        <input type="file" name="fotoItem"><br>
        <label>Nama Produk : </label><input type="text" name="namaItem" value="<?= $datas['namaItem']?>"><br>
        <label>Nama Supplier : </label><input type="text" name="supplierItem" value="<?= $datas['supplierItem'] ?>"><br>
        <label>Kuantiti : </label><input type="text" name="kuantitiItem" value="<?= $datas['kuantitiItem'] ?>"><br>
        <label>Satuan : </label><input type="text" name="satuanItem" value="<?= $datas['satuanItem'] ?>"><br>
        <label>Harga : </label><input type="text" name="hargaItem"  value="<?= $datas['hargaItem'] ?>"><br>
        <label>Waktu Masuk Produk : </label><input type="date" name="tanggalmasukProduk" value="<?= $datas['tanggalmasukProduk'] ?>"><br>
        <label>Waktu Expiry Produk : </label><input type="date" name="tanggalexpiryProduk" value="<?= $datas['tanggalexpiryProduk'] ?>"><br>
        <button type="submit">Simpan</button>
    </form>

    </fieldset>
</body>
</html>