<?php

namespace App\Http\Livewire\Auth\Passwords;

use Livewire\Component;

class Confirm extends Component
{
    public string $password = '';

    public function confirm(): void
    {
        $this->validate([
            'password' => 'required|password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm');
    }
}
