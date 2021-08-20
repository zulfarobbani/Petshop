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

    <form method="POST" action="/transaksi/<?= $detail['idTransaksi'] ?>/update" enctype="multipart/form-data">
        <input type="text" placeholder="Nomor Receipt" name="nomorTransaksi" value="<?= $detail['nomorTransaksi'] ?>">
        <input type="text" placeholder="Pelanggan" name="pelangganTransaksi" value="<?= $detail['pelangganTransaksi'] ?>">
        <input type="text" placeholder="Kasir" name="kasirTransaksi" value="<?= $detail['kasirTransaksi'] ?>">
        <select name="idClient">
            <option <?= $detail['idClient'] == 'client1' ? 'selected' : '' ?> value="client1">Client 1</option>
            <option <?= $detail['idClient'] == 'client2' ? 'selected' : '' ?> value="client2">Client 2</option>
            <option <?= $detail['idClient'] == 'client3' ? 'selected' : '' ?> value="client3">Client 3</option>
        </select>
        <input type="date" placeholder="Tanggal" name="tanggalTransaksi" value="<?= $detail['tanggalTransaksi'] ?>">
        <div id="transaksiProduk">
            <button type="button" id="tambahListProduk"><i class="fas fa-plus-square"></i></button>
            <?php foreach ($groupItem as $key => $value) { ?>
                <div class="listProduk" id="listproduk_<?= ++$key ?>">
                    <select name="idItem[]" class="produk">
                        <option value="-">Nama Produk</option>
                        <?php foreach ($produk as $key => $value1) { ?>
                            <option <?= $value['idItem'] == $value1['idItem'] ? 'selected' : '' ?> value="<?= $value1['idItem'] ?>"><?= $value1['namaItem'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="number" class="kuantiti" name="kuantitiItem[]" min="1" placeholder="Qty" value="<?= $value['kuantitiItem'] ?>">
                    <button type="button" class="hapusList" value="<?= $key ?>"><i class="fas fa-minus-circle"></i></button>
                </div>
            <?php } ?>
            <!-- <div class="listProduk" id="listproduk_1">
                <select name="idItem[]">
                    <option value="-">Nama Produk</option>
                    <option value="namaProduk1">Produk 1</option>
                    <option value="namaProduk2">Produk 2</option>
                    <option value="namaProduk3">Produk 3</option>
                </select>
                <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty">
                <input type="text" placeholder="pengurangItem" name="pengurangItem[]">
            </div> -->
        </div>

        <button type="submit">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.returBarang').hide();

            $("#tambahListProduk").on("click", function() {

                var lastElementId = $("#transaksiProduk > .listProduk:last").attr('id');
                var lastId = lastElementId.split('_')[1];
                var numberNextId = ++lastId;
                var nextId = "listproduk_" + numberNextId;

                var tampilanHtml = '<div class="listProduk" id="' + nextId +
                    '"><select name="idItem[]"><option value="-">Nama Produk</option><option value="namaProduk1">Produk 1</option><option value="namaProduk2">Produk 2</option><option value="namaProduk3">Produk 3</option></select><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty"><button class="hapusList" value="' +
                    numberNextId + '"><i class="fas fa-minus-circle"></i></button></div>';

                $("#transaksiProduk").append(tampilanHtml);
            });

            $(document).on("click", ".hapusList", function() {
                var elementId = $(this).val();

                var listProdukId = "#listproduk_" + elementId;

                $(listProdukId).remove();
            });
        });
    </script>

</body>

</html>