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
    modal.find(".stockItem").val(data.data.stockItem);
    modal.find(".satuanItem").val(data.data.satuanItem);
    modal
      .find(".hargaItem")
      .val("Rp." + parseInt(data.data.hargaItem).toLocaleString());
    
    modal
    .find(".hargaperpcsItem")
    .val("Rp." + parseInt(data.data.hargaperpcsItem).toLocaleString());
    modal.find(".tanggalmasukProduk").val(data.data.tanggalmasukProduk);
    modal.find(".tanggalexpiryProduk").val(data.data.tanggalexpiryProduk);
    modal.find(".fotoItem").prop("src", "/assets/media/" + data.data.pathMedia);
    // console.log()
    modal.find(".btnAktivitas").prop("idproduk", id);
    // modal.find(".btnAktivitas").setAttribute('idproduk', id)

    var modalAktivitas = $('#modalaktivitasproduct');
    var isiAktivitas = "";
    $.ajax({
      type: "get",
      url: "/produk/"+id+"/activity"
    }).done(function(data) {
      for (let index = 0; index < data.data.length; index++) {
        const element = data.data[index];
        isiAktivitas+= "<tr><td>"+(index+1)+"</td><td>"+element.deskripsiChronology+"</td><td>"+element.dateCreate+"</td></tr>";
      }
      modalAktivitas.find('.bodyAktivitas').html(isiAktivitas);
    })
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
    modal.find(".stockItem").html(data.data.stockItem);
    modal.find(".satuanItem").val(data.data.satuanItem);
    modal.find(".hargaItem").val(data.data.hargaItem);
    modal.find(".hargaperpcsItem").val(data.data.hargaperpcsItem);
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
    modal.find(".hargaperpcsItem").val(data.data.hargaperpcsItem);
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
