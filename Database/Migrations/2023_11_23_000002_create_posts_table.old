<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\User\Models\User;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreatePostsTable.
 */
class CreatePostsTable extends XotBaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->id();
                $table->string('title', 2048);
                $table->string('slug', 2048);
                $table->string('thumbnail', 2048)->nullable();
                $table->longText('body');
                $table->boolean('active')->default(false);
                $table->datetime('published_at')->nullable();
                $table->foreignIdFor(User::class, 'user_id');
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('meta_title')) {
                    $table->string('meta_title', 255)->nullable();
                }
                if (! $this->hasColumn('meta_description')) {
                    $table->string('meta_description', 255)->nullable();
                }

                $this->updateTimestamps($table);
            }
        );
    }
}
