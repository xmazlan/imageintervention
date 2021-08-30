<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signs', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 18)->unique();
            $table->string('fullname', 100);
            $table->foreignId('classGroupID')->constrained('classGroups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('positionID')->constrained('positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('institute', 50)->default('Pemerintah Kota Pekanbaru');
            $table->enum('positionType', ['lurah', 'camat', 'kadis', 'sekda']);
            $table->integer('moreUnderline')->default(0);
            $table->string('nohp')->nullable();
            $table->string('email')->nullable();
            $table->string('nik')->nullable();
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
        Schema::dropIfExists('signs');
    }
}
