$(document).ready(function () {
  $(".tambahListProduk").on("click", function () {
    var lastElementId = $(".transaksiProduk > .listProduk:last").attr("id");
    var lastId = lastElementId.split("_")[1];
    var numberNextId = ++lastId;
    var nextId = "listproduk_" + numberNextId;

    var tampilanHtml =
      '<div class="listProduk" id="' +
      nextId +
      '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

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
        '</select></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        numberNextId +
        '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

      $(".transaksiProduk").append(tampilanHtml);
    });
  });

  $(document).on("click", ".hapusList", function () {
    var elementId = $(this).val();
    var listProdukId = "#listproduk_" + elementId;

    $(listProdukId).remove();
  });

  $(document).on("change", ".produk", function () {
    var parent = $(this).parent();
    if ($(this).val() != "") {
      $.ajax({
        type: "get",
        url: "/produk/" + $(this).val() + "/get",
      }).done(function (data) {
        parent.find(".kuantiti").val(data.data.stockItem);
        parent.find(".kuantiti").prop("max", data.data.stockItem);
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

      // $("#transaksiProduk").html('');
      var tampilanHtml = "";
      for (let index1 = 0; index1 < data.groupItem.length; index1++) {
        const element1 = data.groupItem[index1];

        var lastElementId = $(".transaksiProduk > .listProduk:last").attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listproduk_" + numberNextId;

        tampilanHtml +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

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
          '</select></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.jumlahBeli +
          '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
          numberNextId +
          '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';
      }

      $(".transaksiProduk").html(tampilanHtml);
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

        var lastElementId = modal.find(".transaksiProduk > .listProduk:last").attr("id");
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
          '</select></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.jumlahBeli +
          '" disabled></div></div></div></div>';
      }

      modal.find(".transaksiProduk").html(tampilanHtml);
    });
  });
});
