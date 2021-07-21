<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Profile</title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/theme.css">

    <!-- Head Libs -->
    <script src="/assets/vendor/modernizr/modernizr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
</head>

<body>
    <?php include(__DIR__ . '/../helper/header.php') ?>

    <div class="container mt-4">
        <!-- <div class="row mt-2 mb-3">
            <div class="col-6">
                <form action="/produk" method="get">
                    <label for=""><b>Waktu Masuk</b></label><br>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            Dari <input type="date" class="form-control" name="filterWaktumasukFrom" value="<?= $filterWaktumasukFrom ?>">
                            <br>
                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        </div>
                        <div class="col-6">
                            Sampai<input type="date" class="form-control" name="filterWaktumasukTo" value="<?= $filterWaktumasukTo ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <label for=""><b>Waktu Expiry</b></label><br>
                <div class="row">
                    <div class="col-6">
                        Dari <input type="date" class="form-control" name="filterWaktuexpiryFrom" value="<?= $filterWaktuexpiryFrom ?>">
                    </div>
                    <div class="col-6">
                        Sampai <input type="date" class="form-control" name="filterWaktuexpiryTo" value="<?= $filterWaktuexpiryTo ?>">
                    </div>
                </div>
            </div>
        </div> -->

        <div class="card p-3">
            <div class="row">
                <div class="col-6">
                    <h4>Product</h4>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-sm text-white rounded-pill h-75 px-4" data-bs-toggle="modal" data-bs-target="#modaltambahproduct" id="btnIjo">
                        <span class="material-icons-outlined">add_box</span>
                        <span class="align-top">Tambah Produk</span></button>
                </div>
            </div>

            <div class="row mt-2 mb-2">
                <div class="col-1">
                    <form method="POST" action="">
                        <select name="data_per_page" class="form-select float-start" aria-label="Default select example">
                            <option value="" selected>No</option>
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
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <div class="col-6 float-start">
                    entries per page
                </div>
                <div class="col-4">
                    <div class="text-end">
                        <input class="form-control w-50 float-end" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Supplier</th>
                            <!-- <th scope="col">Stock</th> -->
                            <th scope="col">Kuantiti</th>
                            <th scope="col">Satuan</th>
                            <!-- <th scope="col">Waktu Masuk</th>
                            <th scope="col">Waktu Expiry</th> -->
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $key => $data) { ?>
                            <tr>
                                <td><?= $data['namaItem'] ?></td>
                                <td><?= $data['supplierItem'] ?></td>
                                <!-- <td><?= $data['stockItem'] ?></td> -->
                                <td><?= $data['kuantitiItem'] ?></td>
                                <td><?= $data['satuanItem'] ?></td>
                                <!-- <td><?= $data['tanggalmasukProduk'] == '0000-00-00' ? '' : date('d M Y', strtotime($data['tanggalmasukProduk'])) ?></td>
                                <td><?= $data['tanggalexpiryProduk'] == '0000-00-00' ? '' : date('d M Y', strtotime($data['tanggalexpiryProduk'])) ?></td> -->
                                <td class="d-flex">
                                    <button type="button" class="btn px-2 py-1 me-1 text-white btnEdit" id="btnBiru" data-bs-toggle="modal" data-bs-target="#modalubahproduct" data-bs-idItem="<?= $data['idItem'] ?>"><i class="fa fa-edit"></i></button>

                                    <button type="button" class="btn px-2 py-1 me-1 text-white btnDetail" id="btnKuning" data-bs-toggle="modal" data-bs-target="#modalrincianproduct" data-bs-idItem="<?= $data['idItem'] ?>"><i class="fa fa-search-plus"></i></button>

                                    <button type="button" class="btn px-2 py-1 me-1 text-white btnHapus" id="btnMerah" data-bs-toggle="modal" data-bs-target="#modalhapusproduct" data-bs-idItem="<?= $data['idItem'] ?>"><i class="fa fa-trash-alt"></i></button>
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
                            <li class="page-item <?= $pagination['current_page'] == $page ? 'active' : '' ?>"><a class="page-link" href="?data_per_page=<?= $pagination['result_per_page']  ?>&page=<?= $page ?>"><?= $page ?></a></li>
                        <?php } ?>
                        <li class="page-item <?= $pagination['current_page'] + 1 > $pagination['number_of_page'] ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?= intval($pagination['current_page']) + 1 ?>"><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah Product -->
    <div class="modal fade" id="modaltambahproduct" tabindex="-1" aria-labelledby="modaltambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambah"><b>Tambah Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/produk/store" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="file" class="form-control" id="inputGroupFile03" name="fotoItem" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <label for="">Nama Produk</label>
                                    <input type="text" class="form-control namaItem" name="namaItem" placeholder="Product A">
                                </div>
                                <div class="mb-1">
                                    <label for="">Supplier</label>
                                    <input type="text" class="form-control supplierItem" name="supplierItem" placeholder="Supplier A">
                                </div>
                                <!-- <div class="mb-1">
                                    <label for="">Kuantiti Produk</label>
                                    <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100">
                                </div> -->
                                <div class="mb-1">
                                    <label for="">Satuan Produk</label>
                                    <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Produk</label>
                                    <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Per pcs</label>
                                    <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Masuk Produk</label>
                                    <input type="date" class="form-control tanggalmasukProduk" name="tanggalmasukProduk" placeholder="Tanggal Masuk Produk">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Expiry Produk</label>
                                    <input type="date" class="form-control tanggalexpiryProduk" name="tanggalexpiryProduk" placeholder="Tanggal Expiry Produk">
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubah"><b>Ubah Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" class="formEdit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                                <input type="file" class="form-control" id="inputGroupFile03" name="fotoItem" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <label for="">Nama Produk</label>
                                    <input type="text" class="form-control namaItem" name="namaItem" placeholder="Product A">
                                </div>
                                <div class="mb-1">
                                    <label for="">Supplier</label>
                                    <input type="text" class="form-control supplierItem" name="supplierItem" placeholder="Supplier A">
                                </div>
                                <!-- <div class="mb-1">
                                    <label for="">Kuantiti Produk</label>
                                    <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100">
                                    <b>Stock Produk : <span class="stockItem"></span></b>
                                </div> -->
                                <div class="mb-1">
                                    <label for="">Satuan Produk</label>
                                    <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Produk</label>
                                    <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Per pcs</label>
                                    <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Masuk Produk</label>
                                    <input type="date" class="form-control tanggalmasukProduk" name="tanggalmasukProduk" placeholder="Tanggal Masuk Produk">
                                </div>
                                <div class="mb-1">
                                    <label for="">Tanggal Expiry Produk</label>
                                    <input type="date" class="form-control tanggalexpiryProduk" name="tanggalexpiryProduk" placeholder="Tanggal Expiry Produk">
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

    <!-- Modal Hapus Product-->
    <div class="modal fade" id="modalhapusproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                        </div>
                        <div class="col-6">
                            <div class="mb-1">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control namaItem" name="namaItem" placeholder="Product A" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Supplier</label>
                                <input type="text" class="form-control supplierItem" name="supplierItem" placeholder="Supplier A" disabled>
                            </div>
                            <!-- <div class="mb-1">
                                <label for="">Kuantiti Produk</label>
                                <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100" disabled>
                            </div> -->
                            <div class="mb-1">
                                <label for="">Satuan Produk</label>
                                <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Produk</label>
                                <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Per pcs</label>
                                <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000">
                            </div>
                            <div class="mb-1">
                                <label for="">Tanggal Masuk Produk</label>
                                <input type="date" class="form-control tanggalmasukProduk" name="tanggalmasukProduk" placeholder="Tanggal Masuk Produk" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Tanggal Expiry Produk</label>
                                <input type="date" class="form-control tanggalexpiryProduk" name="tanggalexpiryProduk" placeholder="Tanggal Expiry Produk" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn rounded-pill px-3 btn-sm text-white btnActionHapus" id="btnKuning">Hapus</button>
                    <form action="" method="post" class="d-none hapusForm"></form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rincian Produk-->
    <div class="modal fade" id="modalrincianproduct" tabindex="-1" aria-labelledby="rincianproduct" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rincianproduct"><b>Rincian Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                        </div>
                        <div class="col-6">
                            <div class="mb-1">
                                <label for="">Nama Produk</label>
                                <input type="text" class="form-control namaItem" name="namaItem" placeholder="Product A" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Supplier</label>
                                <input type="text" class="form-control supplierItem" name="supplierItem" placeholder="Supplier A" disabled>
                            </div>
                            <!-- <div class="mb-1">
                                <label for="">Stock Produk</label>
                                <input type="text" class="form-control stockItem" placeholder="100" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Kuantiti Produk</label>
                                <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100" disabled>
                            </div> -->
                            <div class="mb-1">
                                <label for="">Satuan Produk</label>
                                <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Produk</label>
                                <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Per pcs</label>
                                <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000">
                            </div>
                            <div class="mb-1">
                                <label for="">Tanggal Masuk Produk</label>
                                <input type="date" class="form-control tanggalmasukProduk" name="tanggalmasukProduk" placeholder="Tanggal Masuk Produk" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Tanggal Expiry Produk</label>
                                <input type="date" class="form-control tanggalexpiryProduk" name="tanggalexpiryProduk" placeholder="Tanggal Expiry Produk" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <!-- Ditambahkan oleh pegawai A pada pukul 07.00 WIB,3 Juli 2021 -->
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3 btn-sm text-white float-end btnAktivitas" data-bs-toggle="modal" data-bs-target="#modalaktivitasproduct">Rincian Selengkapnya</button>
                        </div>
                    </div>
                </div>
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

    <!-- ajax crud produk -->
    <script src="/assets/js/ajax/produk.js"></script>
</body>

</html>