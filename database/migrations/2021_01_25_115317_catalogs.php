<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\CatalogContract;

class Catalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CatalogContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(CatalogContract::TITLE);
            $table->string(CatalogContract::URL);
            $table->string(CatalogContract::ICON)->nullable();
            $table->string(CatalogContract::IMG)->nullable();
            $table->integer(CatalogContract::PARENT_ID)->default(0);
            $table->integer(CatalogContract::LFT)->default(0);
            $table->integer(CatalogContract::RGT)->default(0);
            $table->integer(CatalogContract::DEPTH)->default(0);
            $table->enum(CatalogContract::STATUS,CatalogContract::STATUS_VALUES)->default(CatalogContract::ACTIVE);
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
        Schema::dropIfExists(CatalogContract::TABLE);
    }
}
