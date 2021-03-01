$(document).ready(function () {
    var counter = $(".time").attr("content");
    var arr = location.pathname;
    var _id = $(".time").attr("itemid")

    if (counter > 0) { 
        if (arr == "/riwayat") {
            $(".url").attr("onclick", "return confirm('Apakah Anda yakin akan pindah page ?');");
            $(".url").attr("url", "/konfirmasi/" + _id);
            ubah();
        }
        window.onload = function () {
            display = document.querySelector('#waktu');
            startTimer(counter, display);
        };
    } else {
        
    }

    function ubah(){
        var _url = $(".url").attr("url")
        let _token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                is_active: 4,
                waktu_payment: 0,
                _token: _token
            },
            success: function (hasil) {
               
            }
        });
    }

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
                download();
            }
        }, 1000);
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
