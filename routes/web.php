<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

// 🎬 Frontend Components
use App\Livewire\MovieList;
use App\Livewire\MovieDetails;
use App\Livewire\MovieComments;

// 👤 Auth Components
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

// ⚙️ Settings Components
use App\Livewire\MyProfile;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;

// 🧩 Admin Components
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\AdminMovies;

// ======================================================
// 🧭 PUBLIC ROUTES (No Login Required)
// ======================================================
Route::get('/', MovieList::class)->name('home');
Route::get('/movies/{id}/details', MovieDetails::class)->name('movie.details');
Route::get('/movies/{id}/comments', MovieComments::class)->name('movie.comments');

// ======================================================
// 🔐 AUTH ROUTES (Guest Only)
// ======================================================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// ======================================================
// 👤 USER ROUTES (Requires Login)
// ======================================================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', MyProfile::class)->name('profile.show');
});

// ======================================================
// 🧑‍💼 ADMIN ROUTES (Requires Login)
// ======================================================
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/movies', AdminMovies::class)->name('movies');
    });

// ======================================================
// ⚙️ SETTINGS ROUTES (Requires Login)
// ======================================================
Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile')->name('settings');

    Route::get('settings/profile', MyProfile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            Features::optionEnabled(Features::twoFactorAuthentication(), 'confirm')
                ? ['password.confirm']
                : []
        )
        ->name('two-factor.show');
});
