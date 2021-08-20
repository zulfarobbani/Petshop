<!DOCTYPE html>
<html lang="en">

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
  <div class="container">
    <div class="card mt-4">
      <form action="/users/<?= $detail['idUser'] ?>/update" method="post" enctype="multipart/form-data">
        <div class="row m-3">
          <div class="col-md-5 text-center">
            <img src="/assets/media/<?= $detail['pathMedia'] ?>" class="img-fluid img-thumbnail">
            <input type="file" name="fotoUser" class="form-control">
            <h5 class="mt-3"><?= $detail['namaUser'] ?></h5>
            <span><?= $detail['emailUser'] ?></span><br>
            <span><?= $detail['nohpUser'] ?></span>
          </div>
          <div class="col-md-7">
            <h4>Edit Profile</h4>
            <div class="mb-2">
              <label for="">Nama User</label>
              <input type="text" class="form-control" placeholder="Nama Pegawai" name="namaUser" value="<?= $detail['namaUser'] ?>">
            </div>
            <div class="mb-2">
              <label for="">Email</label>
              <input type="text" class="form-control" placeholder="pegawai@email.com" name="emailUser" value="<?= $detail['emailUser'] ?>">
            </div>
            <div class="mb-2">
              <label for="">No Handphone</label>
              <input type="text" class="form-control" placeholder="08123456789" name="nohpUser" value="<?= $detail['nohpUser'] ?>">
            </div>
            <div>
              <button type="submit" class="btn rounded-pill px-4 text-white float-end" id="btnIjo">Simpan</button>
              <button type="reset" class="btn rounded-pill px-4 me-3 text-white float-end" id="btnMerah">Batal</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>

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
</body>

</html>