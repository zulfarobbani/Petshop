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
    <form action="/produk/store" method="POST" enctype="multipart/form-data">
        <input type="file" name="fotoItem"><br>
        <label>Nama Produk : </label><input type="text" name="namaItem"><br>
        <label>Nama Supplier : </label><input type="text" name="supplierItem"><br>
        <label>Kuantiti : </label><input type="text" name="kuantitiItem"><br>
        <label>Satuan : </label><input type="text" name="satuanItem"><br>
        <label>Harga : </label><input type="text" name="hargaItem"><br>
        <label>Waktu Masuk Produk : </label><input type="date" name="tanggalmasukProduk"><br>
        <label>Waktu Expiry Produk : </label><input type="date" name="tanggalexpiryProduk"><br>
        <button type="submit">Simpan</button>
    </form>

    </fieldset>
</body>
</html>