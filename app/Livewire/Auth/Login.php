<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $errorMessage = '';

    public function mount()
    {
        // ✅ Store the previous page (if not already coming from login/register)
        if (!session()->has('url.intended') && url()->previous() !== route('login')) {
            session(['url.intended' => url()->previous()]);
        }
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            $user = Auth::user();

            // ✅ Redirect admin or return to intended page
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // ✅ Go back to where they were (movie page, etc.)
            return redirect()->intended(route('home'));
        }

        $this->errorMessage = 'Invalid email or password.';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

