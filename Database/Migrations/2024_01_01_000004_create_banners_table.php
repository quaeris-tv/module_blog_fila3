<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class .
 */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class() extends XotBaseMigration {
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
return new class extends XotBaseMigration {
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
return new class extends XotBaseMigration {
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                /*
                'desktop_thumbnail' => 'string',
                'mobile_thumbnail' => 'string',
                'desktop_thumbnail_webp' => 'string',
                'mobile_thumbnail_webp' => 'string',
                */
                $table->string('link')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('action_text')->nullable();
                $table->string('category_id', 36)->index()->nullable();
                $table->datetime('start_date')->nullable();
                $table->datetime('end_date')->nullable();
                $table->boolean('hot_topic')->default(false);
                $table->integer('open_markets_count')->nullable();
                $table->boolean('landing_banner')->default(false);
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);

                if (! $this->hasColumn('pos')) {
                    $table->integer('pos')->nullable();
                }
            }
        );
    }
};
