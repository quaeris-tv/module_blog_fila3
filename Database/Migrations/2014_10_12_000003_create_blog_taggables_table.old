<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Taggable;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreateBlogTaggablesTable extends XotBaseMigration
{
    protected ?string $model_class = Taggable::class;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table) : void {
                $table->id();
                $table->foreignId('tag_id');
                // ->constrained()->cascadeOnDelete();
                $table->morphs('taggable');
                $table->unique(['tag_id', 'taggable_id', 'taggable_type']);
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('tag_id')) {
                    $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
                }

                if (! $this->hasColumn('taggable_id')) {
                    $table->morphs('taggable');
                }

                if (! $this->hasColumn('updated_by')) {
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                }
            }
        );
    }
}
