<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 *  .
 */
return new class extends XotBaseMigration {
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

                $table->date('date');
                $table->nullableMorphs('model');
                $table->integer('rating_id');
                $table->integer('credits');
                $table->timestamps();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('rating_id')) {
                    $table->integer('rating_id')->after('article_id');
                }

                if ($this->hasColumn('article_id')) {
                    $table->dropColumn('article_id');
                    $table->nullableMorphs('model');
                }
                if ($this->hasColumn('bet_credits')) {
                    $table->renameColumn('bet_credits', 'credits');
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
