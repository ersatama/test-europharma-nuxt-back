<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\CharacteristicContract;

class Characteristics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CharacteristicContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(CharacteristicContract::PRODUCT_ID);
            $table->bigInteger(CharacteristicContract::FILTER_ID);
            $table->string(CharacteristicContract::TITLE)->nullable();
            $table->integer(CharacteristicContract::PARENT_ID)->default(0);
            $table->integer(CharacteristicContract::LFT)->default(0);
            $table->integer(CharacteristicContract::RGT)->default(0);
            $table->integer(CharacteristicContract::DEPTH)->default(0);
            $table->enum(CharacteristicContract::STATUS,CharacteristicContract::STATUS_VALUES)->default(CharacteristicContract::ACTIVE);
            $table->timestamps();
            $table->index(CharacteristicContract::PRODUCT_ID);
            $table->index(CharacteristicContract::FILTER_ID);
            $table->index(CharacteristicContract::PARENT_ID);
            $table->index(CharacteristicContract::TITLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CharacteristicContract::TABLE);
    }
}
