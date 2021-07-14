<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nis');
            $table->string('surat');
            $table->string('nama');
            $table->string('kelas');
            $table->string('va');
            $table->string('bank');
            $table->json('ket');
            $table->timestamps();
        });
        Schema::create('uploadtks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nis');
            $table->string('surat');
            $table->string('nama');
            $table->string('kelas');
            $table->string('va');
            $table->string('bank');
            $table->json('ket');
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
        Schema::dropIfExists('uploads');
        Schema::dropIfExists('uploadtks');
    }
}
