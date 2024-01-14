<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Category;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreateBlogCategoriesTable extends XotBaseMigration
{
    protected ?string $model_class = Category::class;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->string('slug');
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('description')) {
                    $table->text('description')->nullable();
                }
                // if (! $this->hasColumn('profile_photo_path')) {
                //    $table->string('profile_photo_path', 2048)->nullable();
                // }
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
