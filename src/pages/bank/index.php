<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Bank</h3>
    <?= $session ?>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Nama Bank</td>
            <td>Aksi</td>
        </tr>
        <?php foreach ($datas as $key => $value) { ?>
            <tr>
                <td><?= $key+=1 ?></td>
                <td><?= $value['namaBank'] ?></td>
                <td>
                    <a href="bank/edit/<?= $value['idBank'] ?>">Edit</a> | <a href="">Hapus</a> | <a href="">Detail</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>