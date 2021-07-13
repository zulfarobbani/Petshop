<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Petshop</title>
</head>

<body>

    <form method="POST" action="/login/proses">
        <div class="mb-3">
            <?php if (count($errors) > 0) {?>
                <?php foreach($errors as $error) {?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?= $error?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }?>
            <?php }?>
        </div>

        <div class="mb-3">
            <label for="emailUser" class="form-label">Email address</label>
            <input type="email" name="emailUser" class="form-control" id="emailUser" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="passwordUser" class="form-label">Password</label>
            <input type="password" name="passwordUser" class="form-control" id="passwordUser">
        </div>
        
        
        <button type="submit" name="login" value="login" class="btn btn-primary">Submit</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>
</html>