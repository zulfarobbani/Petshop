<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop</title>
</head>
<body>
    <h1>Detail User</h1>

    <table>
        <tr>
            <td>Nama User</td>
            <td> : </td>
            <td><?= $detail['namaUser']?></td>
        </tr>
        <tr>
            <td>Nik User</td>
            <td> : </td>
            <td><?= $detail['nikUser']?></td>
        </tr>
        <tr>
            <td>Hirarki User</td>
            <td> : </td>
            <td><?= $detail['hirarkiUser'] == '1' ? 'Hirarki Pertama' : 'Hirarki Kedua'?></td>
        </tr>
    </table>
</body>
</html>