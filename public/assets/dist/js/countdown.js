$(document).ready(function () {

    $(".companydetailriwayat").attr("disabled",true)
    $(".namadetailriwayat").attr("disabled",true)
    $(".emaildetailriwayat").attr("disabled",true)
    $(".nomerhpdetailriwayat").attr("disabled",true)
    $(".pilihandetailriwayat").attr("disabled",true)
    $(".tipedetailriwayat").attr("disabled",true)
    $(".jumlahsitdetailriwayat").attr("disabled",true)
    $(".hargadetailriwayat").attr("disabled",true)
    $(".jumlahpesanandetailriwayat").attr("disabled",true)
    $(".potongandetailriwayat").attr("disabled",true)
    $(".haridetailriwayat").attr("disabled",true)
    $(".totaldetailriwayat").attr("disabled",true)
    $(".datedetailriwayat").attr("disabled",true)
    $(".isactivedetailriwayat").attr("disabled",true)
    $(".notedetailriwayat").attr("disabled",true)

    $(".companykonfirmasi").attr("disabled",true)
    $(".namakonfirmasi").attr("disabled",true)
    $(".emailkonfirmasi").attr("disabled",true)
    $(".nomerhpkonfirmasi").attr("disabled",true)
    $(".pilihankonfirmasi").attr("disabled",true)
    $(".tipekonfirmasi").attr("disabled",true)
    $(".jumlahsitkonfirmasi").attr("disabled",true)
    $(".hargakonfirmasi").attr("disabled",true)
    $(".jumlahpesanankonfirmasi").attr("disabled",true)
    $(".potongankonfirmasi").attr("disabled",true)
    $(".harikonfirmasi").attr("disabled",true)
    $(".totalkonfirmasi").attr("disabled",true)
    $(".datekonfirmasi").attr("disabled",true)
    $(".notekonfirmasi").attr("disabled",true)


        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#Table tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    
    var counter = $(".time").attr("content");
    var _id = $(".time").attr("itemid")
    
    if (date('Y-m-d h:i:s' == counter)) {
        ubah();
    } else {
        
    }
    
    function ubah() {
        var _url = '/konfirmasi/' + _id
        let _token = $('meta[name="csrf-token"]').attr('content')
        
        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                is_active: 4,
                _token: _token
            },
            success: function (hasil) {
                
            }
        });
    }

    
    
    // var arr = location.pathname;

    // if (counter > 0) { 
    //     if (arr == "/riwayat") {
    //         $(".url").attr("onclick", "return confirm('Apakah Anda yakin akan pindah page ?');");
    //         $(".url").attr("url", "/konfirmasi/" + _id);
    //         ubah();
    //     }
    //     window.onload = function () {
    //         display = document.querySelector('#waktu');
    //         startTimer(counter, display);
    //     };
    // } else {
        
    // }

    

    // function startTimer(duration, display) {
    //     var timer = duration, minutes, seconds;
    //     setInterval(function () {
    //         minutes = parseInt(timer / 60, 10);
    //         seconds = parseInt(timer % 60, 10);

    //         minutes = minutes < 10 ? "0" + minutes : minutes;
    //         seconds = seconds < 10 ? "0" + seconds : seconds;

    //         display.textContent = minutes + ":" + seconds;

    //         if (--timer < 0) {
    //             timer = duration;
    //             download();
    //         }
    //     }, 1000);
    // }

    // function download() {
    //     var bool
    //     var id = $(".time").attr("itemid")
    //     var _url = '/konfirmasi/' + id
    //     let _token = $('meta[name="csrf-token"]').attr('content')

    //     $.ajax({
    //         type: 'POST',
    //         url: _url,
    //         data: {
    //             is_active: 4,
    //             waktu_payment : 0,
    //             _token: _token
    //         },
    //         success: function (hasil) {
    //             bool = true
    //         }
    //     });
    //     console.log(bool)
    //     if (bool == true) {
            
    //     } else {
    //         window.location.href = '/riwayat'
    //     }
    // }  
});
