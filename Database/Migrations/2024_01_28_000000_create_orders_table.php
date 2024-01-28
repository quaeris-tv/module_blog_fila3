<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 *  .
 */
class CreateOrdersTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                // $table->uuid('orderId')->unique();
                // $table->uuid('productId')->index();
                // $table->integer('quantity');
                // $table->integer('total');
                // $table->timestamps();

                $table->date('date')->unique();
                $table->uuid('articleId');
                $table->integer('bet_credits');
                $table->timestamps();
            });

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('current_team_id')) {
                //    $table->foreignId('current_team_id')->nullable();
                // }
            }
        );
    }
}
