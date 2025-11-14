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
        // ❌ Remove storing intended URL inside Livewire (causes loops)
        // We will let Laravel handle intended URLs automatically.
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {

            session()->regenerate();

            $user = Auth::user();

            // ✅ Admin redirect
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // ✅ Always redirect to home to avoid back/logout loops
            return redirect()->route('home');
        }

        $this->errorMessage = 'Invalid email or password.';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
