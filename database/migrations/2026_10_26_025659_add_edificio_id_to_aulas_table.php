
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->foreignId('edificio_id')
                ->nullable()
                ->constrained('edificios')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->dropForeign(['edificio_id']);
            $table->dropColumn('edificio_id');
        });
    }
};
