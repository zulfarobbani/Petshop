<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <form action="/users/<?= $detail['idUser']?>/update" method="POST" enctype="multipart/form-data"><br>
        <input type="text" name="namaUser" placeholder="Nama Pegawai" value="<?= $detail['namaUser']?>"><br>
        <input type="text" name="emailUser" placeholder="Email Pegawai" value="<?= $detail['emailUser']?>"><br>
        <input type="password" name="currentPasswordUser" placeholder="Current Password"><br>
        <input type="password" name="passwordUser" placeholder="New Password"><br>
        <input type="password" name="confirmPasswordUser" placeholder="Confirm Password"><br>
        <input type="text" name="nikUser" placeholder="Nik" value="<?= $detail['nikUser']?>" ><br>
        <input type="radio" name="hirarkiUser" value="1" <?= $detail['hirarkiUser'] == '1' ? 'checked' : ''?>>Hirarki Pertama<br>
        <input type="radio" name="hirarkiUser" value="2" <?= $detail['hirarkiUser'] == '2' ? 'checked' : ''?>>Hirarki Kedua<br>
        <button type="submit">Submit<br>
    </form>
</body>
</html>