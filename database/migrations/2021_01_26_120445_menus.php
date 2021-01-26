<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\MenuContract;

class Menus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MenuContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MenuContract::CATEGORY_ID);
            $table->string(MenuContract::TITLE);
            $table->string(MenuContract::URL);
            $table->string(MenuContract::ICON)->nullable();
            $table->string(MenuContract::IMG)->nullable();
            $table->integer(MenuContract::PARENT_ID)->default(0);
            $table->integer(MenuContract::LFT)->default(0);
            $table->integer(MenuContract::RGT)->default(0);
            $table->integer(MenuContract::DEPTH)->default(0);
            $table->enum(MenuContract::STATUS,MenuContract::STATUS_VALUES)->default(MenuContract::ACTIVE);
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
        Schema::dropIfExists(MenuContract::TABLE);
    }
}
