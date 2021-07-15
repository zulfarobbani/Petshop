<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
    <title></title>
    <style type="text/css">
        body {
            background-color: #fcecec;
            color: #48466d;
        }

        #divbtn {
            margin-right: 25%;

        }

        #btnlogin {
            background-color: #48466d;
        }

        #lupass {
            color: #48466d;
        }

        @media (max-width: 770px) {
            #col6 {
                padding-top: 25%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <form method="POST" action="/login/proses">
            <div class="row align-items-center">
                <div class="col-md-6 ps-0 d-sm-none d-none d-md-block">
                    <!-- START CODE -->
                    <img src="assets/img/login1.jpg" class="img-fluid">
                </div>
                <div class="col-md-6" id="col6">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="flex-shrink">
                            <img src="assets/img/logo.png" width="150px">
                        </div>
                        <div class="flex-grow fs-4 ms-3 mt-2">
                            <span>SAMBAT<br>FAUNA SHOP</span>
                        </div>
                    </div>
                    <div>
                        <!-- <input type="text" class="form-control w-50 mx-auto rounded-pill border-0 mb-3" placeholder="Username" name=""> -->
                        <input type="email" name="emailUser" class="form-control w-50 mx-auto rounded-pill border-0 mb-3" id="emailUser" placeholder="Email" aria-describedby="emailHelp">
                        <!-- <input type="text" class="form-control w-50 mx-auto rounded-pill border-0 " placeholder="Username" name=""> -->
                        <input type="password" name="passwordUser" class="form-control w-50 mx-auto rounded-pill border-0 " id="passwordUser" placeholder="Password">
                    </div>
                    <div class="mb-3 mt-2">
                        <?php if (count($errors) > 0) { ?>
                            <?php foreach ($errors as $error) { ?>
                                <div class="alert alert-danger w-50 mx-auto alert-dismissible fade show" role="alert">
                                    <strong><?= $error ?></strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="d-flex flex-row-reverse mt-3" id="divbtn">
                        <button class="btn rounded-pill px-3 text-white ms-3" id="btnlogin" name="login" type="submit">Login</button>
                        <!-- <a href="" class="mt-1" id="lupass">Lupa pass?</a> -->
                    </div>
                    <!-- <div class="d-flex">
        		<img src="img/logo.png" width="150px" height="100px">
        		<span class="fw-bold fs-4 ms-3 mt-2" style="color: #48466d;"></span>
        	</div>  -->

                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
</body>

</html>