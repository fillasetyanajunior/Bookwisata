$(document).ready(function () {
    $('#addbus').click(function () {
        $('.footer_bus button[type=submit]').html('Add');
        $('#BusModalLabel').html('Tambah Posting Bus');
        $('.body_bus form').attr('action', '/bus/store');
        $('.body_bus form').attr('method', 'post');

        $("#nama").val('');
        $("#po").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#transmisi").val('');
        $("#ac").val('');
        $("#overland").val('');
        $("#jumlah_sit").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editbus*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_bus button[type=submit]').html('Edit');
        $('#BusModalLabel').html('Edit Posting Bus');
        $('.body_bus form').attr('action', '/bus/update/' + id);
        $('.body_bus form').attr('method', 'post');

        let _url = '/bus/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.bus.nama);
                $("#po").val(hasil.bus.po);
                $("#form_prov option[value='" + hasil.bus.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.bus.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.bus.tipe + "']").attr('selected', true);
                $("#transmisi option[value='" + hasil.bus.transmisi + "']").attr('selected', true);
                $("#ac option[value='" + hasil.bus.ac + "']").attr('selected', true);
                $("#overland option[value='" + hasil.bus.overland + "']").attr('selected', true);
                $("#jumlah_sit").val(hasil.bus.jumlah_sit);
                $("#sale").val(hasil.bus.sale);
                $("#harga").val(hasil.bus.harga);
                $("#review").val(hasil.bus.review);
            }
        });
    });
    $('#addcamp').click(function () {
        $('.footer_camp button[type=submit]').html('Add');
        $('#CampModalLabel').html('Tambah Posting Camp');
        $('.body_camp form').attr('action', '/camp/store');
        $('.body_camp form').attr('method', 'post');

        $("#nama").val('');
        $("#company").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editcamp*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_camp button[type=submit]').html('Edit');
        $('#CampModalLabel').html('Edit Posting Camp');
        $('.body_camp form').attr('action', '/camp/update/' + id);
        $('.body_camp form').attr('method', 'post');

        let _url = '/camp/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.camp.nama);
                $("#company").val(hasil.camp.company);
                $("#form_prov option[value='" + hasil.camp.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.camp.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.camp.tipe + "']").attr('selected', true);
                $("#sale").val(hasil.camp.sale);
                $("#harga").val(hasil.camp.harga);
                $("#review").val(hasil.camp.review);
            }
        });
    });
    $('#adddestinasi').click(function () {
        $('.footer_destinasi button[type=submit]').html('Add');
        $('#DestinasiModalLabel').html('Tambah Posting Destinasi');
        $('.body_destinasi form').attr('action', '/destinasi/store');
        $('.body_destinasi form').attr('method', 'post');

        $("#nama").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#alamat").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editdestinasi*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_destinasi button[type=submit]').html('Edit');
        $('#DestinasiModalLabel').html('Edit Posting Destinasi');
        $('.body_destinasi form').attr('action', '/destinasi/update/' + id);
        $('.body_destinasi form').attr('method', 'post');

        let _url = '/destinasi/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.destinasi.nama);
                $("#alamat").val(hasil.destinasi.alamat);
                $("#form_prov option[value='" + hasil.destinasi.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.destinasi.kabupaten + "']").attr('selected', true);
                $("#sale").val(hasil.destinasi.sale);
                $("#harga").val(hasil.destinasi.harga);
                $("#review").val(hasil.destinasi.review);
            }
        });
    });
    $('#addguide').click(function () {
        $('.footer_guide button[type=submit]').html('Add');
        $('#GuideModalLabel').html('Tambah Posting Tour Guide');
        $('.body_guide form').attr('action', '/guide/store');
        $('.body_guide form').attr('method', 'post');

        $("#nama").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editguide*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_guide button[type=submit]').html('Edit');
        $('#GuideModalLabel').html('Edit Posting Tour Guide');
        $('.body_guide form').attr('action', '/guide/update/' + id);
        $('.body_guide form').attr('method', 'post');

        let _url = '/guide/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.guide.nama);
                $("#form_prov option[value='" + hasil.guide.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.guide.kabupaten + "']").attr('selected', true);
                $("#sale").val(hasil.guide.sale);
                $("#harga").val(hasil.guide.harga);
                $("#review").val(hasil.guide.review);
            }
        });
    });
    $('#addhotel').click(function () {
        $('.footer_hotel button[type=submit]').html('Add');
        $('#hotelModalLabel').html('Tambah Posting Hotel');
        $('.body_hotel form').attr('action', '/hotel/store');
        $('.body_hotel form').attr('method', 'post');

        $("#nama").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#bad").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#edithotel*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_hotel button[type=submit]').html('Edit');
        $('#hotelModalLabel').html('Edit Posting Hotel');
        $('.body_hotel form').attr('action', '/hotel/update/' + id);
        $('.body_hotel form').attr('method', 'post');

        let _url = '/hotel/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.hotel.nama);
                $("#form_prov option[value='" + hasil.hotel.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.hotel.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.hotel.tipe + "']").attr('selected', true);
                $("#bad option[value='" + hasil.hotel.bad + "']").attr('selected', true);
                $("#sale").val(hasil.hotel.sale);
                $("#harga").val(hasil.hotel.harga);
                $("#review").val(hasil.hotel.review);
            }
        });
    });
    $('#addkapal').click(function () {
        $('.footer_kapal button[type=submit]').html('Add');
        $('#KapalModalLabel').html('Tambah Posting Kapal Pesiar');
        $('.body_kapal form').attr('action', '/kapal/store');
        $('.body_kapal form').attr('method', 'post');

        $("#nama").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editkapal*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_kapal button[type=submit]').html('Edit');
        $('#KapalModalLabel').html('Edit Posting Kapal Pesiar');
        $('.body_kapal form').attr('action', '/kapal/update/' + id);
        $('.body_kapal form').attr('method', 'post');

        let _url = '/kapal/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.kapal.nama);
                $("#form_prov option[value='" + hasil.kapal.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.kapal.kabupaten + "']").attr('selected', true);
                $("#sale").val(hasil.kapal.sale);
                $("#harga").val(hasil.kapal.harga);
                $("#review").val(hasil.kapal.review);
            }
        });
    });
    $('#addkuliner').click(function () {
        $('.footer_kuliner button[type=submit]').html('Add');
        $('#KulinerModalLabel').html('Tambah Posting Kuliner');
        $('.body_kuliner form').attr('action', '/kuliner/store');
        $('.body_kuliner form').attr('method', 'post');

        $("#nama").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#alamat").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editkuliner*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_kuliner button[type=submit]').html('Edit');
        $('#KulinerModalLabel').html('Edit Posting Kuliner');
        $('.body_kuliner form').attr('action', '/kuliner/update/' + id);
        $('.body_kuliner form').attr('method', 'post');

        let _url = '/kuliner/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.kuliner.nama);
                $("#form_prov option[value='" + hasil.kuliner.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.kuliner.kabupaten + "']").attr('selected', true);
                $("#alamat").val(hasil.kuliner.alamat);
                $("#sale").val(hasil.kuliner.sale);
                $("#harga").val(hasil.kuliner.harga);
                $("#review").val(hasil.kuliner.review);
            }
        });
    })
    $('#addmobil').click(function () {
        $('.footer_mobil button[type=submit]').html('Add');
        $('#MobilModalLabel').html('Tambah Posting Mobil');
        $('.body_mobil form').attr('action', '/mobil/store');
        $('.body_mobil form').attr('method', 'post');

        $("#nama").val('');
        $("#company").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#transmisi").val('');
        $("#ac").val('');
        $("#overland").val('');
        $("#jumlah_sit").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editmobil*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_mobil button[type=submit]').html('Edit');
        $('#MobilModalLabel').html('Edit Posting Mobil');
        $('.body_mobil form').attr('action', '/mobil/update/' + id);
        $('.body_mobil form').attr('method', 'post');

        let _url = '/mobil/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.mobil.nama);
                $("#company").val(hasil.mobil.company);
                $("#form_prov option[value='" + hasil.mobil.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.mobil.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.mobil.tipe + "']").attr('selected', true);
                $("#transmisi option[value='" + hasil.mobil.transmisi + "']").attr('selected', true);
                $("#ac option[value='" + hasil.mobil.ac + "']").attr('selected', true);
                $("#overland option[value='" + hasil.mobil.overland + "']").attr('selected', true);
                $("#jumlah_sit").val(hasil.mobil.jumlah_sit);
                $("#sale").val(hasil.mobil.sale);
                $("#harga").val(hasil.mobil.harga);
                $("#review").val(hasil.mobil.review);
            }
        });
    });
    $('#addpaket').click(function () {
        $('.footer_paket button[type=submit]').html('Add');
        $('#PaketModalLabel').html('Tambah Posting Paket Wisata');
        $('.body_paket form').attr('action', '/paket/store');
        $('.body_paket form').attr('method', 'post');

        $("#nama").val('');
        $("#company").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editpaket*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_paket button[type=submit]').html('Edit');
        $('#PaketModalLabel').html('Edit Posting Paket Wisata');
        $('.body_paket form').attr('action', '/paket/update/' + id);
        $('.body_paket form').attr('method', 'post');

        let _url = '/paket/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.paket.nama);
                $("#company").val(hasil.paket.company);
                $("#form_prov option[value='" + hasil.paket.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.paket.kabupaten + "']").attr('selected', true);
                $("#sale").val(hasil.paket.sale);
                $("#harga").val(hasil.paket.harga);
                $("#review").val(hasil.paket.review);
            }
        });
    });
    $('#addpusat').click(function () {
        $('.footer_pusat button[type=submit]').html('Add');
        $('#PusatModalLabel').html('Tambah Posting Pusat Oleh-Oleh');
        $('.body_pusat form').attr('action', '/pusat/store');
        $('.body_pusat form').attr('method', 'post');

        $("#nama").val('');
        $("#alamat").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editpusat*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_pusat button[type=submit]').html('Edit');
        $('#PusatModalLabel').html('Edit Posting Pusat Oleh-Oleh');
        $('.body_pusat form').attr('action', '/pusat/update/' + id);
        $('.body_pusat form').attr('method', 'post');

        let _url = '/pusat/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.pusat.nama);
                $("#alamat").val(hasil.pusat.alamat);
                $("#form_prov option[value='" + hasil.pusat.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.pusat.kabupaten + "']").attr('selected', true);
                $("#sale").val(hasil.pusat.sale);
                $("#harga").val(hasil.pusat.harga);
                $("#review").val(hasil.pusat.review);
            }
        });
    });
    $('#addsepeda').click(function () {
        $('.footer_sepeda button[type=submit]').html('Add');
        $('#SepedaModalLabel').html('Tambah Posting Sepeda');
        $('.body_sepeda form').attr('action', '/sepeda/store');
        $('.body_sepeda form').attr('method', 'post');

        $("#nama").val('');
        $("#company").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#editsepeda*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_sepeda button[type=submit]').html('Edit');
        $('#SepedaModalLabel').html('Edit Posting Sepeda');
        $('.body_sepeda form').attr('action', '/sepeda/update/' + id);
        $('.body_sepeda form').attr('method', 'post');

        let _url = '/sepeda/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.sepeda.nama);
                $("#company").val(hasil.sepeda.company);
                $("#form_prov option[value='" + hasil.sepeda.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.sepeda.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.sepeda.tipe + "']").attr('selected', true);
                $("#sale").val(hasil.sepeda.sale);
                $("#harga").val(hasil.sepeda.harga);
                $("#review").val(hasil.sepeda.review);
            }
        });
    });
    $('#addtour').click(function () {
        $('.footer_tour button[type=submit]').html('Add');
        $('#TourModalLabel').html('Tambah Posting Paket Tour');
        $('.body_tour form').attr('action', '/tour/store');
        $('.body_tour form').attr('method', 'post');

        $("#nama").val('');
        $("#company").val('');
        $("#form_prov").val('');
        $("#form_kab").val('');
        $("#tipe").val('');
        $("#harga").val('');
        $("#review").val('');
        $("#formFile").val('');
    })
    $('#edittour*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_tour button[type=submit]').html('Edit');
        $('#TourModalLabel').html('Edit Posting Paket Tour');
        $('.body_tour form').attr('action', '/tour/update/' + id);
        $('.body_tour form').attr('method', 'post');

        let _url = '/tour/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama").val(hasil.tour.nama);
                $("#company").val(hasil.tour.company);
                $("#form_prov option[value='" + hasil.tour.provinsi + "']").attr('selected', true);
                $("#form_kab option[value='" + hasil.tour.kabupaten + "']").attr('selected', true);
                $("#tipe option[value='" + hasil.tour.tipe + "']").attr('selected', true);
                $("#sale").val(hasil.tour.sale);
                $("#harga").val(hasil.tour.harga);
                $("#review").val(hasil.tour.review);
            }
        });
    });
    $('#addaccessmenu').click(function () {
        $('.footer_accessmenu button[type=submit]').html('Add');
        $('#AccessMenuModalLabel').html('Tambah Access Menu');
        $('.body_accessmenu form').attr('action', '/accessmenu/store');
        $('.body_accessmenu form').attr('method', 'post');

        $("#menu_id").val('');
        $("#role_id").val('');
    })
    $('#editaccessmenu*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_accessmenu button[type=submit]').html('Edit');
        $('#AccessMenuModalLabel').html('Edit Access Menu');
        $('.body_accessmenu form').attr('action', '/accessmenu/update/' + id);
        $('.body_accessmenu form').attr('method', 'post');

        let _url = '/accessmenu/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#menu_id option[value='" + hasil.accessmenu.menu_id + "']").attr('selected', true)
                $("#role_id option[value='" + hasil.accessmenu.role_id + "']").attr('selected', true)
            }
        });
    });
    $('#addinformasi').click(function () {
        $('.footer_informasi button[type=submit]').html('Add');
        $('#InformasiModalLabel').html('Tambah Informasi');
        $('.body_informasi form').attr('action', '/informasi/store');
        $('.body_informasi form').attr('method', 'post');

        $("#title").val('');
        $("#informasi").val('');
    })
    $('#editinformasi*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_informasi button[type=submit]').html('Edit');
        $('#InformasiModalLabel').html('Edit Informasi');
        $('.body_informasi form').attr('action', '/informasi/update/' + id);
        $('.body_informasi form').attr('method', 'post');

        let _url = '/informasi/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#title").val(hasil.informasi.title)
                $("#informasi").val(hasil.informasi.informasi);
                $("#pilihinformasi option[value='" + hasil.informasi.pilihinformasi + "']").attr('selected', true)
            }
        });
    });
    $('#editmanagementuser*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_managementuser button[type=submit]').html('Edit');
        $('#ManagemenUserModalLabel').html('Edit User');
        $('.body_managementuser form').attr('action', '/managementuser/update/' + id);
        $('.body_managementuser form').attr('method', 'post');

        let _url = '/managementuser/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#name").val(hasil.user.name)
                $("#role option[value='" + hasil.user.role + "']").attr('selected', true)
            }
        });
    });
    $('#addmenu').click(function () {
        $('.footer_menu button[type=submit]').html('Add');
        $('#MenuModalLabel').html('Tambah Menu');
        $('.body_menu form').attr('action', '/menu/store');
        $('.body_menu form').attr('method', 'post');

        $("#nama_menu").val('');
        $("#icon").val('');
    })
    $('#editmenu*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_menu button[type=submit]').html('Edit');
        $('#MenuModalLabel').html('Edit Menu');
        $('.body_menu form').attr('action', '/menu/update/' + id);
        $('.body_menu form').attr('method', 'post');

        let _url = '/menu/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#nama_menu").val(hasil.menu.menu);
                $("#icon").val(hasil.menu.icon);
            }
        });
    });
    $('#addsubmenu').click(function () {
        $('.footer_submenu button[type=submit]').html('Add');
        $('#SubMenuModalLabel').html('Tambah Sub Menu');
        $('.body_submenu form').attr('action', '/submenu/store');
        $('.body_submenu form').attr('method', 'post');

         $("#menu_id").val('')
         $("#sub_menu").val('');
         $("#icon").val('');
         $("#url").val('');
    })
    $('#editsubmenu*').on('click', function () {
        const id = $(this).data('id');
        $('.footer_submenu button[type=submit]').html('Edit');
        $('#SubMenuModalLabel').html('Edit Sub Menu');
        $('.body_submenu form').attr('action', '/submenu/update/' + id);
        $('.body_submenu form').attr('method', 'post');

        let _url = '/submenu/edit/' + id;
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: _url,
            data: {
                _token: _token
            },
            success: function (hasil) {
                $("#menu_id option[value='" + hasil.submenu.menu_id + "']").attr('selected', true)
                $("#sub_menu").val(hasil.submenu.sub_menu);
                $("#icon").val(hasil.submenu.icon);
                $("#url").val(hasil.submenu.url);
            }
        });
    });
})
