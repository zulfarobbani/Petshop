$(document).ready(function () {
  $(".tambahListHarga").on("click", function () {
    var container = $(this).parent();
    var lastElementId = container
      .find(".masterHarga > .listHarga:last")
      .attr("id");
    var lastId = lastElementId.split("_")[1];
    var numberNextId = ++lastId;
    var nextId = "listHarga_" + numberNextId;

    var tampilanHtml =
      '<div class="listHarga" id="' +
      nextId +
      '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga"></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga"><option value="">-- Pilih Jenis Harga --</option><option value="1">Harga Grosir</option><option value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga"></div><div class="col"><button type="button" class="hapusListHarga btn btn-sm btn-danger" value="' +
      numberNextId +
      '"><i class="fas fa-minus-circle"></i></button></div></div></div>';

    container.find(".masterHarga").append(tampilanHtml);
  });

  $(document).on('click', '.btnSubmitStore', function() {
    var modal = $(this).parents().find("#modaltambahproduct");
    modal.find('.formStore').submit();
    console.log(modal);
  })

  $(document).on("click", ".btnDetail", function () {
    var id = $(this).attr("data-bs-idItem");
    var modal = $("#modalrincianproduct");
    $.ajax({
      type: "get",
      url: "/produk/" + id + "/get",
    }).done(function (data) {
      modal.find(".namaItem").val(data.data.namaItem);
      modal.find(".supplierItem").val(data.data.supplierItem);
      modal.find(".kuantitiItem").val(data.data.kuantitiItem);
      modal.find(".stockItem").html(data.data.stockItem);
      modal.find(".satuanItem").val(data.data.satuanItem);
      modal.find(".hargaItem").val(data.data.hargaItem);
      modal.find(".hargaperpcsItem").val(data.data.hargaperpcsItem);
      modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
      modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
      modal
        .find(".fotoItem")
        .prop("src", "/assets/media/" + data.data.pathMedia);
      modal
        .find(".formEdit")
        .prop("action", "/produk/" + data.data.idItem + "/update");
    });

    var tampilanHtml = "";

    $.ajax({
      type: "get",
      url: "/hargaItem/" + id + "/get",
    }).done(function (data) {
      if (data.datas.length > 0) {
        for (let index = 0; index < data.datas.length; index++) {
          const element = data.datas[index];
          tampilanHtml +=
            '<div class="listHarga" id="listHarga_' +
            index +
            '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga" value="' +
            element.satuanHargaitem +
            '" disabled></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga" disabled><option value="">-- Pilih Jenis Harga --</option><option ' +
            (element.jenisHargaitem == "1" ? "selected" : "") +
            ' value="1">Harga Grosir</option><option ' +
            (element.jenisHargaitem == "2" ? "selected" : "") +
            ' value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga" value="' +
            element.harga +
            '" disabled></div>';
        }
        modal.find(".masterHarga").html(tampilanHtml);
      } else {
        var lastElementId = modal
          .find(".masterHarga > .listHarga:last")
          .attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listHarga_" + numberNextId;

        tampilanHtml +=
          '<div class="listHarga" id="' +
          nextId +
          '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga" disabled></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga" disabled><option value="">-- Pilih Jenis Harga --</option><option value="1">Harga Grosir</option><option value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga" disabled></div></div></div>';

        modal.find(".masterHarga").html(tampilanHtml);
      }
    });
  });

  $(document).on("click", ".hapusListHarga", function () {
    var elementId = $(this).val();
    var listProdukId = "#listHarga_" + elementId;

    $(listProdukId).remove();
  });

  $(document).on("click", ".btnEdit", function () {
    var id = $(this).attr("data-bs-idItem");
    var modal = $("#modalubahproduct");
    $.ajax({
      type: "get",
      url: "/produk/" + id + "/get",
    }).done(function (data) {
      modal.find(".namaItem").val(data.data.namaItem);
      modal.find(".supplierItem").val(data.data.supplierItem);
      modal.find(".kuantitiItem").val(data.data.kuantitiItem);
      modal.find(".stockItem").html(data.data.stockItem);
      modal.find(".satuanItem").val(data.data.satuanItem);
      modal.find(".hargaItem").val(data.data.hargaItem);
      modal.find(".hargaperpcsItem").val(data.data.hargaperpcsItem);
      modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
      modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
      modal
        .find(".fotoItem")
        .prop("src", "/assets/media/" + data.data.pathMedia);
      modal
        .find(".formEdit")
        .prop("action", "/produk/" + data.data.idItem + "/update");
    });

    var tampilanHtml = "";

    $.ajax({
      type: "get",
      url: "/hargaItem/" + id + "/get",
    }).done(function (data) {
      if (data.datas.length > 0) {
        for (let index = 0; index < data.datas.length; index++) {
          const element = data.datas[index];
          tampilanHtml +=
            '<div class="listHarga" id="listHarga_' +
            (index+1) +
            '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga" value="' +
            element.satuanHargaitem +
            '"></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga"><option value="">-- Pilih Jenis Harga --</option><option ' +
            (element.jenisHargaitem == "1" ? "selected" : "") +
            ' value="1">Harga Grosir</option><option ' +
            (element.jenisHargaitem == "2" ? "selected" : "") +
            ' value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga" value="' +
            element.harga +
            '"></div>';
          tampilanHtml +=
            index > 0
              ? '<div class="col"><button type="button" class="hapusListHarga btn btn-sm btn-danger" value="' +
                (index+1) +
                '"><i class="fas fa-minus-circle"></i></button></div></div></div></div>'
              : "</div></div></div>";
        }
        modal.find(".masterHarga").html(tampilanHtml);
      } else {
        var lastElementId = modal
          .find(".masterHarga > .listHarga:last")
          .attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listHarga_" + numberNextId;

        tampilanHtml +=
          '<div class="listHarga" id="' +
          nextId +
          '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga"></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga"><option value="">-- Pilih Jenis Harga --</option><option value="1">Harga Grosir</option><option value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga"></div></div></div>';

        modal.find(".masterHarga").html(tampilanHtml);
      }
    });
  });

  $(document).on("click", ".btnHapus", function () {
    var id = $(this).attr("data-bs-idItem");
    var modal = $("#modalhapusproduct");
    $.ajax({
      type: "get",
      url: "/produk/" + id + "/get",
    }).done(function (data) {
      modal.find(".namaItem").val(data.data.namaItem);
      modal.find(".supplierItem").val(data.data.supplierItem);
      modal.find(".kuantitiItem").val(data.data.kuantitiItem);
      modal.find(".stockItem").html(data.data.stockItem);
      modal.find(".satuanItem").val(data.data.satuanItem);
      modal.find(".hargaItem").val(data.data.hargaItem);
      modal.find(".hargaperpcsItem").val(data.data.hargaperpcsItem);
      modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
      modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
      modal
        .find(".fotoItem")
        .prop("src", "/assets/media/" + data.data.pathMedia);
      modal
        .find(".hapusForm")
        .prop("action", "/produk/" + data.data.idItem + "/delete");
    });

    var tampilanHtml = "";

    $.ajax({
      type: "get",
      url: "/hargaItem/" + id + "/get",
    }).done(function (data) {
      if (data.datas.length > 0) {
        for (let index = 0; index < data.datas.length; index++) {
          const element = data.datas[index];
          tampilanHtml +=
            '<div class="listHarga" id="listHarga_' +
            index +
            '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga" value="' +
            element.satuanHargaitem +
            '" disabled></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga" disabled><option value="">-- Pilih Jenis Harga --</option><option ' +
            (element.jenisHargaitem == "1" ? "selected" : "") +
            ' value="1">Harga Grosir</option><option ' +
            (element.jenisHargaitem == "2" ? "selected" : "") +
            ' value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga" value="' +
            element.harga +
            '" disabled></div>';
        }
        modal.find(".masterHarga").html(tampilanHtml);
      } else {
        var lastElementId = modal
          .find(".masterHarga > .listHarga:last")
          .attr("id");
        var lastId = lastElementId.split("_")[1];
        var numberNextId = ++lastId;
        var nextId = "listHarga_" + numberNextId;

        tampilanHtml +=
          '<div class="listHarga" id="' +
          nextId +
          '"><div class="row"><div class="col-3"><input type="text" name="satuanHarga[]" class="form-control satuanHarga" disabled></div><div class="col-4"><select name="jenisHarga[]" class="form-control jenisHarga" disabled><option value="">-- Pilih Jenis Harga --</option><option value="1">Harga Grosir</option><option value="2">Harga Eceran</option></select></div><div class="col-4"><input type="text" name="hargaHarga[]" class="form-control hargaHarga" disabled></div></div></div>';

        modal.find(".masterHarga").html(tampilanHtml);
      }
    });
  });

  $(document).on("click", ".btnActionHapus", function () {
    $(this).parent().find(".hapusForm").submit();
  });
});
