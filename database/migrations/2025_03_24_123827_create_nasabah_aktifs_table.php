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
        Schema::create('nasabah_aktifs', function (Blueprint $table) {
            $table->id();
            $table->string('noAccount');
            $table->string('custname');
            $table->string('branch_id');
            $table->string('account_type');
            $table->string('account_status');
            $table->string('gudang_id');
            $table->string('rak_id');
            $table->string('createdby');
            $table->string('updatedby');
            $table->string('dokumen_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah_aktifs');
    }
};
