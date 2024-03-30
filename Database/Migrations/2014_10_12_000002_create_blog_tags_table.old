<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Tag;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreateBlogTagsTable extends XotBaseMigration
{
    protected ?string $model_class = Tag::class;

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
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('name')) {
                    $table->string('name')->nullable();
                }

                if (! $this->hasColumn('slug')) {
                    $table->string('slug')->nullable();
                }

                if (! $this->hasColumn('type')) {
                    $table->string('type')->nullable();
                }

                if (! $this->hasColumn('order_column')) {
                    $table->integer('order_column')->nullable();
                }
            }
        );
    }
}
