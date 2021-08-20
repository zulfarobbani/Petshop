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
      '"><div class="row"><div class="col-3"><select class="form-select produk" name="idItem[]"><option value="">Produk</option>';

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
          element.namaItem + ' - ' + element.supplierItem +
          "</option>";
      }

      var jenishargaTransaksi = container.find(".jenisharga").val();

      tampilanHtml +=
        '</select></div><input type="hidden" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="' +
        jenishargaTransaksi +
        '"><input type="hidden" name="idHargaitem[]" class="idHarga" value=""><div class="col-3"><select class="satuan form-select" name="satuanItem[]"><option value="">Satuan</option></select></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" required></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        numberNextId +
        '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

      container.find(".transaksiProduk").append(tampilanHtml);

      var lastIndex = container.find(".produk").length - 1;

      var example = new Choices(container.find(".produk")[lastIndex]);
      var choices = [];
      for (let index = 0; index < datas.datas.length; index++) {
        const element = datas.datas[index];
        choices.push({ value: element.idItem, label: element.namaItem });
      }
      example.setChoices(choices, "Produk");
    });
  });

  $(document).on("click", ".hapusList", function () {
    var elementId = $(this).val();
    var listProdukId = "#listproduk_" + elementId;

    $(listProdukId).remove();
  });

  $(document).on("change", ".produk", function () {
    var parent = $(this).closest(".listProduk");
    var jenis = parent.find(".jenisharga").val();
    if ($(this).val() != "") {
      $.ajax({
        type: "get",
        url: "/hargaItem/" + $(this).val() + "/get/" + jenis,
      }).done(function (data) {
        var satuan = "";
        if (data.datas.length > 0) {
          for (let index = 0; index < data.datas.length; index++) {
            const element = data.datas[index];
            satuan +=
              '<option value="' +
              element.satuanHargaitem +
              '">' +
              element.satuanHargaitem +
              "</option>";
          }
          parent.find(".satuan").html(satuan);
          parent.find(".harga").val(data.datas[0].harga);
          parent.find(".idHarga").val(data.datas[0].idHargaitem);
        } else {
          parent.find(".satuan").html("");
          parent.find(".harga").val("");
          parent.find(".idHarga").val("");
        }
      });
    }
  });

  $(document).on("change", ".satuan", function () {
    var parent = $(this).closest(".listProduk");
    var jenis = parent.find(".jenisharga").val();
    var produk = parent.find(".produk").val();
    if ($(this).val() != "") {
      $.ajax({
        type: "get",
        url: "/hargaItem/" + produk + "/get/" + jenis + "/" + $(this).val(),
      }).done(function (data) {
        parent.find(".harga").val(data.datas[0].harga);
        parent.find(".idHarga").val(data.datas[0].idHargaitem);
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
      modal.find(".tanggalTransaksi").val(data.detail.dateCreate);
      modal
        .find(".cetakReceipt")
        .prop(
          "href",
          "/transaksi/" + data.detail.idTransaksi + "/print-receipt"
        );

      modal
        .find(".formEdit")
        .prop("action", "/transaksi/" + data.detail.idTransaksi + "/update");
      modal.find(".transaksiProduk").html("");

      if (data.groupItem.length > 0) {
        for (let index1 = 0; index1 < data.groupItem.length; index1++) {
          var tampilanHtml = "";
          const element1 = data.groupItem[index1];

          tampilanHtml +=
            '<div class="listProduk" id="' +
            nextId +
            '"><div class="row"><div class="col-3"><select class="form-select produk" name="idItem[]"><option value="">Produk</option>';
          for (let index = 0; index < data.produk.length; index++) {
            const element3 = data.produk[index];
            tampilanHtml +=
              "<option " +
              (element3.idItem == element1.idItem ? "selected" : "") +
              ' value="' +
              element3.idItem +
              '">' +
              element3.namaItem +
              "</option>";
          }

          // var lastElementId = modal
          //   .find(".transaksiProduk > .listProduk:last")
          //   .attr("id");
          // var lastId = lastElementId.split("_")[1];
          var lastId = 1;
          var numberNextId = ++lastId;
          var nextId = "listproduk_" + numberNextId;

          var jenishargaTransaksi = modal.find(".jenisharga").val();
          var satuan = "";
          for (let j = 0; j < element1.satuan.length; j++) {
            const element2 = element1.satuan[j];
            satuan +=
              "<option " +
              (element2.idHargaitem == element1.idHargaitem ? "selected" : "") +
              ' value="' +
              element2.satuanHargaitem +
              '">' +
              element2.satuanHargaitem +
              "</option>";
          }

          var btnHapus =
            index1 > 0
              ? '<div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
                numberNextId +
                '"><i class="fas fa-minus-circle"></i></button></div>'
              : "";

          tampilanHtml +=
            '</select></div><input type="hidden" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="' +
            jenishargaTransaksi +
            '"><input type="hidden" name="idHargaitem[]" class="idHarga" value="' +
            element1.idHargaitem +
            '"><div class="col-3"><select class="satuan form-select" name="satuanItem[]">' +
            satuan +
            '</select></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
            element1.hargaItemgr +
            '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
            element1.jumlahBeli +
            '"></div>' +
            btnHapus +
            "</div></div></div>";

          modal.find(".transaksiProduk").append(tampilanHtml);

          var lastIndex = modal.find(".produk").length - 1;

          var example = new Choices(modal.find(".produk")[lastIndex]);
          // var choices = [];
          // for (let index = 0; index < data.produk.length; index++) {
          //   const element3 = data.produk[index];
          //   choices.push({
          //     value: element3.idItem,
          //     label: element3.namaItem,
          //     selected: element3.idItem == element1.idItem ? true : false,
          //   });
          // }
          // example.setChoices(choices, "Produk");

          // tampilanHtml +=
          //   '<div class="listProduk" id="' +
          //   nextId +
          //   '"><div class="row"><div class="col-3"><select name="idItem[]" class="produk form-control"><option value="-">Nama Produk</option>';

          // for (let index = 0; index < data.produk.length; index++) {
          //   const element = data.produk[index];
          //   tampilanHtml +=
          //     '<option value="' +
          //     element.idItem +
          //     '"' +
          //     (element1.idItem == element.idItem ? "selected" : "") +
          //     ">" +
          //     element.namaItem +
          //     "</option>";
          // }

          // <b>Harga Produk : <span class="hargaItem">Rp.' +
          //   parseInt(element1.hargaItem).toLocaleString() +
          //   '</span></b>

          // var totalHargaitem =
          //   parseInt(element1.hargaItem) * element1.jumlahBeli;
          // tampilanHtml +=
          //   '</select></div><div class="col-3"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
          //   element1.satuanItem +
          //   '"></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
          //   element1.hargaItemgr +
          //   '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
          //   element1.jumlahBeli +
          //   '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
          //   numberNextId +
          //   '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

          // tampilanHtml +=
          // '</select></div><div class="col-2"><input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="' +
          // element1.jenishargaItem +
          // '"></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
          // element1.satuanItemgr +
          // '"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
          // element1.hargaItemgr +
          // '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" max="' +
          // element1.stockItem +
          // '" placeholder="Qty" class="kuantiti form-control" value="' +
          // element1.jumlahBeli +
          // '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
          // numberNextId +
          // '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

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

        // modal.find(".transaksiProduk").html(tampilanHtml);
      } else {
        var tampilanHtml = "";
        var nextId = "listproduk_1";

        tampilanHtml +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-3"><select class="form-select produk" name="idItem[]"><option value="">Produk</option>';
        for (let index = 0; index < data.produk.length; index++) {
          const element3 = data.produk[index];
          tampilanHtml +=
            '<option value="' +
            element3.idItem +
            '">' +
            element3.namaItem +
            "</option>";
        }

        var jenishargaTransaksi = modal.find(".jenisharga").val();
        var satuan = "";

        tampilanHtml +=
          '</select></div><input type="hidden" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="' +
          jenishargaTransaksi +
          '"><input type="hidden" name="idHargaitem[]" class="idHarga" value=""><div class="col-3"><select class="satuan form-select" name="satuanItem[]"></select></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value=""></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value=""></div></div></div></div>';

        modal.find(".transaksiProduk").append(tampilanHtml);

        var lastIndex = modal.find(".produk").length - 1;

        var example = new Choices(modal.find(".produk")[lastIndex]);

        // tampilanHtml +=
        //   '<div class="listProduk" id="' +
        //   nextId +
        //   '"><div class="row"><div class="col-7"><select name="idItem[]" class="produk form-control"><option value="-">Produk</option>';

        // for (let index = 0; index < data.produk.length; index++) {
        //   const element = data.produk[index];
        //   tampilanHtml +=
        //     '<option value="' +
        //     element.idItem +
        //     '">' +
        //     element.namaItem +
        //     "</option>";
        // }

        // tampilanHtml +=
        //   '</select></div><div class="col"><input type="number" name="kuantitiItem[]" min="1" max="" placeholder="Qty" class="kuantiti form-control" value=""><b>Stock Produk : <span class="stockItem"></span></b></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="1"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

        // modal.find(".transaksiProduk").html(tampilanHtml);
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

  $('.btnSubmitRetur').on('click', function() {
    $("#modalreturproduct").find(".formRetur").submit();
  })

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
      modal.find(".tanggalTransaksi").val(data.detail.dateCreate);
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
          '"><div class="row"><div class="col-7"><input type="text" class="form-control" value="'+element1.namaItem+'" disabled><span><b>Kuantiti akhir pembelian : </b><input type="text" value="'+(element1.jumlahBeli - element1.pengurangItem)+'" disabled></span><br><span><b>Total akhir pembelian : <input type="text" value="'+(parseInt(element1.hargaItemgr)*(element1.jumlahBeli - element1.pengurangItem))+'" disabled></b></span>';

        tampilanHtmlDetail +=
          '<div class="listProduk" id="' +
          nextId +
          '"><div class="row"><div class="col-4"><input type="text" class="form-control" value="'+element1.namaItem+'" disabled>';

        // for (let index = 0; index < data.produk.length; index++) {
        //   const element = data.produk[index];

        //   tampilanHtmlDetail +=
        //     '<option value="' +
        //     element.idItem +
        //     '"' +
        //     (element1.idItem == element.idItem ? "selected" : "") +
        //     ">" +
        //     element.namaItem +
        //     "</option>";
        // }

        // tampilanHtml +=
        //   '</select></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
        //   element1.satuanItemgr +
        //   '"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
        //   element1.hargaItemgr +
        //   '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" max="' +
        //   element1.stockItem +
        //   '" placeholder="Qty" class="kuantiti form-control" value="' +
        //   element1.jumlahBeli +
        //   '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        //   numberNextId +
        //   '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';

        tampilanHtml +=
          '</div><div class="col"><input type="number" name="' +
          element1.idGroupitem +
          '" min="0" max="'+element1.jumlahBeli+'" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.pengurangItem +
          '"></div><div class="col"><input type="text" class="form-control" value="'+element1.satuanItemgr+'" disabled></div></div></div></div>';

        tampilanHtmlDetail +=
          '</div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
          element1.satuanItemgr +
          '" disabled></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
          element1.hargaItemgr +
          '" disabled></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" max="' +
          element1.stockItem +
          '" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.jumlahBeli +
          '" disabled></div></div></div></div>';

        // tampilanHtmlDetail +=
        // '</select><b>Harga Produk : <span class="hargaItem">Rp.' +
        // parseInt(element1.hargaItem).toLocaleString() +
        // '</span></b></div><div class="col-2"><input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control" value="' +
        // element1.jenishargaItem +
        // '"></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
        // element1.satuanItemgr +
        // '"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
        // element1.hargaItemgr +
        // '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" max="' +
        // element1.stockItem +
        // '" placeholder="Qty" class="kuantiti form-control" value="' +
        // element1.jumlahBeli +
        // '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        // numberNextId +
        // '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';
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
      modal.find(".tanggalTransaksi").val(data.detail.dateCreate);
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
          '"><div class="row"><div class="col-4"><select name="idItem[]" class="produk form-control" disabled><option value="-">Nama Produk</option>';

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
          '</select></div><div class="col-3"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
          element1.satuanItemgr +
          '" disabled></div><div class="col-3"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
          element1.hargaItemgr +
          '" disabled></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
          element1.jumlahBeli +
          '" disabled></div></div></div></div>';

        // tampilanHtml +=
        // '</select><b>Harga Produk : <span class="hargaItem">Rp.' +
        // parseInt(element1.hargaItem).toLocaleString() +
        // '</span></b></div><div class="col-2"><input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control" value="' +
        // element1.satuanItemgr +
        // '"></div><div class="col-2"><input type="number" name="hargaItem[]" placeholder="Harga" min="1" class="harga form-control" value="' +
        // element1.hargaItemgr +
        // '"></div><div class="col-2"><input type="number" name="kuantitiItem[]" min="1" placeholder="Qty" class="kuantiti form-control" value="' +
        // element1.jumlahBeli +
        // '"></div><div class="col-1"><button type="button" class="hapusList btn btn-sm btn-danger" value="' +
        // numberNextId +
        // '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>';
      }

      modal.find(".transaksiProduk").html(tampilanHtml);
    });
  });
});
