$(document).ready(function () {

    let datas = $('#form_kab').attr('datas')
    // ambil data kabupaten ketika data memilih provinsi
    if(!datas)
    {
        $('#form_prov').on("change", function () {
            var id = $(this).val();
            let _url = '/kabupaten';
            let _token = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                type: 'POST',
                url : _url,
                data: {
                    id: id,
                    _token: _token
                },
                success: function (hasil) {
                    $("#form_kab").removeAttr('disabled')
                    $("#form_kab").empty()
                    $("#form_kab").show();
                    $.each(hasil.kota,function (index,kotas){
                        $("#form_kab").append('<option value="' + kotas.id + '"' +  '>' + kotas.nama + '</option>');
                    })
                }
            });
        });
    }else
    {
        $('#form_prov').mouseover( function () {
            var id = $(this).val();
            let _url = '/kabupaten';
            let datas = $('#form_kab').attr('datas')
            let _token = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                type: 'POST',
                url: _url,
                data: {
                    id: id,
                    _token: _token,
                    datas: datas
                },
                success: function (hasil) {
                    $("#form_kab").removeAttr('disabled')
                    $("#form_kab").empty()
                    $("#form_kab").show();
                    $.each(hasil.kota, function (index, kotas) {
                        $("#form_kab").append('<option value="' + kotas.id + '"' + '>' + kotas.nama + '</option>');
                        $("#form_kab option[value='" + datas + "']").attr('selected', true);
                    })
                }
            });
        });
        $('#file').hide()
        $('#checkbox').click(function(){
            if ($(this).is(':checked')){
                $('#file').show()
            }else{
                $('#file').hide()
            }
        });
    }
    
});