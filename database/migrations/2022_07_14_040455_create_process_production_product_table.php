<?php

use App\Models\ProcessProduction;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_production_product', function (Blueprint $table) {
            $table->foreignIdFor(ProcessProduction::class);
            $table->foreignIdFor(Product::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_production_product');
    }
};
