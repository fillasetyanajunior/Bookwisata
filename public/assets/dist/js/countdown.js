$(document).ready(function () {
    var counter = $(".time").attr("content");

    if (counter > 0) {
        countDown();
    } else {
    }
    function countDown() {
        if (counter >= 0) {
            $('#waktu').html('Lakukan Pembayaran Sebelum 30 Menit : ' + counter);
        }
        else {
            download();
            return;
        }
        counter -= 1;

        var counter2 = setTimeout(countDown, 1000);
        return;
    }
    function download() {
        var bool
        var id = $(".time").attr("itemid")
        var _url = '/konfirmasi/' + id
        let _token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                is_active: 4,
                waktu_payment : 0,
                _token: _token
            },
            success: function (hasil) {
                bool = true
            }
        });
        console.log(bool)
        if (bool == true) {
            
        } else {
            window.location.href = '/riwayat'
        }
    }
    
});