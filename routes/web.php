<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostJobController;
use App\Http\Middleware\IsEmployer;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\IsPremiumUser;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/register/seeker',[UserController::class,'createSeeker'])->name('create.seeker');
Route::post('/register/seeker',[UserController::class,'storeSeeker'])->name('store.seeker');

Route::get('/register/employer',[UserController::class,'createEmployer'])->name('create.employer');
Route::post('/register/employer',[UserController::class,'storeEmployer'])->name('store.employer');

Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/login',[UserController::class,'postLogin'])->name('login.post');

Route::post('/logout',[UserController::class,'logout'])->name('logout');

Route::get('/dashboard',[DashboardController::class,'index'])->middleware('verified')->name('dashboard');

Route::get('/verify',[DashboardController::class,'verify'])->name('verification.notice');
Route::get('/resend/verification/email',[DashboardController::class,'resend'])->name('resend.email');

Route::get('/subscription',[SubscriptionController::class,'subscribe'])->middleware(['auth', IsEmployer::class])-> name ('subscription');
// Route::get('/subscription',[SubscriptionController::class,'subscribe'])->middleware(['auth', IsEmployer::class])-> name ('subscription');
Route::get('/pay/weekly',[SubscriptionController::class,'initiatePayment'])->name('pay.weekly');
Route::get('/pay/monthly',[SubscriptionController::class,'initiatePayment'])->name('pay.monthly');
Route::get('/pay/yearly',[SubscriptionController::class,'initiatePayment'])->name('pay.yearly');
Route::get('/payment/success',[SubscriptionController::class,'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel',[SubscriptionController::class,'cancel'])->name('payment.cancel');

Route::get('/job/create',[PostJobController::class,'create'])->name('job.create')->middleware(["auth",IsPremiumUser::class]);
Route::post('/job/store',[PostJobController::class,'store'])->name('job.store')->middleware(["auth",IsPremiumUser::class]);
