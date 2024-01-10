<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class .
 */
class CreateMenusTable extends XotBaseMigration
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

                $table->string('name');
                $table->text('items')->nullable();
                // $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('items')) {
                    $table->text('items')->nullable();
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
