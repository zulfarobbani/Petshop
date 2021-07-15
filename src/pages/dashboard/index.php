<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="/assets/vendors/simple-datatables/style.css">

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
  <link rel="stylesheet" href="/assets/css/theme-elements.css">
  <link rel="stylesheet" href="/assets/css/theme-blog.css">
  <link rel="stylesheet" href="/assets/css/theme-shop.css">

  <!-- Demo CSS -->


  <!-- Skin CSS -->
  <link rel="stylesheet" href="/assets/css/skins/default.css">

  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="/assets/css/custom.css">

  <!-- Head Libs -->
  <script src="/assets/vendor/modernizr/modernizr.min.js"></script>

  <link rel="stylesheet" type="text/css" href="/assets/style/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">

  <style>
    body {
      background-color: #fceeeb;
    }

    .isiHalaman {
      margin: 25px 50px
    }

    .navbar {
      background-color: #5d4d75;
    }

    .logoStockBarang {
      height: 130px;
      margin: 50px 0px 50px 30px;
    }
  </style>

  <title>Hello, world!</title>
</head>

<body>
  <?php include(__DIR__ . '/../helper/header.php') ?>
  <div class="isiHalaman">
    <div class="row">
      <div class="col-md-4" id="penjualan_produk"></div>
      <div class="col-md-4" id="omset"></div>
      <div class="col-md-4" id="kuantiti_pembelian"></div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="/assets/media/icon 1.png" alt="logo Expire" class="logoStockBarang">
              </div>
              <div class="col-md-8 align-self-center">
                <h1>Stock Expiry</h1>
                <h1 style="font-size : 100px">150</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <img src="/assets/media/icon 2.png" alt="logo Ketersediaan Stock" class="logoStockBarang">
              </div>
              <div class="col-md-8 align-self-center">
                <h1>Ketersediaan Stock</h1>
                <h1 style="font-size : 100px">300</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-body">
        <h4 class="card-title">Riwayat Transaksi</h4>
        <table class="table" id="tableTransaksi">
          <tbody>
            <tr>
              <td>01 Juli 2021</td>
              <td>RCP/07/21/0001</td>
              <td>Total Harga</td>
              <td>Profit</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>RCP/07/21/0001</td>
              <td>Total Harga</td>
              <td>Profit</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>RCP/07/21/0001</td>
              <td>Total Harga</td>
              <td>Profit</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>RCP/07/21/0001</td>
              <td>Total Harga</td>
              <td>Profit</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>RCP/07/21/0001</td>
              <td>Total Harga</td>
              <td>Profit</td>
              <td>User</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <div class="card mt-5">
      <div class="card-body">
        <h4 class="card-title">Riwayat Aktifitas</h4>
        <table class="table" id="tableAktifitas">
          <tbody>
            <tr>
              <td>01 Juli 2021</td>
              <td>User A Menambahkan Produk A</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>User A Menambahkan Produk A</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>User A Menambahkan Produk A</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>User A Menambahkan Produk A</td>
              <td>User</td>
            </tr>
            <tr>
              <td>01 Juli 2021</td>
              <td>User A Menambahkan Produk A</td>
              <td>User</td>
            </tr>
          </tbody>
        </table>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="/assets/vendors/apexcharts/apexcharts.js"></script>
  <script src="/assets/js/dashboard/dashboard.js"></script>
  <script src="/assets/vendors/simple-datatables/simple-datatables.js"></script>
  <script>
    // Simple Datatable
    let tableTransaksi = document.querySelector('#tableTransaksi');
    let tableAktifitas = document.querySelector('#tableAktifitas');
    let dataTableTransaksi = new simpleDatatables.DataTable(tableTransaksi);
    let dataTableAktifitas = new simpleDatatables.DataTable(tableAktifitas);
  </script>

</body>

</html>