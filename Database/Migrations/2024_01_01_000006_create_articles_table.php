<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateArticlesTable extends XotBaseMigration
{
    /**
     * db up.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->string('title')->unique();
                $table->text('content')->nullable();
                $table->string('picture')->nullable();
                $table->unsignedInteger('category_id')->nullable();
                $table->unsignedInteger('author_id')->nullable();
                $table->string('status')->nullable();
                $table->boolean('show_on_homepage')->default(0);
                $table->integer('read_time')->nullable();
                $table->string('slug');
                $table->text('excerpt')->nullable()->default(null);
                $table->date('published_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->foreign('category_id'); // ->references('id')->on('categories');
                $table->foreign('author_id'); // ->references('id')->on('users');
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                /*
                if ($this->hasColumn('auth_user_id')) {
                    $table->dropColumn('user_id');
                    $table->renameColumn('auth_user_id', 'user_id');
                }
                */
                if (! $this->hasColumn('published_at')) {
                    $table->dateTime('published_at')->nullable();
                }
                if (! $this->hasColumn('slug')) {
                    $table->string('slug')->unique();
                }
                if (! $this->hasColumn('title')) {
                    $table->string('title');
                }
                if (! $this->hasColumn('content_blocks')) {
                    $table->text('content_blocks')->nullable();
                }
                if (! $this->hasColumn('footer_blocks')) {
                    $table->text('footer_blocks')->nullable();
                }
                if (! $this->hasColumn('main_image_url')) {
                    $table->text('main_image_url')->nullable();
                }
                if (! $this->hasColumn('main_image_upload')) {
                    $table->text('main_image_upload')->nullable();
                }
                if (! $this->hasColumn('is_featured')) {
                    $table->boolean('is_featured')->default(false);
                }
                if (! $this->hasColumn('description')) {
                    $table->string('description');
                }
                if (! $this->hasColumn('uuid')) {
                    $table->uuid('uuid')->nullable()->after('id');
                }

                if ($this->hasColumn('is_closed')) {
                    $table->dropColumn('is_closed');
                }

                if (! $this->hasColumn('closed_at')) {
                    $table->dateTime('closed_at')->nullable();
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
