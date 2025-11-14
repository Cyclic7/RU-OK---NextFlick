<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Throwable;

class MyProfile extends Component
{
    public string $name = '';
    public string $currentPassword = '';
    public string $newPassword = '';
    public string $confirmPassword = '';

    public bool $isGuest = false;

    public function mount()
    {
        // mark guest if no authenticated user
        $this->isGuest = ! Auth::check();

        // Only set name if user exists (avoid null -> property error)
        $this->name = Auth::user()->name ?? '';
    }

    /**
     * Update User Name
     */
    public function updateProfile()
    {
        if (! Auth::check()) {
            // If not authenticated, redirect to login (or show an error)
            return redirect()->route('login');
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        if (! $user instanceof User) {
            $this->addError('auth', 'Authenticated user is not valid.');
            return;
        }

        $user->name = $this->name;

        try {
            $user->save();
            session()->flash('success', 'Name updated successfully.');
        } catch (Throwable $e) {
            // Log the exception if you want (laravel.log), and show friendly message
            logger()->error('Profile save error: ' . $e->getMessage());
            session()->flash('error', 'Unable to save changes. Please try again later.');
        }
    }

    /**
     * Update Password
     */
    public function updatePassword()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'same:newPassword'],
        ]);

        $user = Auth::user();

        if (! $user instanceof User) {
            $this->addError('auth', 'Authenticated user is not valid.');
            return;
        }

        if (! Hash::check($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');
            return;
        }

        $user->password = Hash::make($this->newPassword);

        try {
            $user->save();
            session()->flash('success', 'Password updated successfully.');
            $this->reset('currentPassword', 'newPassword', 'confirmPassword');
        } catch (Throwable $e) {
            logger()->error('Password save error: ' . $e->getMessage());
            session()->flash('error', 'Unable to update password. Please try again later.');
        }
    }

    /**
     * Switch to Guest (unauthenticated visitor)
     */
   

    /**
     * Show logout modal only
     */
    public function logout()
    {
        $this->dispatch('show-logout-options');
    }

    /**
     * Fully logout after modal selection
     */
    public function logoutCompletely()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
