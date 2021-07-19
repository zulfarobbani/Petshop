<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Petshop</title>
</head>

<body>

    <form method="POST" action="/transaksi/store" enctype="multipart/form-data">
        <input type="text" placeholder="Nomor Receipt" name="nomorTransaksi">
        <input type="text" placeholder="Pelanggan" name="pelangganTransaksi">
        <input type="text" placeholder="Kasir" name="kasirTransaksi">
        <select name="idClient">
            <option value="client1">Client 1</option>
            <option value="client2">Client 2</option>
            <option value="client3">Client 3</option>
        </select>
        <input type="date" placeholder="Tanggal" name="tanggalTransaksi">
        <div id="transaksiProduk">
            <button type="button" id="tambahListProduk"><i class="fas fa-plus-square"></i></button>
            <div class="listProduk" id="listproduk_1">
                <select name="idItem[]" class="produk">
                    <option value="">Nama Produk</option>
                    <?php foreach ($produk as $key => $value) { ?>
                        <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                    <?php } ?>
                </select>
                <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti">
                <!-- <input type="text" placeholder="pengurangItem" name="pengurangItem[]"> -->
            </div>
        </div>

        <button type="submit">Submit</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $("#tambahListProduk").on("click", function() {

                var lastElementId = $("#transaksiProduk > .listProduk:last").attr('id');
                var lastId = lastElementId.split('_')[1];
                var numberNextId = ++lastId;
                var nextId = "listproduk_" + numberNextId;
                var tampilanHtml = '<div class="listProduk" id="' + nextId + '"><select name="idItem[]"><option value="-">Nama Produk</option>'

                // ajax get all produk
                $.ajax({
                    type: 'get',
                    url: '/produk/get-all'
                }).done(function(datas) {
                    for (let index = 0; index < datas.datas.length; index++) {
                        const element = datas.datas[index];
                        tampilanHtml += '<option value="' + element.idItem + '">' + element.namaItem + '</option>';
                    }

                    tampilanHtml += '</select><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti"><button class="hapusList" value="' + numberNextId + '"><i class="fas fa-minus-circle"></i></button></div>';

                    $("#transaksiProduk").append(tampilanHtml);
                })
            });

            $(document).on("click", ".hapusList", function() {
                var elementId = $(this).val();

                var listProdukId = "#listproduk_" + elementId;

                $(listProdukId).remove();
            });

            $(document).on('change', '.produk', function() {
                var parent = $(this).parent();
                if ($(this).val() != '') {
                    $.ajax({
                        type: 'get',
                        url: '/produk/'+$(this).val()+'/get'
                    }).done(function(data) {
                        parent.find('.kuantiti').val(data.data.stockItem)
                        parent.find('.kuantiti').prop('max', data.data.stockItem)
                    })
                }
            })
        });
    </script>

</body>

</html>