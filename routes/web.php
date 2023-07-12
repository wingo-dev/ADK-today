<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\Auth\VerificationController as AuthVerificationController;
use App\Http\Controllers\BanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinpaymentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductCodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\FileUploadController;
use App\Models\Event;
use App\Models\Payment;
use App\Utils\Helpers;
use App\Utils\Payment_Constants\PaymentCurrency;
use App\Utils\Payment_Constants\PaymentStatus;
use App\Utils\Payment_Constants\PaymentType;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;
use App\Notifications\PostVerificationNotification;
use App\Utils\Common\UserRoles;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/run/{command}', function($command){
    $res = Artisan::call($command);    
    return $res;
});
Route::get('get-towns', [TownController::class, 'getTowns'])->name('get.towns');
Route::get('get-tags', [TagController::class, 'getTags'])->name('get.tags');
Route::get('get-time',function(){
    return response()->json(Carbon::now()->toDateTimeString());
})->name('get.time');

Route::view('/copyright-policy', 'copyright-policy')->name('copyright-policy');
Route::view('/privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('/terms-of-use', 'terms-of-use')->name('terms-of-use');

Route::get('/event-detail/{id}', [EventController::class, 'detail'])->name('event-detail');

// Route::get('/test', function () {

//     $event = Event::first();
//     // dd(Carbon::now()->toTimeString());
//     dd($event->end_date <= Carbon::now()->toDateString() && $event->end_time < Carbon::now()->toTimeString());

//     return view('test');
// });


Auth::routes();

Route::middleware(['isBanned'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verifyOrLogout');
    Route::get('/land', [App\Http\Controllers\HomeController::class, 'land']);

    Route::get('/verificaction', [UserController::class, 'verificationView'])->name('verification.view');
    Route::get('/verification/resend/{email?}', [UserController::class, 'verificationResend'])->name('verification.modal.resend');
    Route::post('/verification/post', [UserController::class, 'verificationPost'])->name('verification.post');


    Route::view('/verification', 'verification');


    // Route::view('/verify-notice', 'auth.verify')->name('verification.notice');
    // Route::view('/verify-notice', 'auth.verify')->name('verification.resend');

    Route::get('/email/verify', [AuthVerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthVerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [AuthVerificationController::class, 'resend'])->name('verification.resend');

    Route::middleware(['auth', 'verifyOrLogout'])->group(function () {
        Route::post('file-upload', [FileUploadController::class, 'store'])->name('file.store');

        Route::get('home/events',[SearchController::class,'homeSearch'])->name('search');
        Route::middleware(['isAdmin'])->group(function () {


            Route::get('users/search',[UserController::class,'search'])->name('users.search');
            Route::get('ban-users/search',[BanController::class,'search'])->name('ban-users.search');
            Route::get('towns/search',[TownController::class,'search'])->name('towns.search');
            Route::get('tags/search',[TagController::class,'search'])->name('tags.search');



            Route::post('users/ban', [BanController::class, 'banUser'])->name('ban-users.ban');
            Route::post('users/unban', [BanController::class, 'unbanUser'])->name('ban-users.unban');
            Route::resource('ban-users', BanController::class)->only(['index', 'create']);
            Route::resource('users', UserController::class);
            Route::resource('counties', CountyController::class);
            Route::resource('towns', TownController::class);
            Route::resource('tags', TagController::class);
            Route::resource('categories', CategoryController::class);

        });

        Route::middleware(['isVendor'])->group(function () {
            Route::post('recommend/tag', [TagController::class, 'recommendTag'])->name('tags.recommend');
            Route::post('recommend/category', [CategoryController::class, 'recommendCategory'])->name('categories.recommend');

            Route::view('recommend/category','events.suggest-category')->name('categories.recommend.view');
            Route::get('recommend/tag',[TagController::class,'recommendTagView'])->name('tags.recommend.view');
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('isVendor');

            Route::resource('events', EventController::class);
            Route::get('/clone-event/{id}', [EventController::class, 'cloneEvent'])->name('clone-event');

        });


        Route::view('/profile', 'profile')->name('profile');
        Route::view('/password-change', 'profile-password')->name('password-change');
        // Route::get('account', [AccountSettingController::class, 'create'])->name('view-account')->middleware('verified');
        Route::get('profile/edit', [AccountSettingController::class, 'editProfile'])->name('profile-edit');
        Route::delete('account/delete', [AccountSettingController::class, 'destroy'])->name('delete-account');
        Route::put('update-account', [AccountSettingController::class, 'update'])->name('update-account');
        Route::get('account-settings', [AccountSettingController::class, 'settings'])->name('account-settings');
        Route::put('update-account-settings', [AccountSettingController::class, 'updateSettings'])->name('update-account-settings');
        
        Route::put('upgrade-vendor', [AccountSettingController::class, 'upgradeToVendor'])->name('upgrade-vendor');
    });
});
