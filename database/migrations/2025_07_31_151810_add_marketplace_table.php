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
        Schema::table('website', function (Blueprint $table) {
            $table->string('shopee');
            $table->string('tokopedia');
            $table->text('how_to_purchase');
            $table->text('about');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website', function (Blueprint $table) {
            $table->dropColumn(['shopee','tokopedia', 'about','how_to_purchase']);
        });
    }
};
