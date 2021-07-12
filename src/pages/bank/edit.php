<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit Bank</h2>
    <form method="POST" action="bank/update/<?= $bank['idBank'] ?>">
        <label for="">Nama Bank</label>
        <input type="text" name="namaBank" value="<?= $bank['namaBank']; ?>">
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>