<?php

use App\Models\Machine;
use App\Models\Product;
use App\Models\Shift;
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
        Schema::create('planning_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Machine::class);
            $table->foreignIdFor(Shift::class);
            $table->bigInteger('qty_planning');
            $table->dateTime('datetimein');
            $table->dateTime('datetimeout');
            $table->integer('total');
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
        Schema::dropIfExists('planning_machines');
    }
};
