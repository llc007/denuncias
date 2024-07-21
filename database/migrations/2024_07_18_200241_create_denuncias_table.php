<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->boolean('anonima')->default(false);
            $table->string('tipo_denuncia');
            $table->string('donde_sucedio');
            $table->date('cuando_sucedio');
            $table->text('descripcion_hecho');
            $table->string('estado')->default('Nueva'); // Agregado campo estado con valor por defecto 'Nueva'
            $table->string('folio')->unique();
            $table->string('pin');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacion con la tabla users
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
        Schema::dropIfExists('denuncias');
    }
}
