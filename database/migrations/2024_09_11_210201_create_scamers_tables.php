<?php

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
        Schema::create('scamers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('secondname')->nullable();
            $table->string('lastname')->nullable();
            $table->text('description')->nullable();
            $table->boolean('visible')->default(true)->nullable(false);
        });

        Schema::create('scamer_names', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('secondname')->nullable();
            $table->string('lastname')->nullable();
        });

        Schema::create('scamer_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('pass_serial')->nullable();
            $table->string('pass_number')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('is_real')->default(true)->nullable();
        });

        Schema::create('scamer_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('phone')->nullable();
        });

        Schema::create('scamer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type')->nullable(false);
            $table->text('url')->nullable(false);
        });

        Schema::create('scamer_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('photo_path')->nullable(false);
        });

        Schema::create('scamer_scam_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scamer_id')
                ->constrained('scamers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('description')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
        });

        Schema::create('scam_photo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scam_operation_id')
                ->constrained('scamer_scam_operations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('photo_path')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scamer_names');
        Schema::dropIfExists('scamer_passes');
        Schema::dropIfExists('scamer_phones');
        Schema::dropIfExists('scamer_profiles');
        Schema::dropIfExists('scamer_photos');

        Schema::dropIfExists('scam_photo');
        Schema::dropIfExists('scamer_scam_operations');
        Schema::dropIfExists('scamers');
    }
};
