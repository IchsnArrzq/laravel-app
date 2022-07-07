<?php

use App\Models\Customer;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->string('part_name');
            $table->string('part_number');
            $table->bigInteger('cycle_time')->nullable();
            $table->string('process')->nullable();
            $table->string('type')->nullable();
            $table->string('unit')->nullable();
            $table->string('maker')->default('INPLAN')->nullable();
            $table->string('cavity')->nullable();
            $table->integer('machine_rate')->nullable();
            $table->string('welding_length')->nullable();
            $table->bigInteger('dies')->nullable();
            $table->bigInteger('dies_lifetime')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
