<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\Contracts\Auth\PasswordBroker;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class Email extends Component
{
    public ?string $email;
    public string $emailSentMessage = '';

    public function sendResetPasswordLink(): void
    {
        $this->validate(['email' => ['required', 'email']]);

        $response = $this->broker()->sendResetLink(['email' => $this->email]);

        if ($response === Password::RESET_LINK_SENT) {
            $this->emailSentMessage = (string) __($response);
        }

        $this->addError('email', __($response));
    }

    public function broker(): PasswordBroker
    {
        return Password::broker();
    }

    public function render()
    {
        return view('livewire.auth.passwords.email');
    }
}
