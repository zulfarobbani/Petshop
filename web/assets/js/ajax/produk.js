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
    modal.find(".satuanItem").val(data.data.satuanItem);
    modal
      .find(".hargaItem")
      .val("Rp." + parseInt(data.data.hargaItem).toLocaleString());
    modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
    modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
    modal.find(".fotoItem").prop("src", "/assets/media/" + data.data.pathMedia);
  });
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
    modal.find(".satuanItem").val(data.data.satuanItem);
    modal.find(".hargaItem").val(data.data.hargaItem);
    modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
    modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
    modal.find(".fotoItem").prop("src", "/assets/media/" + data.data.pathMedia);
    modal
      .find(".formEdit")
      .prop("action", "/produk/" + data.data.idItem + "/update");
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
    modal.find(".satuanItem").val(data.data.satuanItem);
    modal.find(".hargaItem").val(data.data.hargaItem);
    modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
    modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
    modal.find(".fotoItem").prop("src", "/assets/media/" + data.data.pathMedia);
    modal
      .find(".formEdit")
      .prop("action", "/produk/" + data.data.idItem + "/update");
    modal
      .find(".hapusForm")
      .prop("action", "/produk/" + data.data.idItem + "/delete");
  });
});

$(document).on('click', '.btnActionHapus', function() {
    $(this).parent().find('.hapusForm').submit()
})
