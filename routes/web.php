<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\MovieList;
use App\Livewire\MovieDetails;use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;



Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile.show');
});



Route::get('/', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/list', MovieList::class)->name('home');
Route::get('/movies/{id}', MovieDetails::class)->name('movies.details');


// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('home');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

