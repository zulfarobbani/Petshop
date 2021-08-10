<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    @page {
        size: auto;
    }
</style>

<div style="font-family: 'Consolas', monospace;padding: 0 10px 20px 10px;">
    <center>
        <p style="font-size : 14pt; margin-bottom : 7px">Sambat Fauna Shop</p>
        <hr style="border : 1px dashed black">
        <div style="margin : 7px">
            <p style="font-size : 8pt; margin : 1px">Jl. Babakan Ciparay No. 17</p>
            <p style="font-size : 8pt; margin : 1px">Kota Bandung, Jawa Barat</p>
            <p style="font-size : 8pt; margin : 1px">Telp : 0895 0485 6051</p>
        </div>
        <hr style="border : 1px dashed black">
    </center>

    <div>
        <table style="font-size : 7pt">
            <tr>
                <td>Kasir</td>
                <td> : </td>
                <td><span><?= $detail['namaUser'] ?></span></td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td> : </td>
                <td><span><?= $detail['pelangganTransaksi'] ?></span></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td> : </td>
                <td><span></span><?= date('d F Y H:i:s', strtotime($detail['tanggalTransaksi'])) ?></td>
            </tr>
        </table>
    </div>
    <hr style="border : 1px dashed black">
    <div id="receiptProduk" style="font-size : 7pt">
        <?php foreach ($groupItem as $value) { ?>
            <!-- <b style="font-size : 25px"><?= $value['idItem'] ?></b><br> -->
            <b><?= $value['namaItem'] ?></b>
            <div><span>Rp.<?= number_format($value['hargaItemgr'], 2, ',', '.') ?></span> x <span><?= $value['jumlahBeli'] ?></span> <span><?= $value['satuanItemgr'] ?></span> <span style="float: right">Rp.<?= number_format($value['hargaItemgr'] * $value['jumlahBeli'], 2, ',', '.') ?></span></div>
        <?php $totalHarga += $value['hargaItemgr'] * $value['jumlahBeli'];
        } ?>
    </div>
    <hr style="border : 1px dashed black">

    <div id="harga" style="font-size : 7pt">
        <div id="subTotal">
            <span>Sub-Total</span><span style="float: right">Rp.<?= number_format($totalHarga, 2, ',', '.') ?></span>
        </div>
        <div id="grandTotal">
            <span>Grand Total</span><span style="float: right">Rp.<?= number_format($totalHarga, 2, ',', '.') ?></span>
        </div>
        <div id="Cash">
            <span>Cash</span><span style="float: right">Rp.<?= number_format($totalHarga, 2, ',', '.') ?></span>
        </div>
    </div>

    <center>
        <div style="font-size: 7pt;margin-top: 20px;">
            Teliti Sebelum Membeli, Barang Yang Telah Dibeli Tidak Dapat Dikembalikan<br><br>
            Instagram : sambatfs<br>
            Facebook : Sambat Fauna Shop<br>
            Email : sambatfaunashop13@gmail.com
    </div>
    </center>
</div>

<center>
<p>
    ---------------
</p>
</center>


<script>
    window.print();
</script>