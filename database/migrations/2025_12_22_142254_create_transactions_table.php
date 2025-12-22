<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // amount_cents column storing money amount as cents - so lets say i spend 25.23 EUR, that would be 2523 cents, basically when storing we multiply by 100, and when displaying we divide by 100
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete(); // making a foreign key on users id from users table. 
            $table->enum('type',['income', 'expense']); // using enum, lets set the only accepted values that will be set in database. 
            $table->unsignedInteger('amount_cents'); // unsigned integers CANNOT be negative, so for money amount we use unsigned integer. 
            $table->char('currency',3)->default('EUR');   
            $table->string('category', 100)->nullable();
            $table->date('occurred_on');
            $table->longText('note')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'type', 'occurred_on']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
