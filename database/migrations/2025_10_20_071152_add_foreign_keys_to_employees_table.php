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
        Schema::table('employees', function (Blueprint $table) {
            
            // 1. TAMBAH department_id
            // Since you ran migrate:fresh, the table is empty, and this column should be added.
            // We use 'department_id', not 'departemen_id'.
            // The hasColumn check is technically unnecessary after migrate:fresh but is good practice.
            if (!Schema::hasColumn('employees', 'department_id')) {
                $table->unsignedBigInteger('department_id')->after('tanggal_masuk');
            }

            // 2. TAMBAH position_id
            // ***FIXED***: Placing it after the correct column name: 'department_id' (not 'departemen_id').
            if (!Schema::hasColumn('employees', 'position_id')) {
                $table->unsignedBigInteger('position_id')->after('department_id');
            }

            // 3. TAMBAH FOREIGN KEY for department_id
            // ***FIXED***: Using column 'department_id' and table 'departments'.
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments') 
                  ->onDelete('cascade');

            // 4. TAMBAH FOREIGN KEY for position_id
            $table->foreign('position_id')
                  ->references('id')
                  ->on('positions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Hapus foreign keys terlebih dahulu
            // ***FIXED***: Using column 'department_id'.
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);

            // Kemudian hapus kolomnya
            // ***FIXED***: Using column 'department_id'.
            $table->dropColumn(['department_id', 'position_id']);
        });
    }
};