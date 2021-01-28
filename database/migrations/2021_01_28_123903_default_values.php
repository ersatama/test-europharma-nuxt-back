<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\DefaultValueContract;

class DefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DefaultValueContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(DefaultValueContract::FILTER_ID);
            $table->string(DefaultValueContract::TITLE)->nullable();
            $table->integer(DefaultValueContract::PARENT_ID)->default(0);
            $table->integer(DefaultValueContract::LFT)->default(0);
            $table->integer(DefaultValueContract::RGT)->default(0);
            $table->integer(DefaultValueContract::DEPTH)->default(0);
            $table->enum(DefaultValueContract::STATUS,DefaultValueContract::STATUS_VALUES)
                ->default(DefaultValueContract::ACTIVE);
            $table->timestamps();
            $table->index(DefaultValueContract::FILTER_ID);
            $table->index(DefaultValueContract::PARENT_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DefaultValueContract::TABLE);
    }
}
