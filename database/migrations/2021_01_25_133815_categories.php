<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\CategoryContract;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CategoryContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(CategoryContract::CATALOG_ID);
            $table->string(CategoryContract::TITLE);
            $table->string(CategoryContract::URL);
            $table->string(CategoryContract::ICON)->nullable();
            $table->string(CategoryContract::IMG)->nullable();
            $table->integer(CategoryContract::PARENT_ID)->default(0);
            $table->integer(CategoryContract::LFT)->default(0);
            $table->integer(CategoryContract::RGT)->default(0);
            $table->integer(CategoryContract::DEPTH)->default(0);
            $table->enum(CategoryContract::STATUS,CategoryContract::STATUS_VALUES)->default(CategoryContract::ACTIVE);
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
        Schema::dropIfExists(CategoryContract::TABLE);
    }
}
