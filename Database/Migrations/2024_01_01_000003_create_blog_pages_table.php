<?php

declare(strict_types=1);

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Page;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateProfilesTable.
 */
class CreateBlogPagesTable extends XotBaseMigration
{
    protected ?string $model_class = Page::class;

    /**
     * db up.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->timestamps();
                $table->string('slug')->unique();
                $table->string('title');
                $table->text('content');
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
                if (! $this->hasColumn('content_blocks')) {
                    // $table->text('content_blocks')->nullable();
                    $table->json('content_blocks')->default(new Expression('(JSON_ARRAY())'));
                }

                if (! $this->hasColumn('sidebar_blocks')) {
                    // $table->text('sidebar_blocks')->nullable();
                    $table->json('sidebar_blocks')->default(new Expression('(JSON_ARRAY())'));
                }
                if (! $this->hasColumn('footer_blocks')) {
                    // $table->text('footer_blocks')->nullable();
                    $table->json('footer_blocks')->default(new Expression('(JSON_ARRAY())'));
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
