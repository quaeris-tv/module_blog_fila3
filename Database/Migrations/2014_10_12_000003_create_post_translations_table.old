<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreatePostTranslationsTable extends XotBaseMigration
{
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
                // $table->foreignId('blog_author_id')->nullable()->constrained()->cascadeOnDelete();
                // $table->foreignId('blog_category_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('post_id');
                $table->string('locale');
                $table->string('title')->nullable();
                $table->string('slug')->nullable();
                $table->text('excerpt')->nullable();
                $table->string('banner')->nullable();
                $table->longText('content');
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('title')) {
                    $table->string('title')->nullable();
                    $table->string('slug')->nullable()->change();
                }

                // if (! $this->hasColumn('profile_photo_path')) {
                //    $table->string('profile_photo_path', 2048)->nullable();
                // }
            }
        );
    }
}
