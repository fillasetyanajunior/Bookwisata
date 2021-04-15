<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boardingpass</title>
</head>
<body>
    <h4>Halo {{$_nama}}</h4>
    <p>Terima kasih telah memesan layanan kami semoga kamu senang dengan pelayanan kami.</p>
    <p>Untuk itu kami ingatkan untuk kamu untuk mencetak Boardingpas yang kami kirimkan <span>dan setelah itu tunjukan kepada mitra kami yang bergabung untuk mengambil layanan yang kami sediakan untuk anda.</span> </p>
    <p>Untuk informasi lebih lanjut mengenai layanan kami,silahkan menghubungi kami di customer support (+62 274 - 443165) atau melalui live chat di <a href="{{url('/')}}">bookwisata.com</a> </p>
    <p>Salam</p>
    <p>{{env('APP_NAME')}}</p>
    <br><br><br>
    <p>Link Boardingpass</p>
    <a href="{{url('pdf/' . $_id)}}" class="link">Boardingpass</a>
</body>
</html>