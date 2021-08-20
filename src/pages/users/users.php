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
  <link rel="stylesheet" href="/assets/vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/assets/vendor/animate/animate.min.css">
  <link rel="stylesheet" href="/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
  <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="/assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="/assets/vendor/magnific-popup/magnific-popup.min.css">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="/assets/css/theme.css">
  <link rel="stylesheet" href="/assets/css/theme-elements.css">
  <link rel="stylesheet" href="/assets/css/theme-blog.css">
  <link rel="stylesheet" href="/assets/css/theme-shop.css">

  <!-- Head Libs -->
  <script src="/assets/vendor/modernizr/modernizr.min.js"></script>

  <link rel="stylesheet" type="text/css" href="/assets/style/style.css">
</head>

<body>
  <?php include(__DIR__ . '/../helper/header.php') ?>

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

      <!-- <div class="row mt-2 mb-2">
        <div class="col-1">
          <form method="POST" action="">
            <select name="data_per_page" class="form-select float-start" aria-label="Default select example">
              <option value=" " selected>No</option>
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
        <div class="col-7 float-start">
          entries per page
        </div>
        <div class="col-4">
          <div class="text-end">
            <input class="form-control w-50 float-end" type="search" placeholder="Search" aria-label="Search">
          </div>
        </div>
      </div> -->
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
        <div class="col-2">
          <form method="POST" action="">
            <select name="data_per_page" class="form-select float-start" aria-label="Default select example">
              <option value=" " selected>No</option>
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
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
          </form>
        </div>
        <div class="col">
          <form method="GET" action="" style="float:rigth;">
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
              <th scope="col">Nama Pegawai</th>
              <th scope="col">Email</th>
              <th scope="col">Nomor Handphone</th>
              <!-- <th scope="col">Username</th> -->
              <th scope="col">Masuk Sistem</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datas as $key => $data) { ?>
              <tr>
                <td><?= $data['namaUser'] ?></td>
                <td><?= $data['emailUser'] ?></td>
                <td><?= $data['nohpUser'] ?></td>
                <!-- <td>Pegawai.a</td> -->
                <td><?= date('d M Y', strtotime($data['dateCreate'])) ?></td>
                <td class="d-flex">
                  <button type="button" class="btn px-2 py-1 me-1 text-white btnEdit" id="btnBiru" data-bs-toggle="modal" data-bs-target="#ModalUbahUser" data-bs-idUser="<?= $data['idUser'] ?>"><i class="fa fa-edit"></i></button>

                  <button type="button" class="btn px-2 py-1 me-1 text-white btnDetail" id="btnKuning" data-bs-toggle="modal" data-bs-target="#ModalRincianUser" data-bs-idUser="<?= $data['idUser'] ?>"><i class="fa fa-search-plus"></i></button>

                  <button type="button" class="btn px-2 py-1 me-1 text-white btnHapus" id="btnMerah" data-bs-toggle="modal" data-bs-target="#ModalHapusUser" data-bs-idUser="<?= $data['idUser'] ?>"><i class="fa fa-trash-alt"></i></button>

                  <button type="button" class="btn rounded-pill px-3 py-1 btn-sm text-white btnResetPassword" id="btnMerah" data-bs-toggle="modal" data-bs-target="#ModalResetPassword" data-bs-idUser="<?= $data['idUser'] ?>"><i class="fa fa-lock-open"></i> Reset Password</button>
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


  <!-- Modal Tambah User -->
  <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="TambahUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="TambahUser"><b>Tambah User</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="users/store" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <label for="">Foto user</label>
                <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload" name="fotoUser">
              </div>
              <div class="col-6">
                <div class="mb-1">
                  <label for="">Nama Pegawai</label>
                  <input type="text" class="form-control" placeholder="Nama Pegawai" name="namaUser">
                </div>
                <div class="mb-1">
                  <label for="">Email</label>
                  <input type="text" class="form-control" placeholder="Email" name="emailUser">
                </div>
                <div class="mb-1">
                  <label for="">Nomor Handphone</label>
                  <input type="text" class="form-control" placeholder="Nomor Handphone" name="nohpUser">
                </div>
                <div class="mb-1">
                  <label for="">Jenis User</label>
                  <select class="form-select" aria-label="Default select example" name="hirarkiUser">
                    <option value="">-- Pilih Jenis User --</option>
                    <?php foreach ($hirarki as $key => $data) { ?>
                      <option value="<?= $data['idHirarki'] ?>"><?= $data['namaHirarki'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <h5>Pengaturan hak akses</h5>
              <div class="col-4">
                <input type="checkbox" class="hakAkses" name="hakAkses[]" value="dashboard"> Dashboard
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses" name="hakAkses[]" value="product"> Product
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses" name="hakAkses[]" value="transaction"> Transaction
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses" name="hakAkses[]" value="users"> Users
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

  <!-- Modal Ubah User -->
  <div class="modal fade" id="ModalUbahUser" tabindex="-1" aria-labelledby="modalubah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalubah"><b>Ubah User</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="formEdit">
          <div class="modal-body">
            <div class="row">
              <div class="col-6">
                <img src="" alt="" class="img-fluid img-thumbnail fotoUser">
                <label for="">Foto user</label>
                <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload" name="fotoUser">
              </div>
              <div class="col-6">
                <div class="mb-1">
                  <label for="">Nama Pegawai</label>
                  <input type="text" class="form-control namaUser" placeholder="Nama Pegawai" name="namaUser">
                </div>
                <div class="mb-1">
                  <label for="">Email</label>
                  <input type="text" class="form-control emailUser" placeholder="Email" name="emailUser">
                </div>
                <div class="mb-1">
                  <label for="">Nomor Handphone</label>
                  <input type="text" class="form-control nohpUser" placeholder="Nomor Handphone" name="nohpUser">
                </div>
                <div class="mb-1">
                  <label for="">Jenis User</label>
                  <select class="form-select hirarkiUser" aria-label="Default select example" name="hirarkiUser">
                    <option value="">-- Pilih Jenis User --</option>
                    <?php foreach ($hirarki as $key => $data) { ?>
                      <option value="<?= $data['idHirarki'] ?>"><?= $data['namaHirarki'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <h5>Pengaturan hak akses</h5>
              <div class="col-4">
                <input type="checkbox" class="hakAkses dashboard" name="hakAkses[]" value="dashboard"> Dashboard
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses product" name="hakAkses[]" value="product"> Product
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses transaction" name="hakAkses[]" value="transaction"> Transaction
              </div>
              <div class="col-4">
                <input type="checkbox" class="hakAkses users" name="hakAkses[]" value="users"> Users
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
              <label for="">Foto user</label>
              <img src="" alt="" class="img-fluid img-thumbnail fotoUser">
            </div>
            <div class="col-6">
              <div class="mb-1">
                <label for="">Nama Pegawai</label>
                <input type="text" class="form-control namaUser" placeholder="Nama Pegawai" name="namaUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Email</label>
                <input type="text" class="form-control emailUser" placeholder="Email" name="emailUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Nomor Handphone</label>
                <input type="text" class="form-control nohpUser" placeholder="Nomor Handphone" name="nohpUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Jenis User</label>
                <select class="form-select hirarkiUser" aria-label="Default select example" name="hirarkiUser">
                  <option value="">-- Pilih Jenis User --</option>
                  <?php foreach ($hirarki as $key => $data) { ?>
                    <option value="<?= $data['idHirarki'] ?>"><?= $data['namaHirarki'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah">Batal</button>
          <button type="button" class="btn rounded-pill px-3 btn-sm text-white btnActionHapus" id="btnKuning">Hapus</button>
          <form action="" method="post" class="formHapus"></form>
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
              <label for="">Foto user</label>
              <img src="" alt="" class="img-fluid img-thumbnail fotoUser">
            </div>
            <div class="col-6">
              <div class="mb-1">
                <label for="">Nama Pegawai</label>
                <input type="text" class="form-control namaUser" placeholder="Nama Pegawai" name="namaUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Email</label>
                <input type="text" class="form-control emailUser" placeholder="Email" name="emailUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Nomor Handphone</label>
                <input type="text" class="form-control nohpUser" placeholder="Nomor Handphone" name="nohpUser" disabled>
              </div>
              <div class="mb-1">
                <label for="">Jenis User</label>
                <select class="form-select hirarkiUser" aria-label="Default select example" name="hirarkiUser">
                  <option value="">-- Pilih Jenis User --</option>
                  <?php foreach ($hirarki as $key => $data) { ?>
                    <option value="<?= $data['idHirarki'] ?>"><?= $data['namaHirarki'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill px-3 btn-sm text-white float-end" id="btnMerah" data-bs-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Reset Password User-->
  <div class="modal fade" id="ModalResetPassword" tabindex="-1" aria-labelledby="ModalHapus" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalHapus"><b>Reset Password User</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-6">
              <label for="">Foto user</label>
              <img src="" alt="" class="img-fluid img-thumbnail fotoUser">
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-6">
              <p>
              <h4>Reset Password User atas nama <b class="namaUser"></b> ?</h4>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn rounded-pill px-3 btn-sm text-white" id="btnMerah">Batal</button>
          <button type="button" class="btn rounded-pill px-3 btn-sm text-white btnActionResetPassword" id="btnKuning">Reset</button>
          <form action="" method="post" class="formResetPassword"></form>
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

  <!-- custom js user management -->
  <script src="/assets/js/ajax/users.js"></script>
</body>

</html>