<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Tag;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateBlogTagsTable.
 */
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class() extends XotBaseMigration {
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
    protected ?string $model_class = Tag::class;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->json('name');
                $table->json('slug');
                $table->string('type')->nullable();
                $table->integer('order_column')->nullable();

                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('name')) {
                //    $table->string('name');
                // }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
