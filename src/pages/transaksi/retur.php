<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Petshop</title>
</head>

<body>

    <form method="POST" action="/transaksi/<?= $detail['idTransaksi'] ?>/retur-store" enctype="multipart/form-data">
        <div class="returBarang">
            Barang yang diretur<br>
            <?php foreach ($groupItem as $key => $value) { ?>
                <div class="listProduk" id="listproduk_<?= ++$key ?>">
                    <select name="idItemRetur[]" disabled>
                        <option value="-">Nama Produk</option>
                        <?php foreach ($produk as $key => $value1) { ?>
                            <option <?= $value['idItem'] == $value1['idItem'] ? 'selected' : '' ?> value="<?= $value1['idItem'] ?>"><?= $value1['namaItem'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="number" class="kuantiti" name="kuantitiItem[]" min="1" placeholder="Qty" value="<?= $value['jumlahBeli'] ?>" disabled>
                    <input type="number" placeholder="pengurangItem" name="<?= $value['idItem'] ?>" value="<?= $value['pengurangItem'] ?>" max="<?= $value['jumlahBeli'] ?>" min="0">
                </div>
            <?php } ?>
        </div>

        <button type="submit">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            

        });
    </script>

</body>

</html>