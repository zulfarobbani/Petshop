<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="http://fonts.cdnfonts.com/css/ocr-a-extended" rel="stylesheet">
                
    <style>
        @page {
            size: auto;
            margin: 0px 50px;
        }
    </style>

    <title>Transaction Receipt</title>
    
  </head>
  <body style="font-family: 'OCR A Extended', sans-serif;">
    <!-- HTML FOR PRINT RECEIPT TRANSACTION -->
    <div id="receiptTemplate" >
        <center>
            <p style="font-size : 60px; margin : 35px">Sambat Fauna Shop</p><hr style="border : 1px dashed black">
            <div style="margin : 20px">
                <p style="font-size : 30px; margin : 10px" >Jl. Babakan Ciparay No. 17</p>
                <p style="font-size : 30px; margin : 10px" >Kota Bandung, Jawa Barat</p>
                <p style="font-size : 30px; margin : 10px" >Telp : 0895 0485 6051</p>
            </div> <hr style="border : 1px dashed black">
        </center>

        <div style="margin : 15px; font-size : 20px"> 
            <table>
                <tr>
                    <td>No</td>
                    <td> : </td>
                    <td><span id="receiptNoTran"><?= $detail['nomorTransaksi']?></span></td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td> : </td>
                    <td><span id="receiptKasTran"><?= $detail['namaUser']?></span></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td> : </td>
                    <td><span id="receiptPelTran"><?= $detail['pelangganTransaksi']?></span></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td> : </td>
                    <td><span id="receiptTglTran"></span><?= date('d F Y', strtotime($detail['tanggalTransaksi']))?></td>
                </tr>
                <tr>
                    <td>Jenis Transaksi</td>
                    <td> : </td>
                    <td><span id="receiptTglTran"></span><?= $detail['jenisTransaksi'] == '1' ? 'Grosir' : 'Eceran'?></td>
                </tr>
            </table>
        </div> <hr style="border : 1px dashed black">
        <div id="receiptProduk" style="margin : 20px; font-size : 20px">
            <?php foreach($groupItem as $value) {?>
                <b style="font-size : 25px"><?= $value['idItem']?></b><br>
                <b style="font-size : 25px"><?= $value['namaItem']?></b>
                <div><span>Rp. <?= number_format($value['hargaItem'], 2, ',', '.') ?></span> x <span><?= $value['jumlahBeli']?></span> <span><?= $value['satuanItem']?></span> <span style="float: right">Rp. <?= number_format($value['hargaItem'] * $value['jumlahBeli'], 2, ',', '.')?></span></div>
            <?php $totalHarga += $value['hargaItem'] * $value['jumlahBeli']; }?>
        </div><hr style="border : 1px dashed black">

        <div id="harga" style="margin : 20px; font-size : 20px">
            <div id="subTotal">
                <span>Sub-Total</span><span style="float: right">Rp. <?= number_format($totalHarga, 2, ',', '.')?></span>
            </div>
            <div id="grandTotal">
                <span>Grand Total</span><span style="float: right">Rp. <?= number_format($totalHarga, 2, ',', '.')?></span>
            </div>
            <div id="Cash">
                <span>Cash</span><span style="float: right">Rp. <?= number_format($totalHarga, 2, ',', '.')?></span>
            </div>
        </div>

        <center>
            <p>Teliti Sebelum Membeli, Barang Yang Telah Dibeli Tidak Dapat Dikembalikan</p>
            <p>Instagram : sambatfs</p>
            <p>Facebook : Sambat Fauna Shop</p>
            <p>Email : example@gmail.com</p>
        </center>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        window.print();

        window.onafterprint = function(){
            window.location = "/transaksi";
        };
    </script>
  </body>
</html>