<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <form action="/users/store" method="POST" enctype="multipart/form-data"><br>
        <input type="text" name="namaUser" placeholder="Nama Pegawai"><br>
        <input type="text" name="emailUser" placeholder="Email Pegawai"><br>
        <input type="password" name="passwordUser" placeholder="Password"><br>
        <input type="password" name="confirmPasswordUser" placeholder="Confirm Password"><br>
        <input type="text" name="nikUser" placeholder="Nik"><br>
        <input type="radio" name="hirarkiUser" value="1">Hirarki Pertama<br>
        <input type="radio" name="hirarkiUser" value="2">Hirarki Kedua<br>
        <button type="submit">Submit<br>
    </form>
</body>
</html>