<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Company;

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

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/company', function () {
    return view('company.index', [
        'company' => Company::first()
    ]);
})->name('company');

Route::resource('restaurants', RestaurantController::class)->only(['index', 'show']);

Route::middleware('verified')->group(function () {
    Route::resource('restaurants.reviews', ReviewController::class)->only('create', 'store', 'edit', 'update', 'destroy')->middleware('subscribed');
    Route::resource('restaurants.reservations', ReservationController::class)->only(['store'])->middleware('subscribed');
    Route::resource('reservations', ReservationController::class)->only(['index', 'destroy'])->middleware('subscribed');
    Route::get('/mypage', function () {
        return view('mypage.index');
    })->name('mypage');
    Route::get('user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('user', [UserController::class, 'update'])->name('user.update');

    Route::get('subscription', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('subscription/edit', [SubscriptionController::class, 'edit'])->middleware('subscribed')->name('subscription.edit');
    Route::post('subscription/update', [SubscriptionController::class, 'update'])->middleware('subscribed')->name('subscription.update');
    Route::get('subscription/cancel', [SubscriptionController::class, 'cancel'])->middleware('subscribed')->name('subscription.cancel');
    Route::post('subscription/destroy', [SubscriptionController::class, 'destroy'])->middleware('subscribed')->name('subscription.destroy');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('login', [Dashboard\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [Dashboard\Auth\LoginController::class, 'login'])->name('login');
    Route::post('logout', [Dashboard\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('/', [Dashboard\HomeController::class, 'index'])->name('home');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'admin.auth'], function () {
    Route::get('users', [Dashboard\UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [Dashboard\UserController::class, 'show'])->name('users.show');
    Route::resource('restaurants', Dashboard\RestaurantController::class);
    Route::resource('categories', Dashboard\CategoryController::class)->except('show', 'create');
    Route::resource('companies', Dashboard\CompanyController::class)->only(['index', 'edit', 'update']);
});
