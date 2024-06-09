<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('antrian_id');
            $table->foreign('antrian_id')->references('id')->on('antrian_usahas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('noantrian')->nullable();
            $table->string('nama_pembeli');
            $table->timestamp('CreatedDateTime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('SudahDilayani')->nullable();
            $table->string('Jawaban1')->nullable();
            $table->string('Jawaban2')->nullable();
            $table->string('Jawaban3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
