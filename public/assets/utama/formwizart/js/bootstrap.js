function scroll_to_class(element_class, removed_height) {
    var scroll_to = $(element_class).offset().top - removed_height;
    if ($(window).scrollTop() != scroll_to) {
        $('html, body').stop().animate({
            scrollTop: scroll_to
        }, 0);
    }
}

function bar_progress(progress_line_object, direction) {
    var number_of_steps = progress_line_object.data('number-of-steps');
    var now_value = progress_line_object.data('now-value');
    var new_value = 0;
    if (direction == 'right') {
        new_value = now_value + (100 / number_of_steps);
    } else if (direction == 'left') {
        new_value = now_value - (100 / number_of_steps);
    }
    progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
}

$(document).ready(function () {
    // Form
    $('.f1 fieldset:first').fadeIn('slow');

    $('.f1 input[type="text"], .f1 input[type="password"], .f1 input[type="email"], .f1 textarea, .f1 select, .f1 input[type="date"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    // step selanjutnya (ketika klik tombol selanjutnya)
    $('.f1 .btn-next').on('click', function () {
        var parent_fieldset = $(this).parents('fieldset');
        var next_step = true;
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        // validasi form
        parent_fieldset.find('input[type="text"], input[type="password"], input[type="email"], textarea, select, input[type="date"]').each(function () {
            if ($(this).val() == "") {
                $(this).addClass('input-error');
                next_step = false;
            } else {
                $(this).removeClass('input-error');
            }
        });

        if (next_step) {
            parent_fieldset.fadeOut(400, function () {
                // change icons
                current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                // progress bar
                bar_progress(progress_line, 'right');
                // show next step
                $(this).next().fadeIn();
                // scroll window to beginning of the form
                scroll_to_class($('.f1'), 20);
            });
        }
    });

    // step sbelumnya (ketika klik tombol sebelumnya)
    $('.f1 .btn-previous').on('click', function () {
        // navigation steps / progress steps
        var current_active_step = $(this).parents('.f1').find('.f1-step.active');
        var progress_line = $(this).parents('.f1').find('.f1-progress-line');

        $(this).parents('fieldset').fadeOut(400, function () {
            // change icons
            current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
            // progress bar
            bar_progress(progress_line, 'left');
            // show previous step
            $(this).prev().fadeIn();
            // scroll window to beginning of the form
            scroll_to_class($('.f1'), 20);
        });
    });

    // submit (ketika klik tombol submit diakhir wizard)
    $('.f1').on('submit', function (e) {
        // validasi form
        $(this).find('input[type="text"], input[type="password"], input[type="email"], textarea, select, input[type="date"]').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
            } else {
                $(this).removeClass('input-error');
            }
        });
    });
    var format = function (num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted);
    }

    $('input[type="date"]').change(function () {
        $('#tanggal').html($(this).val())
        $('#tanggaldetailpesanan').html($(this).val())
        const hari = new Date($(this).val())
        var haris = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
        $('#haridetailpesanan').html(haris[hari.getDay()])

    })
    $('input[name="namalengkap"]').keyup(function () {
        $('#namadetailpesanan').html($(this).val())
    })
    $('input[name="nomerhp"]').keyup(function () {
        $('#nomerdetailpesanan').html($(this).val())
    })
    $('input[name="email"]').keyup(function () {
        $('#emaildetailpesanan').html($(this).val())
    })
    $('select[name="hari"]').change(function () {
        $('#jumlahhari').html($(this).val() + ' Hari')
        var total = 0
        var hari = $(this).val()
        const harga = $('input[name="pricetotal"]').val()
        total = hari * Number(harga.replace(/[^0-9.-]+/g, ""))

        var diskon = (10 / 100) * total

        $('#potongan').html('Rp. ' + format(diskon))
        $('#totalprice').html('Rp. ' + format(total))
    })
});
