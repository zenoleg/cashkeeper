<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->executeTransactionTable();
        $this->executeUserTable();
        $this->executeCategoryTable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->revertTransactionTable();
        $this->revertUserTable();
        $this->revertCategoryTable();
    }

    /**
     * Создает таблицу транзакций
     */
    public function executeTransactionTable(): void
    {
        Schema::create('zen_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable(false);
            $table->boolean('is_cost')->nullable(false);
            $table->string('name')->nullable(false);
            $table->text('description');
            $table->string('category_id');
            $table->double('value')->nullable(false);
            $table->timestamps();

            $table->primary('id');

            $table->foreign('user_id')
                ->references('user_id')->on('zen_users')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')->on('zen_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Создает таблицу пользователей
     */
    public function executeUserTable(): void
    {
        Schema::create('zen_users', function (Blueprint $table) {
            $table->integer('user_id')->nullable(false)->unique();
            $table->string('name')->nullable(false);
            $table->double('balance')->nullable(false);
            $table->timestamps();

            $table->primary('user_id');
        });
    }

    /**
     * Создает таблицу пользователей
     */
    public function executeCategoryTable(): void
    {
        Schema::create('zen_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false)->unique();

            $table->primary('id');
        });
    }


    /**
     * Удаляет таблицу пользователей
     */
    public function revertUserTable(): void
    {
        Schema::drop('zen_users');
    }

    /**
     * Удаляет таблицу транзакций
     */
    public function revertTransactionTable(): void
    {
        Schema::drop('zen_transactions');
    }

    /**
     * Удаляет таблицу категорий
     */
    public function revertCategoryTable(): void
    {
        Schema::drop('zen_categories');
    }
}
