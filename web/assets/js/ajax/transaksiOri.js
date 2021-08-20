$(document).ready(function () {
  $(".tambahListProduk").on("click", function () {
    var container = $(this).parent();
    var lastElementId = container
      .find(".transaksiProduk > .listProduk:last")
      .attr("id");
    var lastId = lastElementId.split("_")[1];
    var numberNextId = ++lastId;
    var nextId = "listproduk_" + numberNextId;

    var tampilanHtml =
      '<div class="listProduk" id="' +
      nextId +
      '"><div class="row"><div class="col-3"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

    // ajax get all produk
    $.ajax({
      type: "get",
      url: "/produk/get-all",
    }).done(function (datas) {
      for (let index = 0; index < datas.datas.length; index++) {
        const element = datas.datas[index];
        tampilanHtml +=
          '<option value="' +
          element.idItem +
          '">' +
          element.namaItem +
          "</option>";
      }

      tampilanHtml +=
        '</select></div><div class="col-2"> <input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control"></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control"><b>Stock: <span class="stockItem"></span></b></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        numberNextId +
        '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

      container.find(".transaksiProduk").append(tampilanHtml);
    });
  });

  $(document).on("click", ".hapusList", function () {
    var elementId = $(this).val();
    var listProdukId = "#listproduk_" + elementId;

    $(listProdukId).remove();
  });

  $(document).on("change", ".produk", function () {
    var parent = $(this).parent().parent();
    var kuantiti = 0;
    var hargaItem = 0;
    if ($(this).val() != "") {
      $.ajax({
        type: "get",
        url: "/produk/" + $(this).val() + "/get",
      }).done(function (data) {
        kuantiti = parent.find(".kuantiti").val();
        hargaItem = parseInt(data.data.hargaItem);
        totalhargaItem = kuantiti * parseInt(data.data.hargaItem);
        parent.find(".kuantiti").prop("max", data.data.stockItem);
        parent.find(".stockItem").html(data.data.stockItem);
        parent.find(".hargaItem").html("Rp."+hargaItem.toLocaleString())
        // parent.find(".totalHargaitem").html("Rp."+totalHargaitem.toLocaleString())
      });
    }
  });

  $(document).on("click", ".btnEdit", function () {
    var id = $(this).attr("data-bs-idTransaksi");
    var modal = $("#modalubahproduct");
    $.ajax({
      type: "get",
      url: "/transaksi/" + id + "/get",
    }).done(function (data) {
      modal.find(".nomorTransaksi").val(data.detail.nomorTransaksi);
      modal.find(".pelangganTransaksi").val(data.detail.pelangganTransaksi);
      modal.find(".tanggalTransaksi").val(data.detail.tanggalTransaksi);
      modal.find(".statusTransaksi").val(data.detail.statusTransaksi);
      modal
        .find(".cetakReceipt")
        .prop(
          "href",
          "/transaksi/" + data.detail.idTransaksi + "/print-receipt"
        );

      modal
        .find(".formEdit")
        .prop("action", "/transaksi/" + data.detail.idTransaksi + "/update");

      if (data.groupItem.length > 0) {
        var tampilanHtml = "";
        for (let index1 = 0; index1 < data.groupItem.length; index1++) {
          const element1 = data.groupItem[index1];

          var lastElementId = modal
            .find(".transaksiProduk > .listProduk:last")
            .attr("id");
          var lastId = lastElementId.split("_")[1];
          var numberNextId = ++lastId;
          var nextId = "listproduk_" + numberNextId;

          tampilanHtml +=
            '<div class="listProduk" id="' +
            nextId +
            '"><div class="row"><div class="col-3"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

          for (let index = 0; index < data.produk.length; index++) {
            const element = data.produk[index];
            tampilanHtml +=
              '<option value="' +
              element.idItem +
              '"' +
              (element1.idItem == element.idItem ? "selected" : "") +
              ">" +
              element.namaItem +
              "</option>";
          }

          var totalHargaitem = parseInt(element1.hargaItem) * element1.jumlahBeli;
          tampilanHtml +=
            '</select><b>Harga Produk : <span class="hargaItem">Rp.'+parseInt(element1.hargaItem).toLocaleString()+'</span></b></div><div class="col-2"><input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="'+
            element1.jenishargaItem+
            '"></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="'+
            element1.satuanItemgr+
            '"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="'+
            element1.hargaItemgr+
            '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" max="' +
            element1.stockItem +
            '" placeholder="Qty" class="kuantiti form-control" value="' +
            element1.jumlahBeli +
            '"><b>Stock: ' +
            element1.stockItem +
            '</b></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
            numberNextId +
            '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';
            // tampilanHtml +=
            // '</select><b>Harga Produk : <span class="hargaItem">Rp.'+parseInt(element1.hargaItem).toLocaleString()+'</span></b><br><b>Total Harga: <span class="totalHargaitem">Rp.'+totalHargaitem.toLocaleString()+'</span></b></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" max="' +
            // element1.stockItem +
            // '" placeholder="Qty" class="kuantiti form-control" value="' +
            // element1.jumlahBeli +
            // '"><b>Stock Produk : ' +
            // element1.stockItem +
            // '</b></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
            // numberNextId +
            // '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';
        }

        modal.find(".transaksiProduk").html(tampilanHtml);
      } else {
        var tampilanHtml = "";
        var nextId = "listproduk_1";

        tampilanHtml +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

        for (let index = 0; index < data.produk.length; index++) {
          const element = data.produk[index];
          tampilanHtml +=
            '<option value="' +
            element.idItem +
            '">' +
            element.namaItem +
            '</option>';
        }

        tampilanHtml +=
          '</select></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" max="" placeholder="Qty" class="kuantiti form-control" value=""><b>Stock Produk : <span class="stockItem"></span></b></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="1"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

        modal.find(".transaksiProduk").html(tampilanHtml);
      }

      var modalAktivitas = $("#modalaktivitasproduct");
      var isiAktivitas = "";
      $.ajax({
        type: "get",
        url: "/produk/" + id + "/activity",
      }).done(function (data) {
        for (let index = 0; index < data.data.length; index++) {
          const element = data.data[index];
          isiAktivitas +=
            "<tr><td>" +
            (index + 1) +
            "</td><td>" +
            element.deskripsiChronology +
            "</td><td>" +
            element.dateCreate +
            "</td></tr>";
        }
        modalAktivitas.find(".bodyAktivitas").html(isiAktivitas);
      });
    });
  });

  $(document).on("click", ".btnRetur", function () {
    var id = $(this).attr("data-bs-idTransaksi");
    var modal = $("#modalreturproduct");
    $.ajax({
      type: "get",
      url: "/transaksi/" + id + "/get",
    }).done(function (data) {
      modal.find(".nomorTransaksi").val(data.detail.nomorTransaksi);
      modal.find(".pelangganTransaksi").val(data.detail.pelangganTransaksi);
      modal.find(".tanggalTransaksi").val(data.detail.tanggalTransaksi);
      modal.find(".statusTransaksi").val(data.detail.statusTransaksi);
      // modal
      //   .find(".cetakReceipt")
      //   .prop(
      //     "href",
      //     "/transaksi/" + data.detail.idTransaksi + "/print-receipt"
      //   );

      modal
        .find(".formRetur")
        .prop(
          "action",
          "/transaksi/" + data.detail.idTransaksi + "/retur-store"
        );

      // $("#transaksiProduk").html('');
      var tampilanHtml = "";
      var tampilanHtmlDetail = "";
      for (let index1 = 0; index1 < data.groupItem.length; index1++) {
        const element1 = data.groupItem[index1];

        var lastElementId = $(".transaksiProduk > .listProduk:last").attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listproduk_" + numberNextId;

        tampilanHtml +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control" disabled><option value="-">Nama Produk</option>';

        tampilanHtmlDetail +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control" disabled><option value="-">Nama Produk</option>';

        for (let index = 0; index < data.produk.length; index++) {
          const element = data.produk[index];
          tampilanHtml +=
            '<option value="' +
            element.idItem +
            '"' +
            (element1.idItem == element.idItem ? "selected" : "") +
            ">" +
            element.namaItem +
            "</option>";

          tampilanHtmlDetail +=
            '<option value="' +
            element.idItem +
            '"' +
            (element1.idItem == element.idItem ? "selected" : "") +
            ">" +
            element.namaItem +
            "</option>";
        }

        tampilanHtml +=
          '</select></div><div class="col"><input type="number" name="' +
          element1.idItem +
          '" min="1" max="' +
          element1.stockItem +
          '" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.pengurangItem +
          '"><b>Stock Barang : ' +
          element1.stockItem +
          "</b></div></div></div></div>";

        tampilanHtmlDetail +=
          '</select></div><div class="col"><input type="number" name="' +
          element1.idItem +
          '" min="1" placeholder="Qty" class="kuantiti form-control" disabled value="' +
          element1.jumlahBeli +
          '"></div></div></div></div>';
      }

      modal.find(".transaksiProduk").html(tampilanHtml);

      modal.find(".transaksiProdukDetail").html(tampilanHtmlDetail);
    });
  });

  $(document).on("click", ".btnDetail", function () {
    var id = $(this).attr("data-bs-idTransaksi");
    var modal = $("#modalrincianproduct");
    $.ajax({
      type: "get",
      url: "/transaksi/" + id + "/get",
    }).done(function (data) {
      modal.find(".nomorTransaksi").val(data.detail.nomorTransaksi);
      modal.find(".pelangganTransaksi").val(data.detail.pelangganTransaksi);
      modal.find(".tanggalTransaksi").val(data.detail.tanggalTransaksi);
      modal.find(".statusTransaksi").val(data.detail.statusTransaksi);
      modal
        .find(".cetakReceipt")
        .prop(
          "href",
          "/transaksi/" + data.detail.idTransaksi + "/print-receipt"
        );

      modal
        .find(".formEdit")
        .prop("action", "/transaksi/" + data.detail.idTransaksi + "/update");

      // $("#transaksiProduk").html('');
      var tampilanHtml = "";
      for (let index1 = 0; index1 < data.groupItem.length; index1++) {
        const element1 = data.groupItem[index1];

        var lastElementId = modal
          .find(".transaksiProduk > .listProduk:last")
          .attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listproduk_" + numberNextId;

        tampilanHtml +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control" disabled><option value="-">Nama Produk</option>';

        for (let index = 0; index < data.produk.length; index++) {
          const element = data.produk[index];
          tampilanHtml +=
            '<option value="' +
            element.idItem +
            '"' +
            (element1.idItem == element.idItem ? "selected" : "") +
            ">" +
            element.namaItem +
            "</option>";
        }

        tampilanHtml +=
          '</select><b>Harga Produk : <span class="hargaItem">Rp.'+parseInt(element1.hargaItem).toLocaleString()+'</span></b></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.jumlahBeli +
          '" disabled><b>Stock Produk : ' +
          element1.stockItem +
          "</b></div></div></div></div>";
      }

      modal.find(".transaksiProduk").html(tampilanHtml);
    });
  });
});
