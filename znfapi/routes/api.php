<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PaketController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\FrontendController;
use App\Http\Controllers\API\BuatUndangan;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\API\PembayaranController;
use App\Http\Controllers\API\TemplateController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\ElemenController;
use App\Http\Controllers\API\MusikController;


Route::post('/send-otp', [OtpController::class, 'otp']);
Route::post('/verify-otp', [OtpController::class, 'verifyotp']);
Route::post('register', [AuthController::class, 'register']);
Route::post('register-ads', [AuthController::class, 'registerads']);

Route::post('login', [AuthController::class, 'login']);
Route::get('allusers', [AuthController::class, 'index']);


Route::get('view-paket', [PaketController::class, 'index']);
Route::get('view-paket/{id}', [PaketController::class, 'viewsinglepaket']);

Route::get('fetchproducts/{slug}', [FrontendController::class, 'product']);
Route::get('allproducts', [FrontendController::class, 'allproduct']);
Route::get('alltema', [FrontendController::class, 'alltema']);
Route::get('alluser', [FrontendController::class, 'alluser']);
Route::get('tema/{id}', [FrontendController::class, 'tema']);


Route::post('place-order', [BuatUndangan::class, 'placeorder']);
Route::get('edit-order/{id}', [BuatUndangan::class, 'editorder']);
Route::post('update-order/{id}', [BuatUndangan::class, 'updateorder']);
Route::delete('delete-order/{id}', [BuatUndangan::class, 'destroy']);
Route::get('vieworder', [BuatUndangan::class, 'vieworder']);
Route::get('vieworder/{userId}', [BuatUndangan::class, 'vieworderbyid']);
Route::get('view-product', [ProductController::class, 'index']);

Route::post('wish/{orderid}', [BuatUndangan::class, 'wish']);
Route::get('wish/{orderid}', [BuatUndangan::class, 'wishlist']);

Route::post('rsvp/{orderid}', [BuatUndangan::class, 'rsvp']);
Route::get('rsvp/{orderid}', [BuatUndangan::class, 'rsvplist']);

Route::get('daftar-pembayaran', [PembayaranController::class, 'index']);
Route::post('buat-pembayaran', [PembayaranController::class, 'buatPembayaran']);

Route::get('karakter', [TemplateController::class, 'karakter']);
Route::get('font', [TemplateController::class, 'font']);
Route::get('warna', [TemplateController::class, 'warna']);

Route::get('background', [TemplateController::class, 'background']);
Route::post('background', [TemplateController::class, 'backgroundstore']);
Route::get('background/{id}', [TemplateController::class, 'backgroundwid']);
Route::post('background-update/{id}', [TemplateController::class, 'backgroundupdate']);

Route::post('karakter', [TemplateController::class, 'karakterstore']);
Route::post('font', [TemplateController::class, 'fontstore']);
Route::post('warna', [TemplateController::class, 'warnastore']);


Route::get('getelemen', [ElemenController::class, 'index']);
Route::post('getelemen', [ElemenController::class, 'store']);
Route::get('getelemen/{id}', [ElemenController::class, 'show']);
Route::post('getelemen/{id}', [ElemenController::class, 'update']);
Route::delete('getelemen/{id}', [ElemenController::class, 'destroy']);

Route::post('upload-elemencover', [ElemenController::class, 'storeElemenCover']);
Route::post('upload-elemenpembuka', [ElemenController::class, 'storeElemenPembuka']);
Route::post('upload-elemenmempelai', [ElemenController::class, 'storeElemenMempelai']);
Route::post('upload-elemenlovestory', [ElemenController::class, 'storeElemenLovestory']);
Route::post('upload-elemengaleri', [ElemenController::class, 'storeElemenGaleri']);
Route::post('upload-elemenvideoprewed', [ElemenController::class, 'storeElemenVideoprewed']);
Route::post('upload-elemenacara', [ElemenController::class, 'storeElemenAcara']);
Route::post('upload-elemenrsvp', [ElemenController::class, 'storeElemenRSVP']);
Route::post('upload-elemenucapan', [ElemenController::class, 'storeElemenUcapan']);
Route::post('upload-elemenangpao', [ElemenController::class, 'storeElemenAngpao']);
Route::post('upload-elemenlivestreaming', [ElemenController::class, 'storeElemenLivestreaming']);
Route::post('upload-elemensusunanacara', [ElemenController::class, 'storeElemenSusunanacara']);
Route::post('upload-elemenpenutup', [ElemenController::class, 'storeElemenPenutup']);

Route::get('getkarakter', [ElemenController::class, 'indexKarakter']);
Route::post('getkarakter', [ElemenController::class, 'storeKarakter']);
Route::get('getkarakter/{id}', [ElemenController::class, 'showKarakter']);
Route::delete('getkarakter/{id}', [ElemenController::class, 'destroyKarakter']);

Route::post('upload-karaktercover', [ElemenController::class, 'storeKarakterCover']);
Route::post('upload-karaktermempelai', [ElemenController::class, 'storeKarakterMempelai']);
Route::post('upload-karakterlovestory', [ElemenController::class, 'storeKarakterLovestory']);
Route::post('upload-karakterangpao', [ElemenController::class, 'storeKarakterAngpao']);
Route::post('upload-karakterpenutup', [ElemenController::class, 'storeKarakterPenutup']);

Route::get('getmusik', [MusikController::class, 'getmusik']);
Route::post('getmusik', [MusikController::class, 'storemusik']);

Route::get('getfont', [MusikController::class, 'getfont']);
Route::get('getfont/{id}', [MusikController::class, 'getfontid']);
Route::post('getfont', [MusikController::class, 'storefont']);
Route::post('getfont/{id}', [MusikController::class, 'update']);
Route::delete('getfont/{id}', [MusikController::class, 'destroyfont']);

Route::get('getwarna', [MusikController::class, 'getwarna']);
Route::get('getwarna/{id}', [MusikController::class, 'getwarnaid']);
Route::post('getwarna', [MusikController::class, 'storewarna']);
Route::post('getwarna/{id}', [MusikController::class, 'updatewarna']);
Route::delete('getwarna/{id}', [MusikController::class, 'destroywarna']);

Route::middleware(['auth:sanctum', 'isAPIAdmin'])->group(function () {
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'You are in', 'status' => 200], 200);
    });

    Route::post('store-product', [ProductController::class, 'store']);
    Route::get('edit-product/{id}', [ProductController::class, 'edit']);
    Route::post('update-product/{id}', [ProductController::class, 'update']);

    Route::post('edit-status/{id}', [BuatUndangan::class, 'editStatus']);
    Route::delete('delete-produk/{id}', [ProductController::class, 'destroy']);
    Route::post('updateDesain/{id}', [ProductController::class, 'updateDesain']);
    Route::post('updateInfoMempelai/{id}', [ProductController::class, 'updateInfoMempelai']);
    Route::post('updateInfoAcara/{id}', [ProductController::class, 'updateInfoAcara']);
    Route::post('updateInfoTambahan/{id}', [ProductController::class, 'updateInfoTambahan']);
    Route::post('updateGaleri/{id}', [ProductController::class, 'updateGaleri']);


});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
