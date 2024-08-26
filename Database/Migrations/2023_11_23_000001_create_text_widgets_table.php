<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateTextWidgetsTable.
 */
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class() extends XotBaseMigration {
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('key')->unique();
                $table->string('image', 2048)->nullable();
                $table->string('title', 2048)->nullable();
                $table->longText('content')->nullable();
                $table->boolean('active');
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('parent_id')) {
                //    $table->foreignId('parent_id')->nullable();
                // }
                // if (! $this->hasColumn('profile_photo_path')) {
                //    $table->string('profile_photo_path', 2048)->nullable();
                // }
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
