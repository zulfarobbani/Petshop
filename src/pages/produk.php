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
    <script src="assets/vendor/modernizr/modernizr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  </head>
  <body>
    <?php include(__DIR__.'/helper/header.php' )?>

    <div class="container mt-4">
      <div class="card p-3">
        <div class="row">
          <div class="col-6">
            <h4>Product</h4>
          </div>
          <div class="col-6 text-end">
            <button type="button" class="btn btn-sm text-white rounded-pill h-75 px-4" data-bs-toggle="modal" data-bs-target="#modaltambahproduct" id="btnIjo">
              <span class="material-icons-outlined">add_box</span>
              <span class="align-top">Tambah Transaksi</span></button>
          </div>
        </div>

        <div class="row mt-2 mb-2">
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
        </div>

        <div class="table-responsive">
          
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Supplier</th>
              <th scope="col">Kuantiti</th>
              <th scope="col">Satuan</th>
              <th scope="col">Waktu Masuk</th>
              <th scope="col">Waktu Expiry</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Barang Merk A</td>
              <td>Supplier A</td>
              <td>100</td>
              <td>Kg</td>
              <td>25 Juni 2021</td>
              <td>Waktu Expiry</td>
              <td class="d-flex">
                <button type="button" class="btn px-2 py-1 me-1 text-white" id="btnBiru" data-bs-toggle="modal" data-bs-target="#modalubahproduct"><i class="fa fa-edit"></i></button>

                <button type="button" class="btn px-2 py-1 me-1 text-white" id="btnKuning" data-bs-toggle="modal" data-bs-target="#modalrincianproduct"><i class="fa fa-search-plus"></i></button>

                <button type="button" class="btn px-2 py-1 text-white" id="btnMerah" data-bs-toggle="modal" data-bs-target="#modalhapusproduct"><i class="fa fa-trash-alt"></i></button>
              </td>
            </tr>
          </tbody>
      </table>
        </div>

      <div class="row">
        <div class="col-6">
          <h6 class="text-muted">Showing 1 to 10 of 26 entries</h6>
        </div>
        <div class="col-6">
          <ul class="pagination float-end">
              <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
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
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <!-- <img src="img/imgpost.svg" style="width: 250px;"> -->
            <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Nama Product" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Nama Supplier">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Kuantiti">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Satuan">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Harga">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Waktu Masuk Product">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Waktu Expiry Product">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnIjo">Simpan</button>
      </div>
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
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Product A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Supplier A">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="100">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pcs">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="1.000.000">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="01/07/2021">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="13/05/2022">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnIjo">Simpan</button>
      </div>
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
            
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Product A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Supplier A">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="100">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pcs">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="1.000.000">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="01/07/2021">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="13/05/2022">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer"><button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnKuning">Hapus</button>
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
            
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Product A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Supplier A">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="100">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pcs">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="1.000.000">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="01/07/2021">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="13/05/2022">
              </div>
              <button type="button" class="btn rounded-pill px-3 btn-sm text-white float-end mt-3" id="btnMerah" data-bs-dismiss="modal">Batal</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-8">
            Ditambahkan oleh pegawai A pada pukul 07.00 WIB,3 Juli 2021
          </div>
          <div class="col-4">
            <a href="#"><button class="btn btn-secondary btn-sm rounded-pill px-3 btn-sm text-white float-end">Rincian Selengkapnya</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Vendor -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="assets/vendor/popper/umd/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/common/common.min.js"></script>
    <script src="assets/vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="assets/vendor/isotope/jquery.isotope.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendor/vide/jquery.vide.min.js"></script>
    <script src="assets/vendor/vivus/vivus.min.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="assets/js/theme.js"></script>

    <!-- Theme Custom -->
    <script src="assets/js/custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="assets/js/theme.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>