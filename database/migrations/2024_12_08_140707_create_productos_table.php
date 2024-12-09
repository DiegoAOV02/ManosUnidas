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
        if(!Schema::hasTable('productos')) {
            Schema::create('productos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // Relación con la tabla users
                $table->string('nombre_producto');
                $table->text('descripcion_producto')->nullable();
                $table->decimal('precio', 10, 2);
                $table->integer('unidades_disponibles');
                $table->string('categoria');
                $table->string('imagen_path')->nullable(); // Ruta de la imagen subida
                $table->timestamps();
                // Llave foránea
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }); 
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};