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
                $table->foreign('category_id'); //->references('id')->on('categories');
                $table->foreign('author_id'); //->references('id')->on('users');
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

                $this->updateTimestamps($table, true);
            }
        );
    }
}
