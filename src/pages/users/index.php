<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <a href="/users/create">Tambah Data Users</a>

    <table border="1">
        <thead>
            <tr>
                <td>Nama User</td>
                <td>Nik User</td>
                <td>Hirarki User</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datas as $value) {?>
                <tr>
                    <td><?= $value['namaUser']?></td>
                    <td><?= $value['nikUser']?></td>
                    <td><?= $value['hirarkiUser'] == '1' ? 'Hirarki Pertama' : 'Hirarki Kedua'?></td>
                    <td>
                        <a href="/users/<?= $value['idUser']?>/edit">Edit</a>
                        <a href="/users/<?= $value['idUser']?>/detail">Detail</a>
                        <a href="/users/<?= $value['idUser']?>/delete">Hapus</a>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</body>
</html>