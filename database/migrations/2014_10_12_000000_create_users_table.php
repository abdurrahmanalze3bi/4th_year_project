<?php
// database/migrations/2014_10_12_000000_create_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // Remove wallet_id from here - we'll add it later

            // Personal information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

            // Profile details
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->enum('address', [
                'دمشق','درعا','القنيطرة','السويداء','ريف دمشق',
                'حمص','حماة','اللاذقية','طرطوس','حلب',
                'ادلب','الحسكة','الرقة','دير الزور'
            ])->nullable();

            // Social authentication
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();

            // Status flags
            $table->tinyInteger('status')->default(1);
            $table->boolean('is_verified_passenger')->default(0);
            $table->boolean('is_verified_driver')->default(0);
            $table->enum('verification_status', ['none','pending','rejected','approved'])
                ->default('none');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
