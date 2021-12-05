<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Nome do cliente');
            $table->string('type', 10)->comment('Tipo de cliente - Física ou Jurídica');
            $table->string('state', 2)->comment('Unidade da Federação');
            $table->integer('category_id')->comment('Categoria');
            $table->date('start')->comment('Data: Fundacao para PJ ou Nascimento para PF');
            $table->string('telephones', 255)->comment('Telefones do cliente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
