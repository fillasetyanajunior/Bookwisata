<?php

use App\Http\Controllers\CobaController;
use App\Http\Controllers\ResponseApiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\AccessMenuController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HotelConteoller;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\CampController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SepedaController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\PromosiBusController;
use App\Http\Controllers\PromosiDestinasiController;
use App\Http\Controllers\PromosiGuideController;
use App\Http\Controllers\PromosiHotelController;
use App\Http\Controllers\PromosiKapalController;
use App\Http\Controllers\PromosiKulinerController;
use App\Http\Controllers\PromosiMobilController;
use App\Http\Controllers\PromosiPaketController;
use App\Http\Controllers\PromosiPusatController;
use App\Http\Controllers\PromosiTourController;
use App\Http\Controllers\PromosiCampController;
use App\Http\Controllers\PromosiSepedaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KonfirmasiController;
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
    return view('paketbook.bus.confirmbus');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/',[UtamaController::class,'index']);
Route::post('/',[UtamaController::class,'Pencarian']);

Route::get('/daftarlayananmitra', [UtamaController::class,'LayananMitra'])->name('daftarlayananmitra');
Route::get('/faq', [UtamaController::class,'Faq'])->name('faq');
Route::get('/contact', [UtamaController::class,'Contact'])->name('contact');
Route::get('/lowongankerja', [UtamaController::class,'LowonganKerja'])->name('lowongankerja');

Route::get('/listofbus',[UtamaController::class, 'ListOfBus'])->name('listofbus');
Route::get('/listofmobil',[UtamaController::class, 'ListOfMobil'])->name('listofmobil');
Route::get('/listofdestinasi',[UtamaController::class, 'ListOfDestinasi'])->name('listofdestinasi');
Route::get('/listofpusat',[UtamaController::class, 'ListOfPusat'])->name('listofpusat');
Route::get('/listofkuliner',[UtamaController::class, 'ListOfKuliner'])->name('listofkuliner');
Route::get('/listofhotel',[UtamaController::class, 'ListOfHotel'])->name('listofhotel');
Route::get('/listofkapal',[UtamaController::class, 'ListOfKapal'])->name('listofkapal');
Route::get('/listofguide',[UtamaController::class, 'ListOfGuide'])->name('listofguide');
Route::get('/listofpaket',[UtamaController::class, 'ListOfPaket'])->name('listofpaket');
Route::get('/listoftour',[UtamaController::class, 'ListOfTour'])->name('listoftour');
Route::get('/listofsepeda',[UtamaController::class, 'ListOfSepeda'])->name('listofsepeda');
Route::get('/listofcamp',[UtamaController::class, 'ListOfCamp'])->name('listofcamp');

Route::get('/detailbus/{bus}', [PromosiBusController::class,'index'])->name('detailbus');
Route::get('/detailmobil/{mobil}', [PromosiMobilController::class,'index'])->name('detailmobil');
Route::get('/detaildestinasi/{destinasi}', [PromosiDestinasiController::class,'index'])->name('detaildestinasi');
Route::get('/detailpusat/{pusat}', [PromosiPusatController::class,'index'])->name('detailpusat');
Route::get('/detailguide/{guide}', [PromosiGuideController::class,'index'])->name('detailguide');
Route::get('/detailhotel/{hotel}', [PromosiHotelController::class,'index'])->name('detailhotel');
Route::get('/detailkapal/{kapal}', [PromosiKapalController::class,'index'])->name('detailkapal');
Route::get('/detailpaket/{paket}', [PromosiPaketController::class,'index'])->name('detailpaket');
Route::get('/detailkuliner/{kuliner}', [PromosiKulinerController::class,'index'])->name('detailkuliner');
Route::get('/detailtour/{tour}', [PromosiTourController::class,'index'])->name('detailtour');
Route::get('/detailsepeda/{sepeda}', [PromosiSepedaController::class,'index'])->name('detailsepeda');
Route::get('/detailcamp/{camp}', [PromosiCampController::class,'index'])->name('detailcamp');
Route::get('/detailinformasi/{informasi}',[InformasiController::class,'index'])->name('detailinformasi');

Route::get('/checkout', [CartController::class, 'Checkout'])->name('checkout');
Route::post('/checkout', [CartController::class, 'CheckoutStore'])->name('checkoutstore');
Route::get('/cartproduk', [CartController::class,'Cart'])->name('cart');
Route::post('/cartproduk', [CartController::class,'storeCart'])->name('cartstore');
Route::delete('/cartproduk/delete/{id}', [CartController::class,'delete']);
Route::delete('/cartproduk/deleteall', [CartController::class,'deleteAll']);

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::post('/layananmitra', [TransaksiMitraController::class, 'create']);
    Route::post('/layananmitra/create', [TransaksiMitraController::class, 'store']);

    Route::get('/riwayat',[RiwayatController::class,'index'])->name('riwayat');

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
    Route::get('/boardingkuliner', [PromosiKulinerController::class,'index'])->name('showbordingkuliner');
    Route::post('/bordingkuliner', [PromosiKulinerController::class,'boording'])->name('bordingkuliner');
    Route::get('/bookchartkuliner', [PromosiKulinerController::class,'create'])->middleware('auth')->name('createkuliner');
    Route::post('/bookchartkuliner/kuliner/{kuliner}', [PromosiKulinerController::class,'store'])->name('storekuliner');
    Route::put('/bookchartkuliner/{riwayat}', [PromosiKulinerController::class,'update'])->name('updatekuliner');

    //Camp
    Route::get('/boardingcamp', [PromosiCampController::class,'index'])->name('showbordingcamp');
    Route::post('/bordingcamp', [PromosiCampController::class,'boording'])->name('bordingcamp');
    Route::get('/bookchartcamp', [PromosiCampController::class,'create'])->middleware('auth')->name('createcamp');
    Route::post('/bookchartcamp/camp/{camp}', [PromosiCampController::class,'store'])->name('storecamp');
    Route::put('/bookchartcamp/{riwayat}', [PromosiCampController::class,'update'])->name('updatecamp');

    //Tour
    Route::get('/boardingtour', [PromosiTourController::class,'index'])->name('showbordingtour');
    Route::post('/bordingtour', [PromosiTourController::class,'boording'])->name('bordingtour');
    Route::get('/bookcharttour', [PromosiTourController::class,'create'])->middleware('auth')->name('createtour');
    Route::post('/bookcharttour/tour/{tour}', [PromosiTourController::class,'store'])->name('storetour');
    Route::put('/bookcharttour/{riwayat}', [PromosiTourController::class,'update'])->name('updatetour');

    //Sepeda
    Route::get('/boardingsepeda', [PromosiSepedaController::class,'index'])->name('showbordingsepeda');
    Route::post('/bordingsepeda', [PromosiSepedaController::class,'boording'])->name('bordingsepeda');
    Route::get('/bookchartsepeda', [PromosiSepedaController::class,'create'])->middleware('auth')->name('createsepeda');
    Route::post('/bookchartsepeda/sepeda/{sepeda}', [PromosiSepedaController::class,'store'])->name('storesepeda');
    Route::put('/bookchartsepeda/{riwayat}', [PromosiSepedaController::class,'update'])->name('updatesepeda');

    //Detail Riwayat
    Route::get('detailriwayat/{riwayat}', [RiwayatController::class,'show']);

    //Profile
    Route::get('/myprofile', [HomeController::class, 'Myprofile'])->name('myprofile');
    Route::post('/myprofile/{user}', [HomeController::class, 'UpdateMyProfile']);

    //Konfirmasi
    Route::get('/konfirmasi_pembayaran', [KonfirmasiController::class,'index'])->name('konfirmasi_pembayaran');
});

Route::middleware(['auth', 'verified','user'])->group(function () {

    Route::get('/konfirmasi_pembayaran/create', [KonfirmasiController::class,'create'])->name('create_konfirmasi_pembayaran');
    Route::post('/konfirmasi_pembayaran', [KonfirmasiController::class,'store'])->name('store_konfirmasi_pembayaran');
});

Route::group(['middleware' => ['auth', 'verified','admin']], function () {

    Route::get('/menu',[MenuController::class,'index'])->name('menu');
    Route::post('/menu/store',[MenuController::class,'store']);
    Route::post('/menu/edit/{menu}',[MenuController::class,'edit']);
    Route::post('/menu/update/{menu}',[MenuController::class,'update']);
    Route::delete('/menu/delete/{menu}',[MenuController::class,'destroy']);

    Route::get('/submenu',[SubMenuController::class,'index'])->name('submenu');
    Route::post('/submenu/store',[SubMenuController::class,'store']);
    Route::post('/submenu/edit/{subMenu}',[SubMenuController::class,'edit']);
    Route::post('/submenu/update/{subMenu}',[SubMenuController::class,'update']);
    Route::delete('/submenu/delete/{subMenu}',[SubMenuController::class,'destroy']);

    Route::get('/accessmenu',[AccessMenuController::class,'index'])->name('accessmenu');
    Route::post('/accessmenu/store',[AccessMenuController::class,'store']);
    Route::post('/accessmenu/edit/{accessMenu}',[AccessMenuController::class,'edit']);
    Route::post('/accessmenu/update/{accessMenu}',[AccessMenuController::class,'update']);
    Route::delete('/accessmenu/delete/{accessMenu}',[AccessMenuController::class,'destroy']);

    Route::get('/informasi',[InformasiController::class,'index'])->name('informasi');
    Route::post('/informasi/store',[InformasiController::class,'store']);
    Route::post('/informasi/edit/{informasi}',[InformasiController::class,'edit']);
    Route::post('/informasi/update/{informasi}',[InformasiController::class,'update']);
    Route::delete('/informasi/delete/{informasi}',[InformasiController::class,'destroy']);

    Route::get('/managementuser', [ManagementUserController::class, 'index'])->name('managementuser');
    Route::post('/managementuser/edit/{user}', [ManagementUserController::class, 'EditOfUser']);
    Route::post('/managementuser/update/{user}', [ManagementUserController::class, 'update']);

    Route::get('/showlayananmitra', [TransaksiMitraController::class,'index'])->name('layananmitra');
});

Route::group(['middleware' => ['auth','verified','mitra']], function () {

    Route::get('/konfirmasi_pembayaran/{konfirmasi}', [KonfirmasiController::class,'showValidasi']);
    Route::get('/konfirmasi_mitra/{konfirmasipembayaran}', [KonfirmasiController::class,'showValidasiMitra']);
    Route::post('/konfirmasi_download/mitra/{konfirmasipembayaran}', [KonfirmasiController::class,'downloadMitra']);
    Route::post('/konfirmasi_download/pembayaran/{konfirmasi}', [KonfirmasiController::class,'downloadPembayaran']);

    Route::get('/bus',[BusController::class,'index'])->name('bus');
    Route::post('/bus/store', [BusController::class,'store']);
    Route::post('/bus/edit/{bus}', [BusController::class,'edit']);
    Route::post('/bus/update/{bus}', [BusController::class,'update']);
    Route::delete('/bus/delete/{bus}', [BusController::class,'destroy']);

    Route::get('/mobil',[MobilController::class,'index'])->name('mobil');
    Route::post('/mobil/store', [MobilController::class,'store']);
    Route::post('/mobil/edit/{mobil}', [MobilController::class,'edit']);
    Route::post('/mobil/update/{mobil}', [MobilController::class,'update']);
    Route::delete('/mobil/delete/{mobil}', [MobilController::class,'destroy']);

    Route::get('/destinasi',[DestinasiController::class,'index'])->name('destinasi');
    Route::post('/destinasi/store', [DestinasiController::class,'store']);
    Route::post('/destinasi/edit/{destinasi}', [DestinasiController::class,'edit']);
    Route::post('/destinasi/update/{destinasi}', [DestinasiController::class,'update']);
    Route::delete('/destinasi/delete/{destinasi}', [DestinasiController::class,'destroy']);

    Route::get('/hotel',[HotelConteoller::class,'index'])->name('hotel');
    Route::post('/hotel/store', [HotelConteoller::class,'store']);
    Route::post('/hotel/edit/{hotel}', [HotelConteoller::class,'edit']);
    Route::post('/hotel/update/{hotel}', [HotelConteoller::class,'update']);
    Route::delete('/hotel/delete/{hotel}', [HotelConteoller::class,'destroy']);

    Route::get('/kapal',[KapalController::class,'index'])->name('kapal');
    Route::post('/kapal/store', [KapalController::class,'store']);
    Route::post('/kapal/edit/{kapal}', [KapalController::class,'edit']);
    Route::post('/kapal/update/{kapal}', [KapalController::class,'update']);
    Route::delete('/kapal/delete/{kapal}', [KapalController::class,'destroy']);

    Route::get('/paket',[PaketController::class,'index'])->name('paket');
    Route::post('/paket/store', [PaketController::class,'store']);
    Route::post('/paket/edit/{paket}', [PaketController::class,'edit']);
    Route::post('/paket/update/{paket}', [PaketController::class,'update']);
    Route::delete('/paket/delete/{paket}', [PaketController::class,'destroy']);

    Route::get('/kuliner',[KulinerController::class,'index'])->name('kuliner');
    Route::post('/kuliner/store', [KulinerController::class,'store']);
    Route::post('/kuliner/edit/{kuliner}', [KulinerController::class,'edit']);
    Route::post('/kuliner/update/{kuliner}', [KulinerController::class,'update']);
    Route::delete('/kuliner/delete/{kuliner}', [KulinerController::class,'destroy']);

    Route::get('/pusat',[PusatController::class,'index'])->name('pusat');
    Route::post('/pusat/store', [PusatController::class,'store']);
    Route::post('/pusat/edit/{pusat}', [PusatController::class,'edit']);
    Route::post('/pusat/update/{pusat}', [PusatController::class,'update']);
    Route::delete('/pusat/delete/{pusat}', [PusatController::class,'destroy']);

    Route::get('/guide',[GuideController::class,'index'])->name('guide');
    Route::post('/guide/store', [GuideController::class,'store']);
    Route::post('/guide/edit/{guide}', [GuideController::class,'edit']);
    Route::post('/guide/update/{guide}', [GuideController::class,'update']);
    Route::delete('/guide/delete/{guide}', [GuideController::class,'destroy']);

    Route::get('/tour',[TourController::class,'index'])->name('tour');
    Route::post('/tour/store', [TourController::class,'store']);
    Route::post('/tour/edit/{tour}', [TourController::class,'edit']);
    Route::post('/tour/update/{tour}', [TourController::class,'update']);
    Route::delete('/tour/delete/{tour}', [TourController::class,'destroy']);

    Route::get('/sepeda',[SepedaController::class,'index'])->name('sepeda');
    Route::post('/sepeda/store', [SepedaController::class,'store']);
    Route::post('/sepeda/edit/{sepeda}', [SepedaController::class,'edit']);
    Route::post('/sepeda/update/{sepeda}', [SepedaController::class,'update']);
    Route::delete('/sepeda/delete/{sepeda}', [SepedaController::class,'destroy']);

    Route::get('/camp',[CampController::class,'index'])->name('camp');
    Route::post('/camp/store', [CampController::class,'store']);
    Route::post('/camp/edit/{camp}', [CampController::class,'edit']);
    Route::post('/camp/update/{camp}', [CampController::class,'update']);
    Route::delete('/camp/delete/{camp}', [CampController::class,'destroy']);

    Route::get('/konfirmasi/{riwayat}',[RiwayatController::class,'edit'])->name('konfirmasi');
    Route::post('/konfirmasi/{riwayat}',[RiwayatController::class,'update'])->name('riwayatkonfirmasi');

    Route::post('/kabupaten',[ResponseApiController::class, 'kabupaten']);
});

    // //Coba
    // Route::get('/coba',[CobaController::class,'index'])->name('coba');
    // Route::post('/cobas',[CobaController::class,'coba'])->name('cobas');

