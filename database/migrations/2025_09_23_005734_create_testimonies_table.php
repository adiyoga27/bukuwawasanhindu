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
        Schema::create('testimonies', function (Blueprint $table) {
              $table->id();
            $table->string('name'); // Nama pemberi testimoni
            $table->string('role')->nullable(); // Profesi/jabatan
            $table->string('photo')->nullable(); // Path foto profil
            $table->unsignedTinyInteger('rating')->default(5); // Bintang 1-5
            $table->text('message'); // Isi testimoni
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonies');
    }
};
