<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Lab404\AuthChecker\Models\Login as Lab404Login;

class Login extends Lab404Login
{
    use Uuidable;

    protected $casts = ['user_id' => 'integer', 'user_type' => 'string', 'ip_address' => 'string'];
}
