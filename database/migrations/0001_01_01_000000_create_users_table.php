<?php

use App\Domain\Entities\Usuario;
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
        Schema::create(Usuario::TABELA, function (Blueprint $table) {
            $table->bigIncrements(Usuario::ID);
            $table->string(Usuario::NOME);
            $table->integer(Usuario::IDADE);
            $table->timestamp(Usuario::DT_HR_CRIACAO);
            $table->timestamp(Usuario::DT_HR_ATUALIZACAO)->nullable();
            $table->timestamp(Usuario::DT_HR_DELECAO)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Usuario::TABELA);
    }
};
