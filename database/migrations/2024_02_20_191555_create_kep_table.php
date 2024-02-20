<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('etkinlikler', function (Blueprint $table) {
            $table->id();
            $table->string('OGR_NO');
            $table->integer('BIRIM_ICI');
            $table->integer('BIRIM_DISI');
            $table->string('AYNI_FAKULTE');
            $table->string('ETKINLIK_ADI');
            $table->enum('KATILIM', ['Tamamlandı', '']);
            $table->string('EKTINLIK_KEY');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etkinlikler');
    }
};