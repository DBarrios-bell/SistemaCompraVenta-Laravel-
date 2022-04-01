<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalepointIdToShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shoppings', function (Blueprint $table) {
            $table->unsignedBigInteger('salepoint_id')->after('status');
            $table->foreign('salepoint_id')->references('id')->on('sale_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppings', function (Blueprint $table) {
            $table->dropForeign('sale_points_salepoint_id_foreign');
            $table->dropColumn('salepoint_id');
        });
    }
}
