<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Profile extends Component
{
    public $name;
    public $email;
    public $password = '';
    public $newPassword = '';
    public $confirmPassword = '';

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        /** @var User $user */
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email',
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('success', 'Profile updated successfully!');
    }
    public function updatePassword()
    {
        $this->validate([
            'password' => 'required',
            'newPassword' => 'required|min:6|same:confirmPassword',
        ]);

        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            session()->flash('error', 'User not found.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        $user->password = Hash::make($this->newPassword);
        $user->save();

        $this->reset(['password', 'newPassword', 'confirmPassword']);
        session()->flash('success', 'Password changed successfully!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
