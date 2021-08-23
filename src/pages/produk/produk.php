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

            <!-- <span>Jumlah data perhalaman</span> -->
            <div class="row mt-2 mb-2">
                <!-- <div class="col-2">
                    <form method="GET" action="">
                        <div class="d-flex">
                            <select name="data_per_page" class="form-control float-start" aria-label="Default select example" style="width: 50px;">
                                <option value="" selected>No</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div> -->
                <div class="col-12">
                    <form method="GET" action="">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success float-end">Submit</button>
                            <input class="form-control w-50 float-end" type="search" name="search" placeholder="Search" aria-label="Search">
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Harga Asal (Krg/Dus/Set)</th>
                            <th scope="col">Harga Asal (Pcs/Kg)</th>
                            <!-- <th scope="col">Kuantiti</th> -->
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
                                <td><?= $data['hargaItem'] != null ? "Rp.".number_format($data['hargaItem'], 2, ',', '.') : '-' ?></td>
                                <td><?= $data['hargaperpcsItem'] != null ? "Rp.".number_format($data['hargaperpcsItem'], 2, ',', '.') : '-' ?></td>
                                <!-- <td><?= $data['kuantitiItem'] ?></td> -->
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

            <?php if ($pagination['number_of_page'] > 1) { ?>
            <div class="row">
                <div class="col-6">
                    <h6 class="text-muted">Showing <?= $pagination['page_first_result'] + 1 ?> to <?= count($datas) ?> of <?= $pagination['countRows'] ?> entries</h6>
                </div>
                <div class="col-6">
                    <?php
                    $links = "<ul class=\"pagination float-end\">
            <li class=\"page-item " . ($pagination['current_page'] - 1 == 0 ? 'disabled' : '') . "\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . (intval($pagination['current_page']) - 1) . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\"><i class=\"fas fa-angle-left\"></i></a></li>";
                    if ($pagination['number_of_page'] >= 1 && $pagination['current_page'] <= $pagination['number_of_page']) {
                        $i = max(2, $pagination['current_page'] - 5);
                        $links .= "<li class=\"page-item " . ($pagination['current_page'] == ($i - 1) ? 'active' : '') . "\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=1&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\">1</a></li>";
                        if ($i > 2)
                            $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . ($i - 1) . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\"> ... </a></li>";
                        for (; $i < min($pagination['current_page'] + 6, $pagination['number_of_page']); $i++) {
                            $links .= "<li class=\"page-item " . ($pagination['current_page'] == $i ? 'active' : '') . "\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . $i . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\">" . $i . "</a></li>";
                        }
                        if ($i != $pagination['number_of_page'])
                            $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . $i . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\"> ... </a></li>";
                        $links .= "<li class=\"page-item " . ($pagination['current_page'] == $pagination['number_of_page'] ? 'active' : '') . "\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . $pagination['number_of_page'] . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\">" . $pagination['number_of_page'] . "</a></li>";
                    }
                    $links .= "<li class=\"page-item " . ($pagination['current_page'] + 1 > $pagination['number_of_page'] ? 'disabled' : '') . "\"><a class=\"page-link\" href=\"?data_per_page=" . $pagination['result_per_page'] . "&page=" . (intval($pagination['current_page']) + 1) . "&filterWaktumasukFrom=".$filterWaktumasukFrom."&filterWaktumasukTo=".$filterWaktumasukTo."&search=".$search."\"><i class=\"fas fa-angle-right\"></i></a></li>
            </ul>";
                    echo $links;
                    ?>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>

    <!-- Modal Tambah Product -->
    <div class="modal fade" id="modaltambahproduct" tabindex="-1" aria-labelledby="modaltambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambah"><b>Tambah Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/produk/store" method="post" enctype="multipart/form-data" class="formStore">
                        <div class="row">
                            <div class="col-6">
                                <input type="file" class="form-control" id="inputGroupFile03" name="fotoItem" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                                <button type="button" class="btn mt-4 rounded-pill px-3 btn-sm text-white mb-3 tambahListHarga" id="btnIjo"><i class="fas fa-plus-square"> Tambah Harga</i></button>
                                <div class="row mt-1">
                                    <div class="col-3">Satuan</div>
                                    <div class="col-4">Jenis Harga</div>
                                    <div class="col-4">Harga</div>
                                </div>
                                <div class="masterHarga">
                                    <div class="listHarga" id="listHarga_1">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" name="satuanHarga[]" class="form-control satuanHarga">
                                            </div>
                                            <div class="col-4">
                                                <select name="jenisHarga[]" class="form-control jenisHarga">
                                                    <option value="">-- Pilih Jenis Harga --</option>
                                                    <option value="1">Harga Grosir</option>
                                                    <option value="2">Harga Eceran</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="hargaHarga[]" class="form-control hargaHarga">
                                            </div>
                                            <!-- <div class="col">
                                                <button type="button" class="hapusListHarga btn btn-sm btn-danger" value=""><i class="fas fa-minus-circle"></i></button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
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
                                    <label for="">Harga Asal <b>(Krg/Dus/Set)</b></label>
                                    <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Asal <b>(Pcs/Kg)</b></label>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn rounded-pill px-3 btn-sm text-white btnSubmitStore" id="btnIjo">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Product -->
    <div class="modal fade" id="modalubahproduct" tabindex="-1" aria-labelledby="modalubah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubah"><b>Ubah Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" class="formEdit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                                    </div>
                                    <div class="col">
                                        <input type="file" class="form-control" id="inputGroupFile03" name="fotoItem" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                                    </div>
                                </div>
                                <button type="button" class="btn mt-4 rounded-pill px-3 btn-sm text-white mb-3 tambahListHarga" id="btnIjo"><i class="fas fa-plus-square"> Tambah Harga</i></button>
                                <div class="row mt-1">
                                    <div class="col-3">Satuan</div>
                                    <div class="col-4">Jenis Harga</div>
                                    <div class="col-4">Harga</div>
                                </div>
                                <div class="masterHarga">
                                    <div class="listHarga" id="listHarga_1">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="text" name="satuanHarga[]" class="form-control satuanHarga">
                                            </div>
                                            <div class="col-4">
                                                <select name="jenisHarga[]" class="form-control jenisHarga">
                                                    <option value="">-- Pilih Jenis Harga --</option>
                                                    <option value="1">Harga Grosir</option>
                                                    <option value="2">Harga Eceran</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <input type="text" name="hargaHarga[]" class="form-control hargaHarga">
                                            </div>
                                            <!-- <div class="col">
                                                <button type="button" class="hapusListHarga btn btn-sm btn-danger" value=""><i class="fas fa-minus-circle"></i></button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
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
                                    <label for="">Harga Asal <b>(Krg/Dus/Set)</b></label>
                                    <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000">
                                </div>
                                <div class="mb-1">
                                    <label for="">Harga Asal <b>(Pcs/Kg)</b></label>
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
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Hapus Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-3">Satuan</div>
                                <div class="col-4">Jenis Harga</div>
                                <div class="col-4">Harga</div>
                            </div>
                            <div class="masterHarga">
                                <div class="listHarga" id="listHarga_1">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="satuanHarga[]" class="form-control satuanHarga">
                                        </div>
                                        <div class="col-4">
                                            <select name="jenisHarga[]" class="form-control jenisHarga">
                                                <option value="">-- Pilih Jenis Harga --</option>
                                                <option value="1">Harga Grosir</option>
                                                <option value="2">Harga Eceran</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="hargaHarga[]" class="form-control hargaHarga">
                                        </div>
                                        <!-- <div class="col">
                                                <button type="button" class="hapusListHarga btn btn-sm btn-danger" value=""><i class="fas fa-minus-circle"></i></button>
                                            </div> -->
                                    </div>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100">
                                    <b>Stock Produk : <span class="stockItem"></span></b>
                                </div> -->
                            <div class="mb-1">
                                <label for="">Satuan Produk</label>
                                <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Asal <b>(Krg/Dus/Set)</b></label>
                                <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Asal <b>(Pcs/Kg)</b></label>
                                <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000" disabled>
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
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rincianproduct"><b>Rincian Product</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <img src="" alt="" class="fotoItem img-fluid img-thumbnail">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-3">Satuan</div>
                                <div class="col-4">Jenis Harga</div>
                                <div class="col-4">Harga</div>
                            </div>
                            <div class="masterHarga">
                                <div class="listHarga" id="listHarga_1">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" name="satuanHarga[]" class="form-control satuanHarga">
                                        </div>
                                        <div class="col-4">
                                            <select name="jenisHarga[]" class="form-control jenisHarga">
                                                <option value="">-- Pilih Jenis Harga --</option>
                                                <option value="1">Harga Grosir</option>
                                                <option value="2">Harga Eceran</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="hargaHarga[]" class="form-control hargaHarga">
                                        </div>
                                        <!-- <div class="col">
                                                <button type="button" class="hapusListHarga btn btn-sm btn-danger" value=""><i class="fas fa-minus-circle"></i></button>
                                            </div> -->
                                    </div>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control kuantitiItem" name="kuantitiItem" placeholder="100">
                                    <b>Stock Produk : <span class="stockItem"></span></b>
                                </div> -->
                            <div class="mb-1">
                                <label for="">Satuan Produk</label>
                                <input type="text" class="form-control satuanItem" name="satuanItem" placeholder="Pcs" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Asal <b>(Krg/Dus/Set)</b></label>
                                <input type="text" class="form-control hargaItem" name="hargaItem" placeholder="1.000.000" disabled>
                            </div>
                            <div class="mb-1">
                                <label for="">Harga Asal <b>(Pcs/Kg)</b></label>
                                <input type="text" class="form-control hargaperpcsItem" name="hargaperpcsItem" placeholder="1.000.000" disabled>
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