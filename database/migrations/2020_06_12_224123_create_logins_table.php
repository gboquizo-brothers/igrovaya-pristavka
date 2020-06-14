<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Lab404\AuthChecker\Models\Login;

class CreateLoginsTable extends Migration
{
    public function up(): void
    {
        Schema::create('logins', static function (Blueprint $table) {
            $table->uuid('id');
            $table->ipAddress('ip_address');
            $table->string('type')->default(Login::TYPE_LOGIN);
            $table->uuid('user_id');
            $table->uuid('device_id')->index()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
}
