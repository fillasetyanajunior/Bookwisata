<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{url('assets/utama/js/jquery-3-5-1.js') }}"></script>
    <script language="javascript" type="text/javaScript">
     $(document).ready(function () {
        $('.link').show()
        $('.link').on('click',function () {
             $('.link').hide()
        });

        
    });
    </script>
    <title>Boardingpass</title>
</head>
<body>
    <h4>Halo </h4>
    <p>Terima kasih telah memesan layanan kami semoga kamu senang dengan pelayanan kami.</p>
    <p>Untuk itu kami ingatkan untuk kamu untuk mencetak Boardingpas yang kami kirimkan <span>dan setelah itu tunjukan kepada mitra kami yang bergabung untuk mengambil layanan yang kami sediakan untuk anda.</span> </p>
    <p>Untuk informasi lebih lanjut mengenai layanan kami,silahkan menghubungi kami di customer support (+62 274 - 443165) atau melalui live chat di <a href="{{url('/')}}">bookwisata.com</a> </p>
    <p>Salam</p>
    <p>{{env('APP_NAME')}}</p>
    <br><br><br>
    <p>Link Boardingpass</p>
    <a href="" class="link">Boardingpass</a>
    
</body>
</html>