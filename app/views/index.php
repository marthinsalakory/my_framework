<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center style="margin-top: 100px;">
        <h1>Selamat Datang Di Framework Alfreinsco</h1>
        <h1>Pembuat : <?= $pembuat; ?></h1>
        <h1>Alamat : <?= $alamat; ?></h1>
        <h1>
            <u>Info Contact:</u><br>
            <ul>
                <li>Whatsapp = <?= $contact['whatsapp']; ?></li>
                <li>Facebook = <?= $contact['facebook']; ?></li>
                <li>Twiter = <?= $contact['twiter']; ?></li>
                <li>Instagram = <?= $contact['instagram']; ?></li>
            </ul>
        </h1>
    </center>
</body>

</html>