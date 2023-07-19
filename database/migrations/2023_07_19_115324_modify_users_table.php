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
        Schema::table('users', function(Blueprint $table){
            $table->string('lastName')->after('name');
            $table->string('phone', 15)->after('email')->nullable();
            $table->string('address')->after('phone')->nullable();
            $table->renameColumn('name', 'firstName');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->renameColumn('firstName', 'name');
            $table->dropColumn('lastName', 'phone', 'address');
        });
    }
};
