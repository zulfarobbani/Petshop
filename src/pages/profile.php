<!DOCTYPE html>
<html>
  <head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 

    <title>User Management</title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">

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
    <link rel="stylesheet" href="assets/css/theme-elements.css">
    <link rel="stylesheet" href="assets/css/theme-blog.css">
    <link rel="stylesheet" href="assets/css/theme-shop.css">

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/style/style.css">
  </head>
  <body>
    <?php include(__DIR__.'/helper/header.php' )?>

    <div class="container mt-4">
      <div class="card p-3">
        <div class="row">
          <div class="col-6">
            <h4 class="text-muted fw-normal display-6 fs-4">User Management</h4>
          </div>
          <div class="col-6 text-end">
            <button type="button" class="btn btn-sm rounded-pill h-75 px-4 text-white" id="btnIjo" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">
              <span class="material-icons-outlined">person_add</span>
              <span class="align-top">Tambah User</span></button>
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
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Email</th>
                <th scope="col">Nomor Handphone</th>
                <th scope="col">Username</th>
                <th scope="col">Masuk Sistem</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Pegawai A</td>
                <td>pegawaia@gmail.com</td>
                <td>08123456789</td>
                <td>Pegawai.a</td>
                <td>01 Juli 2021</td>
                <td class="d-flex">
                  <button type="button" class="btn px-2 py-1 me-1 text-white" id="btnBiru" data-bs-toggle="modal" data-bs-target="#ModalUbahUser"><i class="fa fa-edit"></i></button>

                  <button type="button" class="btn px-2 py-1 me-1 text-white" id="btnKuning" data-bs-toggle="modal" data-bs-target="#ModalRincianUser"><i class="fa fa-search-plus"></i></button>

                  <button type="button" class="btn px-2 py-1 text-white" id="btnMerah" data-bs-toggle="modal" data-bs-target="#ModalHapusUser"><i class="fa fa-trash-alt"></i></button>
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


<!-- Modal Tambah User -->
<div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="TambahUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TambahUser"><b>Tambah User</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <!-- <img src="img/person.svg" style="width: 250px;"> -->
            <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
            <!-- <div class="image-upload">
              <label for="file-input">
                <span class="material-icons-outlined">file_upload</span>
              </label>

              <input id="file-input" type="file" /></div> -->
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Nama Pegawai" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Email ">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Nomor Handphone">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Username">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Password">
              </div>
              <div class="mb-1">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Jenis Pegawai</option>
                  <option value="1">Kasir</option>
                  <option value="2">Pegawai</option>
                </select>
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

<!-- Modal Ubah User -->
<div class="modal fade" id="ModalUbahUser" tabindex="-1" aria-labelledby="modalubah" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalubah"><b>Ubah User</b></h5>
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
                <input type="text" class="form-control" placeholder="Pegawai A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawaia@gmail.com">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="0812345678">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawai.a">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Password">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pegawai">
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

<!-- Modal Hapus User-->
<div class="modal fade" id="ModalHapusUser" tabindex="-1" aria-labelledby="ModalHapus" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalHapus"><b>Hapus User</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pegawai A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawaia@gmail.com">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="0812345678">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawai.a">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Password">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pegawai">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah">Batal</button>
        <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnKuning">Hapus</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Rincian User-->
<div class="modal fade" id="ModalRincianUser" tabindex="-1" aria-labelledby="RincianUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RincianUser"><b>Rincian User</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            
          </div>
          <div class="col-6">
            <form>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pegawai A" >
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawaia@gmail.com">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="0812345678">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="pegawai.a">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Password">
              </div>
              <div class="mb-1">
                <input type="text" class="form-control" placeholder="Pegawai">
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn rounded-pill px-3 btn-sm text-white float-end" id="btnMerah" data-bs-dismiss="modal">Keluar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Vendor -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery.appear/jquery.appear.min.js"></script>
    <script src="vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.min.js"></script>
    <script src="vendor/popper/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/common/common.min.js"></script>
    <script src="vendor/jquery.validation/jquery.validate.min.js"></script>
    <script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
    <script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
    <script src="vendor/isotope/jquery.isotope.min.js"></script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="vendor/vide/jquery.vide.min.js"></script>
    <script src="vendor/vivus/vivus.min.js"></script>
    
    <!-- Theme Base, Components and Settings -->
    <script src="js/theme.js"></script>

    <!-- Theme Custom -->
    <script src="js/custom.js"></script>
    
    <!-- Theme Initialization Files -->
    <script src="js/theme.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>