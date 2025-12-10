<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTurtlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turtles', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
            $table->text('modal_description');
            $table->string('latin_name')->nullable();
            $table->string('image_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turtles', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'modal_description', 'latin_name', 'image_path']);
        });
    }
}
