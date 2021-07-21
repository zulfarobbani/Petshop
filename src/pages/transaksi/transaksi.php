<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Profile</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/assets/css/theme.css">


    <!-- Head Libs -->
    <script src="/assets/vendor/modernizr/modernizr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/assets/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
</head>

<body>
    <?php include(__DIR__ . '/../helper/header.php') ?>

    <div class="container mt-4">
        <div class="card p-3">
            <div class="row">
                <div class="col-6">
                    <h4>Transaction</h4>
                    <h6><?= $jenis_transaksi == '1' ? 'Grosir' : 'Eceran' ?></h6>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-sm text-white rounded-pill h-75 px-4" data-bs-toggle="modal" data-bs-target="#ModalTambahTransaksi" id="btnIjo">
                        <span class="material-icons-outlined">add_shopping_cart</span>
                        <span class="align-top">Tambah Transaksi</span></button>
                </div>
            </div>

            <!-- <div class="row mt-2 mb-2">
                <div class="col-1">
                    <select class="form-select float-start" aria-label="Default select example">
                        <option selected>No</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="col-7 float-start">
                    entries per page
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <input class="form-control w-50 float-end" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </div> -->

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nomor Receipt</th>
                            <th scope="col">Pelanggan</th>
                            <th scope="col">Kasir</th>
                            <th scope="col">Total Penjualan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $key => $data) { ?>
                            <tr>
                                <td><?= $data['nomorTransaksi'] ?></td>
                                <td><?= $data['pelangganTransaksi'] ?></td>
                                <td><?= $data['kasirTransaksi'] ?></td>
                                <td>Rp.<?= number_format($data['totalHargaTransaksi'], 2, ',', '.') ?></td>
                                <td><?= date('d M Y', strtotime($data['dateCreate'])) ?></td>
                                <td>
                                    <button type="button" class="btn px-2 py-1 text-white btnEdit" id="btnBiru" data-bs-toggle="modal" data-bs-target="#modalubahproduct" data-bs-idTransaksi="<?= $data['idTransaksi'] ?>"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn px-2 py-1 text-white btnDetail" id="btnKuning" data-bs-toggle="modal" data-bs-target="#modalrincianproduct" data-bs-idTransaksi="<?= $data['idTransaksi'] ?>"><i class="fa fa-search-plus"></i></button>

                                    <a href="/transaksi/<?= $data['idTransaksi'] ?>/print-receipt" class="btn px-2 py-1 text-white btnHapus" id="btnIjo" target="_blank"><i class="fas fa-print"></i></a>

                                    <button type="button" class="btn px-2 py-1 text-white btnRetur btn-sm" id="btnMerah" data-bs-toggle="modal" data-bs-target="#modalreturproduct" data-bs-idTransaksi="<?= $data['idTransaksi'] ?>"><i class="fa fa-arrow-left"></i> Retur Produk</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-6">
                    <h6 class="text-muted">Showing <?= $pagination['page_first_result'] + 1 ?> to <?= count($datas) ?> of <?= $pagination['countRows'] ?> entries</h6>
                </div>
                <div class="col-6">
                    <ul class="pagination float-end">
                        <li class="page-item <?= $pagination['current_page'] - 1 == 0 ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= intval($pagination['current_page']) - 1 ?>"><i class="fas fa-angle-left"></i></a></li>
                        <?php for ($page = 1; $page <= $pagination['number_of_page']; $page++) { ?>
                            <li class="page-item <?= $pagination['current_page'] == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a></li>
                        <?php } ?>
                        <li class="page-item <?= $pagination['current_page'] + 1 > $pagination['number_of_page'] ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= intval($pagination['current_page']) + 1 ?>"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Transaksi -->
    <div class="modal fade" id="ModalTambahTransaksi" tabindex="-1" aria-labelledby="ModalTambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTambah"><b>Tambah Transaksi</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/transaksi/store" method="post">
                    <div class="modal-body">
                        <h6>Transaksi <b><?= $jenis_transaksi == '1' ? 'Grosir' : 'Eceran' ?></b></h6>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label for="">Nomor Transaksi</label>
                                    <input type="text" class="form-control nomorTransaksi" name="nomorTransaksi" placeholder="RCP/07/21/2021">
                                </div>
                                <div class="mb-1">
                                    <label for="">Pelanggan Transaksi</label>
                                    <input type="text" class="form-control pelangganTransaksi" name="pelangganTransaksi" placeholder="Pelanggan A">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Transaksi</label>
                                    <input type="date" class="form-control tanggalTransaksi" name="tanggalTransaksi" placeholder="01/07/2021">
                                </div>
                                <!-- <div class="mb-1">
                                    <label for="">Status Transaksi</label>
                                    <select class="form-select statusTransaksi" name="statusTransaksi" aria-label="Default select example">
                                        <option>Status</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Complete</option>
                                        <option value="3">Return Barang</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="col">
                                <button type="button" class="btn rounded-pill px-3 btn-sm text-white mb-3 tambahListProduk" id="btnIjo"><i class="fas fa-plus-square"> Tambah Produk</i></button>
                                <div class="row">
                                    <div class="col-3">
                                        <h6>Produk</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Jenis Harga</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Satuan</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Harga</h6>
                                    </div>
                                    <div class="col-2">
                                        <h6>Kuantiti</h6>
                                    </div>
                                </div>
                                <div class="transaksiProduk">
                                    <div class="listProduk" id="listproduk_1">
                                        <div class="row">
                                            <div class="col-3">
                                                <select name="idItem[]" class="produk form-control">
                                                    <option value="">Nama Produk</option>
                                                    <?php foreach ($produk as $key => $value) { ?>
                                                        <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="hargaItem[]" placeholder="Harga" min='1' class="harga form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn rounded-pill px-3 btn-sm text-white" id="btnIjo">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Product -->
    <div class="modal fade" id="modalubahproduct" tabindex="-1" aria-labelledby="modalubah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubah"><b>Ubah Transaksi</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="formEdit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label for="">Nomor Transaksi</label>
                                    <input type="text" class="form-control nomorTransaksi" name="nomorTransaksi" placeholder="RCP/07/21/2021">
                                </div>
                                <div class="mb-1">
                                    <label for="">Pelanggan Transaksi</label>
                                    <input type="text" class="form-control pelangganTransaksi" name="pelangganTransaksi" placeholder="Pelanggan A">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Transaksi</label>
                                    <input type="date" class="form-control tanggalTransaksi" name="tanggalTransaksi" placeholder="01/07/2021">
                                </div>
                                <!-- <div class="mb-1">
                                    <label for="">Status Transaksi</label>
                                    <select class="form-select statusTransaksi" name="statusTransaksi" aria-label="Default select example">
                                        <option>Status</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Complete</option>
                                        <option value="3">Return Barang</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="col">
                                <button type="button" class="btn rounded-pill px-3 btn-sm text-white mb-3 tambahListProduk" id="btnIjo"><i class="fas fa-plus-square"> Tambah Produk</i></button>
                                <div class="transaksiProduk">
                                    <div class="listProduk" id="listproduk_1">
                                        <div class="row">
                                            <div class="col-3">
                                                <select name="idItem[]" class="produk form-control">
                                                    <option value="">Nama Produk</option>
                                                    <?php foreach ($produk as $key => $value) { ?>
                                                        <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="hargaItem[]" placeholder="Harga" min='1' class="harga form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti form-control">
                                            </div>
                                        </div>

                                        <!-- <input type="text" placeholder="pengurangItem" name="pengurangItem[]"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
                        <!-- <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnKuning">Pratinjau</button> -->
                        <a href="" class="btn rounded-pill px-3 btn-sm text-white cetakReceipt" id="btnBiru" target="_blank">Cetak</a>
                        <button type="submit" class="btn rounded-pill px-3 btn-sm text-white" id="btnIjo">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Product-->
    <!-- <div class="modal fade" id="modalhapusproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Product</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="RCP/07/21/2021" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pelanggan A">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="01/07/2021">
              </div>
              <div class="mb-1">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Status</option>
                  <option value="1">Draft</option>
                  <option value="2">Complete</option>
                  <option value="3">Return Barang</option>
                </select>
              </div>
            </form>
          </div>
          <div class="col-6">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah">Batal</button>
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnKuning">Hapus</button>
      </div>
    </div>
  </div>
</div> -->

    <!-- Modal Rincian Transaksi-->
    <div class="modal fade" id="modalrincianproduct" tabindex="-1" aria-labelledby="rincianproduct" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rincianproduct"><b>Rincian Transaksi</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="formEdit">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-1">
                                    <label for="">Nomor Transaksi</label>
                                    <input type="text" class="form-control nomorTransaksi" name="nomorTransaksi" placeholder="RCP/07/21/2021" disabled>
                                </div>
                                <div class="mb-1">
                                    <label for="">Pelanggan Transaksi</label>
                                    <input type="text" class="form-control pelangganTransaksi" name="pelangganTransaksi" placeholder="Pelanggan A" disabled>
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Transaksi</label>
                                    <input type="date" class="form-control tanggalTransaksi" name="tanggalTransaksi" placeholder="01/07/2021" disabled>
                                </div>
                                <!-- <div class="mb-1">
                                    <label for="">Status Transaksi</label>
                                    <select class="form-select statusTransaksi" aria-label="Default select example" disabled>
                                        <option>Status</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Complete</option>
                                        <option value="3">Return Barang</option>
                                    </select>
                                </div> -->
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-4">
                                        <h6>Produk</h6>
                                    </div>
                                    <!-- <div class="col">
                                        <h6>Kuantiti</h6>
                                    </div> -->
                                </div>
                                <div class="transaksiProduk">
                                    <div class="listProduk" id="listproduk_1">
                                        <div class="row">
                                            <div class="col-4">
                                                <select name="idItem[]" class="produk form-control" disabled>
                                                    <option value="">Nama Produk</option>
                                                    <?php foreach ($produk as $key => $value) { ?>
                                                        <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control">
                                            </div>
                                            <div class="col-2">
                                                <input type="number" name="hargaItem[]" placeholder="Harga" min='1' class="harga form-control">
                                            </div>
                                            <div class="col">
                                                <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti form-control" disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-body">
                    <div class="float-end">
                        <!-- <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnKuning">Pratinjau</button> -->
                        <a href="" class="btn rounded-pill px-3 btn-sm text-white cetakReceipt" id="btnBiru" target="_blank">Cetak</a>
                        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Keluar</button>
                    </div><br>
                    <hr>

                    <!-- <div class="row mt-3">
                        <div class="col-8">
                            Ditambahkan oleh pegawai A pada pukul 07.00 WIB,3 Juli 2021
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3 btn-sm text-white float-end btnAktivitas" data-bs-toggle="modal" data-bs-target="#modalaktivitasproduct">Rincian Selengkapnya</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Retur Product -->
    <div class="modal fade" id="modalreturproduct" tabindex="-1" aria-labelledby="modalubah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubah"><b>Retur Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" class="formRetur">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <h6>Produk</h6>
                            </div>
                            <!-- <div class="col">
                                <h6>Kuantiti</h6>
                            </div> -->
                        </div>
                        <div class="transaksiProduk">
                            <div class="listProduk" id="listproduk_1">
                                <div class="row">
                                    <div class="col-4">
                                        <select name="idItem[]" class="produk form-control" disabled>
                                            <option value="">Nama Produk</option>
                                            <?php foreach ($produk as $key => $value) { ?>
                                                <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Lihat Detail Transaksi
                        </button>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label for="">Nomor Transaksi</label>
                                            <input type="text" class="form-control nomorTransaksi" name="nomorTransaksi" placeholder="RCP/07/21/2021" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Pelanggan Transaksi</label>
                                            <input type="text" class="form-control pelangganTransaksi" name="pelangganTransaksi" placeholder="Pelanggan A" disabled>
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Tanggal Transaksi</label>
                                            <input type="date" class="form-control tanggalTransaksi" name="tanggalTransaksi" placeholder="01/07/2021" disabled>
                                        </div>
                                        <!-- <div class="mb-1">
                                            <label for="">Status Transaksi</label>
                                            <select class="form-select statusTransaksi" aria-label="Default select example" disabled>
                                                <option>Status</option>
                                                <option value="1">Draft</option>
                                                <option value="2">Complete</option>
                                                <option value="3">Return Barang</option>
                                            </select>
                                        </div> -->
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-7">
                                                <h6>Produk</h6>
                                            </div>
                                            <!-- <div class="col">
                                                <h6>Kuantiti</h6>
                                            </div> -->
                                        </div>
                                        <div class="transaksiProdukDetail">
                                            <div class="listProduk" id="listproduk_1">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <select name="idItem[]" class="produk form-control" disabled>
                                                            <option value="">Nama Produk</option>
                                                            <?php foreach ($produk as $key => $value) { ?>
                                                                <option value="<?= $value['idItem'] ?>"><?= $value['namaItem'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" name="jenishargaItem[]" placeholder="Jenis Harga" class="jenisharga form-control">
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" name="satuanItem[]" placeholder="Satuan" class="satuan form-control">
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="number" name="hargaItem[]" placeholder="Harga" min='1' class="harga form-control">
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" name="kuantitiItem[]" min='1' placeholder="Qty" class="kuantiti form-control" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn rounded-pill px-3 btn-sm text-white" id="btnIjo">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Aktivitas Produk-->
    <div class="modal fade" id="modalaktivitasproduct" tabindex="-1" aria-labelledby="rincianproduct" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rincianproduct"><b>Aktivitas Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Activitas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bodyAktivitas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- note 
1. css ga kebaca
2. semuanya belum responsive 
3. icon sama warna nya kurang sesuai
4. di crud produk masih belum sesuai (isi modal nya)-->
    <!-- Vendor -->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="/assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="/assets/vendor/popper/umd/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/common/common.min.js"></script>
    <script src="/assets/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="/assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="/assets/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/assets/vendor/vide/jquery.vide.min.js"></script>
    <script src="/assets/vendor/vivus/vivus.min.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="/assets/js/theme.js"></script>

    <!-- Theme Custom -->
    <script src="/assets/js/custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="/assets/js/theme.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- custom js transaksi -->
    <script src="/assets/js/ajax/transaksi.js"></script>
</body>

</html>