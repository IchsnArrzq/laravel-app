<?php

use App\Models\CategoryMachine;
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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CategoryMachine::class);
            $table->string('name');
            $table->string('number');
            $table->string('code');
            $table->string('brand');
            $table->date('purchase_date');
            $table->date('manufacture_date');
            $table->float('stroke');
            $table->string('production_area');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('machines');
    }
};
