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
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->integer('load_capacity');
            $table->foreign('vehicle_id')
                  ->references('id')
                  ->on('vehicles')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        \Illuminate\Support\Facades\DB::statement('DROP VIEW IF EXISTS truck_details');

        /** @noinspection SqlNoDataSourceInspection */
        \Illuminate\Support\Facades\DB::statement(<<<SQL
            CREATE VIEW truck_details AS
            SELECT
                t.id AS id,
                v.id AS vehicle_id,
                v.brand,
                v.model,
                v.year,
                t.load_capacity,
                v.created_at,
                v.updated_at
            FROM trucks t
            INNER JOIN vehicles v ON t.vehicle_id = v.id
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
