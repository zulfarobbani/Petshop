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
    
    <div id="transaksiProduk">
        <button type="button" id="tambahListProduk"><i class="fas fa-plus-square"></i></button>
        <div class="listProduk" id="listproduk_1">
            <select name="namaProduk">
                <option value="-">Nama Produk</option>
                <option value="namaProduk1">Produk 1</option>
                <option value="namaProduk2">Produk 2</option>
                <option value="namaProduk3">Produk 3</option>
            </select>
            <input type="number" min='1' placeholder="Qty">
            <input type="text" placeholder="Satuan">
            <input type="text" min='1' placeholder="Harga">
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function(){
        $("#tambahListProduk").on("click", function(){

            var lastElementId = $("#transaksiProduk > .listProduk:last").attr('id');
            var lastId = lastElementId.split();
            var numberNextId = lastId++;
            var nextId = "listproduk_" + numberNextId;

            console.log(lastElementId, lastId);

            var tampilanHtml = '<div class="listProduk" id="'+ nextId +'"><select name="namaProduk"><option value="-">Nama Produk</option><option value="namaProduk1">Produk 1</option><option value="namaProduk2">Produk 2</option><option value="namaProduk3">Produk 3</option></select><input type="number" min="1" placeholder="Qty"><input type="text" placeholder="Satuan"><input type="text" min="1"placeholder="Harga"><button type="button"><i class="fas fa-minus-circle"></i></button></div>';

            $("#transaksiProduk").append(tampilanHtml);
        });
    });
</script>

</body>
</html>