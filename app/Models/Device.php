<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Lab404\AuthChecker\Models\Device as Lab404Device;

class Device extends Lab404Device
{
    use Uuidable;

    protected $casts = ['user_id' => 'integer', 'user_type' => 'string', 'ip_address' => 'string'];
}
