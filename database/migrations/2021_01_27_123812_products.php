<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\ProductContract;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ProductContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(ProductContract::MENU_ID);

            $table->string(ProductContract::BARCODE)->unique();
            $table->string(ProductContract::URL)->unique();
            $table->string(ProductContract::TITLE)->nullable();
            $table->text(ProductContract::DESCRIPTION)->nullable();
            $table->string(ProductContract::PRICE)->nullable();
            $table->string(ProductContract::DISCOUNT)->nullable();
            $table->string(ProductContract::LIMIT)->nullable();
            $table->string(ProductContract::QUANTITY)->nullable();

            $table->string(ProductContract::ECLUB)->nullable();
            $table->string(ProductContract::ECLUB_LIMIT)->nullable();
            $table->string(ProductContract::ECLUB_DISCOUNT)->nullable();

            $table->integer(ProductContract::PARENT_ID)->default(0);
            $table->integer(ProductContract::LFT)->default(0);
            $table->integer(ProductContract::RGT)->default(0);
            $table->integer(ProductContract::DEPTH)->default(0);
            $table->enum(ProductContract::STATUS,ProductContract::STATUS_VALUES)->default(ProductContract::ACTIVE);
            $table->timestamps();
            $table->index(ProductContract::MENU_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(ProductContract::TABLE);
    }
}
