<?php

use App\Http\Controllers\CobaController;
use App\Http\Controllers\ResponseApiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\AccessMenuController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelConteoller;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PromosiBusController;
use App\Http\Controllers\PromosiDestinasiController;
use App\Http\Controllers\PromosiGuideController;
use App\Http\Controllers\PromosiHotelController;
use App\Http\Controllers\PromosiKapalController;
use App\Http\Controllers\PromosiKulinerController;
use App\Http\Controllers\PromosiMobilController;
use App\Http\Controllers\PromosiPaketController;
use App\Http\Controllers\PromosiPusatController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TransaksiMitraController;
use App\Http\Controllers\UtamaController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These~
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/pdf/{id}',[PdfController::class, 'PdfGenerate']);

Route::get('/coba',function (){
    return view('email.konfirmasi');
});

Route::get('/',[UtamaController::class,'index']);
Route::post('/',[UtamaController::class,'Pencarian']);

Route::get('/listofbus',[UtamaController::class, 'ListOfBus'])->name('listofbus');
Route::get('/listofmobil',[UtamaController::class, 'ListOfMobil'])->name('listofmobil');
Route::get('/listofdestinasi',[UtamaController::class, 'ListOfDestinasi'])->name('listofdestinasi');
Route::get('/listofpusat',[UtamaController::class, 'ListOfPusat'])->name('listofpusat');
Route::get('/listofkuliner',[UtamaController::class, 'ListOfKuliner'])->name('listofkuliner');
Route::get('/listofhotel',[UtamaController::class, 'ListOfHotel'])->name('listofhotel');
Route::get('/listofkapal',[UtamaController::class, 'ListOfKapal'])->name('listofkapal');
Route::get('/listofguide',[UtamaController::class, 'ListOfGuide'])->name('listofguide');
Route::get('/listofpaket',[UtamaController::class, 'ListOfPaket'])->name('listofpaket');

Route::get('/detailbus/{bus}', [PromosiBusController::class,'show'])->name('detailbus');
Route::get('/detailmobil/{mobil}', [PromosiMobilController::class,'show'])->name('detailmobil');
Route::get('/detaildestinasi/{destinasi}', [PromosiDestinasiController::class,'show'])->name('detaildestinasi');
Route::get('/detailpusat/{pusat}', [PromosiPusatController::class,'show'])->name('detailpusat');
Route::get('/detailguide/{guide}', [PromosiGuideController::class,'show'])->name('detailguide');
Route::get('/detailhotel/{hotel}', [PromosiHotelController::class,'show'])->name('detailhotel');
Route::get('/detailkapal/{kapal}', [PromosiKapalController::class,'show'])->name('detailkapal');
Route::get('/detailpaket/{paket}', [PromosiPaketController::class,'show'])->name('detailpaket');
Route::get('/detailkuliner/{kuliner}', [PromosiKulinerController::class,'show'])->name('detailkuliner');

Route::group(['middleware' => ['auth', 'verified']], function () {
    
    Route::post('/layananmitra', [TransaksiMitraController::class, 'create']);
    Route::post('/layananmitra/create', [TransaksiMitraController::class, 'store']);

    Route::get('/riwayat',[RiwayatController::class,'index'])->name('riwayat');

    Route::get('detailriwayat/{riwayat}', [RiwayatController::class,'show']);
    
    //Bus
    Route::get('/bordingbus', [PromosiBusController::class,'index'])->name('showbordingbus');
    Route::post('/bordingbus', [PromosiBusController::class,'boording'])->name('bordingbus');
    Route::get('/bookchartbus', [PromosiBusController::class,'create'])->middleware('auth')->name('createbus');
    Route::post('/bookchartbus/bus/{bus}', [PromosiBusController::class,'store'])->name('storebus');
    Route::put('/bookchartbus/{riwayat}', [PromosiBusController::class,'update'])->name('updatebus');
    
    //Mobil
    Route::get('/bordingmobil', [PromosiMobilController::class,'index'])->name('showbordingmobil');
    Route::post('/bordingmobil', [PromosiMobilController::class,'boording'])->name('bordingmobil');
    Route::get('/bookchartmobil', [PromosiMobilController::class,'create'])->middleware('auth')->name('createmobil');
    Route::post('/bookchartmobil/mobil/{mobil}', [PromosiMobilController::class,'store'])->name('storemobil');
    Route::put('/bookchartmobil/{riwayat}', [PromosiMobilController::class,'update'])->name('updatemobil');
    
    //Destinasi
    Route::get('/bordingdestinasi', [PromosiDestinasiController::class,'index'])->name('showbordingdestinasi');
    Route::post('/bordingdestinasi', [PromosiDestinasiController::class,'boording'])->name('bordingdestinasi');
    Route::get('/bookchartdestinasi', [PromosiDestinasiController::class,'create'])->middleware('auth')->name('createdestinasi');
    Route::post('/bookchartdestinasi/destinasi/{destinasi}', [PromosiDestinasiController::class,'store'])->name('storedestinasi');
    Route::put('/bookchartdestinasi/{riwayat}', [PromosiDestinasiController::class,'update'])->name('updatedestinasi');
    
    //Pusat Oleh-oleh
    Route::get('/bordingpusat', [PromosiPusatController::class,'index'])->name('showbordingpusat');
    Route::post('/bordingpusat', [PromosiPusatController::class,'boording'])->name('bordingpusat');
    Route::get('/bookchartpusat', [PromosiPusatController::class,'create'])->middleware('auth')->name('createpusat');
    Route::post('/bookchartpusat/pusat/{pusat}', [PromosiPusatController::class,'store'])->name('storepusat');
    Route::put('/bookchartpusat/{riwayat}', [PromosiPusatController::class,'update'])->name('updatepusat');
    
    //Tourguide
    Route::get('/bordingguide', [PromosiGuideController::class,'index'])->name('showbordingguide');
    Route::post('/bordingguide', [PromosiGuideController::class,'boording'])->name('bordingguide');
    Route::get('/bookchartguide', [PromosiGuideController::class,'create'])->middleware('auth')->name('createguide');
    Route::post('/bookchartguide/guide/{guide}', [PromosiGuideController::class,'store'])->name('storeguide');
    Route::put('/bookchartguide/{riwayat}', [PromosiGuideController::class,'update'])->name('updateguide');
    
    //Hotel
    Route::get('/bordinghotel', [PromosiHotelController::class,'index'])->name('showbordinghotel');
    Route::post('/bordinghotel', [PromosiHotelController::class,'boording'])->name('bordinghotel');
    Route::get('/bookcharthotel', [PromosiHotelController::class,'create'])->middleware('auth')->name('createhotel');
    Route::post('/bookcharthotel/hotel/{hotel}', [PromosiHotelController::class,'store'])->name('storehotel');
    Route::put('/bookcharthotel/{riwayat}', [PromosiHotelController::class,'update'])->name('updatehotel');
    
    //Kapal Pesiar
    Route::get('/bordingkapal', [PromosiKapalController::class,'index'])->name('showbordingkapal');
    Route::post('/bordingkapal', [PromosiKapalController::class,'boording'])->name('bordingkapal');
    Route::get('/bookchartkapal', [PromosiKapalController::class,'create'])->middleware('auth')->name('createkapal');
    Route::post('/bookchartkapal/kapal/{kapal}', [PromosiKapalController::class,'store'])->name('storekapal');
    Route::put('/bookchartkapal/{riwayat}', [PromosiKapalController::class,'update'])->name('updatekapal');
    
    //Paket Wisata
    Route::get('/bordingpaket', [PromosiPaketController::class,'index'])->name('showbordingpaket');
    Route::post('/bordingpaket', [PromosiPaketController::class,'boording'])->name('bordingpaket');
    Route::get('/bookchartpaket', [PromosiPaketController::class,'create'])->middleware('auth')->name('createpaket');
    Route::post('/bookchartpaket/paket/{paket}', [PromosiPaketController::class,'store'])->name('storepaket');
    Route::put('/bookchartpaket/{riwayat}', [PromosiPaketController::class,'update'])->name('updatepaket');
    
    //Kuliner
    Route::get('/konfrimasi', [PromosiKulinerController::class,'index'])->name('showbordingkuliner');
    Route::post('/bordingkuliner', [PromosiKulinerController::class,'boording'])->name('bordingkuliner');
    Route::get('/bookchartkuliner', [PromosiKulinerController::class,'create'])->middleware('auth')->name('createkuliner');
    Route::post('/bookchartkuliner/kuliner/{kuliner}', [PromosiKulinerController::class,'store'])->name('storekuliner');
    Route::put('/bookchartkuliner/{riwayat}', [PromosiKulinerController::class,'update'])->name('updatekuliner');
});

Route::middleware(['auth', 'verified','user'])->group(function () {
    
    //Konfirmasi
    Route::get('/konfirmasi_pembayaran', [KonfirmasiController::class,'index'])->name('konfirmasi_pembayaran');
    Route::get('/konfirmasi_pembayaran/create', [KonfirmasiController::class,'create'])->name('create_konfirmasi_pembayaran');
    Route::post('/konfirmasi_pembayaran', [KonfirmasiController::class,'store'])->name('store_konfirmasi_pembayaran');
});


Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/myprofile', [HomeController::class, 'Myprofile'])->name('myprofile');
Route::post('/myprofile/{user}', [HomeController::class, 'UpdateMyProfile']);

Route::group(['middleware' => ['auth', 'verified','admin']], function () {
    
    Route::get('/menu',[MenuController::class,'index'])->name('menu');
    Route::get('/menu/create',[MenuController::class,'create'])->name('create_menu');
    Route::post('/menu',[MenuController::class,'store'])->name('store_menu');
    Route::get('/menu/{menu}',[MenuController::class,'edit'])->name('edit_menu');
    Route::put('/menu/{menu}',[MenuController::class,'update'])->name('update_menu');
    Route::delete('/menu/{menu}',[MenuController::class,'destroy'])->name('destroy_menu');
    
    Route::get('/submenu',[SubMenuController::class,'index'])->name('submenu');
    Route::get('/submenu/create',[SubMenuController::class,'create'])->name('create_submenu');
    Route::post('/submenu',[SubMenuController::class,'store'])->name('store_submenu');
    Route::get('/submenu/{subMenu}',[SubMenuController::class,'edit'])->name('edit_submenu');
    Route::put('/submenu/{subMenu}',[SubMenuController::class,'update'])->name('update_submenu');
    Route::delete('/submenu/{subMenu}',[SubMenuController::class,'destroy'])->name('destroy_submenu');
    
    Route::get('/accessmenu',[AccessMenuController::class,'index'])->name('accessmenu');
    Route::get('/accessmenu/create',[AccessMenuController::class,'create'])->name('create_accessmenu');
    Route::post('/accessmenu',[AccessMenuController::class,'store'])->name('store_accessmenu');
    Route::get('/accessmenu/{accessMenu}',[AccessMenuController::class,'edit'])->name('edit_accessmenu');
    Route::put('/accessmenu/{accessMenu}',[AccessMenuController::class,'update'])->name('update_accessmenu');
    Route::delete('/accessmenu/{accessMenu}',[AccessMenuController::class,'destroy'])->name('destroy_accessmenu');

    Route::get('/informasi',[InformasiController::class,'index'])->name('informasi');
    Route::get('/informasi/create',[InformasiController::class,'create'])->name('create_informasi');
    Route::post('/informasi',[InformasiController::class,'store'])->name('store_informasi');
    Route::get('/informasi/{informasi}',[InformasiController::class,'edit'])->name('edit_informasi');
    Route::put('/informasi/{informasi}',[InformasiController::class,'update'])->name('update_informasi');
    Route::delete('/informasi/{informasi}',[InformasiController::class,'destroy'])->name('destroy_informasi');

    Route::get('/managementuser', [ManagementUserController::class, 'index'])->name('managementuser');
    Route::get('/managementuser/edit/{user}', [ManagementUserController::class, 'EditOfUser'])->name('edit_managementuser');
    Route::get('/managementuser/show/{user}', [ManagementUserController::class, 'show']);
    Route::post('/managementuser/{user}', [ManagementUserController::class, 'update'])->name('update_managementuser');

    Route::get('/showlayananmitra', [TransaksiMitraController::class,'index'])->name('layananmitra');
});
Route::group(['middleware' => ['auth','verified','mitra']], function () {
    
    Route::get('/bus',[BusController::class,'index'])->name('bus');
    Route::get('/bus/create',[BusController::class,'create'])->name('create_bus');
    Route::post('/bus', [BusController::class,'store'])->name('store_bus');
    Route::get('/bus/{bus}', [BusController::class,'edit'])->name('edit_bus');
    Route::put('/bus/{bus}', [BusController::class,'update'])->name('update_bus');
    Route::delete('/bus/{bus}', [BusController::class,'destroy'])->name('destroy_bus');
    
    Route::get('/mobil',[MobilController::class,'index'])->name('mobil');
    Route::get('/mobil/create',[MobilController::class,'create'])->name('create_mobil');
    Route::post('/mobil', [MobilController::class,'store'])->name('store_mobil');
    Route::get('/mobil/{mobil}', [MobilController::class,'edit'])->name('edit_mobil');
    Route::put('/mobil/{mobil}', [MobilController::class,'update'])->name('update_mobil');
    Route::delete('/mobil/{mobil}', [MobilController::class,'destroy'])->name('destroy_mobil');
    
    Route::get('/destinasi',[DestinasiController::class,'index'])->name('destinasi');
    Route::get('/destinasi/create',[DestinasiController::class,'create'])->name('create_destinasi');
    Route::post('/destinasi', [DestinasiController::class,'store'])->name('store_destinasi');
    Route::get('/destinasi/{destinasi}', [DestinasiController::class,'edit'])->name('edit_destinasi');
    Route::put('/destinasi/{destinasi}', [DestinasiController::class,'update'])->name('update_destinasi');
    Route::delete('/destinasi/{destinasi}', [DestinasiController::class,'destroy'])->name('destroy_destinasi');
    
    Route::get('/hotel',[HotelConteoller::class,'index'])->name('hotel');
    Route::get('/hotel/create',[HotelConteoller::class,'create'])->name('create_hotel');
    Route::post('/hotel', [HotelConteoller::class,'store'])->name('store_hotel');
    Route::get('/hotel/{hotel}', [HotelConteoller::class,'edit'])->name('edit_hotel');
    Route::put('/hotel/{hotel}', [HotelConteoller::class,'update'])->name('update_hotel');
    Route::delete('/hotel/{hotel}', [HotelConteoller::class,'destroy'])->name('destroy_hotel');
    
    Route::get('/kapal',[KapalController::class,'index'])->name('kapal');
    Route::get('/kapal/create',[KapalController::class,'create'])->name('create_kapal');
    Route::post('/kapal', [KapalController::class,'store'])->name('store_kapal');
    Route::get('/kapal/{kapal}', [KapalController::class,'edit'])->name('edit_kapal');
    Route::put('/kapal/{kapal}', [KapalController::class,'update'])->name('update_kapal');
    Route::delete('/kapal/{kapal}', [KapalController::class,'destroy'])->name('destroy_kapal');
    
    Route::get('/paket',[PaketController::class,'index'])->name('paket');
    Route::get('/paket/create',[PaketController::class,'create'])->name('create_paket');
    Route::post('/paket', [PaketController::class,'store'])->name('store_paket');
    Route::get('/paket/{paket}', [PaketController::class,'edit'])->name('edit_paket');
    Route::put('/paket/{paket}', [PaketController::class,'update'])->name('update_paket');
    Route::delete('/paket/{paket}', [PaketController::class,'destroy'])->name('destroy_paket');
    
    Route::get('/kuliner',[KulinerController::class,'index'])->name('kuliner');
    Route::get('/kuliner/create',[KulinerController::class,'create'])->name('create_kuliner');
    Route::post('/kuliner', [KulinerController::class,'store'])->name('store_kuliner');
    Route::get('/kuliner/{kuliner}', [KulinerController::class,'edit'])->name('edit_kuliner');
    Route::put('/kuliner/{kuliner}', [KulinerController::class,'update'])->name('update_kuliner');
    Route::delete('/kuliner/{kuliner}', [KulinerController::class,'destroy'])->name('destroy_kuliner');
    
    Route::get('/pusat',[PusatController::class,'index'])->name('pusat');
    Route::get('/pusat/create',[PusatController::class,'create'])->name('create_pusat');
    Route::post('/pusat', [PusatController::class,'store'])->name('store_pusat');
    Route::get('/pusat/{pusat}', [PusatController::class,'edit'])->name('edit_pusat');
    Route::put('/pusat/{pusat}', [PusatController::class,'update'])->name('update_pusat');
    Route::delete('/pusat/{pusat}', [PusatController::class,'destroy'])->name('destroy_pusat');
    
    Route::get('/guide',[GuideController::class,'index'])->name('guide');
    Route::get('/guide/create',[GuideController::class,'create'])->name('create_guide');
    Route::post('/guide', [GuideController::class,'store'])->name('store_guide');
    Route::get('/guide/{guide}', [GuideController::class,'edit'])->name('edit_guide');
    Route::put('/guide/{guide}', [GuideController::class,'update'])->name('update_guide');
    Route::delete('/guide/{guide}', [GuideController::class,'destroy'])->name('destroy_guide');

    Route::get('/konfirmasi/{riwayat}',[RiwayatController::class,'edit'])->name('konfirmasi');
    Route::post('/konfirmasi/{riwayat}',[RiwayatController::class,'update'])->name('riwayatkonfirmasi');

    Route::post('/kabupaten',[ResponseApiController::class, 'kabupaten']);
});  
    
    // //Coba
    // Route::get('/coba',[CobaController::class,'index'])->name('coba');
    // Route::post('/cobas',[CobaController::class,'coba'])->name('cobas');
    
