<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateLiveuserUsersTable.
 */
class CreatePostsTable extends XotBaseMigration
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
                $table->foreignId('blog_author_id')->nullable()->constrained()->cascadeOnDelete();
                $table->foreignId('blog_category_id')->nullable()->constrained()->nullOnDelete();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('excerpt')->nullable();
                $table->string('banner')->nullable();
                $table->longText('content');
                $table->date('published_at')->nullable();
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table) : void {
                // if (! $this->hasColumn('current_team_id')) {
                //    $table->foreignId('current_team_id')->nullable();
                // }
                // if (! $this->hasColumn('profile_photo_path')) {
                //    $table->string('profile_photo_path', 2048)->nullable();
                // }
            }
        );
    }
}
