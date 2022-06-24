<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalityCodeMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationality_code_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('nationality_code_id');
            $table->string('custom_nationality_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationality_code_mappings');
    }
}
