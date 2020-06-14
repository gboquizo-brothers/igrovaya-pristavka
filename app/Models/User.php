<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\AuthChecker\Interfaces\HasLoginsAndDevicesInterface;
use Lab404\AuthChecker\Models\HasLoginsAndDevices;

class User extends Authenticatable implements MustVerifyEmail, HasLoginsAndDevicesInterface
{
    use HasLoginsAndDevices;
    use Notifiable;
    use Uuidable;


    protected $fillable = ['email', 'name', 'nick', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];
}
