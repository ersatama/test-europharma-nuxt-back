<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\FilterContract;

class Filters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(FilterContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(FilterContract::MENU_ID);
            $table->string(FilterContract::TITLE);
            $table->integer(FilterContract::PARENT_ID)->default(0);
            $table->integer(FilterContract::LFT)->default(0);
            $table->integer(FilterContract::RGT)->default(0);
            $table->integer(FilterContract::DEPTH)->default(0);
            $table->enum(FilterContract::STATUS,FilterContract::STATUS_VALUES)->default(FilterContract::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(FilterContract::TABLE);
    }
}
