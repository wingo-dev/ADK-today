<?php

use App\Utils\Common\UserRoles;
use App\Utils\Common\UserStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();

            $table->integer('role')->default(UserRoles::USER);//  default = User  (3 =user, 2 = vendor, 1 = admin,  0 = super admin)
            $table->integer('status')->default(UserStatus::UNVERIFIED);// (3 = verified, 2 = unverified, 1 = deactivated, 0 = blocked

            // vendor onlies
            $table->string('name')->nullable();
            $table->string('title')->nullable();// (vendor only)
            $table->string('organization')->nullable();// (vendor only)
            $table->string('phone')->nullable();// (vendor only)
            $table->string('url')->nullable();// (vendor only)
            $table->string('town')->nullable();// (vendor only)
            $table->string('county')->nullable();//(vendor only)
            $table->string('zip')->nullable();// (vendor only)
            $table->string('state')->nullable();// (vendor only) Default = New York
            // end vendor only

            // System only
            $table->string('ip_address')->nullable();// (system value only)
            $table->string('last_login')->nullable();// (system value only)
            // end System only


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
