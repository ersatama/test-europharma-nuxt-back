<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\BrandContract;

class Brands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(BrandContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(BrandContract::TITLE);
            $table->string(BrandContract::ICON)->nullable();
            $table->string(BrandContract::IMG)->nullable();
            $table->integer(BrandContract::PARENT_ID)->default(0);
            $table->integer(BrandContract::LFT)->default(0);
            $table->integer(BrandContract::RGT)->default(0);
            $table->integer(BrandContract::DEPTH)->default(0);
            $table->enum(BrandContract::STATUS,BrandContract::STATUS_VALUES)->default(BrandContract::ACTIVE);
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
        Schema::dropIfExists(BrandContract::TABLE);
    }
}
